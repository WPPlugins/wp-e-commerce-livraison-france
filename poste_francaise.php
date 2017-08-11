<?php
/*
Plugin Name: WP e-Commerce Livraison France
Plugin URI: http://wpcb.fr/plugin-livraison-france
Description: Livraison depuis la France vers la France et l'étranger (Plugin requis : WP e-Commerce)
Version: 1.1.2
Author: 6WWW
Author URI: http://6www.net
*/


class postefrancaise {
	var $internal_name, $name;
	var $services = array();
	var $settings;
	var $base_country;
	var $base_zipcode;
	
	//  Constructor
	function postefrancaise () {
		$this->internal_name = "wpsc_postefrancaise";
		$this->name = 'Poste Française';
		$this->is_external = true;
		$this->requires_weight = true;
		$this->needs_zipcode = true;
		$this->debug = false; // change to true to log (to the PHP error log) the API URLs and responses for each active service
		
		// Initialise the list of available postage services
		$this->services['LETTREMAX'] = __('Lettre MAX', 'wpsc');
		$this->services['COLIS'] = __('Colis', 'wpsc');
		$this->services['CHRONOPOST'] = __('Chronopost', 'wpsc');
		$this->services['ENLEVEMENT'] = __('Enlèvement sur place', 'wpsc');
		
		// Attempt to load the existing settings
		$this->settings = get_option("wpsc_postefrancaise_settings");
		$this->base_country = get_option('base_country');
		$this->base_zipcode = get_option('base_zipcode');
		
		if (!$this->settings) {
			// Initialise the settings with defaults values:
			$this->settings = array();
			$this->settings['services']['LETTREMAX'] = true;
			$this->settings['services']['COLIS'] = true;
			$this->settings['services']['CHRONOPOST'] = true;
			$this->settings['services']['ENLEVEMENT'] = true;
			$this->settings['address'] = 'Centre Ville de Lyon, France';
			$this->settings['days_to_france']['COLIS'] = 4;
			$this->settings['days_to_OM1']['COLIS'] = 8;
			$this->settings['days_to_OM2']['COLIS'] = 12;
			$this->settings['days_to_international_zone_A']['COLIS'] = 15;
			$this->settings['days_to_international_zone_B']['COLIS'] = 15;
			$this->settings['days_to_international_zone_C']['COLIS'] = 15;
			$this->settings['days_to_international_zone_D']['COLIS'] = 15;
			$this->settings['days_to_france']['CHRONOPOST'] = 0.5;
			$this->settings['days_to_zone_1']['CHRONOPOST'] = 3;
			$this->settings['days_to_zone_2']['CHRONOPOST'] = 3;
			$this->settings['days_to_zone_3']['CHRONOPOST'] = 3;
			$this->settings['tarif_lettre']['COLIS'] = false;
			$this->settings['debug'] = false;
			$this->settings['type_tarif_lettre']['COLIS'] = 'prioritaire';
			update_option('wpsc_postefrancaise_settings', $this->settings);
		}
		
		return true;
	} // end constructor
	
	function getName() {
		return $this->name;
	}
	
	function getInternalName() {
		return $this->internal_name;
	}
	
	function getForm() {
		$output = '';
		if ($this->base_country != 'FR') {
			return __('Ne fonctionne que pour un commerçant basé en France.', 'wpsc');
		}
		// base_zipcode should be given and equal to 5 (french zipcode)
		if (strlen($this->base_zipcode) != 5) {
			return __('Entrer votre code postal plus haut sur cette page.', 'wpsc');
		}
		// Load the values :
		// Create the admin form
		$output.='<tr><td>';
		$output.='</td></tr>';
		$output .= "<tr><td><p>Adresse physique :</p></td></tr><tr><td><input type='text' name='wpsc_postefrancaise_settings[address]' value='".$this->settings['address']."'></td></tr>";
		$output .= "<tr><td>" . __('Choisissez les services que vous voulez proposer:', 'wpsc') . "</td></tr>";
		// Lettre Max :
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['services']['LETTREMAX']=='on'){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[services][LETTREMAX]'/>".$this->services['LETTREMAX']."</label></td></tr>";
		// Colis :
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['services']['COLIS']=='on'){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[services][COLIS]'/>".$this->services['COLIS']."</label></td></tr>";
		// CHRONOPOST
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['services']['CHRONOPOST']=='on'){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[services][CHRONOPOST]'/>".$this->services['CHRONOPOST']."</label></td></tr>";
		// Enlà¨vement sur place :
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['services']['ENLEVEMENT']=='on'){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[services][ENLEVEMENT]'/>".$this->services['ENLEVEMENT']."</label></td></tr>";	
		
		$output.="<tr><td><label>Délais de livraison vers la France pour les colis standards (colissimo) :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_france][COLIS]' value='".$this->settings[days_to_france][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'outre zone OM1 pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_OM1][COLIS]' value='".$this->settings[days_to_OM1][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'outre zone OM2 pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_OM2][COLIS]' value='".$this->settings[days_to_OM2][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone A pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_international_zone_A][COLIS]' value='".$this->settings[days_to_international_zone_A][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone B pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_international_zone_B][COLIS]' value='".$this->settings[days_to_international_zone_B][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone C pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_international_zone_C][COLIS]' value='".$this->settings[days_to_international_zone_C][COLIS]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone D pour les Colis :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_international_zone_D][COLIS]' value='".$this->settings[days_to_international_zone_D][COLIS]."'/></td></tr>";
		// Option tarif lettre :
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['tarif_lettre']['COLIS']){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[tarif_lettre][COLIS]'/>Utiliser le tarif <strong>lettre</strong> pour les colis < 3kg (pas pour les lettre max)</label></td></tr>";
		// 2 choix : lettre verte ou lettre prioritaire :
		$output.='<tr><td><INPUT type="radio" name="wpsc_postefrancaise_settings[type_tarif_lettre][COLIS]" value="prioritaire"';
		if ($this->settings['type_tarif_lettre']['COLIS']=='prioritaire'){
			$output.=' checked="checked" ';
		}
		$output.="> Lettre Prioritaire</input> ";
		$output.='<INPUT type="radio" name="wpsc_postefrancaise_settings[type_tarif_lettre][COLIS]" value="verte"';
		if ($this->settings['type_tarif_lettre']['COLIS']=='verte'){
			$output.=' checked="checked" ';
		}
		$output.="> Lettre Verte</input></td></tr>";
		// CHRONOPOST
		
		$output.="<tr><td><label>Délais de livraison vers la France métropolitaine et monaco pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_france][CHRONOPOST]' value='".$this->settings[days_to_france][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 1 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_1][CHRONOPOST]' value='".$this->settings[days_to_zone_1][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 2 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_2][CHRONOPOST]' value='".$this->settings[days_to_zone_2][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 3 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_3][CHRONOPOST]' value='".$this->settings[days_to_zone_3][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 4 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_4][CHRONOPOST]' value='".$this->settings[days_to_zone_4][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 5 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_5][CHRONOPOST]' value='".$this->settings[days_to_zone_5][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 6 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_6][CHRONOPOST]' value='".$this->settings[days_to_zone_6][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 7 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_7][CHRONOPOST]' value='".$this->settings[days_to_zone_7][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 8 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_8][CHRONOPOST]' value='".$this->settings[days_to_zone_8][CHRONOPOST]."'/></td></tr>";
		$output.="<tr><td><label>Délais de livraison vers l'international zone 9 pour les colis chronopost :</label></td></tr>";
		$output.="<tr><td><input type='text' name='wpsc_postefrancaise_settings[days_to_zone_9][CHRONOPOST]' value='".$this->settings[days_to_zone_9][CHRONOPOST]."'/></td></tr>";
		
		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['tarif_pretaexpedier']['CHRONOPOST']){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[tarif_pretaexpedier][CHRONOPOST]'/>Utiliser les produits <strong>prêt-à-expédier</strong> pour les colis chronopost <6kg -> </label></td></tr>";
		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][enveloppe_document][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['enveloppe_document']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Enveloppe 500g et 1kg (documents uniquement)</input> ";
		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][pochette_gonflable][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['pochette_gonflable']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Pochette gonflable 1kg et 2kg</input> ";
		$output.="> Enveloppe 500g et 1kg (documents uniquement)</input> ";
		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][boite][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['boite']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Boîte 3kg et 6kg</input> ";
		// UE : 
		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][enveloppe_document_ue][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['enveloppe_document_ue']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Enveloppe 500g Union Européenne (documents uniquement)</input> ";
		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][pochette_gonflable_ue][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['pochette_gonflable_ue']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Pochette gonflable 2kg Union Européenne</input> ";

		$output.='<tr><td><INPUT type="checkbox" name="wpsc_postefrancaise_settings[tarif_pretaexpedier][boite_ue][CHRONOPOST]" ';
		if ($this->settings['tarif_pretaexpedier']['boite_ue']['CHRONOPOST']){
			$output.=' checked="checked" ';
		}
		$output.="> Boîte 6kg Union Européene</input> ";

		$output .= "<tr><td><label><input type='checkbox' ";
		if ($this->settings['debug']){
			$output.=" checked='checked' ";
		}
		$output.=" name='wpsc_postefrancaise_settings[debug]'/>Mode debug</label></td></tr>";

		// Autres options :
		$output.= "<input type='hidden' name='wpsc_postefrancaise_settings_updateoptions' value='true'>";
		$output.= "</td></tr>";
		$output.= "<tr><td><h4>" . __('Notes:', 'wpsc') . "</h4>";
		$output.= '1. Lacheteur aura le choix de la méthode de livraison au moment de régler son panier.<br />';
		$output.= '2. Le poids de chaque produit doit être renseigné.<br />';
		$output.= '3. Les dimensions de chaque produit doivent àªtre renseignées (optionel)<br />';
		$output.= "</tr></td>";
		$output.= "<tr><td><h4>" . __('Tarifs:', 'wpsc') . "</h4>";
		$output.= '<a href="http://www.laposte.fr/content/download/12782/102894/file/fm-resume-tarifs-particuliers-2011d_10_01.pdf?espace=particulier" target="_blank">Lettre</a> | <a href="http://www.laposte.fr/content/download/9317/67273/file/Métropole%20BP.pdf?espace=particulier" target="_blank">Colis</a> | <a href="http://www.chronopost.fr/transport-express/webdav/site/chronov4/users/chronopost/public/pdf/Tarifs_et_VPC/Tarifs_guichet.pdf" target="_blank">Chronopost</a>';
		$output.= "</tr></td>";
		
		return $output;
	} // End of getForm function
	
	function submit_form() {
		$this->settings['services'] = array();

		// Only continue if this module's options were updated
		if ( !isset($_POST["wpsc_postefrancaise_settings_updateoptions"]) || !$_POST["wpsc_postefrancaise_settings_updateoptions"] ) return;
		
		// Save the settings :
		$this->settings['services']['LETTREMAX'] = $_POST['wpsc_postefrancaise_settings']['services']['LETTREMAX'];
		$this->settings['services']['COLIS'] = $_POST['wpsc_postefrancaise_settings']['services']['COLIS'];
		$this->settings['services']['CHRONOPOST'] = $_POST['wpsc_postefrancaise_settings']['services']['CHRONOPOST'];					
		$this->settings['services']['ENLEVEMENT'] = $_POST['wpsc_postefrancaise_settings']['services']['ENLEVEMENT'];
		$this->settings['address']=$_POST['wpsc_postefrancaise_settings']['address'];
		$this->settings['tarif_lettre']['COLIS']=$_POST['wpsc_postefrancaise_settings']['tarif_lettre']['COLIS'];
		$this->settings['type_tarif_lettre']['COLIS']=$_POST['wpsc_postefrancaise_settings']['type_tarif_lettre']['COLIS'];
		$this->settings['days_to_france']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_france']['COLIS'];
		$this->settings['days_to_OM1']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_OM1']['COLIS'];
		$this->settings['days_to_OM2']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_OM2']['COLIS'];
		$this->settings['days_to_international_zone_A']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_international_zone_A']['COLIS'];
		$this->settings['days_to_international_zone_B']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_international_zone_B']['COLIS'];
		$this->settings['days_to_international_zone_C']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_international_zone_C']['COLIS'];
		$this->settings['days_to_international_zone_D']['COLIS']=$_POST['wpsc_postefrancaise_settings']['days_to_international_zone_D']['COLIS'];
		$this->settings['days_to_france']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_france']['CHRONOPOST'];
		$this->settings['days_to_zone_1']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_1']['CHRONOPOST'];
		$this->settings['days_to_zone_2']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_2']['CHRONOPOST'];
		$this->settings['days_to_zone_3']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_3']['CHRONOPOST'];
		$this->settings['days_to_zone_4']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_4']['CHRONOPOST'];
		$this->settings['days_to_zone_5']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_5']['CHRONOPOST'];
		$this->settings['days_to_zone_6']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_6']['CHRONOPOST'];
		$this->settings['days_to_zone_7']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_7']['CHRONOPOST'];
		$this->settings['days_to_zone_8']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_8']['CHRONOPOST'];
		$this->settings['days_to_zone_9']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['days_to_zone_9']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['enveloppe_document']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['enveloppe_document']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['pochette_gonflable']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['pochette_gonflable']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['boite']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['boite']['CHRONOPOST'];
		// Union européenne prêt-a-expédier :
		$this->settings['tarif_pretaexpedier']['enveloppe_document_ue']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['enveloppe_document_ue']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['pochette_gonflable_ue']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['pochette_gonflable_ue']['CHRONOPOST'];
		$this->settings['tarif_pretaexpedier']['boite_ue']['CHRONOPOST']=$_POST['wpsc_postefrancaise_settings']['tarif_pretaexpedier']['boite_ue']['CHRONOPOST'];
		$this->settings['debug']=$_POST['wpsc_postefrancaise_settings']['debug'];
		// Save to db :
		update_option('wpsc_postefrancaise_settings',$this->settings);
		
			
		return true;
	} // End of submit_form function
	
	function getQuote() {
		global $wpdb, $wpsc_cart;
		$wpsc_postefrancaise_settings= get_option("wpsc_postefrancaise_settings");

		if ($this->base_country != 'FR' || strlen($this->base_zipcode) != 5 || !count($wpsc_cart->cart_items)) return;
		$dest = $_SESSION['wpsc_delivery_country'];
		$destzipcode = '';
		if(isset($_POST['zipcode'])) {
			$destzipcode = $_POST['zipcode'];      
			$_SESSION['wpsc_zipcode'] = $_POST['zipcode'];
		} 
		else if(isset($_SESSION['wpsc_zipcode'])) {
			$destzipcode = $_SESSION['wpsc_zipcode'];
		}
		if ($dest == 'FR' && strlen($destzipcode) != 5) {return array();}

		/*
		3 possible scenarios:
		1. Cart consists of only item(s) that have "disregard shipping" ticked.
		In this case, WPEC doesn't mention shipping at all during checkout, and this shipping module probably won't be executed at all.
		Just in case it does get queried, we should still override the quoted price(s) to $0.00 so the customer is able to get free shipping.
		2. Cart consists of only item(s) where "disregard shipping" isn't ticked (ie. all item(s) attract shipping charges).
		In this case, we should query the quote as per normal.
		3. Cart consists of one or more "disregard shipping" product(s), and one or more other products that attract shipping charges.
		In this case, we should query the quote, only taking into account the product(s) that attract shipping charges.
		Products with "disregard shipping" ticked shouldn't have their weight or dimensions included in the quote.
		*/
		

		// Weight is in grams
		$weight = wpsc_convert_weight($wpsc_cart->calculate_total_weight(true), 'pound', 'gram');
		// Calculate the total cart dimensions by adding the volume of each product then calculating the cubed root
		$volume = 0;
		// Total number of item(s) in the cart
		$numItems = count($wpsc_cart->cart_items);

		if ($numItems == 0) {
		    // The customer's cart is empty. This probably shouldn't occur, but just in case!
		    return array();
		}

		// Total number of item(s) that don't attract shipping charges.
		$numItemsWithDisregardShippingTicked = 0;

		foreach($wpsc_cart->cart_items as $cart_item) {
			if ( !$cart_item->uses_shipping ) {
			    // The "Disregard Shipping for this product" option is ticked for this item.
			    // Don't include it in the shipping quote.
			    $numItemsWithDisregardShippingTicked++;
			    continue;
			}

			// If we are here then this item attracts shipping charges.
			$meta = get_product_meta($cart_item->product_id,'product_metadata',true);
			$meta = $meta['dimensions'];

			if ($meta && is_array($meta)) {
				$productVolume = 1;
				foreach (array('width','height','length') as $dimension) {
					// Cubi square of the dimension to get the volume of the box it will be squared later
					switch ($meta["{$dimension}_unit"]) {
						// we need the units in mm
						case 'cm':
							// convert from cm to mm
							$productVolume = $productVolume * (floatval($meta[$dimension]) * 10);
							break;
						case 'meter':
							// convert from m to mm
							$productVolume = $productVolume * (floatval($meta[$dimension]) * 1000);
							break;
						case 'in':
							// convert from in to mm
							$productVolume = $productVolume * (floatval($meta[$dimension]) * 25.4);
							break;
					}
				}
				$volume += floatval($productVolume);
			}
		}
		// Calculate the cubic root of the total volume, rounding up
		$cuberoot = ceil(pow($volume, 1 / 3));
		
		// Use default dimensions of 100mm if the volume is zero
		$height=100; // Mettre dans les options, todo
		$width=100;
		$length=100;
		
		if ($cuberoot > 0) {
		    $height = $width = $length = $cuberoot;
		}

		if ($length < 100) $length = 100;
		if ($width < 100) $width = 100;

		$shippingPriceNeedsToBeZero = false;
		
		if ($numItemsWithDisregardShippingTicked == $numItems) {
		    // The cart consists of entirely "disregard shipping" products, so the shipping quote(s) should be $0.00
		    // Set the weight to 1 gram so that we can obtain valid Australia Post quotes (which we will then ignore the quoted price of)
		    $weight = 1;
		    $shippingPriceNeedsToBeZero = true;
		}
		
		$params = array(
		    'Pickup_Postcode' => $this->base_zipcode
		    , 'Destination_Postcode' => $destzipcode
		    , 'Quantity' => 1
		    , 'Weight' => $weight
		    , 'Height' => $height
		    , 'Width' => $width
		    , 'Length' => $length
		    , 'Country' => $dest
		);
		$plugin_dir_path = dirname(__FILE__);
		include( $plugin_dir_path.'/tarifs/tarifs_lettremax.php');
		include( $plugin_dir_path.'/tarifs/tarifs_colis.php');
		include( $plugin_dir_path.'/tarifs/tarifs_chronopost.php');	
		// ENLEVEMENT
		$service_postefrancaise='ENLEVEMENT';
		$methods[$service_postefrancaise]['name']='Enlèvement sur place à  l\'adresse : '.$this->settings['address'];
		$methods[$service_postefrancaise]['charge']=0; // Ne coute rien
		$methods[$service_postefrancaise]['err_msg']='OK';
		
		// Allow another WordPress plugin to override the quoted method(s)/amount(s)
		$methods = apply_filters('wpsc_postefrancaise_methods', $methods, $this->base_zipcode, $destzipcode, $dest, $weight);
		
		$quotedMethods = array();
		
		if ($this->settings['debug']){
		$text = sprintf('Poids : %1$d grammes',$params['Weight']);
		$quotedMethods[$text] = 1;
		}
		
		foreach ($methods as $code => $data) {
			// Only include methods with an OK response
			if ($data['err_msg'] != 'OK') continue;
			// Only include methods that are checked in the admin :
			if (!$this->settings['services'][$code]) continue;
			if ($data['days']) {
				// If the estimated number of days is specified, so include it in the quote
				$text = sprintf('%1$s (temps de livraison estimé : %2$d jours ouvrables)', $data['name'], $data['days']);
			}
			else {
				// No time estimate
				$text = $data['name'];
			}
			$quotedMethods[$text] = $data['charge'];
		}
		return $quotedMethods;
	} // End of getQuote function
	
	function get_item_shipping() {} // don't delete
}

function postefrancaise_setup() {
	global $wpsc_shipping_modules;
	$postefrancaise = new postefrancaise();
	$wpsc_shipping_modules[$postefrancaise->getInternalName()] = $postefrancaise;
}

add_action('plugins_loaded', 'postefrancaise_setup');
?>
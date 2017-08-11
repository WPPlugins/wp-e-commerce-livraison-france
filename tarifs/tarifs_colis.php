<?php

// Tableaux des destinations COLIS :
		$dest_colis_fr=array('FR');
		$dest_colis_outre_mer_zone_1=array('GP','MQ','GY','RE','YT','PM');
		$dest_colis_outre_mer_zone_2=array('NC','PF','WF','TF');
		$dest_colis_international_zone_A=array('AD','AL','AM' ,'AT' ,'AX' ,'AZ' ,'BA' ,'BE' ,'BG' ,'BY' ,'CH' ,'CY' ,'CZ' ,'DE' ,'DK','EE','ES','FI','FO','FR','GB','GE','GG','GI','GR','HR','HU','IE' ,'IM','IS','IT','JE' ,'KZ' ,'LI' ,'LT' ,'LU' ,'LV','MC','MD','ME','MK','MT','NL','NO','PL','PT','RO','RS','RU','SE','SI','SJ','SK','SM','TR' ,'UA' ,'VA') ;
		$dest_colis_international_zone_B=array('DZ','MA','LY','TN','MR'); // +Europe de l'est to do
		$dest_colis_international_zone_C=array('CA','US'); // + Proche et moyen Orient + Afrique Hors Magreb todo
		$dest_colis_international_zone_D=array(); // + reste du monde todo
		
		// colis :
		$service_postefrancaise='COLIS';
		// Utilisation de l'api "home-made" (uniquement a destination de france métropolitaine)
		if (in_array($params['Country'],$dest_colis_fr)){
			// Tarifs à  destination de la france :
			$methods[$service_postefrancaise]['name']='Colis France métropolitaine et Monaco';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_france'][$service_postefrancaise];
			//Table tarifaire colis France Métropolitaine et Monaco
			if($params['Weight']>=0 && $params['Weight']<=20){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=0.60; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=0.57; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=5.60;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>20 && $params['Weight']<=50){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=1.00; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=0.95; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=5.60;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>50 && $params['Weight']<=100){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=1.45; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=1.40; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=5.60;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>100 && $params['Weight']<=250){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=2.40; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=2.30; 
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=5.60;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>250 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=3.25;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=3.10;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=5.60;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=4.20;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=4.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=6.95;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=5.50;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=5.25;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=7.95;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_lettre'][$service_postefrancaise]){
					// Tarif different si tarif_lettre coché :
					// 2 types de tarif lettre : tarif prioritaire et tarif verte :
					if ($wpsc_postefrancaise_settings['type_tarif_lettre'][$service_postefrancaise]=='prioritaire'){
						$methods[$service_postefrancaise]['charge']=6.40;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else { //verte
						$methods[$service_postefrancaise]['charge']=6.10;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else { // Pas de tarif lettre :
						$methods[$service_postefrancaise]['charge']=8.95;
						$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=10.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=12.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=15.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=18.20;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=30000){
				$methods[$service_postefrancaise]['charge']=24.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids non trouvé';
			}
		} // Fin des tarifs France Monaco
		elseif (in_array($params['Country'],$dest_colis_outre_mer_zone_1)){
			// Tarifs à  destination de la zone outre mer 1
			$methods[$service_postefrancaise]['name']='Colis Outre-Mer Zone 1';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_OM1'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				$methods[$service_postefrancaise]['charge']=8.45;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>500 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=12.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=17.35;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=22.00;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=26.65;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=31.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=35.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=40.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=45.25;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=49.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=54.55;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=77.75;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=100.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>20000 && $params['Weight']<=25000){
				$methods[$service_postefrancaise]['charge']=124.15;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>25000 && $params['Weight']<=30000){
				$methods[$service_postefrancaise]['charge']=147.35;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids non trouvé';
				}
		} // Fin de zone Colis outre mer zone 1
		// Tarifs à  destination de la zone outre mer 2
		elseif (in_array($params['Country'],$dest_colis_outre_mer_zone_2)){
			$methods[$service_postefrancaise]['name']='Colis Outre-Mer Zone 2';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_OM2'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				$methods[$service_postefrancaise]['charge']=10.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>500 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=15.20;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=26.80;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=38.40;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=50.00;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=61.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=73.20;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=84.80;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=96.40;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=108.00;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=119.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=177.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=235.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>20000 && $params['Weight']<=25000){
				$methods[$service_postefrancaise]['charge']=293.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>25000 && $params['Weight']<=30000){
				$methods[$service_postefrancaise]['charge']=351.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids > 30 kg impossible';
				}
		} // Fin de zone Colis outre mer zone 2
		elseif (in_array($params['Country'],$dest_colis_international_zone_A) ){
			$methods[$service_postefrancaise]['name']='Colis International Zone A';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_international_zone_A'][$service_postefrancaise];
		// Zone Internationale A
			if($params['Weight']>=0 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=16.15;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=17.85;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=21.55;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=25.25;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=28.95;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=32.65;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=36.35;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=40.05;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=43.75;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=47.45;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=54.65;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=61.85;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>20000 && $params['Weight']<=25000){
				$methods[$service_postefrancaise]['charge']=69.05;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>25000 && $params['Weight']<=30000){
				$methods[$service_postefrancaise]['charge']=76.25;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {$methods[$service_postefrancaise]['err_msg']='Poids > 30 kg impossible';}
		} // Fin zone A
		elseif (in_array($params['Country'],$dest_colis_international_zone_B)) { // + Europe de l'est todo.
			$methods[$service_postefrancaise]['name']='Colis International Zone B';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_international_zone_B'][$service_postefrancaise];
		// Zone Internationale B
			if($params['Weight']>=0 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=19.80;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=21.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=26.25;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=30.80;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=35.35;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=39.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=44.45;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=49.00;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=53.55;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=58.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=68.50;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=78.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids > 20 kg impossible';
			}
		} // Fin international zone B
		// Zone Internationale C
		elseif (in_array($params['Country'],$dest_colis_international_zone_C)){
			$methods[$service_postefrancaise]['name']='Colis International Zone C';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_international_zone_C'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=23.20;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=31.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=40.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=50.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=60.50;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=70.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=80.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=89.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=99.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=109.50;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=133.60;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=157.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids > 20 kg impossible';
			}
		}// Fin international zone C
		else { // Tarif internationaux colis Zone D
			$methods[$service_postefrancaise]['name']='Colis International Zone D';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_international_zone_D'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=1000){
				$methods[$service_postefrancaise]['charge']=26.40;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				$methods[$service_postefrancaise]['charge']=39.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				$methods[$service_postefrancaise]['charge']=52.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=4000){
				$methods[$service_postefrancaise]['charge']=66.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>4000 && $params['Weight']<=5000){
				$methods[$service_postefrancaise]['charge']=79.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				$methods[$service_postefrancaise]['charge']=92.50;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=7000){
				$methods[$service_postefrancaise]['charge']=105.70;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>7000 && $params['Weight']<=8000){
				$methods[$service_postefrancaise]['charge']=118.90;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>8000 && $params['Weight']<=9000){
				$methods[$service_postefrancaise]['charge']=132.10;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>9000 && $params['Weight']<=10000){
				$methods[$service_postefrancaise]['charge']=145.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
				$methods[$service_postefrancaise]['charge']=171.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
				$methods[$service_postefrancaise]['charge']=197.30;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids > 20 kg impossible';
			}
		} // Fin de international zone D
?>
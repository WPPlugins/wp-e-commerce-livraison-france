<?php
// CHRONOPOST (jusqu'à  zone 3 pour le moment)
		$dest_chronopost_fr=array('FR');
		$dest_chronopost_zone_1=array('DE','BE','LU','NL');
		$dest_chronopost_zone_2=array('AT','DE','ES','FI','GB','GR','IE','IT','PT','SE');
		$dest_chronopost_zone_3=array('BU','CY','EE','HU','LV','LT','MT','PL','CZ','RO','SK','SI');
		$dest_chronopost_zone_4=array('AL','AD','AM','BY','BA','IC','HR','FO','GE','GI','GS','IS','JE','LI','MK','MD','ME','NO','RU','SM','RS','CH','TR','UA'); // Europe hors UE
		$dest_chronopost_zone_5=array('AI','AG','AR','AW','BS','BB','BZ','BM','BO','BR','CA','KY','CL','CO','CR','CU','AN','DO','DM','SV','EC','US','GD','GL','GT','GY','HT','HN','JM','MX','MS','NI','PA','PY','PE','PR','AN','KN','VC','VI','LC','SR','TT','TC','UY','VE','VI','VG'); // Amerique
		$dest_chronopost_zone_6=array('ZA','DZ','AO','SA','AZ','BH','BI','BW','BF','CM','CV','CF','KM','CG','CD','CI','DJ','EG','AE','ER','ET','GA','GM','GH','GN','GW','GQ','IQ','IR','IL','JO','KE','KW','LS','LB','LR','LY','MG','MW','ML','MA','MU','MR','MZ','NA','NE','NG','OM','UG','PS','QA','RW','ST','SN','SC','SL','SO','SD','SZ','SY','TZ','TD','TG','TN','YE','ZM','ZW'); // Afrique moyen orient
		$dest_chronopost_zone_7=array('AF','AU','BD','BT','BN','KH','CN','CX','CC','CK','KR','FJ','GU','HK','IN','ID','JP','KZ','KG','KI','LA','MO','MY','MV','MH','FM','MN','MM','NR','NP','NF','NZ','UZ','PK','PW','PG','PH','MP','SB','WS','AS','SG','LK','TK','TW','TH','TL','TO','TM','TV','VU','VN',); // Asie Océanie
		$dest_chronopost_zone_8=array('GP','MQ','RE'); 
		$dest_chronopost_zone_9=array('GY','YT','NC','PF','PM','WF'); // 
		
		
		$service_postefrancaise='CHRONOPOST';
		if (in_array($params['Country'],$dest_chronopost_fr)){
			$methods[$service_postefrancaise]['name']='Chrono 13 France métropolitaine et Monaco';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_france'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=22.50;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_document'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=23.50;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						$methods[$service_postefrancaise]['err_msg']='Méthode non connue';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=33.52;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=23.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=23.50;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						$methods[$service_postefrancaise]['err_msg']='Méthode non connue';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=33.52;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>1000 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=25.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=33.52;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=33.52;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>2000 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=27.01;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=38.31;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=38.31;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>3000 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=30.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=38.31;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=38.31;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>5000 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=30.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=46.99;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=46.99;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif ($params['Weight']>6000 && $params['Weight']<=10000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=46.99;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>10000 && $params['Weight']<=15000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=55.69;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>15000 && $params['Weight']<=20000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=64.36;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>20000 && $params['Weight']<=25000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=73.04;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif ($params['Weight']>25000 && $params['Weight']<=30000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=81.73;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			else {
				$methods[$service_postefrancaise]['err_msg']='Poids trop élevé pour chronopost';
			}
		} // Fin de chronopost France
		elseif (in_array($params['Country'],$dest_chronopost_zone_1)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 1';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_1'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=46.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=47.07;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=47.07;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=53.25;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=53.25;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=59.42;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=59.42;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=65.59;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=65.59;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=71.76;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=71.76;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=77.93;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=77.93;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=84.10;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=84.10;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=90.27;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=90.27;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=96.45;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=96.45;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=102.62;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=102.62;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=108.79;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=108.79;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=114.96;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=114.96;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=121.13;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=127.30;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=133.47;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=139.64;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=145.82;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=151.99;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=158.16;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=164.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*3.59;//todo : round sup
				$methods[$service_postefrancaise]['charge']=164.33+$TarifSup;
				$methods[$service_postefrancaise]['err_msg']='OK';

			}
		} // Fin de chronopost zone 1
		elseif (in_array($params['Country'],$dest_chronopost_zone_2)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 2';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_2'][$service_postefrancaise];
if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=46.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=51.81;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=51.81;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=58.56;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=58.56;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=65.30;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=65.30;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=72.05;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=72.05;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=78.79;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=78.79;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=85.54;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=85.54;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=92.28;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=92.28;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=99.03;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=99.03;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=105.77;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=105.77;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=112.52;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=112.52;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=119.27;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=119.27;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=126.01;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=126.01;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=132.76;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=139.50;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=146.25;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=152.99;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=159.74;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=166.48;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=173.23;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=179.97;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*4.88;//todo : round sup
				$methods[$service_postefrancaise]['charge']=179.97+$TarifSup;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
		} // Fin de chronopost zone 2
		elseif (in_array($params['Country'],$dest_chronopost_zone_3)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 3';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_3'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=46.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=96.77;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=96.77;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=114.23;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=114.23;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=131.69;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=131.69;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=57.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=149.15;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=149.15;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=166.61;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=166.61;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=184.08;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=184.08;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=196.87;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=196.87;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=209.67;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=209.67;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=222.47;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=222.47;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=235.27;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=235.27;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=248.06;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=248.06;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_ue'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=88.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=260.86;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=260.86;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=273.66;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=286.45;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=299.25;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=312.05;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=324.85;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=337.64;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=350.44;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=363.24;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*10.52;//todo : round sup
				$methods[$service_postefrancaise]['charge']=363.24+$TarifSup;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
		} // Fin de chronopost zone 3
		// OUTRE MER ZONE 8
		elseif (in_array($params['Country'],$dest_chronopost_zone_8)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 8 (Outre-mer)';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_8'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=78.01;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=78.01;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=88.27;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=88.27;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=98.54;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=98.54;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=108.80;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=108.80;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=119.06;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=119.06;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=129.33;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=129.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=140.33;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=140.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=144.83;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=144.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=149.33;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=149.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=153.83;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=153.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=158.33;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=158.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
					else {
						//Tarif chronopost emballé par vos soins
						$methods[$service_postefrancaise]['charge']=162.83;
						$methods[$service_postefrancaise]['err_msg']='OK';
					}
				}
				else{
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=162.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=167.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=171.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=176.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=180.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=185.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=189.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=194.33;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					//Tarif chronopost emballé par vos soins
					$methods[$service_postefrancaise]['charge']=198.83;
					$methods[$service_postefrancaise]['err_msg']='OK';
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*6.60;//todo : round sup
				$methods[$service_postefrancaise]['charge']=198.83+$TarifSup;
				$methods[$service_postefrancaise]['err_msg']='OK';
			}
		} // Fin de chronopost zone 8
		// OUTRE MER ZONE 9
		elseif (in_array($params['Country'],$dest_chronopost_zone_9)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 9 (Outre-mer)';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_9'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=92.38;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=92.38;
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=114.60;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=114.60;
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=136.81;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=136.81;
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=159.03;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=159.03;
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=181.25;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=181.25;
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=203.47;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=203.47;
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=227.38;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=227.38;
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=242.79;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=242.79;
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=258.20;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=258.20;
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=273.61;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=273.61;
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=287.87;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=287.87;
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=302.13;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=302.13;
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					$methods[$service_postefrancaise]['charge']=316.39;
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					$methods[$service_postefrancaise]['charge']=330.65;
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					$methods[$service_postefrancaise]['charge']=344.91;
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					$methods[$service_postefrancaise]['charge']=359.17;
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					$methods[$service_postefrancaise]['charge']=373.43;
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					$methods[$service_postefrancaise]['charge']=387.69;
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					$methods[$service_postefrancaise]['charge']=401.95;
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					$methods[$service_postefrancaise]['charge']=416.21;
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*16.68;//todo : round sup
				$methods[$service_postefrancaise]['charge']=416.21+$TarifSup;
			}
			$methods[$service_postefrancaise]['err_msg']='OK';
		} // Fin de chronopost zone 9
		// RESTE DU MONDE Zone 4
		elseif (in_array($params['Country'],$dest_chronopost_zone_4)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 4';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_4'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=68.71;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=68.71;
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=77.22;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=77.22;
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=85.73;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=85.73;
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=94.24;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=94.24;
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=102.75;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=102.75;
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=111.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=111.26;
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=125.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=125.26;
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=132.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=132.26;
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=139.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=139.26;
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=146.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=146.26;
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=152.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=152.26;
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=158.26;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=158.26;
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					$methods[$service_postefrancaise]['charge']=164.26;
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					$methods[$service_postefrancaise]['charge']=168.26;
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					$methods[$service_postefrancaise]['charge']=172.26;
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					$methods[$service_postefrancaise]['charge']=176.26;
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					$methods[$service_postefrancaise]['charge']=180.26;
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					$methods[$service_postefrancaise]['charge']=184.26;
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					$methods[$service_postefrancaise]['charge']=188.26;
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					$methods[$service_postefrancaise]['charge']=192.26;
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*4.32;//todo : round sup
				$methods[$service_postefrancaise]['charge']=192.26+$TarifSup;
			}
			$methods[$service_postefrancaise]['err_msg']='OK';
		} // Fin de chronopost zone 4
		// RESTE DU MONDE Zone 5
		elseif (in_array($params['Country'],$dest_chronopost_zone_5)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 5';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_5'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=78.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=78.01;
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=88.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=88.01;
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=98.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=98.01;
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=108.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=108.01;
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=118.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=118.01;
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=128.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=128.01;
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=141.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=141.01;
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=145.51;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=145.51;
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=150.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=150.01;
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=154.51;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=154.51;
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=159.01;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=159.01;
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=163.51;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=163.51;
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					$methods[$service_postefrancaise]['charge']=168.01;
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					$methods[$service_postefrancaise]['charge']=172.51;
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					$methods[$service_postefrancaise]['charge']=177.01;
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					$methods[$service_postefrancaise]['charge']=181.51;
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					$methods[$service_postefrancaise]['charge']=186.01;
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					$methods[$service_postefrancaise]['charge']=190.51;
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					$methods[$service_postefrancaise]['charge']=195.01;
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					$methods[$service_postefrancaise]['charge']=199.51;
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*7.80;//todo : round sup
				$methods[$service_postefrancaise]['charge']=199.51+$TarifSup;
			}
			$methods[$service_postefrancaise]['err_msg']='OK';
		} // Fin de chronopost zone 5
		// RESTE DU MONDE Zone 6
		elseif (in_array($params['Country'],$dest_chronopost_zone_6)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 6';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_6'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=87.43;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=87.43;
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=104.82;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=104.82;
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=122.20;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=122.20;
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=139.59;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=139.59;
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=156.98;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=156.98;
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=174.37;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=174.37;
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=195.34;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=195.34;
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=205.81;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=205.81;
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=216.28;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=216.28;
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=226.75;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=226.75;
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=237.45;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=237.45;
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=248.15;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=248.15;
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					$methods[$service_postefrancaise]['charge']=258.85;
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					$methods[$service_postefrancaise]['charge']=269.55;
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					$methods[$service_postefrancaise]['charge']=280.25;
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					$methods[$service_postefrancaise]['charge']=290.95;
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					$methods[$service_postefrancaise]['charge']=301.65;
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					$methods[$service_postefrancaise]['charge']=312.35;
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					$methods[$service_postefrancaise]['charge']=323.05;
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					$methods[$service_postefrancaise]['charge']=333.75;
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*12.72;//todo : round sup
				$methods[$service_postefrancaise]['charge']=333.75+$TarifSup;
			}
			$methods[$service_postefrancaise]['err_msg']='OK';
		} // Fin de chronopost zone 6
				// RESTE DU MONDE Zone 7
		elseif (in_array($params['Country'],$dest_chronopost_zone_7)){
			$methods[$service_postefrancaise]['name']='Chrono Express International Zone 7';
			$methods[$service_postefrancaise]['days']=$this->settings['days_to_zone_7'][$service_postefrancaise];
			if($params['Weight']>=0 && $params['Weight']<=500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['enveloppe_document_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=58.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=92.02;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=92.02;
				}
			}	
			elseif($params['Weight']>500 && $params['Weight']<=1000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=110.37;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=110.37;
				}
			}
			elseif($params['Weight']>1000 && $params['Weight']<=1500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=128.72;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=128.72;
				}
			}
			elseif($params['Weight']>1500 && $params['Weight']<=2000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['pochette_gonflable_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=77.00;
					}
					elseif ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=147.08;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=147.08;
				}
			}
			elseif($params['Weight']>2000 && $params['Weight']<=2500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=165.43;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=165.43;
				}
			}
			elseif($params['Weight']>2500 && $params['Weight']<=3000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=183.79;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=183.79;
				}
			}
			elseif($params['Weight']>3000 && $params['Weight']<=3500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=205.83;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=205.83;
				}
			}
			elseif($params['Weight']>3500 && $params['Weight']<=4000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=216.87;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=216.87;
				}
			}
			elseif($params['Weight']>4000 && $params['Weight']<=4500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=227.91;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=227.91;
				}
			}
			elseif($params['Weight']>4500 && $params['Weight']<=5000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=238.95;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=238.95;
				}
			}
			elseif($params['Weight']>5000 && $params['Weight']<=5500){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=250.22;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=250.22;
				}
			}
			elseif($params['Weight']>5500 && $params['Weight']<=6000){
				if ($wpsc_postefrancaise_settings['tarif_pretaexpedier'][$service_postefrancaise]){
					if ($wpsc_postefrancaise_settings['tarif_pretaexpedier']['boite_om_rdm'][$service_postefrancaise]){	
						$methods[$service_postefrancaise]['charge']=150.00;
					}
					else {
						$methods[$service_postefrancaise]['charge']=261.49;
					}
				}
				else{
					$methods[$service_postefrancaise]['charge']=261.49;
				}
			}
			elseif($params['Weight']>6000 && $params['Weight']<=6500){
					$methods[$service_postefrancaise]['charge']=272.76;
			}
			elseif($params['Weight']>6500 && $params['Weight']<=7000){
					$methods[$service_postefrancaise]['charge']=284.03;
			}
			elseif($params['Weight']>7000 && $params['Weight']<=7500){
					$methods[$service_postefrancaise]['charge']=295.30;
			}
			elseif($params['Weight']>7500 && $params['Weight']<=8000){
					$methods[$service_postefrancaise]['charge']=306.57;
			}
			elseif($params['Weight']>8000 && $params['Weight']<=8500){
					$methods[$service_postefrancaise]['charge']=317.84;
			}
			elseif($params['Weight']>8500 && $params['Weight']<=9000){
					$methods[$service_postefrancaise]['charge']=329.11;
			}
			elseif($params['Weight']>9000 && $params['Weight']<=9500){
					$methods[$service_postefrancaise]['charge']=340.38;
			}
			elseif($params['Weight']>9500 && $params['Weight']<=10000){
					$methods[$service_postefrancaise]['charge']=351.65;
			}						
			else {
				$WeightSup=$params['Weight']-10000;
				$TarifSup=$WeightSup/0.5*13.32;//todo : round sup
				$methods[$service_postefrancaise]['charge']=351.65+$TarifSup;
			}
			$methods[$service_postefrancaise]['err_msg']='OK';
		} // Fin de chronopost zone 7
		else {
			// Reste du monde chronopost pas encore développé
			$methods[$service_postefrancaise]['err_msg']='Chronopost indisponible pour les zones 4 5 6 et 7 pour le moment';
		}

?>
<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class ofoehn extends eqLogic {
    /*     * *************************Attributs****************************** */

    /*     * ***********************Methode static*************************** */

    //Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron() {
		foreach (self::byType('ofoehn') as $ofoehn) {//parcours tous les équipements du plugin ofoehn
			if ($ofoehn->getIsEnable() == 1) {//vérifie que l'équipement est actif
				$cmd = $ofoehn->getCmd(null, 'refresh');//retourne la commande "refresh si elle existe
				if (!is_object($cmd)) {//Si la commande n'existe pas
					continue; //continue la boucle
				}
				$cmd->execCmd(); // la commande existe on la lance
			}
		}
    }
    
	/*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {

      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {

      }
     */



    /*     * *********************Méthodes d'instance************************* */
	
	public function LectureSliderConsigne($valueSlider) {
		log::add('ofoehn', 'debug','Function LectureSliderConsigne : Lancement/Ok' );
		return $valueSlider ;
	}
	
    public function preInsert() {
        
    }

    public function postInsert() {
        
    }

    public function preSave() {
		$this->setDisplay("width","400px");
		$this->setDisplay("height","315px");
    }

    public function postSave() {
		$info = $this->getCmd(null, 'Watter_In');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Entrée Eau', __FILE__));
		}
		$info->setLogicalId('Watter_In');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 40);
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Watter_Ou');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Sortie Eau', __FILE__));
		}
		$info->setLogicalId('Watter_Ou');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 40);
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(2);
		$info->save();
		
		$info = $this->getCmd(null, 'Pump_State');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Etat Pompe', __FILE__));
		}
		$info->setLogicalId('Pump_State');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('binary');
		$info->setIsHistorized(1);
		$info->setOrder(10);
		$info->save();
		
		$info = $this->getCmd(null, 'Mode');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Mode Pompe', __FILE__));
		}
		$info->setLogicalId('Mode');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(11);
		$info->save();
		
		$action = $this->getCmd(null, 'Mode_Hot');
		if (!is_object($action)) {
			$action = new ofoehnCmd();
			$action->setName(__('Chaud', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('Mode_Hot');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(12);
		$action->save();
		
		$action = $this->getCmd(null, 'Mode_Cold');
		if (!is_object($action)) {
			$action = new ofoehnCmd();
			$action->setName(__('Froid', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('Mode_Cold');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(13);
		$action->save();
		
		$action = $this->getCmd(null, 'Mode_Auto');
		if (!is_object($action)) {
			$action = new ofoehnCmd();
			$action->setName(__('Auto.', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('Mode_Auto');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(14);
		$action->save();
		
		$info = $this->getCmd(null, 'Temp_Setpoint');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Temp. Consigne', __FILE__));
		}
		$info->setLogicalId('Temp_Setpoint');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(15);
		$info->save();
		
		$action = $this->getCmd(null, 'Set_Temp_Setpoint');
		if (!is_object($action)) {
			$action = new ofoehnCmd();
			$action->setName(__('Changer Consigne', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('Set_Temp_Setpoint');
		$action->setType('action');
		$action->setSubType('slider');
		$action->setConfiguration('minValue', 16);
		$action->setConfiguration('maxValue', 32);
		$action->setOrder(16);
		$action->save();
		
		$info = $this->getCmd(null, 'Flow');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Débit', __FILE__));
		}
		$info->setLogicalId('Flow');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(17);
		$info->save();
		
		$info = $this->getCmd(null, 'Error');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Erreur', __FILE__));
		}
		$info->setLogicalId('Error');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(18);
		$info->save();
		
		$action = $this->getCmd(null, 'On_Off');
		if (!is_object($action)) {
			$action = new ofoehnCmd();
			$action->setName(__('Marche - Arrêt', __FILE__));
		}
		$action->setEqLogic_id($this->getId());
		$action->setLogicalId('On_Off');
		$action->setType('action');
		$action->setSubType('other');
		$action->setOrder(19);
		$action->save(); 
		
		$info = $this->getCmd(null, 'status');
		if (!is_object($info)) {
			$info = new ofoehnCmd();
			$info->setName(__('Statut', __FILE__));
		}
		$info->setLogicalId('status');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(30);
		$info->save();
		
		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new ofoehnCmd();
			$refresh->setName(__('Rafraîchir', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->setOrder(31);
		$refresh->save();
    }

    public function preUpdate() {
        
    }

    public function postUpdate() {
		$cmd = $this->getCmd(null, 'refresh'); // On recherche la commande refresh de l’équipement
		if (is_object($cmd)) { //elle existe et on lance la commande
			 $cmd->execCmd();
		}
    }

    public function preRemove() {
       
    }

    public function postRemove() {
        
    }
	
	public function getOfoehnData($input) {
		$OFoehn_IP = $this->getConfiguration("IP");
		$OFoehn_Port = $this->getConfiguration("Port");
		$OFoehn_USER = $this->getConfiguration("User");
		$OFoehn_PASSWORD = $this->getConfiguration("Password");
		
		if (strlen($OFoehn_IP) == 0) {
			log::add('ofoehn', 'debug','No IP defined for heat pump interface ...');
			$this->checkAndUpdateCmd('status', 'IP PAC manquante ...');
			return;
		}
		
		if (strlen($OFoehn_USER) == 0) {
			log::add('ofoehn', 'debug','No user defined for heat pump interface ...');
			$this->checkAndUpdateCmd('status', 'Nom utilisateur PAC manquant ...');
			return;
		}
		
		if (strlen($OFoehn_PASSWORD) == 0) {
			log::add('ofoehn', 'debug','No password defined for heat pump interface ...');
			$this->checkAndUpdateCmd('status', 'Mot de passe PAC manquant ...');
			return;
		}
		
		if (strlen($OFoehn_Port) == 0) {
			$OFoehn_Port = 80;
		}
	
		$ch = curl_init();     
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_USERPWD, $OFoehn_USER.":".$OFoehn_PASSWORD);
		
		// STARTING / STOPPING HEAT PUMP
		if ($input == 'OnOff') {
			curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/changeOnOff.cgi');
			curl_exec($ch);
			if (curl_errno($ch)) {
				curl_close ($ch);
				log::add('ofoehn', 'error','Error starting/stopping heat pump: '.curl_error($ch));
				$this->checkAndUpdateCmd('status', 'Erreur On/Off PAC (voir log)');
				return;
			}
			Sleep(2);
		}
		
		// SETTING TEMPERATURE SETPOINT
		if ($input == 'SetTempSetpoint') {
			$cmd = $this->getCmd(null, 'Temp_Setpoint');
			if (is_object($cmd)) {
				$tempsetpoint = $cmd->execCmd();
			}
			log::add('ofoehn', 'info','Setting heat pump temperature set point: '.$tempsetpoint);
			curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/setReg.cgi');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'consigneFroid='.$tempsetpoint.'&consigneChaud='.$tempsetpoint.'&consigneAuto='.$tempsetpoint.'');
			curl_exec($ch);
			if (curl_errno($ch)) {
				curl_close ($ch);
				log::add('ofoehn', 'error','Error setting heat pump temperature set point: '.curl_error($ch));
				$this->checkAndUpdateCmd('status', 'Erreur Consigne PAC (voir log)');
				return;
			}
			return;
		}
		
		// SETTING MODE HOT
		if ($input == 'ModeHot') {
			log::add('ofoehn', 'info','Setting heat pump Mode Hot');
			curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/setReg.cgi');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=CHAUD');
			curl_exec($ch);
			if (curl_errno($ch)) {
				curl_close ($ch);
				log::add('ofoehn', 'error','Error setting heat pump Mode Hot: '.curl_error($ch));
				$this->checkAndUpdateCmd('status', 'Erreur Mode Chaud (voir log)');
				return;
			}
			return;
		}
		
		// SETTING MODE COLD
		if ($input == 'ModeCold') {
			log::add('ofoehn', 'info','Setting heat pump Mode Cold');
			curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/setReg.cgi');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=FROID');
			curl_exec($ch);
			if (curl_errno($ch)) {
				curl_close ($ch);
				log::add('ofoehn', 'error','Error setting heat pump Mode Cold: '.curl_error($ch));
				$this->checkAndUpdateCmd('status', 'Erreur Mode Froid (voir log)');
				return;
			}
			return;
		}
		
		// SETTING MODE AUTO
		if ($input == 'ModeAuto') {
			log::add('ofoehn', 'info','Setting heat pump Mode Auto');
			curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/setReg.cgi');
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'mode=AUTO');
			curl_exec($ch);
			if (curl_errno($ch)) {
				curl_close ($ch);
				log::add('ofoehn', 'error','Error setting heat pump Mode Auto: '.curl_error($ch));
				$this->checkAndUpdateCmd('status', 'Erreur Mode Auto. (voir log)');
				return;
			}
			return;
		}
		
		// COLLECTING VALUES
		
		
		// Home
		curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/accueil.cgi');
		$dataHome = curl_exec($ch);
		if (curl_errno($ch)) {
			curl_close ($ch);
			log::add('ofoehn', 'error','Error getting heat pump main data: '.curl_error($ch));
			$this->checkAndUpdateCmd('status', 'Erreur récup. données (voir log)');
			return;
		}
		
		// Settings
		curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/getReg.cgi');
		$dataSettings = curl_exec($ch);
		if (curl_errno($ch)) {
			curl_close ($ch);
			log::add('ofoehn', 'error','Error getting heat pump settings: '.curl_error($ch));
			$this->checkAndUpdateCmd('status', 'Erreur récup. paramètres (voir log)');
			return;
		}
		
		// Supervision
		curl_setopt($ch, CURLOPT_URL, 'http://'.$OFoehn_IP.':'.$OFoehn_Port.'/super.cgi');
		$dataSupervision = curl_exec($ch);
		if (curl_errno($ch)) {
			curl_close ($ch);
			log::add('ofoehn', 'error','Error getting heat pump values: '.curl_error($ch));
			$this->checkAndUpdateCmd('status', 'Erreur Données (voir log)');
			return;
		}
	
		curl_close ($ch);
		
		$dataHome_array = explode("\n", $dataHome);
		$dataSettings_array = explode("\n", $dataSettings);
		$dataSupervision_array = explode("\n", $dataSupervision);

		$Error = $dataHome_array[7];
		$Flow = $dataHome_array[8];
		$Mode = $dataSettings_array[0];
		$Watter_In = $dataSupervision_array[5];
		$Watter_Ou = $dataSupervision_array[6];
		$Pump_State = $dataSupervision_array[23];
		
		if ($dataSettings == '') {
			$this->checkAndUpdateCmd('Watter_In', 0);
			$this->checkAndUpdateCmd('Watter_Ou', 0);
			$this->checkAndUpdateCmd('Pump_State', 0);
			$this->checkAndUpdateCmd('Mode', '...');
			$this->checkAndUpdateCmd('Temp_Setpoint', 0);
			$this->checkAndUpdateCmd('Error', '...');
			$this->checkAndUpdateCmd('Flow', '...');
								
			$this->checkAndUpdateCmd('status', 'Hors Ligne ...');
			log::add('ofoehn', 'debug','Heat pump is off-line ...');
			return;
		} else {
			curl_close ($ch);
			$this->checkAndUpdateCmd('Watter_In', $Watter_In);
			$this->checkAndUpdateCmd('Watter_Ou', $Watter_Ou);
			if ($Pump_State == 'ON') {
				$this->checkAndUpdateCmd('Pump_State', 1);
			} else {
				$this->checkAndUpdateCmd('Pump_State', 0);
			}
			$this->checkAndUpdateCmd('Mode', $Mode);
			switch ($Mode) {		
			case 'Froid':
				$this->checkAndUpdateCmd('Temp_Setpoint', $dataSettings_array[1]);
				break;
			
			case 'Chaud':
				$this->checkAndUpdateCmd('Temp_Setpoint', $dataSettings_array[2]);
				break;
			
			case 'Auto':
				$this->checkAndUpdateCmd('Temp_Setpoint', $dataSettings_array[3]);
				break;
			}
			$this->checkAndUpdateCmd('Error', $Error);
			$this->checkAndUpdateCmd('Flow', $Flow);
			
			$this->checkAndUpdateCmd('status', 'OK');
			log::add('ofoehn', 'debug','All good: Data='.$data);
			return;
		}	
	}
	
    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class ofoehnCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

    public function execute($_options = array()) {
		$eqlogic = $this->getEqLogic();
		switch ($this->getLogicalId()) {		
			case 'refresh':
				$info = $eqlogic->getOfoehnData('');
				break;
			
			case 'On_Off':
				$info = $eqlogic->getOfoehnData('OnOff');
				break;
				
			case 'Set_Temp_Setpoint':
				$info = $eqlogic->LectureSliderConsigne($_options['slider']);
				$eqlogic->checkAndUpdateCmd('Temp_Setpoint', $info.'.0'); 
				$info = $eqlogic->getOfoehnData('SetTempSetpoint');
				break;
				
			case 'Mode_Hot':
				$eqlogic->checkAndUpdateCmd('Mode', 'Chaud');
				$info = $eqlogic->getOfoehnData('ModeHot');
				break;
				
			case 'Mode_Cold':
				$eqlogic->checkAndUpdateCmd('Mode', 'Froid');
				$info = $eqlogic->getOfoehnData('ModeCold');
				break;
				
			case 'Mode_Auto':
				$eqlogic->checkAndUpdateCmd('Mode', 'Auto');
				$info = $eqlogic->getOfoehnData('ModeAuto');
				break;
					
		}
    }
    /*     * **********************Getteur Setteur*************************** */
}

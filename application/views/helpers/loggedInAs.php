<?php
class Application_View_Helper_loggedInAs extends Zend_View_Helper_Abstract
{
	public function loggedInAs()
	{
		// De la vista debe de enviar con una acci'on para poderle darle informaci'on 
		//para ello se debe de crear m'as funciones en este helper para no estar creando muchos
		
		if (Application_Model_User::isLoggedIn()) {
            $this->view->loggedIn   = true;
            $user = Application_Model_User::getIdentity();
            return $user;
        }
        
	}
}

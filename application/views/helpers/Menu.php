<?php
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco, @hechalco
 *facebook: heraudchalco, hechalco
 */
 class Application_View_Helper_Menu extends Zend_View_Helper_Abstract
 {
 	
 	function Menu()
 	{
 		// return "Hola mundo cruel";
 		$modelMenu = new Application_Model_modelLink();
 		return $modelMenu->getAll();
 	}
 }
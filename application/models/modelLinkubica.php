<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelLinkubica extends Zend_Db_Table_Abstract
 {
	protected $_name = 'linkubica';
	protected $_primary = 'idlinkubica';
	
	public function getAll()
	{
        return $this->fetchAll();
	}	
}
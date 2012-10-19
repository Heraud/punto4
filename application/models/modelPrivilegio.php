<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelPrivilegio extends Zend_Db_Table_Abstract
 {
	protected $_name = 'privilegio';
	protected $_primary = 'idprivilegio';
	
	public function getAll()
	{
			$query = $this->select()
	                ->from(array( 'pri'=>'privilegio'), array('idprivilegio','pri_nombre','pri_estado'))                                
	                ->where('(pri_estado = "Activo" OR pri_estado = "Suspendido")
	                ') 
	                ->order('idprivilegio ASC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}	
	public function save( $bind, $id = null )
	{
	    if( is_null( $id )){
	        $row = $this->createRow();
	    }else{
	        $row = $this->getRow( $id );
	    }
		$row->setFromArray( $bind );
		return $row->save();
	}
	
	public function getRow( $id )
	{	
	    $id = (int) $id;
	    $row = $this->find( $id )->current();
	    return $row;
	}
}
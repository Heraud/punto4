<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelLink extends Zend_Db_Table_Abstract
 {
	protected $_name = 'link';
	protected $_primary = 'idlink';
	
	public function getAll()
	{
			$query = $this->select()
	                ->from(array( 'li'=>'link'), array('*'))
					->join(array('lu'=>'linkubica'),'lu.idlinkubica=li.idlinkubica',array('lu_nombre'))	                                
	                ->where('(li_estado = "Activo" OR li_estado = "Suspendido")
	                ') 
	                ->order('idlink DESC')
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
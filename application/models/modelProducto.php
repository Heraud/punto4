<?php
class Application_Model_modelProducto extends Zend_Db_Table_Abstract
{
	protected $_name = 'producto';
	protected $_primary = 'idproducto';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'pro'=>'producto'), array('*'))
	                ->order('idproducto DESC'); 
	                
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'pro'=>'producto'), array('*'))
	                ->where('(pro.pro_nombre like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idproducto DESC'); 

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

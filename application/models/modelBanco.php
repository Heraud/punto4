<?php
class Application_Model_modelBanco extends Zend_Db_Table_Abstract
{
	protected $_name = 'banco';
	protected $_primary = 'idbanco';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'ba'=>'banco'), array('idbanco','ba_nombre','ba_direc','ba_estado'))
	                ->where('ba_estado = "Activo"')
	                ->order('idbanco DESC'); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'ba'=>'banco'), array('idbanco','ba_nombre','ba_direc','ba_estado'))
	                ->where('ba_estado = "Activo" AND ba.ba_nombre like "%'.$txtbuscar.'%"')
	                ->order('idbanco DESC'); 

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

<?php
class Application_Model_modelBoleta extends Zend_Db_Table_Abstract
{
	protected $_name = 'boleta';
	protected $_primary = 'idboleta';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'bo'=>'boleta'), array('*'))
	                ->where('(bo_estado = "Activo")
	                ')
	                ->order('idboleta DESC'); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'bo'=>'boleta'), array('*'))
	                ->where('(bo_estado = "Activo")
	                	AND(bo.bo_nro like "%'.$txtbuscar.'%" 
	                	OR bo.bo_emisor like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idboleta DESC')
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
	public function getVeryBoleta($bo_nro=null){
		$query= $this->select()
				->from(array('bo'=>'boleta'),array('bo_nro'))
				->where("(bo_estado = 'Activo') AND bo_nro = '$bo_nro'");
				return $this->fetchAll($query);
	}
}

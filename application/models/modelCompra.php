<?php
class Application_Model_modelCompra extends Zend_Db_Table_Abstract
{
	protected $_name = 'compra';
	protected $_primary = 'idcompra';
	
	public function getAll()
	{

			$query = $this->select()
	                ->from( array( 'co'=>'compra'), array('idcompra','co_nrofact','co_fech','co_importe','co_encargado','co_estado','idproveedor','idpersonal'))
	                ->join(array( 'pro' =>'proveedor'), 'co.idproveedor = pro.idproveedor', array('pro_nombre'))
	                ->join(array( 'per' =>'personal'), 'co.idpersonal = per.idpersonal', array('per_nombre'))
	                ->where('(co_estado = "Activo" OR co_estado = "Suspendido") 
	                	AND (pro_estado = "Activo" OR pro_estado = "Suspendido") 
	                	AND (per_estado = "Activo" OR per_estado = "Suspendido")
	                ')
	                ->order('idcompra DESC')
	                ->setIntegrityCheck(false); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'co'=>'compra'), array('idcompra','co_nrofact','co_fech','co_importe','co_encargado','co_estado','idproveedor','idpersonal'))
	                ->join(array( 'pro' =>'proveedor'), 'co.idproveedor = pro.idproveedor', array('pro_nombre'))
	                ->join(array( 'per' =>'personal'), 'co.idpersonal = per.idpersonal', array('per_nombre'))
	                ->where('(co_estado = "Activo" OR co_estado = "Suspendido") 
	                	AND (pro_estado = "Activo" OR pro_estado = "Suspendido") 
	                	AND (per_estado = "Activo" OR per_estado = "Suspendido")
	                	AND(co.idcompra like "%'.$txtbuscar.'%" 
	                	OR co.co_nrofact like "%'.$txtbuscar.'%" 
	                	OR pro.pro_nombre like "%'.$txtbuscar.'%"
	                	OR per.per_nombre like "%'.$txtbuscar.'%")
	                ')
	                ->order('idcompra DESC')
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
	public function getRowCustom( $id )
	{	
		$query = $this->select()
                ->from( array( 'co'=>'compra'), array('idcompra','co_nrofact','co_fech','co_importe','co_encargado','co_estado','idproveedor','idpersonal'))
                ->join(array( 'pro' =>'proveedor'), 'co.idproveedor = pro.idproveedor', array('pro_nombre'))
                ->join(array( 'per' =>'personal'), 'co.idpersonal = per.idpersonal', array('per_nombre'))
                ->where('(co_estado = "Activo" OR co_estado = "Suspendido") 
                	AND (pro_estado = "Activo" OR pro_estado = "Suspendido") 
                	AND (per_estado = "Activo" OR per_estado = "Suspendido") AND idcompra = '.$id.'
                ')
                ->order('idcompra DESC')
                ->setIntegrityCheck(false); 
        return $this->fetchAll( $query );
	}
}

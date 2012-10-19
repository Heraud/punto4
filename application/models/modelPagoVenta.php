<?php
class Application_Model_modelPagoVenta extends Zend_Db_Table_Abstract
{
	protected $_name = 'pago_venta';
	protected $_primary = 'idpago_venta';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'pv'=>'pago_venta'), array('idpago_venta','idventa','pv_fech','pv_sigfech','pv_monto_pagado','pv_monto_saldo','pv_estado'))
	                ->group('pv.idpago_venta, pv.idventa')
	                ->order('idpago_venta DESC'); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'pv'=>'pago_venta'), array('idpago_venta','idventa','pv_fech','pv_sigfech','pv_monto_pagado','pv_monto_saldo','pv_estado'))
	                ->where('(pv.idventa like "%'.$txtbuscar.'%") 
	                ')
	                ->group('pv.idpago_venta, pv.idventa') 
	                ->order('idpago_venta DESC'); 

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

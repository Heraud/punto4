<?php
class Application_Model_modelVenta extends Zend_Db_Table_Abstract
{
	protected $_name = 'venta';
	protected $_primary = 'idventa';
	
	public function getAll($tipocomprobante){

		if ($tipocomprobante=='factura') {
			$query = $this->select()
	                ->from( array( 've'=>'venta'), array('idventa','ve_fech','ve_tipo','ve_nrocuota','ve_importe','ve_estado','idcliente','idpersonal','idfactura'))
	                ->join(array( 'cl' =>'cleinte'), 'cl.idcliente=ve.idcliente', array('cl_nombre'))
	                ->join(array( 'per' =>'personal'), 'per.idpersonal=ve.idpersonal', array('per_nombre'))
	                ->join(array( 'fa' =>'factura'), 'fa.idfactura=ve.idfactura', array('fa_nro'))
	                ->order('idventa DESC')
	                ->setIntegrityCheck(false); 			
		} if($tipocomprobante=='boleta') {
			$query = $this->select()
	                ->from( array( 've'=>'venta'), array('idventa','ve_fech','ve_tipo','ve_nrocuota','ve_importe','ve_estado','idcliente','idpersonal','idboleta'))
	                ->join(array( 'cl' =>'cleinte'), 'cl.idcliente=ve.idcliente', array('cl_nombre'))
	                ->join(array( 'per' =>'personal'), 'per.idpersonal=ve.idpersonal', array('per_nombre'))
	                ->join(array( 'bo' =>'boleta'), 'bo.idboleta=ve.idboleta', array('bo_nro'))
	                ->order('idventa DESC')
	                ->setIntegrityCheck(false); 
		}
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar,$tipocomprobante){

		if ($tipocomprobante=='factura') {
			$query = $this->select()
	                ->from( array( 've'=>'venta'), array('idventa','ve_fech','ve_tipo','ve_nrocuota','ve_importe','ve_estado','idcliente','idpersonal','idfactura'))
	                ->join(array( 'cl' =>'cleinte'), 'cl.idcliente=ve.idcliente', array('cl_nombre'))
	                ->join(array( 'per' =>'personal'), 'per.idpersonal=ve.idpersonal', array('per_nombre'))
	                ->join(array( 'fa' =>'factura'), 'fa.idfactura=ve.idfactura', array('fa_nro'))
	                ->where('(ve.ve_tipo like "%'.$txtbuscar.'%" 
	                	OR cl.cl_nombre like "%'.$txtbuscar.'%"
	                	OR per.per_nombre like "%'.$txtbuscar.'%"
	                	OR fa.fa_nro like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idventa DESC')
	                ->setIntegrityCheck(false); 			
		} if($tipocomprobante=='boleta') {
	                ->from( array( 've'=>'venta'), array('idventa','ve_fech','ve_tipo','ve_nrocuota','ve_importe','ve_estado','idcliente','idpersonal','idboleta'))
	                ->join(array( 'cl' =>'cleinte'), 'cl.idcliente=ve.idcliente', array('cl_nombre'))
	                ->join(array( 'per' =>'personal'), 'per.idpersonal=ve.idpersonal', array('per_nombre'))
	                ->join(array( 'bo' =>'boleta'), 'bo.idboleta=ve.idboleta', array('bo_nro'))
	                ->where('(ve.ve_tipo like "%'.$txtbuscar.'%" 
	                	OR cl.cl_nombre like "%'.$txtbuscar.'%"
	                	OR per.per_nombre like "%'.$txtbuscar.'%"
	                	OR bo.bo_nro like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idventa DESC')
	                ->setIntegrityCheck(false); 
		}

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

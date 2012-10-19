<?php
class Application_Model_modelPagoBanco extends Zend_Db_Table_Abstract
{
	protected $_name = 'pago_banco';
	protected $_primary = 'idpago_banco';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'pb'=>'pago_banco'), array('idpago_banco','pb_fech','pb_sigfech','pb_monto','pb_monto','pb_saldo','pb_estado','idprestamo'))
	                ->join(array('pre'=>'prestamo'),'pre.idprestamo = pb.idprestamo')
	                ->join(array('ba'=>'banco'),'ba.idbanco = pre.idbanco')
	                ->order('idpago_banco DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'pb'=>'pago_banco'), array('idpago_banco','pb_fech','pb_sigfech','pb_monto','pb_monto','pb_saldo','pb_estado','idprestamo'))
	                ->join(array('pre'=>'prestamo'),'pre.idprestamo = pb.idprestamo')
	                ->join(array('ba'=>'banco'),'ba.idbanco = pre.idbanco')
	                ->where('ba.ba_nombre like "%'.$txtbuscar.'%"')
	                ->order('idpago_banco DESC')
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

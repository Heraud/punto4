<?php
class Application_Model_modelFactura extends Zend_Db_Table_Abstract
{
	protected $_name = 'factura';
	protected $_primary = 'idfactura';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'fa'=>'factura'), array('idfactura','fa_nro','fa_fech','fa_subtotal','fa_total','fa_emisor','fa_estado','idigv'))
	                ->join(array( 'ig' =>'igv'), 'ig.idigv=fa.idigv', array('ig_tasa'))
	                ->where('(fa_estado = "Activo")
	                ')
	                ->order('idfactura DESC')
	                ->setIntegrityCheck(false); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'fa'=>'factura'), array('*'))
	                ->join(array( 'ig' =>'igv'), 'ig.idigv=fa.idigv', array('ig_tasa'))
	                ->where('(fa_estado = "Activo")
	                	 AND(fa.fa_nro like "%'.$txtbuscar.'%"
	                	OR fa.fa_emisor like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idfactura DESC')
	                ->setIntegrityCheck(false); 

	        return $this->fetchAll( $query );
	}
	public function getVeryFactura($fa_nro=null){
		$query= $this->select()
				->from(array('fa'=>'factura'),array('fa_nro'))
				->where("(fa_estado = 'Activo') AND fa_nro = '$fa_nro'");
				return $this->fetchAll($query);
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

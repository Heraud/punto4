<?php
class Application_Model_modelIgv extends Zend_Db_Table_Abstract
{
	protected $_name = 'igv';
	protected $_primary = 'idigv';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'ig'=>'igv'), array('*'))
	                ->where('(ig_estado = "Activo" OR ig_estado = "Suspendido")
	                ')
	                ->order('idigv ASC'); 
        return $this->fetchAll( $query );
	}
	public function getKeyName(){
		$query = $this->select()
				->from(array('igv'))
				->where('ig_estado = "Activo" OR ig_estado = "Suspendido"')
				->order('idigv ASC');
		return $this->fetchAll($query);
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'ig'=>'igv'), array('*'))
	                ->where('(ig_estado = "Activo" OR ig_estado = "Suspendido")
	                	AND(ig.ig.ig_tasa like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idigv ASC')
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
	public function getVeryIGV($ig_tasa=null){
		$query= $this->select()
				->from(array('ig'=>'igv'),array('ig_tasa'))
				->where("(ig_estado = 'Activo' OR ig_estado = 'Suspendido') AND ig_tasa = '$ig_tasa'");

				return $this->fetchAll($query);
	}
}

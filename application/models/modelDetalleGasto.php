<?php
class Application_Model_modelDetalleGasto extends Zend_Db_Table_Abstract
{
	protected $_name = 'detalle_gasto';
	protected $_primary = 'iddetalle_gasto';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'dg'=>'detalle_gasto'), array('iddetalle_gasto','dg_canti','dg_punitario','dg_ptotal','dg_estado','idgasto'))
	                ->join(array('ga'=>'gasto'),'ga.idgasto = dg.idgasto',array('ga_nrofact', 'ga_descrip'))
	                ->order('iddetalle_gasto DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'dg'=>'detalle_gasto'), array('iddetalle_gasto','dg_canti','dg_punitario','dg_ptotal','dg_estado','idgasto'))
	                ->join(array('ga'=>'gasto'),'ga.idgasto = dg.idgasto',array('ga_nrofact', 'ga_descrip'))
	                ->where('ga.ga_nrofact like "%'.$txtbuscar.'%" OR ga.ga_descrip like "%'.$txtbuscar.'%"')
	                ->order('iddetalle_gasto DESC')
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

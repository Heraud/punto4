<?php
class Application_Model_modelGasto extends Zend_Db_Table_Abstract
{
	protected $_name = 'gasto';
	protected $_primary = 'idgasto';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'ga'=>'gasto'), array('idgasto','ga_nrofact','ga_descrip','ga_fecha','ga_importe','ga_estado','idcategoria_gasto'))
	                ->join(array('cg'=>'categoria_gasto'),'cg.idcategoria_gasto = ga.idcategoria_gasto','cg_nombre')
	                ->order('idgasto DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'ga'=>'gasto'), array('idgasto','ga_nrofact','ga_descrip','ga_fecha','ga_importe','ga_estado','idcategoria_gasto'))
	                ->join(array('cg'=>'categoria_gasto'),'cg.idcategoria_gasto = ga.idcategoria_gasto','cg_nombre')
	                ->where('cg.cg_nombre like "%'.$txtbuscar.'%" OR ga.ga_descrip like "%'.$txtbuscar.'%"')
	                ->order('idgasto DESC')
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

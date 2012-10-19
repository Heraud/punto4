<?php
class Application_Model_modelDetalleCompra extends Zend_Db_Table_Abstract
{
	protected $_name = 'detalle_compra';
	protected $_primary = 'iddetalle_compra';
	
	public function getAll()
	{

			$query = $this->select()
	                ->from( array( 'dc'=>'detalle_compra'), array('iddetalle_compra','dc_canti','dc_punitario','dc_ptotal','dc_estado','idcompra','idrecurso'))
	                ->join(array( 're' =>'recurso'), 're.idrecurso = dc.idrecurso', array('re_nombre'))
	                ->join(array( 'co' =>'compra'), 'co.idcompra = dc.idcompra', array('co_nrofact'))
	                ->order('iddetalle_compra DESC')
	                ->setIntegrityCheck(false); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'dc'=>'detalle_compra'), array('iddetalle_compra','dc_canti','dc_punitario','dc_ptotal','dc_estado','idcompra','idrecurso'))
	                ->join(array( 're' =>'recurso'), 're.idrecurso = dc.idrecurso', array('re_nombre'))
	                ->join(array( 'co' =>'compra'), 'co.idcompra = dc.idcompra', array('co_nrofact'))
	                ->where('(re.re_nombre like "%'.$txtbuscar.'%" 
	                	OR co.co_nrofact like "%'.$txtbuscar.'%") 
	                ')
	                ->order('iddetalle_compra DESC')
	                ->setIntegrityCheck(false); 

	        return $this->fetchAll( $query );
	}
	public function getDetailsShopping($idcompra=null){
		$query =  $this->select()
					->from(array("dc"=>"detalle_compra"),array('iddetalle_compra','dc_canti','dc_punitario','dc_ptotal','idcompra','idrecurso'))
					->join(array('re'=>'recurso'),'re.idrecurso = dc.idrecurso',array('re_nombre'))
					->join(array('co'=>'compra'),'co.idcompra = dc.idcompra',array('co_nrofact'))
					->where('dc.idcompra = "'.$idcompra.'"')
					->order('iddetalle_compra ASC')
					->setIntegrityCheck(false);

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

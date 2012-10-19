<?php
class Application_Model_modelDetalleVenta extends Zend_Db_Table_Abstract
{
	protected $_name = 'detalle_venta';
	protected $_primary = 'iddetalle_venta';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'dv'=>'detalle_venta'), array('iddetalle_venta','dv_canti','dv_punitario','dv_total','dv_estado','idrecurso','idventa','idproducto'))
	                ->join(array('ve'=>'venta'),'ve.idventa = dv.idventa')
	                ->join(array('re'=>'recurso'),'re.idrecurso = dv.idrecurso',array('re_nombre'))
	                ->join(array('pro'=>'producto'),'pro.idproducto = dv.idproducto',array('pro_nombre'))
	                ->order('iddetalle_venta DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'dv'=>'detalle_venta'), array('iddetalle_venta','dv_canti','dv_punitario','dv_total','dv_estado','idrecurso','idventa','idproducto'))
	                ->join(array('ve'=>'venta'),'ve.idventa = dv.idventa')
	                ->join(array('re'=>'recurso'),'re.idrecurso = dv.idrecurso',array('re_nombre'))
	                ->join(array('pro'=>'producto'),'pro.idproducto = dv.idproducto',array('pro_nombre'))
	                ->where('(pro.pro_nombre like "%'.$txtbuscar.'%") 
	                ') 
	                ->order('iddetalle_venta DESC')
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

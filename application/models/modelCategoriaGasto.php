<?php
class Application_Model_modelCategoriaGasto extends Zend_Db_Table_Abstract
{
	protected $_name = 'categoria_gasto';
	protected $_primary = 'idcategoria_gasto';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'cg'=>'categoria_gasto'), array('*'))
	                ->where('cg.cg_estado = "Activo"')
	                ->order('idcategoria_gasto DESC'); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'cg'=>'categoria_gasto'), array('*'))
	                ->where('cg.cg_estado = "Activo" AND cg_nombre like "%'.$txtbuscar.'%" 
	                ')
	                ->order('idcategoria_gasto DESC'); 

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

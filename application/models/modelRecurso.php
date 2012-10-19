<?php
class Application_Model_modelRecurso extends Zend_Db_Table_Abstract
{
	protected $_name = 'recurso';
	protected $_primary = 'idrecurso';
	
	public function getAll()
	{

			$query = $this->select()
	                ->from( array( 're'=>'recurso'), array('*'))
	                ->where('(re_estado = "Activo" OR re_estado = "Suspendido")
	                ')
	                ->order('idrecurso DESC'); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){
			$query = $this->select()
	                ->from( array( 're'=>'recurso'), array('*'))
	                ->where('(re_estado = "Activo" OR re_estado = "Suspendido")
	                	AND(re.idrecurso like "%'.$txtbuscar.'%" 
	                	OR re.re_nombre like "%'.$txtbuscar.'%" 
	                	OR re.re_sku like "%'.$txtbuscar.'%" 
	                	OR re.re_marca like "%'.$txtbuscar.'%"
	                	OR re.re_presenta like "%'.$txtbuscar.'%"
	                	OR re.re_umedida like "%'.$txtbuscar.'%")
	                ')
	                ->order('idrecurso DESC'); 

	        return $this->fetchAll( $query );
	}
	public function getVerificarRecursoNombre($re_nombre){
		$query= $this->select()
				->from(array('re'=>'recurso'),array('re_nombre'))
				->where("(re_estado = 'Activo' OR re_estado = 'Suspendido') AND re_nombre = '$re_nombre'");
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
	
	public function getRow( $id )	{	
	    $id = (int) $id;
	    $row = $this->find( $id )->current();
	    return $row;
	}
}

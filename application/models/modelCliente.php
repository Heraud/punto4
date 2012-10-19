<?php
class Application_Model_modelCliente extends Zend_Db_Table_Abstract
{
	protected $_name = 'cliente';
	protected $_primary = 'idcliente';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'cl'=>'cliente'), array('*'))
	                ->where('(cl_estado = "Activo" OR cl_estado = "Suspendido")
	                ')
	                ->order('idcliente DESC'); 
        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'cl'=>'cliente'), array('*'))
	                ->where('(cl_estado = "Activo" OR cl_estado = "Suspendido") 
	                	AND(cl.cl_docu like "%'.$txtbuscar.'%" 
	                	OR cl.cl_nombre like "%'.$txtbuscar.'%"
	                	OR cl.cl_direc like "%'.$txtbuscar.'%"
	                	OR cl.cl_telf like "%'.$txtbuscar.'%"
	                	OR cl.cl_email like "%'.$txtbuscar.'%") 
	                ')
	                ->order('idcliente DESC')
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

<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelPersonal extends Zend_Db_Table_Abstract
 {
	protected $_name = 'personal';
	protected $_primary = 'idpersonal';
	
	public function getAll()
	{
			$query = $this->select()
	                ->from(array( 'per'=>'personal'), array('idpersonal','per_docu','per_nombre','per_fechregistro','per_email','per_telf','per_direc','per_estado','idsucursal'))
					->join(array('su'=>'sucursal'),'su.idsucursal=per.idsucursal',array('su_nombre','su_estado'))	                
	                ->where('(per_estado = "Activo" OR per_estado = "Suspendido") AND (su_estado = "Activo" OR su_estado = "Suspendido")')
	                ->order('idpersonal DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from(array( 'per'=>'personal'), array('idpersonal','per_docu','per_nombre','per_fechregistro','per_email','per_telf','per_direc','per_estado','idsucursal'))
					->join(array('su'=>'sucursal'),'su.idsucursal=per.idsucursal',array('su_nombre','su_estado'))	                
	                ->where('(per_estado = "Activo" OR per_estado = "Suspendido") AND (su_estado = "Activo" OR su_estado = "Suspendido")
	                	AND(per.per_nombre like "%'.$txtbuscar.'%" 
	                	OR per.per_docu like "%'.$txtbuscar.'%"
	                	OR su.su_nombre like "%'.$txtbuscar.'%")
	                ')
	                ->order('idpersonal DESC')
	                ->setIntegrityCheck(false);
	        return $this->fetchAll( $query );
	}
	public function getKeyName(){
		$query = $this->select()
				->from(array('pe'=>'personal'),array('idpersonal','per_nombre'))
				->where('per_estado = "Activo"')
				->order('idpersonal ASC');
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
	public function getVeryDocPersonal($per_docu=null){
		$query= $this->select()
				->from(array('per'=>'personal'),array('per_docu'))
				->where("(per_estado = 'Activo' OR per_estado = 'Suspendido') AND per_docu = '$per_docu'");

				return $this->fetchAll($query);
	}
}
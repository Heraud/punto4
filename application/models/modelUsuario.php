<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelUsuario extends Zend_Db_Table_Abstract
 {
	protected $_name = 'usuario';
	protected $_primary = 'idusuario';
	
	public function getAll()
	{
			$query = $this->select()
	                ->from(array( 'us'=>'usuario'), array('idusuario','us_user','us_pass','us_fech','us_estado','idprivilegio','idpersonal'))
					->join(array('per'=>'personal'),'per.idpersonal=us.idpersonal',array('per_nombre'))	                
					->join(array('pri'=>'privilegio'),'pri.idprivilegio=us.idprivilegio',array('pri_nombre'))	                
	                ->where('(us_estado = "Activo" OR us_estado = "Suspendido") AND (pri_estado = "Activo" OR pri_estado = "Suspendido")
	                ') 
	                ->order('idusuario DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from(array( 'us'=>'usuario'), array('idusuario','us_user','us_pass','us_fech','us_estado','idprivilegio','idpersonal'))
					->join(array('per'=>'personal'),'per.idpersonal=us.idpersonal',array('per_nombre'))
					->join(array('pri'=>'privilegio'),'pri.idprivilegio=us.idprivilegio',array('pri_nombre'))	                
	                ->where('(us_estado = "Activo" OR us_estado = "Suspendido") AND (pri_estado = "Activo" OR pri_estado = "Suspendido")
	                	AND(us.us_user like "%'.$txtbuscar.'%" 
	                	OR us.us_privile like "%'.$txtbuscar.'%" 
	                	OR per.per_nombre like "%'.$txtbuscar.'%" 
	                	OR su.su_nombre like "%'.$txtbuscar.'%")
	                ')
	                ->order('idusuario DESC')
	                ->setIntegrityCheck(false);

	        return $this->fetchAll( $query );
	}
	public function getKeyName(){
		$query = $this->select()
				->from(array('us'=>'usuario'),array('idusuario','us_user'))
				->where('us_estado = "Activo" OR us_estado = "Suspendido"')
				->order('idusuario ASC');
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
	public function getVeryUserBD($us_user=null){
		$query= $this->select()
				->from(array('us'=>'usuario'),array('us_user'))
				->where("(us_estado = 'Activo' OR us_estado = 'Suspendido') AND us_user = '$us_user'");
				return $this->fetchAll($query);
	}	
	
	public function getRow( $id )
	{	
	    $id = (int) $id;
	    $row = $this->find( $id )->current();
	    return $row;
	}
}
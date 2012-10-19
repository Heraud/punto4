<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
 class Application_Model_modelSucursal extends Zend_Db_Table_Abstract
 {
	protected $_name = 'sucursal';
	protected $_primary = 'idsucursal';
	
	public function getAll()
	{
			$query = $this->select()
	                ->from(array( 'su'=>'sucursal'), array('idsucursal','su_nombre','su_direc','su_estado'))
	                ->where('su_estado = "Activo" OR su_estado = "Suspendido"') 
	                ->order('idsucursal DESC'); 
        return $this->fetchAll( $query );
	}
	public function getKeyName(){
		$query = $this->select()
				->from(array('su'=>'sucursal'),array('idsucursal','su_nombre'))
				->where('su_estado = "Activo"')
				->order('idsucursal ASC');
				return $this->fetchAll($query);
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from(array( 'su'=>'sucursal'), array('idsucursal','su_nombre','su_direc','su_estado'))
	                ->where('(su_estado = "Activo" OR su_estado = "Suspendido")
	                	AND(su.idsucursal like "%'.$txtbuscar.'%" 
	                	OR su.su_nombre like "%'.$txtbuscar.'%")')
	                ->order('idcompra DESC');

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
<?php 
 /**
 * Author: Heraud Chalco h.
 *Email: hesleither@gmail.com
 *twitter: @heraudchalco
 *facebook: heraudchalco
 */
class Application_Model_modelProveedor extends Zend_Db_Table_Abstract
{
	protected $_name = 'proveedor';
	protected $_primary = 'idproveedor';
	
	public function getAll()
	{
		$query = $this->select()
                ->from( array( 'pro'=>'proveedor' ), array('idproveedor','pro_docu', 'pro_nombre', 'pro_ciudad', 'pro_direc', 'pro_telf', 'pro_email', 'pro_fechingre','pro_estado'))
                ->where('pro_estado = "Activo" OR pro_estado = "Suspendido"')
                ->order('idproveedor DESC');        
        
        return $this->fetchAll( $query );
	}
	public function getKeyName()
	{
		$query = $this->select()
                ->from( array( 'pro'=>'proveedor' ), array('idproveedor','pro_nombre'))
                ->where('pro_estado = "Activo"')
                ->order('idproveedor DESC');        
        
        return $this->fetchAll( $query );
	}
	
	public function getSearch($txtbuscar)
	{
		$query = $this->select()
                ->from( array( 'pro'=>'proveedor' ), array('idproveedor','pro_docu', 'pro_nombre', 'pro_ciudad', 'pro_direc', 'pro_telf', 'pro_email', 'pro_fechingre','pro_estado'))
                ->where('(pro_estado = "Activo" OR pro_estado = "Suspendido")
                		AND(pro.pro_docu like "%'.$txtbuscar.'%" 
                			OR pro.pro_nombre like "%'.$txtbuscar.'%" 
                			OR pro.pro_direc like "%'.$txtbuscar.'%")
                ')
                ->order('idproveedor DESC');        
        
        return $this->fetchAll( $query );
	}
	public function getVeryProveedor($pro_docu=null){
		$query= $this->select()
				->from(array('pro'=>'proveedor'),array('pro_docu'))
				->where("(pro_estado = 'Activo' OR pro_estado = 'Suspendido') AND pro_docu = '$pro_docu'");
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

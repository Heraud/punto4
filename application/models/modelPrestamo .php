<?php
class Application_Model_modelPrestamo extends Zend_Db_Table_Abstract
{
	protected $_name = 'prestamo';
	protected $_primary = 'idprestamo';
	
	public function getAll(){

			$query = $this->select()
	                ->from( array( 'pre'=>'prestamo'), array('idprestamo','pre_fech','pre_monto','pre_cuota','pre_nrocuota','pre_estado','idbanco'))
	                ->join(array('ba'=>'banco'),'ba.idbanco = pre.idbanco',array('ba_nombre'))
	                ->order('idprestamo DESC')
	                ->setIntegrityCheck(false); 

        return $this->fetchAll( $query );
	}
	public function getSearch($txtbuscar){

			$query = $this->select()
	                ->from( array( 'pre'=>'prestamo'), array('idprestamo','pre_fech','pre_monto','pre_cuota','pre_nrocuota','pre_estado','idbanco'))
	                ->join(array('ba'=>'banco'),'ba.idbanco = pre.idbanco',array('ba_nombre'))
	                ->where('ba.ba_nombre like "%'.$txtbuscar.'%"')
	                ->order('idprestamo DESC')
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

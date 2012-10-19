<?php
class ProveedorController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $ProveedorModel = new Application_Model_modelProveedor();        
        $DatoProveedor = $ProveedorModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoProveedor);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmProveedor();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelProveedor();
                $id = $model->save($form->getValues());


                // Recuperando la fecha de mysql, ya que el del php tiene problemas después del medio día.
                $db=Zend_Db_Table_Abstract::getDefaultAdapter();
                $result = $db->fetchAll("SELECT CURDATE() as date");
                foreach ($result as $key) {
                    $date = $key['date'];
                }
                $Data = array('pro_fechingre'=>$date);
                $where = $model->getAdapter()->quoteInto('idproveedor=?',(int)$id);
                $model->update($Data,$where);  


                return $this->_redirect('/proveedor/list/');
            }
        }
        $this->view->form = $form;
    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/proveedor/list");
        }

        $frmProveedor = new Application_Form_frmProveedor();
        $mdProveedor = new Application_Model_modelProveedor();

        if ($this->getRequest()->isPost()) {

            if ($frmProveedor->isValid($this->_getAllParams())) {
                $mdProveedor->save($frmProveedor->getValues(),$this->_getParam('id'));
                return $this->_redirect('/proveedor/list/');
            }
        } else {
            $row = $mdProveedor->getRow($this->_getParam('id'));
            if ($row) 
            {
                $frmProveedor->populate($row->toArray());
            }
        }
        $this->view->id=$this->_getParam('id');
        $this->view->form = $frmProveedor;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/proveedor/list');
        }

        $mdProveedor = new Application_Model_modelProveedor();
        $row = $mdProveedor->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pro_estado'=>'Cerrado'
            );
            $where = $mdProveedor->getAdapter()->quoteInto('idproveedor = ?', (int)$this->_getParam('id'));            
            $mdProveedor->update($data,$where);
        }
        return $this->_redirect('/proveedor/list');
    }
   public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/proveedor/list');
        }

        $mdProveedor = new Application_Model_modelProveedor();
        $row = $mdProveedor->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pro_estado'=>'Suspendido'
            );
            $where = $mdProveedor->getAdapter()->quoteInto('idproveedor = ?', (int)$this->_getParam('id'));            
            $mdProveedor->update($data,$where);
        }
        return $this->_redirect('/proveedor/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/proveedor/list');
        }

        $mdProveedor = new Application_Model_modelProveedor();
        $row = $mdProveedor->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pro_estado'=>'Activo'
            );
            $where = $mdProveedor->getAdapter()->quoteInto('idproveedor = ?', (int)$this->_getParam('id'));            
            $mdProveedor->update($data,$where);
        }
        return $this->_redirect('/proveedor/list');
    }
    public function searchAction(){
        $txtbuscar = $this->getRequest()->getParam('txtbuscar');
        $proveedorModel = new Application_Model_modelProveedor();        
        $dataProveedor = $proveedorModel->getSearch($txtbuscar);
        $paginator=$dataProveedor;
        $row=count($paginator);
        $action= "proveedor";
        include('ajax/search.php');
        exit();
    }
}
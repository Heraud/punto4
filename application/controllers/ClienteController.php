<?php
class ClienteController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $ClienteModel = new Application_Model_modelCliente();        
        $DatoCliente = $ClienteModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoCliente);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmCliente();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelCliente();
                $id = $model->save($form->getValues());
                return $this->_redirect('/cliente/list/');
            }
        }

        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/cliente/list");
        }

        $frmCliente = new Application_Form_frmCliente();
        $mdCliente = new Application_Model_modelCliente();

        if ($this->getRequest()->isPost()) {

            if ($frmCliente->isValid($this->_getAllParams())) {
                $mdCliente->save($frmCliente->getValues(),$this->_getParam('id'));
                return $this->_redirect('/cliente/list/');
            }
        } else {
            $row = $mdCliente->getRow($this->_getParam('id'));
            if ($row) 
            {
                $frmCliente->populate($row->toArray());
            }
        }

        $this->view->form = $frmCliente;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/cliente/list');
        }

        $mdCliente = new Application_Model_modelCliente();
        $row = $mdCliente->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'cl_estado'=>'Cerrado'
            );
            $where = $mdCliente->getAdapter()->quoteInto('idcliente = ?', (int)$this->_getParam('id'));            
            $mdCliente->update($data,$where);
        }
        return $this->_redirect('/cliente/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $clienteModel = new Application_Model_modelCliente();        
        $dataClien = $clienteModel->getSearch($txtbuscar);
        $paginator=$dataClien;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "cliente";
        // include('../application/views/scripts/cliente/search.phtml');exit();
        include('ajax/search.php');exit();
    }
}
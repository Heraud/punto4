<?php
class SucursalController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $SucursalModel = new Application_Model_modelSucursal();        
        $DatoSucursal = $SucursalModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoSucursal);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmSucursal();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelSucursal();
                $model->save($form->getValues());
                return $this->_redirect('/sucursal/list/');
            }
        }

        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/sucursal/list");
        }

        $frmSucursal = new Application_Form_frmSucursal();
        $mdSucursal = new Application_Model_modelSucursal();

        if ($this->getRequest()->isPost()) {

            if ($frmSucursal->isValid($this->_getAllParams())) {
                $mdSucursal->save($frmSucursal->getValues(),$this->_getParam('id'));
                return $this->_redirect('/sucursal/list');
            }
        } else {
            $row = $mdSucursal->getRow($this->_getParam('id'));
            if ($row) {
                $frmSucursal->populate($row->toArray());
            }
        }

        $this->view->form = $frmSucursal;
    }


    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/sucursal/list');
        }

        $modelSucursal = new Application_Model_modelSucursal();
        $row = $modelSucursal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'su_estado'=>'Cerrado'
            );
            $where = $modelSucursal->getAdapter()->quoteInto('idsucursal = ?', (int)$this->_getParam('id'));            
            $modelSucursal->update($data,$where);
        }
        return $this->_redirect('/sucursal/list');
    }
    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/sucursal/list');
        }

        $mdSucursal = new Application_Model_modelSucursal();
        $row = $mdSucursal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'su_estado'=>'Suspendido'
            );
            $where = $mdSucursal->getAdapter()->quoteInto('idsucursal = ?', (int)$this->_getParam('id'));            
            $mdSucursal->update($data,$where);
        }
        return $this->_redirect('/sucursal/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/sucursal/list');
        }

        $mdSucursal = new Application_Model_modelSucursal();
        $row = $mdSucursal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'su_estado'=>'Activo'
            );
            $where = $mdSucursal->getAdapter()->quoteInto('idsucursal = ?', (int)$this->_getParam('id'));            
            $mdSucursal->update($data,$where);
        }
        return $this->_redirect('/sucursal/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $sucursalModel = new Application_Model_modelSucursal();        
        $dataSucu = $sucursalModel->getSearch($txtbuscar);
        $paginator=$dataSucu;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "sucursal";
        // include('../application/views/scripts/sucursal/search.phtml');exit();
        include('ajax/search.php');
        //exit();
    }

}

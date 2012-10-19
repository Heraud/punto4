<?php
class PrivilegioController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $PrivilegioModel = new Application_Model_modelPrivilegio();        
        $DatoPrivilegio = $PrivilegioModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoPrivilegio);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){        
        $modelPrivilegio = new Application_Model_modelPrivilegio();
        $dataModel = $modelPrivilegio->getAll();
        if (count($dataModel)==5) {
            $form = '<br><br><div class="alert alert-block alert-error fade in">Ups!!, Ud. alcanzó la catidad límite de 
            ingreso de Privilegios, Para poder ingresar tiene que eliminar al menos una <a class="btn btn-primary" href="/privilegio/list"> Aquí</a></div>';            
        }else{
            $form = new Application_Form_frmPrivilegio();

            //Validadonde el tipo de envio del formulario
            if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->_getAllParams())) {
                    $modelPrivilegio->save($form->getValues());
                    return $this->_redirect('/privilegio/list/');
                }
            }            
        }
        //Enviando el mensaje de form al view
        $this->view->form = $form;
    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/privilegio/list");
        }

        $frmPrivilegio = new Application_Form_frmPrivilegio();
        $mdPrivilegio = new Application_Model_modelPrivilegio();

        if ($this->getRequest()->isPost()) {

            if ($frmPrivilegio->isValid($this->_getAllParams())) {
                $mdPrivilegio->save($frmPrivilegio->getValues(),$this->_getParam('id'));
                return $this->_redirect('/privilegio/list');
            }
        } else {
            $row = $mdPrivilegio->getRow($this->_getParam('id'));
            if ($row) {
                $frmPrivilegio->populate($row->toArray());
            }
        }

        $this->view->form = $frmPrivilegio;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/privilegio/list');
        }

        $mdPrivilegio = new Application_Model_modelPrivilegio();
        $row = $mdPrivilegio->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pri_estado'=>'Cerrado'
            );
            $where = $mdPrivilegio->getAdapter()->quoteInto('idprivilegio = ?', (int)$this->_getParam('id'));            
            $mdPrivilegio->update($data,$where);
        }
        return $this->_redirect('/privilegio/list');
    }

    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/privilegio/list');
        }

        $mdPrivilegio = new Application_Model_modelPrivilegio();
        $row = $mdPrivilegio->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pri_estado'=>'Suspendido'
            );
            $where = $mdPrivilegio->getAdapter()->quoteInto('idprivilegio = ?', (int)$this->_getParam('id'));            
            $mdPrivilegio->update($data,$where);
        }
        return $this->_redirect('/privilegio/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/privilegio/list');
        }

        $mdPrivilegio = new Application_Model_modelPrivilegio();
        $row = $mdPrivilegio->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'pri_estado'=>'Activo'
            );
            $where = $mdPrivilegio->getAdapter()->quoteInto('idprivilegio = ?', (int)$this->_getParam('id'));            
            $mdPrivilegio->update($data,$where);
        }
        return $this->_redirect('/privilegio/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $privilegioModel = new Application_Model_modelPrivilegio();        
        $dataSucu = $privilegioModel->getSearch($txtbuscar);
        $paginator=$dataSucu;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "privilegio";
        // include('../application/views/scripts/privilegio/search.phtml');exit();
        include('ajax/search.php');
        //exit();
    }

}

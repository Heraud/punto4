<?php
class LinkController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   

    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $LinkModel = new Application_Model_modelLink();        
        $DatoLink = $LinkModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoLink);
        $paginator->setDefaultItemCountPerPage(20);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){        
        $modelLink = new Application_Model_modelLink();
        $dataModel = $modelLink->getAll();
        if (count($dataModel)==5) {
            $form = '<br><br><div class="alert alert-block alert-error fade in">Ups!!, Ud. alcanzó la catidad límite de 
            ingreso de Links, Para poder ingresar tiene que eliminar al menos una <a class="btn btn-primary" href="/link/list"> Aquí</a></div>';            
        }else{
            $form = new Application_Form_frmLink();

            //Validadonde el tipo de envio del formulario
            if ($this->getRequest()->isPost()) {
                if ($form->isValid($this->_getAllParams())) {
                    $modelLink->save($form->getValues());
                    return $this->_redirect('/link/list/');
                }
            }            
        }
        //Enviando el mensaje de form al view
        $this->view->form = $form;
    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/link/list");
        }

        $frmLink = new Application_Form_frmLink();
        $mdLink = new Application_Model_modelLink();

        if ($this->getRequest()->isPost()) {

            if ($frmLink->isValid($this->_getAllParams())) {
                $mdLink->save($frmLink->getValues(),$this->_getParam('id'));
                return $this->_redirect('/link/list');
            }
        } else {
            $row = $mdLink->getRow($this->_getParam('id'));
            if ($row) {
                $frmLink->populate($row->toArray());
            }
        }

        $this->view->form = $frmLink;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/link/list');
        }

        $mdLink = new Application_Model_modelLink();
        $row = $mdLink->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'li_estado'=>'Cerrado'
            );
            $where = $mdLink->getAdapter()->quoteInto('idlink = ?', (int)$this->_getParam('id'));            
            $mdLink->update($data,$where);
        }
        return $this->_redirect('/link/list');
    }

    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/link/list');
        }

        $mdLink = new Application_Model_modelLink();
        $row = $mdLink->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'li_estado'=>'Suspendido'
            );
            $where = $mdLink->getAdapter()->quoteInto('idlink = ?', (int)$this->_getParam('id'));            
            $mdLink->update($data,$where);
        }
        return $this->_redirect('/link/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/link/list');
        }

        $mdLink = new Application_Model_modelLink();
        $row = $mdLink->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'li_estado'=>'Activo'
            );
            $where = $mdLink->getAdapter()->quoteInto('idlink = ?', (int)$this->_getParam('id'));            
            $mdLink->update($data,$where);
        }
        return $this->_redirect('/link/list');
    }

    // Action para para poder asiqnar permisos y privilegios a los links.
    public function privilegesAction() {
        $ModelLink = new Application_Model_modelLink();        
        $ModelPrivilegios = new Application_Model_modelPrivilegio();
        $DataLink = $ModelLink->getAll();
        $DataPrivilegio = $ModelPrivilegios->getAll();
            $this->view->DataLink = $DataLink;
            $this->view->DataPrivilegio = $DataPrivilegio;

    }
    public function checkedfalseAction(){
        $Variable = $_REQUEST['variable'];
        list($idlink, $idprivilegio,$li_pri) = explode("-",$Variable);
        $ModelLink = new Application_Model_modelLink();
        if ($idlink) {
            $Data = array(
                "$li_pri"=>0
                );
            $where = $ModelLink->getAdapter()->quoteInto('idlink=?',(int)$idlink);
            $ModelLink->update($Data,$where);  
            echo "El privilegio para este link le fué quitada correctamente ;-)";  
        }
        exit();
    }
    public function checkedtrueAction(){
        $Variable = $_REQUEST['variable'];
        list($idlink, $idprivilegio,$li_pri) = explode("-",$Variable);
        $ModelLink = new Application_Model_modelLink();
        if ($idlink) {
            $Data = array(
                "$li_pri"=>$idprivilegio
                );
            $where = $ModelLink->getAdapter()->quoteInto('idlink=?',(int)$idlink);
            $ModelLink->update($Data,$where);    
            echo "El privilegio para este link le fué concedida correctamente ;-)";
        }
        exit();
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $linkModel = new Application_Model_modelLink();        
        $dataSucu = $linkModel->getSearch($txtbuscar);
        $paginator=$dataSucu;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "link";
        // include('../application/views/scripts/link/search.phtml');exit();
        include('ajax/search.php');
        //exit();
    }

}

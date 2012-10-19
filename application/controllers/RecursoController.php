<?php
class RecursoController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $RecursoModel = new Application_Model_modelRecurso();        
        $DatoRecurso = $RecursoModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoRecurso);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmRecurso();        

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_getAllParams())) {
                $modelRecurso = new Application_Model_modelRecurso();
                $idrecurso = $modelRecurso->save($form->getValues());  

                return $this->_redirect('/recurso/list/');
            }
        }
        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/recurso/list");
        }

        $frmRecurso = new Application_Form_frmUpdateRecurso();
        $mdRecurso = new Application_Model_modelRecurso();

        if ($this->getRequest()->isPost()) {

            if ($frmRecurso->isValid($this->_getAllParams())) {
                $mdRecurso->save($frmRecurso->getValues(),$this->_getParam('id'));
                return $this->_redirect('/recurso/list');
            }
        } else {
            $row = $mdRecurso->getRow($this->_getParam('id'));
            if ($row) {
                $frmRecurso->populate($row->toArray());
            }
        }
        $this->view->id = $this->_getParam('id');
        $this->view->form = $frmRecurso;
    }


    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/recurso/list');
        }
        $modelRecurso = new Application_Model_modelRecurso();
        $row = $modelRecurso->getRow($this->_getParam('id'));
        if ($row) {
            $data = array(
                're_estado'=>'Cerrado'
            );
            $where = $modelRecurso->getAdapter()->quoteInto('idrecurso = ?', (int)$this->_getParam('id'));            
            $modelRecurso->update($data,$where);
        }
        return $this->_redirect('/recurso/list');
    }
    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/recurso/list');
        }

        $mdRecurso = new Application_Model_modelRecurso();
        $row = $mdRecurso->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                're_estado'=>'Suspendido'
            );
            $where = $mdRecurso->getAdapter()->quoteInto('idrecurso = ?', (int)$this->_getParam('id'));            
            $mdRecurso->update($data,$where);
        }
        return $this->_redirect('/recurso/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/recurso/list');
        }

        $mdRecurso = new Application_Model_modelRecurso();
        $row = $mdRecurso->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                're_estado'=>'Activo'
            );
            $where = $mdRecurso->getAdapter()->quoteInto('idrecurso = ?', (int)$this->_getParam('id'));            
            $mdRecurso->update($data,$where);
        }
        return $this->_redirect('/recurso/list');
    }

    public function searchAction(){
        $txtbuscar = $this->getRequest()->getParam('txtbuscar');
        $recursoModel = new Application_Model_modelRecurso();        
        $dataRecurso = $recursoModel->getSearch($txtbuscar);
        $paginator=$dataRecurso;
        $row=count($paginator);
        $action= "recurso";
        include('ajax/search.php');
        exit();
    }

}

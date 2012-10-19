<?php
class IgvController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $IgvModel = new Application_Model_modelIgv();        
        $DatoIgv = $IgvModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoIgv);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmIgv();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelIgv();
                $id = $model->save($form->getValues());
                return $this->_redirect('/igv/list/');
            }
        }

        $this->view->form = $form;

    }

    public function updateAction(){

        if(!$this->_hasParam('id')){
            $this->_redirect("/igv/list");
        }

        $BanderaNamespace = new Zend_Session_Namespace();
        
        

        $frmIgv = new Application_Form_frmIgv();
        $mdIgv = new Application_Model_modelIgv();

        if ($this->getRequest()->isPost()) {

            if ($frmIgv->isValid($this->_getAllParams())) {
                $mdIgv->save($frmIgv->getValues(),$this->_getParam('id'));
                unset($BanderaNamespace->Ig_Tasa);
                return $this->_redirect('/igv/list/');
            }
        } else {
            $row = $mdIgv->getRow($this->_getParam('id'));
            if ($row) 
            {
                $frmIgv->populate($row->toArray());
                $BanderaNamespace->Ig_Tasa = $row['ig_tasa'];
            }
        }

        $this->view->form = $frmIgv;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/igv/list');
        }

        $mdIgv = new Application_Model_modelIgv();
        $row = $mdIgv->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'ig_estado'=>'Cerrado'
            );
            $where = $mdIgv->getAdapter()->quoteInto('idigv = ?', (int)$this->_getParam('id'));            
            $mdIgv->update($data,$where);
        }
        return $this->_redirect('/igv/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $igvModel = new Application_Model_modelIgv();        
        $dataIgv = $igvModel->getSearch($txtbuscar);
        $paginator=$dataIgv;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "igv";
        // include('../application/views/scripts/igv/search.phtml');exit();
        include('ajax/search.php');exit();
    }
}
<?php
class PersonalController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $PersonalModel = new Application_Model_modelPersonal();        
        $DatoPersonal = $PersonalModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoPersonal);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmPersonal();        

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_getAllParams())) {
                $modelPersonal = new Application_Model_modelPersonal();
                $idpersonal = $modelPersonal->save($form->getValues());

                // Recuperando la fecha de mysql, ya que el del php tiene problemas después del medio día.
                $db=Zend_Db_Table_Abstract::getDefaultAdapter();
                $result = $db->fetchAll("SELECT CURDATE() as date");
                foreach ($result as $key) {
                    $date = $key['date'];
                }
                $Data = array(
                        'per_fechregistro'=>$date
                        );
                $where = $modelPersonal->getAdapter()->quoteInto('idpersonal=?',(int)$idpersonal);
                $modelPersonal->update($Data,$where);    

                return $this->_redirect('/personal/list/');
            }
        }
        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/personal/list");
        }

        $frmPersonal = new Application_Form_frmUpdatePersonal();
        $mdPersonal = new Application_Model_modelPersonal();

        if ($this->getRequest()->isPost()) {

            if ($frmPersonal->isValid($this->_getAllParams())) {
                $mdPersonal->save($frmPersonal->getValues(),$this->_getParam('id'));
                return $this->_redirect('/personal/list');
            }
        } else {
            $row = $mdPersonal->getRow($this->_getParam('id'));
            if ($row) {
                $frmPersonal->populate($row->toArray());
            }
        }
        $this->view->id = $this->_getParam('id');
        $this->view->form = $frmPersonal;
    }


    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/personal/list');
        }

        $modelPersonal = new Application_Model_modelPersonal();
        $row = $modelPersonal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'per_estado'=>'Cerrado'
            );
            $where = $modelPersonal->getAdapter()->quoteInto('idpersonal = ?', (int)$this->_getParam('id'));            
            $modelPersonal->update($data,$where);
        }
        return $this->_redirect('/personal/list');
    }
    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/personal/list');
        }

        $mdPersonal = new Application_Model_modelPersonal();
        $row = $mdPersonal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'per_estado'=>'Suspendido'
            );
            $where = $mdPersonal->getAdapter()->quoteInto('idpersonal = ?', (int)$this->_getParam('id'));            
            $mdPersonal->update($data,$where);
        }
        return $this->_redirect('/personal/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/personal/list');
        }

        $mdPersonal = new Application_Model_modelPersonal();
        $row = $mdPersonal->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'per_estado'=>'Activo'
            );
            $where = $mdPersonal->getAdapter()->quoteInto('idpersonal = ?', (int)$this->_getParam('id'));            
            $mdPersonal->update($data,$where);
        }
        return $this->_redirect('/personal/list');
    }

    public function searchAction(){
        $txtbuscar = $this->getRequest()->getParam('txtbuscar');
        $personalModel = new Application_Model_modelPersonal();        
        $dataPersonal = $personalModel->getSearch($txtbuscar);
        $paginator=$dataPersonal;
        $row=count($paginator);
        $action= "personal";
        include('ajax/search.php');
        exit();
    }

}

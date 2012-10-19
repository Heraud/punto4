<?php
class UsuarioController extends Zend_Controller_Action
{
    public function init(){
        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
    }    

    public function listAction(){
        $UsuarioModel = new Application_Model_modelUsuario();        
        $DatoUsuario = $UsuarioModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoUsuario);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmUsuario();        

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_getAllParams())) {
                $modelUsuario = new Application_Model_modelUsuario();
                $idusuario = $modelUsuario->save($form->getValues());

                // Recuperando la fecha de mysql, ya que el del php tiene problemas después del medio día.
                $db=Zend_Db_Table_Abstract::getDefaultAdapter();
                $result = $db->fetchAll("SELECT CURDATE() as date");
                foreach ($result as $key) {
                    $date = $key['date'];
                }
                $Data = array(
                        'us_pass' => sha1(md5($form->getValue('us_pass'))),
                        'us_fech'=>$date
                        );

                $where = $modelUsuario->getAdapter()->quoteInto('idusuario=?',(int)$idusuario);
                $modelUsuario->update($Data,$where);    

                return $this->_redirect('/usuario/list/');
            }
        }
        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/usuario/list");
        }

        $frmUsuario = new Application_Form_frmUpdateUsuario();
        $mdUsuario = new Application_Model_modelUsuario();

        if ($this->getRequest()->isPost()) {

            if ($frmUsuario->isValid($this->_getAllParams())) {
                $mdUsuario->save($frmUsuario->getValues(),$this->_getParam('id'));
                $Data = array(
                        'us_pass' => sha1(md5($frmUsuario->getValue('us_pass')))
                        );

                $where = $mdUsuario->getAdapter()->quoteInto('idusuario=?',(int)$this->_getParam('id'));
                $mdUsuario->update($Data,$where);    

                return $this->_redirect('/usuario/list');
            }
        } else {
            $row = $mdUsuario->getRow($this->_getParam('id'));
            if ($row) {
                // $frmUsuario->populate($row->toArray());
                $frmUsuario->getElement("us_user")->setValue($row['us_user']);
                $frmUsuario->getElement("us_fech")->setValue($row['us_fech']);
                $frmUsuario->getElement("us_estado")->setValue($row['us_estado']);
                $frmUsuario->getElement("idprivilegio")->setValue($row['idprivilegio']);
                $frmUsuario->getElement("idpersonal")->setValue($row['idpersonal']);
            }
        }

        $this->view->id = $this->_getParam('id');
        $this->view->form = $frmUsuario;
    }


    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/usuario/list');
        }

        $modelUsuario = new Application_Model_modelUsuario();
        $row = $modelUsuario->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'per_estado'=>'Cerrado'
            );
            $where = $modelUsuario->getAdapter()->quoteInto('idusuario = ?', (int)$this->_getParam('id'));            
            $modelUsuario->update($data,$where);
        }
        return $this->_redirect('/usuario/list');
    }
    public function suspendAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/usuario/list');
        }

        $mdUsuario = new Application_Model_modelUsuario();
        $row = $mdUsuario->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'us_estado'=>'Suspendido'
            );
            $where = $mdUsuario->getAdapter()->quoteInto('idusuario = ?', (int)$this->_getParam('id'));            
            $mdUsuario->update($data,$where);
        }
        return $this->_redirect('/usuario/list');
    }

    public function activeAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/usuario/list');
        }

        $mdUsuario = new Application_Model_modelUsuario();
        $row = $mdUsuario->getRow($this->_getParam('id'));

        if ($row) {
            $data = array(
                'us_estado'=>'Activo'
            );
            $where = $mdUsuario->getAdapter()->quoteInto('idusuario = ?', (int)$this->_getParam('id'));            
            $mdUsuario->update($data,$where);
        }
        return $this->_redirect('/usuario/list');
    }


}

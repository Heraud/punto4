<?php
class BoletaController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $BoletaModel = new Application_Model_modelBoleta();        
        $DatoBoleta = $BoletaModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoBoleta);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmBoleta();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelBoleta();
                $idboleta = $model->save($form->getValues());
                
                // Recuperando la fecha de mysql, ya que el del php tiene problemas después del medio día.
                $db=Zend_Db_Table_Abstract::getDefaultAdapter();
                $result = $db->fetchAll("SELECT CURDATE() as date");
                foreach ($result as $key) {
                    $date = $key['date'];
                }
                $Data = array(
                        'bo_fech'=>$date,
                        'bo_estado'=>'Activo'
                        );

                $where = $model->getAdapter()->quoteInto('idboleta=?',(int)$idboleta);
                $model->update($Data,$where);

                return $this->_redirect('/boleta/list/');
            }
        }

        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/boleta/list");
        }
        $BanderaNamespace = new Zend_Session_Namespace();

        $frmBoleta = new Application_Form_frmBoleta();
        $mdBoleta = new Application_Model_modelBoleta();

        if ($this->getRequest()->isPost()) {

            if ($frmBoleta->isValid($this->_getAllParams())) {
                $idboleta = $mdBoleta->save($frmBoleta->getValues(),$this->_getParam('id'));
                return $this->_redirect('/boleta/list/');
            }
        } else {
            $row = $mdBoleta->getRow($this->_getParam('id'));
            if ($row) 
            {
                $frmBoleta->populate($row->toArray());
                $BanderaNamespace->Bo_Nro = $row['bo_nro'];
            }
        }

        $this->view->form = $frmBoleta;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/boleta/list');
        }

        $mdBoleta = new Application_Model_modelBoleta();
        $row = $mdBoleta->getRow($this->_getParam('id'));

        if ($row) {
            $row->delete();
        }
        return $this->_redirect('/boleta/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];
        $boletaModel = new Application_Model_modelBoleta();        
        $dataBoleta = $boletaModel->getSearch($txtbuscar);
        $paginator=$dataBoleta;
        $row=count($paginator);
        //Variable para tomar acciones en la parte de la búsqueda
        $action= "boleta";
        include('ajax/search.php');exit();
    }
}
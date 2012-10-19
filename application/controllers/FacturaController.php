<?php
class FacturaController extends Zend_Controller_Action
{
    
    public function init(){

        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
        
    }    

    public function listAction(){
        $FacturaModel = new Application_Model_modelFactura();        
        $DatoFactura = $FacturaModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoFactura);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $form = new Application_Form_frmFactura();        

        if ($this->getRequest()->isPost()) {

            if ($form->isValid($this->_getAllParams())) {
                $model = new Application_Model_modelFactura();
                $idfactura = $model->save($form->getValues());
                
                // Recuperando la fecha de mysql, ya que el del php tiene problemas después del medio día.
                $db=Zend_Db_Table_Abstract::getDefaultAdapter();
                $result = $db->fetchAll("SELECT CURDATE() as date");
                foreach ($result as $key) {
                    $date = $key['date'];
                }
                $Data = array(
                        'fa_fech'=>$date,
                        'fa_estado'=>'Activo'
                        );

                $where = $model->getAdapter()->quoteInto('idfactura=?',(int)$idfactura);
                $model->update($Data,$where);

                return $this->_redirect('/factura/list/');
            }
        }

        $this->view->form = $form;

    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/factura/list");
        }
        $BanderaNamespace = new Zend_Session_Namespace();

        $frmFactura = new Application_Form_frmFactura();
        $mdFactura = new Application_Model_modelFactura();

        if ($this->getRequest()->isPost()) {

            if ($frmFactura->isValid($this->_getAllParams())) {
                $idfactura = $mdFactura->save($frmFactura->getValues(),$this->_getParam('id'));
                return $this->_redirect('/factura/list/');
            }
        } else {
            $row = $mdFactura->getRow($this->_getParam('id'));
            if ($row) 
            {
                $frmFactura->populate($row->toArray());
                $BanderaNamespace->Fa_Nro = $row['fa_nro'];
            }
        }

        $this->view->form = $frmFactura;
    }

    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/factura/list');
        }

        $mdFactura = new Application_Model_modelFactura();
        $row = $mdFactura->getRow($this->_getParam('id'));

        if ($row) {
            $row->delete();
        }
        return $this->_redirect('/factura/list');
    }

    public function searchAction(){
        $txtbuscar = $_REQUEST['txtbuscar'];

        $facturaModel = new Application_Model_modelFactura();
        $dataFactura = $facturaModel->getSearch($txtbuscar);
        $paginator=$dataFactura;

        $row=count($paginator);

        //Variable para tomar acciones en la parte de la búsqueda
        $action= "factura";
        include('ajax/search.php'); exit();
    }
}
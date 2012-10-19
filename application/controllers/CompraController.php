<?php
class CompraController extends Zend_Controller_Action
{
    public function init(){
        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');   
    }
    
    public function indexAction(){
    }    

    public function listAction(){
        $CompraModel = new Application_Model_modelCompra();        
        $DatoCompra = $CompraModel->getAll();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoCompra);
        $paginator->setDefaultItemCountPerPage(10);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        $this->view->paginator = $paginator;
    }

    public function addAction(){
        $ModelRecurso = new Application_Model_modelRecurso();   
        $DatoRecurso= $ModelRecurso->getAll();
        $ModelProveedor = new Application_Model_modelProveedor();
        $DatoProveedor = $ModelProveedor->getKeyName();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginator/items.phtml');
        $paginator = Zend_Paginator::factory($DatoRecurso);
        $paginator->setDefaultItemCountPerPage(30);

        if ($this->_hasParam('page')) {
            $paginator->setCurrentPageNumber($this->_getParam('page'));
        }

        //Para ver si hay items en el carrito y eliminar si se requiere
        $sessionNamespace  = new Zend_Session_Namespace();
        $this->view->carrito = $sessionNamespace->ArrayCarrito;

        $this->view->proveedor = $DatoProveedor;
        $this->view->paginator = $paginator;


    }

    public function updateAction(){
        if(!$this->_hasParam('id')){
            $this->_redirect("/compra/list");
        }

        $frmCompra = new Application_Form_frmUpdateCompra();
        $mdCompra = new Application_Model_modelCompra();

        if ($this->getRequest()->isPost()) {

            if ($frmCompra->isValid($this->_getAllParams())) {
                $mdCompra->save($frmCompra->getValues(),$this->_getParam('id'));
                return $this->_redirect('/compra/list');
            }
        } else {
            $row = $mdCompra->getRow($this->_getParam('id'));
            if ($row) {
                $frmCompra->populate($row->toArray());
            }
        }
        $this->view->form = $frmCompra;
    }


    public function deleteAction() {

        if (!$this->_hasParam('id')) {
            return $this->_redirect('/compra/list');
        }


        $modelCompra = new Application_Model_modelCompra();

        $row = $modelCompra->getRow($this->_getParam('id'));
        if ($row) {

            try {
                $row->delete();                
            } catch (Exception $e) {
                echo "Error en DetalleCompras:",$e->getMessage(),"\n";
                exit();
            }
        }
        return $this->_redirect('/compra/list');
    }

    //Estas dos Funciones son para buscar recursos par aluego comprar !!!NO TOCAR!!
        public function listartodoAction(){
            $recursoModel = new Application_Model_modelRecurso();   
            $dataRecurso = $recursoModel->getAll();
            $paginator=$dataRecurso;
            $row=count($paginator);
            $action= "comprar_recurso_add";
            include('ajax/search.php');
            exit();
        }

        public function searchAction(){
            $txtbuscar = $this->getRequest()->getParam('txtbuscar');
            $recursoModel = new Application_Model_modelRecurso();   
            $dataRecurso = $recursoModel->getSearch($txtbuscar);
            $paginator=$dataRecurso;
            $row=count($paginator);
            try {
                $action= "comprar_recurso_add";
                include('ajax/search.php');            
            } catch (Exception $e) {
                echo "Error"; $e->getMessage();exit();
            }
            exit();
        }

    public function searchcompraAction(){
        $txtbuscar = $this->getRequest()->getParam('txtbuscar');
        $CompraModel = new Application_Model_modelCompra();   
        $dataCompra = $CompraModel->getSearch($txtbuscar);
        $paginator=$dataCompra;
        $row=count($paginator);
        try {
            $action= "compra";
            require('ajax/search.php');            
        } catch (Exception $e) {
            echo "Error"; $e->getMessage();exit();
        }
        exit();
    }        


}

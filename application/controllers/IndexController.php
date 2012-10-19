<?php

class IndexController extends Zend_Controller_Action
{
    protected $session;

    public function init()
    {
        /* Initialize action controller here */
        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
        // $this->_helper->viewRenderer->setNoRender();
        // $this->_helper->getHelper('layout')->disableLayout();
    }

    public function indexAction()
    {
        // action body
    }
    public function preDispatch()
    {
    
    }

}


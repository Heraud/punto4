<?php

class UserController extends Zend_Controller_Action
{
    
    public function init()
    {
        $this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
        $this->view->baseUrl = $this->_request->getBaseUrl();
        $this->_helper->getHelper('Layout')->disableLayout();
        
    }
    
    public function preDispatch()
    {
        if (Application_Model_User::isLoggedIn()) {
            $this->view->loggedIn   = true;
            $this->view->user       = Application_Model_User::getIdentity();
        }
    }
    public function indexAction(){
        $this->_forward('login');
        
    }
    public function loginAction(){
        $form   = new Application_Form_Login();
        
        if($this->getRequest()->isPost()){
            if($form->isValid($this->_getAllParams())){
      
                Zend_Loader::loadClass('Zend_Filter_StripTags');                
                $filter = new Zend_Filter_StripTags();  
                $usr    = trim($filter->filter($this->getRequest()->getPost('username')));
                $pwd    = trim($filter->filter($this->getRequest()->getPost('password')));
                try{
                    $user   = new Application_Model_User();
                    $user->setMessage('El nombre de usuario y password no coinciden.', Application_Model_User::NOT_IDENTITY);
                    $user->setMessage('La contraseña ingresada es incorrecta. Inténtelo de nuevo.',Application_Model_User::INVALID_CREDENTIAL);
                    $user->setMessage('Los campos no pueden dejarse en blanco.',Application_Model_User::INVALID_LOGIN);
                    
                    $user->login($usr,$pwd);
                    
                    $this->_redirect("/");
                    
                }catch (Exception $e){
                    $responseLogin = '<span id="msg" class="label label-important"><strong>'.$e->getMessage().'</strong></span>';
                }

            }            
            
        }
        if (!isset($responseLogin)) {
            $responseLogin = '<span>Iniciar Sesión</span>';
        }
        $this->view->responseLogin = $responseLogin;
        $this->view->form_login = $form;
        $this->view->title = 'Login';
    }
    
    public function logoutAction(){
        $user   = new Application_Model_User();
        $user->logout();
        $this->_redirect('/user/');
    }
}
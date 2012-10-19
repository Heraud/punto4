<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
    protected $_name            = 'usuario';
    protected $_primary         = 'idusuario';
    const NOT_IDENTITY          = 'notIdentity';
    const INVALID_CREDENTIAL    = 'invalidCredential';
    const INVALID_USER          = 'invalidUser';
    const INVALID_LOGIN         = 'invalidLogin';
    
    // Mensaje de validaciones por default.
    // @var array
    protected $_messages        = array(
        self::NOT_IDENTITY          => "Identidad inexistente. Un registro con la identidad proporcionada no se pudo encontrar.",
        self::INVALID_CREDENTIAL    => "Credenciales no válidas. La credencial proporcionada no es válida.",
        self::INVALID_USER          => "El usuario no válido. La credencial proporcionada no es válida",
        self::INVALID_LOGIN         => "Login no válido. Los campos están vacíos."
   );
    
    public function setMessage($messageString, $messageKey = null){
        if($messageKey === null){
            $keys       = array_keys($this->_messages);
            $messageKey = current($keys);
        }
        
        $mk = $this->_messages[$messageKey];
        if(!isset($mk) && empty($mk)){
            throw new Exception("No hay mensajes existentes para la clave: ".$messageKey);
        }
        
        $this->_messages[$messageKey]   = $messageString;
        
        return $this;
    }
    public function setMessages(array $messages){
        foreach ($messages as $key => $message){
            $this->setMessage($message,$key);
        }
        
        return $this;
    }
    
    public function login($usr,$pwd)
    {
        if(!empty($usr) && !empty($pwd))
        {
            // Zend_Loader::loadClass('Zend_Auth_Adapter_DbTable');
            $autAdapter = new Zend_Auth_Adapter_DbTable(self::getDefaultAdapter());

            $autAdapter->setTableName('usuario');
            $autAdapter->setIdentityColumn('us_user');
            $autAdapter->setCredentialColumn('us_pass');

            $autAdapter->setIdentity($usr);
            $autAdapter->setCredential(sha1(md5($pwd)));

            $aut = Zend_Auth::getInstance();
            $result = $aut->authenticate($autAdapter);
            
            switch($result->getCode())
            {
                case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
                    throw new Exception($this->_messages[self::NOT_IDENTITY]);
                    break;
                
                case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
                    throw new Exception($this->_messages[self::INVALID_CREDENTIAL]);
                    break;
                
                case Zend_Auth_Result::SUCCESS:
                    if($result->isValid())
                    {
                        $data   = $autAdapter->getResultRowObject();
                        $aut->getStorage()->write($data);
                        // echo $data->idpersonal;exit();
                                               
                    }else{
                        throw new Exception($this->_messages[self::INVALID_USER]);
                    }
                    break;
                default:
                    throw new Exception($this->_messages[self::INVALID_LOGIN]);
                    break;
                        
                
            }
            
        }else{
            throw new Exception($this->_messages[self::INVALID_LOGIN]);
        }
        return $this;
    }
    
    public function logout()
    {
        Zend_Auth::getInstance()->clearIdentity();
        return $this;
    }
    public static function getIdentity()
    {
        $auth   = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
            return $auth->getIdentity();
        }
        return null;
    }
    public static function isLoggedIn()
    {
        return Zend_Auth::getInstance()->hasIdentity();
    }


}
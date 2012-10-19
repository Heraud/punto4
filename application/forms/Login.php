<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        
        $errores    = array(
            Zend_Validate_NotEmpty::IS_EMPTY => 'El campo no puede estar vacío.'
        );
        
        $traduccion = new Zend_Translate('array', $errores);  
        Zend_Form::setDefaultTranslator($traduccion);

        $this->addElement(
                'text','username',array(
                'label'=>' ',
                // 'validators' => array(array('StringLength', false, array(6, 20))),
                'required'=>true,
                'placeholder'=>'Usuario',
                'class'=>'input-medium' 
                )
            );
        $this->addElement(
                'password','password', array(
                'label'=>' ',
                'placeholder'=>'Password',
                'required'=>true,
                'class'=>'input-medium'
                )
            );
        
// // Definimos los elementos para el formulario
//         $formulario     = new Zend_Form();
//         $usr            = $formulario->createElement('text', 'username')
//      				->setLabel('Usuario')     				
//          			->setRequired(true);
        
//         $pwd            = $formulario->createElement('password', 'password')
//      				->setLabel('Contraseña')     				
//          			->setRequired(true);
        
        
//         // Agregamos los elementos al formulario
        
//         $this->addElement($usr);
//         $this->addElement($pwd);
        $this->addElement(
                'submit','ingresar',array(
                    'class' => 'btn',
                    'label' => ''
                )
        );
    }
}
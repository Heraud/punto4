<?php

class Application_Form_frmCliente extends Zend_Form
{
    public function init()
    {
       // Traducción de errores de Zend/Validate
        
        $errores    = array(
            Zend_Validate_NotEmpty::IS_EMPTY            => 'El campo no puede estar vacío.',
            Zend_Validate_StringLength::TOO_LONG        => 'El campo debe contener solo de %min% caracteres.',
            Zend_Validate_StringLength::TOO_SHORT       => 'El campo debe contener un máximo de %max% caracteres.',
            Zend_Validate_EmailAddress::INVALID         => 'La dirección de correo no es válida.',
            Zend_Validate_EmailAddress::QUOTED_STRING   => "'%localPart%' no concuerda con el formato de comillas.",
            Zend_Validate_EmailAddress::DOT_ATOM        => "'%localPart%' no concuerda con el formato de punto.",
            Zend_Validate_EmailAddress::INVALID_HOSTNAME    => "'%hostname%' no es un nombre de dominio válido.",
            Zend_Validate_EmailAddress::INVALID_LOCAL_PART  => "'%localPart%' no es una parte local válida.",
            Zend_Validate_EmailAddress::INVALID_MX_RECORD   => "'%hostname%' no tiene un dominio de correo asignado.",            
            
            Zend_Validate_EmailAddress::INVALID_FORMAT      => "'%value%' no es una dirección válida de correo electrónico en el formato básico: nombre@dominio",
            Zend_Validate_EmailAddress::INVALID_SEGMENT     => "'% hostname%' no está en un segmento de red enrutable. '% Value%' de la dirección de correo electrónico no deben ser resueltas de la red pública.",
            Zend_Validate_EmailAddress::LENGTH_EXCEEDED     => "'% value%' supera la longitud permitida.",

            Zend_Validate_Digits::NOT_DIGITS =>"'%value%' Debe contener solo dígitos"
        );

        $traduccion = new Zend_Translate('array', $errores);  
        Zend_Form::setDefaultTranslator($traduccion);

        $this->addElement(
                'text','cl_docu',array(
                'label'=>'Documento de Identidad o RUC(*):',
                'validators' => array(
                    'Digits',
                    // array('regex', false, array('/^[0-9]+/',array('messages' => array('notAlnum'=>'Only Alphanumeric')))),
                    array('StringLength', false, array(8, 11))),
                'required'=>true,
                'placeholder'=>'Ingrese documento de identidad',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','cl_nombre',array(
                'label'=>'Nombre y Apellidos:',
                'required'=>true,
                'placeholder'=>'Ingrese nombre y apellidos',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','cl_direc',array(
                'label'=>'Dirección:',
                'required'=>true,
                'placeholder'=>'Ingrese su dirección',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','cl_telf',array(
                'label'=>'Teléfono:',
                'validators' => array(
                    'Alnum',
                    array('StringLength', false, array(6, 20))),
                'required'=>true,
                'placeholder'=>'Ingrese su número telefónico',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','cl_email',array(
                'validators' => array(
                    'EmailAddress'),
                'label'=>'Email:',
                'required'=>true,
                'placeholder'=>'Ingrese su correo electrónico',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'select', 'cl_estado', array(
                'label' => 'Estado:',
                'MultiOptions'=>array('Activo'=>'Activo','Suspendido'=>'Suspendido','Cerrado'=>'Cerrado')
                )
        );  

        $this->addElement(
                'submit','Guardar',array(
                'class'=>'btn btn-primary'
                )
        );

        $this->getElement('Guardar')->setDecorators(array(
         'ViewHelper', 'Description', 'Errors',
         array(array('data' => 'HtmlTag'), array('tag' => 'span','class'=>'btnGuardar')),
         ))->setAttrib('class', 'btn btn-primary')->removeDecorator('Label');

        $this->addElement(
            'reset','Reset',array(
                    'class'=>'btn btn-inverse'
                )
            );
         $this->getElement('Reset')->setDecorators(array(
         'ViewHelper', 'Description', 'Errors',
         array(array('data' => 'HtmlTag'), array('tag' => 'span','class'=>'btnReset'))
         ))->setAttrib('class', 'btn btn-inverse')->removeDecorator('Label');

    }
}
<?php

class Application_Form_frmUpdateCompra extends Zend_Form
{     
    public function init()
    {
       // Traducción de errores de Zend/Validate
        
        $errores    = array(
            Zend_Validate_NotEmpty::IS_EMPTY            => 'El campo no puede estar vacío.',
            Zend_Validate_StringLength::TOO_LONG        => 'El campo debe contener solo de %min% caracteres.',
            Zend_Validate_StringLength::TOO_SHORT       => 'El campo debe contener entre %min% y %max% caracteres.',
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

        $this->setAttrib('id', 'frmCompra');

        $this->addElement(
                'text','co_nrofact',array(
                'label'=>'Nro. Factura(*):',
                'readonly'=>true,
                'validators' => array(
                    'Digits',
                    array('StringLength', false, array(1,10))),
                'required'=>true,
                'placeholder'=>'Ingrese documento de identidad',
                'class'=>'input-large' 
                )
            );

        $date = new ZendX_JQuery_Form_Element_DatePicker('co_fech');
        $date->setLabel('Fecha compra:')
        ->setJQueryParam('dateFormat', 'yy-mm-dd')
        ->setJQueryParam('changeYear', 'true')
        ->setJqueryParam('changeMonth', 'true')
        ->setJqueryParam('regional', 'de')
        ->setJqueryParam('yearRange', "2000:2020")
        ->addValidator(new Zend_Validate_Date(array('format' => 'yyyy-mm-dd',)))
        ->setRequired(false);

        $this->addElement($date);

        $this->addElement(
                'text','co_importe',array(
                'label'=>'Importe de la Compra(*):',
                'required'=>true,
                'placeholder'=>'Importe de la compra',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','co_encargado',array(
                'label'=>'Encargado de la Compra:',
                'placeholder'=>'Ingrese su número telefónico',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'select','idproveedor',array(
                    'label'=>'Seleccione proveedor',
                    )
            );
        $model = new Application_Model_modelProveedor();
        foreach ($model->getKeyName() as $key) {
            $this->getElement('idproveedor')->addMultiOption($key->idproveedor,$key->pro_nombre);
        }
        $this->addElement(
                'select','idpersonal',array(
                    'label'=>'Seleccione personal',
                    )
            );
        $model = new Application_Model_modelPersonal();
        foreach ($model->getKeyName() as $key) {
            $this->getElement('idpersonal')->addMultiOption($key->idpersonal,$key->per_nombre);
        }  

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
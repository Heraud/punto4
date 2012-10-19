<?php

class Application_Form_frmRecurso extends Zend_Form
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

            Zend_Validate_Digits::NOT_DIGITS =>'"%value%" debe ser solo dígitos'
        );

        $traduccion = new Zend_Translate('array', $errores);  
        Zend_Form::setDefaultTranslator($traduccion);

        $this->setAttrib('id', 'frmRecurso');

        $this->addElement(
                'text','re_nombre',array(
                'label'=>'Nombre del recurso(*):',
                'validators'=>array(array('StringLength',false,array(8,50))),
                'required'=>true,
                'placeholder'=>'Ingrese nombre del recurso',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','re_sku',array(
                'label'=>'SKU del Producto:',
                'validators'=>array(array('StringLength',false,array(0,50))),
                'placeholder'=>'Ingrese SKU recurso',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_marca',array(
                'label'=>'Marca del recurso:',
                'validators'=>array(array('StringLength',false,array(0,50))),
                'placeholder'=>'Ingrese la marca del recurso',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_presenta',array(
                'label'=>'Presentación(*):',
                'required'=>true,                    
                'validators' => array(array('StringLength',false,array(0,20))),
                'placeholder'=>'Ingrese presentación',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_umedida',array(
                'label'=>'Unidad de Medida(*):',
                'required'=>true,                
                'validators' => array(
                    array('StringLength', false, array(2, 20))),
                'placeholder'=>'Ingrese unidad de medida',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'text','re_pcompra',array(
                'label'=>'Precio de compra(*):',
                'required'=>true,
                'validators'=>array('Digits'),
                'placeholder'=>'Ingrese precio de compra',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_pventa',array(
                'label'=>'Precio de venta(*):',
                'required'=>true,
                'validators'=>array('Digits'),
                'placeholder'=>'Ingrese precio de venta',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_stock',array(
                'label'=>'Stock(*):',
                'Description'=>'Preferentemente ingrese en metros/litros/unidades/kilógramos',
                'required'=>true,
                'validators'=>array('Digits'),
                'placeholder'=>'Ingrese el stock',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_stockmin',array(
                'label'=>'Stock mínimo(*):',
                'required'=>true,
                'validators'=>array('Digits'),
                'placeholder'=>'Ingrese el stock mínimo',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'text','re_stockmax',array(
                'label'=>'Stock máximo(*):',
                'required'=>true,
                'validators'=>array('Digits'),
                'placeholder'=>'Ingrese el stock máximo',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'select', 're_estado', array(
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
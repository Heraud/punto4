<?php

class Application_Form_frmFactura extends Zend_Form
{
    public function init()
    {
       // Traducción de errores de Zend/Validate
        
        require_once 'Zend/Validate/NotEmpty.php';
        require_once 'Zend/Validate/StringLength.php';
        require_once 'Zend/Validate/EmailAddress.php';
        
        $errores    = array(
            Zend_Validate_NotEmpty::IS_EMPTY            => 'El campo no puede estar vacío.',
            Zend_Validate_StringLength::TOO_LONG        => 'El campo debe contener por lo menos %min% caracteres.',
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

            Zend_Validate_Int::INVALID => "Tipo inválido dado. Ingreso una cadena",
            Zend_Validate_Int::NOT_INT => "'%value%' no parece ser un entero"
        );

        $traduccion = new Zend_Translate('array', $errores);  
        Zend_Form::setDefaultTranslator($traduccion);

        $this->addElement(
                'text','fa_nro',array(
                'label'=>'Nro. Factura(*):',
                'validators' => array(
                    'Int'),
                'required'=>true,
                'placeholder'=>'Ingrese el nro de factura',
                'class'=>'input-large' 
                )
            );


        $date = new ZendX_JQuery_Form_Element_DatePicker('fa_fech');
        $date->setLabel('Fecha compra(*):')
        ->setJQueryParam('dateFormat', 'yy-mm-dd')
        ->setJQueryParam('changeYear', 'true')
        ->setJqueryParam('changeMonth', 'true')
        ->setJqueryParam('regional', 'de')
        ->setJqueryParam('yearRange', "2000:2020")
        ->addValidator(new Zend_Validate_Date(array('format' => 'yyyy-mm-dd',)))
        ->setRequired(true);

        $this->addElement($date);

        $this->addElement(
                'text','fa_subtotal',array(
                'label'=>'Sun Total(*):',
                'validators' => array(
                    'Int'),
                'required'=>true,
                'placeholder'=>'Ingrese monto subtotal',
                'class'=>'input-large' 
                )
            ); 

        $this->addElement(
                'text','fa_total',array(
                'label'=>'Importe Total(*):',
                'validators' => array(
                    'Int'),
                'required'=>true,
                'placeholder'=>'Ingrese importe Total',
                'class'=>'input-large' 
                )
            );

        $this->addElement(
                'select','fa_emisor',array(
                    'label'=>'Elija el usuario emisor(*):',
                    )
            );
        $model = new Application_Model_modelUsuario();
        foreach ($model->getKeyName() as $key) {
            $this->getElement('fa_emisor')->addMultiOption($key->us_user,$key->us_user);
        }
        $this->addElement(
                'select','idigv',array(
                    'label'=>'IGV(*):',
                    )
            );
        $model = new Application_Model_modelIgv();
        foreach ($model->getKeyName() as $key) {
            $this->getElement('idigv')->addMultiOption($key->idigv,$key->ig_tasa);
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
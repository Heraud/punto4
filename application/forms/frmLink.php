<?php

class Application_Form_frmLink extends Zend_Form
{
    public function init()
    {
       // Traducción de errores de Zend/Validate        
        
        $errores    = array(
            Zend_Validate_NotEmpty::IS_EMPTY            => 'El campo no puede estar vacío.'
        );
        
        $traduccion = new Zend_Translate('array', $errores);  
        Zend_Form::setDefaultTranslator($traduccion);

        $this->addElement(
            'text','li_nombre',array(
                'label'=>'Descripción del Link(*):',
                'required'=>true,
                'placeholder'=>'Ingrese la descripción del Link',
                'class'=>'input-large' 
                )
            );
     
        $this->addElement(
            'text','li_link',array(
                'label'=>'Link(sin espacio)(*):',
                'required'=>true,
                'placeholder'=>'Ingrese el link',
                'class'=>'input-large' 
                )
            );
        $this->addElement(
                'select', 'idlinkubica', array(
            'label' => 'Ubicación del Link:',
                )
        );
        $model = new Application_Model_modelLinkubica();
        foreach ($model->getAll() as $key) {
            $this->getElement("idlinkubica")->addMultiOption($key->idlinkubica,$key->lu_nombre);
        }


        $this->addElement(
                'select', 'li_estado', array(
            'label' => 'Estado:',
            'MultiOptions'=>array('Activo'=>'Activo','Suspendido'=>'Suspendido','Cerrado'=>'Cerrado')
                )
        );            

        $this->addElement(
            'submit','Guardar',array(
                    'class'=>'btn btn-primary',
                    'label'=>'Guardar Dato'
                )
            );
        $this->getElement('Guardar')->setDecorators(array(
         'ViewHelper', 'Description', 'Errors',
         array(array('data' => 'HtmlTag'), array('tag' => 'span','class'=>'btnGuardar')),
         ))->setAttrib('class', 'btn btn-primary')->removeDecorator('Label');

        $this->addElement(
            'reset','Reset',array(
                    'class'=>'btn btn-inverse',
                    'label'=>'Limpiar Campos'
                )
            );
         $this->getElement('Reset')->setDecorators(array(
         'ViewHelper', 'Description', 'Errors',
         array(array('data' => 'HtmlTag'), array('tag' => 'span','class'=>'btnReset'))
         ))->setAttrib('class', 'btn btn-inverse')->removeDecorator('Label');

    }
}
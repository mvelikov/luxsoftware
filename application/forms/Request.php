<?php

class Form_Request extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $registerFieldset = array();

        $el = new Zend_Form_Element_Text('name');
        $el->setLabel('Name');
        $el->addValidator(new Zend_Validate_Alpha(true));
        $el->addValidator(new Zend_Validate_StringLength(array('min' => 1, 'max' => 20)));
        $el->setRequired(true);
        $this->addElement($el);
        $registerFieldset[] = $el->getName();

        $el = new Zend_Form_Element_Text('email');
        $el->setLabel('Email');
        $el->addValidator(new Zend_Validate_EmailAddress());
        $el->addValidator(new Zend_Validate_StringLength(array('min' => 1, 'max' => 50)));
        $el->setRequired(true);
        $el->setAttrib('autocomplete', 'off');
        $this->addElement($el);
        $registerFieldset[] = $el->getName();


        $el = new Zend_Form_Element_Textarea('message');
        $el->setLabel('Message');
        $el->setRequired(true);
        $el->setAttrib('cols', '26');
        $el->setAttrib('rows', '10');
        $el->addValidator(new Zend_Validate_StringLength(array('min' => 1, 'max' => 200)));
        $this->addElement($el);
        $registerFieldset[] = $el->getName();

        

        $this->addDisplayGroup(
                $registerFieldset
                , 'Request-Information', array('legend' => 'Make request'));

        $submitButtonElement = new Zend_Form_Element_Submit('submit');
        $submitButtonElement->setAttrib('class', 'submit-button');
        $submitButtonElement->setLabel('Send');
        $submitButtonElement->setRequired(true);
        $this->addElement($submitButtonElement);
 
        $this->setElementDecorators(array(
            'ViewHelper',
            array('HtmlTag', array('tag' => 'div', 'class' => 'buttondiv'))
                ), array('submit'));

        $this->setDecorators(array(
            array('Description', array('tag' => 'div', 'class' => "form-title")),
            'FormElements',
            array('Form', array('class' => 'form')),
            array('HtmlTag', array('tag' => 'div', 'class' => 'formdiv'))
        ));
  
        parent::init();
    }

}
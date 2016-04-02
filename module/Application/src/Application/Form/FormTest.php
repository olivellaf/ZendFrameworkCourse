<?php
/**
 * Created by PhpStorm.
 * User: Ferran Olivella
 * Date: 2/4/2016
 * Time: 17:03
 */


namespace Application\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Captcha;
use Zend\Form\Factory;
use Zend\Form\Form;
use Application\Form\FormTestValidator;


class FormTest extends Form{


    public function __construct($name = null) {

        parent::__construct($name);

        // Using our own and created Form Test Validator class
        // Associating the validation to the form
        $this->setInputFilter(new FormTestValidator());

        $this->add(array(
            'name' => 'name',
            'options' => array(
                'label' => 'Name: ',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => '',
            )
        ));

        // Another way to create a form. Using Factory.
        $factory = new Factory();

        $email = $factory->createElement(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Email: ',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'email-input',
            ),
        ));

        $this->add($email);

        // Submit
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Send',
                'title' => 'Send',
            ),
        ));
    }
}

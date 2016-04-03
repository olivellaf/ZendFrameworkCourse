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

    protected $adapter;

    public function __construct($dbAdapter = null, $name = null) {

        parent::__construct($name);

        // Assigning the adapter to the $adapter attribute of the class
        $this->adapter = $dbAdapter;


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


        // Adding a SELECT field into the form
        // In this case, we don't declare the array first as the other cases, insert it straight to the method add.
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category',
            'options' => array(
                'label' => 'Category: ',
                'empty_option' => 'Select a category',
                'value_options' => $this->getCategories(), // getting categories from the DB

            ),

            'attributes' => array(
                'value' => 'si', // checked by default
                'required' => 'required',
                'class' => 'form-control',
            )
        ));

        // Adding a Checkbox and Radio field into the form
        // In this case, we don't declare the array first as the other cases, insert it straight to the method add.
        $this->add(array(
            'type' => 'radio',
            'name' => 'status',
            'options' => array(
                'value_options' => array(
                    'public' => ' Public ',
                    'followers' => ' Only followers ',
                ),
            ),
            'attributes' => array(
                'value' => 'public', // checked by default
                'required' => 'required',
            )
        ));

        // Checkbox
        $this->add(array(
            'type' => 'checkbox',
            'name' => 'document',
            'options' => array(
                'label' => ' Document ',
                'use_hidden_element' => false,
                'checked_value' => 'si',
            ),
        ));



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

    /**
     * Function for get all data from the db.
     */
    public function getCategories() {

        // Make a standard query with Query Builder
        $dbAdapter = $this->adapter;
        $statement = $dbAdapter->query("SELECT id, name FROM categories");
        $result = $statement->execute();

        $select = array();

        foreach ($result as $r) {

            $select[$r['id']] = $r['name'];
        }

        return $select;
    }
}

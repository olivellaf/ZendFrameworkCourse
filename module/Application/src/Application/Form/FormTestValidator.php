<?php
/**
 * Created by PhpStorm.
 * User: Ferran Olivella
 * Date: 2/4/2016
 * Time: 19:22
 */


namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator\EmailAddress as EmailAddressVal;
use Zend\Validator\ValidatorChain;
use Zend\I18n\Validator as I18nValidator;


class FormTestValidator extends InputFilter {

    /**
     * Defining all te validation rules and filters for the form
     */
    public function __construct() {

        $this->add(array(
            'name' => 'name',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => '5', // minimum characters
                        'max' => '20', // maximum characters
                        'messages' => array(
                            \Zend\Validator\StringLength::INVALID => 'Your name is incorrect',
                            \Zend\Validator\StringLength::TOO_SHORT => 'Your name is too short. Minimum 5 characters',
                            \Zend\Validator\StringLength::TOO_LONG => 'Your name is too long. Maximum 20 characters',
                        )
                    )
                ),

                array(
                    'name' => 'Alpha',
                    'options' => array(
                        'messages' => array(
                            I18nValidator\Alpha::INVALID => 'Your name can only contain characters',
                            I18nValidator\Alpha::NOT_ALPHA => 'Your contains number. Check it. Only characters allowed',
                            I18nValidator\Alpha::STRING_EMPTY => 'Empty field. Please check it.',
                        )
                    )
                )
            )
        ));

        $this->add(array(
           'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'allowWhiteSpace' => true, // allow white spaces
                        'messages' => array(
                            EmailAddressVal::INVALID_HOSTNAME => 'Incorrect email given',
                        )
                    )
                )
            )


        ));

    }

}

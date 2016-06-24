<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Form\FormTest;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Validator;
use Zend\I18n\Validator as I18Validator;

use Zend\Db\Adapter\Adapter;
use Application\Controller\Plugin\Plugins;


class IndexController extends AbstractActionController
{

    protected $userTable;


    /**
     * Added after modify module.php, for adding new "factories".
     */
    protected function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }

        return $this->userTable;
    }


    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function helloWorldAction() {
        echo "Hola Mundo! Soy Ferran y esto aprendiendo Zend Framework 2";
        die();
    }

    public function formAction() {

        // Get the dbAdapter to connect to the Database
        $dbAdapter = $this->getServiceLocator()->get('Zend\\Db\\Adapter\\Adapter');

        // Create the form object and pass to the adaptor
        $form = new FormTest($dbAdapter, 'form');

        // $form = new FormTest("form");

        $view = array(
            'title' => 'Forms in Zend Framework 2',
            'form' => $form,
        );

        if ($this->request->isPost()) {

            // Get the data post and fill the form
            $form->setData($this->request->getPost());

            // If the form is not valid, add the errors to the view
            if (!$form->isValid()) {

                $errors = $form->getMessages();

                $view['errors'] = $errors;

                // Extra content. Manipulating the errors array, for only shows the first that we have stablished.
                    // Something like this.  $view['errors'] = $errors['email']['emailAddressInvalidHostname'];

            }

        }

        return new ViewModel($view);
    }

    public function getFormDataAction() {

        if ($this->request->getPost('submit')) {

            $data = $this->request->getPost();

            $email = new Validator\EmailAddress();

            // Set error message
            $email->setMessage("Email field '%value%' is not correct");

            $validate_email = $email->isValid($this->request->getPost('email'));

            // Validation: Only characters
            $alpha = new I18Validator\Alpha();
            $alpha->setMessage("The name %value% introduced isn't only characters");
            $validate_alpha = $alpha->isValid($this->request->getPost('name'));


            if ($validate_email && $validate_alpha) {

                $validate = "Data validation correct";

            } else {

                // If there are some error. Get the errors and show it.
                $validate = array(
                    $email->getMessages(),
                    $alpha->getMessages(),
                );

                var_dump($validate);
            }

            var_dump($data);
            die();

        } else {


        }
        // Redirecting to the same Form Page but showing the data obtained.
        //$this->redirect()->toUrl($this->getRequest()->getBaseUrl(). "/application/index/form");

    }

    public function listAction() {

        /* Testing our own plugins and pieces of code */
        $plugins = $this->Plugins();
        echo $plugins->today();

        $var = "Value";
        var_dump($plugins->exists($var));
        /* end testing plugins */


        // $users = $this->getUserTable()->fetchAll();

        $users = $this->getUserTable()->fetchAllSql(); // using the literal sql string method

        foreach ($users as $user) {
            var_dump($user);
        }

        die();
    }

    public function addAction() {
        $user = new \Application\Model\User();

        $data = array(
            "name" => "Bruce",
            "surname" => "Wayne",
            "description" => "I'am Batman.",
            "email" => "batman2@gmail.com",
            "password" => "batman",
            "image" => "batimage1",
            "alternative" => "batalternative1",
        );

        $user->exchangeArray($data); /* transforms the array to the User Type */

        $userExists = $users = $this->getUserTable()->getUserByEmail($data['email']);

        if ($userExists) {
            $this->redirect()->toUrl($this->getRequest()->getBaseUrl(). "/application/index/list");

        } else {

            $save = $this->getUserTable()->saveUser($user);
            $this->redirect()->toUrl($this->getRequest()->getBaseUrl(). "/application/index/list");
        }
    }
}

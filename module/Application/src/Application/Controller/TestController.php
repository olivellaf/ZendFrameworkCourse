<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{

    public function indexAction()
    {
        
        $var1 = $this->params()->fromRoute("var1", "DEFAULT1");
        $var2 = $this->params()->fromRoute("var2", "DEFAULT2");
                
        /***************************************************************/
        // If there no parameters. Set a redirection to Home
        /* if($var1 == "DEFAULT1") {
           return $this->redirect()->toUrl(
                   /**
                    * Two ways for do the same
                    *   $this->redirect()->toRoute("home")
                    *   $this->getRequest()->getBaseUrl("www.google.com")
                    */
                  // $this->getRequest()->getBaseUrl()
                  // ); 
        /***************************************************************/
        
        
        // Defining the Test Layout on the controller
        $this->layout("layout/test");
        
        $this->layout()->param="Hi! How are you?";
        $this->layout()->title="Layouts with Zend Framework 2";
        
        return new ViewModel(array(
            "text" => "Hola Mundo! Soy Ferran y esto aprendiendo Zend Framework 2",
            "var1" => $var1,
            "var2" => $var2
        ));
    }
    
    public function getAjaxDataAction() {
        $view = new ViewModel();
        
        // Function used for not load some content.
        $view->setTerminal(true);
        
        return $view;
    }
    
}

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

        $this->layout("layout/test");

        $this->layout()->param="Hello how are you?";
        $this->layout()->title="Templates in Zend Framework 2";
        
        return new ViewModel(array(
            "text" => "Hello World! I'm Ferran and I'm learning to use Zend Framework 2",
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

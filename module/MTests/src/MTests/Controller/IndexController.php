<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace MTests\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function helloWorldAction() {
        echo "Hola Mundo! Soy Ferran y esto aprendiendo Zend Framework 2 | MTests ";
        echo "<br> Tener en cuenta que también nos podemos bajar el esqueleto de un módulo vacío des del  git de zend";
        die();
    }
}

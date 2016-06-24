<?php
/**
 * Created by PhpStorm.
 * User: starm
 * Date: 24/6/2016
 * Time: 18:30
 */

namespace Application\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;


class LowerCase extends AbstractHelper
{

    /**
     * Like method __construct, but before of it. Just this class has been invoked, executes the code.
     */
    public function __invoke($str) {
        return strtolower($str);
    }

}
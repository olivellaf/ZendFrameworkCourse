<?php
/**
 * Created by PhpStorm.
 * User: starm
 * Date: 24/6/2016
 * Time: 18:12
 */

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;





class Plugins extends AbstractPlugin
{

    public function today() {
        return date("Y-m-d");
    }

    public function exists($var) {

        $var = trim($var);

        if (!is_null($var) && $var !== false && !empty($var)) {
            // Good!
        } else {
            $var = false;
        }

        return $var;
    }




}
<?php
/**
 * Created by PhpStorm.
 * User: starm
 * Date: 24/6/2016
 * Time: 16:31
 */

namespace Application\Model;


class User {

    public $id, $name, $surname, $description, $email, $password, $image, $alternative;

    /**
     * This function helps us to define the entity. It's like the setter and getters.
     * @param $data
     */
    public function exchangeArray($data) {
        $this->id = (!empty($data["id"])) ? $data["id"] : null ;
        $this->name = (!empty($data["name"])) ? $data["name"] : null ;
        $this->surname = (!empty($data["surname"])) ? $data["surname"] : null ;
        $this->description = (!empty($data["description"])) ? $data["description"] : null ;
        $this->password = (!empty($data["password"])) ? $data["password"] : null ;
        $this->email = (!empty($data["email"])) ? $data["email"] : null ;
        $this->image = (!empty($data["image"])) ? $data["image"] : null ;
        $this->alternative = (!empty($data["alternative"])) ? $data["alternative"] : null ;
    }


}




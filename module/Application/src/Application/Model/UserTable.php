<?php
/**
 * Created by PhpStorm.
 * User: starm
 * Date: 24/6/2016
 * Time: 16:43
 */

namespace Application\Model;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

/* Necessary for use Complex queries */
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\ResultSet\ResultSet;


class UserTable
{
    protected $tableGateway;
    protected $dbAdapter;


    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
        $this->dbAdapter = $tableGateway->adapter;
    }

    public function fetchAllSql() {
        // First way. Using dbAdapter createStatement. For basics.
         /** $query = $this->dbAdapter->createStatement("SELECT * FROM user;");
         * $data = $query->execute();
         **/

        // Second Way. SQL Native Queries.
        /*$query = $this->dbAdapter->query("SELECT * FROM user;", Adapter::QUERY_MODE_EXECUTE);
        $data = $query->toArray();*/

        // Third Way. Query Builder.
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select();
        $select->from("user");

        $statement = $sql->prepareStatementForSqlObject($select);

        $data = $statement->execute();
        //


        // Transforms to array from a ResultSet
        $resultSet = new ResultSet();
        $data = $resultSet->initialize($data);

        return $data;

        /**
         * If you need mor information of how to use the query builder from Documentation \Zend\Db\Sql ... :)
         */
    }

    /**
     * Get the result set of a Select All of the items from a table on the database.
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }


    /**
     * Get only one User from $id given
     * @param $id
     * @return array|\ArrayObject|null
     */
    public function getUser($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array("id"=>$id));
        $row = $rowset->current();

        return $row;
    }


    public function getUserByEmail($email) {
        $rowset = $this->tableGateway->select(array("email"=>$email));
        $row = $rowset->current();

        return $row;
    }


    /**
     * Update an user with a new information from user. Also checks if everthing went allright.
     * @param User $user
     * @return int
     * @throws \Exception
     */
    public function saveUser(User $user) {
        $data = array(
          "name" => $user->name,
          "surname" => $user->surname,
          "description" => $user->description,
          "email" => $user->email,
          "password" => $user->password,
          "image" => $user->image,
          "alternative" => $user->alternative,
        );

        $id = (int) $user->id;

        if ($id == 0) {
            $result = $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $result = $this->tableGateway->update($data);
            } else {
                throw new \Exception("The user doesn't exist");
            }
        }

        return $result;
    }

    /**
     * Delete user from $id given and checks if we succeed on it.
     * @param $id
     * @return int
     */
    public function deleteUser($id) {
        $delete = $this->tableGateway->delete(array("id"=>(int) $id));
        return $delete;
    }

    /* Working with the SQL Native Queries */


}
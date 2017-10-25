<?php
require_once 'DAL.php';


class BL {

    public static function login($email, $password){
        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM `administrator` WHERE `email`= :email AND `password`= :password;');
        $stmt->execute(['email' => $email, 'password' => md5($password)]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function CreateEntity($table, $model){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $str1 = implode(",", array_keys($model));
        $str2 = ':' . implode(",:", array_keys($model)) ;
        $query = "INSERT INTO " .  $table . " (" . $str1 . ") values (" . $str2 . ")";
        $stmt = $db->prepare($query);
        $stmt->execute($model);

        $id = $db->lastInsertId();
        if($id){
            return $id;
        }

        return false;
    }

    public static function updateItemById($table, $id, $data){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $strUpdate = '';
        unset($data['id']);
        foreach ($data as $key => $value){
            $strUpdate .= $key . ' = :' . $key . ',';
        }
        $strUpdate = substr($strUpdate, 0, -1);
        $query = 'UPDATE ' .  $table . ' SET ' . $strUpdate . ' WHERE id = :id';
        $stmt = $db->prepare($query);
        $data['id'] = $id;
        $stmt->execute($data);

        return 0;
    }
    public static function getAll($table){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM ' .  $table);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch())
        {
            $result[] = $row;
        }

        return $result;

    }

    public static function getOneById($table, $id){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM ' .  $table . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row;

    }

    public static function getAllIds($table){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT id FROM ' .  $table . ' ORDER BY id');
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch())
        {
            $result[] = $row;
        }

        return $result;

    }

    public static function deleteItem($table, $id){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $stmt = $db->prepare('DELETE FROM ' .  $table . ' WHERE id = :id');

        $stmt->execute(['id' => $id]);
     //   $row = $stmt->fetch();
        return 0;
    }

}
?>
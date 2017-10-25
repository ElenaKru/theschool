<?php
require_once 'model.php';

class AdminModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    private $email;
    const tableName = 'admin';
    function __construct($params) {
        // parent::__construct('Customer');

        //    $this->tableName = 'Customer';
//        $this->id = $params["id"];
        $this->name = $params["name"];

    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}

?>
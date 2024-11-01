<?php 
require_once ROOT_PATH . '/model/Database.php';


    class UserModel extends Database{
        public function getUsers($intLimit){
            return $this->select($intLimit);
        }
    }
?>
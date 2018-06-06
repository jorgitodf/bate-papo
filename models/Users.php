<?php

class Users extends Model {

    private $userId;

    public function verifyLogin()
    {
        if (!empty($_SESSION['chathashlogin'])) {
            $s = $_SESSION['chathashlogin'];

            $sql = "SELECT * FROM users WHERE login = :hash";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":hash", $s);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch();
                $this->userId = $data['id'];
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
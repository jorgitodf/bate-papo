<?php

class Users extends Model {

    private $userId;

    public function verifyLogin()
    {
        if (!empty($_SESSION['chathashlogin'])) {
            $s = $_SESSION['chathashlogin'];

            $sql = "SELECT * FROM users WHERE loginhash  = :loginhash";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":loginhash", $s);
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

    public function validateUsername($username)
    {
        if (preg_match('/^[a-z0-9]+$/', $username)) {
            return true;
        } else {
            return false;
        }
    }

    public function userExists($username)
    {       
        $sql = "SELECT * FROM users WHERE username = :username";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":username", $username);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUser($username, $password)
    {
        $newpass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":username", $username);
        $sql->bindValue(":password", $newpass);
        $sql->execute();
    }

    public function validateUser($username, $password) 
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":username", $username);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $info = $sql->fetch();
            if (password_verify($password, $info['password'])) {
                $loginHash = md5(rand(0,99999).time().$info['id']);
                $this->setLoginHash($info['id'], $loginHash);    
                $_SESSION['chathashlogin'] =  $loginHash;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function setLoginHash($id, $hash)
    {
        $sql = "UPDATE users SET loginhash = :loginhash WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":loginhash", $hash);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}
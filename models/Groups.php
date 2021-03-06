<?php

class Groups extends Model {

    public function getListGroups()
    {       
        $array = array();
        $sql = "SELECT * FROM groups ORDER BY name ASC";
        $sql = $this->db->query($sql);
        $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }

    public function add($name)
    {       
        $array = array();
        $sql = "INSERT INTO groups (name) VALUES (:name)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->execute();
    }
}
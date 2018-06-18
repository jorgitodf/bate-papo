<?php

class Messages extends Model 
{
    public function add($uid, $idGroup, $msg)
    {
        $array = array();
        $sql = "INSERT INTO messages (date_msg, message, user_id, group_id) VALUES (NOW(), :message, :uid, :msg)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":message", $msg);
        $sql->bindValue(":user_id", $uid);
        $sql->bindValue(":group_id", $idGroup);
        $sql->execute();
    }
}
<?php

class Messages extends Model 
{
    public function add($uid, $idGroup, $msg)
    {
        $array = array();
        $sql = "INSERT INTO messages (date_msg, message, user_id, group_id) VALUES (NOW(), :message, :user_id, :group_id)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":message", $msg);
        $sql->bindValue(":user_id", $uid);
        $sql->bindValue(":group_id", $idGroup);
        $sql->execute();
    }

    public function get($lastTime, $groups)
    {
        $array = array();
        $sql = "SELECT *, (SELECT users.username FROM users WHERE users.id = messages.user_id) AS username
            FROM messages 
            WHERE date_msg > :date_msg AND group_id IN (".(implode(',', $groups)).")";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":date_msg", $lastTime);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FECTH_ASSOC);
        }
        return $array;
    }
}
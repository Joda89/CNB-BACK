<?php

namespace App\Services;

class MailsService extends BaseService
{   
        public function get($idUser)
    {
        return $this->db->fetchAll("SELECT * FROM user_mail where user = ?", array((int) $idUser));
    }

    function save($user_mail)
    {
        $this->db->insert("user_mail", $user_mail);
        return $this->db->lastInsertId();
    }

    function update($id, $user_mail)
    {
        return $this->db->update('user_mail', $user_mail, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("user_mail", array("id" => $id));
    }

}

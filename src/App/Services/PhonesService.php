<?php

namespace App\Services;

class PhonesService extends BaseService
{   
        public function get($idUser)
    {
        return $this->db->fetchAll("SELECT * FROM user_phone where user = ?", array((int) $idUser));
    }

    function save($user_phone)
    {
        $this->db->insert("user_phone", $user_phone);
        return $this->db->lastInsertId();
    }

    function update($id, $user_phone)
    {
        return $this->db->update('user_phone', $user_phone, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("user_phone", array("id" => $id));
    }

}

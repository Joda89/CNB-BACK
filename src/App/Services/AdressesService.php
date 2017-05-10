<?php

namespace App\Services;

class AdressesService extends BaseService
{   
        public function get($idUser)
    {
        return $this->db->fetchAll("SELECT * FROM user_adresse where user = ?", array((int) $idUser));
    }

    function save($user_adresse)
    {
        $this->db->insert("user_adresse", $user_adresse);
        return $this->db->lastInsertId();
    }

    function update($id, $user_adresse)
    {
        return $this->db->update('user_adresse', $user_adresse, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("user_adresse", array("id" => $id));
    }

}

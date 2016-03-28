<?php

namespace App\Services;

class UsersService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM user");
    }
    
        public function get($id)
    {
        return $this->db->fetchAssoc("SELECT * FROM user where id = ?", array((int) $id));
    }

    function save($user)
    {
        $this->db->insert("user", $user);
        return $this->db->lastInsertId();
    }

    function update($id, $user)
    {
        return $this->db->update('user', $user, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("user", array("id" => $id));
    }

}

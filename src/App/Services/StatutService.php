<?php

namespace App\Services;

class StatutsService extends BaseService
{   
        public function get($idStatut)
    {
        return $this->db->fetchAssoc("SELECT * FROM statut where id = ?", array((int) $idStatut));
    }

    function save($statut)
    {
        $this->db->insert("statut", $statut);
        return $this->db->lastInsertId();
    }

    function update($id, $statut)
    {
        return $this->db->update('statut', $statut, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("statut", array("id" => $id));
    }

}

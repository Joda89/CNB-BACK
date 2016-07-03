<?php

namespace App\Services;

class LignesService extends BaseService
{   
        public function get($idLigne)
    {
        return $this->db->fetchAssoc("SELECT * FROM ligne_eau where id = ?", array((int) $idLigne));
    }

    function save($lignedEau)
    {
        $this->db->insert("ligne_eau", $lignedEau);
        return $this->db->lastInsertId();
    }

    function update($id, $lignedEau)
    {
        return $this->db->update('ligne_eau', $lignedEau, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("ligne_eau", array("id" => $id));
    }

}

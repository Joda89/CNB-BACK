<?php

namespace App\Services;

class SeancesService extends BaseService
{   
        public function get($idSeance)
    {
        return $this->db->fetchAssoc("SELECT * FROM seance where id = ?", array((int) $idSeance));
    }

    function save($seance)
    {
        $this->db->insert("seance", $seance);
        return $this->db->lastInsertId();
    }

    function update($id, $seance)
    {
        return $this->db->update('seance', $seance, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("seance", array("id" => $id));
    }

}

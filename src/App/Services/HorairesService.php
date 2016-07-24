<?php

namespace App\Services;

class HorairesService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM cour_horaire");
    }

    public function get($idCour)
    {
        return $this->db->fetchAssoc("SELECT * FROM cour_horaire where idTypeCour = ?", array((int) $idCour));
    }

    function save($cour_horaire)
    {
        $this->db->insert("cour_horaire", $cour_horaire);
        return $this->db->lastInsertId();
    }

    function update($id, $cour_horaire)
    {
        return $this->db->update('cour_horaire', $cour_horaire, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("cour_horaire", array("id" => $id));
    }

}

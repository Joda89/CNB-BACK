<?php

namespace App\Services;

class TypesService extends BaseService
{   
    public function get($idCour)
    {
        return $this->db->fetchAssoc("SELECT * FROM cour_type where id = ?", array((int) $idCour));
    }

    function save($courType)
    {
        $this->db->insert("cour_type", $courType);
        return $this->db->lastInsertId();
    }

    function update($id, $courType)
    {
        return $this->db->update('cour_type', $courType, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("cour_type", array("id" => $id));
    }

}

<?php

namespace App\Services;

class CoursService extends BaseService
{   
    
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM cour");
    }
    
    
    public function getByCoursHoraire($idCoursHoraire)
    {
        return $this->db->fetchAssoc("SELECT * FROM cour where idHoraireCour = ?", array((int) $idCoursHoraire));
    }
    
    public function getByUser($idUser)
    {
        return $this->db->fetchAssoc("SELECT * FROM cour where user = ?", array((int) $idUser));
    }

    function save($cour)
    {
        $this->db->insert("cour", $cour);
        return $this->db->lastInsertId();
    }

    function update($id, $cour)
    {
        return $this->db->update('cour', $cour, array('id' => $id));
    }

    function delete($id)
    {
        return $this->db->delete("cour", array("id" => $id));
    }

}

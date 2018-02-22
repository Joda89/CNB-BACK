<?php
/**
 * Created by IntelliJ IDEA.
 * User: mathieu
 * Date: 2/17/18
 * Time: 3:54 PM
 */

namespace App\Services;


class ConfigService extends BaseService
{

    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM config");
    }


    public function get($idConfig)
    {
        return $this->db->fetchAssoc("SELECT * FROM config where id = ?", array((int)$idConfig));
    }

    function save($config)
    {
        $this->db->insert("config", $config);
        return $this->db->lastInsertId();
    }

    function update($id, $config)
    {

        return $this->db->update('config', $config, array("id" => $id));
    }

    function delete($id)
    {
        return $this->db->delete("config", array("id" => $id));
    }
}
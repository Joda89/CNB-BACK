<?php

namespace App\Services;

class UpdateService extends BaseService
{
    
    public function recupererListeVersionAInstaller()
    {
        

    }
    
    public function testImport($file) {
        $this->db->import($file);
    }
}

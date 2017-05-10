<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Composer\Script\Event;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of installer
 *
 * @author joda
 */
class Installer {
    
    public static function postInstall(Event $event) {
        
        $app = array();
        require __DIR__ . '/../resources/config/prod.php';
        
        $mysql = new mysqli($app['db.options']['host'], $app['db.options']['user'], $app['db.options']['password'], $app['db.options']['dbname']);
        
        $sql = "SHOW TABLES FROM " .$app['db.options']['dbname'];
        $result = $mysql->query($sql);
        
        if($result->num_rows == 0) {
            $sqlSource = file_get_contents(__DIR__ . '/../resources/sql/full/cnb.sql');
            $mysql->multi_query($sqlSource);
        }
    }
    
    
    
}

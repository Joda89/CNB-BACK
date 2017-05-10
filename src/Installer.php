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
        
        $mysql = mysql_connect($app['db.options']['host'], $app['db.options']['user'], $app['db.options']['password']);
        if(!mysql_select_db($app['db.options']['dbname'])) {
            $sqlSource = file_get_contents(__DIR__ . '/../resources/sql/full/cnb.sql');
            mysqli_multi_query($mysql,$sqlSource);
        }
    }
    
    
    
}

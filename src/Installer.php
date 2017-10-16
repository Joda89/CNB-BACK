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
    
    public static function importSqlFile($host,$user,$pass,$dbname, $sql_file_OR_content){
	set_time_limit(3000);
	$SQL_CONTENT = (strlen($sql_file_OR_content) > 300 ?  $sql_file_OR_content : file_get_contents($sql_file_OR_content)  );  
	$allLines = explode("\n",$SQL_CONTENT); 
	$mysqli = new mysqli($host, $user, $pass, $dbname); 
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            
        } 
        $result = $mysqli->query('SET foreign_key_checks = 0');	        
        preg_match_all("/\nCREATE TABLE(.*?)\`(.*?)\`/si", "\n". $SQL_CONTENT, $target_tables); 
        foreach ($target_tables[2] as $table){
            $mysqli->query('DROP TABLE IF EXISTS '.$table);
            
        }       
        $result = $mysqli->query('SET foreign_key_checks = 1');    
        $mysqli->query("SET NAMES 'utf8'");	
	$templine = '';	// Temporary variable, used to store current query
	foreach ($allLines as $line)	{											// Loop through each line
		if (substr($line, 0, 2) != '--' && $line != '') {
                    $templine .= $line; 	// (if it is not a comment..) Add this line to the current segment
			if (substr(trim($line), -1, 1) == ';') {		// If it has a semicolon at the end, it's the end of the query
				if(!$mysqli->query($templine)){ 
                                    print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->error . '<br /><br />');  
                                    
                                }  $templine = ''; // set variable to empty, to start picking up the lines after ";"
			}
		}
	}	return 'Importing finished. Now, Delete the import file.';
}
    
    public static function postInstall(Event $event) {
        
        $app = array();
        require __DIR__ . '/../resources/config/prod.php';
        
        
        Installer::importSqlFile($app['db.options']['host'], $app['db.options']['user'], $app['db.options']['password'], $app['db.options']['dbname'], __DIR__ . '/../resources/sql/full/cnb.sql') ;
    }
    
    
    
}

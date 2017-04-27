<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbHelper
 *
 * @author Bruno
 */
class dbHelper {
    
    public function conecta(){
        $mongo = new Mongo();
        $db = $mongo->ColetorWeb;
        echo $mongo->admin->command(array("listDatabases" => 1));
    }
    
    
}

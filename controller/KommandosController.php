<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 12.06.2019
 * Time: 15:51
 */
require_once '../lib/Functions.php';
class KommandosController
{

    //ToDO Kommandos
    public function validierung(){
        $functions= new Functions();
        $kommando = htmlspecialchars( $_GET['kommando']);
        if(strcmp("ls",$kommando)==0){
        //$_SESSION['output']= shell_exec(escapeshellcmd($kommando));
          $_SESSION['output']='hat funktioniert';
            $InfoLog= "\n Kommando \n   User-Id: ".$_SESSION['uid']."\n   Kommando:".$kommando."\n Datum & Uhrzeit:".$functions->dateAndTime();
            file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
        }
        else{
            $InfoLog= "\n Unerlaubtes Kommando \n   User-Id: ".$_SESSION['uid']."\n   Kommando:".$kommando."\n Datum & Uhrzeit:".$functions->dateAndTime();
            file_put_contents("../lib/log.txt",$InfoLog,FILE_APPEND);
          $_SESSION['output']='Dieses Kommando ist nicht zugelassen.'.$kommando;
        }
    }


    public function index(){
        $view = new View("kommandos_index");
        $view->confirm = "";
        $view->title = "Kommandos";
        $view->menuTitle = "Kommandos";
        $view->heading = "Kommandos";
        $this->validierung();
     if(isset($_SESSION['output'])){
            $view->ergebnis=$_SESSION['output'];
            unset($_SESSION['output']);
        }
        $view->display();
    }
}
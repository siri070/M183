<?php

/*
 * Die index.php Datei ist der Einstiegspunkt des MVC. Hier werden zuerst alle
 * vom Framework benötigten Klassen geladen und danach wird die Anfrage dem
 * Dispatcher weitergegeben.
 *
 * Wie in der .htaccess Datei beschrieben, werden alle Anfragen, welche nicht
 * auf eine bestehende Datei zeigen hierhin umgeleitet.
 */
  session_start();

if(!isset($_SESSION['once'])){
    $_SESSION['once'] = "ausgefuehrt";
}

  // fix schf: approot für url
  $GLOBALS['appurl'] = '/M183/public';
  $GLOBALS['numAppurlFragments'] = 2;
$GLOBALS['teilurlnormal']="/normal";
$GLOBALS['urlAllUser']= "/AllUser/";

  require_once '../lib/Dispatcher.php';
  require_once '../lib/formbuilder/FormBuilder.php';
  require_once '../lib/View.php';
  require_once '../lib/Functions.php';

  $dispatcher = new Dispatcher();
  $dispatcher->dispatch();
?>
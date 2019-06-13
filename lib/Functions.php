<?php
  class Functions {
	public function displayErrors($errors, $function, $post) {
	  $_SESSION['errors'] = $errors;
	  $_SESSION['userData'] = $post;
      header("Location: ".$GLOBALS['appurl'].$function);
	}
	public function  dateAndTime(){
        date_default_timezone_set("Europe/Berlin");
        $timestamp = time();
	    $date=date("d.m.Y",$timestamp);
	    $time=date("H:i",$timestamp);
	    $dateAndTime= $date.", ".$time;
	    return $dateAndTime;
    }
  }
?>
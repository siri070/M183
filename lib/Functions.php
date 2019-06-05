<?php
  class Functions {
	public function displayErrors($errors, $function, $post) {
	  $_SESSION['errors'] = $errors;
	  $_SESSION['userData'] = $post;
      header("Location: ".$GLOBALS['appurl'].$function);
	}
  }
?>
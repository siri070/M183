<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
<!--
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->
    <link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=$GLOBALS['appurl']?>/css/style.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
      <script src="<?=$GLOBALS['appurl']?>/js/jquery.min.js"></script>
      <script src="<?=$GLOBALS['appurl']?>/js/bootstrap.min.js"></script>
      <script src="<?=$GLOBALS['appurl']?>/js/bootstrap-filestyle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Eigene CSS- und JavaScript-Dateien -->
    <link href="<?=$GLOBALS['appurl']?>/css/style.css" rel="stylesheet" />
	<script src="<?=$GLOBALS['appurl']?>/js/jscript.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

		  <?php
          if (isset($_SESSION['uid'])) {
              $uid = $_SESSION['uid']?>
              <li><a href="<?=$GLOBALS['appurl']?>/login/logout?uid=<?= $uid?>">Logout</a></li>
              <li><a href="<?=$GLOBALS['appurl']?>/login/userdata?uid=<?= $uid?>">Benutzerdaten</a></li>
              <li><a href="<?=$GLOBALS['appurl']?>/blog?uid=<?= $uid?>">Mein Blog</a></li>
              <?php } else { ?>
                  <li><a href="<?=$GLOBALS['appurl']?>/login">Login</a></li>
                  <li><a href="<?=$GLOBALS['appurl']?>/login/registration">Registration</a></li>
              <?php }

			?>
              <?php
              if ((isset($_GET['gid']) && $_GET['gid'] > 0)&&!isset($_GET['bid'])&&isset($_SESSION['uid'])){
                  $gid = $_GET['gid'];
                  $uid = $_SESSION['uid'];
                  ?>

                  <?php
              }
              if ((isset($_GET['bid']) && $_GET['bid'] > 0)&&(isset($_GET['gid']) && $_GET['gid'] > 0)&&isset($_SESSION['uid'])){
                  $gid = $_GET['gid'];
                  $uid = $_SESSION['uid'];
                  ?>

                  <?php
              }?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container nav_gap">
    <h3><?= $heading ?></h3>
        <div class="list-group" id="alert-container">
            <?php
            if(isset($_SESSION['errors'])){
                $values = $_SESSION['errors'];
                if (is_array($values) || is_object($values))
                {
                    foreach ($_SESSION['errors'] as $error) {
                        echo "<div class='alert alert-danger'>";
                        echo "$error<br>";
                        echo "</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>";
                    echo $_SESSION['errors'];
                    echo "</div>";
                }
                unset($_SESSION['errors']);
            }
            if(isset($_SESSION['accompolishment']))
            {
                echo "<div class='alert alert-success' role='alert'>";
                echo $_SESSION['accompolishment'];
                echo "</div>";
                unset($_SESSION['accompolishment']);
            }
            ?>
        </div>
        <script>
            $(document).ready(function(){
                    $(".alert").fadeToggle(5000);
            });
        </script>

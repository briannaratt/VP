<?php
  session_start();
  
  //kui pole sisseloginud
  if(!isset($_SESSION["userid"])){
	  //jõugu sisselogimise lehele
	  header("Location: page.php");
  }
  //väljalogimine
  if(isset($_GET["logout"])){
	  session_destroy();
	   header("Location: page.php");
	   exit();
  }

require("../../../config.php");
//kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
//$database = "if20_brianna_3";
require("fnc_film.php");

//$username = "Brianna Ratt";
 require("header.php");

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  
 <ul>
  <li><a href="home.php">Avalehele<a/></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
 </ul>
 
 <hr>
 <?php echo readfilms(); ?>

</body>
</html>
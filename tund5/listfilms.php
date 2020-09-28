<?php
require("../../../config.php");
//$database = "if20_brianna_3";

$username = "Brianna Ratt";
 require("header.php");
 require("fnc_film.php");

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  
 <ul>
  <li><a href="home3.php">Avalehele<a/></li>
 </ul>
 
 <hr>
 <?php echo readfilms(); ?>

</body>
</html>
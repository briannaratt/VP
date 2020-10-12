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

 //loeme andmebaasi login ifo muutujad
 require("../../../../config_vp2020.php");
 //kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
 $database = "if20_brianna_3";
 
//loeme andmebaasist
$nonsensehtml = "";
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
$stmt = $conn->prepare("SELECT nonsenseidea FROM nonsense");
echo $conn->error;
$stmt->bind_result($nonsensefromdb);
$stmt->execute();
while($stmt->fetch()){
	$nonsensehtml .= "<p>" .$nonsensefromdb ."</p>";
}
	$stmt->close();
	$conn->close();
//var_dump($_POST);

require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>

  <ul>
    <li><a href="home.php">Avalehele</a></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
  </ul>
  
<p>Seni on sisestatud mõtted:</p>
<hr>
<?php echo $nonsensehtml; ?>

</body>
</html>
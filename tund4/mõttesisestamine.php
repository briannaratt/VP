<?php require("header.php"); ?>
<?php
require("../../../config.php");
$database = "if20_brianna_3";
$username = "Brianna Ratt";

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

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>

  <hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte!</label>
  <input type="text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>
 <ul>
  <li><a href="home3.php">Avalehele<a/></li>
 </ul>
  
</body>
</html>
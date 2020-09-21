<?php require("header.php"); ?>
<?php
require("../../../config.php");
$database = "if20_brianna_3";
if(isset($_POST["submitnonsense"])){
	if(!empty($_POST["nonsense"])){
		//andmebaasi lisamine
		//loome andmebaasi ühenduse
		$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
		//valmistame ette SQL käsu
		$stmt = $conn->prepare("INSERT INTO nonsense (nonsenseidea) VALUES(?)");
		echo $conn->error;
		//s - string/tekst, i- integer , d-decimal
		$stmt->bind_param("s", $_POST["nonsense"]);
		$stmt->execute();
		//käsk ja ühendus kinni
		$stmt->close();
		$conn->close();
	}
}

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
var_dump($_POST);

?>

  <hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte!</label>
  <input type="text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>
  <a href="home3.php">Tagasi avalehele</a>
  
</body>
</html>
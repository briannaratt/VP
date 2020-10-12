<?php
session_start();

//kui pole sisse loginud
if(!isset($_SESSION["userid"])){
	//jõugu sisselogimine lehele
	header("Location: page.php");
}
//väljalogimine
if(isset($_GET["logout"])){
	session_destroy();
	header("Location: page.php");
	exit();
}

require("../../../config.php");
//$database = "if20_brianna_3";

$username = "Brianna Ratt";
 require("header.php");
 require("fnc_film.php");
 //kui klikiti nuppu, siis kontrollime ja salvestame
 $inputerror = "";
 //$title = "";
 if(isset($_POST["filmsubmit"])){
	 //$title = $_POST["titleinput"]; , value= php echo $titleinput jne
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
	 $inputerror= "Osa vajalikku infot on sisestamata! ";
	}
	if($_POST["yearinput"] > date ("Y") or ($_POST["yearinput"] < 1895)){
		$inputerror.= "Ebareaalne valmimisaasta.";
	}
	if(empty($inputerror)){
		writefilm($_POST["titleinput"], $_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
}

?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  
 <ul>
  <li><a href="home3.php">Avalehele<a/></li>
	<li><a href="?logout=1">Logi välja</a>!</li>
 </ul>
 <hr>
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label for="titleinput">Filmi pealkiri: </label>
	<input type="text" name="titleinput" id="titleinput" placeholder="pealkiri"><span> Pealkiri on sisestamata</span>
	<br>
	<label for="yearinput">Filmi valmimisaasta: </label>
	<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
	<br>
	<label for="durationinput">Filmi kestus minutites: </label>
	<input type="number" name="durationinput" id="durationinput" placeholder="80">
	<br>
	<label for="genreinput">Filmi žanr: </label>
	<input type="text" name="genreinput" id="genreinput" placeholder="žanr">
	<br>
	<label for="studioinput">Filmi tootja: </label>
	<input type="text" name="studioinput" id="studioinput" placeholder="tootja">
	<br>
	<label for="directorinput">Filmi lavastaja: </label>
	<input type="text" name="directorinput" id="directorinput" placeholder="lavastaja">
	<br>
	<input type="submit" name="filmsubmit" value="Salvestab filmiinfo">
	
 </form>
 <p><?php echo $inputerror; ?></p>

</body>
</html>
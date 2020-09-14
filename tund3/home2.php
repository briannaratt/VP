<?php
//loeme andmebaasi login info muutujad
require("../../../config.php");
//kui kasutaja on vormis andmeid saatnud, siis salvestame andmebaasi
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
//valmistame ette SQL käsu
$stmt = $conn->prepare("SELECT nonsenseidea FROM nonsense");
echo $conn->error;
//seome tulemuse mingi muutujaga
$stmt->bind_result($nonsensefromdb);
$stmt->execute();
//võtan, kuni on
while($stmt->fetch()){
	//<p> teeme iga nonsensei jaoks elemendi </p>
	$nonsensehtml .= "<p>" .$nonsensefromdb ."</p>";
}
	$stmt->close();
	$conn->close();
	//ongi andmebaasist loetud


 $username = "Brianna Ratt";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "lihtsalt aeg";
 
 //vaatame, mida vormist serverile saadetakse
 var_dump($_POST);
 
 $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
 $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni",
 "juuli", "august", "september", "oktoober", "november", "detsember"];
 
 //küsime nädalapäeva
 $weekdaynow = date("N");
 //echo $weekdaynow;
 
 if($hournow < 6){
	 $partofday = "uneaeg";
 }
 if($hournow >= 6 and $hournow < 8) {
	 $partofday = "hommikuste protseduuride aeg";
 }
 if($hournow >= 8 and $hournow < 18) {
	 $partofday = "õppimise aeg";
 }
 if($hournow >= 19 and $hournow < 21) {
	 $partofday = "puhkamise aeg";
 }
 if($hournow > 21) {
	 $partofday = "uneaeg";
 }
 
 //jälgime semestri kulgu
 $semesterstart = new DateTime("2020-8-31");
 $semesterend = new DateTime("2020-12-13");
 $semesterduration = $semesterstart->diff($semesterend);
 $semesterdurationdays = $semesterduration->format("%r%a");
 $today = new DateTime("now");
 $fromsemesterstart = $semesterstart->diff($today);
 //saime aja erinevuse objektina, seda niisama näidata ei saa
 $fromsemesterstartdays = $fromsemesterstart->format("%r%a");
 $alltimesemester = $semesterstart->diff($semesterend);
 $alltimesemesterdays = $alltimesemester->format("%r%a");
 $dayspercentage = round($fromsemesterstartdays / $alltimesemesterdays * 100);
 
 //loen kataloogist piltide nimekirja
 //$allfiles = scandir("../vp_pics/"); OLI ENNE
 $allfiles = array_slice(scandir("../vp_pics/"), 2);
 //echo $allfiles; //massiivi nii näidata ei saa
 //var_dump($allfiles);
 //$allpicfiles = array_slice($allfiles, 2); OLI ENNE
 //var_dump($allpicfiles);
 $allpicfiles = [];
 $picfiletypes = ["image/jpeg", "image/png"];
 //käin kogu massiivi läbi ja kontrollin iga üksikut elementi, kas on sobiv fail ehk pilt
 foreach ($allfiles as $file){
	 $fileinfo = getImagesize("../vp_pics/" .$file);
	 if (in_array($fileinfo["mime"], $picfiletypes) == true){
		array_push($allpicfiles, $file);
	 }
 }
 //paneme kõik pildid järjest ekraanile
 //uurime, mitu pilti on ehk mitu faili on nimekirjas - massiivis
 $piccount = count($allpicfiles);
 //echo $piccount;
 //$i = $1 + 1;
 //$1 ++; (lühem kirjaviis, tähendab sama mis i+1)
 //$i += 1; (lühem kirjaviis, tähendab sama mis i+1)
 //algab nullist peale, peab jääma väiksemaks kui piltide arv ja kasvab, tsüklil peab lõpp olema
 $imghtml = "";
 for($i = 0; $i < $piccount; $i ++){
	 //<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
	 $imghtml .= '<img src="../vp_pics/' .$allpicfiles[$i] .'" ';
	 $imghtml .= 'alt="Tallinna Ülikool">';
 }
 
 require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  <p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1] .", " . $fulltimenow .". Semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?>.
  <?php echo "Parajasti on " .$partofday ."."; ?></p>
  <p>Semestri kestus päevades: <?php echo $alltimesemesterdays; ?></p>
  <p>Semestrist on läbitud <?php echo $dayspercentage; ?> %!</p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <form method="POST">
  <label>Sisesta oma tänane mõttetu mõte!</label>
  <input type="text" name="nonsense" placeholder="mõttekoht">
  <input type="submit" value="Saada ära!" name="submitnonsense">
  </form>
  <hr>
  <?php echo $nonsensehtml; ?>
  
</body>
</html>

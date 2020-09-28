<?php

 $username = "Brianna Ratt";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "lihtsalt aeg";
 $daynrnow = date("j");
 $yearnow = date("o");
 $timenow = date("H:i:s");
 
 $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
 $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni",
 "juuli", "august", "september", "oktoober", "november", "detsember"];
 
 //küsime nädalapäeva
 $weekdaynow = date("N");
 $monthnow = date("F");
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
/*  for($i = 0; $i < $piccount; $i ++){
	 //<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
	 $imghtml .= '<img src="../vp_pics/' .$allpicfiles[$i] .'" ';
	 $imghtml .= 'alt="Tallinna Ülikool">';
 } */
 $imghtml.= '<img src="../vp_pics/' .$allpicfiles[mt_rand(0,$piccount - 1)] .'" ';
 $imghtml .= 'alt="Tallinna Ülikool">';
 
 require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  <p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1]. ", ". $daynrnow .". ". $monthnow ." ". $yearnow . ", kell ". $timenow. "."; ?></p>
  <?php echo "Semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?></p>
  <?php echo "Parajasti on " .$partofday ."."; ?></p>
  <p>Semestri kestus päevades: <?php echo $alltimesemesterdays; ?></p>
  <p>Semestrist on läbitud <?php echo $dayspercentage; ?> %!</p>
  <hr>
  <br>
  <p>Loo omale <a href="addnewuser.php">kasutajakonto</a>!</p>
  <hr>
  <?php echo $imghtml; ?>
  
  
 <ul>
  <li><a href="mõttesisestamine.php">Mõtete lisamine</a></li>
  <li><a href="sisestatudmõtted.php">Lisatud mõtted</a></li>
  <li><a href="listfilms.php"> Filmiinfo näitamine</a></li>
  <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
 </ul>
  
</body>
</html>

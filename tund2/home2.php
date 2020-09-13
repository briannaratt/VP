<?php
 $username = "Brianna Ratt";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "lihtsalt aeg";
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
 $dayspercentage = round($fromsemesterstartdays / $alltimesemesterdays * 100)
 
?>

<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title>Veebileht</title>

</head>
<body>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?> programmeerib veebi</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis<p>
  <p>Lehe avamise aeg: <?php echo $fulltimenow .", semestri algusest on möödunud " .$fromsemesterstartdays ." päeva"; ?>.
  <?php echo "Parajasti on " .$partofday ."."; ?></p>
  <p>Semestri kestus päevades: <?php echo $alltimesemesterdays; ?></p>
  <p>Semestrist on läbitud <?php echo $dayspercentage; ?> %!</p>
  
</body>
</html>




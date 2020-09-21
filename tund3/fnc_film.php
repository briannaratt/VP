<?php
$database = "if20_brianna_3";
//var_dump($GLOBALS);
function readfilms(){
		//loeme andmebaasist
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	$stmt = $conn->prepare("SELECT * FROM film");
	echo $conn->error;
	$stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
	$stmt->execute();
	$filmshtml = "\t <ol> \n";
	while($stmt->fetch()){
		$filmshtml .= "\t \t <li>" .$titlefromdb ."\n";
		$filmshtml .= "\t \t \t <ul> \n";
		$filmshtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Kestus: " .$durationfromdb ." minutit</li> \n";
		$filmshtml .= "\t \t \t \t <li>Žanr: " .$genrefromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Tootja/Stuudio: " .$studiofromdb ."</li> \n";
		$filmshtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
		$filmshtml .= "\t \t \t </ul> \n";
		$filmshtml .= "\t \t </li> \n";
	}
	$filmshtml.="\t </ol> \n";

		$stmt->close();
		$conn->close();
		return $filmshtml;
	
}//readfilms lõppeb
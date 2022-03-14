<?php
// Read the variables sent via POST from our API
$sessionId   ;
$serviceCode ;
$phoneNumber ;
$text      =""  ;
if(isset($_POST["sessionId"])){
	$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
}
$vaccin = array();
$vaccin[]='Astrazeneca';
$vaccin[]='coviShield';
$vaccin[]='janssen';
$vaccin[]='pfizer';

$centre= array();
$centre[]='stade Mahamasina';
$centre[]='institut pasteur';
$centre[]='csb2 Analakely';
$centre[]='HJRA';

if ($text == "") {
    // This is the first request. Note how we start the response with CON
    $response  = "Bienvenue, comment peut-on vous aider \n";
    $response .= "1. Statistique \n";
    $response .= "2. se faire vacciner";

 } else if ($text == "1") {
    // Business logic for first level response
    $response = " nombre de vaccinne 300 \n";
    $response .= "nombre de guerie 15 \n";
    $response .= "nombre de mort 16 \n";

} else if ($text == "2") {
    // Business logic for first level response
    // This is a terminal request. Note how we start the response with END
	$response = " liste des vaccins disponible \n";
	for($i=0;$i<count($vaccin);$i++){
		$response .= "".($i+1).".".$vaccin[$i]."\n";
	}
    // $response = "1. Astrazeneca \n";
    // $response .= "2. coviShield  \n";
    // $response .= "3. janssen \n";
    // $response .= "4. pfizer  \n";

} else if($text == "2*1" || $text == "2*2" || $text == "2*3" || $text == "2*4") { 
	$vac = explode(".",$test)[1];
    // This is a second level response where the user selected 1 in the first instance
    $accountNumber  = "ACC1001";

    // This is a terminal request. Note how we start the response with END
    $response = "les centre fournissant le vaccin ".$vaccin[$vac]." \n";
	for($i=0;$i<count($centre);$i++){
		$response .= "".($i+1).".".$centre[$i]."\n";
	}
	// $response = "1. stade Mahamasina \n";
    // $response .= "2. institut pasteur \n";
    // $response .= "4. csb2 Analakely \n";
    // $response .= "5. HJRA \n";

}else if(count($text) == 5){
	$vac = explode(".",$test)[1]-1;
	$cen= explode("*",$text)[2]-1;
	$response = "vous avez fait une reservation pour le vaccin ".$vaccin[$vac]." dans le centre ".$centre[$cen]." \n";
}

// // Echo the response back to the API
header('Content-type: text/plain');
echo $response;
?>
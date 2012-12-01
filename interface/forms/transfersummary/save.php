<?php
// Copyright (C) 2012-2013 Naina Mohamed <naina@capminds.com> CapMinds Technologies
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
foreach ($_POST as $k => $var) {
$_POST[$k] = mysql_escape_string($var);
echo "$var\n";
}
if ($encounter == "")
$encounter = date("Ymd");
if ($_GET["mode"] == "new"){
$newid = formSubmit("form_transfersummary", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Transfer Summary", $newid, "transfersummary", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update form_transfersummary set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(),		  			  
  provider	='".$_POST["provider"]."',				  
  transfer_to		='".$_POST["transfer_to"]."',								
  transfer_date		='".$_POST["transfer_date"]."',							
  status_of_admission	='".$_POST["status_of_admission"]."',		
  diagnosis_diagnses 		='".$_POST["diagnosis_diagnses"]."',		
  intervention_provided		='".$_POST["intervention_provided"]."',	
  overall_status_of_discharge 		='".$_POST["overall_status_of_discharge"]."'		
 		
  where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>

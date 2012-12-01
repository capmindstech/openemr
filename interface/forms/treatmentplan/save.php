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
$newid = formSubmit("form_treatmentplan", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "Treatment plan Form", $newid, "treatmentplan", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update form_treatmentplan set pid = {$_SESSION["pid"]},groupname='".$_SESSION["authProvider"]."',user='".$_SESSION["authUser"]."',authorized=$userauthorized,activity=1, date = NOW(),  				  
  provider	='".$_POST["provider"]."',				 
  admit_date 	='".$_POST["admit_date"]."',
  presenting_issues 		='".$_POST["presenting_issues"]."',
  patient_history 		='".$_POST["patient_history"]."',
  medications 		='".$_POST["medications"]."',
  anyother_relevant_information 		='".$_POST["anyother_relevant_information"]."',
  diagnosis 		='".$_POST["diagnosis"]."',
  treatment_received 		='".$_POST["treatment_received"]."',
  recommendation_for_follow_up 		='".$_POST["recommendation_for_follow_up"]."'  
 where id=$id");
}
$_SESSION["encounter"] = $encounter;
formHeader("Redirecting....");
formJump();
formFooter();
?>

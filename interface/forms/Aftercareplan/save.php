<?php
// Copyright (C) 2012-2013 Naina Mohamed <naina@capminds.com> CapMinds Technologies
 
include_once("../../globals.php");
include_once("$srcdir/api.inc");
include_once("$srcdir/forms.inc");
require_once("$srcdir/htmlspecialchars.inc.php");
require_once("$srcdir/formdata.inc.php");

foreach ($_POST as $k => $var) {
$_POST[$k]= mysql_escape_string($var);
echo "$var\n";
}
if (attr($encounter) == "")
$encounter = date("Ymd");
if($_GET["mode"] == "new"){
$newid = formSubmit("form_aftercareplan", $_POST, $_GET["id"], $userauthorized);
addForm($encounter, "AfterCare Plan Form", $newid, "aftercareplan", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlInsert("update form_aftercareplan set pid = {$_SESSION["pid"]},groupname='".add_escape_custom($_SESSION["authProvider"])."',user='".add_escape_custom($_SESSION["authUser"])."',authorized=$userauthorized,activity=1, date = NOW(),	  				  
  provider	='".add_escape_custom($_POST["provider"])."',
  admit_date 		='".add_escape_custom($_POST["admit_date"])."',
  discharged 		='".add_escape_custom($_POST["discharged"])."',
  goal_a_acute_intoxication 		='".add_escape_custom($_POST["goal_a_acute_intoxication"])."',
  goal_a_acute_intoxication_I 		='".add_escape_custom($_POST["goal_a_acute_intoxication_I"])."',
  goal_a_acute_intoxication_II 		='".add_escape_custom($_POST["goal_a_acute_intoxication_II"])."',
  goal_b_emotional_behavioral_conditions 		='".add_escape_custom($_POST["goal_b_emotional_behavioral_conditions"])."',
  goal_b_emotional_behavioral_conditions_I 		='".add_escape_custom($_POST["goal_b_emotional_behavioral_conditions_I"])."',
  goal_c_relapse_potential 		='".add_escape_custom($_POST["goal_c_relapse_potential"])."',
  goal_c_relapse_potential_I 		='".add_escape_custom($_POST["goal_c_relapse_potential_I"])."'  
  
  where id=$id");
 
}
$_SESSION["encounter"] = attr($encounter);
formHeader("Redirecting....");
formJump();
formFooter();
?>

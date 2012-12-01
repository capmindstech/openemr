<?php
// Copyright (C) 2012-2013 Naina Mohamed <naina@capminds.com> CapMinds Technologies
 
//SANITIZE ALL ESCAPES
$sanitize_all_escapes=true;

//STOP FAKE REGISTER GLOBALS
$fake_register_globals=false;

include_once("../../globals.php");
include_once("$srcdir/api.inc");
require_once("$srcdir/patient.inc");
require_once("$srcdir/options.inc.php");
require_once("$srcdir/htmlspecialchars.inc.php");
formHeader("Form:AfterCare Planning");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

?>
<html>
<head>
<?php html_header_show();?>
<script type="text/javascript" src="../../../library/dialog.js"></script>
<!-- pop up calendar -->
<style type="text/css">@import url(<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.css);</style>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar_setup.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dialog.js"></script>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
</head>
<body class="body_top">
<p><span class="forms-title"><?php echo xlt('AfterCare Planning'); ?></span></p>
</br>
<form method=post  action="<?php echo attr($rootdir);?>/forms/Aftercareplan/save.php?mode=new">
<table  border="0">
<tr>
<td align="left" class="forms" class="forms"><?php echo xlt('Client Name' ); ?>:</td>
		<td class="forms">
			<label class="forms-data"> <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "fname,lname,squad");
   echo htmlspecialchars(xlt('','','','').text($result['fname'])." ".text($result['lname']));}
   $patient_name=text($result['fname'])." ".text($result['lname']);
   ?>
   </label>
   <input type="hidden" name="client_name" value="<?php echo attr($patient_name);?>">
		</td>
		<td align="left"  class="forms"><?php echo xlt('DOB'); ?>:</td>
		<td class="forms">
		<label class="forms-data"> <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "*");
   echo htmlspecialchars( xlt('','','','') . text($result['DOB']));}
   $dob=text($result['DOB']);
   ?>
   </label>
     <input type="hidden" name="DOB" value="<?php echo attr($dob);?>">
		</td>
		</tr>
<tr>
	
		
  <td align="left" class="forms"><?php echo xlt('Admit Date','e'); ?>:</td>
  
		<td class="forms">
			   <input type='text' size='10' name='admit_date' id='admission_date' <?php echo attr($disabled) ?>;
       value='<?php echo attr($viewmode) ? substr($result['date'], 0, 10) : date('Y-m-d'); ?>'
       title='<?php xla('yyyy-mm-dd Date of service','e'); ?>'
       onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
        <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
        id='img_admission_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
        title='<?php xla('Click here to choose a date','e'); ?>'>
		</td>
	
	
		<td align="left"  class="forms"><?php echo xlt('Discharged','e'); ?>:</td>
		<td class="forms">
			   <input type='text' size='10' name='discharged' id='discharge_date' <?php echo attr($disabled)?>;
       value='<?php echo attr($viewmode) ? substr($result['date'], 0, 10) : date('Y-m-d'); ?>'
       title='<?php xla('yyyy-mm-dd Date of service','e'); ?>'
       onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
        <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
        id='img_discharge_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
        title='<?php xla('Click here to choose a date','e'); ?>'>
		</td>
	</tr>
	<tr>
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		
		<td class="forms-subtitle" colspan="4" class="forms-subtitle"><B><?php echo xlt('Goal and Methods');?></B></td>
		
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		
		<td colspan="4"  class="forms-subtitle"><B><?php echo xlt('Goal A');?>:&nbsp;<?php echo xlt('Acute Intoxication/Withdrawal'); ?></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">1.</td>
		<td colspan="3"><textarea name="goal_a_acute_intoxication" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">2.</td>
		<td colspan="3"><textarea name="goal_a_acute_intoxication_I" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">3.</td>
		<td colspan="3"><textarea name="goal_a_acute_intoxication_II" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	
	<tr>
		
		<td colspan="4" class="forms-subtitle"><B><?php echo xlt('Goal B');?>:</B>&nbsp;<?php echo xlt('Emotional / Behavioral Conditions & Complications'); ?></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">1.</td>
		<td colspan="3"><textarea name="goal_b_emotional_behavioral_conditions" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">2.</td>
		<td colspan="3"><textarea name="goal_b_emotional_behavioral_conditions_I" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	
		
		<td colspan="4" class="forms-subtitle"><B><?php echo xlt('Goal C'); ?>:</B>&nbsp;<?php echo xlt('Relapse Potential'); ?></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">1.</td>
		<td colspan="3"><textarea name="goal_c_relapse_potential" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="right" class="forms">2.</td>
		<td colspan="3"><textarea name="goal_c_relapse_potential_I" rows="2" cols="80" wrap="virtual name"></textarea></td>
		
	</tr>
	
<tr>
</tr>	
	<tr>
		<td></td>
    <td>
    <input type='submit'  value='<?php echo xla('Save','e');?>'class="button-css">&nbsp;
	<input type='button' class="button-css" value='<?php echo xla('Cancel','e');?>'
 onclick="top.restoreSession();location='<?php echo "$rootdir/patient_file/encounter/$returnurl" ?>'" /></td>
	</tr>
</table>
</form>
<script language="javascript">
/* required for popup calendar */
Calendar.setup({inputField:"admission_date", ifFormat:"%Y-%m-%d", button:"img_admission_date"});
Calendar.setup({inputField:"discharge_date", ifFormat:"%Y-%m-%d", button:"img_discharge_date"});
</script>
<?php
formFooter();
?>

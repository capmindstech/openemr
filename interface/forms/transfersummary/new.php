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
formHeader("Form:Transfer Summary");
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
<p><span class="forms-title">Transfer Summary</span></p>
</br>
<form method=post   action="<?php echo $rootdir;?>/forms/transfersummary/save.php?mode=new">
<table  border="0">
	<tr>
		<td align="left" class="forms"><?php xl('Client Name','e'); ?>:</td>
		<td class="forms">
			<label class="forms-data"> <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "fname,lname,squad");
   echo htmlspecialchars(xl('','','','').$result['fname']." ".$result['lname']);}
   $patient_name=$result['fname']." ".$result['lname'];
   ?>
   </label>
   <input type="hidden" name="client_name" value="<?php echo $patient_name;?>">
		
		<td align="left" class="forms" ><?php xl('DOB','e'); ?>:</td>
		<td class="forms">
		<label class="forms-data"> <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "*");
   echo htmlspecialchars( xl('','','','') . $result['DOB']  );}
   $dob=$result['DOB'];
   ?>
   </label>
     <input type="hidden" name="DOB" value="<?php echo $dob;?>">
		</td>
	</tr>
	<tr>
	
		<td align="left" class="forms"><?php xl('Transfer to','e'); ?>:</td>
		 <td class="forms">
		 <input type="text" name="transfer_to" id="transfer_to" value=""></td>
		
		<td align="left" class="forms"><?php xl('Transfer date','e'); ?>:</td>
	   	<td class="forms">
			   <input type='text' size='10' name='Transfer_date' id='transfer_date' <?php echo $disabled ?>;
       value='<?php echo $viewmode ? substr($result['date'], 0, 10) : date('Y-m-d'); ?>'
       title='<?php xl('yyyy-mm-dd Date of service','e'); ?>'
       onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
        <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
        id='img_transfer_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
        title='<?php xl('Click here to choose a date','e'); ?>'>
		</td>
	
	   </tr>
	
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Status Of Admission','e'); ?>:</b></td>
		<td colspan="3"><textarea name="status_of_admission" rows="3" cols="60" wrap="virtual name"></textarea></td>
		
	
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Diagnosis / Diagnses','e'); ?>:</b></td>
		<td colspan="3"><textarea name="diagnosis_diagnses" rows="3" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Intervention Provided','e'); ?>:</b></td>
		<td colspan="3"><textarea name="intervention_provided" rows="3" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Overall Status Of Discharge','e'); ?>:</b></td>
		<td colspan="3"><textarea name="overall_status_of_discharge" rows="3" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	

	<tr>
		<td></td>
   <td><input type='submit'  value="Save" class="button-css">&nbsp;
	<input type='button' class="button-css" value='<?php xl('Cancel','e');?>'
 onclick="top.restoreSession();location='<?php echo "$rootdir/patient_file/encounter/$returnurl" ?>'" /></td>
 <td></td>
		<td></td>
		<td></td>
	</tr>
</table>
</form>
<script language="javascript">
/* required for popup calendar */
Calendar.setup({inputField:"transfer_date", ifFormat:"%Y-%m-%d", button:"img_transfer_date"});

</script>
<?php
formFooter();
?>

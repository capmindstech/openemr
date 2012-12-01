<?php
// Copyright (C) 2012-2013 Naina Mohamed <naina@capminds.com> CapMinds Technologies

//SANITIZE ALL ESCAPES
 $sanitize_all_escapes=true;

 //STOP FAKE REGISTER GLOBALS
 $fake_register_globals=false;
 
include_once("../../globals.php");
require_once("$srcdir/options.inc.php");
include_once("$srcdir/api.inc");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

?>
<html><head>
<?php html_header_show();?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<!-- pop up calendar -->
<style type="text/css">@import url(<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.css);</style>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar.js"></script>
<?php include_once("{$GLOBALS['srcdir']}/dynarch_calendar_en.inc.php"); ?>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/dynarch_calendar_setup.js"></script>
</head>
<body class="body_top">
<?php
$obj = formFetch("form_transfersummary", $_GET["id"]);
?>
<p><span class="forms-title">Transfer Summary</span></p>
</br>

<form method=post action="<?php echo $rootdir?>/forms/transfersummary/save.php?mode=update&id=<?php echo $_GET["id"];?>">
<table  border="0">

	<tr>

		<td align="left" class="forms"><?php xl('Client Name','e'); ?>:</td>
		<td class="forms"><label class="forms-data"><?php echo stripslashes($obj{"client_name"});?></label></td>
		<td align="left" class="forms"><?php xl('DOB','e'); ?>:</td>
		<td class="forms" ><label class="forms-data"><?php echo stripslashes($obj{"DOB"});?></label></td>
	</tr>
	<tr>
	
	<td align="left" class="forms"><?php xl('Transfer to','e'); ?>:</td>
	
	 <td class="forms">
		 <input type="text" name="transfer_to" id="transfer_to" value="<?php echo stripslashes($obj{"transfer_to"});?>"></td>
		 
		<td align="left" class="forms"><?php xl('Transfer date','e'); ?>:</td>
	   	<td class="forms">
			   <input type='text' size='10' name='transfer_date' id='transfer_date' <?php echo $disabled ?>;
       value='<?php echo stripslashes($obj{"transfer_date"}); ?>' 
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
		<td colspan="3"><textarea name="status_of_admission" rows="3" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"status_of_admission"});?></textarea></td>
		</tr>
		<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Diagnosis / Diagnses','e'); ?>:</b></td>
		<td colspan="3"><textarea name="diagnosis_diagnses" rows="3" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"diagnosis_diagnses"});?></textarea></td>
			</tr>
			<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Intervention Provided','e'); ?>:</b></td>
		<td colspan="3"><textarea name="intervention_provided" rows="3" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"intervention_provided"});?></textarea></td>
	</tr>
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><b><?php xl('Overall Status Of Discharge','e'); ?>:</b></td>
		<td colspan="3"><textarea name="overall_status_of_discharge" rows="3" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"overall_status_of_discharge"});?></textarea></td>
	</tr>
	
<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td></td>
    <td><input type='submit'  value="Save" class="button-css">&nbsp;
	
	<input type='button' class="button-css" value='<?php xl('Cancel','e');?>'
 onclick="top.restoreSession();location='<?php echo "$rootdir/patient_file/encounter/$returnurl" ?>'" />
 <input type='button'  value="Print" onclick="window.print()" class="button-css">&nbsp;
 </td>
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

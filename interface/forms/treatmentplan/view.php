<?php
// Copyright (C) 2012-2013 Naina Mohamed <naina@capminds.com> CapMinds Technologies
//SANITIZE ALL ESCAPES
 $sanitize_all_escapes=true;

 //STOP FAKE REGISTER GLOBALS
 $fake_register_globals=false;
 
include_once("../../globals.php");
require_once("$srcdir/options.inc.php");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

// Get the providers list.
 $ures = sqlStatement("SELECT id, username, fname, lname FROM users WHERE " .
  "authorized != 0 AND active = 1 ORDER BY lname, fname");
?>
<html><head>
<?php html_header_show();?>
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
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
<?php
include_once("$srcdir/api.inc");
$obj = formFetch("form_treatmentplan", $_GET["id"]);
?>
<p><span class="forms-title">Treatment Planning</span></p>
</br>

<form method=post  action="<?php echo $rootdir?>/forms/treatmentplan/save.php?mode=update&id=<?php echo $_GET["id"];?>">
<table  border="0">
	<tr>
		<td align="left" class="forms"><?php xl('Client Name','e'); ?>:</td>
		<td class="forms">
			<label class="forms-data"><?php  echo stripslashes($obj{"client_name"});?> </label>
		</td>
	<td align="left" class="forms"><?php xl('DOB','e'); ?>:</td>
		<td class="forms" >
		<label class="forms-data"><?php echo stripslashes($obj{"DOB"});?></label>
		</td>
	</tr>
	<tr>
			<td align="left" class="forms"><?php xl('Client Number','e'); ?>:</td>
		<td class="forms">
			<label class="forms-data"><?php echo stripslashes($obj{"client_number"});?></label>
		</td>

		<td align="left" class="forms"><?php xl('Admit Date','e'); ?>:</td>
		<td class="forms">
			   <input type='text' size='10' name='admit_date' id='admission_date' <?php echo $disabled ?>; value='<?php echo stripslashes($obj{"admit_date"}); ?>'   title='<?php xl('yyyy-mm-dd Date of service','e'); ?>'
       onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
        <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
        id='img_admission_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
        title='<?php xl('Click here to choose a date','e'); ?>'>
		</td> 
		
		</tr>
		<tr>
		<td align="left" class="forms"><?php xl('Provider','e'); ?>:</td>
		 <td class="forms" width="280px">
 <?php

    echo "<select name='provider' style='width:60%' />";
    while ($urow = sqlFetchArray($ures)) {
      echo "    <option value='" . $urow['lname'] . "'";
      if ($urow['lname'] == stripslashes($obj{"provider"})) echo " selected";
      echo ">" . $urow['lname'];
      if ($urow['fname']) echo ", " . $urow['fname'];
      echo "</option>\n";
    }
    echo "</select>";
?>
		</td>
			
		</tr>
	
	<tr>
	
  <td colspan='3' nowrap style='font-size:8pt'>
   &nbsp;
	</td>
	</tr>
		
	<tr>
		<td align="left" class="forms"><?php xl('Presenting Issue(s)','e'); ?>:</td>
		<td colspan="3"><textarea name="presenting_issues" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"presenting_issues"});?></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Patient History','e'); ?>:</td>
		<td colspan="3"><textarea name="patient_history" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"patient_history"});?></textarea></td>
		
	</tr>
	<tr>
		
		<td align="left" class="forms"><?php xl('Medications','e'); ?>:</td>
		<td colspan="3"><textarea name="medications" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"medications"});?></textarea></td>
		
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Anyother Relevant Information','e'); ?>:</td>
		<td colspan="3"><textarea name="anyother_relevant_information" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"anyother_relevant_information"});?></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Diagnosis','e'); ?>:</td>
		<td colspan="3"><textarea name="diagnosis" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"diagnosis"});?></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Treatment Received','e'); ?>:</td>
		<td colspan="3"><textarea name="treatment_received" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"treatment_received"});?></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Recommendation For Follow Up','e'); ?>:</td>
		<td colspan="3"><textarea name="recommendation_for_follow_up" rows="2" cols="60" wrap="virtual name"><?php echo stripslashes($obj{"recommendation_for_follow_up"});?></textarea></td>
		
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
 onclick="top.restoreSession();location='<?php echo "$rootdir/patient_file/encounter/$returnurl" ?>'" /></td>
	</tr>
</table>
</form>
<script language="javascript">
/* required for popup calendar */
Calendar.setup({inputField:"admission_date", ifFormat:"%Y-%m-%d", button:"img_admission_date"});

</script>
<?php
formFooter();
?>

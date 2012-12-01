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
formHeader("Form:Treatment Planning");
$returnurl = $GLOBALS['concurrent_layout'] ? 'encounter_top.php' : 'patient_encounter.php';

// Get the providers list.
 $ures = sqlStatement("SELECT id, username, fname, lname FROM users WHERE " .
  "authorized != 0 AND active = 1 ORDER BY lname, fname");
?>
<html><head>
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
<p><span class="forms-title">Treatment Planning</span></p>
</br>
<form method=post action="<?php echo $rootdir;?>/forms/treatmentplan/save.php?mode=new">
<table  border="0">

	<tr>

		<td align="left"  class="forms"><?php xl('Client Name','e'); ?>:</td>
		<td class="forms">
			<label class="forms-data"> <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "fname,lname,squad");
   echo htmlspecialchars(xl('','','','').$result['fname']." ".$result['lname']);}
   $patient_name=$result['fname']." ".$result['lname'];
   ?>
   </label>
   <input type="hidden" name="client_name" value="<?php echo $patient_name;?>">
		</td>
			<td align="left"  class="forms"><?php xl('DOB','e'); ?>:</td>	
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
 	
	
	
		<td align="left"  class="forms"><?php xl('Client Number','e'); ?>:</td>
		<td class="forms">
			<label class="forms-data" > <?php if (is_numeric($pid)) {
    // Check for no access to the patient's squad.
    $result = getPatientData($pid, "*");
   echo htmlspecialchars(xl('','','','').$result['pid']);}
   $patient_id=$result['pid'];
   ?>
   </label>
    <input type="hidden" name="client_number" value="<?php echo $patient_id;?>">
		</td>


		<td align="left" class="forms"><?php xl('Admit Date','e'); ?>:</td>
		<td class="forms" >
			   <input type='text' size='10' name='admit_date' id='admission_date' <?php echo $disabled ?>;
       value='<?php echo $viewmode ? substr($result['date'], 0, 10) : date('Y-m-d'); ?>'
       title='<?php xl('yyyy-mm-dd Date of service','e'); ?>'
       onkeyup='datekeyup(this,mypcc)' onblur='dateblur(this,mypcc)' />
        <img src='../../pic/show_calendar.gif' align='absbottom' width='24' height='22'
        id='img_admission_date' border='0' alt='[?]' style='cursor:pointer;cursor:hand'
        title='<?php xl('Click here to choose a date','e'); ?>'>
		</td>
	</tr>
 <td class="forms" nowrap>
   <b><?php xl('Provider','e'); ?>:</b>
  </td>
  <td class="forms" width="280px">

<?php
 
    echo "<select name='provider' style='width:60%' />";
    while ($urow = sqlFetchArray($ures)) {
      echo "    <option value='" . $urow['lname'] . "'";
      if ($urow['id'] == $defaultProvider) echo " selected";
      echo ">" . $urow['lname'];
      if ($urow['fname']) echo ", " . $urow['fname'];
      echo "</option>\n";
    }
    echo "</select>";

?>

  </td>
	</tr>
	 <tr>
 
 
	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Presenting Issue(s)','e'); ?>:</td>
		<td colspan="3"><textarea name="presenting_issues" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Patient History','e'); ?>:</td>
		<td colspan="3"><textarea name="patient_history" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Medications','e'); ?>:</td>
		<td colspan="3"><textarea name="medications" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Anyother Relevant Information','e'); ?>:</td>
		<td colspan="3"><textarea name="anyother_relevant_information" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Diagnosis','e'); ?>:</td>
		<td colspan="3"><textarea name="diagnosis" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>

	<tr>
		<td align="left" class="forms"><?php xl('Treatment Received','e'); ?>:</td>
		<td colspan="3"><textarea name="treatment_received" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	<tr>
		<td align="left" class="forms"><?php xl('Recommendation For Follow Up','e'); ?>:</td>
		<td colspan="3"><textarea name="recommendation_for_follow_up" rows="2" cols="60" wrap="virtual name"></textarea></td>
		
	</tr>
	

	<tr>
		<td align="left colspan="3" style="padding-bottom:7px;"></td>
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

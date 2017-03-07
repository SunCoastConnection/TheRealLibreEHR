<?php

// SANITIZE ALL ESCAPES
$sanitize_all_escapes = true;

// STOP FAKE REGISTER GLOBALS
$fake_register_globals = false;

require_once '../globals.php';
require_once $srcdir.'/patient.inc';
require_once $srcdir.'/formatting.inc.php';
require_once $srcdir.'/options.inc.php';
require_once $srcdir.'/formdata.inc.php';
require_once $srcdir.'/clinical_rules.php';
require_once $srcdir.'/report_database.inc';


function existsDefault(&$array, $key, $default = '') {
  if(array_key_exists($key, $array)) {
    $default = trim($array[$key]);
  }
  return $default;
}


function find_MGID_by_measure_name ( $measure_name ) {
	// echo ("DEBUG find_group_type_by_measure_name: measure_name is ".$measure_name ."\n");
	if ( strpos( $measure_name, "PQRS_Group_") === false) {
		// echo ("DEBUG: MGID Not Applicable (Individual Measures) is X\n");
		return "X";
	} else {
	$group_portion_only=substr($measure_name,11,strlen($measure_name)-16  );
	// echo ("DEBUG group_portion_only is $group_portion_only\n");
	switch ($group_portion_only) {
    	case "Diabetes":
        	echo ("DEBUG: Diabetes Mellitus MGID is A\n");
		return "A";
        	break;
    	case "CKD":
        	echo ("DEBUG: CKD MGID is C\n");
		return "C";
        	break;
    	case "Preventive":
        	echo ("DEBUG: Preventive Care MGID is D\n");
		return "D";
        	break;
	case "RA":
		echo ("DEBUG: Rheumatoid Arthritis MGID is F\n");
		return "F";
		break;
	case "CABG":
		echo ("DEBUG: CABG MGID is H\n");
		return "H";
		break;
	case "HepatitisC":
		echo ("DEBUG: Hepatitis C MGID is I\n");
		return "I";
		break;
	case "HF":
		echo ("DEBUG: HF MGID is L\n");
		return "L";
		break;
	case "CAD":
		echo ("DEBUG: CAD MGID is M\n");
		return "M";
		break;
	case "HIVAIDS":
		echo ("DEBUG: HIV/AIDS MGID is N\n");
		return "N";
		break;
	case "Asthma":
		echo ("DEBUG: Asthma MGID is O \n");
		return "O";
		break;
	case "COPD":
		echo ("DEBUG: COPD MGID is P \n");
		return "P";
		break;
	case "IBD":
		echo ("DEBUG: IBD MGID is Q \n");
		return "Q";
		break;
	case "Sleep_Apnea":
		echo ("DEBUG: Sleep Apnea is R \n");
		return "R";
		break;
	case "Cataracts":
		echo ("DEBUG: Cataracts MGID is S \n");
		return "S";
		break;
	case "Dementia":
		echo ("DEBUG: Dementia MGID is T \n");
		return "T";
		break;
	case "Parkinsons":
		echo ("DEBUG: Parkinson’s Disease MGID is U \n");
		return "U";
		break;
	case "Oncology":
		echo ("DEBUG: Oncology MGID is Y \n");
		return "Y";
		break;
	case "TKR":
		echo ("DEBUG: Total Knee Replacement MGID is Z \n");
		return "Z";
		break;
	case "Surgery":
		echo ("DEBUG: General Surgery MGID is AA \n");
		return "AA";
		break;
	case "OPEIR":
		echo ("DEBUG: OPEIR MGID is AB \n");
		return "AB";
		break;
	case "Sinusitis":
		echo ("DEBUG: Sinusitis MGID is AC \n");
		return "AC";
		break;
	case "AOE":
		echo ("DEBUG: AOE MGID is AD \n");
		return "AD";
		break;
	case "CP":
		echo ("DEBUG: Cardiovascular Prevention MGID is AE \n");
		return "AE";
		break;
	case "DR":
		echo ("DEBUG: Diabetic Retinopathy MGID is AF \n");
		return "AF";
		break;
	case "MCC":
		echo ("DEBUG: Multiple Chronic Conditions MGID is AG \n");
		return "AG";
		break;
	default:
		echo ("DEBUG: Measure type did not match, setting to Not Applicable (Individual) (X) \n");
		return "X";
	}	// switch
	}	// else
}  // end find_MGID_by_measure_name	


function get_Provider_email ($user_id) {
	$query="SELECT email FROM `users` WHERE id=$user_id ; ";
	$result=sqlFetchArray(sqlStatement($query));
	$EMAIL=$result['email'];
	//echo ("DEBUG: |$query| result |$result| ;  email is $EMAIL\n");
	return $EMAIL;
}


###	==========	BEGIN MAIN	==========

echo ("Assumptions ---  Before you generate this XML, you should do the following: \n");
echo (" * XML should only be generated for a report with a single provider.  *REQUIRED* \n");
echo (" * XML should only be generated for an Individual Measures report, or a report generated with one Measure Group selected.  *REQUIRED* \n");
echo (" * The eligible professional has signed a waiver giving the registry permission to submit data on their behalf.  *REQUIRED* \n");
echo (" * Failed Patients is assumed to be = Denominator - Numerator - Exclusions.  *REQUIRED* \n");
echo (" * 9 Measures were chosen for an Individual Measures report.  *REQUIRED* \n");
echo (" * Go into Administration --- Facilities --- Mark ONE facility as 'Primary Business Entity'.  Be sure it has the correct TIN.   *REQUIRED* \n");
echo (" * Go into Administration --- 'Ad dr Book' --- Add an email address for any providers for whom you want to recieve PQRS email notifications *Optional* \n");
echo (" * You are not reporting on GPROs. \n");
echo (" * You are not reporting on on Risk Adjusted Measures. \n");
echo (" * Measures that must be reported on for EVERY Encounter will be manualy dealt with in the XML. \n");

echo ("\n================================================================================\n");



$report_id = $_GET['report_id'] ;
//$report_id = (isset($_REQUEST['report_id'])) ;
echo ("DEBUG report_id is $report_id \n");

if(!empty($report_id)) {
	$report_view = collectReportDatabase($report_id);
	//echo ("DEBUG report_view is:  ".implode($report_view)."\n" );

	$dataSheet = json_decode($report_view['data'], true);
	//echo ("DEBUG dataSheet is:  ".implode($dataSheet)."\n" );
	echo ("DEBUG the first measure is ".$dataSheet[0]['id']   ."\n");
//TODO:  Sanity check that all measures are either individual or of the same group


	$CREATE_DATE=date("m/d/y");	//In the form:  01-23-2016
	echo("CREATE_DATE is ".$CREATE_DATE ."\n");

	$CREATE_TIME=date("H:i");	//In the form:  23:01
	echo("CREATE_TIME is ".$CREATE_TIME ."\n");

	$CREATOR="Suncoast Connection";
	echo("CREATOR is ".$CREATOR ."\n");

	$VERSION="1.0";		// "The version of the file being submitted"
	echo("VERSION is ".$VERSION ."\n");

	$REGISTRY_NAME="suncoastrhio";	#TODO:  Get this from globals
	echo("REGISTRY_NAME is ".$REGISTRY_NAME ."\n");

	$REGISTRY_ID="263971780";    // SCRHIO's tax payer number  EIN	#TODO:  Get this from globals
	echo("REGISTRY_ID is ".$REGISTRY_ID ."\n");

	$VENDOR_UNIQUE_ID="5249237";	#TODO:  Get this from globals
	echo("VENDOR_UNIQUE_ID is ".$VENDOR_UNIQUE_ID ."\n");

	$MEASURE_GROUP_ID=find_MGID_by_measure_name($dataSheet[0]['id']);
	echo ("The MGID is ".$MEASURE_GROUP_ID."\n");

	//  1=Individual Registry Submission 2=GPRO Registry Submi
	$SUBMISSION_TYPE="1";	
	echo("SUBMISSION_TYPE is ".$SUBMISSION_TYPE ."\n");

	if ($MEASURE_GROUP_ID=="X") {
		$SUBMISSION_METHOD="A";	// IndividuAl
	} else {
		$SUBMISSION_METHOD="G";	// Group
	}
	echo("SUBMISSION_METHOD is ".$SUBMISSION_METHOD ."\n");

	// (A=EHR, B=Claims, C=Practice Mgmt System, D=Web Tool)";
	$COLLECTION_METHOD="D";
	echo("COLLECTION_METHOD is ".$COLLECTION_METHOD ."\n");

	$PROVIDER_NPI=$report_view['provider'];
	echo("PROVIDER_NPI is ".$PROVIDER_NPI ."\n");

	$PROVIDER_TIN="TINTINTINTINTINTINTINTINTINTINTINTINTINTINTINTIN";  #TODO
	echo("PROVIDER_TIN is ".$PROVIDER_TIN ."\n");

	$PROVIDER_EMAIL=get_Provider_email($PROVIDER_NPI);
	echo("PROVIDER_EMAIL is ".$PROVIDER_EMAIL ."\n");

	// We are assuming and require that the waiver have been signed
	$WAIVER_SIGNED="Y";
	echo("WAIVER_SIGNED is (we're always assuming) ".$WAIVER_SIGNED ."\n");

//TODO:  Generate these in code instead of hard coding 2016
	$ENCOUNTER_FROM_DATE="01-01-2016";
	echo("ENCOUNTER_FROM_DATE is ".$ENCOUNTER_FROM_DATE ."\n");

	$ENCOUNTER_TO_DATE="12-31-2016";
	echo("ENCOUNTER_TO_DATE is ".$ENCOUNTER_TO_DATE ."\n");


	$OUTFILE_PATH=$GLOBALS['OE_SITE_DIR']."/PQRS/dropzone/files/";
	echo ("DEBUG:  OUTFILE_PATH is $OUTFILE_PATH \n"); #TODO Delete this

	$OUTFILE_BASENAME="PQRS2017-".$PROVIDER_NPI."_".$PROVIDER_TIN;
	echo("DEBUG:  OUTFILE_BASENAME is ".$OUTFILE_BASENAME ."\n");


	if ( $MEASURE_GROUP_ID != "X" ) {   // Only for Group Measures
		echo "--------------------------------------------------------------------------------\n";

// Total number of Medicare Part B FFS patients seen for the PQRS measure group
		//$FFS_PATIENT_COUNT=get_Medicare_Patient_Count($report_id);	#TODO
		$FFS_PATIENT_COUNT="FFS_PATIENT_COUNT-FFS_PATIENT_COUNT-FFS_PATIENT_COUNT-FFS_PATIENT_COUNT";
		echo ("* Total count of Medicare Part B FFS patients is $FFS_PATIENT_COUNT (LIES!!!!)\n");

// Number of instances of reporting for all applicable measures within the measure group, for each eligible instance (reporting numerator)
		#$GROUP_REPORTING_RATE_NUMERATOR=get_Reporting_Rate_Numerator($report_id);	#TODO
		$GROUP_REPORTING_RATE_NUMERATOR=198;
		echo ("* Group Reporting Rate Numerator is $GROUP_REPORTING_RATE_NUMERATOR (LIES!!!!)\n");

// What is Eligible instances for the PQRS Measure Group?(reporting denominator)
		#$GROUP_ELIGIBLE_INSTANCES=get_Group_Eligable_Instances($report_id);
		$GROUP_ELIGIBLE_INSTANCES=200;	#TODO
		echo ("* Group Eligible Instances is $GROUP_ELIGIBLE_INSTANCES (LIES!!!!)\n");

		$GROUP_REPORTING_RATE=sprintf("%00.2f",  $GROUP_REPORTING_RATE_NUMERATOR/$GROUP_ELIGIBLE_INSTANCES*100);
		echo ("* Group Reporting Rate is $GROUP_REPORTING_RATE %\n");
	}	// End if($MEASURE_GROUP_ID != "X")

	# This is the Total number of XML files to be generated
	$TOTAL_MEASURES=count($dataSheet);
	echo (" Total number of Measures being reported on is $TOTAL_MEASURES \n");

# LOOP!!!!!!!!!!!!!!!!!!!!!!!!!!!
	$FILE_NUMBER="0";

	foreach($dataSheet as $row) {
		$FILE_NUMBER++;
		//echo ("DEBUG row -- ".implode("|", $row) ."\n");
		echo "--------------------------------------------------------------------------------\n";
		echo "For Measure ".$FILE_NUMBER.":  \n";
		$PQRS_MEASURE_NUMBER=ltrim(substr($row['id'],strlen($measure_name)-4 ),'0');
		echo (" PQRS Measure Number is $PQRS_MEASURE_NUMBER \n");

		# Technically, the $COLLECTION_METHOD can be different for each measure

// TODO TODO TODO  TODO  TODO  TODO  TODO  TODO  TODO  TODO  TODO  TODO  TODO
	#	MEASURE_STRATA_NUM=`ask "What is Measure Strata Number?  (1?)"`
		$MEASURE_STRATA_NUM="1";	// TODO
		echo (" Assuming MEASURE_STRATA_NUM is 1 for now.  \n");

//`ask "How many eligible instances (Reporting Denominator) for the PQRS measure?
		$ELIGIBLE_INSTANCES=$row['pass_filter'];
		echo (" Denominator is $ELIGIBLE_INSTANCES \n");

//`ask "How many Meets Performance Instances? (Performance Numerator)
		$MEETS_PERFORMANCE_INSTANCES=$row['pass_target'];
		echo (" Numerator is $MEETS_PERFORMANCE_INSTANCES \n");

//`ask "How many Exclusions?
		$PERFORMANCE_EXCLUSION_INSTANCES=$row['excluded'];
		echo (" Exclusions is $PERFORMANCE_EXCLUSION_INSTANCES \n");

//`ask "How many Performance Not Met Instances?
		$PERFORMANCE_NOT_MET_INSTANCES=$ELIGIBLE_INSTANCES-$MEETS_PERFORMANCE_INSTANCES-$PERFORMANCE_EXCLUSION_INSTANCES;
		echo (" Failed is $PERFORMANCE_NOT_MET_INSTANCES (calculated) \n");

		#REPORTING_RATE=`ask "Reporting rate? (i.e. 100.00)"`
		if ( $MEASURE_GROUP_ID = "X" ){
			$REPORTING_RATE=sprintf ( "%00.2f", (($MEETS_PERFORMANCE_INSTANCES+$PERFORMANCE_EXCLUSION_INSTANCES+$PERFORMANCE_NOT_MET_INSTANCES)/$ELIGIBLE_INSTANCES ) * 100);
#<meets-performance-instances>+<performance-exclusion-instances>+<performance-not-met-instances>/<eligible-instances>
			echo (" Reporting Rate for this Measure is  $REPORTING_RATE (calculated)\n");
		}

		#PERFORMANCE_RATE=`ask "What is Performance Rate? (i.e. 100.00)"`
		$PERFORMANCE_RATE=sprintf("%00.2f", $MEETS_PERFORMANCE_INSTANCES/($MEETS_PERFORMANCE_INSTANCES+$PERFORMANCE_EXCLUSION_INSTANCES+$PERFORMANCE_NOT_MET_INSTANCES-$PERFORMANCE_EXCLUSION_INSTANCES) * 100);
#<meets-performance-instances> / [(<meets-performance-instances>+<performance-exclusion-instances>+<performance-not-met-instances>) - <performance-exclusion-instances>]
		echo (" * Your Performance Rate is $PERFORMANCE_RATE (calculated)\n");


# ==============================================================
#  Generate XML
		$OUTFILE_NAME="$OUTFILE_BASENAME-$FILE_NUMBER.xml";
		$myFileHandle=fopen($OUTFILE_PATH."/".$OUTFILE_NAME, "w") or die("Unable to open file!");		# TODO  FULL PATH

		echo "\nGenerating File number ".$FILE_NUMBER.": ".$OUTFILE_NAME."\n\n";
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		fwrite($myFileHandle, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n");
		echo "<submission type=\"PQRS-REGISTRY\" version=\"8.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"Registry_Payment.xsd\">\n";
		fwrite($myFileHandle, "<submission type=\"PQRS-REGISTRY\" version=\"8.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"Registry_Payment.xsd\">\n");
		echo "  <file-audit-data>\n";
		fwrite($myFileHandle,  "  <file-audit-data>\n");
		echo "    <create-date>".$CREATE_DATE."</create-date>\n";
		fwrite($myFileHandle,  "    <create-date>".$CREATE_DATE."</create-date>\n");
		echo "    <create-time>".$CREATE_TIME."</create-time>\n";
		fwrite($myFileHandle,  "    <create-time>".$CREATE_TIME."</create-time>\n");
		echo "    <create-by>".$CREATOR."</create-by>\n";
		fwrite($myFileHandle,  "    <create-by>".$CREATOR."</create-by>\n");
		echo "    <version>".$VERSION."</version>\n";
		fwrite($myFileHandle,  "    <version>".$VERSION."</version>\n");
		echo "    <file-number>".$FILE_NUMBER."</file-number>\n";
		fwrite($myFileHandle,  "    <file-number>".$FILE_NUMBER."</file-number>\n");
		echo "    <number-of-files>".$TOTAL_MEASURES."</number-of-files>\n";
		fwrite($myFileHandle,  "    <number-of-files>".$TOTAL_MEASURES."</number-of-files>\n");
		echo "  </file-audit-data>\n";
		fwrite($myFileHandle,  "  </file-audit-data>\n");
		echo "  <registry>\n";
		fwrite($myFileHandle,  "  <registry>\n");
		echo "    <registry-name>".$REGISTRY_NAME."</registry-name>\n";
		fwrite($myFileHandle,  "    <registry-name>".$REGISTRY_NAME."</registry-name>\n");
		echo "    <registry-id>".$REGISTRY_ID."</registry-id>\n";
		fwrite($myFileHandle,  "    <registry-id>".$REGISTRY_ID."</registry-id>\n");
		echo "    <vendor-unique-id>".$VENDOR_UNIQUE_ID."</vendor-unique-id>\n";
		fwrite($myFileHandle,  "    <vendor-unique-id>".$VENDOR_UNIQUE_ID."</vendor-unique-id>\n");
		echo "    <submission-type>".$SUBMISSION_TYPE."</submission-type>\n";
		fwrite($myFileHandle,  "    <submission-type>".$SUBMISSION_TYPE."</submission-type>\n");
		echo "    <submission-method>".$SUBMISSION_METHOD."</submission-method>\n";
		fwrite($myFileHandle,  "    <submission-method>".$SUBMISSION_METHOD."</submission-method>\n");
		echo "  </registry>\n";
		fwrite($myFileHandle,  "  </registry>\n");
		echo "  <measure-group ID=\"".$MEASURE_GROUP_ID."\" >\n";
		fwrite($myFileHandle,  "  <measure-group ID=\"".$MEASURE_GROUP_ID."\" >\n");
		echo "    <provider>\n";
		fwrite($myFileHandle,  "    <provider>\n");
		echo '      <gpro-type xsi:nil="true"></gpro-type>'."\n";
		fwrite($myFileHandle,  '      <gpro-type xsi:nil="true"></gpro-type>'."\n");
		echo "      <npi>$PROVIDER_NPI</npi>\n";
		fwrite($myFileHandle,  "      <npi>$PROVIDER_NPI</npi>\n");
		echo "      <tin>$PROVIDER_TIN</tin>\n";
		fwrite($myFileHandle,  "      <tin>$PROVIDER_TIN</tin>\n");
	
		if ( empty($PROVIDER_EMAIL) ) {
			//echo ("DEBUG  PROVIDER_EMAIL is empty! \n");
			echo "      <email-address xsi:nil=\"true\"/>\n";
			fwrite($myFileHandle,  "      <email-address xsi:nil=\"true\"/>\n");
		} else {
			echo "      <email-address>$PROVIDER_EMAIL</email-address>\n";
			fwrite($myFileHandle,  "      <email-address>$PROVIDER_EMAIL</email-address>\n");
		}

		echo "      <waiver-signed>$WAIVER_SIGNED</waiver-signed>\n";
		fwrite($myFileHandle,  "      <waiver-signed>$WAIVER_SIGNED</waiver-signed>\n");
		echo "      <encounter-from-date>$ENCOUNTER_FROM_DATE</encounter-from-date>\n";
		fwrite($myFileHandle,  "      <encounter-from-date>$ENCOUNTER_FROM_DATE</encounter-from-date>\n");
		echo "      <encounter-to-date>$ENCOUNTER_TO_DATE</encounter-to-date>\n";
		fwrite($myFileHandle,  "      <encounter-to-date>$ENCOUNTER_TO_DATE</encounter-to-date>\n");

		if ( $MEASURE_GROUP_ID != "X" ) {
			echo "      <measure-group-stat>\n";
			fwrite($myFileHandle,  "      <measure-group-stat>\n");
			echo "        <ffs-patient-count>$FFS_PATIENT_COUNT</ffs-patient-count>\n";
			fwrite($myFileHandle,  "        <ffs-patient-count>$FFS_PATIENT_COUNT</ffs-patient-count>\n");
			echo "        <group-reporting-rate-numerator>$GROUP_REPORTING_RATE_NUMERATOR</group-reporting-rate-numerator>\n";
			fwrite($myFileHandle,  "        <group-reporting-rate-numerator>$GROUP_REPORTING_RATE_NUMERATOR</group-reporting-rate-numerator>\n");
			echo "        <group-eligible-instances>$GROUP_ELIGIBLE_INSTANCES</group-eligible-instances>\n";
			fwrite($myFileHandle,  "        <group-eligible-instances>$GROUP_ELIGIBLE_INSTANCES</group-eligible-instances>\n");
			echo "        <group-reporting-rate>$GROUP_REPORTING_RATE</group-reporting-rate>\n";
			fwrite($myFileHandle,  "        <group-reporting-rate>$GROUP_REPORTING_RATE</group-reporting-rate>\n");
			echo "      </measure-group-stat>\n";
			fwrite($myFileHandle,  "      </measure-group-stat>\n");
		}

		echo "      <pqrs-measure>\n";
		fwrite($myFileHandle,  "      <pqrs-measure>\n");
		echo "        <pqrs-measure-number>$PQRS_MEASURE_NUMBER</pqrs-measure-number>\n";
		fwrite($myFileHandle,  "        <pqrs-measure-number>$PQRS_MEASURE_NUMBER</pqrs-measure-number>\n");
		echo "        <collection-method>$COLLECTION_METHOD</collection-method>\n";
		fwrite($myFileHandle,  "        <collection-method>$COLLECTION_METHOD</collection-method>\n");
		echo "        <pqrs-measure-details>\n";
		fwrite($myFileHandle,  "        <pqrs-measure-details>\n");
		echo "          <measure-strata-num>$MEASURE_STRATA_NUM</measure-strata-num>\n";
		fwrite($myFileHandle,  "          <measure-strata-num>$MEASURE_STRATA_NUM</measure-strata-num>\n");
		echo "          <eligible-instances>$ELIGIBLE_INSTANCES</eligible-instances>\n";
		fwrite($myFileHandle,  "          <eligible-instances>$ELIGIBLE_INSTANCES</eligible-instances>\n");
		echo "          <meets-performance-instances>$MEETS_PERFORMANCE_INSTANCES</meets-performance-instances>\n";
		fwrite($myFileHandle,  "          <meets-performance-instances>$MEETS_PERFORMANCE_INSTANCES</meets-performance-instances>\n");
		echo "          <performance-exclusion-instances>$PERFORMANCE_EXCLUSION_INSTANCES</performance-exclusion-instances>\n";
		fwrite($myFileHandle,  "          <performance-exclusion-instances>$PERFORMANCE_EXCLUSION_INSTANCES</performance-exclusion-instances>\n");
		echo "          <performance-not-met-instances>$PERFORMANCE_NOT_MET_INSTANCES</performance-not-met-instances>\n";
		fwrite($myFileHandle,  "          <performance-not-met-instances>$PERFORMANCE_NOT_MET_INSTANCES</performance-not-met-instances>\n");


		if ( $MEASURE_GROUP_ID = "X" ) {
			echo "          <reporting-rate>$REPORTING_RATE</reporting-rate>\n";
			fwrite($myFileHandle,  "          <reporting-rate>$REPORTING_RATE</reporting-rate>\n");
		}


		echo "          <performance-rate>$PERFORMANCE_RATE</performance-rate>\n";
		fwrite($myFileHandle,  "          <performance-rate>$PERFORMANCE_RATE</performance-rate>\n");

// We are not doing RISK-ADJUSTED-MEASURES
// <risk-adjusted-measure-detail>
 // <population-ref-rate>8.3000</population-ref-rate>	// Note: When the population-ref-rate is null use <population-ref-rate xsi:nil="true"/> for this tag.`
 // <risk-standardized-rate>7.0000</risk-standardized-rate>	// Note: When the risk-standardized-rate is null use < risk-standardized-rate  xsi:nil="true"/> for this tag.
 // <lower-ci>6.9213</lower-ci>	// Note: When the lower-ci is null use <lower-ci xsi:nil="true"/> for this tag.
 // <upper-ci>10.3910</upper-ci>	// Note: When the upper-ci is null use <upper-ci xsi:nil="true"/> for this tag.
 // <performance-assessment>Average</performance-assessment>	// Note: When the performance-assessment is null use <performance-assessment xsi:nil="true"/> for this tag.
 // <risk-adjustment-description>Remove patients with X</risk-adjustment-description>	// 300 characters	// Note: When the risk-adjustment-description is null use <risk-adjustment-description xsi:nil="true"/> for this tag.
 // <risk-reporting-rate>95.0000</risk-reporting-rate>	// Note: When the risk-reporting-rate is null use <risk-reporting-rate xsi:nil="true"/> for this tag.
// </risk-adjusted-measure-detail>
		echo "        </pqrs-measure-details>\n";
		fwrite($myFileHandle,  "        </pqrs-measure-details>\n");
		echo "      </pqrs-measure>\n";
		fwrite($myFileHandle,  "      </pqrs-measure>\n");
		echo "    </provider>\n";
		fwrite($myFileHandle,  "    </provider>\n");
		echo "  </measure-group>\n";
		fwrite($myFileHandle,  "  </measure-group>\n");
		echo "</submission>\n";
		fwrite($myFileHandle,  "</submission>\n");
		fclose($myFileHandle);
	}	// End loop.  LOOP LOOP LOOP LOOP
} else {	// End if(!empty($report_id))
	echo ("ERROR!  No report_id specified!\n");
}
?>

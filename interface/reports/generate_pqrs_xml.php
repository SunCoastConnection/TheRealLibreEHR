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


$report_id = $_GET['report_id'] ;
//$report_id = (isset($_REQUEST['report_id'])) ;
echo "DEBUG report_id is $report_id \n";

if(!empty($report_id)) {
  $report_view = collectReportDatabase($report_id);
}	//TODO:  This should encompass this whole page
echo ("DEBUG report_view is:  ".implode($report_view)."\n" );

$dataSheet = json_decode($report_view['data'], true);
echo ("DEBUG dataSheet is:  ".implode($dataSheet)."\n" );
echo ("DEBUG the first measure (group type) is ".$dataSheet[0]['id']   ."\n");
//TODO:  Sanity check that all measures are either individual or of the same group
$MGID=find_MGID_by_measure_name($dataSheet[0]['id']);
echo ("DEBUG The MGID is ".$MGID."\n");
foreach($dataSheet as $row) {
	echo ("DEBUG row -- ".implode("|", $row) ."\n");
}



function find_MGID_by_measure_name ( $measure_name ) {
	echo ("DEBUG find_group_type_by_measure_name: measure_name is ".$measure_name ."\n");
	if ( strpos( $measure_name, "PQRS_Group_") === false) {
		echo ("DEBUG: MGID Not Applicable (Individual Measures) is X\n");
		return "X";
	} else {
	$group_portion_only=substr($measure_name,11,strlen($measure_name)-16  );
	echo ("DEBUG group_portion_only is $group_portion_only\n");
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
	}
	}

}  // end find_MGID_by_measure_name	

#  ============================================================

# Begin Main

// Set or collect information needed for the XML

/*
OUTFILE_BASENAME=`ask "Base name of output file? (ex. kurth_sinusitis_group, smith_individual) 
"`
*/
	echo("DEBUG:  ========================================" ."\n");
$CREATE_DATE="DATE DATE DATE DATE FIXME FIXME FIXME!";
	echo("DEBUG:  CREATE_DATE is ".$CREATE_DATE ."\n");
$CREATE_TIME="DATE DATE DATE DATE FIXME FIXME FIXME!";
	echo("DEBUG:  CREATE_TIME is ".$CREATE_TIME ."\n");
$CREATOR="Suncoast Connection";
	echo("DEBUG:  CREATOR is ".$CREATOR ."\n");
$VERSION="1.0";
	echo("DEBUG:  VERSION is ".$VERSION ."\n");
$REGISTRY_NAME="suncoastrhio";
	echo("DEBUG:  REGISTRY_NAME is ".$REGISTRY_NAME ."\n");
$REGISTRY_ID="263971780";    // Their tax payer number  EIN
	echo("DEBUG:  REGISTRY_ID is ".$REGISTRY_ID ."\n");
$VENDOR_UNIQUE_ID="5249237";
	echo("DEBUG:  VENDOR_UNIQUE_ID is ".$VENDOR_UNIQUE_ID ."\n");

$SUBMISSION_TYPE="1";	# 1=Individual Registry Submission 2=GPRO Registry Submi
	echo("DEBUG:  SUBMISSION_TYPE is ".$SUBMISSION_TYPE ."\n");
$SUBMISSION_METHOD="ask Is this a Group or individuAl measure submission? (Group = G, Individual = A)";
	echo("DEBUG:  SUBMISSION_METHOD is ".$SUBMISSION_METHOD ."\n");
$COLLECTION_METHOD="ask What is the Collecion Method? (A=EHR, B=Claims, C=Practice Mgmt System, D=Web Tool)";
	echo("DEBUG:  COLLECTION_METHOD is ".$COLLECTION_METHOD ."\n");


$PROVIDER_NPI="What is Provider NPI?";
	echo("DEBUG:  PROVIDER_NPI is ".$PROVIDER_NPI ."\n");
$PROVIDER_TIN="What is Provider TIN?";
	echo("DEBUG:  PROVIDER_TIN is ".$PROVIDER_TIN ."\n");
$PROVIDER_EMAIL="What is Provider email? (Enter 'none' for default)";
	echo("DEBUG:  PROVIDER_EMAIL is ".$PROVIDER_EMAIL ."\n");
/*	if [ $PROVIDER_EMAIL = "none" ] ; then 
		PROVIDER_EMAIL="drbowen@bowenmd.com"
	fi
*/

$WAIVER_SIGNED="Y";
	echo("DEBUG:  WAIVER_SIGNED is (we're always assuming) ".$WAIVER_SIGNED ."\n");

/*if [ $WAIVER_SIGNED = "y" ] ; then WAIVER_SIGNED="Y" ; fi
if [ $WAIVER_SIGNED != "Y" ] ; then
	echo "Waiver MUST be signed!"
	exit;
fi
*/

//TODO:  Generate these in code instead of ahrd coding 2016
$ENCOUNTER_FROM_DATE="01-01-2016";
	echo("DEBUG:  ENCOUNTER_FROM_DATE is ".$ENCOUNTER_FROM_DATE ."\n");
$ENCOUNTER_TO_DATE="12-31-2016";
	echo("DEBUG:  ENCOUNTER_TO_DATE is ".$ENCOUNTER_TO_DATE ."\n");


//TODO:  Start here
$MEASURE_GROUP_ID="A";
/*
echo "Which Measure Group are you reporting on?"
MEASURE_GROUP_ID=`ask_mgid`
echo "DEBUG:  MEASURE_GROUP_ID=$MEASURE_GROUP_ID"

if [ $MEASURE_GROUP_ID != "X" ] ; then
	FFS_PATIENT_COUNT=`ask "What is Total number of Medicare Part B FFS patients seen for the PQRS measure group?  (FFS_PATIENT_COUNT)
"`
	GROUP_REPORTING_RATE_NUMERATOR=`ask "Number of instances of reporting for all applicable measures within the measure group, for each eligible instance (reporting numerator)
"`
	GROUP_ELIGIBLE_INSTANCES=`ask "What is Eligible instances for the PQRS Measure Group?  (GROUP_ELIGIBLE_INSTANCES (reporting denominator) )
"`
	#GROUP_REPORTING_RATE=`ask "What is Reporting Rate for this PQRS Measure Group? (GROUP_REPORTING_RATE i.e. 100.00)"` 
	GROUP_REPORTING_RATE=$(printf %.2f $( echo "scale=2;($GROUP_REPORTING_RATE_NUMERATOR/$GROUP_ELIGIBLE_INSTANCES) *100" |bc ))
	echo
	echo "* Your Group Reporting Rate is  $GROUP_REPORTING_RATE %"
fi

echo
FILE_OF=`ask "How many total Measures are you reporting on?
"`	# Total number of XML files
*/
# LOOP!!!!!!!!!!!!!!!!!!!!!!!!!!!
$FILE_NUMBER="1";							# Number 1 of 5

//while ( [ $FILE_NUMBER -le $FILE_OF ] ) ; do

	echo "For ".$FILE_NUMBER."st measure:";
//	PQRS_MEASURE_NUMBER=`ask "What is PQRS Measure Number of measure "$FILE_NUMBER"?
//"`

	# Technically, the $COLLECTION_METHOD can be different for each measure

#	MEASURE_STRATA_NUM=`ask "What is Measure Strata Number?  (1?)"`
	$MEASURE_STRATA_NUM="1";
//	ELIGIBLE_INSTANCES=`ask "How many eligible instances (Reporting Denominator) for the PQRS measure?
//"`
//	MEETS_PERFORMANCE_INSTANCES=`ask "How many Meets Performance Instances? (Performance Numerator)
//"`
//	PERFORMANCE_EXCLUSION_INSTANCES=`ask "How many Exclusions?
//"`
//	PERFORMANCE_NOT_MET_INSTANCES=`ask "How many Performance Not Met Instances?
//"`

	#REPORTING_RATE=`ask "Reporting rate? (i.e. 100.00)"`
//	if [ $MEASURE_GROUP_ID = "X" ] ; then
//		REPORTING_RATE=$(printf %.2f $( echo "scale=4;(($MEETS_PERFORMANCE_INSTANCES+$PERFORMANCE_EXCLUSION_INSTANCES+$PERFORMANCE_NOT_MET_INSTANCES)/$ELIGIBLE_INSTANCES ) * 100" |bc ))
#<meets-performance-instances>+<performance-exclusion-instances>+<performance-not-met-instances>/<eligible-instances>
		echo "* Your Reporting Rate is  ".$REPORTING_RATE." %\n";
//	fi

	#PERFORMANCE_RATE=`ask "What is Performance Rate? (i.e. 100.00)"`
//	PERFORMANCE_RATE=$(printf %.2f $( echo "scale=4;($MEETS_PERFORMANCE_INSTANCES/($MEETS_PERFORMANCE_INSTANCES+$PERFORMANCE_EXCLUSION_INSTANCES+$PERFORMANCE_NOT_MET_INSTANCES-$PERFORMANCE_EXCLUSION_INSTANCES) ) * 100" | bc ))
#<meets-performance-instances> / [(<meets-performance-instances>+<performance-exclusion-instances>+<performance-not-met-instances>) - <performance-exclusion-instances>]
	echo "* Your Performance Rate is ".$PERFORMANCE_RATE." %\n";


# ==============================================================
#  Generate XML
//	OUTFILE_NAME=$OUTFILE_BASENAME-$FILE_NUMBER.xml
	echo "Generating File number ".$FILE_NUMBER.": ".$OUTFILE_NAME." \n";
	echo "\n<hr>\n\n";
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"; // > $OUTFILE_NAME
	echo "<submission type=\"PQRS-REGISTRY\" version=\"8.0\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"Registry_Payment.xsd\">\n";
	echo "  <file-audit-data>\n";
	echo "    <create-date>".$CREATE_DATE."</create-date>\n";
	echo "    <create-time>".$CREATE_TIME."</create-time>\n";
	echo "    <create-by>".$CREATOR."</create-by>\n";
	echo "    <version>".$VERSION."</version>\n";
	echo "    <file-number>".$FILE_NUMBER."</file-number>\n";
	echo "    <number-of-files>".$FILE_OF."</number-of-files>\n";
	echo "  </file-audit-data>\n";
	echo "  <registry>\n";
	echo "    <registry-name>".$REGISTRY_NAME."</registry-name>\n";
	echo "    <registry-id>".$REGISTRY_ID."</registry-id>\n";
	echo "    <vendor-unique-id>".$VENDOR_UNIQUE_ID."</vendor-unique-id>\n";
	echo "    <submission-type>".$SUBMISSION_TYPE."</submission-type>\n";
	echo "    <submission-method>".$SUBMISSION_METHOD."</submission-method>\n";
	echo "  </registry>\n";
	echo "  <measure-group ID=\"".$MEASURE_GROUP_ID."\" >\n";
	echo "    <provider>\n";
	echo '      <gpro-type xsi:nil="true"></gpro-type>'."\n";
	echo "      <npi>$PROVIDER_NPI</npi>\n";
	echo "      <tin>$PROVIDER_TIN</tin>\n";
	echo "      <email-address>$PROVIDER_EMAIL</email-address>\n";
	echo "      <waiver-signed>$WAIVER_SIGNED</waiver-signed>\n";
	echo "      <encounter-from-date>$ENCOUNTER_FROM_DATE</encounter-from-date>\n";
	echo "      <encounter-to-date>$ENCOUNTER_TO_DATE</encounter-to-date>\n";

	if ( $MEASURE_GROUP_ID != "X" ) {
		echo "      <measure-group-stat>\n";
		echo "        <ffs-patient-count>$FFS_PATIENT_COUNT</ffs-patient-count>\n";
		echo "        <group-reporting-rate-numerator>$GROUP_REPORTING_RATE_NUMERATOR</group-reporting-rate-numerator>\n";
		echo "        <group-eligible-instances>$GROUP_ELIGIBLE_INSTANCES</group-eligible-instances>\n";
		echo "        <group-reporting-rate>$GROUP_REPORTING_RATE</group-reporting-rate>\n";
		echo "      </measure-group-stat>\n";
	}

	echo "      <pqrs-measure>\n";
	echo "        <pqrs-measure-number>$PQRS_MEASURE_NUMBER</pqrs-measure-number>\n";
	echo "        <collection-method>$COLLECTION_METHOD</collection-method>\n";
	echo "        <pqrs-measure-details>\n";
	echo "          <measure-strata-num>$MEASURE_STRATA_NUM</measure-strata-num>\n";
	echo "          <eligible-instances>$ELIGIBLE_INSTANCES</eligible-instances>\n";
	echo "          <meets-performance-instances>$MEETS_PERFORMANCE_INSTANCES</meets-performance-instances>\n";
	echo "          <performance-exclusion-instances>$PERFORMANCE_EXCLUSION_INSTANCES</performance-exclusion-instances>\n";
	echo "          <performance-not-met-instances>$PERFORMANCE_NOT_MET_INSTANCES</performance-not-met-instances>\n";


	if ( $MEASURE_GROUP_ID = "X" ) {
		echo "          <reporting-rate>$REPORTING_RATE</reporting-rate>\n";
	}


	echo "          <performance-rate>$PERFORMANCE_RATE</performance-rate>\n";
// This section is new for 2017?
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
	echo "      </pqrs-measure>\n";
	echo "    </provider>\n";
	echo "  </measure-group>\n";
	echo "</submission>\n";
	
/*
	FILE_NUMBER=`expr $FILE_NUMBER + 1`
done	#Main while loop that generated multiple files
*/
?>

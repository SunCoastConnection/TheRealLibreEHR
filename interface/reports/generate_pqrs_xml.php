<?php
//  BROKEN!  BORKEN BROKEN BROKEN!  This is not PHP!  It's BASH.  #!/bin/bash

/*
askYN() {
    while true; do
        if [ "${2:-}" = "Y" ]; then
            prompt="Y/n"
            default=Y
        elif [ "${2:-}" = "N" ]; then
            prompt="y/N"
            default=N
        else
            prompt="y/n"
            default=
        fi

        # Ask the question - use /dev/tty in case stdin is redirected from somewhere else
        read -p "$1 [$prompt] " REPLY </dev/tty

        # Default?
        if [ -z "$REPLY" ]; then
            REPLY=$default
        fi

        # Check if the reply is valid
        case "$REPLY" in
            Y*|y*) return 0 ;;
            N*|n*) return 1 ;;
        esac

    done
}


ask() {
    while true; do
        # Ask the question - use /dev/tty in case stdin is redirected from somewhere else
        read -p "$1  " REPLY </dev/tty

	if [[ "$REPLY" ]]; then
		echo $REPLY
		return ;
        fi
    done
}

ask_mgid() {
 	select MGID in "Diabetes Mellitus" "CKD" "Preventive Care" "Rheumatoid Arthritis" "CABG" "Hepatitis C" "HF" "CAD" "HIV/AIDS" "Asthma" "COPD" "IBD" "Sleep Apnea" "Cataracts" "Dementia" "Parkinson’s Disease" "Oncology" "Total Knee Replacement" "General Surgery" "OPEIR" "Sinusitis" "AOE" "Not Applicable (Individual)"
       	do
		case $MGID in
 			"Diabetes Mellitus")
                		echo "A"
				break
				;;
 			"CKD")
                		echo "C"
				break
				;;
 			"Preventive Care")
                		echo "D"
				break
				;;
 			"Rheumatoid Arthritis")
                		echo "F"
				break
				;;
 			"CABG")
                		echo "H"
				break
				;;
 			"Hepatitis C")
                		echo "I"
				break
				;;
 			"HF")
                		echo "L"
				break
				;;
 			"CAD")
                		echo "M"
				break
				;;
 			"HIV/AIDS")
                		echo "N"
				break
				;;
 			"Asthma")
                		echo "O"
				break
				;;
 			"COPD")
                		echo "P"
				break
				;;
 			"IBD")
                		echo "Q"
				break
				;;
 			"Sleep Apnea")
                		echo "R"
				break
				;;
 			"Cataracts")
                		echo "S"
				break
				;;
 			"Dementia")
                		echo "T"
				break
				;;
 			"Parkinson’s Disease")
                		echo "U"
				break
				;;
 			"Oncology")
                		echo "Y"
				break
				;;
 			"Total Knee Replacement")
                		echo "Z"
				break
				;;
 			"General Surgery")
                		echo "AA"
				break
				;;
 			"OPEIR")
                		echo "AB"
				break
				;;
 			"Sinusitis")
				echo "AC"
				break
				;;
 			"AOE")
				echo "AD"
				break
				;;
			"Not Applicable (Individual)")
				echo "X"
				break
				;;
		esac
	done

}
*/
#  ============================================================

# Begin Main

// Set or collect information needed for the XML

/*
OUTFILE_BASENAME=`ask "Base name of output file? (ex. kurth_sinusitis_group, smith_individual) 
"`
*/
//$CREATE_DATE=`date +%m-%d-%Y`
//$CREATE_TIME=`date +%H:%M`
$CREATOR="Suncoast Connection";
$VERSION="1.0";
$REGISTRY_NAME="suncoastrhio";
$REGISTRY_ID="263971780";    // Their tax payer number  EIN
$VENDOR_UNIQUE_ID="5249237";

$SUBMISSION_TYPE="1";	# 1=Individual Registry Submission 2=GPRO Registry Submi
//SUBMISSION_METHOD=`ask "Is this a Group or individuAl measure submission? (Group = G, Individual = A)"`
//COLLECTION_METHOD=`ask "What is the Collection Method? (A=EHR, B=Claims, C=Practice Mgmt System, D=Web Tool)"`


//PROVIDER_NPI=`ask "What is Provider NPI?"`
//PROVIDER_TIN=`ask "What is Provider TIN?"`
//PROVIDER_EMAIL=`ask "What is Provider email? (Enter 'none' for default)"`
/*	if [ $PROVIDER_EMAIL = "none" ] ; then 
		PROVIDER_EMAIL="drbowen@bowenmd.com"
	fi
echo "DEBUG: PROVIDER_EMAIL=$PROVIDER_EMAIL "
*/

$WAIVER_SIGNED="Y";

/*if [ $WAIVER_SIGNED = "y" ] ; then WAIVER_SIGNED="Y" ; fi
if [ $WAIVER_SIGNED != "Y" ] ; then
	echo "Waiver MUST be signed!"
	exit;
fi
*/
$ENCOUNTER_FROM_DATE="01-01-2016";
$ENCOUNTER_TO_DATE="12-31-2016";

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
	echo '      <gpro-type xsi:nil="true" />';
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
<risk-adjusted-measure-detail>
 <population-ref-rate>8.3000</population-ref-rate>	// Note: When the population-ref-rate is null use <population-ref-rate xsi:nil="true"/> for this tag.`
 <risk-standardized-rate>7.0000</risk-standardized-rate>	// Note: When the risk-standardized-rate is null use < risk-standardized-rate  xsi:nil="true"/> for this tag.
 <lower-ci>6.9213</lower-ci>	// Note: When the lower-ci is null use <lower-ci xsi:nil="true"/> for this tag.
 <upper-ci>10.3910</upper-ci>	// Note: When the upper-ci is null use <upper-ci xsi:nil="true"/> for this tag.
 <performance-assessment>Average</performance-assessment>	// Note: When the performance-assessment is null use <performance-assessment xsi:nil="true"/> for this tag.
 <risk-adjustment-description>Remove patients with X</risk-adjustment-description>	// 300 characters	// Note: When the risk-adjustment-description is null use <risk-adjustment-description xsi:nil="true"/> for this tag.
 <risk-reporting-rate>95.0000</risk-reporting-rate>	// Note: When the risk-reporting-rate is null use <risk-reporting-rate xsi:nil="true"/> for this tag.
</risk-adjusted-measure-detail>
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

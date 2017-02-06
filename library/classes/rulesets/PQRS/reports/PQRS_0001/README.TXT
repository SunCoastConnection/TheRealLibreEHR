PQRS_0001

Measure #1 (NQF 0059): Diabetes: Hemoglobin A1c Poor Control â?? National Quality Strategy
Domain: Effective Clinical Care

Percentage of patients 18-75 years of age with diabetes who had hemoglobin A1c > 9.0% during the measurement period


DENOMINATOR:
Patients 18 - 75 years of age with diabetes with a visit during the measurement period
Denominator Criteria (Eligible Cases):
*	Patients 18 through 75 years of age on date of encounter
AND
*	Diagnosis for diabetes (ICD-9-CM) [for use 1/1/2015-9/30/2015]: 
*	Diagnosis for diabetes (ICD-10-CM) [for use 10/01/2015-12/31/2015]: 
250.00, 250.01, 250.02, 250.03, 250.10, 250.11, 250.12, 250.13, 250.20, 250.21, 250.22, 250.23, 250.30, 250.31, 250.32, 250.33, 250.40, 250.41, 250.42, 250.43, 250.50, 250.51, 250.52, 250.53, 250.60, 250.61, 250.62, 250.63, 250.70, 250.71, 250.72, 250.73, 250.80, 250.81, 250.82, 250.83, 250.90, 250.91, 250.92, 250.93, 357.2, 362.01, 362.02, 362.03, 362.04, 362.05, 362.06, 362.07, 366.41, 648.00, 648.01, 648.02, 648.03, 648.04 E10.10, E10.11, E10.21, E10.22, E10.29, E10.311, E10.319, E10.321, E10.329, E10.331, E10.339, E10.341, E10.349, E10.351, E10.359, E10.36, E10.39, E10.40, E10.41, E10.42, E10.43, E10.44, E10.49, E10.51, E10.52, E10.59, E10.610, E10.618, E10.620, E10.621, E10.622, E10.628, E10.630, E10.638, E10.641, E10.649, E10.65, E10.69, E10.8, E10.9, E11.00, E11.01, E11.21, E11.22, E11.29, E11.311, E11.319, E11.321, E11.329, E11.331, E11.339, E11.341, E11.349, E11.351, E11.359, E11.36, E11.39, E11.40, E11.41, E11.42, E11.43, E11.44, E11.49, E11.51, E11.52, E11.59, E11.610, E11.618, E11.620, E11.621, E11.622, E11.628, E11.630, E11.638, E11.641, E11.649, E11.65, E11.69, E11.8, E11.9, O24.011, O24.012, O24.013, O24.019, O24.02, O24.03, O24.111, O24.112, O24.113, O24.119, O24.12, O24.13
AND
*	Patient encounter during reporting period (CPT or HCPCS): 
97802, 97803, 97804, 99201, 99202, 99203, 99204, 99205, 99211,99212, 99213, 99214, 99215, 99217, 99218, 99219, 99220, 99221, 99222, 99223, 99231, 99232, 99233, 99238, 99239, 99281, 99282, 99283, 99284, 99285, 99291, 99304, 99305, 99306, 99307, 99308, 99309, 99310, 99315, 99316, 99318, 99324, 99325, 99326, 99327, 99328, 99334, 99335, 99336, 99337, 99341, 99342, 99343, 99344, 99345, 99347, 99348, 99349, 99350, G0270, G0271, G0402, G0438, G0439

NUMERATOR:
Patients whose most recent HbA1c level (performed during the measurement period) is > 9.0%
//         Numerator Instructions: A lower calculated performance rate for this measure indicates better clinical care or control. Patient is numerator compliant if most recent HbA1c level >9% or is missing a result or if an HbA1c test was not done during the measurement year.

Performance Met: 
*	CPT II 3046F	// Most recent hemoglobin A1c level > 9.0%
OR
*	CPT II 3046F:8P	// Hemoglobin A1c level was not performed during the performance period (12 months)

Performance Not Met: 
// Most Recent Hemoglobin A1c Level < 9.0% (this is good)
*	CPT II 3044F	// Most recent hemoglobin A1c (HbA1c) level < 7.0%
OR
*	CPT II 3045F	// Most recent hemoglobin A1c (HbA1c) level 7.0 to 9.0%
///////////////////////////////////////////////SAMPLE PHP FOR THIS MEASURE///////////////////////////////////

<?php
/*A mysql query string held in the php variable $query_for_whole_measure that calculates PQRS measure #1.
  Gives rows as Dx(diagnosis), Tx(procedure), CPT2 (performance code), DOS(date of service), PID(Patient ID), DOB(date of birth).
  Selection joins multiple rows from the billing table to get a number of dates of service, but asks the patient's date of birth on the date of the Tx.
  PID is used to check relevance between the rows and tables.
  This query includes the numerator.  This whole query could be safely used as a numerator/pass/fail calculation if changed to
   run against a single PID.
   THIS IS AN INVERTED MEASURE
   This query looks for all patient
  */
$query_for_whole_measure = "SELECT DISTINCT  b1.code AS Dx, b2.code AS Tx,  CONCAT(b3.code, b3.modifier) AS CPT2, fe.date AS DOS, fe.user AS PROVIDER, p.pid AS PID, p.DOB AS DOB".
"  FROM billing AS b1".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  //b2 is the second billing table alias to get the procedure code (CPT4 or G code) as Tx. We are matching the Patient ID (PID).  denominator
"INNER JOIN billing AS b3 ON (b1.pid = b3.pid)".  //b3 is the third billing table alias to get the reporting code (CPT II) as CPT2 which is our [numerator].  We would not want this if the provider does not report CPT2
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.

"WHERE b1.code IN".  //Diagnosis must match one of the following
"('250.00','250.01','250.02','250.03','250.10','250.11','250.12','250.13','250.20','250.21',".
" '250.22','250.23','250.30','250.31','250.32','250.33','250.40','250.41','250.42','250.43','250.50',".
" '250.51','250.52','250.53','250.60','250.61','250.62','250.63','250.70','250.71','250.72','250.73',".
" ' 250.80','250.81','250.82','250.83','250.90','250.91','250.92','250.93','357.2','362.01','362.02','".
" '362.03','362.04','362.05','362.06','362.07','366.41','648.00','648.01','648.02','648.03','648.04',".
" ' E10.10','E10.11','E10.21','E10.22','E10.29','E10.311','E10.319','E10.321','E10.329','E10.331',".
" ' E10.339','E10.341','E10.349','E10.351','E10.359','E10.36','E10.39','E10.40','E10.41','E10.42',".
" 'E10.43','E10.44','E10.49','E10.51','E10.52','E10.59','E10.610','E10.618','E10.620','E10.621',".
" ' E10.622','E10.628','E10.630','E10.638','E10.641','E10.649','E10.65','E10.69','E10.8','E10.9',".
" 'E11.00','E11.01','E11.21','E11.22','E11.29','E11.311','E11.319','E11.321','E11.329','E11.331','".
" 'E11.339','E11.341','E11.349','E11.351','E11.359','E11.36','E11.39','E11.40','E11.41','E11.42',".
" ' E11.43','E11.44','E11.49','E11.51','E11.52','E11.59','E11.610','E11.618','E11.620','E11.621','".
" ' E11.622','E11.628','E11.630','E11.638','E11.641','E11.649','E11.65','E11.69','E11.8','E11.9',".
" 'O24.011','O24.012','O24.013','O24.019','O24.02','O24.03','O24.111','O24.112','O24.113','".
" 'O24.119','O24.12','O24.13')"

."AND b2.code IN".  //Procedure code must match one of the following
"('97802','97803','97804','99201','99202','99203','99204','99205','99211',99212','99213','99214','99215',".
" '99217','99218','99219','99220','99221','99222','99223','99231','99232','99233','99238','99239','99281',".
" '99282','99283','99284','99285','99291','99304','99305','99306','99307','99308','99309','99310','99315',".
" '99316','99318','99324','99325','99326','99327','99328','99334','99335','99336','99337','99341','99342',".
" '99343','99344','99345','99347','99348','99349','99350','G0270','G0271','G0402','G0438','G0439')"

." AND (YEAR(fe.date) - YEAR(p.DOB)) BETWEEN '18' AND '75' "  //age must be between 18 and 75 on the date of treatment
."AND YEAR(fe.date) ='2015' "  //date of the encounter must be in the year 2015.  This should actually check against a form variable.

."AND CONCAT(b3.code,b3.modifier) IN ('3046F','3046F8P','3044F','3045F')" //checking for CPT2 code with modifier. 
// Note that 3046F8P is a combination of code and modifier without a colon between them.  The query doesn't add that.
//This AND clause results in only records that have a reported CPT2 code to be shown.
//This is the numerator query addition.  We would only want this if we are sure that all CPT2 codes get reported, which makes this a non-functional example.

."ORDER BY b1.pid;" ; //list rows of data by the patient's ID number
//////////////////////////////////////////////////END of Query for  whole measure/////////////////////////////////////////////////////////////////////////////////////
/*
REAL QUERIES START HERE******************************************************
*/
/////////////////////////////////////Example to just check denominator/initial pop //////////////////////////////////////
$query_just_denominator_for_one_patient =
//"SELECT   b1.code AS Dx, b2.code AS Tx, fe.date AS DOS, p.pid AS PID, p.DOB AS DOB".  //We don't need all these fields as rows.  Really we just want a true/false comparison
"SELECT COUNT(b1.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1".  //b1 is the first billing table alias to get the diagnosis as Dx. denominator
"INNER JOIN billing AS b2 ON (b1.pid = b2.pid)".  //b2 is the second billing table alias to get the procedure code (CPT4 or G code) as Tx. We are matching the Patient ID (PID).  denominator
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".  //fe is the alias of form_encounter that gets the date of service for the Tx
"JOIN patient_data AS p ON (b1.pid = p.pid)".  //We join the patient_data table to check the patient's age.

"WHERE b1.pid = '$Patient' ".  ///only check for current patient, which is matched on the PID
"AND b1.user = '$Provider' ".
"AND b1.code IN".  //Diagnosis must match one of the following
"('250.00','250.01','250.02','250.03','250.10','250.11','250.12','250.13','250.20','250.21',".
" '250.22','250.23','250.30','250.31','250.32','250.33','250.40','250.41','250.42','250.43','250.50',".
" '250.51','250.52','250.53','250.60','250.61','250.62','250.63','250.70','250.71','250.72','250.73',".
" ' 250.80','250.81','250.82','250.83','250.90','250.91','250.92','250.93','357.2','362.01','362.02','".
" '362.03','362.04','362.05','362.06','362.07','366.41','648.00','648.01','648.02','648.03','648.04',".
" ' E10.10','E10.11','E10.21','E10.22','E10.29','E10.311','E10.319','E10.321','E10.329','E10.331',".
" ' E10.339','E10.341','E10.349','E10.351','E10.359','E10.36','E10.39','E10.40','E10.41','E10.42',".
" 'E10.43','E10.44','E10.49','E10.51','E10.52','E10.59','E10.610','E10.618','E10.620','E10.621',".
" ' E10.622','E10.628','E10.630','E10.638','E10.641','E10.649','E10.65','E10.69','E10.8','E10.9',".
" 'E11.00','E11.01','E11.21','E11.22','E11.29','E11.311','E11.319','E11.321','E11.329','E11.331','".
" 'E11.339','E11.341','E11.349','E11.351','E11.359','E11.36','E11.39','E11.40','E11.41','E11.42',".
" ' E11.43','E11.44','E11.49','E11.51','E11.52','E11.59','E11.610','E11.618','E11.620','E11.621','".
" ' E11.622','E11.628','E11.630','E11.638','E11.641','E11.649','E11.65','E11.69','E11.8','E11.9',".
" 'O24.011','O24.012','O24.013','O24.019','O24.02','O24.03','O24.111','O24.112','O24.113','".
" 'O24.119','O24.12','O24.13')"

."AND b2.code IN".  //Procedure code must match one of the following
"('97802','97803','97804','99201','99202','99203','99204','99205','99211',99212','99213','99214','99215',".
" '99217','99218','99219','99220','99221','99222','99223','99231','99232','99233','99238','99239','99281',".
" '99282','99283','99284','99285','99291','99304','99305','99306','99307','99308','99309','99310','99315',".
" '99316','99318','99324','99325','99326','99327','99328','99334','99335','99336','99337','99341','99342',".
" '99343','99344','99345','99347','99348','99349','99350','G0270','G0271','G0402','G0438','G0439');";

$result = sqlStatement($query_just_denominator_for_one_patient);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ $denominator=TRUE;} else {$denominator=FALSE;}  //there is a better way of stating this, but this is easier to understand for N00bs

/////////////////////////////End query just denominator for one patient//////////////////////////////

////////////////Check for numerator fail ( which is good!!!)////////////////////////////////
$query_just_numerator_fail_for_one_patient =
"SELECT COUNT(b1.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1".
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
"WHERE b1.pid = '$Patient' ".
"AND YEAR(fe.date) ='2015' "
."AND b1.code IN ('3044F','3045F');"; //checking for CPT2 code.

$result = sqlStatement($query_just_numerator_fail_for_one_patient);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ $numeratorfail=TRUE;} else {$numeratorfail=FALSE;}  //there is a better way of stating this, but this is easier to understand for N00bs

/////////////////Check if numerator was explicitly reported as passed (which is bad.  This is so stupid)///////////////////////////
//if the one above fails, you want to see if this result is confirmed by a code
if ($numeratorfail=FALSE){
$query_just_numerator_pass_for_one_patient =
"SELECT COUNT(b1.code)".  ///just give us a number as a result of all this, counting how many results we get.
"  FROM billing AS b1".
"JOIN form_encounter AS fe ON (b1.encounter = fe.encounter)".
"WHERE b1.pid = '$Patient' ".
"AND YEAR(fe.date) ='2015' ".
"AND CONCAT(b3.code,b3.modifier) IN ('3046F','3046F8P');" ;//checking for CPT2 code with modifier.

$result = sqlStatement($query_just_numerator_pass_for_one_patient);  ///runs the string $query_just.... as an sql statement.
//The query just gives you a number, not rows, which is the count of the rows it returned.
if ($result > 0){ $numeratorpassconfirmed=TRUE;} else {$numeratorpassconfirmed=FALSE;}  //there is a better way of stating this, but this is easier to understand for N00bs
}
/* In a function, the above code should not end this way.  We don't really want to assign boolean values to $numerator_... the function should just ask:
if ($result > 0){
				return true;
			}else{
				return false;
			}
			*/
?>
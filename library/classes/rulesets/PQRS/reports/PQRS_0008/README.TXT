PQRS_0008

Measure #8 (NQF 0083): Heart Failure (HF): Beta-Blocker Therapy for Left Ventricular Systolic Dysfunction (LVSD) 
National Quality Strategy Domain: Effective Clinical Care

2015 PQRS OPTIONS FOR INDIVIDUAL MEASURES: REGISTRY ONLY

DESCRIPTION:
Percentage of patients aged 18 years and older with a diagnosis of heart failure (HF) with a current or prior left ventricular ejection fraction (LVEF) < 40% who were prescribed beta-blocker therapy either within a 12 month period when seen in the outpatient setting OR at each hospital discharge

INSTRUCTIONS:
This measure is to be reported for all heart failure patients a minimum of once per reporting period when seen in the outpatient setting AND reported at each hospital discharge (99238* and 99239*) during the reporting period.
*NOTE: When reporting CPT code 99238 and 99239, it is recommended the measure be reported each time the code is submitted for hospital discharge.

Only patients who had at least two denominator eligible visits during the reporting period will be counted for Reporting Criteria 1.



There are two reporting criteria for this measure:
     1) Patients who are 18 years and older with a diagnosis of HF with a current or prior LVEF < 40% seen in the outpatient setting with two denominator eligible visits
OR
     2) Patients who are 18 years and older with a diagnosis of HF with a current or prior LVEF < 40% and discharged from hospital



REPORTING CRITERIA 1: All patients with a diagnosis of HF seen in the outpatient setting
DENOMINATOR (REPORTING CRITERIA 1):
//  All patients aged 18 years and older with a diagnosis of heart failure with a current or prior LVEF < 40%
*	Patients aged >= 18 years on date of encounter
AND
*	Diagnosis for heart failure (ICD-9-CM) [for use 1/1/2015-9/30/2015]: 
IN "( '402.01', '402.11', '402.91', '404.01', '404.03', '404.11', '404.13', '404.91', '404.93', '428.0', '428.1', '428.20', '428.21', '428.22', '428.23', '428.30', '428.31', '428.32', '428.33', '428.40', '428.41', '428.42', '428.43', '428.9', 'I11.0', 'I13.0', 'I13.2', 'I50.1', 'I50.20', 'I50.21', 'I50.22', 'I50.23', 'I50.30', 'I50.31', 'I50.32', 'I50.33', 'I50.40', 'I50.41', 'I50.42', 'I50.43', 'I50.9' )"
AND
*	Patient encounter(s) during the reporting period (CPT): 
IN "( '99201', '99202', '99203', '99204', '99205', '99212', '99213', '99214', '99215', '99304', '99305', '99306', '99307', '99308', '99309', '99310', '99324', '99325', '99326', '99327', '99328', '99334', '99335', '99336', '99337', '99341', '99342', '99343', '99344', '99345', '99347', '99348', '99349', '99350' )"
AND
*	Two Denominator Eligible Visits
AND
*	Left ventricular ejection fraction (LVEF) < 40% or documentation of moderately or severely depressed left ventricular systolic function: 
*	G8923

NUMERATOR (REPORTING CRITERIA 1):
// Patients who were prescribed beta-blocker therapy within a 12 month period when seen in the outpatient setting
//	Definitions:
//	Prescribed â Outpatient Setting - May include prescription given to the patient for beta-blocker therapy at one or more visits in the measurement period OR patient already taking beta-blocker therapy as documented in current medication list.
//	Beta-blocker Therapy - For patients with prior LVEF < 40%, beta-blocker therapy should include bisoprolol, carvedilol, or sustained release metoprolol succinate.


Numerator Options:
Performance Met:
//	Beta-blocker therapy prescribed 
//	OR  Other Performance Exclusion: Beta-Blocker Therapy for LVEF < 40% not prescribed for reasons documented by the clinician (eg, low blood pressure, fluid overload, asthma, patients recently treated with an intravenous positive inotropic agent, allergy, intolerance, other medical reasons, patient declined, other patient reasons, or other reasons attributable to the healthcare system) 
*	IN "('G8450', 'G8451' )"


Performance Not Met:
//	Beta-blocker therapy not prescribed 
*	G8452



REPORTING CRITERIA 2: All patients with a diagnosis of HF and discharged from hospital
DENOMINATOR (REPORTING CRITERIA 2):
//  All patients aged 18 years and older with a diagnosis of heart failure with a current or prior LVEF < 40%
*	Patients aged >= 18 years on date of encounter
AND
*	Diagnosis for heart failure (ICD-9-CM/ICD-10-CM)
IN "( '402.01', '402.11', '402.91', '404.01', '404.03', '404.11', '404.13', '404.91', '404.93', '428.0', '428.1', '428.20', '428.21', '428.22', '428.23', '428.30', '428.31', '428.32', '428.33', '428.40', '428.41', '428.42', '428.43', '428.9', 'I11.0', 'I13.0', 'I13.2', 'I50.1', 'I50.20', 'I50.21', 'I50.22', 'I50.23', 'I50.30', 'I50.31', 'I50.32', 'I50.33', 'I50.40', 'I50.41', 'I50.42', 'I50.43', 'I50.9' )"
AND
*	Patient encounter during reporting period (CPT): 
IN "( '99238', '99239' )"
/*  *NOTE: When reporting CPT code 99238 and 99239, it is recommended the measure be reported each time the code is submitted for hospital discharge. */
AND
*	Left ventricular ejection fraction (LVEF) < 40% or documentation of moderately or severely depressed left ventricular systolic function: 
*	3021F


NUMERATOR (REPORTING CRITERIA 2):
//  Patients who were prescribed beta-blocker therapy at each hospital discharge

Numerator Options:
Performance Met:
//	Beta-blocker therapy prescribed 
//	OR  Other Performance Exclusion: Beta-Blocker Therapy for LVEF < 40% not prescribed for reasons documented by the clinician (eg, low blood pressure, fluid overload, asthma, patients recently treated with an intravenous positive inotropic agent, allergy, intolerance, other medical reasons, patient declined, other patient reasons, other reasons attributable to the healthcare system) 
*	IN "('G8450', 'G8451' )"


Performance Not Met:         
//	Beta-blocker therapy not prescribed 
*	G8452


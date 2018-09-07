<?php
/* Copyright (C) 2015 - 2017      Suncoast Connection
 * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @author  Bryan lee <leebc@suncoastconnection.com>
 * @author  Lana Woods <lana@suncoastconnection.com>
 * @package LibreHealthEHR 
 * @link    http://suncoastconnection.com
 * @link    http://librehealth.io
 *
 * Please support this product by sharing your changes with the LibreHealth.io community.
 */

$query =
"DROP TABLE IF EXISTS `pqrs_direct_entry_lookup`;";
sqlStatementNoLog($query);

$query =
"CREATE TABLE `pqrs_direct_entry_lookup` (
`measure_number` varchar(50),
`type` varchar(100),
`value` varchar(3072),
`status` INT(1) );";
sqlStatementNoLog($query);


$query ="INSERT INTO `pqrs_direct_entry_lookup` (`measure_number`, `type`, `value`,`status`) VALUES
('PQRS_0001', 'description', 'Blood Glucose',''),
('PQRS_0001', 'question', 'What was the patient\'s most recent hemoglobin A1c (HbA1c) level?',''),
('PQRS_0001', 'answer', '1|A1c (HbA1c) level < 7.0%|3044F',9),
('PQRS_0001', 'answer', '2|A1c (HbA1c) level 7.0 to 9.0%|3045F',9),
('PQRS_0001', 'answer', '3|A1c level > 9.0%|3046F',1),
('PQRS_0001', 'answer', '4|A1c check not performed during period|3046F:8P',1),

('PQRS_0005', 'description', 'Heart Failure (HF): Angiotensin-Converting Enzyme (ACE) Inhibitor or Angiotensin Receptor Blocker (ARB) Therapy for Left Ventricular Systolic Dysfunction (LVSD)<br>Percentage of patients aged 18 years and older with a diagnosis of heart failure (HF) with a current or prior left ventricular ejection fraction (LVEF) < 40% who were prescribed ACE inhibitor or ARB therapy either within a 12 month period when seen in the outpatient setting OR at each hospital discharge',''),
('PQRS_0005', 'question', 'Was patient prescribed ACE inhibitor or ARB therapy within a 12 month period when seen in the outpatient setting OR at hospital discharge?',''),
('PQRS_0005', 'answer', '1|ACE Inhibitor or ARB therapy prescribed or currently being taken (4010F)|4010F',1),
('PQRS_0005', 'answer', '2|Documentation of medical reason(s) for not prescribing ACE inhibitor or ARB therapy (eg, hypotensive patients who are at immediate risk of cardiogenic shock, hospitalized patients who have experienced marked azotemia, allergy, intolerance, other medical reasons) (4010F with 1P)|4010F:1P',2),
('PQRS_0005', 'answer', '3|Documentation of patient reason(s) for not prescribing ACE inhibitor or ARB therapy (eg, patient declined, other patient reasons) (4010F with 2P)|4010F:2P',2),
('PQRS_0005', 'answer', '4| Documentation of system reason(s) for not prescribing ACE inhibitor or ARB therapy (eg, other system reasons) (4010F with 3P)|4010F:3P',2),
('PQRS_0005', 'answer', '5|ACE inhibitor or angiotensin receptor blocker (ARB) therapy was not prescribed, reason not otherwise specified (4010F with 8P)|4010F:8P',9),

('PQRS_0006', 'description', 'Coronary Artery Disease (CAD): Antiplatelet Therapy',''),
('PQRS_0006', 'question', 'Was patient prescribed aspirin or clopidogrel?',''),

('PQRS_0006', 'answer', '1|Aspirin or clopidogrel prescribed|4086F',1),
('PQRS_0006', 'answer', '2|Documentation of medical reason(s) for not prescribing aspirin or clopidogrel (eg, allergy, intolerance, receiving other thienopyridine therapy, receiving warfarin therapy, bleeding coagulation disorders, other medical reasons)|4086F:1P',2),
('PQRS_0006', 'answer', '3|Documentation of patient reason(s) for not prescribing aspirin or clopidogrel (eg, patient declined, other patient reasons)|4086F:2P',2),
('PQRS_0006', 'answer', '4|Documentation of system reason(s) for not prescribing aspirin or clopidogrel (eg, lack of drug availability, other reasons attributable to the health care system)|4086F:3P',2),
('PQRS_0006', 'answer', '5|Aspirin or clopidogrel was not prescribed, reason not otherwise specified|4086F:8P',9),

('PQRS_0007', 'description', 'Coronary Artery Disease (CAD): Beta-Blocker Therapy -- Prior Myocardial Infarction (MI) or Left Ventricular Systolic Dysfunction (LVEF < 40%)',''),
('PQRS_0007', 'question', 'Was patient prescribed beta-blocker therapy?',''),
('PQRS_0007', 'answer', '1|Beta-blocker therapy prescribed or currently being taken|G9189',1),
('PQRS_0007', 'answer', '2|Documentation of medical reason(s) for not prescribing beta-blocker therapy (e.g., allergy, intolerance, other medical reasons)|G9190',2),
('PQRS_0007', 'answer', '3|Documentation of patient reason(s) for not prescribing beta-blocker therapy (e.g., patient declined, other patient reasons)|G9191',2),
('PQRS_0007', 'answer', '4|Documentation of system reason(s) for not prescribing beta-blocker therapy (e.g., other reasons attributable to the health care system)|G9192',2),
('PQRS_0007', 'answer', '5|Beta-blocker therapy not prescribed, reason not given|G9188',9),

('PQRS_0008', 'description', 'Heart Failure (HF): Beta-Blocker Therapy for Left Ventricular Systolic Dysfunction (LVSD)',''),
('PQRS_0008', 'question', 'Was Patient prescribed beta-blocker therapy within a 12 month period when seen in the outpatient setting or at each hospital discharge?',''),
('PQRS_0008', 'answer', '1|Beta-blocker therapy prescribed|G8450',1),
('PQRS_0008', 'answer', '2|Beta-Blocker Therapy for LVEF < 40% not prescribed for reasons documented by the clinician (e.g., low blood pressure, fluid overload, asthma, patients recently treated with an intravenous positive inotropic agent, allergy, intolerance, other medical reasons, patient declined, other patient reasons, or other reasons attributable to the healthcare system)|G8451',2),
('PQRS_0008', 'answer', '3|Beta-blocker therapy not prescribed|G8452',9),

('PQRS_0012', 'description', 'Primary Open-Angle Glaucoma (POAG): Optic Nerve Evaluation',''),
('PQRS_0012', 'question', 'Did patients have an optic nerve head evaluation during one or more office visits within 12 months',''),
('PQRS_0012', 'answer', '1|Optic nerve head evaluation performed (2027F)|2027F',1),
('PQRS_0012', 'answer', '2|Documentation of medical reason(s) for not performing an optic nerve head evaluation (2027F:1P)|2027F:1P',2),
('PQRS_0012', 'answer', '3|Optic nerve head evaluation was not performed, reason not otherwise specified (2027F:8P)|2027F:8P',9),

('PQRS_0014', 'description', 'Age-Related Macular Degeneration (AMD): Dilated Macular Examination ',''),
('PQRS_0014', 'question', 'Did patient have a dilated macular examination performed which included documentation of the presence or absence of macular thickening or hemorrhage AND the level of macular degeneration severity during one or more office visits within 12 months',''),
('PQRS_0014', 'answer', '1|Dilated macular exam performed, including documentation of the presence or absence of macular thickening or hemorrhage AND the level of macular degeneration severity (2019F)|2019F',1),
('PQRS_0014', 'answer', '2|Documentation of medical reason(s) for not performing a dilated macular examination (2019F:1P)|2019F:1P',2),
('PQRS_0014', 'answer', '3|Documentation of patient reason(s) for not performing a dilated macular examination(2019F:2P)|2019F:2P',2),
('PQRS_0014', 'answer', '4|Dilated macular exam was not performed, reason not otherwise specified (2019F:8P)|2019F:8P',9),

('PQRS_0019', 'description', 'Diabetic Retinopathy: Communication with the Physician Managing Ongoing Diabetes Care<p>***Please see measure documentation for specifics.***<p>',''),
('PQRS_0019', 'question', 'Patients with documentation, at least once within 12 months, of the findings of the dilated macular or fundus exam via communication to the physician who manages the patient\'s diabetic care<br>Definitions:<br>Communication -- May include documentation in the medical record indicating that the findings of the dilated macular or fundus exam were communicated (e.g., verbally, by letter) with the clinician managing the patient\'s diabetic care OR a copy of a letter in the medical record to the clinician managing the patient\'s diabetic care outlining the findings of the dilated macular or fundus exam.<br>Findings -- Includes level of severity of retinopathy (e.g., mild nonproliferative, moderate nonproliferative, severe nonproliferative, very severe nonproliferative, proliferative) AND the presence or absence of macular edema.',''),
('PQRS_0019', 'answer', '1|Dilated macular or fundus exam performed, including documentation of the presence or absence of macular edema AND level of severity of retinopathy; AND Findings of dilated macular or fundus exam communicated to the physician or other qualified health care professional managing the diabetes care (5010F G8397)|5010F G8397',1),
('PQRS_0019', 'answer', '2|Dilated macular or fundus exam performed, including documentation of the presence or absence of macular edema AND level of severity of retinopathy; AND Documentation of medical reason(s) for not communicating the findings of the dilated macular or fundus exam to the physician who manages the ongoing care of the patient with diabetes(5010F:1P G8397)|5010F:1P G8397',2),
('PQRS_0019', 'answer', '3|Dilated macular or fundus exam performed, including documentation of the presence or absence of macular edema AND level of severity of retinopathy; AND Documentation of patient reason(s) for not communicating the findings of the dilated macular or fundus exam to the physician who manages the ongoing care of the patient with diabetes(5010F:2P G8397)|5010F:2P G8397',2),
('PQRS_0019', 'answer', '4|Documentation of medical reason(s) for not communicating the findings of the dilated macular or fundus exam to the physician who manages the ongoing care of the patient with diabetes(5010F:1P G8397)|5010F:1P G8397',2),
('PQRS_0019', 'answer', '5|Patient is not eligible for this measure because patient did not have dilated macular or fundus exam performed (G8398)|G8398',2),
('PQRS_0019', 'answer', '6|Dilated macular or fundus exam performed, including documentation of the presence or absence of macular edema AND level of severity of retinopathy; AND Findings of dilated macular or fundus exam were not communicated to the physician managing the diabetes care, reason not otherwise specified(5010F:8P G8397)|5010F:8P G8397',9),

('PQRS_0021', 'description', 'Perioperative Care: Selection of Prophylactic Antibiotic -- First OR Second Generation Cephalosporin <p> ***Please see measure documentation for specifics.***<p>',''),
('PQRS_0021', 'question', 'Did this Surgical patient have an order for a first OR second generation cephalosporin for antimicrobial prophylaxis?<br>INSTRUCTIONS: There must be documentation of an order (written order, verbal order, or standing order/protocol) for a first OR second generation cephalosporin for antimicrobial prophylaxis OR documentation that a first OR second generation cephalosporin was given.<br>NOTE: In the event surgery is delayed, as long as the patient is redosed (if clinically appropriate) the numerator coding should be applied.',''),
('PQRS_0021', 'answer', '1|Documentation of Order for First or Second Generation Cephalosporin for Antimicrobial Prophylaxis (written order, verbal order, or standing order/protocol) (G9197)|G9197',1),
('PQRS_0021', 'answer', '2|Documentation of medical reason(s) for not ordering a first OR second generation cephalosporin for antimicrobial prophylaxis (e.g., patients enrolled in clinical trials, patients with documented infection prior to surgical procedure of interest, patients who were receiving antibiotics more than 24 hours prior to surgery [except colon surgery patients taking oral prophylactic antibiotics], patients who were receiving antibiotics within 24 hours prior to arrival [except colon surgery patients taking oral prophylactic antibiotics], other medical reason(s)) (G9196)|G9196',2),
('PQRS_0021', 'answer', '3|Order for first OR second generation cephalosporin for antimicrobial prophylaxis was not documented, reason not given (G9198)|G9198',9),

('PQRS_0023', 'description', 'Perioperative Care: Venous Thromboembolism (VTE) Prophylaxis (When Indicated in ALL Patients)<br>Percentage of surgical patients aged 18 years and older undergoing procedures for which venous thromboembolism (VTE) prophylaxis is indicated in all patients, who had an order for Low Molecular Weight Heparin (LMWH), LowDose Unfractionated Heparin (LDUH), adjusted-dose warfarin, fondaparinux or mechanical prophylaxis to be given within 24 hours prior to incision time or within 24 hours after surgery end time',''),
('PQRS_0023', 'quesion', 'Did this surgical patient have an order for LMWH, LDUH, adjusted-dose warfarin, fondaparinux or mechanical prophylaxis to be given within 24 hours prior to incision time or within 24 hours after surgery end time<br>There must be documentation of order (written order, verbal order, or standing order/protocol) for VTE prophylaxis OR documentation that VTE prophylaxis was given.<br>Definition:<br> Mechanical Prophylaxis -- Does not include TED hose.<br>Note: A single CPT Category II code is provided for VTE prophylaxis ordered or VTE prophylaxis given. If VTE prophylaxis is given, report 4044F.',''),
('PQRS_0023', 'answer', '1|Documentation that an order was given for venous thromboembolism (VTE) prophylaxis to be given within 24 hours prior to incision time or 24 hours after surgery end time (4044F)|4044F',1),
('PQRS_0023', 'answer', '2|VTE Prophylaxis not Ordered for Medical Reasons (4044F:1P)|4044F:1P',2),
('PQRS_0023', 'answer', '3|VTE Prophylaxis not Ordered, Reason not Otherwise Specified (4044F:8P)|4044F:8P',9),

('PQRS_0024', 'description', 'Communication with the Physician or Other Clinician Managing On-going Care Post-Fracture for Men and Women Aged 50 Years and Older<br>Percentage of patients aged 50 years and older treated for a fracture with documentation of communication, between the physician treating the fracture and the physician or other clinician managing the patient\'s on-going care, that a fracture occurred and that the patient was or should be considered for osteoporosis treatment or testing. This measure is reported by the physician who treats the fracture and who therefore is held accountable for the communication',''),
('PQRS_0024', 'question', 'Is there documentation of communication with the physician or other clinician managing the patient\'s on-going care that a fracture occurred and that the patient was or should be considered for osteoporosis testing or treatment?<br>Definition:<br>Communication -- May include documentation in the medical record indicating that the clinician treating the fracture communicated (e.g., verbally, by letter, through shared electronic health record, a bone mineral density test report was sent) with the clinician managing the patient\'s on-going care OR a copy of a letter in the medical record outlining whether the patient was or should be treated for osteoporosis.',''),
('PQRS_0024', 'answer', '1|Post Fracture Care Communication Documented (5015F)|5015F',1),
('PQRS_0024', 'answer', '2|Post Fracture Care not Communicated for Medical Reasons (5015F:1P)|5015F:1P',2),
('PQRS_0024', 'answer', '3|Post Fracture Care not Communicated for Patient Reasons (5015F:2P)|5015F:2P',2),
('PQRS_0024', 'answer', '4|Post Fracture Care not Communicated Reason not Otherwise Specified (5015F:8P)|5015F:8P',9),

('PQRS_0039', 'description', 'Screening for Osteoporosis for Women Aged 65-85 Years of Age',''),
('PQRS_0039', 'question', 'Is there documentation in their medical record of having received a DXA test of the hip or spine?',''),
('PQRS_0039', 'answer', '1|Central DXA Measurement Performed (G8399)|G8399',1),
('PQRS_0039', 'answer', '2|Central DXA Measurement not Performed for Documented Reasons (G8401)|G8401',2),
('PQRS_0039', 'answer', '3|Central DXA Measurement not Performed, Reason not Given (G8400)|G8400',9),

('PQRS_0043', 'description', 'Coronary Artery Bypass Graft (CABG): Use of Internal Mammary Artery (IMA) in Patients with Isolated CABG Surgery',''),
('PQRS_0043', 'question', 'Did Patients undergoing isolated CABG who received an IMA graft?  <p>  Please see Measure Documentation',''),
('PQRS_0043', 'answer', '1|(4110F)|4110F',1),
('PQRS_0043', 'answer', '2|(4110F:1P)|4110F:1P',2),
('PQRS_0043', 'answer', '3|(4110F:8P)|4110F:8P',9),

('PQRS_0044', 'description', 'Coronary Artery Bypass Graft (CABG): Preoperative Beta-Blocker in Patients with Isolated CABG Surgery',''),
('PQRS_0044', 'question', 'Did patient received a beta-blocker within 24 hours prior to surgical incision of isolated CABG surgeries?<p> Please see Measure documentation',''),
('PQRS_0044', 'answer', '1|Beta blocker administered within 24 hours prior to surgical incision (4115F)|4115F',1),
('PQRS_0044', 'answer', '2|Documentation of medical reason(s) for not administering beta blocker within 24 hours prior to surgical incision (e.g., not indicated, contraindicated, other medical reason) (4115F:1P)|4115F:1P',2),
('PQRS_0044', 'answer', '3|Beta blocker not administered within 24 hours prior to surgical incision, reason not otherwise specified (4115F:8P)|4115F:8P',9),

('PQRS_0046', 'description', 'Medication Reconciliation Post-Discharge',''),
('PQRS_0046', 'question', 'Was Medication reconciliation conducted by a prescribing practitioner, clinical pharmacists or registered nurse on or within 30 days of discharge?<p>Definition:  Medication Reconciliation -- A type of review in which the discharge medications are reconciled with the most recent medication list in the outpatient medical record. Documentation in the outpatient medical record must include evidence of medication reconciliation and the date on which it was performed. Any of the following evidence meets criteria: (1) Documentation of the current medications with a notation that references the discharge medications (e.g., no changes in meds since discharge, same meds at discharge, discontinue all discharge meds), (2) Documentation of the patient\'s current medications with a notation that the discharge medications were reviewed, (3) Documentation that the provider ''reconciled the current and discharge meds,'' (4) Documentation of a current medication list, a discharge medication list and notation that the appropriate practitioner type reviewed both lists on the same date of service, (5) Notation that no medications were prescribed or ordered upon discharge',''),
('PQRS_0046', 'answer', '1|Documentation of Reconciliation of Discharge Medication with Current Medication List in the Medical Record (1111F)|1111F',1),
('PQRS_0046', 'answer', '2|Discharge Medication not Reconciled with Current Medication List in the Medical Record, Reason Not Otherwise Specified (1111F:8P)|(1111F:8P',9),

('PQRS_0047', 'description', 'Care Plan',''),
('PQRS_0047', 'question', 'Was Care Plan discussed and documented?<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0047', 'answer', '1|Advance Care Planning discussed and documented; advance care plan or surrogate decision maker documented in the medical record(1123F)|1123F',1),
('PQRS_0047', 'answer', '2|Advance Care Planning discussed and documented in the medical record; patient did not wish or was not able to name a surrogate decision maker or provide an advance care plan; If patients cultural and/or spiritual beliefs preclude a discussion of advance care planning(1124F)|1124F',1),
('PQRS_0047', 'answer', '3|Advance care planning not documented, reason not otherwise specified(1123F:8P)|1123F:8P',9),

('PQRS_0048', 'description', 'Percentage of female patients, aged 65 years and older, who were assessed for the presence or absence of urinary incontinence within 12 months',''),
('PQRS_0048', 'question', 'Was this patient assessed for the presence or absence of urinary incontinence within 12 months?',''),
('PQRS_0048', 'answer', '1|Presence or absence of urinary incontinence assessed (1090F)|1090F',1),
('PQRS_0048', 'answer', '2|Documentation of medical reason(s) for not assessing for the presence or absence of urinary incontinence (1090F:1P)|1090F:1P',2),
('PQRS_0048', 'answer', '3|Presence or absence of urinary incontinence not assessed, reason not otherwise specified (1090F:8P)|1090F:8P',9),

('PQRS_0050', 'description', 'Incontinence: Plan of Care for Urinary Incontinence in Women Aged 65 Years and Older',''),
('PQRS_0050', 'question', 'Does patient have a documented plan of care for urinary incontinence at least once within 12 months?<br>Plan of Care -- May include behavioral interventions (e.g., bladder training, pelvic floor muscle training, prompted voiding), referral to specialist, surgical treatment, reassess at follow-up visit, lifestyle interventions, addressing co-morbid factors, modification or discontinuation of medications contributing to urinary incontinence, or pharmacologic therapy.',''),
('PQRS_0050', 'answer', '1|Plan of Care for Urinary Incontinence Documented (0509F)|0509F',1),
('PQRS_0050', 'answer', '2|Plan of Care for Urinary Incontinence not Documented, Reason not Otherwise Specified(0509F:8P)|0509F:8P',9),

('PQRS_0051', 'description', 'Chronic Obstructive Pulmonary Disease (COPD): Spirometry Evaluation',''),
('PQRS_0051', 'question', 'Patients with documented spirometry results in the medical record (FEV1 and FEV1/FVC)<br>Numerator Instructions: Look for most recent documentation of spirometry results in the medical record; do not limit the search to the reporting period.',''),
('PQRS_0051', 'answer', '1|Spirometry Results Documented and reviewed (3023F)|3023F',1),
('PQRS_0051', 'answer', '2|Spirometry Results not Documented for Medical Reasons (3023F:1P)|3023F:1P',2),
('PQRS_0051', 'answer', '3|Spirometry Results not Documented for Patient Reasons (3023F:2P)|3023F:2P',2),
('PQRS_0051', 'answer', '4|Spirometry Results not Documented for System Reasons (3023F:3P)|3023F:3P',2),
('PQRS_0051', 'answer', '5|Spirometry Results not Documented, Reason not Otherwise Specified (3023F:8P)|3023F:8P',9),

('PQRS_0052', 'description', 'Chronic Obstructive Pulmonary Disease (COPD): Inhaled Bronchodilator Therapy',''),
('PQRS_0052', 'question', 'Was patient prescribed an inhaled bronchodilator?',''),
('PQRS_0052', 'answer', '1|Long-acting inhaled bronchodilator prescribed (G9695)|4025F G8924',1),
('PQRS_0052', 'answer', '2|Documentation of medical reason(s) for not prescribing a long-acting inhaled bronchodilator (G9696|G9696',2),
('PQRS_0052', 'answer', '3|Documentation of patient reason(s) for not prescribing a long-acting inhaled bronchodilator (G9697)|G9697',2),
('PQRS_0052', 'answer', '4|Documentation of system reason(s) for not prescribing a long-acting inhaled bronchodilator (G9698)|G9698',2),
('PQRS_0052', 'answer', '5|Long-acting inhaled bronchodilator not prescribed, reason not otherwise specified(G9699)|G9699',9),

('PQRS_0065', 'description', 'Appropriate Treatment for Children with Upper Respiratory Infection (URI)<p>***See Measure Documentation***<p>',''),
('PQRS_0065', 'question', 'Patients who were not prescribed or dispensed a prescription for antibiotic medication on or within 3 days after the URI Episode date<br>Numerator Instructions: For performance, the measure will be calculated as the number of patient\'s encounter(s) where antibiotics were neither prescribed nor dispensed on or within three days of the episode for URI over the total number of encounters in the denominator (patients aged 3 months through 18 years with an outpatient or ED visit for URI. A higher score indicates appropriate treatment of patients with URI (e.g., the proportion for whom antibiotics were not prescribed or dispensed following the episode).',''),
('PQRS_0065', 'answer', '1|Patient not prescribed or dispensed antibiotic (G8708)|G8708',1),
('PQRS_0065', 'answer', '2|Patient prescribed or dispensed antibiotic for documented medical reason(s) (G8709)|G8709',2),
('PQRS_0065', 'answer', '3|Patient prescribed or dispensed antibiotic (G8710)|G8710',9),

('PQRS_0066', 'description', 'Appropriate Testing for Children with Pharyngitis',''),
('PQRS_0066', 'question', 'Children with a group A streptococcus test in the 7-day period from 3 days prior through 3 days after the pharyngitis episode date<br>Numerator Instructions: For performance, the measure will be calculated as the number of patient encounters where diagnosed with pharyngitis, dispensed an antibiotic and received a group A streptococcus (strep) test for the episode over the total number of encounters in the denominator (patients aged 3 through 18 years with an outpatient or ED visit and an antibiotic ordered on or three days after the visit). A higher score indicates appropriate treatment of children with pharyngitis (e.g., the proportion for whom antibiotics were prescribed with an accompanying step test).',''),
('PQRS_0066', 'answer', '1|Group A Strep Test Performed (3210F)|3210F',1),
('PQRS_0066', 'answer', '2|Group A Strep Test not Performed, reason not otherwise specified (3210F with 8P)|3210F:8P',9),

('PQRS_0067', 'description', 'Hematology: Myelodysplastic Syndrome (MDS) and Acute Leukemias: Baseline Cytogenetic Testing Performed on Bone Marrow',''),
('PQRS_0067', 'question', 'Did patient have baseline cytogenetic testing performed on bone marrow?<br>Definition:<br>Baseline Cytogenetic Testing -- Testing that is performed at time of diagnosis or prior to initiating treatment (transfusion, growth factors, or antineoplastic therapy) for that diagnosis',''),
('PQRS_0067', 'answer', '1|Cytogenetic testing performed on bone marrow at time of diagnosis or prior to initiating treatment (3155F)|3155F',1),
('PQRS_0067', 'answer', '2| Medical Performance Exclusion: Documentation of reason(s) (3155F:1P)|3155F:1P',2),
('PQRS_0067', 'answer', '3|Patient Performance Exclusion: Documentation of reason(s)(3155F:2P)|3155F:2P',2),
('PQRS_0067', 'answer', '4|System Performance Exclusion: Documentation of reason(s) (3155F:3P|3155F:3P',2),
('PQRS_0067', 'answer', '5|Cytogenetic testing not performed on bone marrow at time of diagnosis or prior to initiating treatment, reason not otherwise specified (3155F with 8P)|3155F:8P',9),

('PQRS_0068', 'description', 'Hematology: Myelodysplastic Syndrome (MDS): Documentation of Iron Stores in Patients Receiving Erythropoietin Therapy',''),
('PQRS_0068', 'question', 'Did patients have documentation of iron stores within 60 days prior to initiating erythropoietin therapy?<br>Documentation of Iron Stores -- Includes either: 1) bone marrow examination including iron stain OR 2) serum iron measurement including ferritin, serum iron and total iron-binding capacity (TIBC).',''),
('PQRS_0068', 'answer', '1|Documentation of iron stores prior to initiating erythropoietin therapy (3160F)|3160F',1),
('PQRS_0068', 'answer', '2|Documentation of system reason(s) for not documenting iron stores prior to initiating erythropoietin therapy (3160F with 3P)|3160F:3P',2),
('PQRS_0068', 'answer', '3|Iron stores prior to initiating erythropoietin therapy not documented, reason not otherwise specified (3160F:8P)|3160F:8P',9),

('PQRS_0069', 'description', 'Hematology: Multiple Myeloma: Treatment with Bisphosphonates',''), 
('PQRS_0069', 'question', 'Was patients prescribed or received intravenous bisphosphonate therapy within the 12 month reporting period<br>Definitions:<br>Bisphosphonate Therapy -- Includes the following medications: pamidronate and zoledronate.<br>Prescribed -- Includes patients who are currently receiving medication(s) that follow the treatment plan recommended at an encounter during the reporting period, even if the prescription for that medication was ordered prior to the encounter.',''),
('PQRS_0069', 'answer', '1|Bisphosphonate therapy, intravenous, ordered or received (4100F)|4100F',1),
('PQRS_0069', 'answer', '2|Documentation of medical reason(s) for not prescribing bisphosphonates (eg, patients who do not have bone disease, patients with dental disease, patients with renal insufficiency) (4100F:1P)|4100F:1P',2),
('PQRS_0069', 'answer', '3|Documentation of patient reason(s) for not prescribing bisphosphonates (4100F with 2P)|4100F:2P',2),
('PQRS_0069', 'answer', '4|Bisphosphonate therapy, intravenous, not ordered or received, reason not otherwise specified (4100F:8P)|4100F:8P',9),

('PQRS_0070', 'description', 'Hematology: Chronic Lymphocytic Leukemia (CLL): Baseline Flow Cytometry',''),
('PQRS_0070', 'question', 'Patients who had baseline flow cytometry studies performed and documented in the chart<br>Definition:<br>Baseline Flow Cytometry Studies -- Refer to testing that is performed at time of diagnosis or prior to initiating treatment for that diagnosis. Treatment may include anti-neoplastic therapy.',''),
('PQRS_0070', 'answer', '1|Flow cytometry studies performed at time of diagnosis or prior to initiating treatment (3170F)|3170F',1),
('PQRS_0070', 'answer', '2|Documentation of medical reason(s) for not performing baseline flow cytometry studies (3170F with 1P)|3170F:1P',2),
('PQRS_0070', 'answer', '3|Documentation of patient reason(s) for not performing baseline flow cytometry studies (eg, receiving palliative care or not receiving treatment as defined above) (3170F:2P)|3170F:2P',2),
('PQRS_0070', 'answer', '4|Documentation of system reason(s) for not performing baseline flow cytometry studies (eg, patient previously treated by another physician at the time baseline flow cytometry studies were performed) (3170F with 3P)|3170F:3P',2),
('PQRS_0070', 'answer', '5|Flow cytometry studies not performed at time of diagnosis or prior to initiating treatment, reason not otherwise specified (3170F with 8P)|3170F:8P',9),

('PQRS_0076', 'description', 'Prevention of Central Venous Catheter (CVC) - Related Bloodstream Infections',''),
('PQRS_0076', 'question', 'Patients for whom central venous catheter (CVC) was inserted with all elements of maximal sterile barrier technique, hand hygiene, skin preparation and, if ultrasound is used, sterile ultrasound techniques followed<br>Definitions:<br>Maximal Sterile Barrier Technique -- includes all of the following elements: Cap AND mask AND sterile gown AND sterile gloves AND sterile full body drape.<br>Sterile Ultrasound Techniques -- require sterile gel and sterile probe covers.',''),
('PQRS_0076', 'answer', '1|All elements of maximal sterile barrier technique, hand hygiene, skin preparation and, if ultrasound is used, sterile ultrasound techniques followed (6030F)|6030F',1),
('PQRS_0076', 'answer', '2|All Elements of Maximal Sterile Barrier Technique not Followed for Documented Medical Reasons (including increased risk of harm to patient if adherence to aseptic technique would cause delay in CVC insertion) (6030F:1P)|6030F:1P',2),
('PQRS_0076', 'answer', '3|All Elements of Maximal Sterile Barrier Technique not Followed, Reason not Otherwise Specified (6030F:8P)|6030F:8P',9),

('PQRS_0091', 'description', 'Acute Otitis Externa (AOE): Topical Therapy',''),
('PQRS_0091', 'question', 'Was Patient prescribed a topical preparation?<br>Definition:<br>Prescribed -- May include prescription given to the patient for topical preparations at one or more visits during the episode of AOE OR patient already receiving topical preparations as documented in the currentmedication list.',''),
('PQRS_0091', 'answer', '1|Topical preparations (including OTC) prescribed for acute otitis externa (4130F)|4130F',1),
('PQRS_0091', 'answer', '2|Documentation of medical reason(s) for not prescribing topical preparations (including OTC) for acute otitis externa (eg, coexisting acute otitis media, tympanic membrane perforation) (4130F:1P)|4130F:1P',''),
('PQRS_0091', 'answer', '3|Documentation of patient reason(s) for not prescribing topical preparations (including OTC) for acute otitis externa (4130F:2P)|4130F:2P',2),
('PQRS_0091', 'answer', '4|Topical preparations (including OTC) for acute otitis externa (AOE) not prescribed, reason not otherwise specified (4130F:8P)|4130F:8P',''),

('PQRS_0093', 'description', 'Acute Otitis Externa (AOE): Systemic Antimicrobial Therapy -- Avoidance of Inappropriate Use',''),
('PQRS_0093', 'question', 'Patients who were not prescribed systemic antimicrobial therapy',''),
('PQRS_0093', 'answer', '1|Systemic Antimicrobial Therapy not Prescribed (4132F)|4132F',1),
('PQRS_0093', 'answer', '2|Systemic Antimicrobial Therapy Prescribed for Medical Reasons (4131F:1P)|4131F:1P',2),
('PQRS_0093', 'answer', '3|Systemic Antimicrobial Therapy Prescribed (4131F)|4131F',9),

('PQRS_0099', 'description', 'Breast Cancer Resection Pathology Reporting: pT Category (Primary Tumor) and pN Category (Regional Lymph Nodes) with Histologic Grade',''),
('PQRS_0099', 'question', 'Does pathology Report include the pT category, the pN category and the histologic grade?',''),
('PQRS_0099', 'answer', '1|pT category (primary tumor), pN category (regional lymph nodes), and histologic grade documented in pathology report (3260F)|3260F',1),
('PQRS_0099', 'answer', '2|pT Category, pN Category and Histologic Grade not Documented for documented Medical Reasons (3260F:1P)|3260F:1P',2),
('PQRS_0099', 'answer', '3|pT Category, pN Category and Histologic Grade not Documented, Reason not Otherwise Specified (3260F:8P)|3260F:8P',9),

('PQRS_0100', 'description', 'Colorectal Cancer Resection Pathology Reporting: pT Category (Primary Tumor) and pN Category (Regional Lymph Nodes) with Histologic Grade',''),
('PQRS_0100', 'question', 'Reports that include the pT category, the pN category and the histologic grade',''),
('PQRS_0100', 'answer', '1|pT category (primary tumor), pN category (regional lymph nodes), and histologic grade were documented in pathology report (G8721)|G8721',1),
('PQRS_0100', 'answer', '2|Documentation of medical reason(s) for not including the pT category, the pN category or the histologic grade in the pathology report (e.g., re-excision without residual tumor; non-carcinomas, anal canal) (G8722)|G8722',2),
('PQRS_0100', 'answer', '3|pT category, pN category and histologic grade were not documented in the pathology report, reason not given (G8724)|G8724',9),

('PQRS_0102', 'description', 'Prostate Cancer: Avoidance of Overuse of Bone Scan for Staging Low Risk Prostate Cancer Patients',''),
('PQRS_0102', 'question', 'Patients who did not have a bone scan performed at any time since diagnosis of prostate cancer<br> Numerator Instructions: A higher score indicates appropriate treatment of patients with prostate cancer at low risk of recurrence.',''),
('PQRS_0102', 'answer', '1|Bone scan not performed prior to initiation of treatment nor at any time since diagnosis of prostate cancer (3270F)|3270F',1),
('PQRS_0102', 'answer', '2|Documentation of medical reason(s) for performing a bone scan (including documented pain, salvage therapy, other medical reasons) (3269F:1P)|3269F:1P',2),
('PQRS_0102', 'answer', '3|Documentation of system reason(s) for performing a bone scan (including bone scan ordered by someone other than the reporting physician) (3269F:3P)|3269F:3P',2),
('PQRS_0102', 'answer', '4|Bone scan performed prior to initiation of treatment or at any time since diagnosis of prostate cancer (3269F)|3269F',9),

('PQRS_0104', 'description', 'Prostate Cancer: Combination Androgen Deprivation Therapy for High Risk or Very High Risk Prostate Cancer',''),
('PQRS_0104', 'question', 'Patients who were prescribed androgen deprivation therapy in combination with external beam radiotherapy to the prostate ',''),
('PQRS_0104', 'answer', '1|Androgen deprivation therapy prescribed/administered beam radiotherapy to the prostate(G9894)|G9894',1),
('PQRS_0104', 'answer', '2|Documentation of medical reason(s) for not prescribing/administering the above (eg, salvage therapy)(G9895) |G9895',2),
('PQRS_0104', 'answer', '3|Documentation of patient reason(s) for not prescribing/administering the above (G9896)|G9896',2),
('PQRS_0104', 'answer', '4|Patients who were not prescribed/administered above, reason not otherwise specified (G9897)|G9897',9),

('PQRS_0109', 'description', 'Osteoarthritis (OA): Function and Pain Assessment -- National Quality Strategy',''),
('PQRS_0109', 'question', 'Patient visits with assessment for level of function and pain documented (may include the use of a standardized scale or the completion of an assessment questionnaire, such as an SF-36, AAOS Hip & Knee Questionnaire)<br>NUMERATOR NOTE: For the purposes of this measure, the method for assessing function and pain is left up to the discretion of the individual clinician and based on the needs of the patient. The assessment may be done via a validated instrument (though one is not required) that measures pain and various functional elements including a patient\'s ability to perform activities of daily living (ADLs).',''),
('PQRS_0109', 'answer', '1|Osteoarthritis Symptoms and Functional Status Assessed (1006F)|1006F',1),
('PQRS_0109', 'answer', '2|Osteoarthritis Symptoms and Functional Status not Assessed, Reason not Otherwise Specified (1006F:8P)|1006F:8P',9),

('PQRS_0110', 'description', 'Preventive Care and Screening: Influenza Immunization',''),
('PQRS_0110', 'question', 'Did patients receive an influenza immunization OR who reported previous receipt of an influenza immunization<p>Numerator Instructions:<br> The numerator for this measure can be met by reporting either administration of an influenza vaccination or that the patient reported previous receipt of the <b>current season''s</b> influenza immunization. If the performance of the numerator is not met, a clinician can report a valid performance exclusion for having not administered an influenza vaccination. For clinicians reporting a performance exclusion for this measure, there should be a clear rationale and documented reason for not administering an influenza immunization if the patient did not indicate previous receipt, which could include a medical reason (e.g., patient allergy), patient reason (e.g., patient declined), or system reason (e.g., vaccination not available). The system reason should be indicated only for cases of disruption or shortage of influenza vaccination supply.<br>Definition:  Previous Receipt -- Receipt of the <b>current season''s</b> influenza immunization from another provider OR from same provider prior to the visit to which the measure is applied (typically, prior vaccination would include influenza vaccine given since August 1st).',''),
('PQRS_0110', 'answer', '1|Influenza Immunization Administered (G8482)|G8482',1),
('PQRS_0110', 'answer', '2|Influenza Immunization previously received (G8482)|G8482',1),
('PQRS_0110', 'answer', '3|Influenza Immunization not Administered for Documented Reasons (e.g., patient allergy or other medical reasons, patient declined or other patient reasons, vaccine not available or other system reasons) (G8483)|G8483',2),
('PQRS_0110', 'answer', '4|Influenza Immunization not Administered, Reason not Given (G8484)|G8484',9),

('PQRS_0111', 'description', 'Pneumonia Vaccination Status for Older Adults',''),
('PQRS_0111', 'question', 'Did patients receive a pneumococcal vaccination? <p>NUMERATOR NOTE: While the measure provides credit for adults 65 years of age and older who have ever received either the PCV13 or PPSV23 vaccine (or both), according to ACIP recommendations, patients should receive both vaccines. The order and timing of the vaccinations depends on certain patient characteristics, and are described in more detail in the ACIP recommendations.',''),
('PQRS_0111', 'answer', '1|Pneumococcal Vaccination Administered or Previously Received (4040F)|4040F',1),
('PQRS_0111', 'answer', '2|Pneumococcal Vaccination not Administered or Previously Received,Reason not Otherwise Specified (4040F:8P)|4040:8PF',9),

('PQRS_0112', 'description', 'Breast Cancer Screening ',''),
('PQRS_0112', 'question', 'Did patient have one or more mammograms any time on or between October 1, 27 months prior to December 31 of the measurement period?',''),
('PQRS_0112', 'answer', '1|Mammogram Performed--Screening mammography results documented and reviewed (G9899)|G9899',1),
('PQRS_0112', 'answer', '2|Mammogram not Performed/Reviewed (G9900)|G9900',9),

('PQRS_0113', 'description', 'Colorectal Cancer Screening',''),
('PQRS_0113', 'question', 'Did patient have one or more appropriate screenings for colorectal cancer?',''), 
('PQRS_0113', 'answer', '1|Colorectal Cancer Screening, results documented and reviewed (3017F)|3017F',1),
('PQRS_0113', 'answer', '3|Colorectal Cancer Screening not Performed, Reason not specified (3017F:8P)|3017F:8P',9),

('PQRS_0116', 'description', 'Avoidance of Antibiotic Treatment in Adults With Acute Bronchitis',''),
('PQRS_0116', 'question', 'Patients who were not prescribed or dispensed antibiotics on or within 3 days of the initial date of service<br>Numerator Instructions: For performance, the measure will be calculated as the number of patient encounters where antibiotics were neither prescribed nor dispensed on or within 3 days of the episode for acute bronchitis over the total number of encounters in the denominator (patients aged 18 through 64 years with an outpatient or ED visit for acute bronchitis). A higher score indicates appropriate treatment of patients with acute bronchitis (e.g., the proportion for whom antibiotics were not prescribed or dispensed on or three days after the encounter). Antibiotic Medications<p>Please refer to Measure documentation for Antibiotic Table',''),
('PQRS_0116', 'answer', '1|Antibiotic neither prescribed nor dispensed (4124F)|4124F',1),
('PQRS_0116', 'answer', '2|Antibiotic prescribed or dispensed (4120F)|4120F',9),

('PQRS_0117', 'description', 'Diabetes: Eye Exam',''),
('PQRS_0117', 'question', 'Did patients have an eye screening for diabetic retinal disease. This includes diabetics who had one of the following:<li>A retinal or dilated eye exam by an eye care professional in the measurement period or <li>a negative retinal or dilated exam (no evidence of retinopathy) by an eye care professional in the year prior to the measurement period<br>The eye exam must be performed or reviewed by an ophthalmologist or optometrist. Alternatively, results may be read by a qualified reading center that operates under the direction of a medical director who is a retinal specialist.<br>*Note: the low risk code 3072F can only be used if the claim/encounter was during the measurement period because it indicates that the patient had ''no evidence of retinopathy in the prior year''. This code definition indicates results were negative; therefore a result is not required.',''),
('PQRS_0117', 'answer', '1|Dilated retinal eye exam with interpretation by an ophthalmologist or optometrist documented and reviewed (2022F)|2022F',1),
('PQRS_0117', 'answer', '2|Seven standard field stereoscopic photos with interpretation by an ophthalmologist or optometrist documented and reviewed (2024F)|2024F',1),
('PQRS_0117', 'answer', '3|Eye imaging validated to match diagnosis from seven standard field stereoscopic photos results documented and reviewed (2026F)|2026F',1),
('PQRS_0117', 'answer', '4|Low risk for retinopathy (no evidence of retinopathy in the prior year) *(see note above) (3072F)|3072F',1),
('PQRS_0117', 'answer', '5|Retinal or Dilated Eye Exam not Performed, Reason not Otherwise Specified (2022F:8P)|2022F:8P',9),

('PQRS_0118', 'description', 'Coronary Artery Disease (CAD): Angiotensin-Converting Enzyme (ACE) Inhibitor or Angiotensin Receptor Blocker (ARB) Therapy - Diabetes or Left Ventricular Systolic Dysfunction (LVEF &lt; 40%)',''),
('PQRS_0118', 'question', 'Patients who were prescribed ACE inhibitor or ARB therapy OR Patients who were prescribed ACE inhibitor or ARB therapy <br><b>**** It is important you review the Measure Documentation for Definitions and Instructions to understand which set of coded to choose for this Measure ****</b>',''),
('PQRS_0118', 'answer', '1|Clinician prescribed angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy (G8935)|G8935',1),
('PQRS_0118', 'answer', '2|Clinician documented that patient was not an eligible candidate for angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy (G8936)|G8936',2),
('PQRS_0118', 'answer', '3|Clinician did not prescribe angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy, reason not given (G8937)|G8937',''),
('PQRS_0118', 'answer', '4|Angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy prescribed (G8473)|G8473',1),
('PQRS_0118', 'answer', '5|Angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy not prescribed for reasons documented by the clinician (G8474)|G8474',2),
('PQRS_0118', 'answer', '6|Angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy not prescribed, reason not given (G8475)|G8475',9),

('PQRS_0119', 'description', 'Diabetes: Medical Attention for Nephropathy',''),
('PQRS_0119', 'question', 'Did patient receive a screening for nephropathy or had evidence of nephropathy during the measurement period?',''),
('PQRS_0119', 'answer', '1|Positive microalbuminuria test result documented and reviewed (3060F)|3060F',1),
('PQRS_0119', 'answer', '2|Negative microalbuminuria test result documented and reviewed (3061F)|3061F',1),
('PQRS_0119', 'answer', '3|Positive macroalbuminuria test result documented and reviewed (3062F)|3062F',1),
('PQRS_0119', 'answer', '4|Documentation of treatment for nephropathy (eg, patient receiving dialysis, patient being treated for ESRD, CRF, ARF, or renal insufficiency, any visit to a nephrologist) (3066F)|3066F',1),
('PQRS_0119', 'answer', '5|Patient receiving angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy (G8506)|G8506',1),
('PQRS_0119', 'answer', '6|Nephropathy screening was not performed, reason not otherwise specified (3060F:8P)|3060F:8P',9),

('PQRS_0122', 'description', 'Adult Kidney Disease: Blood Pressure Management<br>Percentage of patient visits for those patients aged 18 years and older with a diagnosis of chronic kidney disease (CKD) (stage 3, 4, or 5, not receiving Renal Replacement Therapy [RRT]) with a blood pressure < 140/90 mmHg OR = 140/90 mmHg with a documented plan of care',''),
('PQRS_0122', 'question', 'Patient visits with blood pressure < 140/90 mmHg OR >= 140/90 mmHg with a documented plan of care <br>Numerator Instructions: If multiple blood pressure measurements are taken at a single visit, use the most recent measurement taken at that visit. <br>Definition: Plan of Care -- A documented plan of care should include one or more of the following: recheck blood pressure within 90 days; initiate or alter pharmacologic therapy for blood pressure control; initiate or alter non-pharmacologic therapy (lifestyle changes) for blood pressure control; documented review of patient\'s home blood pressure log which indicates that patient\'s blood pressure is or is not well controlled.',''),
('PQRS_0122', 'answer', '1|Most recent blood pressure has a systolic measurement of < 140 mmHg and a diastolic measurement of < 90 mmHg (G8476)|G8476',1),
('PQRS_0122', 'answer', '2|Most recent blood pressure has a systolic measurement of >= 140 mmHg and/or a diastolic measurement of >= 90 mmHg AND Elevated blood pressure plan of care documented  (G8477 0513F)|G8477 0513F',1),
('PQRS_0122', 'answer', '3|Blood pressure measurement not performed or documented, reason not given (G8478)|G8478',9),
('PQRS_0122', 'answer', '4| No documentation of elevated blood pressure plan of care, reason not otherwise specified  AND Most recent blood pressure has a systolic measurement of =140 mmHg and/or a diastolic measurement of = 90 mmHg (0513Fi:8P G8477)|0513F:8P G8477',9),

('PQRS_0126', 'description', 'Diabetes Mellitus: Diabetic Foot and Ankle Care, Peripheral Neuropathy -- Neurological Evaluation<br>Percentage of patients aged 18 years and older with a diagnosis of diabetes mellitus who had a neurological examination of their lower extremities within 12 months',''),
('PQRS_0126', 'question', 'Patients who had a lower extremity neurological exam performed at least once within 12 months <br>Definition: Lower Extremity Neurological Exam -- Consists of a documented evaluation of motor and sensory abilities and should include: 10-g monofilament plus testing any one of the following: vibration using 128-Hz tuning fork, pinprick sensation, ankle reflexes, or vibration perception threshold), however the clinician should perform all necessary tests to make the proper evaluation.',''),
('PQRS_0126', 'answer', '1|Lower extremity neurological exam performed and documented (G8404)|G8404',1),
('PQRS_0126', 'answer', '2|Lower extremity neurological exam not performed (G8405)|G8405',9),

('PQRS_0127', 'description', 'Diabetes Mellitus: Diabetic Foot and Ankle Care, Ulcer Prevention -- Evaluation of Footwear<br>Percentage of patients aged 18 years and older with a diagnosis of diabetes mellitus who were evaluated for proper footwear and sizing',''),
('PQRS_0127', 'question', 'Was Patients evaluated for proper footwear and sizing at least once within 12 months?<br>Evaluation for Proper Footwear -- Includes a foot examination documenting the vascular, neurological, dermatological, and structural/biomechanical findings. The foot should be measured using a standard measuring device, and counseling on appropriate footwear should be based on risk categorization.',''),
('PQRS_0127', 'answer', '1|Footwear evaluation performed and documented (G8410)|G8410',1),
('PQRS_0127', 'answer', '2|Clinician documented that patient was not an eligible candidate for footwear evaluation measure (G8416)|G8416',2),
('PQRS_0127', 'answer', '3|Footwear evaluation was not performed (G8415)|G8415',9),

('PQRS_0128', 'description', 'Preventive Care and Screening: Body Mass Index (BMI) Screening and Follow-Up Plan',''),
('PQRS_0128', 'question', 'Does patient have a documented BMI during the encounter or during the previous twelve months, AND when the BMI is outside of normal parameters, is a follow-up plan documented during the encounter or during the previous twelve months?',''),
('PQRS_0128', 'answer', '1|BMI Documented as Normal, No Follow-Up Plan Required (G8420)|G8420',1),
('PQRS_0128', 'answer', '2|BMI Documented as Above Normal Parameters, AND Follow-Up Documented (G8417)|G8417',1),
('PQRS_0128', 'answer', '3|BMI Documented as Below Normal Parameters, AND Follow-Up Documented (G8418)|G8418',1),
('PQRS_0128', 'answer', '4|BMI is documented as being outside of normal limits, follow-up plan is not completed for documented reason(G9716)|G9716',2),
('PQRS_0128', 'answer', '5|BMI not Documented, Reason not Given (G8421)|G8421',9),
('PQRS_0128', 'answer', '6|BMI Documented Outside of Normal Parameters, Follow-Up Plan not Documented, Reason not Given (G8419)|G8419',9),

('PQRS_0130', 'description', 'Documentation of Current Medications in the Medical Record',''),
('PQRS_0130', 'question', 'Eligible professional attests to documenting, updating or reviewing a patient\'s current medications using all immediate resources available on the date of encounter. This list must include ALL known prescriptions, over-the counters, herbals, and vitamin/mineral/dietary (nutritional) supplements AND must contain the medications'' name, dosages, frequency and route of administration <br>Definitions:<br>Current Medications -- Medications the patient is presently taking including all prescriptions, over-thecounters, herbals and vitamin/mineral/dietary (nutritional) supplements with each medication''s name, dosage, frequency and administered route. <br>Route -- Documentation of the way the medication enters the body (some examples include but are not limited to: oral, sublingual, subcutaneous injections, and/or topical) <br>Not Eligible -- A patient is not eligible if the following reason is documented: Patient is in an urgent or emergent medical situation where time is of the essence and to delay treatment would jeopardize the patient\'s health status <br> NUMERATOR NOTE: The eligible professional must document in the medical record they obtained, updated, or reviewed a medication list on the date of the encounter. Eligible professionals reporting this measure may document medication information received from the patient, authorized representative(s), caregiver(s) or other available healthcare resources. G8427 should be reported if the eligible professional documented that the patient is not currently taking any medications',''),
('PQRS_0130', 'answer', '1|Eligible professional attests to documenting in the medical record they obtained, updated, or reviewed the patient\'s current medications (G8427)|G8427',1),
('PQRS_0130', 'answer', '2|Eligible professional attests to documenting in the medical record the patient is not eligible for a current list of medications being obtained, updated, or reviewed by the eligible professional (G8430)|G8430',2),
('PQRS_0130', 'answer', '3|Current Medications with Name, Dosage, Frequency, or Route not Documented, Reason not Given (G8428)|G8428',9),

('PQRS_0131', 'description', 'Pain Assessment and Follow-Up',''),
('PQRS_0131', 'question', 'Patient visits with a documented pain assessment using a standardized tool(s) AND documentation of a follow-up plan when pain is present<br>Definitions:<br>Pain Assessment -- Documentation of a clinical assessment for the presence or absence of pain using a standardized tool is required. A multi-dimensional clinical assessment of pain using a standardized tool may include characteristics of pain -- such as: location, intensity, description, and onset/duration.<br>Standardized Tool -- An assessment tool that has been appropriately normed and validated for the population in which it is used. Examples of tools for pain assessment, include, but are not limited to: Brief Pain Inventory (BPI), Faces Pain Scale (FPS), McGill Pain Questionnaire (MPQ), Multidimensional Pain Inventory (MPI), Neuropathic Pain Scale (NPS), Numeric Rating Scale (NRS), Oswestry Disability Index (ODI), Roland Morris Disability Questionnaire (RMDQ), Verbal Descriptor Scale (VDS), Verbal Numeric Rating Scale (VNRS) and Visual Analog Scale (VAS).<br>Follow-Up Plan -- A documented outline of care for a positive pain assessment is required. This must include a planned follow-up appointment or a referral, a notification to other care providers as applicable OR indicate the initial treatment plan is still in effect. These plans may include pharmacologic and/or educational interventions.<br>Not Eligible -- A patient is not eligible if one or more of the following reason(s) is documented:<li> Severe mental and/or physical incapacity where the person is unable to express himself/herself in a manner understood by others. For example, cases where pain cannot be accurately assessed through use of nationally recognized standardized pain assessment tools<li>Patient is in an urgent or emergent situation where time is of the essence and to delay treatment would jeopardize the patient\'s health status<br>NUMERATOR NOTE: The standardized tool used to assess the patient\'s pain must be documented in the medical record (exception: A provider may use a fraction such as 5/10 for Numeric Rating Scale without documenting this actual tool name when assessing pain for intensity)',''),
('PQRS_0131', 'answer', '1|Pain Assessment Documented as Positive AND Follow-Up Plan Documented (G8730)|G8730',1),
('PQRS_0131', 'answer', '2|Pain Assessment Documented as Negative, No Follow-Up Plan Required (G8731)|G8731',1),
('PQRS_0131', 'answer', '3|Pain Assessment not Documented; Documented that Patient is not Eligible (G8442)|G8442',2),
('PQRS_0131', 'answer', '4|Pain Assessment Documented as Positive, Follow-Up Plan not Documented; Documented that Patient not Eligible (G8939)|G8939',2),
('PQRS_0131', 'answer', '5|Pain Assessment not Documented, Reason not Given (G8732)|G8732',9),
('PQRS_0131', 'answer', '6|Pain Assessment Documented as Positive, Follow-Up Plan not Documented, Reason not Given (G8509)|G8509',9),

('PQRS_0134', 'description', 'Preventive Care and Screening: Screening for Clinical Depression and Follow-Up Plan',''),
('PQRS_0134', 'question', 'Patients screened for clinical depression on the date of the encounter using an age appropriate standardized tool AND, if positive, a follow-up plan is documented on the date of the positive screen<br>Numerator Instructions: The name of the age appropriate standardized depression screening tool utilized must be documented in the medical record. The depression screening must be reviewed and addressed in the office of the provider filing the code on the date of the encounter.<br>*See Measure Description for Definitions*',''),
('PQRS_0134', 'answer', '1|Screening for Clinical Depression Documented as Positive, AND Follow-Up Plan Documented (G8431)|G8431',1),
('PQRS_0134', 'answer', '2|Screening for Clinical Depression Documented as Negative, Follow-Up Plan not Required (G8510)|G8510',1),
('PQRS_0134', 'answer', '3|Screening for Clinical Depression not Documented; documented that Patient not Eligible (G8433)|G8433',2),
('PQRS_0134', 'answer', '4|Screening for Clinical Depression not Documented, Reason not Given (G8432)|G8432',9),
('PQRS_0134', 'answer', '5|Screening for Clinical Depression Documented as Positive, Follow-Up Plan not Documented, Reason not Given (G8511)|G8511',9),

('PQRS_0137', 'description', 'Melanoma: Continuity of Care -- Recall System',''),
('PQRS_0137', 'question', 'Patients whose information is entered, at least once within a 12 month period, into a recall system that includes:<li>A target date for the next complete physical exam AND<li>A process to follow up with patients who either did not make an appointment within the specified timeframe or who missed a scheduled appointment <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0137', 'answer', '1|Patient information entered into a recall system that includes: target date for the next exam specified AND a process to follow up with patients regarding missed or unscheduled appointments (7010F)|7010F',1),
('PQRS_0137', 'answer', '2|Documentation of system reason(s) for not entering patient\'s information into a recall system (e.g., melanoma being monitored by another physician provider) (7010F:3P)|7010F:3P',2),
('PQRS_0137', 'answer', '3|Recall system not utilized, reason not otherwise specified (7010F:8P)|7010F:8P',9),

('PQRS_0138', 'description', 'Melanoma: Coordination of Care',''),
('PQRS_0138', 'question', 'Patient visits with a treatment plan documented in the chart that was communicated to the physician(s) providing continuing care within one month of diagnosis <br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions: A treatment plan should include the following elements: diagnosis, tumor thickness, and plan for surgery or alternate care.<br>Definition:<br>Communication -- Communication may include: documentation in the medical record that the physician(s) treating the melanoma communicated (e.g., verbally, by letter, copy of treatment plan sent) with the physician(s) providing the continuing care OR a copy of a letter in the medical record outlining whether the patient was or should be treated for melanoma.',''),
('PQRS_0138', 'answer', '1|Treatment plan communicated to provider(s) managing continuing care within 1 month of diagnosis (5050F)|5050F',1),
('PQRS_0138', 'answer', '2|Documentation of patient reason(s) for not communicating treatment plan to the Primary Care Physician(s) (PCP)(s) (eg, patient asks that treatment plan not be communicated to the physician(s) providing continuing care) (5050F:2P)|5050F:2P',2),
('PQRS_0138', 'answer', '3|Documentation of system reason(s) for not communicating treatment plan to the PCP(s) (eg, patient does not have a primary care physician or referring physician) (5050F:3P)|5050F:3P',2),
('PQRS_0138', 'answer', '4|Treatment plan not communicated, reason not otherwise specified (5050F:8P)|5050F:8P',9),

('PQRS_0140', 'description', 'Age-Related Macular Degeneration (AMD): Counseling on Antioxidant Supplement',''),
('PQRS_0140', 'question', 'Patients with AMD or their caregiver(s) who were counseled within 12 months on the benefits and/or risks of the AREDS formulation for preventing progression of AMD <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0140', 'answer', '1|Counseling about the benefits and/or risks of the AgeRelated Eye Disease Study (AREDS) formulation for preventing progression of age-related macular degeneration (AMD) provided to patient and/or caregiver(s) (4177F)|4177F',1),
('PQRS_0140', 'answer', '2|AREDS Counseling not Performed, Reason not Otherwise Specified (4177F:8P)|4177F:8P',''),

('PQRS_0141', 'description', 'Primary Open-Angle Glaucoma (POAG): Reduction of Intraocular Pressure (IOP) by 15% OR Documentation of a Plan of Care',''),
('PQRS_0141', 'question', 'Patients whose glaucoma treatment has not failed (the most recent IOP was reduced by at least 15% from the preintervention level) OR if the most recent IOP was not reduced by at least 15% from the pre-intervention level, a plan of care was documented within 12 months <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0141', 'answer', '1|Intraocular pressure (IOP) reduced by a value of greater than or equal to 15% from the pre-intervention level (3284F)|3284F',1),
('PQRS_0141', 'answer', '2|Glaucoma plan of care documented AND Intraocular pressure (IOP) reduced by a value less than 15% from the pre-intervention level (0517F 3285F)|0517F 3285F',1),
('PQRS_0141', 'answer', '3|Glaucoma plan of care not documented, reason not otherwise specified AND Intraocular pressure (IOP) reduced by a value less than 15% from the pre-intervention level (0517F:8P 3285F)|0517F:8P 3285F',9),
('PQRS_0141', 'answer', '4|IOP measurement not documented, reason not otherwise specified (3284F:8P)|3284F:8P',9),

('PQRS_0143', 'description', 'Oncology: Medical and Radiation -- Pain Intensity Quantified',''),
('PQRS_0143', 'question', 'Patient visits in which pain intensity is quantified<br>Numerator Instructions: Pain intensity should be quantified using a standard instrument, such as a 0-10 numerical rating scale, visual analog scale, a categorical scale, or the pictorial scale.',''),
('PQRS_0143', 'answer', '1|Pain severity quantified; pain present (1125F)|1125F',1),
('PQRS_0143', 'answer', '2|Pain severity quantified; no pain present (1126F)|1126F',1),
('PQRS_0143', 'answer', '3|Pain severity not documented, reason not otherwise specified (1125F:8P)|1125F:8P',9),

('PQRS_0144', 'description', 'Oncology: Medical and Radiation -- Plan of Care for Pain',''),
('PQRS_0144', 'question', 'Patient visits that included a documented plan of care to address pain<br>Numerator Instructions: A documented plan of care may include: use of opioids, nonopioid analgesics, psychological support, patient and/or family education, referral to a pain clinic, or reassessment of pain at an appropriate time interval.',''),
('PQRS_0144', 'answer', '1|Plan of care to address pain documented (0521F)|0521F',1),
('PQRS_0144', 'answer', '2|Plan of care for pain not documented, reason not otherwise specified (0521F with 8P)|0521F:8P',9),

('PQRS_0145', 'description', 'Radiology: Exposure Time Reported for Procedures Using Fluoroscopy',''),
('PQRS_0145', 'question', 'Final reports for procedures using fluoroscopy that include radiation exposure indices, or exposure time and number of fluorographic images (if radiation exposure indices are not available)<br>Definition:<br>Radiation exposure indices - For the purposes of this measure, radiation exposure indices should, if possible, include at least one of the following:<br>1. Skin dose mapping<br>2. Peak skin dose (PSD)<br>3. Reference air kerma (Ka,r)<br>4. Kerma-area product (PKA)<br>If the fluoroscopic equipment does not automatically provide any of the above radiation exposure indices, exposure time and the number of fluorographic images taken during the procedure may be used.',''),
('PQRS_0145', 'answer', '1|Radiation Exposure indices, or Exposure Time and Number of Fluorographic Images (if radiation exposure indices are not available) Documented in Final Procedure Report (G9500)|G9500',1),
('PQRS_0145', 'answer', '2|Radiation Exposure indices, or Exposure Time and Number of Fluorographic Images (if radiation exposure indices are not available) not Documented in Final Procedure Report, Reason not Given (G9501)|G9501',9),

('PQRS_0146', 'description', 'Radiology: Inappropriate Use of ''Probably Benign'' Assessment Category in Screening Mammograms',''),
('PQRS_0146', 'question', 'Final reports classified as ''probably benign''<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.  A lower percentage, with a definitional target approaching 0%, indicates appropriate assessment of screening mammograms.',''),
('PQRS_0146', 'answer', '1|Mammogram Assessment Category of ''Probably Benign'' Documented (3343F)|3343F',1),
('PQRS_0146', 'answer', '2|Mammogram assessment category of ''incomplete: need additional imaging evaluation'' documented (3340F)|3340F',9),
('PQRS_0146', 'answer', '3|Mammogram assessment category of ''negative'' documented (3341F)|3341F',9),
('PQRS_0146', 'answer', '4|Mammogram assessment category of ''benign'' documented (3342F)|3342F',9),
('PQRS_0146', 'answer', '5|Mammogram assessment category of ''suspicious'' documented (3344F)|3344F',9),
('PQRS_0146', 'answer', '6|Mammogram assessment category ''highly suggestive of malignancy'' documented (3345F)|3345F',9),
('PQRS_0146', 'answer', '7|Mammogram assessment category of ''known biopsy proven malignancy'' documented (3350F)|3350F',9),

('PQRS_0147', 'description', 'Nuclear Medicine: Correlation with Existing Imaging Studies for All Patients Undergoing Bone Scintigraphy',''),
('PQRS_0147', 'question', 'Final reports that include physician documentation of correlation with existing relevant imaging studies (e.g., x-ray, MRI, CT, etc.)<br>Definition:<br>Relevant Imaging Studies -- Relevant imaging studies are defined as studies that correspond to the same anatomical region in question.<br>Note: Correlative studies are considered to be unavailable if relevant studies (reports and/or actual examination material) from other imaging modalities exist but could not be obtained after reasonable efforts to retrieve the studies are made by the interpreting physician prior to the finalization of the bone scintigraphy report.',''),
('PQRS_0147', 'answer', '1|Final report for bone scintigraphy study includes correlation with existing relevant imaging studies (eg, xray, MRI, CT) corresponding to the same anatomical region in question (3570F)|3570F',1),
('PQRS_0147', 'answer', '2|Documentation of system reason(s) for not documenting correlation with existing relevant imaging studies in final report (eg, no existing relevant imaging study available, patient did not have a previous relevant imaging study) (3570F:3P)|3570F:3P',2),
('PQRS_0147', 'answer', '3|Bone scintigraphy report not correlated in the final report with existing relevant imaging studies, reason not otherwise specified (3570F:8P)|3570F:8P',9),

('PQRS_0154', 'description', 'Falls: Risk Assessment<br>This is a two-part measure which is paired with Measure #155: Falls: Plan of Care. If the falls risk assessment indicates the patient has documentation of two or more falls in the past year or any fall with injury in the past year (CPT II code 1100F is submitted), #155 should also be reported.',''),
('PQRS_0154', 'question', 'Did Patient have a risk assessment for falls completed within 12 months?<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions: All components do not need to be completed during one patient visit, but should be documented in the medical record as having been performed within the past 12 months.<br> ** Please see Measure Documentation for definitons of:<li>Fall <li>Risk Assessment <li>Balance/gait Assessment <li>Postural blood pressure <li>Vision Assessment <li>Home fall hazards Assessment <li>Medications Assessment',''),
('PQRS_0154', 'answer', '1|Falls risk assessment documented(3288F)|3288F',1),
('PQRS_0154', 'answer', '2| Risk Assessment for Falls not Completed for Medical Reasons (3288F:1P) Documentation of medical reason(s) for not completing a risk assessment for falls (i.e., patient is not ambulatory, bed ridden, immobile, confined to chair, wheelchair bound, dependent on helper pushing wheelchair, independent in wheelchair or minimal help in wheelchair) |3288F:1P',2),
('PQRS_0154', 'answer', '3|Patient not at Risk for Falls (1101F) Patient screened for future fall risk; documentation of no falls in the past year or only one fall without injury in the past year|1101F',2),
('PQRS_0154', 'answer', '4|Risk Assessment for Falls not Completed, Reason not Otherwise Specified (3288F:8P) Falls risk assessment not completed, reason not otherwise specified AND Patient screened for future fall risk; documentation of two or more falls in the past year or any fall with injury in the past year|3288F:8P',9),

('PQRS_0155', 'description', 'Falls: Plan of Care <br>This is a two-part measure which is paired with Measure #154: Falls: Risk Assessment. <br>This measure should be reported if CPT II code 1100F ''Patient screened for future falls risk; documentation of two or more falls in the past year or any fall with injury in the past year'' is submitted for Measure #154.',''),
('PQRS_0155', 'question', 'Patients with a plan of care for falls documented within 12 months<br>Numerator Instructions: All components do not need to be completed during one patient visit, but should be documented in the medical record as having been performed within the past 12 months.<br> ** Please see measure documentation for Definitions **<br>Definitions:<li>Plan of Care<li>Consideration of Vitamin D Supplementation<li>Balance, Strength, and Gait Training<li>Fall ',''),
('PQRS_0155', 'answer', '1|Plan of Care Documented (0518F)|0518F',1),
('PQRS_0155', 'answer', '2|Medical Performance Exclusion (0518F:1P)|0518F:1P',2),
('PQRS_0155', 'answer', '3|Plan of Care not Documented, Reason not Otherwise Specified (0518F:8P)|0518F:8P',9),

('PQRS_0156', 'description', 'Oncology: Radiation Dose Limits to Normal Tissues',''),
('PQRS_0156', 'question', 'Patients who had documentation in medical record that radiation dose limits to normal tissues were established prior to the initiation of a course of 3D conformal radiation for a minimum of two tissues',''),
('PQRS_0156', 'answer', '1|Radiation dose limits to normal tissues established prior to the initiation of a course of 3D conformal radiation for a minimum of two tissue/organ (0520F)|0520F',1),
('PQRS_0156', 'answer', '2|Radiation dose limits to normal tissues not established prior to the initiation of a course of 3D conformal radiation for a minimum of two tissue/organ, reason not otherwise specified (0520F:8P)|0520F:8P',9),

('PQRS_0164', 'description', 'Coronary Artery Bypass Graft (CABG): Prolonged Intubation',''),
('PQRS_0164', 'question', 'Patients undergoing isolated CABG who require intubation > 24 hours following exit from the operating room <br>INVERSE MEASURE: A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0164', 'answer', '1|Prolonged postoperative intubation (> 24 hrs) required (G8569)|G8569',1),
('PQRS_0164', 'answer', '2|Prolonged postoperative intubation (> 24 hrs) not required (G8570)',9),

('PQRS_0165', 'description', 'Coronary Artery Bypass Graft (CABG): Deep Sternal Wound Infection Rate',''),
('PQRS_0165', 'question', 'Patients who, within 30 days postoperatively, develop deep sternal wound infection involving muscle, bone, and/or mediastinum requiring operative intervention. Patient must have ALL of the following conditions: 1.) wound opened with excision of tissue (incision and drainage) or re-exploration of mediastinum, 2.) positive culture unless patient is on antibiotics at time of culture or no culture obtained, and 3.) treatment with antibiotics beyond perioperative prophylaxis<br> INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0165', 'answer', '1|Development of deep sternal wound infection/mediastinitis within 30 days postoperatively (G8571)|G8571',1),
('PQRS_0165', 'answer', '2|No deep sternal wound infection/mediastinitis (G8572)|G8572',9),

('PQRS_0166', 'description', 'Coronary Artery Bypass Graft (CABG): Stroke',''),
('PQRS_0166', 'question', 'Patients undergoing isolated CABG surgery who have a postoperative stroke (i.e., any confirmed neurological deficit of abrupt onset caused by a disturbance in blood supply to the brain) that did not resolve within 24 hours<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0166', 'answer', '1|Stroke following isolated CABG surgery (G8573)|G8573',1),
('PQRS_0166', 'answer', '2|No stroke following isolated CABG surgery (G8574)|G8574',9),

('PQRS_0167', 'description', 'Coronary Artery Bypass Graft (CABG): Postoperative Renal Failure',''),
('PQRS_0167', 'question', 'Patients who develop postoperative renal failure or require dialysis; (Definition of renal failure/dialysis requirement - patient had acute renal failure or worsening renal function resulting in one of the following: 1) increase of serum creatinine to &ge; 4.0 mg/dL or 3x most recent preoperative creatinine level (acute rise must be at least 0.5 mg/dL), or 2) a new requirement for dialysis postoperatively)<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0167', 'answer', '1|Developed postoperative renal failure or required dialysis (G8575)|G8575',1),
('PQRS_0167', 'answer', '2|No postoperative renal failure/dialysis not required (G8576)|G8576',9),

('PQRS_0168', 'description', 'Coronary Artery Bypass Graft (CABG): Surgical Re-Exploration',''),
('PQRS_0168', 'question', 'Patients undergoing isolated CABG surgery who require a return to the OR during the current hospitalization for mediastinal bleeding with or without tamponade, graft occlusion, valve dysfunction, or other cardiac reason<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0168', 'answer', '1|Re-exploration required due to mediastinal bleeding with or without tamponade, graft occlusion, valve dysfunction, or other cardiac reason (G8577)|G8577',1),
('PQRS_0168', 'answer', '2|Re-exploration not required due to mediastinal bleeding with or without tamponade, graft occlusion, valve dysfunction, or other cardiac reason (G8578)|G8578',9),

('PQRS_0176', 'description', 'Rheumatoid Arthritis (RA): Tuberculosis Screening',''),
('PQRS_0176', 'question', 'Patients for whom a TB screening was performed and results interpreted within 6 months prior to receiving a first course of therapy using a biologic DMARD<br>Numerator Instructions: Patients are considered to be receiving a first course of therapy using a biologic DMARD only if they have never previously been prescribed or dispensed a biologic DMARD.<br>Definition:<br>Biologic DMARD Therapy -- Includes Adalimunab, Etanercept, Infliximab, Abatacept, Anakinra (Rituximab is excluded).',''),
('PQRS_0176', 'answer', '1|TB screening performed and results interpreted within six months prior to initiation of first-time biologic disease modifying anti-rheumatic drug therapy for RA (3455F)|3455F',1),
('PQRS_0176', 'answer', '2|Documentation of medical reason for not screening for TB or interpreting results (ie, patient positive for TB and documentation of past treatment; patient who has recently completed a course of anti-TB therapya. (3455F:1P)|3455F:1P',2),
('PQRS_0176', 'answer', '3|TB screening not performed or results not interpreted, reason not otherwise specified. (3455F:8P)|3455F:8P',9),

('PQRS_0177', 'description', 'Rheumatoid Arthritis (RA): Periodic Assessment of Disease Activity',''),
('PQRS_0177', 'question', 'Patients with disease activity assessed by a standardized descriptive or numeric scale or composite index and classified into one of the following categories: low, moderate or high, at least once within 12 months<br>Definition:<br>Assessment and Classification of Disease Activity -- Assesses if physicians are utilizing a standardized, systematic approach for evaluating the level of disease activity. The scales/instruments listed are examples of how to define activity level and cut-off points can differ by scale. Standardized descriptive or numeric scales and/or composite indexes could include but are not limited to: DAS28, SDAI, CDAI, RADAI, RAPID.<br>NUMERATOR NOTE: If the physician uses an alternate, standardized, systematic approach for evaluating the level of disease activity other than the tools listed above, that will be numerator compliant.',''),
('PQRS_0177', 'answer', '1|Rheumatoid arthritis (RA) disease activity, low (3470F)|3470F',1),
('PQRS_0177', 'answer', '2|Rheumatoid arthritis (RA) disease activity, moderate (3471F)|3471F',1),
('PQRS_0177', 'answer', '3|Rheumatoid arthritis (RA) disease activity, high (3472F)|3472F',1),
('PQRS_0177', 'answer', '4|Disease activity not assessed and classified, reason not otherwise specified (3470F:8P)|3470F:8P',9),

('PQRS_0178', 'description', 'Rheumatoid Arthritis (RA): Functional Status Assessment',''),
('PQRS_0178', 'question', 'Patients for whom a functional status assessment was performed at least once within 12 months<br> ** Please See Measure Description for Definitions **',''),
('PQRS_0178', 'answer', '1|Functional status assessed (1170F)|1170F',1),
('PQRS_0178', 'answer', '2|Functional status not assessed, reason not otherwise specified (1170F:8P)|1170F:8P',9),

('PQRS_0179', 'description', 'Rheumatoid Arthritis (RA): Assessment and Classification of Disease Prognosis',''),
('PQRS_0179', 'question', 'Patients with at least one documented assessment and classification (good/poor) of disease prognosis utilizing clinical markers of poor prognosis within 12 months<br>Numerator Instructions: This measure evaluates if physicians are assessing and classifying disease prognosis using a standardized, systematic approach. Disease prognosis should be classified as either poor or good.<br> ** Please See Measure Description for Definitions ** ',''),
('PQRS_0179', 'answer', '1|Disease prognosis for rheumatoid arthritis assessed, poor prognosis documented (3475F)|3475F',1),
('PQRS_0179', 'answer', '2|Disease prognosis for rheumatoid arthritis assessed, good prognosis documented (3476F)|3476F',1),
('PQRS_0179', 'answer', '3|Disease prognosis for rheumatoid arthritis not assessed and classified, reason not otherwise specified (3475F:8P)',9),

('PQRS_0180', 'description', ' Rheumatoid Arthritis (RA): Glucocorticoid Management',''),
('PQRS_0180', 'question', 'Patients who have been assessed for glucocorticoid use and for those on prolonged doses of prednisone &ge 10 mg daily (or equivalent) with improvement or no change in disease activity, documentation of a glucocorticoid management plan within 12 months <br> ** Please see Measure Documentation for Definitions **',''),
('PQRS_0180', 'answer', '1|Patient not receiving glucocorticoid therapy (4192F)|4192F',1),
('PQRS_0180', 'answer', '2|Patient receiving &lt; 10 mg daily prednisone (or equivalent), or RA activity is worsening, or glucocorticoid use is for less than 6 months (4193F)|4193F',1),
('PQRS_0180', 'answer', '3|Patient receiving &ge; 10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity AND Glucocorticoid Management Plan documented (4194F 0540F)|4194F 0540F',2),
('PQRS_0180', 'answer', '4|Documentation of medical reason(s) for not documenting glucocorticoid management plan (ie, glucocorticoid prescription is for a medical condition other than RA) AND Patient receiving &ge; 10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity (0540F:1P 4194F)|0540F:1P 4194F',2),
('PQRS_0180', 'answer', '5|Glucocorticoid dose was not documented, reason not otherwise specified (4194F:8P)|4194F:8P',9),
('PQRS_0180', 'answer', '6|Glucocorticoid management plan not documented, reason not otherwise specified AND Patient receiving &ge; 10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity (0540F:8P 4194F)|0540F:8P 4194F',9),

('PQRS_0181', 'description', 'Elder Maltreatment Screen and Follow-Up Plan',''),
('PQRS_0181', 'question', 'Patients with a documented elder maltreatment screen using an Elder Maltreatment Screening tool on the date of the encounter and follow-up plan documented on the date of the positive screen<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0181', 'answer', '1|Elder Maltreatment Screen Documented as Positive AND Follow-Up Plan Documented (G8733)|G8733',1),
('PQRS_0181', 'answer', '2|Elder Maltreatment Screen Documented as Negative, Follow-Up Plan not Required (G8734)|G8734',1),
('PQRS_0181', 'answer', '3|Elder Maltreatment Screen not Documented, Patient not Eligible (G8535)|G8535',2),
('PQRS_0181', 'answer', '4|Elder Maltreatment Screen Documented as Positive, Follow-Up Plan not Documented, Patient not Eligible for Follow-Up Plan (G8941)|G8941',2),
('PQRS_0181', 'answer', '5|Elder Maltreatment Screen not Documented, Reason not Given (G8536)|G8536',9),
('PQRS_0181', 'answer', '6|Elder Maltreatment Screen Documented as Positive, Follow-Up Plan not Documented, Reason not Given (G8735)|G8735',9),

('PQRS_0182', 'description', 'Functional Outcome Assessment',''),
('PQRS_0182', 'question', 'Patients with a documented current functional outcome assessment using a standardized tool AND a documented care plan based on the identified functional outcome deficiencies<br>*See Meacure Description for Definitions*',''),
('PQRS_0182', 'answer', '1|Functional Outcome Assessment Documented as Positive AND Care Plan Documented (G8539)|G8539',1),
('PQRS_0182', 'answer', '2|Functional Outcome Assessment Documented, No Functional Deficiencies Identified, Care Plan not Required (G8542)|G8542',1),
('PQRS_0182', 'answer', '3|Functional Outcome Assessment Documented AND Care Plan Documented, if Indicated, Within the Previous 30 Days (G8942)|G8942',1),
('PQRS_0182', 'answer', '4|Functional Outcome Assessment not Documented, Patient not Eligible (G8540)|G8540',2),
('PQRS_0182', 'answer', '5|Functional Outcome Assessment Documented, Care Plan not Documented, Patient not Eligible (G9227)|G9227',2),
('PQRS_0182', 'answer', '6|Functional Outcome Assessment not Documented, Reason not Given (G8541)|G8541',9),
('PQRS_0182', 'answer', '7|Functional Outcome Assessment Documented as Positive, Care Plan not Documented, Reason not Given (G8543)|G8543',9),

('PQRS_0185', 'description', 'Colonoscopy Interval for Patients with a History of Adenomatous Polyps -- Avoidance of Inappropriate Use',''),
('PQRS_0185', 'question', 'Patients who had an interval of 3 or more years since their last colonoscopy',''),
('PQRS_0185', 'answer', '1|Interval of Three or More Years Since Patient\'s Last Colonoscopy (0529F)|0529F',1),
('PQRS_0185', 'answer', '2|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy for Medical Reasons; Documentation of medical reason(s) (0529F:1P)|0529F:1P',2),
('PQRS_0185', 'answer', '3|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy for System Reasons; Documentation of system reason (0529F:3P)|0529F:3P',2),
('PQRS_0185', 'answer', '4|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy, Reason not Otherwise Specified (0529F:8P)|0529F:8P',9),

('PQRS_0187', 'description', 'Stroke and Stroke Rehabilitation: Thrombolytic Therapy',''),
('PQRS_0187', 'question', 'Patients for whom IV thrombolytic therapy was initiated at the hospital within three hours (= 180 minutes) of time last known well<br>Definition: Last Known Well -- The date and time prior to hospital arrival at which it was witnessed or reported that the patient was last known to be without the signs and symptoms of the current stroke or at his or her baseline state of health.',''),
('PQRS_0187', 'answer', '1|IV t-PA initiated within three hours (= 180 minutes) of time last known well (G8600)|G8600',1),
('PQRS_0187', 'answer', '2|IV t-PA not initiated within three hours (= 180 minutes) of time last known well for reasons documented by clinician (e.g., patient enrolled in clinical trial for stroke, patient admitted for elective carotid intervention) (G8601)|G8601',2),
('PQRS_0187', 'answer', '3|IV t-PA not initiated within three hours (= 180 minutes) of time last known well, reason not given (G8602)|G8602',9),

('PQRS_0191', 'description', 'Cataracts: 20/40 or Better Visual Acuity within 90 Days Following Cataract Surgery',''),
('PQRS_0191', 'question', 'Did patient have best-corrected visual acuity of 20/40 or better (distance or near) achieved within 90 days following cataract surgery?',''),
('PQRS_0191', 'answer', '1|Best-corrected visual acuity of 20/40 or better (distance or near) achieved within the 90 days following cataract surgery (4175F)|4175F',1),
('PQRS_0191', 'answer', '2|Best-corrected visual acuity of 20/40 or better (distance or near) not achieved within the 90 days following cataract surgery, reason not otherwise specified (4175F:8P)|4175F:8P',9),

('PQRS_0192', 'description', 'Cataracts: Complications within 30 Days Following Cataract Surgery Requiring Additional Surgical Procedures',''),
('PQRS_0192', 'question', 'Patients who had one or more specified operative procedures for any of the following major complications within 30 days following cataract surgery: retained nuclear fragments, endophthalmitis, dislocated or wrong power IOL, retinal detachment, or wound dehiscence<br> ** See Measure Description for extensive code list **<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0192', 'answer', '1|Surgical procedure performed within 30 days followingcataract surgery for major complications (e.g., retained nuclear fragments, endophthalmitis, dislocated or wrong power IOL, retinal detachment or wound dehiscence) (G8627)|G8627',1),
('PQRS_0192', 'answer', '2|Surgical procedure not performed within 30 days following cataract surgery for major complications (e.g., retained nuclear fragments, endophthalmitis, dislocated or wrong power IOL, retinal detachment or wound dehiscence) (G8628)|G8628',9),

('PQRS_0195', 'description', 'Radiology: Stenosis Measurement in Carotid Imaging Reports',''),
('PQRS_0195', 'question', 'Final reports for carotid imaging studies that include direct or indirect reference to measurements of distal internal carotid diameter as the denominator for stenosis measurement<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0195', 'answer', '1|Reference to Measurements of Distal Internal Carotid Diameter as the Denominator for Stenosis Measurement Referenced (3100F)|3100F',1),
('PQRS_0195', 'answer', '2|Measurements of Distal Internal Carotid Diameter not Referenced, Reason not Otherwise Specified (3100F:8P)|3100F:8P',9),


('PQRS_0204', 'description', 'Ischemic Vascular Disease (IVD): Use of Aspirin or Another Antithrombotic',''),
('PQRS_0204', 'question', 'Patients who have documentation of use of aspirin or another antithrombotic therapy during the measurement period<br>Numerator Instructions: Oral antithrombotic therapy consists of: aspirin, clopidogrel, combination of aspirin and extended release dipyridamole, prasugrel, ticagrelor or ticlopidine',''),
('PQRS_0204', 'answer', '1|Aspirin or Another Antithrombotic Therapy Used (G8598)|G8598',1),
('PQRS_0204', 'answer', '2|Aspirin or Another Antithrombotic Therapy not Used, Reason not Given (G8599)|G8599',9),

('PQRS_0205', 'description', 'HIV/AIDS: Sexually Transmitted Disease Screening for Chlamydia, Gonorrhea, and Syphilis',''),
('PQRS_0205', 'question', 'Patients with chlamydia, gonorrhea, and syphilis screenings performed at least once since the diagnosis of HIV infection<br>NUMERATOR NOTE: Report G9228 when results are documented for all of the 3 screenings',''),
('PQRS_0205', 'answer', '1|Chlamydia, gonorrhea and syphilis screening results documented (report when results are present for all of the 3 screenings) (G9228)|G9228',1),
('PQRS_0205', 'answer', '2|Chlamydia, gonorrhea, and syphilis screening results not documented (Patient refusal is the only allowed exclusion) (G9229)|G9229',2),
('PQRS_0205', 'answer', '3|Chlamydia, gonorrhea, and syphilis screening results not documented as performed, reason not given (G9230)|G9230',9),

('PQRS_0217', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Knee Impairments',''),
('PQRS_0217', 'question', 'Patients presented FOTO Functional Intake Survey for the Knee at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Not Eligible/Not Appropriate -- A patient is not eligible if one or more of the following conditions exist:<li>Patient refused to participate<li>Patient unable to complete the questionnaire due to blindness, illiteracy, severe mental incapacity or language incompatibility and an adequate proxy is not available<li>Prior to conclusion of Plan of Care, intervention was interrupted or discontinued for any reason including by the referring physician, the provider, the payer or the patient, and attempts by the provider to complete a follow-up functional status survey near Discharge were unsuccessful.',''),
('PQRS_0217', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the knee successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8647)|G8647',1),
('PQRS_0217', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the knee successfully calculated and the score was less than zero (&lt; 0) (G8648)|G8648',1),
('PQRS_0217', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the knee not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8649)|G8649',2),
('PQRS_0217', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the knee not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8650)|G8650',9),

('PQRS_0218', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Hip Impairments',''),
('PQRS_0218', 'question', 'Patients presented FOTO Functional Intake Survey for the Hip at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score<br>*** Please see Measure Documentation for Definitions and Instructions ***<br> Not Eligible/Not Appropriate -- A patient is not eligible if one or more of the following conditions exist:<li>Patient refused to participate<li>Patient unable to complete the questionnaire due to blindness, illiteracy, severe mental incapacity or language incompatibility and an adequate proxy is not available<li>Prior to conclusion of Plan of Care, intervention was interrupted or discontinued for any reason including by the referring physician, the provider, the payer or the patient, and attempts by the provider to complete a follow-up functional status survey near Discharge were unsuccessful.',''),
('PQRS_0218', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the hip successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8651)|G8651',1),
('PQRS_0218', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the hip successfully calculated and the score was less than zero (&lt; 0) (G8652)|G8652',1),
('PQRS_0218', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the hip not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8653)|G8653',2),
('PQRS_0218', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the hip not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8654)|G8654',9),

('PQRS_0219', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lower Leg, Foot or Ankle Impairments',''),
('PQRS_0219', 'question', 'Patients presented FOTO Functional Intake Survey for the Lower Leg, Foot or Ankle at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0219', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the lower leg, foot or ankle successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8655)|G8655',1),
('PQRS_0219', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the lower leg, foot or ankle successfully calculated and the score was less than zero (&lt; 0) (G8656)|G8656',1),
('PQRS_0219', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the lower leg, foot or ankle not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8657)|G8657',2),
('PQRS_0219', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the lower leg, foot or ankle not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8658)|G8658',9),

('PQRS_0220', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lumbar Spine Impairments',''),
('PQRS_0220', 'question', 'Patients presented FOTO Functional Intake Survey for the Lumbar Spine at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0220', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the lumbar spine successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8659)|G8659',1),
('PQRS_0220', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the lumbar spine successfully calculated and the score was less than zero (&lt; 0) (G8660)|G8660',1),
('PQRS_0220', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the lumbar spine not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8661)|G8661',2),
('PQRS_0220', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the lumbar spine not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8662)|G8662',9),

('PQRS_0221', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Shoulder Impairments',''),
('PQRS_0221', 'question', 'Patients presented FOTO Functional Intake Survey for the Shoulder at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0221', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the shoulder successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8663)|G8663',1),
('PQRS_0221', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the shoulder successfully calculated and the score was less than zero (&lt; 0) (G8664)|G8664',1),
('PQRS_0221', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the shoulder not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8665)|G8665',2),
('PQRS_0221', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the shoulder not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8666)|G8666',9),

('PQRS_0222', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Elbow, Wrist or Hand Impairments',''),
('PQRS_0222', 'question', 'Patients presented FOTO Functional Intake Survey for the Elbow, Wrist or Hand at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score <br>*** Please see Measure Documentation for Definitions and Instructions *** ',''),
('PQRS_0222', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the elbow, wrist or hand successfully calculated and the score was equal to zero (0) or greater than zero (&gt; 0) (G8667)|G8667',1),
('PQRS_0222', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the elbow, wrist or hand successfully calculated and the score was less than zero (&lt; 0) (G8668)|G8668',1),
('PQRS_0222', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the elbow, wrist or hand not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8669)|G8669',2),
('PQRS_0222', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the elbow, wrist or hand not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8670)|G8670',9),

('PQRS_0223', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Neck, Cranium, Mandible, Thoracic Spine, Ribs, or Other General Orthopedic Impairments',''),
('PQRS_0223', 'question', 'Patients presented FOTO Functional Intake Survey for the Neck, Cranium, Mandible, Thoracic Spine, Ribs, or Other General Orthopedic Impairment at admission and FOTO Functional Status Survey at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0223', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment successfully calculated and the score was equal to zero (0) or greater than zero (> 0) (G8671)|G8671',1),
('PQRS_0223', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment successfully calculated and the score was less than zero (&lt; 0) (G8672)|G8672',1),
('PQRS_0223', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, patient Not Eligible/Not Appropriate (G8673)|G8673',2),
('PQRS_0223', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8674)|G8674',9),

('PQRS_0224', 'description', 'Melanoma: Overutilization of Imaging Studies in Melanoma',''),
('PQRS_0224', 'question', 'Patients for whom no diagnostic imaging studies were ordered<br><b>*** Please see Measure Documentation for Definitions and Instructions ***</b><br>Numerator Instructions: A higher score indicates appropriate treatment of patients with melanoma without additional signs or symptoms.',''),
('PQRS_0224', 'answer', '1|None of the following diagnostic imaging studies ordered: chest x-ray, CT, Ultrasound, MRI, PET, or nuclear medicine scans (3320F)|3320F',1),
('PQRS_0224', 'answer', '2|Documentation of medical reason(s) for ordering diagnostic imaging studies (e.g., patient has co-morbid condition that warrants imaging, other medical reasons) (3319F:1P)|3319F:1P',2),
('PQRS_0224', 'answer', '3|Documentation of system reason(s) for ordering diagnostic imaging studies (e.g., requirement for clinical trial enrollment, ordered by another provider, other system reasons) (3319F:3P)|3319F:3P',2),
('PQRS_0224', 'answer', '4|One of the following diagnostic imaging studies ordered -- chest x-ray, CT, Ultrasound, MRI, PET, or nuclear medicine scans (3319F)|3319F',9),

('PQRS_0225', 'description', 'Radiology: Reminder System for Screening Mammograms',''),
('PQRS_0225', 'question', 'Patients whose information is entered into a reminder system with a target due date for the next mammogram<br>Numerator Instructions: The reminder system should be linked to a process for notifying patients when their next mammogram is due and should include the following elements at a minimum: patient identifier, patient contact information, dates(s) of prior screening mammogram(s) (if known), and the target due date for the next mammogram.',''),
('PQRS_0225', 'answer', '1|Patient Information Entered into a Reminder System with Target Due Date for the Next Mammogram (7025F)|7025F',1),
('PQRS_0225', 'answer', '2|Patient Information not Entered into a Reminder System for Medical Reasons (7025F:1P)|7025F:1P',2),
('PQRS_0225', 'answer', '3|Patient Information not Entered into a Reminder System, Reason not Otherwise Specified (7025F:8P)|7025F:8P',9),

('PQRS_0226', 'description', 'Preventive Care and Screening: Tobacco Use: Screening and Cessation Intervention',''),
('PQRS_0226', 'question', 'Patients who were screened for tobacco use at least once within 24 months AND who received tobacco cessation intervention if identified as a tobacco user<br>Definitions:<br>Tobacco Use -- Includes use of any type of tobacco.<br>Tobacco Cessation Intervention -- Includes brief counseling (3 minutes or less), and/or pharmacotherapy.',''),
('PQRS_0226', 'answer', '1|Patient screened for tobacco use AND received tobacco cessation intervention (counseling, pharmacotherapy, or both) (4004F)|4004F',1),
('PQRS_0226', 'answer', '2|Current tobacco non-user (1036F)|1036F',1),
('PQRS_0226', 'answer', '3|Tobacco Screening not Performed for Medical Reasons; Documentation of medical reason(s) (eg, limited life expectancy, other medical reasons) (4004F:1P)|4004F:1P',2),
('PQRS_0226', 'answer', '4|Tobacco Screening OR Tobacco Cessation Intervention not Performed, Reason Not Otherwise Specified (4004F:8P)|4004F:8P',9),

('PQRS_0236', 'description', 'Controlling High Blood Pressure',''),
('PQRS_0236', 'question', 'Is the blood pressure at the most recent visit adequately controlled (systolic blood pressure &lt; 140 mmHg and diastolic blood pressure &lt; 90 mmHg)?',''),
('PQRS_0236', 'answer', '1|Most recent systolic blood pressure &lt; 140 mmHg AND Most recent diastolic blood pressure &lt; 90 mmHg (G8752 G8754)|G8752 G8754',1),
('PQRS_0236', 'answer', '2|Most recent systolic blood pressure &ge; 140 mmHg AND Most recent diastolic blood pressure &lt; 90 mmHg (G8753 G8754)|G8753 G8754',9),
('PQRS_0236', 'answer', '3|Most recent systolic blood pressure &lt; 140 mmHg AND Most recent diastolic blood pressure &gt; 90 mmHg (G8752 G8755)|G8752 G8755',9),
('PQRS_0236', 'answer', '4|Most recent systolic blood pressure &ge; 140 mmHg AND Most recent diastolic blood pressure &gt; 90 mmHg (G8753 G8755)|G8753 G8755',9),
('PQRS_0236', 'answer', '5|Blood Pressure Measurement not Documented, Reason not Given (G8756)|G8756',9),

('PQRS_0238', 'description', 'Use of High-Risk Medications in the Elderly',''),
('PQRS_0238', 'question', 'What percentage of patients 65 years of age and older were ordered high-risk medication during the measurement period<br>INVERSE MEASURE<br>?',''),
('PQRS_0238', 'answer', '1|One order for high-risk medication (G9365)|G9365',1),
('PQRS_0238', 'answer', '2|High-risk medication not ordered during the measurement period (G9366)|G9366',9),
('PQRS_0238', 'answer', '3|Two or more orders for the same high-risk medication (G9367)|G9367',1),
('PQRS_0238', 'answer', '4|Less than two orders for the same high-risk medication (G9368)|G9368',9),

('PQRS_0243', 'description', 'Rehabilitation Patient Referral from an Outpatient Setting',''),
('PQRS_0243', 'question', 'Patients who have had a qualifying event/diagnosis within the previous 12 months, who have been referred to an outpatient cardiac rehabilitation/secondary prevention (CR) program Numerator Instructions: CR programs may include a traditional CR program based on face-to-face interactions and training sessions or other options that include home-based approaches. If alternative CR approaches are used, they should be designed to meet appropriate safety standards.',''),
('PQRS_0243', 'answer', '1|Referral to an outpatient cardiac rehabilitation/secondary prevention program. Referred to an outpatient cardiac rehabilitation program (4500F)|4500F',1),
('PQRS_0243', 'answer', '2|Documentation of medical reason(s) for not referring to an outpatient CR program (4500F:1P)|4500F:1P',2),
('PQRS_0243', 'answer', '3|Documentation of system reason(s) for not referring to an outpatient CR program (4500:3P)|4500:3P',2),
('PQRS_0243', 'answer', '4|Previous cardiac rehabilitation for qualifying cardiac event completed (4510F)|4510F',2),
('PQRS_0243', 'answer', '5|Patient not referred to outpatient CR/secondary prevention program, reason not otherwise specified (4500F:8P)|4500F:8P',9),

('PQRS_0249', 'description', 'Barrett''s Esophagus',''),
('PQRS_0249', 'question', 'Esophageal biopsy report documents the presence of Barrett''s mucosa and includes a statement about dysplasia',''),
('PQRS_0249', 'answer', '1|Esophageal Biopsy Reports with the Histological Finding of Barrett''s Mucosa that Contains a Statement about Dysplasia (present, absent, or indefinite and if present, contains appropriate grading) (3126F)|3126F',1),
('PQRS_0249', 'answer', '2|Esophageal Biopsy Reports with the Histological Finding of Barrett''s Mucosa that Contains a Statement about Dysplasia (present, absent, or indefinite) not Performed for Medical Reasons (3126F:1P)|3126F:1P',2),
('PQRS_0249', 'answer', '3|Esophageal Biopsy Reports with the Histological Finding of Barrett''s Mucosa that does not Contain a Statement about Dysplasia (present, absent, or indefinite), Reason not Otherwise Specified (3126F:8P)|3126F:8P',9),

('PQRS_0250', 'description', 'Radical Prostatectomy Pathology Reporting',''),
('PQRS_0250', 'question', 'Radical Prostatectomy reports that include the pT category, the pN category, Gleason score and a statement about margin status',''),
('PQRS_0250', 'answer', '1|Radical Prostatectomy Report includes pT category, pN category, Gleason Score and Statement about Margin Status (3267F)|3267F',1),
('PQRS_0250', 'answer', '2|pT category, pN category, Gleason Score and Statement about Margin Status not Documented for Medical Reasons (3267F:1P)|3267F:1P',2),
('PQRS_0250', 'answer', '3|pT category, pN category, Gleason Score and Statement about Margin Status not Documented, Reason not Otherwise Specified (3267F:8P)|3267F:8P',9),

('PQRS_0251', 'description', 'Quantitative Immunohistochemical (IHC) Evaluation of Human Epidermal Growth Factor Receptor 2 Testing (HER2) for Breast Cancer Patients',''),
('PQRS_0251', 'question', 'Breast cancer patients receiving quantitative breast tumor HER2 IHC evaluation using the ASCO/CAP recommended manual system or a computer-assisted system consistent with the optimal algorithm for HER2 testing as described in the current ASCO/CAP guideline',''),
('PQRS_0251', 'answer', '1|Quantitative HER2 by IHC evaluation consistent with scoring system defined in the ASCO/CAP guidelines (3394F)|3394F',1),
('PQRS_0251', 'answer', '2|Quantitative evaluation of HER2 did not use the system recommended in the ASCO/CAP Guidelines for Human Epidermal Growth Factor Receptor 2 Testing in breast cancer, reason not otherwise specified (3394F:8P)|3394F:8P',9),

('PQRS_0254', 'description', 'Ultrasound Determination of Pregnancy Location for Pregnant Patients with Abdominal Pain',''),
('PQRS_0254', 'question', 'Did pregnant patients presenting at ED with abdominal pain or vaginal bleeding recieve a trans-abdominal or trans-vaginal ultrasound for pregnacy location?',''),
('PQRS_0254', 'answer', '1|Trans-Abdominal or Trans-Vaginal Ultrasound Performed (G8806)|G8806',1),
('PQRS_0254', 'answer', '2|Trans-Abdominal or Trans-Vaginal Ultrasound not Performed for Documented Clinical Reasons (G8807)|G8807',2),
('PQRS_0254', 'answer', '3| Trans-Abdominal or Trans-Vaginal Ultrasound not Performed, Reason not Given (G8808)|G8808',9),

('PQRS_0255', 'description', 'Rh Immunoglobulin (Rhogam) for Rh-Negative Pregnant Women at Risk of Fetal Blood Exposure',''),
('PQRS_0255', 'question', 'Patients who receive an order for Rh-Immunoglobulin (Rhogam) in the ED',''),
('PQRS_0255', 'answer', '1|Documentation in Medical Record that Rh-immunoglobulin (Rhogam) Ordered (G8809)|G8809',1),
('PQRS_0255', 'answer', '2|Rh-immunoglobulin (Rhogam) not Ordered for Documented Reasons (e.g., patient had prior documented receipt of Rhogam within 12 weeks, patient refusal) (G8810)|G8810',2),
('PQRS_0255', 'answer', '3|Rh-immunoglobulin (Rhogam) not Ordered, Reason not Given (G8811)|G8811',9),

('PQRS_0257', 'description', 'Statin Therapy at Discharge after Lower Extremity Bypass (LEB)',''),
('PQRS_0257', 'question', 'Patients prescribed a statin medication at discharge  ',''),
('PQRS_0257', 'answer', '1|Statin medication prescribed at discharge (G8816)|G8816',1),
('PQRS_0257', 'answer', '2|Statin therapy not prescribed for documented reasons (e.g., medical intolerance to statin, death of patient prior to discharge, transfer of care to another acute care or federal hospital, hospice admission, left against medical advice) (G8815)|G8815',2),
('PQRS_0257', 'answer', '3|Statin therapy not prescribed at discharge, reason not given (G8817)|G8817',9),

('PQRS_0258', 'description', 'Rate of Open Repair of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) without Major Complications (Discharged to Home by Post-Operative Day #7)',''),
('PQRS_0258', 'question', ' Patients discharged to home no later than post-operative day #7<br>Definition:<br>Home -- For purposes of reporting this measure, home is the point of origin prior to hospital admission prior to procedure of AAA. For example, if the patient comes from a skilled facility and returns to the skilled facility post AAA repair, this would meet criteria for discharged to home. ',''),
('PQRS_0258', 'answer', '1|Patient discharge to home no later than post-operative day #7 (G8818)|G8818',1),
('PQRS_0258', 'answer', '2|Patient not discharged to home by post-operative day #7 (G8825)|G8825',9),

('PQRS_0259', 'description', 'Rate of Endovascular Aneurysm Repair (EVAR) of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) without Major Complications (Discharged to Home by Post Operative Day #2)',''),
('PQRS_0259', 'question', 'Patients discharged to home no later than post-operative day #2 following EVAR of AAA <br>Definition:<br>Home -- For purposes of reporting this measure, home is the point of origin prior to hospital admission prior to procedure of AAA. For example, if the patient comes from a skilled facility and returns to the skilled facility post AAA repair, this would meet criteria for discharged to home.',''),
('PQRS_0259', 'answer', '1|Patient discharged to home no later than post-operative day #2 following EVAR (G8826)|G8826',1),
('PQRS_0259', 'answer', '2|Patient not discharged to home by post-operative day #2 following EVAR (G8833)|G8833',9),

('PQRS_0260', 'description', 'Rate of Carotid Endarterectomy (CEA) for Asymptomatic Patients, without Major Complications (Discharged to Home by Post-Operative Day #2)',''),
('PQRS_0260', 'question', 'Patients that are asymptomatic neurologically who were discharged alive, to home no later than post-operative day #2 following CEA<br>Definition:<br>Home -- For purposes of reporting this measure, home is the point of origin prior to hospital admission for procedure of CEA. For example, if the patient comes from a skilled facility and returns to the skilled facility post CEA, this would meet criteria for discharged to home.',''),
('PQRS_0260', 'answer', '1|Patient discharged to home no later than post-operative day #2 following CEA (G8834)|G8834',1),
('PQRS_0260', 'answer', '2|Patient not discharged to home by post-operative day #2 following CEA (G8838)|G8838',9),

('PQRS_0261', 'description', 'Referral for Otologic Evaluation for Patients with Acute or Chronic Dizziness',''),
('PQRS_0261', 'question', 'Patients referred to a physician for an otologic evaluation subsequent to an audiologic evaluation who present with acute or chronic dizziness<br>NUMERATOR NOTE: The physician receiving the referral, or providing care currently, should preferably be specially trained in disorders of the ear.',''),
('PQRS_0261', 'answer', '1|Referral for Otologic Evaluation (G8856)|G8856',1),
('PQRS_0261', 'answer', '2|Referral for Otologic Evaluation not Performed for Documented Reasons (e.g., patients who are already under the care of a physician for acute or chronic dizziness) (G8857)|G8857',2),
('PQRS_0261', 'answer', '3|Referral for Otologic Evaluation not Performed, Reason not Given (G8858)|G8858',9),

('PQRS_0262', 'description', 'Image Confirmation of Successful Excision of Image-Localized Breast Lesion',''),
('PQRS_0262', 'question', ' Patients undergoing excisional biopsy or partial mastectomy of a non-palpable lesion whose excised breast tissue was evaluated by imaging (x-ray, ultrasound, MRI, PET mammography or other imaging modality) intraoperatively to confirm successful inclusion of targeted lesion',''),
('PQRS_0262', 'answer', '1|Excised tissue evaluated by imaging intraoperatively to confirm successful inclusion of targeted lesion (G8872)|G8872',1),
('PQRS_0262', 'answer', '2|Excised tissue not evaluated by imaging intraoperatively to confirm successful inclusion of targeted lesion, reason not given (G8874)|G8874',9),

('PQRS_0263', 'description', 'Preoperative Diagnosis of Breast Cancer',''),
('PQRS_0263', 'question', 'The number of patients aged 18 and older undergoing breast cancer operations who had breast cancer diagnosed preoperatively by a minimally invasive biopsy<br>Definition:<br>Minimally invasive biopsy methods -- Includes fine needle aspiration, percutaneous core needle biopsy, percutaneous automated vacuum assisted rotating biopsy device, skin biopsy, skin shave or punch biopsy',''),
('PQRS_0263', 'answer', '1|Clinician diagnosed breast cancer preoperatively by a minimally invasive biopsy method (G8875)|G8875',1),
('PQRS_0263', 'answer', '2|Documentation of reason(s) for not performing minimally invasive biopsy to diagnose breast cancer preoperatively (e.g., lesion too close to skin, implant, chest wall, etc., lesion could not be adequately visualized for needle biopsy, patient condition prevents needle biopsy [weight, breast thickness, etc.], duct excision without imaging abnormality, prophylactic mastectomy, reduction mammoplasty, excisional biopsy performed by another physician) (G8876)|G8876',2),
('PQRS_0263', 'answer', '3|Clinician did not attempt to achieve the diagnosis of breast cancer preoperatively by a minimally invasive biopsy method, reason not given (G8877)|G8877',9),

('PQRS_0264', 'description', 'Sentinel Lymph Node Biopsy for Invasive Breast Cancer',''),
('PQRS_0264', 'question', 'Did patients operated upon for invasive breast cancer that are clinically node negative before or after neoadjuvant systemic therapy undergo a SLN procedure?',''),
('PQRS_0264', 'answer', '1|Sentinel lymph node biopsy procedure performed (G8878)|G8878',1),
('PQRS_0264', 'answer', '2|Documentation of reason(s) sentinel lymph node biopsy not performed (G8880)|G8880',2),
('PQRS_0264', 'answer', '3|Sentinel lymph node biopsy procedure not performed, reason not given (G8882)|G8882',9),

('PQRS_0265', 'description', 'Biopsy Follow-Up',''),
('PQRS_0265', 'question', 'Were Patients biopsy results reviewed and communicated to the primary care/referring physician and the patient by the physician performing the biopsy. The physician performing the biopsy must also acknowledge and/or document the communication in a biopsy tracking log and document in the patient\'s medical record.<br>Numerator Instructions: To satisfy this measure, the biopsying physician must:<li>Review the biopsy results with the patient<li>Communicate those results to the primary care/referring physician<li>Track communication in a log<li>Document tracking process in the patient\'s medical record<br>Definition:<br>The components of a tracking log incorporate the followingInitials of physician performing the biopsy<li>Patient name<li>Date of biopsy<li>Type of biopsy<li>Biopsy result<li>Date of biopsy result',''),
('PQRS_0265', 'answer', '1|Biopsy results reviewed, communicated, tracked, and documented (G8883)|G8883',1),
('PQRS_0265', 'answer', '2|Clinician documented reason that patient\'s biopsy results were not reviewed (G8884)|G8884',2),
('PQRS_0265', 'answer', '3|Biopsy results not reviewed, communicated, tracked, or documented (G8885)|G8885',9),

('PQRS_0268', 'description', 'Epilepsy: Counseling for Women of Childbearing Potential with Epilepsy',''),
('PQRS_0268', 'question', 'Female patients or caregivers counseled at least once a year about how epilepsy and its treatment may affect contraception OR pregnancy',''),
('PQRS_0268', 'answer', '1|Counseling for Women of Childbearing Potential with Epilepsy (4340F)|4340F',1),
('PQRS_0268', 'answer', '2|Counseling for Women of Childbearing Potential with Epilepsy not Performed for Medical Reasons (4340F:1P)|4340F:1P',2),
('PQRS_0268', 'answer', '3|Counseling for Women of Childbearing Potential with Epilepsy not Performed, Reason not Otherwise Specified (4340F:8P)|4340F:8P',9),

('PQRS_0271', 'description', 'Inflammatory Bowel Disease (IBD): Preventive Care: Corticosteroid Related Iatrogenic Injury -- Bone Loss Assessment',''),
('PQRS_0271', 'question', 'Patients who have received dose of corticosteroids greater than or equal to 10 mg/day of prednisone equivalents for 60 or greater consecutive days or a single prescription equating to 600 mg prednisone or greater for all fills and who were documented for risk of bone loss during the reporting year or the pervious calendar year.<br>Definition:<br>Documented -- Documentation that an assessment for risk of bone loss has been performed or ordered. This includes, but is not limited to, review of systems and medication history, and ordering of Central Dualenergy X-Ray Absorptiometry (DXA) scan.',''),
('PQRS_0271', 'answer', '1|Within the past 2 years, Central Dual-energy X-Ray Absorptiometry (DXA) ordered and documented review of systems and medication history or pharmacologic therapy (other than minerals/vitamins) for osteoporosis prescribed (G8861)|G8861',1),
('PQRS_0271', 'answer', '2|Within the past 2 years, Central Dual-energy X-Ray Absorptiometry (DXA) not ordered and documented, no review of systems and no medication history or pharmacologic therapy (other than minerals/vitamins) for osteoporosis prescribed (G9472)|G9472',9),

('PQRS_0275', 'description', 'Inflammatory Bowel Disease (IBD): Assessment of Hepatitis B Virus (HBV) Status Before Initiating Anti-TNF (Tumor Necrosis Factor) Therapy',''),
('PQRS_0275', 'question', 'Did patients have HBV status assessed and results interpreted prior to receiving their first ever course of antiTNF therapy?',''),
('PQRS_0275', 'answer', '1|Hepatitis B Virus (HBV) status assessed and results interprreted prior to receiving a first course of anti-TNF therapy (G9912)|G9912',1),
('PQRS_0275', 'answer', '2|Patient has documented immunity to hepatitis B and is receiving a first course of anti-TNF therapy (G8869)|G8869',1),
('PQRS_0275', 'answer', '3|Documented reason for not assessing Hepatitis B Virus (HBV) status (e.g. patient not receiving a first course of anti-TNF therapy, patient declined) (G9504)|G9504',2),
('PQRS_0275', 'answer', '4|No documentation that Hepatitis B Virus (HBV) status was assessed and results interpreted prior to receiving a first course of anti-TNF therapy, reason not specified (G9913)|G9913',9),
('PQRS_0275', 'answer', '5|No record of Hepatitis B Virus results documented (G9915)|G9915',9),

('PQRS_0276', 'description', ' Sleep Apnea: Assessment of Sleep Symptoms',''),
('PQRS_0276', 'question', 'Patient visits with an assessment of sleep symptoms documented, including presence or absence of snoring and daytime sleepiness',''),
('PQRS_0276', 'answer', '1|Sleep apnea symptoms assessed, including presence or absence of snoring and daytime sleepiness (G8839)|G8839',1),
('PQRS_0276', 'answer', '2|Documentation of reason(s) for not documenting an assessment of sleep symptoms (e.g., patient didn\'t have initial daytime sleepiness, patient visited between initial testing and initiation of therapy) (G8840)|G8840',2),
('PQRS_0276', 'answer', '3|Sleep apnea symptoms not assessed, reason not given (G8841)|G8841',9),

('PQRS_0277', 'description', 'Sleep Apnea: Severity Assessment at Initial Diagnosis',''),
('PQRS_0277', 'question', 'Patients who had an apnea hypopnea index (AHI) or a respiratory disturbance index (RDI) measured at the time of initial diagnosis<br>Definitions:<br>Apnea-Hypopnea Index (AHI) for polysomnography performed in a sleep lab is defined as (Total Apneas + Hypopneas per hour of sleep) -- Apnea-Hypopnea Index (AHI) for a home sleep study is defined as (Total Apneas + Hypopneas per hour of monitoring).<br>Respiratory Disturbance Index (RDI) - is defined as (Total Apneas + Hypopneas + Respiratory Effort Related Arousals per hour of sleep).',''),
('PQRS_0277', 'answer', '1|Apnea hypopnea index (AHI) or respiratory disturbance index (RDI) measured at the time of initial diagnosis (G8842)|G8842',1),
('PQRS_0277', 'answer', '2|Documentation of reason(s) for not measuring an apnea hypopnea index (AHI) or a respiratory disturbance index (RDI) at the time of initial diagnosis (e.g., psychiatric disease, dementia, patient declined, financial, insurance coverage, test ordered but not yet completed) (G8843)|G8843',2),
('PQRS_0277', 'answer', '3|Apnea hypopnea index (AHI) or respiratory disturbance index (RDI) not measured at the time of initial diagnosis, reason not given (G8844)|G8844',9),

('PQRS_0278', 'description', 'Sleep Apnea: Positive Airway Pressure Therapy Prescribed',''),
('PQRS_0278', 'question', 'Patients who were prescribed positive airway pressure therapy<br>Definition:<br>Moderate or severe sleep apnea - apnea hypopnea index (AHI) or a respiratory disturbance index (RDI) greater than or equal to 15 episodes per hour of sleep',''),
('PQRS_0278', 'answer', '1|Positive airway pressure therapy prescribed (G8845)|G8845',1),
('PQRS_0278', 'answer', '2|Documentation of reason(s) for not prescribing positive airway pressure therapy (e.g., patient unable to tolerate, alternative therapies used, patient declined, financial, insurance coverage)  (G8849)|G8849',2),
('PQRS_0278', 'answer', '3| Positive airway pressure therapy not prescribed, reason not given (G8850)|G8850',9),

('PQRS_0279', 'description', ' Sleep Apnea: Assessment of Adherence to Positive Airway Pressure Therapy',''),
('PQRS_0279', 'question', 'Patient visits with documentation that adherence to positive airway pressure therapy was objectively measured<br>Definition:<br>Objectively measured is defined as -- positive airway pressure machine-generated measurement of hours of use.',''),
('PQRS_0279', 'answer', '1|Objective measurement of adherence to positive airway pressure therapy, documented (G8851)|G8851',1),
('PQRS_0279', 'answer', '2|Documentation of reason(s) for not objectively measuring adherence to positive airway pressure therapy (e.g., patient didn\'t bring data from continuous positive airway pressure [CPAP], therapy not yet initiated, not available on machine)(G8854)|G8854',2),
('PQRS_0279', 'answer', '3|Objective measurement of adherence to positive airway pressure therapy not performed, reason not given (G8855)|G8855',9),

('PQRS_0282', 'description', 'Dementia: Functional Status Assessment',''),
('PQRS_0282', 'question', 'Patients for whom an assessment of functional status is performed and the results reviewed at least once within a 12 month period <br> *** Please see Measure Description for Instructions ***',''),
('PQRS_0282', 'answer', '1|Functional status for dementia assessed and results reviewed (1175F)|1175F',1),
('PQRS_0282', 'answer', '2|Documentation of medical reason(s) for not assessing and reviewing functional status for dementia (eg, patient is severely impaired and caregiver knowledge is limited, other medical reason) (1175F:1P)|1175F:1P',2),
('PQRS_0282', 'answer', '3|Functional status for dementia not assessed and results not reviewed, reason not otherwise specified (1175F:8P)|1175F:8P',9),

('PQRS_0283', 'description', ' Dementia: Neuropsychiatric Symptom Assessment',''),
('PQRS_0283', 'question', 'Patients for whom an assessment of neuropsychiatric symptoms is performed and results reviewed at least once in a 12 month period<br>*** Please See Measure Documentation for Instructions, etc ***',''),
('PQRS_0283', 'answer', '1|Neuropsychiatric symptoms assessed and results reviewed (1181F)|1181F',1),
('PQRS_0283', 'answer', '2|Neuropsychiatric symptoms not assessed and results not reviewed, reason not otherwise specified (1181F:8P)|1181F:8P',9),

('PQRS_0286', 'description', 'Dementia: Counseling Regarding Safety Concerns',''),
('PQRS_0286', 'question', 'Patients or their caregiver(s) who were counseled or referred for counseling regarding safety concerns within a 12 month period<br>  *** See Measure Details for Instructions ***',''),
('PQRS_0286', 'answer', '1|Safety counseling for dementia provided (6101F)|6101F',1),
('PQRS_0286', 'answer', '2|Safety counseling for dementia ordered (6102F)|6102F',1),
('PQRS_0286', 'answer', '3|Documentation of medical reason(s) for not providing counseling regarding safety concerns (eg, patient in palliative care, other medical reason) (6101F:1P)|6101F:1P',2),
('PQRS_0286', 'answer', '4|Documentation of medical reason(s) for not ordering safety counseling (eg, patient in palliative care, other medical reason) (6102F:1P)|6102F:1P',2),
('PQRS_0286', 'answer', '5|Safety counseling for dementia not provided, reason not otherwise specified (6101F:8P)|6101F:8P',9),
('PQRS_0286', 'answer', '6|Safety counseling for dementia not ordered, reason not otherwise specified (6102F:8P)|6102F:8P',9),

('PQRS_0288', 'description', 'Dementia: Caregiver Education and Support',''),
('PQRS_0288', 'question', 'Patients whose caregiver(s) were provided with education on dementia disease management and health behavior changes AND referred to additional resources for support within a 12 month period <br> ** Please see Measure Documentation for Instructions **',''),
('PQRS_0288', 'answer', '1|Caregiver provided with education and referred to additional resources for support (4322F)|4322F',1),
('PQRS_0288', 'answer', '2|Documentation of medical reason(s) for not providing the caregiver with education on disease management and health behavior changes or referring to additional sources for support (eg, patient does not have a caregiver, other medical reason) (4322F:1P)|4322F:1P',2),
('PQRS_0288', 'answer', '3|Caregiver not provided with education and not referred to additional resources for support, reason not otherwise specified (4322F:8P)|4322F:8P',9),

('PQRS_0290', 'description', 'Parkinson\'s Disease: Psychiatric Disorders or Disturbances Assessment',''),
('PQRS_0290', 'question', 'Patients who were assessed for psychiatric disorders or disturbances (e.g., psychosis, depression, anxiety disorder, apathy, or impulse control disorder) at least annually',''),
('PQRS_0290', 'answer', '1|Psychiatric symptoms assessed (G9742)|G9742',1),
('PQRS_0290', 'answer', '2|Psychiatric symptoms not assessed, reason not otherwise specified (G9743) |G9743',9),

('PQRS_0291', 'description', ' Parkinson\'s Disease: Cognitive Impairment or Dysfunction Assessment',''),
('PQRS_0291', 'question', 'Was patients assessed for cognitive impairment or dysfunction at least annually?',''),
('PQRS_0291', 'answer', '1|Cognitive impairment or dysfunction assessed (3720F)|3720F',1),
('PQRS_0291', 'answer', '2|Cognitive impairment or dysfunction was not assessed, reason not otherwise specified (3720F:8P)|3720F:8P',9),

('PQRS_0293', 'description', 'Parkinson\'s Disease: Rehabilitative Therapy Options',''),
('PQRS_0293', 'question', 'Patients (or caregiver(s), as appropriate) who had rehabilitative therapy options (e.g., physical, occupational, or speech therapy) discussed at least annually',''),
('PQRS_0293', 'answer', '1|Rehabilitative therapy options discussed with patient (or caregiver) (4400F)|4400F',1),
('PQRS_0293', 'answer', '2|Documentation of medical reason(s) for not discussing rehabilitative therapy options with patient (or caregiver) (4400F:1P)|4400F:1P',2),
('PQRS_0293', 'answer', '3|Rehabilitative therapy options not discussed with patient (or caregiver), reason not otherwise specified (4400F:8P)|4400F:8P',9),

('PQRS_0303', 'description', 'Cataracts: Improvement in Patient\'s Visual Function within 90 Days Following Cataract Surgery',''),
('PQRS_0303', 'question', 'Patients 18 years and older who had improvement in visual function achieved within 90 days following cataract surgery, based on completing a pre-operative and post-operative visual function survey',''),
('PQRS_0303', 'answer', '1|Improvement in visual function achieved within 90 days following cataract surgery (G0913)|G0913',1),
('PQRS_0303', 'answer', '2|Patient care survey was not completed by patient (G0914)|G0914',2),
('PQRS_0303', 'answer', '3|Improvement in visual function not achieved within 90 days following cataract surgery (G0915)|G0915',9),

('PQRS_0304', 'description', 'Patient Satisfaction within 90 Days Following Cataract Surgery',''),
('PQRS_0304', 'question', 'Patients 18 years and older in the sample who were satisfied with their care within 90 days following cataract surgery, based on completion of the Consumer Assessment of Healthcare Providers and Systems Surgical Care Survey',''),
('PQRS_0304', 'answer', '1|Satisfaction with care achieved within 90 days following cataract surgery (G0916)|G0916',1),
('PQRS_0304', 'answer', '2|Patient care survey was not completed by patient (G0917)|G0917',2),
('PQRS_0304', 'answer', '3|Satisfaction with care not achieved within 90 days following cataract surgery (G0918)|G0918',9),

('PQRS_0317', 'description', 'Percentage of patients aged 18 years and older seen during the reporting period who were screened for high blood pressure AND a recommended follow-up plan is documented based on the current blood pressure (BP) reading as indicated',''),
('PQRS_0317', 'question', 'Was patient screened for high blood pressure AND had a recommended follow-up plan documented, as indicated, if the blood pressure is pre-hypertensive or hypertensive?<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>NUMERATOR NOTE: Although the recommended screening interval for a normal BP reading is every 2 years, to meet the intent of this measure, BP screening and follow-up must be performed once per measurement period. For patients with Normal blood pressure a follow-up plan is not required.',''),
('PQRS_0317', 'answer', '1|Normal blood pressure reading documented, follow-up not required (G8783)|G8783',1),
('PQRS_0317', 'answer', '2|Pre-Hypertensive or Hypertensive blood pressure reading documented, AND the indicated follow-up is documented (G8950)|G8950',1),
('PQRS_0317', 'answer', '3|Documented reason for not screening or recommending a follow-up for high blood pressure  (G9745)(|G9745',2),
('PQRS_0317', 'answer', '4|Blood pressure reading not documented, reason not given (G8785)|G8785',9),
('PQRS_0317', 'answer', '5|Pre-Hypertensive or Hypertensive blood pressure reading documented, indicated follow-up not documented, reason not given (G8952)|G8952',9),

('PQRS_0320', 'description', 'Appropriate Follow-Up Interval for Normal Colonoscopy in Average Risk Patients',''),
('PQRS_0320', 'question', 'Patients who had recommended follow-up interval of at least 10 years for repeat colonoscopy documented in their colonoscopy report',''),
('PQRS_0320', 'answer', '1|At Least 10 Year Follow-Up Interval for Colonoscopy Recommended (0528F)|0528F',1),
('PQRS_0320', 'answer', '2|At Least 10 Year Follow-Up Interval for Colonoscopy not Recommended for Medical Reasons (0528F::1P)|0528F:1P',2),
('PQRS_0320', 'answer', '3|At Least 10 Year Follow-Up Interval for Colonoscopy not Recommended, Reason not Otherwise Specified (0528F:8P)|0528F:8P',9),

('PQRS_0322', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Preoperative Evaluation in Low Risk Surgery Patients',''),
('PQRS_0322', 'question', 'Cardiac Stress Imaging Test primarily performed on patient?',''),
('PQRS_0322', 'answer', '1|Cardiac Stress Imaging Test primarily performed on low-risk surgery patient for preoperative evaluation within 30 days preceding this surgery|G8961',1),
('PQRS_0322', 'answer', '2|Cardiac Stress Imaging Test performed on patient for any reason including those who did not have low-risk surgery or test that was performed more than 30 days preceding low-risk surgery|G8962',9),

('PQRS_0323', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Routine Testing After Percutaneous Coronary Intervention (PCI)<br>Percentage of all stress single-photon emission computed tomography (SPECT) myocardial perfusion imaging (MPI), stress echocardiogram (ECHO), cardiac computed tomography angiography (CCTA), and cardiovascular magnetic resonance (CMR) performed in patients aged 18 years and older routinely after percutaneous coronary intervention (PCI), with reference to timing of test after PCI and symptom status <br>**INVERSE MEASURE**',''),
('PQRS_0323', 'question', 'Was of stress SPECT MPI, stress echo, CCTA and CMR performed in asymptomatic patients within 2 years of the most recent PCI?',''),
('PQRS_0323', 'answer', '1|Cardiac Stress Imaging performed primarily for monitoring of asymptomatic patient who had PCI within 2 years|G8963',1),
('PQRS_0323', 'answer', '2|ardiac Stress Imaging test performed primarily for any other reason than monitoring of asymptomatic patient who had PCI within 2 years (e.g., symptomatic patient, patient greater than 2 years since PCI, initial evaluation, etc.)|G8964',9),

('PQRS_0324', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Testing in Asymptomatic, Low-Risk Patients<br>Percentage of all stress single-photon emission computed tomography (SPECT) myocardial perfusion imaging (MPI), stress echocardiogram (ECHO), cardiac computed tomography angiography (CCTA), and cardiovascular magnetic resonance (CMR) performed in asymptomatic, low coronary heart disease (CHD) risk patients 18 years and older for initial detection and risk assessmenti<br>**INVERSE MEASURE**',''),
('PQRS_0324', 'question', 'Was stress SPECT MPI, stress echo, CCTA, or CMR primarily performed for asymptomatic, low CHD risk patients for initial detection and risk assessment?',''),
('PQRS_0324', 'answer', '1|Cardiac Stress Imaging Test primarily performed on low CHD risk patient for initial detection and risk assessment|G8965',1),
('PQRS_0324', 'answer', '2|Cardiac Stress Imaging Test performed on symptomatic or higher than low CHD risk patient or for any reason other than initial detection and risk assessment|G8966',9),

('PQRS_0325', 'description', 'Adult Major Depressive Disorder (MDD): Coordination of Care of Patients with Specific Comorbid Conditions<br>Percentage of medical records of patients aged 18 years and older with a diagnosis of major depressive disorder (MDD) and a specific diagnosed comorbid condition (diabetes, coronary artery disease, ischemic stroke, intracranial hemorrhage, chronic kidney disease [stages 4 or 5], End Stage Renal Disease [ESRD] or congestive heart failure) being treated by another clinician with communication to the clinician treating the comorbid condition',''),
('PQRS_0325', 'question', 'Medical records of patients with communication to the clinician treating the comorbid condition<br>Definition:<br>Communication -- Transmission of relevant clinical information which specifies that the patient has MDD',''),
('PQRS_0325', 'answer', '1|Clinician treating Major Depressive Disorder communicates to clinician treating comorbid condition (G8959)|G8959',1),
('PQRS_0325', 'answer', '2|Clinician treating Major Depressive Disorder did not communicate to clinician treating comorbid condition for specified patient reason (G9232)|G9232',2),
('PQRS_0325', 'answer', '3|Clinician treating Major Depressive Disorder did not communicate to clinician treating comorbid condition, reason not given (G8960)|G8960',9),

('PQRS_0326', 'description', 'Atrial Fibrillation and Atrial Flutter: Chronic Anticoagulation Therapy',''),
('PQRS_0326', 'question', 'Was the patient prescribed warfarin OR another oral anticoagulant drug that is FDA approved for the prevention of thromboembolism?',''),
('PQRS_0326', 'answer', '1|Warfarin OR Another Oral Anticoagulant that is FDA Approved is Prescribed (G8967)|G8967',1),
('PQRS_0326', 'answer', '2|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented Medical Reasons (G8968)|G8968',2),
('PQRS_0326', 'answer', '3|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented Patient Reasons (G8969)|G8969',2),
('PQRS_0326', 'answer', '4|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented System Reasons (G89927)|G9927',2),
('PQRS_0326', 'answer', '5|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed, Reason not Given (G9928)|G9928',9),

('PQRS_0327', 'description', 'Pediatric Kidney Disease: Adequacy of Volume Management',''),
('PQRS_0327', 'question', 'Calendar months during which patients have an assessment of the adequacy of volume management from a nephrologist<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Definition:<br>Adequacy of Volume Management -- Adequacy of volume management for a patient on dialysis is determined by assessing whether or not the patient achieved a target end dialysis weight after receiving dialysis, by a comparison of the patient-specific target end dialysis weight and the actual post dialysis weight.',''),
('PQRS_0327', 'answer', '1|Most recent assessment of adequacy of volume management documented (G8955)|G8955',1),
('PQRS_0327', 'answer', '2|Assessment of adequacy of volume management not documented, reason not given (G8958)|G8958',2),

('PQRS_0328', 'description', 'Pediatric Kidney Disease: ESRD Patients Receiving Dialysis: Hemoglobin Level &lt; 10 g/dL',''),
('PQRS_0328', 'question', 'Calendar months during which patients have a hemoglobin level &lt; 10 g/dL Numerator Instructions: The hemoglobin values used for this measure should be a most recent (last) hemoglobin value recorded for each calendar month.  <br>*** Please see Measure Documentation for Definitions and Instructions ***<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0328', 'answer', '1|Most recent hemoglobin (Hgb) level &lt; 10 g/dL (G8973)|G8973',1),
('PQRS_0328', 'answer', '2|Hemoglobin level measurement not documented, reason not given (G8974)|G8974',2),
('PQRS_0328', 'answer', '3|Documentation of medical reason(s) for patient having a hemoglobin level &lt; 10 g/dL (G8975)|G8975',2),
('PQRS_0328', 'answer', '4|Most recent hemoglobin (Hgb) level &ge; 10 g/dL (G8976)|G8976',9),

('PQRS_0329', 'description', 'Adult Kidney Disease: Catheter Use at Initiation of Hemodialysis',''),
('PQRS_0329', 'question', 'Patients whose mode of vascular access is a catheter at the time maintenance hemodialysis is initiated<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions: Of note, the performance tags indicating ''Performance Met'' and ''Performance Not Met'' are included to highlight what is being measured and reported and not to encourage catheter use. <br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0329', 'answer', '1|Patient whose mode of vascular access is a catheter at the time maintenance hemodialysis is initiated (G9240)|G9240',1),
('PQRS_0329', 'answer', '2|Documentation of reasons for patient initiating maintenance hemodialysis with a catheter as the mode of vascular access (G9239)|G9239',2),
('PQRS_0329', 'answer', '3|Patient whose mode of vascular access is not a catheter at the time maintenance hemodialysis is initiated (G9241)|G9241',9),

('PQRS_0330', 'description', 'Adult Kidney Disease: Catheter Use for Greater Than or Equal to 90 Days',''),
('PQRS_0330', 'question', 'Patients whose mode of vascular access is a catheter <br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions: Of note, the performance tags indicating ''Performance Met'' and ''Performance Not Met'' are included to highlight what is being measured and reported and not to encourage extended use of catheters for vascular access.<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0330', 'answer', '1|Patient receiving maintenance hemodialysis for greater than or equal to 90 days with a catheter as the mode of vascular access (G9265)|G9265',1),
('PQRS_0330', 'answer', '2|Documentation of patient receiving maintenance hemodialysis for greater than or equal to 90 days with a catheter for documented reasons (G9264)|G9264',2),
('PQRS_0330', 'answer', '3|Patient receiving maintenance hemodialysis for greater than or equal to 90 days without a catheter as the mode of vascular access (G9266)|G9266',9),

('PQRS_0331', 'description', 'Adult Sinusitis: Antibiotic Prescribed for Acute Viral Sinusitis (Overuse)',''),
('PQRS_0331', 'question', 'Was Patient prescribed any antibiotic within 10 days after onset of symptoms?<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0331', 'answer', '1|Antibiotic regimen prescribed within 10 days after onset of symptoms (G9286)|G9286',1),
('PQRS_0331', 'answer', '2|Antibiotic regimen prescribed within 10 days after onset of symptoms for documented medical reason (G9505)|G9505',2),
('PQRS_0331', 'answer', '3|Antibiotic regimen not prescribed within 10 days after onset of symptoms (G9287)|G9287',9),

('PQRS_0332', 'description', 'Adult Sinusitis: Appropriate Choice of Antibiotic: Amoxicillin With or Without Clavulanate Prescribed for Patients with Acute Bacterial Sinusitis (Appropriate Use)',''),
('PQRS_0332', 'question', 'Was Patient prescribed amoxicillin, with or without clavulanate, as a first line antibiotic at the time of diagnosis?',''),
('PQRS_0332', 'answer', '1|Amoxicillin, with or without clavulanate, prescribed as a first line antibiotic at the time of diagnosis (G9315)|G9315',1),
('PQRS_0332', 'answer', '2|Amoxicillin, with or without clavulanate, not prescribed as first line antibiotic at the time of diagnosis for documented reason (e.g., cystic fibrosis, immotile cilia disorders, ciliary dyskinesia, immune deficiency, prior history of sinus surgery within the past 12 months, anatomic abnormalities, such as deviated nasal septum, resistant organisms, allergy to medication, recurrent sinusitis, chronic sinusitis, or other reasons) (G9313)|G9313',2),
('PQRS_0332', 'answer', '3|Amoxicillin, with or without clavulanate, not prescribed as first line antibiotic at the time of diagnosis, reason not given (G9314)|G9314',9),

('PQRS_0333', 'description', 'Adult Sinusitis: Computerized Tomography (CT) for Acute Sinusitis (Overuse)',''),
('PQRS_0333', 'question', 'Patients who had a computerized tomography (CT) scan of the paranasal sinuses ordered at the time of diagnosis or received within 28 days after date of diagnosis<br>Numerator Instructions:<br>INVERSE MEASURE- A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0333', 'answer', '1|CT scan of the paranasal sinuses ordered at the time of diagnosis or received within 28 days after date of diagnosis (G9349)|G9349',1),
('PQRS_0333', 'answer', '2|CT scan of the paranasal sinuses ordered at the time of diagnosis for documented reasons (e.g., persons with sinusitis symptoms lasting at least 7 to 10 days, antibiotic resistance, immunocompromised, recurrent sinusitis, acute frontal sinusitis, acute sphenoid sinusitis, periorbital cellulitis, or other medical) (G9348)|G9348',2),
('PQRS_0333', 'answer', '3|CT scan of the paranasal sinuses not ordered at the time of diagnosis or received within 28 days after date of diagnosis (G9350)|G9350',9),

('PQRS_0334', 'description', 'Adult Sinusitis: More than One Computerized Tomography (CT) Scan Within 90 Days for Chronic Sinusitis (Overuse)',''),
('PQRS_0334', 'question', 'Patients who had more than one CT scan of the paranasal sinuses ordered or received within 90 days after date of diagnosis<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0334', 'answer', '1|More than one CT scan of the paranasal sinuses ordered or received within 90 days after the date of diagnosis, reason not given (G9352)|G9352',1),
('PQRS_0334', 'answer', '2|More than one CT scan of the paranasal sinuses ordered or received within 90 days after the date of diagnosis for documented reasons (e.g., patients with complications, second CT obtained prior to surgery, other medical reasons) (G9353)|G9353',2),
('PQRS_0334', 'answer', '3|One CT scan or no CT scan of the paranasal sinuses ordered within 90 days after the date of diagnosis (G9354)|G9354',9),

('PQRS_0335', 'description', 'Maternity Care: Elective Delivery or Early Induction Without Medical Indication at &ge; 37 and &lt; 39 Weeks (Overuse)',''),
('PQRS_0335', 'question', 'Patients who had elective deliveries or early inductions',''),
('PQRS_0335', 'answer', '1|Early elective delivery or early elective induction not performed (&ge; 37 and &lt; 39 weeks gestation) (G9355)|G9355',1),
('PQRS_0335', 'answer', '2|Medical indication for induction [Documentation of reason(s) for elective delivery or early induction (e.g., hemorrhage and placental complications, hypertension, preeclampsia and eclampsia, rupture of membranespremature or prolonged, maternal conditions complicating pregnancy/delivery, fetal conditions complicating pregnancy/delivery, malposition and malpresentation of fetus, late pregnancy, prior uterine surgery, or participation in clinical trial)] (G9361)|G9361',2),
('PQRS_0335', 'answer', '3|Early elective delivery or early elective induction performed (&ge; 37 and &lt; 39 weeks gestation) (G9356)|G9356',9),

('PQRS_0336', 'description', 'Maternity Care: Post-Partum Follow-Up and Care Coordination',''),
('PQRS_0336', 'question', 'Patients receiving the following at a post-partum visit:<li>Breast feeding evaluation and education, including patient-reported breast feeding<li>Post-partum depression screening<li>Post-partum glucose screening for gestational diabetes patients and<li>Family and contraceptive planning<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instruction: To satisfactorily meet the numerator ALL components (breast feeding evaluation and education, post-partum depression screening, family and contraceptive planning and post-partum glucose screening for patients with gestational diabetes) must be performed.',''),
('PQRS_0336', 'answer', '1|Post-partum screenings, evaluations and education performed (G9357)|G9357',1),
('PQRS_0336', 'answer', '2|Post-partum screenings, evaluations and education not performed (G9358)|G9358',9),

('PQRS_0337', 'description', 'Tuberculosis Prevention for Psoriasis,Psoriatic Arthritis and Rheumatoid Arthritis Patients on a Biological Immune Response Modifier',''),
('PQRS_0337', 'question', 'Does the patients have a documented negative annual TB screening or have documentation of the management of a positive TB screening test with no evidence of active tuberculosis, confirmed through use of radiographic imaging (i.e., chest x-ray, CT)?',''),
('PQRS_0337', 'answer', '1|Documentation of negative or managed positive TB screen with further evidence that TB is not active (G9359)|G9359',1),
('PQRS_0337', 'answer', '2|Documentation of patient reason for not having record of negative or managed positive TB screen (G9932)|G9932',2),
('PQRS_0337', 'answer', '3|No documentation of negative or managed positive TB screen (G9360)|G9360',9),

('PQRS_0338', 'description', 'HIV Viral Load Suppression',''),
('PQRS_0338', 'question', 'Number of patients with a HIV viral load less than 200 copies/mL at last viral load test',''),
('PQRS_0338', 'answer', '1|Documentation of viral load less than 200 copies/mL (G9243)|G9243',1),
('PQRS_0338', 'answer', '2|Documentation of viral load equal to or greater than 200 copies/mL or viral load not performed (G9242)|G9242',9),

('PQRS_0340', 'description', 'HIV Medical Visit Frequency',''),
('PQRS_0340', 'question', 'Number of patients who had at least one medical visit in each 6 month period of the 24 month measurement period, with a minimum of 60 days between medical visits',''),
('PQRS_0340', 'answer', '1|Patient had at least one medical visit in each 6 month period of the 24 month measurement period, with a minimum of 60 days between medical visits (G9247)|G9247',1),
('PQRS_0340', 'answer', '2|Patient did not have at least one medical visit in each 6 month period of the 24 month measurement period, with a minimum of 60 days between medical visits (G9246)|G9246',9),

('PQRS_0342', 'description', 'Pain Brought Under Control Within 48 Hours',''),
('PQRS_0342', 'question', 'Patients whose pain was brought to a comfortable level within 48 hours of initial assessment (after admission to palliative care services)<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Definitions:<br>Comfortable Level -- For the purpose of reporting this measure, achievement of comfort should be assessed as defined by the patient\'s response (of ''yes'' or ''no'' when asked if their pain was brought to a comfortable level within 48 hours after the initial assessment).<br>Within 48 Hours -- The look-back window for the pain management measure question is 48 hours. The follow up measure question should be asked between 48 to 72 hours from the initial evaluation. The follow up question should not be asked prior to 48 hours.',''),
('PQRS_0342', 'answer', '1|Documentation of patient pain brought to a comfortable level within 48 hours from initial assessment (G9250)|G9250',1),
('PQRS_0342', 'answer', '2|Documentation of patient with pain not brought to a comfortable level within 48 hours from initial assessment (G9251)|G9251',9),

('PQRS_0343', 'description', 'Screening Colonoscopy Adenoma Detection Rate',''),
('PQRS_0343', 'question', 'Did the patient age 50 years or older have a conventional adenoma or colorectal cancer detected during screening colonoscopy?',''),
('PQRS_0343', 'answer', '1|Adenoma(s) or colorectal cancer detected during screening colonoscopy (G9933)|G9933',1),
('PQRS_0343', 'answer', '2|Documentation that neoplasm detected is only diagnosed as traditional serrated adenoma, sessile serrated polyp, or sessile serrated adenoma (G9934)|G9934',2),
('PQRS_0343', 'answer', '3|Adenoma(s) or colorectal cancer not detected during screening colonoscopy (G9935)|G9935',9),

('PQRS_0344', 'description', 'Rate of Carotid Artery Stenting (CAS) for Asymptomatic Patients, Without Major Complications (Discharged to Home by Post-Operative Day #2)',''),
('PQRS_0344', 'question', 'Patients discharged to home no later than post-operative day 2 following CAS<br> Definition:<br>Home -- For purposes of reporting this measure, home is the point of origin prior to hospital admission prior to procedure. For example, if the patient comes from a skilled facility and returns to the skilled facility, this would meet criteria for discharged to home.',''),
('PQRS_0344', 'answer', '1|Documentation of patient discharged to home no later than post-operative day 2 following CAS (G9255)|G9255',1),
('PQRS_0344', 'answer', '2|Documentation of patient discharged to home later than post-operative day 2 following CAS (G9254)|G9254',9),

('PQRS_0345', 'description', 'Rate of Asymptomatic Patients Undergoing Carotid Artery Stenting (CAS) Who are Stroke Free or Discharged Alive',''),
('PQRS_0345', 'question', 'Is the patient stroke free or in the hospital or discharged alive following CAS?',''),
('PQRS_0345', 'answer', '1|Documentation of patient survival and absence of stroke following CAS (G9259)|G9259',1),
('PQRS_0345', 'answer', '2|Documentation of patient stroke following CAS (G9257)|G9257',9),
('PQRS_0345', 'answer', '3|Documentation of patient death following CAS (G9256)|G9256',9),

('PQRS_0346', 'description', 'Rate of Asymptomatic Patients Undergoing Carotid Endarterectomy (CEA) Who are Stroke Free or Discharged Alive',''),
('PQRS_0346', 'question', 'Was the patient stroke free or discharged alive following CEA?',''),
('PQRS_0346', 'answer', '1|Documentation of patient survival and absence of stroke following CEA (G9261)|G9261',1),
('PQRS_0346', 'answer', '2|Documentation of patient stroke following CEA (G9258)|G9258',9),
('PQRS_0346', 'answer', '3|Documentation of patient death  following CEA (G9260)|G9260',9),

('PQRS_0347', 'description', 'Rate of Endovascular Aneurysm Repair (EVAR) of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) Who are Discharged Alive',''),
('PQRS_0347', 'question', 'Was the patient discharged alive following endovascular AAA repair?',''),
('PQRS_0347', 'answer', '2|Documentation that patient discharged alive following endovascular AAA repair (G9263)|G9263',1),
('PQRS_0347', 'answer', '1|Documentation of patient death in the hospital following endovascular AAA repair (G9262)|G9262',9),

('PQRS_0348', 'description', 'HRS-3 Implantable Cardioverter-Defibrillator (ICD) Complications Rate',''),
('PQRS_0348', 'question', 'CRITERIA 1:  Did the patient experience one or more of the following complications or mortality within <b>30</b> days following ICD implantation? Death<br>2. Pneumothorax or hemothorax plus a chest tube<br>3. Hematoma plus a blood transfusion or evacuation<br>4. Cardiac tamponade or pericardiocentesis<br><center>OR</center><br>Number of patients with one or more of the following complications within 90 days (depending on the complication) following ICD implantation<br>Complications measured for 90 days:<br>1. Mechanical complications requiring a system revision<br>2. Device related infection<br>3. Additional ICD implantation.',''),
('PQRS_0348', 'answer', '1|Documentation of patient with one or more complications or mortality within 30 days (G9267)|G9267',1),
('PQRS_0348', 'answer', '2|Documentation of patient without one or more complications and without mortality within 30 days (G9269)|G9269',9),
('PQRS_0348', 'answer', '3|Documentation of patient with one or more complications within 90 days (G9268)|G9268',1),
('PQRS_0348', 'answer', '4|Documentation of patient without one or more complications within 90 days (G9270)|G9270',9),

('PQRS_0350', 'description', 'Total Knee Replacement: Shared Decision-Making: Trial of Conservative (Non-surgical) Therapy',''),
('PQRS_0350', 'question', 'Is there documentation of shared decision-making including discussion of conservative (non-surgical) therapy (e.g. NSAIDs, analgesics, weight loss, exercise, injections) prior to the procedure?',''),
('PQRS_0350', 'answer', '1|Documented shared decision-making including discussion of conservative (non-surgical) therapy (e.g., NSAIDs, analgesics, weight loss, exercise, injections) prior to the procedure (G9296)|G9296',1),
('PQRS_0350', 'answer', '2|Shared decision-making including discussion of conservative (non-surgical) therapy (e.g. NSAIDs, analgesics, weight loss, exercise, injections) prior to the procedure not documented, reason not given (G9297)|G9297',9),

('PQRS_0351', 'description', 'Total Knee Replacement: Venous Thromboembolic and Cardiovascular Risk Evaluation',''),
('PQRS_0351', 'question', 'Was the patient evaluated for the presence or absence of venous thromboembolic and cardiovascular risk factors within 30 days prior to the procedure (e.g., history of DVT, PE, MI, arrhythmia and stroke)?',''),
('PQRS_0351', 'answer', '1|Patients who are evaluated for venous thromboembolic and cardiovascular risk factors within 30 days prior to the procedure (e.g. history of DVT, PE, MI, arrhythmia and stroke) (G9298)|G9298',1),
('PQRS_0351', 'answer', '2|Patients who are not evaluated for venous thromboembolic and cardiovascular risk factors within 30 days prior to the procedure including (e.g. history of DVT, PE, MI, arrhythmia and stroke), reason not given (G9299)|G9299',9),

('PQRS_0352', 'description', 'Total Knee Replacement: Preoperative Antibiotic Infusion with Proximal Tourniquet',''),
('PQRS_0352', 'question', 'Patients who had the prophylactic antibiotic completely infused prior to the inflation of the proximal tourniquet (tourniquet around the proximal thigh)',''),
('PQRS_0352', 'answer', '1|Patients who had the prophylactic antibiotic completely infused prior to the inflation of the proximal tourniquet (G9301)|G9301',1),
('PQRS_0352', 'answer', '2|Documentation of medical reason(s) for not completely infusing the prophylactic antibiotic prior to the inflation of the proximal tourniquet (e.g., a tourniquet was not used) (G9300)|G9300',2),
('PQRS_0352', 'answer', '3|Prophylactic antibiotic not completely infused prior to the inflation of the proximal tourniquet, reason not given (G9302)|G9302',9),

('PQRS_0353', 'description', 'Total Knee Replacement: Identification of Implanted Prosthesis in Operative Report',''),
('PQRS_0353', 'question', 'Patients whose operative report identifies the prosthetic implant specifications including the prosthetic implant manufacturer, the brand name of the prosthetic implant and the size of each prosthetic implant ',''),
('PQRS_0353', 'answer', '1|Operative report identifies the prosthetic implant specifications (G9304)|G9304',1),
('PQRS_0353', 'answer', '2|Operative report does not identify the prosthetic implant specifications, reason not given (G9303)|G9303',9),

('PQRS_0354', 'description', 'Anastomotic Leak Intervention',''),
('PQRS_0354', 'question', 'Intervention (via return to operating room, interventional radiology, or interventional gastroenterology) for presence of leak of endoluminal contents (such as air, fluid, GI contents, or contrast material) through an anastomosis. The presence of an infection/abscess thought to be related to an anastomosis, even if the leak cannot be definitively identified as visualized during an operation, or by contrast extravasation would also be considered an anastomotic leak<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The <b>Performance Not Met</b> numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0354', 'answer', '1|Intervention for presence of leak of endoluminal contents through an anastomosis required (G9306)|G9306',1),
('PQRS_0354', 'answer', '2|Intervention for presence of leak of endoluminal contents through an anastomosis not required (G9305)|G9305',9),

('PQRS_0355', 'description', 'Unplanned Reoperation within the 30 Day Postoperative Period',''),
('PQRS_0355', 'question', 'Unplanned return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The <b>Performance Not Met</b> numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.<br>NUMERATOR NOTE: This measure is not intended to capture patients who go back to the operating room within 30 days for a follow-up procedure based on the pathology results from the principal operative procedure or concurrent procedure. Examples: Exclude breast biopsies with return for re-excisions; insertion of port-a-cath for chemotherapy. The return to the OR may occur at any hospital or surgical facility.',''),
('PQRS_0355', 'answer', '1|Unplanned return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure (G9308)|G9308',1),
('PQRS_0355', 'answer', '2|No return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure (G9307)|G9307',9),

('PQRS_0356', 'description', ' Unplanned Hospital Readmission within 30 Days of Principal Procedure',''),
('PQRS_0356', 'question', 'Inpatient readmission to the same hospital for any reason or an outside hospital (if known to the surgeon), within 30 days of the principal surgical procedure<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The <b>Performance Not Met</b> numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0356', 'answer', '1|Unplanned hospital readmission within 30 days of principal procedure (G9310)|G9310',1),
('PQRS_0356', 'answer', '2|No unplanned hospital readmission within 30 days of principal procedure (G9309)|G9309',9),

('PQRS_0357', 'description', 'Surgical Site Infection (SSI)',''),
('PQRS_0357', 'question', 'Number of patients with a surgical site infection<br><b>*** Please see Measure Documentation for extensive Definitions and Instructions ***</b><br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The <b>Performance Not Met</b> numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify. ',''),
('PQRS_0357', 'answer', '1|Surgical site infection (G9312)|G9312',1),
('PQRS_0357', 'answer', '2|No surgical site infection (G9311)|G9311',9),

('PQRS_0358', 'description', 'Patient-centered Surgical Risk Assessment and Communication',''),
('PQRS_0358', 'question', 'Documentation of empirical, personalized risk assessment based on the patient\'s risk factors with a validated risk calculator using multi-institutional clinical data, the specific risk calculator used, and communication of risk assessment from risk calculator with the patient and/or family<br><b> *** Please see Measure Documentation for discussion.</b>',''),
('PQRS_0358', 'answer', '1|Documentation of patient-specific risk assessment with a risk calculator based on multi-institutional clinical data, the specific risk calculator used, and communication of risk assessment from risk calculator with the patient or family (G9316)|G9316',1),
('PQRS_0358', 'answer', '2|Documentation of patient-specific risk assessment with a risk calculator based on multi-institutional clinical data, the specific risk calculator used, and communication of risk assessment from risk calculator with the patient or family not completed (G9317)|G9317',9),

('PQRS_0359', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Utilization of a Standardized Nomenclature for Computed Tomography (CT) Imaging Description',''),
('PQRS_0359', 'question', 'CT imaging reports with the imaging study named according to a standardized nomenclature and the standardized nomenclature is used in institution\'s computer systems<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0359', 'answer', '1|Imaging study named according to standardized nomenclature (G9318)|G9318',1),
('PQRS_0359', 'answer', '2|Imaging study not named according to standardized nomenclature, reason not given (G9319)|G9319',9),

('PQRS_0360', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Count of Potential High Dose Radiation Imaging Studies: Computed Tomography (CT) and Cardiac Nuclear Medicine Studies',''),
('PQRS_0360', 'question', 'CT and cardiac nuclear medicine (myocardial perfusion studies) imaging reports that document a count of known previous CT (any type of CT) and cardiac nuclear medicine (myocardial perfusion) studies that the patient has received in the 12-month period prior to the current study<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0360', 'answer', '1|Count of previous CT (any type of CT) and cardiac nuclear medicine (myocardial perfusion) studies documented in the 12-month period prior to the current study (G9321)|G9321',1),
('PQRS_0360', 'answer', '2|Count of previous CT and cardiac nuclear medicine (myocardial perfusion) studies not documented in the 12-month period prior to the current study, reason not given (G9322)|G9322',9),

('PQRS_0361', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Reporting to a Radiation Dose Index Registry',''),
('PQRS_0361', 'question', ' a CT studies performed that are reported to a radiation dose index registry that is capable of collecting at a minimum all of the following data elements:<br>*** Please see Measure Documentation for Definitions and Instructions ***<br><li>Manufacturer<li>Study description<li>Manufacturer`s model name<li>Patient\'s weight<li>Patient\'s size<li>Patient\'s sex<li>Patient\'s age<li>Exposure time<li>X-Ray tube current<li>Kilovoltage (kV)<li>Mean Volume Computed tomography dose index (CTDIvol)<li>Dose-length product (DLP)<br>Detailed information regarding the patient demographic and scanner data elements included in the Digital Imaging and Communication in Medicine (DICOM) header and CT irradiation event data elements included in the DICOM Supplement 127: CT Radiation Dose Reporting (Dose Structured Report) can be found in the Dose Index Registry Data Dictionary available on the American College of Radiology (ACR) Web site.',''),
('PQRS_0361', 'answer', '1|CT studies performed reported to a radiation dose index registry with all necessary data elements (G9327)|G9327',1),
('PQRS_0361', 'answer', '2|CT studies performed not reported to a radiation dose index registry, reason not given (G9326)|G9326',9),

('PQRS_0362', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Computed Tomography (CT) Images Available for Patient Follow-up and Comparison Purposes',''),
('PQRS_0362', 'question', 'Final reports for CT studies which document that DICOM format image data are available to non-affiliated external healthcare facilities or entities on a secure, media-free, reciprocally searchable basis with patient authorization for at least a 12-month period after the study<br> Definition:<br>Media-free - Radiology images that are transmitted electronically ONLY, not images recorded on film, CD, or other imaging transmittal form.',''),
('PQRS_0362', 'answer', '1|Final report documented that DICOM format image data available to non-affiliated external healthcare facilities or entities on a secure, media free, reciprocally searchable basis with patient authorization for at least a 12-month period after the study (G9340)|G9340',1),
('PQRS_0362', 'answer', '2|DICOM format image data available to non-affiliated external healthcare facilities or entities on a secure, media free, reciprocally searchable basis with patient authorization for at least a 12-month period after the study not documented in final report, reason not given (G9329)|G9329',9),

('PQRS_0363', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Search for Prior Computed Tomography (CT) Studies Through a Secure, Authorized, Media-Free, Shared Archive',''),
('PQRS_0363', 'question', 'Final reports of CT studies, which document that a search for DICOM format images was conducted for prior patient CT imaging studies completed at non-affiliated external healthcare facilities or entities within the past 12-months and are available through a secure, authorized, media-free, shared archive prior to an imaging study being performed <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0363', 'answer', '1|Search conducted for prior patient CT studies (G9341)|G9341',1),
('PQRS_0363', 'answer', '2|Due to system reasons search not conducted for DICOM format images for prior patient CT imaging studies (e.g., non-affiliated external healthcare facilities or entities does not have archival abilities through a shared archival system) (G9344)|G9344',2),
('PQRS_0363', 'answer', '3|Documentation of medical reason for not conducting a search for DICOM format images for prior patient CT imaging studies completed at non-affiliated external healthcare facilities or entities within the past 12 months that are available through a secure, authorized, media-free, shared archive (e.g., trauma, acute myocardial infarction, stroke, aortic aneurysm where time is of the essence)(G9753)|G9753',2),
('PQRS_0363', 'answer', '4|Search not conducted prior to an imaging study being performed, reason not given (G9342)|G9342',9),

('PQRS_0364', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Appropriateness: Follow-up CT Imaging for Incidentally Detected Pulmonary Nodules According to Recommended Guidelines',''),
('PQRS_0364', 'question', 'Final reports with documented follow-up recommendations for incidentally detected pulmonary nodules (e.g., follow-up CT imaging studies needed or that no follow-up is needed) based at a minimum on nodule size AND patient risk factors<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0364', 'answer', '1|Follow-up recommendations documented according to recommended guidelines for incidentally detected pulmonary nodules (e.g., follow-up CT imaging studies needed or that no follow-up is needed) based at a minimum on nodule size AND patient risk factors (G9345)|G9345',1),
('PQRS_0364', 'answer', '2|Documentation of medical reason(s) that follow-up imaging is indicated (e.g., patient has a known malignancy that can metastasize, other medical reason(s)(G9755) |G9755',2),
('PQRS_0364', 'answer', '3|Follow-up recommendations not documented according to recommended guidelines for incidentally detected pulmonary nodules, reason not given (G9347)|G9347',9),

('PQRS_0370', 'description', 'Depression Remission at Twelve Months',''),
('PQRS_0370', 'question', 'Adults who achieved remission at twelve months as demonstrated by a twelve month (+/- 30 days) PHQ-9 score of less than five<br>Definitions:<br>Remission - a PHQ-9 score of less than five.<br>Twelve Months - the point in time from the index date extending out twelve months (+/- 30 days). The most recent PHQ-9 score within twelve months +/- 30 days (11 to 13 months after index) that is less than five is deemed as remission at twelve months. Scores obtained prior to or after this period are not counted as numerator compliant (remission).',''),
('PQRS_0370', 'answer', '1|Remission at twelve months as demonstrated by a twelve month (+/-30 days) PHQ-9 score of less than 5 (G9509)|G9509',1),
('PQRS_0370', 'answer', '2|Remission at twelve months not demonstrated by a twelve month (+/-30 days) PHQ-9 score of less than five. Either PHQ-9 score was not assessed or is greater than or equal to 5 (G9510)|G9510',9),

('PQRS_0383', 'description', 'Adherence to Antipsychotic Medications For Individuals with Schizophrenia',''),
('PQRS_0383', 'question', 'Individuals in the denominator who have a Proportion of Days Covered (PDC) of at least 0.8 for antipsychotic medications <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0383', 'answer', '1|Individual had a PDC of 0.8 or greater (G9512)|G9512',1),
('PQRS_0383', 'answer', '2|Individual did not have a PDC of 0.8 or greater (G9513)|G9513',9),

('PQRS_0384', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: No Return to the Operating Room Within 90 Days of Surgery',''),
('PQRS_0384', 'question', 'Patients who did not return to the operating room within 90 days for complications within the operative eye',''),
('PQRS_0384', 'answer', '1|Patient did not require a return to the operating room within 90 days of surgery (G9515)|G9515',1),
('PQRS_0384', 'answer', '2|Patient required a return to the operating room within 90 days of surgery (G9514)|G9514',9),

('PQRS_0385', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: Visual Acuity Improvement Within 90 Days of Surgery',''),
('PQRS_0385', 'question', 'Patients who achieved an improvement in their visual acuity, from their preoperative level, within 90 days of surgery in the operative eye',''),
('PQRS_0385', 'answer', '1|Patient achieved an improvement in visual acuity, from their preoperative level, within 90 days of surgery (G9516)|G9516',1),
('PQRS_0385', 'answer', '2|Patient did not achieve an improvement in visual acuity, from their preoperative level, within 90 days of surgery, reason not given (G9517)|G9517',9),

('PQRS_0386', 'description', 'Amyotrophic Lateral Sclerosis (ALS) Patient Care Preferences',''),
('PQRS_0386', 'question', ' Were patients offered assistance in planning for end of life issues (e.g., advance directives, invasive ventilation, or hospice) at least once annually?',''),
('PQRS_0386', 'answer', '1|Patient offered assistance with end of life issues during the measurement period (G9380)|G9380',1),
('PQRS_0386', 'answer', '3|Patient not offered assistance with end of life issues during the measurement period (G9382)|G9382',9),

('PQRS_0387', 'description', 'Annual Hepatitis C Virus (HCV) Screening for Patients who are Active Injection Drug Users',''),
('PQRS_0387', 'question', 'Patients who received screening for HCV infection within the 12 month reporting period<br>Definition:<br>Screening for HCV infection -- includes HCV antibody test or HCV RNA test',''),
('PQRS_0387', 'answer', '1| Patient received screening for HCV infection within the 12 month reporting period (G9383)|G9383',1),
('PQRS_0387', 'answer', '2|Documentation of medical reason(s) for not receiving annual screening for HCV infection (e.g., decompensated cirrhosis indicating advanced disease [i.e., ascites, esophageal variceal bleeding, hepatic encephalopathy], hepatocellular carcinoma, waitlist for organ transplant, limited life expectancy, other medical reasons) (G9384)|G9384',2),
('PQRS_0387', 'answer', '3|Documentation of patient reason(s) for not receiving annual screening for HCV infection (e.g., patient declined, other patient reasons) (G9385)|G9385',2),
('PQRS_0387', 'answer', '4|Screening for HCV infection not received within the 12 month reporting period, reason not given (G9386)|G9386',9),

('PQRS_0388', 'description', 'Cataract Surgery with Intra-Operative Complications (Unplanned Rupture of Posterior Capsule Requiring Unplanned Vitrectomy',''),
('PQRS_0388', 'question', 'Patients who experienced an unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0388', 'answer', '1|Unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery (G9389)|G9389',1),
('PQRS_0388', 'answer', '2|No unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery (G9390)|G9389',9),

('PQRS_0389', 'description', 'Cataract Surgery: Difference Between Planned and Final Refraction',''),
('PQRS_0389', 'question', 'Patients who achieved a final refraction (spherical equivalent) +/- 1.0 diopters of their planned (target) refraction (spherical equivalent) within 90 days following cataract surgery. The refraction planned and final refraction values should correspond to the eye that underwent the cataract procedure',''),
('PQRS_0389', 'answer', '1|Patient achieves final refraction (spherical equivalent) +/- 1.0 Diopters of their planned refraction within 90 days of surgery (G9519)|G9519',1),
('PQRS_0389', 'answer', '2|Patient does not achieve final refraction (spherical equivalent) +/- 1.0 Diopters of their planned refraction within 90 days of surgery (G9520)|G9520',9),

('PQRS_0390', 'description', 'Hepatitis C: Discussion and Shared Decision Making Surrounding Treatment Options',''),
('PQRS_0390', 'question', 'Patients with whom a physician or other qualified healthcare professional reviewed the range of treatment options appropriate to their genotype and demonstrated a shared decision making approach with the patient',''),
('PQRS_0390', 'answer', '1|Documentation in the patient record of a discussion between the physician/clinician and the patient that includes all of the following: treatment choices appropriate to genotype, risks and benefits, evidence of effectiveness, and patient preferences toward the outcome of the treatment (G9399)|G9399',1),
('PQRS_0390', 'answer', '2|Documentation of medical or patient reason(s) for not discussing treatment options. Medical reasons: Patient is not a candidate for treatment due to advanced physical or mental health comorbidity (including active substance use); currently receiving antiviral treatment; successful antiviral treatment (with sustained virologic response) prior to reporting period; other documented medical reasons. Patient reasons: Patient unable or unwilling to participate in the discussion or other patient reasons (G9400)|G9400',2),
('PQRS_0390', 'answer', '3|No documentation of a discussion in the patient record of a discussion between the physician or other qualified healthcare professional and the patient that includes all of the following: treatment choices appropriate to genotype, risks and benefits, evidence of effectiveness, and patient preferences toward treatment (G9401)|G9401',9),

('PQRS_0391', 'description', 'Follow-Up After Hospitalization for Mental Illness (FUH)',''),
('PQRS_0391', 'question', 'NUMERATOR (REPORTING CRITERIA 1): <br>Patient Received Follow-Up within 30 Days from Discharge<br>An outpatient visit, intensive outpatient visit or partial hospitalization with a mental health practitioner within 30 days after acute inpatient discharge. Include outpatient visits, intensive outpatient visits or partial hospitalizations that occur on the date of discharge.<br><center><b>OR</b></center><br>NUMERATOR (REPORTING CRITERIA 2):<br>Patient Received Follow-Up within 7 Days from Discharge<br>An outpatient visit, intensive outpatient visit or partial hospitalization with a mental health practitioner within 7 days after acute inpatient discharge. Include outpatient visits, intensive outpatient visits or partial hospitalizations that occur on the date of discharge.  <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0391', 'answer', '1|Patient received follow-up on the date of discharge or within 30 days after discharge (G9402)|G9402',1),
('PQRS_0391', 'answer', '2|Clinician documented reason patient was not able to complete 30 day follow-up from acute inpatient setting discharge (e.g., patient death prior to follow-up visit, patient non-compliant for visit follow-up) (G9403)|G9403',2),
('PQRS_0391', 'answer', '3|Patient did not receive follow-up on the date of discharge or within 30 days after discharge (G9404)|G9404',9),
('PQRS_0391', 'answer', '4|Patient received follow-up within 7 days from discharge (G9405)|G9405',1),
('PQRS_0391', 'answer', '5|Clinician documented reason patient was not able to complete 7 day follow-up from acute inpatient setting discharge (i.e., patient death prior to follow-up visit, patient non-compliance for visit follow-up) (G9406)|G9406',2),
('PQRS_0391', 'answer', '6|Patient did not receive follow-up on or within 7 days after discharge (G9407)|G9407',9),

('PQRS_0392', 'description', 'HRS-12: Cardiac Tamponade and/or Pericardiocentesis Following Atrial Fibrillation Ablation <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0392', 'question', 'The number of patients from the denominator with cardiac tamponade and/or pericardiocentesis occurring within 30days following atrial fibrillation ablation <br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0392', 'answer', '1|Patients with cardiac tamponade and/or pericardiocentesis occurring within 30 days (G9408)|G9408',1),
('PQRS_0392', 'answer', '2|Patients without cardiac tamponade and/or pericardiocentesis occurring within 30 days (G9409)|G9409',9),

('PQRS_0393', 'description', 'HRS-9: Infection within 180 Days of Cardiac Implantable Electronic Device (CIED) Implantation, Replacement, or Revision <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0393', 'question', 'The number of patients from the denominator admitted with an infection requiring device removal or surgical revision within 180 days following CIED implantation, replacement, or revision.  <br>*** Please see Measure Documentation for Definitions and Instructions ***<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0393', 'answer', '1|Patient with a new CIED admitted within 180 days, status post CIED implantation with an infection requiring device removal or surgical revision (G9410)|G9410',1),
('PQRS_0393', 'answer', '2|Patient with a new CIED not admitted within 180 days, status post CIED implantation with an infection requiring device removal or surgical revision (G9411)|G9411',9),
('PQRS_0393', 'answer', '3|Patient with replacement or revision of a CIED admitted within 180 days, status post CIED replacement, or revision with an infection requiring device removal or surgical revision (G9412)|G9412',1),
('PQRS_0393', 'answer', '4|Patient with replacement or revision of a CIED not admitted within 180 days, status post CIED replacement, or revision with an infection requiring device removal or surgical revision (G9413)|G9413',9),

('PQRS_0394', 'description', 'Immunizations for Adolescents.  NOT A RECOMMENDED MEASURE',''),
('PQRS_0394', 'question', 'Adolescents who had one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays<br><center>ALSO</center><br>Adolescents who had one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays<br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0394', 'answer', '1|Patient had one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9414) *AND* Patient had one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9416) (G9414 G9416)|G9414 G9416',1),
('PQRS_0394', 'answer', '2|Patient had one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9414) *AND* Patient did not have one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9417) (G9414 G9417)|G9414 G9417',9),
('PQRS_0394', 'answer', '3|Patient did not have one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9415) *AND* Patient had one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9416) (G9415 G9416)|G9415 G9416',1),
('PQRS_0394', 'answer', '4|Patient did not have one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9415) *AND* Patient did not have one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9417) (G9415 G9417)|G9415 G9417',9),

('PQRS_0395', 'description', 'Lung Cancer Reporting (Biopsy/Cytology Specimens)',''),
('PQRS_0395', 'question', 'Biopsy and cytology specimen reports with a diagnosis of primary non-small cell lung cancer classified into specific histologic type (squamous cell carcinoma, adenocarcinoma) OR classified as NSCLC-NOS with an explanation included in the pathology report',''),
('PQRS_0395', 'answer', '1|Primary non-small cell lung cancer biopsy and cytology specimen report documents classification into specific histologic type OR classified as NSCLC-NOS with an explanation (G9418)|G9418',1),
('PQRS_0395', 'answer', '2|Documentation of medical reason(s) for not including the histological type OR NSCLC-NOS classification with an explanation (e.g., biopsy taken for other purposes in a patient with a history of primary non-small cell lung cancer or other documented medical reasons) (G9419)|G9419',2),
('PQRS_0395', 'answer', '3|Primary non-small cell lung cancer biopsy and cytology specimen report does not document classification into specific histologic type OR classified as NSCLC-NOS with an explanation (G9421)|G9421',9),

('PQRS_0396', 'description', 'Lung Cancer Reporting (Resection Specimens)',''),
('PQRS_0396', 'question', ' Pathology reports based on resection specimens with a diagnosis of primary lung carcinoma that include the pT category, pN category and for non-small cell lung cancer, histologic type (squamous cell carcinoma, adenocarcinoma and NOT NSCLC-NOS)',''),
('PQRS_0396', 'answer', '1|Primary Lung Carcinoma that Include the pT category, pN category and for Non-Small Cell Lung Cancer, Histologic Type (Squamous Cell Carcinoma, Adenocarcinoma and NOT NSCLC-NOS) (G9422)|G9422',1),
('PQRS_0396', 'answer', '2|Primary Lung Carcinoma that Include the pT category, pN category and for Non Small Cell Lung Cancer, Histologic Type (Squamous Cell Carcinoma, Adenocarcinoma) not Documented for Documented Medical Reasons (G9423)|G9423',2),
('PQRS_0396', 'answer', '3|Primary Lung Carcinoma that Include the pT category, pN category and for Non-Small Cell Lung Cancer, Histologic Type (Squamous Cell Carcinoma, Adenocarcinoma) not Documented, Reason not Given (G9425)|G9425',9),

('PQRS_0397', 'description', 'Melanoma Reporting',''),
('PQRS_0397', 'question', 'Pathology reports for primary malignant cutaneous melanoma that include the pT category and a statement on thickness and ulceration and for pT1, mitotic rate',''),
('PQRS_0397', 'answer', '1|Pathology Reports that Include the pT Category and a Statement on Thickness and Ulceration and for pT1, mitotic rate (G9428)|G9428',1),
('PQRS_0397', 'answer', '2|Documentation of medical reason(s) for not including pT Category and a statement on thickness and ulceration and for pT1, mitotic rate (e.g., negative skin biopsies in a patient with a history of melanoma or other documented medical reasons) (G9429)|G9429',2),
('PQRS_0397', 'answer', '3|Pathology report does not include the pT Category and a statement on thickness and ulceration and for pT1, mitotic rate (G9431)|G9431',9),

('PQRS_0398', 'description', 'Optimal Asthma Control.  NOT A RECOMMENDED MEASURE',''),
('PQRS_0398', 'question', 'Asthma well-controlled (take the most recent asthma control tool available during the measurement period)<br><li>Asthma Control TestTM (ACT) score of 20 or above - ages 12 and older<li>Childhood Asthma Control Test (C-ACT) score of 20 or above - ages 11 and younger<li>Asthma Control Questionnaire (ACQ) score of 0.75 or lower - ages 17 and older<li>Asthma Therapy Assessment Questionnaire (ATAQ) score of 0 -- Pediatric (ages 5 -- 17) or Adult (ages 18 and older)<br><center>AND</center><br>Patient not at elevated risk of exacerbation -- less than two<li>Emergency department visits not resulting in a hospitalization due to asthma in last 12 months<li>Inpatient hospitalizations requiring an overnight stay due to asthma in last 12 months.',''),
('PQRS_0398', 'answer', '1|Asthma well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score and results documented (G9432) *AND* Total number of emergency department visits and inpatient hospitalizations less than two in the past 12 months (G9521) (G9432 G9521)|G9432 G9521',1),
('PQRS_0398', 'answer', '2|Asthma not well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score, OR specified asthma control tool not used, reason not given (G9434) *AND* Total number of emergency department visits and inpatient hospitalizations less than two in the past 12 months (G9521) (G9434 G9521)|G9434 G9521',1),
('PQRS_0398', 'answer', '3|Asthma well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score and results documented (G9432) *AND* Total number of emergency department visits and inpatient hospitalizations equal to or greater than two in the past 12 months OR patient not screened, reason not given (G9522) (G9432 G9522)|G9432 G9522',1),
('PQRS_0398', 'answer', '4|Asthma not well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score, OR specified asthma control tool not used, reason not given (G9434) *AND* Total number of emergency department visits and inpatient hospitalizations equal to or greater than two in the past 12 months OR patient not screened, reason not given (G9522) (G9434 G9522)|G9434 G9522',9),


('PQRS_0400', 'description', 'One-Time Screening for Hepatitis C Virus (HCV) for Patients at Risk',''),
('PQRS_0400', 'question', 'Patients who received one-time screening for HCV infection<br>Definition:<br>Screening for HCV Infection includes current or prior receipt of:<br>1. HCV antibody test<br>2. HCV RNA test<br>3. Recombinant immunoblot assay (RIBA) test (if performed at any time in the past)',''),
('PQRS_0400', 'answer', '1|Patient received one-time screening for HCV infection (G9451)|G9451',1),
('PQRS_0400', 'answer', '2|Documentation of medical reason(s) for not receiving one-time screening for HCV infection (e.g., decompensated cirrhosis indicating advanced disease [ie, ascites, esophageal variceal bleeding, hepatic encephalopathy], hepatocellular carcinoma, waitlist for organ transplant, limited life expectancy, other medical reasons) (G9452)|G9452',2),
('PQRS_0400', 'answer', '3|Documentation of patient reason(s) for not receiving one-time screening for HCV infection (e.g., patient declined, other patient reasons) (G9453)|G9453',2),
('PQRS_0400', 'answer', '4|One-time screening for HCV infection not received within 12 month reporting period and no documentation of prior screening for HCV infection, reason not given (G9454)|G9454',9),

('PQRS_0401', 'description', 'Hepatitis C: Screening for Hepatocellular Carcinoma (HCC) in Patients with Cirrhosis',''),
('PQRS_0401', 'question', 'Patients who underwent abdominal imaging with either ultrasound, contrast enhanced CT or MRI',''),
('PQRS_0401', 'answer', '1|Patient underwent abdominal imaging with ultrasound, contrast enhanced CT or contrast MRI for HCC (G9455)|G9455',1),
('PQRS_0401', 'answer', '2|Documentation of medical or patient reason(s) for not ordering or performing screening for HCC. Medical reason: Comorbid medical conditions with expected survival <5 years, hepatic decompensation and not a candidate for liver transplantation, or other medical reasons. Patient reasons: Patient declined or other patient reasons (e.g., cost of tests, time related to accessing testing equipment) (G9456)|G9456',2),
('PQRS_0401', 'answer', '3|Patient did not undergo abdominal imaging and did not have a documented reason for not undergoing abdominal imaging in the reporting period (G9457)|G9457',9),

('PQRS_0402', 'description', 'Tobacco Use and Help with Quitting Among Adolescents',''),
('PQRS_0402', 'question', 'Patients who were screened for tobacco use at least once within 18 months (during the measurement period or the six months prior to the measurement period) AND who received tobacco cessation counseling intervention if identified as a tobacco user<br>Definitions:<br>Tobacco Use Status -- Any documentation of smoking or tobacco use status, including ''never'' or ''non-use''br>Tobacco User -- Any documentation of active or current use of tobacco products, including smoking.',''),
('PQRS_0402', 'answer', '1|Patient documented as tobacco user AND received tobacco cessation intervention (must include at least one of the following: advice given to quit smoking or tobacco use, counseling on the benefits of quitting smoking or tobacco use, assistance with or referral to external smoking or tobacco cessation support programs, or current enrollment in smoking or tobacco use cessation program) if identified as a tobacco user (G9458)|G9458',1),
('PQRS_0402', 'answer', '2|Currently a tobacco non-user (G9459)|G9459',2),
('PQRS_0402', 'answer', '3|Tobacco assessment OR tobacco cessation intervention not performed, reason not given (G9460)|G9460',9),

('PQRS_0403', 'description', 'Adult Kidney Disease: Referral to Hospice',''),
('PQRS_0403', 'question', 'Patients who are referred to hospice care',''),
('PQRS_0403', 'answer', '1|Patient was referred to hospice care (G9524)',1),
('PQRS_0403', 'answer', '2|Documentation of patient reason(s) for not referring to hospice care (e.g., patient declined, other patient reasons) (G9525)|G9525',2),
('PQRS_0403', 'answer', '3|Patient was not referred to hospice care, reason not given (G9526)|G9526',9),

('PQRS_0404', 'description', 'Anesthesiology Smoking Abstinence',''),
('PQRS_0404', 'question', 'Current cigarette smokers and who abstained from smoking prior to anesthesia on the day of surgery or procedure.<br>Definition:<br>Abstinence - Defined by either patient self-report or an exhaled carbon monoxide level of &lt; 10 ppm.',''),
('PQRS_0404', 'answer', '1|Patients who abstained from smoking prior to anesthesia on the day of surgery or procedure (G9644)|G9644',1),
('PQRS_0404', 'answer', '2|Patients who did not abstain from smoking prior to anesthesia on the day of surgery or procedure (G9645)|G9645',9),

('PQRS_0405', 'description', 'Appropriate Follow-up Imaging for Incidental Abdominal Lesions.  NOT A RECOMMENDED MEASURE',''),
('PQRS_0405', 'question', 'Final reports for abdominal imaging studies with follow-up imaging recommended <br>Numerator Instructions: <br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0405', 'answer', '1|Final reports for abdominal imaging studies with followup imaging recommended (G9548)|G9548',1),
('PQRS_0405', 'answer', '2|Documentation of medical reason(s) that follow-up imaging is indicated e.g., patient has a known malignancy that can metastasize, other medical reason(s) (G9549)|G9549',2),
('PQRS_0405', 'answer', '3|Final reports for abdominal imaging studies with followup imaging not recommended (G9550)|G9550',9),

('PQRS_0406', 'description', 'Appropriate Follow-up Imaging for Incidental Thyroid Nodules in Patients',''),
('PQRS_0406', 'question', 'Final reports for CT or MRI of the chest or neck or ultrasound of the neck with follow-up imaging recommended for reports with a thyroid nodule &lt; 1.0 cm noted<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0406', 'answer', '1|Final reports for CT or MRI of the chest or neck or ultrasound of the neck with follow-up imaging recommended (G9554)|G9554',1),
('PQRS_0406', 'answer', '2|Documentation of medical reason(s) for not including documentation that follow up imaging is not needed (e.g., patient has multiple endocrine neoplasia, patient has cervical lymphadenopathy, other medical reason(s)) (G9555)|G9555',2),
('PQRS_0406', 'answer', '3|Final reports for CT or MRI of the chest or neck or ultrasound of the neck with follow-up imaging not recommended (G9556)|G9556',9),

('PQRS_0407', 'description', 'Appropriate Treatment of MSSA Bacteremia',''),
('PQRS_0407', 'question', 'Number of denominator eligible patients treated with a beta-lactam antibiotic (e.g. nafcillin, oxacillin or cefazolin) as definitive therapy<br>Definition:<br>Beta-Lactam -- For the purposes of this measure, a beta-lactam antibiotic is defined as Nafcillin, Oxacillin or Cefazolin.',''),
('PQRS_0407', 'answer', '1|Patient treated with a beta-lactam antibiotic as definitive therapy (G9558)|G9558',1),
('PQRS_0407', 'answer', '2| Documentation of medical reason(s) for not prescribing a Beta-lactam antibiotic (e.g., allergy, intolerance to beta-lactam antibiotics) (G9559)|G9559',2),
('PQRS_0407', 'answer', '3|Patient not treated with a beta-lactam antibiotic as definitive therapy, reason not given (G9560)|G9560',9),

('PQRS_0408', 'description', 'Opioid Therapy Follow-up Evaluation',''),
('PQRS_0408', 'question', 'Patients who had a follow-up evaluation conducted at least every three months during opioid therapy',''),
('PQRS_0408', 'answer', '1|Patients who had a follow-up evaluation conducted at least every three months during opioid therapy (G9562)|G9562',1),
('PQRS_0408', 'answer', '2|Patients who did not have a follow-up evaluation conducted at least every three months during opioid therapy (G9563)|G9563',9),

('PQRS_0409', 'description', 'Clinical Outcome Post Endovascular Stroke Treatment',''),
('PQRS_0409', 'question', 'Patients with a mRS of 0 to 2 at 90 days<br>Definition:<br>The Modified Rankin Scale (mRS) The scale runs from 0-6, running from perfect health without symptoms to death.<br>0 - No symptoms.<br>1 - No significant disability. Able to carry out all usual activities, despite some symptoms.<br>2 - Slight disability. Able to look after own affairs without assistance, but unable to carry out all previous activities.<br>3 - Moderate disability. Requires some help, but able to walk unassisted.<br>4 - Moderately severe disability. Unable to attend to own bodily needs without assistance, and unable to walk unassisted.<br>5 - Severe disability. Requires constant nursing care and attention, bedridden, incontinent.<br>6 - Dead.',''),
('PQRS_0409', 'answer', '1|Patients with 90 day mRS score of 0 to 2 (G9646)|G9646',1),
('PQRS_0409', 'answer', '2|Patients in whom mRS score could not be obtained at 90 day follow-up (G9647)|G9647',2),
('PQRS_0409', 'answer', '3|Patients with 90 day mRS score greater than 2 (G9648)|G9648',9),

('PQRS_0410', 'description', 'Psoriasis: Clinical Response to Oral Systemic or Biologic Medications',''),
('PQRS_0410', 'question', 'Did patient with psoriasis vulgaris have a documented physician global assessment (PGA: 6-point scale), body surface area (BSA), psoriasis area and severity index (PASI) and/or dermatology life quality index (DLQI) that meet any ONE of the following benchmarks:<li>PGA (6-point scale) -- 2 (clear to mild skin disease)<li>BSA < 3% (mild disease)<li>PASI < 3 (no or minimal disease)<li>DLQI < 5 (no effect or small effect on patient\'s quality of life)',''),
('PQRS_0410', 'answer', '1|Psoriasis assessment tool documented meeting any one of the specified benchmarks (G9649)|G9649',1),
('PQRS_0410', 'answer', '2|Documentation that the patient declined therapy change or alternative therapies are unavailable, has documented contraindications or has not been treated with an oral or systemic biologic in at least 6 consecutive months in order to achieve better disease control as measured by PGA, BSA, PASI, or DLQI (G9765)|G9765',2),
('PQRS_0410', 'answer', '3|Psoriasis assessment tool documented not meeting any one of the specified benchmarks or psoriasis assessment tool not documented (G9651)|G9651',9),

('PQRS_0411', 'description', 'Depression Remission at Six Months',''),
('PQRS_0411', 'question', 'Adults who achieved remission at six months as demonstrated by a six month (+/- 30 days) PHQ-9 score of less than five<br>Definitions:<br>Remission - a PHQ-9 score less than five.<br>Six Months - the point in time from the index date extending out six months (+/- 30 days). The most recent PHQ-9 score within six months +/- 30 days (5 to 7 months after index) that is less than five is deemed as remission at 6 months. Scores obtained prior to or after this period are not counted as numerator compliant (remission).',''),
('PQRS_0411', 'answer', '1|Remission at six months as demonstrated by a six month (+/-30 days) PHQ-9 score of less than five (G9573)|G9573',1),
('PQRS_0411', 'answer', '2|Remission at six months not demonstrated by a six month (+/-30 days) PHQ-9 score of less than five. Either PHQ-9 score was not assessed or is greater than or equal to five. (G9574)|G9574',9),

('PQRS_0412', 'description', 'Documentation of Signed Opioid Treatment Agreement',''),
('PQRS_0412', 'question', 'Patients who signed an opioid treatment agreement at least once during opioid therapy',''),
('PQRS_0412', 'answer', '1|Documentation of signed opioid treatment agreement at least once during opioid therapy (G9578)|G9578',1),
('PQRS_0412', 'answer', '2| No documentation of signed an opioid treatment agreement at least once during opioid therapy (G9579)|G9579',9),

('PQRS_0413', 'description', 'Door to Puncture Time for Endovascular Stroke Treatment',''),
('PQRS_0413', 'question', 'Patients with CVA undergoing endovascular stroke treatment who have a door to puncture time of less than 2 hours',''),
('PQRS_0413', 'answer', '1|Door to puncture time of less than 2 hours (G9580)|G9580',1),
('PQRS_0413', 'answer', '2|Door to puncture time of greater than 2 hours, no reason given (G9582)|G9582',9),

('PQRS_0414', 'description', 'Evaluation or Interview for Risk of Opioid Misuse ',''),
('PQRS_0414', 'question', 'Patients evaluated for risk of misuse of opiates by using a brief validated instrument (e.g., Opioid Risk Tool, SOAAPR) or patient interview at least once during opioid therapy',''),
('PQRS_0414', 'answer', '1|Patient evaluated for risk of misuse of opiates by using a brief validated instrument (e.g., Opioid Risk Tool, SOAAP-R) or patient interviewed at least once during opioid therapy (G9584)|G9584',1),
('PQRS_0414', 'answer', '2|Patient not evaluated for risk of misuse of opiates by using a brief validated instrument (e.g., Opioid Risk Tool, SOAAP-R) or patient not interviewed at least once during opioid therapy (G9585)|G9585',9),

('PQRS_0415', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 18 Years and Older',''),
('PQRS_0415', 'question', 'Emergency department visits for patients who have an indication for a head CT <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0415', 'answer', '1|Patient with minor blunt head trauma had an appropriate indication(s) for a head CT (G9529)|G9529',1),
('PQRS_0415', 'answer', '2|Patient with minor blunt head trauma did not have an appropriate indication(s) for a head CT (G9533)|G9533',9),

('PQRS_0416', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 2 through 17 Years',''),
('PQRS_0416', 'question', 'Emergency department visits for patients who are classified as low risk according to the Pediatric Emergency Care Applied Research Network (PECARN) prediction rules for traumatic brain injury<br>*** Please see Measure Documentation for Definitions and Instructions ***<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify. ',''),
('PQRS_0416', 'answer', '1|Pediatric patient with minor blunt head trauma classified as low risk according to the PECARN prediction rules (G9593)|G9593',1),
('PQRS_0416', 'answer', '2|Pediatric patient with minor blunt head trauma not classified as low risk according to the PECARN prediction rules (G9597)|G9597',9),

('PQRS_0417', 'description', 'Rate of Open Repair of Abdominal Aortic Aneurysms (AAA) Where Patients Are Discharged Alive',''),
('PQRS_0417', 'question', 'Patients discharged alive/home following open repair of asymptomatic AAAs in men with &lt; 6 cm diameter and women with &lt; 5.5 cm diameter AAAs<br>Numerator Instructions: A higher calculated performance rate for this measure indicates better clinical care or control. Therefore the ''Performance Met'' numerator outcome option for this measure is the representation of the better clinical quality or control. Reporting that numerator outcome option will produce a performance rate that trends closer to 100% zero, as quality increases.<br>Definition:<br>Home -- For purposes of reporting this measure, home is the point of origin prior to hospital admission prior to procedure of AAA. For example, if the patient comes from a skilled facility and returns to the skilled facility post AAA repair, this would meet criteria for discharged to home.',''),
('PQRS_0417', 'answer', '1|Patient discharge to home no later than post-operative day #7 (G9601)|G9601',1),
('PQRS_0417', 'answer', '2|Patient not discharged to home by post-operative day #7 (G9602)|G9602',9),

('PQRS_0418', 'description', 'Osteoporosis Management in Women Who Had a Fracture',''),
('PQRS_0418', 'question', 'Patients who received either a bone mineral density test or a prescription for a drug to treat osteoporosis after a fracture occurs<br>Definitions:<br>Pharmacologic Therapy -- U.S. Food and Drug Administration approved pharmacologic options for osteoporosis prevention and/or treatment of postmenopausal osteoporosis include, in alphabetical order: bisphosphonates (alendronate, alendronate-cholecalciferol, calcium carbonate-risedronate, ibandronate, risedronate, zoledronic acid, calcitonin, teriparatide, denosumab, and raloxifine.<br>Prescribed -- May include prescription given to the patient for treatment of osteoporosis (as listed above) at one or more encounters during the reporting period, or documentation that patient is already taking pharmacologic therapy for osteoporosis, as documented in the current medical list.',''),
('PQRS_0418', 'answer', '1|Central Dual-energy X-Ray Absorptiometry (DXA) results documented (3095F)|3095F',1),
('PQRS_0418', 'answer', '2|Pharmacologic therapy (other than minerals/vitamins) for osteoporosis prescribed (G8633)|G8633',1),
('PQRS_0418', 'answer', '3|Central dual energy X-ray absorptiometry (DXA) measurement was not performed, reason not otherwise specified (3095F:8P)|3095F:8P',9),
('PQRS_0418', 'answer', '4|Pharmacologic therapy for osteoporosis was not prescribed, reason not given (G8635)|G8635',9),

('PQRS_0419', 'description', 'Overuse Of Neuroimaging For Patients With Primary Headache And A Normal Neurological Examination',''),
('PQRS_0419', 'question', 'Patients with a normal neurological examination for whom advanced brain imaging (CTA, CT, MRA or MRI) was NOT ordered.<br>Definition:<br>Normal Neurological Examination - Absence of signs of increased intracranial pressure (e.g., papilledema, absent venous pulsations on funduscopic examination, altered cognition), focal neurologic deficits, ataxia, pathologic neurologic reflexes (e.g., Babinski sign, clonus), signs of meningeal irritation ',''),
('PQRS_0419', 'answer', '1|Advanced brain imaging (CTA, CT, MRA or MRI) was NOT ordered (G9534)|G9534',1),
('PQRS_0419', 'answer', '2|Documentation of Medical reason(s) for ordering an advanced brain imaging study <br>*** Please see Measure Documentation for examples *** (G9536)|G9536',2),
('PQRS_0419', 'answer', '3|Documentation of System reason(s) for ordering an advanced brain imaging study (i.e., needed as part of a clinical trial; other clinician ordered the study) (G9537)|G9537',2),
('PQRS_0419', 'answer', '4|Advanced brain imaging (CTA, CT, MRA or MRI) was ordered (G9538)|G9538',9),

('PQRS_0420', 'description', 'Varicose Vein Treatment with Saphenous Ablation: Outcome Survey',''),
('PQRS_0420', 'question', 'Patients whose outcome survey score improved when assessed 3-6 months following treatment<br>Definition:<br>Outcome Survey -- A normalized and validated outcome survey developed for the patient reported outcomes for saphenous vein ablation. The disease specific standardized outcome survey utilized must be documented in the medical record. Examples of outcome surveys include, but are not limited to:<br><lii>Venous Insufficiency Epidemiological and Economic Study-Quality of Life (VEINES-QOL)<li>Chronic Venous Insufficiency Questionnaire (CIVIQ)<li>Aberdeen Varicose Veins Questionnaire (AVVQ)<li>Specific Quality of Life and Outcome Response - Venous (SQOR-V)',''),
('PQRS_0420', 'answer', '1|Patient survey score improved from baseline following treatment (G9603)|G9603',1),
('PQRS_0420', 'answer', '2|Patient survey results not available (G9604)|G9604',2),
('PQRS_0420', 'answer', '3|Patient survey score did not improve from baseline following treatment (G9605)|G9605',9),

('PQRS_0421', 'description', 'Appropriate Assessment of Retrievable Inferior Vena Cava Filters for Removal',''),
('PQRS_0421', 'question', 'Number of patients that have appropriate IVC filter follow-up<br>Definition:<br>Appropriate IVC Filter follow-up - For the purposes of this measure, the appropriate follow-up would include:<br>1) Filter removed OR;<br>2) Documentation of re-assessment for the appropriateness of filter removal OR;<br>3) Documentation of at least two attempts to reach the patient to arrange a clinical re-assessment for the appropriateness of filter removal',''),
('PQRS_0421', 'answer', '1|Filter removed within 3 months of placement (G9541)|G9541',1),
('PQRS_0421', 'answer', '2|Documented re-assessment for the appropriateness of filter removal within 3 months of placement (G9542)|G9542',1),
('PQRS_0421', 'answer', '3|Documentation of at least two attempts to reach the patient to arrange a clinical re-assessment for the appropriateness of filter removal within 3 months of placement (G9543)|G9543',1),
('PQRS_0421', 'answer', '4|Patients that do not have the filter removed, documented re-assessment for the appropriateness of filter removal, or documentation of at least two attempts to reach the patient to arrange a clinical re-assessment for the appropriateness of filter removal within 3 months of placement (G9544)|G9544',9),

('PQRS_0422', 'description', 'Performing Cystoscopy at the Time of Hysterectomy for Pelvic Organ Prolapse to Detect Lower Urinary Tract Injury',''),
('PQRS_0422', 'question', 'Patients in whom an intraoperative cystoscopy was performed to evaluate for lower urinary tract injury at the time of hysterectomy for pelvic organ prolapse',''),
('PQRS_0422', 'answer', '1| Intraoperative cystoscopy performed to evaluate for lower tract injury (G9606)|G9606',1),
('PQRS_0422', 'answer', '2|Patient is not eligible (e.g., patient death during procedure, absent urethra or an otherwise inaccessible bladder) (G9607)|G9607',2),
('PQRS_0422', 'answer', '3|Intraoperative cystoscopy not performed to evaluate for lower tract injury (G9608)|G9608',9),

('PQRS_0423', 'description', 'Perioperative Anti-platelet Therapy for Patients Undergoing Carotid Endarterectomy',''),
('PQRS_0423', 'question', 'Patients undergoing carotid endarterectomy who received anti-platelet agents such as aspirin or aspirin-like agents, or P2y12 antagonists within 48 hours prior to the initiation of surgery AND are prescribed this medication at hospital discharge following surgery<br> Numerator Instructions: There must be documentation of an order (written order, verbal order, or standing order/protocol) for anti-platelet agents OR P2y12 antagonists OR documentation that anti-platelet agents OR P2y12 antagonists was given within 48 hours prior to surgery AND patient has prescription for this medication hospital discharge following surgery.<br>NUMERATOR NOTE: In the event surgery is delayed, as long as the patient is redosed (if clinically indicated) the numerator coding G9609 (Performance Met) is appropriate.',''),
('PQRS_0423', 'answer', '1|Documentation of an order for anti-platelet agents OR P2y12 antagonists (G9609)|G9609',1),
('PQRS_0423', 'answer', '2|Documentation of medical reason(s) for not ordering anti-platelet agents OR P2y12 antagonists (e.g.  Patients with known intolerance to anti-platelet agents such as aspirin or aspirin-like agents, or P2y12 antagonists, or those on or other intravenous anticoagulants; patients with active bleeding or undergoing urgent or emergent operations or endarterectomy combined with cardiac surgery, other medical reason(s)) (G9610)|G9610',2),
('PQRS_0423', 'answer', '3|Order for anti-platelet agents OR P2y12 antagonists was not documented, reason not given (G9611)|G9611',9),

('PQRS_0424', 'description', 'Perioperative Temperature Management',''),
('PQRS_0424', 'question', 'Patients for whom at least one body temperature greater than or equal to 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) was recorded within the 30 minutes immediately before or the 15 minutes immediately after anesthesia end time',''),
('PQRS_0424', 'answer', '1|At least 1 body temperature measurement equal to or greater than 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) recorded within the 30 minutes immediately before or the 15 minutes immediately after anesthesia end time (G9771)|G9771',1),
('PQRS_0424', 'answer', '2|Documentation of one of the following medical reason(s) for not achieving at least 1 body temperature measurement equal to or greater than 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) recorded within the 30 minutes immediately before or the 15 minutes immediately after anesthesia end time (e.g., Emergency cases, Intentional hypothermia, etc.) (G9772)|G9772',2),
('PQRS_0424', 'answer', '3|At least 1 body temperature measurement equal to or greater than 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) recorded within the 30 minutes immediately before or the 15 minutes immediately after anesthesia end time (G9773)|G9773',9),

('PQRS_0425', 'description', 'Photodocumentation of Cecal Intubation',''),
('PQRS_0425', 'question', 'Number of patients undergoing screening or surveillance colonoscopy who have photodocumentation of landmarks of cecal intubation to establish a complete examination <br>NUMERATOR NOTE: In the instance that the patient has an anatomical/physiological reason for not capturing photodocumentation of one or more of cecal landmarks (i.e., patient has no cecum), it would be appropriate to report G9613.',''),
('PQRS_0425', 'answer', '1|Photodocumentation of one or more cecal landmarks to establish a complete examination (G9612)|G9612',1),
('PQRS_0425', 'answer', '2|No photodocumentation of cecal landmarks to establish a complete examination (G9614)|G9614',9),

('PQRS_0426', 'description', 'Post-Anesthetic Transfer of Care Measure: Procedure Room to a Post Anesthesia Care Unit (PACU)',''),
('PQRS_0426', 'question', 'Did the patient recieve transfer care from procedure room to PACU or other non ICU location utilizing a checklist or protocol which includes:<br>Identification of patient<br>1. Identification of responsible practitioner (PACU nurse or advanced practitioner)<br>2. Discussion of pertinent medical history<br>3. Discussion of the surgical/procedure course (procedure, reason for surgery, procedure performed)<br>4. Intraoperative anesthetic management and issues/concerns.<br>5. Expectations/Plans for the early post-procedure period.<br>6. Opportunity for questions and acknowledgement of understanding of report from the receiving PACU team',''),
('PQRS_0426', 'answer', '1|A transfer of care protocol or handoff tool/checklist that includes the required key handoff elements is used (G9655)|G9655',1),
('PQRS_0426', 'answer', '2|A transfer of care protocol or handoff tool/checklist that includes the required key handoff elements is not used (G9658)|G9658',9),

('PQRS_0427', 'description', 'Post-Anesthetic Transfer of Care: Use of Checklist or Protocol for Direct Transfer of Care from Procedure Room to Intensive Care Unit (ICU)',''),
('PQRS_0427', 'question', 'Patients who have a documented use of a checklist or protocol for the transfer of care from the responsible anesthesia practitioner to the responsible ICU team or team member<br>Definition:<br>Checklist or Protocol - The key handoff elements that must be included in the transfer of care protocol or checklist include:<li>Identification of patient, key family member(s) or patient surrogate<li>Identification of responsible practitioner (primary service)<li>Discussion of pertinent/attainable medical history<li>Discussion of the surgical/procedure course (procedure, reason for surgery, procedure performed)<li>Intraoperative anesthetic management and issue/concerns to include things such as airway, hemodynamic, narcotic, sedation level and paralytic management and intravenous fluids/blood products and urine output during the procedure<li>Expectations/Plans for the early post-procedure period to include things such as the anticipated course (anticipatory guidance), complications, need for laboratory or ECG and medication administration<li>Opportunity for questions and acknowledgement of understanding of report from the receiving ICU team<br>Identification of patient; In the instance the identity of the patient is unable to be confirmed, identification provided by the clinical facility would suffice toward meeting performance of the measure ',''),
('PQRS_0427', 'answer', '1|Transfer of care checklist used (0583F)|0583F',1),
('PQRS_0427', 'answer', '2|Transfer of care checklist not used (0583F:8P)|0583F:8P',9),

('PQRS_0428', 'description', 'Pelvic Organ Prolapse: Preoperative Assessment of Occult Stress Urinary Incontinence',''),
('PQRS_0428', 'question', 'Number of patients undergoing preoperative assessment<br>Definition:<br>Preoperative Assessment -- Includes the following:<br>1) History asking about incontinence and its character.<br>2) Urinalysis documented.<br> 3) Physical exam testing for stress incontinence whether or not a patient is symptomatic.',''),
('PQRS_0428', 'answer', '1|Preoperative assessment documented (G9615)|G9615',1),
('PQRS_0428', 'answer', '2|Documentation of reason(s) for not documenting a preoperative assessment (e.g., patient with a gynecologic or other pelvic malignancy noted at the time of surgery) (G9616)|G9616',2),
('PQRS_0428', 'answer', '3|Preoperative assessment not documented, reason not given (G9617)|G9617',9),

('PQRS_0429', 'description', 'Pelvic Organ Prolapse: Preoperative Screening for Uterine Malignancy',''),
('PQRS_0429', 'question', 'Number of patients screened for uterine malignancy or those that had an ultrasound and/or endometrial sampling of any kind',''),
('PQRS_0429', 'answer', '1|Documentation of screening for uterine malignancy, or those that had an ultrasound and/or endometrial sampling of any kind (G9618)|G9618',1),
('PQRS_0429', 'answer', '2|Patient not screened for uterine malignancy, or those that have not had an ultrasound and/or endometrial sampling of any kind, reason not given (G9620)|G9620',9),

('PQRS_0430', 'description', 'Prevention of Post-Operative Nausea and Vomiting (PONV) -- Combination Therapy',''),
('PQRS_0430', 'question', 'Patients who receive combination therapy consisting of at least two prophylactic pharmacologic anti-emetic agents of different classes preoperatively or intraoperatively<br>Definition:<br>Anti-emetics Therapy - The recommended first- and second-line classes of pharmacologic anti-emetics for PONV prophylaxis in patients at moderate to severe risk of PONV include (but are not limited to):<li>NK-1 Receptor Antagonists<li>5-Hydroxytryptamine (5-HT3) Receptor Antagonists<li>Glucocorticoids<li>Phenothiazines<li>Phenylethylamines<li>Butyrophenones<li>Antihistamines<li>Anticholinergics<br>NOTE: The foregoing list of medications/drug names is based on clinical guidelines and other evidence. The specified drugs were selected based on the strength of evidence for their clinical effectiveness. This list of selected drugs may not be current. Physicians and other health care professionals should refer to the FDA''s web site page entitled ''Drug Safety Communications'' for up-to-date drug recall and alert information when prescribing medications.',''),
('PQRS_0430', 'answer', '1|Patient received at least 2 prophylactic pharmacologic anti-emetic agents of different classes preoperatively and intraoperatively (G9775)|G9775',1),
('PQRS_0430', 'answer', '2|Documentation of medical reason for not receiving at least 2 prophylactic pharmacologic anti-emetic agents of different classes preoperatively and intraoperatively (e.g., intolerance or other medical reason) (G9776)|G9776',2),
('PQRS_0430', 'answer', '3|Patient did not receive at least 2 prophylactic pharmacologic anti-emetic agents of different classes preoperatively and intraoperatively (G9777)|G9777',9),

('PQRS_0431', 'description', 'Preventive Care and Screening: Unhealthy Alcohol Use: Screening & Brief Counseling',''),
('PQRS_0431', 'question', 'Was patient screened at least once within the last 24 months for unhealthy alcohol use using a systematic screening method AND who received brief counseling if identified as an unhealthy alcohol user?<br>** Please see Measure Documentation for Definitons and Methods used in this measure **',''),
('PQRS_0431', 'answer', '1|Patient identified as an unhealthy alcohol user when screened for unhealthy alcohol use using a systematic screening method and received brief counseling (G9621)|G9621',1),
('PQRS_0431', 'answer', '2|Patient not identified as an unhealthy alcohol user when screened for unhealthy alcohol use using a systematic screening method (G9622)|G9622',1),
('PQRS_0431', 'answer', '3|Documentation of medical reason(s) for not screening for unhealthy alcohol use (e.g., limited life expectancy, other medical reasons) (G9623)|G9623',2),
('PQRS_0431', 'answer', '4|Patient not screened for unhealthy alcohol screening using a systematic screening method OR patient did not receive brief counseling, reason not given (G9624)|G9624',9),

('PQRS_0432', 'description', 'Proportion of Patients Sustaining a Bladder Injury at the Time of any Pelvic Organ Prolapse Repair',''),
('PQRS_0432', 'question', 'Total number of patient\'s receiving a bladder injury at the time of surgery to repair a pelvic organ prolapse with repair during the procedure or subsequently up to 1 month post-surgery <br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.<br>NUMERATOR NOTE: In order to meet the measure, bladder injury is sustained as a result of the prolapse surgery.',''),
('PQRS_0432', 'answer', '1|Patient sustained bladder injury at the time of surgery or subsequently up to 1 month post-surgery (G9625)|G9625',1),
('PQRS_0432', 'answer', '2|Patient is not eligible (e.g., gynecologic or other pelvic malignancy documented, concurrent surgery involving bladder neoplasia or otherwise to treat a bladder specific problem, patient death from other causes, etc.) (G9626)|G9626',2),
('PQRS_0432', 'answer', '3|Patient did not sustain bladder injury at the time of surgery or subsequently up to 1 month post-surgery (G9627)|G9627',9),

('PQRS_0433', 'description', 'Proportion of Patients Sustaining a Major Viscus Injury at the time of any Pelvic Organ Prolapse Repair',''),
('PQRS_0433', 'question', 'The number of patients receiving a major viscus injury with repair at the time of initial surgery or subsequently up to 1 month postoperatively-surgery<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.<br>NUMERATOR NOTE: In order to meet the measure, major viscus injury is sustained as a result of the prolapse surgery.',''),
('PQRS_0433', 'answer', '1|Patient sustained major viscus injury at the time of surgery or subsequently up to 1 month post-surgery (G9628)|G9628',1),
('PQRS_0433', 'answer', '2|Patient is not eligible (e.g., gynecologic or other pelvic malignancy documented, concurrent surgery involving bladder neoplasia or otherwise to treat a bladder specific problem, patient death from other causes, etc.) (G9629)|G9629',2),
('PQRS_0433', 'answer', '3|Patient did not sustain major viscus injury at the time of surgery or subsequently up to 1 month post-surgery (G9630)|G9630',9),

('PQRS_0434', 'description', 'Proportion of Patients Sustaining a Ureter Injury at the Time of any Pelvic Organ Prolapse Repair',''),
('PQRS_0434', 'question', 'The number of patients receiving a ureter injury with repair at the time of initial surgery or subsequently up to 1 month postoperatively surgery<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify. <br>NUMERATOR NOTE: In order to meet the measure, ureter injury is sustained as a result of the prolapse surgery.',''),
('PQRS_0434', 'answer', '1|Patient sustained ureter injury at the time of surgery or discovered subsequently up to 1 month post-surgery (G9631)|G9631',1),
('PQRS_0434', 'answer', '2|Patient is not eligible (e.g., gynecologic or other pelvic malignancy documented, concurrent surgery involving bladder neoplasia or otherwise to treat a bladder specific problem, patient death from other causes, etc.) (G9632)|G9632',2),
('PQRS_0434', 'answer', '3|Patient did not sustain ureter injury at the time of surgery or subsequently up to 1 month post-surgery (G9633)|G9633',9),

('PQRS_0435', 'description', 'Quality of Life Assessment For Patients With Primary Headache Disorders',''),
('PQRS_0435', 'question', 'Patient whose health related quality of life was assessed with a tool(s) during at least two visits during the 12 month measurement period AND whose health related quality of life score stayed the same or improved',''),
('PQRS_0435', 'answer', '1|Health-related quality of life assessed with tool during at least two visits and quality of life score remained the same or improved (G9634)|G9634',1),
('PQRS_0435', 'answer', '2|Health-related quality of life not assessed with tool for documented reason(s) (e.g., patient has a cognitive or neuropsychiatric impairment that impairs his/her ability to complete the HRQoL survey, patient has the inability to read and/or write in order to complete the HRQoL questionnaire) (G9635)|G9635',2),
('PQRS_0435', 'answer', '3|Health-related quality of life not assessed with tool during at least two visits or quality of life score declined (G9636)|G9636',9),

('PQRS_0436', 'description', 'Radiation Consideration for Adult CT: Utilization of Dose Lowering Techniques',''),
('PQRS_0436', 'question', 'Final reports with documentation that indicate an individualized dose optimization technique was used for the performed procedure, Dose optimization techniques include the following:<li>Automated exposure control<li>Adjustment of the mA and/or kV according to patient size<li>Use of iterative reconstruction technique',''),
('PQRS_0436', 'answer', '1|Final reports with documentation of one or more dose reduction techniques (e.g., Automated exposure control, adjustment of the mA and/or kV according to patient size, use of iterative reconstruction technique) (G9637)|G9637',1),
('PQRS_0436', 'answer', '2|Final reports without documentation of one or more dose reduction techniques (e.g., Automated exposure control, adjustment of the mA and/or kV according to patient size, use of iterative reconstruction technique) (G9638)|G9638',9),

('PQRS_0437', 'description', 'Rate of Surgical Conversion from Lower Extremity Endovascular Revascularization Procedure',''),
('PQRS_0437', 'question', 'Number of patients undergoing major amputation or open surgical bypass within 48 hours of the index endovascular lower extremity revascularization procedure<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that is trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0437', 'answer', '1|Major amputation or open surgical bypass required within 48 hours of the index endovascular lower extremity revascularization procedure (G9641)|G9641',1),
('PQRS_0437', 'answer', '3|Major amputation or open surgical bypass not required within 48 hours of the index endovascular lower extremity revascularization procedure (G9639)|G9639',9),

('PQRS_0438', 'description', 'Statin Therapy for the Prevention and Treatment of Cardiovascular Disease <br>*** Please see Measure Documentation for Definitions and Instructions *** ',''),
('PQRS_0438', 'question', 'Patients who are statin therapy users during the measurement period or who receive an order (prescription) to receive statin therapy at any point during the measurement period <br>*** Please see Measure Documentation for Definitions and Instructions ***',''),
('PQRS_0438', 'answer', '1|Patients who are currently statin therapy users or received an order (prescription) for statin therapy (G9664)|G9664',1),
('PQRS_0438', 'answer', '2|Documentation of medical reason(s) for not currently being a statin therapy user or receive an order (prescription) for statin therapy  (G9781)|G9781',2),
('PQRS_0438', 'answer', '3|Patients who are not currently statin therapy users or did not receive an order (prescription) for statin therapy (G9665)|G9665',9),

('PQRS_0439', 'description', 'Age Appropriate Screening Colonoscopy',''),
('PQRS_0439', 'question', 'All patients greater than 85 years of age included in the denominator who did NOT have a history of colorectal cancer or a valid medical reason for the colonoscopy, including: iron deficiency anemia, lower gastrointestinal bleeding, Crohn''s Disease (i.e. regional enteritis), familial adenomatous polyposis, Lynch Syndrome (i.e., hereditary nonpolyposis colorectal cancer), inflammatory bowel disease, ulcerative colitis, abnormal findings of gastrointestinal tract, or changes in bowel habits. Colonoscopy examinations performed for screening purposes only<br>Numerator Instructions:<br>INVERSE MEASURE - A lower calculated performance rate for this measure indicates better clinical care or control. The ''Performance Not Met'' numerator option for this measure is the representation of the better clinical quality or control. Reporting that numerator option will produce a performance rate that trends closer to 0%, as quality increases. For inverse measures a rate of 100% means all of the denominator eligible patients did not receive the appropriate care or were not in proper control, and therefore an inverse measure at 100% does not qualify for reporting purposes, however any reporting rate less than 100% does qualify.',''),
('PQRS_0439', 'answer', '1|Patients greater than 85 years of age who did not have a history of colorectal cancer or valid medical reason for the colonoscopy, including: iron deficiency anemia, lower gastrointestinal bleeding, Crohn''s Disease (i.e., regional enteritis), familial adenomatous polyposis, Lynch Syndrome (i.e., hereditary non-polyposis colorectal cancer), inflammatory bowel disease, ulcerative colitis, abnormal finding of gastrointestinal tract, or changes in bowel habits (G9659)|G9659',1),
('PQRS_0439', 'answer', '2|Documentation of medical reason(s) for a colonoscopy performed on a patient greater than 85 years of age (e.g., last colonoscopy incomplete, last colonoscopy had inadequate prep, iron deficiency anemia, lower gastrointestinal bleeding, Crohn''s Disease (i.e., regional enteritis), familial history of adenomatous polyposis, Lynch Syndrome (i.e., hereditary non-polyposis colorectal cancer), inflammatory bowel disease, ulcerative colitis, abnormal finding of gastrointestinal tract, or changes in bowel habits) (G9660)|G9660',2),
('PQRS_0439', 'answer', '3|Patients greater than 85 years of age who received a routine colonoscopy for a reason other than the following: an assessment of signs/symptoms of GI tract illness, and/or the patient is considered high risk, and/or to follow-up on previously diagnoses advance lesions (G9661)|G9661',9),

('PQRS_0440', 'description', 'Basal Cell Carcinoma (BCC)/Squamous Cell Carcinoma: Biopsy Reporting Time from Pathologist to Clinician',''),
('PQRS_0440', 'question', 'Was the final pathology report diagnosing cutaneous basal cell carcinoma or squamous cell carcinoma sent from the Pathologist/Dermatopathologist to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist?',''),
('PQRS_0440', 'answer', '1|Pathology report diagnosing cutaneous basal cell carcinoma or squamous cell carcinoma (to include in situ disease)sent from the Pathologist/Dermatopathologist to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist (G9785)|G9785',1),
('PQRS_0440', 'answer', '2|Pathology report diagnosing cutaneous basal cell carcinoma or squamous cell carcinoma (to include in situ disease) was not sent from the Pathologist/Dermatopathologist to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist (G9786)|G9786',9),

('PQRS_0441', 'description', ' Ischemic Vascular Disease (IVD) All or None Outcome Measure (Optimal Control) NOT A RECOMMENDED MEASURE, !INCOMPLETE! ',''),
('PQRS_0441', 'question', 'The number of IVDpatients who meet ALL of the following targets: Most recent BP is less than 140/90 mm Hg And Most recent tobacco status is Tobacco Free (NOTE: If there is No Documentation of Tobacco Status thepatient is not compliant for this measure) And Daily Aspirin or Other Antiplatelet Unless Contraindicated And Statin Use.',''),
('PQRS_0441', 'answer', '1|Most recent BP is less than or equal to 140/90 mm Hg (G9788)|G9788',1),
('PQRS_0441', 'answer', '2|Blood pressure recorded during inpatient stays, Emergency Room Visits, Urgent Care Visits, and Patient Self-Reported BP?s (Home and Health Fair BP results) (G9789)|G9789',2),
('PQRS_0441', 'answer', '3|Most recent BP is greater than 140/90 mm Hg, or blood pressure not documented (G9790)|G9790',9),

('PQRS_0442', 'description', 'Persistence of Beta-Blocker Treatment After a Heart Attack',''),
('PQRS_0442', 'question', 'Patients who had a 180-day course of treatment with beta-blockers post discharge.',''),
('PQRS_0442', 'answer', '1|Patient prescribed a 180-day course of treatment with beta-blockers post discharge for AMI (G9803)|G9803',1),
('PQRS_0442', 'answer', '2|Patientwasnot prescribed a 180-day course of treatment with beta-blockers post discharge for AMI (G9804) |G9804',9),

('PQRS_0443', 'description', 'Non-Recommended Cervical Cancer Screening in Adolescent Females',''),
('PQRS_0443', 'question', 'Patients who received cervical cytology or an HPV test during the measurement period .',''),
('PQRS_0443', 'answer', '1|Patients who received cervical cytology or an HPV test (G9806) |G9806',1),
('PQRS_0443', 'answer', '2|Patients who did not receive cervical cytology or an HPV test (G9807) |G9807',9),

('PQRS_0444', 'description', 'Medication Management for People with Asthma',''),
('PQRS_0444', 'question', 'The number of patients who achieved a proportion of days (PDC) of at least 75% for their asthma controller medications during the measurement year.',''),
('PQRS_0444', 'answer', '1|Patient achieved a PDC of at least 75% for their asthma controller medication (G9810) |G9810',1),
('PQRS_0444', 'answer', '2|Patient did not achieve a PDC of at least 75% for their asthma controller medication (G9811)|G9811',9),

('PQRS_0445', 'description', 'Risk-Adjusted Operative Mortality for Coronary Artery Bypass Graft(CABG)',''),
('PQRS_0445', 'question', 'Number of patients undergoing isolated CABG who die, including both all deaths occurring during thehospitalization in which the operation was performed, even if after 30 days, and those deaths occurring after discharge from the hospital, but within 30 days of the procedure .',''),
('PQRS_0445', 'answer', '1|Patient died including all deaths occurring during the hospitalization in which the operation was performed, even if after 30 days, and those deaths occurring after discharge from the hospital, but within 30 days of the procedure (G9812) |G9812',1),
('PQRS_0445', 'answer', '2|Patient did not die within 30 days of the procedure or during the index hospitalization(G9813)|G9813',9),

('PQRS_0446', 'description', ' Operative Mortality Stratified by the Five STS-EACTS Mortality Categories NOTE:  Answer needed for only ONE reporting criteria in this measure, then re-run the report.',''),
('PQRS_0446', 'question', 'Did patient death occur during the index acute care hospitalization in which the procedure was performed stratified by the five STAT Mortality Levels, a multi-institutional validated complexity stratification tool? <BR> AND <BR> Did patient death occur after discharge from the hospital, but within 30 days of the procedure, stratified by the five STAT Mortality Levels, a multi-institutional validated complexity stratification tool?',''),
('PQRS_0446', 'answer', '1|Death occurring during index acute care hospitalization (G9814)|G9814',1),
('PQRS_0446', 'answer', '2|Death did not occur during index acute care hospitalization (G9815)|G9815',9),
('PQRS_0446', 'answer', '3|Death occurring after discharge from hospital but within 30 days post procedure (G9816)|G9816',1),
('PQRS_0446', 'answer', '4|Death did not occur after discharge from hospital but within 30 days post procedure (G9817)|G9817',9),

('PQRS_0447', 'description', 'Chlamydia Screening and Follow Up',''),
('PQRS_0447', 'question', 'Adolescents who had documentation of a chlamydia screening test with proper follow-up during the measurement period.',''),
('PQRS_0447', 'answer', '1|Documentation of a chlamydia screening test with proper follow-up(G9820)|G9820',1),
('PQRS_0447', 'answer', '2|No documentation of a chlamydia screening test with proper follow-up (G9821) |G9821',9),

('PQRS_0448', 'description', 'Appropriate Workup Prior to Endometrial Ablation',''),
('PQRS_0448', 'question', 'Women who received endometrial sampling or hysteroscopy with biopsy and results documented during the year prior to the index date (exclusive of the index date) of the endometrial ablation.',''),
('PQRS_0448', 'answer', '1|Endometrial sampling or hysteroscopywith biopsy and results documented(G9823) |G9823',1),
('PQRS_0448', 'answer', '2|Endometrial sampling or hysteroscopywith biopsy and results not documented(G9824)|G9824',9),

('PQRS_0449', 'description', 'HER2 Negative or Undocumented Breast Cancer Patients Spared Treatment with HER2-T argeted Therapies',''),
('PQRS_0449', 'question', 'HER2-targeted therapy administration during the initial course of treatment.',''),
('PQRS_0449', 'answer', '1|HER2-targeted therapies not administered during the initial course of treatment(G9827)|G9827',1),
('PQRS_0449', 'answer', '2|HER2-targeted therapies administered during the initial course of treatment(G9828)|G9828',9),


('PQRS_0450', 'description', 'Trastuzumab Received By Patients With AJCC Stage I (T1c) ? III And HER2 Positive Breast Cancer Receiving Adjuvant Chemotherapy',''),
('PQRS_0450', 'question', 'Trastuzumab administered within 12 months of diagnosis.',''),
('PQRS_0450', 'answer', '1|Trastuzumab administered within 12 months of diagnosis(G9835)|G9835',1),
('PQRS_0450', 'answer', '2|Reason for not administering Trastuzumab documented (e.g. patient declined, patient died, patient transferred, contraindication or other clinical exclusion, neoadjuvant chemotherapy or radiation NOT complete)(G9836)|G9836',2),
('PQRS_0450', 'answer', '3|Trastuzumab not administered within 12 months of diagnosis(G9837)|G9837',9),

('PQRS_0451', 'description', 'RAS (KRAS and NRAS) Gene Mutation Testing Performed for Patients with Metastatic Colorectal Cancer who receive Anti-epidermal Growth Factor Receptor (EGFR) Monoclonal Antibody Therapy',''),
('PQRS_0451', 'question', 'Was RAS (KRAS and NRAS) gene mutation testing performed before initiation of anti-EGFR MoAb?',''),
('PQRS_0451', 'answer', '1|RAS (KRAS and NRAS) gene mutation testing performed before initiation of anti-EGFR MoAb (G9840)|G9840',1),
('PQRS_0451', 'answer', '2|RAS (KRAS and NRAS)gene mutation testing not performed before initiation of anti-EGFR MoAb (G9841)|G9841',9),

('PQRS_0452', 'description', 'Patients with Metastatic Colorectal Cancer and RAS (KRAS and NRAS) Gene Mutation Spared Treatment with Anti-epidermal Growth Factor Receptor (EGFR) Monoclonal Antibodies',''),
('PQRS_0452', 'question', 'Did the patient receive Anti-EGFR monoclonal antibody therapy?',''),
('PQRS_0452', 'answer', '1|Patient did not receive anti-EGFR monoclonal antibody therapy (G9844)|G9844',1),
('PQRS_0452', 'answer', '2|Patient received anti-EGFR monoclonal antibody therapy (G9845)|G9845',9),

('PQRS_0453', 'description', 'Proportion Receiving Chemotherapy in the Last 14 Days of Life',''),
('PQRS_0453', 'question', 'Patients who received chemotherapy in the last 14 days of life.',''),
('PQRS_0453', 'answer', '1|Patient received chemotherapy in the last 14 days of life (G9847)|G9847',1),
('PQRS_0453', 'answer', '2|Patientdid not receive chemotherapy in the last 14 days of life (G9848)|G9848',9),

('PQRS_0454', 'description', 'Proportion of Patients who Died from Cancer with more than One Emergency Department Visit in the Last 30 Days of Life',''),
('PQRS_0454', 'question', 'Patients who died from cancer and had more than one emergency department visit in the last 30 days of life .',''),
('PQRS_0454', 'answer', '1|Patient had more than one emergency department visit in the last 30 days of life(G9850)|G9850',1),
('PQRS_0454', 'answer', '2|Patient had one or less emergency department visits in the last 30 days oflife(G9851)|G9851',9),

('PQRS_0455', 'description', 'Proportion Admitted to the Intensive Care Unit (ICU) in the Last 30 Days of Life',''),
('PQRS_0455', 'question', 'Proportion Admitted to the Intensive Care Unit (ICU) in the Last 30 Days of Life.',''),
('PQRS_0455', 'answer', '1|Patient admitted to the ICU in the last 30 days of life (G9853)|G9853',1),
('PQRS_0455', 'answer', '2|Patient was not admitted to the ICU in the last 30 days of life (G9854)|G9854',9),

('PQRS_0456', 'description', 'Proportion Not Admitted To Hospice',''),
('PQRS_0456', 'question', 'Patients not admitted to hospice.',''),
('PQRS_0456', 'answer', '1|Patient was not admitted to hospice (G9856)|G9856',1),
('PQRS_0456', 'answer', '2|Patient admitted to hospice (G9857)|G9857',9),

('PQRS_0457', 'description', 'Proportion Admitted to Hospice for less than 3 days',''),
('PQRS_0457', 'question', 'Patients who died from cancer and spent fewer than three days in hospice.',''),
('PQRS_0457', 'answer', '1|Patient spent less than three days in hospice care (G9860)|G9860',1),
('PQRS_0457', 'answer', '2|Patient spent greater than or equal to three days in hospice care (G9861)|G9861',9),

('PQRS_0459', 'description', 'text',''),
('PQRS_0459', 'question', 'text',''),
('PQRS_0459', 'answer', '1|text|G0000',1),
('PQRS_0459', 'answer', '2|text|G0000',9),

('PQRS_0460', 'description', 'text',''),
('PQRS_0460', 'question', 'text.',''),
('PQRS_0460', 'answer', '1|text|G0000',1),
('PQRS_0460', 'answer', '2|text|G0000',9),

('PQRS_0461', 'description', 'text',''),
('PQRS_0461', 'question', 'text.',''),
('PQRS_0461', 'answer', '1|text|G0000',1),
('PQRS_0461', 'answer', '2|text|G0000',9),

('PQRS_0463', 'description', 'text',''),
('PQRS_0463', 'question', 'text.',''),
('PQRS_0463', 'answer', '1|text|G0000',1),
('PQRS_0463', 'answer', '2|text|G0000',2),
('PQRS_0463', 'answer', '3|text|G0000',9),

('PQRS_0464', 'description', 'text',''),
('PQRS_0464', 'question', 'text.',''),
('PQRS_0464', 'answer', '1|text|G0000',1),
('PQRS_0464', 'answer', '2|text|G0000',2),
('PQRS_0464', 'answer', '2|text|G0000',9),

('PQRS_0465', 'description', 'text',''),
('PQRS_0465', 'question', 'text.',''),
('PQRS_0465', 'answer', '1|text|G0000',1),
('PQRS_0465', 'answer', '2|text|G0000',9),

('PQRS_0467', 'description', 'text',''),
('PQRS_0467', 'question', 'text.',''),
('PQRS_0467', 'answer', '1|text|G0000',1),
('PQRS_0467', 'answer', '2|text|G0000',9),

('pre_0001', 'description', 'Pre-selection of patients for Measure 001',''),
('pre_0007', 'description', 'Pre-selection of patients for Measure 007',''),
('pre_0005', 'description', 'Pre-selection of patients for Measure 005',''),
('pre_0024', 'description', 'Pre-selection of patients for Measure 024',''),
('pre_0047', 'description', 'Pre-selection of patients for Measure 047',''),
('pre_0048', 'description', 'Pre-selection of patients for Measure 048',''),
('pre_0050', 'description', 'Pre-selection of patients for Measure 050',''),
('pre_0052', 'description', 'Pre-selection of patients for Measure 052',''),
('pre_0065', 'description', 'Pre-selection of patients for Measure 065',''),
('pre_0066', 'description', 'Pre-selection of patients for Measure 066',''),
('pre_0068', 'description', 'Pre-selection of patients for Measure 068',''),
('pre_0099', 'description', 'Pre-selection of patients for Measure 099',''),
('pre_0100', 'description', 'Pre-selection of patients for Measure 100',''),
('pre_0102', 'description', 'Pre-selection of patients for Measure 102',''),
('pre_0104', 'description', 'Pre-selection of patients for Measure 104',''),
('pre_0111', 'description', 'Pre-selection of patients for Measure 111',''),
('pre_0112', 'description', 'Pre-selection of patients for Measure 112',''),
('pre_0113', 'description', 'Pre-selection of patients for Measure 113',''),
('pre_0116', 'description', 'Pre-selection of patients for Measure 116',''),
('pre_0117', 'description', 'Pre-selection of patients for Measure 117',''),
('pre_0118', 'description', 'Pre-selection of patients for Measure 118',''),
('pre_0119', 'description', 'Pre-selection of patients for Measure 119',''),
('pre_0128', 'description', 'Pre-selection of patients for Measure 128',''),
('pre_0134', 'description', 'Pre-selection of patients for Measure 134',''),
('pre_0146', 'description', 'Pre-selection of patients for Measure 146',''),
('pre_0154', 'description', 'Pre-selection of patients for Measure 154',''),
('pre_0155', 'description', 'Pre-selection of patients for Measure 155',''),
('pre_0167', 'description', 'Pre-selection of patients for Measure 167',''),
('pre_0176', 'description', 'Pre-selection of patients for Measure 176',''),
('pre_0204', 'description', 'Pre-selection of patients for Measure 204',''),
('pre_0205', 'description', 'Pre-selection of patients for Measure 205',''),
('pre_0217', 'description', 'Pre-selection of patients for Measure 217',''),
('pre_0218', 'description', 'Pre-selection of patients for Measure 218',''),
('pre_0219', 'description', 'Pre-selection of patients for Measure 219',''),
('pre_0220', 'description', 'Pre-selection of patients for Measure 220',''),
('pre_0221', 'description', 'Pre-selection of patients for Measure 221',''),
('pre_0222', 'description', 'Pre-selection of patients for Measure 222',''),
('pre_0223', 'description', 'Pre-selection of patients for Measure 223',''),
('pre_0224', 'description', 'Pre-selection of patients for Measure 224',''),
('pre_0225', 'description', 'Pre-selection of patients for Measure 225',''),
('pre_0236', 'description', 'Pre-selection of patients for Measure 236',''),
('pre_0238', 'description', 'Pre-selection of patients for Measure 238',''),
('pre_0249', 'description', 'Pre-selection of patients for Measure 249',''),
('pre_0250', 'description', 'Pre-selection of patients for Measure 250',''),
('pre_0251', 'description', 'Pre-selection of patients for Measure 251',''),
('pre_0258', 'description', 'Pre-selection of patients for Measure 258',''),
('pre_0259', 'description', 'Pre-selection of patients for Measure 259',''),
('pre_0260', 'description', 'Pre-selection of patients for Measure 260',''),
('pre_0262', 'description', 'Pre-selection of patients for Measure 262',''),
('pre_0263', 'description', 'Pre-selection of patients for Measure 263',''),
('pre_0264', 'description', 'Pre-selection of patients for Measure 264',''),
('pre_0271', 'description', 'Pre-selection of patients for Measure 271',''),
('pre_0278', 'description', 'Pre-selection of patients for Measure 278',''),
('pre_0279', 'description', 'Pre-selection of patients for Measure 279',''),
('pre_0326', 'description', 'Pre-selection of patients for Measure 326',''),
('pre_0327', 'description', 'Pre-selection of patients for Measure 327',''),
('pre_0329', 'description', 'Pre-selection of patients for Measure 329',''),
('pre_0330', 'description', 'Pre-selection of patients for Measure 330',''),
('pre_0332', 'description', 'Pre-selection of patients for Measure 332',''),
('pre_0337', 'description', 'Pre-selection of patients for Measure 337',''),
('pre_0340', 'description', 'Pre-selection of patients for Measure 340',''),
('pre_0344', 'description', 'Pre-selection of patients for Measure 344',''),
('pre_0345', 'description', 'Pre-selection of patients for Measure 345',''),
('pre_0346', 'description', 'Pre-selection of patients for Measure 346',''),
('pre_0347', 'description', 'Pre-selection of patients for Measure 347',''),
('pre_0348', 'description', 'Pre-selection of patients for Measure 348',''),
('pre_0358', 'description', 'Pre-selection of patients for Measure 358',''),
('pre_0364', 'description', 'Pre-selection of patients for Measure 364',''),
('pre_0370', 'description', 'Pre-selection of patients for Measure 370',''),
('pre_0384', 'description', 'Pre-selection of patients for Measure 384',''),
('pre_0385', 'description', 'Pre-selection of patients for Measure 385',''),
('pre_0386', 'description', 'Pre-selection of patients for Measure 386',''),
('pre_0388', 'description', 'Pre-selection of patients for Measure 388',''),
('pre_0391', 'description', 'Pre-selection of patients for Measure 391',''),
('pre_0394', 'description', 'Pre-selection of patients for Measure 394',''),
('pre_0395', 'description', 'Pre-selection of patients for Measure 395',''),
('pre_0396', 'description', 'Pre-selection of patients for Measure 396',''),
('pre_0397', 'description', 'Pre-selection of patients for Measure 397',''),
('pre_0403', 'description', 'Pre-selection of patients for Measure 403',''),
('pre_0404', 'description', 'Pre-selection of patients for Measure 404',''),
('pre_0405', 'description', 'Pre-selection of patients for Measure 405',''),
('pre_0406', 'description', 'Pre-selection of patients for Measure 406',''),
('pre_0408', 'description', 'Pre-selection of patients for Measure 408',''),
('pre_0410', 'description', 'Pre-selection of patients for Measure 410',''),
('pre_0411', 'description', 'Pre-selection of patients for Measure 411',''),
('pre_0412', 'description', 'Pre-selection of patients for Measure 412',''),
('pre_0413', 'description', 'Pre-selection of patients for Measure 413',''),
('pre_0414', 'description', 'Pre-selection of patients for Measure 414',''),
('pre_0415', 'description', 'Pre-selection of patients for Measure 415',''),
('pre_0416', 'description', 'Pre-selection of patients for Measure 416',''),
('pre_0417', 'description', 'Pre-selection of patients for Measure 417',''),
('pre_0418', 'description', 'Pre-selection of patients for Measure 418',''),
('pre_0419', 'description', 'Pre-selection of patients for Measure 419',''),
('pre_0421', 'description', 'Pre-selection of patients for Measure 421',''),
('pre_0424', 'description', 'Pre-selection of patients for Measure 424',''),
('pre_0425', 'description', 'Pre-selection of patients for Measure 425',''),
('pre_0426', 'description', 'Pre-selection of patients for Measure 426',''),
('pre_0427', 'description', 'Pre-selection of patients for Measure 427',''),
('pre_0429', 'description', 'Pre-selection of patients for Measure 429',''),
('pre_0430', 'description', 'Pre-selection of patients for Measure 430',''),
('pre_0437', 'description', 'Pre-selection of patients for Measure 437',''),
('pre_0438', 'description', 'Pre-selection of patients for Measure 438',''),
('pre_0440', 'description', 'Pre-selection of patients for Measure 440',''),
('pre_0441', 'description', 'Pre-selection of patients for Measure 441',''),
('pre_0442', 'description', 'Pre-selection of patients for Measure 442',''),
('pre_0443', 'description', 'Pre-selection of patients for Measure 443',''),
('pre_0444', 'description', 'Pre-selection of patients for Measure 444',''),
('pre_0447', 'description', 'Pre-selection of patients for Measure 447',''),
('pre_0448', 'description', 'Pre-selection of patients for Measure 448',''),
('pre_0449', 'description', 'Pre-selection of patients for Measure 449',''),
('pre_0450', 'description', 'Pre-selection of patients for Measure 450',''),
('pre_0452', 'description', 'Pre-selection of patients for Measure 452',''),
('pre_0453', 'description', 'Pre-selection of patients for Measure 453',''),
('pre_0454', 'description', 'Pre-selection of patients for Measure 454',''),
('pre_0455', 'description', 'Pre-selection of patients for Measure 455',''),
('pre_0456', 'description', 'Pre-selection of patients for Measure 456',''),
('pre_0457', 'description', 'Pre-selection of patients for Measure 457',''),


('hyper'            ,' description','Risk Factor: ADHD,Conduct Disorders, and Hyperkinetic Syndrome',''),
('alcohol'          ,' description','Risk Factor: Alcohol Use Disorders',''),
('anxious'          ,' description','Risk Factor: Anxiety Disorders',''),
('autistic'         ,' description','Risk Factor: Autism Spectrum Disorders',''),
('bipolar'          ,' description','Risk Factor: Bipolar Disorder',''),
('c_palsy'          ,' description','Risk Factor: Cerebral Palsy',''),
('c_fibrosis'       ,' description','Risk Factor: Cystic Fibrosis and Other Metabolic Developmental Disorders',''),
('depressed'        ,' description','Risk Factor: Depressive Disorders',''),
('drugs'            ,' description','Risk Factor: Drug Use Disorder',''),
('epilepsy'         ,' description','Risk Factor: Epilepsy',''),
('fibro_m'          ,' description','Risk Factor: Fibromyalgia, Chronic Pain and Fatigue',''),
('hiv'              ,' description','Risk Factor: Human Immunodeficiency Virus and/or Acquired  Immunodeficiency Syndrome (HIV/AIDS)',''),
('mental_dis'       ,' description','Risk Factor: Intellectual Disabilities and Related Conditions',''),
('learn_dis'        ,' description','Risk Factor: Learning Disabilities',''),
('leukemia_lymphoma',' description','Risk Factor: Leukemias and Lymphomas',''),
('liver'            ,' description','Risk Factor: Liver Disease, Cirrhosis and Other Liver Conditions (except Viral Hepatitis)',''),
('migraine'         ,' description','Risk Factor: Migraine and Chronic Headache',''),
('mobility'         ,' description','Risk Factor: Mobility Impairments',''),
('m_sclerosis'      ,' description','Risk Factor: Multiple Sclerosis and Transverse Myelitis',''),
('m_distrophy'      ,' description','Risk Factor: Muscular Dystrophy',''),
('obesity'          ,' description','Risk Factor: Obesity',''),
('dev_delay'        ,' description','Risk Factor: Developmental Delays',''),
('pvd'              ,' description','Risk Factor: Peripheral Vascular Disease (PVD)',''),
('personality_dis'  ,' description','Risk Factor: Personality Disorders',''),
('ptsd'             ,' description','Risk Factor: Post-Traumatic Stress Disorder (PTSD)',''),
('ulcer'            ,' description','Risk Factor: Pressure and Chronic Ulcers',''),
('schizo'           ,' description','Risk Factor: Schizophrenia',''),
('psycho'           ,' description','Risk Factor: Psychotic Disorders',''),
('blind'            ,' description','Risk Factor: Sensory - Blindness andVisual Impairment',''),
('deaf'             ,' description','Risk Factor: Sensory � Deafness and Hearing Impairment',''),
('spina_bif'        ,' description','Risk Factor: Spina Bifida and Other Congenital Anomalies of the Nervous System',''),
('spine_injury'     ,' description','Risk Factor: Spinal Cord Injury',''),
('tobacco'          ,' description','Risk Factor: Tobacco Use',''),
('brain_dam'        ,' description','Risk Factor: Traumatic Brain Injury and Nonpsychotic Mental Disorders due to Brain Damage',''),
('hepa'             ,' description','Risk Factor: Viral Hepatitis',''),


















('pre_0001', 'question', 'Patients who may qualify for Measure 001',''),
('pre_0007', 'question', 'Patients who may qualify for Measure 007',''),
('pre_0005', 'question', 'Patients who may qualify for Measure 005',''),
('pre_0024', 'question', 'Patients who may qualify for Measure 024',''),
('pre_0047', 'question', 'Patients who may qualify for Measure 047',''),
('pre_0048', 'question', 'Patients who may qualify for Measure 048',''),
('pre_0050', 'question', 'Patients who may qualify for Measure 050',''),
('pre_0052', 'question', 'Patients who may qualify for Measure 052',''),
('pre_0065', 'question', 'Patients who may qualify for Measure 065',''),
('pre_0066', 'question', 'Patients who may qualify for Measure 066',''),
('pre_0068', 'question', 'Patients who may qualify for Measure 068',''),
('pre_0099', 'question', 'Patients who may qualify for Measure 099',''),
('pre_0100', 'question', 'Patients who may qualify for Measure 100',''),
('pre_0102', 'question', 'Patients who may qualify for Measure 102',''),
('pre_0104', 'question', 'Patients who may qualify for Measure 104',''),
('pre_0111', 'question', 'Patients who may qualify for Measure 111',''),
('pre_0112', 'question', 'Patients who may qualify for Measure 112',''),
('pre_0113', 'question', 'Patients who may qualify for Measure 113',''),
('pre_0116', 'question', 'Patients who may qualify for Measure 116',''),
('pre_0117', 'question', 'Patients who may qualify for Measure 117',''),
('pre_0118', 'question', 'Patients who may qualify for Measure 118',''),
('pre_0119', 'question', 'Patients who may qualify for Measure 119',''),
('pre_0128', 'question', 'Patients who may qualify for Measure 128',''),
('pre_0134', 'question', 'Patients who may qualify for Measure 134',''),
('pre_0146', 'question', 'Patients who may qualify for Measure 146',''),
('pre_0154', 'question', 'Patients who may qualify for Measure 154',''),
('pre_0155', 'question', 'Patients who may qualify for Measure 155',''),
('pre_0167', 'question', 'Patients who may qualify for Measure 167',''),
('pre_0176', 'question', 'Patients who may qualify for Measure 176',''),
('pre_0204', 'question', 'Patients who may qualify for Measure 204',''),
('pre_0205', 'question', 'Patients who may qualify for Measure 205',''),
('pre_0217', 'question', 'Patients who may qualify for Measure 217',''),
('pre_0218', 'question', 'Patients who may qualify for Measure 218',''),
('pre_0219', 'question', 'Patients who may qualify for Measure 219',''),
('pre_0220', 'question', 'Patients who may qualify for Measure 220',''),
('pre_0221', 'question', 'Patients who may qualify for Measure 221',''),
('pre_0222', 'question', 'Patients who may qualify for Measure 222',''),
('pre_0223', 'question', 'Patients who may qualify for Measure 223',''),
('pre_0224', 'question', 'Patients who may qualify for Measure 224',''),
('pre_0225', 'question', 'Patients who may qualify for Measure 225',''),
('pre_0236', 'question', 'Patients who may qualify for Measure 236',''),
('pre_0238', 'question', 'Patients who may qualify for Measure 238',''),
('pre_0249', 'question', 'Patients who may qualify for Measure 249',''),
('pre_0250', 'question', 'Patients who may qualify for Measure 250',''),
('pre_0251', 'question', 'Patients who may qualify for Measure 251',''),
('pre_0258', 'question', 'Patients who may qualify for Measure 258',''),
('pre_0259', 'question', 'Patients who may qualify for Measure 259',''),
('pre_0260', 'question', 'Patients who may qualify for Measure 260',''),
('pre_0262', 'question', 'Patients who may qualify for Measure 262',''),
('pre_0263', 'question', 'Patients who may qualify for Measure 263',''),
('pre_0264', 'question', 'Patients who may qualify for Measure 264',''),
('pre_0271', 'question', 'Patients who may qualify for Measure 271',''),
('pre_0278', 'question', 'Patients who may qualify for Measure 278',''),
('pre_0279', 'question', 'Patients who may qualify for Measure 279',''),
('pre_0326', 'question', 'Patients who may qualify for Measure 326',''),
('pre_0327', 'question', 'Patients who may qualify for Measure 327',''),
('pre_0329', 'question', 'Patients who may qualify for Measure 329',''),
('pre_0330', 'question', 'Patients who may qualify for Measure 330',''),
('pre_0332', 'question', 'Patients who may qualify for Measure 332',''),
('pre_0337', 'question', 'Patients who may qualify for Measure 337',''),
('pre_0340', 'question', 'Patients who may qualify for Measure 340',''),
('pre_0344', 'question', 'Patients who may qualify for Measure 344',''),
('pre_0345', 'question', 'Patients who may qualify for Measure 345',''),
('pre_0346', 'question', 'Patients who may qualify for Measure 346',''),
('pre_0347', 'question', 'Patients who may qualify for Measure 347',''),
('pre_0348', 'question', 'Patients who may qualify for Measure 348',''),
('pre_0358', 'question', 'Patients who may qualify for Measure 358',''),
('pre_0364', 'question', 'Patients who may qualify for Measure 364',''),
('pre_0370', 'question', 'Patients who may qualify for Measure 370',''),
('pre_0384', 'question', 'Patients who may qualify for Measure 384',''),
('pre_0385', 'question', 'Patients who may qualify for Measure 385',''),
('pre_0386', 'question', 'Patients who may qualify for Measure 386',''),
('pre_0388', 'question', 'Patients who may qualify for Measure 388',''),
('pre_0391', 'question', 'Patients who may qualify for Measure 391',''),
('pre_0394', 'question', 'Patients who may qualify for Measure 394',''),
('pre_0395', 'question', 'Patients who may qualify for Measure 395',''),
('pre_0396', 'question', 'Patients who may qualify for Measure 396',''),
('pre_0397', 'question', 'Patients who may qualify for Measure 397',''),
('pre_0403', 'question', 'Patients who may qualify for Measure 403',''),
('pre_0404', 'question', 'Patients who may qualify for Measure 404',''),
('pre_0405', 'question', 'Patients who may qualify for Measure 405',''),
('pre_0406', 'question', 'Patients who may qualify for Measure 406',''),
('pre_0408', 'question', 'Patients who may qualify for Measure 408',''),
('pre_0410', 'question', 'Patients who may qualify for Measure 410',''),
('pre_0411', 'question', 'Patients who may qualify for Measure 411',''),
('pre_0412', 'question', 'Patients who may qualify for Measure 412',''),
('pre_0413', 'question', 'Patients who may qualify for Measure 413',''),
('pre_0414', 'question', 'Patients who may qualify for Measure 414',''),
('pre_0415', 'question', 'Patients who may qualify for Measure 415',''),
('pre_0416', 'question', 'Patients who may qualify for Measure 416',''),
('pre_0417', 'question', 'Patients who may qualify for Measure 417',''),
('pre_0418', 'question', 'Patients who may qualify for Measure 418',''),
('pre_0419', 'question', 'Patients who may qualify for Measure 419',''),
('pre_0421', 'question', 'Patients who may qualify for Measure 421',''),
('pre_0424', 'question', 'Patients who may qualify for Measure 424',''),
('pre_0425', 'question', 'Patients who may qualify for Measure 425',''),
('pre_0426', 'question', 'Patients who may qualify for Measure 426',''),
('pre_0427', 'question', 'Patients who may qualify for Measure 427',''),
('pre_0429', 'question', 'Patients who may qualify for Measure 429',''),
('pre_0430', 'question', 'Patients who may qualify for Measure 430',''),
('pre_0437', 'question', 'Patients who may qualify for Measure 437',''),
('pre_0438', 'question', 'Patients who may qualify for Measure 438',''),
('pre_0440', 'question', 'Patients who may qualify for Measure 440',''),
('pre_0441', 'question', 'Patients who may qualify for Measure 441',''),
('pre_0442', 'question', 'Patients who may qualify for Measure 442',''),
('pre_0443', 'question', 'Patients who may qualify for Measure 443',''),
('pre_0444', 'question', 'Patients who may qualify for Measure 444',''),
('pre_0447', 'question', 'Patients who may qualify for Measure 447',''),
('pre_0448', 'question', 'Patients who may qualify for Measure 448',''),
('pre_0449', 'question', 'Patients who may qualify for Measure 449',''),
('pre_0450', 'question', 'Patients who may qualify for Measure 450',''),
('pre_0452', 'question', 'Patients who may qualify for Measure 452',''),
('pre_0453', 'question', 'Patients who may qualify for Measure 453',''),
('pre_0454', 'question', 'Patients who may qualify for Measure 454',''),
('pre_0455', 'question', 'Patients who may qualify for Measure 455',''),
('pre_0456', 'question', 'Patients who may qualify for Measure 456',''),
('pre_0457', 'question', 'Patients who may qualify for Measure 457',''),

('pre_0001', 'answer', '1|Exclude patients with G9687|G9687',9),

('pre_0005', 'answer', '1|Include patients with 3021F|3021F',9),

('pre_0007', 'answer', '1|Include patients with G8694|G8694',9),

('pre_0024', 'answer', '1|Exclude patients with G9688|G9688',9),
('pre_0047', 'answer', '1|Exclude patients with G9692|G9692',9),
('pre_0048', 'answer', '1|Exclude patients with G9692|G9692',9),
('pre_0050', 'answer', '1|Exclude patients with G9694|G9694',9),
('pre_0052', 'answer', '1|Include patients with G8924|G8924',9),

('pre_0065', 'answer', '1|Exclude patients with G8790|G8790',9),
('pre_0065', 'answer', '2|Exclude patients with G9701|G9701',9),
('pre_0065', 'answer', '3|Exclude patients with G9700|G9700',9),

('pre_0066', 'answer', '1|Exclude patients with G9702|G9702',9),
('pre_0066', 'answer', '2|Exclude patients with G9703|G9703',9),
('pre_0066', 'answer', '3|Include patients with G8711|G8711',9),

('pre_0068', 'answer', '1|Include patients with 4090F|4090F',9),
('pre_0099', 'answer', '1|Exclude patients with 3250F|3250F',9),
('pre_0100', 'answer', '1|Exclude patients with G8723|G8723',9),
('pre_0102', 'answer', '1|Include patients with G9706|G9706',9),
('pre_0104', 'answer', '1|Include patients with G8465|G8465',9),

('pre_0111', 'answer', '1|Exclude patients with G9707|G9707',9),

('pre_0112', 'answer', '1|Exclude patients with G9708|G9708',9),
('pre_0112', 'answer', '2|Exclude patients with G9709|G9709',9),

('pre_0113', 'answer', '1|Exclude patients with G8711|G8711',9),
('pre_0113', 'answer', '2|Exclude patients with G9710|G9710',9),

('pre_0116', 'answer', '1|Exclude patients with G9712|G9712',9),
('pre_0116', 'answer', '2|Exclude patients with G9713|G9713',9),
('pre_0116', 'answer', '3|Exclude INPATIENT ADMISSION|G9713',9),

('pre_0117', 'answer', '1|Exclude Hospice patients G9714|G9714',9),
('pre_0118', 'answer', '1|Include patients with G8934|G8934',9),

('pre_0119', 'answer', '1|Exclude Hospice patients G9715|G9715',9),

('pre_0128', 'answer', '1|Exclude patients with G8422|G8422',9),
('pre_0128', 'answer', '2|Exclude patients with G8938|G8938',9),

('pre_0134', 'answer', '1|Exclude Hospice patients G9717|G9717',9),

('pre_0146', 'answer', '1|Include patients with 77067|77067',9),
('pre_0146', 'answer', '2|Include patients with G0202|G0202',9),

('pre_0154', 'answer', '1|Exclude Hospice patients G9718|G9718',9),
('pre_0154', 'answer', '2|Include patients with 1100F|1100F',9),

('pre_0155', 'answer', '1|Exclude Hospice patients G9720|G9720',9),
('pre_0155', 'answer', '2|Include patients with 1100F|1100F',9),

('pre_0167', 'answer', '1|Exclude patients with G9722|G9722',9),

('pre_0176', 'answer', '1|Include patients with 4195F|4195F',9),

('pre_0204', 'answer', '1|Exclude patients with G9723|G9723',9),
('pre_0204', 'answer', '2|Exclude patients with G9724|G9724',9),

('pre_0205', 'answer', '1|Exclude patients with G9725|G9725',9),

('pre_0217', 'answer', '1|Exclude patients with G8726|G8726',9),
('pre_0217', 'answer', '2|Exclude patients with G9727|G8726',9),

('pre_0218', 'answer', '1|Exclude patients with G8728|G8728',9),
('pre_0218', 'answer', '2|Exclude patients with G9729|G8729',9),

('pre_0219', 'answer', '1|Exclude patients with G8730|G8730',9),
('pre_0219', 'answer', '2|Exclude patients with G9731|G8731',9),

('pre_0220', 'answer', '1|Exclude patients with G8732|G8732',9),
('pre_0220', 'answer', '2|Exclude patients with G9733|G8733',9),

('pre_0221', 'answer', '1|Exclude patients with G8734|G8734',9),
('pre_0221', 'answer', '2|Exclude patients with G9735|G8735',9),

('pre_0222', 'answer', '1|Exclude patients with G8736|G8736',9),
('pre_0222', 'answer', '2|Exclude patients with G9737|G8737',9),

('pre_0223', 'answer', '1|Exclude patients with G8738|G8738',9),
('pre_0223', 'answer', '2|Exclude patients with G9739|G8739',9),

('pre_0224', 'answer', '1|Exclude patients with G8749|G8749',9),
('pre_0224', 'answer', '2|Exclude patients with G8944|G8944',9),

('pre_0225', 'answer', '1|Include patients with 77067|77067',9),
('pre_0225', 'answer', '2|OR Include patients with G0202|G0202',9),

('pre_0236', 'answer', '1|Exclude patients with G9740|G9740',9),
('pre_0236', 'answer', '2|Exclude patients with G9231|G9231',9),

('pre_0238', 'answer', '1|Exclude patients with G9741|G9741',9),

('pre_0249', 'answer', '1|Exclude patients with G8797|G8797',9),

('pre_0250', 'answer', '1|Exclude patients with G8798|G8798',9),

('pre_0251', 'answer', '1|Include patients with Eval Performed 3395F|3395F',9),

('pre_0258', 'answer', '1|Exclude ANY patients with 9004F|9004F',9),
('pre_0258', 'answer', '2|Exclude FEMALE patients with 9003F|9003F',9),

('pre_0259', 'answer', '1|Exclude ANY patients with 9004F|9004F',9),
('pre_0259', 'answer', '2|Exclude FEMALE patients with 9003F|9003F',9),

('pre_0260', 'answer', '1|Exclude patients with 9006F|9006F',9),
('pre_0260', 'answer', '2|Exclude patients with 9007F|9007F',9),

('pre_0262', 'answer', '1|Exclude patients with G8873|G8873',9),

('pre_0263', 'answer', '1|Exclude patients with G8946|G8946',9),

('pre_0264', 'answer', '1|Include patients with G8879|G8879',9),

('pre_0271', 'answer', '1|Include patients with G9469|G9469',9),

('pre_0278', 'answer', '1|Include patients with G8846|G8846',9),

('pre_0279', 'answer', '1|Include patients with G8852|G8852',9),

('pre_0326', 'answer', '1|Exclude patients with G9746|G9746',9),
('pre_0326', 'answer', '2|Include patients with G8972|G8972',9),

('pre_0327', 'answer', '1|Include patients with G8958|G8958',9),

('pre_0329', 'answer', '1|Exclude patients with G9747|G9747',9),
('pre_0329', 'answer', '2|Exclude patients with G9748|G9748',9),

('pre_0330', 'answer', '1|Exclude patients with G9749|G9749',9),
('pre_0330', 'answer', '2|Exclude patients with G9750|G9750',9),
('pre_0330', 'answer', '3|Include patients with G9240|G9240',9),

('pre_0332', 'answer', '1|Include patients with G9364 and G9498|G9364 G9498',9),

('pre_0337', 'answer', '1|Include patients with G9506|G9506',9),

('pre_0340', 'answer', '1|Exclude patients with G9751|G9751',9),

('pre_0344', 'answer', '1|Exclude patients with 9006F|9006F',9),
('pre_0344', 'answer', '2|Exclude patients with 9007F|9007F',9),

('pre_0345', 'answer', '1|Exclude patients with 9006F|9006F',9),
('pre_0345', 'answer', '2|Exclude patients with 9007F|9007F',9),

('pre_0346', 'answer', '1|Exclude patients with 9006F|9006F',9),
('pre_0346', 'answer', '2|Exclude patients with 9007F|9007F',9),

('pre_0347', 'answer', '1|Exclude ANY patients with 9004F|9004F',9),
('pre_0347', 'answer', '2|Exclude FEMALE patients with 9003F|9003F',9),

('pre_0348', 'answer', '1|Exclude patients with removed I.C.D.|0JPT0PZ',9),

('pre_0358', 'answer', '1|Exclude patients with G9752|G9752',9),

('pre_0364', 'answer', '1|Include patients with G9754|G9754',9),

('pre_0370', 'answer', '1|Include patients with G9511|G9511',9),

('pre_0384', 'answer', '1|Exclude patients with G9756|G9756',9),

('pre_0385', 'answer', '1|Exclude patients with G9756|G9756',9),

('pre_0386', 'answer', '1|Exclude patients with G9758|G9758',9),

('pre_0388', 'answer', '1|Exclude patients with G9759|G9759',9),

('pre_0391', 'answer', '1|Exclude patients with G9760|G9760',9),

('pre_0394', 'answer', '1|Exclude patients with G9761|G9761',9),

('pre_0395', 'answer', '1|Exclude patients with G9420|G9420',9),

('pre_0396', 'answer', '1|Exclude patients with G9424|G9424',9),

('pre_0397', 'answer', '1|Exclude patients with G9430|G9430',9),

('pre_0403', 'answer', '1|Include patients with G9523|G9523',9),

('pre_0404', 'answer', '1|Include patients with G9642 and G9643 and G9497|G9642 G9643 G9497',9),

('pre_0405', 'answer', '1|Include patients with G9547|G9547',9),

('pre_0406', 'answer', '1|Include patients with G9552|G9552',9),

('pre_0408', 'answer', '1|Include patients with G9561|G9561',9),

('pre_0410', 'answer', '1|Include patients with G9764|G9764',9),

('pre_0411', 'answer', '1|Include patients with G9511|G9511',9),

('pre_0412', 'answer', '1|Include patients with G9577|G9577',9),

('pre_0413', 'answer', '1|Exclude patients with G9766|G9766',9),
('pre_0413', 'answer', '2|Exclude patients with G9767|G9767',9),

('pre_0414', 'answer', '1|Include patients with G9583|G9583',9),

('pre_0415', 'answer', '1|Exclude patients with G9531|G9531',9),
('pre_0415', 'answer', '2|Include patients with G9530|G9530',9),

('pre_0416', 'answer', '1|Exclude patients with G9595|G9595',9),
('pre_0416', 'answer', '2|Include patients with G9594|G9594',9),

('pre_0417', 'answer', '1|Exclude patient with 9004F or G9600|9004F G9600',9),
('pre_0417', 'answer', '2|Exclude FEMALE patient with 9003F|9003F G9600',9),

('pre_0418', 'answer', '1|Exclude patients with G9768|G9768',9),
('pre_0418', 'answer', '2|Exclude patients with G9769|G9769',9),

('pre_0419', 'answer', '1|Include patients with G9535|G9535',9),

('pre_0421', 'answer', '1|Include patients with G9539 and G9540|G9539 G9540',9),

('pre_0424', 'answer', '1|Exclude patients with G9654|G9654',9),
('pre_0424', 'answer', '2|Exclude patients with G9770|G9770',9),
('pre_0424', 'answer', '3|Include patients with 4255F|4255F',9),

('pre_0425', 'answer', '1|Exclude patients with G9613|G9613',9),

('pre_0426', 'answer', '1|Include patients with G9656|G9656',9),

('pre_0427', 'answer', '1|Include patients with 0581F|0581F',9),

('pre_0429', 'answer', '1|Exclude patients with G9774|G9774',9),

('pre_0430', 'answer', '1|Include patients with 4554F and 4556F|4554F 4556F',9),

('pre_0437', 'answer', '1|Exclude patients with G9640|G9640',9),

('pre_0438', 'answer', '1|Exclude patients with G9778|G9778',9),
('pre_0438', 'answer', '2|Exclude patients with G9779|G9779',9),
('pre_0438', 'answer', '3|Exclude patients with G9780|G9780',9),
('pre_0438', 'answer', '4|Include patients with G9662|G9662',9),
('pre_0438', 'answer', '5|Include patients with G9663|G9663',9),
('pre_0438', 'answer', '6|Include patients with G9782|G9782',9),
('pre_0438', 'answer', '7|Include patients with G9666|G9666',9),

('pre_0440', 'answer', '1|Exclude patients with G9748|G9748',9),

('pre_0441', 'answer', '1|Include patients with G8787|G8787',9),

('pre_0442', 'answer', '1|Exclude patients with G9799|G9799',9),
('pre_0442', 'answer', '2|Exclude patients with G9800|G9800',9),
('pre_0442', 'answer', '3|Exclude patients with G9801|G9801',9),
('pre_0442', 'answer', '4|Exclude patients with G9802|G9802',9),
('pre_0442', 'answer', '5|Include patients with G9798|G9798',9),
                                                                  
('pre_0443', 'answer', '1|Exclude patients with G9805|G9805',9),

('pre_0444', 'answer', '1|Exclude patients with G9808|G9808',9),
('pre_0444', 'answer', '2|Exclude patients with G9809|G9809',9),

('pre_0447', 'answer', '1|Include patients with G9818|G9818',9),

('pre_0448', 'answer', '1|Exclude patients with G9822|G9822',9),

('pre_0449', 'answer', '1|Exclude patients with G9826|G9826',9),
('pre_0449', 'answer', '2|Include patients with G9825|G9825',9),

('pre_0450', 'answer', '1|Exclude patients with G9833|G9833',9),
('pre_0450', 'answer', '2|Exclude patients with G9834|G9834',9),
('pre_0450', 'answer', '3|Include patients with G9829 and G9830|G9830 G9829',9),
('pre_0450', 'answer', '4|Include patients with G9829 and G9831|G9831 G9829',9),
('pre_0450', 'answer', '5|Include patients with G9829 and G9832|G9832 G9829',9),

('pre_0452', 'answer', '1|Include patients with G9842 and G9843|G9842 G9843',9),

('pre_0453', 'answer', '1|Include patients with G9846|G9846',9),

('pre_0454', 'answer', '1|Include patients with G9849|G9849',9),

('pre_0455', 'answer', '1|Include patients with G9852|G9852',9),

('pre_0456', 'answer', '1|Include patients with G9855|G9855',9),

('pre_0457', 'answer', '1|Include patients with G9858 and G9859|G9858 G9859',9),

('PQRS_0XXX', 'question', 'Please see measure documentation for specifics.',''),









('end', 'blank', '','' );";
sqlStatementNoLog($query);


?>

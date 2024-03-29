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
('PQRS_0001', 'description', 'Diabetes: Hemoglobin A1C Poor Control <br>INVERSE MEASURE',''),
('PQRS_0001', 'question', 'What was the patient\'s most recent hemoglobin A1c (HbA1c) level?',''),
('PQRS_0001', 'answer', '1|A1c (HbA1c) level < 7.0% (3044F)|3044F',9),
('PQRS_0001', 'answer', '2|A1c (HbA1c) level 7.0 to 9.0% (3045F)|3045F',9),
('PQRS_0001', 'answer', '3|A1c level > 9.0% (3046F)|3046F',1),
('PQRS_0001', 'answer', '4|A1c check not performed during period (3046F:8P)|3046F:8P',1),

('PQRS_0005', 'description', 'Heart Failure: Angiotensin-Converting Enzyme (ACE) Inhibitor or Angiotensin Receptor Blocker Therapy for Left Ventricular Systolic Dysfunction (LVEF < 40%)',''),
('PQRS_0005', 'question', 'Was the patient prescribed an ACE inhibitor or ARB therapy for LVSD within a 12 month period when seen in the outpatient setting OR at hospital discharge?',''),
('PQRS_0005', 'answer', '1|ACE Inhibitor or ARB therapy prescribed or currently being taken (4010F)|4010F',1),
('PQRS_0005', 'answer', '2|Documentation of medical reason(s) for not prescribing ACE inhibitor or ARB therapy (4010F:1P)|4010F:1P',2),
('PQRS_0005', 'answer', '3|Documentation of patient reason(s) for not prescribing ACE inhibitor or ARB therapy (eg, patient declined) (4010F:2P)|4010F:2P',2),
('PQRS_0005', 'answer', '4|Documentation of system reason(s) for not prescribing ACE inhibitor or ARB therapy (4010F:3P)|4010F:3P',2),
('PQRS_0005', 'answer', '5|ACE inhibitor or ARB therapy was not prescribed, reason not given (4010F:8P)|4010F:8P',9),

('PQRS_0006', 'description', 'Coronary Artery Disease (CAD): Antiplatelet Therapy',''),
('PQRS_0006', 'question', 'Was patient prescribed or already taking aspirin or clopidogrel?',''),
('PQRS_0006', 'answer', '1|Aspirin or clopidogrel prescribed or listed as a current medication in the medication list (4068F)|4086F',1),
('PQRS_0006', 'answer', '2|Documentation of medical reason(s) for not prescribing aspirin or clopidogrel (4086F:1P)|4086F:1P',2),
('PQRS_0006', 'answer', '3|Documentation of patient reason(s) for not prescribing aspirin or clopidogrel (4086F:2P)|4086F:2P',2),
('PQRS_0006', 'answer', '4|Documentation of system reason(s) for not prescribing aspirin or clopidogrel (4086F:3P)|4086F:3P',2),
('PQRS_0006', 'answer', '5|Aspirin or clopidogrel was not prescribed, reason not given (4086F:8P)|4086F:8P',9),

('PQRS_0007', 'description', 'Coronary Artery Disease (CAD): Beta-Blocker Therapy -- Prior Myocardial Infarction (MI) or Left Ventricular Systolic Dysfunction (LVEF < 40%)',''),
('PQRS_0007', 'question', 'Was patient prescribed beta-blocker therapy?',''),
('PQRS_0007', 'answer', '1|Beta-blocker therapy prescribed or currently being taken (G9189)|G9189',1),
('PQRS_0007', 'answer', '2|Documentation of medical reason(s) for not prescribing beta-blocker therapy (G9190)|G9190',2),
('PQRS_0007', 'answer', '3|Documentation of patient reason(s) for not prescribing beta-blocker therapy (G9191)|G9191',2),
('PQRS_0007', 'answer', '4|Documentation of system reason(s) for not prescribing beta-blocker therapy (G9192)|G9192',2),
('PQRS_0007', 'answer', '5|Beta-blocker therapy not prescribed, reason not given (G9188)|G9188',9),

('PQRS_0008', 'description', 'Heart Failure (HF): Beta-Blocker Therapy for Left Ventricular Systolic Dysfunction (LVSD)',''),
('PQRS_0008', 'question', 'Was the patient prescribed beta-blocker therapy within a 12 month period, when seen in the outpatient setting or at each hospital discharge?',''),
('PQRS_0008', 'answer', '1|Beta-blocker therapy prescribed (G8450)|G8450',1),
('PQRS_0008', 'answer', '2|Beta-Blocker Therapy for LVEF < 40% not prescribed for reasons documented by the clinician (G8451)|G8451',2),
('PQRS_0008', 'answer', '3|Beta-blocker therapy not prescribed (G8452)|G8452',9),

('PQRS_0012', 'description', 'Primary Open-Angle Glaucoma (POAG): Optic Nerve Evaluation',''),
('PQRS_0012', 'question', 'Did the patient have an optic nerve head evaluation during one or more office visits within 12 months?',''),
('PQRS_0012', 'answer', '1|Optic nerve head evaluation performed (2027F)|2027F',1),
('PQRS_0012', 'answer', '2|Documentation of medical reason(s) for not performing an optic nerve head evaluation (2027F:1P)|2027F:1P',2),
('PQRS_0012', 'answer', '3|Optic nerve head evaluation was not performed, reason not given (2027F:8P)|2027F:8P',9),

('PQRS_0014', 'description', 'Age-Related Macular Degeneration (AMD): Dilated Macular Examination ',''),
('PQRS_0014', 'question', 'Did the patient have a dilated macular examination performed during one or more office visits within 12 months?',''),
('PQRS_0014', 'answer', '1|Dilated macular exam performed (G9974)|G9974',1),
('PQRS_0014', 'answer', '2|Documentation of medical reason(s) for not performing a dilated macular examination (G9975)|G9975',2),
('PQRS_0014', 'answer', '3|Documentation of patient reason(s) for not performing a dilated macular examination(G9892)|G9892',2),
('PQRS_0014', 'answer', '4|Dilated macular exam was not performed, reason not given (G9893)|G9893',9),

('PQRS_0019', 'description', 'Diabetic Retinopathy: Communication with the Physician Managing Ongoing Diabetes Care ',''),
('PQRS_0019', 'question', 'Is there documentation of the findings from a dilated macular or fundus exam provided at least once within 12 months? ',''),
('PQRS_0019', 'answer', '1|Findings of dilated macular or fundus exam communicated to the qualified health care professional managing the diabetes care (5010F G8397)|5010F G8397',1),
('PQRS_0019', 'answer', '2|Documentation of medical reason(s) for not communicating the findings of the dilated macular or fundus exam to the health care professional managing the diabetes care (5010:1P G8397)|5010F:1P G8397',2),
('PQRS_0019', 'answer', '3|Documentation of patient reason(s) for not communicating the findings of the dilated macular or fundus exam to the health care professional managing the diabetes care (5010F:2P G8397)|5010F:2P G8397',2),
('PQRS_0019', 'answer', '4|Findings of dilated macular or fundus exam were not communicated to the health care professional managing the diabetes care, reason not given(5010F:8P G8397)|5010F:8P G8397',9),

('PQRS_0021', 'description', 'Perioperative Care: Selection of Prophylactic Antibiotic -- First OR Second Generation Cephalosporin ',''),
('PQRS_0021', 'question', 'Did this surgical patient have an order for a first OR second generation cephalosporin for antimicrobial prophylaxis? ',''),
('PQRS_0021', 'answer', '1|Documentation of order for first or second generation cephalosporin for antimicrobial prophylaxis (G9197)|G9197',1),
('PQRS_0021', 'answer', '2|Documentation of medical reason(s) for not ordering a first OR second generation cephalosporin for antimicrobial prophylaxis (G9196)|G9196',2),
('PQRS_0021', 'answer', '3|Order for first OR second generation cephalosporin for antimicrobial prophylaxis was not documented, reason not given (G9198)|G9198',9),

('PQRS_0023', 'description', 'Perioperative Care: Venous Thromboembolism (VTE) Prophylaxis ',''),
('PQRS_0023', 'quesion', 'Did this surgical patient have an order for LMWH, LDUH, adjusted-dose warfarin, fondaparinux or mechanical prophylaxis to be given within 24 hours prior to incision time or within 24 hours after surgery end time? ',''),
('PQRS_0023', 'answer', '1|Documentation that an order was given for venous thromboembolism (VTE) prophylaxis to be given within 24 hours prior to incision time or 24 hours after surgery end time (4044F)|4044F',1),
('PQRS_0023', 'answer', '2|VTE prophylaxis not ordered for medical reasons (4044F:1P)|4044F:1P',2),
('PQRS_0023', 'answer', '3|VTE prophylaxis not ordered, reason not given (4044F:8P)|4044F:8P',9),

('PQRS_0024', 'description', 'Communication with the Clinician Managing On-going Care Post-Fracture for Men and Women Aged 50 Years and Older ',''),
('PQRS_0024', 'question', 'Is there documentation of communication with the clinician managing the patient\'s on-going care that a fracture occurred and that the patient was or should be considered for osteoporosis testing or treatment? ',''),
('PQRS_0024', 'answer', '1|Documentation of communication that a fracture occured and the patient was or should be tested or treated for osteoprosis (5015F)|5015F',1),
('PQRS_0024', 'answer', '2|No documentation of communication that a fracture occured and the patient was or should be tested or treated for osteoprosis, Reason not given (5015F:8P)|5015F:8P',9),

('PQRS_0039', 'description', 'Screening for Osteoporosis for Women Aged 65-85 Years of Age',''),
('PQRS_0039', 'question', 'Is there documentation in the patient medical record of ever having received a DXA test of the hip or spine?',''),
('PQRS_0039', 'answer', '1|Central DXA results documented (G8399)|G8399',1),
('PQRS_0039', 'answer', '2|Central DXA results not documented, reason not given (G8400)|G8400',9),

('PQRS_0044', 'description', 'Coronary Artery Bypass Graft (CABG): Preoperative Beta-Blocker in Patients with Isolated CABG Surgery',''),
('PQRS_0044', 'question', 'Did patient received a beta-blocker within 24 hours prior to surgical incision? ',''),
('PQRS_0044', 'answer', '1|Beta blocker administered within 24 hours prior to surgical incision (4115F)|4115F',1),
('PQRS_0044', 'answer', '2|Documentation of medical reason(s) for not administering beta blocker within 24 hours prior to surgical incision (4115F:1P)|4115F:1P',2),
('PQRS_0044', 'answer', '3|Beta blocker not administered within 24 hours prior to surgical incision, reason not given (4115F:8P)|4115F:8P',9),

('PQRS_0046', 'description', 'Medication Reconciliation Post-Discharge',''),
('PQRS_0046', 'question', 'Was medication reconciliation conducted by a prescribing practitioner, clinical pharmacist or registered nurse on or within 30 days of discharge from an inpatient facility? ',''),
('PQRS_0046', 'answer', '1|Discharge medications reconciled with the current medication list in the outpatient medical record (1111F)|1111F',1),
('PQRS_0046', 'answer', '2|Discharge medication not reconciled with the current medication list in the outpatient medical record, reason not given (1111F:8P)|(1111F:8P',9),

('PQRS_0047', 'description', 'Advance Care Plan',''),
('PQRS_0047', 'question', 'Was an Advance Care Planning discussed and documented with the patient or their surrogate?',''),
('PQRS_0047', 'answer', '1|Advance Care Planning discussed and documented; advance care plan or surrogate decision maker documented in the medical record (1123F)|1123F',1),
('PQRS_0047', 'answer', '2|Advance Care Planning discussed and documented in the medical record; patient did not wish or was not able to name a surrogate decision maker or provide an advance care plan (1124F)|1124F',1),
('PQRS_0047', 'answer', '3|Advance care planning not documented, reason not otherwise specified (1123F:8P)|1123F:8P',9),

('PQRS_0048', 'description', 'Percentage of female patients, aged 65 years and older, who were assessed for the presence or absence of urinary incontinence within 12 months',''),
('PQRS_0048', 'question', 'Was the patient assessed for the presence or absence of urinary incontinence within 12 months?',''),
('PQRS_0048', 'answer', '1|Presence or absence of urinary incontinence assessed (1090F)|1090F',1),
('PQRS_0048', 'answer', '2|Presence or absence of urinary incontinence not assessed, reason not otherwise specified (1090F:8P)|1090F:8P',9),

('PQRS_0050', 'description', 'Incontinence: Plan of Care for Urinary Incontinence in Women Aged 65 Years and Older',''),
('PQRS_0050', 'question', 'Does the patient have a documented plan of care for urinary incontinence at least once within 12 months?',''),
('PQRS_0050', 'answer', '1|Plan of Care for Urinary Incontinence Documented (0509F)|0509F',1),
('PQRS_0050', 'answer', '2|Plan of Care for Urinary Incontinence not Documented, Reason not Otherwise Specified (0509F:8P)|0509F:8P',9),

('PQRS_0051', 'description', 'Chronic Obstructive Pulmonary Disease (COPD): Spirometry Evaluation',''),
('PQRS_0051', 'question', 'Does the patients have spirometry results documented in the medical record (FEV1 and FEV1/FVC)?',''), 
('PQRS_0051', 'answer', '1|Spirometry Results Documented and reviewed (3023F)|3023F',1),
('PQRS_0051', 'answer', '2|Spirometry Results not Documented for Medical Reasons (3023F:1P)|3023F:1P',2),
('PQRS_0051', 'answer', '3|Spirometry Results not Documented for Patient Reasons (3023F:2P)|3023F:2P',2),
('PQRS_0051', 'answer', '4|Spirometry Results not Documented for System Reasons (3023F:3P)|3023F:3P',2),
('PQRS_0051', 'answer', '5|Spirometry Results not Documented, Reason not Otherwise Specified (3023F:8P)|3023F:8P',9),

('PQRS_0052', 'description', 'Chronic Obstructive Pulmonary Disease (COPD): Inhaled Bronchodilator Therapy',''),
('PQRS_0052', 'question', 'Was the patient prescribed an inhaled bronchodilator?',''),
('PQRS_0052', 'answer', '1|Long-acting inhaled bronchodilator prescribed (G9695 )|G9695 4025F G8924',1),
('PQRS_0052', 'answer', '2|Documentation of medical reason(s) for not prescribing a long-acting inhaled bronchodilator (G9696)|G9696',2),
('PQRS_0052', 'answer', '3|Documentation of patient reason(s) for not prescribing a long-acting inhaled bronchodilator (G9697)|G9697',2),
('PQRS_0052', 'answer', '4|Documentation of system reason(s) for not prescribing a long-acting inhaled bronchodilator (G9698)|G9698',2),
('PQRS_0052', 'answer', '5|Long-acting inhaled bronchodilator not prescribed, reason not otherwise specified(G9699)|G9699',9),

('PQRS_0065', 'description', 'Appropriate Treatment for Children with Upper Respiratory Infection (URI)',''),
('PQRS_0065', 'question', 'Was an antibiotic prescribed or dispensed for the patient on or within 3 days after the initial outpatient or ED visit date for URI. (Appropriate treatment of patients with URI is to NOT prescribe treatment with antibiotics within first 3 days of an eligible encounter).',''),
('PQRS_0065', 'answer', '1|Patient NOT prescribed or dispensed antibiotic (G8708)|G8708',1),
('PQRS_0065', 'answer', '2|Patient prescribed or dispensed antibiotic (G8710)|G8710',9),

('PQRS_0066', 'description', 'Appropriate Testing for Children with Pharyngitis',''),
('PQRS_0066', 'question', 'Was a group A streptococcus test performed on the patient in the 7-day period from 3 days prior through 3 days after the pharyngitis episode date?',''),
('PQRS_0066', 'answer', '1|Group A Strep Test Performed (3210F)|3210F',1),
('PQRS_0066', 'answer', '2|Group A Strep Test not Performed, reason not otherwise specified (3210F:8P)|3210F:8P',9),

('PQRS_0067', 'description', 'Hematology: Myelodysplastic Syndrome (MDS) and Acute Leukemias: Baseline Cytogenetic Testing Performed on Bone Marrow',''),
('PQRS_0067', 'question', 'Did the patient have baseline cytogenetic testing performed on bone marrow at the time of diagnosis or prior to initiating treatment for MDS or acute leukemia?',''),
('PQRS_0067', 'answer', '1|Cytogenetic testing performed on bone marrow at time of diagnosis or prior to initiating treatment (3155F)|3155F',1),
('PQRS_0067', 'answer', '2|Documentation of Medical reason(s) for not performing cytogenic testing (3155F:1P)|3155F:1P',2),
('PQRS_0067', 'answer', '3|Documentation of patient reason(s) for not performing cytogenic testing (3155F:2P)|3155F:2P',2),
('PQRS_0067', 'answer', '4|Documentation of system reason(s) for not performing cytogenic testing (3155F:3P|3155F:3P',2),
('PQRS_0067', 'answer', '5|Cytogenetic testing not performed on bone marrow at time of diagnosis or prior to initiating treatment, reason not given (3155F with 8P)|3155F:8P',9),

('PQRS_0068', 'description', 'Hematology: Myelodysplastic Syndrome (MDS): Documentation of Iron Stores in Patients Receiving Erythropoietin Therapy',''),
('PQRS_0068', 'question', 'Did the patient have documentation of iron stores (via bone marrow exam or serum testing) within 60 days prior to initiating erythropoietin therapy?',''),
('PQRS_0068', 'answer', '1|Documentation of iron stores prior to initiating erythropoietin therapy (3160F)|3160F',1),
('PQRS_0068', 'answer', '2|Documentation of system reason(s) for not documenting iron stores prior to initiating erythropoietin therapy (3160F:3P)|3160F:3P',2),
('PQRS_0068', 'answer', '3|Iron stores not documented prior to initiating erythropoietin therapy, reason not given (3160F:8P)|3160F:8P',9),

('PQRS_0069', 'description', 'Hematology: Multiple Myeloma: Treatment with Bisphosphonates',''),
('PQRS_0069', 'question', 'Was the patient prescribed or did they receive intravenous bisphosphonate therapy within the 12 month reporting period?',''),
('PQRS_0069', 'answer', '1|Bisphosphonate therapy, intravenous, ordered or received (4100F)|4100F',1),
('PQRS_0069', 'answer', '2|Documentation of medical reason(s) for not prescribing bisphosphonates (4100F:1P)|4100F:1P',2),
('PQRS_0069', 'answer', '3|Documentation of patient reason(s) for not prescribing bisphosphonates (4100F with 2P)|4100F:2P',2),
('PQRS_0069', 'answer', '4|Bisphosphonate therapy, intravenous, not ordered or received, reason not given (4100F:8P)|4100F:8P',9),

('PQRS_0070', 'description', 'Hematology: Chronic Lymphocytic Leukemia (CLL): Baseline Flow Cytometry',''),
('PQRS_0070', 'question', 'Did the patient have baseline flow cytometry studies performed and documented in the chart?',''),
('PQRS_0070', 'answer', '1|Flow cytometry studies performed at the time of diagnosis or prior to initiating treatment (3170F)|3170F',1),
('PQRS_0070', 'answer', '2|Documentation of medical reason(s) for not performing baseline flow cytometry studies (3170F:1P)|3170F:1P',2),
('PQRS_0070', 'answer', '3|Documentation of patient reason(s) for not performing baseline flow cytometry studies (3170F:2P)|3170F:2P',2),
('PQRS_0070', 'answer', '4|Documentation of system reason(s) for not performing baseline flow cytometry studies (3170F:3P)|3170F:3P',2),
('PQRS_0070', 'answer', '5|Flow cytometry studies not performed at time of diagnosis or prior to initiating treatment, reason not given (3170F:8P)|3170F:8P',9),

('PQRS_0076', 'description', 'Prevention of Central Venous Catheter (CVC) - Related Bloodstream Infections',''),
('PQRS_0076', 'question', 'Was the central venous catheter (CVC) inserted utilizing all elements of maximal sterile barrier technique, hand hygiene, skin preparation and, if ultrasound used, were sterile ultrasound techniques followed?',''),
('PQRS_0076', 'answer', '1|All elements of maximal sterile technique followed (6030F)|6030F',1),
('PQRS_0076', 'answer', '2|Documention of medical reasons for NOT following all elements of maximal sterile technique (6030F:1P)|6030F:1P',2),
('PQRS_0076', 'answer', '3|All elements of maximal sterile technique not followed, reason not given (6030F:8P)|6030F:8P',9),

('PQRS_0091', 'description', 'Acute Otitis Externa (AOE): Topical Therapy',''),
('PQRS_0091', 'question', 'Was the patient prescribed a topical preparation for AOE?',''),
('PQRS_0091', 'answer', '1|Topical preparations (including OTC) prescribed for acute otitis externa (4130F)|4130F',1),
('PQRS_0091', 'answer', '2|Documentation of medical reason(s) for not prescribing topical preparations (including OTC) for AOE (4130F:1P)|4130F:1P',''),
('PQRS_0091', 'answer', '3|Documentation of patient reason(s) for not prescribing topical preparations (including OTC) for AOE (4130F:2P)|4130F:2P',2),
('PQRS_0091', 'answer', '4|Topical preparations (including OTC) for AOE not prescribed, reason not given (4130F:8P)|4130F:8P',''),

('PQRS_0093', 'description', 'Acute Otitis Externa (AOE): Systemic Antimicrobial Therapy -- Avoidance of Inappropriate Use',''),
('PQRS_0093', 'question', 'Was the patient prescribed systemic antimicrobial therapy?',''),
('PQRS_0093', 'answer', '1|Systemic Antimicrobial Therapy not Prescribed (4132F)|4132F',1),
('PQRS_0093', 'answer', '2|Documentation of medical reasons for prescribing systemic antimicrobial therapy (4131F:1P)|4131F:1P',2),
('PQRS_0093', 'answer', '3|Systemic Antimicrobial Therapy Prescribed (4131F)|4131F',9),

('PQRS_0102', 'description', 'Prostate Cancer: Avoidance of Overuse of Bone Scan for Staging Low Risk Prostate Cancer Patients',''),
('PQRS_0102', 'question', 'Did the patient with low risk prostate cancer have a bone scan performed at any time since diagnosis?',''),
('PQRS_0102', 'answer', '1|Bone scan not performed prior to initiation of treatment nor at any time since diagnosis of prostate cancer (3270F)|3270F',1),
('PQRS_0102', 'answer', '2|Documentation of medical reason(s) for performing a bone scan (3269F:1P)|3269F:1P',2),
('PQRS_0102', 'answer', '3|Documentation of system reason(s) for performing a bone scan (3269F:3P)|3269F:3P',2),
('PQRS_0102', 'answer', '4|Bone scan performed prior to initiation of treatment or at any time since diagnosis of prostate cancer (3269F)|3269F',9),

('PQRS_0104', 'description', 'Prostate Cancer: Combination Androgen Deprivation Therapy for High Risk or Very High Risk Prostate Cancer',''),
('PQRS_0104', 'question', 'Was the patient with high risk prostate cancer prescribed androgen deprivation therapy in combination with external beam radiotherapy?',''),
('PQRS_0104', 'answer', '1|Androgen deprivation therapy prescribed/administered in combination with beam radiotherapy to the prostate (G9894)|G9894',1),
('PQRS_0104', 'answer', '2|Documentation of medical reason(s) for not prescribing/administering androgen deprivation therapy/beam radiotherapy (G9895)|G9895',2),
('PQRS_0104', 'answer', '3|Documentation of patient reason(s) for not prescribing/administering androgen deprivation therapy/beam radiotherapy (G9896)|G9896',2),
('PQRS_0104', 'answer', '4|Androgen deprivation therapy in combination with external beam radiotherapy not prescribed/administered, reason not given (G9897)|G9897',9),

('PQRS_0109', 'description', 'Osteoarthritis (OA): Function and Pain Assessment',''),
('PQRS_0109', 'question', 'Was the patient assessed for level of function and pain?',''),
('PQRS_0109', 'answer', '1|Osteoarthritis pain symptoms and functional status assessed (1006F)|1006F',1),
('PQRS_0109', 'answer', '2|Osteoarthritis pain symptoms and functional status not assessed, reason not given (1006F:8P)|1006F:8P',9),

('PQRS_0110', 'description', 'Preventive Care and Screening: Influenza Immunization',''),
('PQRS_0110', 'question', 'Did the patient receive an influenza immunization OR report previous receipt of influenza immunization during the most recent flu season?',''),
('PQRS_0110', 'answer', '1|Influenza immunization administered (G8482)|G8482',1),
('PQRS_0110', 'answer', '2|Influenza immunization previously received (G8482)|G8482',1),
('PQRS_0110', 'answer', '3|Influenza immunization not administered for documented reasons (G8483)|G8483',2),
('PQRS_0110', 'answer', '4|Influenza immunization not administered, reason not given (G8484)|G8484',9),

('PQRS_0111', 'description', 'Pneumonia Vaccination Status for Older Adults',''),
('PQRS_0111', 'question', 'Has the patient ever received a PCV13 and/or PPSV23 pneumococcal vaccination?',''),
('PQRS_0111', 'answer', '1|Pneumococcal vaccination administered or previously received (4040F)|4040F',1),
('PQRS_0111', 'answer', '2|Pneumococcal vaccination not administered or previously received, reason not given (4040F:8P)|4040:8PF',9),

('PQRS_0112', 'description', 'Breast Cancer Screening',''),
('PQRS_0112', 'question', 'Did the patient have one or more screening, diagnostic, film or 3D mammograms performed and reviewed during the current reporting period or up to 15 months prior to the start of the reporting period?',''),
('PQRS_0112', 'answer', '1|Mammogram performed, results documented and reviewed (G9899)|G9899',1),
('PQRS_0112', 'answer', '2|Mammogram not performed/documented/reviewed, reason not given (G9900)|G9900',9),

('PQRS_0113', 'description', 'Colorectal Cancer Screening',''),
('PQRS_0113', 'question', 'Did the patient have one or more appropriate screenings for colorectal cancer?',''),
('PQRS_0113', 'answer', '1|Colorectal cancer screening performed, results documented and reviewed (3017F)|3017F',1),
('PQRS_0113', 'answer', '2|Colorectal cancer screening not performed, results not documented or reviewed, reason not given (3017F:8P)|3017F:8P',9),

('PQRS_0116', 'description', 'Avoidance of Antibiotic Treatment in Adults With Acute Bronchitis',''),
('PQRS_0116', 'question', 'Was the patient prescribed or dispensed antibiotics on or within 3 days of the initial date of outpatient or ED visit?',''),
('PQRS_0116', 'answer', '1|Antibiotic neither prescribed nor dispensed (4124F)|4124F',1),
('PQRS_0116', 'answer', '2|Antibiotic prescribed or dispensed (4120F)|4120F',9),

('PQRS_0117', 'description', 'Diabetes: Eye Exam',''),
('PQRS_0117', 'question', 'Does the patient have results of a dilated retinal eye exam OR a negative retinopathy result documented no more than 12 months prior to the reporting period?',''),
('PQRS_0117', 'answer', '1|Dilated retinal eye exam with interpretation by an ophthalmologist or optometrist documented and reviewed (2022F)|2022F',1),
('PQRS_0117', 'answer', '2|Seven standard- field stereoscopic photos with interpretation by an ophthalmologist or optometrist documented and reviewed (2024F)|2024F',1),
('PQRS_0117', 'answer', '3|Eye imaging validated to match diagnosis from seven standard field stereoscopic photos results documented and reviewed (2026F)|2026F',1),
('PQRS_0117', 'answer', '4|Low risk for retinopathy (no evidence of retinopathy in the prior year) (3072F)|3072F',1),
('PQRS_0117', 'answer', '5|Dilated retinal eye exam not performed, reason not given (2022F:8P)|2022F:8P',9),

('PQRS_0118', 'description', 'Coronary Artery Disease (CAD): Angiotensin-Converting Enzyme (ACE) Inhibitor or Angiotensin Receptor Blocker (ARB) Therapy - Diabetes or Left Ventricular Systolic Dysfunction (LVEF &lt; 40%)',''),
('PQRS_0118', 'question', 'Was the patient prescribed an ACE inhibitor or ARB therapy?',''),
('PQRS_0118', 'answer', '1|CAD with LVEF patient prescribed ACE inhibitor or ARB therapy (G8935)|G8935',1),
('PQRS_0118', 'answer', '2|Documention that the patient was not an eligible candidate for ACE inhibitor or ARB therapy (G8936)|G8936',2),
('PQRS_0118', 'answer', '3|Clinician did not prescribe ACE inhibitor or ARB therapy, reason not given (G8937)|G8937',''),
('PQRS_0118', 'answer', '4|CAD with Diabetes patient prescribed ACE inhibitor or ARB therapy (G8473)|G8473',1),
('PQRS_0118', 'answer', '5|Documentation that ACE inhibitor or ARB therapy not prescribed due to medical, patient or system reasons  (G8474)|G8474',2),
('PQRS_0118', 'answer', '6|ACE inhibitor or ARB therapy not prescribed, reason not given (G8475)|G8475',9),

('PQRS_0119', 'description', 'Diabetes: Medical Attention for Nephropathy',''),
('PQRS_0119', 'question', 'Did the patient receive screening for nephropathy or show evidence of nephropathy during the measurement period?',''),
('PQRS_0119', 'answer', '1|Positive microalbuminuria test result documented and reviewed (3060F)|3060F',1),
('PQRS_0119', 'answer', '2|Negative microalbuminuria test result documented and reviewed (3061F)|3061F',1),
('PQRS_0119', 'answer', '3|Positive macroalbuminuria test result documented and reviewed (3062F)|3062F',1),
('PQRS_0119', 'answer', '4|Documentation of treatment for nephropathy (3066F)|3066F',1),
('PQRS_0119', 'answer', '5|Patient receiving angiotensin converting enzyme (ACE) inhibitor or angiotensin receptor blocker (ARB) therapy (G8506)|G8506',1),
('PQRS_0119', 'answer', '6|Nephropathy screening was not performed, reason not given (3060F:8P)|3060F:8P',9),

('PQRS_0126', 'description', 'Diabetes Mellitus: Diabetic Foot and Ankle Care, Peripheral Neuropathy-- Neurological Evaluation',''),
('PQRS_0126', 'question', 'Was the patient provided with at least one lower extremity neurological exam within the past 12 months?',''),
('PQRS_0126', 'answer', '1|Lower extremity neurological exam performed and documented (G8404)|G8404',1),
('PQRS_0126', 'answer', '3|Lower extremity neurological exam was not performed (G8405)|G8405',9),

('PQRS_0127', 'description', 'Diabetes Mellitus: Diabetic Foot and Ankle Care, Ulcer Prevention -- Evaluation of Footwear',''),
('PQRS_0127', 'question', 'Was the patient evaluated for proper footwear and sizing at least once within 12 months?',''),
('PQRS_0127', 'answer', '1|Footwear evaluation performed and documented (G8410)|G8410',1),
('PQRS_0127', 'answer', '2|Clinician documented that the patient was not an eligible candidate for footwear evaluation (G8416)|G8416',2),
('PQRS_0127', 'answer', '3|Footwear evaluation was not performed (G8415)|G8415',9),

('PQRS_0128', 'description', 'Preventive Care and Screening: Body Mass Index (BMI) Screening and Follow-Up Plan',''),
('PQRS_0128', 'question', 'Does patient have a documented BMI during the encounter or during the previous twelve months, AND when the BMI is outside of normal parameters, is a follow-up plan documented during the encounter or during the previous twelve months?',''),
('PQRS_0128', 'answer', '1|BMI ddocumented as normal, no follow-up plan required (G8420)|G8420',1),
('PQRS_0128', 'answer', '2|BMI documented as above normal parameters, AND follow-up documented (G8417)|G8417',1),
('PQRS_0128', 'answer', '3|BMI documented as below normal parameters, AND follow-Up documented (G8418)|G8418',1),
('PQRS_0128', 'answer', '4|BMI is documented as being outside of normal limits, follow-up plan is not completed for documented reason(G9716)|G9716',2),
('PQRS_0128', 'answer', '5|BMI not documented, reason not Given (G8421)|G8421',9),
('PQRS_0128', 'answer', '6|BMI Documented Outside of Normal Parameters, Follow-Up Plan not Documented, Reason not Given (G8419)|G8419',9),

('PQRS_0130', 'description', 'Documentation of Current Medications in the Medical Record',''),
('PQRS_0130', 'question', 'Does the eligible clinician attest to documenting, updating or reviewing the patient\'s current medications using all immediate resources available on the date of encounter?',''),
('PQRS_0130', 'answer', '1|Eligible professional attests to documenting in the medical record they obtained, updated, or reviewed the patient\'s current medications (G8427)|G8427',1),
('PQRS_0130', 'answer', '2|Eligible professional attests to documenting in the medical record the patient is not eligible for a current list of medications being obtained, updated, or reviewed (G8430)|G8430',2),
('PQRS_0130', 'answer', '3|Current list of medications not documented as obtained, updated or reviewed, reason not given (G8428)|G8428',9),

('PQRS_0131', 'description', 'Pain Assessment and Follow-Up',''),
('PQRS_0131', 'question', 'Does the patient have documentation of a pain assessment using a standardized tool(s) AND documentation of a follow-up plan when pain is present?',''),
('PQRS_0131', 'answer', '1|Pain assessment documented as positive using a standradized tool AND a follow-up plan is documented (G8730)|G8730',1),
('PQRS_0131', 'answer', '2|Pain assessment documented as negative, no follow-up plan required (G8731)|G8731',1),
('PQRS_0131', 'answer', '3|Documentation that patient is not eligible for pain assessment at time of encounter (G8442)|G8442',2),
('PQRS_0131', 'answer', '4|Pain assessment documented as positive, but follow-up plan not documented; documentation that patient not eligible (G8939)|G8939',2),
('PQRS_0131', 'answer', '5|Pain assessment not documented, reason not given (G8732)|G8732',9),
('PQRS_0131', 'answer', '6|Pain assessment documented as positive, follow-up plan not documented, reason not given (G8509)|G8509',9),

('PQRS_0134', 'description', 'Preventive Care and Screening: Screening for Clinical Depression and Follow-Up Plan',''),
('PQRS_0134', 'question', 'Was the patient screened for clinical depression on the date of the encounter using an age appropriate standardized tool AND, if positive, is a follow-up plan documented?',''),
('PQRS_0134', 'answer', '1|Screening for depression documented as positive, AND a follow-up plan documented (G8431)|G8431',1),
('PQRS_0134', 'answer', '2|Screening for depression documented as negative, follow-up plan is not required (G8510)|G8510',1),
('PQRS_0134', 'answer', '3|Screening for depression not completed, for documented reason (G8433)|G8433',2),
('PQRS_0134', 'answer', '4|Screening for depression not documented, reason not given (G8432)|G8432',9),
('PQRS_0134', 'answer', '5|Screening for depression documented as positive, follow-up plan not documented, reason not given (G8511)|G8511',9),

('PQRS_0137', 'description', 'Melanoma: Continuity of Care -- Recall System',''),
('PQRS_0137', 'question', 'Was the patient information entered into a recall system that sets a target date for next complete skin exam at least once every 12 months AND follows a process to address missed or unscheduled appointments?',''),
('PQRS_0137', 'answer', '1|Patient information was entered into a recall system that includes: target date for the next exam AND a process to follow up missed or unscheduled appointments (7010F)|7010F',1),
('PQRS_0137', 'answer', '2|Documentation of system reason(s) for not entering patient\'s information into a recall system (7010F:3P)|7010F:3P',2),
('PQRS_0137', 'answer', '3|Recall system not utilized, reason not given (7010F:8P)|7010F:8P',9),

('PQRS_0138', 'description', 'Melanoma: Coordination of Care',''),
('PQRS_0138', 'question', 'Is there documentation that the patient treatment plan was communicated to the physician(s) providing continuing care within one month of diagnosis?',''),
('PQRS_0138', 'answer', '1|Treatment plan communicated to provider(s) managing continuing care within 1 month of diagnosis (5050F)|5050F',1),
('PQRS_0138', 'answer', '2|Documentation of patient reason(s) for not communicating treatment plan to the Primary Care Physician(s) providing continuing care) (5050F:2P)|5050F:2P',2),
('PQRS_0138', 'answer', '3|Documentation of system reason(s) for not communicating treatment plan to the PCP (5050F:3P)|5050F:3P',2),
('PQRS_0138', 'answer', '4|Treatment plan not communicated, reason not given (5050F:8P)|5050F:8P',9),

('PQRS_0141', 'description', 'Primary Open-Angle Glaucoma (POAG): Reduction of Intraocular Pressure (IOP) by 15% OR Documentation of a Plan of Care',''),
('PQRS_0141', 'question', 'Was the patient\'s most recent IOP reduced by at least 15% from the pre-intervention level OR, if not reduced, was a plan of care was documented within 12 months?',''),
('PQRS_0141', 'answer', '1|Patient IOP reduced by a value of greater than or equal to 15% from the pre-intervention level (3284F)|3284F',1),
('PQRS_0141', 'answer', '2|Glaucoma plan of care documented and IOP reduced by a value LESS THAN 15% from the pre-intervention level (0517F 3285F)|0517F 3285F',1),
('PQRS_0141', 'answer', '3|Glaucoma plan of care not documented, reason not given, and IOP reduced by a value LESS THAN 15% from the pre-intervention level (0517F:8P 3285F)|0517F:8P 3285F',9),
('PQRS_0141', 'answer', '4|Patient IOP measurement not documented, reason not given (3284F:8P)|3284F:8P',9),

('PQRS_0143', 'description', 'Oncology: Medical and Radiation -- Pain Intensity Quantified',''),
('PQRS_0143', 'question', 'Was the patient pain intensity quantified at each chemotherapy or radiation therapy visit?',''),
('PQRS_0143', 'answer', '1|Pain severity quantified; pain present (1125F)|1125F',1),
('PQRS_0143', 'answer', '2|Pain severity quantified; no pain present (1126F)|1126F',1),
('PQRS_0143', 'answer', '3|Pain severity not documented, reason not given (1125F:8P)|1125F:8P',9),

('PQRS_0144', 'description', 'Oncology: Medical and Radiation -- Plan of Care for Patients Who Report Pain',''), 
('PQRS_0144', 'question', 'Does the patient record include a documented plan of care to address pain?',''),
('PQRS_0144', 'answer', '1|Plan of care to address pain documented (0521F)|0521F',1),
('PQRS_0144', 'answer', '2|Plan of care for pain not documented, reason not given (0521F:8P)|0521F:8P',9),

('PQRS_0145', 'description', 'Radiology: Exposure Time Reported for Procedures Using Fluoroscopy',''),
('PQRS_0145', 'question', 'Did the patient final procedure report include radiation exposure indices, or, if indices not available, exposure time and number of fluorographic images?',''),
('PQRS_0145', 'answer', '1|Radiation exposure indices, or exposure time and number of fluorographic images documented in final procedure report (G9500)|G9500',1),
('PQRS_0145', 'answer', '2|Radiation exposure indices, or exposure time and number of fluorographic Images was not documented in final procedure report, reason not given (G9501)|G9501',9),

('PQRS_0146', 'description', 'Radiology: Inappropriate Use of ''Probably Benign'' Assessment Category in Screening Mammograms <br>INVERSE MEASURE',''),
('PQRS_0146', 'question', 'Were mammogram findings classified as ''probably benign'' in the final patient report?',''),
('PQRS_0146', 'answer', '1|Mammogram assessment category of ''probably benign'' documented in the final report (3343F)|3343F',1),
('PQRS_0146', 'answer', '2|Mammogram assessment category other than ''probably benign'' documented in the final report (3350F)|3350F',9),

('PQRS_0147', 'description', 'Nuclear Medicine: Correlation with Existing Imaging Studies for All Patients Undergoing Bone Scintigraphy',''),
('PQRS_0147', 'question', 'Did the patient final reports include physician documentation of correlation with existing relevant imaging studies (e.g., x-ray, MRI, CT, etc.)?',''),
('PQRS_0147', 'answer', '1|Final report for bone scintigraphy study includes correlation with existing relevant imaging studies corresponding to the same anatomical region in question (3570F)|3570F',1),
('PQRS_0147', 'answer', '2|Documentation of system reason(s) for not documenting correlation with existing relevant imaging studies in final report (3570F:3P)|3570F:3P',2),
('PQRS_0147', 'answer', '3|Bone scintigraphy report not correlated in the final report with existing relevant imaging studies, reason not given (3570F:8P)|3570F:8P',9),

('PQRS_0154', 'description', 'Falls: Risk Assessment (for patients with a positive screening for falls)',''),
('PQRS_0154', 'question', 'Did the patient have a risk assessment for falls completed within 12 months?',''),
('PQRS_0154', 'answer', '1|Falls risk assessment documented(3288F)|3288F',1),
('PQRS_0154', 'answer', '2|Documentation of medical reasons for not completing a risk assessment for falls (3288:1P)|3288F:1P',2),
('PQRS_0154', 'answer', '4|Falls risk assessment  not completed, reason not given (3288F:8P)|3288F:8P',9),

('PQRS_0155', 'description', 'Falls: Plan of Care (for patients with a positive screening for falls)',''),
('PQRS_0155', 'question', 'Did the patient have a plan of care for falls documented within 12 months?',''),
('PQRS_0155', 'answer', '1|Falls plan of care documented (0518F)|0518F',1),
('PQRS_0155', 'answer', '2|Patient not ambulatory, bedridden, immobile, confined to chair, wheelchair bound (0518F:1P)|0518F:1P',2),
('PQRS_0155', 'answer', '3|Falls plan of care not documented, reason not given (0518F:8P)|0518F:8P',9),

('PQRS_0164', 'description', 'Coronary Artery Bypass Graft (CABG): Prolonged Intubation <br>INVERSE MEASURE ',''),
('PQRS_0164', 'question', 'Did the patient require intubation > 24 hours following exit from the operating room?',''),
('PQRS_0164', 'answer', '1|Prolonged postoperative intubation (> 24 hrs) required (G8569)|G8569',1),
('PQRS_0164', 'answer', '2|Prolonged postoperative intubation (> 24 hrs) not required (G8570)|G8570',9),

('PQRS_0165', 'description', 'Coronary Artery Bypass Graft (CABG): Deep Sternal Wound Infection Rate <br>INVERSE MEASURE',''),
('PQRS_0165', 'question', 'Did the patient develop a deep sternal wound infection involving muscle, bone, and/or mediastinum requiring operative intervention within 30 days post surgery?',''),
('PQRS_0165', 'answer', '1|Development of deep sternal wound infection/mediastinitis within 30 days postoperatively (G8571)|G8571',1),
('PQRS_0165', 'answer', '2|No deep sternal wound infection/mediastinitis (G8572)|G8572',9),

('PQRS_0166', 'description', 'Coronary Artery Bypass Graft (CABG): Stroke <br>INVERSE MEASURE',''),
('PQRS_0166', 'question', 'Did the patient have a postoperative stroke that did not resolve within 24 hours?',''),
('PQRS_0166', 'answer', '1|Stroke following isolated CABG surgery (G8573)|G8573',1),
('PQRS_0166', 'answer', '2|No stroke following isolated CABG surgery (G8574)|G8574',9),

('PQRS_0167', 'description', 'Coronary Artery Bypass Graft (CABG): Postoperative Renal Failure <br>INVERSE MEASURE',''),
('PQRS_0167', 'question', ' Did the patient develop postoperative renal failure or require dialysis?',''),
('PQRS_0167', 'answer', '1|Developed postoperative renal failure or required dialysis (G8575)|G8575',1),
('PQRS_0167', 'answer', '2|No postoperative renal failure/dialysis not required (G8576)|G8576',9),

('PQRS_0168', 'description', 'Coronary Artery Bypass Graft (CABG): Surgical Re-Exploration <br>INVERSE MEASURE ',''),
('PQRS_0168', 'question', 'Did the patient require a return to the OR to explore for mediastinal bleeding with or without tamponade, graft occlusion, valve dysfunction, or other cardiac reason?',''),
('PQRS_0168', 'answer', '1|Re-exploration required due to mediastinal bleeding with or without tamponade, graft occlusion, valve dysfunction, or other cardiac reason (G8577)|G8577',1),
('PQRS_0168', 'answer', '2|Re-exploration not required (G8578)|G8578',9),

('PQRS_0176', 'description', 'Rheumatoid Arthritis (RA): Tuberculosis Screening',''),
('PQRS_0176', 'question', 'Was TB screening performed and results interpreted within 6 months prior to the patient receiving a first course of therapy using a biologic DMARD?',''),
('PQRS_0176', 'answer', '1|TB screening performed and results interpreted within six months prior to initiation of first-time biologic disease modifying anti-rheumatic drug therapy for RA (3455F)|3455F',1),
('PQRS_0176', 'answer', '2|Documentation of medical reason for not screening for TB or interpreting results (3455F:1P)|3455F:1P',2),
('PQRS_0176', 'answer', '3|TB screening not performed or results not interpreted, reason not given (3455F:8P)|3455F:8P',9),

('PQRS_0177', 'description', 'Rheumatoid Arthritis (RA): Periodic Assessment of Disease Activity',''),
('PQRS_0177', 'question', 'Was patient disease activity assessed by a standardized descriptive, numeric scale or composite index and classified as: low, moderate or high, at least once within 12 months?',''),
('PQRS_0177', 'answer', '1|Rheumatoid arthritis (RA) disease activity, low (3470F)|3470F',1),
('PQRS_0177', 'answer', '2|Rheumatoid arthritis (RA) disease activity, moderate (3471F)|3471F',1),
('PQRS_0177', 'answer', '3|Rheumatoid arthritis (RA) disease activity, high (3472F)|3472F',1),
('PQRS_0177', 'answer', '4|Disease activity not assessed and classified, reason not given (3470F:8P)|3470F:8P',9),

('PQRS_0178', 'description', 'Rheumatoid Arthritis (RA): Functional Status Assessment',''),
('PQRS_0178', 'question', 'Was a functional status assessment was performed on the patient at least once within 12 months?',''),
('PQRS_0178', 'answer', '1|Functional status assessed (1170F)|1170F',1),
('PQRS_0178', 'answer', '2|Functional status not assessed, reason not given (1170F:8P)|1170F:8P',9),

('PQRS_0179', 'description', 'Rheumatoid Arthritis (RA): Assessment and Classification of Disease Prognosis',''),
('PQRS_0179', 'question', 'Does the patient have at least one documented assessment and classification (good/poor) of disease prognosis utilizing clinical markers of poor prognosis, within 12 months?',''),
('PQRS_0179', 'answer', '1|Disease prognosis for rheumatoid arthritis assessed, poor prognosis documented (3475F)|3475F',1),
('PQRS_0179', 'answer', '2|Disease prognosis for rheumatoid arthritis assessed, good prognosis documented (3476F)|3476F',1),
('PQRS_0179', 'answer', '3|Disease prognosis for rheumatoid arthritis not assessed and classified, reason not given (3475F:8P)|3475F:8P)',9),

('PQRS_0180', 'description', ' Rheumatoid Arthritis (RA): Glucocorticoid Management',''),
('PQRS_0180', 'question', 'Has the patient been assessed for glucocorticoid use and if on prolonged doses of prednisone >=10 mg daily (or equivalent) with improvement or no change in disease activity, is there documentation of a glucocorticoid management plan within 12 months?',''),
('PQRS_0180', 'answer', '1|Patient not receiving glucocorticoid therapy (4192F)|4192F',1),
('PQRS_0180', 'answer', '2|Patient receiving less than 10 mg daily prednisone (or equivalent), or RA activity is worsening, or glucocorticoid use is for less than 6 months (4193F)|4193F',1),
('PQRS_0180', 'answer', '3|Patient receiving >= 10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity AND Glucocorticoid Management Plan documented (4194F 0540F)|4194F 0540F',2),
('PQRS_0180', 'answer', '4|Documentation of medical reason(s) for not documenting glucocorticoid management plan (ie, glucocorticoid prescription is for a medical condition other than RA) AND Patient receiving >= 10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity (0540F:1P 4194F)|0540F:1P 4194F',2),
('PQRS_0180', 'answer', '5|Glucocorticoid dose was not documented, reason not given (4194F:8P)|4194F:8P',9),
('PQRS_0180', 'answer', '6|Glucocorticoid management plan not documented, reason not given AND Patient receiving >=10 mg daily prednisone (or equivalent) for longer than 6 months, and improvement or no change in disease activity (0540F:8P 4194F)|0540F:8P 4194F',9),

('PQRS_0181', 'description', 'Elder Maltreatment Screen and Follow-Up Plan',''),
('PQRS_0181', 'question', 'Did the patient have a documented elder maltreatment screen using an Elder Maltreatment Screening tool on the date of the encounter AND a follow-up plan documented if a positive screen?',''),
('PQRS_0181', 'answer', '1|Elder maltreatment screen documented as positive AND follow-up plan documented (G8733)|G8733',1),
('PQRS_0181', 'answer', '2|Elder maltreatment screen documented as negative, follow-up plan not required (G8734)|G8734',1),
('PQRS_0181', 'answer', '3|Elder maltreatment screen not documented, patient not eligible (G8535)|G8535',2),
('PQRS_0181', 'answer', '4|Elder maltreatment screen documented as positive, follow-up plan not documented, patient not eligible for follow-up plan (G8941)|G8941',2),
('PQRS_0181', 'answer', '5|Elder maltreatment screen not documented, reason not given (G8536)|G8536',9),
('PQRS_0181', 'answer', '6|Elder maltreatment screen documented as positive, follow-up plan not documented, reason not given (G8735)|G8735',9),

('PQRS_0182', 'description', 'Functional Outcome Assessment',''),
('PQRS_0182', 'question', 'Did the patient have documention of a current functional outcome assessment using a standardized tool AND a documented care plan based on the identified functional outcome deficiencies?',''),
('PQRS_0182', 'answer', '1|Functional Outcome Assessment Documented as Positive AND Care Plan Documented (G8539)|G8539',1),
('PQRS_0182', 'answer', '2|Functional Outcome Assessment Documented, No Functional Deficiencies Identified, Care Plan not Required (G8542)|G8542',1),
('PQRS_0182', 'answer', '3|Functional Outcome Assessment Documented AND Care Plan Documented, if Indicated, Within the Previous 30 Days (G8942)|G8942',1),
('PQRS_0182', 'answer', '4|Functional Outcome Assessment not Documented, Patient not Eligible (G8540)|G8540',2),
('PQRS_0182', 'answer', '5|Functional Outcome Assessment Documented, Care Plan not Documented, Patient not Eligible (G9227)|G9227',2),
('PQRS_0182', 'answer', '6|Functional Outcome Assessment not Documented, Reason not Given (G8541)|G8541',9),
('PQRS_0182', 'answer', '7|Functional Outcome Assessment Documented as Positive, Care Plan not Documented, Reason not Given (G8543)|G8543',9),

('PQRS_0185', 'description', 'Colonoscopy Interval for Patients with a History of Adenomatous Polyps -- Avoidance of Inappropriate Use',''),
('PQRS_0185', 'question', 'Did the patient have an interval of 3 or more years since their last colonoscopy?',''),
('PQRS_0185', 'answer', '1|Interval of Three or More Years Since Patient\'s Last Colonoscopy (0529F)|0529F',1),
('PQRS_0185', 'answer', '2|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy for Medical Reasons; Documentation of medical reason(s) (0529F:1P)|0529F:1P',2),
('PQRS_0185', 'answer', '3|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy for System Reasons; Documentation of system reason (0529F:3P)|0529F:3P',2),
('PQRS_0185', 'answer', '4|Interval of Less Than Three Years Since Patient\'s Last Colonoscopy, Reason not given (0529F:8P)|0529F:8P',9),

('PQRS_0187', 'description', 'Stroke and Stroke Rehabilitation: Thrombolytic Therapy',''),
('PQRS_0187', 'question', 'Was IV thrombolytic therapy was initiated for the patient at the hospital within three hours (= 180 minutes) of time last known well?<br>Definition: Last Known Well -- The date and time that the patient was last known to be without the signs and symptoms of the current stroke.',''),
('PQRS_0187', 'answer', '1|IV t-PA initiated within three hours (= 180 minutes) of time last known well (G8600)|G8600',1),
('PQRS_0187', 'answer', '2|IV t-PA not initiated within three hours (= 180 minutes) of time last known well for reasons documented by clinician (G8601)|G8601',2),
('PQRS_0187', 'answer', '3|IV t-PA not initiated within three hours (= 180 minutes) of time last known well, reason not given (G8602)|G8602',9),

('PQRS_0191', 'description', 'Cataracts: 20/40 or Better Visual Acuity within 90 Days Following Cataract Surgery',''),
('PQRS_0191', 'question', 'Did the patient acheive best-corrected visual acuity of 20/40 or better (distance or near) within 90 days following cataract surgery?',''),
('PQRS_0191', 'answer', '1|Best-corrected visual acuity of 20/40 or better (distance or near) achieved within the 90 days following cataract surgery (4175F)|4175F',1),
('PQRS_0191', 'answer', '2|Best-corrected visual acuity of 20/40 or better (distance or near) not achieved within the 90 days following cataract surgery, reason not given (4175F:8P)|4175F:8P',9),

('PQRS_0192', 'description', 'Cataracts: Complications within 30 Days Following Cataract Surgery Requiring Additional Surgical Procedures  <br>INVERSE MEASURE ',''),
('PQRS_0192', 'question', 'Did the patient have one or more specified operative procedures for any of the following major complications within 30 days following cataract surgery: retained nuclear fragments, endophthalmitis, dislocated or wrong power IOL, retinal detachment, or wound dehiscence?',''),
('PQRS_0192', 'answer', '1|Surgical procedure performed within 30 days following cataract surgery for major complications (G8627)|G8627',1),
('PQRS_0192', 'answer', '2|Surgical procedure not performed within 30 days following cataract surgery for major complications  (G8628)|G8628',9),

('PQRS_0195', 'description', 'Radiology: Stenosis Measurement in Carotid Imaging Reports',''),
('PQRS_0195', 'question', 'Did patient final reports for carotid imaging studies include direct or indirect reference to measurements of distal internal carotid diameter as the denominator for stenosis measurement?',''),
('PQRS_0195', 'answer', '1|Final report includes reference to measurements of distal internal carotid diameter as the denominator for stenosis measurement (3100F)|3100F',1),
('PQRS_0195', 'answer', '2|Final report did not reference measurements of distal internal carotid diameter as the denominator for stenosis measurement, reason not given (3100F:8P)|3100F:8P',9),

('PQRS_0205', 'description', 'HIV/AIDS: Sexually Transmitted Disease Screening for Chlamydia, Gonorrhea, and Syphilis',''),
('PQRS_0205', 'question', 'Did the patient have chlamydia, gonorrhea, and syphilis screenings performed at least once since the diagnosis of HIV infection?',''),
('PQRS_0205', 'answer', '1|Chlamydia, gonorrhea and syphilis screening results all documented (G9228)|G9228',1),
('PQRS_0205', 'answer', '2|Documentation of patient refusal for chlamydia, gonorrhea, and syphilis screening. (G9229)|G9229',2),
('PQRS_0205', 'answer', '3|Chlamydia, gonorrhea, and syphilis screening results not documented as performed, reason not given (G9230)|G9230',9),

('PQRS_0217', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Knee Impairments',''),
('PQRS_0217', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the Knee at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0217', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the knee successfully calculated and the score was equal to zero or greater than zero (G8647)|G8647',1),
('PQRS_0217', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the knee successfully calculated and the score was less than zero (G8648)|G8648',1),
('PQRS_0217', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the knee not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8649)|G8649',2),
('PQRS_0217', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the knee not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8650)|G8650',9),

('PQRS_0218', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Hip Impairments',''),
('PQRS_0218', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the Hip at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0218', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the hip successfully calculated and the score was equal to zero or greater than zero (G8651)|G8651',1),
('PQRS_0218', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the hip successfully calculated and the score was less than zero (G8652)|G8652',1),
('PQRS_0218', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the hip not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8653)|G8653',2),
('PQRS_0218', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the hip not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8654)|G8654',9),

('PQRS_0219', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lower Leg, Foot or Ankle Impairments',''),
('PQRS_0219', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the lower leg, foot or ankle at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0219', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the lower leg, foot or ankle successfully calculated and the score was equal to zero or greater than zero (G8655)|G8655',1),
('PQRS_0219', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the lower leg, foot or ankle successfully calculated and the score was less than zero (G8656)|G8656',1),
('PQRS_0219', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the lower leg, foot or ankle not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8657)|G8657',2),
('PQRS_0219', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the lower leg, foot or ankle not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8658)|G8658',9),

('PQRS_0220', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lumbar Spine Impairments',''),
('PQRS_0220', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the Lumbar Spine at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0220', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the lumbar spine successfully calculated and the score was equal to zero or greater than zero (G8659)|G8659',1),
('PQRS_0220', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the lumbar spine successfully calculated and the score was less than zero (G8660)|G8660',1),
('PQRS_0220', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the lumbar spine not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8661)|G8661',2),
('PQRS_0220', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the lumbar spine not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8662)|G8662',9),

('PQRS_0221', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Shoulder Impairments',''),
('PQRS_0221', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the Shoulder at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0221', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the shoulder successfully calculated and the score was equal to zero or greater than zero (G8663)|G8663',1),
('PQRS_0221', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the shoulder successfully calculated and the score was less than zero (G8664)|G8664',1),
('PQRS_0221', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the shoulder not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8665)|G8665',2),
('PQRS_0221', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the shoulder not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8666)|G8666',9),

('PQRS_0222', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Elbow, Wrist or Hand Impairments',''),
('PQRS_0222', 'question', 'Was the patient presented with the FOTO Functional Intake Survey for the elbow, wrist or hand at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0222', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the elbow, wrist or hand successfully calculated and the score was equal to zero or greater than zero (G8667)|G8667',1),
('PQRS_0222', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the elbow, wrist or hand successfully calculated and the score was less than zero (G8668)|G8668',1),
('PQRS_0222', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the elbow, wrist or hand not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8669)|G8669',2),
('PQRS_0222', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the elbow, wrist or hand not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8670)|G8670',9),

('PQRS_0223', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Other General Orthopedic Impairments',''),
('PQRS_0223', 'question', 'Was the patient presented with the FOTO Functional Intake Survey at admission and at discharge for the purpose of calculating the patient\'s Risk-adjusted Functional Status Change Residual Score?',''),
('PQRS_0223', 'answer', '1|Risk-Adjusted Functional Status Change Residual Score for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment successfully calculated and the score was equal to zero or greater than zero (G8671)|G8671',1),
('PQRS_0223', 'answer', '2|Risk-Adjusted Functional Status Change Residual Score for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment successfully calculated and the score was less than zero (G8672)|G8672',1),
('PQRS_0223', 'answer', '3|Risk-Adjusted Functional Status Change Residual Scores for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment not measured because the patient not eligible to complete FOTO Functional Status Survey near discharge, Not Appropriate (G8673)|G8673',2),
('PQRS_0223', 'answer', '4|Risk-Adjusted Functional Status Change Residual Scores for the neck, cranium, mandible, thoracic spine, ribs or other general orthopedic impairment not measured because the patient did not complete FOTO Functional Intake on admission and/or follow up Status Survey near discharge, reason not given (G8674)|G8674',9),

('PQRS_0225', 'description', 'Radiology: Reminder System for Screening Mammograms',''),
('PQRS_0225', 'question', 'Was the patient information entered into a reminder system with a target due date for the next mammogram?',''),
('PQRS_0225', 'answer', '1|Patient Information Entered into a Reminder System with Target Due Date for the Next Mammogram (7025F)|7025F',1),
('PQRS_0225', 'answer', '2|Patient Information not Entered into a Reminder System for Medical Reasons (7025F:1P)|7025F:1P',2),
('PQRS_0225', 'answer', '3|Patient Information not Entered into a Reminder System, Reason not Given (7025F:8P)|7025F:8P',9),

('PQRS_0226', 'description', 'Preventive Care and Screening: Tobacco Use: Screening and Cessation Intervention',''),
('PQRS_0226', 'question', 'Was the patient screened for tobacco use at least once within 24 months AND if identified as a tobacco user, receive tobacco cessation intervention?',''),
('PQRS_0226', 'answer', '1|Non- tobacco user|1036F G9903',1),
('PQRS_0226', 'answer', '2|Tobacco-user without cessation intervention| G9902 G9908',9),
('PQRS_0226', 'answer', '3|Tobacco-user AND received tobacco cessation intervention| G9902 G9906 4004F 99406 99407 G0436 G0437 Z71.6',1),
('PQRS_0226', 'answer', '4|Tobacco user, no treatment for medical reasons| G9902 G9907 G9909',2),
('PQRS_0226', 'answer', '5|Tobacco screening not performed for medical reasons| 4004F:1P',2),
('PQRS_0226', 'answer', '6|Tobacco screening not performed, reason not given| G9905 4004F:8P',9),

('PQRS_0236', 'description', 'Controlling High Blood Pressure',''),
('PQRS_0236', 'question', 'Is the blood pressure at the most recent visit adequately controlled (systolic blood pressure &lt; 140 mmHg and diastolic blood pressure &lt; 90 mmHg)?',''),
('PQRS_0236', 'answer', '1|Most recent systolic blood pressure is less than 140 mmHg AND most recent diastolic blood pressure is less than 90 mmHg (G8752 G8754)|G8752 G8754',1),
('PQRS_0236', 'answer', '2|Most recent systolic blood pressure is 140 mmHg or higher AND most recent diastolic blood pressure is less than 90 mmHg (G8753 G8754)|G8753 G8754',9),
('PQRS_0236', 'answer', '3|Most recent systolic blood pressure is less than 140 mmHg AND most recent diastolic blood pressure is 90 mmHg or higher (G8752 G8755)|G8752 G8755',9),
('PQRS_0236', 'answer', '4|Most recent systolic blood pressure is 140 mmHg or AND most recent diastolic blood pressure is 90 mmHg or higher (G8753 G8755)|G8753 G8755',9),
('PQRS_0236', 'answer', '5|Blood pressure measurement not documented, reason not given (G8756)|G8756',9),

('PQRS_0238', 'description', 'Use of High-Risk Medications in the Elderly  <br>INVERSE MEASURE ',''),
('PQRS_0238', 'question', 'Was the patient ordered high-risk medication at least once during the measurement period and if yes, were there two or more orders for the same high risk medication?',''),
('PQRS_0238', 'answer', '1|One order for high-risk medication (G9365)|G9365',1),
('PQRS_0238', 'answer', '2|High-risk medication not ordered during the measurement period (G9366)|G9366',9),
('PQRS_0238', 'answer', '3|Two or more orders for the same high-risk medication (G9367)|G9367',1),
('PQRS_0238', 'answer', '4|Less than two orders for the same high-risk medication (G9368)|G9368',9),

('PQRS_0243', 'description', 'Cardiac Rehabilitation Patient Referral from an Outpatient Setting',''),
('PQRS_0243', 'question', 'Was the patient referred to an outpatient cardiac rehabilitation/secondary prevention (CR) program?',''),
('PQRS_0243', 'answer', '1|Referral to an outpatient cardiac rehabilitation/secondary prevention program (4500F)|4500F',1),
('PQRS_0243', 'answer', '2|Documentation of medical reason(s) for not referring to an outpatient CR program (4500F:1P)|4500F:1P',2),
('PQRS_0243', 'answer', '3|Documentation of system reason(s) for not referring to an outpatient CR program (4500:3P)|4500:3P',2),
('PQRS_0243', 'answer', '4|Previous cardiac rehabilitation for qualifying cardiac event completed (4510F)|4510F',2),
('PQRS_0243', 'answer', '5|Not referred to outpatient CR/secondary prevention program, reason not given(4500F:8P)|4500F:8P',9),

('PQRS_0249', 'description', 'Barrett''s Esophagus',''),
('PQRS_0249', 'question', 'Did the patient esophageal biopsy report document the presence of Barrett''s mucosa and include a statement about dysplasia?',''),
('PQRS_0249', 'answer', '1|Esophageal biopsy reports histologic finding of Barrett''s mucosa and contains a statement about dysplasia (present, absent, or indefinite and if present, contains appropriate grading) (3126F)|3126F',1),
('PQRS_0249', 'answer', '2|Documentation of medical reason(s) for not submitting histological finding of Barrett\'s mucosa (3126F:1P)|3126F:1P',2),
('PQRS_0249', 'answer', '3|Esophageal biopsy reports histologic finding of of Barrett''s mucosa but does not contain a statement about dysplasia (present, absent, or indefinite), reason not given (3126F:8P)|3126F:8P',9),

('PQRS_0250', 'description', 'Radical Prostatectomy Pathology Reporting',''),
('PQRS_0250', 'question', 'Did the patient Radical Prostatectomy report include the pT category, the pN category, Gleason score and a statement about margin status?',''),
('PQRS_0250', 'answer', '1|Pathology report includes pT category, pN category, Gleason score and a statement about margin status (3267F)|3267F',1),
('PQRS_0250', 'answer', '2|pT category, pN category, Gleason score and statement about margin status not documented, for medical reasons (3267F:1P)|3267F:1P',2),
('PQRS_0250', 'answer', '3|pT category, pN category, Gleason score and statement about margin status not documented, reason not  given (3267F:8P)|3267F:8P',9),

('PQRS_0254', 'description', 'Ultrasound Determination of Pregnancy Location for Pregnant Patients with Abdominal Pain',''),
('PQRS_0254', 'question', 'Did pregnant patients presenting at ED with abdominal pain or vaginal bleeding recieve a trans-abdominal or trans-vaginal ultrasound for pregnacy location?',''),
('PQRS_0254', 'answer', '1|Trans-Abdominal or Trans-Vaginal Ultrasound Performed (G8806)|G8806',1),
('PQRS_0254', 'answer', '2|Trans-Abdominal or Trans-Vaginal Ultrasound not Performed for Documented Clinical Reasons (G8807)|G8807',2),
('PQRS_0254', 'answer', '3|Trans-Abdominal or Trans-Vaginal Ultrasound not Performed, Reason not Given (G8808)|G8808',9),

('PQRS_0255', 'description', 'Rh Immunoglobulin (Rhogam) for Rh-Negative Pregnant Women at Risk of Fetal Blood Exposure',''),
('PQRS_0255', 'question', 'Did the patient receive an order for Rh-Immunoglobulin (Rhogam) in the ED?',''),
('PQRS_0255', 'answer', '1|Documentation in Medical Record that Rh-immunoglobulin (Rhogam) Ordered (G8809)|G8809',1),
('PQRS_0255', 'answer', '2|Rh-immunoglobulin (Rhogam) not Ordered for Documented Reasons (G8810)|G8810',2),
('PQRS_0255', 'answer', '3|Rh-immunoglobulin (Rhogam) not Ordered, Reason not Given (G8811)|G8811',9),

('PQRS_0258', 'description', 'Rate of Open Repair of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) without Major Complications (Discharged to Home by Post-Operative Day #7)',''),
('PQRS_0258', 'question', ' Was the patients discharged to home no later than post-operative day #7?<br>Definition:<br>Home -- the point of origin prior to hospital admission prior to procedure of AAA.',''),
('PQRS_0258', 'answer', '1|Patient discharged to home no later than post-operative day #7 (G8818)|G8818',1),
('PQRS_0258', 'answer', '2|Patient not discharged to home by post-operative day #7 (G8825)|G8825',9),

('PQRS_0259', 'description', 'Rate of Endovascular Aneurysm Repair (EVAR) of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) without Major Complications (Discharged to Home by Post Operative Day #2)',''),
('PQRS_0259', 'question', 'Was the patients discharged to home no later than post-operative day #2 following EVAR of AAA? <br>Definition:<br>Home -- the point of origin prior to hospital admission prior to procedure of AAA.',''),
('PQRS_0259', 'answer', '1|Patient discharged to home no later than post-operative day #2 following EVAR (G8826)|G8826',1),
('PQRS_0259', 'answer', '2|Patient not discharged to home by post-operative day #2 following EVAR (G8833)|G8833',9),

('PQRS_0260', 'description', 'Rate of Carotid Endarterectomy (CEA) for Asymptomatic Patients, without Major Complications (Discharged to Home by Post-Operative Day #2)',''),
('PQRS_0260', 'question', 'Was the patient discharged to home no later than post-operative day #2 following CEA?<br>Definition:<br>Home -- the point of origin prior to hospital admission for procedure of CEA.',''),
('PQRS_0260', 'answer', '1|Patient discharged to home no later than post-operative day #2 following CEA (G8834)|G8834',1),
('PQRS_0260', 'answer', '2|Patient not discharged to home by post-operative day #2 following CEA (G8838)|G8838',9),

('PQRS_0261', 'description', 'Referral for Otologic Evaluation for Patients with Acute or Chronic Dizziness',''),
('PQRS_0261', 'question', 'Was the patient referred to a physician for an otologic evaluation?',''),
('PQRS_0261', 'answer', '1|Referral for Otologic Evaluation Peformed(G8856)|G8856',1),
('PQRS_0261', 'answer', '2|Referral for Otologic Evaluation not Performed for Documented Reasons (G8857)|G8857',2),
('PQRS_0261', 'answer', '3|Referral for Otologic Evaluation not Performed, Reason not Given (G8858)|G8858',9),

('PQRS_0262', 'description', 'Image Confirmation of Successful Excision of Image-Localized Breast Lesion',''),
('PQRS_0262', 'question', ' Was the breast tissue evaluated by imaging (x-ray, ultrasound, MRI, PET mammography or other imaging modality) during the course of the biopsy or partial matectomy to confirm successful inclusion of targeted lesion?',''),
('PQRS_0262', 'answer', '1|The excised tissue was evaluated by imaging to confirm successful inclusion of targeted lesion (G8872)|G8872',1),
('PQRS_0262', 'answer', '2|The excised tissue was not evaluated by imaging to confirm successful inclusion of targeted lesion, reason not given (G8874)|G8874',9),

('PQRS_0264', 'description', 'Sentinel Lymph Node Biopsy for Invasive Breast Cancer that is Clinically Node Negative',''),
('PQRS_0264', 'question', 'Did the patient undergo a SLN procedure?',''),
('PQRS_0264', 'answer', '1|Sentinel lymph node biopsy procedure performed (G8878)|G8878',1),
('PQRS_0264', 'answer', '2|Documentation of reason(s) that sentinel lymph node biopsy was not performed (G8880)|G8880',2),
('PQRS_0264', 'answer', '3|Sentinel lymph node biopsy procedure not performed, reason not given (G8882)|G8882',9),

('PQRS_0265', 'description', 'Biopsy Follow-Up',''),
('PQRS_0265', 'question', 'Were the patient biopsy results reviewed and communicated to the primary care/referring physician and the patient by the physician performing the biopsy?. The physician performing the biopsy must also acknowledge and/or document the communication in a biopsy tracking log and document in the patient\'s medical record.<br>Numerator Instructions: To satisfy this measure, the biopsying physician must:<li>Review the biopsy results with the patient<li>Communicate those results to the primary care/referring physician<li>Track communication in a log<li>Document tracking process in the patient\'s medical record<br>Definition:<br>The components of a tracking log incorporate the followingInitials of physician performing the biopsy<li>Patient name<li>Date of biopsy<li>Type of biopsy<li>Biopsy result<li>Date of biopsy result',''),
('PQRS_0265', 'answer', '1|Biopsy results reviewed, communicated, tracked, and documented (G8883)|G8883',1),
('PQRS_0265', 'answer', '2|Clinician documented reason that patient\'s biopsy results were not reviewed (G8884)|G8884',2),
('PQRS_0265', 'answer', '3|Biopsy results not reviewed, communicated, tracked, or documented (G8885)|G8885',9),

('PQRS_0268', 'description', 'Epilepsy: Counseling for Women of Childbearing Potential with Epilepsy',''),
('PQRS_0268', 'question', 'Was the patient or their caregiver counseled at least once a year about how epilepsy and its treatment may affect contraception OR pregnancy?',''),
('PQRS_0268', 'answer', '1|Counseling for Women of Childbearing Potential with Epilepsy (4340F)|4340F',1),
('PQRS_0268', 'answer', '2|Counseling for Women of Childbearing Potential with Epilepsy not Performed for Medical Reasons (4340F:1P)|4340F:1P',2),
('PQRS_0268', 'answer', '3|Counseling for Women of Childbearing Potential with Epilepsy not Performed, Reason not Given (4340F:8P)|4340F:8P',9),

('PQRS_0271', 'description', 'Inflammatory Bowel Disease (IBD): Preventive Care: Corticosteroid Related Iatrogenic Injury -- Bone Loss Assessment',''),
('PQRS_0271', 'question', 'Did the patient receive an assessment for risk of bone loss? Was Central Dual-energy Xray Absorbtiometry (DXA) performed or ordered and review of systems and medication history performed OR was osteoporosis medication prescribed within the past 2 years?',''),
('PQRS_0271', 'answer', '1|DXA ordered, documented review of systems and medication history OR pharmacologic therapy for osteoporosis prescribed (G8861)|G8861',1),
('PQRS_0271', 'answer', '2|No documentation of (DXA)  review of systems, medication history or prescription for pharmacologic therapy for osteoporosis prescribed (G9472)|G9472',9),

('PQRS_0275', 'description', 'Inflammatory Bowel Disease (IBD): Assessment of Hepatitis B Virus (HBV) Status Before Initiating Anti-TNF (Tumor Necrosis Factor) Therapy',''),
('PQRS_0275', 'question', 'Did the patient have HBV status assessed and results interpreted prior to receiving their first ever course of antiTNF therapy?',''),
('PQRS_0275', 'answer', '1|HBV status was assessed and results interpreted prior to receiving a first course of anti-TNF therapy (G9912)|G9912',1),
('PQRS_0275', 'answer', '2|Patient has documented immunity to HBV and is receiving a first course of anti-TNF therapy (G8869)|G8869',1),
('PQRS_0275', 'answer', '3|Documented reason for not assessing HBV status (G9504)|G9504',2),
('PQRS_0275', 'answer', '4|HBV results not interpreted prior to receiving a first course of anti-TNF therapy, reason not given (G9913)|G9913',9),
('PQRS_0275', 'answer', '5|No record of Hepatitis B Virus results documented (G9915)|G9915',9),

('PQRS_0277', 'description', 'Sleep Apnea: Severity Assessment at Initial Diagnosis',''),
('PQRS_0277', 'question', 'Did the patient have an apnea hypopnea index (AHI) or a respiratory disturbance index (RDI) measured at the time of initial diagnosis?',''),
('PQRS_0277', 'answer', '1|AHI or RDI measured at the time of initial diagnosis (G8842)|G8842',1),
('PQRS_0277', 'answer', '2|Documentation of reason(s) for not measuring an AHI or a RDI at the time of initial diagnosis (G8843)|G8843',2),
('PQRS_0277', 'answer', '3|AHI or RDI not measured at the time of initial diagnosis, reason not given (G8844)|G8844',9),

('PQRS_0279', 'description', ' Sleep Apnea: Assessment of Adherence to Positive Airway Pressure Therapy',''),
('PQRS_0279', 'question', 'Is there documentation of objective measurement regarding patient adherence to positive airway pressure therapy?',''),
('PQRS_0279', 'answer', '1|Objective measurement of adherence to positive airway pressure therapy, documented (G8851)|G8851',1),
('PQRS_0279', 'answer', '2|Documentation of reason(s) for not objectively measuring adherence to positive airway pressure therapy (G8854)|G8854',2),
('PQRS_0279', 'answer', '3|Objective measurement of adherence to positive airway pressure therapy not performed, reason not given (G8855)|G8855',9),

('PQRS_0282', 'description', 'Dementia: Functional Status Assessment',''),
('PQRS_0282', 'question', 'Did the patient have a functional status assessment performed at least once within a 12 month period?',''),
('PQRS_0282', 'answer', '1|Functional status performed at least once in the last 12 months (G9916)|G9916',1),
('PQRS_0282', 'answer', '2|Documentation of medical reason(s) for not performing a functional status (G9917)|G9917',2),
('PQRS_0282', 'answer', '3|Functional status not performed, reason not given (G9918)|G9918',9),

('PQRS_0283', 'description', ' Dementia Associated Behavioral and Psychiatric Symptom Screening Management',''),
('PQRS_0283', 'question', 'Was the patient screened for behavioral and psychiatric symptoms at least once in a 12 month period AND if positive, were symptoms management recommendations documented?',''),
('PQRS_0283', 'answer', '1|Screening performed and positive, symptoms management recommendations documented (G9919)|G9919',1),
('PQRS_0283', 'answer', '2|Screening performed; negative (G9920)|G9920',1),
('PQRS_0283', 'answer', '3|Screening not performed; partial screening Or positive screening with no  recommendations, reason not given (G9920)|G9920',9),

('PQRS_0286', 'description', 'Dementia: Safety Concerns Screening and Mitigation Recommendations or Referral for Patients with Dementia',''),
('PQRS_0286', 'question', 'Was the patient or their caregiver(s) screened for 1) danger to self or others and 2)environmental risk AND if safety concerns, are there recommendations or a referral for further safety evaluation(mitigation)?',''),
('PQRS_0286', 'answer', '1|Safety screening positive, documented mitigation recommendations and or referrals,orders (G9922)|G9922',1),
('PQRS_0286', 'answer', '2|Safety screening, negative (G9923)|G9923',1),
('PQRS_0286', 'answer', '3|Documentation of medical reason(s) for not performing safety screening OR for not providing mitigation recommendations, referrals or orders (G9924)|G9924',2),
('PQRS_0286', 'answer', '4|Safety screening not provided, reason not given (G9925)|G9925',9),
('PQRS_0286', 'answer', '6|Safety screening positive without mitigation recommendations referrals or orders  (G9926)|G9926',9),

('PQRS_0288', 'description', 'Dementia: Caregiver Education and Support',''),
('PQRS_0288', 'question', 'Patients whose caregiver(s) were provided with education on dementia management and health behavior changes AND referred to additional resources for support in the last 12 months',''),
('PQRS_0288', 'answer', '1|Caregiver provided with education and referred to additional resources for support (4322F)|4322F',1),
('PQRS_0288', 'answer', '2|Documentation of medical reason(s) for not providing the caregiver with demetia education or referring to additional sources for support (4322F:1P)|4322F:1P',2),
('PQRS_0288', 'answer', '3|Caregiver not provided with education and not referred to additional resources for support, reason not given (4322F:8P)|4322F:8P',9),

('PQRS_0290', 'description', 'Parkinson\'s Disease: Psychiatric Symptoms Assessment',''),
('PQRS_0290', 'question', 'Was the patient assessed for psychiatric symptoms in the past 12 months?',''),
('PQRS_0290', 'answer', '1|Psychiatric symptoms assessed (G9742)|G9742',1),
('PQRS_0290', 'answer', '2|Psychiatric symptoms not assessed, reason not given (G9743)|G9743',9),

('PQRS_0291', 'description', ' Parkinson\'s Disease: Cognitive Impairment or Dysfunction Assessment',''),
('PQRS_0291', 'question', 'Was the patient assessed for cognitive impairment or dysfunction at least once in the past 12 months?',''),
('PQRS_0291', 'answer', '1|Cognitive impairment or dysfunction assessed (3720F)|3720F',1),
('PQRS_0291', 'answer', '2|Cognitive impairment or dysfunction was not assessed, reason not given (3720F:8P)|3720F:8P',9),

('PQRS_0293', 'description', 'Parkinson\'s Disease: Rehabilitative Therapy Options',''),
('PQRS_0293', 'question', 'Were rehabilitative therapy options discussed with the patient or caregiver(s) in the past 12 months?',''),
('PQRS_0293', 'answer', '1|Rehabilitative therapy options discussed with patient (or caregiver) (4400F)|4400F',1),
('PQRS_0293', 'answer', '2|Documentation of medical reason(s) for not discussing rehabilitative therapy options with patient (or caregiver) (4400F:1P)|4400F:1P',2),
('PQRS_0293', 'answer', '3|Rehabilitative therapy options not discussed with patient (or caregiver), reason not given (4400F:8P)|4400F:8P',9),

('PQRS_0303', 'description', 'Cataracts: Improvement in Patient\'s Visual Function within 90 Days Following Cataract Surgery',''),
('PQRS_0303', 'question', 'Was improvement in visual function achieved within 90 days following cataract surgery, based on pre-operative and post-operative visual function surveys?',''),
('PQRS_0303', 'answer', '1|Improvement in visual function achieved within 90 days following cataract surgery (G0913)|G0913',1),
('PQRS_0303', 'answer', '2|Patient care survey was not completed by patient (G0914)|G0914',2),
('PQRS_0303', 'answer', '3|Improvement in visual function not achieved within 90 days following cataract surgery (G0915)|G0915',9),

('PQRS_0304', 'description', 'Patient Satisfaction within 90 Days Following Cataract Surgery',''),
('PQRS_0304', 'question', 'Was the patient satisfied with their care within 90 days following cataract surgery, based on completion of the Consumer Assessment of Healthcare Providers and Systems Surgical Care Survey (CAHPS)',''),
('PQRS_0304', 'answer', '1|Satisfaction with care achieved within 90 days following cataract surgery (G0916)|G0916',1),
('PQRS_0304', 'answer', '2|Patient care survey was not completed by patient (G0917)|G0917',2),
('PQRS_0304', 'answer', '3|Satisfaction with care not achieved within 90 days following cataract surgery (G0918)|G0918',9),

('PQRS_0317', 'description', 'Preventive Care and Screening: Screening for High Blood Pressure and Follow Up Documented',''),
('PQRS_0317', 'question', 'Was the patient screened for high blood pressure AND had a recommended follow-up plan documented, as indicated, if the blood pressure is pre-hypertensive or hypertensive?',''),
('PQRS_0317', 'answer', '1|Normal blood pressure reading documented, follow-up not required (G8783)|G8783',1),
('PQRS_0317', 'answer', '2|Pre-Hypertensive or Hypertensive blood pressure reading documented, AND the indicated follow-up is documented (G8950)|G8950',1),
('PQRS_0317', 'answer', '3|Documented reason for not screening or recommending a follow-up for high blood pressure (G9745)|G9745',2),
('PQRS_0317', 'answer', '4|Blood pressure reading not documented, reason not given (G8785)|G8785',9),
('PQRS_0317', 'answer', '5|Pre-Hypertensive or Hypertensive blood pressure reading documented, indicated follow-up not documented, reason not given (G8952)|G8952',9),

('PQRS_0320', 'description', 'Appropriate Follow-Up Interval for Normal Colonoscopy in Average Risk Patients',''),
('PQRS_0320', 'question', 'Patients who had recommended follow-up interval of at least 10 years for repeat colonoscopy documented in their colonoscopy report',''),
('PQRS_0320', 'answer', '1|Recommendation of at least a 10 year interval for followup Colonoscopy  (0528F)|0528F',1),
('PQRS_0320', 'answer', '2|Documentation of medical reasons: Interval of at least 10 years for Colonoscopy followup NOT recommended (0528F:1P)|0528F:1P',2),
('PQRS_0320', 'answer', '3|No Follow-Up Interval for Colonoscopy Recommended or recoomendation is less than 10 year interval, reason not given (0528F:8P)|0528F:8P',9),

('PQRS_0322', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Preoperative Evaluation in Low Risk Surgery Patients <br>INVERSE MEASURE',''),
('PQRS_0322', 'question', 'Did the patient meet the definition of a low risk surgery patient (surgeries with risk for cardiac death or MI is less than 1% including, but not limited to,endoscopic procedures, superficial procedures, cataract surgery, and excisional breast surgery',''),
('PQRS_0322', 'answer', '1|Cardiac Stress Imaging performed on patient for a low risk surgery (G8961)|G8961',1),
('PQRS_0322', 'answer', '2|Cardiac Stress Imaging Test performed on patient for any other reason (G8962)|G8962',9),

('PQRS_0323', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Routine Testing After Percutaneous Coronary Intervention (PCI)<br>INVERSE MEASURE',''),
('PQRS_0323', 'question', 'Was the patient asymptomatic, receiving a SPECT MPI, stress ECHO, CCTA or CMR performed within 2 years of the most recent PCI?',''),
('PQRS_0323', 'answer', '1|Cardiac Stress Imaging performed for asymptomatic patient who had a PCI within the past 2 years (G8963)|G8963',1),
('PQRS_0323', 'answer', '2|Cardiac Stress Imaging test performed for any other reason (G8964)|G8964',9),

('PQRS_0324', 'description', 'Cardiac Stress Imaging Not Meeting Appropriate Use Criteria: Testing in Asymptomatic, Low-Risk Patients<br>INVERSE MEASURE',''),
('PQRS_0324', 'question', 'Was SPECT MPI, stress echo, CCTA, or CMR performed for asymptomatic, low CHD risk patients for initial detection and risk assessment?',''),
('PQRS_0324', 'answer', '1|Cardiac Stress Imaging Test performed on low CHD risk patient for initial detection and risk assessment (G8965)|G8965',1),
('PQRS_0324', 'answer', '2|Cardiac Stress Imaging Test performed on symptomatic or higher than low CHD risk patient or for any reason other than initial detection and risk assessment (G8966)|G8966',9),

('PQRS_0325', 'description', 'Adult Major Depressive Disorder (MDD): Coordination of Care of Patients with Specific Comorbid Conditions',''),
('PQRS_0325', 'question', 'Did the clinician treating this patient for MDD communicate relevant information to the clinician who primarily manages the comorbid conditions of the patient?',''),
('PQRS_0325', 'answer', '1|Clinician treating MDD communicated relevant information to the clinician treating comorbid condition (G8959)|G8959',1),
('PQRS_0325', 'answer', '2|Documentation of patient reason for clinician treating MDD not communicating with clinician treating comorbid condition (G9232)|G9232',2),
('PQRS_0325', 'answer', '3|Clinician treating MDD did not communicate with clinician treating comorbid condition, reason not given (G8960)|G8960',9),

('PQRS_0326', 'description', 'Atrial Fibrillation and Atrial Flutter: Chronic Anticoagulation Therapy',''),
('PQRS_0326', 'question', 'Was the patient prescribed warfarin OR another oral anticoagulant drug that is FDA approved for the prevention of thromboembolism?',''),
('PQRS_0326', 'answer', '1|Warfarin OR Another Oral Anticoagulant that is FDA Approved is Prescribed (G8967)|G8967',1),
('PQRS_0326', 'answer', '2|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented Medical Reasons (G8968)|G8968',2),
('PQRS_0326', 'answer', '3|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented Patient Reasons (G8969)|G8969',2),
('PQRS_0326', 'answer', '4|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed for Documented System Reasons (G9927)|G9927',2),
('PQRS_0326', 'answer', '5|Warfarin OR Another Oral Anticoagulant that is FDA Approved not Prescribed, Reason not Given (G9928)|G9928',9),

('PQRS_0328', 'description', 'Pediatric Kidney Disease: ESRD Patients Receiving Dialysis: Hemoglobin Level &lt; 10 g/dL<br>INVERSE MEASURE',''),
('PQRS_0328', 'question', 'Did the patient have a hemoglobin level &lt; 10 g/dL?',''),
('PQRS_0328', 'answer', '1|Most recent hemoglobin (Hgb) level &lt; 10 g/dL (G8973)|G8973',1),
('PQRS_0328', 'answer', '2|Hemoglobin level measurement not documented, reason not given (G8974)|G8974',2),
('PQRS_0328', 'answer', '3|Documentation of medical reason(s) for patient having a hemoglobin level &lt; 10 g/dL (G8975)|G8975',2),
('PQRS_0328', 'answer', '4|Most recent hemoglobin (Hgb) level &ge; 10 g/dL (G8976)|G8976',9),

('PQRS_0329', 'description', 'Adult Kidney Disease: Catheter Use at Initiation of Hemodialysis<br>INVERSE MEASURE',''),
('PQRS_0329', 'question', 'Was a catheter the mode of vascular access at the time maintenance hemodialysis was initiated?',''),
('PQRS_0329', 'answer', '1|A catheter was the mode of vascular access at the time that maintenance hemodialysis was initiated (G9240)|G9240',1),
('PQRS_0329', 'answer', '2|Documented reasons for initiating maintenance hemodialysis with a catheter as the mode of vascular access (G9239)|G9239',2),
('PQRS_0329', 'answer', '3|A catheter was not the mode of vascular access at the time that maintenance hemodialysis was initiated (G9241)|G9241',9),

('PQRS_0330', 'description', 'Adult Kidney Disease: Catheter Use for Greater Than or Equal to 90 Days<br>INVERSE MEASURE',''),
('PQRS_0330', 'question', 'Was a catheter the mode of vascular access for dialysis of 90 days or greater?',''),
('PQRS_0330', 'answer', '1|A catheter was the mode of vascular access for dialysis of 90 days or greater (G9265)|G9265',1),
('PQRS_0330', 'answer', '2|Documented reasons for receiving maintenance hemodialysis for greater than or equal to 90 days with a catheter as the mode of vascular access (G9264)|G9264',2),
('PQRS_0330', 'answer', '3|A catheter was not the mode of vascular access for maintenance hemodialysis of 90 days or greater (G9266)|G9266',9),

('PQRS_0331', 'description', 'Adult Sinusitis: Antibiotic Prescribed for Acute Viral Sinusitis (Overuse) <br>INVERSE MEASURE',''),
('PQRS_0331', 'question', 'Was the patient prescribed any antibiotic within 10 days after onset of symptoms?',''),
('PQRS_0331', 'answer', '1|Antibiotic regimen prescribed within 10 days after onset of symptoms (G9286)|G9286',1),
('PQRS_0331', 'answer', '2|Antibiotic regimen prescribed within 10 days after onset of symptoms for documented medical reason (G9505)|G9505',2),
('PQRS_0331', 'answer', '3|Antibiotic regimen not prescribed within 10 days after onset of symptoms (G9287)|G9287',9),

('PQRS_0332', 'description', 'Adult Sinusitis: Appropriate Choice of Antibiotic: Amoxicillin With or Without Clavulanate Prescribed for Patients with Acute Bacterial Sinusitis (Appropriate Use)',''),
('PQRS_0332', 'question', 'Was the patient prescribed amoxicillin, with or without clavulanate, as a first line antibiotic at the time of diagnosis?',''),
('PQRS_0332', 'answer', '1|Amoxicillin, with or without clavulanate, prescribed as a first line antibiotic at the time of diagnosis (G9315)|G9315',1),
('PQRS_0332', 'answer', '2|Amoxicillin, with or without clavulanate, not prescribed as first line antibiotic at the time of diagnosis for documented reason (G9313)|G9313',2),
('PQRS_0332', 'answer', '3|Amoxicillin, with or without clavulanate, not prescribed as first line antibiotic at the time of diagnosis, reason not given (G9314)|G9314',9),

('PQRS_0333', 'description', 'Adult Sinusitis: Computerized Tomography (CT) for Acute Sinusitis (Overuse) <br>INVERSE MEASURE',''),
('PQRS_0333', 'question', 'Did the patient have a computerized tomography (CT) scan of the paranasal sinuses ordered at the time of diagnosis or received within 28 days after date of diagnosis?',''),
('PQRS_0333', 'answer', '1|CT scan of the paranasal sinuses ordered at the time of diagnosis or received within 28 days after date of diagnosis (G9349)|G9349',1),
('PQRS_0333', 'answer', '2|CT scan of the paranasal sinuses ordered at the time of diagnosis for documented reasons (G9348)|G9348',2),
('PQRS_0333', 'answer', '3|CT scan of the paranasal sinuses not ordered at the time of diagnosis or received within 28 days after date of diagnosis (G9350)|G9350',9),

('PQRS_0335', 'description', 'Maternity Care: Elective Delivery or Early Induction Without Medical Indication at &ge; 37 and &lt; 39 Weeks (Overuse)',''),
('PQRS_0335', 'question', 'Did the patient have an elective delivery or induction without medical indication at 37 or 38 weeks gestation?',''),
('PQRS_0335', 'answer', '1|Early elective delivery or early elective induction not performed (G9355)|G9355',1),
('PQRS_0335', 'answer', '2|Documented medical indication for elective delivery or early induction (G9361)|G9361',2),
('PQRS_0335', 'answer', '3|Early elective delivery or early elective induction performed without medical indication (G9356)|G9356',9),

('PQRS_0336', 'description', 'Maternity Care: Post-Partum Follow-Up and Care Coordination',''),
('PQRS_0336', 'question', 'Did the patient receive breast feeding evaluation and education, post-partum depression screening, post-partum glucose screening for gestational diabetes patients and family and contraceptive planning at their post partum visit?',''),
('PQRS_0336', 'answer', '1|The recommended post-partum screenings, evaluations and education performed (G9357)|G9357',1),
('PQRS_0336', 'answer', '2|The recommended post-partum screenings, evaluations and education not performed (G9358)|G9358',9),

('PQRS_0337', 'description', 'Tuberculosis Prevention for Psoriasis,Psoriatic Arthritis and Rheumatoid Arthritis Patients on a Biological Immune Response Modifier',''),
('PQRS_0337', 'question', 'Does the patient have a documented negative annual TB screening or if a history of positive TB screening test is there documentation that there are no signs or symptoms of active tuberculosis, confirmed through use of radiographic imaging?',''),
('PQRS_0337', 'answer', '1|Documentation of negative TB screen or a managed positive TB screen with confirmation that TB is not active (G9359)|G9359',1),
('PQRS_0337', 'answer', '2|Documentation of patient reason for not having a record of negative or managed positive TB screen (G9932)|G9932',2),
('PQRS_0337', 'answer', '3|No documentation of TB screening (G9360)|G9360',9),

('PQRS_0338', 'description', 'HIV Viral Load Suppression',''),
('PQRS_0338', 'question', 'Did the patient have a HIV viral load result of less than 200 copies/mL at last viral load test?',''),
('PQRS_0338', 'answer', '1|Viral load result is less than 200 copies/mL (G9243)|G9243',1),
('PQRS_0338', 'answer', '2|Documentation of viral load equal to or greater than 200 copies/mL OR viral load test not performed (G9242)|G9242',9),

('PQRS_0340', 'description', 'HIV Medical Visit Frequency',''),
('PQRS_0340', 'question', 'Did the patient have at least one medical visit every 6 months during the past 24 months, with a minimum of 60 days between medical visits?',''),
('PQRS_0340', 'answer', '1|Patient had at least one medical visit every 6 months during the past 24 months, with a minimum of 60 days between medical visits (G9247)|G9247',1),
('PQRS_0340', 'answer', '2|Patient did not have at least one medical visit every 6 months during the past 24 months, with a minimum of 60 days between medical visits (G9246)|G9246',9),

('PQRS_0342', 'description', 'Pain Brought Under Control Within 48 Hours',''),
('PQRS_0342', 'question', 'Did the patient report that their pain was brought to a comfortable level within 48 hours of initial assessment, after admission to palliative care services?',''),
('PQRS_0342', 'answer', '1|Documentation that patient reported pain brought to a comfortable level within 48 hours from initial assessment (G9250)|G9250',1),
('PQRS_0342', 'answer', '2|Documentation that patient reported pain was not brought to a comfortable level within 48 hours from initial assessment (G9251)|G9251',9),

('PQRS_0343', 'description', 'Screening Colonoscopy Adenoma Detection Rate',''),
('PQRS_0343', 'question', 'Did the patient have a conventional adenoma or colorectal cancer detected during screening colonoscopy?',''),
('PQRS_0343', 'answer', '1|Adenoma(s) or colorectal cancer detected during screening colonoscopy (G9933)|G9933',1),
('PQRS_0343', 'answer', '2|Documentation that neoplasm detected is only diagnosed as traditional serrated adenoma, sessile serrated polyp, or sessile serrated adenoma (G9934)|G9934',2),
('PQRS_0343', 'answer', '3|Adenoma(s) or colorectal cancer not detected during screening colonoscopy (G9935)|G9935',9),

('PQRS_0344', 'description', 'Rate of Carotid Artery Stenting (CAS) for Asymptomatic Patients, Without Major Complications (Discharged to Home by Post-Operative Day #2)',''),
('PQRS_0344', 'question', 'Was the patient discharged no later than post-operative day 2 following CAS?',''),
('PQRS_0344', 'answer', '1|Documentation that patient was discharged before or on post-operative day 2, following CAS (G9255)|G9255',1),
('PQRS_0344', 'answer', '2|Documentation that patient was discharged later than post-operative day 2, following CAS (G9254)|G9254',9),

('PQRS_0345', 'description', 'Rate of Asymptomatic Patients Undergoing Carotid Artery Stenting (CAS) Who are Stroke Free or Discharged Alive',''),
('PQRS_0345', 'question', 'Was the patient stroke free while in the hospital or discharged alive following CAS?',''),
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

('PQRS_0348', 'description', 'HRS-3 Implantable Cardioverter-Defibrillator (ICD) Complications Rate <br>INVERSE MEASURE',''),
('PQRS_0348', 'question', 'CRITERIA 1:  Did the patient experience one or more of the following complications or mortality within <b>30</b> days following ICD implantation? <br>1.Death<br>2. Pneumothorax or hemothorax plus a chest tube<br>3. Hematoma plus a blood transfusion or evacuation<br>4. Cardiac tamponade or pericardiocentesis<br><center>OR</center><br> CRITERIA 2: Did the patients experience one or more of the following complications within 90 days (depending on the complication) following ICD implantation?s:<br>1. Mechanical complications requiring a system revision<br>2. Device related infection<br>3. Additional ICD implantation.',''),
('PQRS_0348', 'answer', '1|Documentation of one or more complications or mortality within 30 days (G9267)|G9267',1),
('PQRS_0348', 'answer', '2|No complications or mortality within 30 days of ICD (G9269)|G9269',9),
('PQRS_0348', 'answer', '3|Documentation of one or more complications within 90 days (G9268)|G9268',1),
('PQRS_0348', 'answer', '4|No complications within 90 days of ICD(G9270)|G9270',9),

('PQRS_0350', 'description', 'Total Knee Replacement: Shared Decision-Making: Trial of Conservative (Non-surgical) Therapy',''),
('PQRS_0350', 'question', 'Is there documentation of shared decision-making, including discussion of conservative (non-surgical) therapy (e.g. NSAIDs, analgesics, weight loss, exercise, injections) prior to the procedure?',''),
('PQRS_0350', 'answer', '1|Documentation of shared decision-making, including discussion of conservative (non-surgical) therapy prior to the procedure (G9296)|G9296',1),
('PQRS_0350', 'answer', '2|No documentation of shared decision-making, reason not given (G9297)|G9297',9),

('PQRS_0351', 'description', 'Total Knee Replacement: Venous Thromboembolic and Cardiovascular Risk Evaluation',''),
('PQRS_0351', 'question', 'Was the patient evaluated for the presence or absence of venous thromboembolic and cardiovascular risk factors (history of DVT, PE, MI, arrhythmia and stroke) within 30 days prior to the procedure?',''),
('PQRS_0351', 'answer', '1|Evaluated for venous thromboembolic and cardiovascular risk factors within 30 days prior to the procedure (G9298)|G9298',1),
('PQRS_0351', 'answer', '2|Not evaluated for venous thromboembolic and cardiovascular risk factors within 30 days prior to the procedure, reason not given (G9299)|G9299',9),

('PQRS_0352', 'description', 'Total Knee Replacement: Preoperative Antibiotic Infusion with Proximal Tourniquet',''),
('PQRS_0352', 'question', 'Did the patient have the prophylactic antibiotic completely infused prior to the inflation of the proximal tourniquet (tourniquet around the proximal thigh)?',''),
('PQRS_0352', 'answer', '1|The prophylactic antibiotic was completely infused prior to the inflation of the proximal tourniquet (G9301)|G9301',1),
('PQRS_0352', 'answer', '2|Documentation of medical reason(s) for not completely infusing the prophylactic antibiotic prior to the inflation of the proximal tourniquet (G9300)|G9300',2),
('PQRS_0352', 'answer', '3|Prophylactic antibiotic not completely infused prior to the inflation of the proximal tourniquet, reason not given (G9302)|G9302',9),

('PQRS_0353', 'description', 'Total Knee Replacement: Identification of Implanted Prosthesis in Operative Report',''),
('PQRS_0353', 'question', 'Did the operative report identify the prosthetic implant specifications including the prosthetic implant manufacturer, the brand name of the prosthetic implant and the size of each prosthetic implant? ',''),
('PQRS_0353', 'answer', '1|Operative report identifies the prosthetic implant specifications (G9304)|G9304',1),
('PQRS_0353', 'answer', '2|Operative report does not identify the prosthetic implant specifications, reason not given (G9303)|G9303',9),

('PQRS_0354', 'description', 'Anastomotic Leak Intervention <br>INVERSE MEASURE',''),
('PQRS_0354', 'question', 'Did the patient require intervention for presence of a leak of endoluminal contents or of fluids related to an abcess, through an anastomosis?',''),
('PQRS_0354', 'answer', '1|Intervention for presence of leak of endoluminal contents or abcess through an anastomosis required (G9306)|G9306',1),
('PQRS_0354', 'answer', '2|Intervention for presence of leak of endoluminal or abcess contents through an anastomosis not required (G9305)|G9305',9),

('PQRS_0355', 'description', 'Unplanned Reoperation within the 30 Day Postoperative Period <br>INVERSE MEASURE',''),
('PQRS_0355', 'question', 'Did the patient experience an unplanned return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure?',''),
('PQRS_0355', 'answer', '1|Unplanned return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure (G9308)|G9308',1),
('PQRS_0355', 'answer', '2|No return to the operating room for a surgical procedure, for any reason, within 30 days of the principal operative procedure (G9307)|G9307',9),

('PQRS_0356', 'description', ' Unplanned Hospital Readmission within 30 Days of Principal Procedure <br>INVERSE MEASURE',''),
('PQRS_0356', 'question', 'Did the patient experience readmission to the same hospital for any reason or an outside hospital (if known to the surgeon), within 30 days of the principal surgical procedure?',''),
('PQRS_0356', 'answer', '1|Unplanned hospital readmission within 30 days of principal procedure (G9310)|G9310',1),
('PQRS_0356', 'answer', '2|No unplanned hospital readmission within 30 days of principal procedure (G9309)|G9309',9),

('PQRS_0357', 'description', 'Surgical Site Infection (SSI) <br>INVERSE MEASURE',''),
('PQRS_0357', 'question', 'Did the patients experience a Superficial Incisional, Deep Incisional, Organ or Organ space surgical site infection within 30 days after operation?',''),
('PQRS_0357', 'answer', '1|Surgical site infection (G9312)|G9312',1),
('PQRS_0357', 'answer', '2|No surgical site infection (G9311)|G9311',9),

('PQRS_0358', 'description', 'Patient-Centered Surgical Risk Assessment and Communication',''),
('PQRS_0358', 'question', 'Did the patient have a surgical risk assessment performed with a validated risk calculator followed by a discussion with the surgeon regarding personal risk for post operative complications? ',''),
('PQRS_0358', 'answer', '1|Documentation of a patient-specific risk assessment and communication of risk results with the patient or family (G9316)|G9316',1),
('PQRS_0358', 'answer', '2|No documention of both a patient-specific risk assessment and communication of risk results with the patient or family or (G9317)|G9317',9),

('PQRS_0360', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Count of Potential High Dose Radiation Imaging Studies: Computed Tomography (CT) and Cardiac Nuclear Medicine Studies',''),
('PQRS_0360', 'question', 'Did the CT or cardiac nuclear medicine (myocardial perfusion studies) imaging reports document a count of known previous CT and cardiac nuclear medicine studies that the patient has received in the 12-month period prior to the current study?',''),
('PQRS_0360', 'answer', '1|Count of previous CT and cardiac nuclear medicine studies documented in the 12-month period prior to the current study (G9321)|G9321',1),
('PQRS_0360', 'answer', '2|Count of previous CT and cardiac nuclear medicine studies not documented in the 12-month period prior to the current study, reason not given (G9322)|G9322',9),

('PQRS_0361', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Reporting to a Radiation Dose Index Registry',''),
('PQRS_0361', 'question', ' Was the patient CT study reported to a radiation dose index registry that is capable of collecting at a minimum all of the following data elements: <br><li>Manufacturer<li>Study description<li>Manufacturer`s model name<li>Patient\'s weight<li>Patient\'s size<li>Patient\'s sex<li>Patient\'s age<li>Exposure time<li>X-Ray tube current<li>Kilovoltage (kV)<li>Mean Volume Computed tomography dose index (CTDIvol)<li>Dose-length product (DLP)',''),
('PQRS_0361', 'answer', '1|CT studies performed reported to a radiation dose index registry with all necessary data elements (G9327)|G9327',1),
('PQRS_0361', 'answer', '2|CT studies performed not reported to a radiation dose index registry, reason not given (G9326)|G9326',9),

('PQRS_0362', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Computed Tomography (CT) Images Available for Patient Follow-up and Comparison Purposes',''),
('PQRS_0362', 'question', 'Did the final CT studie report document that DICOM format image data are available to non-affiliated external healthcare facilities or entities on a secure, media-free, reciprocally searchable basis with patient authorization for at least a 12-month period after the study?',''),
('PQRS_0362', 'answer', '1|Final report documented that DICOM format image data available to non-affiliated external healthcare facilities or entities on a secure, media free, reciprocally searchable basis with patient authorization for at least a 12-month period after the study (G9340)|G9340',1),
('PQRS_0362', 'answer', '2|No documentation that a DICOM format image data is available (G9329)|G9329',9),

('PQRS_0364', 'description', 'Optimizing Patient Exposure to Ionizing Radiation: Appropriateness: Follow-up CT Imaging for Incidentally Detected Pulmonary Nodules According to Recommended Guidelines',''),
('PQRS_0364', 'question', 'Did final reports with document appropriate follow-up recommendations for incidentally detected pulmonary nodules (e.g., follow-up CT imaging studies needed or that no follow-up is needed) based at a minimum on nodule size AND patient risk factors?',''),
('PQRS_0364', 'answer', '1|Follow-up recommendations documented according to recommended guidelines for incidentally detected pulmonary nodules (e.g., follow-up CT imaging studies needed or that no follow-up is needed) based at a minimum on nodule size AND patient risk factors (G9345)|G9345',1),
('PQRS_0364', 'answer', '2|Documentation of medical reason(s) that follow-up imaging is indicated (G9755)|G9755',2),
('PQRS_0364', 'answer', '3|Follow-up recommendations not documented or don\'t follow recommended guidelines for incidentally detected pulmonary nodules, reason not given (G9347)|G9347',9),

('PQRS_0370', 'description', 'Depression Remission at Twelve Months',''),
('PQRS_0370', 'question', 'Did the patient achieve remission at twelve months as demonstrated by a twelve month (+/- 30 days) PHQ-9 score of less than five?',''),
('PQRS_0370', 'answer', '1|Remission at twelve months as demonstrated by a twelve month (+/-30 days) PHQ-9 score of less than 5 (G9509)|G9509',1),
('PQRS_0370', 'answer', '2|PHQ-9 score was not assessed OR twelve month (+/-30 days) PHQ9 score is greater than or equal to 5 (G9510)|G9510',9),

('PQRS_0374', 'description', 'Closing The Referral Loop: Receipt of Specialist Report',''),
('PQRS_0374', 'question', 'Did the referring provider receive a follow up report about the patient, from the provider to whom the patient was referred?',''),
('PQRS_0374','answer',  '1,The referring provider received a report from the provider to whom the patient was referred (G9969)|G9969',1),
('PQRS_0374', 'answer', '2|The referring provider did not receive a report from the provider to whom the patient was referred (G9970)|G9970',9),

('PQRS_0383', 'description', 'Adherence to Antipsychotic Medications For Individuals with Schizophrenia',''),
('PQRS_0383', 'question', 'Did the individual have a Proportion of Days Covered (PDC) of at least 0.8 for antipsychotic medications?',''),
('PQRS_0383', 'answer', '1|Individual had a PDC of 0.8 or greater (G9512)|G9512',1),
('PQRS_0383', 'answer', '2|Individual did not have a PDC of 0.8 or greater (G9513)|G9513',9),

('PQRS_0384', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: No Return to the Operating Room Within 90 Days of Surgery',''),
('PQRS_0384', 'question', 'Did the patient return to the operating room within 90 days for complications within the operative eye?',''),
('PQRS_0384', 'answer', '1|Patient did not require a return to the operating room within 90 days of surgery (G9515)|G9515',1),
('PQRS_0384', 'answer', '2|Patient required a return to the operating room within 90 days of surgery (G9514)|G9514',9),

('PQRS_0385', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: Visual Acuity Improvement Within 90 Days of Surgery',''),
('PQRS_0385', 'question', 'Did the patient achieve improvement in their visual acuity, from their preoperative level, within 90 days of surgery in the operative eye?',''),
('PQRS_0385', 'answer', '1|Patient achieved improvement in visual acuity within 90 days of surgery (G9516)|G9516',1),
('PQRS_0385', 'answer', '2|Patient did not achieve an improvement in visual acuity within 90 days of surgery, reason not given (G9517)|G9517',9),

('PQRS_0386', 'description', 'Amyotrophic Lateral Sclerosis (ALS) Patient Care Preferences',''),
('PQRS_0386', 'question', ' Was the patient offered assistance in planning for end of life issues (e.g., advance directives, invasive ventilation, or hospice) at least once annually?',''),
('PQRS_0386', 'answer', '1|Patient offered assistance with end of life issues during the measurement period (G9380)|G9380',1),
('PQRS_0386', 'answer', '2|Patient not offered assistance with end of life issues during the measurement period (G9382)|G9382',9),

('PQRS_0387', 'description', 'Annual Hepatitis C Virus (HCV) Screening for Patients who are Active Injection Drug Users',''),
('PQRS_0387', 'question', 'Did the patient receive screening lab test for HCV infection within the 12 month reporting period?',''),
('PQRS_0387', 'answer', '1|Patient received screening for HCV infection within the 12 month reporting period (G9383)|G9383',1),
('PQRS_0387', 'answer', '2|Documentation of medical reason(s) for not receiving annual screening for HCV infection (G9384)|G9384',2),
('PQRS_0387', 'answer', '3|Documentation of patient reason(s) for not receiving annual screening for HCV infection (G9385)|G9385',2),
('PQRS_0387', 'answer', '4|Screening for HCV infection not done within the 12 month reporting period, reason not given (G9386)|G9386',9),

('PQRS_0388', 'description', 'Cataract Surgery with Intra-Operative Complications (Unplanned Rupture of Posterior Capsule Requiring Unplanned Vitrectomy',''),
('PQRS_0388', 'question', 'Did the patient experience an unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery?<br>INVERSE MEASURE',''),
('PQRS_0388', 'answer', '1|Unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery (G9389)|G9389',1),
('PQRS_0388', 'answer', '2|No unplanned rupture of the posterior capsule requiring vitrectomy during cataract surgery (G9390)|G9390',9),

('PQRS_0389', 'description', 'Cataract Surgery: Difference Between Planned and Final Refraction',''),
('PQRS_0389', 'question', 'Did the patient achieve a final refraction (spherical equivalent) +/- 1.0 diopters of their planned (target) refraction (spherical equivalent) within 90 days following cataract surgery?',''),
('PQRS_0389', 'answer', '1|Patient achieves final refraction (spherical equivalent) +/- 1.0 Diopters of their planned refraction within 90 days of surgery (G9519)|G9519',1),
('PQRS_0389', 'answer', '2|Patient does not achieve final refraction (spherical equivalent) +/- 1.0 Diopters of their planned refraction within 90 days of surgery (G9520)|G9520',9),

('PQRS_0390', 'description', 'Hepatitis C: Discussion and Shared Decision Making Surrounding Treatment Options',''),
('PQRS_0390', 'question', 'Did a qualified healthcare professional review the range of genotype appropriate treatment options with the patient, following a shared decision making approach?',''),
('PQRS_0390', 'answer', '1|Discussion between the physician/clinician and the patient includes all of the following: treatment choices appropriate to genotype, risks and benefits, evidence of effectiveness, and patient preferences toward the outcome of the treatment (G9399)|G9399',1),
('PQRS_0390', 'answer', '2|Documentation of medical or patient reason(s) for not discussing treatment options (G9400)|G9400',2),
('PQRS_0390', 'answer', '3|No documentation of a discussion with the patient that includes all of the following: treatment choices appropriate to genotype, risks and benefits, evidence of effectiveness, and patient preferences toward treatment (G9401)|G9401',9),

('PQRS_0391', 'description', 'Follow-Up After Hospitalization for Mental Illness (FUH)',''),
('PQRS_0391', 'question', 'NUMERATOR (REPORTING CRITERIA 1): <br> Did the patient receive follow-up by a mental health practiioner within 30 days after acute inpatient discharge?<br> CRITERIA 2:<br> Did the patient receive follow-up by a mental health practitioner within 7 days after acute inpatient discharge?',''),
('PQRS_0391', 'answer', '1|Patient received follow-up within 30 days after discharge (G9402)|G9402',1),
('PQRS_0391', 'answer', '2|Clinician documented reason patient was not able to complete 30 day follow-up(G9403)|G9403',2),
('PQRS_0391', 'answer', '3|Patient did not receive follow-up within 30 days after discharge (G9404)|G9404',9),
('PQRS_0391', 'answer', '4|Patient received follow-up within 7 days after discharge (G9405)|G9405',1),
('PQRS_0391', 'answer', '5|Clinician documented reason patient was not able to complete 7 day follow-up (G9406)|G9406',2),
('PQRS_0391', 'answer', '6|Patient did not receive follow-up within 7 days after discharge (G9407)|G9407',9),

('PQRS_0392', 'description', 'HRS-12: Cardiac Tamponade and/or Pericardiocentesis Following Atrial Fibrillation Ablation <br>INVERSE MEASURE',''),
('PQRS_0392', 'question', 'Did the patient experience cardiac tamponade and/or pericardiocentesis within 30 days following atrial fibrillation ablation? ',''),
('PQRS_0392', 'answer', '1|Patient with cardiac tamponade and/or pericardiocentesis occurring within 30 days (G9408)|G9408',1),
('PQRS_0392', 'answer', '2|Patient without cardiac tamponade and/or pericardiocentesis occurring within 30 days (G9409)|G9409',9),

('PQRS_0393', 'description', 'HRS-9: Infection within 180 Days of Cardiac Implantable Electronic Device (CIED) Implantation, Replacement, or Revision <br>INVERSE MEASURE',''),
('PQRS_0393', 'question', 'Was the number patient  admitted with an infection requiring device removal or surgical revision within 180 days following CIED implantation, replacement, or revision?',''),
('PQRS_0393', 'answer', '1|Patient admitted within 180 days post new CIED implantation, with an infection requiring device removal or surgical revision (G9410)|G9410',1),
('PQRS_0393', 'answer', '2|Patient not admitted within 180 days post new CIED implantation, with an infection requiring device removal or surgical revision (G9411)|G9411',9),
('PQRS_0393', 'answer', '3|Patient with replacement or revision of a CIED admitted within 180 days post CIED replacement or revision, with an infection requiring device removal or surgical revision (G9412)|G9412',1),
('PQRS_0393', 'answer', '4|Patient with replacement or revision of a CIED not admitted within 180 days post CIED replacement or revision, with an infection requiring device removal or surgical revision (G9413)|G9413',9),

('PQRS_0394', 'description', 'Immunizations for Adolescents.  NOT A RECOMMENDED MEASURE',''),
('PQRS_0394', 'question', 'Did the patient have some or all of the recommended immunizations for adolescents by his or her 13th birthday?',''),
('PQRS_0394', 'answer', '1|Patient had one dose of meningococcal vaccine at age 11 or 12,  *AND* one Tdap OR Td vaccine at age 10,11 or 12 and 2 or 3 HPV vaccines between patient\'s 9th and 13th birthdays (G9414 G9416)|G9414 G9416',1),
('PQRS_0394', 'answer', '2|Patient had one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9414) *AND* Patient did not have one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9417) (G9414 G9417)|G9414 G9417',9),
('PQRS_0394', 'answer', '3|Patient did not have one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9415) *AND* Patient had one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9416) (G9415 G9416)|G9415 G9416',1),
('PQRS_0394', 'answer', '4|Patient did not have one dose of meningococcal vaccine on or between the patient\'s 11th and 13th birthdays (G9415) *AND* Patient did not have one tetanus, diphtheria toxoids and acellular pertussis vaccine (Tdap) OR one tetanus, diphtheria toxoids vaccine (Td) on or between the patient\'s 10th and 13th birthdays OR one tetanus and one diphtheria vaccine on or between the patient\'s 10th and 13th birthdays (G9417) (G9415 G9417)|G9415 G9417',9),

('PQRS_0395', 'description', 'Lung Cancer Reporting (Biopsy/Cytology Specimens)',''),
('PQRS_0395', 'question', 'Was the biopsy and cytology specimen report classified into specific histologic type (squamous cell carcinoma, adenocarcinoma) OR classified as NSCLC-NOS with an explanation included in the pathology report',''),
('PQRS_0395', 'answer', '1|Biopsy and cytology specimen report documents classification into specific histologic type OR classified as NSCLC-NOS with an explanation (G9418)|G9418',1),
('PQRS_0395', 'answer', '2|Documentation of medical reason(s) for not including the histological type OR NSCLC-NOS classification (G9419)|G9419',2),
('PQRS_0395', 'answer', '3|Biopsy and cytology specimen report does not document classification into specific histologic type OR as NSCLC-NOS (G9421)|G9421',9),

('PQRS_0396', 'description', 'Lung Cancer Reporting (Resection Specimens)',''),
('PQRS_0396', 'question', 'Did the pathology report based on resection include the pT category, pN category and for non-small cell lung cancer, histologic type?',''),
('PQRS_0396', 'answer', '1|Resection report includes the pT category, pN category and for Non-Small Cell Lung Cancer, Histologic Type (G9422)|G9422',1),
('PQRS_0396', 'answer', '2|Documented Medical Reasons for  not including pT category, pN category and for Non Small Cell Lung Cancer, Histologic Typein the resection report (G9423)|G9423',2),
('PQRS_0396', 'answer', '3|Resection report does not include the pT category, pN category and for Non-Small Cell Lung Cancer, Histologic Type reason not Given (G9425)|G9425',9),

('PQRS_0397', 'description', 'Melanoma Reporting',''),
('PQRS_0397', 'question', 'Did the pathology report include the pT category and a statement on thickness and ulceration and for pT1, mitotic rate?',''),
('PQRS_0397', 'answer', '1|Pathology Report Includes the pT Category and a Statement on Thickness and Ulceration and for pT1, mitotic rate (G9428)|G9428',1),
('PQRS_0397', 'answer', '2|Documentation of medical reason(s) for not including pT Category and a statement on thickness and ulceration and for pT1, mitotic rate (G9429)|G9429',2),
('PQRS_0397', 'answer', '3|Pathology report does not include the pT Category and a statement on thickness and ulceration and for pT1, mitotic rate (G9431)|G9431',9),

('PQRS_0398', 'description', 'Optimal Asthma Control.  NOT A RECOMMENDED MEASURE',''),
('PQRS_0398', 'question', 'Asthma well-controlled (take the most recent asthma control tool available during the measurement period)<br><li>Asthma Control TestTM (ACT) score of 20 or above - ages 12 and older<li>Childhood Asthma Control Test (C-ACT) score of 20 or above - ages 11 and younger<li>Asthma Control Questionnaire (ACQ) score of 0.75 or lower - ages 17 and older<li>Asthma Therapy Assessment Questionnaire (ATAQ) score of 0 -- Pediatric (ages 5 -- 17) or Adult (ages 18 and older)<br><center>AND</center><br>Patient not at elevated risk of exacerbation -- less than two<li>Emergency department visits not resulting in a hospitalization due to asthma in last 12 months<li>Inpatient hospitalizations requiring an overnight stay due to asthma in last 12 months.',''),
('PQRS_0398', 'answer', '1|Asthma well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score and results documented (G9432) *AND* Total number of emergency department visits and inpatient hospitalizations less than two in the past 12 months (G9521) (G9432 G9521)|G9432 G9521',1),
('PQRS_0398', 'answer', '2|Asthma not well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score, OR specified asthma control tool not used, reason not given (G9434) *AND* Total number of emergency department visits and inpatient hospitalizations less than two in the past 12 months (G9521) (G9434 G9521)|G9434 G9521',1),
('PQRS_0398', 'answer', '3|Asthma well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score and results documented (G9432) *AND* Total number of emergency department visits and inpatient hospitalizations equal to or greater than two in the past 12 months OR patient not screened, reason not given (G9522) (G9432 G9522)|G9432 G9522',1),
('PQRS_0398', 'answer', '4|Asthma not well-controlled based on the ACT, C-ACT, ACQ, or ATAQ score, OR specified asthma control tool not used, reason not given (G9434) *AND* Total number of emergency department visits and inpatient hospitalizations equal to or greater than two in the past 12 months OR patient not screened, reason not given (G9522) (G9434 G9522)|G9434 G9522',9),

('PQRS_0400', 'description', 'One-Time Screening for Hepatitis C Virus (HCV) for Patients at Risk',''),
('PQRS_0400', 'question', 'Did the patient receive one-time screening for HCV infection?',''),
('PQRS_0400', 'answer', '1|Patient received one-time screening for HCV infection (G9451)|G9451',1),
('PQRS_0400', 'answer', '2|Documentation of medical reason(s) for patient not receiving one-time screening for HCV infection (G9452)|G9452',2),
('PQRS_0400', 'answer', '3|Documentation of patient reason(s) for not receiving one-time screening for HCV infection (G9453)|G9453',2),
('PQRS_0400', 'answer', '4|One-time screening for HCV infection not done and no documentation of prior screening for HCV infection, reason not given (G9454)|G9454',9),

('PQRS_0401', 'description', 'Hepatitis C: Screening for Hepatocellular Carcinoma (HCC) in Patients with Cirrhosis',''),
('PQRS_0401', 'question', 'Did the patient undergo abdominal imaging with either ultrasound, contrast enhanced CT or MRI',''),
('PQRS_0401', 'answer', '1|Patient underwent abdominal imaging with ultrasound, contrast enhanced CT or contrast MRI for HCC (G9455)|G9455',1),
('PQRS_0401', 'answer', '2|Documentation of medical or patient reason(s) for not ordering or performing screening for HCC (G9456)|G9456',2),
('PQRS_0401', 'answer', '3|Patient did not undergo abdominal imaging and did not have a documented reason for not undergoing abdominal imaging (G9457)|G9457',9),

('PQRS_0402', 'description', 'Tobacco Use and Help with Quitting Among Adolescents',''),
('PQRS_0402', 'question', 'Was the patient screened for tobacco use at least once within 18 months AND receive tobacco cessation counseling intervention if identified as a tobacco user?',''),
('PQRS_0402', 'answer', '1|Patient documented as tobacco user AND received brief tobacco cessation intervention (G9458)|G9458',1),
('PQRS_0402', 'answer', '2|Currently a tobacco non-user (G9459)|G9459',2),
('PQRS_0402', 'answer', '3|Tobacco assessment OR tobacco cessation intervention not performed, reason not given (G9460)|G9460',9),

('PQRS_0403', 'description', 'Adult Kidney Disease: Referral to Hospice',''),
('PQRS_0403', 'question', 'Was the patients referred to hospice care?',''),
('PQRS_0403', 'answer', '1|Patient was referred to hospice care (G9524)|G9524',1),
('PQRS_0403', 'answer', '2|Documentation of patient reason(s) for not referring to hospice care (G9525)|G9525',2),
('PQRS_0403', 'answer', '3|Patient was not referred to hospice care, reason not given (G9526)|G9526',9),

('PQRS_0404', 'description', 'Anesthesiology Smoking Abstinence',''),
('PQRS_0404', 'question', 'Did the patient abstain from smoking prior to anesthesia on the day of surgery or procedure?',''),
('PQRS_0404', 'answer', '1|Patients abstained from smoking prior to anesthesia on the day of surgery or procedure (G9644)|G9644',1),
('PQRS_0404', 'answer', '2|Patient did not abstain from smoking prior to anesthesia on the day of surgery or procedure (G9645)|G9645',9),

('PQRS_0405', 'description', 'Appropriate Follow-up Imaging for Incidental Abdominal Lesions.<br>INVERSE MEASURE  ',''),
('PQRS_0405', 'question', 'Did final imaging study reports recommend follow-up imaging?',''),
('PQRS_0405', 'answer', '1|Final reports for abdominal imaging recommend followup imaging (G9548)|G9548',1),
('PQRS_0405', 'answer', '2|Documentation of medical reason(s) that follow-up imaging is indicated (G9549)|G9549',2),
('PQRS_0405', 'answer', '3|Final reports for abdominal imaging studies, followup imaging not recommended (G9550)|G9550',9),

('PQRS_0406', 'description', 'Appropriate Follow-up Imaging for Incidental Thyroid Nodules in Patients <br>INVERSE MEASURE ',''),
('PQRS_0406', 'question', 'Did final reports for CT or MRI of the chest or neck or ultrasound of the neck recommend follow-up imaging for a thyroid nodule finding of &lt; 1.0 cm?',''),
('PQRS_0406', 'answer', '1|Follow-up imaging recommended in final report (G9554)|G9554',1),
('PQRS_0406', 'answer', '2|Documentation of medical reason(s) for requiring follow up imaging (G9555)|G9555',2),
('PQRS_0406', 'answer', '3|Follow-up imaging not recommended in final report (G9556)|G9556',9),

('PQRS_0407', 'description', 'Appropriate Treatment of Methicillin-Susceptible Staphlococcus Aureus (MSSA) Bacteremia',''),
('PQRS_0407', 'question', 'Was the patients treated with a beta-lactam antibiotic (e.g. nafcillin, oxacillin or cefazolin) as definitive therapy?',''),
('PQRS_0407', 'answer', '1|Patient treated with a beta-lactam antibiotic as definitive therapy (G9558)|G9558',1),
('PQRS_0407', 'answer', '2|Documentation of medical reason(s) for not prescribing a Beta-lactam antibiotic (G9559)|G9559',2),
('PQRS_0407', 'answer', '3|Patient not treated with a beta-lactam antibiotic as definitive therapy, reason not given (G9560)|G9560',9),

('PQRS_0408', 'description', 'Opioid Therapy Follow-up Evaluation',''),
('PQRS_0408', 'question', 'Did the patient have a follow-up evaluation conducted at least every three months during opioid therapy?',''),
('PQRS_0408', 'answer', '1|A follow-up evaluation was conducted at least every three months during opioid therapy (G9562)|G9562',1),
('PQRS_0408', 'answer', '2|A follow-up evaluation was not conducted at least every three months during opioid therapy (G9563)|G9563',9),

('PQRS_0409', 'description', 'Clinical Outcome Post Endovascular Stroke Treatment',''),
('PQRS_0409', 'question', 'Did the patient have a Modified Rankin Scale (mRS) score of 0 to 2 at 90 days after undergoing endovascular stroke treatment?',''),
('PQRS_0409', 'answer', '1|90 day mRS score of 0 to 2 (G9646)|G9646',1),
('PQRS_0409', 'answer', '2|mRS score could not be obtained at 90 day follow-up (G9647)|G9647',2),
('PQRS_0409', 'answer', '3|90 day mRS score greater than 2 (G9648)|G9648',9),

('PQRS_0410', 'description', 'Psoriasis: Clinical Response to Oral Systemic or Biologic Medications',''),
('PQRS_0410', 'question', 'Did patient with psoriasis vulgaris have a documented Physician global assessment (PGA) rating of 2 or less, Body surface area (BSA) of less than 3%, Psoriasis area and severity index (PASI) of < 3 OR a  Dermatology life quality index (DLQI) of less than or equal to 5?',''),
('PQRS_0410', 'answer', '1|Psoriasis assessment tool documented meeting any one of the specified benchmarks (G9649)|G9649',1),
('PQRS_0410', 'answer', '2|Documentation that the patient declined therapy change or alternative therapies are unavailable, has documented contraindications or has not been treated with an oral or systemic biologic in at least 6 consecutive months in order to achieve better disease control as measured by PGA, BSA, PASI, or DLQI (G9765)|G9765',2),
('PQRS_0410', 'answer', '3|Psoriasis assessment tool documented not meeting any one of the specified benchmarks OR psoriasis assessment tool not documented (G9651)|G9651',9),

('PQRS_0411', 'description', 'Depression Remission at Six Months',''),
('PQRS_0411', 'question', 'Did the patient achieve remission at six months as demonstrated by a six month (+/- 30 days) PHQ-9 score of less than five?',''),
('PQRS_0411', 'answer', '1|The six month (+/-30 days) PHQ-9 score is less than five (G9573)|G9573',1),
('PQRS_0411', 'answer', '2|Remission at six months not demonstrated. Either PHQ-9 score was not assessed or is greater than or equal to five. (G9574)|G9574',9),

('PQRS_0412', 'description', 'Documentation of Signed Opioid Treatment Agreement',''),
('PQRS_0412', 'question', 'Did the patient sign an opioid treatment agreement at least once during opioid therapy?',''),
('PQRS_0412', 'answer', '1|Documentation of signed opioid treatment agreement at least once during opioid therapy (G9578)|G9578',1),
('PQRS_0412', 'answer', '2|No documentation of signed an opioid treatment agreement during opioid therapy (G9579)|G9579',9),

('PQRS_0413', 'description', 'Door to Puncture Time for Endovascular Stroke Treatment',''),
('PQRS_0413', 'question', 'Did the patient have a door to puncture time of less than 2 hours after undergoing endovascular stroke treatment?',''),
('PQRS_0413', 'answer', '1|Door to puncture time of less than 2 hours (G9580)|G9580',1),
('PQRS_0413', 'answer', '2|Door to puncture time of greater than 2 hours, no reason given (G9582)|G9582',9),

('PQRS_0414', 'description', 'Evaluation or Interview for Risk of Opioid Misuse ',''),
('PQRS_0414', 'question', 'Was the patients evaluated for risk of misuse of opiates using a validated tool or patient interview at least once during opioid therapy?',''),
('PQRS_0414', 'answer', '1|Patient evaluated for risk of misuse of opiates at least once during opioid therapy (G9584)|G9584',1),
('PQRS_0414', 'answer', '2|Patient not evaluated for risk of misuse of opiates at least once during opioid therapy (G9585)|G9585',9),

('PQRS_0415', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 18 Years and Older',''),
('PQRS_0415', 'question', 'Did the patient have an appropriate indication for a head CT?',''),
('PQRS_0415', 'answer', '1|Patient with minor blunt head trauma had an appropriate indication(s) for a head CT (G9529)|G9529',1),
('PQRS_0415', 'answer', '2|Patient with minor blunt head trauma did not have an appropriate indication(s) for a head CT (G9533)|G9533',9),

('PQRS_0416', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 2 through 17 Years <br>INVERSE MEASURE',''),
('PQRS_0416', 'question', 'Was the patient receiveing a head CT in the ED classified as low risk  for traumatic brain injury?',''),
('PQRS_0416', 'answer', '1|Classified as low risk according to the PECARN prediction rules (G9593)|G9593',1),
('PQRS_0416', 'answer', '2|Not classified as low risk according to the PECARN prediction rules (G9597)|G9597',9),

('PQRS_0417', 'description', 'Rate of Open Repair of Abdominal Aortic Aneurysms (AAA) Where Patients Are Discharged Alive',''),
('PQRS_0417', 'question', 'Was the patient discharged alive/home following open repair of asymptomatic AAA in men with &lt; 6 cm diameter and women with &lt; 5.5 cm diameter AAA?',''),
('PQRS_0417', 'answer', '1|Patient discharged no later than post-operative day #7 (G9601)|G9601',1),
('PQRS_0417', 'answer', '2|Patient not discharged by post-operative day #7 (G9602)|G9602',9),

('PQRS_0418', 'description', 'Osteoporosis Management in Women Who Had a Fracture',''),
('PQRS_0418', 'question', 'Did the patient receive either a bone mineral density test or a prescription for a drug to treat osteoporosis in the 6 months after the fracture?',''),
('PQRS_0418', 'answer', '1|Central Dual-energy X-Ray Absorptiometry (DXA) performed, results documented (3095F)|3095F',1),
('PQRS_0418', 'answer', '2|Pharmacologic therapy (other than minerals/vitamins) for osteoporosis prescribed (G8633)|G8633',1),
('PQRS_0418', 'answer', '3|Central dual energy X-ray absorptiometry (DXA) was not performed, reason not given (3095F:8P)|3095F:8P',9),
('PQRS_0418', 'answer', '4|Pharmacologic therapy for osteoporosis was not prescribed, reason not given (G8635)|G8635',9),

('PQRS_0419', 'description', 'Overuse Of Neuroimaging For Patients With Primary Headache And A Normal Neurological Examination',''),
('PQRS_0419', 'question', 'Was advanced brain imaging (CTA, CT, MRA or MRI) ordered for the patient with a normal neurological examination?',''),
('PQRS_0419', 'answer', '1|Advanced brain imaging (CTA, CT, MRA or MRI) was NOT ordered (G9534)|G9534',1),
('PQRS_0419', 'answer', '2|Documentation of Medical reason(s) for ordering an advanced brain imaging study (G9536)|G9536',2),
('PQRS_0419', 'answer', '3|Documentation of System reason(s) for ordering an advanced brain imaging study (G9537)|G9537',2),
('PQRS_0419', 'answer', '4|Advanced brain imaging (CTA, CT, MRA or MRI) was ordered (G9538)|G9538',9),

('PQRS_0420', 'description', 'Varicose Vein Treatment with Saphenous Ablation: Outcome Survey',''),
('PQRS_0420', 'question', 'Did the patient outcome survey score improve from baseline, when assessed 3-6 months following treatment?',''),
('PQRS_0420', 'answer', '1|Patient survey score improved from baseline following treatment (G9603)|G9603',1),
('PQRS_0420', 'answer', '2|Patient survey results not available (G9604)|G9604',2),
('PQRS_0420', 'answer', '3|Patient survey score did not improve from baseline following treatment (G9605)|G9605',9),

('PQRS_0421', 'description', 'Appropriate Assessment of Retrievable Inferior Vena Cava (IFC) Filters for Removal',''),
('PQRS_0421', 'question', 'Was the patient assessed for appropriateness of continued filtration, device removal or unable to locate, within 3 months of IFC filter placement?',''),
('PQRS_0421', 'answer', '1|Filter removed within 3 months of placement (G9541)|G9541',1),
('PQRS_0421', 'answer', '2|Documentation of reassessment for appropriateness of filter removal (G9542)|G9542',1),
('PQRS_0421', 'answer', '3|Documentation of at least 2 failed attempts to arrange for clinical reassessment within 3 months of device placement (G9543)|G9543',1),
('PQRS_0421', 'answer', '4|No documentation that filter was removed, reassessed or at least 2 attempts made to contact patient, within 3 months (G9544)|G9544',9),

('PQRS_0422', 'description', 'Performing Cystoscopy at the Time of Hysterectomy for Pelvic Organ Prolapse to Detect Lower Urinary Tract Injury',''),
('PQRS_0422', 'question', 'Was an intraoperative cystoscopy performed to evaluate for lower urinary tract injury at the time of hysterectomy?',''),
('PQRS_0422', 'answer', '1|Intraoperative cystoscopy performed to evaluate for lower tract injury (G9606)|G9606',1),
('PQRS_0422', 'answer', '2|Documented medical reason for not performing an intraoperative cystoscopy(G9607)|G9607',2),
('PQRS_0422', 'answer', '3|Intraoperative cystoscopy not performed to evaluate for lower tract injury (G9608)|G9608',9),

('PQRS_0424', 'description', 'Perioperative Temperature Management',''),
('PQRS_0424', 'question', 'Was at least one body temperature greater than or equal to 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) recorded within the 30 minutes immediately before or the 15 minutes immediately after anesthesia end time?',''),
('PQRS_0424', 'answer', '1|At least 1 body temperature measurement equal to or greater than 35.5 degrees Celsius (or 95.9 degrees Fahrenheit) recorded within specified time frame (G9771)|G9771',1),
('PQRS_0424', 'answer', '2|Documentation of  medical reason(s) for not achieving the specified temperature measurement within specified time frame (G9772)|G9772',2),
('PQRS_0424', 'answer', '3|Specified temperature measurement not achieved within specified time frame (G9773)|G9773',9),

('PQRS_0425', 'description', 'Photodocumentation of Cecal Intubation',''),
('PQRS_0425', 'question', 'Did the patient have photodocumentation of landmarks of cecal intubation to establish a completed colon screening or surveillance examination?',''),
('PQRS_0425', 'answer', '1|Photodocumentation of one or more cecal landmarks to establish a complete examination (G9612)|G9612',1),
('PQRS_0425', 'answer', '2|No photodocumentation of cecal landmarks to establish a complete examination (G9614)|G9614',9),

('PQRS_0428', 'description', 'Pelvic Organ Prolapse: Preoperative Assessment of Occult Stress Urinary Incontinence',''),
('PQRS_0428', 'question', 'Did the patient undergo a preoperative assessment that includes the following:<br>1) History about incontinence and its character <br>2) Urinalysis <br> 3) Physical exam testing for stress incontinence?',''),
('PQRS_0428', 'answer', '1|Preoperative assessment documented (G9615)|G9615',1),
('PQRS_0428', 'answer', '2|Documentation of reason(s) for not documenting a preoperative assessment (G9616)|G9616',2),
('PQRS_0428', 'answer', '3|Preoperative assessment not documented, reason not given (G9617)|G9617',9),

('PQRS_0429', 'description', 'Pelvic Organ Prolapse: Preoperative Screening for Uterine Malignancy',''),
('PQRS_0429', 'question', 'Was the patient screened for uterine malignancy or did she have an ultrasound and/or endometrial sampling of any kind prior to completion of surgery?',''),
('PQRS_0429', 'answer', '1|Documentation of screening for uterine malignancy, or ultrasound and/or endometrial sampling of any kind (G9618)|G9618',1),
('PQRS_0429', 'answer', '2|Not screened for uterine malignancy, no ultrasound and/or endometrial sampling of any kind done, reason not given (G9620)|G9620',9),

('PQRS_0430', 'description', 'Prevention of Post-Operative Nausea and Vomiting (PONV) -- Combination Therapy',''),
('PQRS_0430', 'question', 'Did the patient receive combination therapy consisting of at least two prophylactic anti-emetic agents of different classes preoperatively or intraoperatively?',''),
('PQRS_0430', 'answer', '1|Patient received at least 2 prophylactic pharmacologic anti-emetic agents of different classes (G9775)|G9775',1),
('PQRS_0430', 'answer', '2|Documentation of medical reason for not receiving at least 2 prophylactic pharmacologic anti-emetic agents (G9776)|G9776',2),
('PQRS_0430', 'answer', '3|Patient did not receive at least 2 prophylactic pharmacologic anti-emetic agents (G9777)|G9777',9),

('PQRS_0431', 'description', 'Preventive Care and Screening: Unhealthy Alcohol Use: Screening & Brief Counseling',''),
('PQRS_0431', 'question', 'Was the patient screened at least once within the last 24 months for unhealthy alcohol use AND receive brief counseling if identified as an unhealthy alcohol user?',''),
('PQRS_0431', 'answer', '1|Patient identified as an unhealthy alcohol user and received brief counseling (G9621)|G9621',1),
('PQRS_0431', 'answer', '2|Patient not identified as an unhealthy alcohol user when screened for unhealthy alcohol use (G9622)|G9622',1),
('PQRS_0431', 'answer', '3|Documentation of medical reason(s) for not screening for unhealthy alcohol use (G9623)|G9623',2),
('PQRS_0431', 'answer', '4|Patient not screened for unhealthy alcohol use OR patient did not receive brief counseling, reason not given (G9624)|G9624',9),

('PQRS_0432', 'description', 'Proportion of Patients Sustaining a Bladder Injury at the Time of any Pelvic Organ Prolapse Repair <br>INVERSE MEASURE',''),
('PQRS_0432', 'question', 'Did the patient sustain a bladder injury at the time of pelvic organ repair surgery or subsequently up to 1 month post-surgery?',''),
('PQRS_0432', 'answer', '1|Patient sustained bladder injury at the time of surgery or subsequently up to 1 month post-surgery (G9625)|G9625',1),
('PQRS_0432', 'answer', '2|Documentation of medical reason for not reporting bladder injury (G9626)|G9626',2),
('PQRS_0432', 'answer', '3|Patient did not sustain bladder injury at the time of surgery or subsequently up to 1 month post-surgery (G9627)|G9627',9),

('PQRS_0433', 'description', 'Proportion of Patients Sustaining a Bowel Injury at the time of any Pelvic Organ Prolapse Repair <br>INVERSE MEASURE',''),
('PQRS_0433', 'question', 'Did the patient sustain a bowel injury at the time of initial surgery or subsequently up to 1 month post-surgery?',''),
('PQRS_0433', 'answer', '1|Patient sustained a bowel injury at the time of surgery or subsequently up to 1 month post-surgery (G9628)|G9628',1),
('PQRS_0433', 'answer', '2|Documentation of medical reason for not reporting bowel injury (G9629)|G9629',2),
('PQRS_0433', 'answer', '3|Patient did not sustain a bowel injury at the time of surgery or subsequently up to 1 month post-surgery (G9630)|G9630',9),

('PQRS_0434', 'description', 'Proportion of Patients Sustaining a Ureter Injury at the Time of any Pelvic Organ Prolapse Repair? <br>INVERSE MEASURE',''),
('PQRS_0434', 'question', 'Did the patient receive a ureter injury at the time of initial surgery or subsequently up to 1 month post-surgery?',''),
('PQRS_0434', 'answer', '1|Patient sustained ureter injury at the time of surgery or  subsequently up to 1 month post-surgery (G9631)|G9631',1),
('PQRS_0434', 'answer', '2|Documentation of medical reason for not reporting ureter injury (G9632)|G9632',2),
('PQRS_0434', 'answer', '3|Patient did not sustain ureter injury at the time of surgery or subsequently up to 1 month post-surgery (G9633)|G9633',9),

('PQRS_0435', 'description', 'Quality of Life Assessment For Patients With Primary Headache Disorders',''),
('PQRS_0435', 'question', 'Was a patient health related quality of life assessed with a tool(s) during at least two visits during the 12 month measurement period AND did the score stay the same or improve?',''),
('PQRS_0435', 'answer', '1|Health-related quality of life assessed as specified and the score remained the same or improved (G9634)|G9634',1),
('PQRS_0435', 'answer', '2|Documented reason that Health-related quality of life not assessed (G9635)|G9635',2),
('PQRS_0435', 'answer', '3|Health-related quality of life not assessed OR quality of life score declined (G9636)|G9636',9),

('PQRS_0436', 'description', 'Radiation Consideration for Adult CT: Utilization of Dose Lowering Techniques',''),
('PQRS_0436', 'question', 'Did final reports document that an individualized dose optimization technique was used for the performed procedure? Dose optimization techniques include the following:<li>Automated exposure control<li>Adjustment of the mA and/or kV according to patient size<li>Use of iterative reconstruction technique',''),
('PQRS_0436', 'answer', '1|Final reports have documentation of utilization of one or more dose reduction techniques (G9637)|G9637',1),
('PQRS_0436', 'answer', '2|Final reports do not have documentation of one or more dose reduction techniques (G9638)|G9638',9),

('PQRS_0437', 'description', 'Rate of Surgical Conversion from Lower Extremity Endovascular Revascularization Procedure <br>INVERSE MEASURE',''),
('PQRS_0437', 'question', 'Did the patient undergo major amputation or open surgical bypass within 48 hours of the index endovascular lower extremity revascularization procedure?',''),
('PQRS_0437', 'answer', '1|Major amputation or open surgical bypass required within 48 hours of the index procedure (G9641)|G9641',1),
('PQRS_0437', 'answer', '2|Major amputation or open surgical bypass not required within 48 hours of the index procedure (G9639)|G9639',9),

('PQRS_0438', 'description', 'Statin Therapy for the Prevention and Treatment of Cardiovascular Disease',''),
('PQRS_0438', 'question', 'Was the patient already on statin therapy an was an order or prescription for statin therapy provided?',''),
('PQRS_0438', 'answer', '1|Patients is a current statin therapy user or received an order (prescription) for statin therapy (G9664)|G9664',1),
('PQRS_0438', 'answer', '2|Documentation of medical reason(s) for not being on statin therapy (G9781)|G9781',2),
('PQRS_0438', 'answer', '3|Patient not a current statin user or did not receive an order (prescription) for statin therapy, reason not given (G9665)|G9665',9),

('PQRS_0439', 'description', 'Age Appropriate Screening Colonoscopy <br>INVERSE MEASURE',''),
('PQRS_0439', 'question', 'Was the colonoscopy examination performed for screening purposes only?',''),
('PQRS_0439', 'answer', '1|No valid medical reason for a colonoscopy (G9659)|G9659',1),
('PQRS_0439', 'answer', '2|Documentation of medical reason(s) for a colonoscopy (G9660)|G9660',2),
('PQRS_0439', 'answer', '3|Documentation of other valid reason for a colonoscopy (G9661)|G9661',9),

('PQRS_0440', 'description', 'Basal Cell Carcinoma (BCC)/Squamous Cell Carcinoma: Biopsy Reporting Time from Pathologist to Clinician',''),
('PQRS_0440', 'question', 'Was the final pathology report sent from the Pathologist/Dermatopathologist to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist?',''),
('PQRS_0440', 'answer', '1|Pathology report sent to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist (G9785)|G9785',1),
('PQRS_0440', 'answer', '2|Pathology report was not sent from the Pathologist/Dermatopathologist to the biopsying clinician for review within 7 business days from the time when the tissue specimen was received by the pathologist (G9786)|G9786',9),

('PQRS_0441', 'description', ' Ischemic Vascular Disease (IVD) All or None Outcome Measure (Optimal Control) NOT A RECOMMENDED MEASURE, !INCOMPLETE! ',''),
('PQRS_0441', 'question', 'The number of IVD patients who meet ALL of the following targets: Most recent BP is less than 140/90 mm Hg And Most recent tobacco status is Tobacco Free (NOTE: If there is No Documentation of Tobacco Status thepatient is not compliant for this measure) And Daily Aspirin or Other Antiplatelet Unless Contraindicated And Statin Use.',''),
('PQRS_0441', 'answer', '1|Most recent BP is less than or equal to 140/90 mm Hg (G9788)|G9788',1),
('PQRS_0441', 'answer', '2|Blood pressure recorded during inpatient stays, Emergency Room Visits, Urgent Care Visits, and Patient Self-Reported BP?s (Home and Health Fair BP results) (G9789)|G9789',2),
('PQRS_0441', 'answer', '3|Most recent BP is greater than 140/90 mm Hg, or blood pressure not documented (G9790)|G9790',9),

('PQRS_0442', 'description', 'Persistence of Beta-Blocker Treatment After a Heart Attack',''),
('PQRS_0442', 'question', 'Was the patient prescribed a 180-day (6 month) course of treatment with beta-blockers post discharge for acute MI?',''),
('PQRS_0442', 'answer', '1|Patient prescribed a 180-day course of treatment with beta-blockers post discharge (G9803)|G9803',1),
('PQRS_0442', 'answer', '2|Patient was not prescribed a 180-day course of treatment with beta-blockers post discharge (G9804)|G9804',9),

('PQRS_0443', 'description', 'Non-Recommended Cervical Cancer Screening in Adolescent Females <br>INVERSE MEASURE',''),
('PQRS_0443', 'question', 'Did the patient receive cervical cytology or an HPV test during the measurement period? .',''),
('PQRS_0443', 'answer', '1|Patient received cervical cytology or an HPV test (G9806)|G9806',1),
('PQRS_0443', 'answer', '2|Patient did not receive cervical cytology or an HPV test (G9807)|G9807',9),

('PQRS_0444', 'description', 'Medication Management for People with Asthma',''),
('PQRS_0444', 'question', 'Did the patient achieve a proportion of days (PDC) of at least 75% for their asthma controller medications during the measurement year?',''),
('PQRS_0444', 'answer', '1|Patient achieved a PDC of at least 75% for their asthma controller medication (G9810)|G9810',1),
('PQRS_0444', 'answer', '2|Patient did not achieve a PDC of at least 75% for their asthma controller medication (G9811)|G9811',9),

('PQRS_0445', 'description', 'Risk-Adjusted Operative Mortality for Coronary Artery Bypass Graft (CABG) <br>INVERSE MEASURE',''),
('PQRS_0445', 'question', 'Did the patients undergoing isolated CABG die at any time during the hospitalization in which the operation was performed OR after discharge from the hospital, but within 30 days of the procedure?',''),
('PQRS_0445', 'answer', '1|Patient died during the index hospitalization OR after discharge from the hospital, but within 30 days of the procedure (G9812)|G9812',1),
('PQRS_0445', 'answer', '2|Patient did not die within 30 days of the procedure or during the index hospitalization (G9813)|G9813',9),

('PQRS_0446', 'description', ' Operative Mortality Stratified by the Five STS-EACTS Mortality Categories<br>INVERSE MEASURE<br> NOTE:  Answer needed for only ONE reporting criteria in this measure, then re-run the report.',''),
('PQRS_0446', 'question', 'Did patient death occur during the index hospitalization in which the procedure was performed? <BR> AND <BR> Did patient death occur after discharge from the hospital, but within 30 days of the procedure?',''),
('PQRS_0446', 'answer', '1|Death occurring during index acute care hospitalization (G9814)|G9814',1),
('PQRS_0446', 'answer', '2|Death did not occur during index acute care hospitalization (G9815)|G9815',9),
('PQRS_0446', 'answer', '3|Death occurring after discharge from hospital but within 30 days post procedure (G9816)|G9816',1),
('PQRS_0446', 'answer', '4|Death did not occur after discharge from hospital but within 30 days post procedure (G9817)|G9817',9),

('PQRS_0448', 'description', 'Appropriate Workup Prior to Endometrial Ablation',''),
('PQRS_0448', 'question', 'Did the patient receive endometrial sampling or hysteroscopy with biopsy and results documented any time during the year prior to the index date of the endometrial ablation?',''),
('PQRS_0448', 'answer', '1|Endometrial sampling or hysteroscopywith biopsy and results documented (G9823)|G9823',1),
('PQRS_0448', 'answer', '2|Endometrial sampling or hysteroscopywith biopsy and results not documented (G9824)|G9824',9),

('PQRS_0449', 'description', 'HER2 Negative or Undocumented Breast Cancer Patients Spared Treatment with HER2-Targeted Therapies',''),
('PQRS_0449', 'question', 'Was HER2-targeted therapy administered during the initial course of treatment.',''),
('PQRS_0449', 'answer', '1|HER2-targeted therapies not administered during the initial course of treatment(G9827)|G9827',1),
('PQRS_0449', 'answer', '2|HER2-targeted therapies administered during the initial course of treatment(G9828)|G9828',9),

('PQRS_0450', 'description', 'Trastuzumab Received By Patients With AJCC Stage I (T1c)- III And HER2 Positive Breast Cancer Receiving Adjuvant Chemotherapy',''),
('PQRS_0450', 'question', 'Was Trastuzumab administered within 12 months of diagnosis?',''),
('PQRS_0450', 'answer', '1|Trastuzumab administered within 12 months of diagnosis(G9835)|G9835',1),
('PQRS_0450', 'answer', '2|Documented reason for not administering Trastuzumab (G9836)|G9836',2),
('PQRS_0450', 'answer', '3|Trastuzumab not administered within 12 months of diagnosis (G9837)|G9837',9),

('PQRS_0451', 'description', 'RAS (KRAS and NRAS) Gene Mutation Testing Performed for Patients with Metastatic Colorectal Cancer who receive Anti-epidermal Growth Factor Receptor (EGFR) Monoclonal Antibody Therapy',''),
('PQRS_0451', 'question', 'Was RAS (KRAS and NRAS) gene mutation testing performed before initiation of anti-EGFR MoAb?',''),
('PQRS_0451', 'answer', '1|RAS (KRAS and NRAS) gene mutation testing performed before initiation of anti-EGFR MoAb (G9840)|G9840',1),
('PQRS_0451', 'answer', '2|RAS (KRAS and NRAS)gene mutation testing not performed before initiation of anti-EGFR MoAb (G9841)|G9841',9),

('PQRS_0452', 'description', 'Patients with Metastatic Colorectal Cancer and RAS (KRAS and NRAS) Gene Mutation Spared Treatment with Anti-epidermal Growth Factor Receptor (EGFR) Monoclonal Antibodies',''),
('PQRS_0452', 'question', 'Did the patient receive Anti-EGFR monoclonal antibody therapy?',''),
('PQRS_0452', 'answer', '1|Patient did not receive anti-EGFR monoclonal antibody therapy (G9844)|G9844',1),
('PQRS_0452', 'answer', '2|Patient received anti-EGFR monoclonal antibody therapy (G9845)|G9845',9),

('PQRS_0453', 'description', 'Proportion Receiving Chemotherapy in the Last 14 Days of Life <br>INVERSE MEASURE',''),
('PQRS_0453', 'question', 'Did the patient who receive chemotherapy in the last 14 days of life?',''),
('PQRS_0453', 'answer', '1|Patient received chemotherapy in the last 14 days of life (G9847)|G9847',1),
('PQRS_0453', 'answer', '2|Patient did not receive chemotherapy in the last 14 days of life (G9848)|G9848',9),

('PQRS_0454', 'description', 'Proportion of Patients who Died from Cancer with more than One Emergency Department Visit in the Last 30 Days of Life<br>INVERSE MEASURE',''),
('PQRS_0454', 'question', 'Did the patient have more than one emergency department visit in the last 30 days of life?.',''),
('PQRS_0454', 'answer', '1|Patient had more than one emergency department visit in the last 30 days of life (G9850)|G9850',1),
('PQRS_0454', 'answer', '2|Patient had one or less emergency department visits in the last 30 days of life (G9851)|G9851',9),

('PQRS_0455', 'description', 'Proportion Admitted to the Intensive Care Unit (ICU) in the Last 30 Days of Life <br>INVERSE MEASURE',''),
('PQRS_0455', 'question', 'Was the patient admitted to the Intensive Care Unit (ICU) in the Last 30 Days of Life?',''),
('PQRS_0455', 'answer', '1|Patient was admitted to the ICU in the last 30 days of life (G9853)|G9853',1),
('PQRS_0455', 'answer', '2|Patient was not admitted to the ICU in the last 30 days of life (G9854)|G9854',9),

('PQRS_0456', 'description', 'Proportion Not Admitted To Hospice <br>INVERSE MEASURE',''),
('PQRS_0456', 'question', 'Was the patient admitted to hospice?',''),
('PQRS_0456', 'answer', '1|Patient was not admitted to hospice (G9856)|G9856',1),
('PQRS_0456', 'answer', '2|Patient admitted to hospice (G9857)|G9857',9),

('PQRS_0457', 'description', 'Proportion Admitted to Hospice for less than 3 days',''),
('PQRS_0457', 'question', 'Did the patient spend fewer than three days in hospice prior to dying?',''),
('PQRS_0457', 'answer', '1|Patient spent less than three days in hospice care (G9860)|G9860',1),
('PQRS_0457', 'answer', '2|Patient spent greater than or equal to three days in hospice care (G9861)|G9861',9),

('PQRS_0459', 'description', 'Average Change in Back Pain Following Lumbar Discectomy/Laminotomy',''),
('PQRS_0459', 'question', 'Was patient back pain measured by the Visual Analog Scale (VAS) within three months preoperatively AND at three months (6 to 20 weeks) postoperatively?',''),
('PQRS_0459', 'answer', '1|Back pain was measured using the VAS within three months preop AND at three months (6 - 20 weeks) postop (G9941)|G9941',1),
('PQRS_0459', 'answer', '2|Back pain was not measured using the VAS within three months preop AND at three months (6 - 20 weeks) postop (G9943)|G9943',9),

('PQRS_0460', 'description', 'Average Change in Back Pain Following Lumbar Fusion',''),
('PQRS_0460', 'question', 'Was patient back pain measured by the Visual Analog Scale (VAS) within three months preoperatively AND at one year (+/- 3 months) postoperatively?',''),
('PQRS_0460', 'answer', '1|Back pain was measured using the VAS within three months preop AND at one year (9 to 15 months) postop (G9944)|G9944',1),
('PQRS_0460', 'answer', '2|Back pain was not measured using the VAS within three months preop AND at one year (9 to 15 months) postop (G9946)|G9946',9),

('PQRS_0461', 'description', 'Average Change in Leg Pain Following Lumbar Discectomy/Laminotomy',''),
('PQRS_0461', 'question', 'Was patient leg pain measured by the Visual Analog Scale (VAS) within three months preoperatively AND at three months (6 to 20 weeks) postoperatively?',''),
('PQRS_0461', 'answer', '1|Leg pain was measured using the VAS within three months preop AND at 6 to 20 weeks postop (G9947)|G9947',1),
('PQRS_0461', 'answer', '2|Leg pain was not measured using the VAS within three months preop AND at 6 to 20 weeks postop (G9949)|G9949',9),

('PQRS_0463', 'description', 'Prevention of Post-Operative Vomitting (POV): Combination Therapy (Pediatrics)',''),
('PQRS_0463', 'question', 'Did the patient receive combination therapy consisting of at least two prophylactic pharmacologic anti-emetic agents of different classes preoperatively and/or intraoperatively?',''),
('PQRS_0463', 'answer', '1|Patient received at least 2 prophylactic pharmacologic anti-emetic agents of different classes (G9956)|G9956',1),
('PQRS_0463', 'answer', '2|Documentation of medical reason for not receiving at least 2 prophylactic pharmacologic anti-emetic agents (G9957)|G9957',2),
('PQRS_0463', 'answer', '3|Patient did not receive at least 2 prophylactic pharmacologic anti-emetic agents (G9958)|G9958',9),

('PQRS_0464', 'description', 'Otitis Media with Effusion (OME): Systemic Antimicrobials: Avoidance of Inappropriate Use',''),
('PQRS_0464', 'question', 'Was the patient prescribed systemic antimicrobials for OME?',''),
('PQRS_0464', 'answer', '1|Systemic antimicrobials not prescribed (G9959)|G9959',1),
('PQRS_0464', 'answer', '2|Documentation of medical reason(s) for prescribing systemic antimicrobials (G9960)|G9960',2),
('PQRS_0464', 'answer', '3|Systemic antimicrobials prescribed (G9961)|G9961',9),

('PQRS_0465', 'description', 'Uterine Artery Embolization Technique: Documentation of Angiographic Endpoints and Interrogation of Ovarian Arteries',''),
('PQRS_0465', 'question', 'Were embolization endpoints documented separately for each embolized vessel AND ovarian artery angiography or embolization performed in the presence of variant uterine artery anatomy?',''),
('PQRS_0465', 'answer', '1|Embolization endpoints are documented separately for each embolized vessel AND ovarian artery angiography or embolization performed in the presence of variant uterine artery anatomy (G9962)|G9962',1),
('PQRS_0465', 'answer', '2|Embolization endpoints are not documented separately for each embolized vessel OR ovarian artery angiography or embolization not performed in the presence of variant uterine artery anatomy (G9963)|G9963',9),

('PQRS_0467', 'description', 'Developmental Screening in the First Three Years of Life',''),
('PQRS_0467', 'question', 'Was the child screened for risk of developmental, behavioral and social delays using a standardized tool with interpretation and report?',''),
('PQRS_0467', 'answer', '1|The child was screened for risk of developmental, behavioral and social delays using a standardized tool with interpretation and report (G9966)|G9966',1),
('PQRS_0467', 'answer', '2|The child was not screened for risk of developmental, behavioral and social delays using a standardized tool with interpretation and report (G9967)|G9967',9),

('PQRS_0468', 'description', 'Continuity of Pharmacotherapy for Opioid Use Disorder (OUD) Therapy',''),
('PQRS_0468', 'question', 'Was the patient treated for at least 180 continuous days for their opioid use disorder?',''),
('PQRS_0468', 'answer', '1|The patient had at least 180 days of continuous OUD medication, with no more than a 7 day gap (M1034)|M1034',1),
('PQRS_0468', 'answer', '2|The patient was deliberately phased out of OUD therapy prior to 180 days of continuous treatment (M1035)|M1035',2),
('PQRS_0468', 'answer', '3|The patient did not have 180 continuous days of OUD therapy or there were medication gaps longer than 7 days (M1036) |M1036',9),

('PQRS_0469', 'description', 'Average Change in Functional Status Following Lumbar Fusion Surgery',''),
('PQRS_0469', 'question', 'Were functional status scores obtained using the Owestry Disability Index tool, version 2.1a within 3 months pre op and at 9 to 15 months post op?',''),
('PQRS_0469', 'answer', '1|Functional status scores were obtained using Owestry v 2.1a within 3 months pre op AND at 9 to 15 months post op(M1042)|M1042',1),
('PQRS_0469', 'answer', '2|Functional status scores were not obtained using Owestry v 2.1a within 3 months pre op AND 9 to 15 months post op(M1043)|M1043',9),

('PQRS_0470', 'description', 'Average Change in Functional Status Following Total Knee Replacement Surgery Surgery',''),
('PQRS_0470', 'question', 'Were functional status scores obtained using the Oxford Knee Score(OKS) tool, within 3 months pre op AND at 9 to 15 months post op?',''),
('PQRS_0470', 'answer', '1|Functional status scores were obtained using the OKS tool, within 3 months pre op AND at 9 to 15 months post op(M1045)|M1045',1),
('PQRS_0470', 'answer', '2|Functional status scores were not obtained using the OKS tool, within 3 months pre op AND 9 to 15 months post op(M1046)|M1046',9),

('PQRS_0471', 'description', 'Average Change in Functional Status Following Lumbar Discectomy/LaminotomySurgery',''),
('PQRS_0471', 'question', 'Were functional status scores obtained using the Owestry Disability Index tool, version 2.1a within 3 months preop AND at 6 to 20 weeks post op?',''),
('PQRS_0471', 'answer', '1|Functional status scores were obtained using Owestry v 2.1a, within 3 months pre op AND at 6 to 20 weeks post op(M1048)|M1048',1),
('PQRS_0471', 'answer', '2|Functional status scores were not obtained using Owestry v 2.1a within 3 months pre op AND 6 to 20 weeks post op(M1049)|M1049',9),

('PQRS_0473', 'description', 'Average Change in Leg Pain Following Lumbar Fusion Surgery',''),
('PQRS_0473', 'question', 'Was patient leg pain measured by the Visual Analog Scale (VAS) within three months preop AND at 9 to 15 months postop?',''),
('PQRS_0473', 'answer', '1|Leg pain was measured using the VAS within three months preop AND at 9 to 15 months postop(M1053)|M1053',1),
('PQRS_0473', 'answer', '2|Leg pain was not measured using the VAS within three months preop AND at 9 to 15 months postop(M1052)|M1052',9),

('PQRS_0474', 'description', 'Zoster (Shingles) Vaccination',''),
('PQRS_0474', 'question', 'Has the patient received OR have a documented history of having received two Intramuscular doses of Shingrix vaccination 2 to 6 months apart?',''),
('PQRS_0474', 'answer', '1|Shingrix vaccine documented as fully (both doses) administered or previously received(M1064)|M1064',1),
('PQRS_0474', 'answer', '2|Documented reasons for Shigrix vaccine not received or not fully received, including if too early for dose 2(M1065)|M1065',2),
('PQRS_0474', 'answer', '3|No documentation that Shingrix fully administered or previously received,  reason not given(M1066)|M1066',9),

('pre-selection_0052', 'description', 'Chronic Obstructive Pulmonary Disease (COPD): Inhaled Bronchodilator Therapy',''),
('pre-selection_0065', 'description', 'Appropriate Treatment for Children with Upper Respiratory Infection (URI)',''),
('pre-selection_0066', 'description', 'Appropriate Testing for Children with Pharyngitis',''),
('pre-selection_0068', 'description', 'Hematology: Myelodysplastic Syndrome: Documentation of Iron Stores in Patients Receiving Erythropoietin Therapy',''),
('pre-selection_0102', 'description', 'Prostate Cancer: Avoidance of Overuse of Bone Scan for Staging Low Risk Prostate Cancer Patients',''),
('pre-selection_0104', 'description', 'Prostate Cancer: Combination Androgen Deprivation Therapy for High Risk or Very High Risk Prostate Cancer',''),
('pre-selection_0111', 'description', 'Pneumonia Vaccination Status for Older Adults',''),
('pre-selection_0112', 'description', 'Breast Cancer Screening',''),
('pre-selection_0113', 'description', 'Colorectal Cancer Screening',''),
('pre-selection_0116', 'description', 'Avoidance of Antibiotic Treatment in Adults With Acute Bronchitis',''),
('pre-selection_0117', 'description', 'Diabetes: Eye Exam',''),
('pre-selection_0118', 'description', 'CAD: ACE Inhibitor or ARB Therapy - Diabetes or Left Ventricular Systolic Dysfunction',''),
('pre-selection_0119', 'description', 'Diabetes: Medical Attention for Nephropathy',''),
('pre-selection_0154', 'description', 'Falls: Risk Assessment (for patients with a positive screening for falls)',''),
('pre-selection_0155', 'description', 'Falls: Plan of Care (for patients with a positive screening for falls)',''),
('pre-selection_0167', 'description', 'Coronary Artery Bypass Graft (CABG): Postoperative Renal Failure',''),
('pre-selection_0176', 'description', 'Rheumatoid Arthritis (RA): Tuberculosis Screening',''),
('pre-selection_0205', 'description', 'HIV/AIDS: Sexually Transmitted Disease Screening for Chlamydia, Gonorrhea, and Syphilis',''),
('pre-selection_0217', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Knee Impairments',''),
('pre-selection_0218', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Hip Impairments',''),
('pre-selection_0219', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lower Leg, Foot or Ankle Impairments',''),
('pre-selection_0220', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Lumbar Spine Impairments',''),
('pre-selection_0221', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Shoulder Impairments',''),
('pre-selection_0222', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Elbow, Wrist or Hand Impairments',''),
('pre-selection_0223', 'description', 'Functional Deficit: Change in Risk-Adjusted Functional Status for Patients with Other General Orthopedic Impairments',''),
('pre-selection_0236', 'description', 'Controlling High Blood Pressure',''),
('pre-selection_0238', 'description', 'Use of High-Risk Medications in the Elderly',''),
('pre-selection_0249', 'description', 'Barrett''s Esophagus',''),
('pre-selection_0250', 'description', 'Radical Prostatectomy Pathology Reporting',''),
('pre-selection_0258', 'description', 'Rate of Open Repair of Small or Moderate Non-Ruptured Abdominal Aortic Aneurysms (AAA) without Major Complications',''),
('pre-selection_0259', 'description', 'Rate of Endovascular Aneurysm Repair of Small or Moderate Non-Ruptured AAA without Major Complications',''),
('pre-selection_0260', 'description', 'Rate of Carotid Endarterectomy (CEA) for Asymptomatic Patients, without Major Complications',''),
('pre-selection_0262', 'description', 'Image Confirmation of Successful Excision of Image-Localized Breast Lesion',''),
('pre-selection_0264', 'description', 'Sentinel Lymph Node Biopsy for Invasive Breast Cancer that is Clinically Node Negative',''),
('pre-selection_0271', 'description', 'Inflammatory Bowel Disease (IBD): Preventive Care: Corticosteroid Related Iatrogenic Injury -- Bone Loss Assessment',''),
('pre-selection_0279', 'description', ' Sleep Apnea: Assessment of Adherence to Positive Airway Pressure Therapy',''),
('pre-selection_0326', 'description', 'Atrial Fibrillation and Atrial Flutter: Chronic Anticoagulation Therapy',''),
('pre-selection_0329', 'description', 'Adult Kidney Disease: Catheter Use at Initiation of Hemodialysis',''),
('pre-selection_0330', 'description', 'Adult Kidney Disease: Catheter Use for Greater Than or Equal to 90 Days',''),
('pre-selection_0332', 'description', 'Adult Sinusitis: Appropriate Choice of Antibiotic: Amoxicillin With or Without Clavulanate for Patients with Acute Bacterial Sinusitis',''),
('pre-selection_0337', 'description', 'Tuberculosis Prevention for Psoriasis,Psoriatic Arthritis and Rheumatoid Arthritis Patients on a Biological Immune Response Modifier',''),
('pre-selection_0340', 'description', 'HIV Medical Visit Frequency',''),
('pre-selection_0344', 'description', 'Rate of Carotid Artery Stenting (CAS) for Asymptomatic Patients, Without Major Complications',''),
('pre-selection_0345', 'description', 'Rate of Asymptomatic Patients Undergoing Carotid Artery Stenting (CAS) Who are Stroke Free or Discharged Alive',''),
('pre-selection_0346', 'description', 'Rate of Asymptomatic Patients Undergoing Carotid Endarterectomy (CEA) Who are Stroke Free or Discharged Alive',''),
('pre-selection_0347', 'description', 'Rate of Endovascular Aneurysm Repair (EVAR) of Small or Moderate Non-Ruptured AAA Who are Discharged Alive',''),
('pre-selection_0348', 'description', 'HRS-3 Implantable Cardioverter-Defibrillator (ICD) Complications Rate ',''),
('pre-selection_0358', 'description', 'Patient-Centered Surgical Risk Assessment and Communication',''),
('pre-selection_0364', 'description', 'Follow-up CT Imaging for Incidentally Detected Pulmonary Nodules According to Recommended Guidelines',''),
('pre-selection_0370', 'description', 'Depression Remission at Twelve Months',''),
('pre-selection_0384', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: No Return to the Operating Room Within 90 Days of Surgery',''),
('pre-selection_0385', 'description', 'Adult Primary Rhegmatogenous Retinal Detachment Surgery: Visual Acuity Improvement Within 90 Days of Surgery',''),
('pre-selection_0386', 'description', 'Amyotrophic Lateral Sclerosis (ALS) Patient Care Preferences',''),
('pre-selection_0388', 'description', 'Cataract Surgery with Intra-Operative Complications (Unplanned Rupture of Posterior Capsule Requiring Unplanned Vitrectomy',''),
('pre-selection_0391', 'description', 'Follow-Up After Hospitalization for Mental Illness',''),
('pre-selection_0394', 'description', 'Immunizations for Adolescents',''),
('pre-selection_0395', 'description', 'Lung Cancer Reporting (Biopsy/Cytology Specimens)',''),
('pre-selection_0396', 'description', 'Lung Cancer Reporting (Resection Specimens)',''),
('pre-selection_0397', 'description', 'Melanoma Reporting',''),
('pre-selection_0403', 'description', 'Adult Kidney Disease: Referral to Hospice',''),
('pre-selection_0404', 'description', 'Anesthesiology Smoking Abstinence',''),
('pre-selection_0405', 'description','Appropriate Follow-up Imaging for Incidental Abdominal Lesions',''),
('pre-selection_0406', 'description', 'Appropriate Follow-up Imaging for Incidental Thyroid Nodules in Patients',''),
('pre-selection_0408', 'description', 'Opioid Therapy Follow-up Evaluation',''),
('pre-selection_0410', 'description', 'Psoriasis: Clinical Response to Oral Systemic or Biologic Medications',''),
('pre-selection_0411', 'description', 'Depression Remission at Six Months',''),
('pre-selection_0412', 'description', 'Documentation of Signed Opioid Treatment Agreement',''),
('pre-selection_0413', 'description', 'Door to Puncture Time for Endovascular Stroke Treatment',''),
('pre-selection_0414', 'description', 'Evaluation or Interview for Risk of Opioid Misuse ',''),
('pre-selection_0415', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 18 Years and Older',''),
('pre-selection_0416', 'description', 'Emergency Medicine: Emergency Department Utilization of CT for Minor Blunt Head Trauma for Patients Aged 2 through 17 Years',''),
('pre-selection_0417', 'description', 'Rate of Open Repair of Abdominal Aortic Aneurysms (AAA) Where Patients Are Discharged Alive',''),
('pre-selection_0418', 'description', 'Osteoporosis Management in Women Who Had a Fracture',''),
('pre-selection_0419', 'description', 'Overuse Of Neuroimaging For Patients With Primary Headache And A Normal Neurological Examination',''),
('pre-selection_0421', 'description', 'Appropriate Assessment of Retrievable Inferior Vena Cava Filters for Removal',''),
('pre-selection_0424', 'description', 'Perioperative Temperature Management',''),
('pre-selection_0425', 'description', 'Photodocumentation of Cecal Intubation',''),
('pre-selection_0429', 'description', 'Pelvic Organ Prolapse: Preoperative Screening for Uterine Malignancy',''),
('pre-selection_0430', 'description', 'Prevention of Post-Operative Nausea and Vomiting (PONV) -- Combination Therapy',''),
('pre-selection_0437', 'description', 'Rate of Surgical Conversion from Lower Extremity Endovascular Revascularization Procedure',''),
('pre-selection_0438', 'description', 'Statin Therapy for the Prevention and Treatment of Cardiovascular Disease',''),
('pre-selection_0440', 'description', 'Basal Cell Carcinoma (BCC)/Squamous Cell Carcinoma: Biopsy Reporting Time from Pathologist to Clinician',''),
('pre-selection_0441', 'description', ' Ischemic Vascular Disease (IVD) All or None Outcome Measure',''),
('pre-selection_0442', 'description', 'Persistence of Beta-Blocker Treatment After a Heart Attack',''),
('pre-selection_0443', 'description', 'Non-Recommended Cervical Cancer Screening in Adolescent Females',''),
('pre-selection_0444', 'description', 'Medication Management for People with Asthma',''),
('pre-selection_0448', 'description', 'Appropriate Workup Prior to Endometrial Ablation',''),
('pre-selection_0449', 'description', 'HER2 Negative or Undocumented Breast Cancer Patients Spared Treatment with HER2-Targeted Therapies',''),
('pre-selection_0450', 'description', 'Trastuzumab Received By Patients With AJCC Stage I - III And HER2 Positive Breast Cancer Receiving Adjuvant Chemotherapy',''),
('pre-selection_0452', 'description', 'Patients with Metastatic Colorectal Cancer and RAS Gene Mutation Spared Treatment with EGFR Monoclonal Antibodies',''),
('pre-selection_0453', 'description', 'Proportion Receiving Chemotherapy in the Last 14 Days of Life',''),
('pre-selection_0454', 'description', 'Proportion of Patients who Died from Cancer with more than One Emergency Department Visit in the Last 30 Days of Life',''),
('pre-selection_0455', 'description', 'Proportion Admitted to the Intensive Care Unit (ICU) in the Last 30 Days of Life',''),
('pre-selection_0456', 'description', 'Proportion Not Admitted To Hospice',''),
('pre-selection_0457', 'description', 'Proportion Admitted to Hospice for less than 3 days',''),
('pre-selection_0459', 'description', 'Average Change in Back Pain Following Lumbar Discectomy/Laminotomy',''),
('pre-selection_0460', 'description', 'Average Change in Back Pain Following Lumbar Fusion',''),
('pre-selection_0461', 'description', 'Average Change in Leg Pain Following Lumbar Discectomy/Laminotomy',''),
('pre-selection_0463', 'description', 'Prevention of Post-Operative Vomitting (POV): Combination Therapy (Pediatrics)',''),
('pre-selection_0468', 'description', 'Continuity of Pharmacotherapy for Opioid Use Disorder (OUD) Therapy',''),
('pre-selection_0471', 'description', 'Average Change in Functional Status Following Lumbar Discectomy/Laminotomy Surgery',''),
('pre-selection_0474', 'description', 'Zoster (Shingles) Vaccination',''),



('pre_0005', 'question', 'Does the patient qualify for Measure 005?',''),
('pre_0007', 'question', 'Does the patient qualify for Measure 007?',''), 
('pre_0008', 'question', 'Does the patient qualify for Measure 008?',''), 
('pre_0047', 'question', 'Does the patient qualify for Measure 047?',''), 
('pre_0050', 'question', 'Does the patient qualify for Measure 050?',''),
('pre_0052', 'question', 'Does the patient qualify for Measure 052?',''),
('pre_0065', 'question', 'Does the patient qualify for Measure 065?',''),
('pre_0066', 'question', 'Does the patient qualify for Measure 066?',''),
('pre_0068', 'question', 'Does the patient qualify for Measure 068?',''),
('pre_0102', 'question', 'Does the patient qualify for Measure 102?',''),
('pre_0104', 'question', 'Does the patient qualify for Measure 104?',''),
('pre_0111', 'question', 'Does the patient qualify for Measure 111?',''),
('pre_0112', 'question', 'Does the patient qualify for Measure 112?',''), 
('pre_0113', 'question', 'Does the patient qualify for Measure 113?',''),
('pre_0116', 'question', 'Does the patient qualify for Measure 116?',''),
('pre_0117', 'question', 'Does the patient qualify for Measure 117?',''), 
('pre_0118', 'question', 'Does the patient qualify for Measure 118?',''), 
('pre_0119', 'question', 'Does the patient qualify for Measure 119?',''), 
('pre_0126', 'question', 'Does the patient qualify for Measure 126?',''), 
('pre_0154', 'question', 'Does the patient qualify for Measure 154?',''),
('pre_0155', 'question', 'Does the patient qualify for Measure 155?',''), 
('pre_0167', 'question', 'Does the patient qualify for Measure 167?',''),
('pre_0176', 'question', 'Does the patient qualify for Measure 176?',''), 
('pre_0205', 'question', 'Does the patient qualify for Measure 205?',''),
('pre_0217', 'question', 'Does the patient qualify for Measure 217?',''),
('pre_0218', 'question', 'Does the patient qualify for Measure 218?',''), 
('pre_0219', 'question', 'Does the patient qualify for Measure 219?',''), 
('pre_0220', 'question', 'Does the patient qualify for Measure 220?',''), 
('pre_0221', 'question', 'Does the patient qualify for Measure 221?',''), 
('pre_0222', 'question', 'Does the patient qualify for Measure 222?',''), 
('pre_0223', 'question', 'Does the patient qualify for Measure 223?',''), 
('pre_0236', 'question', 'Does the patient qualify for Measure 236?',''), 
('pre_0238', 'question', 'Does the patient qualify for Measure 238?',''), 
('pre_0249', 'question', 'Does the patient qualify for Measure 249?',''), 
('pre_0250', 'question', 'Does the patient qualify for Measure 250?',''), 
('pre_0258', 'question', 'Does the patient qualify for Measure 258?',''), 
('pre_0259', 'question', 'Does the patient qualify for Measure 259?',''), 
('pre_0260', 'question', 'Does the patient qualify for Measure 260?',''), 
('pre_0262', 'question', 'Does the patient qualify for Measure 262?',''),
('pre_0264', 'question', 'Does the patient qualify for Measure 264?',''), 
('pre_0271', 'question', 'Does the patient qualify for Measure 271?',''), 
('pre_0279', 'question', 'Does the patient qualify for Measure 279?',''), 
('pre_0326', 'question', 'Does the patient qualify for Measure 326?',''),
('pre_0329', 'question', 'Does the patient qualify for Measure 329?',''), 
('pre_0330', 'question', 'Does the patient qualify for Measure 330?',''), 
('pre_0332', 'question', 'Does the patient qualify for Measure 332?',''),  
('pre_0337', 'question', 'Does the patient qualify for Measure 337?',''), 
('pre_0340', 'question', 'Does the patient qualify for Measure 340?',''), 
('pre_0344', 'question', 'Does the patient qualify for Measure 344?',''), 
('pre_0345', 'question', 'Does the patient qualify for Measure 345?',''), 
('pre_0346', 'question', 'Does the patient qualify for Measure 346?',''), 
('pre_0347', 'question', 'Does the patient qualify for Measure 347?',''), 
('pre_0348', 'question', 'Does the patient qualify for Measure 348?',''), 
('pre_0358', 'question', 'Does the patient qualify for Measure 358?',''), 
('pre_0364', 'question', 'Does the patient qualify for Measure 364?',''),
('pre_0370', 'question', 'Does the patient qualify for Measure 370?',''), 
('pre_0384', 'question', 'Does the patient qualify for Measure 384?',''), 
('pre_0385', 'question', 'Does the patient qualify for Measure 385?',''), 
('pre_0386', 'question', 'Does the patient qualify for Measure 386?',''), 
('pre_0388', 'question', 'Does the patient qualify for Measure 388?',''), 
('pre_0391', 'question', 'Does the patient qualify for Measure 391?',''),
('pre_0394', 'question', 'Does the patient qualify for Measure 394?',''), 
('pre_0395', 'question', 'Does the patient qualify for Measure 395?',''), 
('pre_0396', 'question', 'Does the patient qualify for Measure 396?',''), 
('pre_0397', 'question', 'Does the patient qualify for Measure 397?',''), 
('pre_0403', 'question', 'Does the patient qualify for Measure 403?',''),
('pre_0404', 'question', 'Does the patient qualify for Measure 404?',''), 
('pre_0405', 'question', 'Does the patient qualify for Measure 405?',''), 
('pre_0406', 'question', 'Does the patient qualify for Measure 406?',''), 
('pre_0408', 'question', 'Does the patient qualify for Measure 408?',''), 
('pre_0410', 'question', 'Does the patient qualify for Measure 410?',''), 
('pre_0411', 'question', 'Does the patient qualify for Measure 411?',''), 
('pre_0412', 'question', 'Does the patient qualify for Measure 412?',''), 
('pre_0413', 'question', 'Does the patient qualify for Measure 413?',''), 
('pre_0414', 'question', 'Does the patient qualify for Measure 414?',''),
('pre_0415', 'question', 'Does the patient qualify for Measure 415?',''),
('pre_0416', 'question', 'Does the patient qualify for Measure 416?',''), 
('pre_0417', 'question', 'Does the patient qualify for Measure 417?',''), 
('pre_0418', 'question', 'Does the patient qualify for Measure 418?',''), 
('pre_0419', 'question', 'Does the patient qualify for Measure 419?',''), 
('pre_0424', 'question', 'Does the patient qualify for Measure 424?',''), 
('pre_0425', 'question', 'Does the patient qualify for Measure 425?',''),
('pre_0429', 'question', 'Does the patient qualify for Measure 429?',''), 
('pre_0430', 'question', 'Does the patient qualify for Measure 430?',''), 
('pre_0437', 'question', 'Does the patient qualify for Measure 437?',''), 
('pre_0438', 'question', 'Does the patient qualify for Measure 438?',''), 
('pre_0440', 'question', 'Does the patient qualify for Measure 440?',''),
('pre_0441', 'question', 'Does the patient qualify for Measure 441?',''), 
('pre_0442', 'question', 'Does the patient qualify for Measure 442?',''), 
('pre_0443', 'question', 'Does the patient qualify for Measure 443?',''), 
('pre_0444', 'question', 'Does the patient qualify for Measure 444?',''),
('pre_0448', 'question', 'Does the patient qualify for Measure 448?',''), 
('pre_0449', 'question', 'Does the patient qualify for Measure 449?',''),
('pre_0450', 'question', 'Does the patient qualify for Measure 450?',''), 
('pre_0452', 'question', 'Does the patient qualify for Measure 452?',''), 
('pre_0453', 'question', 'Does the patient qualify for Measure 453?',''), 
('pre_0454', 'question', 'Does the patient qualify for Measure 454?',''), 
('pre_0455', 'question', 'Does the patient qualify for Measure 455?',''), 
('pre_0456', 'question', 'Does the patient qualify for Measure 456?',''), 
('pre_0457', 'question', 'Does the patient qualify for Measure 457?',''), 
('pre_0459', 'question', 'Does the patient qualify for Measure 459?',''), 
('pre_0460', 'question', 'Does the patient qualify for Measure 460?',''), 
('pre_0461', 'question', 'Does the patient qualify for Measure 461?',''), 
('pre_0463', 'question', 'Does the patient qualify for Measure 463?',''), 
('pre_0468', 'question', 'Does the patient qualify for Measure 468?',''), 
('pre_0471', 'question', 'Does the patient qualify for Measure 471?',''), 
('pre_0474', 'question', 'Does the patient qualify for Measure 474?',''), 



('pre_0005', 'answer', '1|Include in denominator: Patient has LVEF of less than 40 percent: 3021F|3021F',9),
('pre_0007', 'answer', '1|Include in denominator: Patient has LVEF of less than 40 percent: G8694|G8694',9),
('pre_0008', 'answer', '1|Include in denominator: Patient has LVEF of less than 40 percent: G8923|G8923',9),
('pre_0047', 'answer', '1|Exclude from denominator: hospice patient: G9692|G9692',9),
('pre_0048', 'answer', '1|Exclude from denominator: hospice patient: G9693|G9693',9),
('pre_0050', 'answer', '1|Exclude from denominator: hospice patient: G9694|G9694',9),
('pre_0052', 'answer', '1|Include in denominator: This patient with COPD has a FEV1 of less than 60% and is symptomatic: G824|G8924',9),

('pre_0065', 'answer', '1|Exclude from denominator: patient presently on antibiotics for other infection: G8709|G8709',9),
('pre_0065', 'answer', '2|Exclude from denominator: patient has been on antibiotics in the 30 days prior to URI diagnosis: G9701|G9701',9),
('pre_0065', 'answer', '3|Exclude from denominator: hospice patient: G9700|G9700',9),

('pre_0066', 'answer', '1|Exclude from denominator: hospice patient: G9702|G9702',9),
('pre_0066', 'answer', '2|Exclude from denominator: patient has been on antibiotics in the 30 days prior to Pharyngitis diagnosis: G9703|G9703',9),
('pre_0066', 'answer', '3|Include in denominator:patient was prescribed an antibiotic at visit or within 3 days after visit: G8711|G8711',9),

('pre_0068', 'answer', '1|Include in denominator: patient is receiving erythropoetin therapy: 4090F|4090F',9),
('pre_0102', 'answer', '1|Include in denominator: patient has a low or very low risk for recurrence of prostate cancer: G9706|G9706',9),
('pre_0104', 'answer', '1|Include in denominator: patient has a high or very high risk for recurrence of prostate cancer: G8465|G8465',9),
('pre_0111', 'answer', '1|Exclude from denominator: hospice patient: G9707|G9707',9),

('pre_0112', 'answer', '1|Exclude from denominator: patient has a history of left, right or bilateral mastectomy: G9708|G9708',9),
('pre_0112', 'answer', '2|Exclude from denominator: hospice patient: G9709|G9709',9),
('pre_0112', 'answer', '3|Exclude from denominator: patient is age 65 plus in SNP facility or long term care POS 32,33,34,54 or 56: G9898|G9898',9),

('pre_0113', 'answer', '1|Exclude from denominator: patient has a diagnosis or history of coloectal cancer or total colectomy :G9711|G9711',9),
('pre_0113', 'answer', '2|Exclude from denominator: hospice patient: G9710|G9710',9),
('pre_0113', 'answer', '3|Exclude from denominator: patient is age 65 plus in SNP facility or long term care POS 32,33,34,54 or 56: G9901|G9901',9),

('pre_0116', 'answer', '1|Exclude from denominator: patient presently on antibiotics for other infection: G9712|G9712',9),
('pre_0116', 'answer', '2|Exclude from denominator: INPATIENT ADMISSION: G9712|G9712',9),
('pre_0116', 'answer', '3|Exclude from denominator: hospice patient: G9713|G9713',9),

('pre_0117', 'answer', '1|Exclude from denominator: hospice patient: G9714|G9714',9),
('pre_0118', 'answer', '1|Include in denominator: Patient has LVEF of less than 40 percent: G8934|G8934',9),
('pre_0119', 'answer', '1|Exclude from denominator: hospice patient: G9715|G9715',9),

('pre_0154', 'answer', '1|Exclude from denominator: hospice patient: G9718|G9718',9),
('pre_0154', 'answer', '2|Include in denominator: patient has had two or more falls or any fall with injury in past year: 1100F|1100F',9),

('pre_0155', 'answer', '1|Exclude from denominator: hospice patient: G9720|G9720',9),
('pre_0155', 'answer', '2|Include in denominator: patient has had two or more falls or any fall with injury in past year: 1100F|1100F',9),

('pre_0167', 'answer', '1|Exclude from denominator: patient has renal failure or serum creatinine equal or higher than 4 mg per dL: G9722|G9722',9),
('pre_0176', 'answer', '1|Include in denominator: patient is receiving biologic disease modifying anti-rheumatic drug therapy: 4195F|4195F',9),
('pre_0205', 'answer', '1|Exclude from denominator: hospice patient: G9725|G9725',9),

('pre_0217', 'answer', '1|Exclude from denominator: patient refused to participate: G9726|G9726',9),
('pre_0217', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9727|G9727',9),

('pre_0218', 'answer', '1|Exclude from denominator: patient refused to participate: G9728|G9728',9),
('pre_0218', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9729|G9729',9),

('pre_0219', 'answer', '1|Exclude from denominator: patient refused to participate: G9730|G9730',9),
('pre_0219', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9731|G9731',9),

('pre_0220', 'answer', '1|Exclude from denominator: patient refused to participate: G9732|G9732',9),
('pre_0220', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9733|G9733',9),

('pre_0221', 'answer', '1|Exclude from denominator: patient refused to participate: G9734|G9734',9),
('pre_0221', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9735|G9735',9),

('pre_0222', 'answer', '1|Exclude from denominator: patient refused to participate: G9736|G9736',9),
('pre_0222', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9737|G9737',9),

('pre_0223', 'answer', '1|Exclude from denominator: patient refused to participate: G9738|G9738',9),
('pre_0223', 'answer', '2|Exclude from denominator: patient unable to complete FOTO due to physical, cognitive or literacy barriers: G9739|G9739',9),

('pre_0236', 'answer', '1|Exclude from denominator: hospice patient: G9740|G9740',9),
('pre_0236', 'answer', '2|Exclude from denominator: patient has End Stage Renal Disease, is on dialysis or has had renal transplant: G9231|G9231',9),
('pre_0236', 'answer', '3|Exclude from denominator: patient is age 65 plus in SNP facility or long term care POS 32,33,34,54 or 56: G9910|G9910',9),

('pre_0238', 'answer', '1|Exclude from denominator: hospice patient: G9741|G9741',9),
('pre_0249', 'answer', '1|Exclude from denominator: specimen type was not from the esophagus: G8797|G8797',9),
('pre_0250', 'answer', '1|Exclude from denominator: specimen type was not from the prostate: G8798|G8798',9),

('pre_0258', 'answer', '1|Exclude from denominator: this female patient has an AAA diameter of between 5.5 cm and 5.9 cm: 9003F|9003F',9),
('pre_0258', 'answer', '2|Exclude from denominator: this patient, male or female, has an AAA diameter of 6.0 cm or greater: 9004F|9004F',9),

('pre_0259', 'answer', '1|Exclude from denominator: this female patient has an AAA diameter of between 5.5 cm and 5.9 cm: 9003F|9003F',9),
('pre_0259', 'answer', '2|Exclude from denominator: this patient, male or female, has an AAA diameter of 6.0 cm or greater: 9004F|9004F',9),

('pre_0260', 'answer', '1|Exclude from denominator: patient has a history of symptomatic carotid stenosis, TIA or stroke prior to procedure: 9006F|9006F',9),

('pre_0262', 'answer', '1|Exclude from denominator: the anatomic location for the specimen was not amenable to imaging: G8873|G8873',9),

('pre_0264', 'answer', '1|Include in denominator: patient with node-negative T1N0M0 or T2N0M0 invasive breast cancer: G9911|G9911',9),

('pre_0271', 'answer', '1|Include in denominator: patient received corticosteroid treatment for 60 days or more OR a high dose single Rx  G9469|G9469',9),

('pre_0279', 'answer', '1|Include in denominator: patient was prescibed positive airway pressure therapy: G8852|G8852',9),

('pre_0326', 'answer', '1   ,Exclude from denominator: patient has transient or reversible AF: G9929|G9929',9),
('pre_0326', 'answer', '2|Exclude from denominator:  hospice or comfort care patient: G9930|G9930',9),
('pre_0326', 'answer', '3|Exclude from denominator: patient stroke risk assessment score is 0 or 1: G9931|G9931',9),

('pre_0329', 'answer', '1|Exclude from denominator: patient undergoing palliative dialysis with a catheter: G9747|G9747',9),
('pre_0329', 'answer', '2|Exclude from denominator: patient scheduled to receive a living donor kidney transplant: G9748|G9748',9),

('pre_0330', 'answer', '1|Exclude from denominator: patient undergoing palliative dialysis with a catheter: G9749|G9749',9),
('pre_0330', 'answer', '2|Exclude from denominator: patient scheduled to receive a living donor kidney transplant: G9750|G9750',9),
('pre_0330', 'answer', '3|Include in denominator: at initiation of hemodialysis patient had a catheter for vascular access: G9240 |G9240',9),

('pre_0332', 'answer', '1|Include in denominator: the patient had sinusitis caused by bacteria: G9364 and an antibiotic regimen was prescribed: G9498|G9364 G9498',9),
('pre_0337', 'answer', '1|Include in denominator: the patient was prescribed a biologic immune response modifier: G9506|G9506',9),
('pre_0340', 'answer', '1|Exclude from denominator: the patient died during the measurement period: G9751|G9751',9),
('pre_0344', 'answer', '1|Exclude from denominator: patient has a history of symptomatic carotid stenosis, TIA or stroke prior to procedure: 9006F |9006F',9),
('pre_0345', 'answer', '1|Exclude from denominator: patient has a history of symptomatic carotid stenosis, TIA or stroke prior to procedure: 9006F |9006F',9),
('pre_0346', 'answer', '1|Exclude from denominator: patient has a history of symptomatic carotid stenosis, TIA or stroke prior to procedure: 9006F |9006F',9),

('pre_0347', 'answer', '1|Exclude from denominator: this female patient has an AAA diameter of between 5.5 cm and 5.9 cm: 9003F|9003F',9),
('pre_0347', 'answer', '2|Exclude from denominator: this patient, male or female, has an AAA diameter of 6.0 cm or greater: 9004F|9004F',9),

('pre_0348', 'answer', '1|Exclude from denominator: the patient has had Implantable Cardioveter-Defibrillator removed: 0JPT0PZ|0JPT0PZ',9),
('pre_0358', 'answer', '1|Exclude from denominator: the patient had emergency surgery: G9752|G9752',9),
('pre_0364', 'answer', '1|Include in denominator: the patient had an incidentally detected pulmonary nodule: G9754|G9754',9),
('pre_0370', 'answer', '1|Include in denominator: patient PHQ9 score is greater than 9 during the 12 month determination period: G9511|G9511',9),
('pre_0384', 'answer', '1|Exclude from denominator:patient surgical procedure included the use of silicone oil: G9756|G9756',9),
('pre_0385', 'answer', '1|Exclude from denominator:patient surgical procedure included the use of silicone oil: G9756|G9756',9),
('pre_0386', 'answer', '1|Exclude from denominator: hospice patient: G9758|G9758',9),
('pre_0388', 'answer', '1|Exclude from denominator: patient has a history of preoperative posterior capsule rupture: G9759|G9759',9),
('pre_0391', 'answer', '1|Exclude from denominator: hospice patient: G9760|G9760',9),
('pre_0394', 'answer', '1|Exclude from denominator: patient has allergy or other contraindication for Tdap, MMR or HPV vaccine: G9761|G9761',9),
('pre_0395', 'answer', '1|Exclude from denominator:specimen site other than lung or is not classified as primary non-small cell lung cancer: G9420|G9420',9),
('pre_0396', 'answer', '1|Exclude from denominator: specimen site other than lung,OR classified as NSCLC-NOS: G9424 |G9424',9),
('pre_0397', 'answer', '1|Exclude from denominator: specimen site other than anatomic cutaneous location: G9430|G9430',9),
('pre_0403', 'answer', '1|Include in denominator:patient discontinued from hemodialysis or peritoneal dialysis: G9523|G9523',9),
('pre_0404', 'answer', '1|Include in denominator: smokes, elective surgery, tobacco counselling within 24 hrs of surgery G9642 and G9643 and G9497|G9642 G9643 G9497',9),
('pre_0405', 'answer', '1|Include in denominator: patient has Incidental finding of Liver lesion, Cystic kidney lesion or Adrenal lesion: G9547|G9547',9),
('pre_0406', 'answer', '1|Include in denominator: incidental thyroid nodule less than 1.0 cm noted in patient report patients: G9552|G9552',9),
('pre_0408', 'answer', '1|Include in denominator: patient was prescribed opiates for longer than six weeks: G9561|G9561',9),
('pre_0410', 'answer', '1|Include in denominator: patient has been treated with an oral systemic or biologic medication for psoriasis vulgaris: G9764|G9764',9),
('pre_0411', 'answer', '1|Include in denominator: patient PHQ-9 Score greater than 9 during the twelve mos denominator identification period: G9511|G9511',9),
('pre_0412', 'answer', '1|Include in denominator: patients was prescribed opiates for longer than six weeks G9577|G9577',9),

('pre_0413', 'answer', '1|Exclude from denominator: patient transferred from one institution to another for treatment of confirmed stroke: G9766|G9766',9),
('pre_0413', 'answer', '2|Exclude from denominator: a hospitalized patient with newly diagnosed CVA considered for stroke treatment: G9767|G9767',9),

('pre_0414', 'answer', '1|Include in denominator: patient was prescribed opiates for longer than six weeks: G9583|G9583',9),

('pre_0415', 'answer', '1|Exclude from denominator: patient has ventricular shunt, brain tumor, multisystem trauma, pregnancy, or on antiplatelet meds|G9531',9),
('pre_0415', 'answer', '2|Include in denominator: patient had GCS score of 15 and had a head CT ordered for trauma, by an ER provider:  G9530|G9530',9),

('pre_0416', 'answer', '1|Exclude from denominator: patient has ventricular shunt, brain tumor, coagulopathy-including thrombocytopenia: G9595|G9595',9),
('pre_0416', 'answer', '2|Include in denominator:  patient had GCS score of 15 and had a head CT ordered for trauma, by an ER provider: G9594|G9594',9),

('pre_0417', 'answer', '1|Exclude from denominator: aortic aneurysm is 6.0 cm or greater  diameter on CT: 9004F|9004F',9),
('pre_0417', 'answer', '2|Exclude from denominator: FEMALE patient with aortic aneurysm is 5.5 - 5.9 cm or greater diameter on CT: 9003F|9003F',9),
('pre_0417', 'answer', '3|Exclude from denominator: patient had symptomatic AAA that required urgent/emergent (non-elective) repair: G9600|G9600',9),

('pre_0418', 'answer', '1|Exclude from denominator: hospice patient: G9768|G9768',9),
('pre_0418', 'answer', '2|Exclude from denominator: bone density test done in past 2 yrs OR received osteoporosis treatment in past 12 mos: G9769|G9769',9),
('pre_0418', 'answer', '3|Exclude from denominator: patient is age 65 plus in SNP facility or long term care POS 32,33,34,54 or 56: G9938|G9938',9),

('pre_0419', 'answer', '1|Include in denominator: patient had a normal neurological examination: G9535|G9535',9),

('pre_0424', 'answer', '1|Exclude from denominator: patient under monitored anesthesia care (MAC) G9654|G9654',9),
('pre_0424', 'answer', '2|Exclude from denominator: patient had peripheral nerve block (PNB): G9770|G9770',9),
('pre_0424', 'answer', '3|Include in denominator: patient was anesthetized for 60 minutes or longer: 4255F|4255F',9),

('pre_0425', 'answer', '1|Exclude from denominator: anatomical reason for not capturing photodocumentation, such as prior surgical removal: G9613|G9613',9),
('pre_0429', 'answer', '1|Exclude from denominator: patients has a history of a hysterectomy: G9774|G9774',9),
('pre_0430', 'answer', '1|Include in denominator: patient given inhalational anesthetic and has 3 plus risk factors for PONV: 4554F and 4556F|4554F 4556F',9),
('pre_0437', 'answer', '1|Exclude from denominator: patient underwent a planned hybrid or staged procedure: G9640|G9640',9),

('pre_0438', 'answer', '1|Exclude from denominator: patient was pregnant: G9778|G9778',9),
('pre_0438', 'answer', '2|Exclude from denominator: patient was breastfeeding: G9779|G9779',9),
('pre_0438', 'answer', '3|Exclude from denominator: patient had rhabdomyolysis: G9780|G9780',9),
('pre_0438', 'answer', '4|Include in denominator: patient a has history of Clinical Atherosclerotic Vascular Disease: G9662|G9662',9),
('pre_0438', 'answer', '5|Include in denominator: patient has a history of  fasting or direct LDL-C of 190 mg/dL or higher: G9663|G9663',9),
('pre_0438', 'answer', '6|Include in denominator: patient has a history of familial or pure hypercholesterolemia G9782|G9782',9),
('pre_0438', 'answer', '7|Include in denominator: highest fasting or direct LDL-C was 70 –189 mg/dL within the past 3 years: G9666|G9666',9),

('pre_0440', 'answer', '1|Exclude from denominator: the pathologist is providing a second opinion on the biopsy: G9784|G9748',9),
('pre_0440', 'answer', '2|Exclude from denominator: the pathologist is the same clinician who performed the biopsy: G9939|G9939',9),

('pre_0441', 'answer', '1|Include in denominator: patient alive as of the last day of the measurement period: G8787|G8787',9),

('pre_0442', 'answer', '1|Exclude from denominator: patient has a history of medication being dispensed for asthma: G9799|G9799',9),
('pre_0442', 'answer', '2|Exclude from denominator: patients has an intolerance or allergy to beta-blocker therapy: G9800|G9800',9),
('pre_0442', 'answer', '3|Exclude from denominator: patient was transferred directly to a non-acute care facility for any diagnosis: G9801|G9801',9),
('pre_0442', 'answer', '4|Exclude from denominator: hospice patient: G9802|G9802',9),
('pre_0442', 'answer', '5|Include in denominator: discharged for AMI btwn July 1 of year prior to measurement year and June 30 of current one: G9798|G9798',9),

('pre_0443', 'answer', '1|Exclude from denominator: hospice patient: G9805|G9805',9),

('pre_0444', 'answer', '1|Exclude from denominator: patient had no asthma controller medications dispensed during the measurement year: G9808|G9808',9),
('pre_0444', 'answer', '2|Exclude from denominator: hospice patient: G9809|G9809',9),

('pre_0448', 'answer', '1|Exclude from denominator: patient had an endometrial ablation procedure during the year prior to the index date: G9822|G9822',9),

('pre_0449', 'answer', '1|Exclude from denominator: Patient transferred to practice after initiation of chemotherapy: G9826|G9826',9),
('pre_0449', 'answer', '2|Include in denominator: patient HER-2/neu status is negative or undocumented: G9825|G9825',9),

('pre_0450', 'answer', '1|Exclude from denominator: patient transfered to practice after initiation of chemotherapy: G9833|G9833',9),
('pre_0450', 'answer', '2|Exclude from denominator: patient had metastatic disease at diagnosis: G9834|G9834',9),
('pre_0450', 'answer', '3|Include in denominator: breast adjuvant chemotherapy administered and HER-2/neu positive: G9829 and G9830|G9830 G9829',9),
('pre_0450', 'answer', '4|Include in denominator: breast adjuvant chemotherapy administered and AJCC stage II or III :G9829 and G9831|G9831 G9829',9),
('pre_0450', 'answer', '5|Include in denominator: breast adjuvant chemotherapy administered, AJCC stage 1 and not T1, T1a,T1b: G9829 and G9832|G9832 G9829',9),

('pre_0452', 'answer', '1|Include in denominator: patient had metastatic disease at dx and KRAS or NRAS gene mutation: G9842 and G9843|G9842 G9843',9),
('pre_0453', 'answer', '1|Include in denominator: patient died from cancer: G9846|G9846',9),
('pre_0454', 'answer', '1|Include in denominator: patient died from cancer:G9849|G9849',9),
('pre_0455', 'answer', '1|Include in denominator: patient died from cancer: G9852|G9852',9),
('pre_0456', 'answer', '1|Include in denominator: patient died from cancer: G9855|G9855',9),
('pre_0457', 'answer', '1|Include in denominator: patient enrolled in hospice and patient died from cancer: G9858 and G9859|G9858 G9859',9),
('pre_0459', 'answer', '1|Exclude from denominator: patient had additional spine procedures performed at time of surgery: G9942|G9942',9),
('pre_0460', 'answer', '1|Exclude from denominator: Patient had cancer, spinal fracture or infection OR had idiopathic or congenital scoliosis: G9945|G9945',9),
('pre_0461', 'answer', '1|Exclude from denominator: patient had additional spine procedures performed at time of surgery: G9948|G9948',9),

('pre_0463', 'answer', '1|Exclude from denominator: an inhalational anesthetic was used only for induction: G9955|G9955',9),
('pre_0463', 'answer', '2|Include in denominator: patient given inhalational anesthetic and has 2 plus risk factors for PONV: G9954|G9954',9),
('pre_0468', 'answer', '1|Include in denominator: patient is currently taking pharmacotherapy for Opiod Use Disorder: M1032|M1032',9),
('pre_0471', 'answer', '1|Exclude from denominator: Patient had additional spine procedures performed during the lumbar discectomy/laminotomy: M1071|M1071',9),

('pre_0474', 'answer', '1|Exclude from denominator: Pregnant patient: M1061|M1061',9),
('pre_0474', 'answer', '2|Exclude from denominator: Immunocompromised patient: M1062|M1062',9),
('pre_0474', 'answer', '3|Exclude from denominator: Patient is receiving high doses of immunosuppressive therapy: M1063|M1063',9),



('PQRS_0XXX', 'question', 'Please see measure documentation for specifics.',''),

('end', 'blank', '','' );";
sqlStatementNoLog($query);


?>




























































































































































































































































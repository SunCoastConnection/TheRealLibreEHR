<?php
/*
 * Copyright (C) 2018 Suncoast Connection
 *
 * @package MIPS_Gateway
 * @linkhttp://suncoastconnection.com
 * @author Suncoast Connection
 * @author Art Eaton
*/



$query =
"DROP TABLE IF EXISTS mips_hcc_rates;";
sqlStatementNoLog($query);

$query =
"CREATE TABLE IF NOT EXISTS `mips_hcc_rates` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(150),
rate varchar(15),
PRIMARY KEY(`id`)
);";
sqlStatementNoLog($query);

$query =
"INSERT INTO `mips_hcc_rates` (`type`, `code`,`rate`) VALUES 
('HCC_0001','HIV/AIDS','1.747'), 
('HCC_0002','Septicemia, Sepsis, Systemic Inflammatory Response Syndrome/Shock', '0.346'), 
('HCC_0006','Opportunistic Infections', '0.58'), 
('HCC_0008','Metastatic Cancer and Acute Leukemia', '1.143'), 
('HCC_0009','Lung and Other Severe Cancers', '0.727'), 
('HCC_0010','Lymphoma and Other Cancers', '0.401'), 
('HCC_0011','Colorectal, Bladder, and Other Cancers','0.293'), 
('HCC_0012','Breast, Prostate, and Other Cancers and Tumors', '0.199'), 
('HCC_0017','Diabetes with Acute Complications',  '0.441'), 
('HCC_0018','Diabetes with Chronic Complications', '0.441'), 
('HCC_0019','Diabetes without Complication', '0.16'), 
('HCC_0021','Protein-Calorie Malnutrition','0.26'), 
('HCC_0022','Morbid Obesity', '0.511'), 
('HCC_0023','Other Significant Endocrine and Metabolic Disorders','0.337'), 
('HCC_0027','End-Stage Liver Disease',  '0.962'), 
('HCC_0028','Cirrhosis of Liver','0.39'), 
('HCC_0029','Chronic Hepatitis', '0.39'), 
('HCC_0033','Intestinal Obstruction/Perforation', '0.335'), 
('HCC_0034','Chronic Pancreatitis', '0.241'), 
('HCC_0035','Inflammatory Bowel Disease', '0.244'), 
('HCC_0039','Bone/Join/Muscle Infections/Necrosis', '0.345'), 
('HCC_0040','Rheumatoid Arthritis and Inflammatory Connective Tissue Disease',  '0.329'), 
('HCC_0046','Severe Hematological Disorders', '0.68'), 
('HCC_0047','Disorders of Immunity','0.529'), 
('HCC_0048','Coagulation Defects and Other Specified', '0.151'), 
('HCC_0054','Drug/Alcohol Psychosis', '0.102'), 
('HCC_0055','Drug/Alcohol Dependence',  '0.102'), 
('HCC_0057','Schizophrenia',  '0.271'), 
('HCC_0058','Major Depressive, Bipolar, and Paranoid Disorders', '0.271'), 
('HCC_0070','Quadriplegia ',  '0.497'), 
('HCC_0071','Paraplegia', '0.467'), 
('HCC_0072','Spinal cord Disorders/ Injuries','0.229'), 
('HCC_0073','Amyotrophic Lateral Sclerosis and Other Motor Neuron Disease', '0.224'), 
('HCC_0074','Cerebral Palsy', '0'),  
('HCC_0075','Myasthenia Gravis/Myoneural Disorders, Inflammatory','0.369'), 
('HCC_0076','Muscular Dystrophy','0.104'), 
('HCC_0077','Multiple Sclerosis ', '0'),  
('HCC_0078','Parkinsons and Huntingtons Diseases ', '0.145'), 
('HCC_0079','Seizure Disorders and Convulsions',  '0.088'), 
('HCC_0080','Coma, Brain Compression/Anoxic', '0.042'), 
('HCC_0082','Respirator Dependence/Tracheostomy Status','1.52'), '1.631'),
('HCC_0083','Respiratory Arrest','0.727'), 
('HCC_0084','Cardio-Respiratory Failure and Shock', '0.297'), 
('HCC_0085','Congestive Heart Failure', '0.191'), 
('HCC_0086','Acute Myocardial Infarction', '0.497'), 
('HCC_0087','Unstable Angina and Other Acute Ischemic Heart Disease ', '0.497'), 
('HCC_0088','Angina Pectoris', '0.497'), 
('HCC_0096','Specified Heart Arrhythmias', '0.224'), 
('HCC_0099','Cerebral Hemorrhage', '0.114'), 
('HCC_0100','Ischemic or Unspecified Stroke', '0.114'), 
('HCC_0103','Hemiplegia/Hemiparesis', '0.031'), 
('HCC_0104','Monoplegia, Other Paralytic Syndromes', '0.031'), 
('HCC_0106','Atherosclerosis of the Extremities with Ulceration or Gangrene', '0.884'), 
('HCC_0107','Vascular Disease with Complications', '0.321'), 
('HCC_0108','Vascular Disease', '0.094'), 
('HCC_0110','Cystic Fibrosis', '0.305'), 
('HCC_0111','Chronic Obstructive Pulmonary Disease', '0.305'), 
('HCC_0112','Fibrosis of Lung and Other Chronic Lung Disorders', '0.057'), 
('HCC_0114','Aspiration and Specified Bacterial Pneumonias', '0.067'), 
('HCC_0115','Pneumococcal Pneumonia, Empyema, Lung Abscess', '0.067'), 
('HCC_0122','Proliferative Diabetic Retinopathy and Vitreous Hemorrhage','0.46'), 
('HCC_0124','Exudative Macular Degeneration', '0.228'), 
('HCC_0134','Dialysis Status', '0.462'), 
('HCC_0135','Acute Renal Failure Hematological Disorders',  '0.462'), 
('HCC_0136','Chronic Kidney Disease, Stage 5','0.436'), 
('HCC_0137','Chronic Kidney Disease, Severe (Stage 4)', '0.202'), 
('HCC_0157','Pressure Ulcer of Skin with Necrosis Through to Muscle, Tendon, or Bone','0.924'), 
('HCC_0158','Pressure Ulcer of Skin with Full Thickness Skin Loss', '0.295'), 
('HCC_0161','Chronic Ulcer of Skin, Except Pressure','0.294'), 
('HCC_0162','Severe Skin Burn or Condition', '0.076'), 
('HCC_0166','Severe Head Injury','0.042'), 
('HCC_0167','Major Head Injury', '0'),  
('HCC_0169','Vertebral Fractures without Spinal Cord Injury', '0.209'), 
('HCC_0170','Hip Fracture/Dislocation and Toxic Neuropathy', '0'),  
('HCC_0173','Traumatic Amputations and Complications', '0.267'), 
('HCC_0176','Complications of Specified Implanted Device or Graft', '0.502'), 
('HCC_0186','Major Organ Transplant or Replacement Status', '0.962'), 
('HCC_0188','Artificial Openings for Feeding or Elimination', '0.5'), 
('HCC_0189','Amputation Status, Lower Limb/Amputation Complications', '0.407');"; 
sqlStatementNoLog($query);
?>

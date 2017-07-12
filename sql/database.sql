--
-- Database: `libreehr`
-- 

-- 
-- Table structure for table `addresses`
-- 

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL default '0',
  `line1` varchar(255) default NULL,
  `line2` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `state` varchar(35) default NULL,
  `zip` varchar(10) default NULL,
  `plus_four` varchar(4) default NULL,
  `country` varchar(255) default NULL,
  `foreign_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=InnoDB;


--
-- Table structure for table `amc_misc_data`
--

DROP TABLE IF EXISTS `amc_misc_data`;
CREATE TABLE `amc_misc_data` (
  `amc_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_rules',
  `pid` bigint(20) default NULL,
  `map_category` varchar(255) NOT NULL default '' COMMENT 'Maps to an object category (such as prescriptions etc.)',
  `map_id` bigint(20) NOT NULL default '0' COMMENT 'Maps to an object id (such as prescription id etc.)',
  `date_created` datetime default NULL,
  `date_completed` datetime default NULL,
  KEY  (`amc_id`,`pid`,`map_id`)
) ENGINE=InnoDB;


--
-- Table structure for table `amendments`
--

DROP TABLE IF EXISTS `amendments`;
CREATE TABLE IF NOT EXISTS `amendments` (
  `amendment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Amendment ID',
  `amendment_date` date	NOT NULL COMMENT 'Amendement request date',
  `amendment_by` varchar(50) NOT NULL COMMENT 'Amendment requested from',
  `amendment_status` varchar(50) NULL COMMENT 'Amendment status accepted/rejected/null',
  `pid` int(11) NOT NULL COMMENT 'Patient ID from patient_data',
  `amendment_desc` TEXT COMMENT 'Amendment Details',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `modified_by`	int(11) NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time',
  `modified_time` timestamp NULL COMMENT 'modified time',
  PRIMARY KEY amendments_id(`amendment_id`),
  KEY amendment_pid(`pid`)
) ENGINE = MyISAM;


--
-- Table structure for table `amendments_history`
--

DROP TABLE IF EXISTS `amendments_history`;
CREATE TABLE IF NOT EXISTS `amendments_history` (
  `amendment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Amendment ID',
  `amendment_note` TEXT COMMENT 'Amendment requested from',
  `amendment_status` VARCHAR(50) NULL COMMENT 'Amendment Request Status',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time',
KEY amendment_history_id(`amendment_id`)
) ENGINE = MyISAM;
	

-- 
-- Table structure for table `array`
-- 

DROP TABLE IF EXISTS `array`;
CREATE TABLE `array` (
  `array_key` varchar(255) default NULL,
  `array_value` longtext
) ENGINE=InnoDB;


--
-- Table structure for table `audit_master`
--

DROP TABLE IF EXISTS `audit_master`;
CREATE TABLE `audit_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'The Id of the user who approves or denies',
  `approval_status` tinyint(4) NOT NULL COMMENT '1-Pending,2-Approved,3-Denied,4-Appointment directly updated to calendar table,5-Cancelled appointment',
  `comments` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` datetime NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1-new patient,2-existing patient,3-change is only in the document,4-Patient upload,5-random key,10-Appointment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

--
-- Table structure for table `audit_details`
--

DROP TABLE IF EXISTS `audit_details`;
CREATE TABLE `audit_details` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `table_name` VARCHAR(100) NOT NULL COMMENT 'libreehr table name',
  `field_name` VARCHAR(100) NOT NULL COMMENT 'libreehr table''s field name',
  `field_value` TEXT COMMENT 'libreehr table''s field value',
  `audit_master_id` BIGINT(20) NOT NULL COMMENT 'Id of the audit_master table',
  `entry_identification` VARCHAR(255) NOT NULL DEFAULT '1' COMMENT 'Used when multiple entry occurs from the same table.1 means no multiple entry',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

--
-- Table structure for table `background_services`
--

DROP TABLE IF EXISTS `background_services`;
CREATE TABLE `background_services` (
  `name` varchar(31) NOT NULL,
  `title` varchar(127) NOT NULL COMMENT 'name for reports',
  `active` tinyint(1) NOT NULL default '0',
  `running` tinyint(1) NOT NULL default '-1',
  `next_run` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `execute_interval` int(11) NOT NULL default '0' COMMENT 'minimum number of minutes between function calls,0=manual mode',
  `function` varchar(127) NOT NULL COMMENT 'name of background service function',
  `require_once` varchar(255) default NULL COMMENT 'include file (if necessary)',
  `sort_order` int(11) NOT NULL default '100' COMMENT 'lower numbers will be run first',
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB;

-- 
-- Dumping data for table `background_services`
-- 

INSERT INTO `background_services` (`name`, `title`, `execute_interval`, `function`, `require_once`, `sort_order`) VALUES
('phimail', 'phiMail Direct Messaging Service', 5, 'phimail_check', '/library/direct_message_check.inc', 100);


-- 
-- Table structure for table `batchcom`
-- 

DROP TABLE IF EXISTS `batchcom`;
CREATE TABLE `batchcom` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id` int(11) NOT NULL default '0',
  `sent_by` bigint(20) NOT NULL default '0',
  `msg_type` varchar(60) default NULL,
  `msg_subject` varchar(255) default NULL,
  `msg_text` mediumtext,
  `msg_date_sent` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `billing`
-- 

DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `code_type` varchar(15) default NULL,
  `code` varchar(20) default NULL,
  `pid` int(11) default NULL,
  `provider_id` int(11) default NULL,
  `user` int(11) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(1) default NULL,
  `encounter` bigint(20) default NULL,
  `code_text` longtext,
  `billed` tinyint(1) default NULL,
  `activity` tinyint(1) default NULL,
  `payer_id` int(11) default NULL,
  `bill_process` tinyint(2) NOT NULL default '0',
  `bill_date` datetime default NULL,
  `process_date` datetime default NULL,
  `process_file` varchar(255) default NULL,
  `modifier` varchar(12) default NULL,
  `units` int(11) default NULL,
  `fee` decimal(12,2) default NULL,
  `justify` varchar(255) default NULL,
  `target` varchar(30) default NULL,
  `x12_partner_id` int(11) default NULL,
  `ndc_info` varchar(255) default NULL,
  `notecodes` varchar(80) NOT NULL default '',
  `exclude_from_insurance_billing` TINYINT(1) NOT NULL DEFAULT '0',
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `value` varchar(255) default NULL,
  `parent` int(11) NOT NULL default '0',
  `lft` int(11) NOT NULL default '0',
  `rght` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`),
  KEY `lft` (`lft`,`rght`)
) ENGINE=InnoDB;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` VALUES (1, 'Categories', '', 0, 0, 25);
INSERT INTO `categories` VALUES (2, 'Lab Report', '', 1, 1, 2);
INSERT INTO `categories` VALUES (3, 'Medical Record', '', 1, 3, 4);
INSERT INTO `categories` VALUES (4, 'Patient Information', '', 1, 5, 10);
INSERT INTO `categories` VALUES (5, 'Patient ID card', '', 4, 6, 7);
INSERT INTO `categories` VALUES (6, 'Advance Directive', '', 1, 11, 18);
INSERT INTO `categories` VALUES (7, 'Do Not Resuscitate Order', '', 6, 12, 13);
INSERT INTO `categories` VALUES (8, 'Durable Power of Attorney', '', 6, 14, 15);
INSERT INTO `categories` VALUES (9, 'Living Will', '', 6, 16, 17);
INSERT INTO `categories` VALUES (10, 'Patient Photograph', '', 4, 8, 9);
INSERT INTO `categories` VALUES (11, 'CCR', '', 1, 19, 20);
INSERT INTO `categories` VALUES (12, 'CCD', '', 1, 21, 22);
INSERT INTO `categories` VALUES (13, 'CCDA', '', 1, 23, 24);


-- 
-- Table structure for table `categories_seq`
-- 

DROP TABLE IF EXISTS `categories_seq`;
CREATE TABLE `categories_seq` (
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- Dumping data for table `categories_seq`
-- 

INSERT INTO `categories_seq` VALUES (13);


-- 
-- Table structure for table `categories_to_documents`
-- 

DROP TABLE IF EXISTS `categories_to_documents`;
CREATE TABLE `categories_to_documents` (
  `category_id` int(11) NOT NULL default '0',
  `document_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`,`document_id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `claims`
-- 

DROP TABLE IF EXISTS `claims`;
CREATE TABLE `claims` (
  `patient_id` int(11) NOT NULL,
  `encounter_id` int(11) NOT NULL,
  `version` int(10) unsigned NOT NULL COMMENT 'Claim version, incremented in code',
  `payer_id` int(11) NOT NULL default '0',
  `status` tinyint(2) NOT NULL default '0',
  `payer_type` tinyint(4) NOT NULL default '0',
  `bill_process` tinyint(2) NOT NULL default '0',
  `bill_time` datetime default NULL,
  `process_time` datetime default NULL,
  `process_file` varchar(255) default NULL,
  `target` varchar(30) default NULL,
  `x12_partner_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`patient_id`,`encounter_id`,`version`)
) ENGINE=InnoDB;


--
-- Table structure for table `clinical_plans`
--

DROP TABLE IF EXISTS `clinical_plans`;
CREATE TABLE `clinical_plans` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_plans',
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 is default for all patients, while > 0 is id from patient_data table',
  `normal_flag` tinyint(1) COMMENT 'Normal Activation Flag',
  `cqm_flag` tinyint(1) COMMENT 'Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_2011_flag` tinyint(1) COMMENT '2011 Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_2014_flag` tinyint(1) COMMENT '2014 Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_measure_group` varchar(10) NOT NULL default '' COMMENT 'Clinical Quality Measure Group Identifier',
  PRIMARY KEY  (`id`,`pid`)
) ENGINE=InnoDB ;

--
-- Clinical Quality Measure (CMQ) plans
--
-- Measure Group A: Diabetes Mellitus
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('dm_plan_cqm', 0, 0, 1, 1, 'A');
-- Measure Group C: Chronic Kidney Disease (CKD)
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('ckd_plan_cqm', 0, 0, 1, 1, 'C');
-- Measure Group D: Preventative Care
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('prevent_plan_cqm', 0, 0, 1, 1, 'D');
-- Measure Group E: Perioperative Care
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('periop_plan_cqm', 0, 0, 1, 1, 'E');
-- Measure Group F: Rheumatoid Arthritis
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('rheum_arth_plan_cqm', 0, 0, 1, 1, 'F');
-- Measure Group G: Back Pain
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('back_pain_plan_cqm', 0, 0, 1, 1, 'G');
-- Measure Group H: Coronary Artery Bypass Graft (CABG)
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_measure_group` ) VALUES ('cabg_plan_cqm', 0, 0, 1, 1, 'H');
--
-- Standard clinical plans
--
-- Diabetes Mellitus
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_measure_group` ) VALUES ('dm_plan', 0, 1, 0, '');
INSERT INTO `clinical_plans` ( `id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_measure_group` ) VALUES ('prevent_plan', 0, 1, 0, '');


--
-- Table structure for table `clinical_plans_rules`
--

DROP TABLE IF EXISTS `clinical_plans_rules`;
CREATE TABLE `clinical_plans_rules` (
  `plan_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_plans',
  `rule_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_rules',
  PRIMARY KEY  (`plan_id`,`rule_id`)
) ENGINE=InnoDB ;

--
-- Clinical Quality Measure (CMQ) plans to rules mappings
--
-- Measure Group A: Diabetes Mellitus
--   NQF 0059 (PQRI 1)   Diabetes: HbA1c Poor Control
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan_cqm', 'rule_dm_a1c_cqm');
--   NQF 0064 (PQRI 2)   Diabetes: LDL Management & Control
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan_cqm', 'rule_dm_ldl_cqm');
--   NQF 0061 (PQRI 3)   Diabetes: Blood Pressure Management
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan_cqm', 'rule_dm_bp_control_cqm');
--   NQF 0055 (PQRI 117) Diabetes: Eye Exam
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan_cqm', 'rule_dm_eye_cqm');
--   NQF 0056 (PQRI 163) Diabetes: Foot Exam
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan_cqm', 'rule_dm_foot_cqm');
-- Measure Group D: Preventative Care
--   NQF 0041 (PQRI 110) Influenza Immunization for Patients >= 50 Years Old
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan_cqm', 'rule_influenza_ge_50_cqm');
--   NQF 0043 (PQRI 111) Pneumonia Vaccination Status for Older Adults
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan_cqm', 'rule_pneumovacc_ge_65_cqm');
--   NQF 0421 (PQRI 128) Adult Weight Screening and Follow-Up
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan_cqm', 'rule_adult_wt_screen_fu_cqm');
--
-- Standard clinical plans to rules mappings
--
-- Diabetes Mellitus
--   Hemoglobin A1C
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan', 'rule_dm_hemo_a1c');
--   Urine Microalbumin
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan', 'rule_dm_urine_alb');
--   Eye Exam
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan', 'rule_dm_eye');
--   Foot Exam
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('dm_plan', 'rule_dm_foot');
-- Preventative Care
--   Hypertension: Blood Pressure Measurement
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_htn_bp_measure');
--   Tobacco Use Assessment
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_tob_use_assess');
--   Tobacco Cessation Intervention
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_tob_cess_inter');
--   Adult Weight Screening and Follow-Up
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_adult_wt_screen_fu');
--   Weight Assessment and Counseling for Children and Adolescents
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_wt_assess_couns_child');
--   Influenza Immunization for Patients >= 50 Years Old
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_influenza_ge_50');
--   Pneumonia Vaccination Status for Older Adults
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_pneumovacc_ge_65');
--   Cancer Screening: Mammogram
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_cs_mammo');
--   Cancer Screening: Pap Smear
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_cs_pap');
--   Cancer Screening: Colon Cancer Screening
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_cs_colon');
--   Cancer Screening: Prostate Cancer Screening
INSERT INTO `clinical_plans_rules` ( `plan_id`, `rule_id` ) VALUES ('prevent_plan', 'rule_cs_prostate');



DROP TABLE IF EXISTS `clinical_rules_log`;
CREATE TABLE `clinical_rules_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `uid` bigint(20) NOT NULL DEFAULT '0',
  `category` VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'An example category is clinical_reminder_widget',
  `value` TEXT NOT NULL,
  `new_value` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `uid` (`uid`),
  KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;



-- 
-- Table structure for table `codes`
-- 

DROP TABLE IF EXISTS `codes`;
CREATE TABLE `codes` (
  `id` int(11) NOT NULL auto_increment,
  `code_text` varchar(255) NOT NULL default '',
  `code_text_short` varchar(24) NOT NULL default '',
  `code` varchar(25) NOT NULL default '',
  `code_type` smallint(6) default NULL,
  `modifier` varchar(12) NOT NULL default '',
  `units` int(11) default NULL,
  `fee` decimal(12,2) default NULL,
  `superbill` varchar(31) NOT NULL default '',
  `related_code` varchar(255) NOT NULL default '',
  `taxrates` varchar(255) NOT NULL default '',
  `cyp_factor` float NOT NULL DEFAULT 0 COMMENT 'quantity representing a years supply',
  `active` TINYINT(1) DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `exclude_from_insurance_billing` TINYINT(1) DEFAULT '0' COMMENT '0 = include, 1 = exclude',
  `reportable` TINYINT(1) DEFAULT 0 COMMENT '0 = non-reportable, 1 = reportable',
  `financial_reporting` TINYINT(1) DEFAULT 0 COMMENT '0 = negative, 1 = considered important code in financial reporting',
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `code_type` (`code_type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `syndromic_surveillance`
-- 

DROP TABLE IF EXISTS `syndromic_surveillance`;
CREATE TABLE `syndromic_surveillance` (
  `id` bigint(20) NOT NULL auto_increment,
  `lists_id` bigint(20) NOT NULL,
  `submission_date` datetime NOT NULL,
  `filename` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY (`lists_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `config`
-- 

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `value` varchar(255) default NULL,
  `parent` int(11) NOT NULL default '0',
  `lft` int(11) NOT NULL default '0',
  `rght` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent` (`parent`),
  KEY `lft` (`lft`,`rght`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `config_seq`
-- 

DROP TABLE IF EXISTS `config_seq`;
CREATE TABLE `config_seq` (
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- 
-- Dumping data for table `config_seq`
-- 

INSERT INTO `config_seq` VALUES (0);


--
-- Table structure for table `dated_reminders`
--

DROP TABLE IF EXISTS `dated_reminders`;
CREATE TABLE `dated_reminders` (
  `dr_id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_from_ID` int(11) NOT NULL,
  `dr_message_text` varchar(160) NOT NULL,
  `dr_message_sent_date` datetime NOT NULL,
  `dr_message_due_date` date NOT NULL,
  `pid` int(11) NOT NULL,
  `message_priority` tinyint(1) NOT NULL,
  `message_processed` tinyint(1) NOT NULL DEFAULT '0',
  `processed_date` timestamp NULL DEFAULT NULL,
  `dr_processed_by` int(11) NOT NULL,
  PRIMARY KEY (`dr_id`),
  KEY `dr_from_ID` (`dr_from_ID`,`dr_message_due_date`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


--
-- Table structure for table `dated_reminders_link`
--

DROP TABLE IF EXISTS `dated_reminders_link`;
CREATE TABLE `dated_reminders_link` (           
  `dr_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  PRIMARY KEY (`dr_link_id`),
  KEY `to_id` (`to_id`),
  KEY `dr_id` (`dr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


-- 
-- Table structure for table `direct_message_log`
-- 

DROP TABLE IF EXISTS `direct_message_log`;
CREATE TABLE `direct_message_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `msg_type` char(1) NOT NULL COMMENT 'S=sent,R=received',
  `msg_id` varchar(127) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `create_ts` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `status` char(1) NOT NULL COMMENT 'Q=queued,D=dispatched,R=received,F=failed',
  `status_info` varchar(511) default NULL,
  `status_ts` timestamp NULL default NULL,
  `patient_id` bigint(20) default NULL,
  `user_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `msg_id` (`msg_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `documents`
-- 

DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL default '0',
  `type` enum('file_url','blob','web_url') default NULL,
  `size` int(11) default NULL,
  `date` datetime default NULL,
  `url` varchar(255) default NULL,
  `mimetype` varchar(255) default NULL,
  `pages` int(11) default NULL,
  `owner` int(11) default NULL,
  `revision` timestamp NOT NULL,
  `foreign_id` int(11) default NULL,
  `docdate` date default NULL,
  `hash` varchar(40) DEFAULT NULL COMMENT '40-character SHA-1 hash of document',
  `list_id` bigint(20) NOT NULL default '0',
  `couch_docid` VARCHAR(100) DEFAULT NULL,
  `couch_revid` VARCHAR(100) DEFAULT NULL,
  `storagemethod` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0->Harddisk,1->CouchDB',
  `path_depth` TINYINT DEFAULT '1' COMMENT 'Depth of path to use in url to find document. Not applicable for CouchDB.',
  `imported` TINYINT DEFAULT 0 NULL COMMENT 'Parsing status for CCR/CCD/CCDA importing',
  `encounter_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Encounter id if tagged',
  `encounter_check`	TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'If encounter is created while tagging',
  `audit_master_approval_status` TINYINT NOT NULL DEFAULT 1 COMMENT 'approval_status from audit_master table',
  `audit_master_id` int(11) default NULL,
  `documentationOf` varchar(255) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `revision` (`revision`),
  KEY `foreign_id` (`foreign_id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB;


--
-- Table structure for table `documents_legal_detail`
--

DROP TABLE IF EXISTS `documents_legal_detail`;
CREATE TABLE `documents_legal_detail` (
  `dld_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dld_pid` int(10) unsigned DEFAULT NULL,
  `dld_facility` int(10) unsigned DEFAULT NULL,
  `dld_provider` int(10) unsigned DEFAULT NULL,
  `dld_encounter` int(10) unsigned DEFAULT NULL,
  `dld_master_docid` int(10) unsigned NOT NULL,
  `dld_signed` smallint(5) unsigned NOT NULL COMMENT '0-Not Signed or Cannot Sign(Layout),1-Signed,2-Ready to sign,3-Denied(Pat Regi),4-Patient Upload,10-Save(Layout)',
  `dld_signed_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dld_filepath` varchar(75) DEFAULT NULL,
  `dld_filename` varchar(45) NOT NULL,
  `dld_signing_person` varchar(50) NOT NULL,
  `dld_sign_level` int(11) NOT NULL COMMENT 'Sign flow level',
  `dld_content` varchar(50) NOT NULL COMMENT 'Layout sign position',
  `dld_file_for_pdf_generation` blob NOT NULL COMMENT 'The filled details in the fdf file is stored here.Patient Registration Screen',
  `dld_denial_reason` longtext,
  `dld_moved` tinyint(4) NOT NULL DEFAULT '0',
  `dld_patient_comments` text COMMENT 'Patient comments stored here',
  PRIMARY KEY (`dld_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `documents_legal_master`
--

DROP TABLE IF EXISTS `documents_legal_master`;
CREATE TABLE `documents_legal_master` (
  `dlm_category` int(10) unsigned DEFAULT NULL,
  `dlm_subcategory` int(10) unsigned DEFAULT NULL,
  `dlm_document_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dlm_document_name` varchar(75) NOT NULL,
  `dlm_filepath` varchar(75) NOT NULL,
  `dlm_facility` int(10) unsigned DEFAULT NULL,
  `dlm_provider` int(10) unsigned DEFAULT NULL,
  `dlm_sign_height` double NOT NULL,
  `dlm_sign_width` double NOT NULL,
  `dlm_filename` varchar(45) NOT NULL,
  `dlm_effective_date` datetime NOT NULL,
  `dlm_version` int(10) unsigned NOT NULL,
  `content` varchar(255) NOT NULL,
  `dlm_savedsign` varchar(255) DEFAULT NULL COMMENT '0-Yes 1-No',
  `dlm_review` varchar(255) DEFAULT NULL COMMENT '0-Yes 1-No',
  `dlm_upload_type` tinyint(4) DEFAULT '0' COMMENT '0-Provider Uploaded,1-Patient Uploaded',
  PRIMARY KEY (`dlm_document_id`)
) ENGINE=InnoDB COMMENT='List of Master Docs to be signed' AUTO_INCREMENT=1 ;


--
-- Table structure for table `documents_legal_categories`
--

DROP TABLE IF EXISTS `documents_legal_categories`;
CREATE TABLE `documents_legal_categories` (
  `dlc_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dlc_category_type` int(10) unsigned NOT NULL COMMENT '1 category 2 subcategory',
  `dlc_category_name` varchar(45) NOT NULL,
  `dlc_category_parent` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`dlc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 ;

--
-- Dumping data for table `documents_legal_categories`
--

INSERT INTO `documents_legal_categories` (`dlc_id`, `dlc_category_type`, `dlc_category_name`, `dlc_category_parent`) VALUES
(3, 1, 'Category', NULL),
(4, 2, 'Sub Category', 1),
(5, 1, 'Layout Form', 0),
(6, 2, 'Layout Signed', 5);

-- 
-- Table structure for table `drug_inventory`
-- 

DROP TABLE IF EXISTS `drug_inventory`;
CREATE TABLE `drug_inventory` (
  `inventory_id` int(11) NOT NULL auto_increment,
  `drug_id` int(11) NOT NULL,
  `lot_number` varchar(20) default NULL,
  `expiration` date default NULL,
  `manufacturer` varchar(255) default NULL,
  `on_hand` int(11) NOT NULL default '0',
  `warehouse_id` varchar(31) NOT NULL DEFAULT '',
  `vendor_id` bigint(20) NOT NULL DEFAULT 0,
  `last_notify` date NOT NULL default '0000-00-00',
  `destroy_date` date default NULL,
  `destroy_method` varchar(255) default NULL,
  `destroy_witness` varchar(255) default NULL,
  `destroy_notes` varchar(255) default NULL,
  PRIMARY KEY  (`inventory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `drug_sales`
-- 

DROP TABLE IF EXISTS `drug_sales`;
CREATE TABLE `drug_sales` (
  `sale_id` int(11) NOT NULL auto_increment,
  `drug_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `encounter` int(11) NOT NULL default '0',
  `user` varchar(255) default NULL,
  `sale_date` date NOT NULL,
  `quantity` int(11) NOT NULL default '0',
  `fee` decimal(12,2) NOT NULL default '0.00',
  `billed` tinyint(1) NOT NULL default '0' COMMENT 'indicates if the sale is posted to accounting',
  `xfer_inventory_id` int(11) NOT NULL DEFAULT 0,
  `distributor_id` bigint(20) NOT NULL DEFAULT 0 COMMENT 'references users.id',
  `notes` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`sale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `drug_templates`
-- 

DROP TABLE IF EXISTS `drug_templates`;
CREATE TABLE `drug_templates` (
  `drug_id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL default '',
  `dosage` varchar(10) default NULL,
  `period` int(11) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  `refills` int(11) NOT NULL default '0',
  `taxrates` varchar(255) default NULL,
  PRIMARY KEY  (`drug_id`,`selector`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `drugs`
-- 

DROP TABLE IF EXISTS `drugs`;
CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL DEFAULT '',
  `ndc_number` varchar(20) NOT NULL DEFAULT '',
  `on_order` int(11) NOT NULL default '0',
  `reorder_point` float NOT NULL DEFAULT 0.0,
  `max_level` float NOT NULL DEFAULT 0.0,
  `last_notify` date NOT NULL default '0000-00-00',
  `reactions` text,
  `form` int(3) NOT NULL default '0',
  `size` float unsigned NOT NULL default '0',
  `unit` int(11) NOT NULL default '0',
  `route` int(11) NOT NULL default '0',
  `substitute` int(11) NOT NULL default '0',
  `related_code` varchar(255) NOT NULL DEFAULT '' COMMENT 'may reference a related codes.code',
  `cyp_factor` float NOT NULL DEFAULT 0 COMMENT 'quantity representing a years supply',
  `active` TINYINT(1) DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `allow_combining` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 = allow filling an order from multiple lots',
  `allow_multiple`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = allow multiple lots at one warehouse',
  `drug_code` varchar(25) NULL,
  PRIMARY KEY  (`drug_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `eligibility_response`
--

DROP TABLE IF EXISTS `eligibility_response`;
CREATE TABLE `eligibility_response` (
  `response_id` bigint(20) NOT NULL auto_increment,
  `response_description` varchar(255) default NULL,
  `response_status` enum('A','D') NOT NULL default 'A',
  `response_vendor_id` bigint(20) default NULL,
  `response_create_date` date default NULL,
  `response_modify_date` date default NULL,
  PRIMARY KEY  (`response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


--
-- Table structure for table `eligibility_verification`
--

DROP TABLE IF EXISTS `eligibility_verification`;
CREATE TABLE `eligibility_verification` (
  `verification_id` bigint(20) NOT NULL auto_increment,
  `response_id` bigint(20) default NULL,
  `insurance_id` bigint(20) default NULL,
  `eligibility_check_date` datetime default NULL,
  `copay` int(11) default NULL,
  `deductible` int(11) default NULL,
  `deductiblemet` enum('Y','N') default 'Y',
  `create_date` date default NULL,
  PRIMARY KEY  (`verification_id`),
  KEY `insurance_id` (`insurance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


-- 
-- Table structure for table `employer_data`
-- 

DROP TABLE IF EXISTS `employer_data`;
CREATE TABLE `employer_data` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `street` varchar(255) default NULL,
  `postal_code` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `state` varchar(255) default NULL,
  `country` varchar(255) default NULL,
  `date` datetime default NULL,
  `pid` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `enc_category_map`
--
-- Mapping of rule encounter categories to category ids from the event category in libreehr_postcalendar_categories
--

DROP TABLE IF EXISTS `enc_category_map`;
CREATE TABLE `enc_category_map` (
  `rule_enc_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'encounter id from rule_enc_types list in list_options',
  `main_cat_id` int(11) NOT NULL DEFAULT 0 COMMENT 'category id from event category in libreehr_postcalendar_categories',
  KEY  (`rule_enc_id`,`main_cat_id`)
) ENGINE=InnoDB ;

INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_outpatient', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_outpatient', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_outpatient', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_fac', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_fac', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_fac', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_off_vis', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_off_vis', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_off_vis', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_hea_and_beh', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_hea_and_beh', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_hea_and_beh', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_occ_ther', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_occ_ther', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_occ_ther', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_psych_and_psych', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_psych_and_psych', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_psych_and_psych', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_18_older', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_18_older', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_18_older', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_40_older', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_40_older', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_ser_40_older', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_ind_counsel', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_ind_counsel', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_ind_counsel', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_group_counsel', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_group_counsel', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_group_counsel', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_other_serv', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_other_serv', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pre_med_other_serv', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_out_pcp_obgyn', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_out_pcp_obgyn', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_out_pcp_obgyn', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pregnancy', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pregnancy', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_pregnancy', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_discharge', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_discharge', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nurs_discharge', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_acute_inp_or_ed', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_acute_inp_or_ed', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_acute_inp_or_ed', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nonac_inp_out_or_opth', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nonac_inp_out_or_opth', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_nonac_inp_out_or_opth', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_influenza', 5);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_influenza', 9);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_influenza', 10);
INSERT INTO `enc_category_map` ( `rule_enc_id`, `main_cat_id` ) VALUES ('enc_ophthal_serv', 14);

--
-- Table structure for table `erx_ttl_touch`
--
-- Store records last update per patient data process
--

DROP TABLE IF EXISTS `erx_ttl_touch`;
CREATE  TABLE `erx_ttl_touch` (
  `patient_id` BIGINT(20) UNSIGNED NOT NULL COMMENT 'Patient record Id' ,
  `process` ENUM('allergies','medications') NOT NULL COMMENT 'NewCrop eRx SOAP process' ,
  `updated` DATETIME NOT NULL COMMENT 'Date and time of last process update for patient' ,
  PRIMARY KEY (`patient_id`, `process`)
) ENGINE = InnoDB COMMENT = 'Store records last update per patient data process' ;


--
-- Table structure for table `standardized_tables_track`
--

DROP TABLE IF EXISTS `standardized_tables_track`;
CREATE TABLE `standardized_tables_track` (
  `id` int(11) NOT NULL auto_increment,
  `imported_date` datetime default NULL,
  `name` varchar(255) NOT NULL default '' COMMENT 'name of standardized tables such as RXNORM',
  `revision_version` varchar(255) NOT NULL default '' COMMENT 'revision of standardized tables that were imported',
  `revision_date` datetime default NULL COMMENT 'revision of standardized tables that were imported',
  `file_checksum` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `facility`
-- 

DROP TABLE IF EXISTS `facility`;
CREATE TABLE `facility` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(60) default NULL,
  `phone` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `street` varchar(255) default NULL,
  `city` varchar(255) default NULL,
  `state` varchar(50) default NULL,
  `postal_code` varchar(11) default NULL,
  `country_code` varchar(10) default NULL,
  `federal_ein` varchar(15) default NULL,
  `website` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `service_location` tinyint(1) NOT NULL default '1',
  `billing_location` tinyint(1) NOT NULL default '0',
  `accepts_assignment` tinyint(1) NOT NULL default '0',
  `pos_code` tinyint(4) default NULL,
  `x12_sender_id` varchar(25) default NULL,
  `attn` varchar(65) default NULL,
  `domain_identifier` varchar(60) default NULL,
  `facility_npi` varchar(15) default NULL,
  `tax_id_type` VARCHAR(31) NOT NULL DEFAULT '',
  `color` VARCHAR(7) NOT NULL DEFAULT '',
  `primary_business_entity` INT(10) NOT NULL DEFAULT '0' COMMENT '0-Not Set as business entity 1-Set as business entity',
  `facility_code` VARCHAR(31) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `facility`
-- 

INSERT INTO `facility` VALUES (3, 'Your Clinic Name Here', '000-000-0000', '000-000-0000', '', '', '', '', '', '', NULL, NULL, 1, 1, 0, NULL, '', '', '', '', '','#99FFFF','0', '');



-- 
-- Table structure for table `facility_user_ids`
-- 

DROP TABLE IF EXISTS `facility_user_ids`;
CREATE TABLE  `facility_user_ids` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL,
  `facility_id` bigint(20) DEFAULT NULL,
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`facility_id`,`field_id`)
) ENGINE=InnoDB  AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `fee_sheet_options`
-- 

DROP TABLE IF EXISTS `fee_sheet_options`;
CREATE TABLE `fee_sheet_options` (
  `fs_category` varchar(63) default NULL,
  `fs_option` varchar(63) default NULL,
  `fs_codes` varchar(255) default NULL
) ENGINE=InnoDB;

-- 
-- Dumping data for table `fee_sheet_options`
-- 

INSERT INTO `fee_sheet_options` VALUES ('1New Patient', '1Brief', 'CPT4|99201|');
INSERT INTO `fee_sheet_options` VALUES ('1New Patient', '2Limited', 'CPT4|99202|');
INSERT INTO `fee_sheet_options` VALUES ('1New Patient', '3Detailed', 'CPT4|99203|');
INSERT INTO `fee_sheet_options` VALUES ('1New Patient', '4Extended', 'CPT4|99204|');
INSERT INTO `fee_sheet_options` VALUES ('1New Patient', '5Comprehensive', 'CPT4|99205|');
INSERT INTO `fee_sheet_options` VALUES ('2Established Patient', '1Brief', 'CPT4|99211|');
INSERT INTO `fee_sheet_options` VALUES ('2Established Patient', '2Limited', 'CPT4|99212|');
INSERT INTO `fee_sheet_options` VALUES ('2Established Patient', '3Detailed', 'CPT4|99213|');
INSERT INTO `fee_sheet_options` VALUES ('2Established Patient', '4Extended', 'CPT4|99214|');
INSERT INTO `fee_sheet_options` VALUES ('2Established Patient', '5Comprehensive', 'CPT4|99215|');


-- 
-- Table structure for table `form_dictation`
-- 

DROP TABLE IF EXISTS `form_dictation`;
CREATE TABLE `form_dictation` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default NULL,
  `activity` tinyint(4) default NULL,
  `dictation` longtext,
  `additional_notes` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_encounter`
-- 

DROP TABLE IF EXISTS `form_encounter`;
CREATE TABLE `form_encounter` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `reason` longtext,
  `facility` longtext,
  `facility_id` int(11) NOT NULL default '0',
  `pid` bigint(20) default NULL,
  `encounter` bigint(20) default NULL,
  `onset_date` datetime default NULL,
  `sensitivity` varchar(30) default NULL,
  `billing_note` text,
  `pc_catid` int(11) NOT NULL default '5' COMMENT 'event category from libreehr_postcalendar_categories',
  `last_level_billed` int  NOT NULL DEFAULT 0 COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_level_closed` int  NOT NULL DEFAULT 0 COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_stmt_date`    date DEFAULT NULL,
  `stmt_count`        int  NOT NULL DEFAULT 0,
  `provider_id` INT(11) DEFAULT '0' COMMENT 'default and main provider for this visit',
  `supervisor_id` INT(11) DEFAULT '0' COMMENT 'supervising provider, if any, for this visit',
  `ordering_physician` INT(11) DEFAULT '0' COMMENT 'ordering provider , if any, for this visit',
  `referring_physician` INT(11) DEFAULT '0' COMMENT 'referring provider, if any, for this visit',
  `contract_physician` INT(11) DEFAULT '0' COMMENT 'contract provider, if any, for this visit',  
  `invoice_refno` varchar(31) NOT NULL DEFAULT '',
  `referral_source` varchar(31) NOT NULL DEFAULT '',
  `billing_facility` INT(11) NOT NULL DEFAULT 0,
  `external_id` VARCHAR(20) DEFAULT NULL,
  `eft_number` varchar(80) DEFAULT NULL,
  `claim_number` varchar(80) DEFAULT NULL,
  `document_image` varchar(80) DEFAULT NULL,
  `seq_number` varchar(80) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid_encounter` (`pid`, `encounter`),
  KEY `encounter_date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_annotate_diagram`
-- 

DROP TABLE IF EXISTS `form_annotate_diagram`;
CREATE TABLE `form_annotate_diagram` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT '1',
  `data` text ,
  `imagedata` varchar(255) DEFAULT 'NEW',
  `dyntitle` varchar(255) DEFAULT 'Annotated Diagram',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `form_misc_billing_options`
-- 

DROP TABLE IF EXISTS `form_misc_billing_options`;
CREATE TABLE `form_misc_billing_options` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default NULL,
  `activity` tinyint(4) default NULL,
  `employment_related` tinyint(1) default NULL,
  `auto_accident` tinyint(1) default NULL,
  `accident_state` varchar(2) default NULL,
  `other_accident` tinyint(1) default NULL,
  `medicaid_referral_code` varchar(2)   default NULL,
  `epsdt_flag` tinyint(1) default NULL,
  `provider_qualifier_code` varchar(2) default NULL,
  `provider_id` int(11) default NULL,
  `outside_lab` tinyint(1) default NULL,
  `lab_amount` decimal(5,2) default NULL,
  `is_unable_to_work` tinyint(1) default NULL,
  `date_initial_treatment` date default NULL,
  `off_work_from` date default NULL,
  `off_work_to` date default NULL,
  `is_hospitalized` tinyint(1) default NULL,
  `hospitalization_date_from` date default NULL,
  `hospitalization_date_to` date default NULL,
  `medicaid_resubmission_code` varchar(10) default NULL,
  `medicaid_original_reference` varchar(15) default NULL,
  `prior_auth_number` varchar(20) default NULL,
  `comments` varchar(255) default NULL,
  `replacement_claim` tinyint(1) default 0,
  `icn_resubmission_number` varchar(35) default NULL,
  `box_14_date_qual` char(3) default NULL,
  `box_15_date_qual` char(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_reviewofs`
-- 

DROP TABLE IF EXISTS `form_reviewofs`;
CREATE TABLE `form_reviewofs` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default NULL,
  `activity` tinyint(4) default NULL,
  `fever` varchar(5) default NULL,
  `chills` varchar(5) default NULL,
  `night_sweats` varchar(5) default NULL,
  `weight_loss` varchar(5) default NULL,
  `poor_appetite` varchar(5) default NULL,
  `insomnia` varchar(5) default NULL,
  `fatigued` varchar(5) default NULL,
  `depressed` varchar(5) default NULL,
  `hyperactive` varchar(5) default NULL,
  `exposure_to_foreign_countries` varchar(5) default NULL,
  `cataracts` varchar(5) default NULL,
  `cataract_surgery` varchar(5) default NULL,
  `glaucoma` varchar(5) default NULL,
  `double_vision` varchar(5) default NULL,
  `blurred_vision` varchar(5) default NULL,
  `poor_hearing` varchar(5) default NULL,
  `headaches` varchar(5) default NULL,
  `ringing_in_ears` varchar(5) default NULL,
  `bloody_nose` varchar(5) default NULL,
  `sinusitis` varchar(5) default NULL,
  `sinus_surgery` varchar(5) default NULL,
  `dry_mouth` varchar(5) default NULL,
  `strep_throat` varchar(5) default NULL,
  `tonsillectomy` varchar(5) default NULL,
  `swollen_lymph_nodes` varchar(5) default NULL,
  `throat_cancer` varchar(5) default NULL,
  `throat_cancer_surgery` varchar(5) default NULL,
  `heart_attack` varchar(5) default NULL,
  `irregular_heart_beat` varchar(5) default NULL,
  `chest_pains` varchar(5) default NULL,
  `shortness_of_breath` varchar(5) default NULL,
  `high_blood_pressure` varchar(5) default NULL,
  `heart_failure` varchar(5) default NULL,
  `poor_circulation` varchar(5) default NULL,
  `vascular_surgery` varchar(5) default NULL,
  `cardiac_catheterization` varchar(5) default NULL,
  `coronary_artery_bypass` varchar(5) default NULL,
  `heart_transplant` varchar(5) default NULL,
  `stress_test` varchar(5) default NULL,
  `emphysema` varchar(5) default NULL,
  `chronic_bronchitis` varchar(5) default NULL,
  `interstitial_lung_disease` varchar(5) default NULL,
  `shortness_of_breath_2` varchar(5) default NULL,
  `lung_cancer` varchar(5) default NULL,
  `lung_cancer_surgery` varchar(5) default NULL,
  `pheumothorax` varchar(5) default NULL,
  `stomach_pains` varchar(5) default NULL,
  `peptic_ulcer_disease` varchar(5) default NULL,
  `gastritis` varchar(5) default NULL,
  `endoscopy` varchar(5) default NULL,
  `polyps` varchar(5) default NULL,
  `colonoscopy` varchar(5) default NULL,
  `colon_cancer` varchar(5) default NULL,
  `colon_cancer_surgery` varchar(5) default NULL,
  `ulcerative_colitis` varchar(5) default NULL,
  `crohns_disease` varchar(5) default NULL,
  `appendectomy` varchar(5) default NULL,
  `divirticulitis` varchar(5) default NULL,
  `divirticulitis_surgery` varchar(5) default NULL,
  `gall_stones` varchar(5) default NULL,
  `cholecystectomy` varchar(5) default NULL,
  `hepatitis` varchar(5) default NULL,
  `cirrhosis_of_the_liver` varchar(5) default NULL,
  `splenectomy` varchar(5) default NULL,
  `kidney_failure` varchar(5) default NULL,
  `kidney_stones` varchar(5) default NULL,
  `kidney_cancer` varchar(5) default NULL,
  `kidney_infections` varchar(5) default NULL,
  `bladder_infections` varchar(5) default NULL,
  `bladder_cancer` varchar(5) default NULL,
  `prostate_problems` varchar(5) default NULL,
  `prostate_cancer` varchar(5) default NULL,
  `kidney_transplant` varchar(5) default NULL,
  `sexually_transmitted_disease` varchar(5) default NULL,
  `burning_with_urination` varchar(5) default NULL,
  `discharge_from_urethra` varchar(5) default NULL,
  `rashes` varchar(5) default NULL,
  `infections` varchar(5) default NULL,
  `ulcerations` varchar(5) default NULL,
  `pemphigus` varchar(5) default NULL,
  `herpes` varchar(5) default NULL,
  `osetoarthritis` varchar(5) default NULL,
  `rheumotoid_arthritis` varchar(5) default NULL,
  `lupus` varchar(5) default NULL,
  `ankylosing_sondlilitis` varchar(5) default NULL,
  `swollen_joints` varchar(5) default NULL,
  `stiff_joints` varchar(5) default NULL,
  `broken_bones` varchar(5) default NULL,
  `neck_problems` varchar(5) default NULL,
  `back_problems` varchar(5) default NULL,
  `back_surgery` varchar(5) default NULL,
  `scoliosis` varchar(5) default NULL,
  `herniated_disc` varchar(5) default NULL,
  `shoulder_problems` varchar(5) default NULL,
  `elbow_problems` varchar(5) default NULL,
  `wrist_problems` varchar(5) default NULL,
  `hand_problems` varchar(5) default NULL,
  `hip_problems` varchar(5) default NULL,
  `knee_problems` varchar(5) default NULL,
  `ankle_problems` varchar(5) default NULL,
  `foot_problems` varchar(5) default NULL,
  `insulin_dependent_diabetes` varchar(5) default NULL,
  `noninsulin_dependent_diabetes` varchar(5) default NULL,
  `hypothyroidism` varchar(5) default NULL,
  `hyperthyroidism` varchar(5) default NULL,
  `cushing_syndrom` varchar(5) default NULL,
  `addison_syndrom` varchar(5) default NULL,
  `additional_notes` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_ros`
-- 

DROP TABLE IF EXISTS `form_ros`;
CREATE TABLE `form_ros` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `activity` int(11) NOT NULL default '1',
  `date` datetime default NULL,
  `weight_change` varchar(3) default NULL,
  `weakness` varchar(3) default NULL,
  `fatigue` varchar(3) default NULL,
  `anorexia` varchar(3) default NULL,
  `fever` varchar(3) default NULL,
  `chills` varchar(3) default NULL,
  `night_sweats` varchar(3) default NULL,
  `insomnia` varchar(3) default NULL,
  `irritability` varchar(3) default NULL,
  `heat_or_cold` varchar(3) default NULL,
  `intolerance` varchar(3) default NULL,
  `change_in_vision` varchar(3) default NULL,
  `glaucoma_history` varchar(3) default NULL,
  `eye_pain` varchar(3) default NULL,
  `irritation` varchar(3) default NULL,
  `redness` varchar(3) default NULL,
  `excessive_tearing` varchar(3) default NULL,
  `double_vision` varchar(3) default NULL,
  `blind_spots` varchar(3) default NULL,
  `photophobia` varchar(3) default NULL,
  `hearing_loss` varchar(3) default NULL,
  `discharge` varchar(3) default NULL,
  `pain` varchar(3) default NULL,
  `vertigo` varchar(3) default NULL,
  `tinnitus` varchar(3) default NULL,
  `frequent_colds` varchar(3) default NULL,
  `sore_throat` varchar(3) default NULL,
  `sinus_problems` varchar(3) default NULL,
  `post_nasal_drip` varchar(3) default NULL,
  `nosebleed` varchar(3) default NULL,
  `snoring` varchar(3) default NULL,
  `apnea` varchar(3) default NULL,
  `breast_mass` varchar(3) default NULL,
  `breast_discharge` varchar(3) default NULL,
  `biopsy` varchar(3) default NULL,
  `abnormal_mammogram` varchar(3) default NULL,
  `cough` varchar(3) default NULL,
  `sputum` varchar(3) default NULL,
  `shortness_of_breath` varchar(3) default NULL,
  `wheezing` varchar(3) default NULL,
  `hemoptsyis` varchar(3) default NULL,
  `asthma` varchar(3) default NULL,
  `copd` varchar(3) default NULL,
  `chest_pain` varchar(3) default NULL,
  `palpitation` varchar(3) default NULL,
  `syncope` varchar(3) default NULL,
  `pnd` varchar(3) default NULL,
  `doe` varchar(3) default NULL,
  `orthopnea` varchar(3) default NULL,
  `peripheal` varchar(3) default NULL,
  `edema` varchar(3) default NULL,
  `legpain_cramping` varchar(3) default NULL,
  `history_murmur` varchar(3) default NULL,
  `arrythmia` varchar(3) default NULL,
  `heart_problem` varchar(3) default NULL,
  `dysphagia` varchar(3) default NULL,
  `heartburn` varchar(3) default NULL,
  `bloating` varchar(3) default NULL,
  `belching` varchar(3) default NULL,
  `flatulence` varchar(3) default NULL,
  `nausea` varchar(3) default NULL,
  `vomiting` varchar(3) default NULL,
  `hematemesis` varchar(3) default NULL,
  `gastro_pain` varchar(3) default NULL,
  `food_intolerance` varchar(3) default NULL,
  `hepatitis` varchar(3) default NULL,
  `jaundice` varchar(3) default NULL,
  `hematochezia` varchar(3) default NULL,
  `changed_bowel` varchar(3) default NULL,
  `diarrhea` varchar(3) default NULL,
  `constipation` varchar(3) default NULL,
  `polyuria` varchar(3) default NULL,
  `polydypsia` varchar(3) default NULL,
  `dysuria` varchar(3) default NULL,
  `hematuria` varchar(3) default NULL,
  `frequency` varchar(3) default NULL,
  `urgency` varchar(3) default NULL,
  `incontinence` varchar(3) default NULL,
  `renal_stones` varchar(3) default NULL,
  `utis` varchar(3) default NULL,
  `hesitancy` varchar(3) default NULL,
  `dribbling` varchar(3) default NULL,
  `stream` varchar(3) default NULL,
  `nocturia` varchar(3) default NULL,
  `erections` varchar(3) default NULL,
  `ejaculations` varchar(3) default NULL,
  `g` varchar(3) default NULL,
  `p` varchar(3) default NULL,
  `ap` varchar(3) default NULL,
  `lc` varchar(3) default NULL,
  `mearche` varchar(3) default NULL,
  `menopause` varchar(3) default NULL,
  `lmp` varchar(3) default NULL,
  `f_frequency` varchar(3) default NULL,
  `f_flow` varchar(3) default NULL,
  `f_symptoms` varchar(3) default NULL,
  `abnormal_hair_growth` varchar(3) default NULL,
  `f_hirsutism` varchar(3) default NULL,
  `joint_pain` varchar(3) default NULL,
  `swelling` varchar(3) default NULL,
  `m_redness` varchar(3) default NULL,
  `m_warm` varchar(3) default NULL,
  `m_stiffness` varchar(3) default NULL,
  `muscle` varchar(3) default NULL,
  `m_aches` varchar(3) default NULL,
  `fms` varchar(3) default NULL,
  `arthritis` varchar(3) default NULL,
  `loc` varchar(3) default NULL,
  `seizures` varchar(3) default NULL,
  `stroke` varchar(3) default NULL,
  `tia` varchar(3) default NULL,
  `n_numbness` varchar(3) default NULL,
  `n_weakness` varchar(3) default NULL,
  `paralysis` varchar(3) default NULL,
  `intellectual_decline` varchar(3) default NULL,
  `memory_problems` varchar(3) default NULL,
  `dementia` varchar(3) default NULL,
  `n_headache` varchar(3) default NULL,
  `s_cancer` varchar(3) default NULL,
  `psoriasis` varchar(3) default NULL,
  `s_acne` varchar(3) default NULL,
  `s_other` varchar(3) default NULL,
  `s_disease` varchar(3) default NULL,
  `p_diagnosis` varchar(3) default NULL,
  `p_medication` varchar(3) default NULL,
  `depression` varchar(3) default NULL,
  `anxiety` varchar(3) default NULL,
  `social_difficulties` varchar(3) default NULL,
  `thyroid_problems` varchar(3) default NULL,
  `diabetes` varchar(3) default NULL,
  `abnormal_blood` varchar(3) default NULL,
  `anemia` varchar(3) default NULL,
  `fh_blood_problems` varchar(3) default NULL,
  `bleeding_problems` varchar(3) default NULL,
  `allergies` varchar(3) default NULL,
  `frequent_illness` varchar(3) default NULL,
  `hiv` varchar(3) default NULL,
  `hai_status` varchar(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_soap`
-- 

DROP TABLE IF EXISTS `form_soap`;
CREATE TABLE `form_soap` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `pid` bigint(20) default '0',
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default '0',
  `activity` tinyint(4) default '0',
  `subjective` text,
  `objective` text,
  `assessment` text,
  `plan` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `form_vitals`
-- 

DROP TABLE IF EXISTS `form_vitals`;
CREATE TABLE `form_vitals` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `pid` bigint(20) default '0',
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default '0',
  `activity` tinyint(4) default '0',
  `bps` varchar(40) default NULL,
  `bpd` varchar(40) default NULL,
  `weight` float(5,2) default '0.00',
  `height` float(5,2) default '0.00',
  `temperature` float(5,2) default '0.00',
  `temp_method` varchar(255) default NULL,
  `pulse` float(5,2) default '0.00',
  `respiration` float(5,2) default '0.00',
  `note` varchar(255) default NULL,
  `BMI` float(4,1) default '0.0',
  `BMI_status` varchar(255) default NULL,
  `waist_circ` float(5,2) default '0.00',
  `head_circ` float(4,2) default '0.00',
  `oxygen_saturation` float(5,2) default '0.00',
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `forms`
-- 

DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `encounter` bigint(20) default NULL,
  `form_name` longtext,
  `form_id` bigint(20) default NULL,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `authorized` tinyint(4) default NULL,
  `deleted` tinyint(4) DEFAULT '0' NOT NULL COMMENT 'flag indicates form has been deleted',
  `formdir` longtext,
  PRIMARY KEY  (`id`),
  KEY `pid_encounter` (`pid`, `encounter`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `geo_country_reference`
-- 

DROP TABLE IF EXISTS `geo_country_reference`;
CREATE TABLE `geo_country_reference` (
  `countries_id` int(5) NOT NULL auto_increment,
  `countries_name` varchar(64) default NULL,
  `countries_iso_code_2` char(2) NOT NULL default '',
  `countries_iso_code_3` char(3) NOT NULL default '',
  PRIMARY KEY  (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=InnoDB AUTO_INCREMENT=240 ;

-- 
-- Dumping data for table `geo_country_reference`
-- 


INSERT INTO `geo_country_reference` VALUES (223, 'United States', 'US', 'USA');
INSERT INTO `geo_country_reference` VALUES (224, 'United States Minor Outlying Islands', 'UM', 'UMI');


-- 
-- Table structure for table `geo_zone_reference`
-- 

DROP TABLE IF EXISTS `geo_zone_reference`;
CREATE TABLE `geo_zone_reference` (
  `zone_id` int(5) NOT NULL auto_increment,
  `zone_country_id` int(5) NOT NULL default '0',
  `zone_code` varchar(5) default NULL,
  `zone_name` varchar(32) default NULL,
  PRIMARY KEY  (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 ;

-- 
-- Dumping data for table `geo_zone_reference`
-- 

INSERT INTO `geo_zone_reference` VALUES (1, 223, 'AL', 'Alabama');
INSERT INTO `geo_zone_reference` VALUES (2, 223, 'AK', 'Alaska');
INSERT INTO `geo_zone_reference` VALUES (3, 223, 'AS', 'American Samoa');
INSERT INTO `geo_zone_reference` VALUES (4, 223, 'AZ', 'Arizona');
INSERT INTO `geo_zone_reference` VALUES (5, 223, 'AR', 'Arkansas');
INSERT INTO `geo_zone_reference` VALUES (6, 223, 'AF', 'Armed Forces Africa');
INSERT INTO `geo_zone_reference` VALUES (7, 223, 'AA', 'Armed Forces Americas');
INSERT INTO `geo_zone_reference` VALUES (8, 223, 'AC', 'Armed Forces Canada');
INSERT INTO `geo_zone_reference` VALUES (9, 223, 'AE', 'Armed Forces Europe');
INSERT INTO `geo_zone_reference` VALUES (10, 223, 'AM', 'Armed Forces Middle East');
INSERT INTO `geo_zone_reference` VALUES (11, 223, 'AP', 'Armed Forces Pacific');
INSERT INTO `geo_zone_reference` VALUES (12, 223, 'CA', 'California');
INSERT INTO `geo_zone_reference` VALUES (13, 223, 'CO', 'Colorado');
INSERT INTO `geo_zone_reference` VALUES (14, 223, 'CT', 'Connecticut');
INSERT INTO `geo_zone_reference` VALUES (15, 223, 'DE', 'Delaware');
INSERT INTO `geo_zone_reference` VALUES (16, 223, 'DC', 'District of Columbia');
INSERT INTO `geo_zone_reference` VALUES (17, 223, 'FM', 'Federated States Of Micronesia');
INSERT INTO `geo_zone_reference` VALUES (18, 223, 'FL', 'Florida');
INSERT INTO `geo_zone_reference` VALUES (19, 223, 'GA', 'Georgia');
INSERT INTO `geo_zone_reference` VALUES (20, 223, 'GU', 'Guam');
INSERT INTO `geo_zone_reference` VALUES (21, 223, 'HI', 'Hawaii');
INSERT INTO `geo_zone_reference` VALUES (22, 223, 'ID', 'Idaho');
INSERT INTO `geo_zone_reference` VALUES (23, 223, 'IL', 'Illinois');
INSERT INTO `geo_zone_reference` VALUES (24, 223, 'IN', 'Indiana');
INSERT INTO `geo_zone_reference` VALUES (25, 223, 'IA', 'Iowa');
INSERT INTO `geo_zone_reference` VALUES (26, 223, 'KS', 'Kansas');
INSERT INTO `geo_zone_reference` VALUES (27, 223, 'KY', 'Kentucky');
INSERT INTO `geo_zone_reference` VALUES (28, 223, 'LA', 'Louisiana');
INSERT INTO `geo_zone_reference` VALUES (29, 223, 'ME', 'Maine');
INSERT INTO `geo_zone_reference` VALUES (30, 223, 'MH', 'Marshall Islands');
INSERT INTO `geo_zone_reference` VALUES (31, 223, 'MD', 'Maryland');
INSERT INTO `geo_zone_reference` VALUES (32, 223, 'MA', 'Massachusetts');
INSERT INTO `geo_zone_reference` VALUES (33, 223, 'MI', 'Michigan');
INSERT INTO `geo_zone_reference` VALUES (34, 223, 'MN', 'Minnesota');
INSERT INTO `geo_zone_reference` VALUES (35, 223, 'MS', 'Mississippi');
INSERT INTO `geo_zone_reference` VALUES (36, 223, 'MO', 'Missouri');
INSERT INTO `geo_zone_reference` VALUES (37, 223, 'MT', 'Montana');
INSERT INTO `geo_zone_reference` VALUES (38, 223, 'NE', 'Nebraska');
INSERT INTO `geo_zone_reference` VALUES (39, 223, 'NV', 'Nevada');
INSERT INTO `geo_zone_reference` VALUES (40, 223, 'NH', 'New Hampshire');
INSERT INTO `geo_zone_reference` VALUES (41, 223, 'NJ', 'New Jersey');
INSERT INTO `geo_zone_reference` VALUES (42, 223, 'NM', 'New Mexico');
INSERT INTO `geo_zone_reference` VALUES (43, 223, 'NY', 'New York');
INSERT INTO `geo_zone_reference` VALUES (44, 223, 'NC', 'North Carolina');
INSERT INTO `geo_zone_reference` VALUES (45, 223, 'ND', 'North Dakota');
INSERT INTO `geo_zone_reference` VALUES (46, 223, 'MP', 'Northern Mariana Islands');
INSERT INTO `geo_zone_reference` VALUES (47, 223, 'OH', 'Ohio');
INSERT INTO `geo_zone_reference` VALUES (48, 223, 'OK', 'Oklahoma');
INSERT INTO `geo_zone_reference` VALUES (49, 223, 'OR', 'Oregon');
INSERT INTO `geo_zone_reference` VALUES (50, 223, 'PW', 'Palau');
INSERT INTO `geo_zone_reference` VALUES (51, 223, 'PA', 'Pennsylvania');
INSERT INTO `geo_zone_reference` VALUES (52, 223, 'PR', 'Puerto Rico');
INSERT INTO `geo_zone_reference` VALUES (53, 223, 'RI', 'Rhode Island');
INSERT INTO `geo_zone_reference` VALUES (54, 223, 'SC', 'South Carolina');
INSERT INTO `geo_zone_reference` VALUES (55, 223, 'SD', 'South Dakota');
INSERT INTO `geo_zone_reference` VALUES (56, 223, 'TN', 'Tenessee');
INSERT INTO `geo_zone_reference` VALUES (57, 223, 'TX', 'Texas');
INSERT INTO `geo_zone_reference` VALUES (58, 223, 'UT', 'Utah');
INSERT INTO `geo_zone_reference` VALUES (59, 223, 'VT', 'Vermont');
INSERT INTO `geo_zone_reference` VALUES (60, 223, 'VI', 'Virgin Islands');
INSERT INTO `geo_zone_reference` VALUES (61, 223, 'VA', 'Virginia');
INSERT INTO `geo_zone_reference` VALUES (62, 223, 'WA', 'Washington');
INSERT INTO `geo_zone_reference` VALUES (63, 223, 'WV', 'West Virginia');
INSERT INTO `geo_zone_reference` VALUES (64, 223, 'WI', 'Wisconsin');
INSERT INTO `geo_zone_reference` VALUES (65, 223, 'WY', 'Wyoming');
INSERT INTO `geo_zone_reference` VALUES (66, 38, 'AB', 'Alberta');
INSERT INTO `geo_zone_reference` VALUES (67, 38, 'BC', 'British Columbia');
INSERT INTO `geo_zone_reference` VALUES (68, 38, 'MB', 'Manitoba');
INSERT INTO `geo_zone_reference` VALUES (69, 38, 'NF', 'Newfoundland');
INSERT INTO `geo_zone_reference` VALUES (70, 38, 'NB', 'New Brunswick');
INSERT INTO `geo_zone_reference` VALUES (71, 38, 'NS', 'Nova Scotia');
INSERT INTO `geo_zone_reference` VALUES (72, 38, 'NT', 'Northwest Territories');
INSERT INTO `geo_zone_reference` VALUES (73, 38, 'NU', 'Nunavut');
INSERT INTO `geo_zone_reference` VALUES (74, 38, 'ON', 'Ontario');
INSERT INTO `geo_zone_reference` VALUES (75, 38, 'PE', 'Prince Edward Island');
INSERT INTO `geo_zone_reference` VALUES (76, 38, 'QC', 'Quebec');
INSERT INTO `geo_zone_reference` VALUES (77, 38, 'SK', 'Saskatchewan');
INSERT INTO `geo_zone_reference` VALUES (78, 38, 'YT', 'Yukon Territory');
INSERT INTO `geo_zone_reference` VALUES (79, 61, 'QLD', 'Queensland');
INSERT INTO `geo_zone_reference` VALUES (80, 61, 'SA', 'South Australia');
INSERT INTO `geo_zone_reference` VALUES (81, 61, 'ACT', 'Australian Capital Territory');
INSERT INTO `geo_zone_reference` VALUES (82, 61, 'VIC', 'Victoria');


-- 
-- Table structure for table `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` longtext,
  `user` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `history_data`
-- 

DROP TABLE IF EXISTS `history_data`;
CREATE TABLE `history_data` (
  `id` bigint(20) NOT NULL auto_increment,
  `coffee` longtext,
  `tobacco` longtext,
  `alcohol` longtext,
  `sleep_patterns` longtext,
  `exercise_patterns` longtext,
  `seatbelt_use` longtext,
  `counseling` longtext,
  `hazardous_activities` longtext,
  `recreational_drugs` longtext,
  `last_breast_exam` varchar(255) default NULL,
  `last_mammogram` varchar(255) default NULL,
  `last_gynocological_exam` varchar(255) default NULL,
  `last_rectal_exam` varchar(255) default NULL,
  `last_prostate_exam` varchar(255) default NULL,
  `last_physical_exam` varchar(255) default NULL,
  `last_sigmoidoscopy_colonoscopy` varchar(255) default NULL,
  `last_ecg` varchar(255) default NULL,
  `last_cardiac_echo` varchar(255) default NULL,
  `last_retinal` varchar(255) default NULL,
  `last_fluvax` varchar(255) default NULL,
  `last_pneuvax` varchar(255) default NULL,
  `last_ldl` varchar(255) default NULL,
  `last_hemoglobin` varchar(255) default NULL,
  `last_psa` varchar(255) default NULL,
  `last_exam_results` varchar(255) default NULL,
  `history_mother` longtext,
  `dc_mother` text,
  `history_father` longtext,
  `dc_father`  text,
  `history_siblings` longtext,
  `dc_siblings` text,
  `history_offspring` longtext,
  `dc_offspring` text,
  `history_spouse` longtext,
  `dc_spouse` text,
  `relatives_cancer` longtext,
  `relatives_tuberculosis` longtext,
  `relatives_diabetes` longtext,
  `relatives_high_blood_pressure` longtext,
  `relatives_heart_problems` longtext,
  `relatives_stroke` longtext,
  `relatives_epilepsy` longtext,
  `relatives_mental_illness` longtext,
  `relatives_suicide` longtext,
  `cataract_surgery` datetime default NULL,
  `tonsillectomy` datetime default NULL,
  `cholecystestomy` datetime default NULL,
  `heart_surgery` datetime default NULL,
  `hysterectomy` datetime default NULL,
  `hernia_repair` datetime default NULL,
  `hip_replacement` datetime default NULL,
  `knee_replacement` datetime default NULL,
  `appendectomy` datetime default NULL,
  `date` datetime default NULL,
  `pid` bigint(20) NOT NULL default '0',
  `name_1` varchar(255) default NULL,
  `value_1` varchar(255) default NULL,
  `name_2` varchar(255) default NULL,
  `value_2` varchar(255) default NULL,
  `additional_history` text,
  `exams` text,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `icd9_dx_code`
--

DROP TABLE IF EXISTS `icd9_dx_code`;

-- --------------------------------------------------------

--
-- Table structure for table `icd9_sg_code`
--

DROP TABLE IF EXISTS `icd9_sg_code`;

-- --------------------------------------------------------

--
-- Table structure for table `icd9_dx_long_code`
--

DROP TABLE IF EXISTS `icd9_dx_long_code`;


-- --------------------------------------------------------

--
-- Table structure for table `icd9_sg_long_code`
--

DROP TABLE IF EXISTS `icd9_sg_long_code`;


-- --------------------------------------------------------

--
-- Table structure for table `icd10_dx_order_code`
--

DROP TABLE IF EXISTS `icd10_dx_order_code`;
CREATE TABLE `icd10_dx_order_code` (
  `dx_id`               SERIAL,
  `dx_code`             varchar(7),
  `formatted_dx_code`   varchar(10),
  `valid_for_coding`    char,
  `short_desc`          varchar(60),
  `long_desc`           varchar(300),
  `active` tinyint default 0,
  `revision` int default 0,
  KEY `formatted_dx_code` (`formatted_dx_code`),
  KEY `active` (`active`)
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_pcs_order_code`
--

DROP TABLE IF EXISTS `icd10_pcs_order_code`;
CREATE TABLE `icd10_pcs_order_code` (
  `pcs_id`              SERIAL,
  `pcs_code`            varchar(7),
  `valid_for_coding`    char,
  `short_desc`          varchar(60),
  `long_desc`           varchar(300),
  `active` tinyint default 0,
  `revision` int default 0,
  KEY `pcs_code` (`pcs_code`),
  KEY `active` (`active`)
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_gem_pcs_9_10`
--

DROP TABLE IF EXISTS `icd10_gem_pcs_9_10`;
CREATE TABLE `icd10_gem_pcs_9_10` (
  `map_id` SERIAL,
  `pcs_icd9_source` varchar(5) default NULL,
  `pcs_icd10_target` varchar(7) default NULL,
  `flags` varchar(5) default NULL,
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_gem_pcs_10_9`
--

DROP TABLE IF EXISTS `icd10_gem_pcs_10_9`;
CREATE TABLE `icd10_gem_pcs_10_9` (
  `map_id` SERIAL,
  `pcs_icd10_source` varchar(7) default NULL,
  `pcs_icd9_target` varchar(5) default NULL,
  `flags` varchar(5) default NULL,
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_gem_dx_9_10`
--

DROP TABLE IF EXISTS `icd10_gem_dx_9_10`;
CREATE TABLE `icd10_gem_dx_9_10` (
  `map_id` SERIAL,
  `dx_icd9_source` varchar(5) default NULL,
  `dx_icd10_target` varchar(7) default NULL,
  `flags` varchar(5) default NULL,
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_gem_dx_10_9`
--

DROP TABLE IF EXISTS `icd10_gem_dx_10_9`;
CREATE TABLE `icd10_gem_dx_10_9` (
  `map_id` SERIAL,
  `dx_icd10_source` varchar(7) default NULL,
  `dx_icd9_target` varchar(5) default NULL,
  `flags` varchar(5) default NULL,
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_reimbr_dx_9_10`
--

DROP TABLE IF EXISTS `icd10_reimbr_dx_9_10`;
CREATE TABLE `icd10_reimbr_dx_9_10` (
  `map_id` SERIAL,
  `code`        varchar(8),
  `code_cnt`    tinyint,
  `ICD9_01`     varchar(5),
  `ICD9_02`     varchar(5),
  `ICD9_03`     varchar(5),
  `ICD9_04`     varchar(5),
  `ICD9_05`     varchar(5),
  `ICD9_06`     varchar(5),
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


--
-- Table structure for table `icd10_reimbr_pcs_9_10`
--

DROP TABLE IF EXISTS `icd10_reimbr_pcs_9_10`;
CREATE TABLE `icd10_reimbr_pcs_9_10` (
  `map_id`      SERIAL,
  `code`        varchar(8),
  `code_cnt`    tinyint,
  `ICD9_01`     varchar(5),
  `ICD9_02`     varchar(5),
  `ICD9_03`     varchar(5),
  `ICD9_04`     varchar(5),
  `ICD9_05`     varchar(5),
  `ICD9_06`     varchar(5),
  `active` tinyint default 0,
  `revision` int default 0
) ENGINE=InnoDB;


-- 
-- Table structure for table `immunizations`
-- 

DROP TABLE IF EXISTS `immunizations`;
CREATE TABLE `immunizations` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `administered_date` datetime default NULL,
  `immunization_id` int(11) default NULL,
  `cvx_code` varchar(10) default NULL,
  `manufacturer` varchar(100) default NULL,
  `lot_number` varchar(50) default NULL,
  `administered_by_id` bigint(20) default NULL,
  `administered_by` VARCHAR( 255 ) default NULL COMMENT 'Alternative to administered_by_id',
  `education_date` date default NULL,
  `vis_date` date default NULL COMMENT 'Date of VIS Statement', 
  `note` text,
  `create_date` datetime default NULL,
  `update_date` timestamp NOT NULL,
  `created_by` bigint(20) default NULL,
  `updated_by` bigint(20) default NULL,
  `amount_administered` float DEFAULT NULL,			
  `amount_administered_unit` varchar(50) DEFAULT NULL,			
  `expiration_date` date DEFAULT NULL,			
  `route` varchar(100) DEFAULT NULL,			
  `administration_site` varchar(100) DEFAULT NULL,			
  `added_erroneously` tinyint(1) NOT NULL DEFAULT '0',  
  `external_id` VARCHAR(20) DEFAULT NULL,
  `completion_status` VARCHAR(50) DEFAULT NULL,
  `information_source` VARCHAR(31) DEFAULT NULL,
  `refusal_reason` VARCHAR(31) DEFAULT NULL,
  `ordering_provider` INT(11) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `insurance_companies`
-- 

DROP TABLE IF EXISTS `insurance_companies`;
CREATE TABLE `insurance_companies` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `attn` varchar(255) default NULL,
  `cms_id` varchar(15) default NULL,
  `ins_type_code` tinyint(2) default NULL,
  `x12_receiver_id` varchar(25) default NULL,
  `x12_default_partner_id` int(11) default NULL,
  `alt_cms_id` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `insurance_data`
-- 

DROP TABLE IF EXISTS `insurance_data`;
CREATE TABLE `insurance_data` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` enum('primary','secondary','tertiary') default NULL,
  `provider` varchar(255) default NULL,
  `plan_name` varchar(255) default NULL,
  `policy_number` varchar(255) default NULL,
  `group_number` varchar(255) default NULL,
  `subscriber_lname` varchar(255) default NULL,
  `subscriber_mname` varchar(255) default NULL,
  `subscriber_fname` varchar(255) default NULL,
  `subscriber_relationship` varchar(255) default NULL,
  `subscriber_ss` varchar(255) default NULL,
  `subscriber_DOB` date default NULL,
  `subscriber_street` varchar(255) default NULL,
  `subscriber_postal_code` varchar(255) default NULL,
  `subscriber_city` varchar(255) default NULL,
  `subscriber_state` varchar(255) default NULL,
  `subscriber_country` varchar(255) default NULL,
  `subscriber_phone` varchar(255) default NULL,
  `subscriber_employer` varchar(255) default NULL,
  `subscriber_employer_street` varchar(255) default NULL,
  `subscriber_employer_postal_code` varchar(255) default NULL,
  `subscriber_employer_state` varchar(255) default NULL,
  `subscriber_employer_country` varchar(255) default NULL,
  `subscriber_employer_city` varchar(255) default NULL,
  `copay` varchar(255) default NULL,
  `date` date NOT NULL default '0000-00-00',
  `eDate` date NOT NULL default '0000-00-00',
  `pid` bigint(20) NOT NULL default '0',
  `subscriber_sex` varchar(25) default NULL,
  `accept_assignment` varchar(5) NOT NULL DEFAULT 'TRUE',
  `policy_type` varchar(25) NOT NULL default '',
  `inactive` tinyint(1) DEFAULT 0,
  `inactive_time` datetime DEFAULT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pid_type_date_inactivetime` (pid,type,date,inactive_time)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `insurance_numbers`
-- 

DROP TABLE IF EXISTS `insurance_numbers`;
CREATE TABLE `insurance_numbers` (
  `id` int(11) NOT NULL default '0',
  `provider_id` int(11) NOT NULL default '0',
  `insurance_company_id` int(11) default NULL,
  `provider_number` varchar(20) default NULL,
  `rendering_provider_number` varchar(20) default NULL,
  `group_number` varchar(20) default NULL,
  `provider_number_type` varchar(4) default NULL,
  `rendering_provider_number_type` varchar(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `issue_encounter`
-- 

DROP TABLE IF EXISTS `issue_encounter`;
CREATE TABLE `issue_encounter` (
  `pid` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `encounter` int(11) NOT NULL,
  `resolved` tinyint(1) NOT NULL,
  PRIMARY KEY  (`pid`,`list_id`,`encounter`)
) ENGINE=InnoDB;


--
-- Table structure for table `issue_types`
--

DROP TABLE IF EXISTS `issue_types`;
CREATE TABLE `issue_types` (
    `active` tinyint(1) NOT NULL DEFAULT '1',
    `category` varchar(75) NOT NULL DEFAULT '',
    `type` varchar(75) NOT NULL DEFAULT '',
    `plural` varchar(75) NOT NULL DEFAULT '',
    `singular` varchar(75) NOT NULL DEFAULT '',
    `abbreviation` varchar(75) NOT NULL DEFAULT '',
    `style` smallint(6) NOT NULL DEFAULT '0',
    `force_show` smallint(6) NOT NULL DEFAULT '0',
    `ordering` int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`category`,`type`)
) ENGINE=InnoDB;

--
-- Dumping data for table `issue_types`
--

INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('10','default','medical_problem','Medical Problems','Problem','P','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('30','default','medication','Medications','Medication','M','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('20','default','allergy','Allergies','Allergy','A','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('40','default','surgery','Surgeries','Surgery','S','0','0');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('50','default','dental','Dental Issues','Dental','D','0','0');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('10','ippf_specific','medical_problem','Medical Problems','Problem','P','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('30','ippf_specific','medication','Medications','Medication','M','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('20','ippf_specific','allergy','Allergies','Allergy','Y','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('40','ippf_specific','surgery','Surgeries','Surgery','S','0','0');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('50','ippf_specific','ippf_gcac','Abortions','Abortion','A','3','0');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('60','ippf_specific','contraceptive','Contraception','Contraception','C','4','0');


-- 
-- Table structure for table `lang_constants`
-- 

DROP TABLE IF EXISTS `lang_constants`;
CREATE TABLE `lang_constants` (
  `cons_id` int(11) NOT NULL auto_increment,
  `constant_name` mediumtext BINARY,
  UNIQUE KEY `cons_id` (`cons_id`),
  KEY `constant_name` (`constant_name`(100))
) ENGINE=InnoDB ;

-- 
-- Table structure for table `lang_definitions`
-- 

DROP TABLE IF EXISTS `lang_definitions`;
CREATE TABLE `lang_definitions` (
  `def_id` int(11) NOT NULL auto_increment,
  `cons_id` int(11) NOT NULL default '0',
  `lang_id` int(11) NOT NULL default '0',
  `definition` mediumtext,
  UNIQUE KEY `def_id` (`def_id`),
  KEY `cons_id` (`cons_id`)
) ENGINE=InnoDB ;

-- 
-- Table structure for table `lang_languages`
-- 

DROP TABLE IF EXISTS `lang_languages`;
CREATE TABLE `lang_languages` (
  `lang_id` int(11) NOT NULL auto_increment,
  `lang_code` char(2) NOT NULL default '',
  `lang_description` varchar(100) default NULL,
  `lang_is_rtl` TINYINT DEFAULT 0 COMMENT 'Set this to 1 for RTL languages Arabic, Farsi, Hebrew, Urdu etc.',
  UNIQUE KEY `lang_id` (`lang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `lang_languages`
-- 

INSERT INTO `lang_languages` VALUES (1, 'en', 'English', 0);


--
-- Table structure for table `lang_custom`
--

DROP TABLE IF EXISTS `lang_custom`;
CREATE TABLE `lang_custom` (
  `lang_description` varchar(100) NOT NULL default '',
  `lang_code` char(2) NOT NULL default '',
  `constant_name` mediumtext,
  `definition` mediumtext
) ENGINE=InnoDB ;


-- 
-- Table structure for table `layout_options`
-- 

DROP TABLE IF EXISTS `layout_options`;
CREATE TABLE `layout_options` (
  `form_id` varchar(31) NOT NULL default '',
  `field_id` varchar(31) NOT NULL default '',
  `group_name` varchar(31) NOT NULL default '',
  `title` varchar(63) NOT NULL default '',
  `seq` int(11) NOT NULL default '0',
  `data_type` tinyint(3) NOT NULL default '0',
  `uor` tinyint(1) NOT NULL default '1',
  `fld_length` int(11) NOT NULL default '15',
  `max_length` int(11) NOT NULL default '0',
  `list_id` varchar(31) NOT NULL default '',
  `titlecols` tinyint(3) NOT NULL default '1',
  `datacols` tinyint(3) NOT NULL default '1',
  `default_value` varchar(255) NOT NULL default '',
  `edit_options` varchar(36) NOT NULL default '',
  `description` text,
  `fld_rows` int(11) NOT NULL default '0',
  `list_backup_id` varchar(31) NOT NULL default '',
  `source` char(1) NOT NULL default 'F' COMMENT 'F=Form, D=Demographics, H=History, E=Encounter',
  `conditions` text COMMENT 'serialized array of skip conditions',
  PRIMARY KEY  (`form_id`,`field_id`,`seq`)
) ENGINE=InnoDB;

-- 
-- Loading table `layout_options`.  Demographics section first.
-- 

INSERT INTO `layout_options` (`form_id`, `field_id`, `group_name`, `title`, `seq`, `data_type`, `uor`, `fld_length`, `max_length`, `list_id`, `titlecols`, `datacols`, `default_value`, `edit_options`, `description`, `fld_rows`, `list_backup_id`, `source`, `conditions`) VALUES
('DEM', 'fname', '1Face Sheet', 'NAME',5,2,2,10,63, '',1,1, '', 'CD', 'First Name',0, '', 'F', ''),
('DEM', 'mname', '1Face Sheet', '',10,2,1,2,63, '',0,0, '', 'C', 'Middle Name',0, '', 'F', ''),
('DEM', 'lname', '1Face Sheet', '',15,2,2,10,63, '',0,0, '', 'CD', 'Last Name',0, '', 'F', ''),
('DEM', 'sex', '1Face Sheet', 'Sex',20,1,2,0,0, 'sex',1,1, '', 'N', 'Sex',0, '', 'F', ''),
('DEM', 'DOB', '1Face Sheet', 'DOB',25,4,2,0,10, '',1,1, '', 'D', 'Date of Birth',0, '', 'F', ''),
('DEM', 'status', '1Face Sheet', 'Marital Status',30,1,1,0,0, 'marital',1,3, '', '', 'Marital Status',0, '', 'F', ''),
('DEM', 'street', '1Face Sheet', 'Address',35,2,1,25,63, '',1,1, '', 'C', 'Street and Number',0, '', 'F', ''),
('DEM', 'city', '1Face Sheet', 'City',40,2,1,15,63, '',1,1, '', 'C', 'City Name',0, '', 'F', ''),
('DEM', 'state', '1Face Sheet', 'State',45,26,1,0,0, 'state',1,1, '', '', 'State/Locality',0, '', 'F', ''),
('DEM', 'postal_code', '1Face Sheet', 'Postal Code',50,2,1,6,63, '',1,1, '', '', 'Postal Code',0, '', 'F', ''),
('DEM', 'ss', '1Face Sheet', 'S.S.N.',55,2,1,11,11, '',1,1, '', '', 'Social Security Number (No dashes for best searching!)',0, '', 'F', ''),
('DEM', 'drivers_license', '1Face Sheet', 'License/ID',60,2,1,15,63, '',1,1, '', '', 'Drivers License or State ID',0, '', 'F', ''),
('DEM', 'phone_cell', '1Face Sheet', 'Mobile Phone',65,2,1,20,63, '',1,1, '', 'P', 'Cell Phone Number',0, '', 'F', ''),
('DEM', 'email', '1Face Sheet', 'Contact Email',70,2,1,30,95, '',1,1, '', '', 'Contact Email Address',0, '', 'F', ''),
('DEM', 'pricelevel', '1Face Sheet', 'Price Level',75,1,0,0,0, 'pricelevel',1,1, '', '', 'Discount Level',0, '', 'F', ''),
('DEM', 'billing_note', '1Face Sheet', 'Billing Note',80,2,1,60,0, '',1,3, '', '', 'Patient Level Billing Note (Collections)',0, '', 'F', ''),
('DEM', 'providerID', '2Contacts', 'Provider',5,11,1,0,0, '',1,3, '', '', 'Provider',0, '', 'F', ''),
('DEM', 'ref_providerID', '2Contacts', 'Referring Provider',10,11,1,0,0, '',1,3, '', '', 'Referring Provider',0, '', 'F', ''),
('DEM', 'pharmacy_id', '2Contacts', 'Pharmacy',15,12,1,0,0, '',1,3, '', '', 'Preferred Pharmacy',0, '', 'F', ''),
('DEM', 'phone_home', '2Contacts', 'Home Phone',20,2,1,20,63, '',1,1, '', 'P', 'Home Phone Number',0, '', 'F', ''),
('DEM', 'phone_biz', '2Contacts', 'Work Phone',25,2,1,20,63, '',1,1, '', 'P', 'Work Phone Number',0, '', 'F', ''),
('DEM', 'contact_relationship', '2Contacts', 'Emergency Contact',30,2,1,10,63, '',1,1, '', 'C', 'Emergency Contact Person',0, '', 'F', ''),
('DEM', 'phone_contact', '2Contacts', 'Emergency Phone',35,2,1,20,63, '',1,1, '', 'P', 'Emergency Contact Phone Number',0, '', 'F', ''),
('DEM', 'mothersname', '2Contacts', 'Name of Mother',40,2,1,20,63, '',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'guardiansname', '2Contacts', 'Name of Guardian',45,2,1,20,63, '',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'county', '2Contacts', 'County',50,26,1,0,0, 'county',1,1, '', '', 'County',0, '', 'F', ''),
('DEM', 'country_code', '2Contacts', 'Country',55,26,1,0,0, 'country',1,1, '', '', 'Country',0, '', 'F', ''),
('DEM', 'referral_source', '2Contacts', 'Referral Source',60,26,1,0,0, 'refsource',1,1, '', '', 'How did they hear about us',0, '', 'F', NULL),
('DEM', 'allow_patient_portal', '2Privacy', 'Allow Patient Portal',1,1,1,0,0, 'yesno',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'email_direct', '2Privacy', 'Trusted Email',3,2,1,30,95, '',1,1, '', '', 'Trusted Direct Email Address',0, '', 'F', ''),
('DEM', 'hipaa_notice', '2Privacy', 'Privacy Notice Received',5,1,1,0,0, 'yesno',1,1, '', '', 'Did you receive a copy of the HIPAA Notice?',0, '', 'F', ''),
('DEM', 'hipaa_voice', '2Privacy', 'Allow Voice Message',10,1,1,0,0, 'yesno',1,1, '', '', 'Allow telephone messages?',0, '', 'F', ''),
('DEM', 'hipaa_message', '2Privacy', 'Leave Message With',15,2,1,20,63, '',1,1, '', '', 'With whom may we leave a message?',0, '', 'F', ''),
('DEM', 'hipaa_mail', '2Privacy', 'Allow Mail Message',20,1,1,0,0, 'yesno',1,1, '', '', 'Allow email messages?',0, '', 'F', ''),
('DEM', 'hipaa_allowsms', '2Privacy', 'Allow SMS',25,1,1,0,0, 'yesno',1,1, '', '', 'Allow SMS (text messages)?',0, '', 'F', ''),
('DEM', 'hipaa_allowemail', '2Privacy', 'Allow Email',30,1,1,0,0, 'yesno',1,1, '', '', 'Allow Email?',0, '', 'F', ''),
('DEM', 'allow_imm_reg_use', '2Privacy', 'Allow Immunization Registry Use',35,1,1,0,0, 'yesno',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'allow_imm_info_share', '2Privacy', 'Allow Immunization Info Sharing',40,1,1,0,0, 'yesno',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'allow_health_info_ex', '2Privacy', 'Allow Health Information Exchange',45,1,1,0,0, 'yesno',1,1, '', '', '',0, '', 'F', ''),
('DEM', 'contrastart', '2Privacy', 'Contraceptives Start',50,4,0,0,10, '',1,1, '', '', 'Date contraceptive services initially provided',0, '', 'F', ''),
('DEM', 'vfc', '2Privacy', 'VFC',55,1,1,20,0, 'eligibility',1,1, '', '', 'Eligibility status for Vaccine for Children supplied vaccine',0, '', 'F', NULL),
('DEM', 'deceased_date', '2Privacy', 'Date Deceased',60,4,1,0,20, '',1,1, '', 'D', 'If person is deceased then enter date of death.',0, '', 'F', ''),
('DEM', 'deceased_reason', '2Privacy', 'Reason Deceased',65,2,1,30,255, '',1,1, '', '', 'Reason for Death',0, '', 'F', ''),
('DEM', 'industry', '4Employer', 'Industry',5,26,1,0,0, 'Industry',1,1, '', '', 'Industry',0, '', 'F', ''),
('DEM', 'occupation', '4Employer', 'Occupation',10,26,1,0,0, 'Occupation',1,1, '', '', 'Occupation',0, '', 'F', ''),
('DEM', 'em_name', '4Employer', 'Employer Name',15,2,1,20,63, '',1,1, '', 'C', 'Employer Name',0, '', 'F', ''),
('DEM', 'em_street', '4Employer', 'Employer Address',20,2,1,25,63, '',1,1, '', 'C', 'Street and Number',0, '', 'F', ''),
('DEM', 'em_city', '4Employer', 'City',25,2,1,15,63, '',1,1, '', 'C', 'City Name',0, '', 'F', ''),
('DEM', 'em_state', '4Employer', 'State',30,26,1,0,0, 'state',1,1, '', '', 'State/Locality',0, '', 'F', ''),
('DEM', 'em_postal_code', '4Employer', 'Postal Code',35,2,1,6,63, '',1,1, '', '', 'Postal Code',0, '', 'F', ''),
('DEM', 'em_country', '4Employer', 'Country',40,26,1,0,0, 'country',1,1, '', '', 'Country',0, '', 'F', ''),
('DEM', 'language', '5Social Statistics', 'Language',5,1,1,0,0, 'language',1,3, '', '', 'Preferred Language',0, '', 'F', ''),
('DEM', 'interpretter', '5Social Statistics', 'Interpreter',7,2,1,20,63, '',1,1, '', '', 'Interpreter needed?',0, '', 'F', ''),
('DEM', 'ethnicity', '5Social Statistics', 'Ethnicity',10,33,1,0,0, 'ethnicity',1,1, '', '', 'Ethnicity',0, 'ethrace', 'F', ''),
('DEM', 'family_size', '5Social Statistics', 'Family Size',15,2,1,20,63, '',1,1, '', '', 'Family Size',0, '', 'F', ''),
('DEM', 'financial_review', '5Social Statistics', 'Financial Review Date',20,2,1,10,20, '',1,1, '', 'D', 'Financial Review Date',0, '', 'F', ''),
('DEM', 'monthly_income', '5Social Statistics', 'Monthly Income',25,2,1,20,63, '',1,1, '', '', 'Monthly Income',0, '', 'F', ''),
('DEM', 'homeless', '5Social Statistics', 'Homeless',30,2,1,20,63, '',1,1, '', '', 'Homeless or similar?',0, '', 'F', ''),
('DEM', 'migrantseasonal', '5Social Statistics', 'Migrant/Seasonal',35,2,1,20,63, '',1,1, '', '', 'Migrant or seasonal worker?',0, '', 'F', ''),
('DEM', 'religion', '5Social Statistics', 'Religion',45,1,1,0,0, 'religious_affiliation',1,3, '', '', 'Patient Religion',0, '', 'F', NULL);


INSERT INTO `layout_options` (`form_id`,`field_id`,`group_name`,`title`,`seq`,`data_type`,`uor`,`fld_length`,`max_length`,`list_id`,`titlecols`,`datacols`,`default_value`,`edit_options`,`description`,`fld_rows`) VALUES
('LBTref','refer_date'      ,'1Referral','Referral Date'                  , 1, 4,2, 0,  0,''         ,1,1,'C','D','Date of referral', 0),
('LBTref','refer_from'      ,'1Referral','Refer By'                       , 2,10,2, 0,  0,''         ,1,1,'' ,'' ,'Referral By', 0),
('LBTref','refer_external'  ,'1Referral','External Referral'              , 3, 1,1, 0,  0,'boolean'  ,1,1,'' ,'' ,'External referral?', 0),
('LBTref','refer_to'        ,'1Referral','Refer To'                       , 4,14,2, 0,  0,''         ,1,1,'' ,'' ,'Referral To', 0),
('LBTref','body'            ,'1Referral','Reason'                         , 5, 3,2,30,  0,''         ,1,1,'' ,'' ,'Reason for referral', 3),
('LBTref','refer_diag'      ,'1Referral','Referrer Diagnosis'             , 6, 2,1,30,255,''         ,1,1,'' ,'X','Referrer diagnosis', 0),
('LBTref','refer_risk_level','1Referral','Risk Level'                     , 7, 1,1, 0,  0,'risklevel',1,1,'' ,'' ,'Level of urgency', 0),
('LBTref','refer_vitals'    ,'1Referral','Include Vitals'                 , 8, 1,1, 0,  0,'boolean'  ,1,1,'' ,'' ,'Include vitals data?', 0),
('LBTref','refer_related_code','1Referral','Requested Service'            , 9,15,1,30,255,''         ,1,1,'' ,'' ,'Billing Code for Requested Service', 0),
('LBTref','reply_date'      ,'2Counter-Referral','Reply Date'             ,10, 4,1, 0,  0,''         ,1,1,'' ,'D','Date of reply', 0),
('LBTref','reply_from'      ,'2Counter-Referral','Reply From'             ,11, 2,1,30,255,''         ,1,1,'' ,'' ,'Who replied?', 0),
('LBTref','reply_init_diag' ,'2Counter-Referral','Presumed Diagnosis'     ,12, 2,1,30,255,''         ,1,1,'' ,'' ,'Presumed diagnosis by specialist', 0),
('LBTref','reply_final_diag','2Counter-Referral','Final Diagnosis'        ,13, 2,1,30,255,''         ,1,1,'' ,'' ,'Final diagnosis by specialist', 0),
('LBTref','reply_documents' ,'2Counter-Referral','Documents'              ,14, 2,1,30,255,''         ,1,1,'' ,'' ,'Where may related scanned or paper documents be found?', 0),
('LBTref','reply_findings'  ,'2Counter-Referral','Findings'               ,15, 3,1,30,  0,''         ,1,1,'' ,'' ,'Findings by specialist', 3),
('LBTref','reply_services'  ,'2Counter-Referral','Services Provided'      ,16, 3,1,30,  0,''         ,1,1,'' ,'' ,'Service provided by specialist', 3),
('LBTref','reply_recommend' ,'2Counter-Referral','Recommendations'        ,17, 3,1,30,  0,''         ,1,1,'' ,'' ,'Recommendations by specialist', 3),
('LBTref','reply_rx_refer'  ,'2Counter-Referral','Prescriptions/Referrals',18, 3,1,30,  0,''         ,1,1,'' ,'' ,'Prescriptions and/or referrals by specialist', 3),
('LBTptreq','body','1','Details',10,3,2,30,0,'',1,3,'','','Content',5),
('LBTphreq','body','1','Details',10,3,2,30,0,'',1,3,'','','Content',5),
('LBTlegal','body','1','Details',10,3,2,30,0,'',1,3,'','','Content',5),
('LBTbill' ,'body','1','Details',10,3,2,30,0,'',1,3,'','','Content',5),
('HIS','usertext11'       ,'1General'       ,'Risk Factors',1,21,1,0,0,'riskfactors',1,1,'','' ,'Risk Factors', 0),
('HIS','exams'            ,'1General'       ,'Exams/Tests' ,2,23,1,0,0,'exams'      ,1,1,'','' ,'Exam and test results', 0),
('HIS','history_father'   ,'2Family History','Father'                 , 1, 2,1,20,  0,'',1,1,'','' ,'', 0),
('HIS','dc_father'        ,'2Family History','Diagnosis Code'         , 2,15,1, 0,255,'',1,1,'','', '', 0),
('HIS','history_mother'   ,'2Family History','Mother'                 , 3, 2,1,20,  0,'',1,1,'','' ,'', 0),
('HIS','dc_mother'        ,'2Family History','Diagnosis Code'         , 4,15,1, 0,255,'',1,1,'','', '', 0),
('HIS','history_siblings' ,'2Family History','Siblings'               , 5, 2,1,20,  0,'',1,1,'','' ,'', 0),
('HIS','dc_siblings'      ,'2Family History','Diagnosis Code'         , 6,15,1, 0,255,'',1,1,'','', '', 0),
('HIS','history_spouse'   ,'2Family History','Spouse'                 , 7, 2,1,20,  0,'',1,1,'','' ,'', 0),
('HIS','dc_spouse'        ,'2Family History','Diagnosis Code'         , 8,15,1, 0,255,'',1,1,'','', '', 0),
('HIS','history_offspring','2Family History','Offspring'              , 9, 2,1,20,  0,'',1,1,'','' ,'', 0),
('HIS','dc_offspring'     ,'2Family History','Diagnosis Code'         ,10,15,1, 0,255,'',1,1,'','', '', 0),
('HIS','relatives_cancer'             ,'3Relatives','Cancer'             ,1, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_tuberculosis'       ,'3Relatives','Tuberculosis'       ,2, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_diabetes'           ,'3Relatives','Diabetes'           ,3, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_high_blood_pressure','3Relatives','High Blood Pressure',4, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_heart_problems'     ,'3Relatives','Heart Problems'     ,5, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_stroke'             ,'3Relatives','Stroke'             ,6, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_epilepsy'           ,'3Relatives','Epilepsy'           ,7, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_mental_illness'     ,'3Relatives','Mental Illness'     ,8, 2,1,20,0,'',1,1,'','' ,'', 0),
('HIS','relatives_suicide'            ,'3Relatives','Suicide'            ,9, 2,1,20,0,'',1,3,'','' ,'', 0),
('HIS','coffee'              ,'4Lifestyle','Coffee'              ,2,28,1,20,0,'',1,3,'','' ,'Caffeine consumption', 0),
('HIS','tobacco'             ,'4Lifestyle','Tobacco'             ,1,32,1,0,0,'smoking_status',1,3,'','' ,'Tobacco use', 0),
('HIS','alcohol'             ,'4Lifestyle','Alcohol'             ,3,28,1,20,0,'',1,3,'','' ,'Alcohol consumption', 0),
('HIS','recreational_drugs'  ,'4Lifestyle','Recreational Drugs'  ,4,28,1,20,0,'',1,3,'','' ,'Recreational drug use', 0),
('HIS','counseling'          ,'4Lifestyle','Counseling'          ,5,28,1,20,0,'',1,3,'','' ,'Counseling activities', 0),
('HIS','exercise_patterns'   ,'4Lifestyle','Exercise Patterns'   ,6,28,1,20,0,'',1,3,'','' ,'Exercise patterns', 0),
('HIS','hazardous_activities','4Lifestyle','Hazardous Activities',7,28,1,20,0,'',1,3,'','' ,'Hazardous activities', 0),
('HIS','sleep_patterns'      ,'4Lifestyle','Sleep Patterns'      ,8, 2,1,20,0,'',1,3,'','' ,'Sleep patterns', 0),
('HIS','seatbelt_use'        ,'4Lifestyle','Seatbelt Use'        ,9, 2,1,20,0,'',1,3,'','' ,'Seatbelt use', 0),
('HIS','name_1'            ,'5Other','Name/Value'        ,1, 2,1,10,255,'',1,1,'','' ,'Name 1', 0),
('HIS','value_1'           ,'5Other',''                  ,2, 2,1,10,255,'',0,0,'','' ,'Value 1', 0),
('HIS','name_2'            ,'5Other','Name/Value'        ,3, 2,1,10,255,'',1,1,'','' ,'Name 2', 0),
('HIS','value_2'           ,'5Other',''                  ,4, 2,1,10,255,'',0,0,'','' ,'Value 2', 0),
('HIS','additional_history','5Other','Additional History',5, 3,1,30,  0,'',1,3,'' ,'' ,'Additional history notes', 3),
('HIS','userarea11'        ,'5Other','User Defined Area 11',6,3,0,30,0,'',1,3,'','','User Defined', 3),
('HIS','userarea12'        ,'5Other','User Defined Area 12',7,3,0,30,0,'',1,3,'','','User Defined', 3),
('FACUSR', 'provider_id', '1General', 'Provider ID', 1, 2, 1, 15, 63, '', 1, 1, '', '', 'Provider ID at Specified Facility', 0);


-- 
-- Table structure for table `list_options`
-- 

DROP TABLE IF EXISTS `list_options`;
CREATE TABLE `list_options` (
  `list_id` varchar(31) NOT NULL default '',
  `option_id` varchar(31) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `seq` int(11) NOT NULL default '0',
  `is_default` tinyint(1) NOT NULL default '0',
  `option_value` float NOT NULL default '0',
  `mapping` varchar(31) NOT NULL DEFAULT '',
  `notes` varchar(255) NOT NULL DEFAULT '',
  `codes` varchar(255) NOT NULL DEFAULT '',
  `toggle_setting_1` tinyint(1) NOT NULL default '0',
  `toggle_setting_2` tinyint(1) NOT NULL default '0',
  `activity` TINYINT DEFAULT 1 NOT NULL,
  `subtype` varchar(31) NOT NULL DEFAULT '',
  PRIMARY KEY  (`list_id`,`option_id`)
) ENGINE=InnoDB;

-- 
-- Dumping data for table `list_options`
-- 

INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('yesno', 'NO', 'NO', 1, 0, 'N');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('yesno', 'YES', 'YES', 2, 0, 'Y');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('titles', 'Mr.', 'Mr.', 1, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('titles', 'Mrs.', 'Mrs.', 2, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('titles', 'Ms.', 'Ms.', 3, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('titles', 'Dr.', 'Dr.', 4, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sex', 'Female', 'Female', 1, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sex', 'Male', 'Male', 2, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'married', 'Married', 1, 0, 'M');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'single', 'Single', 2, 0, 'S');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'divorced', 'Divorced', 3, 0, 'D');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'widowed', 'Widowed', 4, 0, 'W');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'separated', 'Separated', 5, 0, 'L');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('marital', 'domestic partner', 'Domestic Partner', 6, 0, 'T');

INSERT INTO list_options ( list_id, option_id, title, seq, is_default, option_value ) VALUES ('language', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default, option_value, notes ) VALUES ('language', 'English', 'English', 440, 0, 0, 'eng');


INSERT INTO list_options ( list_id, option_id, title, seq, is_default, option_value ) VALUES ('ethrace', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('pricelevel', 'standard', 'Standard', 1, 1);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('risklevel', 'low', 'Low', 1, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('risklevel', 'medium', 'Medium', 2, 1);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('risklevel', 'high', 'High', 3, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('boolean', '0', 'No', 1, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('boolean', '1', 'Yes', 2, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('country', 'USA', 'USA', 1, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','AL','Alabama'             , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','AK','Alaska'              , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','AZ','Arizona'             , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','AR','Arkansas'            , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','CA','California'          , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','CO','Colorado'            , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','CT','Connecticut'         , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','DE','Delaware'            , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','DC','District of Columbia', 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','FL','Florida'             ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','GA','Georgia'             ,11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','HI','Hawaii'              ,12,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','ID','Idaho'               ,13,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','IL','Illinois'            ,14,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','IN','Indiana'             ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','IA','Iowa'                ,16,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','KS','Kansas'              ,17,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','KY','Kentucky'            ,18,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','LA','Louisiana'           ,19,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','ME','Maine'               ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MD','Maryland'            ,21,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MA','Massachusetts'       ,22,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MI','Michigan'            ,23,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MN','Minnesota'           ,24,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MS','Mississippi'         ,25,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MO','Missouri'            ,26,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','MT','Montana'             ,27,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NE','Nebraska'            ,28,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NV','Nevada'              ,29,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NH','New Hampshire'       ,30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NJ','New Jersey'          ,31,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NM','New Mexico'          ,32,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NY','New York'            ,33,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','NC','North Carolina'      ,34,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','ND','North Dakota'        ,35,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','OH','Ohio'                ,36,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','OK','Oklahoma'            ,37,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','OR','Oregon'              ,38,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','PA','Pennsylvania'        ,39,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','RI','Rhode Island'        ,40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','SC','South Carolina'      ,41,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','SD','South Dakota'        ,42,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','TN','Tennessee'           ,43,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','TX','Texas'               ,44,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','UT','Utah'                ,45,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','VT','Vermont'             ,46,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','VA','Virginia'            ,47,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','WA','Washington'          ,48,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','WV','West Virginia'       ,49,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','WI','Wisconsin'           ,50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('state','WY','Wyoming'             ,51,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Patient'      ,'Patient'      , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Employee'     ,'Employee'     , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Walk-In'      ,'Walk-In'      , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Newspaper'    ,'Newspaper'    , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Radio'        ,'Radio'        , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','T.V.'         ,'T.V.'         , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Direct Mail'  ,'Direct Mail'  , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Coupon'       ,'Coupon'       , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Referral Card','Referral Card', 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('refsource','Other'        ,'Other'        ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','vv' ,'Varicose Veins'                      , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','ht' ,'Hypertension'                        , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','db' ,'Diabetes'                            , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','sc' ,'Sickle Cell'                         , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','fib','Fibroids'                            , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','pid','PID (Pelvic Inflammatory Disease)'   , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','mig','Severe Migraine'                     , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','hd' ,'Heart Disease'                       , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','str','Thrombosis/Stroke'                   , 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','hep','Hepatitis'                           ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','gb' ,'Gall Bladder Condition'              ,11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','br' ,'Breast Disease'                      ,12,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','dpr','Depression'                          ,13,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','all','Allergies'                           ,14,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','inf','Infertility'                         ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','ast','Asthma'                              ,16,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','ep' ,'Epilepsy'                            ,17,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','cl' ,'Contact Lenses'                      ,18,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','coc','Contraceptive Complication (specify)',19,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('riskfactors','oth','Other (specify)'                     ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'brs','Breast Exam'          , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'cec','Cardiac Echo'         , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'ecg','ECG'                  , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'gyn','Gynecological Exam'   , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'mam','Mammogram'            , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'phy','Physical Exam'        , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'pro','Prostate Exam'        , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'rec','Rectal Exam'          , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'sic','Sigmoid/Colonoscopy'  , 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'ret','Retinal Exam'         ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'flu','Flu Vaccination'      ,11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'pne','Pneumonia Vaccination',12,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'ldl','LDL'                  ,13,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'hem','Hemoglobin'           ,14,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('exams' ,'psa','PSA'                  ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','0',''           ,0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','1','suspension' ,1,0,'NCI-CONCEPT-ID:C60928');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','2','tablet'     ,2,0,'NCI-CONCEPT-ID:C42998');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','3','capsule'    ,3,0,'NCI-CONCEPT-ID:C25158');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','4','solution'   ,4,0,'NCI-CONCEPT-ID:C42986');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','5','tsp'        ,5,0,'NCI-CONCEPT-ID:C48544');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','6','ml'         ,6,0,'NCI-CONCEPT-ID:C28254');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','7','units'      ,7,0,'NCI-CONCEPT-ID:C44278');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','8','inhalations',8,0,'NCI-CONCEPT-ID:C42944');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','9','gtts(drops)',9,0,'NCI-CONCEPT-ID:C48491');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','10','cream'   ,10,0,'NCI-CONCEPT-ID:C28944');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','11','ointment',11,0,'NCI-CONCEPT-ID:C42966');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_form','12','puff',12,0,'NCI-CONCEPT-ID:C42944');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','0',''          ,0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('drug_units','1','mg'    ,1,0,'NCI-CONCEPT-ID:C28253');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','2','mg/1cc',2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','3','mg/2cc',3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','4','mg/3cc',4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','5','mg/4cc',5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','6','mg/5cc',6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','7','mcg'   ,7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','8','grams' ,8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','9','mL' ,9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_route', '0',''                 , 0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, codes ) VALUES ('drug_route', '1','Per Oris'         , 1,0, 'PO', 'NCI-CONCEPT-ID:C38288');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '2','Per Rectum'       , 2,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '3','To Skin'          , 3,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '4','To Affected Area' , 4,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '5','Sublingual'       , 5,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '6','OS'               , 6,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '7','OD'               , 7,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '8','OU'               , 8,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '9','SQ'               , 9,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','10','IM'               ,10,0, 'IM');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','11','IV'               ,11,0, 'IV');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','12','Per Nostril'      ,12,0, 'NS');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','13','Both Ears',13,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','14','Left Ear' ,14,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route','15','Right Ear',15,0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', 'intradermal', 'Intradermal', 16, 0, 'ID');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', 'other', 'Other/Miscellaneous', 18, 0, 'OTH');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', 'transdermal', 'Transdermal', 19, 0, 'TD');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, codes ) VALUES ('drug_route','intramuscular','Intramuscular' ,20, 0, 'IM', 'NCI-CONCEPT-ID:C28161');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, codes ) VALUES ('drug_route','inhale','Inhale' ,16, 0, 'RESPIR', 'NCI-CONCEPT-ID:C38216');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','0',''      ,0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','1','b.i.d.',1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','2','t.i.d.',2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','3','q.i.d.',3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','4','q.3h'  ,4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','5','q.4h'  ,5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','6','q.5h'  ,6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','7','q.6h'  ,7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','8','q.8h'  ,8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','9','q.d.'  ,9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','10','a.c.'  ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','11','p.c.'  ,11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','12','a.m.'  ,12,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','13','p.m.'  ,13,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','14','ante'  ,14,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','15','h'     ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','16','h.s.'  ,16,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','17','p.r.n.',17,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_interval','18','stat'  ,18,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('chartloc','fileroom','File Room'              ,1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'boolean'      ,'Boolean'            , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'chartloc'     ,'Chart Storage Locations',1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'country'      ,'Country'            , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'drug_form'    ,'Drug Forms'         , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'drug_units'   ,'Drug Units'         , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'drug_route'   ,'Drug Routes'        , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'drug_interval','Drug Intervals'     , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'exams'        ,'Exams/Tests'        , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'feesheet'     ,'Fee Sheet'          , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'language'     ,'Language'           , 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'lbfnames'     ,'Layout-Based Visit Forms',9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'marital'      ,'Marital Status'     ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'pricelevel'   ,'Price Level'        ,11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'ethrace'      ,'Race/Ethnicity'     ,12,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'refsource'    ,'Referral Source'    ,13,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'riskfactors'  ,'Risk Factors'       ,14,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'risklevel'    ,'Risk Level'         ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'superbill'    ,'Service Category'   ,16,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'sex'          ,'Sex'                ,17,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'state'        ,'State'              ,18,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'taxrate'      ,'Tax Rate'           ,19,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'titles'       ,'Titles'             ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists' ,'yesno'        ,'Yes/No'             ,21,0);


INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'    ,'adjreason'      ,'Adjustment Reasons',1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Adm adjust'     ,'Adm adjust'     , 5,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','After hrs calls','After hrs calls',10,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Bad check'      ,'Bad check'      ,15,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Bad debt'       ,'Bad debt'       ,20,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Coll w/o'       ,'Coll w/o'       ,25,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Discount'       ,'Discount'       ,30,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Hardship w/o'   ,'Hardship w/o'   ,35,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Ins adjust'     ,'Ins adjust'     ,40,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Ins bundling'   ,'Ins bundling'   ,45,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Ins overpaid'   ,'Ins overpaid'   ,50,5);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Ins refund'     ,'Ins refund'     ,55,5);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Pt overpaid'    ,'Pt overpaid'    ,60,5);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Pt refund'      ,'Pt refund'      ,65,5);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Pt released'    ,'Pt released'    ,70,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Sm debt w/o'    ,'Sm debt w/o'    ,75,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','To copay'       ,'To copay'       ,80,2);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','To ded\'ble'    ,'To ded\'ble'    ,85,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('adjreason','Untimely filing','Untimely filing',90,1);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'       ,'sub_relation','Subscriber Relationship',18,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sub_relation','self'        ,'Self'                   , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sub_relation','spouse'      ,'Spouse'                 , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sub_relation','child'       ,'Child'                  , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('sub_relation','other'       ,'Other'                  , 4,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'     ,'occurrence','Occurrence'                  ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','0'         ,'Unknown or N/A'              , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','1'         ,'First'                       ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','6'         ,'Early Recurrence (<2 Mo)'    ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','7'         ,'Late Recurrence (2-12 Mo)'   ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','8'         ,'Delayed Recurrence (> 12 Mo)',25,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','4'         ,'Chronic/Recurrent'           ,30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('occurrence','5'         ,'Acute on Chronic'            ,35,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'  ,'outcome','Outcome'         ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','0'      ,'Unassigned'      , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','1'      ,'Resolved'        , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','2'      ,'Improved'        ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','3'      ,'Status quo'      ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','4'      ,'Worse'           ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('outcome','5'      ,'Pending followup',25,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'    ,'note_type'      ,'Patient Note Types',10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Unassigned'     ,'Unassigned'        , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Chart Note'     ,'Chart Note'        , 2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Insurance'      ,'Insurance'         , 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','New Document'   ,'New Document'      , 4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Pharmacy'       ,'Pharmacy'          , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Prior Auth'     ,'Prior Auth'        , 6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Referral'       ,'Referral'          , 7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Test Scheduling','Test Scheduling'   , 8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Bill/Collect'   ,'Bill/Collect'      , 9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Other'          ,'Other'             ,10,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'        ,'immunizations','Immunizations'           ,  8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','1'            ,'DTaP 1'                  , 30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','2'            ,'DTaP 2'                  , 35,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','3'            ,'DTaP 3'                  , 40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','4'            ,'DTaP 4'                  , 45,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','5'            ,'DTaP 5'                  , 50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','6'            ,'DT 1'                    ,  5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','7'            ,'DT 2'                    , 10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','8'            ,'DT 3'                    , 15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','9'            ,'DT 4'                    , 20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','10'           ,'DT 5'                    , 25,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','11'           ,'IPV 1'                   ,110,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','12'           ,'IPV 2'                   ,115,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','13'           ,'IPV 3'                   ,120,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','14'           ,'IPV 4'                   ,125,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','15'           ,'Hib 1'                   , 80,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','16'           ,'Hib 2'                   , 85,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','17'           ,'Hib 3'                   , 90,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','18'           ,'Hib 4'                   , 95,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','19'           ,'Pneumococcal Conjugate 1',140,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','20'           ,'Pneumococcal Conjugate 2',145,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','21'           ,'Pneumococcal Conjugate 3',150,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','22'           ,'Pneumococcal Conjugate 4',155,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','23'           ,'MMR 1'                   ,130,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','24'           ,'MMR 2'                   ,135,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','25'           ,'Varicella 1'             ,165,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','26'           ,'Varicella 2'             ,170,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','27'           ,'Hepatitis B 1'           , 65,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','28'           ,'Hepatitis B 2'           , 70,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','29'           ,'Hepatitis B 3'           , 75,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','30'           ,'Influenza 1'             ,100,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','31'           ,'Influenza 2'             ,105,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','32'           ,'Td'                      ,160,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','33'           ,'Hepatitis A 1'           , 55,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','34'           ,'Hepatitis A 2'           , 60,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('immunizations','35'           ,'Other'                   ,175,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'apptstat','Appointment Statuses', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','-'       ,'- None'              , 5,0,'FEFDCF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','*'       ,'* Reminder done'     ,10,0,'FFC9F8|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','+'       ,'+ Chart pulled'      ,15,0,'87FF1F|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','x'       ,'x Canceled'          ,20,0,'BFBFBF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','?'       ,'? No show'           ,25,0,'BFBFBF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, toggle_setting_1 ) VALUES ('apptstat','@'       ,'@ Arrived'           ,30,0,'FF2414|10','1');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, toggle_setting_1 ) VALUES ('apptstat','~'       ,'~ Arrived late'      ,35,0,'FF6619|10','1');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, toggle_setting_2 ) VALUES ('apptstat','!'       ,'! Left w/o visit'    ,40,0,'0BBA34|0','1');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','#'       ,'# Ins/fin issue'     ,45,0,'FFFF2B|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','<'       ,'< In exam room'      ,50,0,'52D9DE|10');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes, toggle_setting_2 ) VALUES ('apptstat','>'       ,'> Checked out'       ,55,0,'FEFDCF|0','1');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','$'       ,'$ Coding done'       ,60,0,'C0FF96|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','%'       ,'% Canceled < 24h'    ,65,0,'BFBFBF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','^'       ,'^ Pending from Portal'    ,70,0,'ADBBFF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','='       ,'= Rescheduled'    ,75,0,'BFBFBF|0');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('apptstat','&'       ,'& Rescheduled < 24h'    ,80,0,'BFBFBF|0');

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'    ,'warehouse','Warehouses',21,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('warehouse','onsite'   ,'On Site'   , 5,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','abook_type'  ,'Address Book Types'  , 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','ord_img','Imaging Service'     , 5,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','ord_imm','Immunization Service',10,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','ord_lab','Lab Service'         ,15,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','spe'    ,'Specialist'          ,20,2);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','vendor' ,'Vendor'              ,25,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','dist'   ,'Distributor'         ,30,3);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','oth'    ,'Other'               ,95,1);
INSERT INTO list_options ( list_id, option_id, title, seq, option_value ) VALUES ('abook_type','ccda', 'Care Coordination', 35, 2);
INSERT INTO list_options (list_id, option_id, title , seq, option_value ) VALUES ('abook_type','emr_direct', 'EMR Direct' ,105,4);
INSERT INTO list_options (list_id, option_id, title , seq, option_value ) VALUES ('abook_type','external_provider', 'External Provider' ,110,1);
INSERT INTO list_options (list_id, option_id, title , seq, option_value ) VALUES ('abook_type','external_org', 'External Organization' ,120,1);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_type','Procedure Types', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_type','grp','Group'          ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_type','ord','Procedure Order',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_type','res','Discrete Result',30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_type','rec','Recommendation' ,40,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_body_site','Procedure Body Sites', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_body_site','arm'    ,'Arm'    ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_body_site','buttock','Buttock',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_body_site','oth'    ,'Other'  ,90,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_specimen','Procedure Specimen Types', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_specimen','blood' ,'Blood' ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_specimen','saliva','Saliva',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_specimen','urine' ,'Urine' ,30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_specimen','oth'   ,'Other' ,90,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_route','Procedure Routes', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_route','inj' ,'Injection',10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_route','oral','Oral'     ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_route','oth' ,'Other'    ,90,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_lat','Procedure Lateralities', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_lat','left' ,'Left'     ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_lat','right','Right'    ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_lat','bilat','Bilateral',30,0);

INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('lists','proc_unit','Procedure Units', 1);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','bool'       ,'Boolean'    ,  5);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','cu_mm'      ,'CU.MM'      , 10);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','fl'         ,'FL'         , 20);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','g_dl'       ,'G/DL'       , 30);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','gm_dl'      ,'GM/DL'      , 40);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','hmol_l'     ,'HMOL/L'     , 50);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','iu_l'       ,'IU/L'       , 60);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','mg_dl'      ,'MG/DL'      , 70);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','mil_cu_mm'  ,'Mil/CU.MM'  , 80);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','percent'    ,'Percent'    , 90);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','percentile' ,'Percentile' ,100);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','pg'         ,'PG'         ,110);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','ratio'      ,'Ratio'      ,120);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','thous_cu_mm','Thous/CU.MM',130);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','units'      ,'Units'      ,140);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','units_l'    ,'Units/L'    ,150);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','days'       ,'Days'       ,600);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','weeks'      ,'Weeks'      ,610);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','months'     ,'Months'     ,620);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('proc_unit','oth'        ,'Other'      ,990);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','ord_priority','Order Priorities', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_priority','high'  ,'High'  ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_priority','normal','Normal',20,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','ord_status','Order Statuses', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_status','pending' ,'Pending' ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_status','routed'  ,'Routed'  ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_status','complete','Complete',30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('ord_status','canceled','Canceled',40,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_rep_status','Procedure Report Statuses', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','final'  ,'Final'      ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','review' ,'Reviewed'   ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','prelim' ,'Preliminary',30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','cancel' ,'Canceled'   ,40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','error'  ,'Error'      ,50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_rep_status','correct','Corrected'  ,60,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_res_abnormal','Procedure Result Abnormal', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal','no'  ,'No'  ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal','yes' ,'Yes' ,20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal','high','High',30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal','low' ,'Low' ,40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal', 'vhigh', 'Above upper panic limits', 50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_abnormal', 'vlow', 'Below lower panic limits', 60,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_res_status','Procedure Result Statuses', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','final'     ,'Final'      ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','prelim'    ,'Preliminary',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','cancel'    ,'Canceled'   ,30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','error'     ,'Error'      ,40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','correct'   ,'Corrected'  ,50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_status','incomplete','Incomplete' ,60,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','proc_res_bool','Procedure Boolean Results', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_bool','neg' ,'Negative',10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('proc_res_bool','pos' ,'Positive',20,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'         ,'message_status','Message Status',45,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('message_status','Done'           ,'Done'         , 5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('message_status','Forwarded'      ,'Forwarded'    ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('message_status','New'            ,'New'          ,15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('message_status','Read'           ,'Read'         ,20,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Lab Results' ,'Lab Results', 15,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','New Orders' ,'New Orders', 20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('note_type','Patient Reminders' ,'Patient Reminders', 25,0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'irnpool','Invoice Reference Number Pools', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('irnpool','main','Main',1,1,'000001');

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists', 'eligibility', 'Eligibility', 60, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('eligibility', 'eligible', 'Eligible', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('eligibility', 'ineligible', 'Ineligible', 20, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists', 'transactions', 'Layout-Based Transaction Forms', 9, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('transactions', 'LBTref'  , 'Referral'         , 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('transactions', 'LBTptreq', 'Patient Request'  , 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('transactions', 'LBTphreq', 'Physician Request', 30, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('transactions', 'LBTlegal', 'Legal'            , 40, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('transactions', 'LBTbill' , 'Billing'          , 50, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_adjustment_code','Payment Adjustment Code', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_adjustment_code', 'family_payment', 'Family Payment', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_adjustment_code', 'group_payment', 'Group Payment', 30, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_adjustment_code', 'insurance_payment', 'Insurance Payment', 40, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_adjustment_code', 'patient_payment', 'Patient Payment', 50, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_adjustment_code', 'pre_payment', 'Pre Payment', 60, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_ins','Payment Ins', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_ins', '0', 'Pat', 40, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_ins', '1', 'Ins1', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_ins', '2', 'Ins2', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_ins', '3', 'Ins3', 30, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_method','Payment Method', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_method', 'bank_draft', 'Bank Draft', 50, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_method', 'cash', 'Cash', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_method', 'check_payment', 'Check Payment', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_method', 'credit_card', 'Credit Card', 30, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_method', 'electronic', 'Electronic', 40, 0);
insert into `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) values('payment_method','authorize_net','Authorize.net','60','0','0','','');

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_sort_by','Payment Sort By', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'check_date', 'Check Date', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'payer_id', 'Ins Code', 40, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'payment_method', 'Payment Method', 50, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'payment_type', 'Paying Entity', 30, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'pay_total', 'Amount', 70, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'reference', 'Check Number', 60, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_sort_by', 'session_id', 'Id', 10, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_status','Payment Status', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_status', 'fully_paid', 'Fully Paid', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_status', 'unapplied', 'Unapplied', 20, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_type','Payment Type', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_type', 'insurance', 'Insurance', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_type', 'patient', 'Patient', 20, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists', 'date_master_criteria', 'Date Master Criteria', 33, 1);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'all', 'All', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'today', 'Today', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'this_month_to_date', 'This Month to Date', 30, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'last_month', 'Last Month', 40, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'this_week_to_date', 'This Week to Date', 50, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'this_calendar_year', 'This Calendar Year', 60, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'last_calendar_year', 'Last Calendar Year', 70, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('date_master_criteria', 'custom', 'Custom', 80, 0);


-- order types
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','order_type','Order Types', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','procedure','Procedure',10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','intervention','Intervention',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','laboratory_test','Laboratory Test',30,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','physical_exam','Physical Exam',40,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','risk_category','Risk Category Assessment',50,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','patient_characteristics','Patient Characteristics',60,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('order_type','imaging','Imaging',70,0);

-- eRx User Roles
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxadmin','NewCrop Admin','5','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxdoctor','NewCrop Doctor','20','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxmanager','NewCrop Manager','15','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxmidlevelPrescriber','NewCrop Midlevel Prescriber','25','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxnurse','NewCrop Nurse','10','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('newcrop_erx_role','erxsupervisingDoctor','NewCrop Supervising Doctor','30','0','0','','');
INSERT INTO list_options (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('lists','newcrop_erx_role','NewCrop eRx Role','221','0','0','','');

-- MSP remit codes
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('lists','msp_remit_codes','MSP Remit Codes','221','0','0','','');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '1', '1', 1, 0, 0, '', 'Deductible Amount');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '2', '2', 2, 0, 0, '', 'Coinsurance Amount');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '3', '3', 3, 0, 0, '', 'Co-payment Amount');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '4', '4', 4, 0, 0, '', 'The procedure code is inconsistent with the modifier used or a required modifier is missing. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '9', '9', 9, 0, 0, '', 'The diagnosis is inconsistent with the patient''s age. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '10', '10', 10, 0, 0, '', 'The diagnosis is inconsistent with the patient''s gender. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '11', '11', 11, 0, 0, '', 'The diagnosis is inconsistent with the procedure. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '12', '12', 12, 0, 0, '', 'The diagnosis is inconsistent with the provider type. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '13', '13', 13, 0, 0, '', 'The date of death precedes the date of service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '14', '14', 14, 0, 0, '', 'The date of birth follows the date of service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '15', '15', 15, 0, 0, '', 'The authorization number is missing, invalid, or does not apply to the billed services or provider.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '16', '16', 16, 0, 0, '', 'Claim/service lacks information which is needed for adjudication. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '18', '18', 17, 0, 0, '', 'Duplicate claim/service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '19', '19', 18, 0, 0, '', 'This is a work-related injury/illness and thus the liability of the Worker''s Compensation Carrier.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '20', '20', 19, 0, 0, '', 'This injury/illness is covered by the liability carrier.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '21', '21', 20, 0, 0, '', 'This injury/illness is the liability of the no-fault carrier.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '22', '22', 21, 0, 0, '', 'This care may be covered by another payer per coordination of benefits.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '23', '23', 22, 0, 0, '', 'The impact of prior payer(s) adjudication including payments and/or adjustments.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '24', '24', 23, 0, 0, '', 'Charges are covered under a capitation agreement/managed care plan.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '26', '26', 24, 0, 0, '', 'Expenses incurred prior to coverage.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '27', '27', 25, 0, 0, '', 'Expenses incurred after coverage terminated.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '29', '29', 26, 0, 0, '', 'The time limit for filing has expired.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '31', '31', 27, 0, 0, '', 'Patient cannot be identified as our insured.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '32', '32', 28, 0, 0, '', 'Our records indicate that this dependent is not an eligible dependent as defined.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '33', '33', 29, 0, 0, '', 'Insured has no dependent coverage.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '34', '34', 30, 0, 0, '', 'Insured has no coverage for newborns.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '35', '35', 31, 0, 0, '', 'Lifetime benefit maximum has been reached.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '38', '38', 32, 0, 0, '', 'Services not provided or authorized by designated (network/primary care) providers.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '39', '39', 33, 0, 0, '', 'Services denied at the time authorization/pre-certification was requested.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '40', '40', 34, 0, 0, '', 'Charges do not meet qualifications for emergent/urgent care. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '44', '44', 35, 0, 0, '', 'Prompt-pay discount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '45', '45', 36, 0, 0, '', 'Charge exceeds fee schedule/maximum allowable or contracted/legislated fee arrangement. (Use Group Codes PR or CO depending upon liability).');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '49', '49', 37, 0, 0, '', 'These are non-covered services because this is a routine exam or screening procedure done in conjunction with a routine exam. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '50', '50', 38, 0, 0, '', 'These are non-covered services because this is not deemed a ''medical necessity'' by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '51', '51', 39, 0, 0, '', 'These are non-covered services because this is a pre-existing condition. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '53', '53', 40, 0, 0, '', 'Services by an immediate relative or a member of the same household are not covered.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '54', '54', 41, 0, 0, '', 'Multiple physicians/assistants are not covered in this case. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '55', '55', 42, 0, 0, '', 'Procedure/treatment is deemed experimental/investigational by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '56', '56', 43, 0, 0, '', 'Procedure/treatment has not been deemed ''proven to be effective'' by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '58', '58', 44, 0, 0, '', 'Treatment was deemed by the payer to have been rendered in an inappropriate or invalid place of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '59', '59', 45, 0, 0, '', 'Processed based on multiple or concurrent procedure rules. (For example multiple surgery or diagnostic imaging, concurrent anesthesia.) Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '60', '60', 46, 0, 0, '', 'Charges for outpatient services are not covered when performed within a period of time prior to or after inpatient services.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '61', '61', 47, 0, 0, '', 'Penalty for failure to obtain second surgical opinion. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '66', '66', 48, 0, 0, '', 'Blood Deductible.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '69', '69', 49, 0, 0, '', 'Day outlier amount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '70', '70', 50, 0, 0, '', 'Cost outlier - Adjustment to compensate for additional costs.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '74', '74', 51, 0, 0, '', 'Indirect Medical Education Adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '75', '75', 52, 0, 0, '', 'Direct Medical Education Adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '76', '76', 53, 0, 0, '', 'Disproportionate Share Adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '78', '78', 54, 0, 0, '', 'Non-Covered days/Room charge adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '85', '85', 55, 0, 0, '', 'Patient Interest Adjustment (Use Only Group code PR)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '87', '87', 56, 0, 0, '', 'Transfer amount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '89', '89', 57, 0, 0, '', 'Professional fees removed from charges.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '90', '90', 58, 0, 0, '', 'Ingredient cost adjustment. Note: To be used for pharmaceuticals only.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '91', '91', 59, 0, 0, '', 'Dispensing fee adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '94', '94', 60, 0, 0, '', 'Processed in Excess of charges.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '95', '95', 61, 0, 0, '', 'Plan procedures not followed.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '96', '96', 62, 0, 0, '', 'Non-covered charge(s). At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.) Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 S');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '97', '97', 63, 0, 0, '', 'The benefit for this service is included in the payment/allowance for another service/procedure that has already been adjudicated. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '100', '100', 64, 0, 0, '', 'Payment made to patient/insured/responsible party/employer.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '101', '101', 65, 0, 0, '', 'Predetermination: anticipated payment upon completion of services or claim adjudication.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '102', '102', 66, 0, 0, '', 'Major Medical Adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '103', '103', 67, 0, 0, '', 'Provider promotional discount (e.g., Senior citizen discount).');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '104', '104', 68, 0, 0, '', 'Managed care withholding.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '105', '105', 69, 0, 0, '', 'Tax withholding.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '106', '106', 70, 0, 0, '', 'Patient payment option/election not in effect.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '107', '107', 71, 0, 0, '', 'The related or qualifying claim/service was not identified on this claim. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '108', '108', 72, 0, 0, '', 'Rent/purchase guidelines were not met. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '109', '109', 73, 0, 0, '', 'Claim not covered by this payer/contractor. You must send the claim to the correct payer/contractor.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '110', '110', 74, 0, 0, '', 'Billing date predates service date.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '111', '111', 75, 0, 0, '', 'Not covered unless the provider accepts assignment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '112', '112', 76, 0, 0, '', 'Service not furnished directly to the patient and/or not documented.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '114', '114', 77, 0, 0, '', 'Procedure/product not approved by the Food and Drug Administration.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '115', '115', 78, 0, 0, '', 'Procedure postponed, canceled, or delayed.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '116', '116', 79, 0, 0, '', 'The advance indemnification notice signed by the patient did not comply with requirements.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '117', '117', 80, 0, 0, '', 'Transportation is only covered to the closest facility that can provide the necessary care.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '118', '118', 81, 0, 0, '', 'ESRD network support adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '119', '119', 82, 0, 0, '', 'Benefit maximum for this time period or occurrence has been reached.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '121', '121', 83, 0, 0, '', 'Indemnification adjustment - compensation for outstanding member responsibility.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '122', '122', 84, 0, 0, '', 'Psychiatric reduction.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '125', '125', 85, 0, 0, '', 'Submission/billing error(s). At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '128', '128', 86, 0, 0, '', 'Newborn''s services are covered in the mother''s Allowance.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '129', '129', 87, 0, 0, '', 'Prior processing information appears incorrect. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '130', '130', 88, 0, 0, '', 'Claim submission fee.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '131', '131', 89, 0, 0, '', 'Claim specific negotiated discount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '132', '132', 90, 0, 0, '', 'Prearranged demonstration project adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '133', '133', 91, 0, 0, '', 'The disposition of this claim/service is pending further review.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '134', '134', 92, 0, 0, '', 'Technical fees removed from charges.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '135', '135', 93, 0, 0, '', 'Interim bills cannot be processed.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '136', '136', 94, 0, 0, '', 'Failure to follow prior payer''s coverage rules. (Use Group Code OA).');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '137', '137', 95, 0, 0, '', 'Regulatory Surcharges, Assessments, Allowances or Health Related Taxes.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '138', '138', 96, 0, 0, '', 'Appeal procedures not followed or time limits not met.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '139', '139', 97, 0, 0, '', 'Contracted funding agreement - Subscriber is employed by the provider of services.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '140', '140', 98, 0, 0, '', 'Patient/Insured health identification number and name do not match.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '141', '141', 99, 0, 0, '', 'Claim spans eligible and ineligible periods of coverage.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '142', '142', 100, 0, 0, '', 'Monthly Medicaid patient liability amount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '143', '143', 101, 0, 0, '', 'Portion of payment deferred.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '144', '144', 102, 0, 0, '', 'Incentive adjustment, e.g. preferred product/service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '146', '146', 103, 0, 0, '', 'Diagnosis was invalid for the date(s) of service reported.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '147', '147', 104, 0, 0, '', 'Provider contracted/negotiated rate expired or not on file.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '148', '148', 105, 0, 0, '', 'Information from another provider was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '149', '149', 106, 0, 0, '', 'Lifetime benefit maximum has been reached for this service/benefit category.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '150', '150', 107, 0, 0, '', 'Payer deems the information submitted does not support this level of service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '151', '151', 108, 0, 0, '', 'Payment adjusted because the payer deems the information submitted does not support this many/frequency of services.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '152', '152', 109, 0, 0, '', 'Payer deems the information submitted does not support this length of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '153', '153', 110, 0, 0, '', 'Payer deems the information submitted does not support this dosage.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '154', '154', 111, 0, 0, '', 'Payer deems the information submitted does not support this day''s supply.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '155', '155', 112, 0, 0, '', 'Patient refused the service/procedure.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '157', '157', 113, 0, 0, '', 'Service/procedure was provided as a result of an act of war.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '158', '158', 114, 0, 0, '', 'Service/procedure was provided outside of the United States.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '159', '159', 115, 0, 0, '', 'Service/procedure was provided as a result of terrorism.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '160', '160', 116, 0, 0, '', 'Injury/illness was the result of an activity that is a benefit exclusion.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '161', '161', 117, 0, 0, '', 'Provider performance bonus');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '162', '162', 118, 0, 0, '', 'State-mandated Requirement for Property and Casualty, see Claim Payment Remarks Code for specific explanation.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '163', '163', 119, 0, 0, '', 'Attachment referenced on the claim was not received.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '164', '164', 120, 0, 0, '', 'Attachment referenced on the claim was not received in a timely fashion.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '165', '165', 121, 0, 0, '', 'Referral absent or exceeded.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '166', '166', 122, 0, 0, '', 'These services were submitted after this payers responsibility for processing claims under this plan ended.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '167', '167', 123, 0, 0, '', 'This (these) diagnosis(es) is (are) not covered. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '168', '168', 124, 0, 0, '', 'Service(s) have been considered under the patient''s medical plan. Benefits are not available under this dental plan.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '169', '169', 125, 0, 0, '', 'Alternate benefit has been provided.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '170', '170', 126, 0, 0, '', 'Payment is denied when performed/billed by this type of provider. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '171', '171', 127, 0, 0, '', 'Payment is denied when performed/billed by this type of provider in this type of facility. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '172', '172', 128, 0, 0, '', 'Payment is adjusted when performed/billed by a provider of this specialty. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '173', '173', 129, 0, 0, '', 'Service was not prescribed by a physician.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '174', '174', 130, 0, 0, '', 'Service was not prescribed prior to delivery.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '175', '175', 131, 0, 0, '', 'Prescription is incomplete.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '176', '176', 132, 0, 0, '', 'Prescription is not current.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '177', '177', 133, 0, 0, '', 'Patient has not met the required eligibility requirements.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '178', '178', 134, 0, 0, '', 'Patient has not met the required spend down requirements.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '179', '179', 135, 0, 0, '', 'Patient has not met the required waiting requirements. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '180', '180', 136, 0, 0, '', 'Patient has not met the required residency requirements.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '181', '181', 137, 0, 0, '', 'Procedure code was invalid on the date of service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '182', '182', 138, 0, 0, '', 'Procedure modifier was invalid on the date of service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '183', '183', 139, 0, 0, '', 'The referring provider is not eligible to refer the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '184', '184', 140, 0, 0, '', 'The prescribing/ordering provider is not eligible to prescribe/order the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '185', '185', 141, 0, 0, '', 'The rendering provider is not eligible to perform the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '186', '186', 142, 0, 0, '', 'Level of care change adjustment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '187', '187', 143, 0, 0, '', 'Consumer Spending Account payments (includes but is not limited to Flexible Spending Account, Health Savings Account, Health Reimbursement Account, etc.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '188', '188', 144, 0, 0, '', 'This product/procedure is only covered when used according to FDA recommendations.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '189', '189', 145, 0, 0, '', '''''Not otherwise classified'' or ''unlisted'' procedure code (CPT/HCPCS) was billed when there is a specific procedure code for this procedure/service''');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '190', '190', 146, 0, 0, '', 'Payment is included in the allowance for a Skilled Nursing Facility (SNF) qualified stay.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '191', '191', 147, 0, 0, '', 'Not a work related injury/illness and thus not the liability of the workers'' compensation carrier Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Clai');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '192', '192', 148, 0, 0, '', 'Non standard adjustment code from paper remittance. Note: This code is to be used by providers/payers providing Coordination of Benefits information to another payer in the 837 transaction only. This code is only used when the non-standard code cannot be ');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '193', '193', 149, 0, 0, '', 'Original payment decision is being maintained. Upon review, it was determined that this claim was processed properly.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '194', '194', 150, 0, 0, '', 'Anesthesia performed by the operating physician, the assistant surgeon or the attending physician.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '195', '195', 151, 0, 0, '', 'Refund issued to an erroneous priority payer for this claim/service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '197', '197', 152, 0, 0, '', 'Precertification/authorization/notification absent.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '198', '198', 153, 0, 0, '', 'Precertification/authorization exceeded.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '199', '199', 154, 0, 0, '', 'Revenue code and Procedure code do not match.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '200', '200', 155, 0, 0, '', 'Expenses incurred during lapse in coverage');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '201', '201', 156, 0, 0, '', 'Workers Compensation case settled. Patient is responsible for amount of this claim/service through WC ''Medicare set aside arrangement'' or other agreement. (Use group code PR).');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '202', '202', 157, 0, 0, '', 'Non-covered personal comfort or convenience services.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '203', '203', 158, 0, 0, '', 'Discontinued or reduced service.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '204', '204', 159, 0, 0, '', 'This service/equipment/drug is not covered under the patient?s current benefit plan');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '205', '205', 160, 0, 0, '', 'Pharmacy discount card processing fee');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '206', '206', 161, 0, 0, '', 'National Provider Identifier - missing.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '207', '207', 162, 0, 0, '', 'National Provider identifier - Invalid format');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '208', '208', 163, 0, 0, '', 'National Provider Identifier - Not matched.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '209', '209', 164, 0, 0, '', 'Per regulatory or other agreement. The provider cannot collect this amount from the patient. However, this amount may be billed to subsequent payer. Refund to patient if collected. (Use Group code OA)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '210', '210', 165, 0, 0, '', 'Payment adjusted because pre-certification/authorization not received in a timely fashion');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '211', '211', 166, 0, 0, '', 'National Drug Codes (NDC) not eligible for rebate, are not covered.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '212', '212', 167, 0, 0, '', 'Administrative surcharges are not covered');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '213', '213', 168, 0, 0, '', 'Non-compliance with the physician self referral prohibition legislation or payer policy.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '214', '214', 169, 0, 0, '', 'Workers'' Compensation claim adjudicated as non-compensable. This Payer not liable for claim or service/treatment. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '215', '215', 170, 0, 0, '', 'Based on subrogation of a third party settlement');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '216', '216', 171, 0, 0, '', 'Based on the findings of a review organization');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '217', '217', 172, 0, 0, '', 'Based on payer reasonable and customary fees. No maximum allowable defined by legislated fee arrangement. (Note: To be used for Workers'' Compensation only)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '218', '218', 173, 0, 0, '', 'Based on entitlement to benefits. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier ''IG'') for the jurisdictional');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '219', '219', 174, 0, 0, '', 'Based on extent of injury. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier ''IG'') for the jurisdictional regula');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '220', '220', 175, 0, 0, '', 'The applicable fee schedule does not contain the billed code. Please resubmit a bill with the appropriate fee schedule code(s) that best describe the service(s) provided and supporting documentation if required. (Note: To be used for Workers'' Compensation');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '221', '221', 176, 0, 0, '', 'Workers'' Compensation claim is under investigation. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier ''IG'') for ');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '222', '222', 177, 0, 0, '', 'Exceeds the contracted maximum number of hours/days/units by this provider for this period. This is not patient specific. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '223', '223', 178, 0, 0, '', 'Adjustment code for mandated federal, state or local law/regulation that is not already covered by another code and is mandated before a new code can be created.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '224', '224', 179, 0, 0, '', 'Patient identification compromised by identity theft. Identity verification required for processing this and future claims.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '225', '225', 180, 0, 0, '', 'Penalty or Interest Payment by Payer (Only used for plan to plan encounter reporting within the 837)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '226', '226', 181, 0, 0, '', 'Information requested from the Billing/Rendering Provider was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '227', '227', 182, 0, 0, '', 'Information requested from the patient/insured/responsible party was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is ');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '228', '228', 183, 0, 0, '', 'Denied for failure of this provider, another provider or the subscriber to supply requested information to a previous payer for their adjudication');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '229', '229', 184, 0, 0, '', 'Partial charge amount not considered by Medicare due to the initial claim Type of Bill being 12X. Note: This code can only be used in the 837 transaction to convey Coordination of Benefits information when the secondary payer?s cost avoidance policy allow');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '230', '230', 185, 0, 0, '', 'No available or correlating CPT/HCPCS code to describe this service. Note: Used only by Property and Casualty.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '231', '231', 186, 0, 0, '', 'Mutually exclusive procedures cannot be done in the same day/setting. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '232', '232', 187, 0, 0, '', 'Institutional Transfer Amount. Note - Applies to institutional claims only and explains the DRG amount difference when the patient care crosses multiple institutions.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '233', '233', 188, 0, 0, '', 'Services/charges related to the treatment of a hospital-acquired condition or preventable medical error.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '234', '234', 189, 0, 0, '', 'This procedure is not paid separately. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '235', '235', 190, 0, 0, '', 'Sales Tax');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '236', '236', 191, 0, 0, '', 'This procedure or procedure/modifier combination is not compatible with another procedure or procedure/modifier combination provided on the same day according to the National Correct Coding Initiative.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', '237', '237', 192, 0, 0, '', 'Legislated/Regulatory Penalty. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A0', 'A0', 193, 0, 0, '', 'Patient refund amount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A1', 'A1', 194, 0, 0, '', 'Claim/Service denied. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A5', 'A5', 195, 0, 0, '', 'Medicare Claim PPS Capital Cost Outlier Amount.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A6', 'A6', 196, 0, 0, '', 'Prior hospitalization or 30 day transfer requirement not met.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A7', 'A7', 197, 0, 0, '', 'Presumptive Payment Adjustment');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'A8', 'A8', 198, 0, 0, '', 'Ungroupable DRG.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B1', 'B1', 199, 0, 0, '', 'Non-covered visits.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B10', 'B10', 200, 0, 0, '', 'Allowed amount has been reduced because a component of the basic procedure/test was paid. The beneficiary is not liable for more than the charge limit for the basic procedure/test.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B11', 'B11', 201, 0, 0, '', 'The claim/service has been transferred to the proper payer/processor for processing. Claim/service not covered by this payer/processor.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B12', 'B12', 202, 0, 0, '', 'Services not documented in patients'' medical records.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B13', 'B13', 203, 0, 0, '', 'Previously paid. Payment for this claim/service may have been provided in a previous payment.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B14', 'B14', 204, 0, 0, '', 'Only one visit or consultation per physician per day is covered.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B15', 'B15', 205, 0, 0, '', 'This service/procedure requires that a qualifying service/procedure be received and covered. The qualifying other service/procedure has not been received/adjudicated. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payme');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B16', 'B16', 206, 0, 0, '', '''''New Patient'' qualifications were not met.''');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B20', 'B20', 207, 0, 0, '', 'Procedure/service was partially or fully furnished by another provider.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B22', 'B22', 208, 0, 0, '', 'This payment is adjusted based on the diagnosis.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B23', 'B23', 209, 0, 0, '', 'Procedure billed is not authorized per your Clinical Laboratory Improvement Amendment (CLIA) proficiency test.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B4', 'B4', 210, 0, 0, '', 'Late filing penalty.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B5', 'B5', 211, 0, 0, '', 'Coverage/program guidelines were not met or were exceeded.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B7', 'B7', 212, 0, 0, '', 'This provider was not certified/eligible to be paid for this procedure/service on this date of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B8', 'B8', 213, 0, 0, '', 'Alternative services were available, and should have been utilized. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'B9', 'B9', 214, 0, 0, '', 'Patient is enrolled in a Hospice.');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'D23', 'D23', 215, 0, 0, '', 'This dual eligible patient is covered by Medicare Part D per Medicare Retro-Eligibility. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'W1', 'W1', 216, 0, 0, '', 'Workers'' compensation jurisdictional fee schedule adjustment. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Class of Contract Code Identification Segment (Loop 2100 Other Claim Related Information ');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) VALUES ('msp_remit_codes', 'W2', 'W2', 217, 0, 0, '', 'Payment reduced or denied based on workers'' compensation jurisdictional regulations or payment policies, use only if no other code is applicable. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insur');

INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('lists','nation_notes_replace_buttons','Nation Notes Replace Buttons',1);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('nation_notes_replace_buttons','Yes','Yes',10);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('nation_notes_replace_buttons','No','No',20);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('nation_notes_replace_buttons','Normal','Normal',30);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('nation_notes_replace_buttons','Abnormal','Abnormal',40);
insert into `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) values('lists','payment_gateways','Payment Gateways','297','1','0','','');
insert into `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`) values('payment_gateways','authorize_net','Authorize.net','1','0','0','','');

insert into list_options (list_id, option_id, title, seq, option_value, mapping, notes) values('lists','ptlistcols','Patient List Columns','1','0','','');
INSERT INTO list_options ( list_id, option_id, title, seq, option_value, mapping, notes ) VALUES 
('ptlistcols', 'providerID', 'Provider ID', '30', '', '0', ''),
('ptlistcols','name'      ,'Full Name'     ,'10','3','',''),
('ptlistcols','phone_home','Home Phone'    ,'20','3','',''),
('ptlistcols','DOB'       ,'Date of Birth' ,'40','3','',''),
('ptlistcols','pid'    ,'Patient ID'   ,'50','3','','');

-- Medical Problem Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','medical_problem_issue_list','Medical Problem Issue List');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medical_problem_issue_list', 'HTN', 'HTN', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medical_problem_issue_list', 'asthma', 'asthma', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medical_problem_issue_list', 'diabetes', 'diabetes', 30);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medical_problem_issue_list', 'hyperlipidemia', 'hyperlipidemia', 40);

-- Medication Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','medication_issue_list','Medication Issue List');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medication_issue_list', 'Norvasc', 'Norvasc', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medication_issue_list', 'Lipitor', 'Lipitor', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('medication_issue_list', 'Metformin', 'Metformin', 30);

-- Allergy Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','allergy_issue_list','Allergy Issue List');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('allergy_issue_list', 'penicillin', 'penicillin', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('allergy_issue_list', 'sulfa', 'sulfa', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('allergy_issue_list', 'iodine', 'iodine', 30);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('allergy_issue_list', 'codeine', 'codeine', 40);

-- Surgery Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','surgery_issue_list','Surgery Issue List');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('surgery_issue_list', 'tonsillectomy', 'tonsillectomy', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('surgery_issue_list', 'appendectomy', 'appendectomy', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('surgery_issue_list', 'cholecystectomy', 'cholecystectomy', 30);

-- Dental Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','dental_issue_list','Dental Issue List');

-- General Issue List
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','general_issue_list','General Issue List');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Osteopathy', 'Osteopathy', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Chiropractic', 'Chiropractic', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Prevention Rehab', 'Prevention Rehab', 30);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Podiatry', 'Podiatry', 40);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Strength and Conditioning', 'Strength and Conditioning', 50);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Nutritional', 'Nutritional', 60);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Fitness Testing', 'Fitness Testing', 70);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Pre Participation Assessment', 'Pre Participation Assessment', 80);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('general_issue_list', 'Screening / Testing', 'Screening / Testing', 90);

-- Issue Types List
INSERT INTO list_options (`list_id`,`option_id`,`title`) VALUES ('lists','issue_types','Issue Types');

-- Issue Subtypes List
INSERT INTO list_options (list_id,option_id,title) VALUES ('lists','issue_subtypes','Issue Subtypes');
INSERT INTO list_options (list_id, option_id,title, seq) VALUES ('issue_subtypes', 'eye', 'Eye',10);

-- Insurance Types List
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('lists','insurance_types','Insurance Types',1);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('insurance_types','primary'  ,'Primary'  ,10);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('insurance_types','secondary','Secondary',20);
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`) VALUES ('insurance_types','tertiary' ,'Tertiary' ,30);

-- Amendment Statuses
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists' ,'amendment_status','Amendment Status');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('amendment_status' ,'approved','Approved', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('amendment_status' ,'rejected','Rejected', 20);
	
-- Amendment request from
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists' ,'amendment_from','Amendment From');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('amendment_from' ,'patient','Patient', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('amendment_from' ,'insurance','Insurance', 20);

-- Patient Flow Board Rooms
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','patient_flow_board_rooms','Patient Flow Board Rooms');
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('patient_flow_board_rooms', '1', 'Room 1', 10);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('patient_flow_board_rooms', '2', 'Room 2', 20);
INSERT INTO list_options(list_id,option_id,title,seq) VALUES ('patient_flow_board_rooms', '3', 'Room 3', 30);

-- Religious Affiliation
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','religious_affiliation','Religious Affiliation');

INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','none','1007','Atheist','75');

INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','voodoo','1056','Voodoo','775');
INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','wicca','1057','Wicca','785');
INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','yaohushua','1058','Yaohushua','795');
INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','zen_buddhism','1059','Zen Buddhism','805');
INSERT INTO list_options (list_id, option_id, notes,title, seq) VALUES ('religious_affiliation','zoroastrianism','1060','Zoroastrianism','815');

-- Relationship
INSERT INTO list_options(list_id,option_id,title) VALUES ('lists','personal_relationship','Relationship');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','ADOPT','Adopted Child','ADOPT','10');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','AUNT','Aunt','AUNT','20');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','CHILD','Child','CHILD','30');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','CHLDINLAW','Child in-law','CHLDINLAW','40');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','COUSN','Cousin','COUSN','50');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','DOMPART','Domestic Partner','DOMPART','60');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','FAMMEMB','Family Member','FAMMEMB','70');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','CHLDFOST','Foster Child','CHLDFOST','80');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','GRNDCHILD','Grandchild','GRNDCHILD','90');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','GPARNT','Grandparent','GPARNT','100');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','GRPRN','Grandparent','GRPRN','110');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','GGRPRN','Great Grandparent','GGRPRN','120');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','HSIB','Half-Sibling','HSIB','130');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','MAUNT','MaternalAunt','MAUNT','140');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','MCOUSN','MaternalCousin','MCOUSN','150');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','MGRPRN','MaternalGrandparent','MGRPRN','160');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','MGGRPRN','MaternalGreatgrandparent','MGGRPRN','170');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','MUNCLE','MaternalUncle','MUNCLE','180');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','NCHILD','Natural Child','NCHILD','190');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','NPRN','Natural Parent','NPRN','200');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','NSIB','Natural Sibling','NSIB','210');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','NBOR','Neighbor','NBOR','220');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','NIENEPH','Niece/Nephew','NIENEPH','230');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PRN','Parent','PRN','240');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PRNINLAW','parent in-law','PRNINLAW','250');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PAUNT','PaternalAunt','PAUNT','260');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PCOUSN','PaternalCousin','PCOUSN','270');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PGRPRN','PaternalGrandparent','PGRPRN','280');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PGGRPRN','PaternalGreatgrandparent','PGGRPRN','290');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','PUNCLE','PaternalUncle','PUNCLE','300');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','ROOM','Roommate','ROOM','310');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','SIB','Sibling','SIB','320');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','SIBINLAW','Sibling in-law','SIBINLAW','330');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','SIGOTHR','Significant Other','SIGOTHR','340');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','SPS','Spouse','SPS','350');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','STEP','Step Child','STEP','360');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','STPPRN','Step Parent','STPPRN','370');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','STPSIB','Step Sibling','STPSIB','380');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','UNCLE','Uncle','UNCLE','390');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('personal_relationship','FRND','Unrelated Friend','FRND','400');

-- Severity
INSERT INTO list_options (list_id, option_id, title) VALUES ('lists','severity_ccda','Severity');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','unassigned','Unassigned','','10');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','mild','Mild','SNOMED-CT:255604002','20');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','mild_to_moderate','Mild to moderate','SNOMED-CT:371923003','30');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','moderate','Moderate','SNOMED-CT:6736007','40');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','moderate_to_severe','Moderate to severe','SNOMED-CT:371924009','50');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','severe','Severe','SNOMED-CT:24484000','60');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','life_threatening_severity','Life threatening severity','SNOMED-CT:442452003','70');
INSERT INTO list_options (list_id, option_id, title, codes, seq) values ('severity_ccda','fatal','Fatal','SNOMED-CT:399166001','80');

-- Physician Type

INSERT INTO list_options (list_id,option_id,title) VALUES ('lists','physician_type','Physician Type');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','attending_physician','SNOMED-CT:405279007','Attending physician', '10');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','audiological_physician','SNOMED-CT:310172001','Audiological physician', '20');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','chest_physician','SNOMED-CT:309345004','Chest physician', '30');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','community_health_physician','SNOMED-CT:23278007','Community health physician', '40');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','consultant_physician','SNOMED-CT:158967008','Consultant physician', '50');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','general_physician','SNOMED-CT:59058001','General physician', '60');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','genitourinarymedicinephysician','SNOMED-CT:309358003','Genitourinary medicine physician', '70');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','occupational_physician','SNOMED-CT:158973009','Occupational physician', '80');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','palliative_care_physician','SNOMED-CT:309359006','Palliative care physician', '90');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','physician','SNOMED-CT:309343006','Physician', '100');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','public_health_physician','SNOMED-CT:56466003','Public health physician', '110');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','rehabilitation_physician','SNOMED-CT:309360001','Rehabilitation physician', '120');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','resident_physician','SNOMED-CT:405277009','Resident physician', '130');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','specialized_physician','SNOMED-CT:69280009','Specialized physician', '140');
INSERT INTO list_options (list_id, option_id, codes,title, seq) VALUES ('physician_type','thoracic_physician','SNOMED-CT:309346003','Thoracic physician', '150');

-- Industry

INSERT INTO `list_options` (`list_id`, `option_id`, `title`) VALUES('lists','Industry','Industry');
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Industry', 'law_firm', 'Law Firm', 10);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Industry', 'engineering_firm', 'Engineering Firm', 20);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Industry', 'construction_firm', 'Construction Firm', 30);

-- Occupation

INSERT INTO `list_options` (`list_id`, `option_id`, `title`) VALUES('lists','Occupation','Occupation');
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Occupation', 'lawyer', 'Lawyer', 10);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Occupation', 'engineer', 'Engineer', 20);
INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('Occupation', 'site_worker', 'Site Worker', 30);

-- Reaction

INSERT INTO `list_options` (`list_id`, `option_id`, `title`) VALUES('lists','reaction','Reaction');
INSERT INTO list_options ( list_id, option_id, title, seq, codes ) VALUES ('reaction', 'unassigned', 'Unassigned', 10, '');
INSERT INTO list_options ( list_id, option_id, title, seq, codes ) VALUES ('reaction', 'hives', 'Hives', 20, 'SNOMED-CT:247472004');
INSERT INTO list_options ( list_id, option_id, title, seq, codes ) VALUES ('reaction', 'nausea', 'Nausea', 30, 'SNOMED-CT:422587007');
INSERT INTO list_options ( list_id, option_id, title, seq, codes ) VALUES ('reaction', 'shortness_of_breath', 'Shortness of Breath', 40, 'SNOMED-CT:267036007');

-- County

INSERT INTO list_options (list_id, option_id, title) VALUES ('lists','county','County');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('county','adair','ADAIR','001', '10');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('county','andrew','ANDREW','003', '20');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('county','atchison','ATCHISON','005', '30');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('county','audrain','AUDRAIN','007', '40');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('county','barry','BARRY','009', '50');

-- Immunization Manufacturers

INSERT INTO list_options (list_id, option_id, title) VALUES ('lists','Immunization_Manufacturer','Immunization Manufacturer');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AB','Abbott Laboratories','AB','10');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','ACA','Acambis, Inc','ACA','20');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AD','Adams Laboratories, Inc.','AD','30');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AKR','Akorn, Inc','AKR','40');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','ALP','Alpha Therapeutic Corporation','ALP','50');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AR','Armour','AR','60');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AVB','Aventis Behring L.L.C.','AVB','70');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','AVI','Aviron','AVI','80');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BRR','Barr Laboratories','BRR','90');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BAH','Baxter Healthcare Corporation','BAH','100');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BA','Baxter Healthcare Corporation-inactive','BA','110');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BAY','Bayer Corporation','BAY','120');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BP','Berna Products','BP','130');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BPC','Berna Products Corporation','BPC','140');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','BTP','Biotest Pharmaceuticals Corporation','BTP','150');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CNJ','Cangene Corporation','CNJ','160');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CMP','Celltech Medeva Pharmaceuticals','CMP','170');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CEN','Centeon L.L.C.','CEN','180');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CHI','Chiron Corporation','CHI','190');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CON','Connaught','CON','200');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CRU','Crucell','CRU','210');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','CSL','CSL Behring, Inc','CSL','220');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','DVC','DynPort Vaccine Company, LLC','DVC','230');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MIP','Emergent BioDefense Operations Lansing','MIP','240');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','EVN','Evans Medical Limited','EVN','250');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','GEO','GeoVax Labs, Inc.','GEO','260');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','SKB','GlaxoSmithKline','SKB','270');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','GRE','Greer Laboratories, Inc.','GRE','280');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','GRF','Grifols','GRF','290');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','IDB','ID Biomedical','IDB','300');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','IAG','Immuno International AG','IAG','310');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','IUS','Immuno-U.S., Inc.','IUS','320');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','INT','Intercell Biomedical','INT','330');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','JNJ','Johnson and Johnson','JNJ','340');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','KGC','Korea Green Cross Corporation','KGC','350');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','LED','Lederle','LED','360');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MBL','Massachusetts Biologic Laboratories','MBL','370');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MA','Massachusetts Public Health Biologic Laboratories','MA','380');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MED','MedImmune, Inc.','MED','390');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MSD','Merck and Co., Inc.','MSD','400');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','IM','Merieux','IM','410');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','MIL','Miles','MIL','420');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','NAB','NABI','NAB','430');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','NYB','New York Blood Center','NYB','440');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','NAV','North American Vaccine, Inc.','NAV','450');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','NOV','Novartis Pharmaceutical Corporation','NOV','460');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','NVX','Novavax, Inc.','NVX','470');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','OTC','Organon Teknika Corporation','OTC','480');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','ORT','Ortho-clinical Diagnostics','ORT','490');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','OTH','Other manufacturer','OTH','500');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PD','Parkedale Pharmaceuticals','PD','510');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PFR','Pfizer, Inc','PFR','520');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PWJ','PowderJect Pharmaceuticals','PWJ','530');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PRX','Praxis Biologics','PRX','540');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PSC','Protein Sciences','PSC','550');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','PMC','sanofi pasteur','PMC','560');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','SCL','Sclavo, Inc.','SCL','570');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','SOL','Solvay Pharmaceuticals','SOL','580');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','SI','Swiss Serum and Vaccine Inst.','SI','590');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','TAL','Talecris Biotherapeutics','TAL','600');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','JPN','The Research Foundation for Microbial Diseases of Osaka University (BIKEN)','JPN','610');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','USA','United States Army Medical Research and Material Command','USA','620');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','UNK','Unknown manufacturer','UNK','630');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','VXG','VaxGen','VXG','640');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','WAL','Wyeth','WAL','650');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','WA','Wyeth-Ayerst','WA','660');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Manufacturer','ZLB','ZLB Behring','ZLB','670');

-- Immunization Completion Status

INSERT INTO list_options (list_id, option_id, title) VALUES ('lists','Immunization_Completion_Status','Immunization Completion Status');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Completed','completed','CP', '10');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Refused','Refused','RE', '20');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Not_Administered','Not Administered','NA', '30');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Partially_Administered','Partially Administered','PA', '40');

-- provider_qualifier_code

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists','provider_qualifier_code','Provider Qualifier Code', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('provider_qualifier_code','dk','DK',10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('provider_qualifier_code','dn','DN',20,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('provider_qualifier_code','dq','DQ',30,0);

-- 
-- Table structure for table `lists`
-- 

DROP TABLE IF EXISTS `lists`;
CREATE TABLE `lists` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `type` varchar(255) default NULL,
  `subtype` varchar(31) NOT NULL DEFAULT '',
  `title` varchar(255) default NULL,
  `begdate` date default NULL,
  `enddate` date default NULL,
  `returndate` date default NULL,
  `occurrence` int(11) default '0',
  `classification` int(11) default '0',
  `referredby` varchar(255) default NULL,
  `extrainfo` varchar(255) default NULL,
  `diagnosis` varchar(255) default NULL,
  `activity` tinyint(4) default NULL,
  `comments` longtext,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `outcome` int(11) NOT NULL default '0',
  `destination` varchar(255) default NULL,
  `reinjury_id` bigint(20)  NOT NULL DEFAULT 0,
  `injury_part` varchar(31) NOT NULL DEFAULT '',
  `injury_type` varchar(31) NOT NULL DEFAULT '',
  `injury_grade` varchar(31) NOT NULL DEFAULT '',
  `reaction` varchar(255) NOT NULL DEFAULT '',
  `external_allergyid` INT(11) DEFAULT NULL,
  `erx_source` ENUM('0','1') DEFAULT '0' NOT NULL  COMMENT '0-LibreEHR 1-External',
  `erx_uploaded` ENUM('0','1') DEFAULT '0' NOT NULL  COMMENT '0-Pending NewCrop upload 1-Uploaded TO NewCrop',
  `modifydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `severity_al` VARCHAR( 50 ) DEFAULT NULL,
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `lists_touch`
--

DROP TABLE IF EXISTS `lists_touch`;
CREATE TABLE `lists_touch` (
  `pid` bigint(20) NOT NULL default '0',
  `type` varchar(255) NOT NULL default '',
  `date` datetime default NULL,
  PRIMARY KEY  (`pid`,`type`)
) ENGINE=InnoDB ;


-- 
-- Table structure for table `log`
-- 

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `event` varchar(255) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `comments` longtext,
  `user_notes` longtext,
  `patient_id` bigint(20) default NULL,
  `success` tinyint(1) default 1,
  `checksum` longtext,
  `crt_user` varchar(255) default NULL,
  `log_from` VARCHAR(20) DEFAULT 'LibreEHR',
  `menu_item_id` INT(11) DEFAULT NULL,
  `ccda_doc_id` INT(11) DEFAULT NULL COMMENT 'CCDA document id from ccda',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;



--
-- Table structure for table `modules`
--
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `mod_id` INT(11) NOT NULL AUTO_INCREMENT,
  `mod_name` VARCHAR(64) NOT NULL DEFAULT '0',
  `mod_directory` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_parent` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_type` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_active` INT(1) UNSIGNED NOT NULL DEFAULT '0',
  `mod_ui_name` VARCHAR(20) NOT NULL DEFAULT '''',
  `mod_relative_link` VARCHAR(64) NOT NULL DEFAULT '',
  `mod_ui_order` TINYINT(3) NOT NULL DEFAULT '0',
  `mod_ui_active` INT(1) UNSIGNED NOT NULL DEFAULT '0',
  `mod_description` VARCHAR(255) NOT NULL DEFAULT '',
  `mod_nick_name` VARCHAR(25) NOT NULL DEFAULT '',
  `mod_enc_menu` VARCHAR(10) NOT NULL DEFAULT 'no',
  `permissions_item_table` CHAR(100) DEFAULT NULL,
  `directory` VARCHAR(255) NOT NULL,
  `date` DATETIME NOT NULL,
  `sql_run` TINYINT(4) DEFAULT '0',
  `type` TINYINT(4) DEFAULT '0',
  PRIMARY KEY (`mod_id`,`mod_directory`)
) ENGINE=InnoDB;


--
-- Table structure for table `module_acl_group_settings`
--
DROP TABLE IF EXISTS `module_acl_group_settings`;
CREATE TABLE `module_acl_group_settings` (
  `module_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`group_id`,`section_id`)
) ENGINE=InnoDB;


--
-- Table structure for table `module_acl_sections`
--
DROP TABLE IF EXISTS `module_acl_sections`;
CREATE TABLE `module_acl_sections` (
  `section_id` int(11) DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `parent_section` int(11) DEFAULT NULL,
  `section_identifier` varchar(50) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB;


--
-- Table structure for table `module_acl_user_settings`
--
DROP TABLE IF EXISTS `module_acl_user_settings`;
CREATE TABLE `module_acl_user_settings` (
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` int(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`user_id`,`section_id`)
) ENGINE=InnoDB;


--
-- Table structure for table `module_configuration`
--
DROP TABLE IF EXISTS `module_configuration`;
CREATE TABLE `module_configuration` (
  `module_config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `field_name` varchar(45) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`module_config_id`)
) ENGINE=InnoDB;


--
-- Table structure for table `modules_hooks_settings`
--
DROP TABLE IF EXISTS `modules_hooks_settings`;
CREATE TABLE `modules_hooks_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_id` int(11) DEFAULT NULL,
  `enabled_hooks` varchar(255) DEFAULT NULL,
  `attached_to` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


--
-- Table structure for table `modules_settings`
--
DROP TABLE IF EXISTS `modules_settings`;
CREATE TABLE `modules_settings` (
  `mod_id` INT(11) DEFAULT NULL,
  `fld_type` SMALLINT(6) DEFAULT NULL COMMENT '1=>ACL,2=>preferences,3=>hooks',
  `obj_name` VARCHAR(255) DEFAULT NULL,
  `menu_name` VARCHAR(255) DEFAULT NULL,
  `path` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;


-- 
-- Table structure for table `notes`
-- 

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL default '0',
  `foreign_id` int(11) NOT NULL default '0',
  `note` varchar(255) default NULL,
  `owner` int(11) default NULL,
  `date` datetime default NULL,
  `revision` timestamp NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`owner`),
  KEY `foreign_id_2` (`foreign_id`),
  KEY `date` (`date`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `onotes`
-- 

DROP TABLE IF EXISTS `onotes`;
CREATE TABLE `onotes` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `body` longtext,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `activity` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `onsite_documents`
-- 

DROP TABLE IF EXISTS `onsite_documents`;
CREATE TABLE `onsite_documents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED DEFAULT NULL,
  `facility` int(10) UNSIGNED DEFAULT NULL,
  `provider` int(10) UNSIGNED DEFAULT NULL,
  `encounter` int(10) UNSIGNED DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_type` varchar(255) NOT NULL,
  `patient_signed_status` smallint(5) UNSIGNED NOT NULL,
  `patient_signed_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `authorize_signed_time` datetime DEFAULT NULL,
  `accept_signed_status` smallint(5) NOT NULL,
  `authorizing_signator` varchar(50) NOT NULL,
  `review_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `denial_reason` varchar(255) NOT NULL,
  `authorized_signature` text,
  `patient_signature` text,
  `full_document` blob,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `onsite_mail`
--

DROP TABLE IF EXISTS `onsite_mail`;
CREATE TABLE `onsite_mail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `owner` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext,
  `recipient_id` varchar(128) DEFAULT NULL,
  `recipient_name` varchar(255) DEFAULT NULL,
  `sender_id` varchar(128) DEFAULT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0' COMMENT 'flag indicates note is deleted',
  `delete_date` datetime DEFAULT NULL,
  `mtype` varchar(128) DEFAULT NULL,
  `message_status` varchar(20) NOT NULL DEFAULT 'New',
  `mail_chain` int(11) DEFAULT NULL,
  `reply_mail_chain` int(11) DEFAULT NULL,
  `is_msg_encrypted` tinyint(2) DEFAULT '0' COMMENT 'Whether messsage encrypted 0-Not encrypted, 1-Encrypted',
  PRIMARY KEY (`id`),
  KEY `pid` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `onsite_messages`
--

DROP TABLE IF EXISTS `onsite_messages`;
CREATE TABLE `onsite_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `message` longtext,
  `ip` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'who sent id',
  `recip_id` varchar(255) NOT NULL COMMENT 'who to id array',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT='Portal messages' AUTO_INCREMENT=1 ;

--
-- Table structure for table `onsite_online`
-- 

DROP TABLE IF EXISTS `onsite_online`;
CREATE TABLE `onsite_online` (
  `hash` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_update` datetime NOT NULL,
  `username` varchar(64) NOT NULL,
  `userid` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`hash`)
) ENGINE=InnoDB;

--
-- Table structure for table `onsite_portal_activity`
--

DROP TABLE IF EXISTS `onsite_portal_activity`;
CREATE TABLE `onsite_portal_activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `require_audit` tinyint(1) DEFAULT '1',
  `pending_action` varchar(255) DEFAULT NULL,
  `action_taken` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `narrative` longtext,
  `table_action` longtext,
  `table_args` longtext,
  `action_user` int(11) DEFAULT NULL,
  `action_taken_time` datetime DEFAULT NULL,
  `checksum` longtext,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `onsite_signatures`
--

DROP TABLE IF EXISTS `onsite_signatures`;
CREATE TABLE `onsite_signatures` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(128) NOT NULL DEFAULT 'waiting',
  `type` varchar(128) NOT NULL,
  `created` int(11) NOT NULL,
  `lastmod` datetime NOT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `activity` tinyint(4) NOT NULL DEFAULT '0',
  `authorized` tinyint(4) DEFAULT NULL,
  `signator` varchar(255) NOT NULL,
  `sig_image` text,
  `signature` text,
  `sig_hash` varchar(128) NOT NULL,
  `ip` varchar(46) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid` (`pid`,`user`),
  KEY `encounter` (`encounter`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `libreehr_module_vars`
-- 

DROP TABLE IF EXISTS `libreehr_module_vars`;
CREATE TABLE `libreehr_module_vars` (
  `pn_id` int(11) unsigned NOT NULL auto_increment,
  `pn_modname` varchar(64) default NULL,
  `pn_name` varchar(64) default NULL,
  `pn_value` longtext,
  PRIMARY KEY  (`pn_id`),
  KEY `pn_modname` (`pn_modname`),
  KEY `pn_name` (`pn_name`)
) ENGINE=InnoDB AUTO_INCREMENT=235 ;

-- 
-- Dumping data for table `libreehr_module_vars`
-- 

INSERT INTO `libreehr_module_vars` VALUES (234, 'PostCalendar', 'pcNotifyEmail', '');
INSERT INTO `libreehr_module_vars` VALUES (233, 'PostCalendar', 'pcNotifyAdmin', '0');
INSERT INTO `libreehr_module_vars` VALUES (232, 'PostCalendar', 'pcCacheLifetime', '3600');
INSERT INTO `libreehr_module_vars` VALUES (231, 'PostCalendar', 'pcUseCache', '0');
INSERT INTO `libreehr_module_vars` VALUES (230, 'PostCalendar', 'pcDefaultView', 'day');
INSERT INTO `libreehr_module_vars` VALUES (229, 'PostCalendar', 'pcTimeIncrement', '5');
INSERT INTO `libreehr_module_vars` VALUES (228, 'PostCalendar', 'pcAllowUserCalendar', '1');
INSERT INTO `libreehr_module_vars` VALUES (227, 'PostCalendar', 'pcAllowSiteWide', '1');
INSERT INTO `libreehr_module_vars` VALUES (226, 'PostCalendar', 'pcTemplate', 'default');
INSERT INTO `libreehr_module_vars` VALUES (225, 'PostCalendar', 'pcEventDateFormat', '%Y-%m-%d');
INSERT INTO `libreehr_module_vars` VALUES (224, 'PostCalendar', 'pcDisplayTopics', '0');
INSERT INTO `libreehr_module_vars` VALUES (223, 'PostCalendar', 'pcListHowManyEvents', '15');
INSERT INTO `libreehr_module_vars` VALUES (222, 'PostCalendar', 'pcAllowDirectSubmit', '1');
INSERT INTO `libreehr_module_vars` VALUES (221, 'PostCalendar', 'pcUsePopups', '0');
INSERT INTO `libreehr_module_vars` VALUES (220, 'PostCalendar', 'pcDayHighlightColor', '#EEEEEE');
INSERT INTO `libreehr_module_vars` VALUES (219, 'PostCalendar', 'pcFirstDayOfWeek', '1');
INSERT INTO `libreehr_module_vars` VALUES (218, 'PostCalendar', 'pcUseInternationalDates', '0');
INSERT INTO `libreehr_module_vars` VALUES (217, 'PostCalendar', 'pcEventsOpenInNewWindow', '0');
INSERT INTO `libreehr_module_vars` VALUES (216, 'PostCalendar', 'pcTime24Hours', '0');


-- 
-- Table structure for table `libreehr_modules`
-- 

DROP TABLE IF EXISTS `libreehr_modules`;
CREATE TABLE `libreehr_modules` (
  `pn_id` int(11) unsigned NOT NULL auto_increment,
  `pn_name` varchar(64) default NULL,
  `pn_type` int(6) NOT NULL default '0',
  `pn_displayname` varchar(64) default NULL,
  `pn_description` varchar(255) default NULL,
  `pn_regid` int(11) unsigned NOT NULL default '0',
  `pn_directory` varchar(64) default NULL,
  `pn_version` varchar(10) default NULL,
  `pn_admin_capable` tinyint(1) NOT NULL default '0',
  `pn_user_capable` tinyint(1) NOT NULL default '0',
  `pn_state` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`pn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 ;

-- 
-- Dumping data for table `libreehr_modules`
-- 

INSERT INTO `libreehr_modules` VALUES (46, 'PostCalendar', 2, 'PostCalendar', 'PostNuke Calendar Module', 0, 'PostCalendar', '4.0.0', 1, 1, 3);


-- 
-- Table structure for table `libreehr_postcalendar_categories`
-- 

DROP TABLE IF EXISTS `libreehr_postcalendar_categories`;
CREATE TABLE `libreehr_postcalendar_categories` (
  `pc_catid` int(11) unsigned NOT NULL auto_increment,
  `pc_catname` varchar(100) default NULL,
  `pc_catcolor` varchar(50) default NULL,
  `pc_catdesc` text,
  `pc_recurrtype` int(1) NOT NULL default '0',
  `pc_enddate` date default NULL,
  `pc_recurrspec` text,
  `pc_recurrfreq` int(3) NOT NULL default '0',
  `pc_duration` bigint(20) NOT NULL default '0',
  `pc_end_date_flag` tinyint(1) NOT NULL default '0',
  `pc_end_date_type` int(2) default NULL,
  `pc_end_date_freq` int(11) NOT NULL default '0',
  `pc_end_all_day` tinyint(1) NOT NULL default '0',
  `pc_dailylimit` int(2) NOT NULL default '0',
  `pc_cattype` INT( 11 ) NOT NULL COMMENT 'Used in grouping categories',
  `pc_active` tinyint(1) NOT NULL default 1,
  `pc_seq` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pc_catid`),
  KEY `basic_cat` (`pc_catname`,`pc_catcolor`)
) ENGINE=InnoDB AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `libreehr_postcalendar_categories`
-- 

INSERT INTO `libreehr_postcalendar_categories` VALUES (1, 'No Show', '#DDDDDD', 'Reserved to define when an event did not occur as specified.', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 0, 0, 0, 0, 0, 0,1,1);
INSERT INTO `libreehr_postcalendar_categories` VALUES (2, 'In Office', '#99CCFF', 'Reserved todefine when a provider may haveavailable appointments after.', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 1, 3, 2, 0, 0, 1,1,2);
INSERT INTO `libreehr_postcalendar_categories` VALUES (3, 'Out Of Office', '#99FFFF', 'Reserved to define when a provider may not have available appointments after.', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 1, 3, 2, 0, 0, 1,1,3);
INSERT INTO `libreehr_postcalendar_categories` VALUES (4, 'Vacation', '#EFEFEF', 'Reserved for use to define Scheduled Vacation Time', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 0, 0, 0, 1, 0, 1,1,4);
INSERT INTO `libreehr_postcalendar_categories` VALUES (5, 'Office Visit', '#FFFFCC', 'Normal Office Visit', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0,0,1,5);
INSERT INTO `libreehr_postcalendar_categories` VALUES (6, 'Holidays','#9676DB','Clinic holiday',0,NULL,'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}',0,86400,1,3,2,0,0,2,1,6);
INSERT INTO `libreehr_postcalendar_categories` VALUES (7, 'Closed','#2374AB','Clinic closed',0,NULL,'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}',0,86400,1,3,2,0,0,2,1,7);
INSERT INTO `libreehr_postcalendar_categories` VALUES (8, 'Lunch', '#FFFF33', 'Lunch', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 3600, 0, 3, 2, 0, 0, 1,1,8);
INSERT INTO `libreehr_postcalendar_categories` VALUES (9, 'Established Patient', '#CCFF33', '', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0, 0,1,9);
INSERT INTO `libreehr_postcalendar_categories` VALUES (10,'New Patient', '#CCFFFF', '', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 1800, 0, 0, 0, 0, 0, 0,1,10);
INSERT INTO `libreehr_postcalendar_categories` VALUES (11,'Reserved','#FF7777','Reserved',1,NULL,'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}',0,900,0,3,2,0,0, 1,1,11);
INSERT INTO `libreehr_postcalendar_categories` VALUES (12, 'Health and Behavioral Assessment', '#C7C7C7', 'Health and Behavioral Assessment', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0,0,1,12);
INSERT INTO `libreehr_postcalendar_categories` VALUES (13, 'Preventive Care Services', '#CCCCFF', 'Preventive Care Services', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0,0,1,13);

INSERT INTO `libreehr_postcalendar_categories` VALUES (14, 'Ophthalmological Services', '#F89219', 'Ophthalmological Services', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0,0,1,14);


-- 
-- Table structure for table `libreehr_postcalendar_events`
-- 

DROP TABLE IF EXISTS `libreehr_postcalendar_events`;
CREATE TABLE `libreehr_postcalendar_events` (
  `pc_eid` int(11) unsigned NOT NULL auto_increment,
  `pc_catid` int(11) NOT NULL default '0',
  `pc_multiple` int(10) unsigned NOT NULL,
  `pc_aid` varchar(30) default NULL,
  `pc_pid` varchar(11) default NULL,
  `pc_title` varchar(150) default NULL,
  `pc_time` datetime default NULL,
  `pc_hometext` text,
  `pc_comments` int(11) default '0',
  `pc_counter` mediumint(8) unsigned default '0',
  `pc_topic` int(3) NOT NULL default '1',
  `pc_informant` varchar(20) default NULL,
  `pc_eventDate` date NOT NULL default '0000-00-00',
  `pc_endDate` date NOT NULL default '0000-00-00',
  `pc_duration` bigint(20) NOT NULL default '0',
  `pc_recurrtype` int(1) NOT NULL default '0',
  `pc_recurrspec` text,
  `pc_recurrfreq` int(3) NOT NULL default '0',
  `pc_startTime` time default NULL,
  `pc_endTime` time default NULL,
  `pc_alldayevent` int(1) NOT NULL default '0',
  `pc_location` text,
  `pc_conttel` varchar(50) default NULL,
  `pc_contname` varchar(50) default NULL,
  `pc_contemail` varchar(255) default NULL,
  `pc_website` varchar(255) default NULL,
  `pc_fee` varchar(50) default NULL,
  `pc_eventstatus` int(11) NOT NULL default '0',
  `pc_sharing` int(11) NOT NULL default '0',
  `pc_language` varchar(30) default NULL,
  `pc_apptstatus` varchar(15) NOT NULL default '-',
  `pc_prefcatid` int(11) NOT NULL default '0',
  `pc_facility` smallint(6) NOT NULL default '0' COMMENT 'facility id for this event',
  `pc_sendalertsms` VARCHAR(3) NOT NULL DEFAULT 'NO',
  `pc_sendalertemail` VARCHAR( 3 ) NOT NULL DEFAULT 'NO',
  `pc_billing_location` SMALLINT (6) NOT NULL DEFAULT '0',
  `pc_room` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY  (`pc_eid`),
  KEY `basic_event` (`pc_catid`,`pc_aid`,`pc_eventDate`,`pc_endDate`,`pc_eventstatus`,`pc_sharing`,`pc_topic`),
  KEY `pc_eventDate` (`pc_eventDate`)
) ENGINE=InnoDB AUTO_INCREMENT=7 ;


-- 
-- Table structure for table `libreehr_postcalendar_limits`
-- 

DROP TABLE IF EXISTS `libreehr_postcalendar_limits`;
CREATE TABLE `libreehr_postcalendar_limits` (
  `pc_limitid` int(11) NOT NULL auto_increment,
  `pc_catid` int(11) NOT NULL default '0',
  `pc_starttime` time NOT NULL default '00:00:00',
  `pc_endtime` time NOT NULL default '00:00:00',
  `pc_limit` int(11) NOT NULL default '1',
  PRIMARY KEY  (`pc_limitid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `libreehr_postcalendar_topics`
-- 

DROP TABLE IF EXISTS `libreehr_postcalendar_topics`;
CREATE TABLE `libreehr_postcalendar_topics` (
  `pc_catid` int(11) unsigned NOT NULL auto_increment,
  `pc_catname` varchar(100) default NULL,
  `pc_catcolor` varchar(50) default NULL,
  `pc_catdesc` text,
  PRIMARY KEY  (`pc_catid`),
  KEY `basic_cat` (`pc_catname`,`pc_catcolor`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `libreehr_session_info`
-- 

DROP TABLE IF EXISTS `libreehr_session_info`;
CREATE TABLE `libreehr_session_info` (
  `pn_sessid` varchar(32) NOT NULL default '',
  `pn_ipaddr` varchar(20) default NULL,
  `pn_firstused` int(11) NOT NULL default '0',
  `pn_lastused` int(11) NOT NULL default '0',
  `pn_uid` int(11) NOT NULL default '0',
  `pn_vars` blob,
  PRIMARY KEY  (`pn_sessid`)
) ENGINE=InnoDB;


--
-- Table structure for table `patient_access_onsite`
--

DROP TABLE IF EXISTS `patient_access_onsite`;
CREATE TABLE `patient_access_onsite`(
  `id` INT NOT NULL AUTO_INCREMENT ,
  `pid` INT(11),
  `portal_username` VARCHAR(100) ,
  `portal_pwd` VARCHAR(100) ,
  `portal_pwd_status` TINYINT DEFAULT '1' COMMENT '0=>Password Created Through Demographics by The provider or staff. Patient Should Change it at first time it.1=>Pwd updated or created by patient itself',
  `portal_salt` VARCHAR(100) ,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1;


-- 
-- Table structure for table `patient_data`
-- 

DROP TABLE IF EXISTS `patient_data`;
CREATE TABLE `patient_data` (
  `id` bigint(20) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `language` varchar(255) NOT NULL default '',
  `financial` varchar(255) NOT NULL default '',
  `fname` varchar(255) NOT NULL default '',
  `lname` varchar(255) NOT NULL default '',
  `mname` varchar(255) NOT NULL default '',
  `DOB` date default NULL,
  `street` varchar(255) NOT NULL default '',
  `postal_code` varchar(255) NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `state` varchar(255) NOT NULL default '',
  `country_code` varchar(255) NOT NULL default '',
  `drivers_license` varchar(255) NOT NULL default '',
  `ss` varchar(255) NOT NULL default '',
  `occupation` longtext,
  `phone_home` varchar(255) NOT NULL default '',
  `phone_biz` varchar(255) NOT NULL default '',
  `phone_contact` varchar(255) NOT NULL default '',
  `phone_cell` varchar(255) NOT NULL default '',
  `pharmacy_id` int(11) NOT NULL default '0',
  `status` varchar(255) NOT NULL default '',
  `contact_relationship` varchar(255) NOT NULL default '',
  `date` datetime default NULL,
  `sex` varchar(255) NOT NULL default '',
  `referrer` varchar(255) NOT NULL default '',
  `referrerID` varchar(255) NOT NULL default '',
  `providerID` int(11) default NULL,
  `ref_providerID` int(11) default NULL,
  `email` varchar(255) NOT NULL default '',
  `email_direct` varchar(255) NOT NULL default '',
  `ethnoracial` varchar(255) NOT NULL default '',
  `race` varchar(255) NOT NULL default '',
  `ethnicity` varchar(255) NOT NULL default '',
  `religion` varchar(40) NOT NULL default '',
  `interpretter` varchar(255) NOT NULL default '',
  `migrantseasonal` varchar(255) NOT NULL default '',
  `family_size` varchar(255) NOT NULL default '',
  `monthly_income` varchar(255) NOT NULL default '',
  `billing_note` text,
  `homeless` varchar(255) NOT NULL default '',
  `financial_review` datetime default NULL,
  `pubpid` varchar(255) NOT NULL default '',
  `pid` bigint(20) NOT NULL default '0',
  `genericname1` varchar(255) NOT NULL default '',
  `genericval1` varchar(255) NOT NULL default '',
  `genericname2` varchar(255) NOT NULL default '',
  `genericval2` varchar(255) NOT NULL default '',
  `hipaa_mail` varchar(3) NOT NULL default '',
  `hipaa_voice` varchar(3) NOT NULL default '',
  `hipaa_notice` varchar(3) NOT NULL default '',
  `hipaa_message` varchar(20) NOT NULL default '',
  `hipaa_allowsms` VARCHAR(3) NOT NULL DEFAULT 'NO',
  `hipaa_allowemail` VARCHAR(3) NOT NULL DEFAULT 'NO',
  `squad` varchar(32) NOT NULL default '',
  `fitness` int(11) NOT NULL default '0',
  `referral_source` varchar(30) NOT NULL default '',
  `pricelevel` varchar(255) NOT NULL default 'standard',
  `regdate`     date DEFAULT NULL COMMENT 'Registration Date',
  `contrastart` date DEFAULT NULL COMMENT 'Date contraceptives initially used',
  `completed_ad` VARCHAR(3) NOT NULL DEFAULT 'NO',
  `ad_reviewed` date DEFAULT NULL,
  `vfc` varchar(255) NOT NULL DEFAULT '',
  `mothersname` varchar(255) NOT NULL DEFAULT '',
  `guardiansname` TEXT,
  `allow_imm_reg_use` varchar(255) NOT NULL DEFAULT '',
  `allow_imm_info_share` varchar(255) NOT NULL DEFAULT '',
  `allow_health_info_ex` varchar(255) NOT NULL DEFAULT '',
  `allow_patient_portal` varchar(31) NOT NULL DEFAULT '',
  `deceased_date` datetime default NULL,
  `deceased_reason` varchar(255) NOT NULL default '',
  `soap_import_status` TINYINT(4) DEFAULT NULL COMMENT '1-Prescription Press 2-Prescription Import 3-Allergy Press 4-Allergy Import',
  `care_team` int(11) DEFAULT NULL,
  `county` varchar(40) NOT NULL default '',
  `industry` TEXT,
  UNIQUE KEY `pid` (`pid`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `patient_reminders`
--

DROP TABLE IF EXISTS `patient_reminders`;
CREATE TABLE `patient_reminders` (
  `id` bigint(20) NOT NULL auto_increment,
  `active` tinyint(1) NOT NULL default 1 COMMENT '1 if active and 0 if not active',
  `date_inactivated` datetime DEFAULT NULL,
  `reason_inactivated` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_inactive_opt',
  `due_status` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_due_opt',
  `pid` bigint(20) NOT NULL COMMENT 'id from patient_data table',
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table',
  `date_created` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `voice_status` tinyint(1) NOT NULL default 0 COMMENT '0 if not sent and 1 if sent',
  `sms_status` tinyint(1) NOT NULL default 0 COMMENT '0 if not sent and 1 if sent',
  `email_status` tinyint(1) NOT NULL default 0 COMMENT '0 if not sent and 1 if sent',
  `mail_status` tinyint(1) NOT NULL default 0 COMMENT '0 if not sent and 1 if sent',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY (`category`,`item`)
) ENGINE=InnoDB AUTO_INCREMENT=1;


-- 
-- Table structure for table `patient_tracker`
-- 

DROP TABLE IF EXISTS `patient_tracker`;
CREATE TABLE IF NOT EXISTS `patient_tracker` (
  `id`                     bigint(20)   NOT NULL auto_increment,
  `date`                   datetime     DEFAULT NULL,
  `apptdate`               date         DEFAULT NULL,
  `appttime`               time         DEFAULT NULL,
  `eid`                    bigint(20)   NOT NULL default '0',
  `pid`                    bigint(20)   NOT NULL default '0',
  `original_user`          varchar(255) NOT NULL default '' COMMENT 'This is the user that created the original record',
  `encounter`              bigint(20)   NOT NULL default '0',
  `lastseq`                varchar(4)   NOT NULL default '' COMMENT 'The element file should contain this number of elements',
  `random_drug_test`       TINYINT(1)   DEFAULT NULL COMMENT 'NULL if not randomized. If randomized, 0 is no, 1 is yes',
  `drug_screen_completed`  TINYINT(1)   NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`eid`),
  KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

-- 
-- Table structure for table `patient_tracker_element`
-- 

DROP TABLE IF EXISTS `patient_tracker_element`;
CREATE TABLE IF NOT EXISTS `patient_tracker_element` (
  `pt_tracker_id`      bigint(20)   NOT NULL default '0' COMMENT 'maps to id column in patient_tracker table',
  `start_datetime`     datetime     DEFAULT NULL,
  `room`               varchar(20)  NOT NULL default '',
  `status`             varchar(31)  NOT NULL default '',
  `seq`                varchar(4)   NOT NULL default '' COMMENT 'This is a numerical sequence for this pt_tracker_id events',
  `user`               varchar(255) NOT NULL default '' COMMENT 'This is the user that created this element',
  KEY  (`pt_tracker_id`,`seq`)
) ENGINE=InnoDB;

-- 
-- Table structure for table `payments`
-- 

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL auto_increment,
  `pid` bigint(20) NOT NULL default '0',
  `dtime` datetime NOT NULL,
  `encounter` bigint(20) NOT NULL default '0',
  `user` varchar(255) default NULL,
  `method` varchar(255) default NULL,
  `source` varchar(255) default NULL,
  `amount1` decimal(12,2) NOT NULL default '0.00',
  `amount2` decimal(12,2) NOT NULL default '0.00',
  `posted1` decimal(12,2) NOT NULL default '0.00',
  `posted2` decimal(12,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `payment_gateway_details`
--
DROP TABLE IF EXISTS `payment_gateway_details`;
CREATE TABLE `payment_gateway_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) DEFAULT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `transaction_key` varchar(255) DEFAULT NULL,
  `md5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `pharmacies`
-- 

DROP TABLE IF EXISTS `pharmacies`;
CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `transmit_method` int(11) NOT NULL default '1',
  `email` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `phone_numbers`
-- 

DROP TABLE IF EXISTS `phone_numbers`;
CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL default '0',
  `country_code` varchar(5) default NULL,
  `area_code` char(3) default NULL,
  `prefix` char(3) default NULL,
  `number` varchar(4) default NULL,
  `type` int(11) default NULL,
  `foreign_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `foreign_id` (`foreign_id`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `pnotes`
-- 

DROP TABLE IF EXISTS `pnotes`;
CREATE TABLE `pnotes` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `body` longtext,
  `pid` bigint(20) default NULL,
  `user` varchar(255) default NULL,
  `groupname` varchar(255) default NULL,
  `activity` tinyint(4) default NULL,
  `authorized` tinyint(4) default NULL,
  `title` varchar(255) default NULL,
  `assigned_to` varchar(255) default NULL,
  `deleted` tinyint(4) default 0 COMMENT 'flag indicates note is deleted',
  `message_status` VARCHAR(20) NOT NULL DEFAULT 'New',
  `portal_relation` VARCHAR(100) NULL,
  `is_msg_encrypted` TINYINT(2) DEFAULT '0' COMMENT 'Whether messsage encrypted 0-Not encrypted, 1-Encrypted',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `prescriptions`
-- 

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `filled_by_id` int(11) default NULL,
  `pharmacy_id` int(11) default NULL,
  `date_added` date default NULL,
  `date_modified` date default NULL,
  `provider_id` int(11) default NULL,
  `encounter` int(11) default NULL,
  `start_date` date default NULL,
  `drug` varchar(150) default NULL,
  `drug_id` int(11) NOT NULL default '0',
  `rxnorm_drugcode` INT(11) DEFAULT NULL,
  `form` int(3) default NULL,
  `dosage` varchar(100) default NULL,
  `quantity` varchar(31) default NULL,
  `size` varchar(16) DEFAULT NULL,
  `unit` int(11) default NULL,
  `route` int(11) default NULL,
  `interval` int(11) default NULL,
  `substitute` int(11) default NULL,
  `refills` int(11) default NULL,
  `per_refill` int(11) default NULL,
  `filled_date` date default NULL,
  `medication` int(11) default NULL,
  `note` text,
  `active` int(11) NOT NULL default '1',
  `datetime` DATETIME DEFAULT NULL,
  `user` VARCHAR(50) DEFAULT NULL,
  `site` VARCHAR(50) DEFAULT NULL,
  `prescriptionguid` VARCHAR(50) DEFAULT NULL,
  `erx_source` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-LibreEHR 1-External',
  `erx_uploaded` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-Pending NewCrop upload 1-Uploaded to NewCrop',
  `drug_info_erx` TEXT,
  `external_id` VARCHAR(20) DEFAULT NULL,
  `end_date` date default NULL,
  `indication` text,
  `prn` VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `prices`
-- 

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `pr_id` varchar(11) NOT NULL default '',
  `pr_selector` varchar(255) NOT NULL default '' COMMENT 'template selector for drugs, empty for codes',
  `pr_level` varchar(31) NOT NULL default '',
  `pr_price` decimal(12,2) NOT NULL default '0.00' COMMENT 'price in local currency',
  PRIMARY KEY  (`pr_id`,`pr_selector`,`pr_level`)
) ENGINE=InnoDB;


-- 
-- Table structure for table `registry`
-- 

DROP TABLE IF EXISTS `registry`;
CREATE TABLE `registry` (
  `name` varchar(255) default NULL,
  `state` tinyint(4) default NULL,
  `directory` varchar(255) default NULL,
  `id` bigint(20) NOT NULL auto_increment,
  `sql_run` tinyint(4) default NULL,
  `unpackaged` tinyint(4) default NULL,
  `date` datetime default NULL,
  `priority` int(11) default '0',
  `category` varchar(255) default NULL,
  `nickname` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 ;

--
-- Dumping data for table `registry`
--

INSERT INTO `registry` (`name`, `state`, `directory`, `id`, `sql_run`, `unpackaged`, `date`, `priority`, `category`, `nickname`) VALUES
('New Encounter Form', 1, 'newpatient', 1, 1, 1, '2003-09-14 15:16:45', 0, 'Administrative', ''),
('Speech Dictation', 1, 'dictation', 10, 1, 1, '2003-09-14 15:16:45', 0, 'Clinical', ''),
('Vitals', 1, 'vitals', 12, 1, 1, '2005-03-03 00:16:34', 0, 'Clinical', ''),
('Fee Sheet', 1, 'fee_sheet', 14, 1, 1, '2007-07-28 00:00:00', 0, 'Add Codes', ''),
('Misc Billing Options HCFA', 1, 'misc_billing_options', 15, 1, 1, '2007-07-28 00:00:00', 0, 'Administrative', ''),
('Oncology Quality Reporting', 0, 'pqrs_form_oncology', 21, 1, 1, '2017-02-13 20:08:04', 0, 'PQRS Groups 2', 'Oncology'),
('Chronic Kidney Disease Quality Reporting', 0, 'pqrs_form_chronic_kidney_disease', 22, 1, 1, '2017-02-13 20:07:09', 0, 'PQRS Groups 2', 'CKD'),
('Sinusitis Quality Reporting', 0, 'pqrs_form_sinusitis', 23, 1, 1, '2017-02-13 20:07:36', 0, 'PQRS Groups 2', 'Sinusitis'),
('Rheumatoid Arthritis Quality Reporting', 0, 'pqrs_form_rheumatoid_arthritis', 24, 1, 1, '2017-02-13 20:08:19', 0, 'PQRS Groups 2', 'Rheum. Arth.'),
('HIV_AIDS Quality Reporting', 0, 'pqrs_form_hiv_aids', 25, 1, 1, '2017-02-13 20:07:54', 0, 'PQRS Groups 2', 'HIV'),
('Diabetes Quality Reporting', 0, 'pqrs_form_diabetes', 26, 1, 1, '2017-02-13 20:06:57', 0, 'PQRS Groups 1', 'Diabetes'),
('Heart Failure Quality Reporting', 0, 'pqrs_form_heart_failure', 27, 1, 1, '2017-02-13 20:07:04', 0, 'PQRS Groups 1', 'HF'),
('Dementia Quality Reporting', 0, 'pqrs_form_dementia', 28, 1, 1, '2017-02-13 20:06:55', 0, 'PQRS Groups 1', 'Dementia'),
('Coronary Artery Disease Quality Reporting', 0, 'pqrs_form_coronary_artery_disease', 29, 1, 1, '2017-02-13 20:06:54', 0, 'PQRS Groups 1', 'CAD'),
('Preventive Care Quality Reporting', 0, 'pqrs_form_preventive_care', 30, 1, 1, '2017-02-13 20:08:22', 0, 'PQRS Groups 2', 'Preventive'),
('Hepatitis C Quality Reporting', 0, 'pqrs_form_hepatitis_c', 31, 1, 1, '2017-02-13 20:07:44', 0, 'PQRS Groups 2', 'Hep C'),
('Coronary Artery Bypass Graft Quality Reporting', 0, 'pqrs_form_coronary_artery_bypass_graft', 32, 1, 1, '2017-02-13 20:06:51', 0, 'PQRS Groups 1', 'CAB'),
('Cardiovascular Prevention Quality Reporting', 0, 'pqrs_form_cardiovascular_prevention', 33, 1, 1, '2017-02-13 20:07:40', 0, 'PQRS Groups 1', 'CP'),
('Inflammatory Bowel Disease Quality Reporting', 0, 'pqrs_form_inflammatory_bowel_disease', 34, 1, 1, '2017-02-13 20:07:49', 0, 'PQRS Groups 2', 'IBD'),
('Cataracts Quality Reporting', 0, 'pqrs_form_cataracts', 35, 1, 1, '2017-02-13 20:07:17', 0, 'PQRS Groups 2', 'Cataracts'),
('General Surgery Quality Reporting', 0, 'pqrs_form_general_surgery', 36, 1, 1, '2017-02-13 20:07:00', 0, 'PQRS Groups 1', 'Surgery'),
('Multiple Chronic Conditions Quality Reporting', 0, 'pqrs_form_multiple_chronic_conditions', 37, 1, 1, '2017-02-13 20:07:57', 0, 'PQRS Groups 2', 'MCC'),
('Total Knee Replacement Quality Reporting', 0, 'pqrs_form_total_knee_replacement', 38, 1, 1, '2017-02-13 20:07:23', 0, 'PQRS Groups 2', 'TKR'),
('Parkinsons Quality Reporting', 0, 'pqrs_form_parkinsons', 39, 1, 1, '2017-02-13 20:08:16', 0, 'PQRS Groups 2', 'Parkinsons'),
('Acute Otitis Externa Quality Reporting', 0, 'pqrs_form_acute_otitis_externa', 40, 1, 1, '2017-02-13 20:06:44', 0, 'PQRS Groups1', 'AOE'),
('Chronic Obstructive Pulmonary Disease Quality Reporting', 0, 'pqrs_form_chronic_obstructive_pulmonary_disease', 41, 1, 1, '2017-02-13 20:06:48', 0, 'PQRS Groups 1', 'COPD'),
('OPEIR Quality Reporting', 0, 'pqrs_form_opeir', 42, 1, 1, '2017-02-13 20:08:08', 0, 'PQRS Groups 2', 'OPEIR'),
('Asthma Quality Reporting', 0, 'pqrs_form_asthma', 43, 1, 1, '2017-02-13 20:06:46', 0, 'PQRS Groups 1', 'Asthma'),
('Diabetic Retinopathy Quality Reporting', 0, 'pqrs_form_diabetic_retinopathy', 44, 1, 1, '2017-02-13 20:06:58', 0, 'PQRS Groups 1', 'DR'),
('Sleep Apnea Quality Reporting', 0, 'pqrs_form_sleep_apnea', 45, 1, 1, '2017-02-13 20:07:31', 0, 'PQRS Groups 2', 'Apnea');



-- --------------------------------------------------------

--
-- Table structure for table `report_itemized`
-- (goal is optimize insert performance, so only one key)

DROP TABLE IF EXISTS `report_itemized`;
CREATE TABLE `report_itemized` (
  `report_id` bigint(20) NOT NULL,
  `itemized_test_id` smallint(6) NOT NULL,
  `numerator_label` varchar(25) NOT NULL DEFAULT '' COMMENT 'Only used in special cases',
  `pass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is fail, 1 is pass, 2 is excluded,9 is off',
  `pid` bigint(20) NOT NULL,
  KEY (`report_id`,`itemized_test_id`,`numerator_label`,`pass`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `report_results`
--

DROP TABLE IF EXISTS `report_results`;
CREATE TABLE `report_results` (
  `report_id` bigint(20) NOT NULL,
  `field_id` varchar(31) NOT NULL default '',
  `field_value` longtext,
  PRIMARY KEY (`report_id`,`field_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `rule_action`
--

DROP TABLE IF EXISTS `rule_action`;
CREATE TABLE `rule_action` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `group_id` bigint(20) NOT NULL DEFAULT 1 COMMENT 'Contains group id to identify collection of targets in a rule',
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table',
  KEY  (`id`)
) ENGINE=MyISAM ;

--
-- Standard clinical rule actions
--
INSERT INTO `rule_action` ( `id`, `group_id`, `category`, `item` ) VALUES ('rule_htn_bp_measure', 1, 'act_cat_measure', 'act_bp');


-- --------------------------------------------------------

--
-- Table structure for table `rule_action_item`
--

DROP TABLE IF EXISTS `rule_action_item`;
CREATE TABLE `rule_action_item` (
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_action_category',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_action',
  `clin_rem_link` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom html link in clinical reminder widget',
  `reminder_message` TEXT COMMENT 'Custom message in patient reminder',
  `custom_flag` tinyint(1) NOT NULL default 0 COMMENT '1 indexed to rule_patient_data, 0 indexed within main schema',
  PRIMARY KEY  (`category`,`item`)
) ENGINE=InnoDB ;

INSERT INTO `rule_action_item` ( `category`, `item`, `clin_rem_link`, `reminder_message`, `custom_flag` ) VALUES ('act_cat_measure', 'act_bp', '', '', 0);


-- --------------------------------------------------------

--
-- Table structure for table `rule_filter`
--

DROP TABLE IF EXISTS `rule_filter`;
CREATE TABLE `rule_filter` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `include_flag` tinyint(1) NOT NULL default 0 COMMENT '0 is exclude and 1 is include',
  `required_flag` tinyint(1) NOT NULL default 0 COMMENT '0 is required and 1 is optional',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_filters',
  `method_detail` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options lists rule__intervals',
  `value` varchar(255) NOT NULL DEFAULT '',
  KEY  (`id`)
) ENGINE=InnoDB ;

--
-- Standard clinical rule filters
--
-- Hypertension: Blood Pressure Measurement
INSERT INTO `rule_filter` ( `id`, `include_flag`, `required_flag`, `method`, `method_detail`, `value` ) VALUES ('rule_htn_bp_measure', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::HTN');



-- --------------------------------------------------------

--
-- Table structure for table `rule_patient_data`
--

DROP TABLE IF EXISTS `rule_patient_data`;
CREATE TABLE `rule_patient_data` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL,
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table',
  `complete` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list yesno',
  `result` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY (`pid`),
  KEY (`category`,`item`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


--
-- Table structure for table `rule_reminder`
--

DROP TABLE IF EXISTS `rule_reminder`;
CREATE TABLE `rule_reminder` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_methods',
  `method_detail` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_intervals',
  `value` varchar(255) NOT NULL DEFAULT '',
  KEY  (`id`)
) ENGINE=InnoDB ;

-- Hypertension: Blood Pressure Measurement
INSERT INTO `rule_reminder` ( `id`, `method`, `method_detail`, `value` ) VALUES ('rule_htn_bp_measure', 'clinical_reminder_pre', 'week', '2');


--
-- Table structure for table `rule_target`
--

DROP TABLE IF EXISTS `rule_target`;
CREATE TABLE `rule_target` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `group_id` bigint(20) NOT NULL DEFAULT 1 COMMENT 'Contains group id to identify collection of targets in a rule',
  `include_flag` tinyint(1) NOT NULL default 0 COMMENT '0 is exclude and 1 is include',
  `required_flag` tinyint(1) NOT NULL default 0 COMMENT '0 is required and 1 is optional',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_targets', 
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT 'Data is dependent on the method',
  `interval` bigint(20) NOT NULL DEFAULT 0 COMMENT 'Only used in interval entries', 
  KEY  (`id`)
) ENGINE=InnoDB ;

--
-- Standard clinical rule targets
--
-- Hypertension: Blood Pressure Measurement
INSERT INTO `rule_target` ( `id`, `group_id`, `include_flag`, `required_flag`, `method`, `value`, `interval` ) VALUES ('rule_htn_bp_measure', 1, 1, 1, 'target_interval', 'year', 1);


-- 
-- Table structure for table `sequences`
-- 

DROP TABLE IF EXISTS `sequences`;
CREATE TABLE `sequences` (
  `id` int(11) unsigned NOT NULL default '0'
) ENGINE=InnoDB;

-- 
-- Dumping data for table `sequences`
-- 

INSERT INTO `sequences` VALUES (1);


--
-- Table structure for table `supported_external_dataloads`
--

DROP TABLE IF EXISTS `supported_external_dataloads`;
CREATE TABLE `supported_external_dataloads` (
  `load_id` SERIAL,
  `load_type` varchar(24) NOT NULL DEFAULT '',
  `load_source` varchar(24) NOT NULL DEFAULT 'CMS',
  `load_release_date` date NOT NULL,
  `load_filename` varchar(256) NOT NULL DEFAULT '',
  `load_checksum` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB;

--
-- Dumping data for table `supported_external_dataloads`
--

INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2011-10-01', '2012_PCS_long_and_abbreviated_titles.zip', '201a732b649d8c7fba807cc4c083a71a');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2011-10-01', 'DiagnosisGEMs_2012.zip', '6758c4a3384c47161ce24f13a2464b53');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2011-10-01', 'ICD10OrderFiles_2012.zip', 'a76601df7a9f5270d8229828a833f6a1');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2011-10-01', 'ProcedureGEMs_2012.zip', 'f37416d8fab6cd2700b634ca5025295d');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2011-10-01', 'ReimbursementMapping_2012.zip', '8b438d1fd1f34a9bb0e423c15e89744b');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', '2013_PCS_long_and_abbreviated_titles.zip', '04458ed0631c2c122624ee0a4ca1c475');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', '2013-DiagnosisGEMs.zip', '773aac2a675d6aefd1d7dd149883be51');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', 'ICD10CMOrderFiles_2013.zip', '1c175a858f833485ef8f9d3e66b4d8bd');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', 'ProcedureGEMs_2013.zip', '92aa7640e5ce29b9629728f7d4fc81db');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', '2013-ReimbursementMapping_dx.zip', '0d5d36e3f4519bbba08a9508576787fb');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2012-10-01', 'ReimbursementMapping_pr_2013.zip', '4c3920fedbcd9f6af54a1dc9069a11ca');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', '2014-Reimbursement-Mappings-PR.zip', 'f306a0e8c9edb34d28fd6ce8af82b646');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', '2014-Reimbursement-Mappings-DX.zip', '614b3957304208e3ef7d3ba8b3618888');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', 'ProcedureGEMs-2014.zip', 'be46de29f4f40f97315d04821273acf9');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', '2014-ICD10-Code-Descriptions.zip', '5458b95f6f37228b5cdfa03aefc6c8bb');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', 'DiagnosisGEMs-2014.zip', '3ed7b7c5a11c766102b12d97d777a11b');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
('ICD10', 'CMS', '2013-10-01', '2014-PCS-long-and-abbreviated-titles.zip', '2d03514a0c66d92cf022a0bc28c83d38');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD9', 'CMS', '2014-10-01', 'ICD-9-CM-v32-master-descriptions.zip', 'b852b85f770c83433201dc8ae2c59074');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', '2015-PCS-long-and-abbreviated-titles.zip', 'd1504d6cbc40e008e52dbc50600a4b66');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', 'DiagnosisGEMs_2015.zip', 'a4505805edf25ba4eacda07f23934e63');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', '2015-code-descriptions.zip', '6a8c0ab630d5afa7482daa417950846a');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', 'ProcedureGEMs_2015.zip', 'fcba4e4c96851f4c900345bc557483e2');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', 'Reimbursement_Mapping_dx_2015.zip', '0990d5bcac13ccf5e288249be5261fd7');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2014-10-01', 'Reimbursement_Mapping_pr_2015.zip', '493c022db17a70fcdcbb41bf0ad61a47');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', '2016-PCS-Long-Abbrev-Titles.zip', 'd5ea519d0257db0ed7deb0406a4d0503');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', '2016-General-Equivalence-Mappings.zip', '3324a45b6040be7e48ab770a0d3ca695');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', '2016-Code-Descriptions-in-Tabular-Order.zip', '518a47fe9e268e4fb72fecf633d15f17');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', '2016-ProcedureGEMs.zip', '45a8d9da18d8aed57f0c6ea91e3e8fe4');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', 'Reimbursement_Mapping_dx_2016.zip', '1b53b512e10c1fdf7ae4cfd1baa8dfbb');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2015-10-01', 'Reimbursement_Mapping_pr_2016.zip', '3c780dd103d116aa57980decfddd4f19');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2016-10-01', '2017-PCS-Long-Abbrev-Titles.zip', '4669c47f6a9ca34bf4c14d7f93b37993');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2016-10-01', '2017-GEM-DC.zip', '5a0affdc77a152e6971781233ee969c1');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2016-10-01', '2017-ICD10-Code-Descriptions.zip', 'ed9c159cb4ac4ae4f145062e15f83291');
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES 
('ICD10', 'CMS', '2016-10-01', '2017-GEM-PCS.zip', 'a4e08b08fb9a53c81385867c82aa8a9e');

-- 
-- Table structure for table `transactions`
-- 

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id`                      bigint(20)   NOT NULL auto_increment,
  `date`                    datetime     default NULL,
  `title`                   varchar(255) NOT NULL DEFAULT '',
  `pid`                     bigint(20)   default NULL,
  `user`                    varchar(255) NOT NULL DEFAULT '',
  `groupname`               varchar(255) NOT NULL DEFAULT '',
  `authorized`              tinyint(4)   default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(255) default NULL,
  `password` longtext,
  `authorized` tinyint(4) default NULL,
  `info` longtext,
  `source` tinyint(4) default NULL,
  `fname` varchar(255) default NULL,
  `mname` varchar(255) default NULL,
  `lname` varchar(255) default NULL,
  `federaltaxid` varchar(255) default NULL,
  `federaldrugid` varchar(255) default NULL,
  `upin` varchar(255) default NULL,
  `facility` varchar(255) default NULL,
  `facility_id` int(11) NOT NULL default '0',
  `see_auth` int(11) NOT NULL default '1',
  `active` tinyint(1) NOT NULL default '1',
  `npi` varchar(15) default NULL,
  `title` varchar(30) default NULL,
  `specialty` varchar(255) default NULL,
  `billname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `email_direct` varchar(255) NOT NULL default '',
  `url` varchar(255) default NULL,
  `assistant` varchar(255) default NULL,
  `organization` varchar(255) default NULL,
  `valedictory` varchar(255) default NULL,
  `street` varchar(60) default NULL,
  `streetb` varchar(60) default NULL,
  `city` varchar(30) default NULL,
  `state` varchar(30) default NULL,
  `zip` varchar(20) default NULL,
  `street2` varchar(60) default NULL,
  `streetb2` varchar(60) default NULL,
  `city2` varchar(30) default NULL,
  `state2` varchar(30) default NULL,
  `zip2` varchar(20) default NULL,
  `phone` varchar(30) default NULL,
  `fax` varchar(30) default NULL,
  `phonew1` varchar(30) default NULL,
  `phonew2` varchar(30) default NULL,
  `phonecell` varchar(30) default NULL,
  `notes` text,
  `cal_ui` tinyint(4) NOT NULL default '1',
  `taxonomy` varchar(30) NOT NULL DEFAULT '207Q00000X',
  `calendar` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = appears in calendar',
  `abook_type` varchar(31) NOT NULL DEFAULT '',
  `pwd_expiration_date` date default NULL,
  `pwd_history1` longtext,
  `pwd_history2` longtext,
  `default_warehouse` varchar(31) NOT NULL DEFAULT '',
  `irnpool` varchar(31) NOT NULL DEFAULT '',
  `state_license_number` VARCHAR(25) DEFAULT NULL,
  `newcrop_user_role` VARCHAR(30) DEFAULT NULL,
  `cpoe` tinyint(1) NULL DEFAULT NULL,
  `physician_type` VARCHAR(50) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--
-- NOTE THIS IS DONE AFTER INSTALLATION WHERE THE sql/official_additional_users.sql script is called durig setup
--  (so these inserts can be found in the sql/official_additional_users.sql script)



--
-- Table structure for table `user_secure`
--
DROP TABLE IF EXISTS `users_secure`;
CREATE TABLE `users_secure` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255),
  `salt` varchar(255),
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password_history1` varchar(255),
  `salt_history1` varchar(255),
  `password_history2` varchar(255),
  `salt_history2` varchar(255),
  PRIMARY KEY (`id`),
  UNIQUE KEY `USERNAME_ID` (`id`,`username`)
) ENGINE=InnoDB;


--
-- Table structure for table `user_settings`
--
DROP TABLE IF EXISTS `user_settings`;
CREATE TABLE `user_settings` (
  `setting_user`  bigint(20)   NOT NULL DEFAULT 0,
  `setting_label` varchar(63)  NOT NULL,
  `setting_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`setting_user`, `setting_label`)
) ENGINE=InnoDB;

--
-- Dumping data for table `user_settings`
--

INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'allergy_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'appointments_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'billing_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'clinical_reminders_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'demographics_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'dental_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'directives_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'disclosures_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'immunizations_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'insurance_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'medical_problem_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'medication_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'patient_reminders_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'pnotes_ps_expand', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'prescriptions_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'surgery_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'vitals_ps_expand', '1');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (0, 'gacl_protect', '0');
INSERT INTO user_settings ( setting_user, setting_label, setting_value ) VALUES (1, 'gacl_protect', '1');


-- 
-- Table structure for table `x12_partners`
-- 

DROP TABLE IF EXISTS `x12_partners`;
CREATE TABLE `x12_partners` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `id_number` varchar(255) default NULL,
  `x12_sender_id` varchar(255) default NULL,
  `x12_receiver_id` varchar(255) default NULL,
  `x12_version` varchar(255) default NULL,
  `processing_format` enum('standard','medi-cal','cms','proxymed') default NULL,
  `x12_isa01` VARCHAR( 2 ) NOT NULL DEFAULT '00' COMMENT 'User logon Required Indicator',
  `x12_isa02` VARCHAR( 10 ) NOT NULL DEFAULT '          ' COMMENT 'User Logon',
  `x12_isa03` VARCHAR( 2 ) NOT NULL DEFAULT '00' COMMENT 'User password required Indicator',
  `x12_isa04` VARCHAR( 10 ) NOT NULL DEFAULT '          ' COMMENT 'User Password',
  `x12_isa05` char(2)     NOT NULL DEFAULT 'ZZ',
  `x12_isa07` char(2)     NOT NULL DEFAULT 'ZZ',
  `x12_isa14` char(1)     NOT NULL DEFAULT '0',
  `x12_isa15` char(1)     NOT NULL DEFAULT 'P',
  `x12_gs02`  varchar(15) NOT NULL DEFAULT '',
  `x12_per06` varchar(80) NOT NULL DEFAULT '',
  `x12_gs03`  varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB;

-- -----------------------------------------------------------------------------------
-- Table structure for table `automatic_notification`
-- 

DROP TABLE IF EXISTS `automatic_notification`;
CREATE TABLE `automatic_notification` (
  `notification_id` int(5) NOT NULL auto_increment,
  `sms_gateway_type` varchar(255) NOT NULL,
  `next_app_date` date NOT NULL,
  `next_app_time` varchar(10) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `message` text,
  `email_sender` varchar(100) NOT NULL,
  `email_subject` varchar(100) NOT NULL,
  `type` enum('SMS','Email') NOT NULL default 'SMS',
  `notification_sent_date` datetime NOT NULL,
  PRIMARY KEY  (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `automatic_notification`
-- 

INSERT INTO `automatic_notification` (`notification_id`, `sms_gateway_type`, `next_app_date`, `next_app_time`, `provider_name`, `message`, `email_sender`, `email_subject`, `type`, `notification_sent_date`) VALUES (1, 'CLICKATELL', '0000-00-00', ':', 'EMR GROUP 1 .. SMS', 'Welcome to EMR GROUP 1.. SMS', '', '', 'SMS', '0000-00-00 00:00:00'),
(2, '', '2007-10-02', '05:50', 'EMR GROUP', 'Welcome to EMR GROUP . Email', 'EMR Group', 'Welcome to EMR GROUP', 'Email', '2007-09-30 00:00:00');


-- 
-- Table structure for table `notification_log`
-- 

DROP TABLE IF EXISTS `notification_log`;
CREATE TABLE `notification_log` (
  `iLogId` int(11) NOT NULL auto_increment,
  `pid` int(7) NOT NULL,
  `pc_eid` int(11) unsigned NULL,
  `sms_gateway_type` varchar(50) NOT NULL,
  `smsgateway_info` varchar(255) NOT NULL,
  `message` text,
  `email_sender` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `type` enum('SMS','Email') NOT NULL,
  `patient_info` text,
  `pc_eventDate` date NOT NULL,
  `pc_endDate` date NOT NULL,
  `pc_startTime` time NOT NULL,
  `pc_endTime` time NOT NULL,
  `dSentDateTime` datetime NOT NULL,
  PRIMARY KEY  (`iLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;


-- 
-- Table structure for table `notification_settings`
-- 

DROP TABLE IF EXISTS `notification_settings`;
CREATE TABLE `notification_settings` (
  `SettingsId` int(3) NOT NULL auto_increment,
  `Send_SMS_Before_Hours` int(3) NOT NULL,
  `Send_Email_Before_Hours` int(3) NOT NULL,
  `SMS_gateway_username` varchar(100) NOT NULL,
  `SMS_gateway_password` varchar(100) NOT NULL,
  `SMS_gateway_apikey` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY  (`SettingsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `notification_settings`
-- 

INSERT INTO `notification_settings` (`SettingsId`, `Send_SMS_Before_Hours`, `Send_Email_Before_Hours`, `SMS_gateway_username`, `SMS_gateway_password`, `SMS_gateway_apikey`, `type`) VALUES (1, 150, 150, 'sms username', 'sms password', 'sms api key', 'SMS/Email Settings');

-- -------------------------------------------------------------------
DROP TABLE IF EXISTS `chart_tracker`;
CREATE TABLE `chart_tracker` (
  `ct_pid`            int(11)       NOT NULL,
  `ct_when`           datetime      NOT NULL,
  `ct_userid`         bigint(20)    NOT NULL DEFAULT 0,
  `ct_location`       varchar(31)   NOT NULL DEFAULT '',
  PRIMARY KEY (ct_pid, ct_when)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `ar_session`;
CREATE TABLE `ar_session` (
  `session_id`     int unsigned  NOT NULL AUTO_INCREMENT,
  `payer_id`       int(11)       NOT NULL            COMMENT '0=pt else references insurance_companies.id',
  `user_id`        int(11)       NOT NULL            COMMENT 'references users.id for session owner',
  `closed`         tinyint(1)    NOT NULL DEFAULT 0  COMMENT '0=no, 1=yes',
  `reference`      varchar(255)  NOT NULL DEFAULT '' COMMENT 'check or EOB number',
  `check_date`     date          DEFAULT NULL,
  `deposit_date`   date          DEFAULT NULL,
  `pay_total`      decimal(12,2) NOT NULL DEFAULT 0,
  `created_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `modified_time` datetime NOT NULL,
  `global_amount` decimal( 12, 2 ) NOT NULL ,
  `payment_type` varchar( 50 ) NOT NULL ,
  `description` text,
  `adjustment_code` varchar( 50 ) NOT NULL ,
  `post_to_date` date NOT NULL ,
  `patient_id` int( 11 ) NOT NULL ,
  `payment_method` varchar( 25 ) NOT NULL,
  PRIMARY KEY (session_id),
  KEY user_closed (user_id, closed),
  KEY deposit_date (deposit_date)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `ar_activity`;
CREATE TABLE `ar_activity` (
  `pid`            int(11)       NOT NULL,
  `encounter`      int(11)       NOT NULL,
  `sequence_no`    int unsigned  NOT NULL AUTO_INCREMENT,
  `code_type`    varchar(12)   NOT NULL DEFAULT '',
  `code`           varchar(20)   NOT NULL            COMMENT 'empty means claim level',
  `modifier`       varchar(12)   NOT NULL DEFAULT '',
  `payer_type`     int           NOT NULL            COMMENT '0=pt, 1=ins1, 2=ins2, etc',
  `post_time`      datetime      NOT NULL,
  `post_user`      int(11)       NOT NULL            COMMENT 'references users.id',
  `session_id`     int unsigned  NOT NULL            COMMENT 'references ar_session.session_id',
  `memo`           varchar(255)  NOT NULL DEFAULT '' COMMENT 'adjustment reasons go here',
  `pay_amount`     decimal(12,2) NOT NULL DEFAULT 0  COMMENT 'either pay or adj will always be 0',
  `adj_amount`     decimal(12,2) NOT NULL DEFAULT 0,
  `modified_time` datetime NOT NULL,
  `follow_up` char(1) NOT NULL,
  `follow_up_note` text,
  `account_code` varchar(15) NOT NULL,
  `reason_code` varchar(255) DEFAULT NULL COMMENT 'Use as needed to show the primary payer adjustment reason code',
  PRIMARY KEY (sequence_no, pid, encounter),
  KEY session_id (session_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `users_facility`;
CREATE TABLE `users_facility` (
  `tablename` varchar(64) NOT NULL,
  `table_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  PRIMARY KEY (`tablename`,`table_id`,`facility_id`)
) ENGINE=InnoDB COMMENT='joins users or patient_data to facility table';

DROP TABLE IF EXISTS `lbf_data`;
CREATE TABLE `lbf_data` (
  `form_id`     int(11)      NOT NULL AUTO_INCREMENT COMMENT 'references forms.form_id',
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=InnoDB COMMENT='contains all data from layout-based forms';

DROP TABLE IF EXISTS `lbt_data`;
CREATE TABLE `lbt_data` (
  `form_id`     bigint(20)   NOT NULL COMMENT 'references transactions.id',
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=InnoDB COMMENT='contains all data from layout-based transactions';

DROP TABLE IF EXISTS `gprelations`;
CREATE TABLE `gprelations` (
  `type1` int(2)     NOT NULL,
  `id1`   bigint(20) NOT NULL,
  `type2` int(2)     NOT NULL,
  `id2`   bigint(20) NOT NULL,
  PRIMARY KEY (type1,id1,type2,id2),
  KEY key2  (type2,id2)
) ENGINE=InnoDB COMMENT='general purpose relations';

DROP TABLE IF EXISTS `procedure_providers`;
CREATE TABLE `procedure_providers` (
  `ppid`         bigint(20)   NOT NULL auto_increment,
  `name`         varchar(255) NOT NULL DEFAULT '',
  `npi`          varchar(15)  NOT NULL DEFAULT '',
  `send_app_id`  varchar(255) NOT NULL DEFAULT ''  COMMENT 'Sending application ID (MSH-3.1)',
  `send_fac_id`  varchar(255) NOT NULL DEFAULT ''  COMMENT 'Sending facility ID (MSH-4.1)',
  `recv_app_id`  varchar(255) NOT NULL DEFAULT ''  COMMENT 'Receiving application ID (MSH-5.1)',
  `recv_fac_id`  varchar(255) NOT NULL DEFAULT ''  COMMENT 'Receiving facility ID (MSH-6.1)',
  `DorP`         char(1)      NOT NULL DEFAULT 'D' COMMENT 'Debugging or Production (MSH-11)',
  `direction`    char(1)      NOT NULL DEFAULT 'B' COMMENT 'Bidirectional or Results-only',
  `protocol`     varchar(15)  NOT NULL DEFAULT 'DL',
  `remote_host`  varchar(255) NOT NULL DEFAULT '',
  `login`        varchar(255) NOT NULL DEFAULT '',
  `password`     varchar(255) NOT NULL DEFAULT '',
  `orders_path`  varchar(255) NOT NULL DEFAULT '',
  `results_path` varchar(255) NOT NULL DEFAULT '',
  `notes`        text,
  `lab_director` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ppid`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_type`;
CREATE TABLE `procedure_type` (
  `procedure_type_id`   bigint(20)   NOT NULL AUTO_INCREMENT,
  `parent`              bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references procedure_type.procedure_type_id',
  `name`                varchar(63)  NOT NULL DEFAULT '' COMMENT 'name for this category, procedure or result type',
  `lab_id`              bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references procedure_providers.ppid, 0 means default to parent',
  `procedure_code`      varchar(31)  NOT NULL DEFAULT '' COMMENT 'code identifying this procedure',
  `procedure_type`      varchar(31)  NOT NULL DEFAULT '' COMMENT 'see list proc_type',
  `body_site`           varchar(31)  NOT NULL DEFAULT '' COMMENT 'where to do injection, e.g. arm, buttok',
  `specimen`            varchar(31)  NOT NULL DEFAULT '' COMMENT 'blood, urine, saliva, etc.',
  `route_admin`         varchar(31)  NOT NULL DEFAULT '' COMMENT 'oral, injection',
  `laterality`          varchar(31)  NOT NULL DEFAULT '' COMMENT 'left, right, ...',
  `description`         varchar(255) NOT NULL DEFAULT '' COMMENT 'descriptive text for procedure_code',
  `standard_code`       varchar(255) NOT NULL DEFAULT '' COMMENT 'industry standard code type and code (e.g. CPT4:12345)',
  `related_code`        varchar(255) NOT NULL DEFAULT '' COMMENT 'suggested code(s) for followup services if result is abnormal',
  `units`               varchar(31)  NOT NULL DEFAULT '' COMMENT 'default for procedure_result.units',
  `range`               varchar(255) NOT NULL DEFAULT '' COMMENT 'default for procedure_result.range',
  `seq`                 int(11)      NOT NULL default 0  COMMENT 'sequence number for ordering',
  `activity`            tinyint(1)   NOT NULL default 1  COMMENT '1=active, 0=inactive',
  `notes`               varchar(255) NOT NULL default '' COMMENT 'additional notes to enhance description',
  PRIMARY KEY (`procedure_type_id`),
  KEY parent (parent)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_questions`;
CREATE TABLE `procedure_questions` (
  `lab_id`              bigint(20)   NOT NULL DEFAULT 0   COMMENT 'references procedure_providers.ppid to identify the lab',
  `procedure_code`      varchar(31)  NOT NULL DEFAULT ''  COMMENT 'references procedure_type.procedure_code to identify this order type',
  `question_code`       varchar(31)  NOT NULL DEFAULT ''  COMMENT 'code identifying this question',
  `seq`                 int(11)      NOT NULL default 0   COMMENT 'sequence number for ordering',
  `question_text`       varchar(255) NOT NULL DEFAULT ''  COMMENT 'descriptive text for question_code',
  `required`            tinyint(1)   NOT NULL DEFAULT 0   COMMENT '1 = required, 0 = not',
  `maxsize`             int          NOT NULL DEFAULT 0   COMMENT 'maximum length if text input field',
  `fldtype`             char(1)      NOT NULL DEFAULT 'T' COMMENT 'Text, Number, Select, Multiselect, Date, Gestational-age',
  `options`             text                              COMMENT 'choices for fldtype S and T',
  `tips`                varchar(255) NOT NULL DEFAULT ''  COMMENT 'Additional instructions for answering the question',
  `activity`            tinyint(1)   NOT NULL DEFAULT 1   COMMENT '1 = active, 0 = inactive',
  PRIMARY KEY (`lab_id`, `procedure_code`, `question_code`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_order`;
CREATE TABLE `procedure_order` (
  `procedure_order_id`     bigint(20)   NOT NULL AUTO_INCREMENT,
  `provider_id`            bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references users.id, the ordering provider',
  `patient_id`             bigint(20)   NOT NULL            COMMENT 'references patient_data.pid',
  `encounter_id`           bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references form_encounter.encounter',
  `date_collected`         datetime     DEFAULT NULL        COMMENT 'time specimen collected',
  `date_ordered`           date         DEFAULT NULL,
  `order_priority`         varchar(31)  NOT NULL DEFAULT '',
  `order_status`           varchar(31)  NOT NULL DEFAULT '' COMMENT 'pending,routed,complete,canceled',
  `patient_instructions`   text,
  `activity`               tinyint(1)   NOT NULL DEFAULT 1  COMMENT '0 if deleted',
  `control_id`             varchar(255) NOT NULL DEFAULT '' COMMENT 'This is the CONTROL ID that is sent back from lab',
  `lab_id`                 bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references procedure_providers.ppid',
  `specimen_type`          varchar(31)  NOT NULL DEFAULT '' COMMENT 'from the Specimen_Type list',
  `specimen_location`      varchar(31)  NOT NULL DEFAULT '' COMMENT 'from the Specimen_Location list',
  `specimen_volume`        varchar(30)  NOT NULL DEFAULT '' COMMENT 'from a text input field',
  `date_transmitted`       datetime     DEFAULT NULL        COMMENT 'time of order transmission, null if unsent',
  `clinical_hx`            varchar(255) NOT NULL DEFAULT '' COMMENT 'clinical history text that may be relevant to the order',
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`procedure_order_id`),
  KEY datepid (date_ordered, patient_id),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_order_code`;
CREATE TABLE `procedure_order_code` (
  `procedure_order_id`  bigint(20)  NOT NULL                COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)     NOT NULL AUTO_INCREMENT COMMENT 'supports multiple tests per order',
  `procedure_code`      varchar(31) NOT NULL DEFAULT ''     COMMENT 'like procedure_type.procedure_code',
  `procedure_name`      varchar(255) NOT NULL DEFAULT ''    COMMENT 'descriptive name of the procedure code',
  `procedure_source`    char(1)     NOT NULL DEFAULT '1'    COMMENT '1=original order, 2=added after order sent',
  `diagnoses`           text                                COMMENT 'diagnoses and maybe other coding (e.g. ICD9:111.11)',
  `do_not_send`         tinyint(1)  NOT NULL DEFAULT '0'    COMMENT '0 = normal, 1 = do not transmit to lab',
  `procedure_order_title` varchar( 255 ) NULL DEFAULT NULL,
  PRIMARY KEY (`procedure_order_seq`,`procedure_order_id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_answers`;
CREATE TABLE `procedure_answers` (
  `procedure_order_id`  bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)      NOT NULL DEFAULT 0  COMMENT 'references procedure_order_code.procedure_order_seq',
  `question_code`       varchar(31)  NOT NULL DEFAULT '' COMMENT 'references procedure_questions.question_code',
  `answer_seq`          int(11)      NOT NULL AUTO_INCREMENT COMMENT 'supports multiple-choice questions',
  `answer`              varchar(255) NOT NULL DEFAULT '' COMMENT 'answer data',
  PRIMARY KEY (`answer_seq`,`procedure_order_id`, `procedure_order_seq`, `question_code`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_report`;
CREATE TABLE `procedure_report` (
  `procedure_report_id` bigint(20)     NOT NULL AUTO_INCREMENT,
  `procedure_order_id`  bigint(20)     DEFAULT NULL   COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)        NOT NULL DEFAULT 1  COMMENT 'references procedure_order_code.procedure_order_seq',
  `date_collected`      datetime       DEFAULT NULL,
  `date_collected_tz`   varchar(5)     DEFAULT ''          COMMENT '+-hhmm offset from UTC',
  `date_report`         datetime       DEFAULT NULL,
  `date_report_tz`      varchar(5)     DEFAULT ''          COMMENT '+-hhmm offset from UTC',
  `source`              bigint(20)     NOT NULL DEFAULT 0  COMMENT 'references users.id, who entered this data',
  `specimen_num`        varchar(63)    NOT NULL DEFAULT '',
  `report_status`       varchar(31)    NOT NULL DEFAULT '' COMMENT 'received,complete,error',
  `review_status`       varchar(31)    NOT NULL DEFAULT 'received' COMMENT 'pending review status: received,reviewed',  
  `report_notes`        text           COMMENT 'notes from the lab',
  PRIMARY KEY (`procedure_report_id`),
  KEY procedure_order_id (procedure_order_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `procedure_result`;
CREATE TABLE `procedure_result` (
  `procedure_result_id` bigint(20)   NOT NULL AUTO_INCREMENT,
  `procedure_report_id` bigint(20)   NOT NULL            COMMENT 'references procedure_report.procedure_report_id',
  `result_data_type`    char(1)      NOT NULL DEFAULT 'S' COMMENT 'N=Numeric, S=String, F=Formatted, E=External, L=Long text as first line of comments',
  `result_code`         varchar(31)  NOT NULL DEFAULT '' COMMENT 'LOINC code, might match a procedure_type.procedure_code',
  `result_text`         varchar(255) NOT NULL DEFAULT '' COMMENT 'Description of result_code',
  `date`                datetime     DEFAULT NULL        COMMENT 'lab-provided date specific to this result',
  `facility`            varchar(255) NOT NULL DEFAULT '' COMMENT 'lab-provided testing facility ID',
  `units`               varchar(31)  NOT NULL DEFAULT '',
  `result`              varchar(255) NOT NULL DEFAULT '',
  `range`               varchar(255) NOT NULL DEFAULT '',
  `abnormal`            varchar(31)  NOT NULL DEFAULT '' COMMENT 'no,yes,high,low',
  `comments`            text                             COMMENT 'comments from the lab',
  `document_id`         bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references documents.id if this result is a document',
  `result_status`       varchar(31)  NOT NULL DEFAULT '' COMMENT 'preliminary, cannot be done, final, corrected, incompete...etc.',
  PRIMARY KEY (`procedure_result_id`),
  KEY procedure_report_id (procedure_report_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `globals`;
CREATE TABLE `globals` (
  `gl_name`             varchar(63)    NOT NULL,
  `gl_index`            int(11)        NOT NULL DEFAULT 0,
  `gl_value`            varchar(255)   NOT NULL DEFAULT '',
  PRIMARY KEY (`gl_name`, `gl_index`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `code_types`;
CREATE TABLE `code_types` (
  `ct_key`      varchar(15) NOT NULL           COMMENT 'short alphanumeric name',
  `ct_id`       int(11)     UNIQUE NOT NULL    COMMENT 'numeric identifier',
  `ct_seq`      int(11)     NOT NULL DEFAULT 0 COMMENT 'sort order',
  `ct_mod`      int(11)     NOT NULL DEFAULT 0 COMMENT 'length of modifier field',
  `ct_just`     varchar(15) NOT NULL DEFAULT ''COMMENT 'ct_key of justify type, if any',
  `ct_mask`     varchar(9)  NOT NULL DEFAULT ''COMMENT 'formatting mask for code values',
  `ct_fee`      tinyint(1)  NOT NULL default 0 COMMENT '1 if fees are used',
  `ct_rel`      tinyint(1)  NOT NULL default 0 COMMENT '1 if can relate to other code types',
  `ct_nofs`     tinyint(1)  NOT NULL default 0 COMMENT '1 if to be hidden in the fee sheet',
  `ct_diag`     tinyint(1)  NOT NULL default 0 COMMENT '1 if this is a diagnosis type',
  `ct_active`   tinyint(1)  NOT NULL default 1 COMMENT '1 if this is active',
  `ct_label`    varchar(31) NOT NULL default '' COMMENT 'label of this code type',
  `ct_external` tinyint(1)  NOT NULL default 0 COMMENT '0 if stored codes in codes tables, 1 or greater if codes stored in external tables',
  `ct_claim`    tinyint(1)  NOT NULL default 0 COMMENT '1 if this is used in claims',
  `ct_proc`     tinyint(1)  NOT NULL default 0 COMMENT '1 if this is a procedure type',
  `ct_term`     tinyint(1)  NOT NULL default 0 COMMENT '1 if this is a clinical term',
  `ct_problem`  tinyint(1)  NOT NULL default 0 COMMENT '1 if this code type is used as a medical problem',
  `ct_drug`     tinyint(1)  NOT NULL default 0 COMMENT '1 if this code type is used as a medication',
  PRIMARY KEY (ct_key)
) ENGINE=InnoDB;

INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('ICD9' , 2, 1, 0, ''    , 0, 0, 0, 1, 1, 'ICD9 Diagnosis', 4, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CPT4' , 1, 2, 12, 'ICD9', 1, 0, 0, 0, 1, 'CPT4 Procedure/Service', 0, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('HCPCS', 3, 3, 12, 'ICD9', 1, 0, 0, 0, 1, 'HCPCS Procedure/Service', 0, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CVX'  , 100, 100, 0, '', 0, 0, 1, 0, 1, 'CVX Immunization', 0, 0, 0, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('DSMIV' , 101, 101, 0, '', 0, 0, 0, 1, 0, 'DSMIV Diagnosis', 0, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('ICD10' , 102, 102, 0, '', 0, 0, 0, 1, 1, 'ICD10 Diagnosis', 1, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('SNOMED' , 103, 103, 0, '', 0, 0, 0, 1, 0, 'SNOMED Diagnosis', 2, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CPTII' , 104, 104, 0, 'ICD9', 0, 0, 0, 0, 0, 'CPTII Performance Measures', 0, 1, 0, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('ICD9-SG' , 105, 105, 12, 'ICD9', 1, 0, 0, 0, 0, 'ICD9 Procedure/Service', 5, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('ICD10-PCS' , 106, 106, 12, 'ICD10', 1, 0, 0, 0, 0, 'ICD10 Procedure/Service', 6, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('SNOMED-CT' , 107, 107, 0, '', 0, 0, 1, 0, 0, 'SNOMED Clinical Term', 7, 0, 0, 1, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('SNOMED-PR' , 108, 108, 0, 'SNOMED', 1, 0, 0, 0, 0, 'SNOMED Procedure', 9, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem, ct_drug ) VALUES ('RXCUI', 109, 109, 0, '', 0, 0, 1, 0, 0, 'RXCUI Medication', 0, 0, 0, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('LOINC', 110, 110, 0, '', 0, 0, 1, 0, 1, 'LOINC', 0, 0, 0, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('PHIN Questions', 111, 111, 0, '', 0, 0, 1, 0, 1, 'PHIN Questions', 0, 0, 0, 0, 0);

INSERT INTO list_options ( list_id, option_id, title, seq ) VALUES ('lists', 'code_types', 'Code Types', 1);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'disclosure_type','Disclosure Type', 3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('disclosure_type', 'disclosure-treatment', 'Treatment', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('disclosure_type', 'disclosure-payment', 'Payment', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('disclosure_type', 'disclosure-healthcareoperations', 'Health Care Operations', 30, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'smoking_status','Smoking Status', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '1', 'Current every day smoker', 10, 0, 'SNOMED-CT:449868002');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '2', 'Current some day smoker', 20, 0, 'SNOMED-CT:428041000124106');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '3', 'Former smoker', 30, 0, 'SNOMED-CT:8517006');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '4', 'Never smoker', 40, 0, 'SNOMED-CT:266919005');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '5', 'Smoker, current status unknown', 50, 0, 'SNOMED-CT:77176002');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '9', 'Unknown if ever smoked', 60, 0, 'SNOMED-CT:266927001');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '15', 'Heavy tobacco smoker', 70, 0, 'SNOMED-CT:428071000124103');
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, codes ) VALUES ('smoking_status', '16', 'Light tobacco smoker', 80, 0, 'SNOMED-CT:428061000124105');

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'race','Race', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, option_value ) VALUES ('race', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0);

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'ethnicity','Ethnicity', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, option_value ) VALUES ('ethnicity', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0);


INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('lists'   ,'payment_date','Payment Date', 1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_date', 'date_val', 'Date', 10, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_date', 'post_to_date', 'Post To Date', 20, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('payment_date', 'deposit_date', 'Deposit Date', 30, 0);
-- --------------------------------------------------------

-- 
-- Table structure for table `extended_log`
--

DROP TABLE IF EXISTS `extended_log`;
CREATE TABLE `extended_log` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `event` varchar(255) default NULL,
  `user` varchar(255) default NULL,
  `recipient` varchar(255) default NULL,
  `description` longtext,
  `patient_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `version`;
CREATE TABLE `version` (
  `v_major`     int(11)     NOT NULL DEFAULT 0,
  `v_minor`     int(11)     NOT NULL DEFAULT 0,
  `v_patch`     int(11)     NOT NULL DEFAULT 0,
  `v_realpatch` int(11)     NOT NULL DEFAULT 0,
  `v_tag`       varchar(31) NOT NULL DEFAULT '',
  `v_database`  int(11)     NOT NULL DEFAULT 0,
  `v_acl`       int(11)     NOT NULL DEFAULT 0
) ENGINE=InnoDB;
INSERT INTO version (v_major, v_minor, v_patch, v_realpatch, v_tag, v_database, v_acl) VALUES (0, 0, 0, 0, '', 0, 0);


DROP TABLE IF EXISTS `product_warehouse`;
CREATE TABLE `product_warehouse` (
  `pw_drug_id`   int(11) NOT NULL,
  `pw_warehouse` varchar(31) NOT NULL,
  `pw_min_level` float       DEFAULT 0,
  `pw_max_level` float       DEFAULT 0,
  PRIMARY KEY  (`pw_drug_id`,`pw_warehouse`)
) ENGINE=InnoDB;

--
-- Table structure for table `misc_address_book`
--

DROP TABLE IF EXISTS `misc_address_book`;
CREATE TABLE `misc_address_book` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `street` varchar(60) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


--
-- Table structure for table `esign_signatures`
--

DROP TABLE IF EXISTS `esign_signatures`;
CREATE TABLE `esign_signatures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT 'Table row ID for signature',
  `table` varchar(255) NOT NULL COMMENT 'table name for the signature',
  `uid` int(11) NOT NULL COMMENT 'user id for the signing user',
  `datetime` datetime NOT NULL COMMENT 'datetime of the signature action',
  `is_lock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sig, lock or amendment',
  `amendment` text COMMENT 'amendment text, if any',
  `hash` varchar(255) NOT NULL COMMENT 'hash of signed data',
  `signature_hash` varchar(255) NOT NULL COMMENT 'hash of signature itself',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `table` (`table`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

-- 
-- Table structure for table `log_comment_encrypt`
-- 

DROP TABLE IF EXISTS `log_comment_encrypt`;
CREATE TABLE IF NOT EXISTS `log_comment_encrypt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL,
  `encrypt` enum('Yes','No') NOT NULL DEFAULT 'No',
  `checksum` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `shared_attributes`;
CREATE TABLE `shared_attributes` (
  `pid`          bigint(20)   NOT NULL,
  `encounter`    bigint(20)   NOT NULL COMMENT '0 if patient attribute, else encounter attribute',
  `field_id`     varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `last_update`  datetime     NOT NULL COMMENT 'time of last update',
  `user_id`      bigint(20)   NOT NULL COMMENT 'user who last updated',
  `field_value`  TEXT,
  PRIMARY KEY (`pid`, `encounter`, `field_id`)
);

--
-- Table structure for table `ccda_components`
--
DROP TABLE IF EXISTS `ccda_components`;
CREATE TABLE `ccda_components` (
  `ccda_components_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccda_components_field` varchar(100) DEFAULT NULL,
  `ccda_components_name` varchar(100) DEFAULT NULL,
  `ccda_type` int(11) NOT NULL COMMENT '0=>sections,1=>components',
  PRIMARY KEY (ccda_components_id)
) ENGINE=InnoDB AUTO_INCREMENT=23 ;
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('1','progress_note','Progress Notes',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('2','consultation_note','Consultation Note',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('3','continuity_care_document','Continuity Care Document',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('4','diagnostic_image_reporting','Diagnostic Image Reporting',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('5','discharge_summary','Discharge Summary',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('6','history_physical_note','History and Physical Note',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('7','operative_note','Operative Note',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('8','procedure_note','Procedure Note',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('9','unstructured_document','Unstructured Document',0);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('10','allergies','Allergies',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('11','medications','Medications',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('12','problems','Problems',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('13','immunizations','Immunizations',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('14','procedures','Procedures',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('15','results','Results',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('16','plan_of_care','Plan Of Care',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('17','vitals','Vitals',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('18','social_history','Social History',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('19','encounters','Encounters',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('20','functional_status','Functional Status',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('21','referral','Reason for Referral',1);
insert into ccda_components (ccda_components_id, ccda_components_field, ccda_components_name, ccda_type) values ('22','instructions','Instructions',1);

--
-- Table structure for table `ccda_sections`
--
DROP TABLE IF EXISTS `ccda_sections`;
CREATE TABLE `ccda_sections` (
  `ccda_sections_id` int(11) NOT NULL AUTO_INCREMENT,
  `ccda_components_id` int(11) DEFAULT NULL,
  `ccda_sections_field` varchar(100) DEFAULT NULL,
  `ccda_sections_name` varchar(100) DEFAULT NULL,
  `ccda_sections_req_mapping` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (ccda_sections_id)
) ENGINE=InnoDB AUTO_INCREMENT=46 ;

insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('1','1','assessment_plan','Assessment and Plan','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('2','2','assessment_plan','Assessment and Plan','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('3','2','history_of_present_illness','History of Present Illness','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('4','2','physical_exam','Physical Exam','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('5','2','reason_of_visit','Reason for Referral/Reason for Visit','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('6','3','allergies','Allergies','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('7','3','medications','Medications','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('8','3','problem_list','Problem List','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('9','3','procedures','Procedures','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('10','3','results','Results','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('11','4','report','Report','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('12','5','allergies','Allergies','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('13','5','hospital_course','Hospital Course','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('14','5','hospital_discharge_diagnosis','Hospital Discharge Diagnosis','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('15','5','hospital_discharge_medications','Hospital Discharge Medications','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('16','5','plan_of_care','Plan of Care','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('17','6','allergies','Allergies','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('19','6','chief_complaint','Chief Complaint / Reason for Visit','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('21','6','family_history','Family History','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('22','6','general_status','General Status','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('23','6','hpi_past_med','History of Past Illness (Past Medical History)','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('24','6','hpi','History of Present Illness','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('25','6','medications','Medications','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('26','6','physical_exam','Physical Exam','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('28','6','results','Results','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('29','6','review_of_systems','Review of Systems','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('30','6','social_history','Social History','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('31','6','vital_signs','Vital Signs','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('32','7','anesthesia','Anesthesia','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('33','7','complications','Complications','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('34','7','post_operative_diagnosis','Post Operative Diagnosis','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('35','7','pre_operative_diagnosis','Pre Operative Diagnosis','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('36','7','procedure_estimated_blood_loss','Procedure Estimated Blood Loss','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('37','7','procedure_findings','Procedure Findings','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('38','7','procedure_specimens_taken','Procedure Specimens Taken','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('39','7','procedure_description','Procedure Description','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('40','8','assessment_plan','Assessment and Plan','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('41','8','complications','Complications','1');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('42','8','postprocedure_diagnosis','Postprocedure Diagnosis','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('43','8','procedure_description','Procedure Description','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('44','8','procedure_indications','Procedure Indications','0');
insert into ccda_sections (ccda_sections_id, ccda_components_id, ccda_sections_field, ccda_sections_name, ccda_sections_req_mapping) values('45','9','unstructured_doc','Document','0');

--
-- Table structure for table `ccda_field_mapping`
--
DROP TABLE IF EXISTS `ccda_field_mapping`;
CREATE TABLE `ccda_field_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) DEFAULT NULL,
  `ccda_field` varchar(100) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `ccda`
--
DROP TABLE IF EXISTS `ccda`;
CREATE TABLE `ccda` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pid` BIGINT(20) DEFAULT NULL,
  `encounter` BIGINT(20) DEFAULT NULL,
  `ccda_data` MEDIUMTEXT,
  `time` VARCHAR(50) DEFAULT NULL,
  `status` SMALLINT(6) DEFAULT NULL,
  `updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` VARCHAR(50) null,
  `couch_docid` VARCHAR(100) NULL,
  `couch_revid` VARCHAR(100) NULL,
  `view` tinyint(4) NOT NULL DEFAULT '0',
  `transfer` tinyint(4) NOT NULL DEFAULT '0',
  `emr_transfer` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY unique_key (pid,encounter,time)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `ccda_table_mapping`
--
DROP TABLE IF EXISTS `ccda_table_mapping`;
CREATE TABLE `ccda_table_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ccda_component` varchar(100) DEFAULT NULL,
  `ccda_component_section` varchar(100) DEFAULT NULL,
  `form_dir` varchar(100) DEFAULT NULL,
  `form_type` smallint(6) DEFAULT NULL,
  `form_table` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

--
-- Table structure for table `external_procedures`
--
DROP TABLE IF EXISTS `external_procedures`;
CREATE TABLE `external_procedures` (
  `ep_id` int(11) NOT NULL AUTO_INCREMENT,
  `ep_date` date DEFAULT NULL,
  `ep_code_type` varchar(20) DEFAULT NULL,
  `ep_code` varchar(9) DEFAULT NULL,
  `ep_pid` int(11) DEFAULT NULL,
  `ep_encounter` int(11) DEFAULT NULL,
  `ep_code_text` longtext,
  `ep_facility_id` varchar(255) DEFAULT NULL,
  `ep_external_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ep_id`)
) ENGINE=InnoDB;

--
-- Table structure for table `external_encounters`
--
DROP TABLE IF EXISTS `external_encounters`;
CREATE TABLE `external_encounters` (
  `ee_id` int(11) NOT NULL AUTO_INCREMENT,
  `ee_date` date DEFAULT NULL,
  `ee_pid` int(11) DEFAULT NULL,
  `ee_provider_id` varchar(255) DEFAULT NULL,
  `ee_facility_id` varchar(255) DEFAULT NULL,
  `ee_encounter_diagnosis` varchar(255) DEFAULT NULL,
  `ee_external_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ee_id`)
) ENGINE=InnoDB;

--
-- Table structure for table `form_care_plan`
--
DROP TABLE IF EXISTS `form_care_plan`;
CREATE TABLE `form_care_plan` (
  `id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `codetext` text,
  `description` text,
  `external_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Table structure for table `form_functional_cognitive_status`
--
DROP TABLE IF EXISTS `form_functional_cognitive_status`;
CREATE TABLE `form_functional_cognitive_status` (
  `id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `codetext` text,
  `description` text,
  `external_id` varchar(30) DEFAULT NULL
) ENGINE=InnoDB;

--
-- Table structure for table `form_observation`
--
DROP TABLE IF EXISTS `form_observation`;
CREATE TABLE `form_observation` (
  `id` bigint(20) NOT NULL,
  `date` DATE DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `ob_value` varchar(255),
  `ob_unit` varchar(255),
  `description` varchar(255),
  `code_type` varchar(255),
  `table_code` varchar(255)
) ENGINE=InnoDB;

--
-- Table structure for table `form_clinical_instructions`
--
DROP TABLE IF EXISTS `form_clinical_instructions`;
CREATE TABLE `form_clinical_instructions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `instruction` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activity` TINYINT DEFAULT 1 NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB;
--
-- Table structure for table `menu_entries`
--

DROP TABLE IF EXISTS `menu_entries`;
CREATE TABLE `menu_entries` (
  `id` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `icon` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `helperText` varchar(50) NOT NULL,
  `target` varchar(45) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `requirement` int(11) DEFAULT NULL,
  `acl_reqs` varchar(255) DEFAULT NULL,
  `global_reqs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_entries`
--

INSERT INTO `menu_entries` (`id`, `label`, `icon`, `class`, `helperText`, `target`, `url`, `requirement`, `acl_reqs`, `global_reqs`) VALUES
('About|/interface/main/about_page.php', 'About', '', '', '', 'msc', '/interface/main/about_page.php', NULL, NULL, NULL),
('ACL|/interface/usergroup/adminacl.php', 'ACL', '', '', '', 'adm', '/interface/usergroup/adminacl.php', 0, '["admin","acl"]', 'null'),
('Activity|/interface/reports/inventory_activity.php', 'Activity', '', '', '', 'rep', '/interface/reports/inventory_activity.php', 0, 'null', 'null'),
('Addr Book|/interface/usergroup/addrbook_list.php', 'Address Book', '', '', '', 'adm', '/interface/usergroup/addrbook_list.php', 0, '["admin","practice"]', 'null'),
('Address Label|/interface/patient_file/addr_label.php', 'Address Label', '', '', '', 'pop', '/interface/patient_file/addr_label.php', 1, NULL, 'addr_label_type'),
('Administration:admimg', 'Administration', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Alerts Log|/interface/reports/cdr_log.php', 'Alerts Log', '', '', '', 'rep', '/interface/reports/cdr_log.php', 0, 'null', 'null'),
('Alerts|/interface/super/rules/index.php?action=alerts!listactmgr', 'Alerts', '', '', '', 'adm', '/interface/super/rules/index.php?action=alerts!listactmgr', 0, '["admin","super"]', '"enable_cdr"'),
('AMC Tracking|/interface/reports/amc_tracking.php', 'AMC Tracking', '', '', '', 'rep', '/interface/reports/amc_tracking.php', 0, 'null', 'null'),
('Appointments|/interface/reports/appointments_report.php', 'Appointments', '', '', '', 'rep', '/interface/reports/appointments_report.php', 0, 'null', 'null'),
('Appt-Enc|/interface/reports/appt_encounter_report.php', 'Appt-Enc', '', '', '', 'rep', '/interface/reports/appt_encounter_report.php', 0, 'null', 'null'),
('Appts|/interface/reports/appointments_report.php?patient=', 'Appts', '', '', '', 'pat', '/interface/reports/appointments_report.php?patient=', 1, NULL, NULL),
('Authorizations|/interface/main/authorizations/authorizations.php', 'Authorizations', '', '', '', 'msc', '/interface/main/authorizations/authorizations.php', 0, 'null', 'null'),
('Automated Measures (AMC)|/interface/reports/cqm.php?type=amc', 'Automated Measures (AMC)', '', '', '', 'rep', '/interface/reports/cqm.php?type=amc', 0, 'null', 'null'),
('Background Services|/interface/reports/background_services.php', 'Background Services', '', '', '', 'rep', '/interface/reports/background_services.php', 0, 'null', 'null'),
('Backup|/interface/main/backup.php', 'Backup', '', '', '', 'adm', '/interface/main/backup.php', 0, '["admin","super"]', 'null'),
('Barcode Label|/interface/patient_file/barcode_label.php', 'Barcode Label', '', '', '', 'pop', '/interface/patient_file/barcode_label.php', 1, NULL, 'barcode_label_type'),
('Batch Payments|/interface/billing/new_payment.php', 'Batch Payments', '', '', '', 'pat', '/interface/billing/new_payment.php', 0, 'null', 'null'),
('Batch Results|/interface/orders/orders_results.php?batch=1', 'Batch Results', '', '', '', 'pat', '/interface/orders/orders_results.php?batch=1', 0, 'null', 'null'),
('BatchCom|/interface/batchcom/batchcom.php', 'BatchCom', '', '', '', 'msc', '/interface/batchcom/batchcom.php', 0, 'null', 'null'),
('Billing|/interface/billing/billing_report.php', 'Billing', '', '', '', 'pat', '/interface/billing/billing_report.php', 0, 'null', 'null'),
('Blank Forms:', 'Blank Forms', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Calendar|/interface/main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig', 'Calendar', '', '', '', 'lst', '/interface/main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig', 0, '["admin","calendar"]', 'null'),
('Calendar|/interface/main/main_info.php', 'Calendar', '', '', '', 'lst', '/interface/main/main_info.php', 0, 'null', 'null'),
('Cash Rec|/interface/billing/sl_receipts_report.php', 'Cash Rec', '', '', '', 'rep', '/interface/billing/sl_receipts_report.php', 0, 'null', 'null'),
('Certificates|/interface/usergroup/ssl_certificates_admin.php', 'Certificates', '', '', '', 'adm', '/interface/usergroup/ssl_certificates_admin.php', 0, '["admin","users"]', 'null'),
('Chart Activity|/interface/reports/chart_location_activity.php', 'Chart Activity', '', '', '', 'rep', '/interface/reports/chart_location_activity.php', 0, 'null', 'null'),
('Chart Label|/interface/patient_file/label.php', 'Chart Label', '', '', '', 'pop', '/interface/patient_file/label.php', 1, NULL, 'chart_label_type'),
('Chart Tracker|/custom/chart_tracker.php', 'Chart Tracker', '', '', '', 'msc', '/custom/chart_tracker.php', 0, 'null', 'null'),
('Charts Out|/interface/reports/charts_checked_out.php', 'Charts Out', '', '', '', 'rep', '/interface/reports/charts_checked_out.php', 0, 'null', 'null'),
('Checkout|/interface/patient_file/pos_checkout.php', 'Checkout', '', '', '', 'pop', '/interface/patient_file/pos_checkout.php', 1, 'null', ''),
('Clients:', 'Clients', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Clinic:', 'Clinic', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Clinical|/interface/reports/clinical_reports.php', 'Report Generator', '', '', '', 'rep', '/interface/reports/clinical_reports.php', 0, 'null', 'null'),
('Codes|/interface/patient_file/encounter/superbill_custom_full.php', 'Codes', '', '', '', 'adm', '/interface/patient_file/encounter/superbill_custom_full.php', 0, '["admin","superbill"]', 'null'),
('Collections|/interface/reports/collections_report.php', 'Collections', '', '', '', 'rep', '/interface/reports/collections_report.php', 0, 'null', 'null'),
('Configuration|/interface/orders/types.php', 'Configuration', '', '', '', 'pat', '/interface/orders/types.php', 0, 'null', 'null'),
('Create Visit|/interface/forms/newpatient/new.php?autoloaded=1&calenc=', 'Create Visit', '', '', '', 'enc', '/interface/forms/newpatient/new.php?autoloaded=1&calenc=', 1, 'null', 'null'),
('Current|/interface/patient_file/encounter/encounter_top.php', 'Current', '', '', '', 'enc', '/interface/patient_file/encounter/encounter_top.php', 3, 'null', 'null'),
('Database|/phpmyadmin/index.php', 'Database', '', '', '', 'adm', '/phpmyadmin/index.php', 0, '["admin","database"]', '"!disable_phpmyadmin_link"'),
('Demographics|/interface/patient_file/summary/demographics_print.php', 'Demographics', '', '', '', 'rep', '/interface/patient_file/summary/demographics_print.php', 0, 'null', 'null'),
('Destroyed|destroyed_drugs_report.php', 'Destroyed', '', '', '', 'report', 'destroyed_drugs_report.php', 0, 'null', 'null'),
('Direct Message Log|/interface/reports/direct_message_log.php', 'Direct Message Log', '', '', '', 'rep', '/interface/reports/direct_message_log.php', 0, 'null', 'null'),
('Distribution|/interface/reports/insurance_allocation_report.php', 'Distribution', '', '', '', 'rep', '/interface/reports/insurance_allocation_report.php', 0, 'null', 'null'),
('Document Templates|/interface/super/manage_document_templates.php', 'Document Templates', '', '', '', 'msc', '/interface/super/manage_document_templates.php', 0, 'null', 'null'),
('EDI History|/interface/billing/edih_view.php', 'EDI History', '', '', '', 'pat', '/interface/billing/edih_view.php', 0, 'null', 'null'),
('Electronic Reports|/interface/orders/list_reports.php', 'Electronic Reports', '', '', '', 'pat', '/interface/orders/list_reports.php', 0, 'null', 'null'),
('Eligibility Response|/interface/reports/edi_271.php', 'Eligibility Response', '', '', '', 'rep', '/interface/reports/edi_271.php', 0, 'null', 'null'),
('Eligibility|/interface/reports/edi_270.php', 'Eligibility', '', '', '', 'rep', '/interface/reports/edi_270.php', 0, 'null', 'null'),
('Encounters|/interface/reports/encounters_report.php', 'Encounters', '', '', '', 'rep', '/interface/reports/encounters_report.php', 0, 'null', 'null'),
('Export|/custom/export_xml.php', 'Export', '', '', '', 'pop', '/custom/export_xml.php', 1, NULL, NULL),
('External Data Loads|/interface/code_systems/dataloads_ajax.php', 'External Data Loads', '', '', '', 'adm', '/interface/code_systems/dataloads_ajax.php', 0, '["admin","super"]', 'null'),
('Facilities|/interface/usergroup/facilities.php', 'Facilities', '', '', '', 'adm', '/interface/usergroup/facilities.php', 0, '["admin","users"]', 'null'),
('Fax/Scan|/interface/fax/faxq.php', 'Fax/Scan', '', '', '', 'msc', '/interface/fax/faxq.php', 0, 'null', '["enable_hylafax","enable_scanner"]'),
('Fee Sheet|/interface/patient_file/encounter/load_form.php?formname=fee_sheet', 'Fee Sheet', '', '', '', 'fee', '/interface/patient_file/encounter/load_form.php?formname=fee_sheet', 2, 'null', 'null'),
('Fees:feeimg', 'Fees', '', '', '', NULL, NULL, 0, 'null', 'null'),
('File:file0', 'File', '', '', '', NULL, NULL, NULL, NULL, NULL),
('Files|/interface/super/manage_site_files.php', 'Files', '', '', '', 'adm', '/interface/super/manage_site_files.php', 0, '["admin","super"]', 'null'),
('Financial Summary by Service Code|/interface/reports/svc_code_financial_report.php', 'Financial Summary by Service Code', '', '', '', 'rep', '/interface/reports/svc_code_financial_report.php', 0, 'null', 'null'),
('Financial:', 'Financial', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Financial:top', 'Financial', '', '', '', NULL, NULL, NULL, NULL, NULL),
('Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', 'Flow Board', '', '', '', 'lst', '/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', 0, 'null', 'null'),
('Forms|/interface/forms_admin/forms_admin.php', 'Forms', '', '', '', 'adm', '/interface/forms_admin/forms_admin.php', 0, '["admin","forms"]', 'null'),
('Front Rec|/interface/reports/front_receipts_report.php', 'Front Rec', '', '', '', 'rep', '/interface/reports/front_receipts_report.php', 0, 'null', 'null'),
('Globals|/interface/super/edit_globals.php', 'Globals', '', '', '', 'adm', '/interface/super/edit_globals.php', 0, '["admin","super"]', 'null'),
('Edit Menu|/interface/main/tabs/edit_menu.php', 'Edit Menu', '', '', '', 'adm', '/interface/main/tabs/edit_menu.php', 0, '["admin","super"]', 'null'),
('Immunization Registry|/interface/reports/immunization_report.php', 'Immunization Registry', '', '', '', 'rep', '/interface/reports/immunization_report.php', 0, 'null', 'null'),
('Import:', 'Import', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Import|/custom/import_xml.php', 'Import', '', '', '', 'pop', '/custom/import_xml.php', 1, NULL, NULL),
('Indigents|/interface/billing/indigent_patients_report.php', 'Indigents', '', '', '', 'rep', '/interface/billing/indigent_patients_report.php', 0, 'null', 'null'),
('Insurance:', 'Insurance', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Inventory:invimg', 'Inventory', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Issues|/interface/patient_file/problem_encounter.php', 'Issues', '', '', '', 'tre', '/interface/patient_file/problem_encounter.php', 1, NULL, NULL),
('Lab Documents|/interface/main/display_documents.php', 'Lab Documents', '', '', '', 'pat', '/interface/main/display_documents.php', 0, 'null', 'null'),
('Lab Overview|/interface/patient_file/summary/labdata.php', 'Lab Overview', '', '', '', 'enc', '/interface/patient_file/summary/labdata.php', 1, 'null', 'null'),
('Language|/interface/language/language.php', 'Language', '', '', '', 'adm', '/interface/language/language.php', 0, '["admin","language"]', 'null'),
('Layouts|/interface/super/edit_layout.php', 'Layouts', '', '', '', 'adm', '/interface/super/edit_layout.php', 0, '["admin","super"]', 'null'),
('Lists|/interface/super/edit_list.php', 'Lists', '', '', '', 'adm', '/interface/super/edit_list.php', 0, '["admin","super"]', 'null'),
('List|/interface/reports/inventory_list.php', 'List', '', '', '', 'rep', '/interface/reports/inventory_list.php', 0, 'null', 'null'),
('List|/interface/reports/patient_list.php', 'List', '', '', '', 'rep', '/interface/reports/patient_list.php', 0, 'null', 'null'),
('Load Compendium|/interface/orders/load_compendium.php', 'Load Compendium', '', '', '', 'pat', '/interface/orders/load_compendium.php', 0, 'null', 'null'),
('Logs|/interface/logview/logview.php', 'Logs', '', '', '', 'adm', '/interface/logview/logview.php', 0, '["admin","users"]', 'null'),
('Manage Modules|/interface/modules/zend_modules/public/Installer', 'Manage Modules', '', '', '', 'pat', '/interface/modules/zend_modules/public/Installer', 0, 'null', 'null'),
('Management|/interface/drugs/drug_inventory.php', 'Management', '', '', '', 'pat', '/interface/drugs/drug_inventory.php', 0, 'null', 'null'),
('Menu:admins', 'Menu', '', '', '', NULL, NULL, 0, '["super","admin"]', NULL),
('Merge Patients|/interface/patient_file/merge_patients.php', 'Merge Patients', '', '', '', 'adm', '/interface/patient_file/merge_patients.php', 0, 'null', 'null'),
('Messages|/interface/main/messages/messages.php?form_active=1', 'Messages', '', '', '', 'msg', '/interface/main/messages/messages.php?form_active=1', 0, 'null', 'null'),
('Miscellaneous:misimg', 'Miscellaneous', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Modules:modimg', 'Modules', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Native Data Loads|/interface/super/load_codes.php', 'Native Data Loads', '', '', '', 'adm', '/interface/super/load_codes.php', 0, '["admin","super"]', 'null'),
('New Documents|/controller.php?document&list&patient_id=00', 'New Documents', '', '', '', 'msc', '/controller.php?document&list&patient_id=00', 0, 'null', 'null'),
('New/Patient|/interface/new/new.php', 'Add Patient', 'fa-group', '', '', 'pat', '/interface/new/new.php', 0, 'null', 'null'),
('Ofc Notes|/interface/main/onotes/office_comments.php', 'Ofc Notes', '', '', '', 'msc', '/interface/main/onotes/office_comments.php', 0, 'null', 'null'),
('Order Catalog|/interface/orders/types.php', 'Order Catalog', '', '', '', 'msc', '/interface/orders/types.php', 0, 'null', 'null'),
('Other:', 'Other', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Password|/interface/usergroup/user_info.php', 'Password', '', '', '', 'msc', '/interface/usergroup/user_info.php', 0, 'null', 'null'),
('Pat Ledger|/interface/reports/pat_ledger.php?form=0', 'Patient Ledger', '', '', '', 'rep', '/interface/reports/pat_ledger.php?form=0', 0, 'null', 'null'),
('Patient Education|/interface/reports/patient_edu_web_lookup.php', 'Patient Education', '', '', '', 'msc', '/interface/reports/patient_edu_web_lookup.php', 0, 'null', 'null'),
('Patient Billing Encounter by Carrier|/interface/reports/encounters_report_carrier.php', 'Patient Billing Encounter by Carrier', '', '', '', 'rep', '/interface/reports/encounters_report_carrier.php', 0, 'null', 'null'),
('Patient Flow Board|/interface/reports/patient_flow_board_report.php', 'Patient Flow Board', '', '', '', 'msc', '/interface/reports/patient_flow_board_report.php', 0, 'null', 'null'),
('Patient List Creation|/interface/reports/patient_list_creation.php', 'Patient List Creation', '', '', '', 'rep', '/interface/reports/patient_list_creation.php', 0, 'null', 'null'),
('Patient Record Request|/interface/patient_file/transaction/record_request.php', 'Patient Record Request', '', '', '', 'enc', '/interface/patient_file/transaction/record_request.php', 1, 'null', 'null'),
('Patient Reminders|/interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id=', 'Clinical Reminders', '', '', '', 'adm', '/interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id=', 0, '["admin","super"]', '"enable_cdr"'),
('Patient Results|/interface/orders/orders_results.php', 'Patient Results', '', '', '', 'enc', '/interface/orders/orders_results.php', 1, 'null', 'null'),
('Patient/Client:patimg', 'Patient', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Patients|/interface/main/finder/dynamic_finder.php', 'Find Patient', 'fa-search', '', '', 'lst', '/interface/main/finder/dynamic_finder.php', 0, 'null', 'null'),
('Payment|/interface/patient_file/front_payment.php', 'Payment', '', '', '', 'fee', '/interface/patient_file/front_payment.php', 1, 'null', 'null'),
('Pending Approval|/interface/patient_file/ccr_pending_approval.php', 'Pending Approval', '', '', '', 'pat', '/interface/patient_file/ccr_pending_approval.php', 0, 'null', 'null'),
('Pending Res|/interface/orders/pending_orders.php', 'Pending Res', '', '', '', 'rep', '/interface/orders/pending_orders.php', 0, 'null', 'null'),
('Pending Review|/interface/orders/orders_results.php?review=1', 'Pending Review', '', '', '', 'enc', '/interface/orders/orders_results.php?review=1', 1, 'null', 'null'),
('Pmt Method|/interface/reports/receipts_by_method_report.php', 'Pmt Method', '', '', '', 'rep', '/interface/reports/receipts_by_method_report.php', 0, 'null', 'null'),
('Popup:lists', 'Popups', '', '', '', NULL, NULL, 0, NULL, NULL),
('Posting|/interface/billing/sl_eob_search.php', 'Posting', '', '', '', 'billing', '/interface/billing/sl_eob_search.php', 0, '["admin","acl"]', 'null'),
('Practice|/controller.php?practice_settings&pharmacy&action=list', 'Practice', '', '', '', 'adm', '/controller.php?practice_settings&pharmacy&action=list', 0, '["admin","practice"]', 'null'),
('Preferences|/interface/super/edit_globals.php?mode=user', 'Preferences', 'fa-gears', '', '', 'msc', '/interface/super/edit_globals.php?mode=user', 0, 'null', 'null'),
('Procedures:', 'Procedures', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Procedures:proimg', 'Labs/Testing', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Providers|/interface/orders/procedure_provider_list.php', 'Providers', '', '', '', 'pat', '/interface/orders/procedure_provider_list.php', 0, 'null', 'null'),
('Quality Measures (CQM)|/interface/reports/cqm.php?type=cqm', 'Quality Measures (CQM)', '', '', '', 'rep', '/interface/reports/cqm.php?type=cqm', 0, 'null', 'null'),
('Records:', 'Records', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Referrals|/interface/reports/referrals_report.php', 'Referrals', '', '', '', 'rep', '/interface/reports/referrals_report.php', 0, 'null', 'null'),
('Referral|/interface/patient_file/transaction/print_referral.php', 'Referral', '', '', '', 'rep', '/interface/patient_file/transaction/print_referral.php', 0, 'null', 'null'),
('Report Results|/interface/reports/report_results.php', 'Report Results', '', '', '', 'rep', '/interface/reports/report_results.php', 0, 'null', 'null'),
('Reports:repimg', 'Reports', '', '', '', NULL, NULL, 0, 'null', 'null'),
('Rules|/interface/super/rules/index.php?action=browse!list', 'Rules', '', '', '', 'adm', '/interface/super/rules/index.php?action=browse!list', 0, '["admin","super"]', '"enable_cdr"'),
('Rx|/interface/reports/prescriptions_report.php', 'Rx', '', '', '', 'rep', '/interface/reports/prescriptions_report.php', 0, 'null', 'null'),
('Sales|/interface/reports/sales_by_item.php', 'Sales', '', '', '', 'rep', '/interface/reports/sales_by_item.php', 0, 'null', 'null'),
('Services:', 'Services', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Services|/interface/reports/services_by_category.php', 'Services', '', '', '', 'rep', '/interface/reports/services_by_category.php', 0, 'null', 'null'),
('Standard Measures|/interface/reports/cqm.php?type=standard', 'Standard Measures', '', '', '', 'rep', '/interface/reports/cqm.php?type=standard', 0, 'null', 'null'),
('Statistics|/interface/orders/procedure_stats.php', 'Statistics', '', '', '', 'rep', '/interface/orders/procedure_stats.php', 0, 'null', 'null'),
('Summary|/interface/patient_file/summary/demographics.php', 'Summary', '', '', '', 'pat', '/interface/patient_file/summary/demographics.php', 1, 'null', 'null'),
('Superbill/Fee Sheet|/interface/patient_file/printed_fee_sheet.php', 'Superbill/Fee Sheet', '', '', '', 'rep', '/interface/patient_file/printed_fee_sheet.php', 0, 'null', 'null'),
('Superbill|/interface/patient_file/printed_fee_sheet.php?fill=1', 'Superbill', '', '', '', 'pop', '/interface/patient_file/printed_fee_sheet.php?fill=1', 1, NULL, NULL),
('Superbill|/interface/reports/custom_report_range.php', 'Superbill', '', '', '', 'rep', '/interface/reports/custom_report_range.php', 0, 'null', 'null'),
('Syndromic Surveillance|/interface/reports/non_reported.php', 'Syndromic Surveillance', '', '', '', 'rep', '/interface/reports/non_reported.php', 0, 'null', 'null'),
('TestLBF|/interface/forms/LBF/printable.php?formname=LBF1', 'TestLBF', '', '', '', 'rep', '/interface/forms/LBF/printable.php?formname=LBF1', 0, 'null', 'null'),
('Transactions|/interface/reports/inventory_transactions.php', 'Transactions', '', '', '', 'rep', '/interface/reports/inventory_transactions.php', 0, 'null', 'null'),
('Unique SP|/interface/reports/unique_seen_patients_report.php', 'Unique SP', '', '', '', 'rep', '/interface/reports/unique_seen_patients_report.php', 0, 'null', 'null'),
('Upload|/interface/patient_file/ccr_import.php', 'Upload', '', '', '', 'pat', '/interface/patient_file/ccr_import.php', 0, 'null', 'null'),
('Users|/interface/usergroup/usergroup_admin.php', 'Users', '', '', '', 'adm', '/interface/usergroup/usergroup_admin.php', 0, '["admin","users"]', 'null'),
('View:', 'View', '', '', '', NULL, NULL, 0, NULL, NULL),
('Visit Forms:', 'Visit Forms', 'fa-caret-right', '', '', 'forms', '', 0, 'null', 'null'),
('Visit History|/interface/patient_file/history/encounters.php', 'Visit History', '', '', '', 'enc', '/interface/patient_file/history/encounters.php', 1, 'null', 'null'),
('Visits:encounter', 'Visits', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null'),
('Visits:reports', 'Visits', 'fa-caret-right', '', '', NULL, NULL, 0, 'null', 'null');


--
-- Table structure for table `menu_trees`
--

DROP TABLE IF EXISTS `menu_trees`;
CREATE TABLE `menu_trees` (
  `menu_set` varchar(255) NOT NULL,
  `entry_id` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `helperText` varchar(50) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `seq` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`menu_set`,`entry_id`,`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `menu_trees`
--

INSERT INTO `menu_trees` (`menu_set`, `entry_id`, `icon`, `helperText`, `parent`, `seq`, `label`) VALUES
('Administrators', 'Calendar|/interface/main/main_info.php', '', '', '', 0, NULL),
('Administrators', 'Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', '', '', '', 100, NULL),
('Administrators', 'Messages|/interface/main/messages/messages.php?form_active=1', '', '', '', 200, NULL),
('Administrators', 'Patient/Client:patimg', '', '', '', 300, NULL),
('Administrators', 'Fees:feeimg', '', '', '', 400, NULL),
('Administrators', 'Modules:modimg', '', '', '', 500, NULL),
('Administrators', 'Procedures:proimg', '', '', '', 700, NULL),
('Administrators', 'Administration:admimg', '', '', '', 800, NULL),
('Administrators', 'Reports:repimg', '', '', '', 900, NULL),
('Administrators', 'Miscellaneous:misimg', '', '', '', 1000, NULL),
('Administrators', 'Globals|/interface/super/edit_globals.php', '', '', 'Administration:admimg', 0, NULL),
('Administrators', 'Globals|/interface/super/edit_globals.php', '', '', 'Administration:admimg', 0, NULL),
('Administrators', 'Facilities|/interface/usergroup/facilities.php', '', '', 'Administration:admimg', 100, NULL),
('Administrators', 'Users|/interface/usergroup/usergroup_admin.php', '', '', 'Administration:admimg', 200, NULL),
('Administrators', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'Administration:admimg', 300, NULL),
('Administrators', 'Practice|/controller.php?practice_settings&pharmacy&action=list', '', '', 'Administration:admimg', 400, NULL),
('Administrators', 'Codes|/interface/patient_file/encounter/superbill_custom_full.php', '', '', 'Administration:admimg', 500, NULL),
('Administrators', 'Layouts|/interface/super/edit_layout.php', '', '', 'Administration:admimg', 600, NULL),
('Administrators', 'Lists|/interface/super/edit_list.php', '', '', 'Administration:admimg', 700, NULL),
('Administrators', 'ACL|/interface/usergroup/adminacl.php', '', '', 'Administration:admimg', 800, NULL),
('Administrators', 'Files|/interface/super/manage_site_files.php', '', '', 'Administration:admimg', 900, NULL),
('Administrators', 'Backup|/interface/main/backup.php', '', '', 'Administration:admimg', 1000, NULL),
('Administrators', 'Rules|/interface/super/rules/index.php?action=browse!list', '', '', 'Administration:admimg', 1100, NULL),
('Administrators', 'Alerts|/interface/super/rules/index.php?action=alerts!listactmgr', '', '', 'Administration:admimg', 1200, NULL),
('Administrators', 'Patient Reminders|/interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id=', '', '', 'Administration:admimg', 1300, NULL),
('Administrators', 'Other:', '', '', 'Administration:admimg', 1400, NULL),
('Administrators', 'Demographics|/interface/patient_file/summary/demographics_print.php', '', '', 'Blank Forms:', 0, NULL),
('Administrators', 'Superbill/Fee Sheet|/interface/patient_file/printed_fee_sheet.php', '', '', 'Blank Forms:', 100, NULL),
('Administrators', 'Referral|/interface/patient_file/transaction/print_referral.php', '', '', 'Blank Forms:', 200, NULL),
('Administrators', 'TestLBF|/interface/forms/LBF/printable.php?formname=LBF1', '', '', 'Blank Forms:', 300, NULL),
('Administrators', 'List|/interface/reports/patient_list.php', '', '', 'Clients:', 0, NULL),
('Administrators', 'Rx|/interface/reports/prescriptions_report.php', '', '', 'Clients:', 100, NULL),
('Administrators', 'Patient List Creation|/interface/reports/patient_list_creation.php', '', '', 'Clients:', 200, NULL),
('Administrators', 'Clinical|/interface/reports/clinical_reports.php', '', '', 'Clients:', 300, NULL),
('Administrators', 'Referrals|/interface/reports/referrals_report.php', '', '', 'Clients:', 400, NULL),
('Administrators', 'Immunization Registry|/interface/reports/immunization_report.php', '', '', 'Clients:', 500, NULL),
('Administrators', 'Report Results|/interface/reports/report_results.php', '', '', 'Clinic:', 0, NULL),
('Administrators', 'Standard Measures|/interface/reports/cqm.php?type=standard', '', '', 'Clinic:', 100, NULL),
('Administrators', 'Quality Measures (CQM)|/interface/reports/cqm.php?type=cqm', '', '', 'Clinic:', 200, NULL),
('Administrators', 'Automated Measures (AMC)|/interface/reports/cqm.php?type=amc', '', '', 'Clinic:', 300, NULL),
('Administrators', 'AMC Tracking|/interface/reports/amc_tracking.php', '', '', 'Clinic:', 400, NULL),
('Administrators', 'Alerts Log|/interface/reports/cdr_log.php', '', '', 'Clinic:', 500, NULL),
('Administrators', 'Fee Sheet|/interface/patient_file/encounter/load_form.php?formname=fee_sheet', '', '', 'Fees:feeimg', 0, NULL),
('Administrators', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Fees:feeimg', 100, NULL),
('Administrators', 'Checkout|/interface/patient_file/pos_checkout.php?framed=1', '', '', 'Fees:feeimg', 200, NULL),
('Administrators', 'Billing|/interface/billing/billing_report.php', '', '', 'Fees:feeimg', 300, NULL),
('Administrators', 'Batch Payments|/interface/billing/new_payment.php', '', '', 'Fees:feeimg', 400, NULL),
('Administrators', 'EDI History|/interface/billing/edih_view.php', '', '', 'Fees:feeimg', 500, NULL),
('Administrators', 'Sales|/interface/reports/sales_by_item.php', '', '', 'Financial:', 0, NULL),
('Administrators', 'Cash Rec|/interface/billing/sl_receipts_report.php', '', '', 'Financial:', 100, NULL),
('Administrators', 'Front Rec|/interface/reports/front_receipts_report.php', '', '', 'Financial:', 200, NULL),
('Administrators', 'Pmt Method|/interface/reports/receipts_by_method_report.php', '', '', 'Financial:', 300, NULL),
('Administrators', 'Collections|/interface/reports/collections_report.php', '', '', 'Financial:', 400, NULL),
('Administrators', 'Pat Ledger|/interface/reports/pat_ledger.php?form=0', '', '', 'Financial:', 500, NULL),
('Administrators', 'Financial Summary by Service Code|/interface/reports/svc_code_financial_report.php', '', '', 'Financial:', 600, NULL),
('Administrators', 'Upload|/interface/patient_file/ccr_import.php', '', '', 'Import:', 0, NULL),
('Administrators', 'Pending Approval|/interface/patient_file/ccr_pending_approval.php', '', '', 'Import:', 100, NULL),
('Administrators', 'Distribution|/interface/reports/insurance_allocation_report.php', '', '', 'Insurance:', 0, NULL),
('Administrators', 'Indigents|/interface/billing/indigent_patients_report.php', '', '', 'Insurance:', 100, NULL),
('Administrators', 'Unique SP|/interface/reports/unique_seen_patients_report.php', '', '', 'Insurance:', 200, NULL),
('Administrators', 'List|/interface/reports/inventory_list.php', '', '', 'Inventory:invimg', 0, NULL),
('Administrators', 'Management|/interface/drugs/drug_inventory.php', '', '', 'Inventory:invimg', 0, NULL),
('Administrators', 'Destroyed|destroyed_drugs_report.php', '', '', 'Inventory:invimg', 100, NULL),
('Administrators', 'Activity|/interface/reports/inventory_activity.php', '', '', 'Inventory:invimg', 100, NULL),
('Administrators', 'Transactions|/interface/reports/inventory_transactions.php', '', '', 'Inventory:invimg', 200, NULL),
('Administrators', 'Superbill/Fee Sheet|/interface/patient_file/printed_fee_sheet.php', '', '', 'Menu:admins', 0, NULL),
('Administrators', 'Patient Education|/interface/reports/patient_edu_web_lookup.php', '', '', 'Miscellaneous:misimg', 0, NULL),
('Administrators', 'Authorizations|/interface/main/authorizations/authorizations.php', '', '', 'Miscellaneous:misimg', 100, NULL),
('Administrators', 'Fax/Scan|/interface/fax/faxq.php', '', '', 'Miscellaneous:misimg', 200, NULL),
('Administrators', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'Miscellaneous:misimg', 300, NULL),
('Administrators', 'Order Catalog|/interface/orders/types.php', '', '', 'Miscellaneous:misimg', 400, NULL),
('Administrators', 'Chart Tracker|/custom/chart_tracker.php', '', '', 'Miscellaneous:misimg', 500, NULL),
('Administrators', 'Ofc Notes|/interface/main/onotes/office_comments.php', '', '', 'Miscellaneous:misimg', 600, NULL),
('Administrators', 'BatchCom|/interface/batchcom/batchcom.php', '', '', 'Miscellaneous:misimg', 700, NULL),
('Administrators', 'Password|/interface/usergroup/user_info.php', '', '', 'Miscellaneous:misimg', 800, NULL),
('Administrators', 'Preferences|/interface/super/edit_globals.php?mode=user', '', '', 'Miscellaneous:misimg', 900, NULL),
('Administrators', 'New Documents|/controller.php?document&list&patient_id=00', '', '', 'Miscellaneous:misimg', 1000, NULL),
('Administrators', 'Document Templates|/interface/super/manage_document_templates.php', '', '', 'Miscellaneous:misimg', 1100, NULL),
('Administrators', 'Menu:admins', '', '', 'Miscellaneous:misimg', 1200, NULL),
('Administrators', 'Manage Modules|/interface/modules/zend_modules/public/Installer', '', '', 'Modules:modimg', 0, NULL),
('Administrators', 'Language|/interface/language/language.php', '', '', 'Other:', 0, NULL),
('Administrators', 'Forms|/interface/forms_admin/forms_admin.php', '', '', 'Other:', 100, NULL),
('Administrators', 'Calendar|/interface/main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig', '', '', 'Other:', 200, NULL),
('Administrators', 'Logs|/interface/logview/logview.php', '', '', 'Other:', 300, NULL),
('Administrators', 'Database|/phpmyadmin/index.php', '', '', 'Other:', 400, NULL),
('Administrators', 'Certificates|/interface/usergroup/ssl_certificates_admin.php', '', '', 'Other:', 500, NULL),
('Administrators', 'Native Data Loads|/interface/super/load_codes.php', '', '', 'Other:', 600, NULL),
('Administrators', 'External Data Loads|/interface/code_systems/dataloads_ajax.php', '', '', 'Other:', 700, NULL),
('Administrators', 'Merge Patients|/interface/patient_file/merge_patients.php', '', '', 'Other:', 800, NULL),
('Administrators', 'Patients|/interface/main/finder/dynamic_finder.php', '', '', 'Patient/Client:patimg', 0, NULL),
('Administrators', 'New/Search|/interface/new/new.php', '', '', 'Patient/Client:patimg', 100, NULL),
('Administrators', 'Summary|/interface/patient_file/summary/demographics.php', '', '', 'Patient/Client:patimg', 200, NULL),
('Administrators', 'Visits:encounter', '', '', 'Patient/Client:patimg', 300, NULL),
('Administrators', 'Records:', '', '', 'Patient/Client:patimg', 400, NULL),
('Administrators', 'Visit Forms:', '', '', 'Patient/Client:patimg', 500, NULL),
('Administrators', 'Import:', '', '', 'Patient/Client:patimg', 600, NULL),
('Administrators', 'Pending Res|/interface/orders/pending_orders.php', '', '', 'Procedures:', 0, NULL),
('Administrators', 'Statistics|/interface/orders/procedure_stats.php', '', '', 'Procedures:', 100, NULL),
('Administrators', 'Providers|/interface/orders/procedure_provider_list.php', '', '', 'Procedures:proimg', 0, NULL),
('Administrators', 'Configuration|/interface/orders/types.php', '', '', 'Procedures:proimg', 100, NULL),
('Administrators', 'Load Compendium|/interface/orders/load_compendium.php', '', '', 'Procedures:proimg', 200, NULL),
('Administrators', 'Pending Review|/interface/orders/orders_results.php?review=1', '', '', 'Procedures:proimg', 300, NULL),
('Administrators', 'Patient Results|/interface/orders/orders_results.php', '', '', 'Procedures:proimg', 400, NULL),
('Administrators', 'Lab Overview|/interface/patient_file/summary/labdata.php', '', '', 'Procedures:proimg', 500, NULL),
('Administrators', 'Batch Results|/interface/orders/orders_results.php?batch=1', '', '', 'Procedures:proimg', 600, NULL),
('Administrators', 'Electronic Reports|/interface/orders/list_reports.php', '', '', 'Procedures:proimg', 700, NULL),
('Administrators', 'Lab Documents|/interface/main/display_documents.php', '', '', 'Procedures:proimg', 800, NULL),
('Administrators', 'Patient Record Request|/interface/patient_file/transaction/record_request.php', '', '', 'Records:', 0, NULL),
('Administrators', 'Clients:', '', '', 'Reports:repimg', 0, NULL),
('Administrators', 'Clinic:', '', '', 'Reports:repimg', 100, NULL),
('Administrators', 'Visits:reports', '', '', 'Reports:repimg', 200, NULL),
('Administrators', 'Financial:', '', '', 'Reports:repimg', 300, NULL),
('Administrators', 'Inventory:invimg', '', '', 'Reports:repimg', 400, NULL),
('Administrators', 'Procedures:', '', '', 'Reports:repimg', 500, NULL),
('Administrators', 'Insurance:', '', '', 'Reports:repimg', 600, NULL),
('Administrators', 'Blank Forms:', '', '', 'Reports:repimg', 700, NULL),
('Administrators', 'Services:', '', '', 'Reports:repimg', 800, NULL),
('Administrators', 'Background Services|/interface/reports/background_services.php', '', '', 'Services:', 0, NULL),
('Administrators', 'Direct Message Log|/interface/reports/direct_message_log.php', '', '', 'Services:', 100, NULL),
('Administrators', 'Create Visit|/interface/forms/newpatient/new.php?autoloaded=1&calenc=', '', '', 'Visits:encounter', 0, NULL),
('Administrators', 'Current|/interface/patient_file/encounter/encounter_top.php', '', '', 'Visits:encounter', 100, NULL),
('Administrators', 'Visit History|/interface/patient_file/history/encounters.php', '', '', 'Visits:encounter', 200, NULL),
('Administrators', 'Appointments|/interface/reports/appointments_report.php', '', '', 'Visits:reports', 0, NULL),
('Administrators', 'Patient Flow Board|/interface/reports/patient_flow_board_report.php', '', '', 'Visits:reports', 100, NULL),
('Administrators', 'Patient Billing Encounter by Carrier|/interface/reports/encounters_report_carrier.php', '', '', 'Visits:reports', 0, NULL),
('Administrators', 'Encounters|/interface/reports/encounters_report.php', '', '', 'Visits:reports', 200, NULL),
('Administrators', 'Appt-Enc|/interface/reports/appt_encounter_report.php', '', '', 'Visits:reports', 300, NULL),
('Administrators', 'Superbill|/interface/reports/custom_report_range.php', '', '', 'Visits:reports', 400, NULL),
('Administrators', 'Eligibility|/interface/reports/edi_270.php', '', '', 'Visits:reports', 500, NULL),
('Administrators', 'Eligibility Response|/interface/reports/edi_271.php', '', '', 'Visits:reports', 600, NULL),
('Administrators', 'Chart Activity|/interface/reports/chart_location_activity.php', '', '', 'Visits:reports', 700, NULL),
('Administrators', 'Charts Out|/interface/reports/charts_checked_out.php', '', '', 'Visits:reports', 800, NULL),
('Administrators', 'Services|/interface/reports/services_by_category.php', '', '', 'Visits:reports', 900, NULL),
('Administrators', 'Syndromic Surveillance|/interface/reports/non_reported.php', '', '', 'Visits:reports', 1000, NULL),
('AnsServ', 'File:file0', '', '', '', 0, NULL),
('AnsServ', 'View:', '', '', '', 100, NULL),
('AnsServ', 'Messages|/interface/main/messages/messages.php?form_active=1', '', '', '', 200, NULL),
('AnsServ', 'Patient/Client:patimg', '', '', '', 300, NULL),
('AnsServ', 'Miscellaneous:misimg', '', '', '', 1000, NULL),
('AnsServ', 'Preferences|/interface/super/edit_globals.php?mode=user', '', '', 'File:file0', 100, NULL),
('AnsServ', 'Calendar|/interface/main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig', '', '', 'Other:', 200, NULL),
('AnsServ', 'Patients|/interface/main/finder/dynamic_finder.php', '', '', 'Patient/Client:patimg', 0, NULL),
('AnsServ', 'New/Patient|/interface/new/new.php', '', '', 'Patient/Client:patimg', 100, NULL),
('AnsServ', 'Calendar|/interface/main/main_info.php', '', '', 'View:', 0, NULL),
('AnsServ', 'Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', '', '', 'View:', 100, NULL),
('AnsServ', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'View:', 300, NULL),
('Clinical Staff', 'File:file0', '', '', '', 0, NULL),
('Clinical Staff', 'View:', '0', '0', '', 100, NULL),
('Clinical Staff', 'Messages|/interface/main/messages/messages.php?form_active=1', '0', '0', '', 200, NULL),
('Clinical Staff', 'Patient/Client:patimg', '0', '0', '', 300, NULL),
('Clinical Staff', 'Fees:feeimg', '', '', '', 400, NULL),
('Clinical Staff', 'Procedures:proimg', '', '', '', 400, NULL),
('Clinical Staff', 'Popup:lists', '', '', '', 500, NULL),
('Clinical Staff', 'Patient Education|/interface/reports/patient_edu_web_lookup.php', '0', '0', '', 600, NULL),
('Clinical Staff', 'Fee Sheet|/interface/patient_file/encounter/load_form.php?formname=fee_sheet', '', '', 'Fees:feeimg', 0, NULL),
('Clinical Staff', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Fees:feeimg', 100, NULL),
('Clinical Staff', 'Checkout|/interface/patient_file/pos_checkout.php?framed=1', '', '', 'Fees:feeimg', 200, NULL),
('Clinical Staff', 'Billing|/interface/billing/billing_report.php', '', '', 'Fees:feeimg', 300, NULL),
('Clinical Staff', 'Batch Payments|/interface/billing/new_payment.php', '', '', 'Fees:feeimg', 400, NULL),
('Clinical Staff', 'Posting|/interface/billing/sl_eob_search.php', '', '', 'Fees:feeimg', 500, 'Posting'),
('Clinical Staff', 'EDI History|/interface/billing/edih_view.php', '', '', 'Fees:feeimg', 600, NULL),
('Clinical Staff', 'About|/interface/main/about_page.php', '0', '0', 'File:file0', 0, NULL),
('Clinical Staff', 'Preferences|/interface/super/edit_globals.php?mode=user', '0', '0', 'File:file0', 100, NULL),
('Clinical Staff', 'Upload|/interface/patient_file/ccr_import.php', '', '', 'Import:', 0, NULL),
('Clinical Staff', 'Pending Approval|/interface/patient_file/ccr_pending_approval.php', '', '', 'Import:', 100, NULL),
('Clinical Staff', 'Patients|/interface/main/finder/dynamic_finder.php', '0', '0', 'Patient/Client:patimg', 0, NULL),
('Clinical Staff', 'New/Patient|/interface/new/new.php', '0', '0', 'Patient/Client:patimg', 100, NULL),
('Clinical Staff', 'Summary|/interface/patient_file/summary/demographics.php', '0', '0', 'Patient/Client:patimg', 200, NULL),
('Clinical Staff', 'Visits:encounter', '0', '0', 'Patient/Client:patimg', 300, NULL),
('Clinical Staff', 'Visit Forms:', '', '', 'Patient/Client:patimg', 400, NULL),
('Clinical Staff', 'Records:', '', '', 'Patient/Client:patimg', 500, NULL),
('Clinical Staff', 'Issues|/interface/patient_file/problem_encounter.php', '', '', 'Popup:lists', 0, NULL),
('Clinical Staff', 'Import|/custom/import_xml.php', '', '', 'Popup:lists', 100, NULL),
('Clinical Staff', 'Export|/custom/export_xml.php', '', '', 'Popup:lists', 200, NULL),
('Clinical Staff', 'Appts|/interface/reports/appointments_report.php?patient=', '', '', 'Popup:lists', 300, NULL),
('Clinical Staff', 'Superbill|/interface/patient_file/printed_fee_sheet.php?fill=1', '', '', 'Popup:lists', 400, NULL),
('Clinical Staff', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Popup:lists', 500, NULL),
('Clinical Staff', 'Checkout|/interface/patient_file/pos_checkout.php', '', '', 'Popup:lists', 600, NULL),
('Clinical Staff', 'Letter|/interface/patient_file/letter.php', '', '', 'Popup:lists', 700, NULL),
('Clinical Staff', 'Chart Label|/interface/patient_file/label.php', '', '', 'Popup:lists', 800, NULL),
('Clinical Staff', 'Barcode Label|/interface/patient_file/barcode_label.php', '', '', 'Popup:lists', 900, NULL),
('Clinical Staff', 'Address Label|/interface/patient_file/addr_label.php', '', '', 'Popup:lists', 1000, NULL),
('Clinical Staff', 'Pending Res|/interface/orders/pending_orders.php', '', '', 'Procedures:', 0, NULL),
('Clinical Staff', 'Statistics|/interface/orders/procedure_stats.php', '', '', 'Procedures:', 100, NULL),
('Clinical Staff', 'Providers|/interface/orders/procedure_provider_list.php', '', '', 'Procedures:proimg', 0, NULL),
('Clinical Staff', 'Configuration|/interface/orders/types.php', '', '', 'Procedures:proimg', 100, NULL),
('Clinical Staff', 'Load Compendium|/interface/orders/load_compendium.php', '', '', 'Procedures:proimg', 200, NULL),
('Clinical Staff', 'Pending Review|/interface/orders/orders_results.php?review=1', '', '', 'Procedures:proimg', 300, NULL),
('Clinical Staff', 'Patient Results|/interface/orders/orders_results.php', '', '', 'Procedures:proimg', 400, NULL),
('Clinical Staff', 'Lab Overview|/interface/patient_file/summary/labdata.php', '', '', 'Procedures:proimg', 500, NULL),
('Clinical Staff', 'Batch Results|/interface/orders/orders_results.php?batch=1', '', '', 'Procedures:proimg', 600, NULL),
('Clinical Staff', 'Electronic Reports|/interface/orders/list_reports.php', '', '', 'Procedures:proimg', 700, NULL),
('Clinical Staff', 'Lab Documents|/interface/main/display_documents.php', '', '', 'Procedures:proimg', 800, NULL),
('Clinical Staff', 'Patient Record Request|/interface/patient_file/transaction/record_request.php', '', '', 'Records:', 200, NULL),
('Clinical Staff', 'Addr Book|/interface/usergroup/addrbook_list.php', '0', '0', 'View:', 100, NULL),
('Clinical Staff', 'Calendar|/interface/main/main_info.php', '0', '0', 'View:', 200, NULL),
('Clinical Staff', 'Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', '0', '0', 'View:', 300, NULL),
('Clinical Staff', 'Create Visit|/interface/forms/newpatient/new.php?autoloaded=1&calenc=', '0', '0', 'Visits:encounter', 0, NULL),
('Clinical Staff', 'Current|/interface/patient_file/encounter/encounter_top.php', '0', '0', 'Visits:encounter', 100, NULL),
('Clinical Staff', 'Visit History|/interface/patient_file/history/encounters.php', '0', '0', 'Visits:encounter', 200, NULL),
('default', 'Calendar|/interface/main/main_info.php', '', '', '', 0, NULL),
('default', 'Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', '', '', '', 100, NULL),
('default', 'Messages|/interface/main/messages/messages.php?form_active=1', '', '', '', 200, NULL),
('default', 'Patient/Client:patimg', '', '', '', 300, NULL),
('default', 'Appointments|/interface/reports/appointments_report.php?patient=', '', '', '', 300, NULL),
('default', 'Fees:feeimg', '', '', '', 400, NULL),
('default', 'Modules:modimg', '', '', '', 500, NULL),
('default', 'Inventory:invimg', '', '', '', 600, NULL),
('default', 'Procedures:proimg', '', '', '', 700, NULL),
('default', 'Administration:admimg', '', '', '', 800, NULL),
('default', 'Reports:repimg', '', '', '', 900, NULL),
('default', 'Miscellaneous:misimg', '', '', '', 1000, NULL),
('default', 'Popup:lists', '', '', '', 1100, NULL),
('default', 'About|/interface/main/about_page.php', '', '', '', 1200, ''),
('default', 'Globals|/interface/super/edit_globals.php', '', '', 'Administration:admimg', 0, NULL),
('default', 'Globals|/interface/super/edit_globals.php', '', '', 'Administration:admimg', 0, NULL),
('default', 'Facilities|/interface/usergroup/facilities.php', '', '', 'Administration:admimg', 100, NULL),
('default', 'Users|/interface/usergroup/usergroup_admin.php', '', '', 'Administration:admimg', 200, NULL),
('default', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'Administration:admimg', 300, NULL),
('default', 'Practice|/controller.php?practice_settings&pharmacy&action=list', '', '', 'Administration:admimg', 400, NULL),
('default', 'Codes|/interface/patient_file/encounter/superbill_custom_full.php', '', '', 'Administration:admimg', 500, NULL),
('default', 'Layouts|/interface/super/edit_layout.php', '', '', 'Administration:admimg', 600, NULL),
('default', 'Lists|/interface/super/edit_list.php', '', '', 'Administration:admimg', 700, NULL),
('default', 'ACL|/interface/usergroup/adminacl.php', '', '', 'Administration:admimg', 800, NULL),
('default', 'Files|/interface/super/manage_site_files.php', '', '', 'Administration:admimg', 900, NULL),
('default', 'Backup|/interface/main/backup.php', '', '', 'Administration:admimg', 1000, NULL),
('default', 'Rules|/interface/super/rules/index.php?action=browse!list', '', '', 'Administration:admimg', 1100, NULL),
('default', 'Alerts|/interface/super/rules/index.php?action=alerts!listactmgr', '', '', 'Administration:admimg', 1200, NULL),
('default', 'Patient Reminders|/interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id=', '', '', 'Administration:admimg', 1300, NULL),
('default', 'Other:', '', '', 'Administration:admimg', 1400, NULL),
('default', 'Demographics|/interface/patient_file/summary/demographics_print.php', '', '', 'Blank Forms:', 0, NULL),
('default', 'Superbill/Fee Sheet|/interface/patient_file/printed_fee_sheet.php', '', '', 'Blank Forms:', 100, NULL),
('default', 'Referral|/interface/patient_file/transaction/print_referral.php', '', '', 'Blank Forms:', 200, NULL),
('default', 'TestLBF|/interface/forms/LBF/printable.php?formname=LBF1', '', '', 'Blank Forms:', 300, NULL),
('default', 'List|/interface/reports/patient_list.php', '', '', 'Clients:', 0, NULL),
('default', 'Rx|/interface/reports/prescriptions_report.php', '', '', 'Clients:', 100, NULL),
('default', 'Patient List Creation|/interface/reports/patient_list_creation.php', '', '', 'Clients:', 200, NULL),
('default', 'Clinical|/interface/reports/clinical_reports.php', '', '', 'Clients:', 300, NULL),
('default', 'Referrals|/interface/reports/referrals_report.php', '', '', 'Clients:', 400, NULL),
('default', 'Immunization Registry|/interface/reports/immunization_report.php', '', '', 'Clients:', 500, NULL),
('default', 'Report Results|/interface/reports/report_results.php', '', '', 'Clinic:', 0, NULL),
('default', 'Standard Measures|/interface/reports/cqm.php?type=standard', '', '', 'Clinic:', 100, NULL),
('default', 'Quality Measures (CQM)|/interface/reports/cqm.php?type=cqm', '', '', 'Clinic:', 200, NULL),
('default', 'Automated Measures (AMC)|/interface/reports/cqm.php?type=amc', '', '', 'Clinic:', 300, NULL),
('default', 'AMC Tracking|/interface/reports/amc_tracking.php', '', '', 'Clinic:', 400, NULL),
('default', 'Alerts Log|/interface/reports/cdr_log.php', '', '', 'Clinic:', 500, NULL),
('default', 'Fee Sheet|/interface/patient_file/encounter/load_form.php?formname=fee_sheet', '', '', 'Fees:feeimg', 0, NULL),
('default', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Fees:feeimg', 100, NULL),
('default', 'Checkout|/interface/patient_file/pos_checkout.php?framed=1', '', '', 'Fees:feeimg', 200, NULL),
('default', 'Billing|/interface/billing/billing_report.php', '', '', 'Fees:feeimg', 300, NULL),
('default', 'Batch Payments|/interface/billing/new_payment.php', '', '', 'Fees:feeimg', 400, NULL),
('default', 'Posting|/interface/billing/sl_eob_search.php', '', '', 'Fees:feeimg', 500, 'Posting'),
('default', 'EDI History|/interface/billing/edih_view.php', '', '', 'Fees:feeimg', 600, NULL),
('default', 'Sales|/interface/reports/sales_by_item.php', '', '', 'Financial:', 0, NULL),
('default', 'Cash Rec|/interface/billing/sl_receipts_report.php', '', '', 'Financial:', 100, NULL),
('default', 'Front Rec|/interface/reports/front_receipts_report.php', '', '', 'Financial:', 200, NULL),
('default', 'Pmt Method|/interface/reports/receipts_by_method_report.php', '', '', 'Financial:', 300, NULL),
('default', 'Collections|/interface/reports/collections_report.php', '', '', 'Financial:', 400, NULL),
('default', 'Pat Ledger|/interface/reports/pat_ledger.php?form=0', '', '', 'Financial:', 500, NULL),
('default', 'Financial Summary by Service Code|/interface/reports/svc_code_financial_report.php', '', '', 'Financial:', 600, NULL),
('default', 'Upload|/interface/patient_file/ccr_import.php', '', '', 'Import:', 0, NULL),
('default', 'Pending Approval|/interface/patient_file/ccr_pending_approval.php', '', '', 'Import:', 100, NULL),
('default', 'Distribution|/interface/reports/insurance_allocation_report.php', '', '', 'Insurance:', 0, NULL),
('default', 'Indigents|/interface/billing/indigent_patients_report.php', '', '', 'Insurance:', 100, NULL),
('default', 'Unique SP|/interface/reports/unique_seen_patients_report.php', '', '', 'Insurance:', 200, NULL),
('default', 'List|/interface/reports/inventory_list.php', '', '', 'Inventory:invimg', 0, NULL),
('default', 'Management|/interface/drugs/drug_inventory.php', '', '', 'Inventory:invimg', 0, NULL),
('default', 'Destroyed|destroyed_drugs_report.php', '', '', 'Inventory:invimg', 100, NULL),
('default', 'Activity|/interface/reports/inventory_activity.php', '', '', 'Inventory:invimg', 100, NULL),
('default', 'Transactions|/interface/reports/inventory_transactions.php', '', '', 'Inventory:invimg', 200, NULL),
('default', 'Patient Education|/interface/reports/patient_edu_web_lookup.php', '', '', 'Miscellaneous:misimg', 0, NULL),
('default', 'Authorizations|/interface/main/authorizations/authorizations.php', '', '', 'Miscellaneous:misimg', 100, NULL),
('default', 'Fax/Scan|/interface/fax/faxq.php', '', '', 'Miscellaneous:misimg', 200, NULL),
('default', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'Miscellaneous:misimg', 300, NULL),
('default', 'Order Catalog|/interface/orders/types.php', '', '', 'Miscellaneous:misimg', 400, NULL),
('default', 'Chart Tracker|/custom/chart_tracker.php', '', '', 'Miscellaneous:misimg', 500, NULL),
('default', 'Ofc Notes|/interface/main/onotes/office_comments.php', '', '', 'Miscellaneous:misimg', 600, NULL),
('default', 'BatchCom|/interface/batchcom/batchcom.php', '', '', 'Miscellaneous:misimg', 700, NULL),
('default', 'Password|/interface/usergroup/user_info.php', '', '', 'Miscellaneous:misimg', 800, NULL),
('default', 'Preferences|/interface/super/edit_globals.php?mode=user', '', '', 'Miscellaneous:misimg', 900, NULL),
('default', 'New Documents|/controller.php?document&list&patient_id=00', '', '', 'Miscellaneous:misimg', 1000, NULL),
('default', 'Document Templates|/interface/super/manage_document_templates.php', '', '', 'Miscellaneous:misimg', 1100, NULL),
('default', 'Manage Modules|/interface/modules/zend_modules/public/Installer', '', '', 'Modules:modimg', 0, NULL),
('default', 'Language|/interface/language/language.php', '', '', 'Other:', 0, NULL),
('default', 'Forms|/interface/forms_admin/forms_admin.php', '', '', 'Other:', 100, NULL),
('default', 'Calendar|/interface/main/calendar/index.php?module=PostCalendar&type=admin&func=modifyconfig', '', '', 'Other:', 200, NULL),
('default', 'Logs|/interface/logview/logview.php', '', '', 'Other:', 300, NULL),
('default', 'Database|/phpmyadmin/index.php', '', '', 'Other:', 400, NULL),
('default', 'Certificates|/interface/usergroup/ssl_certificates_admin.php', '', '', 'Other:', 500, NULL),
('default', 'Native Data Loads|/interface/super/load_codes.php', '', '', 'Other:', 600, NULL),
('default', 'External Data Loads|/interface/code_systems/dataloads_ajax.php', '', '', 'Other:', 700, NULL),
('default', 'Merge Patients|/interface/patient_file/merge_patients.php', '', '', 'Other:', 800, NULL),
('default', 'Patients|/interface/main/finder/dynamic_finder.php', '', '', 'Patient/Client:patimg', 0, NULL),
('default', 'New/Search|/interface/new/new.php', '', '', 'Patient/Client:patimg', 100, NULL),
('default', 'Summary|/interface/patient_file/summary/demographics.php', '', '', 'Patient/Client:patimg', 200, NULL),
('default', 'Visits:encounter', '', '', 'Patient/Client:patimg', 300, NULL),
('default', 'Records:', '', '', 'Patient/Client:patimg', 400, NULL),
('default', 'Visit Forms:', '', '', 'Patient/Client:patimg', 500, NULL),
('default', 'Import:', '', '', 'Patient/Client:patimg', 600, NULL),
('default', 'Issues|/interface/patient_file/problem_encounter.php', '', '', 'Popup:lists', 0, NULL),
('default', 'Import|/custom/import_xml.php', '', '', 'Popup:lists', 100, NULL),
('default', 'Export|/custom/export_xml.php', '', '', 'Popup:lists', 200, NULL),
('default', 'Appts|/interface/reports/appointments_report.php?patient=', '', '', 'Popup:lists', 300, NULL),
('default', 'Superbill|/interface/patient_file/printed_fee_sheet.php?fill=1', '', '', 'Popup:lists', 400, NULL),
('default', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Popup:lists', 500, NULL),
('default', 'Checkout|/interface/patient_file/pos_checkout.php', '', '', 'Popup:lists', 600, NULL),
('default', 'Letter|/interface/patient_file/letter.php', '', '', 'Popup:lists', 700, NULL),
('default', 'Chart Label|/interface/patient_file/label.php', '', '', 'Popup:lists', 800, NULL),
('default', 'Barcode Label|/interface/patient_file/barcode_label.php', '', '', 'Popup:lists', 900, NULL),
('default', 'Address Label|/interface/patient_file/addr_label.php', '', '', 'Popup:lists', 1000, NULL),
('default', 'Pending Res|/interface/orders/pending_orders.php', '', '', 'Procedures:', 0, NULL),
('default', 'Statistics|/interface/orders/procedure_stats.php', '', '', 'Procedures:', 100, NULL),
('default', 'Providers|/interface/orders/procedure_provider_list.php', '', '', 'Procedures:proimg', 0, NULL),
('default', 'Configuration|/interface/orders/types.php', '', '', 'Procedures:proimg', 100, NULL),
('default', 'Load Compendium|/interface/orders/load_compendium.php', '', '', 'Procedures:proimg', 200, NULL),
('default', 'Pending Review|/interface/orders/orders_results.php?review=1', '', '', 'Procedures:proimg', 300, NULL),
('default', 'Patient Results|/interface/orders/orders_results.php', '', '', 'Procedures:proimg', 400, NULL),
('default', 'Lab Overview|/interface/patient_file/summary/labdata.php', '', '', 'Procedures:proimg', 500, NULL),
('default', 'Batch Results|/interface/orders/orders_results.php?batch=1', '', '', 'Procedures:proimg', 600, NULL),
('default', 'Electronic Reports|/interface/orders/list_reports.php', '', '', 'Procedures:proimg', 700, NULL),
('default', 'Lab Documents|/interface/main/display_documents.php', '', '', 'Procedures:proimg', 800, NULL),
('default', 'Patient Record Request|/interface/patient_file/transaction/record_request.php', '', '', 'Records:', 0, NULL),
('default', 'Clients:', '', '', 'Reports:repimg', 0, NULL),
('default', 'Clinic:', '', '', 'Reports:repimg', 100, NULL),
('default', 'Visits:reports', '', '', 'Reports:repimg', 200, NULL),
('default', 'Financial:', '', '', 'Reports:repimg', 300, NULL),
('default', 'Inventory:', '', '', 'Reports:repimg', 400, NULL),
('default', 'Procedures:', '', '', 'Reports:repimg', 500, NULL),
('default', 'Insurance:', '', '', 'Reports:repimg', 600, NULL),
('default', 'Blank Forms:', '', '', 'Reports:repimg', 700, NULL),
('default', 'Services:', '', '', 'Reports:repimg', 800, NULL),
('default', 'Background Services|/interface/reports/background_services.php', '', '', 'Services:', 0, NULL),
('default', 'Direct Message Log|/interface/reports/direct_message_log.php', '', '', 'Services:', 100, NULL),
('default', 'Create Visit|/interface/forms/newpatient/new.php?autoloaded=1&calenc=', '', '', 'Visits:encounter', 0, NULL),
('default', 'Current|/interface/patient_file/encounter/encounter_top.php', '', '', 'Visits:encounter', 100, NULL),
('default', 'Visit History|/interface/patient_file/history/encounters.php', '', '', 'Visits:encounter', 200, NULL),
('default', 'Appointments|/interface/reports/appointments_report.php', '', '', 'Visits:reports', 0, NULL),
('default', 'Patient Flow Board|/interface/reports/patient_flow_board_report.php', '', '', 'Visits:reports', 100, NULL),
('default', 'Patient Billing Encounter by Carrier|/interface/reports/encounters_report_carrier.php', '', '', 'Visits:reports', 0, NULL),
('default', 'Encounters|/interface/reports/encounters_report.php', '', '', 'Visits:reports', 200, NULL),
('default', 'Appt-Enc|/interface/reports/appt_encounter_report.php', '', '', 'Visits:reports', 300, NULL),
('default', 'Superbill|/interface/reports/custom_report_range.php', '', '', 'Visits:reports', 400, NULL),
('default', 'Eligibility|/interface/reports/edi_270.php', '', '', 'Visits:reports', 500, NULL),
('default', 'Eligibility Response|/interface/reports/edi_271.php', '', '', 'Visits:reports', 600, NULL),
('default', 'Chart Activity|/interface/reports/chart_location_activity.php', '', '', 'Visits:reports', 700, NULL),
('default', 'Charts Out|/interface/reports/charts_checked_out.php', '', '', 'Visits:reports', 800, NULL),
('default', 'Services|/interface/reports/services_by_category.php', '', '', 'Visits:reports', 900, NULL),
('default', 'Syndromic Surveillance|/interface/reports/non_reported.php', '', '', 'Visits:reports', 1000, NULL),
('Front Office', 'File:file0', '', '', '', 0, NULL),
('Front Office', 'View:', '', '', '', 100, NULL),
('Front Office', 'Patient/Client:patimg', '', '', '', 200, NULL),
('Front Office', 'Patient Reminders|/interface/patient_file/reminder/patient_reminders.php?mode=admin&patient_id=', '', '', '', 200, NULL),
('Front Office', 'Financial:top', '', '', '', 300, NULL),
('Front Office', 'Popup:lists', '', '', '', 400, NULL),
('Front Office', 'Miscellaneous:misimg', '', '', '', 500, NULL),
('Front Office', 'About|/interface/main/about_page.php', '0', '0', 'File:file0', 0, NULL),
('Front Office', 'Preferences|/interface/super/edit_globals.php?mode=user', '', '', 'File:file0', 100, NULL),
('Front Office', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Financial:top', 0, NULL),
('Front Office', 'Checkout|/interface/patient_file/pos_checkout.php', '', '', 'Financial:top', 100, NULL),
('Front Office', 'Front Rec|/interface/reports/front_receipts_report.php', '', '', 'Financial:top', 200, NULL),
('Front Office', 'Pat Ledger|/interface/reports/pat_ledger.php?form=0', '', '', 'Financial:top', 500, NULL),
('Front Office', 'Messages|/interface/main/messages/messages.php?form_active=1', '', '', 'Miscellaneous:misimg', 0, NULL),
('Front Office', 'Patient Education|/interface/reports/patient_edu_web_lookup.php', '', '', 'Miscellaneous:misimg', 100, NULL),
('Front Office', 'Patients|/interface/main/finder/dynamic_finder.php', '', '', 'Patient/Client:patimg', 0, NULL),
('Front Office', 'New/Search|/interface/new/new.php', '', '', 'Patient/Client:patimg', 100, NULL),
('Front Office', 'New/Patient|/interface/new/new.php', '', '', 'Patient/Client:patimg', 200, NULL),
('Front Office', 'Clinical|/interface/reports/clinical_reports.php', '', '', 'Patient/Client:patimg', 300, NULL),
('Front Office', 'Issues|/interface/patient_file/problem_encounter.php', '', '', 'Popup:lists', 0, NULL),
('Front Office', 'Import|/custom/import_xml.php', '', '', 'Popup:lists', 100, NULL),
('Front Office', 'Export|/custom/export_xml.php', '', '', 'Popup:lists', 200, NULL),
('Front Office', 'Appts|/interface/reports/appointments_report.php?patient=', '', '', 'Popup:lists', 300, NULL),
('Front Office', 'Superbill|/interface/patient_file/printed_fee_sheet.php?fill=1', '', '', 'Popup:lists', 400, NULL),
('Front Office', 'Payment|/interface/patient_file/front_payment.php', '', '', 'Popup:lists', 500, NULL),
('Front Office', 'Checkout|/interface/patient_file/pos_checkout.php', '', '', 'Popup:lists', 600, NULL),
('Front Office', 'Letter|/interface/patient_file/letter.php', '', '', 'Popup:lists', 700, NULL),
('Front Office', 'Chart Label|/interface/patient_file/label.php', '', '', 'Popup:lists', 800, NULL),
('Front Office', 'Barcode Label|/interface/patient_file/barcode_label.php', '', '', 'Popup:lists', 900, NULL),
('Front Office', 'Address Label|/interface/patient_file/addr_label.php', '', '', 'Popup:lists', 1000, NULL),
('Front Office', 'Addr Book|/interface/usergroup/addrbook_list.php', '', '', 'View:', 100, NULL),
('Front Office', 'Calendar|/interface/main/main_info.php', '', '', 'View:', 200, NULL),
('Front Office', 'Flow Board|/interface/patient_tracker/patient_tracker.php?skip_timeout_reset=1', '', '', 'View:', 300, NULL);
--

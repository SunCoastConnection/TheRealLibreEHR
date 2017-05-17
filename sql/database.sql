--
-- Database: `pqrs_gateway`
-- 

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
  `amendment_desc` text NOT NULL COMMENT 'Amendment Details',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `modified_by`	int(11) NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time',
  `modified_time` timestamp NULL COMMENT 'modified time',
  PRIMARY KEY amendments_id(`amendment_id`),
  KEY amendment_pid(`pid`)
) ENGINE = MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `amendments_history`
--

DROP TABLE IF EXISTS `amendments_history`;
CREATE TABLE IF NOT EXISTS `amendments_history` (
  `amendment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Amendment ID',
  `amendment_note` text NOT NULL COMMENT 'Amendment requested from',
  `amendment_status` VARCHAR(50) NULL COMMENT 'Amendment Request Status',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time',
KEY amendment_history_id(`amendment_id`)
) ENGINE = MyISAM;
	
-- --------------------------------------------------------

-- 
-- Table structure for table `array`
-- 

DROP TABLE IF EXISTS `array`;
CREATE TABLE `array` (
  `array_key` varchar(255) default NULL,
  `array_value` longtext
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `audit_master`
--

DROP TABLE IF EXISTS `audit_master`;
CREATE TABLE `audit_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'The Id of the user who approves or denies',
  `approval_status` tinyint(4) NOT NULL COMMENT '1-Pending,2-Approved,3-Denied,4-Appointment directly updated to calendar table,5-Cancelled appointment',
  `comments` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` datetime NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1-new patient,2-existing patient,3-change is only in the document,4-Patient upload,5-random key,10-Appointment',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;

--
-- Table structure for table `audit_details`
--

DROP TABLE IF EXISTS `audit_details`;
CREATE TABLE `audit_details` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `table_name` VARCHAR(100) NOT NULL COMMENT 'openemr table name',
  `field_name` VARCHAR(100) NOT NULL COMMENT 'openemr table''s field name',
  `field_value` TEXT NOT NULL COMMENT 'openemr table''s field value',
  `audit_master_id` BIGINT(20) NOT NULL COMMENT 'Id of the audit_master table',
  `entry_identification` VARCHAR(255) NOT NULL DEFAULT '1' COMMENT 'Used when multiple entry occurs from the same table.1 means no multiple entry',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1;

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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `background_services`
-- 

INSERT INTO `background_services` (`name`, `title`, `execute_interval`, `function`, `require_once`, `sort_order`) VALUES
('phimail', 'phiMail Direct Messaging Service', 5, 'phimail_check', '/library/direct_message_check.inc', 100);

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `notecodes` varchar(25) NOT NULL default '',
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

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

-- --------------------------------------------------------

-- 
-- Table structure for table `categories_seq`
-- 

DROP TABLE IF EXISTS `categories_seq`;
CREATE TABLE `categories_seq` (
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `categories_seq`
-- 

INSERT INTO `categories_seq` VALUES (13);

-- --------------------------------------------------------

-- 
-- Table structure for table `categories_to_documents`
-- 

DROP TABLE IF EXISTS `categories_to_documents`;
CREATE TABLE `categories_to_documents` (
  `category_id` int(11) NOT NULL default '0',
  `document_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`category_id`,`document_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `claims`
-- 

DROP TABLE IF EXISTS `claims`;
CREATE TABLE `claims` (
  `patient_id` int(11) NOT NULL,
  `encounter_id` int(11) NOT NULL,
  `version` int(10) unsigned NOT NULL auto_increment,
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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM ;

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

-- --------------------------------------------------------

--
-- Table structure for table `clinical_plans_rules`
--

DROP TABLE IF EXISTS `clinical_plans_rules`;
CREATE TABLE `clinical_plans_rules` (
  `plan_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_plans',
  `rule_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_rules',
  PRIMARY KEY  (`plan_id`,`rule_id`)
) ENGINE=MyISAM ;

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

-- --------------------------------------------------------


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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

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
  `reportable` TINYINT(1) DEFAULT 0 COMMENT '0 = non-reportable, 1 = reportable',
  `financial_reporting` TINYINT(1) DEFAULT 0 COMMENT '0 = negative, 1 = considered important code in financial reporting',
  PRIMARY KEY  (`id`),
  KEY `code` (`code`),
  KEY `code_type` (`code_type`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `config_seq`
-- 

DROP TABLE IF EXISTS `config_seq`;
CREATE TABLE `config_seq` (
  `id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `config_seq`
-- 

INSERT INTO `config_seq` VALUES (0);

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
  `dld_denial_reason` longtext NOT NULL,
  `dld_moved` tinyint(4) NOT NULL DEFAULT '0',
  `dld_patient_comments` text COMMENT 'Patient comments stored here',
  PRIMARY KEY (`dld_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM COMMENT='List of Master Docs to be signed' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=7 ;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
  PRIMARY KEY  (`drug_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `enc_category_map`
--
-- Mapping of rule encounter categories to category ids from the event category in openemr_postcalendar_categories
--

DROP TABLE IF EXISTS `enc_category_map`;
CREATE TABLE `enc_category_map` (
  `rule_enc_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'encounter id from rule_enc_types list in list_options',
  `main_cat_id` int(11) NOT NULL DEFAULT 0 COMMENT 'category id from event category in openemr_postcalendar_categories',
  KEY  (`rule_enc_id`,`main_cat_id`)
) ENGINE=MyISAM ;

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

-- --------------------------------------------------------

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

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `facility`
-- 

DROP TABLE IF EXISTS `facility`;
CREATE TABLE `facility` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `facility`
-- 

INSERT INTO `facility` VALUES (3, 'Your Clinic Name Here', '000-000-0000', '000-000-0000', '', '', '', '', '', '', NULL, NULL, 1, 1, 0, NULL, '', '', '', '', '','#99FFFF','0', '');


-- --------------------------------------------------------

-- 
-- Table structure for table `facility_user_ids`
-- 

DROP TABLE IF EXISTS `facility_user_ids`;
CREATE TABLE  `facility_user_ids` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) DEFAULT NULL,
  `facility_id` bigint(20) DEFAULT NULL,
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`facility_id`,`field_id`)
) ENGINE=MyISAM  AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `fee_sheet_options`
-- 

DROP TABLE IF EXISTS `fee_sheet_options`;
CREATE TABLE `fee_sheet_options` (
  `fs_category` varchar(63) default NULL,
  `fs_option` varchar(63) default NULL,
  `fs_codes` varchar(255) default NULL
) ENGINE=MyISAM;

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

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `pc_catid` int(11) NOT NULL default '5' COMMENT 'event category from openemr_postcalendar_categories',
  `last_level_billed` int  NOT NULL DEFAULT 0 COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_level_closed` int  NOT NULL DEFAULT 0 COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_stmt_date`    date DEFAULT NULL,
  `stmt_count`        int  NOT NULL DEFAULT 0,
  `provider_id` INT(11) DEFAULT '0' COMMENT 'default and main provider for this visit',
  `supervisor_id` INT(11) DEFAULT '0' COMMENT 'supervising provider, if any, for this visit',
  `invoice_refno` varchar(31) NOT NULL DEFAULT '',
  `referral_source` varchar(31) NOT NULL DEFAULT '',
  `billing_facility` INT(11) NOT NULL DEFAULT 0,
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid_encounter` (`pid`, `encounter`),
  KEY `encounter_date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `box_14_date_qual` char(3) default NULL,
  `box_15_date_qual` char(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=240 ;

-- 
-- Dumping data for table `geo_country_reference`
-- 


INSERT INTO `geo_country_reference` VALUES (223, 'United States', 'US', 'USA');
INSERT INTO `geo_country_reference` VALUES (224, 'United States Minor Outlying Islands', 'UM', 'UMI');

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=83 ;

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

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` longtext,
  `user` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `exams`      text         NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `immunizations`
-- 

DROP TABLE IF EXISTS `immunizations`;
CREATE TABLE `immunizations` (
  `id` bigint(20) NOT NULL auto_increment,
  `patient_id` int(11) default NULL,
  `administered_date` datetime default NULL,
  `immunization_id` int(11) default NULL,
  `cvx_code` int(11) default NULL,
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
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `insurance_companies`
-- 

DROP TABLE IF EXISTS `insurance_companies`;
CREATE TABLE `insurance_companies` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `attn` varchar(255) default NULL,
  `cms_id` varchar(15) default NULL,
  `freeb_type` tinyint(2) default NULL,
  `x12_receiver_id` varchar(25) default NULL,
  `x12_default_partner_id` int(11) default NULL,
  `alt_cms_id` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `pid` bigint(20) NOT NULL default '0',
  `subscriber_sex` varchar(25) default NULL,
  `accept_assignment` varchar(5) NOT NULL DEFAULT 'TRUE',
  `policy_type` varchar(25) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pid_type_date` (`pid`,`type`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `integration_mapping`
-- 

DROP TABLE IF EXISTS `integration_mapping`;
CREATE TABLE `integration_mapping` (
  `id` int(11) NOT NULL default '0',
  `foreign_id` int(11) NOT NULL default '0',
  `foreign_table` varchar(125) default NULL,
  `local_id` int(11) NOT NULL default '0',
  `local_table` varchar(125) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `foreign_id` (`foreign_id`,`foreign_table`,`local_id`,`local_table`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

--
-- Dumping data for table `issue_types`
--

INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('10','default','medical_problem','Medical Problems','Problem','P','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('30','default','medication','Medications','Medication','M','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('20','default','allergy','Allergies','Allergy','A','0','1');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('40','default','surgery','Surgeries','Surgery','S','0','0');
INSERT INTO issue_types(`ordering`,`category`,`type`,`plural`,`singular`,`abbreviation`,`style`,`force_show`) VALUES ('50','default','dental','Dental Issues','Dental','D','0','0');


-- --------------------------------------------------------

-- 
-- Table structure for table `lang_constants`
-- 

DROP TABLE IF EXISTS `lang_constants`;
CREATE TABLE `lang_constants` (
  `cons_id` int(11) NOT NULL auto_increment,
  `constant_name` mediumtext BINARY,
  UNIQUE KEY `cons_id` (`cons_id`),
  KEY `constant_name` (`constant_name`(100))
) ENGINE=MyISAM ;

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
) ENGINE=MyISAM ;

-- 
-- Table structure for table `lang_languages`
-- 

DROP TABLE IF EXISTS `lang_languages`;
CREATE TABLE `lang_languages` (
  `lang_id` int(11) NOT NULL auto_increment,
  `lang_code` char(2) NOT NULL default '',
  `lang_description` varchar(100) default NULL,
  UNIQUE KEY `lang_id` (`lang_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `lang_languages`
-- 

INSERT INTO `lang_languages` VALUES (1, 'en', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `lang_custom`
--

DROP TABLE IF EXISTS `lang_custom`;
CREATE TABLE `lang_custom` (
  `lang_description` varchar(100) NOT NULL default '',
  `lang_code` char(2) NOT NULL default '',
  `constant_name` mediumtext NOT NULL default '',
  `definition` mediumtext NOT NULL default ''
) ENGINE=MyISAM ;

-- --------------------------------------------------------

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
  `conditions` text NOT NULL DEFAULT '' COMMENT 'serialized array of skip conditions',
  PRIMARY KEY  (`form_id`,`field_id`,`seq`)
) ENGINE=MyISAM;

INSERT INTO `layout_options` (`form_id`, `field_id`, `group_name`, `title`, `seq`, `data_type`, `uor`, `fld_length`, `max_length`, `list_id`, `titlecols`, `datacols`, `default_value`, `edit_options`, `description`, `fld_rows`, `list_backup_id`, `source`, `conditions`) VALUES
('DEM', 'title', '1Facesheet', 'Name', 1, 1, 0, 0, 0, 'titles', 1, 1, '', 'N', 'Title', 0, '', 'F', ''),
('DEM', 'fname', '1Facesheet', 'Name', 2, 2, 2, 10, 63, '', 1, 3, '', 'CD', 'First Name', 0, '', 'F', ''),
('DEM', 'mname', '1Facesheet', '', 3, 2, 1, 2, 63, '', 0, 0, '', 'C', 'Middle Name', 0, '', 'F', ''),
('DEM', 'lname', '1Facesheet', '', 4, 2, 2, 10, 63, '', 0, 0, '', 'CD', 'Last Name', 0, '', 'F', ''),
('DEM', 'pubpid', '1Facesheet', 'Patient ID', 5, 2, 0, 10, 15, '', 1, 1, '', 'ND', 'External identifier', 0, '', 'F', ''),
('DEM', 'DOB', '1Facesheet', 'DOB', 6, 4, 2, 0, 10, '', 1, 1, '', 'D', 'Date of Birth', 0, '', 'F', ''),
('DEM', 'sex', '1Facesheet', 'Sex', 7, 1, 2, 0, 0, 'sex', 1, 1, '', 'N', 'Sex', 0, '', 'F', ''),
('DEM', 'ss', '1Facesheet', 'S.S.', 10, 2, 0, 11, 11, '', 1, 1, '', '', 'Social Security Number', 0, '', 'F', ''),
('DEM', 'drivers_license', '1Facesheet', 'License/ID', 9, 2, 0, 15, 63, '', 1, 1, '', '', 'Drivers License or State ID', 0, '', 'F', ''),
('DEM', 'status', '1Facesheet', 'Marital Status', 10, 1, 0, 0, 0, 'marital', 1, 3, '', '', 'Marital Status', 0, '', 'F', ''),
('DEM', 'genericname1', '1Facesheet', 'User Defined', 11, 2, 0, 15, 63, '', 1, 3, '', '', 'User Defined Field', 0, '', 'F', ''),
('DEM', 'genericval1', '1Facesheet', '', 12, 2, 0, 15, 63, '', 0, 0, '', '', 'User Defined Field', 0, '', 'F', ''),
('DEM', 'genericname2', '1Facesheet', '', 13, 2, 0, 15, 63, '', 0, 0, '', '', 'User Defined Field', 0, '', 'F', ''),
('DEM', 'genericval2', '1Facesheet', '', 14, 2, 0, 15, 63, '', 0, 0, '', '', 'User Defined Field', 0, '', 'F', ''),
('DEM', 'squad', '1Facesheet', 'Squad', 15, 13, 0, 0, 0, '', 1, 3, '', '', 'Squad Membership', 0, '', 'F', ''),
('DEM', 'pricelevel', '1Facesheet', 'Price Level', 16, 1, 0, 0, 0, 'pricelevel', 1, 1, '', '', 'Discount Level', 0, '', 'F', ''),
('DEM', 'street', '2Contact', 'Address', 1, 2, 1, 25, 63, '', 1, 1, '', 'C', 'Street and Number', 0, '', 'F', ''),
('DEM', 'city', '2Contact', 'City', 2, 2, 1, 15, 63, '', 1, 1, '', 'C', 'City Name', 0, '', 'F', ''),
('DEM', 'state', '2Contact', 'State', 3, 26, 1, 0, 0, 'state', 1, 1, '', '', 'State/Locality', 0, '', 'F', ''),
('DEM', 'postal_code', '2Contact', 'Postal Code', 4, 2, 1, 6, 63, '', 1, 1, '', '', 'Postal Code', 0, '', 'F', ''),
('DEM', 'country_code', '2Contact', 'Country', 5, 26, 1, 0, 0, 'country', 1, 1, '', '', 'Country', 0, '', 'F', ''),
('DEM', 'county', '2Contact', 'County', 5, 26, 0, 0, 0, 'county', 1, 1, '', '', 'County', 0, '', 'F', ''),
('DEM', 'mothersname', '2Contact', 'Mother\'s Name', 6, 2, 0, 20, 63, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'guardiansname', '2Contact', 'Guardian\'s Name', 7, 2, 0, 20, 63, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'contact_relationship', '2Contact', 'Emergency Contact', 8, 2, 0, 10, 63, '', 1, 1, '', 'C', 'Emergency Contact Person', 0, '', 'F', ''),
('DEM', 'phone_contact', '2Contact', 'Emergency Phone', 9, 2, 0, 20, 63, '', 1, 1, '', 'P', 'Emergency Contact Phone Number', 0, '', 'F', ''),
('DEM', 'phone_home', '2Contact', 'Home Phone', 10, 2, 0, 20, 63, '', 1, 1, '', 'P', 'Home Phone Number', 0, '', 'F', ''),
('DEM', 'phone_biz', '2Contact', 'Work Phone', 11, 2, 0, 20, 63, '', 1, 1, '', 'P', 'Work Phone Number', 0, '', 'F', ''),
('DEM', 'phone_cell', '2Contact', 'Mobile Phone', 12, 2, 0, 20, 63, '', 1, 1, '', 'P', 'Cell Phone Number', 0, '', 'F', ''),
('DEM', 'email', '2Contact', 'Contact Email', 13, 2, 0, 30, 95, '', 1, 1, '', '', 'Contact Email Address', 0, '', 'F', ''),
('DEM', 'email_direct', '2Contact', 'Trusted Email', 14, 2, 0, 30, 95, '', 1, 1, '', '', 'Trusted Direct Email Address', 0, '', 'F', ''),
('DEM', 'providerID', '1Facesheet', 'Provider', 8, 11, 1, 0, 0, '', 1, 3, '', '', 'Provider', 0, '', 'F', ''),
('DEM', 'ref_providerID', '1Facesheet', 'Referring Provider', 9, 11, 1, 0, 0, '', 1, 3, '', '', 'Referring Provider', 0, '', 'F', ''),
('DEM', 'pharmacy_id', '3Choices', 'Pharmacy', 3, 12, 0, 0, 0, '', 1, 3, '', '', 'Preferred Pharmacy', 0, '', 'F', ''),
('DEM', 'hipaa_notice', '3Choices', 'HIPAA Notice Received', 4, 1, 0, 0, 0, 'yesno', 1, 1, '', '', 'Did you receive a copy of the HIPAA Notice?', 0, '', 'F', ''),
('DEM', 'hipaa_voice', '3Choices', 'Allow Voice Message', 5, 1, 0, 0, 0, 'yesno', 1, 1, '', '', 'Allow telephone messages?', 0, '', 'F', ''),
('DEM', 'hipaa_message', '3Choices', 'Leave Message With', 6, 2, 0, 20, 63, '', 1, 1, '', '', 'With whom may we leave a message?', 0, '', 'F', ''),
('DEM', 'hipaa_mail', '3Choices', 'Allow Mail Message', 7, 1, 0, 0, 0, 'yesno', 1, 1, '', '', 'Allow email messages?', 0, '', 'F', ''),
('DEM', 'hipaa_allowsms', '3Choices', 'Allow SMS', 8, 1, 0, 0, 0, 'yesno', 1, 1, '', '', 'Allow SMS (text messages)?', 0, '', 'F', ''),
('DEM', 'hipaa_allowemail', '3Choices', 'Allow Email', 9, 1, 0, 0, 0, 'yesno', 1, 1, '', '', 'Allow Email?', 0, '', 'F', ''),
('DEM', 'allow_imm_reg_use', '3Choices', 'Allow Immunization Registry Use', 10, 1, 0, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_imm_info_share', '3Choices', 'Allow Immunization Info Sharing', 11, 1, 0, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_health_info_ex', '3Choices', 'Allow Health Information Exchange', 12, 1, 0, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_patient_portal', '3Choices', 'Allow Patient Portal', 13, 1, 0, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'care_team', '3Choices', 'Care Team', 14, 11, 0, 0, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'cmsportal_login', '3Choices', 'CMS Portal Login', 15, 2, 0, 30, 60, '', 1, 1, '', '', 'CMS Portal Login ID', 0, '', 'F', ''),
('DEM', 'occupation', '4Employer', 'Occupation', 1, 26, 0, 0, 0, 'Occupation', 1, 1, '', '', 'Occupation', 0, '', 'F', ''),
('DEM', 'industry', '4Employer', 'Industry', 1, 26, 0, 0, 0, 'Industry', 1, 1, '', '', 'Industry', 0, '', 'F', ''),
('DEM', 'em_name', '4Employer', 'Employer Name', 2, 2, 0, 20, 63, '', 1, 1, '', 'C', 'Employer Name', 0, '', 'F', ''),
('DEM', 'em_street', '4Employer', 'Employer Address', 3, 2, 0, 25, 63, '', 1, 1, '', 'C', 'Street and Number', 0, '', 'F', ''),
('DEM', 'em_city', '4Employer', 'City', 4, 2, 0, 15, 63, '', 1, 1, '', 'C', 'City Name', 0, '', 'F', ''),
('DEM', 'em_state', '4Employer', 'State', 5, 26, 0, 0, 0, 'state', 1, 1, '', '', 'State/Locality', 0, '', 'F', ''),
('DEM', 'em_postal_code', '4Employer', 'Postal Code', 6, 2, 0, 6, 63, '', 1, 1, '', '', 'Postal Code', 0, '', 'F', ''),
('DEM', 'em_country', '4Employer', 'Country', 7, 26, 0, 0, 0, 'country', 1, 1, '', '', 'Country', 0, '', 'F', ''),
('DEM', 'language', '5Stats', 'Language', 1, 1, 0, 0, 0, 'language', 1, 3, '', '', 'Preferred Language', 0, '', 'F', ''),
('DEM', 'ethnicity', '5Stats', 'Ethnicity', 2, 33, 0, 0, 0, 'ethnicity', 1, 1, '', '', 'Ethnicity', 0, 'ethrace', 'F', ''),
('DEM', 'race', '5Stats', 'Race', 3, 36, 1, 0, 0, 'race', 1, 1, '', '', 'Race', 0, 'ethrace', 'F', ''),
('DEM', 'financial_review', '5Stats', 'Financial Review Date', 4, 2, 0, 10, 20, '', 1, 1, '', 'D', 'Financial Review Date', 0, '', 'F', ''),
('DEM', 'family_size', '5Stats', 'Family Size', 4, 2, 0, 20, 63, '', 1, 1, '', '', 'Family Size', 0, '', 'F', ''),
('DEM', 'monthly_income', '5Stats', 'Monthly Income', 5, 2, 0, 20, 63, '', 1, 1, '', '', 'Monthly Income', 0, '', 'F', ''),
('DEM', 'homeless', '5Stats', 'Homeless, etc.', 6, 2, 0, 20, 63, '', 1, 1, '', '', 'Homeless or similar?', 0, '', 'F', ''),
('DEM', 'interpretter', '5Stats', 'Interpreter', 7, 2, 0, 20, 63, '', 1, 1, '', '', 'Interpreter needed?', 0, '', 'F', ''),
('DEM', 'migrantseasonal', '5Stats', 'Migrant/Seasonal', 8, 2, 0, 20, 63, '', 1, 1, '', '', 'Migrant or seasonal worker?', 0, '', 'F', ''),
('DEM', 'contrastart', '5Stats', 'Contraceptives Start', 9, 4, 0, 0, 10, '', 1, 1, '', '', 'Date contraceptive services initially provided', 0, '', 'F', ''),
('DEM', 'referral_source', '5Stats', 'Referral Source', 10, 26, 0, 0, 0, 'refsource', 1, 1, '', '', 'How did they hear about us', 0, '', 'F', ''),
('DEM', 'vfc', '5Stats', 'VFC', 12, 1, 0, 0, 0, 'eligibility', 1, 1, '', '', 'Eligibility status for Vaccine for Children supplied vaccine', 0, '', 'F', ''),
('DEM', 'religion', '5Stats', 'Religion', 13, 1, 0, 0, 0, 'religious_affiliation', 1, 3, '', '', 'Patient Religion', 0, '', 'F', ''),
('DEM', 'deceased_date', '6Misc', 'Date Deceased', 1, 4, 1, 0, 20, '', 1, 3, '', 'D', 'If person is deceased, then enter date of death.', 0, '', 'F', ''),
('DEM', 'deceased_reason', '6Misc', 'Reason Deceased', 2, 2, 1, 30, 255, '', 1, 3, '', '', 'Reason for Death', 0, '', 'F', ''),
('DEM', 'usertext1', '6Misc', 'User Defined Text 1', 3, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext2', '6Misc', 'User Defined Text 2', 4, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext3', '6Misc', 'User Defined Text 3', 5, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext4', '6Misc', 'User Defined Text 4', 6, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext5', '6Misc', 'User Defined Text 5', 7, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext6', '6Misc', 'User Defined Text 6', 8, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext7', '6Misc', 'User Defined Text 7', 9, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'usertext8', '6Misc', 'User Defined Text 8', 10, 2, 0, 10, 63, '', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist1', '6Misc', 'User Defined List 1', 11, 1, 0, 0, 0, 'userlist1', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist2', '6Misc', 'User DefinedList 2', 12, 1, 0, 0, 0, 'userlist2', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist3', '6Misc', 'User Defined List 3', 13, 1, 0, 0, 0, 'userlist3', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist4', '6Misc', 'User Defined List 4', 14, 1, 0, 0, 0, 'userlist4', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist5', '6Misc', 'User Defined List 5', 15, 1, 0, 0, 0, 'userlist5', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist6', '6Misc', 'User Defined List 6', 16, 1, 0, 0, 0, 'userlist6', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'userlist7', '6Misc', 'User Defined List 7', 17, 1, 0, 0, 0, 'userlist7', 1, 1, '', '', 'User Defined', 0, '', 'F', ''),
('DEM', 'regdate', '6Misc', 'Registration Date', 18, 4, 0, 0, 10, '', 1, 1, '', 'D', 'Start Date at This Clinic', 0, '', 'F', ''),
('LBTref', 'refer_date', '1Referral', 'Referral Date', 1, 4, 2, 0, 0, '', 1, 1, 'C', 'D', 'Date of referral', 0, '', 'F', ''),
('LBTref', 'refer_from', '1Referral', 'Refer By', 2, 10, 2, 0, 0, '', 1, 1, '', '', 'Referral By', 0, '', 'F', ''),
('LBTref', 'refer_external', '1Referral', 'External Referral', 3, 1, 1, 0, 0, 'boolean', 1, 1, '', '', 'External referral?', 0, '', 'F', ''),
('LBTref', 'refer_to', '1Referral', 'Refer To', 4, 14, 2, 0, 0, '', 1, 1, '', '', 'Referral To', 0, '', 'F', ''),
('LBTref', 'body', '1Referral', 'Reason', 5, 3, 2, 30, 0, '', 1, 1, '', '', 'Reason for referral', 3, '', 'F', ''),
('LBTref', 'refer_diag', '1Referral', 'Referrer Diagnosis', 6, 2, 1, 30, 255, '', 1, 1, '', 'X', 'Referrer diagnosis', 0, '', 'F', ''),
('LBTref', 'refer_risk_level', '1Referral', 'Risk Level', 7, 1, 1, 0, 0, 'risklevel', 1, 1, '', '', 'Level of urgency', 0, '', 'F', ''),
('LBTref', 'refer_vitals', '1Referral', 'Include Vitals', 8, 1, 1, 0, 0, 'boolean', 1, 1, '', '', 'Include vitals data?', 0, '', 'F', ''),
('LBTref', 'refer_related_code', '1Referral', 'Requested Service', 9, 15, 1, 30, 255, '', 1, 1, '', '', 'Billing Code for Requested Service', 0, '', 'F', ''),
('LBTref', 'reply_date', '2Counter-Referral', 'Reply Date', 10, 4, 1, 0, 0, '', 1, 1, '', 'D', 'Date of reply', 0, '', 'F', ''),
('LBTref', 'reply_from', '2Counter-Referral', 'Reply From', 11, 2, 1, 30, 255, '', 1, 1, '', '', 'Who replied?', 0, '', 'F', ''),
('LBTref', 'reply_init_diag', '2Counter-Referral', 'Presumed Diagnosis', 12, 2, 1, 30, 255, '', 1, 1, '', '', 'Presumed diagnosis by specialist', 0, '', 'F', ''),
('LBTref', 'reply_final_diag', '2Counter-Referral', 'Final Diagnosis', 13, 2, 1, 30, 255, '', 1, 1, '', '', 'Final diagnosis by specialist', 0, '', 'F', ''),
('LBTref', 'reply_documents', '2Counter-Referral', 'Documents', 14, 2, 1, 30, 255, '', 1, 1, '', '', 'Where may related scanned or paper documents be found?', 0, '', 'F', ''),
('LBTref', 'reply_findings', '2Counter-Referral', 'Findings', 15, 3, 1, 30, 0, '', 1, 1, '', '', 'Findings by specialist', 3, '', 'F', ''),
('LBTref', 'reply_services', '2Counter-Referral', 'Services Provided', 16, 3, 1, 30, 0, '', 1, 1, '', '', 'Service provided by specialist', 3, '', 'F', ''),
('LBTref', 'reply_recommend', '2Counter-Referral', 'Recommendations', 17, 3, 1, 30, 0, '', 1, 1, '', '', 'Recommendations by specialist', 3, '', 'F', ''),
('LBTref', 'reply_rx_refer', '2Counter-Referral', 'Prescriptions/Referrals', 18, 3, 1, 30, 0, '', 1, 1, '', '', 'Prescriptions and/or referrals by specialist', 3, '', 'F', ''),
('LBTptreq', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', ''),
('LBTphreq', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', ''),
('LBTlegal', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', ''),
('LBTbill', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', ''),
('HIS', 'usertext11', '1General', 'Risk Factors', 1, 21, 1, 0, 0, 'riskfactors', 1, 1, '', '', 'Risk Factors', 0, '', 'F', ''),
('HIS', 'exams', '1General', 'Exams/Tests', 2, 23, 1, 0, 0, 'exams', 1, 1, '', '', 'Exam and test results', 0, '', 'F', ''),
('HIS', 'history_father', '2Family History', 'Father', 1, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'dc_father', '2Family History', 'Diagnosis Code', 2, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'history_mother', '2Family History', 'Mother', 3, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'dc_mother', '2Family History', 'Diagnosis Code', 4, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'history_siblings', '2Family History', 'Siblings', 5, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'dc_siblings', '2Family History', 'Diagnosis Code', 6, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'history_spouse', '2Family History', 'Spouse', 7, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'dc_spouse', '2Family History', 'Diagnosis Code', 8, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'history_offspring', '2Family History', 'Offspring', 9, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'dc_offspring', '2Family History', 'Diagnosis Code', 10, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_cancer', '3Relatives', 'Cancer', 1, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_tuberculosis', '3Relatives', 'Tuberculosis', 2, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_diabetes', '3Relatives', 'Diabetes', 3, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_high_blood_pressure', '3Relatives', 'High Blood Pressure', 4, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_heart_problems', '3Relatives', 'Heart Problems', 5, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_stroke', '3Relatives', 'Stroke', 6, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_epilepsy', '3Relatives', 'Epilepsy', 7, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_mental_illness', '3Relatives', 'Mental Illness', 8, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('HIS', 'relatives_suicide', '3Relatives', 'Suicide', 9, 2, 1, 20, 0, '', 1, 3, '', '', '', 0, '', 'F', ''),
('HIS', 'coffee', '4Lifestyle', 'Coffee', 2, 28, 1, 20, 0, '', 1, 3, '', '', 'Caffeine consumption', 0, '', 'F', ''),
('HIS', 'tobacco', '4Lifestyle', 'Tobacco', 1, 32, 1, 0, 0, 'smoking_status', 1, 3, '', '', 'Tobacco use', 0, '', 'F', ''),
('HIS', 'alcohol', '4Lifestyle', 'Alcohol', 3, 28, 1, 20, 0, '', 1, 3, '', '', 'Alcohol consumption', 0, '', 'F', ''),
('HIS', 'recreational_drugs', '4Lifestyle', 'Recreational Drugs', 4, 28, 1, 20, 0, '', 1, 3, '', '', 'Recreational drug use', 0, '', 'F', ''),
('HIS', 'counseling', '4Lifestyle', 'Counseling', 5, 28, 1, 20, 0, '', 1, 3, '', '', 'Counseling activities', 0, '', 'F', ''),
('HIS', 'exercise_patterns', '4Lifestyle', 'Exercise Patterns', 6, 28, 1, 20, 0, '', 1, 3, '', '', 'Exercise patterns', 0, '', 'F', ''),
('HIS', 'hazardous_activities', '4Lifestyle', 'Hazardous Activities', 7, 28, 1, 20, 0, '', 1, 3, '', '', 'Hazardous activities', 0, '', 'F', ''),
('HIS', 'sleep_patterns', '4Lifestyle', 'Sleep Patterns', 8, 2, 1, 20, 0, '', 1, 3, '', '', 'Sleep patterns', 0, '', 'F', ''),
('HIS', 'seatbelt_use', '4Lifestyle', 'Seatbelt Use', 9, 2, 1, 20, 0, '', 1, 3, '', '', 'Seatbelt use', 0, '', 'F', ''),
('HIS', 'name_1', '5Other', 'Name/Value', 1, 2, 1, 10, 255, '', 1, 1, '', '', 'Name 1', 0, '', 'F', ''),
('HIS', 'value_1', '5Other', '', 2, 2, 1, 10, 255, '', 0, 0, '', '', 'Value 1', 0, '', 'F', ''),
('HIS', 'name_2', '5Other', 'Name/Value', 3, 2, 1, 10, 255, '', 1, 1, '', '', 'Name 2', 0, '', 'F', ''),
('HIS', 'value_2', '5Other', '', 4, 2, 1, 10, 255, '', 0, 0, '', '', 'Value 2', 0, '', 'F', ''),
('HIS', 'additional_history', '5Other', 'Additional History', 5, 3, 1, 30, 0, '', 1, 3, '', '', 'Additional history notes', 3, '', 'F', ''),
('HIS', 'userarea11', '5Other', 'User Defined Area 11', 6, 3, 0, 30, 0, '', 1, 3, '', '', 'User Defined', 3, '', 'F', ''),
('HIS', 'userarea12', '5Other', 'User Defined Area 12', 7, 3, 0, 30, 0, '', 1, 3, '', '', 'User Defined', 3, '', 'F', ''),
('FACUSR', 'provider_id', '1General', 'Provider ID', 1, 2, 1, 15, 63, '', 1, 1, '', '', 'Provider ID at Specified Facility', 0, '', 'F', '');
-- --------------------------------------------------------

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
  PRIMARY KEY  (`list_id`,`option_id`)
) ENGINE=MyISAM;

-- 
-- Dumping data for table `list_options`
-- 

INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('yesno', 'NO', 'NO', 1, 0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('yesno', 'YES', 'YES', 2, 0);
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
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','1','suspension' ,1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','2','tablet'     ,2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','3','capsule'    ,3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','4','solution'   ,4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','5','tsp'        ,5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','6','ml'         ,6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','7','units'      ,7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','8','inhalations',8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','9','gtts(drops)',9,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','10','cream'   ,10,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_form','11','ointment',11,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','0',''          ,0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','1','mg'    ,1,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','2','mg/1cc',2,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','3','mg/2cc',3,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','4','mg/3cc',4,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','5','mg/4cc',5,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','6','mg/5cc',6,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','7','mcg'   ,7,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_units','8','grams' ,8,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default ) VALUES ('drug_route', '0',''                 , 0,0);
INSERT INTO list_options ( list_id, option_id, title, seq, is_default, notes ) VALUES ('drug_route', '1','Per Oris'         , 1,0, 'PO');
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


-- Immunization Completion Status

INSERT INTO list_options (list_id, option_id, title) VALUES ('lists','Immunization_Completion_Status','Immunization Completion Status');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Completed','completed','CP', '10');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Refused','Refused','RE', '20');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Not_Administered','Not Administered','NA', '30');
INSERT INTO list_options (list_id, option_id, title, notes, seq) VALUES ('Immunization_Completion_Status','Partially_Administered','Partially Administered','PA', '40');

-- --------------------------------------------------------

-- 
-- Table structure for table `lists`
-- 

DROP TABLE IF EXISTS `lists`;
CREATE TABLE `lists` (
  `id` bigint(20) NOT NULL auto_increment,
  `date` datetime default NULL,
  `type` varchar(255) default NULL,
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
  `erx_source` ENUM('0','1') DEFAULT '0' NOT NULL  COMMENT '0-OpenEMR 1-External',
  `erx_uploaded` ENUM('0','1') DEFAULT '0' NOT NULL  COMMENT '0-Pending NewCrop upload 1-Uploaded TO NewCrop',
  `modifydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `severity_al` VARCHAR( 50 ) DEFAULT NULL,
  `external_id` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lists_touch`
--

DROP TABLE IF EXISTS `lists_touch`;
CREATE TABLE `lists_touch` (
  `pid` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`pid`,`type`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
  `checksum` longtext default NULL,
  `crt_user` varchar(255) default NULL,
  `log_from` VARCHAR(20) DEFAULT 'open-emr',
  `menu_item_id` INT(11) DEFAULT NULL,
  `ccda_doc_id` INT(11) DEFAULT NULL COMMENT 'CCDA document id from ccda',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `modules`
--
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

-- --------------------------------------------------------

--
-- Table structure for table `module_acl_group_settings`
--
CREATE TABLE `module_acl_group_settings` (
  `module_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`group_id`,`section_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `module_acl_sections`
--
CREATE TABLE `module_acl_sections` (
  `section_id` int(11) DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `parent_section` int(11) DEFAULT NULL,
  `section_identifier` varchar(50) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `module_acl_user_settings`
--
CREATE TABLE `module_acl_user_settings` (
  `module_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `allowed` int(1) DEFAULT NULL,
  PRIMARY KEY (`module_id`,`user_id`,`section_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `module_configuration`
--
CREATE TABLE `module_configuration` (
  `module_config_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `field_name` varchar(45) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  PRIMARY KEY (`module_config_id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `modules_hooks_settings`
--
CREATE TABLE `modules_hooks_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_id` int(11) DEFAULT NULL,
  `enabled_hooks` varchar(255) DEFAULT NULL,
  `attached_to` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `modules_settings`
--
CREATE TABLE `modules_settings` (
  `mod_id` INT(11) DEFAULT NULL,
  `fld_type` SMALLINT(6) DEFAULT NULL COMMENT '1=>ACL,2=>preferences,3=>hooks',
  `obj_name` VARCHAR(255) DEFAULT NULL,
  `menu_name` VARCHAR(255) DEFAULT NULL,
  `path` VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_module_vars`
-- 

DROP TABLE IF EXISTS `openemr_module_vars`;
CREATE TABLE `openemr_module_vars` (
  `pn_id` int(11) unsigned NOT NULL auto_increment,
  `pn_modname` varchar(64) default NULL,
  `pn_name` varchar(64) default NULL,
  `pn_value` longtext,
  PRIMARY KEY  (`pn_id`),
  KEY `pn_modname` (`pn_modname`),
  KEY `pn_name` (`pn_name`)
) ENGINE=MyISAM AUTO_INCREMENT=235 ;

-- 
-- Dumping data for table `openemr_module_vars`
-- 

INSERT INTO `openemr_module_vars` VALUES (234, 'PostCalendar', 'pcNotifyEmail', '');
INSERT INTO `openemr_module_vars` VALUES (233, 'PostCalendar', 'pcNotifyAdmin', '0');
INSERT INTO `openemr_module_vars` VALUES (232, 'PostCalendar', 'pcCacheLifetime', '3600');
INSERT INTO `openemr_module_vars` VALUES (231, 'PostCalendar', 'pcUseCache', '0');
INSERT INTO `openemr_module_vars` VALUES (230, 'PostCalendar', 'pcDefaultView', 'day');
INSERT INTO `openemr_module_vars` VALUES (229, 'PostCalendar', 'pcTimeIncrement', '5');
INSERT INTO `openemr_module_vars` VALUES (228, 'PostCalendar', 'pcAllowUserCalendar', '1');
INSERT INTO `openemr_module_vars` VALUES (227, 'PostCalendar', 'pcAllowSiteWide', '1');
INSERT INTO `openemr_module_vars` VALUES (226, 'PostCalendar', 'pcTemplate', 'default');
INSERT INTO `openemr_module_vars` VALUES (225, 'PostCalendar', 'pcEventDateFormat', '%Y-%m-%d');
INSERT INTO `openemr_module_vars` VALUES (224, 'PostCalendar', 'pcDisplayTopics', '0');
INSERT INTO `openemr_module_vars` VALUES (223, 'PostCalendar', 'pcListHowManyEvents', '15');
INSERT INTO `openemr_module_vars` VALUES (222, 'PostCalendar', 'pcAllowDirectSubmit', '1');
INSERT INTO `openemr_module_vars` VALUES (221, 'PostCalendar', 'pcUsePopups', '0');
INSERT INTO `openemr_module_vars` VALUES (220, 'PostCalendar', 'pcDayHighlightColor', '#EEEEEE');
INSERT INTO `openemr_module_vars` VALUES (219, 'PostCalendar', 'pcFirstDayOfWeek', '1');
INSERT INTO `openemr_module_vars` VALUES (218, 'PostCalendar', 'pcUseInternationalDates', '0');
INSERT INTO `openemr_module_vars` VALUES (217, 'PostCalendar', 'pcEventsOpenInNewWindow', '0');
INSERT INTO `openemr_module_vars` VALUES (216, 'PostCalendar', 'pcTime24Hours', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_modules`
-- 

DROP TABLE IF EXISTS `openemr_modules`;
CREATE TABLE `openemr_modules` (
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
) ENGINE=MyISAM AUTO_INCREMENT=47 ;

-- 
-- Dumping data for table `openemr_modules`
-- 

INSERT INTO `openemr_modules` VALUES (46, 'PostCalendar', 2, 'PostCalendar', 'PostNuke Calendar Module', 0, 'PostCalendar', '4.0.0', 1, 1, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_postcalendar_categories`
-- 

DROP TABLE IF EXISTS `openemr_postcalendar_categories`;
CREATE TABLE `openemr_postcalendar_categories` (
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
  PRIMARY KEY  (`pc_catid`),
  KEY `basic_cat` (`pc_catname`,`pc_catcolor`)
) ENGINE=MyISAM AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `openemr_postcalendar_categories`
-- 

INSERT INTO `openemr_postcalendar_categories` VALUES (5, 'Office Visit', '#FFFFCC', 'Normal Office Visit', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0,0);
INSERT INTO `openemr_postcalendar_categories` VALUES (4, 'Vacation', '#EFEFEF', 'Reserved for use to define Scheduled Vacation Time', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 0, 0, 0, 1, 0, 1);
INSERT INTO `openemr_postcalendar_categories` VALUES (1, 'Imported Encounter', '#DDDDDD', 'Reserved to define when an event did not occur as specified.', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `openemr_postcalendar_categories` VALUES (2, 'In Office', '#99CCFF', 'Reserved todefine when a provider may haveavailable appointments after.', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 1, 3, 2, 0, 0, 1);
INSERT INTO `openemr_postcalendar_categories` VALUES (3, 'Out Of Office', '#99FFFF', 'Reserved to define when a provider may not have available appointments after.', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 0, 1, 3, 2, 0, 0, 1);
INSERT INTO `openemr_postcalendar_categories` VALUES (8, 'Lunch', '#FFFF33', 'Lunch', 1, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"1";s:22:"event_repeat_freq_type";s:1:"4";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 3600, 0, 3, 2, 0, 0, 1);
INSERT INTO `openemr_postcalendar_categories` VALUES (9, 'Established Patient', '#CCFF33', '', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 900, 0, 0, 0, 0, 0, 0);
INSERT INTO `openemr_postcalendar_categories` VALUES (10,'New Patient', '#CCFFFF', '', 0, NULL, 'a:5:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";}', 0, 1800, 0, 0, 0, 0, 0, 0);
INSERT INTO `openemr_postcalendar_categories` VALUES (11,'Reserved','#FF7777','Reserved',1,NULL,'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}',0,900,0,3,2,0,0, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_postcalendar_events`
-- 

DROP TABLE IF EXISTS `openemr_postcalendar_events`;
CREATE TABLE `openemr_postcalendar_events` (
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
) ENGINE=MyISAM AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_postcalendar_limits`
-- 

DROP TABLE IF EXISTS `openemr_postcalendar_limits`;
CREATE TABLE `openemr_postcalendar_limits` (
  `pc_limitid` int(11) NOT NULL auto_increment,
  `pc_catid` int(11) NOT NULL default '0',
  `pc_starttime` time NOT NULL default '00:00:00',
  `pc_endtime` time NOT NULL default '00:00:00',
  `pc_limit` int(11) NOT NULL default '1',
  PRIMARY KEY  (`pc_limitid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_postcalendar_topics`
-- 

DROP TABLE IF EXISTS `openemr_postcalendar_topics`;
CREATE TABLE `openemr_postcalendar_topics` (
  `pc_catid` int(11) unsigned NOT NULL auto_increment,
  `pc_catname` varchar(100) default NULL,
  `pc_catcolor` varchar(50) default NULL,
  `pc_catdesc` text,
  PRIMARY KEY  (`pc_catid`),
  KEY `basic_cat` (`pc_catname`,`pc_catcolor`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `openemr_session_info`
-- 

DROP TABLE IF EXISTS `openemr_session_info`;
CREATE TABLE `openemr_session_info` (
  `pn_sessid` varchar(32) NOT NULL default '',
  `pn_ipaddr` varchar(20) default NULL,
  `pn_firstused` int(11) NOT NULL default '0',
  `pn_lastused` int(11) NOT NULL default '0',
  `pn_uid` int(11) NOT NULL default '0',
  `pn_vars` blob,
  PRIMARY KEY  (`pn_sessid`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
)ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

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
  `guardiansname` varchar(255) NOT NULL DEFAULT '',
  `allow_imm_reg_use` varchar(255) NOT NULL DEFAULT '',
  `allow_imm_info_share` varchar(255) NOT NULL DEFAULT '',
  `allow_health_info_ex` varchar(255) NOT NULL DEFAULT '',
  `allow_patient_portal` varchar(31) NOT NULL DEFAULT '',
  `deceased_date` datetime default NULL,
  `deceased_reason` varchar(255) NOT NULL default '',
  `soap_import_status` TINYINT(4) DEFAULT NULL COMMENT '1-Prescription Press 2-Prescription Import 3-Allergy Press 4-Allergy Import',
  `cmsportal_login` varchar(60) NOT NULL default '',
  `care_team` int(11) DEFAULT NULL,
  `county` varchar(40) NOT NULL default '',
  `industry` TEXT NOT NULL,
  UNIQUE KEY `pid` (`pid`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

--
-- Table structure for table `patient_portal_menu`
--

CREATE TABLE `patient_portal_menu` (
  `patient_portal_menu_id` INT(11) NOT NULL AUTO_INCREMENT,
  `patient_portal_menu_group_id` INT(11) DEFAULT NULL,
  `menu_name` VARCHAR(40) DEFAULT NULL,
  `menu_order` SMALLINT(4) DEFAULT NULL,
  `menu_status` TINYINT(2) DEFAULT '1',
  PRIMARY KEY (`patient_portal_menu_id`)
) ENGINE=INNODB AUTO_INCREMENT=14;

INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (1,1,'Dashboard',3,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (2,1,'My Profile',6,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (3,1,'Appointments',9,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (4,1,'Documents',12,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (5,1,'Med Records',15,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (6,1,'My Account',18,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (7,1,'Mailbox',21,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (8,1,'Password',24,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (9,1,'View Log',27,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (10,1,'Logout',30,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (11,1,'View Health Information',33,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (12,1,'Download Health Information',36,1);
INSERT  INTO `patient_portal_menu`(`patient_portal_menu_id`,`patient_portal_menu_group_id`,`menu_name`,`menu_order`,`menu_status`) VALUES (13,1,'Transmit Health Information',39,1);
-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_access_offsite`
--

DROP TABLE IF EXISTS `patient_access_offsite`;


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
) ENGINE=MyISAM AUTO_INCREMENT=1;

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
) ENGINE=MyISAM;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway_details`
--
CREATE TABLE `payment_gateway_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) DEFAULT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `transaction_key` varchar(255) DEFAULT NULL,
  `md5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_bookmark`
-- 

DROP TABLE IF EXISTS `pma_bookmark`;
CREATE TABLE `pma_bookmark` (
  `id` int(11) NOT NULL auto_increment,
  `dbase` varchar(255) default NULL,
  `user` varchar(255) default NULL,
  `label` varchar(255) default NULL,
  `query` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pma_bookmark`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pma_column_info`
-- 

DROP TABLE IF EXISTS `pma_column_info`;
CREATE TABLE `pma_column_info` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `db_name` varchar(64) default NULL,
  `table_name` varchar(64) default NULL,
  `column_name` varchar(64) default NULL,
  `comment` varchar(255) default NULL,
  `mimetype` varchar(255) default NULL,
  `transformation` varchar(255) default NULL,
  `transformation_options` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM COMMENT='Column Information for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_history`
-- 

DROP TABLE IF EXISTS `pma_history`;
CREATE TABLE `pma_history` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(64) default NULL,
  `db` varchar(64) default NULL,
  `table` varchar(64) default NULL,
  `timevalue` timestamp NOT NULL,
  `sqlquery` text,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM COMMENT='SQL history' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_pdf_pages`
-- 

DROP TABLE IF EXISTS `pma_pdf_pages`;
CREATE TABLE `pma_pdf_pages` (
  `db_name` varchar(64) default NULL,
  `page_nr` int(10) unsigned NOT NULL auto_increment,
  `page_descr` varchar(50) default NULL,
  PRIMARY KEY  (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM COMMENT='PDF Relationpages for PMA' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_relation`
-- 

DROP TABLE IF EXISTS `pma_relation`;
CREATE TABLE `pma_relation` (
  `master_db` varchar(64) NOT NULL default '',
  `master_table` varchar(64) NOT NULL default '',
  `master_field` varchar(64) NOT NULL default '',
  `foreign_db` varchar(64) default NULL,
  `foreign_table` varchar(64) default NULL,
  `foreign_field` varchar(64) default NULL,
  PRIMARY KEY  (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM COMMENT='Relation table';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_coords`
-- 

DROP TABLE IF EXISTS `pma_table_coords`;
CREATE TABLE `pma_table_coords` (
  `db_name` varchar(64) NOT NULL default '',
  `table_name` varchar(64) NOT NULL default '',
  `pdf_page_number` int(11) NOT NULL default '0',
  `x` float unsigned NOT NULL default '0',
  `y` float unsigned NOT NULL default '0',
  PRIMARY KEY  (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

-- 
-- Table structure for table `pma_table_info`
-- 

DROP TABLE IF EXISTS `pma_table_info`;
CREATE TABLE `pma_table_info` (
  `db_name` varchar(64) NOT NULL default '',
  `table_name` varchar(64) NOT NULL default '',
  `display_field` varchar(64) default NULL,
  PRIMARY KEY  (`db_name`,`table_name`)
) ENGINE=MyISAM COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `erx_source` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-OpenEMR 1-External',
  `erx_uploaded` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '0-Pending NewCrop upload 1-Uploaded to NewCrop',
  `drug_info_erx` TEXT DEFAULT NULL,
  `external_id` VARCHAR(20) DEFAULT NULL,
  `end_date` date default NULL,
  `indication` text,
  `prn` VARCHAR(30) DEFAULT NULL,
  PRIMARY KEY  (`id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `registry`
-- 

CREATE TABLE `registry` (
  `name` varchar(255) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `directory` varchar(255) DEFAULT NULL,
  `id` bigint(20) NOT NULL,
  `sql_run` tinyint(4) DEFAULT NULL,
  `unpackaged` tinyint(4) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `priority` int(11) DEFAULT '0',
  `category` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;

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
  `reminder_message` text  NOT NULL DEFAULT '' COMMENT 'Custom message in patient reminder',
  `custom_flag` tinyint(1) NOT NULL default 0 COMMENT '1 indexed to rule_patient_data, 0 indexed within main schema',
  PRIMARY KEY  (`category`,`item`)
) ENGINE=MyISAM ;

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
) ENGINE=MyISAM ;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
) ENGINE=MyISAM ;

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
) ENGINE=MyISAM ;

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
) ENGINE=MyISAM;

-- 
-- Dumping data for table `sequences`
-- 

INSERT INTO `sequences` VALUES (1);

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

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
-- --------------------------------------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

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
  `ssi_relayhealth` varchar(64) NULL,
  `calendar` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '1 = appears in calendar',
  `abook_type` varchar(31) NOT NULL DEFAULT '',
  `pwd_expiration_date` date default NULL,
  `pwd_history1` longtext default NULL,
  `pwd_history2` longtext default NULL,
  `default_warehouse` varchar(31) NOT NULL DEFAULT '',
  `irnpool` varchar(31) NOT NULL DEFAULT '',
  `state_license_number` VARCHAR(25) DEFAULT NULL,
  `newcrop_user_role` VARCHAR(30) DEFAULT NULL,
  `cpoe` tinyint(1) NULL DEFAULT NULL,
  `physician_type` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--
-- NOTE THIS IS DONE AFTER INSTALLATION WHERE THE sql/official_additional_users.sql script is called durig setup
--  (so these inserts can be found in the sql/official_additional_users.sql script)


-- --------------------------------------------------------

--
-- Table structure for table `user_secure`
--
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
) ENGINE=InnoDb;

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `setting_user`  bigint(20)   NOT NULL DEFAULT 0,
  `setting_label` varchar(63)  NOT NULL,
  `setting_value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`setting_user`, `setting_label`)
) ENGINE=MyISAM;

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

-- --------------------------------------------------------

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
) ENGINE=MyISAM;

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
  `message` text NOT NULL,
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

-- --------------------------------------------------------

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
  `message` text NOT NULL,
  `email_sender` varchar(255) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `type` enum('SMS','Email') NOT NULL,
  `patient_info` text NOT NULL,
  `pc_eventDate` date NOT NULL,
  `pc_endDate` date NOT NULL,
  `pc_startTime` time NOT NULL,
  `pc_endTime` time NOT NULL,
  `dSentDateTime` datetime NOT NULL,
  PRIMARY KEY  (`iLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

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

CREATE TABLE chart_tracker (
  ct_pid            int(11)       NOT NULL,
  ct_when           datetime      NOT NULL,
  ct_userid         bigint(20)    NOT NULL DEFAULT 0,
  ct_location       varchar(31)   NOT NULL DEFAULT '',
  PRIMARY KEY (ct_pid, ct_when)
) ENGINE=MyISAM;

CREATE TABLE ar_session (
  session_id     int unsigned  NOT NULL AUTO_INCREMENT,
  payer_id       int(11)       NOT NULL            COMMENT '0=pt else references insurance_companies.id',
  user_id        int(11)       NOT NULL            COMMENT 'references users.id for session owner',
  closed         tinyint(1)    NOT NULL DEFAULT 0  COMMENT '0=no, 1=yes',
  reference      varchar(255)  NOT NULL DEFAULT '' COMMENT 'check or EOB number',
  check_date     date          DEFAULT NULL,
  deposit_date   date          DEFAULT NULL,
  pay_total      decimal(12,2) NOT NULL DEFAULT 0,
  created_time timestamp NOT NULL default CURRENT_TIMESTAMP,
  modified_time datetime NOT NULL,
  global_amount decimal( 12, 2 ) NOT NULL ,
  payment_type varchar( 50 ) NOT NULL ,
  description text NOT NULL ,
  adjustment_code varchar( 50 ) NOT NULL ,
  post_to_date date NOT NULL ,
  patient_id int( 11 ) NOT NULL ,
  payment_method varchar( 25 ) NOT NULL,
  PRIMARY KEY (session_id),
  KEY user_closed (user_id, closed),
  KEY deposit_date (deposit_date)
) ENGINE=MyISAM;

CREATE TABLE ar_activity (
  pid            int(11)       NOT NULL,
  encounter      int(11)       NOT NULL,
  sequence_no    int unsigned  NOT NULL AUTO_INCREMENT,
  `code_type`    varchar(12)   NOT NULL DEFAULT '',
  code           varchar(20)   NOT NULL            COMMENT 'empty means claim level',
  modifier       varchar(12)   NOT NULL DEFAULT '',
  payer_type     int           NOT NULL            COMMENT '0=pt, 1=ins1, 2=ins2, etc',
  post_time      datetime      NOT NULL,
  post_user      int(11)       NOT NULL            COMMENT 'references users.id',
  session_id     int unsigned  NOT NULL            COMMENT 'references ar_session.session_id',
  memo           varchar(255)  NOT NULL DEFAULT '' COMMENT 'adjustment reasons go here',
  pay_amount     decimal(12,2) NOT NULL DEFAULT 0  COMMENT 'either pay or adj will always be 0',
  adj_amount     decimal(12,2) NOT NULL DEFAULT 0,
  modified_time datetime NOT NULL,
  follow_up char(1) NOT NULL,
  follow_up_note text NOT NULL,
  account_code varchar(15) NOT NULL,
  reason_code varchar(255) DEFAULT NULL COMMENT 'Use as needed to show the primary payer adjustment reason code',
  PRIMARY KEY (pid, encounter, sequence_no),
  KEY session_id (session_id)
) ENGINE=MyISAM;

CREATE TABLE `users_facility` (
  `tablename` varchar(64) NOT NULL,
  `table_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  PRIMARY KEY (`tablename`,`table_id`,`facility_id`)
) ENGINE=InnoDB COMMENT='joins users or patient_data to facility table';

CREATE TABLE `lbf_data` (
  `form_id`     int(11)      NOT NULL AUTO_INCREMENT COMMENT 'references forms.form_id',
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT NOT NULL,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=MyISAM COMMENT='contains all data from layout-based forms';

CREATE TABLE `lbt_data` (
  `form_id`     bigint(20)   NOT NULL COMMENT 'references transactions.id',
  `field_id`    varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` TEXT         NOT NULL,
  PRIMARY KEY (`form_id`,`field_id`)
) ENGINE=MyISAM COMMENT='contains all data from layout-based transactions';

CREATE TABLE gprelations (
  type1 int(2)     NOT NULL,
  id1   bigint(20) NOT NULL,
  type2 int(2)     NOT NULL,
  id2   bigint(20) NOT NULL,
  PRIMARY KEY (type1,id1,type2,id2),
  KEY key2  (type2,id2)
) ENGINE=MyISAM COMMENT='general purpose relations';

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
  `notes`        text         NOT NULL DEFAULT '',
  `lab_director` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ppid`)
) ENGINE=MyISAM;

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
) ENGINE=MyISAM;

CREATE TABLE `procedure_questions` (
  `lab_id`              bigint(20)   NOT NULL DEFAULT 0   COMMENT 'references procedure_providers.ppid to identify the lab',
  `procedure_code`      varchar(31)  NOT NULL DEFAULT ''  COMMENT 'references procedure_type.procedure_code to identify this order type',
  `question_code`       varchar(31)  NOT NULL DEFAULT ''  COMMENT 'code identifying this question',
  `seq`                 int(11)      NOT NULL default 0   COMMENT 'sequence number for ordering',
  `question_text`       varchar(255) NOT NULL DEFAULT ''  COMMENT 'descriptive text for question_code',
  `required`            tinyint(1)   NOT NULL DEFAULT 0   COMMENT '1 = required, 0 = not',
  `maxsize`             int          NOT NULL DEFAULT 0   COMMENT 'maximum length if text input field',
  `fldtype`             char(1)      NOT NULL DEFAULT 'T' COMMENT 'Text, Number, Select, Multiselect, Date, Gestational-age',
  `options`             text         NOT NULL DEFAULT ''  COMMENT 'choices for fldtype S and T',
  `tips`                varchar(255) NOT NULL DEFAULT ''  COMMENT 'Additional instructions for answering the question',
  `activity`            tinyint(1)   NOT NULL DEFAULT 1   COMMENT '1 = active, 0 = inactive',
  PRIMARY KEY (`lab_id`, `procedure_code`, `question_code`)
) ENGINE=MyISAM;

CREATE TABLE `procedure_order` (
  `procedure_order_id`     bigint(20)   NOT NULL AUTO_INCREMENT,
  `provider_id`            bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references users.id, the ordering provider',
  `patient_id`             bigint(20)   NOT NULL            COMMENT 'references patient_data.pid',
  `encounter_id`           bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references form_encounter.encounter',
  `date_collected`         datetime     DEFAULT NULL        COMMENT 'time specimen collected',
  `date_ordered`           date         DEFAULT NULL,
  `order_priority`         varchar(31)  NOT NULL DEFAULT '',
  `order_status`           varchar(31)  NOT NULL DEFAULT '' COMMENT 'pending,routed,complete,canceled',
  `patient_instructions`   text         NOT NULL DEFAULT '',
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
) ENGINE=MyISAM;

CREATE TABLE `procedure_order_code` (
  `procedure_order_id`  bigint(20)  NOT NULL                COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)     NOT NULL AUTO_INCREMENT COMMENT 'supports multiple tests per order',
  `procedure_code`      varchar(31) NOT NULL DEFAULT ''     COMMENT 'like procedure_type.procedure_code',
  `procedure_name`      varchar(255) NOT NULL DEFAULT ''    COMMENT 'descriptive name of the procedure code',
  `procedure_source`    char(1)     NOT NULL DEFAULT '1'    COMMENT '1=original order, 2=added after order sent',
  `diagnoses`           text        NOT NULL DEFAULT ''     COMMENT 'diagnoses and maybe other coding (e.g. ICD9:111.11)',
  `do_not_send`         tinyint(1)  NOT NULL DEFAULT '0'    COMMENT '0 = normal, 1 = do not transmit to lab',
  `procedure_order_title` varchar( 255 ) NULL DEFAULT NULL,
  PRIMARY KEY (`procedure_order_id`, `procedure_order_seq`)
) ENGINE=MyISAM;

CREATE TABLE `procedure_answers` (
  `procedure_order_id`  bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)      NOT NULL DEFAULT 0  COMMENT 'references procedure_order_code.procedure_order_seq',
  `question_code`       varchar(31)  NOT NULL DEFAULT '' COMMENT 'references procedure_questions.question_code',
  `answer_seq`          int(11)      NOT NULL AUTO_INCREMENT COMMENT 'supports multiple-choice questions',
  `answer`              varchar(255) NOT NULL DEFAULT '' COMMENT 'answer data',
  PRIMARY KEY (`procedure_order_id`, `procedure_order_seq`, `question_code`, `answer_seq`)
) ENGINE=MyISAM;

CREATE TABLE `procedure_report` (
  `procedure_report_id` bigint(20)     NOT NULL AUTO_INCREMENT,
  `procedure_order_id`  bigint(20)     DEFAULT NULL   COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11)        NOT NULL DEFAULT 1  COMMENT 'references procedure_order_code.procedure_order_seq',
  `date_collected`      datetime       DEFAULT NULL,
  `date_report`         datetime       DEFAULT NULL,
  `source`              bigint(20)     NOT NULL DEFAULT 0  COMMENT 'references users.id, who entered this data',
  `specimen_num`        varchar(63)    NOT NULL DEFAULT '',
  `report_status`       varchar(31)    NOT NULL DEFAULT '' COMMENT 'received,complete,error',
  `review_status`       varchar(31)    NOT NULL DEFAULT 'received' COMMENT 'pending review status: received,reviewed',  
  `report_notes`        text           NOT NULL DEFAULT '' COMMENT 'notes from the lab',
  PRIMARY KEY (`procedure_report_id`),
  KEY procedure_order_id (procedure_order_id)
) ENGINE=MyISAM; 

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
  `comments`            text         NOT NULL DEFAULT '' COMMENT 'comments from the lab',
  `document_id`         bigint(20)   NOT NULL DEFAULT 0  COMMENT 'references documents.id if this result is a document',
  `result_status`       varchar(31)  NOT NULL DEFAULT '' COMMENT 'preliminary, cannot be done, final, corrected, incompete...etc.',
  PRIMARY KEY (`procedure_result_id`),
  KEY procedure_report_id (procedure_report_id)
) ENGINE=MyISAM; 

CREATE TABLE `globals` (
  `gl_name`             varchar(63)    NOT NULL,
  `gl_index`            int(11)        NOT NULL DEFAULT 0,
  `gl_value`            varchar(255)   NOT NULL DEFAULT '',
  PRIMARY KEY (`gl_name`, `gl_index`)
) ENGINE=MyISAM; 

CREATE TABLE code_types (
  ct_key  varchar(15) NOT NULL           COMMENT 'short alphanumeric name',
  ct_id   int(11)     UNIQUE NOT NULL    COMMENT 'numeric identifier',
  ct_seq  int(11)     NOT NULL DEFAULT 0 COMMENT 'sort order',
  ct_mod  int(11)     NOT NULL DEFAULT 0 COMMENT 'length of modifier field',
  ct_just varchar(15) NOT NULL DEFAULT ''COMMENT 'ct_key of justify type, if any',
  ct_mask varchar(9)  NOT NULL DEFAULT ''COMMENT 'formatting mask for code values',
  ct_fee  tinyint(1)  NOT NULL default 0 COMMENT '1 if fees are used',
  ct_rel  tinyint(1)  NOT NULL default 0 COMMENT '1 if can relate to other code types',
  ct_nofs tinyint(1)  NOT NULL default 0 COMMENT '1 if to be hidden in the fee sheet',
  ct_diag tinyint(1)  NOT NULL default 0 COMMENT '1 if this is a diagnosis type',
  ct_active tinyint(1) NOT NULL default 1 COMMENT '1 if this is active',
  ct_label varchar(31) NOT NULL default '' COMMENT 'label of this code type',
  ct_external tinyint(1) NOT NULL default 0 COMMENT '0 if stored codes in codes tables, 1 or greater if codes stored in external tables',
  ct_claim tinyint(1) NOT NULL default 0 COMMENT '1 if this is used in claims',
  ct_proc tinyint(1) NOT NULL default 0 COMMENT '1 if this is a procedure type',
  ct_term tinyint(1) NOT NULL default 0 COMMENT '1 if this is a clinical term',
  ct_problem tinyint(1) NOT NULL default 0 COMMENT '1 if this code type is used as a medical problem',
  ct_drug tinyint(1) NOT NULL default 0 COMMENT '1 if this code type is used as a medication',
  PRIMARY KEY (ct_key)
) ENGINE=MyISAM;

INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CPT4' , 1, 2, 12, 'ICD9', 1, 0, 0, 0, 1, 'CPT4 Procedure/Service', 0, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('HCPCS', 3, 3, 12, 'ICD9', 1, 0, 0, 0, 1, 'HCPCS Procedure/Service', 0, 1, 1, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CVX'  , 100, 100, 0, '', 0, 0, 1, 0, 1, 'CVX Immunization', 0, 0, 0, 0, 0);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('ICD10' , 102, 102, 0, '', 0, 0, 0, 1, 1, 'ICD10 Diagnosis', 1, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('SNOMED' , 103, 103, 0, '', 0, 0, 0, 1, 0, 'SNOMED Diagnosis', 2, 1, 0, 0, 1);
INSERT INTO code_types (ct_key, ct_id, ct_seq, ct_mod, ct_just, ct_fee, ct_rel, ct_nofs, ct_diag, ct_active, ct_label, ct_external, ct_claim, ct_proc, ct_term, ct_problem ) VALUES ('CPTII' , 104, 104, 0, 'ICD9', 0, 0, 0, 0, 0, 'CPTII Performance Measures', 0, 1, 0, 0, 0);
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
) ENGINE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE version (
  v_major    int(11)     NOT NULL DEFAULT 0,
  v_minor    int(11)     NOT NULL DEFAULT 0,
  v_patch    int(11)     NOT NULL DEFAULT 0,
  v_realpatch int(11)    NOT NULL DEFAULT 0,
  v_tag      varchar(31) NOT NULL DEFAULT '',
  v_database int(11)     NOT NULL DEFAULT 0,
  v_acl      int(11)     NOT NULL DEFAULT 0
) ENGINE=MyISAM;
INSERT INTO version (v_major, v_minor, v_patch, v_realpatch, v_tag, v_database, v_acl) VALUES (0, 0, 0, 0, '', 0, 0);
-- --------------------------------------------------------



CREATE TABLE `product_warehouse` (
  `pw_drug_id`   int(11) NOT NULL,
  `pw_warehouse` varchar(31) NOT NULL,
  `pw_min_level` float       DEFAULT 0,
  `pw_max_level` float       DEFAULT 0,
  PRIMARY KEY  (`pw_drug_id`,`pw_warehouse`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `misc_address_book`
--

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

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Table structure for table `esign_signatures`
--

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
  `checksum` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `shared_attributes` (
  `pid`          bigint(20)   NOT NULL,
  `encounter`    bigint(20)   NOT NULL COMMENT '0 if patient attribute, else encounter attribute',
  `field_id`     varchar(31)  NOT NULL COMMENT 'references layout_options.field_id',
  `last_update`  datetime     NOT NULL COMMENT 'time of last update',
  `user_id`      bigint(20)   NOT NULL COMMENT 'user who last updated',
  `field_value`  TEXT         NOT NULL,
  PRIMARY KEY (`pid`, `encounter`, `field_id`)
);

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Table structure for table `ccda_components`
--
CREATE TABLE ccda_components (
  ccda_components_id int(11) NOT NULL AUTO_INCREMENT,
  ccda_components_field varchar(100) DEFAULT NULL,
  ccda_components_name varchar(100) DEFAULT NULL,
  ccda_type int(11) NOT NULL COMMENT '0=>sections,1=>components',
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
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Table structure for table `ccda_sections`
--
CREATE TABLE ccda_sections (
  ccda_sections_id int(11) NOT NULL AUTO_INCREMENT,
  ccda_components_id int(11) DEFAULT NULL,
  ccda_sections_field varchar(100) DEFAULT NULL,
  ccda_sections_name varchar(100) DEFAULT NULL,
  ccda_sections_req_mapping tinyint(4) NOT NULL DEFAULT '1',
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
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Table structure for table `ccda_field_mapping`
--
CREATE TABLE ccda_field_mapping (
  id int(11) NOT NULL AUTO_INCREMENT,
  table_id int(11) DEFAULT NULL,
  ccda_field varchar(100) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Table structure for table `ccda`
--
CREATE TABLE ccda (
  id INT(11) NOT NULL AUTO_INCREMENT,
  pid BIGINT(20) DEFAULT NULL,
  encounter BIGINT(20) DEFAULT NULL,
  ccda_data MEDIUMTEXT,
  time VARCHAR(50) DEFAULT NULL,
  status SMALLINT(6) DEFAULT NULL,
  updated_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  user_id VARCHAR(50) null,
  couch_docid VARCHAR(100) NULL,
  couch_revid VARCHAR(100) NULL,
  `view` tinyint(4) NOT NULL DEFAULT '0',
  `transfer` tinyint(4) NOT NULL DEFAULT '0',
  `emr_transfer` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (id),
  UNIQUE KEY unique_key (pid,encounter,time)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Table structure for table `ccda_table_mapping`
--
CREATE TABLE ccda_table_mapping (
  id int(11) NOT NULL AUTO_INCREMENT,
  ccda_component varchar(100) DEFAULT NULL,
  ccda_component_section varchar(100) DEFAULT NULL,
  form_dir varchar(100) DEFAULT NULL,
  form_type smallint(6) DEFAULT NULL,
  form_table varchar(100) DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  deleted tinyint(4) NOT NULL DEFAULT '0',
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Table structure for table `external_procedures`
--
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
-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- Table structure for table `external_encounters`
--
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
-- --------------------------------------------------------

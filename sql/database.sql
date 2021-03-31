CREATE TABLE `addresses` (
  `id` int(11) NOT NULL DEFAULT '0',
  `line1` varchar(255) DEFAULT NULL,
  `line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(35) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `plus_four` varchar(4) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `foreign_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `amc_misc_data` (
  `amc_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_rules',
  `pid` bigint(20) DEFAULT NULL,
  `map_category` varchar(255) NOT NULL DEFAULT '' COMMENT 'Maps to an object category (such as prescriptions etc.)',
  `map_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Maps to an object id (such as prescription id etc.)',
  `date_created` datetime DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `amendments` (
  `amendment_id` int(11) NOT NULL COMMENT 'Amendment ID',
  `amendment_date` date NOT NULL COMMENT 'Amendement request date',
  `amendment_by` varchar(50) NOT NULL COMMENT 'Amendment requested from',
  `amendment_status` varchar(50) DEFAULT NULL COMMENT 'Amendment status accepted/rejected/null',
  `pid` int(11) NOT NULL COMMENT 'Patient ID from patient_data',
  `amendment_desc` text COMMENT 'Amendment Details',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `modified_by` int(11) DEFAULT NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time',
  `modified_time` timestamp NULL DEFAULT NULL COMMENT 'modified time'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `amendments_history` (
  `amendment_id` int(11) NOT NULL COMMENT 'Amendment ID',
  `amendment_note` text COMMENT 'Amendment requested from',
  `amendment_status` varchar(50) DEFAULT NULL COMMENT 'Amendment Request Status',
  `created_by` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'created time'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ar_activity` (
  `pid` int(11) NOT NULL,
  `encounter` int(11) NOT NULL,
  `sequence_no` int(10) UNSIGNED NOT NULL,
  `billing_id` int(11) NOT NULL,
  `code_type` varchar(12) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL COMMENT 'empty means claim level',
  `modifier` varchar(12) NOT NULL DEFAULT '',
  `payer_type` int(11) NOT NULL COMMENT '0=pt, 1=ins1, 2=ins2, etc',
  `post_time` datetime NOT NULL,
  `post_user` int(11) NOT NULL COMMENT 'references users.id',
  `session_id` int(10) UNSIGNED NOT NULL COMMENT 'references ar_session.session_id',
  `memo` varchar(255) NOT NULL DEFAULT '' COMMENT 'adjustment reasons go here',
  `pay_amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'either pay or adj will always be 0',
  `adj_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `modified_time` datetime NOT NULL,
  `follow_up` char(1) NOT NULL,
  `follow_up_note` text,
  `account_code` varchar(15) NOT NULL,
  `reason_code` varchar(255) DEFAULT NULL COMMENT 'Use as needed to show the primary payer adjustment reason code',
  `unapplied` tinyint(1) NOT NULL DEFAULT '0',
  `date_closed` date DEFAULT NULL COMMENT 'Date closed',
  `ready_to_bill` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ar_session` (
  `session_id` int(10) UNSIGNED NOT NULL,
  `payer_id` int(11) NOT NULL COMMENT '0=pt else references insurance_companies.id',
  `user_id` int(11) NOT NULL COMMENT 'references users.id for session owner',
  `closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `reference` varchar(255) NOT NULL DEFAULT '' COMMENT 'check or EOB number',
  `check_date` date DEFAULT NULL,
  `deposit_date` date DEFAULT NULL,
  `pay_total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` datetime NOT NULL,
  `global_amount` decimal(12,2) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `description` text,
  `adjustment_code` varchar(50) NOT NULL,
  `post_to_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `payment_method` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `audit_details` (
  `id` bigint(20) NOT NULL,
  `table_name` varchar(100) NOT NULL COMMENT 'libreehr table name',
  `field_name` varchar(100) NOT NULL COMMENT 'libreehr table''s field name',
  `field_value` text COMMENT 'libreehr table''s field value',
  `audit_master_id` bigint(20) NOT NULL COMMENT 'Id of the audit_master table',
  `entry_identification` varchar(255) NOT NULL DEFAULT '1' COMMENT 'Used when multiple entry occurs from the same table.1 means no multiple entry'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `audit_master` (
  `id` bigint(20) NOT NULL,
  `pid` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT 'The Id of the user who approves or denies',
  `approval_status` tinyint(4) NOT NULL COMMENT '1-Pending,2-Approved,3-Denied,4-Appointment directly updated to calendar table,5-Cancelled appointment',
  `comments` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_time` datetime NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1-new patient,2-existing patient,3-change is only in the document,4-Patient upload,5-random key,10-Appointment'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `automatic_notification` (
  `notification_id` int(5) NOT NULL,
  `sms_gateway_type` varchar(255) NOT NULL,
  `next_app_date` date NOT NULL,
  `next_app_time` varchar(10) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `message` text,
  `email_sender` varchar(100) NOT NULL,
  `email_subject` varchar(100) NOT NULL,
  `type` enum('SMS','Email') NOT NULL DEFAULT 'SMS',
  `notification_sent_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `automatic_notification` (`notification_id`, `sms_gateway_type`, `next_app_date`, `next_app_time`, `provider_name`, `message`, `email_sender`, `email_subject`, `type`, `notification_sent_date`) VALUES
(1, 'CLICKATELL', '0000-00-00', ':', 'EMR GROUP 1 .. SMS', 'Welcome to EMR GROUP 1.. SMS', '', '', 'SMS', '0000-00-00 00:00:00'),
(2, '', '2007-10-02', '05:50', 'EMR GROUP', 'Welcome to EMR GROUP . Email', 'EMR Group', 'Welcome to EMR GROUP', 'Email', '2007-09-30 00:00:00');

CREATE TABLE `background_services` (
  `name` varchar(31) NOT NULL,
  `title` varchar(127) NOT NULL COMMENT 'name for reports',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `running` tinyint(1) NOT NULL DEFAULT '-1' COMMENT 'True indicates managed service is busy. Skip this interval.',
  `next_run` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `execute_interval` int(11) NOT NULL DEFAULT '0' COMMENT 'minimum number of minutes between function calls,0=manual mode',
  `function` varchar(127) NOT NULL COMMENT 'name of background service function',
  `require_once` varchar(255) DEFAULT NULL COMMENT 'include file (if necessary)',
  `sort_order` int(11) NOT NULL DEFAULT '100' COMMENT 'lower numbers will be run first'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `background_services` (`name`, `title`, `active`, `running`, `next_run`, `execute_interval`, `function`, `require_once`, `sort_order`) VALUES
('ccdaservice', 'C-CDA Node Service', 0, -1, '2020-08-16 11:58:53', 1, 'runCheck', '/ccdaservice/ssmanager.php', 95);

CREATE TABLE `batchcom` (
  `id` bigint(20) NOT NULL,
  `patient_id` int(11) NOT NULL DEFAULT '0',
  `sent_by` bigint(20) NOT NULL DEFAULT '0',
  `msg_type` varchar(60) DEFAULT NULL,
  `msg_subject` varchar(255) DEFAULT NULL,
  `msg_text` mediumtext,
  `msg_date_sent` datetime NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `case_number` int(20) DEFAULT NULL COMMENT 'case_number in pt_case table',
  `date` datetime DEFAULT NULL,
  `code_type` varchar(15) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(1) DEFAULT NULL,
  `encounter` int(11) DEFAULT NULL,
  `code_text` longtext,
  `billed` tinyint(1) DEFAULT NULL,
  `activity` tinyint(1) DEFAULT NULL,
  `payer_id` int(11) DEFAULT NULL,
  `bill_process` tinyint(2) NOT NULL DEFAULT '0',
  `bill_date` datetime DEFAULT NULL,
  `process_date` datetime DEFAULT NULL,
  `process_file` varchar(255) DEFAULT NULL,
  `modifier` varchar(12) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `fee` decimal(12,2) DEFAULT NULL,
  `justify` varchar(255) DEFAULT NULL,
  `target` varchar(30) DEFAULT NULL,
  `x12_partner_id` int(11) DEFAULT NULL,
  `ndc_info` varchar(255) DEFAULT NULL,
  `notecodes` varchar(80) NOT NULL DEFAULT '',
  `exclude_from_insurance_billing` tinyint(1) NOT NULL DEFAULT '0',
  `external_id` varchar(20) DEFAULT NULL,
  `pricelevel` varchar(31) DEFAULT '',
  `ready_to_bill` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cases_to_documents` (
  `case_id` int(11) NOT NULL DEFAULT '0',
  `document_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rght` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `name`, `value`, `parent`, `lft`, `rght`) VALUES
(1, 'Categories', '', 0, 0, 31),
(2, 'Lab Report', '', 1, 1, 2),
(3, 'Medical Record', '', 1, 3, 4),
(4, 'Patient Information', '', 1, 5, 10),
(5, 'Patient ID card', '', 4, 6, 7),
(6, 'Advance Directive', '', 1, 11, 18),
(7, 'Do Not Resuscitate Order', '', 6, 12, 13),
(8, 'Durable Power of Attorney', '', 6, 14, 15),
(9, 'Living Will', '', 6, 16, 17),
(10, 'Patient Photograph', '', 4, 8, 9),
(11, 'CCR', '', 1, 19, 20),
(12, 'CCD', '', 1, 21, 22),
(13, 'CCDA', '', 1, 23, 24),
(14, 'Onsite Portal', '', 1, 25, 30),
(15, 'Patient', '', 14, 26, 27),
(16, 'Reviewed', '', 14, 28, 29);

CREATE TABLE `categories_seq` (
  `id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `categories_seq` (`id`) VALUES
(16);

CREATE TABLE `categories_to_documents` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `document_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ccda` (
  `id` int(11) NOT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `encounter` bigint(20) DEFAULT NULL,
  `ccda_data` mediumtext,
  `time` varchar(50) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(50) DEFAULT NULL,
  `couch_docid` varchar(100) DEFAULT NULL,
  `couch_revid` varchar(100) DEFAULT NULL,
  `view` tinyint(4) NOT NULL DEFAULT '0',
  `transfer` tinyint(4) NOT NULL DEFAULT '0',
  `emr_transfer` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ccda_components` (
  `ccda_components_id` int(11) NOT NULL,
  `ccda_components_field` varchar(100) DEFAULT NULL,
  `ccda_components_name` varchar(100) DEFAULT NULL,
  `ccda_type` int(11) NOT NULL COMMENT '0=>sections,1=>components'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ccda_components` (`ccda_components_id`, `ccda_components_field`, `ccda_components_name`, `ccda_type`) VALUES
(1, 'progress_note', 'Progress Notes', 0),
(2, 'consultation_note', 'Consultation Note', 0),
(3, 'continuity_care_document', 'Continuity Care Document', 0),
(4, 'diagnostic_image_reporting', 'Diagnostic Image Reporting', 0),
(5, 'discharge_summary', 'Discharge Summary', 0),
(6, 'history_physical_note', 'History and Physical Note', 0),
(7, 'operative_note', 'Operative Note', 0),
(8, 'procedure_note', 'Procedure Note', 0),
(9, 'unstructured_document', 'Unstructured Document', 0),
(10, 'allergies', 'Allergies', 1),
(11, 'medications', 'Medications', 1),
(12, 'problems', 'Problems', 1),
(13, 'immunizations', 'Immunizations', 1),
(14, 'procedures', 'Procedures', 1),
(15, 'results', 'Results', 1),
(16, 'plan_of_care', 'Plan Of Care', 1),
(17, 'vitals', 'Vitals', 1),
(18, 'social_history', 'Social History', 1),
(19, 'encounters', 'Encounters', 1),
(20, 'functional_status', 'Functional Status', 1),
(21, 'referral', 'Reason for Referral', 1),
(22, 'instructions', 'Instructions', 1);

CREATE TABLE `ccda_field_mapping` (
  `id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `ccda_field` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ccda_sections` (
  `ccda_sections_id` int(11) NOT NULL,
  `ccda_components_id` int(11) DEFAULT NULL,
  `ccda_sections_field` varchar(100) DEFAULT NULL,
  `ccda_sections_name` varchar(100) DEFAULT NULL,
  `ccda_sections_req_mapping` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ccda_sections` (`ccda_sections_id`, `ccda_components_id`, `ccda_sections_field`, `ccda_sections_name`, `ccda_sections_req_mapping`) VALUES
(1, 1, 'assessment_plan', 'Assessment and Plan', 1),
(2, 2, 'assessment_plan', 'Assessment and Plan', 1),
(3, 2, 'history_of_present_illness', 'History of Present Illness', 1),
(4, 2, 'physical_exam', 'Physical Exam', 1),
(5, 2, 'reason_of_visit', 'Reason for Referral/Reason for Visit', 1),
(6, 3, 'allergies', 'Allergies', 0),
(7, 3, 'medications', 'Medications', 0),
(8, 3, 'problem_list', 'Problem List', 0),
(9, 3, 'procedures', 'Procedures', 0),
(10, 3, 'results', 'Results', 0),
(11, 4, 'report', 'Report', 0),
(12, 5, 'allergies', 'Allergies', 0),
(13, 5, 'hospital_course', 'Hospital Course', 0),
(14, 5, 'hospital_discharge_diagnosis', 'Hospital Discharge Diagnosis', 0),
(15, 5, 'hospital_discharge_medications', 'Hospital Discharge Medications', 0),
(16, 5, 'plan_of_care', 'Plan of Care', 1),
(17, 6, 'allergies', 'Allergies', 0),
(19, 6, 'chief_complaint', 'Chief Complaint / Reason for Visit', 1),
(21, 6, 'family_history', 'Family History', 1),
(22, 6, 'general_status', 'General Status', 1),
(23, 6, 'hpi_past_med', 'History of Past Illness (Past Medical History)', 1),
(24, 6, 'hpi', 'History of Present Illness', 1),
(25, 6, 'medications', 'Medications', 0),
(26, 6, 'physical_exam', 'Physical Exam', 1),
(28, 6, 'results', 'Results', 0),
(29, 6, 'review_of_systems', 'Review of Systems', 1),
(30, 6, 'social_history', 'Social History', 1),
(31, 6, 'vital_signs', 'Vital Signs', 0),
(32, 7, 'anesthesia', 'Anesthesia', 1),
(33, 7, 'complications', 'Complications', 1),
(34, 7, 'post_operative_diagnosis', 'Post Operative Diagnosis', 0),
(35, 7, 'pre_operative_diagnosis', 'Pre Operative Diagnosis', 0),
(36, 7, 'procedure_estimated_blood_loss', 'Procedure Estimated Blood Loss', 0),
(37, 7, 'procedure_findings', 'Procedure Findings', 0),
(38, 7, 'procedure_specimens_taken', 'Procedure Specimens Taken', 0),
(39, 7, 'procedure_description', 'Procedure Description', 1),
(40, 8, 'assessment_plan', 'Assessment and Plan', 1),
(41, 8, 'complications', 'Complications', 1),
(42, 8, 'postprocedure_diagnosis', 'Postprocedure Diagnosis', 0),
(43, 8, 'procedure_description', 'Procedure Description', 0),
(44, 8, 'procedure_indications', 'Procedure Indications', 0),
(45, 9, 'unstructured_doc', 'Document', 0);

CREATE TABLE `ccda_table_mapping` (
  `id` int(11) NOT NULL,
  `ccda_component` varchar(100) DEFAULT NULL,
  `ccda_component_section` varchar(100) DEFAULT NULL,
  `form_dir` varchar(100) DEFAULT NULL,
  `form_type` smallint(6) DEFAULT NULL,
  `form_table` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `chart_tracker` (
  `ct_pid` int(11) NOT NULL,
  `ct_when` datetime NOT NULL,
  `ct_userid` bigint(20) NOT NULL DEFAULT '0',
  `ct_location` varchar(31) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `claims` (
  `patient_id` int(11) NOT NULL,
  `encounter_id` int(11) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL COMMENT 'Claim version, incremented in code',
  `payer_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `payer_type` tinyint(4) NOT NULL DEFAULT '0',
  `bill_process` tinyint(2) NOT NULL DEFAULT '0',
  `bill_time` datetime DEFAULT NULL,
  `process_time` datetime DEFAULT NULL,
  `process_file` varchar(255) DEFAULT NULL,
  `target` varchar(30) DEFAULT NULL,
  `x12_partner_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `clinical_plans` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_plans',
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 is default for all patients, while > 0 is id from patient_data table',
  `normal_flag` tinyint(1) DEFAULT NULL COMMENT 'Normal Activation Flag',
  `cqm_flag` tinyint(1) DEFAULT NULL COMMENT 'Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_2011_flag` tinyint(1) DEFAULT NULL COMMENT '2011 Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_2014_flag` tinyint(1) DEFAULT NULL COMMENT '2014 Clinical Quality Measure flag (unable to customize per patient)',
  `cqm_measure_group` varchar(10) NOT NULL DEFAULT '' COMMENT 'Clinical Quality Measure Group Identifier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `clinical_plans` (`id`, `pid`, `normal_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_2014_flag`, `cqm_measure_group`) VALUES
('back_pain_plan_cqm', 0, 0, 1, 1, NULL, 'G'),
('cabg_plan_cqm', 0, 0, 1, 1, NULL, 'H'),
('ckd_plan_cqm', 0, 0, 1, 1, NULL, 'C'),
('dm_plan', 0, 1, 0, NULL, NULL, ''),
('dm_plan_cqm', 0, 0, 1, 1, NULL, 'A'),
('periop_plan_cqm', 0, 0, 1, 1, NULL, 'E'),
('prevent_plan', 0, 1, 0, NULL, NULL, ''),
('prevent_plan_cqm', 0, 0, 1, 1, NULL, 'D'),
('rheum_arth_plan_cqm', 0, 0, 1, 1, NULL, 'F');

CREATE TABLE `clinical_plans_rules` (
  `plan_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_plans',
  `rule_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Unique and maps to list_options list clinical_rules'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `clinical_plans_rules` (`plan_id`, `rule_id`) VALUES
('dm_plan', 'rule_dm_eye'),
('dm_plan', 'rule_dm_foot'),
('dm_plan', 'rule_dm_hemo_a1c'),
('dm_plan', 'rule_dm_urine_alb'),
('dm_plan_cqm', 'rule_dm_a1c_cqm'),
('dm_plan_cqm', 'rule_dm_bp_control_cqm'),
('dm_plan_cqm', 'rule_dm_eye_cqm'),
('dm_plan_cqm', 'rule_dm_foot_cqm'),
('dm_plan_cqm', 'rule_dm_ldl_cqm'),
('prevent_plan', 'rule_adult_wt_screen_fu'),
('prevent_plan', 'rule_cs_colon'),
('prevent_plan', 'rule_cs_mammo'),
('prevent_plan', 'rule_cs_pap'),
('prevent_plan', 'rule_cs_prostate'),
('prevent_plan', 'rule_htn_bp_measure'),
('prevent_plan', 'rule_influenza_ge_50'),
('prevent_plan', 'rule_pneumovacc_ge_65'),
('prevent_plan', 'rule_tob_cess_inter'),
('prevent_plan', 'rule_tob_use_assess'),
('prevent_plan', 'rule_wt_assess_couns_child'),
('prevent_plan_cqm', 'rule_adult_wt_screen_fu_cqm'),
('prevent_plan_cqm', 'rule_influenza_ge_50_cqm'),
('prevent_plan_cqm', 'rule_pneumovacc_ge_65_cqm');

CREATE TABLE `clinical_rules` (
  `id` varchar(35) NOT NULL DEFAULT '',
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '0 is default for all patients, while > 0 is id from patient_data table',
  `active_alert_flag` tinyint(1) DEFAULT NULL COMMENT 'Active Alert Widget Module flag - note not yet utilized',
  `passive_alert_flag` tinyint(1) DEFAULT NULL COMMENT 'Passive Alert Widget Module flag',
  `patient_reminder_flag` tinyint(1) DEFAULT NULL COMMENT 'Clinical Reminder Module flag',
  `release_version` varchar(255) NOT NULL DEFAULT '' COMMENT 'Clinical Rule Release Version',
  `web_reference` varchar(255) NOT NULL DEFAULT '' COMMENT 'Clinical Rule Web Reference',
  `access_control` varchar(255) NOT NULL DEFAULT 'patients:med' COMMENT 'ACO link for access control',
  `pqrs_code` varchar(35) DEFAULT NULL COMMENT 'Measure number',
  `pqrs_individual_2016_flag` tinyint(4) DEFAULT NULL COMMENT 'Is MIPS flag',
  `pqrs_group_type` varchar(2) DEFAULT 'X' COMMENT 'XML output scheme type',
  `active` tinyint(4) DEFAULT NULL COMMENT 'Is this measure turned on?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `clinical_rules_log` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `uid` bigint(20) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '' COMMENT 'An example category is clinical_reminder_widget',
  `value` text NOT NULL,
  `new_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `code_text` varchar(255) NOT NULL DEFAULT '',
  `code_text_short` varchar(24) NOT NULL DEFAULT '',
  `code` varchar(25) NOT NULL DEFAULT '',
  `code_type` smallint(6) DEFAULT NULL,
  `modifier` varchar(12) NOT NULL DEFAULT '',
  `units` int(11) DEFAULT NULL,
  `fee` decimal(12,2) DEFAULT NULL,
  `superbill` varchar(31) NOT NULL DEFAULT '',
  `related_code` varchar(255) NOT NULL DEFAULT '',
  `taxrates` varchar(255) NOT NULL DEFAULT '',
  `cyp_factor` float NOT NULL DEFAULT '0' COMMENT 'quantity representing a years supply',
  `active` tinyint(1) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `exclude_from_insurance_billing` tinyint(1) DEFAULT '0' COMMENT '0 = include, 1 = exclude',
  `reportable` tinyint(1) DEFAULT '0' COMMENT '0 = non-reportable, 1 = reportable',
  `financial_reporting` tinyint(1) DEFAULT '0' COMMENT '0 = negative, 1 = considered important code in financial reporting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `code_types` (
  `ct_key` varchar(15) NOT NULL COMMENT 'short alphanumeric name',
  `ct_id` int(11) NOT NULL COMMENT 'numeric identifier',
  `ct_seq` int(11) NOT NULL DEFAULT '0' COMMENT 'sort order',
  `ct_mod` int(11) NOT NULL DEFAULT '0' COMMENT 'length of modifier field',
  `ct_just` varchar(15) NOT NULL DEFAULT '' COMMENT 'ct_key of justify type, if any',
  `ct_mask` varchar(9) NOT NULL DEFAULT '' COMMENT 'formatting mask for code values',
  `ct_fee` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if fees are used',
  `ct_rel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if can relate to other code types',
  `ct_nofs` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if to be hidden in the fee sheet',
  `ct_diag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this is a diagnosis type',
  `ct_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 if this is active',
  `ct_label` varchar(31) NOT NULL DEFAULT '' COMMENT 'label of this code type',
  `ct_external` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 if stored codes in codes tables, 1 or greater if codes stored in external tables',
  `ct_claim` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this is used in claims',
  `ct_proc` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this is a procedure type',
  `ct_term` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this is a clinical term',
  `ct_problem` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this code type is used as a medical problem',
  `ct_drug` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if this code type is used as a medication'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `code_types` (`ct_key`, `ct_id`, `ct_seq`, `ct_mod`, `ct_just`, `ct_mask`, `ct_fee`, `ct_rel`, `ct_nofs`, `ct_diag`, `ct_active`, `ct_label`, `ct_external`, `ct_claim`, `ct_proc`, `ct_term`, `ct_problem`, `ct_drug`) VALUES
('CPT4', 1, 2, 12, 'ICD10', '', 1, 0, 0, 0, 1, 'CPT4 Procedure/Service', 0, 1, 1, 0, 0, 0),
('CPT2', 104, 104, 0, 'ICD10', '', 0, 0, 0, 0, 0, 'CPT2 Performance Measures', 0, 1, 0, 0, 0, 0),
('CVX', 100, 100, 0, '', '', 0, 0, 1, 0, 1, 'CVX Immunization', 0, 0, 0, 0, 0, 0),
('HCPCS', 3, 3, 12, 'ICD9', '', 1, 0, 0, 0, 1, 'HCPCS Procedure/Service', 0, 1, 1, 0, 0, 0),
('ICD10', 102, 102, 0, '', '', 0, 0, 0, 1, 1, 'ICD10 Diagnosis', 1, 1, 0, 0, 1, 0),
('ICD10-PCS', 106, 106, 12, 'ICD10', '', 1, 0, 0, 0, 0, 'ICD10 Procedure/Service', 6, 1, 1, 0, 0, 0),
('LOINC', 110, 110, 0, '', '', 0, 0, 1, 0, 1, 'LOINC', 0, 0, 0, 0, 0, 0),
('PHIN Questions', 111, 111, 0, '', '', 0, 0, 1, 0, 1, 'PHIN Questions', 0, 0, 0, 0, 0, 0),
('RXCUI', 109, 109, 0, '', '', 0, 0, 1, 0, 0, 'RXCUI Medication', 0, 0, 0, 0, 0, 1),
('SNOMED', 103, 103, 0, '', '', 0, 0, 0, 1, 0, 'SNOMED Diagnosis', 2, 1, 0, 0, 1, 0),
('SNOMED-CT', 107, 107, 0, '', '', 0, 0, 1, 0, 0, 'SNOMED Clinical Term', 7, 0, 0, 1, 0, 0),
('SNOMED-PR', 108, 108, 0, 'SNOMED', '', 1, 0, 0, 0, 0, 'SNOMED Procedure', 9, 1, 1, 0, 0, 0);

CREATE TABLE `dated_reminders` (
  `dr_id` int(11) NOT NULL,
  `dr_from_ID` int(11) NOT NULL,
  `dr_message_text` varchar(160) NOT NULL,
  `dr_message_sent_date` datetime NOT NULL,
  `dr_message_due_date` date NOT NULL,
  `pid` int(11) NOT NULL,
  `message_priority` tinyint(1) NOT NULL,
  `message_processed` tinyint(1) NOT NULL DEFAULT '0',
  `processed_date` timestamp NULL DEFAULT NULL,
  `dr_processed_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `dated_reminders_link` (
  `dr_link_id` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `direct_message_log` (
  `id` bigint(20) NOT NULL,
  `msg_type` char(1) NOT NULL COMMENT 'S=sent,R=received',
  `msg_id` varchar(127) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `recipient` varchar(255) NOT NULL,
  `create_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` char(1) NOT NULL COMMENT 'Q=queued,D=dispatched,R=received,F=failed',
  `status_info` varchar(511) DEFAULT NULL,
  `status_ts` timestamp NULL DEFAULT NULL,
  `patient_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL DEFAULT '0',
  `type` enum('file_url','blob','web_url') DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `revision` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foreign_id` int(11) DEFAULT NULL,
  `docdate` date DEFAULT NULL,
  `hash` varchar(40) DEFAULT NULL COMMENT '40-character SHA-1 hash of document',
  `list_id` bigint(20) NOT NULL DEFAULT '0',
  `couch_docid` varchar(100) DEFAULT NULL,
  `couch_revid` varchar(100) DEFAULT NULL,
  `storagemethod` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0->Harddisk,1->CouchDB',
  `path_depth` tinyint(4) DEFAULT '1' COMMENT 'Depth of path to use in url to find document. Not applicable for CouchDB.',
  `imported` tinyint(4) DEFAULT '0' COMMENT 'Parsing status for CCR/CCD/CCDA importing',
  `encounter_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Encounter id if tagged',
  `encounter_check` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'If encounter is created while tagging',
  `audit_master_approval_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT 'approval_status from audit_master table',
  `audit_master_id` int(11) DEFAULT NULL,
  `documentationOf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drugs` (
  `drug_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `ndc_number` varchar(20) NOT NULL DEFAULT '',
  `on_order` int(11) NOT NULL DEFAULT '0',
  `reorder_point` float NOT NULL DEFAULT '0',
  `max_level` float NOT NULL DEFAULT '0',
  `last_notify` date NOT NULL DEFAULT '0000-00-00',
  `reactions` text,
  `form` int(3) NOT NULL DEFAULT '0',
  `size` float UNSIGNED NOT NULL DEFAULT '0',
  `unit` int(11) NOT NULL DEFAULT '0',
  `route` int(11) NOT NULL DEFAULT '0',
  `substitute` int(11) NOT NULL DEFAULT '0',
  `related_code` varchar(255) NOT NULL DEFAULT '' COMMENT 'may reference a related codes.code',
  `cyp_factor` float NOT NULL DEFAULT '0' COMMENT 'quantity representing a years supply',
  `active` tinyint(1) DEFAULT '1' COMMENT '0 = inactive, 1 = active',
  `allow_combining` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = allow filling an order from multiple lots',
  `allow_multiple` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = allow multiple lots at one warehouse',
  `drug_code` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drug_inventory` (
  `inventory_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `lot_number` varchar(20) DEFAULT NULL,
  `expiration` date DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `on_hand` int(11) NOT NULL DEFAULT '0',
  `warehouse_id` varchar(31) NOT NULL DEFAULT '',
  `vendor_id` bigint(20) NOT NULL DEFAULT '0',
  `last_notify` date NOT NULL DEFAULT '0000-00-00',
  `destroy_date` date DEFAULT NULL,
  `destroy_method` varchar(255) DEFAULT NULL,
  `destroy_witness` varchar(255) DEFAULT NULL,
  `destroy_notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drug_sales` (
  `sale_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `inventory_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `encounter` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `sale_date` date NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `fee` decimal(12,2) NOT NULL DEFAULT '0.00',
  `billed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indicates if the sale is posted to accounting',
  `xfer_inventory_id` int(11) NOT NULL DEFAULT '0',
  `distributor_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references users.id',
  `notes` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `drug_templates` (
  `drug_id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL DEFAULT '',
  `dosage` varchar(10) DEFAULT NULL,
  `period` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `refills` int(11) NOT NULL DEFAULT '0',
  `taxrates` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eligibility_response` (
  `response_id` bigint(20) NOT NULL,
  `response_description` varchar(255) DEFAULT NULL,
  `response_status` enum('A','D') NOT NULL DEFAULT 'A',
  `response_vendor_id` bigint(20) DEFAULT NULL,
  `response_create_date` date DEFAULT NULL,
  `response_modify_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eligibility_verification` (
  `verification_id` bigint(20) NOT NULL,
  `response_id` bigint(20) DEFAULT NULL,
  `insurance_id` bigint(20) DEFAULT NULL,
  `eligibility_check_date` datetime DEFAULT NULL,
  `copay` int(11) DEFAULT NULL,
  `deductible` int(11) DEFAULT NULL,
  `deductiblemet` enum('Y','N') DEFAULT 'Y',
  `create_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `employer_data` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `enc_category_map` (
  `rule_enc_id` varchar(31) NOT NULL DEFAULT '' COMMENT 'encounter id from rule_enc_types list in list_options',
  `main_cat_id` int(11) NOT NULL DEFAULT '0' COMMENT 'category id from event category in libreehr_postcalendar_categories'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `enc_category_map` (`rule_enc_id`, `main_cat_id`) VALUES
('enc_acute_inp_or_ed', 5),
('enc_acute_inp_or_ed', 9),
('enc_acute_inp_or_ed', 10),
('enc_hea_and_beh', 5),
('enc_hea_and_beh', 9),
('enc_hea_and_beh', 10),
('enc_influenza', 5),
('enc_influenza', 9),
('enc_influenza', 10),
('enc_nonac_inp_out_or_opth', 5),
('enc_nonac_inp_out_or_opth', 9),
('enc_nonac_inp_out_or_opth', 10),
('enc_nurs_discharge', 5),
('enc_nurs_discharge', 9),
('enc_nurs_discharge', 10),
('enc_nurs_fac', 5),
('enc_nurs_fac', 9),
('enc_nurs_fac', 10),
('enc_occ_ther', 5),
('enc_occ_ther', 9),
('enc_occ_ther', 10),
('enc_off_vis', 5),
('enc_off_vis', 9),
('enc_off_vis', 10),
('enc_ophthal_serv', 14),
('enc_outpatient', 5),
('enc_outpatient', 9),
('enc_outpatient', 10),
('enc_out_pcp_obgyn', 5),
('enc_out_pcp_obgyn', 9),
('enc_out_pcp_obgyn', 10),
('enc_pregnancy', 5),
('enc_pregnancy', 9),
('enc_pregnancy', 10),
('enc_pre_ind_counsel', 5),
('enc_pre_ind_counsel', 9),
('enc_pre_ind_counsel', 10),
('enc_pre_med_group_counsel', 5),
('enc_pre_med_group_counsel', 9),
('enc_pre_med_group_counsel', 10),
('enc_pre_med_other_serv', 5),
('enc_pre_med_other_serv', 9),
('enc_pre_med_other_serv', 10),
('enc_pre_med_ser_18_older', 5),
('enc_pre_med_ser_18_older', 9),
('enc_pre_med_ser_18_older', 10),
('enc_pre_med_ser_40_older', 5),
('enc_pre_med_ser_40_older', 9),
('enc_pre_med_ser_40_older', 10),
('enc_psych_and_psych', 5),
('enc_psych_and_psych', 9),
('enc_psych_and_psych', 10);

CREATE TABLE `erx_ttl_touch` (
  `patient_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Patient record Id',
  `process` enum('allergies','medications') NOT NULL COMMENT 'NewCrop eRx SOAP process',
  `updated` datetime NOT NULL COMMENT 'Date and time of last process update for patient'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Store records last update per patient data process';

CREATE TABLE `esign_signatures` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL COMMENT 'Table row ID for signature',
  `table` varchar(255) NOT NULL COMMENT 'table name for the signature',
  `uid` int(11) NOT NULL COMMENT 'user id for the signing user',
  `datetime` datetime NOT NULL COMMENT 'datetime of the signature action',
  `is_lock` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sig, lock or amendment',
  `amendment` text COMMENT 'amendment text, if any',
  `hash` varchar(255) NOT NULL COMMENT 'hash of signed data',
  `signature_hash` varchar(255) NOT NULL COMMENT 'hash of signature itself'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `extended_log` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `recipient` varchar(255) DEFAULT NULL,
  `description` longtext,
  `patient_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(60) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postal_code` varchar(11) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `federal_ein` varchar(15) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `service_location` tinyint(1) NOT NULL DEFAULT '1',
  `billing_location` tinyint(1) NOT NULL DEFAULT '0',
  `accepts_assignment` tinyint(1) NOT NULL DEFAULT '0',
  `pos_code` tinyint(4) DEFAULT NULL,
  `x12_sender_id` varchar(25) DEFAULT NULL,
  `attn` varchar(65) DEFAULT NULL,
  `domain_identifier` varchar(60) DEFAULT NULL,
  `facility_npi` varchar(15) DEFAULT NULL,
  `tax_id_type` varchar(31) NOT NULL DEFAULT '',
  `color` varchar(7) NOT NULL DEFAULT '',
  `primary_business_entity` int(10) NOT NULL DEFAULT '0' COMMENT '0-Not Set as business entity 1-Set as business entity',
  `facility_code` varchar(31) DEFAULT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `facility` (`id`, `name`, `alias`, `phone`, `fax`, `street`, `city`, `state`, `postal_code`, `country_code`, `federal_ein`, `website`, `email`, `service_location`, `billing_location`, `accepts_assignment`, `pos_code`, `x12_sender_id`, `attn`, `domain_identifier`, `facility_npi`, `tax_id_type`, `color`, `primary_business_entity`, `facility_code`, `inactive`) VALUES
(1, 'Your Clinic Name Here', 'Your Clinic Name Here', '000-000-0000', '000-000-0000', '', '', '', '', '', '', NULL, NULL, 1, 1, 0, NULL, '', '', '', '', '', '#99FFFF', 0, '', 0);

CREATE TABLE `fee_sheet_options` (
  `fs_category` varchar(63) DEFAULT NULL,
  `fs_option` varchar(63) DEFAULT NULL,
  `fs_codes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `forms` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `encounter` bigint(20) DEFAULT NULL,
  `case_number` int(20) DEFAULT NULL,
  `form_name` longtext,
  `form_id` bigint(20) DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'flag indicates form has been deleted',
  `formdir` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `form_dictation` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `dictation` longtext,
  `additional_notes` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `form_encounter` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `reason` longtext,
  `facility` longtext,
  `facility_id` int(11) NOT NULL DEFAULT '0',
  `pid` bigint(20) DEFAULT NULL,
  `encounter` bigint(20) DEFAULT NULL,
  `onset_date` datetime DEFAULT NULL,
  `sensitivity` varchar(30) DEFAULT NULL,
  `billing_note` text,
  `pc_catid` int(11) NOT NULL DEFAULT '5' COMMENT 'event category from libreehr_postcalendar_categories',
  `last_level_billed` int(11) NOT NULL DEFAULT '0' COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_level_closed` int(11) NOT NULL DEFAULT '0' COMMENT '0=none, 1=ins1, 2=ins2, etc',
  `last_stmt_date` date DEFAULT NULL,
  `stmt_count` int(11) NOT NULL DEFAULT '0',
  `provider_id` int(11) DEFAULT '0' COMMENT 'default and main provider for this visit',
  `supervisor_id` int(11) DEFAULT '0' COMMENT 'supervising provider, if any, for this visit',
  `ordering_physician` int(11) DEFAULT '0' COMMENT 'ordering provider , if any, for this visit',
  `referring_physician` int(11) DEFAULT '0' COMMENT 'referring provider, if any, for this visit',
  `contract_physician` int(11) DEFAULT '0' COMMENT 'contract provider, if any, for this visit',
  `invoice_refno` varchar(31) NOT NULL DEFAULT '',
  `referral_source` varchar(31) NOT NULL DEFAULT '',
  `billing_facility` int(11) NOT NULL DEFAULT '0',
  `external_id` varchar(20) DEFAULT NULL,
  `eft_number` varchar(80) DEFAULT NULL,
  `claim_number` varchar(80) DEFAULT NULL,
  `document_image` varchar(80) DEFAULT NULL,
  `seq_number` varchar(80) DEFAULT NULL,
  `coding_complete` tinyint(1) NOT NULL DEFAULT '0',
  `case_number` int(20) DEFAULT NULL,
  `case_body_part` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `form_misc_billing_options` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `employment_related` tinyint(1) DEFAULT NULL,
  `auto_accident` tinyint(1) DEFAULT NULL,
  `accident_state` varchar(2) DEFAULT NULL,
  `other_accident` tinyint(1) DEFAULT NULL,
  `medicaid_referral_code` varchar(2) DEFAULT NULL,
  `epsdt_flag` tinyint(1) DEFAULT NULL,
  `provider_qualifier_code` varchar(2) DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `outside_lab` tinyint(1) DEFAULT NULL,
  `lab_amount` decimal(5,2) DEFAULT NULL,
  `is_unable_to_work` tinyint(1) DEFAULT NULL,
  `date_initial_treatment` date DEFAULT NULL,
  `off_work_from` date DEFAULT NULL,
  `off_work_to` date DEFAULT NULL,
  `is_hospitalized` tinyint(1) DEFAULT NULL,
  `hospitalization_date_from` date DEFAULT NULL,
  `hospitalization_date_to` date DEFAULT NULL,
  `medicaid_resubmission_code` varchar(10) DEFAULT NULL,
  `medicaid_original_reference` varchar(15) DEFAULT NULL,
  `prior_auth_number` varchar(20) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `replacement_claim` tinyint(1) DEFAULT '0',
  `icn_resubmission_number` varchar(35) DEFAULT NULL,
  `box_14_date_qual` char(3) DEFAULT NULL,
  `box_15_date_qual` char(3) DEFAULT NULL,
  `onset_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `form_vitals` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT '0',
  `activity` tinyint(4) DEFAULT '0',
  `bps` varchar(40) DEFAULT NULL,
  `bpd` varchar(40) DEFAULT NULL,
  `weight` float(5,2) DEFAULT '0.00',
  `height` float(5,2) DEFAULT '0.00',
  `temperature` float(5,2) DEFAULT '0.00',
  `temp_method` varchar(255) DEFAULT NULL,
  `pulse` float(5,2) DEFAULT '0.00',
  `respiration` float(5,2) DEFAULT '0.00',
  `note` varchar(255) DEFAULT NULL,
  `BMI` float(4,1) DEFAULT '0.0',
  `BMI_status` varchar(255) DEFAULT NULL,
  `waist_circ` float(5,2) DEFAULT '0.00',
  `head_circ` float(4,2) DEFAULT '0.00',
  `oxygen_saturation` float(5,2) DEFAULT '0.00',
  `external_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `geo_country_reference` (
  `countries_id` int(5) NOT NULL,
  `countries_name` varchar(64) DEFAULT NULL,
  `countries_iso_code_2` char(2) NOT NULL DEFAULT '',
  `countries_iso_code_3` char(3) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `geo_country_reference` (`countries_id`, `countries_name`, `countries_iso_code_2`, `countries_iso_code_3`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Albania', 'AL', 'ALB'),
(3, 'Algeria', 'DZ', 'DZA'),
(4, 'American Samoa', 'AS', 'ASM'),
(5, 'Andorra', 'AD', 'AND'),
(6, 'Angola', 'AO', 'AGO'),
(7, 'Anguilla', 'AI', 'AIA'),
(8, 'Antarctica', 'AQ', 'ATA'),
(9, 'Antigua and Barbuda', 'AG', 'ATG'),
(10, 'Argentina', 'AR', 'ARG'),
(11, 'Armenia', 'AM', 'ARM'),
(12, 'Aruba', 'AW', 'ABW'),
(13, 'Australia', 'AU', 'AUS'),
(14, 'Austria', 'AT', 'AUT'),
(15, 'Azerbaijan', 'AZ', 'AZE'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahrain', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Barbados', 'BB', 'BRB'),
(20, 'Belarus', 'BY', 'BLR'),
(21, 'Belgium', 'BE', 'BEL'),
(22, 'Belize', 'BZ', 'BLZ'),
(23, 'Benin', 'BJ', 'BEN'),
(24, 'Bermuda', 'BM', 'BMU'),
(25, 'Bhutan', 'BT', 'BTN'),
(26, 'Bolivia', 'BO', 'BOL'),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH'),
(28, 'Botswana', 'BW', 'BWA'),
(29, 'Bouvet Island', 'BV', 'BVT'),
(30, 'Brazil', 'BR', 'BRA'),
(31, 'British Indian Ocean Territory', 'IO', 'IOT'),
(32, 'Brunei Darussalam', 'BN', 'BRN'),
(33, 'Bulgaria', 'BG', 'BGR'),
(34, 'Burkina Faso', 'BF', 'BFA'),
(35, 'Burundi', 'BI', 'BDI'),
(36, 'Cambodia', 'KH', 'KHM'),
(37, 'Cameroon', 'CM', 'CMR'),
(38, 'Canada', 'CA', 'CAN'),
(39, 'Cape Verde', 'CV', 'CPV'),
(40, 'Cayman Islands', 'KY', 'CYM'),
(41, 'Central African Republic', 'CF', 'CAF'),
(42, 'Chad', 'TD', 'TCD'),
(43, 'Chile', 'CL', 'CHL'),
(44, 'China', 'CN', 'CHN'),
(45, 'Christmas Island', 'CX', 'CXR'),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK'),
(47, 'Colombia', 'CO', 'COL'),
(48, 'Comoros', 'KM', 'COM'),
(49, 'Congo', 'CG', 'COG'),
(50, 'Cook Islands', 'CK', 'COK'),
(51, 'Costa Rica', 'CR', 'CRI'),
(52, 'Cote D Ivoire', 'CI', 'CIV'),
(53, 'Croatia', 'HR', 'HRV'),
(54, 'Cuba', 'CU', 'CUB'),
(55, 'Cyprus', 'CY', 'CYP'),
(56, 'Czech Republic', 'CZ', 'CZE'),
(57, 'Denmark', 'DK', 'DNK'),
(58, 'Djibouti', 'DJ', 'DJI'),
(59, 'Dominica', 'DM', 'DMA'),
(60, 'Dominican Republic', 'DO', 'DOM'),
(61, 'East Timor', 'TP', 'TMP'),
(62, 'Ecuador', 'EC', 'ECU'),
(63, 'Egypt', 'EG', 'EGY'),
(64, 'El Salvador', 'SV', 'SLV'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ'),
(66, 'Eritrea', 'ER', 'ERI'),
(67, 'Estonia', 'EE', 'EST'),
(68, 'Ethiopia', 'ET', 'ETH'),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK'),
(70, 'Faroe Islands', 'FO', 'FRO'),
(71, 'Fiji', 'FJ', 'FJI'),
(72, 'Finland', 'FI', 'FIN'),
(73, 'France', 'FR', 'FRA'),
(74, 'France, MEtropolitan', 'FX', 'FXX'),
(75, 'French Guiana', 'GF', 'GUF'),
(76, 'French Polynesia', 'PF', 'PYF'),
(77, 'French Southern Territories', 'TF', 'ATF'),
(78, 'Gabon', 'GA', 'GAB'),
(79, 'Gambia', 'GM', 'GMB'),
(80, 'Georgia', 'GE', 'GEO'),
(81, 'Germany', 'DE', 'DEU'),
(82, 'Ghana', 'GH', 'GHA'),
(83, 'Gibraltar', 'GI', 'GIB'),
(84, 'Greece', 'GR', 'GRC'),
(85, 'Greenland', 'GL', 'GRL'),
(86, 'Grenada', 'GD', 'GRD'),
(87, 'Guadeloupe', 'GP', 'GLP'),
(88, 'Guam', 'GU', 'GUM'),
(89, 'Guatemala', 'GT', 'GTM'),
(90, 'Guinea', 'GN', 'GIN'),
(91, 'Guinea-bissau', 'GW', 'GNB'),
(92, 'Guyana', 'GY', 'GUY'),
(93, 'Haiti', 'HT', 'HTI'),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD'),
(95, 'Honduras', 'HN', 'HND'),
(96, 'Hong Kong', 'HK', 'HKG'),
(97, 'Hungary', 'HU', 'HUN'),
(98, 'Iceland', 'IS', 'ISL'),
(99, 'India', 'IN', 'IND'),
(100, 'Indonesia', 'ID', 'IDN'),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN'),
(102, 'Iraq', 'IQ', 'IRQ'),
(103, 'Ireland', 'IE', 'IRL'),
(104, 'Israel', 'IL', 'ISR'),
(105, 'Italy', 'IT', 'ITA'),
(106, 'Jamaica', 'JM', 'JAM'),
(107, 'Japan', 'JP', 'JPN'),
(108, 'Jordan', 'JO', 'JOR'),
(109, 'Kazakhstan', 'KZ', 'KAZ'),
(110, 'Kenya', 'KE', 'KEN'),
(111, 'Kiribati', 'KI', 'KIR'),
(112, 'Korea, Democratic Peoples Republic of', 'KP', 'PRK'),
(113, 'Korea, Republic of', 'KR', 'KOR'),
(114, 'Kuwait', 'KW', 'KWT'),
(115, 'Kyrgyzstan', 'KG', 'KGZ'),
(116, 'Lao Peoples Democratic Republic', 'LA', 'LAO'),
(117, 'Latvia', 'LV', 'LVA'),
(118, 'Lebanon', 'LB', 'LBN'),
(119, 'Lesotho', 'LS', 'LSO'),
(120, 'Liberia', 'LR', 'LBR'),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY'),
(122, 'Liechtenstein', 'LI', 'LIE'),
(123, 'Lithuania', 'LT', 'LTU'),
(124, 'Luxembourg', 'LU', 'LUX'),
(125, 'Macau', 'MO', 'MAC'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD'),
(127, 'Madagascar', 'MG', 'MDG'),
(128, 'Malawi', 'MW', 'MWI'),
(129, 'Malaysia', 'MY', 'MYS'),
(130, 'Maldives', 'MV', 'MDV'),
(131, 'Mali', 'ML', 'MLI'),
(132, 'Malta', 'MT', 'MLT'),
(133, 'Marshall Islands', 'MH', 'MHL'),
(134, 'Martinique', 'MQ', 'MTQ'),
(135, 'Mauritania', 'MR', 'MRT'),
(136, 'Mauritius', 'MU', 'MUS'),
(137, 'Mayotte', 'YT', 'MYT'),
(138, 'Mexico', 'MX', 'MEX'),
(139, 'Micronesia, Federated States of', 'FM', 'FSM'),
(140, 'Moldova, Republic of', 'MD', 'MDA'),
(141, 'Monaco', 'MC', 'MCO'),
(142, 'Mongolia', 'MN', 'MNG'),
(143, 'Montserrat', 'MS', 'MSR'),
(144, 'Morocco', 'MA', 'MAR'),
(145, 'Mozambique', 'MZ', 'MOZ'),
(146, 'Myanmar', 'MM', 'MMR'),
(147, 'Namibia', 'NA', 'NAM'),
(148, 'Nauru', 'NR', 'NRU'),
(149, 'Nepal', 'NP', 'NPL'),
(150, 'Netherlands', 'NL', 'NLD'),
(151, 'Netherlands Antilles', 'AN', 'ANT'),
(152, 'New Caledonia', 'NC', 'NCL'),
(153, 'New Zealand', 'NZ', 'NZL'),
(154, 'Nicaragua', 'NI', 'NIC'),
(155, 'Niger', 'NE', 'NER'),
(156, 'Nigeria', 'NG', 'NGA'),
(157, 'Niue', 'NU', 'NIU'),
(158, 'Norfolk Island', 'NF', 'NFK'),
(159, 'Northern Mariana Islands', 'MP', 'MNP'),
(160, 'Norway', 'NO', 'NOR'),
(161, 'Oman', 'OM', 'OMN'),
(162, 'Pakistan', 'PK', 'PAK'),
(163, 'Palau', 'PW', 'PLW'),
(164, 'Panama', 'PA', 'PAN'),
(165, 'Papua New Guinea', 'PG', 'PNG'),
(166, 'Paraguay', 'PY', 'PRY'),
(167, 'Peru', 'PE', 'PER'),
(168, 'Philippines', 'PH', 'PHL'),
(169, 'Pitcairn', 'PN', 'PCN'),
(170, 'Poland', 'PL', 'POL'),
(171, 'Portugal', 'PT', 'PRT'),
(172, 'Puerto Rico', 'PR', 'PRI'),
(173, 'Qatar', 'QA', 'QAT'),
(174, 'Reunion', 'RE', 'REU'),
(175, 'Romania', 'RO', 'ROM'),
(176, 'Russian Federation', 'RU', 'RUS'),
(177, 'Rwanda', 'RW', 'RWA'),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(179, 'Saint Lucia', 'LC', 'LCA'),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(181, 'Samoa', 'WS', 'WSM'),
(182, 'San Marino', 'SM', 'SMR'),
(183, 'Sao Tome and Principe', 'ST', 'STP'),
(184, 'Saudi Arabia', 'SA', 'SAU'),
(185, 'Senegal', 'SN', 'SEN'),
(186, 'Seychelles', 'SC', 'SYC'),
(187, 'Sierra Leone', 'SL', 'SLE'),
(188, 'Singapore', 'SG', 'SGP'),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK'),
(190, 'Slovenia', 'SI', 'SVN'),
(191, 'Solomon Islands', 'SB', 'SLB'),
(192, 'Somalia', 'SO', 'SOM'),
(193, 'south Africa', 'ZA', 'ZAF'),
(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(195, 'Spain', 'ES', 'ESP'),
(196, 'Sri Lanka', 'LK', 'LKA'),
(197, 'St. Helena', 'SH', 'SHN'),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM'),
(199, 'Sudan', 'SD', 'SDN'),
(200, 'Suriname', 'SR', 'SUR'),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM'),
(202, 'Swaziland', 'SZ', 'SWZ'),
(203, 'Sweden', 'SE', 'SWE'),
(204, 'Switzerland', 'CH', 'CHE'),
(205, 'Syrian Arab Republic', 'SY', 'SYR'),
(206, 'Taiwan, Province of China', 'TW', 'TWN'),
(207, 'Tajikistan', 'TJ', 'TJK'),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA'),
(209, 'Thailand', 'TH', 'THA'),
(210, 'Togo', 'TG', 'TGO'),
(211, 'Tokelau', 'TK', 'TKL'),
(212, 'Tonga', 'TO', 'TON'),
(213, 'Trinidad and Tobago', 'TT', 'TTO'),
(214, 'Tunisia', 'TN', 'TUN'),
(215, 'Turkey', 'TR', 'TUR'),
(216, 'Turkmenistan', 'TM', 'TKM'),
(217, 'Turks and Caicos Islands', 'TC', 'TCA'),
(218, 'Tuvalu', 'TV', 'TUV'),
(219, 'Uganda', 'UG', 'UGA'),
(220, 'Ukraine', 'UA', 'UKR'),
(221, 'United Arab Emirates', 'AE', 'ARE'),
(222, 'United Kingdom', 'GB', 'GBR'),
(223, 'United States', 'US', 'USA'),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI'),
(225, 'Uruguay', 'UY', 'URY'),
(226, 'Uzbekistan', 'UZ', 'UZB'),
(227, 'Vanuatu', 'VU', 'VUT'),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT'),
(229, 'Venezuela', 'VE', 'VEN'),
(230, 'Viet Nam', 'VN', 'VNM'),
(231, 'Virgin Islands (British)', 'VG', 'VGB'),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR'),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF'),
(234, 'Western Sahara', 'EH', 'ESH'),
(235, 'Yemen', 'YE', 'YEM'),
(236, 'Yugoslavia', 'YU', 'YUG'),
(237, 'Zaire', 'ZR', 'ZAR'),
(238, 'Zambia', 'ZM', 'ZMB'),
(239, 'Zimbabwe', 'ZW', 'ZWE');

CREATE TABLE `geo_zone_reference` (
  `zone_id` int(5) NOT NULL,
  `zone_country_id` int(5) NOT NULL DEFAULT '0',
  `zone_code` varchar(5) DEFAULT NULL,
  `zone_name` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `geo_zone_reference` (`zone_id`, `zone_country_id`, `zone_code`, `zone_name`) VALUES
(1, 223, 'AL', 'Alabama'),
(2, 223, 'AK', 'Alaska'),
(3, 223, 'AS', 'American Samoa'),
(4, 223, 'AZ', 'Arizona'),
(5, 223, 'AR', 'Arkansas'),
(6, 223, 'AF', 'Armed Forces Africa'),
(7, 223, 'AA', 'Armed Forces Americas'),
(8, 223, 'AC', 'Armed Forces Canada'),
(9, 223, 'AE', 'Armed Forces Europe'),
(10, 223, 'AM', 'Armed Forces Middle East'),
(11, 223, 'AP', 'Armed Forces Pacific'),
(12, 223, 'CA', 'California'),
(13, 223, 'CO', 'Colorado'),
(14, 223, 'CT', 'Connecticut'),
(15, 223, 'DE', 'Delaware'),
(16, 223, 'DC', 'District of Columbia'),
(17, 223, 'FM', 'Federated States Of Micronesia'),
(18, 223, 'FL', 'Florida'),
(19, 223, 'GA', 'Georgia'),
(20, 223, 'GU', 'Guam'),
(21, 223, 'HI', 'Hawaii'),
(22, 223, 'ID', 'Idaho'),
(23, 223, 'IL', 'Illinois'),
(24, 223, 'IN', 'Indiana'),
(25, 223, 'IA', 'Iowa'),
(26, 223, 'KS', 'Kansas'),
(27, 223, 'KY', 'Kentucky'),
(28, 223, 'LA', 'Louisiana'),
(29, 223, 'ME', 'Maine'),
(30, 223, 'MH', 'Marshall Islands'),
(31, 223, 'MD', 'Maryland'),
(32, 223, 'MA', 'Massachusetts'),
(33, 223, 'MI', 'Michigan'),
(34, 223, 'MN', 'Minnesota'),
(35, 223, 'MS', 'Mississippi'),
(36, 223, 'MO', 'Missouri'),
(37, 223, 'MT', 'Montana'),
(38, 223, 'NE', 'Nebraska'),
(39, 223, 'NV', 'Nevada'),
(40, 223, 'NH', 'New Hampshire'),
(41, 223, 'NJ', 'New Jersey'),
(42, 223, 'NM', 'New Mexico'),
(43, 223, 'NY', 'New York'),
(44, 223, 'NC', 'North Carolina'),
(45, 223, 'ND', 'North Dakota'),
(46, 223, 'MP', 'Northern Mariana Islands'),
(47, 223, 'OH', 'Ohio'),
(48, 223, 'OK', 'Oklahoma'),
(49, 223, 'OR', 'Oregon'),
(50, 223, 'PW', 'Palau'),
(51, 223, 'PA', 'Pennsylvania'),
(52, 223, 'PR', 'Puerto Rico'),
(53, 223, 'RI', 'Rhode Island'),
(54, 223, 'SC', 'South Carolina'),
(55, 223, 'SD', 'South Dakota'),
(56, 223, 'TN', 'Tenessee'),
(57, 223, 'TX', 'Texas'),
(58, 223, 'UT', 'Utah'),
(59, 223, 'VT', 'Vermont'),
(60, 223, 'VI', 'Virgin Islands'),
(61, 223, 'VA', 'Virginia'),
(62, 223, 'WA', 'Washington'),
(63, 223, 'WV', 'West Virginia'),
(64, 223, 'WI', 'Wisconsin'),
(65, 223, 'WY', 'Wyoming'),
(66, 38, 'AB', 'Alberta'),
(67, 38, 'BC', 'British Columbia'),
(68, 38, 'MB', 'Manitoba'),
(69, 38, 'NF', 'Newfoundland'),
(70, 38, 'NB', 'New Brunswick'),
(71, 38, 'NS', 'Nova Scotia'),
(72, 38, 'NT', 'Northwest Territories'),
(73, 38, 'NU', 'Nunavut'),
(74, 38, 'ON', 'Ontario'),
(75, 38, 'PE', 'Prince Edward Island'),
(76, 38, 'QC', 'Quebec'),
(77, 38, 'SK', 'Saskatchewan'),
(78, 38, 'YT', 'Yukon Territory'),
(79, 61, 'QLD', 'Queensland'),
(80, 61, 'SA', 'South Australia'),
(81, 61, 'ACT', 'Australian Capital Territory'),
(82, 61, 'VIC', 'Victoria');

CREATE TABLE `globals` (
  `gl_name` varchar(63) NOT NULL,
  `gl_index` int(11) NOT NULL DEFAULT '0',
  `gl_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `globals` (`gl_name`, `gl_index`, `gl_value`) VALUES
('account_in_collections', 0, '0'),
('activate_ccr_ccd_report', 0, '1'),
('addr_label_type', 0, '1'),
('admit_default_source', 0, ''),
('admit_default_type', 0, ''),
('advance_directives_warning', 0, '0'),
('age_display_format', 0, '0'),
('age_display_limit', 0, '3'),
('allow_appointments_in_feesheet', 0, '0'),
('allow_debug_language', 0, '1'),
('allow_pat_delete', 0, '1'),
('amendments', 0, '1'),
('appt_display_sets_color_1', 0, '#FFFFFF'),
('appt_display_sets_color_2', 0, '#E6E6FF'),
('appt_display_sets_color_3', 0, '#E6FFE6'),
('appt_display_sets_color_4', 0, '#FFE6FF'),
('appt_display_sets_option', 0, '1'),
('appt_overbook_statuses', 0, 'x, ?, %, ^, =, &'),
('appt_recurrences_widget', 0, '0'),
('atna_audit_cacert', 0, ''),
('atna_audit_host', 0, ''),
('atna_audit_localcert', 0, ''),
('atna_audit_port', 0, '6514'),
('attending_id', 0, ''),
('attending_qualifier_code', 0, ''),
('audit_events_backup', 0, '1'),
('audit_events_cdr', 0, '0'),
('audit_events_order', 0, '1'),
('audit_events_other', 0, '1'),
('audit_events_patient-record', 0, '1'),
('audit_events_query', 0, '0'),
('audit_events_scheduling', 0, '1'),
('audit_events_security-administration', 0, '1'),
('auto_create_new_encounters', 0, '1'),
('auto_writeoff_y_n', 0, '1'),
('backup_log_dir', 0, 'C:/windows/temp'),
('barcode_label_type', 0, '9'),
('billing_log_option', 0, '1'),
('billing_phone_number', 0, ''),
('bill_to_patient', 0, '0'),
('calendar_appt_style', 0, '2'),
('calendar_interval', 0, '15'),
('calendar_provider_view_type', 0, 'full'),
('calendar_refresh_freq', 0, '360000'),
('calendar_view_type', 0, 'providerAgenda'),
('cash_receipts_report_invoice', 0, '0'),
('ccda_alt_service_enable', 0, '0'),
('certificate_authority_crt', 0, ''),
('certificate_authority_key', 0, ''),
('chart_label_type', 0, '1'),
('checkout_roll_off', 0, '0'),
('check_appt_time', 0, '1'),
('claim_type', 0, '0'),
('client_certificate_valid_in_days', 0, '365'),
('cms_1500', 0, '1'),
('cms_1500_box_31_date', 0, '0'),
('cms_1500_box_31_format', 0, '0'),
('cms_left_margin_default', 0, '20'),
('cms_top_margin_default', 0, '24'),
('coding_done_in_feesheet', 0, '0'),
('configuration_import_export', 0, '0'),
('contract_physician_in_feesheet', 0, '0'),
('contract_physician_in_feesheet_name', 0, 'Contractor'),
('couchdb_dbase', 0, ''),
('couchdb_host', 0, 'localhost'),
('couchdb_log', 0, '0'),
('couchdb_pass', 0, ''),
('couchdb_port', 0, '5984'),
('couchdb_user', 0, ''),
('country_data_type', 0, '26'),
('country_list', 0, 'country'),
('css_header', 0, 'style_prism.css'),
('currency_decimals', 0, '2'),
('currency_dec_point', 0, '.'),
('currency_thousands_sep', 0, ','),
('date_display_format', 0, '0'),
('daysheet_provider_totals', 0, '1'),
('default_bill_type', 0, '0111'),
('default_category', 0, '1'),
('default_chief_complaint', 0, ''),
('default_encounter_view', 0, '0'),
('default_fee_sheet_line_item_provider', 0, '0'),
('default_new_encounter_form', 0, ''),
('default_search_code_type', 0, 'ICD10'),
('default_tab_1', 0, '/interface/main/main_info.php'),
('default_tab_2', 0, '/interface/main/messages/messages.php?form_active=1'),
('disable_calendar', 0, '0'),
('disable_chart_tracker', 0, '0'),
('disable_deprecated_metrics_form', 0, '1'),
('disable_immunizations', 0, '0'),
('disable_non_default_groups', 0, '1'),
('disable_pat_trkr', 0, '0'),
('disable_prescriptions', 0, '0'),
('disable_sql_admin_link', 0, '1'),
('disallow_print_deceased', 0, '0'),
('discharge_status_default', 0, ''),
('discount_by_money', 0, '1'),
('display_canceled_appointments', 0, '1'),
('display_onset_date_entry', 0, '0'),
('display_units_in_billing', 0, '0'),
('docs_see_entire_calendar', 0, '0'),
('document_storage_method', 0, '0'),
('drug_screen', 0, '0'),
('drug_testing_percentage', 0, '33'),
('ehr_timezone', 0, '!Europe/Berlin'),
('EMAIL_METHOD', 0, 'SMTP'),
('EMAIL_NOTIFICATION_HOUR', 0, '50'),
('Emergency_Login_email_id', 0, ''),
('enable_alert_log', 0, '1'),
('enable_allergy_check', 0, '1'),
('enable_atna_audit', 0, '0'),
('enable_auditlog', 0, '1'),
('enable_auditlog_encryption', 0, '0'),
('enable_cdr', 0, '1'),
('enable_cdr_crp', 0, '1'),
('enable_cdr_crw', 0, '1'),
('enable_cdr_new_crp', 0, '1'),
('enable_cdr_prw', 0, '1'),
('enable_edihistory_in_menu', 0, '0'),
('enable_fees_in_menu', 0, '1'),
('enable_hylafax', 0, '0'),
('enable_pqrs', 0, '0'),
('enable_scanner', 0, '0'),
('encounter_feesheet_list_num', 0, '4'),
('encounter_page_size', 0, '20'),
('env_font_size', 0, '14'),
('env_x_dist', 0, '65'),
('env_x_width', 0, '104.775'),
('env_y_dist', 0, '220'),
('env_y_height', 0, '241.3'),
('erx_account_id', 0, '1'),
('erx_account_name', 0, ''),
('erx_account_partner_name', 0, ''),
('erx_account_password', 0, ''),
('erx_allergy_display', 0, '0'),
('erx_debug_setting', 0, '0'),
('erx_default_patient_country', 0, ''),
('erx_enable', 0, '0'),
('erx_import_status_message', 0, '0'),
('erx_medication_display', 0, '0'),
('erx_newcrop_path', 0, 'https://secure.newcropaccounts.com/InterfaceV7/RxEntry.aspx'),
('erx_newcrop_path_soap', 0, 'https://secure.newcropaccounts.com/v7/WebServices/Update1.asmx?WSDL;https://secure.newcropaccounts.com/v7/WebServices/Patient.asmx?WSDL'),
('erx_soap_ttl_allergies', 0, '21600'),
('erx_soap_ttl_medications', 0, '21600'),
('erx_upload_active', 0, '0'),
('esign_all', 0, '0'),
('esign_individual', 0, '1'),
('esign_lock_toggle', 0, '0'),
('esign_report_hide_empty_sig', 0, '1'),
('event_color', 0, '1'),
('expand_document_tree', 0, '0'),
('facility_acl', 0, '0'),
('fifth_dun_msg_set', 0, '150'),
('fifth_dun_msg_text', 0, ''),
('first_day_week', 0, '1'),
('first_dun_msg_set', 0, '30'),
('first_dun_msg_text', 0, ''),
('floating_message_alerts', 0, '0'),
('floating_message_alerts_allergies', 0, '0'),
('floating_message_alerts_timer', 0, '0:20'),
('force_billing_widget_open', 0, '0'),
('fourth_dun_msg_set', 0, '120'),
('fourth_dun_msg_text', 0, ''),
('full_new_patient_form', 0, '1'),
('gbl_appt_list_page_size', 0, '10'),
('gbl_currency_symbol', 0, '$'),
('gbl_mask_invoice_number', 0, ''),
('gbl_mask_patient_id', 0, ''),
('gbl_mask_product_id', 0, ''),
('gbl_mdm_category_name', 0, 'Lab Report'),
('gbl_print_log_option', 0, '0'),
('gbl_pt_list_page_size', 0, '10'),
('gbl_visit_referral_source', 0, '0'),
('gbl_vitals_options', 0, '0'),
('gb_how_sort_categories', 0, '1'),
('gb_how_sort_list', 0, '0'),
('hide_billing_widget', 0, '0'),
('hide_document_encryption', 0, '1'),
('hylafax_basedir', 0, '/var/spool/fax'),
('hylafax_enscript', 0, 'enscript -M Letter -B -e^ --margins=36:36:36:36'),
('hylafax_server', 0, 'localhost'),
('ignore_pnotes_authorization', 0, '1'),
('inactivate_insurance_companies', 0, '0'),
('inhouse_pharmacy', 0, '0'),
('insurance_address_demographics_report', 0, '0'),
('insurance_information', 0, '4'),
('insurance_statement_exclude', 0, '1'),
('is_client_ssl_enabled', 0, '0'),
('lab_results_category_name', 0, 'Lab Report'),
('language_default', 0, 'English (Standard)'),
('language_menu_showall', 0, '1'),
('ledger_begin_date', 0, 'Y1'),
('libreehr_name', 0, 'Libre EHR'),
('lims_application', 0, 'Choose the LIMS software to use'),
('lims_enabled', 0, '0'),
('lims_url', 0, 'http://localhost:8080'),
('lock_esign_all', 0, '0'),
('lock_esign_individual', 0, '1'),
('log_password_login_attempts', 0, '0'),
('maximum_drug_test_yearly', 0, '0'),
('MedicareReferrerIsRenderer', 0, '0'),
('minimum_amount_to_print', 0, '1.00'),
('mysql_bin_dir', 0, 'C:/xampp/mysql/bin'),
('notes_to_display_in_Billing', 0, '3'),
('number_appointments_on_statement', 0, '2'),
('number_of_appts_to_show', 0, '10'),
('num_past_appointments_to_show', 0, '0'),
('omit_employers', 0, '0'),
('online_support_link', 0, 'https://forums.LibreEHR.org/c/7-support'),
('operating_id', 0, ''),
('operating_qualifier_code', 0, ''),
('ordering_physician_in_feesheet', 0, '0'),
('other1_id', 0, ''),
('other1_qualifier_code', 0, ''),
('other2_id', 0, ''),
('other2_qualifier_code', 0, ''),
('password_compatibility', 0, '1'),
('password_expiration_days', 0, '0'),
('password_grace_time', 0, '0'),
('password_history', 0, '0'),
('password_login_attempts', 0, '3'),
('patient_id_category_name', 0, 'Patient ID card'),
('patient_photo_category_name', 0, 'Patient Photograph'),
('patient_portal_appt_display_num', 0, '20'),
('patient_reminder_sender_email', 0, ''),
('patient_reminder_sender_name', 0, ''),
('patient_search_results_style', 0, '0'),
('pat_rem_clin_nice', 0, ''),
('pat_trkr_timer', 0, '20'),
('payment_delete_begin_date', 0, 'N0'),
('pdf_bottom_margin', 0, '8'),
('pdf_language', 0, 'en'),
('pdf_layout', 0, 'P'),
('pdf_left_margin', 0, '5'),
('pdf_output', 0, 'D'),
('pdf_right_margin', 0, '5'),
('pdf_size', 0, 'LETTER'),
('pdf_top_margin', 0, '5'),
('perl_bin_dir', 0, 'C:/xampp/perl/bin'),
('phimail_ccd_enable', 0, '0'),
('phimail_ccr_enable', 0, '0'),
('phimail_enable', 0, '0'),
('phimail_interval', 0, '5'),
('phimail_notify', 0, 'admin'),
('phimail_password', 0, ''),
('phimail_server_address', 0, 'https://phimail.example.com:32541'),
('phimail_username', 0, ''),
('phone_country_code', 0, '1'),
('phone_number_format', 0, '($1) $2-$3'),
('portal_default_status', 0, '- None'),
('portal_onsite_address', 0, 'https://your_web_site.com/libreehr/patient_portal'),
('portal_onsite_appt_modify', 0, '0'),
('portal_onsite_document_download', 0, '1'),
('portal_onsite_enable', 0, '0'),
('portal_onsite_two_basepath', 0, '0'),
('portal_onsite_two_register', 0, '1'),
('portal_search_days', 0, '7'),
('portal_start_days', 0, '14'),
('portal_two_pass_reset', 0, '0'),
('portal_two_payments', 0, '0'),
('post_to_date_benchmark', 0, '2020-08-06'),
('pqrs_attestation_date', 0, '2017-06-06'),
('pqrs_creator', 0, 'FIXME creator FIXME!!!'),
('pqrs_demosystem', 0, '0'),
('pqrs_entityType', 0, 'FIXME entityType FIXME!!!'),
('pqrs_registry_id', 0, 'FIXME registry id FIXME!!!'),
('pqrs_registry_name', 0, 'FIXME registry name FIXME!!!'),
('practice_return_email_path', 0, ''),
('preprinted_cms_1450', 0, '0'),
('preprinted_cms_1500', 0, '0'),
('primary_color', 0, '#ffffff'),
('primary_font_color', 0, '#000000'),
('primary_insurance_required', 0, '0'),
('print_command', 0, 'lpr -P HPLaserjet6P -o cpi=10 -o lpi=6 -o page-left=72 -o page-top=72'),
('print_next_appointment_on_ledger', 0, '1'),
('ptkr_begin_date', 0, 'D1'),
('ptkr_date_range', 0, '0'),
('ptkr_end_date', 0, 'Y1'),
('ptkr_flag_dblbook', 0, '1'),
('ptkr_show_encounter', 0, '1'),
('ptkr_show_facility', 0, '1'),
('ptkr_show_pid', 0, '1'),
('ptkr_show_room', 0, '1'),
('ptkr_show_visit_type', 0, '1'),
('ptkr_visit_reason', 0, '0'),
('receipts_by_provider', 0, '0'),
('referring_physician_in_feesheet', 0, '0'),
('replicate_justification', 0, '0'),
('report_itemizing_pqrs', 0, '1'),
('restrict_user_facility', 0, '0'),
('role_based_menu_status', 0, '0'),
('rx_bottom_margin', 0, '30'),
('rx_enable_DEA', 0, '1'),
('rx_enable_NPI', 0, '0'),
('rx_enable_SLN', 0, '0'),
('rx_left_margin', 0, '30'),
('rx_paper_size', 0, 'LETTER'),
('rx_right_margin', 0, '30'),
('rx_show_DEA', 0, '0'),
('rx_show_NPI', 0, '0'),
('rx_show_SLN', 0, '0'),
('rx_top_margin', 0, '72'),
('sales_report_invoice', 0, '2'),
('scanner_output_directory', 0, '/mnt/scan_docs'),
('schedule_end', 0, '17'),
('schedule_start', 0, '8'),
('secondary_color', 0, '#ffffff'),
('secondary_font_color', 0, '#000000'),
('second_dun_msg_set', 0, '60'),
('second_dun_msg_text', 0, ''),
('secure_password', 0, '0'),
('select_multi_providers', 0, '0'),
('set_facility_cookie', 0, '0'),
('show_aging_on_custom_statement', 0, '0'),
('show_insurance_name_on_custom_statement', 0, '0'),
('simplified_copay', 0, '0'),
('simplified_demographics', 0, '0'),
('simplified_prescriptions', 0, '0'),
('SMTP_HOST', 0, 'localhost'),
('SMTP_PASS', 0, ''),
('SMTP_PORT', 0, '25'),
('SMTP_SECURE', 0, ''),
('SMTP_USER', 0, ''),
('specific_application', 0, '0'),
('statement_appearance', 0, '1'),
('statement_bill_note_print', 0, '0'),
('statement_message_to_patient', 0, '0'),
('statement_msg_text', 0, ''),
('state_custom_addlist_widget', 0, '1'),
('state_data_type', 0, '26'),
('state_list', 0, 'state'),
('status_default', 0, ''),
('supervising_physician_in_feesheet', 0, '0'),
('support_encounter_claims', 0, '0'),
('support_fee_sheet_line_item_provider', 0, '0'),
('support_phone_number', 0, ''),
('temporary_files_dir', 0, 'C:/windows/temp'),
('third_dun_msg_set', 0, '90'),
('third_dun_msg_text', 0, ''),
('timeout', 0, '7200'),
('time_display_format', 0, '0'),
('translate_appt_categories', 0, '1'),
('translate_document_categories', 0, '1'),
('translate_form_titles', 0, '1'),
('translate_layout', 0, '1'),
('translate_lists', 0, '1'),
('ubleft_margin_default', 0, '14'),
('ubtop_margin_default', 0, '07'),
('units_of_measurement', 0, '1'),
('updater_icon_visibility', 0, '1'),
('use_appt_status_colors', 0, '1'),
('use_custom_daysheet', 0, '1'),
('use_custom_immun_list', 0, '0'),
('use_custom_statement', 0, '0'),
('use_dunning_message', 0, '0'),
('use_statement_print_exclusion', 0, '0'),
('us_weight_format', 0, '1'),
('weekend_days', 0, '6,0');

CREATE TABLE `gprelations` (
  `type1` int(2) NOT NULL,
  `id1` bigint(20) NOT NULL,
  `type2` int(2) NOT NULL,
  `id2` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='general purpose relations, pnotes only, intended to replace issue_encounters';

CREATE TABLE `groups` (
  `id` bigint(20) NOT NULL,
  `name` longtext,
  `user` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this needs to die';


CREATE TABLE `history_data` (
  `id` bigint(20) NOT NULL,
  `coffee` longtext,
  `tobacco` longtext,
  `alcohol` longtext,
  `sleep_patterns` longtext,
  `exercise_patterns` longtext,
  `seatbelt_use` longtext,
  `counseling` longtext,
  `hazardous_activities` longtext,
  `recreational_drugs` longtext,
  `last_breast_exam` varchar(255) DEFAULT NULL,
  `last_mammogram` varchar(255) DEFAULT NULL,
  `last_gynocological_exam` varchar(255) DEFAULT NULL,
  `last_rectal_exam` varchar(255) DEFAULT NULL,
  `last_prostate_exam` varchar(255) DEFAULT NULL,
  `last_physical_exam` varchar(255) DEFAULT NULL,
  `last_sigmoidoscopy_colonoscopy` varchar(255) DEFAULT NULL,
  `last_ecg` varchar(255) DEFAULT NULL,
  `last_cardiac_echo` varchar(255) DEFAULT NULL,
  `last_retinal` varchar(255) DEFAULT NULL,
  `last_fluvax` varchar(255) DEFAULT NULL,
  `last_pneuvax` varchar(255) DEFAULT NULL,
  `last_ldl` varchar(255) DEFAULT NULL,
  `last_hemoglobin` varchar(255) DEFAULT NULL,
  `last_psa` varchar(255) DEFAULT NULL,
  `last_exam_results` varchar(255) DEFAULT NULL,
  `history_mother` longtext,
  `dc_mother` text,
  `history_father` longtext,
  `dc_father` text,
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
  `cataract_surgery` datetime DEFAULT NULL,
  `tonsillectomy` datetime DEFAULT NULL,
  `cholecystestomy` datetime DEFAULT NULL,
  `heart_surgery` datetime DEFAULT NULL,
  `hysterectomy` datetime DEFAULT NULL,
  `hernia_repair` datetime DEFAULT NULL,
  `hip_replacement` datetime DEFAULT NULL,
  `knee_replacement` datetime DEFAULT NULL,
  `appendectomy` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `name_1` varchar(255) DEFAULT NULL,
  `value_1` varchar(255) DEFAULT NULL,
  `name_2` varchar(255) DEFAULT NULL,
  `value_2` varchar(255) DEFAULT NULL,
  `additional_history` text,
  `exams` text,
  `risk_factors` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_dx_order_code` (
  `dx_id` bigint(20) UNSIGNED NOT NULL,
  `dx_code` varchar(7) DEFAULT NULL,
  `formatted_dx_code` varchar(10) DEFAULT NULL,
  `valid_for_coding` char(1) DEFAULT NULL,
  `short_desc` varchar(60) DEFAULT NULL,
  `long_desc` varchar(300) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_gem_dx_9_10` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `dx_icd9_source` varchar(5) DEFAULT NULL,
  `dx_icd10_target` varchar(7) DEFAULT NULL,
  `flags` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_gem_dx_10_9` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `dx_icd10_source` varchar(7) DEFAULT NULL,
  `dx_icd9_target` varchar(5) DEFAULT NULL,
  `flags` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_gem_pcs_9_10` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `pcs_icd9_source` varchar(5) DEFAULT NULL,
  `pcs_icd10_target` varchar(7) DEFAULT NULL,
  `flags` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_gem_pcs_10_9` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `pcs_icd10_source` varchar(7) DEFAULT NULL,
  `pcs_icd9_target` varchar(5) DEFAULT NULL,
  `flags` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_pcs_order_code` (
  `pcs_id` bigint(20) UNSIGNED NOT NULL,
  `pcs_code` varchar(7) DEFAULT NULL,
  `valid_for_coding` char(1) DEFAULT NULL,
  `short_desc` varchar(60) DEFAULT NULL,
  `long_desc` varchar(300) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_reimbr_dx_9_10` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) DEFAULT NULL,
  `code_cnt` tinyint(4) DEFAULT NULL,
  `ICD9_01` varchar(5) DEFAULT NULL,
  `ICD9_02` varchar(5) DEFAULT NULL,
  `ICD9_03` varchar(5) DEFAULT NULL,
  `ICD9_04` varchar(5) DEFAULT NULL,
  `ICD9_05` varchar(5) DEFAULT NULL,
  `ICD9_06` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `icd10_reimbr_pcs_9_10` (
  `map_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(8) DEFAULT NULL,
  `code_cnt` tinyint(4) DEFAULT NULL,
  `ICD9_01` varchar(5) DEFAULT NULL,
  `ICD9_02` varchar(5) DEFAULT NULL,
  `ICD9_03` varchar(5) DEFAULT NULL,
  `ICD9_04` varchar(5) DEFAULT NULL,
  `ICD9_05` varchar(5) DEFAULT NULL,
  `ICD9_06` varchar(5) DEFAULT NULL,
  `active` tinyint(4) DEFAULT '0',
  `revision` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `immunizations` (
  `id` bigint(20) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `administered_date` datetime DEFAULT NULL,
  `immunization_id` int(11) DEFAULT NULL,
  `cvx_code` varchar(10) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `lot_number` varchar(50) DEFAULT NULL,
  `administered_by_id` bigint(20) DEFAULT NULL,
  `administered_by` varchar(255) DEFAULT NULL COMMENT 'Alternative to administered_by_id',
  `education_date` date DEFAULT NULL,
  `vis_date` date DEFAULT NULL COMMENT 'Date of VIS Statement',
  `note` text,
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `amount_administered` float DEFAULT NULL,
  `amount_administered_unit` varchar(50) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `route` varchar(100) DEFAULT NULL,
  `administration_site` varchar(100) DEFAULT NULL,
  `added_erroneously` tinyint(1) NOT NULL DEFAULT '0',
  `external_id` varchar(20) DEFAULT NULL,
  `completion_status` varchar(50) DEFAULT NULL,
  `information_source` varchar(31) DEFAULT NULL,
  `refusal_reason` varchar(31) DEFAULT NULL,
  `ordering_provider` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `insurance_companies` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `attn` varchar(255) DEFAULT NULL,
  `cms_id` varchar(15) DEFAULT NULL,
  `ins_type_code` tinyint(2) DEFAULT NULL,
  `x12_receiver_id` varchar(25) DEFAULT NULL,
  `x12_default_partner_id` int(11) DEFAULT NULL,
  `alt_cms_id` varchar(15) NOT NULL DEFAULT '',
  `ins_inactive` tinyint(1) NOT NULL DEFAULT '0',
  `allow_print_statement` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' 1 = Yes Print Statements',
  `tier` varchar(5) NOT NULL DEFAULT '',
  `ins_co_initials` varchar(10) NOT NULL,
  `account_type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `insurance_data` (
  `id` bigint(20) NOT NULL,
  `case_number` int(20) DEFAULT NULL COMMENT 'case_id in pt_case table',
  `case_info_id` int(20) DEFAULT NULL COMMENT 'pci_id in pt_case_info',
  `type` enum('primary','secondary','tertiary') DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL,
  `policy_number` varchar(255) DEFAULT NULL,
  `group_number` varchar(255) DEFAULT NULL,
  `subscriber_lname` varchar(255) DEFAULT NULL,
  `subscriber_mname` varchar(255) DEFAULT NULL,
  `subscriber_fname` varchar(255) DEFAULT NULL,
  `subscriber_relationship` varchar(255) DEFAULT NULL,
  `subscriber_ss` varchar(255) DEFAULT NULL,
  `subscriber_DOB` date DEFAULT NULL,
  `subscriber_street` varchar(255) DEFAULT NULL,
  `subscriber_postal_code` varchar(255) DEFAULT NULL,
  `subscriber_city` varchar(255) DEFAULT NULL,
  `subscriber_state` varchar(255) DEFAULT NULL,
  `subscriber_country` varchar(255) DEFAULT NULL,
  `subscriber_phone` varchar(255) DEFAULT NULL,
  `subscriber_employer` varchar(255) DEFAULT NULL,
  `subscriber_employer_street` varchar(255) DEFAULT NULL,
  `subscriber_employer_postal_code` varchar(255) DEFAULT NULL,
  `subscriber_employer_state` varchar(255) DEFAULT NULL,
  `subscriber_employer_country` varchar(255) DEFAULT NULL,
  `subscriber_employer_city` varchar(255) DEFAULT NULL,
  `copay` varchar(255) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `eDate` date NOT NULL DEFAULT '0000-00-00',
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `subscriber_sex` varchar(25) DEFAULT NULL,
  `accept_assignment` varchar(5) NOT NULL DEFAULT 'TRUE',
  `policy_type` varchar(25) NOT NULL DEFAULT '',
  `inactive` tinyint(1) DEFAULT '0',
  `inactive_time` datetime DEFAULT NULL,
  `family_deductible` varchar(15) DEFAULT '0',
  `family_deductible_met` varchar(15) DEFAULT '0',
  `individual_deductible` varchar(15) DEFAULT '0',
  `individual_deductible_met` varchar(15) DEFAULT '0',
  `pays_at` varchar(15) DEFAULT '0',
  `max_out_of_pocket` varchar(15) DEFAULT '0',
  `out_of_pocket_met` varchar(15) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `insurance_data` (`id`, `case_number`, `case_info_id`, `type`, `provider`, `plan_name`, `policy_number`, `group_number`, `subscriber_lname`, `subscriber_mname`, `subscriber_fname`, `subscriber_relationship`, `subscriber_ss`, `subscriber_DOB`, `subscriber_street`, `subscriber_postal_code`, `subscriber_city`, `subscriber_state`, `subscriber_country`, `subscriber_phone`, `subscriber_employer`, `subscriber_employer_street`, `subscriber_employer_postal_code`, `subscriber_employer_state`, `subscriber_employer_country`, `subscriber_employer_city`, `copay`, `date`, `eDate`, `pid`, `subscriber_sex`, `accept_assignment`, `policy_type`, `inactive`, `inactive_time`, `family_deductible`, `family_deductible_met`, `individual_deductible`, `individual_deductible_met`, `pays_at`, `max_out_of_pocket`, `out_of_pocket_met`) VALUES
(1, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(2, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(3, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 1, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(4, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 2, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(5, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 2, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(6, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 2, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(7, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 3, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(8, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 3, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(9, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 3, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(10, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 4, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(11, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 4, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(12, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 4, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(13, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 5, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(14, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 5, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(15, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 5, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(16, NULL, NULL, 'primary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 6, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(17, NULL, NULL, 'secondary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 6, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0'),
(18, NULL, NULL, 'tertiary', '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 6, '', 'TRUE', '', 0, NULL, '0', '0', '0', '0', '0', '0', '0');

CREATE TABLE `insurance_numbers` (
  `id` int(11) NOT NULL DEFAULT '0',
  `provider_id` int(11) NOT NULL DEFAULT '0',
  `insurance_company_id` int(11) DEFAULT NULL,
  `provider_number` varchar(20) DEFAULT NULL,
  `rendering_provider_number` varchar(20) DEFAULT NULL,
  `group_number` varchar(20) DEFAULT NULL,
  `provider_number_type` varchar(4) DEFAULT NULL,
  `rendering_provider_number_type` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `issue_encounter` (
  `pid` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `encounter` int(11) NOT NULL,
  `resolved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `issue_types` (
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(75) NOT NULL DEFAULT '',
  `type` varchar(75) NOT NULL DEFAULT '',
  `plural` varchar(75) NOT NULL DEFAULT '',
  `singular` varchar(75) NOT NULL DEFAULT '',
  `abbreviation` varchar(75) NOT NULL DEFAULT '',
  `style` smallint(6) NOT NULL DEFAULT '0',
  `force_show` smallint(6) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `issue_types` (`active`, `category`, `type`, `plural`, `singular`, `abbreviation`, `style`, `force_show`, `ordering`) VALUES
(1, 'default', 'allergy', 'Allergies', 'Allergy', 'A', 0, 1, 20),
(1, 'default', 'dental', 'Dental Issues', 'Dental', 'D', 0, 0, 50),
(1, 'default', 'medical_problem', 'Medical Problems', 'Problem', 'P', 0, 1, 10),
(1, 'default', 'medication', 'Medications', 'Medication', 'M', 0, 1, 30),
(1, 'default', 'surgery', 'Surgeries', 'Surgery', 'S', 0, 0, 40));

CREATE TABLE `lang_constants` (
  `cons_id` int(11) NOT NULL,
  `constant_name` mediumtext CHARACTER SET utf8 COLLATE utf8_bin
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `lang_custom` (
  `lang_description` varchar(100) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT '',
  `constant_name` mediumtext,
  `definition` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lang_definitions` (
  `def_id` int(11) NOT NULL,
  `cons_id` int(11) NOT NULL DEFAULT '0',
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `definition` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `lang_languages` (
  `lang_id` int(11) NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT '',
  `lang_description` varchar(100) DEFAULT NULL,
  `lang_is_rtl` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `lang_languages` (`lang_id`, `lang_code`, `lang_description`, `lang_is_rtl`) VALUES
(1, 'en', 'English (Standard)', 0);

CREATE TABLE `layout_options` (
  `form_id` varchar(31) NOT NULL DEFAULT '',
  `field_id` varchar(31) NOT NULL DEFAULT '',
  `group_name` varchar(31) NOT NULL DEFAULT '',
  `title` varchar(63) NOT NULL DEFAULT '',
  `seq` int(11) NOT NULL DEFAULT '0',
  `data_type` tinyint(3) NOT NULL DEFAULT '0',
  `uor` tinyint(1) NOT NULL DEFAULT '1',
  `fld_length` int(11) NOT NULL DEFAULT '15',
  `max_length` int(11) NOT NULL DEFAULT '0',
  `list_id` varchar(31) NOT NULL DEFAULT '',
  `titlecols` tinyint(3) NOT NULL DEFAULT '1',
  `datacols` tinyint(3) NOT NULL DEFAULT '1',
  `default_value` varchar(255) NOT NULL DEFAULT '',
  `edit_options` varchar(36) NOT NULL DEFAULT '',
  `description` text,
  `fld_rows` int(11) NOT NULL DEFAULT '0',
  `list_backup_id` varchar(31) NOT NULL DEFAULT '',
  `source` char(1) NOT NULL DEFAULT 'F' COMMENT 'F=Form, D=Demographics, H=History, E=Encounter',
  `conditions` text COMMENT 'serialized array of skip conditions'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `layout_options` (`form_id`, `field_id`, `group_name`, `title`, `seq`, `data_type`, `uor`, `fld_length`, `max_length`, `list_id`, `titlecols`, `datacols`, `default_value`, `edit_options`, `description`, `fld_rows`, `list_backup_id`, `source`, `conditions`) VALUES
('DEM', 'allow_health_info_ex', '2Privacy', 'Allow Health Information Exchange', 45, 1, 1, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_imm_info_share', '2Privacy', 'Allow Immunization Info Sharing', 40, 1, 1, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_imm_reg_use', '2Privacy', 'Allow Immunization Registry Use', 35, 1, 1, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'allow_patient_portal', '2Privacy', 'Allow Patient Portal', 1, 1, 1, 0, 0, 'yesno', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'billing_note', '1Face Sheet', 'Billing Note', 80, 2, 1, 60, 0, '', 1, 3, '', '', 'Patient Level Billing Note (Collections)', 0, '', 'F', ''),
('DEM', 'city', '1Face Sheet', 'City', 40, 2, 1, 15, 63, '', 1, 1, '', 'C', 'City Name', 0, '', 'F', ''),
('DEM', 'contact_relationship', '2Contacts', 'Emergency Contact', 30, 2, 1, 10, 63, '', 1, 1, '', 'C', 'Emergency Contact Person', 0, '', 'F', ''),
('DEM', 'contrastart', '2Privacy', 'Contraceptives Start', 50, 4, 0, 0, 10, '', 1, 1, '', '', 'Date contraceptive services initially provided', 0, '', 'F', ''),
('DEM', 'country_code', '2Contacts', 'Country', 55, 26, 1, 0, 0, 'country', 1, 1, '', '', 'Country', 0, '', 'F', ''),
('DEM', 'county', '2Contacts', 'County', 50, 26, 1, 0, 0, 'county', 1, 1, '', '', 'County', 0, '', 'F', ''),
('DEM', 'deceased_date', '2Privacy', 'Date Deceased', 60, 4, 1, 0, 20, '', 1, 1, '', 'D', 'If person is deceased then enter date of death.', 0, '', 'F', ''),
('DEM', 'deceased_reason', '2Privacy', 'Reason Deceased', 65, 2, 1, 30, 255, '', 1, 1, '', '', 'Reason for Death', 0, '', 'F', ''),
('DEM', 'DOB', '1Face Sheet', 'DOB', 25, 4, 2, 0, 10, '', 1, 1, '', 'D', 'Date of Birth', 0, '', 'F', ''),
('DEM', 'drivers_license', '1Face Sheet', 'License/ID', 60, 2, 1, 15, 63, '', 1, 1, '', '', 'Drivers License or State ID', 0, '', 'F', ''),
('DEM', 'email', '1Face Sheet', 'Contact Email', 70, 2, 1, 30, 95, '', 1, 1, '', '', 'Contact Email Address', 0, '', 'F', ''),
('DEM', 'email_direct', '2Privacy', 'Trusted Email', 3, 2, 1, 30, 95, '', 1, 1, '', '', 'Trusted Direct Email Address', 0, '', 'F', ''),
('DEM', 'em_city', '4Employer', 'City', 25, 2, 1, 15, 63, '', 1, 1, '', 'C', 'City Name', 0, '', 'F', ''),
('DEM', 'em_country', '4Employer', 'Country', 40, 26, 1, 0, 0, 'country', 1, 1, '', '', 'Country', 0, '', 'F', ''),
('DEM', 'em_name', '4Employer', 'Employer Name', 15, 2, 1, 20, 63, '', 1, 1, '', 'C', 'Employer Name', 0, '', 'F', ''),
('DEM', 'em_postal_code', '4Employer', 'Postal Code', 35, 2, 1, 6, 63, '', 1, 1, '', '', 'Postal Code', 0, '', 'F', ''),
('DEM', 'em_state', '4Employer', 'State', 30, 26, 1, 0, 0, 'state', 1, 1, '', '', 'State/Locality', 0, '', 'F', ''),
('DEM', 'em_street', '4Employer', 'Employer Address', 20, 2, 1, 25, 63, '', 1, 1, '', 'C', 'Street and Number', 0, '', 'F', ''),
('DEM', 'ethnicity', '5Social Statistics', 'Ethnicity', 10, 33, 1, 0, 0, 'ethnicity', 1, 1, '', '', 'Ethnicity', 0, 'ethrace', 'F', ''),
('DEM', 'facility', '1Face Sheet', 'Facility', 32, 35, 1, 0, 0, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'family_size', '5Social Statistics', 'Family Size', 15, 2, 1, 20, 63, '', 1, 1, '', '', 'Family Size', 0, '', 'F', ''),
('DEM', 'financial_review', '5Social Statistics', 'Financial Review Date', 20, 2, 1, 10, 20, '', 1, 1, '', 'D', 'Financial Review Date', 0, '', 'F', ''),
('DEM', 'fname', '1Face Sheet', 'NAME', 5, 2, 2, 10, 63, '', 1, 1, '', 'CD', 'First Name', 0, '', 'F', ''),
('DEM', 'guardiansname', '2Contacts', 'Name of Guardian', 45, 2, 1, 20, 63, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'hipaa_allowemail', '2Privacy', 'Allow Email', 30, 1, 1, 0, 0, 'yesno', 1, 1, '', '', 'Allow Email?', 0, '', 'F', ''),
('DEM', 'hipaa_allowsms', '2Privacy', 'Allow SMS', 25, 1, 1, 0, 0, 'yesno', 1, 1, '', '', 'Allow SMS (text messages)?', 0, '', 'F', ''),
('DEM', 'hipaa_mail', '2Privacy', 'Allow Mail Message', 20, 1, 1, 0, 0, 'yesno', 1, 1, '', '', 'Allow email messages?', 0, '', 'F', ''),
('DEM', 'hipaa_message', '2Privacy', 'Leave Message With', 15, 2, 1, 20, 63, '', 1, 1, '', '', 'With whom may we leave a message?', 0, '', 'F', ''),
('DEM', 'hipaa_notice', '2Privacy', 'Privacy Notice Received', 5, 1, 1, 0, 0, 'yesno', 1, 1, '', '', 'Did you receive a copy of the HIPAA Notice?', 0, '', 'F', ''),
('DEM', 'hipaa_voice', '2Privacy', 'Allow Voice Message', 10, 1, 1, 0, 0, 'yesno', 1, 1, '', '', 'Allow telephone messages?', 0, '', 'F', ''),
('DEM', 'homeless', '5Social Statistics', 'Homeless', 30, 2, 1, 20, 63, '', 1, 1, '', '', 'Homeless or similar?', 0, '', 'F', ''),
('DEM', 'industry', '4Employer', 'Industry', 5, 26, 1, 0, 0, 'Industry', 1, 1, '', '', 'Industry', 0, '', 'F', ''),
('DEM', 'interpretter', '5Social Statistics', 'Interpreter', 7, 2, 1, 20, 63, '', 1, 1, '', '', 'Interpreter needed?', 0, '', 'F', ''),
('DEM', 'language', '5Social Statistics', 'Language', 5, 1, 1, 0, 0, 'language', 1, 3, '', '', 'Preferred Language', 0, '', 'F', ''),
('DEM', 'lname', '1Face Sheet', '', 15, 2, 2, 10, 63, '', 0, 0, '', 'CD', 'Last Name', 0, '', 'F', ''),
('DEM', 'migrantseasonal', '5Social Statistics', 'Migrant/Seasonal', 35, 2, 1, 20, 63, '', 1, 1, '', '', 'Migrant or seasonal worker?', 0, '', 'F', ''),
('DEM', 'mname', '1Face Sheet', '', 10, 2, 1, 2, 63, '', 0, 0, '', 'C', 'Middle Name', 0, '', 'F', ''),
('DEM', 'monthly_income', '5Social Statistics', 'Monthly Income', 25, 2, 1, 20, 63, '', 1, 1, '', '', 'Monthly Income', 0, '', 'F', ''),
('DEM', 'mothersname', '2Contacts', 'Name of Mother', 40, 2, 1, 20, 63, '', 1, 1, '', '', '', 0, '', 'F', ''),
('DEM', 'nickname', '1Face Sheet', 'Nick Name', 16, 2, 1, 10, 63, '', 1, 1, '', 'CD', 'Nick Name', 0, '', 'F', ''),
('DEM', 'occupation', '4Employer', 'Occupation', 10, 26, 1, 0, 0, 'Occupation', 1, 1, '', '', 'Occupation', 0, '', 'F', ''),
('DEM', 'pharmacy_id', '2Contacts', 'Pharmacy', 15, 12, 1, 0, 0, '', 1, 3, '', '', 'Preferred Pharmacy', 0, '', 'F', ''),
('DEM', 'phone_biz', '2Contacts', 'Work Phone', 25, 2, 1, 20, 63, '', 1, 1, '', 'P', 'Work Phone Number', 0, '', 'F', ''),
('DEM', 'phone_cell', '1Face Sheet', 'Mobile Phone', 65, 2, 1, 20, 63, '', 1, 1, '', 'P', 'Cell Phone Number', 0, '', 'F', ''),
('DEM', 'phone_contact', '2Contacts', 'Emergency Phone', 35, 2, 1, 20, 63, '', 1, 1, '', 'P', 'Emergency Contact Phone Number', 0, '', 'F', ''),
('DEM', 'phone_home', '2Contacts', 'Home Phone', 20, 2, 1, 20, 63, '', 1, 1, '', 'P', 'Home Phone Number', 0, '', 'F', ''),
('DEM', 'postal_code', '1Face Sheet', 'Postal Code', 50, 2, 1, 6, 63, '', 1, 1, '', '', 'Postal Code', 0, '', 'F', ''),
('DEM', 'pricelevel', '1Face Sheet', 'Price Level', 75, 1, 0, 0, 0, 'pricelevel', 1, 1, '', '', 'Discount Level', 0, '', 'F', ''),
('DEM', 'providerID', '2Contacts', 'Provider', 5, 11, 1, 0, 0, '', 1, 3, '', '', 'Provider', 0, '', 'F', ''),
('DEM', 'referral_source', '2Contacts', 'Referral Source', 60, 26, 1, 0, 0, 'refsource', 1, 1, '', '', 'How did they hear about us', 0, '', 'F', NULL),
('DEM', 'referrer', '2Contacts', 'Referrer', 65, 11, 1, 0, 0, '', 1, 3, '', '', 'Person who Referred This Patient', 0, '', 'F', ''),
('DEM', 'ref_providerID', '2Contacts', 'Referring Provider', 10, 11, 1, 0, 0, '', 1, 3, '', '', 'Referring Provider', 0, '', 'F', ''),
('DEM', 'religion', '5Social Statistics', 'Religion', 45, 1, 1, 0, 0, 'religious_affiliation', 1, 3, '', '', 'Patient Religion', 0, '', 'F', NULL),
('DEM', 'sex', '1Face Sheet', 'Sex', 20, 1, 2, 0, 0, 'sex', 1, 1, '', 'N', 'Sex', 0, '', 'F', ''),
('DEM', 'ss', '1Face Sheet', 'S.S.N.', 55, 2, 1, 11, 11, '', 1, 1, '', '', 'Social Security Number (No dashes for best searching!)', 0, '', 'F', ''),
('DEM', 'state', '1Face Sheet', 'State', 45, 26, 1, 0, 0, 'state', 1, 1, '', '', 'State/Locality', 0, '', 'F', ''),
('DEM', 'statement_y_n', '2Privacy', 'Print Statement', 70, 1, 1, 5, 0, 'yesno', 1, 3, '', '', 'Do Not Print a Patient Statement If NO', 0, '', 'F', ''),
('DEM', 'status', '1Face Sheet', 'Marital Status', 30, 1, 1, 0, 0, 'marital', 1, 3, '', '', 'Marital Status', 0, '', 'F', ''),
('DEM', 'street', '1Face Sheet', 'Address', 35, 2, 1, 25, 63, '', 1, 1, '', 'C', 'Street and Number', 0, '', 'F', ''),
('DEM', 'vfc', '2Privacy', 'VFC', 55, 1, 1, 20, 0, 'eligibility', 1, 1, '', '', 'Eligibility status for Vaccine for Children supplied vaccine', 0, '', 'F', NULL),
('FACUSR', 'provider_id', '1General', 'Provider ID', 1, 2, 1, 15, 63, '', 1, 1, '', '', 'Provider ID at Specified Facility', 0, '', 'F', NULL),
('HIS', 'additional_history', '5Other', 'Additional History', 5, 3, 1, 30, 0, '', 1, 3, '', '', 'Additional history notes', 3, '', 'F', NULL),
('HIS', 'alcohol', '4Lifestyle', 'Alcohol', 3, 28, 1, 20, 0, '', 1, 3, '', '', 'Alcohol consumption', 0, '', 'F', NULL),
('HIS', 'coffee', '4Lifestyle', 'Coffee', 2, 28, 1, 20, 0, '', 1, 3, '', '', 'Caffeine consumption', 0, '', 'F', NULL),
('HIS', 'counseling', '4Lifestyle', 'Counseling', 5, 28, 1, 20, 0, '', 1, 3, '', '', 'Counseling activities', 0, '', 'F', NULL),
('HIS', 'dc_father', '2Family History', 'Diagnosis Code', 2, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'dc_mother', '2Family History', 'Diagnosis Code', 4, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'dc_offspring', '2Family History', 'Diagnosis Code', 10, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'dc_siblings', '2Family History', 'Diagnosis Code', 6, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'dc_spouse', '2Family History', 'Diagnosis Code', 8, 15, 1, 0, 255, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'exams', '1General', 'Exams/Tests', 2, 23, 1, 0, 0, 'exams', 1, 1, '', '', 'Exam and test results', 0, '', 'F', NULL),
('HIS', 'exercise_patterns', '4Lifestyle', 'Exercise Patterns', 6, 28, 1, 20, 0, '', 1, 3, '', '', 'Exercise patterns', 0, '', 'F', NULL),
('HIS', 'hazardous_activities', '4Lifestyle', 'Hazardous Activities', 7, 28, 1, 20, 0, '', 1, 3, '', '', 'Hazardous activities', 0, '', 'F', NULL),
('HIS', 'history_father', '2Family History', 'Father', 1, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'history_mother', '2Family History', 'Mother', 3, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'history_offspring', '2Family History', 'Offspring', 9, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'history_siblings', '2Family History', 'Siblings', 5, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'history_spouse', '2Family History', 'Spouse', 7, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'name_1', '5Other', 'Name/Value', 1, 2, 1, 10, 255, '', 1, 1, '', '', 'Name 1', 0, '', 'F', NULL),
('HIS', 'name_2', '5Other', 'Name/Value', 3, 2, 1, 10, 255, '', 1, 1, '', '', 'Name 2', 0, '', 'F', NULL),
('HIS', 'recreational_drugs', '4Lifestyle', 'Recreational Drugs', 4, 28, 1, 20, 0, '', 1, 3, '', '', 'Recreational drug use', 0, '', 'F', NULL),
('HIS', 'relatives_cancer', '3Relatives', 'Cancer', 1, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_diabetes', '3Relatives', 'Diabetes', 3, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_epilepsy', '3Relatives', 'Epilepsy', 7, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_heart_problems', '3Relatives', 'Heart Problems', 5, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_high_blood_pressure', '3Relatives', 'High Blood Pressure', 4, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_mental_illness', '3Relatives', 'Mental Illness', 8, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_stroke', '3Relatives', 'Stroke', 6, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_suicide', '3Relatives', 'Suicide', 9, 2, 1, 20, 0, '', 1, 3, '', '', '', 0, '', 'F', NULL),
('HIS', 'relatives_tuberculosis', '3Relatives', 'Tuberculosis', 2, 2, 1, 20, 0, '', 1, 1, '', '', '', 0, '', 'F', NULL),
('HIS', 'risk_factors', '1General', 'Risk Factors', 1, 21, 1, 0, 0, 'riskfactors', 1, 1, '', '', 'Risk Factors', 0, '', 'F', NULL),
('HIS', 'seatbelt_use', '4Lifestyle', 'Seatbelt Use', 9, 2, 1, 20, 0, '', 1, 3, '', '', 'Seatbelt use', 0, '', 'F', NULL),
('HIS', 'sleep_patterns', '4Lifestyle', 'Sleep Patterns', 8, 2, 1, 20, 0, '', 1, 3, '', '', 'Sleep patterns', 0, '', 'F', NULL),
('HIS', 'tobacco', '4Lifestyle', 'Tobacco', 1, 32, 1, 0, 0, 'smoking_status', 1, 3, '', '', 'Tobacco use', 0, '', 'F', NULL),
('HIS', 'userarea11', '5Other', 'User Defined Area 11', 6, 3, 0, 30, 0, '', 1, 3, '', '', 'User Defined', 3, '', 'F', NULL),
('HIS', 'userarea12', '5Other', 'User Defined Area 12', 7, 3, 0, 30, 0, '', 1, 3, '', '', 'User Defined', 3, '', 'F', NULL),
('HIS', 'value_1', '5Other', '', 2, 2, 1, 10, 255, '', 0, 0, '', '', 'Value 1', 0, '', 'F', NULL),
('HIS', 'value_2', '5Other', '', 4, 2, 1, 10, 255, '', 0, 0, '', '', 'Value 2', 0, '', 'F', NULL),
('LBTbill', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', NULL),
('LBTlegal', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', NULL),
('LBTphreq', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', NULL),
('LBTptreq', 'body', '1', 'Details', 10, 3, 2, 30, 0, '', 1, 3, '', '', 'Content', 5, '', 'F', NULL),
('LBTref', 'body', '1Referral', 'Reason', 5, 3, 2, 30, 0, '', 1, 1, '', '', 'Reason for referral', 3, '', 'F', NULL),
('LBTref', 'refer_date', '1Referral', 'Referral Date', 1, 4, 2, 0, 0, '', 1, 1, 'C', 'D', 'Date of referral', 0, '', 'F', NULL),
('LBTref', 'refer_diag', '1Referral', 'Referrer Diagnosis', 6, 2, 1, 30, 255, '', 1, 1, '', 'X', 'Referrer diagnosis', 0, '', 'F', NULL),
('LBTref', 'refer_external', '1Referral', 'External Referral', 3, 1, 1, 0, 0, 'boolean', 1, 1, '', '', 'External referral?', 0, '', 'F', NULL),
('LBTref', 'refer_from', '1Referral', 'Refer By', 2, 10, 2, 0, 0, '', 1, 1, '', '', 'Referral By', 0, '', 'F', NULL),
('LBTref', 'refer_related_code', '1Referral', 'Requested Service', 9, 15, 1, 30, 255, '', 1, 1, '', '', 'Billing Code for Requested Service', 0, '', 'F', NULL),
('LBTref', 'refer_risk_level', '1Referral', 'Risk Level', 7, 1, 1, 0, 0, 'risklevel', 1, 1, '', '', 'Level of urgency', 0, '', 'F', NULL),
('LBTref', 'refer_to', '1Referral', 'Refer To', 4, 14, 2, 0, 0, '', 1, 1, '', '', 'Referral To', 0, '', 'F', NULL),
('LBTref', 'refer_vitals', '1Referral', 'Include Vitals', 8, 1, 1, 0, 0, 'boolean', 1, 1, '', '', 'Include vitals data?', 0, '', 'F', NULL),
('LBTref', 'reply_date', '2Counter-Referral', 'Reply Date', 10, 4, 1, 0, 0, '', 1, 1, '', 'D', 'Date of reply', 0, '', 'F', NULL),
('LBTref', 'reply_documents', '2Counter-Referral', 'Documents', 14, 2, 1, 30, 255, '', 1, 1, '', '', 'Where may related scanned or paper documents be found?', 0, '', 'F', NULL),
('LBTref', 'reply_final_diag', '2Counter-Referral', 'Final Diagnosis', 13, 2, 1, 30, 255, '', 1, 1, '', '', 'Final diagnosis by specialist', 0, '', 'F', NULL),
('LBTref', 'reply_findings', '2Counter-Referral', 'Findings', 15, 3, 1, 30, 0, '', 1, 1, '', '', 'Findings by specialist', 3, '', 'F', NULL),
('LBTref', 'reply_from', '2Counter-Referral', 'Reply From', 11, 2, 1, 30, 255, '', 1, 1, '', '', 'Who replied?', 0, '', 'F', NULL),
('LBTref', 'reply_init_diag', '2Counter-Referral', 'Presumed Diagnosis', 12, 2, 1, 30, 255, '', 1, 1, '', '', 'Presumed diagnosis by specialist', 0, '', 'F', NULL),
('LBTref', 'reply_recommend', '2Counter-Referral', 'Recommendations', 17, 3, 1, 30, 0, '', 1, 1, '', '', 'Recommendations by specialist', 3, '', 'F', NULL),
('LBTref', 'reply_rx_refer', '2Counter-Referral', 'Prescriptions/Referrals', 18, 3, 1, 30, 0, '', 1, 1, '', '', 'Prescriptions and/or referrals by specialist', 3, '', 'F', NULL),
('LBTref', 'reply_services', '2Counter-Referral', 'Services Provided', 16, 3, 1, 30, 0, '', 1, 1, '', '', 'Service provided by specialist', 3, '', 'F', NULL);

CREATE TABLE `lbf_data` (
  `form_id` int(11) NOT NULL COMMENT 'references forms.form_id',
  `field_id` varchar(31) NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contains all data from layout-based forms';

CREATE TABLE `lbt_data` (
  `form_id` bigint(20) NOT NULL COMMENT 'references transactions.id',
  `field_id` varchar(31) NOT NULL COMMENT 'references layout_options.field_id',
  `field_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='contains all data from layout-based transactions';

CREATE TABLE `libreehr_postcalendar_categories` (
  `pc_catid` int(11) UNSIGNED NOT NULL,
  `pc_catname` varchar(100) DEFAULT NULL,
  `pc_catcolor` varchar(50) DEFAULT NULL,
  `pc_catdesc` text,
  `pc_recurrtype` int(1) NOT NULL DEFAULT '0',
  `pc_enddate` date DEFAULT NULL,
  `pc_recurrspec` text,
  `pc_recurrfreq` int(3) NOT NULL DEFAULT '0',
  `pc_duration` bigint(20) NOT NULL DEFAULT '0',
  `pc_end_date_flag` tinyint(1) NOT NULL DEFAULT '0',
  `pc_end_date_type` int(2) DEFAULT NULL,
  `pc_end_date_freq` int(11) NOT NULL DEFAULT '0',
  `pc_end_all_day` tinyint(1) NOT NULL DEFAULT '0',
  `pc_dailylimit` int(2) NOT NULL DEFAULT '0',
  `pc_cattype` int(11) NOT NULL COMMENT 'Used in grouping categories',
  `pc_active` tinyint(1) NOT NULL DEFAULT '1',
  `pc_seq` int(11) NOT NULL DEFAULT '0',
  `pc_categories_icon` text NOT NULL,
  `pc_icon_color` varchar(15) DEFAULT NULL,
  `pc_icon_bg_color` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `libreehr_postcalendar_categories` (`pc_catid`, `pc_catname`, `pc_catcolor`, `pc_catdesc`, `pc_recurrtype`, `pc_enddate`, `pc_recurrspec`, `pc_recurrfreq`, `pc_duration`, `pc_end_date_flag`, `pc_end_date_type`, `pc_end_date_freq`, `pc_end_all_day`, `pc_dailylimit`, `pc_cattype`, `pc_active`, `pc_seq`, `pc_categories_icon`, `pc_icon_color`, `pc_icon_bg_color`) VALUES
(1, 'No Show', '#DDDDDD', 'Reserved to define when an event did not occur as specified.', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '', NULL, NULL),
(2, 'In Office', '#99CCFF', 'Reserved todefine when a provider may haveavailable appointments after.', 1, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 0, 1, 3, 2, 0, 0, 1, 1, 2, '', NULL, NULL),
(3, 'Out Of Office', '#99FFFF', 'Reserved to define when a provider may not have available appointments after.', 1, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 0, 1, 3, 2, 0, 0, 1, 1, 3, '', NULL, NULL),
(4, 'Vacation', '#EFEFEF', 'Reserved for use to define Scheduled Vacation Time', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 0, 0, 0, 0, 1, 0, 1, 1, 4, '', NULL, NULL),
(5, 'Office Visit', '#FFFFCC', 'Normal Office Visit', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 0, 0, 0, 0, 0, 1, 5, '', NULL, NULL),
(6, 'Holidays', '#9676DB', 'Clinic holiday', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 86400, 1, 3, 2, 0, 0, 2, 1, 6, '', NULL, NULL),
(7, 'Closed', '#2374AB', 'Clinic closed', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 86400, 1, 3, 2, 0, 0, 2, 1, 7, '', NULL, NULL),
(8, 'Lunch', '#FFFF33', 'Lunch', 1, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 3600, 0, 3, 2, 0, 0, 1, 1, 8, '', NULL, NULL),
(9, 'Established Patient', '#CCFF33', '', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 0, 0, 0, 0, 0, 1, 9, '', NULL, NULL),
(10, 'New Patient', '#CCFFFF', '', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 1800, 0, 0, 0, 0, 0, 0, 1, 10, '', NULL, NULL),
(11, 'Reserved', '#FF7777', 'Reserved', 1, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"1\";s:22:\"event_repeat_freq_type\";s:1:\"4\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 3, 2, 0, 0, 1, 1, 11, '', NULL, NULL),
(12, 'Health and Behavioral Assessment', '#C7C7C7', 'Health and Behavioral Assessment', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 0, 0, 0, 0, 0, 1, 12, '', NULL, NULL),
(13, 'Preventive Care Services', '#CCCCFF', 'Preventive Care Services', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 0, 0, 0, 0, 0, 1, 13, '', NULL, NULL),
(14, 'Ophthalmological Services', '#F89219', 'Ophthalmological Services', 0, NULL, 'a:5:{s:17:\"event_repeat_freq\";s:1:\"0\";s:22:\"event_repeat_freq_type\";s:1:\"0\";s:19:\"event_repeat_on_num\";s:1:\"1\";s:19:\"event_repeat_on_day\";s:1:\"0\";s:20:\"event_repeat_on_freq\";s:1:\"0\";}', 0, 900, 0, 0, 0, 0, 0, 0, 1, 14, '', NULL, NULL);

CREATE TABLE `libreehr_postcalendar_events` (
  `pc_eid` int(11) UNSIGNED NOT NULL,
  `pc_catid` int(11) NOT NULL DEFAULT '0',
  `pc_multiple` int(10) UNSIGNED NOT NULL,
  `pc_aid` varchar(30) DEFAULT NULL,
  `pc_pid` varchar(11) DEFAULT NULL,
  `pc_title` varchar(150) DEFAULT NULL,
  `pc_time` datetime DEFAULT NULL,
  `pc_hometext` text,
  `pc_comments` int(11) DEFAULT '0',
  `pc_counter` mediumint(8) UNSIGNED DEFAULT '0',
  `pc_topic` int(3) NOT NULL DEFAULT '1',
  `pc_informant` varchar(20) DEFAULT NULL,
  `pc_eventDate` date NOT NULL DEFAULT '0000-00-00',
  `pc_endDate` date NOT NULL DEFAULT '0000-00-00',
  `pc_duration` bigint(20) NOT NULL DEFAULT '0',
  `pc_recurrtype` int(1) NOT NULL DEFAULT '0',
  `pc_recurrspec` text,
  `pc_recurrfreq` int(3) NOT NULL DEFAULT '0',
  `pc_startTime` time DEFAULT NULL,
  `pc_endTime` time DEFAULT NULL,
  `pc_alldayevent` int(1) NOT NULL DEFAULT '0',
  `pc_location` text,
  `pc_conttel` varchar(50) DEFAULT NULL,
  `pc_contname` varchar(50) DEFAULT NULL,
  `pc_contemail` varchar(255) DEFAULT NULL,
  `pc_website` varchar(255) DEFAULT NULL,
  `pc_fee` varchar(50) DEFAULT NULL,
  `pc_eventstatus` int(11) NOT NULL DEFAULT '0',
  `pc_sharing` int(11) NOT NULL DEFAULT '0',
  `pc_language` varchar(30) DEFAULT NULL,
  `pc_apptstatus` varchar(15) NOT NULL DEFAULT '-',
  `pc_prefcatid` int(11) NOT NULL DEFAULT '0',
  `pc_facility` smallint(6) NOT NULL DEFAULT '0' COMMENT 'facility id for this event',
  `pc_sendalertsms` varchar(3) NOT NULL DEFAULT 'NO',
  `pc_sendalertemail` varchar(3) NOT NULL DEFAULT 'NO',
  `pc_billing_location` smallint(6) NOT NULL DEFAULT '0',
  `pc_room` varchar(20) NOT NULL DEFAULT '',
  `cancel_reason` text,
  `case_number` varchar(50) DEFAULT NULL,
  `case_body_part` varchar(50) DEFAULT NULL,
  `prior_auth` varchar(50) DEFAULT NULL,
  `prior_auth_2` varchar(50) DEFAULT NULL,
  `bodypart` varchar(120) NOT NULL,
  `bodypart_2` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `libreehr_session_info` (
  `pn_sessid` varchar(32) NOT NULL DEFAULT '',
  `pn_ipaddr` varchar(20) DEFAULT NULL,
  `pn_firstused` int(11) NOT NULL DEFAULT '0',
  `pn_lastused` int(11) NOT NULL DEFAULT '0',
  `pn_uid` int(11) NOT NULL DEFAULT '0',
  `pn_vars` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lims_analysisrequests` (
  `id` int(11) NOT NULL,
  `procedure_order_id` int(11) NOT NULL COMMENT 'references procedure_order.procedure_order_id ',
  `analysisrequest_id` varchar(80) NOT NULL COMMENT 'refers to analysis request id in the lims',
  `status` text NOT NULL COMMENT 'received, processing, complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lists` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `subtype` varchar(31) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `begdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `returndate` date DEFAULT NULL,
  `occurrence` int(11) DEFAULT '0',
  `classification` int(11) DEFAULT '0',
  `referredby` varchar(255) DEFAULT NULL,
  `extrainfo` varchar(255) DEFAULT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `comments` longtext,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `outcome` int(11) NOT NULL DEFAULT '0',
  `destination` varchar(255) DEFAULT NULL,
  `reinjury_id` bigint(20) NOT NULL DEFAULT '0',
  `injury_part` varchar(31) NOT NULL DEFAULT '',
  `injury_type` varchar(31) NOT NULL DEFAULT '',
  `injury_grade` varchar(31) NOT NULL DEFAULT '',
  `reaction` varchar(255) NOT NULL DEFAULT '',
  `external_allergyid` int(11) DEFAULT NULL,
  `erx_source` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-LibreEHR 1-External',
  `erx_uploaded` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0-Pending NewCrop upload 1-Uploaded TO NewCrop',
  `modifydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `severity_al` varchar(50) DEFAULT NULL,
  `external_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `lists_touch` (
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `list_options` (
  `list_id` varchar(50) NOT NULL DEFAULT '',
  `option_id` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `seq` int(11) NOT NULL DEFAULT '0',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `option_value` float NOT NULL DEFAULT '0',
  `mapping` varchar(31) NOT NULL DEFAULT '',
  `notes` text,
  `codes` varchar(255) NOT NULL DEFAULT '',
  `toggle_setting_1` tinyint(1) NOT NULL DEFAULT '0',
  `toggle_setting_2` tinyint(1) NOT NULL DEFAULT '0',
  `activity` tinyint(4) NOT NULL DEFAULT '1',
  `subtype` varchar(31) NOT NULL DEFAULT '',
  `list_options_icon` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`, `subtype`, `list_options_icon`) VALUES
('abook_type', 'ccda', 'Care Coordination', 35, 0, 2, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'dist', 'Distributor', 30, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'emr_direct', 'EMR Direct', 105, 0, 4, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'external_org', 'External Organization', 120, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'external_provider', 'External Provider', 110, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'ord_img', 'Imaging Service', 5, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'ord_imm', 'Immunization Service', 10, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'ord_lab', 'Lab Service', 15, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'oth', 'Other', 95, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'spe', 'Specialist', 20, 0, 2, '', NULL, '', 0, 0, 1, '', ''),
('abook_type', 'vendor', 'Vendor', 25, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Adm adjust', 'Adm adjust', 5, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'After hrs calls', 'After hrs calls', 10, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Bad check', 'Bad check', 15, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Bad debt', 'Bad debt', 20, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Coll w/o', 'Coll w/o', 25, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Discount', 'Discount', 30, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Hardship w/o', 'Hardship w/o', 35, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Ins adjust', 'Ins adjust', 40, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Ins bundling', 'Ins bundling', 45, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Ins overpaid', 'Ins overpaid', 50, 0, 5, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Ins refund', 'Ins refund', 55, 0, 5, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Pt overpaid', 'Pt overpaid', 60, 0, 5, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Pt refund', 'Pt refund', 65, 0, 5, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Pt released', 'Pt released', 70, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Sm debt w/o', 'Sm debt w/o', 75, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'To copay', 'To copay', 80, 0, 2, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'To ded\'ble', 'To ded\'ble', 85, 0, 3, '', NULL, '', 0, 0, 1, '', ''),
('adjreason', 'Untimely filing', 'Untimely filing', 90, 0, 1, '', NULL, '', 0, 0, 1, '', ''),
('allergy_issue_list', 'codeine', 'codeine', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('allergy_issue_list', 'iodine', 'iodine', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('allergy_issue_list', 'penicillin', 'penicillin', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('allergy_issue_list', 'sulfa', 'sulfa', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('amendment_from', 'insurance', 'Insurance', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('amendment_from', 'patient', 'Patient', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('amendment_status', 'approved', 'Approved', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('amendment_status', 'rejected', 'Rejected', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('apptstat', '!', '! Left w/o visit', 40, 0, 0, '', '0BBA34|0', '', 0, 1, 1, '', ''),
('apptstat', '#', '# Ins/fin issue', 45, 0, 0, '', 'FFFF2B|0', '', 0, 0, 1, '', ''),
('apptstat', '$', '$ Coding done', 60, 0, 0, '', 'C0FF96|0', '', 0, 0, 1, '', ''),
('apptstat', '%', '% Canceled < 24h', 65, 0, 0, '', 'BFBFBF|0', '', 0, 0, 1, '', ''),
('apptstat', '&', '& Rescheduled < 24h', 80, 0, 0, '', 'BFBFBF|0', '', 0, 0, 1, '', ''),
('apptstat', '*', '* Reminder done', 10, 0, 0, '', 'FFC9F8|0', '', 0, 0, 1, '', ''),
('apptstat', '+', '+ Chart pulled', 15, 0, 0, '', '87FF1F|0', '', 0, 0, 1, '', ''),
('apptstat', '-', '- None', 5, 0, 0, '', 'FEFDCF|0', '', 0, 0, 1, '', ''),
('apptstat', '<', '< In exam room', 50, 0, 0, '', '52D9DE|10', '', 0, 0, 1, '', ''),
('apptstat', '=', '= Rescheduled', 75, 0, 0, '', 'BFBFBF|0', '', 0, 0, 1, '', ''),
('apptstat', '>', '> Checked out', 55, 0, 0, '', 'FEFDCF|0', '', 0, 1, 1, '', ''),
('apptstat', '?', '? No show', 25, 0, 0, '', 'BFBFBF|0', '', 0, 0, 1, '', ''),
('apptstat', '@', '@ Arrived', 30, 0, 0, '', 'FF2414|10', '', 1, 0, 1, '', ''),
('apptstat', 'Deleted', 'Deleted', 85, 0, 0, '', '0F0F0F|0', '', 0, 0, 1, '', ''),
('apptstat', 'x', 'x Canceled', 20, 0, 0, '', 'BFBFBF|0', '', 0, 0, 1, '', ''),
('apptstat', '^', '^ Pending from Portal', 70, 0, 0, '', 'ADBBFF|0', '', 0, 0, 1, '', ''),
('apptstat', '~', '~ Arrived late', 35, 0, 0, '', 'FF6619|10', '', 1, 0, 1, '', ''),
('boolean', '0', 'No', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('boolean', '1', 'Yes', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('cancellation_reasons', '1', 'No reason given', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('cancellation_reasons', '2', 'Work', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('cancellation_reasons', '3', 'Sick', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('cancellation_reasons', '4', 'Weather', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('chartloc', 'fileroom', 'File Room', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'back_pain_plan_cqm', 'Back Pain', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'cabg_plan_cqm', 'Coronary Artery Bypass Graft (CABG)', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'ckd_plan_cqm', 'Chronic Kidney Disease (CKD)', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'dm_plan', 'Diabetes Mellitus', 500, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'dm_plan_cqm', 'Diabetes Mellitus', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'periop_plan_cqm', 'Perioperative Care', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'prevent_plan', 'Preventative Care', 510, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'prevent_plan_cqm', 'Preventative Care', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_plans', 'rheum_arth_plan_cqm', 'Rheumatoid Arthritis', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'cpoe_med_amc', 'Use CPOE for medication orders directly entered by any licensed healthcare professional who can enter orders into the medical record per state, local and professional guidelines.', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'cpoe_med_stage2_amc', 'Use CPOE for medication orders.(Alternative)', 47, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'cpoe_proc_orders_amc', 'Use CPOE for procedure orders.', 47, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'cpoe_radiology_amc', 'Use CPOE for radiology orders.', 46, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'electronic_notes_amc', 'Electronic Notes', 3200, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'e_prescribe_1_stage2_amc', 'Generate and transmit permissible prescriptions electronically (All Prescriptions).', 50, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'e_prescribe_2_stage2_amc', 'Generate and transmit permissible prescriptions electronically (Not including controlled substances).', 50, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'e_prescribe_amc', 'Generate and transmit permissible prescriptions electronically.', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'e_prescribe_stage1_amc', 'Generate and transmit permissible prescriptions electronically (Not including controlled substances).', 50, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'family_health_history_amc', 'Family Health History', 3100, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'image_results_amc', 'Image Results', 3000, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'lab_result_amc', 'Incorporate clinical lab-test results into certified EHR technology as structured data.', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'med_allergy_list_amc', 'Maintain active medication allergy list.', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'med_list_amc', 'Maintain active medication list.', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'med_reconc_amc', 'The EP, eligible hospital or CAH who receives a patient from another setting of care or provider of care or believes an encounter is relevant should perform medication reconciliation.', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'patient_edu_amc', 'Use certified EHR technology to identify patient-specific education resources and provide those resources to the patient if appropriate.', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'patient_edu_stage2_amc', 'Use certified EHR technology to identify patient-specific education resources and provide those resources to the patient if appropriate(New).', 40, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'problem_list_amc', 'Maintain an up-to-date problem list of current and active diagnoses.', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'provide_rec_pat_amc', 'Provide patients with an electronic copy of their health information (including diagnostic test results, problem list, medication lists, medication allergies), upon request.', 65, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'provide_sum_pat_amc', 'Provide clinical summaries for patients for each office visit.', 75, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'provide_sum_pat_stage2_amc', 'Provide clinical summaries for patients for each office visit (New).', 75, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'record_dem_amc', 'Record demographics.', 55, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'record_smoke_amc', 'Record smoking status for patients 13 years old or older.', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_1_stage1_amc', 'Record and chart changes in vital signs (SET 1).', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_2_stage1_amc', 'Record and chart changes in vital signs (BP out of scope).', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_3_stage1_amc', 'Record and chart changes in vital signs (Height / Weight out of scope).', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_4_stage1_amc', 'Record and chart changes in vital signs ( Height / Weight / BP with in scope ).', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_amc', 'Record and chart changes in vital signs.', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'record_vitals_stage2_amc', 'Record and chart changes in vital signs (New).', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_adult_wt_screen_fu', 'Adult Weight Screening and Follow-Up', 530, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_adult_wt_screen_fu_cqm', 'Adult Weight Screening and Follow-Up (CQM)', 220, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_appt_reminder', 'Appointment Reminder Rule', 2000, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_blood_pressure', 'Measure Blood Pressure', 1610, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_children_pharyngitis_cqm', 'Appropriate Testing for Children with Pharyngitis (CQM)', 502, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_child_immun_stat_2014_cqm', 'Childhood immunization Status (CQM)', 250, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_child_immun_stat_cqm', 'Childhood immunization Status (CQM)', 250, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_cs_colon', 'Cancer Screening: Colon Cancer Screening', 640, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_cs_mammo', 'Cancer Screening: Mammogram', 620, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_cs_pap', 'Cancer Screening: Pap Smear', 630, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_cs_prostate', 'Cancer Screening: Prostate Cancer Screening', 650, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_a1c_cqm', 'Diabetes: HbA1c Poor Control (CQM)', 285, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_bp_control_cqm', 'Diabetes: Blood Pressure Management (CQM)', 290, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_eye', 'Diabetes: Eye Exam', 600, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_eye_cqm', 'Diabetes: Eye Exam (CQM)', 270, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_foot', 'Diabetes: Foot Exam', 610, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_foot_cqm', 'Diabetes: Foot Exam (CQM)', 280, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_hemo_a1c', 'Diabetes: Hemoglobin A1C', 570, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_ldl_cqm', 'Diabetes: LDL Management & Control (CQM)', 300, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_dm_urine_alb', 'Diabetes: Urine Microalbumin', 590, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_fall_screening_cqm', 'Falls: Screening, Risk-Assessment, and Plan of Care to Prevent Future Falls (CQM)', 504, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_htn_bp_measure', 'Hypertension: Blood Pressure Measurement', 500, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_htn_bp_measure_cqm', 'Hypertension: Blood Pressure Measurement (CQM)', 200, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_influenza_ge_50', 'Influenza Immunization for Patients >= 50 Years Old', 550, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_influenza_ge_50_cqm', 'Influenza Immunization for Patients >= 50 Years Old (CQM)', 240, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_inr_measure', 'Measure INR', 1620, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_inr_monitor', 'Coumadin Management - INR Monitoring', 1000, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_pain_intensity_cqm', 'Oncology: Medical and Radiation – Pain Intensity Quantified (CQM)', 506, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_penicillin_allergy', 'Assess Penicillin Allergy', 1600, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_pneumovacc_ge_65', 'Pneumonia Vaccination Status for Older Adults', 570, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_pneumovacc_ge_65_cqm', 'Pneumonia Vaccination Status for Older Adults (CQM)', 260, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_socsec_entry', 'Data Entry - Social Security Number', 1500, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_tob_cess_inter', 'Tobacco Cessation Intervention', 520, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_tob_cess_inter_cqm', 'Tobacco Cessation Intervention (CQM)', 210, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_tob_use_2014_cqm', 'Preventive Care and Screening: Tobacco Use: Screening and Cessation Intervention (CQM)', 210, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_tob_use_assess', 'Tobacco Use Assessment', 510, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_tob_use_assess_cqm', 'Tobacco Use Assessment (CQM)', 205, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_wt_assess_couns_child', 'Weight Assessment and Counseling for Children and Adolescents', 540, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'rule_wt_assess_couns_child_cqm', 'Weight Assessment and Counseling for Children and Adolescents (CQM)', 230, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'secure_messaging_amc', 'Secure Electronic Messaging', 3400, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'send_reminder_amc', 'Send reminders to patients per patient preference for preventive/follow up care.', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'send_reminder_stage2_amc', 'Send reminders to patients per patient preference for preventive/follow up care.', 60, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'send_sum_1_stage2_amc', 'The EP, eligible hospital or CAH who transitions their patient to another setting of care or provider of care or refers their patient to another provider of care should provide summary of care record for each transition of care or referral (Measure A).', 80, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'send_sum_amc', 'The EP, eligible hospital or CAH who transitions their patient to another setting of care or provider of care or refers their patient to another provider of care should provide summary of care record for each transition of care or referral.', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'send_sum_stage1_amc', 'The EP, eligible hospital or CAH who transitions their patient to another setting of care or provider of care or refers their patient to another provider of care should provide summary of care record for each transition of care or referral.', 80, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'send_sum_stage2_amc', 'The EP, eligible hospital or CAH who transitions their patient to another setting of care or provider of care or refers their patient to another provider of care should provide summary of care record for each transition of care or referral (Measure B).', 80, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'timely_access_amc', 'Provide patients with timely electronic access to their health information (including lab results, problem list, medication lists, medication allergies) within four business days of the information being available to the EP.', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('clinical_rules', 'vdt_stage2_amc', 'View, Download, Transmit (VDT) (Measure A)', 3500, 0, 0, '', '', '', 0, 0, 1, '', ''),
('clinical_rules', 'view_download_transmit_amc', 'View, Download, Transmit (VDT)  (Measure B)', 3500, 0, 0, '', '', '', 0, 0, 1, '', ''),
('country', 'USA', 'USA', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'all', 'All', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'custom', 'Custom', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'last_calendar_year', 'Last Calendar Year', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'last_month', 'Last Month', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'this_calendar_year', 'This Calendar Year', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'this_month_to_date', 'This Month to Date', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'this_week_to_date', 'This Week to Date', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('date_master_criteria', 'today', 'Today', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('disclosure_type', 'disclosure-healthcareoperations', 'Health Care Operations', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('disclosure_type', 'disclosure-payment', 'Payment', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('disclosure_type', 'disclosure-treatment', 'Treatment', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_form', '0', '', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_form', '1', 'suspension', 1, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C60928', 0, 0, 1, '', ''),
('drug_form', '10', 'cream', 10, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C28944', 0, 0, 1, '', ''),
('drug_form', '11', 'ointment', 11, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C42966', 0, 0, 1, '', ''),
('drug_form', '12', 'puff', 12, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C42944', 0, 0, 1, '', ''),
('drug_form', '2', 'tablet', 2, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C42998', 0, 0, 1, '', ''),
('drug_form', '3', 'capsule', 3, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C25158', 0, 0, 1, '', ''),
('drug_form', '4', 'solution', 4, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C42986', 0, 0, 1, '', ''),
('drug_form', '5', 'tsp', 5, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C48544', 0, 0, 1, '', ''),
('drug_form', '6', 'ml', 6, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C28254', 0, 0, 1, '', ''),
('drug_form', '7', 'units', 7, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C44278', 0, 0, 1, '', ''),
('drug_form', '8', 'inhalations', 8, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C42944', 0, 0, 1, '', ''),
('drug_form', '9', 'gtts(drops)', 9, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C48491', 0, 0, 1, '', ''),
('drug_interval', '0', '', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '1', 'b.i.d.', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '10', 'a.c.', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '11', 'p.c.', 11, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '12', 'a.m.', 12, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '13', 'p.m.', 13, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '14', 'ante', 14, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '15', 'h', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '16', 'h.s.', 16, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '17', 'p.r.n.', 17, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '18', 'stat', 18, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '2', 't.i.d.', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '3', 'q.i.d.', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '4', 'q.3h', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '5', 'q.4h', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '6', 'q.5h', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '7', 'q.6h', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '8', 'q.8h', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_interval', '9', 'q.d.', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_route', '0', '', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_route', '1', 'Per Oris', 1, 0, 0, '', 'PO', 'NCI-CONCEPT-ID:C38288', 0, 0, 1, '', ''),
('drug_route', '10', 'IM', 10, 0, 0, '', 'IM', '', 0, 0, 1, '', ''),
('drug_route', '11', 'IV', 11, 0, 0, '', 'IV', '', 0, 0, 1, '', ''),
('drug_route', '12', 'Per Nostril', 12, 0, 0, '', 'NS', '', 0, 0, 1, '', ''),
('drug_route', '13', 'Both Ears', 13, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '14', 'Left Ear', 14, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '15', 'Right Ear', 15, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '2', 'Per Rectum', 2, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '3', 'To Skin', 3, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '4', 'To Affected Area', 4, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '5', 'Sublingual', 5, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '6', 'OS', 6, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '7', 'OD', 7, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '8', 'OU', 8, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', '9', 'SQ', 9, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', 'inhale', 'Inhale', 16, 0, 0, '', 'RESPIR', 'NCI-CONCEPT-ID:C38216', 0, 0, 1, '', ''),
('drug_route', 'intradermal', 'Intradermal', 16, 0, 0, '', 'ID', '', 0, 0, 1, '', ''),
('drug_route', 'intramuscular', 'Intramuscular', 20, 0, 0, '', 'IM', 'NCI-CONCEPT-ID:C28161', 0, 0, 1, '', ''),
('drug_route', 'other', 'Other/Miscellaneous', 18, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('drug_route', 'transdermal', 'Transdermal', 19, 0, 0, '', 'TD', '', 0, 0, 1, '', ''),
('drug_units', '0', '', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '1', 'mg', 1, 0, 0, '', NULL, 'NCI-CONCEPT-ID:C28253', 0, 0, 1, '', ''),
('drug_units', '2', 'mg/1cc', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '3', 'mg/2cc', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '4', 'mg/3cc', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '5', 'mg/4cc', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '6', 'mg/5cc', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '7', 'mcg', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '8', 'grams', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('drug_units', '9', 'mL', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('eligibility', 'eligible', 'Eligible', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('eligibility', 'ineligible', 'Ineligible', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethnicity', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethnicity', 'hisp_or_latin', 'Hispanic or Latino', 10, 0, 0, '', '2135-2', '', 0, 0, 1, '', ''),
('ethnicity', 'not_hisp_or_latin', 'Not Hispanic or Latino', 10, 0, 0, '', '2186-5', '', 0, 0, 1, '', ''),
('ethrace', 'aleut', 'ALEUT', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'amer_indian', 'American Indian', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'Asian', 'Asian', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'Black', 'Black', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'cambodian', 'Cambodian', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'Caucasian', 'Caucasian', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'chinese', 'Chinese', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'cs_american', 'Central/South American', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'cuban', 'Cuban', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'eskimo', 'Eskimo', 100, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'filipino', 'Filipino', 110, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'guamanian', 'Guamanian', 120, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'hawaiian', 'Hawaiian', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'Hispanic', 'Hispanic', 140, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'hmong', 'Hmong', 170, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'indian', 'Indian', 180, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'japanese', 'Japanese', 190, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'korean', 'Korean', 200, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'laotian', 'Laotian', 210, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'mexican', 'Mexican/MexAmer/Chicano', 220, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'mlt-race', 'Multiracial', 230, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'othr', 'Other', 240, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'othr_non_us', 'Hispanic - Other (Born outside US)', 160, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'othr_spec', 'Other - Specified', 250, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'othr_us', 'Hispanic - Other (Born in US)', 150, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'pac_island', 'Pacific Islander', 260, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'puerto_rican', 'Puerto Rican', 270, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'refused', 'Refused To State', 280, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'samoan', 'Samoan', 290, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'spec', 'Specified', 300, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'thai', 'Thai', 310, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'unknown', 'Unknown', 320, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'unspec', 'Unspecified', 330, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'vietnamese', 'Vietnamese', 340, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'white', 'White', 350, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ethrace', 'withheld', 'Withheld', 360, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'brs', 'Breast Exam', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'cec', 'Cardiac Echo', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'ecg', 'ECG', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'flu', 'Flu Vaccination', 11, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'gyn', 'Gynecological Exam', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'hem', 'Hemoglobin', 14, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'ldl', 'LDL', 13, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'mam', 'Mammogram', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'phy', 'Physical Exam', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'pne', 'Pneumonia Vaccination', 12, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'pro', 'Prostate Exam', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'psa', 'PSA', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'rec', 'Rectal Exam', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'ret', 'Retinal Exam', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('exams', 'sic', 'Sigmoid/Colonoscopy', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Chiropractic', 'Chiropractic', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Fitness Testing', 'Fitness Testing', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Nutritional', 'Nutritional', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Osteopathy', 'Osteopathy', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Podiatry', 'Podiatry', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Pre Participation Assessment', 'Pre Participation Assessment', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Prevention Rehab', 'Prevention Rehab', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Screening / Testing', 'Screening / Testing', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('general_issue_list', 'Strength and Conditioning', 'Strength and Conditioning', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '1', 'DTaP 1', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '10', 'DT 5', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '11', 'IPV 1', 110, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '12', 'IPV 2', 115, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '13', 'IPV 3', 120, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '14', 'IPV 4', 125, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '15', 'Hib 1', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '16', 'Hib 2', 85, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '17', 'Hib 3', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '18', 'Hib 4', 95, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '19', 'Pneumococcal Conjugate 1', 140, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '2', 'DTaP 2', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '20', 'Pneumococcal Conjugate 2', 145, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '21', 'Pneumococcal Conjugate 3', 150, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '22', 'Pneumococcal Conjugate 4', 155, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '23', 'MMR 1', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '24', 'MMR 2', 135, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '25', 'Varicella 1', 165, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '26', 'Varicella 2', 170, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '27', 'Hepatitis B 1', 65, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '28', 'Hepatitis B 2', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '29', 'Hepatitis B 3', 75, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '3', 'DTaP 3', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '30', 'Influenza 1', 100, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '31', 'Influenza 2', 105, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '32', 'Td', 160, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '33', 'Hepatitis A 1', 55, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '34', 'Hepatitis A 2', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '35', 'Other', 175, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '4', 'DTaP 4', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '5', 'DTaP 5', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '6', 'DT 1', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '7', 'DT 2', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '8', 'DT 3', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('immunizations', '9', 'DT 4', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Immunization_Completion_Status', 'Completed', 'completed', 10, 0, 0, '', 'CP', '', 0, 0, 1, '', ''),
('Immunization_Completion_Status', 'Not_Administered', 'Not Administered', 30, 0, 0, '', 'NA', '', 0, 0, 1, '', ''),
('Immunization_Completion_Status', 'Partially_Administered', 'Partially Administered', 40, 0, 0, '', 'PA', '', 0, 0, 1, '', ''),
('Immunization_Completion_Status', 'Refused', 'Refused', 20, 0, 0, '', 'RE', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AB', 'Abbott Laboratories', 10, 0, 0, '', 'AB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'ACA', 'Acambis, Inc', 20, 0, 0, '', 'ACA', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AD', 'Adams Laboratories, Inc.', 30, 0, 0, '', 'AD', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AKR', 'Akorn, Inc', 40, 0, 0, '', 'AKR', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'ALP', 'Alpha Therapeutic Corporation', 50, 0, 0, '', 'ALP', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AR', 'Armour', 60, 0, 0, '', 'AR', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AVB', 'Aventis Behring L.L.C.', 70, 0, 0, '', 'AVB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'AVI', 'Aviron', 80, 0, 0, '', 'AVI', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BA', 'Baxter Healthcare Corporation-inactive', 110, 0, 0, '', 'BA', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BAH', 'Baxter Healthcare Corporation', 100, 0, 0, '', 'BAH', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BAY', 'Bayer Corporation', 120, 0, 0, '', 'BAY', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BP', 'Berna Products', 130, 0, 0, '', 'BP', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BPC', 'Berna Products Corporation', 140, 0, 0, '', 'BPC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BRR', 'Barr Laboratories', 90, 0, 0, '', 'BRR', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'BTP', 'Biotest Pharmaceuticals Corporation', 150, 0, 0, '', 'BTP', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CEN', 'Centeon L.L.C.', 180, 0, 0, '', 'CEN', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CHI', 'Chiron Corporation', 190, 0, 0, '', 'CHI', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CMP', 'Celltech Medeva Pharmaceuticals', 170, 0, 0, '', 'CMP', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CNJ', 'Cangene Corporation', 160, 0, 0, '', 'CNJ', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CON', 'Connaught', 200, 0, 0, '', 'CON', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CRU', 'Crucell', 210, 0, 0, '', 'CRU', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'CSL', 'CSL Behring, Inc', 220, 0, 0, '', 'CSL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'DVC', 'DynPort Vaccine Company, LLC', 230, 0, 0, '', 'DVC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'EVN', 'Evans Medical Limited', 250, 0, 0, '', 'EVN', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'GEO', 'GeoVax Labs, Inc.', 260, 0, 0, '', 'GEO', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'GRE', 'Greer Laboratories, Inc.', 280, 0, 0, '', 'GRE', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'GRF', 'Grifols', 290, 0, 0, '', 'GRF', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'IAG', 'Immuno International AG', 310, 0, 0, '', 'IAG', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'IDB', 'ID Biomedical', 300, 0, 0, '', 'IDB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'IM', 'Merieux', 410, 0, 0, '', 'IM', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'INT', 'Intercell Biomedical', 330, 0, 0, '', 'INT', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'IUS', 'Immuno-U.S., Inc.', 320, 0, 0, '', 'IUS', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'JNJ', 'Johnson and Johnson', 340, 0, 0, '', 'JNJ', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'JPN', 'The Research Foundation for Microbial Diseases of Osaka University (BIKEN)', 610, 0, 0, '', 'JPN', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'KGC', 'Korea Green Cross Corporation', 350, 0, 0, '', 'KGC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'LED', 'Lederle', 360, 0, 0, '', 'LED', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MA', 'Massachusetts Public Health Biologic Laboratories', 380, 0, 0, '', 'MA', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MBL', 'Massachusetts Biologic Laboratories', 370, 0, 0, '', 'MBL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MED', 'MedImmune, Inc.', 390, 0, 0, '', 'MED', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MIL', 'Miles', 420, 0, 0, '', 'MIL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MIP', 'Emergent BioDefense Operations Lansing', 240, 0, 0, '', 'MIP', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'MSD', 'Merck and Co., Inc.', 400, 0, 0, '', 'MSD', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'NAB', 'NABI', 430, 0, 0, '', 'NAB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'NAV', 'North American Vaccine, Inc.', 450, 0, 0, '', 'NAV', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'NOV', 'Novartis Pharmaceutical Corporation', 460, 0, 0, '', 'NOV', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'NVX', 'Novavax, Inc.', 470, 0, 0, '', 'NVX', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'NYB', 'New York Blood Center', 440, 0, 0, '', 'NYB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'ORT', 'Ortho-clinical Diagnostics', 490, 0, 0, '', 'ORT', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'OTC', 'Organon Teknika Corporation', 480, 0, 0, '', 'OTC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'OTH', 'Other manufacturer', 500, 0, 0, '', 'OTH', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PD', 'Parkedale Pharmaceuticals', 510, 0, 0, '', 'PD', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PFR', 'Pfizer, Inc', 520, 0, 0, '', 'PFR', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PMC', 'sanofi pasteur', 560, 0, 0, '', 'PMC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PRX', 'Praxis Biologics', 540, 0, 0, '', 'PRX', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PSC', 'Protein Sciences', 550, 0, 0, '', 'PSC', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'PWJ', 'PowderJect Pharmaceuticals', 530, 0, 0, '', 'PWJ', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'SCL', 'Sclavo, Inc.', 570, 0, 0, '', 'SCL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'SI', 'Swiss Serum and Vaccine Inst.', 590, 0, 0, '', 'SI', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'SKB', 'GlaxoSmithKline', 270, 0, 0, '', 'SKB', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'SOL', 'Solvay Pharmaceuticals', 580, 0, 0, '', 'SOL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'TAL', 'Talecris Biotherapeutics', 600, 0, 0, '', 'TAL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'UNK', 'Unknown manufacturer', 630, 0, 0, '', 'UNK', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'USA', 'United States Army Medical Research and Material Command', 620, 0, 0, '', 'USA', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'VXG', 'VaxGen', 640, 0, 0, '', 'VXG', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'WA', 'Wyeth-Ayerst', 660, 0, 0, '', 'WA', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'WAL', 'Wyeth', 650, 0, 0, '', 'WAL', '', 0, 0, 1, '', ''),
('Immunization_Manufacturer', 'ZLB', 'ZLB Behring', 670, 0, 0, '', 'ZLB', '', 0, 0, 1, '', ''),
('Industry', 'construction_firm', 'Construction Firm', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Industry', 'engineering_firm', 'Engineering Firm', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Industry', 'law_firm', 'Law Firm', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('insurance_account_type', 'BC', 'BCBS', 15, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_account_type', 'CL', 'COLLECTIONS', 10, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_account_type', 'CP', 'WORKERS COMP', 30, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_account_type', 'SP', 'SELF PAY', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_payment_method', 'check_payment', 'Check Payment', 10, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_payment_method', 'credit_card', 'Credit Card', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('insurance_types', 'primary', 'Primary', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('insurance_types', 'secondary', 'Secondary', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('insurance_types', 'tertiary', 'Tertiary', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('issue_subtypes', 'eye', 'Eye', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('language', 'abkhazian', 'Abkhazian', 10, 0, 0, '', 'abk', '', 0, 0, 1, '', ''),
('language', 'afar', 'Afar', 20, 0, 0, '', 'aar', '', 0, 0, 1, '', ''),
('language', 'afrikaans', 'Afrikaans', 30, 0, 0, '', 'afr', '', 0, 0, 1, '', ''),
('language', 'akan', 'Akan', 40, 0, 0, '', 'aka', '', 0, 0, 1, '', ''),
('language', 'albanian', 'Albanian', 50, 0, 0, '', 'alb(B)|sqi(T)', '', 0, 0, 1, '', ''),
('language', 'amharic', 'Amharic', 60, 0, 0, '', 'amh', '', 0, 0, 1, '', ''),
('language', 'arabic', 'Arabic', 70, 0, 0, '', 'ara', '', 0, 0, 1, '', ''),
('language', 'aragonese', 'Aragonese', 80, 0, 0, '', 'arg', '', 0, 0, 1, '', ''),
('language', 'armenian', 'Armenian', 90, 0, 0, '', 'arm(B)|hye(T)', '', 0, 0, 1, '', ''),
('language', 'assamese', 'Assamese', 100, 0, 0, '', 'asm', '', 0, 0, 1, '', ''),
('language', 'avaric', 'Avaric', 110, 0, 0, '', 'ava', '', 0, 0, 1, '', ''),
('language', 'avestan', 'Avestan', 120, 0, 0, '', 'ave', '', 0, 0, 1, '', ''),
('language', 'aymara', 'Aymara', 130, 0, 0, '', 'aym', '', 0, 0, 1, '', ''),
('language', 'azerbaijani', 'Azerbaijani', 140, 0, 0, '', 'aze', '', 0, 0, 1, '', ''),
('language', 'bambara', 'Bambara', 150, 0, 0, '', 'bam', '', 0, 0, 1, '', ''),
('language', 'bashkir', 'Bashkir', 160, 0, 0, '', 'bak', '', 0, 0, 1, '', ''),
('language', 'basque', 'Basque', 170, 0, 0, '', 'baq(B)|eus(T)', '', 0, 0, 1, '', ''),
('language', 'belarusian', 'Belarusian', 180, 0, 0, '', 'bel', '', 0, 0, 1, '', ''),
('language', 'bengali', 'Bengali', 190, 0, 0, '', 'ben', '', 0, 0, 1, '', ''),
('language', 'bihari_languages', 'Bihari languages', 200, 0, 0, '', 'bih', '', 0, 0, 1, '', ''),
('language', 'bislama', 'Bislama', 210, 0, 0, '', 'bis', '', 0, 0, 1, '', ''),
('language', 'bokmal_norwegian_norwegian_bok', 'Bokmål, Norwegian; Norwegian Bokmål', 220, 0, 0, '', 'nob', '', 0, 0, 1, '', ''),
('language', 'bosnian', 'Bosnian', 230, 0, 0, '', 'bos', '', 0, 0, 1, '', ''),
('language', 'breton', 'Breton', 240, 0, 0, '', 'bre', '', 0, 0, 1, '', ''),
('language', 'bulgarian', 'Bulgarian', 250, 0, 0, '', 'bul', '', 0, 0, 1, '', ''),
('language', 'burmese', 'Burmese', 260, 0, 0, '', 'bur(B)|mya(T)', '', 0, 0, 1, '', ''),
('language', 'catalan_valencian', 'Catalan; Valencian', 270, 0, 0, '', 'cat', '', 0, 0, 1, '', ''),
('language', 'central_khmer', 'Central Khmer', 280, 0, 0, '', 'khm', '', 0, 0, 1, '', ''),
('language', 'chamorro', 'Chamorro', 290, 0, 0, '', 'cha', '', 0, 0, 1, '', ''),
('language', 'chechen', 'Chechen', 300, 0, 0, '', 'che', '', 0, 0, 1, '', ''),
('language', 'chichewa_chewa_nyanja', 'Chichewa; Chewa; Nyanja', 310, 0, 0, '', 'nya', '', 0, 0, 1, '', ''),
('language', 'chinese', 'Chinese', 320, 0, 0, '', 'chi(B)|zho(T)', '', 0, 0, 1, '', ''),
('language', 'church_slavic_old_slavonic_chu', 'Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic', 330, 0, 0, '', 'chu', '', 0, 0, 1, '', ''),
('language', 'chuvash', 'Chuvash', 340, 0, 0, '', 'chv', '', 0, 0, 1, '', ''),
('language', 'cornish', 'Cornish', 350, 0, 0, '', 'cor', '', 0, 0, 1, '', ''),
('language', 'corsican', 'Corsican', 360, 0, 0, '', 'cos', '', 0, 0, 1, '', ''),
('language', 'cree', 'Cree', 370, 0, 0, '', 'cre', '', 0, 0, 1, '', ''),
('language', 'croatian', 'Croatian', 380, 0, 0, '', 'hrv', '', 0, 0, 1, '', ''),
('language', 'czech', 'Czech', 390, 0, 0, '', 'cze(B)|ces(T)', '', 0, 0, 1, '', ''),
('language', 'danish', 'Danish', 400, 0, 0, '', 'dan', '', 0, 0, 1, '', ''),
('language', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('language', 'divehi_dhivehi_maldivian', 'Divehi; Dhivehi; Maldivian', 410, 0, 0, '', 'div', '', 0, 0, 1, '', ''),
('language', 'dutch_flemish', 'Dutch; Flemish', 420, 0, 0, '', 'dut(B)|nld(T)', '', 0, 0, 1, '', ''),
('language', 'dzongkha', 'Dzongkha', 430, 0, 0, '', 'dzo', '', 0, 0, 1, '', ''),
('language', 'English', 'English', 440, 0, 0, '', 'eng', '', 0, 0, 1, '', ''),
('language', 'esperanto', 'Esperanto', 450, 0, 0, '', 'epo', '', 0, 0, 1, '', ''),
('language', 'estonian', 'Estonian', 460, 0, 0, '', 'est', '', 0, 0, 1, '', ''),
('language', 'ewe', 'Ewe', 470, 0, 0, '', 'ewe', '', 0, 0, 1, '', ''),
('language', 'faroese', 'Faroese', 480, 0, 0, '', 'fao', '', 0, 0, 1, '', ''),
('language', 'fijian', 'Fijian', 490, 0, 0, '', 'fij', '', 0, 0, 1, '', ''),
('language', 'finnish', 'Finnish', 500, 0, 0, '', 'fin', '', 0, 0, 1, '', ''),
('language', 'french', 'French', 510, 0, 0, '', 'fre(B)|fra(T)', '', 0, 0, 1, '', ''),
('language', 'fulah', 'Fulah', 520, 0, 0, '', 'ful', '', 0, 0, 1, '', ''),
('language', 'gaelic_scottish_gaelic', 'Gaelic; Scottish Gaelic', 530, 0, 0, '', 'gla', '', 0, 0, 1, '', ''),
('language', 'galician', 'Galician', 540, 0, 0, '', 'glg', '', 0, 0, 1, '', ''),
('language', 'ganda', 'Ganda', 550, 0, 0, '', 'lug', '', 0, 0, 1, '', ''),
('language', 'georgian', 'Georgian', 560, 0, 0, '', 'geo(B)|kat(T)', '', 0, 0, 1, '', ''),
('language', 'german', 'German', 570, 0, 0, '', 'ger(B)|deu(T)', '', 0, 0, 1, '', ''),
('language', 'greek', 'Greek, Modern (1453-)', 580, 0, 0, '', 'gre(B)|ell(T)', '', 0, 0, 1, '', ''),
('language', 'guarani', 'Guarani', 590, 0, 0, '', 'grn', '', 0, 0, 1, '', ''),
('language', 'gujarati', 'Gujarati', 600, 0, 0, '', 'guj', '', 0, 0, 1, '', ''),
('language', 'haitian_haitian_creole', 'Haitian; Haitian Creole', 610, 0, 0, '', 'hat', '', 0, 0, 1, '', ''),
('language', 'hausa', 'Hausa', 620, 0, 0, '', 'hau', '', 0, 0, 1, '', ''),
('language', 'hebrew', 'Hebrew', 630, 0, 0, '', 'heb', '', 0, 0, 1, '', ''),
('language', 'herero', 'Herero', 640, 0, 0, '', 'her', '', 0, 0, 1, '', ''),
('language', 'hindi', 'Hindi', 650, 0, 0, '', 'hin', '', 0, 0, 1, '', ''),
('language', 'hiri_motu', 'Hiri Motu', 660, 0, 0, '', 'hmo', '', 0, 0, 1, '', ''),
('language', 'hungarian', 'Hungarian', 670, 0, 0, '', 'hun', '', 0, 0, 1, '', ''),
('language', 'icelandic', 'Icelandic', 680, 0, 0, '', 'ice(B)|isl(T)', '', 0, 0, 1, '', ''),
('language', 'ido', 'Ido', 690, 0, 0, '', 'ido', '', 0, 0, 1, '', ''),
('language', 'igbo', 'Igbo', 700, 0, 0, '', 'ibo', '', 0, 0, 1, '', ''),
('language', 'indonesian', 'Indonesian', 710, 0, 0, '', 'ind', '', 0, 0, 1, '', ''),
('language', 'interlingua_international_auxi', 'Interlingua (International Auxiliary Language Association)', 720, 0, 0, '', 'ina', '', 0, 0, 1, '', ''),
('language', 'interlingue_occidental', 'Interlingue; Occidental', 730, 0, 0, '', 'ile', '', 0, 0, 1, '', ''),
('language', 'inuktitut', 'Inuktitut', 740, 0, 0, '', 'iku', '', 0, 0, 1, '', ''),
('language', 'inupiaq', 'Inupiaq', 750, 0, 0, '', 'ipk', '', 0, 0, 1, '', ''),
('language', 'irish', 'Irish', 760, 0, 0, '', 'gle', '', 0, 0, 1, '', ''),
('language', 'italian', 'Italian', 770, 0, 0, '', 'ita', '', 0, 0, 1, '', ''),
('language', 'japanese', 'Japanese', 780, 0, 0, '', 'jpn', '', 0, 0, 1, '', ''),
('language', 'javanese', 'Javanese', 790, 0, 0, '', 'jav', '', 0, 0, 1, '', ''),
('language', 'kalaallisut_greenlandic', 'Kalaallisut; Greenlandic', 800, 0, 0, '', 'kal', '', 0, 0, 1, '', ''),
('language', 'kannada', 'Kannada', 810, 0, 0, '', 'kan', '', 0, 0, 1, '', ''),
('language', 'kanuri', 'Kanuri', 820, 0, 0, '', 'kau', '', 0, 0, 1, '', ''),
('language', 'kashmiri', 'Kashmiri', 830, 0, 0, '', 'kas', '', 0, 0, 1, '', ''),
('language', 'kazakh', 'Kazakh', 840, 0, 0, '', 'kaz', '', 0, 0, 1, '', ''),
('language', 'kikuyu_gikuyu', 'Kikuyu; Gikuyu', 850, 0, 0, '', 'kik', '', 0, 0, 1, '', ''),
('language', 'kinyarwanda', 'Kinyarwanda', 860, 0, 0, '', 'kin', '', 0, 0, 1, '', ''),
('language', 'kirghiz_kyrgyz', 'Kirghiz; Kyrgyz', 870, 0, 0, '', 'kir', '', 0, 0, 1, '', ''),
('language', 'komi', 'Komi', 880, 0, 0, '', 'kom', '', 0, 0, 1, '', ''),
('language', 'kongo', 'Kongo', 890, 0, 0, '', 'kon', '', 0, 0, 1, '', ''),
('language', 'korean', 'Korean', 900, 0, 0, '', 'kor', '', 0, 0, 1, '', ''),
('language', 'kuanyama_kwanyama', 'Kuanyama; Kwanyama', 910, 0, 0, '', 'kua', '', 0, 0, 1, '', ''),
('language', 'kurdish', 'Kurdish', 920, 0, 0, '', 'kur', '', 0, 0, 1, '', ''),
('language', 'laotian', 'Lao', 930, 0, 0, '', 'lao', '', 0, 0, 1, '', ''),
('language', 'latin', 'Latin', 940, 0, 0, '', 'lat', '', 0, 0, 1, '', ''),
('language', 'latvian', 'Latvian', 950, 0, 0, '', 'lav', '', 0, 0, 1, '', ''),
('language', 'limburgan_limburger_limburgish', 'Limburgan; Limburger; Limburgish', 960, 0, 0, '', 'lim', '', 0, 0, 1, '', ''),
('language', 'lingala', 'Lingala', 970, 0, 0, '', 'lin', '', 0, 0, 1, '', ''),
('language', 'lithuanian', 'Lithuanian', 980, 0, 0, '', 'lit', '', 0, 0, 1, '', ''),
('language', 'luba-katanga', 'Luba-Katanga', 990, 0, 0, '', 'lub', '', 0, 0, 1, '', ''),
('language', 'luxembourgish_letzeburgesch', 'Luxembourgish; Letzeburgesch', 1000, 0, 0, '', 'ltz', '', 0, 0, 1, '', ''),
('language', 'macedonian', 'Macedonian', 1010, 0, 0, '', 'mac(B)|mkd(T)', '', 0, 0, 1, '', ''),
('language', 'malagasy', 'Malagasy', 1020, 0, 0, '', 'mlg', '', 0, 0, 1, '', ''),
('language', 'malay', 'Malay', 1030, 0, 0, '', 'may(B)|msa(T)', '', 0, 0, 1, '', ''),
('language', 'malayalam', 'Malayalam', 1040, 0, 0, '', 'mal', '', 0, 0, 1, '', ''),
('language', 'maltese', 'Maltese', 1050, 0, 0, '', 'mlt', '', 0, 0, 1, '', ''),
('language', 'manx', 'Manx', 1060, 0, 0, '', 'glv', '', 0, 0, 1, '', ''),
('language', 'maori', 'Maori', 1070, 0, 0, '', 'mao(B)|mri(T)', '', 0, 0, 1, '', ''),
('language', 'marathi', 'Marathi', 1080, 0, 0, '', 'mar', '', 0, 0, 1, '', ''),
('language', 'marshallese', 'Marshallese', 1090, 0, 0, '', 'mah', '', 0, 0, 1, '', ''),
('language', 'mongolian', 'Mongolian', 1100, 0, 0, '', 'mon', '', 0, 0, 1, '', ''),
('language', 'nauru', 'Nauru', 1110, 0, 0, '', 'nau', '', 0, 0, 1, '', ''),
('language', 'navajo_navaho', 'Navajo; Navaho', 1120, 0, 0, '', 'nav', '', 0, 0, 1, '', '');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`, `subtype`, `list_options_icon`) VALUES
('language', 'ndebele_north_north_ndebele', 'Ndebele, North; North Ndebele', 1130, 0, 0, '', 'nde', '', 0, 0, 1, '', ''),
('language', 'ndebele_south_south_ndebele', 'Ndebele, South; South Ndebele', 1140, 0, 0, '', 'nbl', '', 0, 0, 1, '', ''),
('language', 'ndonga', 'Ndonga', 1150, 0, 0, '', 'ndo', '', 0, 0, 1, '', ''),
('language', 'nepali', 'Nepali', 1160, 0, 0, '', 'nep', '', 0, 0, 1, '', ''),
('language', 'northern_sami', 'Northern Sami', 1170, 0, 0, '', 'sme', '', 0, 0, 1, '', ''),
('language', 'norwegian', 'Norwegian', 1180, 0, 0, '', 'nor', '', 0, 0, 1, '', ''),
('language', 'norwegian_nynorsk_nynorsk_norw', 'Norwegian Nynorsk; Nynorsk, Norwegian', 1190, 0, 0, '', 'nno', '', 0, 0, 1, '', ''),
('language', 'occitan_post_1500', 'Occitan (post 1500)', 1200, 0, 0, '', 'oci', '', 0, 0, 1, '', ''),
('language', 'ojibwa', 'Ojibwa', 1210, 0, 0, '', 'oji', '', 0, 0, 1, '', ''),
('language', 'oriya', 'Oriya', 1220, 0, 0, '', 'ori', '', 0, 0, 1, '', ''),
('language', 'oromo', 'Oromo', 1230, 0, 0, '', 'orm', '', 0, 0, 1, '', ''),
('language', 'ossetian_ossetic', 'Ossetian; Ossetic', 1240, 0, 0, '', 'oss', '', 0, 0, 1, '', ''),
('language', 'pali', 'Pali', 1250, 0, 0, '', 'pli', '', 0, 0, 1, '', ''),
('language', 'persian', 'Persian', 1260, 0, 0, '', 'per(B)|fas(T)', '', 0, 0, 1, '', ''),
('language', 'polish', 'Polish', 1270, 0, 0, '', 'pol', '', 0, 0, 1, '', ''),
('language', 'portuguese', 'Portuguese', 1280, 0, 0, '', 'por', '', 0, 0, 1, '', ''),
('language', 'punjabi', 'Punjabi', 1290, 0, 0, '', 'pan', '', 0, 0, 1, '', ''),
('language', 'pushto_pashto', 'Pushto; Pashto', 1300, 0, 0, '', 'pus', '', 0, 0, 1, '', ''),
('language', 'quechua', 'Quechua', 1310, 0, 0, '', 'que', '', 0, 0, 1, '', ''),
('language', 'romanian_moldavian_moldovan', 'Romanian; Moldavian; Moldovan', 1320, 0, 0, '', 'rum(B)|ron(T)', '', 0, 0, 1, '', ''),
('language', 'romansh', 'Romansh', 1330, 0, 0, '', 'roh', '', 0, 0, 1, '', ''),
('language', 'rundi', 'Rundi', 1340, 0, 0, '', 'run', '', 0, 0, 1, '', ''),
('language', 'russian', 'Russian', 1350, 0, 0, '', 'rus', '', 0, 0, 1, '', ''),
('language', 'samoan', 'Samoan', 1360, 0, 0, '', 'smo', '', 0, 0, 1, '', ''),
('language', 'sango', 'Sango', 1370, 0, 0, '', 'sag', '', 0, 0, 1, '', ''),
('language', 'sanskrit', 'Sanskrit', 1380, 0, 0, '', 'san', '', 0, 0, 1, '', ''),
('language', 'sardinian', 'Sardinian', 1390, 0, 0, '', 'srd', '', 0, 0, 1, '', ''),
('language', 'serbian', 'Serbian', 1400, 0, 0, '', 'srp', '', 0, 0, 1, '', ''),
('language', 'shona', 'Shona', 1410, 0, 0, '', 'sna', '', 0, 0, 1, '', ''),
('language', 'sichuan_yi_nuosu', 'Sichuan Yi; Nuosu', 1420, 0, 0, '', 'iii', '', 0, 0, 1, '', ''),
('language', 'sindhi', 'Sindhi', 1430, 0, 0, '', 'snd', '', 0, 0, 1, '', ''),
('language', 'sinhala_sinhalese', 'Sinhala; Sinhalese', 1440, 0, 0, '', 'sin', '', 0, 0, 1, '', ''),
('language', 'slovak', 'Slovak', 1450, 0, 0, '', 'slo(B)|slk(T)', '', 0, 0, 1, '', ''),
('language', 'slovenian', 'Slovenian', 1460, 0, 0, '', 'slv', '', 0, 0, 1, '', ''),
('language', 'somali', 'Somali', 1470, 0, 0, '', 'som', '', 0, 0, 1, '', ''),
('language', 'sotho_southern', 'Sotho, Southern', 1480, 0, 0, '', 'sot', '', 0, 0, 1, '', ''),
('language', 'Spanish', 'Spanish', 1490, 0, 0, '', 'spa', '', 0, 0, 1, '', ''),
('language', 'sundanese', 'Sundanese', 1500, 0, 0, '', 'sun', '', 0, 0, 1, '', ''),
('language', 'swahili', 'Swahili', 1510, 0, 0, '', 'swa', '', 0, 0, 1, '', ''),
('language', 'swati', 'Swati', 1520, 0, 0, '', 'ssw', '', 0, 0, 1, '', ''),
('language', 'swedish', 'Swedish', 1530, 0, 0, '', 'swe', '', 0, 0, 1, '', ''),
('language', 'tagalog', 'Tagalog', 1540, 0, 0, '', 'tgl', '', 0, 0, 1, '', ''),
('language', 'tahitian', 'Tahitian', 1550, 0, 0, '', 'tah', '', 0, 0, 1, '', ''),
('language', 'tajik', 'Tajik', 1560, 0, 0, '', 'tgk', '', 0, 0, 1, '', ''),
('language', 'tamil', 'Tamil', 1570, 0, 0, '', 'tam', '', 0, 0, 1, '', ''),
('language', 'tatar', 'Tatar', 1580, 0, 0, '', 'tat', '', 0, 0, 1, '', ''),
('language', 'telugu', 'Telugu', 1590, 0, 0, '', 'tel', '', 0, 0, 1, '', ''),
('language', 'thai', 'Thai', 1600, 0, 0, '', 'tha', '', 0, 0, 1, '', ''),
('language', 'tibetan', 'Tibetan', 1610, 0, 0, '', 'tib(B)|bod(T)', '', 0, 0, 1, '', ''),
('language', 'tigrinya', 'Tigrinya', 1620, 0, 0, '', 'tir', '', 0, 0, 1, '', ''),
('language', 'tonga_tonga_islands', 'Tonga (Tonga Islands)', 1630, 0, 0, '', 'ton', '', 0, 0, 1, '', ''),
('language', 'tsonga', 'Tsonga', 1640, 0, 0, '', 'tso', '', 0, 0, 1, '', ''),
('language', 'tswana', 'Tswana', 1650, 0, 0, '', 'tsn', '', 0, 0, 1, '', ''),
('language', 'turkish', 'Turkish', 1660, 0, 0, '', 'tur', '', 0, 0, 1, '', ''),
('language', 'turkmen', 'Turkmen', 1670, 0, 0, '', 'tuk', '', 0, 0, 1, '', ''),
('language', 'twi', 'Twi', 1680, 0, 0, '', 'twi', '', 0, 0, 1, '', ''),
('language', 'uighur_uyghur', 'Uighur; Uyghur', 1690, 0, 0, '', 'uig', '', 0, 0, 1, '', ''),
('language', 'ukrainian', 'Ukrainian', 1700, 0, 0, '', 'ukr', '', 0, 0, 1, '', ''),
('language', 'urdu', 'Urdu', 1710, 0, 0, '', 'urd', '', 0, 0, 1, '', ''),
('language', 'uzbek', 'Uzbek', 1720, 0, 0, '', 'uzb', '', 0, 0, 1, '', ''),
('language', 'venda', 'Venda', 1730, 0, 0, '', 'ven', '', 0, 0, 1, '', ''),
('language', 'vietnamese', 'Vietnamese', 1740, 0, 0, '', 'vie', '', 0, 0, 1, '', ''),
('language', 'volapuk', 'Volapük', 1750, 0, 0, '', 'vol', '', 0, 0, 1, '', ''),
('language', 'walloon', 'Walloon', 1760, 0, 0, '', 'wln', '', 0, 0, 1, '', ''),
('language', 'welsh', 'Welsh', 1770, 0, 0, '', 'wel(B)|cym(T)', '', 0, 0, 1, '', ''),
('language', 'western_frisian', 'Western Frisian', 1780, 0, 0, '', 'fry', '', 0, 0, 1, '', ''),
('language', 'wolof', 'Wolof', 1790, 0, 0, '', 'wol', '', 0, 0, 1, '', ''),
('language', 'xhosa', 'Xhosa', 1800, 0, 0, '', 'xho', '', 0, 0, 1, '', ''),
('language', 'yiddish', 'Yiddish', 1810, 0, 0, '', 'yid', '', 0, 0, 1, '', ''),
('language', 'yoruba', 'Yoruba', 1820, 0, 0, '', 'yor', '', 0, 0, 1, '', ''),
('language', 'zhuang_chuang', 'Zhuang; Chuang', 1830, 0, 0, '', 'zha', '', 0, 0, 1, '', ''),
('language', 'zulu', 'Zulu', 1840, 0, 0, '', 'zul', '', 0, 0, 1, '', ''),
('lists', 'abook_type', 'Address Book Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'adjreason', 'Adjustment Reasons', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'allergy_issue_list', 'Allergy Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'amendment_from', 'Amendment From', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'amendment_status', 'Amendment Status', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'apptstat', 'Appointment Statuses', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'boolean', 'Boolean', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'cancellation_reasons', 'Cancellation Reasons', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'chartloc', 'Chart Storage Locations', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'clinical_plans', 'Clinical Plans', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'clinical_rules', 'Clinical Rules', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'code_types', 'Code Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'country', 'Country', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'county', 'County', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'date_master_criteria', 'Date Master Criteria', 33, 1, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'dental_issue_list', 'Dental Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'disclosure_type', 'Disclosure Type', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'drug_form', 'Drug Forms', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'drug_interval', 'Drug Intervals', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'drug_route', 'Drug Routes', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'drug_units', 'Drug Units', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'eligibility', 'Eligibility', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ethnicity', 'Ethnicity', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ethrace', 'Race/Ethnicity', 12, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'exams', 'Exams/Tests', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'feesheet', 'Fee Sheet', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'general_issue_list', 'General Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'immunizations', 'Immunizations', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'Immunization_Completion_Status', 'Immunization Completion Status', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'Immunization_Manufacturer', 'Immunization Manufacturer', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'Industry', 'Industry', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'insurance_account_type', 'Insurance Account Types', 0, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'insurance_payment_method', 'Insurance Payment Method', 0, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'insurance_types', 'Insurance Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'issue_subtypes', 'Issue Subtypes', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'issue_types', 'Issue Types', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'language', 'Language', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'lbfnames', 'Layout-Based Visit Forms', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'marital', 'Marital Status', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'medical_problem_issue_list', 'Medical Problem Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'medication_issue_list', 'Medication Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'message_status', 'Message Status', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'msp_remit_codes', 'MSP Remit Codes', 221, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'nation_notes_replace_buttons', 'Nation Notes Replace Buttons', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'newcrop_erx_role', 'NewCrop eRx Role', 221, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'note_type', 'Patient Note Types', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'Occupation', 'Occupation', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'occurrence', 'Occurrence', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'order_type', 'Order Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ord_priority', 'Order Priorities', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ord_status', 'Order Statuses', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'outcome', 'Outcome', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'patient_flow_board_rooms', 'Patient Flow Board Rooms', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_adjustment_code', 'Payment Adjustment Code', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_date', 'Payment Date', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_gateways', 'Payment Gateways', 297, 1, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'payment_ins', 'Payment Ins', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_method', 'Payment Method', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_sort_by', 'Payment Sort By', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_status', 'Payment Status', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'payment_type', 'Payment Type', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'personal_relationship', 'Relationship', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'physician_type', 'Physician Type', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'pricelevel', 'Price Level', 11, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_body_site', 'Procedure Body Sites', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_lat', 'Procedure Lateralities', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_rep_status', 'Procedure Report Statuses', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_res_abnormal', 'Procedure Result Abnormal', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_res_bool', 'Procedure Boolean Results', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_res_status', 'Procedure Result Statuses', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_route', 'Procedure Routes', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_specimen', 'Procedure Specimen Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_type', 'Procedure Types', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'proc_unit', 'Procedure Units', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'provider_qualifier_code', 'Provider Qualifier Code', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ptlistcols', 'Patient List Columns', 1, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'race', 'Race', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'reaction', 'Reaction', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'refsource', 'Referral Source', 13, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'religious_affiliation', 'Religious Affiliation', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'riskfactors', 'Risk Factors', 14, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'risklevel', 'Risk Level', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_action', 'Clinical Rule Action Item', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_action_category', 'Clinical Rule Action Category', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_age_intervals', 'Clinical Rules Age Intervals', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_comparisons', 'Clinical Rules Comparisons', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_enc_types', 'Clinical Rules Encounter Types', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_filters', 'Clinical Rule Filter Methods', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_reminder_due_opt', 'Clinical Rules Reminder Due Options', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_reminder_inactive_opt', 'Clinical Rules Reminder Inactivation Options', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_reminder_intervals', 'Clinical Rules Reminder Intervals', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_reminder_methods', 'Clinical Rules Reminder Methods', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_targets', 'Clinical Rule Target Methods', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'rule_target_intervals', 'Clinical Rules Target Intervals', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'severity_ccda', 'Severity', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'sex', 'Sex', 17, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'smoking_status', 'Smoking Status', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'state', 'State', 18, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'sub_relation', 'Subscriber Relationship', 18, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'superbill', 'Service Category', 16, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'surgery_issue_list', 'Surgery Issue List', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'taxrate', 'Tax Rate', 19, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'titles', 'Titles', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'transactions', 'Layout-Based Transaction Forms', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'transactions_modifiers', 'Transactions Screen Modifiers', 0, 0, 0, '', '', '', 0, 0, 1, '', ''),
('lists', 'ub_admit_source', 'UB Admit Source', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'ub_admit_type', 'UB Admit Type', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'warehouse', 'Warehouses', 21, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('lists', 'yesno', 'Yes/No', 21, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('marital', 'divorced', 'Divorced', 3, 0, 0, '', 'D', '', 0, 0, 1, '', ''),
('marital', 'domestic partner', 'Domestic Partner', 6, 0, 0, '', 'T', '', 0, 0, 1, '', ''),
('marital', 'married', 'Married', 1, 0, 0, '', 'M', '', 0, 0, 1, '', ''),
('marital', 'separated', 'Separated', 5, 0, 0, '', 'L', '', 0, 0, 1, '', ''),
('marital', 'single', 'Single', 2, 0, 0, '', 'S', '', 0, 0, 1, '', ''),
('marital', 'widowed', 'Widowed', 4, 0, 0, '', 'W', '', 0, 0, 1, '', ''),
('medical_problem_issue_list', 'asthma', 'asthma', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medical_problem_issue_list', 'diabetes', 'diabetes', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medical_problem_issue_list', 'HTN', 'HTN', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medical_problem_issue_list', 'hyperlipidemia', 'hyperlipidemia', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medication_issue_list', 'Lipitor', 'Lipitor', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medication_issue_list', 'Metformin', 'Metformin', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('medication_issue_list', 'Norvasc', 'Norvasc', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('message_status', 'Done', 'Done', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('message_status', 'Forwarded', 'Forwarded', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('message_status', 'New', 'New', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('message_status', 'Read', 'Read', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('msp_remit_codes', '1', '1', 1, 0, 0, '', 'Deductible Amount', '', 0, 0, 1, '', ''),
('msp_remit_codes', '10', '10', 10, 0, 0, '', 'The diagnosis is inconsistent with the patient\'s gender. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '100', '100', 64, 0, 0, '', 'Payment made to patient/insured/responsible party/employer.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '101', '101', 65, 0, 0, '', 'Predetermination: anticipated payment upon completion of services or claim adjudication.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '102', '102', 66, 0, 0, '', 'Major Medical Adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '103', '103', 67, 0, 0, '', 'Provider promotional discount (e.g., Senior citizen discount).', '', 0, 0, 1, '', ''),
('msp_remit_codes', '104', '104', 68, 0, 0, '', 'Managed care withholding.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '105', '105', 69, 0, 0, '', 'Tax withholding.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '106', '106', 70, 0, 0, '', 'Patient payment option/election not in effect.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '107', '107', 71, 0, 0, '', 'The related or qualifying claim/service was not identified on this claim. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '108', '108', 72, 0, 0, '', 'Rent/purchase guidelines were not met. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '109', '109', 73, 0, 0, '', 'Claim not covered by this payer/contractor. You must send the claim to the correct payer/contractor.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '11', '11', 11, 0, 0, '', 'The diagnosis is inconsistent with the procedure. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '110', '110', 74, 0, 0, '', 'Billing date predates service date.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '111', '111', 75, 0, 0, '', 'Not covered unless the provider accepts assignment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '112', '112', 76, 0, 0, '', 'Service not furnished directly to the patient and/or not documented.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '114', '114', 77, 0, 0, '', 'Procedure/product not approved by the Food and Drug Administration.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '115', '115', 78, 0, 0, '', 'Procedure postponed, canceled, or delayed.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '116', '116', 79, 0, 0, '', 'The advance indemnification notice signed by the patient did not comply with requirements.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '117', '117', 80, 0, 0, '', 'Transportation is only covered to the closest facility that can provide the necessary care.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '118', '118', 81, 0, 0, '', 'ESRD network support adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '119', '119', 82, 0, 0, '', 'Benefit maximum for this time period or occurrence has been reached.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '12', '12', 12, 0, 0, '', 'The diagnosis is inconsistent with the provider type. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '121', '121', 83, 0, 0, '', 'Indemnification adjustment - compensation for outstanding member responsibility.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '122', '122', 84, 0, 0, '', 'Psychiatric reduction.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '125', '125', 85, 0, 0, '', 'Submission/billing error(s). At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '128', '128', 86, 0, 0, '', 'Newborn\'s services are covered in the mother\'s Allowance.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '129', '129', 87, 0, 0, '', 'Prior processing information appears incorrect. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '13', '13', 13, 0, 0, '', 'The date of death precedes the date of service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '130', '130', 88, 0, 0, '', 'Claim submission fee.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '131', '131', 89, 0, 0, '', 'Claim specific negotiated discount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '132', '132', 90, 0, 0, '', 'Prearranged demonstration project adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '133', '133', 91, 0, 0, '', 'The disposition of this claim/service is pending further review.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '134', '134', 92, 0, 0, '', 'Technical fees removed from charges.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '135', '135', 93, 0, 0, '', 'Interim bills cannot be processed.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '136', '136', 94, 0, 0, '', 'Failure to follow prior payer\'s coverage rules. (Use Group Code OA).', '', 0, 0, 1, '', ''),
('msp_remit_codes', '137', '137', 95, 0, 0, '', 'Regulatory Surcharges, Assessments, Allowances or Health Related Taxes.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '138', '138', 96, 0, 0, '', 'Appeal procedures not followed or time limits not met.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '139', '139', 97, 0, 0, '', 'Contracted funding agreement - Subscriber is employed by the provider of services.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '14', '14', 14, 0, 0, '', 'The date of birth follows the date of service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '140', '140', 98, 0, 0, '', 'Patient/Insured health identification number and name do not match.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '141', '141', 99, 0, 0, '', 'Claim spans eligible and ineligible periods of coverage.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '142', '142', 100, 0, 0, '', 'Monthly Medicaid patient liability amount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '143', '143', 101, 0, 0, '', 'Portion of payment deferred.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '144', '144', 102, 0, 0, '', 'Incentive adjustment, e.g. preferred product/service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '146', '146', 103, 0, 0, '', 'Diagnosis was invalid for the date(s) of service reported.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '147', '147', 104, 0, 0, '', 'Provider contracted/negotiated rate expired or not on file.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '148', '148', 105, 0, 0, '', 'Information from another provider was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '149', '149', 106, 0, 0, '', 'Lifetime benefit maximum has been reached for this service/benefit category.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '15', '15', 15, 0, 0, '', 'The authorization number is missing, invalid, or does not apply to the billed services or provider.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '150', '150', 107, 0, 0, '', 'Payer deems the information submitted does not support this level of service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '151', '151', 108, 0, 0, '', 'Payment adjusted because the payer deems the information submitted does not support this many/frequency of services.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '152', '152', 109, 0, 0, '', 'Payer deems the information submitted does not support this length of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '153', '153', 110, 0, 0, '', 'Payer deems the information submitted does not support this dosage.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '154', '154', 111, 0, 0, '', 'Payer deems the information submitted does not support this day\'s supply.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '155', '155', 112, 0, 0, '', 'Patient refused the service/procedure.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '157', '157', 113, 0, 0, '', 'Service/procedure was provided as a result of an act of war.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '158', '158', 114, 0, 0, '', 'Service/procedure was provided outside of the United States.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '159', '159', 115, 0, 0, '', 'Service/procedure was provided as a result of terrorism.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '16', '16', 16, 0, 0, '', 'Claim/service lacks information which is needed for adjudication. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '160', '160', 116, 0, 0, '', 'Injury/illness was the result of an activity that is a benefit exclusion.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '161', '161', 117, 0, 0, '', 'Provider performance bonus', '', 0, 0, 1, '', ''),
('msp_remit_codes', '162', '162', 118, 0, 0, '', 'State-mandated Requirement for Property and Casualty, see Claim Payment Remarks Code for specific explanation.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '163', '163', 119, 0, 0, '', 'Attachment referenced on the claim was not received.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '164', '164', 120, 0, 0, '', 'Attachment referenced on the claim was not received in a timely fashion.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '165', '165', 121, 0, 0, '', 'Referral absent or exceeded.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '166', '166', 122, 0, 0, '', 'These services were submitted after this payers responsibility for processing claims under this plan ended.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '167', '167', 123, 0, 0, '', 'This (these) diagnosis(es) is (are) not covered. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '168', '168', 124, 0, 0, '', 'Service(s) have been considered under the patient\'s medical plan. Benefits are not available under this dental plan.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '169', '169', 125, 0, 0, '', 'Alternate benefit has been provided.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '170', '170', 126, 0, 0, '', 'Payment is denied when performed/billed by this type of provider. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '171', '171', 127, 0, 0, '', 'Payment is denied when performed/billed by this type of provider in this type of facility. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '172', '172', 128, 0, 0, '', 'Payment is adjusted when performed/billed by a provider of this specialty. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '173', '173', 129, 0, 0, '', 'Service was not prescribed by a physician.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '174', '174', 130, 0, 0, '', 'Service was not prescribed prior to delivery.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '175', '175', 131, 0, 0, '', 'Prescription is incomplete.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '176', '176', 132, 0, 0, '', 'Prescription is not current.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '177', '177', 133, 0, 0, '', 'Patient has not met the required eligibility requirements.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '178', '178', 134, 0, 0, '', 'Patient has not met the required spend down requirements.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '179', '179', 135, 0, 0, '', 'Patient has not met the required waiting requirements. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '18', '18', 17, 0, 0, '', 'Duplicate claim/service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '180', '180', 136, 0, 0, '', 'Patient has not met the required residency requirements.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '181', '181', 137, 0, 0, '', 'Procedure code was invalid on the date of service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '182', '182', 138, 0, 0, '', 'Procedure modifier was invalid on the date of service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '183', '183', 139, 0, 0, '', 'The referring provider is not eligible to refer the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '184', '184', 140, 0, 0, '', 'The prescribing/ordering provider is not eligible to prescribe/order the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '185', '185', 141, 0, 0, '', 'The rendering provider is not eligible to perform the service billed. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '186', '186', 142, 0, 0, '', 'Level of care change adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '187', '187', 143, 0, 0, '', 'Consumer Spending Account payments (includes but is not limited to Flexible Spending Account, Health Savings Account, Health Reimbursement Account, etc.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '188', '188', 144, 0, 0, '', 'This product/procedure is only covered when used according to FDA recommendations.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '189', '189', 145, 0, 0, '', '\'\'Not otherwise classified\' or \'unlisted\' procedure code (CPT/HCPCS) was billed when there is a specific procedure code for this procedure/service\'', '', 0, 0, 1, '', ''),
('msp_remit_codes', '19', '19', 18, 0, 0, '', 'This is a work-related injury/illness and thus the liability of the Worker\'s Compensation Carrier.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '190', '190', 146, 0, 0, '', 'Payment is included in the allowance for a Skilled Nursing Facility (SNF) qualified stay.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '191', '191', 147, 0, 0, '', 'Not a work related injury/illness and thus not the liability of the workers\' compensation carrier Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Clai', '', 0, 0, 1, '', ''),
('msp_remit_codes', '192', '192', 148, 0, 0, '', 'Non standard adjustment code from paper remittance. Note: This code is to be used by providers/payers providing Coordination of Benefits information to another payer in the 837 transaction only. This code is only used when the non-standard code cannot be ', '', 0, 0, 1, '', ''),
('msp_remit_codes', '193', '193', 149, 0, 0, '', 'Original payment decision is being maintained. Upon review, it was determined that this claim was processed properly.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '194', '194', 150, 0, 0, '', 'Anesthesia performed by the operating physician, the assistant surgeon or the attending physician.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '195', '195', 151, 0, 0, '', 'Refund issued to an erroneous priority payer for this claim/service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '197', '197', 152, 0, 0, '', 'Precertification/authorization/notification absent.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '198', '198', 153, 0, 0, '', 'Precertification/authorization exceeded.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '199', '199', 154, 0, 0, '', 'Revenue code and Procedure code do not match.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '2', '2', 2, 0, 0, '', 'Coinsurance Amount', '', 0, 0, 1, '', ''),
('msp_remit_codes', '20', '20', 19, 0, 0, '', 'This injury/illness is covered by the liability carrier.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '200', '200', 155, 0, 0, '', 'Expenses incurred during lapse in coverage', '', 0, 0, 1, '', ''),
('msp_remit_codes', '201', '201', 156, 0, 0, '', 'Workers Compensation case settled. Patient is responsible for amount of this claim/service through WC \'Medicare set aside arrangement\' or other agreement. (Use group code PR).', '', 0, 0, 1, '', ''),
('msp_remit_codes', '202', '202', 157, 0, 0, '', 'Non-covered personal comfort or convenience services.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '203', '203', 158, 0, 0, '', 'Discontinued or reduced service.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '204', '204', 159, 0, 0, '', 'This service/equipment/drug is not covered under the patient?s current benefit plan', '', 0, 0, 1, '', ''),
('msp_remit_codes', '205', '205', 160, 0, 0, '', 'Pharmacy discount card processing fee', '', 0, 0, 1, '', ''),
('msp_remit_codes', '206', '206', 161, 0, 0, '', 'National Provider Identifier - missing.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '207', '207', 162, 0, 0, '', 'National Provider identifier - Invalid format', '', 0, 0, 1, '', ''),
('msp_remit_codes', '208', '208', 163, 0, 0, '', 'National Provider Identifier - Not matched.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '209', '209', 164, 0, 0, '', 'Per regulatory or other agreement. The provider cannot collect this amount from the patient. However, this amount may be billed to subsequent payer. Refund to patient if collected. (Use Group code OA)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '21', '21', 20, 0, 0, '', 'This injury/illness is the liability of the no-fault carrier.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '210', '210', 165, 0, 0, '', 'Payment adjusted because pre-certification/authorization not received in a timely fashion', '', 0, 0, 1, '', ''),
('msp_remit_codes', '211', '211', 166, 0, 0, '', 'National Drug Codes (NDC) not eligible for rebate, are not covered.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '212', '212', 167, 0, 0, '', 'Administrative surcharges are not covered', '', 0, 0, 1, '', ''),
('msp_remit_codes', '213', '213', 168, 0, 0, '', 'Non-compliance with the physician self referral prohibition legislation or payer policy.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '214', '214', 169, 0, 0, '', 'Workers\' Compensation claim adjudicated as non-compensable. This Payer not liable for claim or service/treatment. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop', '', 0, 0, 1, '', ''),
('msp_remit_codes', '215', '215', 170, 0, 0, '', 'Based on subrogation of a third party settlement', '', 0, 0, 1, '', ''),
('msp_remit_codes', '216', '216', 171, 0, 0, '', 'Based on the findings of a review organization', '', 0, 0, 1, '', ''),
('msp_remit_codes', '217', '217', 172, 0, 0, '', 'Based on payer reasonable and customary fees. No maximum allowable defined by legislated fee arrangement. (Note: To be used for Workers\' Compensation only)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '218', '218', 173, 0, 0, '', 'Based on entitlement to benefits. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier \'IG\') for the jurisdictional', '', 0, 0, 1, '', ''),
('msp_remit_codes', '219', '219', 174, 0, 0, '', 'Based on extent of injury. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier \'IG\') for the jurisdictional regula', '', 0, 0, 1, '', ''),
('msp_remit_codes', '22', '22', 21, 0, 0, '', 'This care may be covered by another payer per coordination of benefits.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '220', '220', 175, 0, 0, '', 'The applicable fee schedule does not contain the billed code. Please resubmit a bill with the appropriate fee schedule code(s) that best describe the service(s) provided and supporting documentation if required. (Note: To be used for Workers\' Compensation', '', 0, 0, 1, '', ''),
('msp_remit_codes', '221', '221', 176, 0, 0, '', 'Workers\' Compensation claim is under investigation. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insurance Policy Number Segment (Loop 2100 Other Claim Related Information REF qualifier \'IG\') for ', '', 0, 0, 1, '', ''),
('msp_remit_codes', '222', '222', 177, 0, 0, '', 'Exceeds the contracted maximum number of hours/days/units by this provider for this period. This is not patient specific. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '223', '223', 178, 0, 0, '', 'Adjustment code for mandated federal, state or local law/regulation that is not already covered by another code and is mandated before a new code can be created.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '224', '224', 179, 0, 0, '', 'Patient identification compromised by identity theft. Identity verification required for processing this and future claims.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '225', '225', 180, 0, 0, '', 'Penalty or Interest Payment by Payer (Only used for plan to plan encounter reporting within the 837)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '226', '226', 181, 0, 0, '', 'Information requested from the Billing/Rendering Provider was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ', '', 0, 0, 1, '', ''),
('msp_remit_codes', '227', '227', 182, 0, 0, '', 'Information requested from the patient/insured/responsible party was not provided or was insufficient/incomplete. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is ', '', 0, 0, 1, '', ''),
('msp_remit_codes', '228', '228', 183, 0, 0, '', 'Denied for failure of this provider, another provider or the subscriber to supply requested information to a previous payer for their adjudication', '', 0, 0, 1, '', ''),
('msp_remit_codes', '229', '229', 184, 0, 0, '', 'Partial charge amount not considered by Medicare due to the initial claim Type of Bill being 12X. Note: This code can only be used in the 837 transaction to convey Coordination of Benefits information when the secondary payer?s cost avoidance policy allow', '', 0, 0, 1, '', ''),
('msp_remit_codes', '23', '23', 22, 0, 0, '', 'The impact of prior payer(s) adjudication including payments and/or adjustments.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '230', '230', 185, 0, 0, '', 'No available or correlating CPT/HCPCS code to describe this service. Note: Used only by Property and Casualty.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '231', '231', 186, 0, 0, '', 'Mutually exclusive procedures cannot be done in the same day/setting. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '232', '232', 187, 0, 0, '', 'Institutional Transfer Amount. Note - Applies to institutional claims only and explains the DRG amount difference when the patient care crosses multiple institutions.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '233', '233', 188, 0, 0, '', 'Services/charges related to the treatment of a hospital-acquired condition or preventable medical error.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '234', '234', 189, 0, 0, '', 'This procedure is not paid separately. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '235', '235', 190, 0, 0, '', 'Sales Tax', '', 0, 0, 1, '', ''),
('msp_remit_codes', '236', '236', 191, 0, 0, '', 'This procedure or procedure/modifier combination is not compatible with another procedure or procedure/modifier combination provided on the same day according to the National Correct Coding Initiative.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '237', '237', 192, 0, 0, '', 'Legislated/Regulatory Penalty. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '24', '24', 23, 0, 0, '', 'Charges are covered under a capitation agreement/managed care plan.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '26', '26', 24, 0, 0, '', 'Expenses incurred prior to coverage.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '27', '27', 25, 0, 0, '', 'Expenses incurred after coverage terminated.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '29', '29', 26, 0, 0, '', 'The time limit for filing has expired.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '3', '3', 3, 0, 0, '', 'Co-payment Amount', '', 0, 0, 1, '', ''),
('msp_remit_codes', '31', '31', 27, 0, 0, '', 'Patient cannot be identified as our insured.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '32', '32', 28, 0, 0, '', 'Our records indicate that this dependent is not an eligible dependent as defined.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '33', '33', 29, 0, 0, '', 'Insured has no dependent coverage.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '34', '34', 30, 0, 0, '', 'Insured has no coverage for newborns.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '35', '35', 31, 0, 0, '', 'Lifetime benefit maximum has been reached.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '38', '38', 32, 0, 0, '', 'Services not provided or authorized by designated (network/primary care) providers.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '39', '39', 33, 0, 0, '', 'Services denied at the time authorization/pre-certification was requested.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '4', '4', 4, 0, 0, '', 'The procedure code is inconsistent with the modifier used or a required modifier is missing. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '40', '40', 34, 0, 0, '', 'Charges do not meet qualifications for emergent/urgent care. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '44', '44', 35, 0, 0, '', 'Prompt-pay discount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '45', '45', 36, 0, 0, '', 'Charge exceeds fee schedule/maximum allowable or contracted/legislated fee arrangement. (Use Group Codes PR or CO depending upon liability).', '', 0, 0, 1, '', ''),
('msp_remit_codes', '49', '49', 37, 0, 0, '', 'These are non-covered services because this is a routine exam or screening procedure done in conjunction with a routine exam. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '50', '50', 38, 0, 0, '', 'These are non-covered services because this is not deemed a \'medical necessity\' by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '51', '51', 39, 0, 0, '', 'These are non-covered services because this is a pre-existing condition. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '53', '53', 40, 0, 0, '', 'Services by an immediate relative or a member of the same household are not covered.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '54', '54', 41, 0, 0, '', 'Multiple physicians/assistants are not covered in this case. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '55', '55', 42, 0, 0, '', 'Procedure/treatment is deemed experimental/investigational by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '56', '56', 43, 0, 0, '', 'Procedure/treatment has not been deemed \'proven to be effective\' by the payer. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '58', '58', 44, 0, 0, '', 'Treatment was deemed by the payer to have been rendered in an inappropriate or invalid place of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '59', '59', 45, 0, 0, '', 'Processed based on multiple or concurrent procedure rules. (For example multiple surgery or diagnostic imaging, concurrent anesthesia.) Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present', '', 0, 0, 1, '', ''),
('msp_remit_codes', '60', '60', 46, 0, 0, '', 'Charges for outpatient services are not covered when performed within a period of time prior to or after inpatient services.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '61', '61', 47, 0, 0, '', 'Penalty for failure to obtain second surgical opinion. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '66', '66', 48, 0, 0, '', 'Blood Deductible.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '69', '69', 49, 0, 0, '', 'Day outlier amount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '70', '70', 50, 0, 0, '', 'Cost outlier - Adjustment to compensate for additional costs.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '74', '74', 51, 0, 0, '', 'Indirect Medical Education Adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '75', '75', 52, 0, 0, '', 'Direct Medical Education Adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '76', '76', 53, 0, 0, '', 'Disproportionate Share Adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '78', '78', 54, 0, 0, '', 'Non-Covered days/Room charge adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '85', '85', 55, 0, 0, '', 'Patient Interest Adjustment (Use Only Group code PR)', '', 0, 0, 1, '', ''),
('msp_remit_codes', '87', '87', 56, 0, 0, '', 'Transfer amount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '89', '89', 57, 0, 0, '', 'Professional fees removed from charges.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '9', '9', 9, 0, 0, '', 'The diagnosis is inconsistent with the patient\'s age. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '90', '90', 58, 0, 0, '', 'Ingredient cost adjustment. Note: To be used for pharmaceuticals only.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '91', '91', 59, 0, 0, '', 'Dispensing fee adjustment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '94', '94', 60, 0, 0, '', 'Processed in Excess of charges.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '95', '95', 61, 0, 0, '', 'Plan procedures not followed.', '', 0, 0, 1, '', ''),
('msp_remit_codes', '96', '96', 62, 0, 0, '', 'Non-covered charge(s). At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.) Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 S', '', 0, 0, 1, '', ''),
('msp_remit_codes', '97', '97', 63, 0, 0, '', 'The benefit for this service is included in the payment/allowance for another service/procedure that has already been adjudicated. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'A0', 'A0', 193, 0, 0, '', 'Patient refund amount.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'A1', 'A1', 194, 0, 0, '', 'Claim/Service denied. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'A5', 'A5', 195, 0, 0, '', 'Medicare Claim PPS Capital Cost Outlier Amount.', '', 0, 0, 1, '', '');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`, `subtype`, `list_options_icon`) VALUES
('msp_remit_codes', 'A6', 'A6', 196, 0, 0, '', 'Prior hospitalization or 30 day transfer requirement not met.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'A7', 'A7', 197, 0, 0, '', 'Presumptive Payment Adjustment', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'A8', 'A8', 198, 0, 0, '', 'Ungroupable DRG.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B1', 'B1', 199, 0, 0, '', 'Non-covered visits.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B10', 'B10', 200, 0, 0, '', 'Allowed amount has been reduced because a component of the basic procedure/test was paid. The beneficiary is not liable for more than the charge limit for the basic procedure/test.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B11', 'B11', 201, 0, 0, '', 'The claim/service has been transferred to the proper payer/processor for processing. Claim/service not covered by this payer/processor.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B12', 'B12', 202, 0, 0, '', 'Services not documented in patients\' medical records.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B13', 'B13', 203, 0, 0, '', 'Previously paid. Payment for this claim/service may have been provided in a previous payment.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B14', 'B14', 204, 0, 0, '', 'Only one visit or consultation per physician per day is covered.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B15', 'B15', 205, 0, 0, '', 'This service/procedure requires that a qualifying service/procedure be received and covered. The qualifying other service/procedure has not been received/adjudicated. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payme', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B16', 'B16', 206, 0, 0, '', '\'\'New Patient\' qualifications were not met.\'', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B20', 'B20', 207, 0, 0, '', 'Procedure/service was partially or fully furnished by another provider.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B22', 'B22', 208, 0, 0, '', 'This payment is adjusted based on the diagnosis.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B23', 'B23', 209, 0, 0, '', 'Procedure billed is not authorized per your Clinical Laboratory Improvement Amendment (CLIA) proficiency test.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B4', 'B4', 210, 0, 0, '', 'Late filing penalty.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B5', 'B5', 211, 0, 0, '', 'Coverage/program guidelines were not met or were exceeded.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B7', 'B7', 212, 0, 0, '', 'This provider was not certified/eligible to be paid for this procedure/service on this date of service. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B8', 'B8', 213, 0, 0, '', 'Alternative services were available, and should have been utilized. Note: Refer to the 835 Healthcare Policy Identification Segment (loop 2110 Service Payment Information REF), if present.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'B9', 'B9', 214, 0, 0, '', 'Patient is enrolled in a Hospice.', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'D23', 'D23', 215, 0, 0, '', 'This dual eligible patient is covered by Medicare Part D per Medicare Retro-Eligibility. At least one Remark Code must be provided (may be comprised of either the NCPDP Reject Reason Code, or Remittance Advice Remark Code that is not an ALERT.)', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'W1', 'W1', 216, 0, 0, '', 'Workers\' compensation jurisdictional fee schedule adjustment. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Class of Contract Code Identification Segment (Loop 2100 Other Claim Related Information ', '', 0, 0, 1, '', ''),
('msp_remit_codes', 'W2', 'W2', 217, 0, 0, '', 'Payment reduced or denied based on workers\' compensation jurisdictional regulations or payment policies, use only if no other code is applicable. Note: If adjustment is at the Claim Level, the payer must send and the provider should refer to the 835 Insur', '', 0, 0, 1, '', ''),
('nation_notes_replace_buttons', 'Abnormal', 'Abnormal', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('nation_notes_replace_buttons', 'No', 'No', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('nation_notes_replace_buttons', 'Normal', 'Normal', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('nation_notes_replace_buttons', 'Yes', 'Yes', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxadmin', 'NewCrop Admin', 5, 0, 0, '', '', '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxdoctor', 'NewCrop Doctor', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxmanager', 'NewCrop Manager', 15, 0, 0, '', '', '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxmidlevelPrescriber', 'NewCrop Midlevel Prescriber', 25, 0, 0, '', '', '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxnurse', 'NewCrop Nurse', 10, 0, 0, '', '', '', 0, 0, 1, '', ''),
('newcrop_erx_role', 'erxsupervisingDoctor', 'NewCrop Supervising Doctor', 30, 0, 0, '', '', '', 0, 0, 1, '', ''),
('note_type', 'Bill/Collect', 'Bill/Collect', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Chart Note', 'Chart Note', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Insurance', 'Insurance', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Lab Results', 'Lab Results', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'New Document', 'New Document', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'New Orders', 'New Orders', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Other', 'Other', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Patient Reminders', 'Patient Reminders', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Pharmacy', 'Pharmacy', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Prior Auth', 'Prior Auth', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Referral', 'Referral', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Test Scheduling', 'Test Scheduling', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('note_type', 'Unassigned', 'Unassigned', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Occupation', 'engineer', 'Engineer', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Occupation', 'lawyer', 'Lawyer', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('Occupation', 'site_worker', 'Site Worker', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '0', 'Unknown or N/A', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '1', 'First', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '4', 'Chronic/Recurrent', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '5', 'Acute on Chronic', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '6', 'Early Recurrence (<2 Mo)', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '7', 'Late Recurrence (2-12 Mo)', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('occurrence', '8', 'Delayed Recurrence (> 12 Mo)', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'enc_checkup_procedure', 'Encounter Checkup Procedure', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'imaging', 'Imaging', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'intervention', 'Intervention', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'laboratory_test', 'Laboratory Test', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'patient_characteristics', 'Patient Characteristics', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'physical_exam', 'Physical Exam', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'procedure', 'Procedure', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('order_type', 'risk_category', 'Risk Category Assessment', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_priority', 'high', 'High', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_priority', 'normal', 'Normal', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_status', 'canceled', 'Canceled', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_status', 'complete', 'Complete', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_status', 'pending', 'Pending', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ord_status', 'routed', 'Routed', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '0', 'Unassigned', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '1', 'Resolved', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '2', 'Improved', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '3', 'Status quo', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '4', 'Worse', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('outcome', '5', 'Pending followup', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('patient_flow_board_rooms', '1', 'Room 1', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('patient_flow_board_rooms', '2', 'Room 2', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('patient_flow_board_rooms', '3', 'Room 3', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_adjustment_code', 'family_payment', 'Family Payment', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_adjustment_code', 'group_payment', 'Group Payment', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_adjustment_code', 'insurance_payment', 'Insurance Payment', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_adjustment_code', 'patient_payment', 'Patient Payment', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_adjustment_code', 'pre_payment', 'Pre Payment', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_date', 'date_val', 'Date', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_date', 'deposit_date', 'Deposit Date', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_date', 'post_to_date', 'Post To Date', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_gateways', 'authorize_net', 'Authorize.net', 1, 0, 0, '', '', '', 0, 0, 1, '', ''),
('payment_ins', '0', 'Pat', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_ins', '1', 'Ins1', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_ins', '2', 'Ins2', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_ins', '3', 'Ins3', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_method', 'authorize_net', 'Authorize.net', 60, 0, 0, '', '', '', 0, 0, 1, '', ''),
('payment_method', 'bank_draft', 'Bank Draft', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_method', 'cash', 'Cash', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_method', 'check_payment', 'Check Payment', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_method', 'credit_card', 'Credit Card', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_method', 'electronic', 'Electronic', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'check_date', 'Check Date', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'payer_id', 'Ins Code', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'payment_method', 'Payment Method', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'payment_type', 'Paying Entity', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'pay_total', 'Amount', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'reference', 'Check Number', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_sort_by', 'session_id', 'Id', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_status', 'fully_paid', 'Fully Paid', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_status', 'unapplied', 'Unapplied', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_type', 'insurance', 'Insurance', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('payment_type', 'patient', 'Patient', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('personal_relationship', 'ADOPT', 'Adopted Child', 10, 0, 0, '', 'ADOPT', '', 0, 0, 1, '', ''),
('personal_relationship', 'AUNT', 'Aunt', 20, 0, 0, '', 'AUNT', '', 0, 0, 1, '', ''),
('personal_relationship', 'CHILD', 'Child', 30, 0, 0, '', 'CHILD', '', 0, 0, 1, '', ''),
('personal_relationship', 'CHLDFOST', 'Foster Child', 80, 0, 0, '', 'CHLDFOST', '', 0, 0, 1, '', ''),
('personal_relationship', 'CHLDINLAW', 'Child in-law', 40, 0, 0, '', 'CHLDINLAW', '', 0, 0, 1, '', ''),
('personal_relationship', 'COUSN', 'Cousin', 50, 0, 0, '', 'COUSN', '', 0, 0, 1, '', ''),
('personal_relationship', 'DOMPART', 'Domestic Partner', 60, 0, 0, '', 'DOMPART', '', 0, 0, 1, '', ''),
('personal_relationship', 'FAMMEMB', 'Family Member', 70, 0, 0, '', 'FAMMEMB', '', 0, 0, 1, '', ''),
('personal_relationship', 'FRND', 'Unrelated Friend', 400, 0, 0, '', 'FRND', '', 0, 0, 1, '', ''),
('personal_relationship', 'GGRPRN', 'Great Grandparent', 120, 0, 0, '', 'GGRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'GPARNT', 'Grandparent', 100, 0, 0, '', 'GPARNT', '', 0, 0, 1, '', ''),
('personal_relationship', 'GRNDCHILD', 'Grandchild', 90, 0, 0, '', 'GRNDCHILD', '', 0, 0, 1, '', ''),
('personal_relationship', 'GRPRN', 'Grandparent', 110, 0, 0, '', 'GRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'HSIB', 'Half-Sibling', 130, 0, 0, '', 'HSIB', '', 0, 0, 1, '', ''),
('personal_relationship', 'MAUNT', 'MaternalAunt', 140, 0, 0, '', 'MAUNT', '', 0, 0, 1, '', ''),
('personal_relationship', 'MCOUSN', 'MaternalCousin', 150, 0, 0, '', 'MCOUSN', '', 0, 0, 1, '', ''),
('personal_relationship', 'MGGRPRN', 'MaternalGreatgrandparent', 170, 0, 0, '', 'MGGRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'MGRPRN', 'MaternalGrandparent', 160, 0, 0, '', 'MGRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'MUNCLE', 'MaternalUncle', 180, 0, 0, '', 'MUNCLE', '', 0, 0, 1, '', ''),
('personal_relationship', 'NBOR', 'Neighbor', 220, 0, 0, '', 'NBOR', '', 0, 0, 1, '', ''),
('personal_relationship', 'NCHILD', 'Natural Child', 190, 0, 0, '', 'NCHILD', '', 0, 0, 1, '', ''),
('personal_relationship', 'NIENEPH', 'Niece/Nephew', 230, 0, 0, '', 'NIENEPH', '', 0, 0, 1, '', ''),
('personal_relationship', 'NPRN', 'Natural Parent', 200, 0, 0, '', 'NPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'NSIB', 'Natural Sibling', 210, 0, 0, '', 'NSIB', '', 0, 0, 1, '', ''),
('personal_relationship', 'PAUNT', 'PaternalAunt', 260, 0, 0, '', 'PAUNT', '', 0, 0, 1, '', ''),
('personal_relationship', 'PCOUSN', 'PaternalCousin', 270, 0, 0, '', 'PCOUSN', '', 0, 0, 1, '', ''),
('personal_relationship', 'PGGRPRN', 'PaternalGreatgrandparent', 290, 0, 0, '', 'PGGRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'PGRPRN', 'PaternalGrandparent', 280, 0, 0, '', 'PGRPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'PRN', 'Parent', 240, 0, 0, '', 'PRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'PRNINLAW', 'parent in-law', 250, 0, 0, '', 'PRNINLAW', '', 0, 0, 1, '', ''),
('personal_relationship', 'PUNCLE', 'PaternalUncle', 300, 0, 0, '', 'PUNCLE', '', 0, 0, 1, '', ''),
('personal_relationship', 'ROOM', 'Roommate', 310, 0, 0, '', 'ROOM', '', 0, 0, 1, '', ''),
('personal_relationship', 'SIB', 'Sibling', 320, 0, 0, '', 'SIB', '', 0, 0, 1, '', ''),
('personal_relationship', 'SIBINLAW', 'Sibling in-law', 330, 0, 0, '', 'SIBINLAW', '', 0, 0, 1, '', ''),
('personal_relationship', 'SIGOTHR', 'Significant Other', 340, 0, 0, '', 'SIGOTHR', '', 0, 0, 1, '', ''),
('personal_relationship', 'SPS', 'Spouse', 350, 0, 0, '', 'SPS', '', 0, 0, 1, '', ''),
('personal_relationship', 'STEP', 'Step Child', 360, 0, 0, '', 'STEP', '', 0, 0, 1, '', ''),
('personal_relationship', 'STPPRN', 'Step Parent', 370, 0, 0, '', 'STPPRN', '', 0, 0, 1, '', ''),
('personal_relationship', 'STPSIB', 'Step Sibling', 380, 0, 0, '', 'STPSIB', '', 0, 0, 1, '', ''),
('personal_relationship', 'UNCLE', 'Uncle', 390, 0, 0, '', 'UNCLE', '', 0, 0, 1, '', ''),
('physician_type', 'attending_physician', 'Attending physician', 10, 0, 0, '', NULL, 'SNOMED-CT:405279007', 0, 0, 1, '', ''),
('physician_type', 'audiological_physician', 'Audiological physician', 20, 0, 0, '', NULL, 'SNOMED-CT:310172001', 0, 0, 1, '', ''),
('physician_type', 'chest_physician', 'Chest physician', 30, 0, 0, '', NULL, 'SNOMED-CT:309345004', 0, 0, 1, '', ''),
('physician_type', 'community_health_physician', 'Community health physician', 40, 0, 0, '', NULL, 'SNOMED-CT:23278007', 0, 0, 1, '', ''),
('physician_type', 'consultant_physician', 'Consultant physician', 50, 0, 0, '', NULL, 'SNOMED-CT:158967008', 0, 0, 1, '', ''),
('physician_type', 'general_physician', 'General physician', 60, 0, 0, '', NULL, 'SNOMED-CT:59058001', 0, 0, 1, '', ''),
('physician_type', 'genitourinarymedicinephysician', 'Genitourinary medicine physician', 70, 0, 0, '', NULL, 'SNOMED-CT:309358003', 0, 0, 1, '', ''),
('physician_type', 'occupational_physician', 'Occupational physician', 80, 0, 0, '', NULL, 'SNOMED-CT:158973009', 0, 0, 1, '', ''),
('physician_type', 'palliative_care_physician', 'Palliative care physician', 90, 0, 0, '', NULL, 'SNOMED-CT:309359006', 0, 0, 1, '', ''),
('physician_type', 'physician', 'Physician', 100, 0, 0, '', NULL, 'SNOMED-CT:309343006', 0, 0, 1, '', ''),
('physician_type', 'public_health_physician', 'Public health physician', 110, 0, 0, '', NULL, 'SNOMED-CT:56466003', 0, 0, 1, '', ''),
('physician_type', 'rehabilitation_physician', 'Rehabilitation physician', 120, 0, 0, '', NULL, 'SNOMED-CT:309360001', 0, 0, 1, '', ''),
('physician_type', 'resident_physician', 'Resident physician', 130, 0, 0, '', NULL, 'SNOMED-CT:405277009', 0, 0, 1, '', ''),
('physician_type', 'specialized_physician', 'Specialized physician', 140, 0, 0, '', NULL, 'SNOMED-CT:69280009', 0, 0, 1, '', ''),
('physician_type', 'thoracic_physician', 'Thoracic physician', 150, 0, 0, '', NULL, 'SNOMED-CT:309346003', 0, 0, 1, '', ''),
('pricelevel', 'standard', 'Standard', 1, 1, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_body_site', 'arm', 'Arm', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_body_site', 'buttock', 'Buttock', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_body_site', 'oth', 'Other', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_lat', 'bilat', 'Bilateral', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_lat', 'left', 'Left', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_lat', 'right', 'Right', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'cancel', 'Canceled', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'correct', 'Corrected', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'error', 'Error', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'final', 'Final', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'prelim', 'Preliminary', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_rep_status', 'review', 'Reviewed', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'high', 'High', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'low', 'Low', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'no', 'No', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'vhigh', 'Above upper panic limits', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'vlow', 'Below lower panic limits', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_abnormal', 'yes', 'Yes', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_bool', 'neg', 'Negative', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_bool', 'pos', 'Positive', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'cancel', 'Canceled', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'correct', 'Corrected', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'error', 'Error', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'final', 'Final', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'incomplete', 'Incomplete', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_res_status', 'prelim', 'Preliminary', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_route', 'inj', 'Injection', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_route', 'oral', 'Oral', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_route', 'oth', 'Other', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_specimen', 'blood', 'Blood', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_specimen', 'oth', 'Other', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_specimen', 'saliva', 'Saliva', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_specimen', 'urine', 'Urine', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_type', 'grp', 'Group', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_type', 'ord', 'Procedure Order', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_type', 'rec', 'Recommendation', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_type', 'res', 'Discrete Result', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'bool', 'Boolean', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'cu_mm', 'CU.MM', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'days', 'Days', 600, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'fl', 'FL', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'gm_dl', 'GM/DL', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'g_dl', 'G/DL', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'hmol_l', 'HMOL/L', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'iu_l', 'IU/L', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'mg_dl', 'MG/DL', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'mil_cu_mm', 'Mil/CU.MM', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'months', 'Months', 620, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'oth', 'Other', 990, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'percent', 'Percent', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'percentile', 'Percentile', 100, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'pg', 'PG', 110, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'ratio', 'Ratio', 120, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'thous_cu_mm', 'Thous/CU.MM', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'units', 'Units', 140, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'units_l', 'Units/L', 150, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('proc_unit', 'weeks', 'Weeks', 610, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('provider_qualifier_code', 'dk', 'DK', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('provider_qualifier_code', 'dn', 'DN', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('provider_qualifier_code', 'dq', 'DQ', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ptlistcols', 'DOB', 'Date of Birth', 50, 0, 3, '', '', '', 0, 0, 1, '', ''),
('ptlistcols', 'fname', 'First Name', 20, 0, 3, '', '', '', 0, 0, 1, '', ''),
('ptlistcols', 'lname', 'Last Name', 10, 0, 3, '', '', '', 0, 0, 1, '', ''),
('ptlistcols', 'phone_home', 'Home Phone', 30, 0, 3, '', '', '', 0, 0, 1, '', ''),
('ptlistcols', 'pid', 'Patient ID', 70, 0, 3, '', '', '', 0, 0, 1, '', ''),
('race', 'abenaki', 'Abenaki', 60, 0, 0, '', '1006-6', '', 0, 0, 0, '', ''),
('race', 'absentee_shawnee', 'Absentee Shawnee', 70, 0, 0, '', '1579-2', '', 0, 0, 0, '', ''),
('race', 'acoma', 'Acoma', 80, 0, 0, '', '1490-2', '', 0, 0, 0, '', ''),
('race', 'afghanistani', 'Afghanistani', 90, 0, 0, '', '2126-1', '', 0, 0, 0, '', ''),
('race', 'african', 'African', 100, 0, 0, '', '2060-2', '', 0, 0, 0, '', ''),
('race', 'african_american', 'African American', 110, 0, 0, '', '2058-6', '', 0, 0, 0, '', ''),
('race', 'agdaagux', 'Agdaagux', 120, 0, 0, '', '1994-3', '', 0, 0, 0, '', ''),
('race', 'agua_caliente', 'Agua Caliente', 130, 0, 0, '', '1212-0', '', 0, 0, 0, '', ''),
('race', 'agua_caliente_cahuilla', 'Agua Caliente Cahuilla', 140, 0, 0, '', '1045-4', '', 0, 0, 0, '', ''),
('race', 'ahtna', 'Ahtna', 150, 0, 0, '', '1740-0', '', 0, 0, 0, '', ''),
('race', 'ak-chin', 'Ak-Chin', 160, 0, 0, '', '1654-3', '', 0, 0, 0, '', ''),
('race', 'akhiok', 'Akhiok', 170, 0, 0, '', '1993-5', '', 0, 0, 0, '', ''),
('race', 'akiachak', 'Akiachak', 180, 0, 0, '', '1897-8', '', 0, 0, 0, '', ''),
('race', 'akiak', 'Akiak', 190, 0, 0, '', '1898-6', '', 0, 0, 0, '', ''),
('race', 'akutan', 'Akutan', 200, 0, 0, '', '2007-3', '', 0, 0, 0, '', ''),
('race', 'alabama_coushatta', 'Alabama Coushatta', 210, 0, 0, '', '1187-4', '', 0, 0, 0, '', ''),
('race', 'alabama_creek', 'Alabama Creek', 220, 0, 0, '', '1194-0', '', 0, 0, 0, '', ''),
('race', 'alabama_quassarte', 'Alabama Quassarte', 230, 0, 0, '', '1195-7', '', 0, 0, 0, '', ''),
('race', 'alakanuk', 'Alakanuk', 240, 0, 0, '', '1899-4', '', 0, 0, 0, '', ''),
('race', 'alamo_navajo', 'Alamo Navajo', 250, 0, 0, '', '1383-9', '', 0, 0, 0, '', ''),
('race', 'alanvik', 'Alanvik', 260, 0, 0, '', '1744-2', '', 0, 0, 0, '', ''),
('race', 'alaskan_athabascan', 'Alaskan Athabascan', 290, 0, 0, '', '1739-2', '', 0, 0, 0, '', ''),
('race', 'alaska_indian', 'Alaska Indian', 270, 0, 0, '', '1737-6', '', 0, 0, 0, '', ''),
('race', 'alaska_native', 'Alaska Native', 280, 0, 0, '', '1735-0', '', 0, 0, 0, '', ''),
('race', 'alatna', 'Alatna', 300, 0, 0, '', '1741-8', '', 0, 0, 0, '', ''),
('race', 'aleknagik', 'Aleknagik', 310, 0, 0, '', '1900-0', '', 0, 0, 0, '', ''),
('race', 'aleut', 'Aleut', 320, 0, 0, '', '1966-1', '', 0, 0, 0, '', ''),
('race', 'aleutian', 'Aleutian', 340, 0, 0, '', '2009-9', '', 0, 0, 0, '', ''),
('race', 'aleutian_islander', 'Aleutian Islander', 350, 0, 0, '', '2010-7', '', 0, 0, 0, '', ''),
('race', 'aleut_corporation', 'Aleut Corporation', 330, 0, 0, '', '2008-1', '', 0, 0, 0, '', ''),
('race', 'alexander', 'Alexander', 360, 0, 0, '', '1742-6', '', 0, 0, 0, '', ''),
('race', 'algonquian', 'Algonquian', 370, 0, 0, '', '1008-2', '', 0, 0, 0, '', ''),
('race', 'allakaket', 'Allakaket', 380, 0, 0, '', '1743-4', '', 0, 0, 0, '', ''),
('race', 'allen_canyon', 'Allen Canyon', 390, 0, 0, '', '1671-7', '', 0, 0, 0, '', ''),
('race', 'alpine', 'Alpine', 400, 0, 0, '', '1688-1', '', 0, 0, 0, '', ''),
('race', 'alsea', 'Alsea', 410, 0, 0, '', '1392-0', '', 0, 0, 0, '', ''),
('race', 'alutiiq_aleut', 'Alutiiq Aleut', 420, 0, 0, '', '1968-7', '', 0, 0, 0, '', ''),
('race', 'ambler', 'Ambler', 430, 0, 0, '', '1845-7', '', 0, 0, 0, '', ''),
('race', 'american_indian', 'American Indian', 440, 0, 0, '', '1004-1', '', 0, 0, 0, '', ''),
('race', 'amer_ind_or_alaska_native', 'American Indian or Alaska Native', 10, 0, 0, '', '1002-5', '', 0, 0, 1, '', ''),
('race', 'anaktuvuk', 'Anaktuvuk', 460, 0, 0, '', '1846-5', '', 0, 0, 0, '', ''),
('race', 'anaktuvuk_pass', 'Anaktuvuk Pass', 470, 0, 0, '', '1847-3', '', 0, 0, 0, '', ''),
('race', 'andreafsky', 'Andreafsky', 480, 0, 0, '', '1901-8', '', 0, 0, 0, '', ''),
('race', 'angoon', 'Angoon', 490, 0, 0, '', '1814-3', '', 0, 0, 0, '', ''),
('race', 'aniak', 'Aniak', 500, 0, 0, '', '1902-6', '', 0, 0, 0, '', ''),
('race', 'anvik', 'Anvik', 510, 0, 0, '', '1745-9', '', 0, 0, 0, '', ''),
('race', 'apache', 'Apache', 520, 0, 0, '', '1010-8', '', 0, 0, 0, '', ''),
('race', 'arab', 'Arab', 530, 0, 0, '', '2129-5', '', 0, 0, 0, '', ''),
('race', 'arapaho', 'Arapaho', 540, 0, 0, '', '1021-5', '', 0, 0, 0, '', ''),
('race', 'arctic', 'Arctic', 550, 0, 0, '', '1746-7', '', 0, 0, 0, '', ''),
('race', 'arctic_slope_corporation', 'Arctic Slope Corporation', 560, 0, 0, '', '1849-9', '', 0, 0, 0, '', ''),
('race', 'arctic_slope_inupiat', 'Arctic Slope Inupiat', 570, 0, 0, '', '1848-1', '', 0, 0, 0, '', ''),
('race', 'arikara', 'Arikara', 580, 0, 0, '', '1026-4', '', 0, 0, 0, '', ''),
('race', 'arizona_tewa', 'Arizona Tewa', 590, 0, 0, '', '1491-0', '', 0, 0, 0, '', ''),
('race', 'armenian', 'Armenian', 600, 0, 0, '', '2109-7', '', 0, 0, 0, '', ''),
('race', 'aroostook', 'Aroostook', 610, 0, 0, '', '1366-4', '', 0, 0, 0, '', ''),
('race', 'Asian', 'Asian', 20, 0, 0, '', '2028-9', '', 0, 0, 1, '', ''),
('race', 'asian_indian', 'Asian Indian', 630, 0, 0, '', '2029-7', '', 0, 0, 0, '', ''),
('race', 'assiniboine', 'Assiniboine', 640, 0, 0, '', '1028-0', '', 0, 0, 0, '', ''),
('race', 'assiniboine_sioux', 'Assiniboine Sioux', 650, 0, 0, '', '1030-6', '', 0, 0, 0, '', ''),
('race', 'assyrian', 'Assyrian', 660, 0, 0, '', '2119-6', '', 0, 0, 0, '', ''),
('race', 'atka', 'Atka', 670, 0, 0, '', '2011-5', '', 0, 0, 0, '', ''),
('race', 'atmautluak', 'Atmautluak', 680, 0, 0, '', '1903-4', '', 0, 0, 0, '', ''),
('race', 'atqasuk', 'Atqasuk', 690, 0, 0, '', '1850-7', '', 0, 0, 0, '', ''),
('race', 'atsina', 'Atsina', 700, 0, 0, '', '1265-8', '', 0, 0, 0, '', ''),
('race', 'attacapa', 'Attacapa', 710, 0, 0, '', '1234-4', '', 0, 0, 0, '', ''),
('race', 'augustine', 'Augustine', 720, 0, 0, '', '1046-2', '', 0, 0, 0, '', ''),
('race', 'bad_river', 'Bad River', 730, 0, 0, '', '1124-7', '', 0, 0, 0, '', ''),
('race', 'bahamian', 'Bahamian', 740, 0, 0, '', '2067-7', '', 0, 0, 0, '', ''),
('race', 'bangladeshi', 'Bangladeshi', 750, 0, 0, '', '2030-5', '', 0, 0, 0, '', ''),
('race', 'bannock', 'Bannock', 760, 0, 0, '', '1033-0', '', 0, 0, 0, '', ''),
('race', 'barbadian', 'Barbadian', 770, 0, 0, '', '2068-5', '', 0, 0, 0, '', ''),
('race', 'barrio_libre', 'Barrio Libre', 780, 0, 0, '', '1712-9', '', 0, 0, 0, '', ''),
('race', 'barrow', 'Barrow', 790, 0, 0, '', '1851-5', '', 0, 0, 0, '', ''),
('race', 'battle_mountain', 'Battle Mountain', 800, 0, 0, '', '1587-5', '', 0, 0, 0, '', ''),
('race', 'bay_mills_chippewa', 'Bay Mills Chippewa', 810, 0, 0, '', '1125-4', '', 0, 0, 0, '', ''),
('race', 'beaver', 'Beaver', 820, 0, 0, '', '1747-5', '', 0, 0, 0, '', ''),
('race', 'belkofski', 'Belkofski', 830, 0, 0, '', '2012-3', '', 0, 0, 0, '', ''),
('race', 'bering_straits_inupiat', 'Bering Straits Inupiat', 840, 0, 0, '', '1852-3', '', 0, 0, 0, '', ''),
('race', 'bethel', 'Bethel', 850, 0, 0, '', '1904-2', '', 0, 0, 0, '', ''),
('race', 'bhutanese', 'Bhutanese', 860, 0, 0, '', '2031-3', '', 0, 0, 0, '', ''),
('race', 'big_cypress', 'Big Cypress', 870, 0, 0, '', '1567-7', '', 0, 0, 0, '', ''),
('race', 'bill_moores_slough', 'Bill Moore\'s Slough', 880, 0, 0, '', '1905-9', '', 0, 0, 0, '', ''),
('race', 'biloxi', 'Biloxi', 890, 0, 0, '', '1235-1', '', 0, 0, 0, '', ''),
('race', 'birch_creek', 'Birch Creek', 900, 0, 0, '', '1748-3', '', 0, 0, 0, '', ''),
('race', 'bishop', 'Bishop', 910, 0, 0, '', '1417-5', '', 0, 0, 0, '', ''),
('race', 'black', 'Black', 920, 0, 0, '', '2056-0', '', 0, 0, 0, '', ''),
('race', 'blackfeet', 'Blackfeet', 940, 0, 0, '', '1035-5', '', 0, 0, 0, '', ''),
('race', 'blackfoot_sioux', 'Blackfoot Sioux', 950, 0, 0, '', '1610-5', '', 0, 0, 0, '', ''),
('race', 'black_or_afri_amer', 'Black or African American', 30, 0, 0, '', '2054-5', '', 0, 0, 1, '', ''),
('race', 'bois_forte', 'Bois Forte', 960, 0, 0, '', '1126-2', '', 0, 0, 0, '', ''),
('race', 'botswanan', 'Botswanan', 970, 0, 0, '', '2061-0', '', 0, 0, 0, '', ''),
('race', 'brevig_mission', 'Brevig Mission', 980, 0, 0, '', '1853-1', '', 0, 0, 0, '', ''),
('race', 'bridgeport', 'Bridgeport', 990, 0, 0, '', '1418-3', '', 0, 0, 0, '', ''),
('race', 'brighton', 'Brighton', 1000, 0, 0, '', '1568-5', '', 0, 0, 0, '', ''),
('race', 'bristol_bay_aleut', 'Bristol Bay Aleut', 1010, 0, 0, '', '1972-9', '', 0, 0, 0, '', ''),
('race', 'bristol_bay_yupik', 'Bristol Bay Yupik', 1020, 0, 0, '', '1906-7', '', 0, 0, 0, '', ''),
('race', 'brotherton', 'Brotherton', 1030, 0, 0, '', '1037-1', '', 0, 0, 0, '', ''),
('race', 'brule_sioux', 'Brule Sioux', 1040, 0, 0, '', '1611-3', '', 0, 0, 0, '', ''),
('race', 'buckland', 'Buckland', 1050, 0, 0, '', '1854-9', '', 0, 0, 0, '', ''),
('race', 'burmese', 'Burmese', 1060, 0, 0, '', '2032-1', '', 0, 0, 0, '', ''),
('race', 'burns_paiute', 'Burns Paiute', 1070, 0, 0, '', '1419-1', '', 0, 0, 0, '', ''),
('race', 'burt_lake_band', 'Burt Lake Band', 1080, 0, 0, '', '1039-7', '', 0, 0, 0, '', ''),
('race', 'burt_lake_chippewa', 'Burt Lake Chippewa', 1090, 0, 0, '', '1127-0', '', 0, 0, 0, '', ''),
('race', 'burt_lake_ottawa', 'Burt Lake Ottawa', 1100, 0, 0, '', '1412-6', '', 0, 0, 0, '', ''),
('race', 'cabazon', 'Cabazon', 1110, 0, 0, '', '1047-0', '', 0, 0, 0, '', ''),
('race', 'caddo', 'Caddo', 1120, 0, 0, '', '1041-3', '', 0, 0, 0, '', ''),
('race', 'cahto', 'Cahto', 1130, 0, 0, '', '1054-6', '', 0, 0, 0, '', ''),
('race', 'cahuilla', 'Cahuilla', 1140, 0, 0, '', '1044-7', '', 0, 0, 0, '', ''),
('race', 'california_tribes', 'California Tribes', 1150, 0, 0, '', '1053-8', '', 0, 0, 0, '', ''),
('race', 'calista_yupik', 'Calista Yupik', 1160, 0, 0, '', '1907-5', '', 0, 0, 0, '', ''),
('race', 'cambodian', 'Cambodian', 1170, 0, 0, '', '2033-9', '', 0, 0, 0, '', ''),
('race', 'campo', 'Campo', 1180, 0, 0, '', '1223-7', '', 0, 0, 0, '', ''),
('race', 'canadian_indian', 'Canadian Indian', 1200, 0, 0, '', '1069-4', '', 0, 0, 0, '', ''),
('race', 'canadian_latinamerican_indian', 'Canadian and Latin American Indian', 1190, 0, 0, '', '1068-6', '', 0, 0, 0, '', ''),
('race', 'canoncito_navajo', 'Canoncito Navajo', 1210, 0, 0, '', '1384-7', '', 0, 0, 0, '', ''),
('race', 'cantwell', 'Cantwell', 1220, 0, 0, '', '1749-1', '', 0, 0, 0, '', ''),
('race', 'capitan_grande', 'Capitan Grande', 1230, 0, 0, '', '1224-5', '', 0, 0, 0, '', ''),
('race', 'carolinian', 'Carolinian', 1240, 0, 0, '', '2092-5', '', 0, 0, 0, '', ''),
('race', 'carson', 'Carson', 1250, 0, 0, '', '1689-9', '', 0, 0, 0, '', ''),
('race', 'catawba', 'Catawba', 1260, 0, 0, '', '1076-9', '', 0, 0, 0, '', ''),
('race', 'cayuga', 'Cayuga', 1270, 0, 0, '', '1286-4', '', 0, 0, 0, '', ''),
('race', 'cayuse', 'Cayuse', 1280, 0, 0, '', '1078-5', '', 0, 0, 0, '', ''),
('race', 'cedarville', 'Cedarville', 1290, 0, 0, '', '1420-9', '', 0, 0, 0, '', ''),
('race', 'celilo', 'Celilo', 1300, 0, 0, '', '1393-8', '', 0, 0, 0, '', ''),
('race', 'central_american_indian', 'Central American Indian', 1310, 0, 0, '', '1070-2', '', 0, 0, 0, '', ''),
('race', 'central_pomo', 'Central Pomo', 1330, 0, 0, '', '1465-4', '', 0, 0, 0, '', ''),
('race', 'chalkyitsik', 'Chalkyitsik', 1340, 0, 0, '', '1750-9', '', 0, 0, 0, '', ''),
('race', 'chamorro', 'Chamorro', 1350, 0, 0, '', '2088-3', '', 0, 0, 0, '', ''),
('race', 'chefornak', 'Chefornak', 1360, 0, 0, '', '1908-3', '', 0, 0, 0, '', ''),
('race', 'chehalis', 'Chehalis', 1370, 0, 0, '', '1080-1', '', 0, 0, 0, '', ''),
('race', 'chemakuan', 'Chemakuan', 1380, 0, 0, '', '1082-7', '', 0, 0, 0, '', ''),
('race', 'chemehuevi', 'Chemehuevi', 1390, 0, 0, '', '1086-8', '', 0, 0, 0, '', ''),
('race', 'chenega', 'Chenega', 1400, 0, 0, '', '1985-1', '', 0, 0, 0, '', ''),
('race', 'cherokee', 'Cherokee', 1410, 0, 0, '', '1088-4', '', 0, 0, 0, '', ''),
('race', 'cherokees_of_northeast_alabama', 'Cherokees of Northeast Alabama', 1440, 0, 0, '', '1090-0', '', 0, 0, 0, '', ''),
('race', 'cherokees_of_southeast_alabama', 'Cherokees of Southeast Alabama', 1450, 0, 0, '', '1091-8', '', 0, 0, 0, '', ''),
('race', 'cherokee_alabama', 'Cherokee Alabama', 1420, 0, 0, '', '1089-2', '', 0, 0, 0, '', ''),
('race', 'cherokee_shawnee', 'Cherokee Shawnee', 1430, 0, 0, '', '1100-7', '', 0, 0, 0, '', ''),
('race', 'chevak', 'Chevak', 1460, 0, 0, '', '1909-1', '', 0, 0, 0, '', ''),
('race', 'cheyenne', 'Cheyenne', 1470, 0, 0, '', '1102-3', '', 0, 0, 0, '', ''),
('race', 'cheyenne-arapaho', 'Cheyenne-Arapaho', 1490, 0, 0, '', '1106-4', '', 0, 0, 0, '', ''),
('race', 'cheyenne_river_sioux', 'Cheyenne River Sioux', 1480, 0, 0, '', '1612-1', '', 0, 0, 0, '', ''),
('race', 'chickahominy', 'Chickahominy', 1500, 0, 0, '', '1108-0', '', 0, 0, 0, '', ''),
('race', 'chickaloon', 'Chickaloon', 1510, 0, 0, '', '1751-7', '', 0, 0, 0, '', ''),
('race', 'chickasaw', 'Chickasaw', 1520, 0, 0, '', '1112-2', '', 0, 0, 0, '', ''),
('race', 'chignik', 'Chignik', 1530, 0, 0, '', '1973-7', '', 0, 0, 0, '', ''),
('race', 'chignik_lagoon', 'Chignik Lagoon', 1540, 0, 0, '', '2013-1', '', 0, 0, 0, '', ''),
('race', 'chignik_lake', 'Chignik Lake', 1550, 0, 0, '', '1974-5', '', 0, 0, 0, '', ''),
('race', 'chilkat', 'Chilkat', 1560, 0, 0, '', '1816-8', '', 0, 0, 0, '', ''),
('race', 'chilkoot', 'Chilkoot', 1570, 0, 0, '', '1817-6', '', 0, 0, 0, '', ''),
('race', 'chimariko', 'Chimariko', 1580, 0, 0, '', '1055-3', '', 0, 0, 0, '', ''),
('race', 'chinese', 'Chinese', 1590, 0, 0, '', '2034-7', '', 0, 0, 0, '', ''),
('race', 'chinik', 'Chinik', 1600, 0, 0, '', '1855-6', '', 0, 0, 0, '', ''),
('race', 'chinook', 'Chinook', 1610, 0, 0, '', '1114-8', '', 0, 0, 0, '', ''),
('race', 'chippewa', 'Chippewa', 1620, 0, 0, '', '1123-9', '', 0, 0, 0, '', ''),
('race', 'chippewa_cree', 'Chippewa Cree', 1630, 0, 0, '', '1150-2', '', 0, 0, 0, '', ''),
('race', 'chiricahua', 'Chiricahua', 1640, 0, 0, '', '1011-6', '', 0, 0, 0, '', ''),
('race', 'chistochina', 'Chistochina', 1650, 0, 0, '', '1752-5', '', 0, 0, 0, '', ''),
('race', 'chitimacha', 'Chitimacha', 1660, 0, 0, '', '1153-6', '', 0, 0, 0, '', ''),
('race', 'chitina', 'Chitina', 1670, 0, 0, '', '1753-3', '', 0, 0, 0, '', ''),
('race', 'choctaw', 'Choctaw', 1680, 0, 0, '', '1155-1', '', 0, 0, 0, '', ''),
('race', 'chuathbaluk', 'Chuathbaluk', 1690, 0, 0, '', '1910-9', '', 0, 0, 0, '', ''),
('race', 'chugach_aleut', 'Chugach Aleut', 1700, 0, 0, '', '1984-4', '', 0, 0, 0, '', ''),
('race', 'chugach_corporation', 'Chugach Corporation', 1710, 0, 0, '', '1986-9', '', 0, 0, 0, '', ''),
('race', 'chukchansi', 'Chukchansi', 1720, 0, 0, '', '1718-6', '', 0, 0, 0, '', ''),
('race', 'chumash', 'Chumash', 1730, 0, 0, '', '1162-7', '', 0, 0, 0, '', ''),
('race', 'chuukese', 'Chuukese', 1740, 0, 0, '', '2097-4', '', 0, 0, 0, '', ''),
('race', 'circle', 'Circle', 1750, 0, 0, '', '1754-1', '', 0, 0, 0, '', ''),
('race', 'citizen_band_potawatomi', 'Citizen Band Potawatomi', 1760, 0, 0, '', '1479-5', '', 0, 0, 0, '', ''),
('race', 'clarks_point', 'Clark\'s Point', 1770, 0, 0, '', '1911-7', '', 0, 0, 0, '', ''),
('race', 'clatsop', 'Clatsop', 1780, 0, 0, '', '1115-5', '', 0, 0, 0, '', ''),
('race', 'clear_lake', 'Clear Lake', 1790, 0, 0, '', '1165-0', '', 0, 0, 0, '', ''),
('race', 'clifton_choctaw', 'Clifton Choctaw', 1800, 0, 0, '', '1156-9', '', 0, 0, 0, '', ''),
('race', 'coast_miwok', 'Coast Miwok', 1810, 0, 0, '', '1056-1', '', 0, 0, 0, '', ''),
('race', 'coast_yurok', 'Coast Yurok', 1820, 0, 0, '', '1733-5', '', 0, 0, 0, '', ''),
('race', 'cochiti', 'Cochiti', 1830, 0, 0, '', '1492-8', '', 0, 0, 0, '', ''),
('race', 'cocopah', 'Cocopah', 1840, 0, 0, '', '1725-1', '', 0, 0, 0, '', ''),
('race', 'coeur_dalene', 'Coeur D\'Alene', 1850, 0, 0, '', '1167-6', '', 0, 0, 0, '', ''),
('race', 'coharie', 'Coharie', 1860, 0, 0, '', '1169-2', '', 0, 0, 0, '', ''),
('race', 'colorado_river', 'Colorado River', 1870, 0, 0, '', '1171-8', '', 0, 0, 0, '', ''),
('race', 'columbia', 'Columbia', 1880, 0, 0, '', '1394-6', '', 0, 0, 0, '', ''),
('race', 'columbia_river_chinook', 'Columbia River Chinook', 1890, 0, 0, '', '1116-3', '', 0, 0, 0, '', ''),
('race', 'colville', 'Colville', 1900, 0, 0, '', '1173-4', '', 0, 0, 0, '', ''),
('race', 'comanche', 'Comanche', 1910, 0, 0, '', '1175-9', '', 0, 0, 0, '', ''),
('race', 'cook_inlet', 'Cook Inlet', 1920, 0, 0, '', '1755-8', '', 0, 0, 0, '', ''),
('race', 'coos', 'Coos', 1930, 0, 0, '', '1180-9', '', 0, 0, 0, '', ''),
('race', 'coos_lower_umpqua_siuslaw', 'Coos, Lower Umpqua, Siuslaw', 1940, 0, 0, '', '1178-3', '', 0, 0, 0, '', ''),
('race', 'copper_center', 'Copper Center', 1950, 0, 0, '', '1756-6', '', 0, 0, 0, '', ''),
('race', 'copper_river', 'Copper River', 1960, 0, 0, '', '1757-4', '', 0, 0, 0, '', ''),
('race', 'coquilles', 'Coquilles', 1970, 0, 0, '', '1182-5', '', 0, 0, 0, '', ''),
('race', 'costanoan', 'Costanoan', 1980, 0, 0, '', '1184-1', '', 0, 0, 0, '', ''),
('race', 'council', 'Council', 1990, 0, 0, '', '1856-4', '', 0, 0, 0, '', ''),
('race', 'coushatta', 'Coushatta', 2000, 0, 0, '', '1186-6', '', 0, 0, 0, '', ''),
('race', 'cowlitz', 'Cowlitz', 2020, 0, 0, '', '1189-0', '', 0, 0, 0, '', ''),
('race', 'cow_creek_umpqua', 'Cow Creek Umpqua', 2010, 0, 0, '', '1668-3', '', 0, 0, 0, '', ''),
('race', 'craig', 'Craig', 2030, 0, 0, '', '1818-4', '', 0, 0, 0, '', ''),
('race', 'cree', 'Cree', 2040, 0, 0, '', '1191-6', '', 0, 0, 0, '', ''),
('race', 'creek', 'Creek', 2050, 0, 0, '', '1193-2', '', 0, 0, 0, '', ''),
('race', 'croatan', 'Croatan', 2060, 0, 0, '', '1207-0', '', 0, 0, 0, '', ''),
('race', 'crooked_creek', 'Crooked Creek', 2070, 0, 0, '', '1912-5', '', 0, 0, 0, '', ''),
('race', 'crow', 'Crow', 2080, 0, 0, '', '1209-6', '', 0, 0, 0, '', ''),
('race', 'crow_creek_sioux', 'Crow Creek Sioux', 2090, 0, 0, '', '1613-9', '', 0, 0, 0, '', ''),
('race', 'cupeno', 'Cupeno', 2100, 0, 0, '', '1211-2', '', 0, 0, 0, '', ''),
('race', 'cuyapaipe', 'Cuyapaipe', 2110, 0, 0, '', '1225-2', '', 0, 0, 0, '', ''),
('race', 'dakota_sioux', 'Dakota Sioux', 2120, 0, 0, '', '1614-7', '', 0, 0, 0, '', ''),
('race', 'declne_to_specfy', 'Declined To Specify', 0, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('race', 'deering', 'Deering', 2130, 0, 0, '', '1857-2', '', 0, 0, 0, '', ''),
('race', 'delaware', 'Delaware', 2140, 0, 0, '', '1214-6', '', 0, 0, 0, '', ''),
('race', 'diegueno', 'Diegueno', 2150, 0, 0, '', '1222-9', '', 0, 0, 0, '', ''),
('race', 'digger', 'Digger', 2160, 0, 0, '', '1057-9', '', 0, 0, 0, '', ''),
('race', 'dillingham', 'Dillingham', 2170, 0, 0, '', '1913-3', '', 0, 0, 0, '', ''),
('race', 'dominican', 'Dominican', 2190, 0, 0, '', '2069-3', '', 0, 0, 0, '', ''),
('race', 'dominica_islander', 'Dominica Islander', 2180, 0, 0, '', '2070-1', '', 0, 0, 0, '', ''),
('race', 'dot_lake', 'Dot Lake', 2200, 0, 0, '', '1758-2', '', 0, 0, 0, '', ''),
('race', 'douglas', 'Douglas', 2210, 0, 0, '', '1819-2', '', 0, 0, 0, '', ''),
('race', 'doyon', 'Doyon', 2220, 0, 0, '', '1759-0', '', 0, 0, 0, '', ''),
('race', 'dresslerville', 'Dresslerville', 2230, 0, 0, '', '1690-7', '', 0, 0, 0, '', ''),
('race', 'dry_creek', 'Dry Creek', 2240, 0, 0, '', '1466-2', '', 0, 0, 0, '', ''),
('race', 'duckwater', 'Duckwater', 2260, 0, 0, '', '1588-3', '', 0, 0, 0, '', ''),
('race', 'duck_valley', 'Duck Valley', 2250, 0, 0, '', '1603-0', '', 0, 0, 0, '', ''),
('race', 'duwamish', 'Duwamish', 2270, 0, 0, '', '1519-8', '', 0, 0, 0, '', ''),
('race', 'eagle', 'Eagle', 2280, 0, 0, '', '1760-8', '', 0, 0, 0, '', ''),
('race', 'eastern_cherokee', 'Eastern Cherokee', 2290, 0, 0, '', '1092-6', '', 0, 0, 0, '', ''),
('race', 'eastern_chickahominy', 'Eastern Chickahominy', 2300, 0, 0, '', '1109-8', '', 0, 0, 0, '', ''),
('race', 'eastern_creek', 'Eastern Creek', 2310, 0, 0, '', '1196-5', '', 0, 0, 0, '', ''),
('race', 'eastern_delaware', 'Eastern Delaware', 2320, 0, 0, '', '1215-3', '', 0, 0, 0, '', ''),
('race', 'eastern_muscogee', 'Eastern Muscogee', 2330, 0, 0, '', '1197-3', '', 0, 0, 0, '', ''),
('race', 'eastern_pomo', 'Eastern Pomo', 2340, 0, 0, '', '1467-0', '', 0, 0, 0, '', ''),
('race', 'eastern_shawnee', 'Eastern Shawnee', 2350, 0, 0, '', '1580-0', '', 0, 0, 0, '', ''),
('race', 'eastern_tribes', 'Eastern Tribes', 2360, 0, 0, '', '1233-6', '', 0, 0, 0, '', ''),
('race', 'echota_cherokee', 'Echota Cherokee', 2370, 0, 0, '', '1093-4', '', 0, 0, 0, '', ''),
('race', 'eek', 'Eek', 2380, 0, 0, '', '1914-1', '', 0, 0, 0, '', ''),
('race', 'egegik', 'Egegik', 2390, 0, 0, '', '1975-2', '', 0, 0, 0, '', ''),
('race', 'egyptian', 'Egyptian', 2400, 0, 0, '', '2120-4', '', 0, 0, 0, '', ''),
('race', 'eklutna', 'Eklutna', 2410, 0, 0, '', '1761-6', '', 0, 0, 0, '', ''),
('race', 'ekuk', 'Ekuk', 2420, 0, 0, '', '1915-8', '', 0, 0, 0, '', ''),
('race', 'ekwok', 'Ekwok', 2430, 0, 0, '', '1916-6', '', 0, 0, 0, '', ''),
('race', 'elim', 'Elim', 2440, 0, 0, '', '1858-0', '', 0, 0, 0, '', ''),
('race', 'elko', 'Elko', 2450, 0, 0, '', '1589-1', '', 0, 0, 0, '', ''),
('race', 'ely', 'Ely', 2460, 0, 0, '', '1590-9', '', 0, 0, 0, '', ''),
('race', 'emmonak', 'Emmonak', 2470, 0, 0, '', '1917-4', '', 0, 0, 0, '', ''),
('race', 'english', 'English', 2480, 0, 0, '', '2110-5', '', 0, 0, 0, '', ''),
('race', 'english_bay', 'English Bay', 2490, 0, 0, '', '1987-7', '', 0, 0, 0, '', ''),
('race', 'eskimo', 'Eskimo', 2500, 0, 0, '', '1840-8', '', 0, 0, 0, '', ''),
('race', 'esselen', 'Esselen', 2510, 0, 0, '', '1250-0', '', 0, 0, 0, '', ''),
('race', 'ethiopian', 'Ethiopian', 2520, 0, 0, '', '2062-8', '', 0, 0, 0, '', ''),
('race', 'etowah_cherokee', 'Etowah Cherokee', 2530, 0, 0, '', '1094-2', '', 0, 0, 0, '', ''),
('race', 'european', 'European', 2540, 0, 0, '', '2108-9', '', 0, 0, 0, '', ''),
('race', 'evansville', 'Evansville', 2550, 0, 0, '', '1762-4', '', 0, 0, 0, '', ''),
('race', 'eyak', 'Eyak', 2560, 0, 0, '', '1990-1', '', 0, 0, 0, '', ''),
('race', 'fallon', 'Fallon', 2570, 0, 0, '', '1604-8', '', 0, 0, 0, '', ''),
('race', 'false_pass', 'False Pass', 2580, 0, 0, '', '2015-6', '', 0, 0, 0, '', ''),
('race', 'fijian', 'Fijian', 2590, 0, 0, '', '2101-4', '', 0, 0, 0, '', ''),
('race', 'filipino', 'Filipino', 2600, 0, 0, '', '2036-2', '', 0, 0, 0, '', ''),
('race', 'flandreau_santee', 'Flandreau Santee', 2610, 0, 0, '', '1615-4', '', 0, 0, 0, '', ''),
('race', 'florida_seminole', 'Florida Seminole', 2620, 0, 0, '', '1569-3', '', 0, 0, 0, '', ''),
('race', 'fond_du_lac', 'Fond du Lac', 2630, 0, 0, '', '1128-8', '', 0, 0, 0, '', ''),
('race', 'forest_county', 'Forest County', 2640, 0, 0, '', '1480-3', '', 0, 0, 0, '', ''),
('race', 'fort_belknap', 'Fort Belknap', 2650, 0, 0, '', '1252-6', '', 0, 0, 0, '', ''),
('race', 'fort_berthold', 'Fort Berthold', 2660, 0, 0, '', '1254-2', '', 0, 0, 0, '', ''),
('race', 'fort_bidwell', 'Fort Bidwell', 2670, 0, 0, '', '1421-7', '', 0, 0, 0, '', ''),
('race', 'fort_hall', 'Fort Hall', 2680, 0, 0, '', '1258-3', '', 0, 0, 0, '', ''),
('race', 'fort_independence', 'Fort Independence', 2690, 0, 0, '', '1422-5', '', 0, 0, 0, '', ''),
('race', 'fort_mcdermitt', 'Fort McDermitt', 2700, 0, 0, '', '1605-5', '', 0, 0, 0, '', ''),
('race', 'fort_mcdowell', 'Fort Mcdowell', 2710, 0, 0, '', '1256-7', '', 0, 0, 0, '', ''),
('race', 'fort_peck', 'Fort Peck', 2720, 0, 0, '', '1616-2', '', 0, 0, 0, '', ''),
('race', 'fort_peck_assiniboine_sioux', 'Fort Peck Assiniboine Sioux', 2730, 0, 0, '', '1031-4', '', 0, 0, 0, '', ''),
('race', 'fort_sill_apache', 'Fort Sill Apache', 2740, 0, 0, '', '1012-4', '', 0, 0, 0, '', ''),
('race', 'fort_yukon', 'Fort Yukon', 2750, 0, 0, '', '1763-2', '', 0, 0, 0, '', ''),
('race', 'french', 'French', 2760, 0, 0, '', '2111-3', '', 0, 0, 0, '', ''),
('race', 'french_american_indian', 'French American Indian', 2770, 0, 0, '', '1071-0', '', 0, 0, 0, '', ''),
('race', 'gabrieleno', 'Gabrieleno', 2780, 0, 0, '', '1260-9', '', 0, 0, 0, '', ''),
('race', 'gakona', 'Gakona', 2790, 0, 0, '', '1764-0', '', 0, 0, 0, '', ''),
('race', 'galena', 'Galena', 2800, 0, 0, '', '1765-7', '', 0, 0, 0, '', ''),
('race', 'gambell', 'Gambell', 2810, 0, 0, '', '1892-9', '', 0, 0, 0, '', ''),
('race', 'gay_head_wampanoag', 'Gay Head Wampanoag', 2820, 0, 0, '', '1680-8', '', 0, 0, 0, '', ''),
('race', 'georgetown_eastern_tribes', 'Georgetown (Eastern Tribes)', 2830, 0, 0, '', '1236-9', '', 0, 0, 0, '', ''),
('race', 'georgetown_yupik-eskimo', 'Georgetown (Yupik-Eskimo)', 2840, 0, 0, '', '1962-0', '', 0, 0, 0, '', ''),
('race', 'german', 'German', 2850, 0, 0, '', '2112-1', '', 0, 0, 0, '', ''),
('race', 'gila_bend', 'Gila Bend', 2860, 0, 0, '', '1655-0', '', 0, 0, 0, '', ''),
('race', 'gila_river_pima-maricopa', 'Gila River Pima-Maricopa', 2870, 0, 0, '', '1457-1', '', 0, 0, 0, '', ''),
('race', 'golovin', 'Golovin', 2880, 0, 0, '', '1859-8', '', 0, 0, 0, '', ''),
('race', 'goodnews_bay', 'Goodnews Bay', 2890, 0, 0, '', '1918-2', '', 0, 0, 0, '', ''),
('race', 'goshute', 'Goshute', 2900, 0, 0, '', '1591-7', '', 0, 0, 0, '', ''),
('race', 'grand_portage', 'Grand Portage', 2910, 0, 0, '', '1129-6', '', 0, 0, 0, '', ''),
('race', 'grand_ronde', 'Grand Ronde', 2920, 0, 0, '', '1262-5', '', 0, 0, 0, '', ''),
('race', 'grand_traverse_band', 'Grand Traverse Band of Ottawa/Chippewa', 2930, 0, 0, '', '1130-4', '', 0, 0, 0, '', ''),
('race', 'grayling', 'Grayling', 2940, 0, 0, '', '1766-5', '', 0, 0, 0, '', ''),
('race', 'greenland_eskimo', 'Greenland Eskimo', 2950, 0, 0, '', '1842-4', '', 0, 0, 0, '', ''),
('race', 'gros_ventres', 'Gros Ventres', 2960, 0, 0, '', '1264-1', '', 0, 0, 0, '', ''),
('race', 'guamanian', 'Guamanian', 2970, 0, 0, '', '2087-5', '', 0, 0, 0, '', ''),
('race', 'guamanian_or_chamorro', 'Guamanian or Chamorro', 2980, 0, 0, '', '2086-7', '', 0, 0, 0, '', ''),
('race', 'gulkana', 'Gulkana', 2990, 0, 0, '', '1767-3', '', 0, 0, 0, '', ''),
('race', 'haida', 'Haida', 3000, 0, 0, '', '1820-0', '', 0, 0, 0, '', ''),
('race', 'haitian', 'Haitian', 3010, 0, 0, '', '2071-9', '', 0, 0, 0, '', ''),
('race', 'haliwa', 'Haliwa', 3020, 0, 0, '', '1267-4', '', 0, 0, 0, '', ''),
('race', 'hannahville', 'Hannahville', 3030, 0, 0, '', '1481-1', '', 0, 0, 0, '', ''),
('race', 'havasupai', 'Havasupai', 3040, 0, 0, '', '1726-9', '', 0, 0, 0, '', ''),
('race', 'healy_lake', 'Healy Lake', 3050, 0, 0, '', '1768-1', '', 0, 0, 0, '', ''),
('race', 'hidatsa', 'Hidatsa', 3060, 0, 0, '', '1269-0', '', 0, 0, 0, '', ''),
('race', 'hmong', 'Hmong', 3070, 0, 0, '', '2037-0', '', 0, 0, 0, '', ''),
('race', 'ho-chunk', 'Ho-chunk', 3080, 0, 0, '', '1697-2', '', 0, 0, 0, '', ''),
('race', 'hoh', 'Hoh', 3090, 0, 0, '', '1083-5', '', 0, 0, 0, '', ''),
('race', 'hollywood_seminole', 'Hollywood Seminole', 3100, 0, 0, '', '1570-1', '', 0, 0, 0, '', ''),
('race', 'holy_cross', 'Holy Cross', 3110, 0, 0, '', '1769-9', '', 0, 0, 0, '', ''),
('race', 'hoonah', 'Hoonah', 3120, 0, 0, '', '1821-8', '', 0, 0, 0, '', ''),
('race', 'hoopa', 'Hoopa', 3130, 0, 0, '', '1271-6', '', 0, 0, 0, '', ''),
('race', 'hoopa_extension', 'Hoopa Extension', 3140, 0, 0, '', '1275-7', '', 0, 0, 0, '', ''),
('race', 'hooper_bay', 'Hooper Bay', 3150, 0, 0, '', '1919-0', '', 0, 0, 0, '', ''),
('race', 'hopi', 'Hopi', 3160, 0, 0, '', '1493-6', '', 0, 0, 0, '', ''),
('race', 'houma', 'Houma', 3170, 0, 0, '', '1277-3', '', 0, 0, 0, '', ''),
('race', 'hualapai', 'Hualapai', 3180, 0, 0, '', '1727-7', '', 0, 0, 0, '', ''),
('race', 'hughes', 'Hughes', 3190, 0, 0, '', '1770-7', '', 0, 0, 0, '', ''),
('race', 'huron_potawatomi', 'Huron Potawatomi', 3200, 0, 0, '', '1482-9', '', 0, 0, 0, '', ''),
('race', 'huslia', 'Huslia', 3210, 0, 0, '', '1771-5', '', 0, 0, 0, '', ''),
('race', 'hydaburg', 'Hydaburg', 3220, 0, 0, '', '1822-6', '', 0, 0, 0, '', ''),
('race', 'igiugig', 'Igiugig', 3230, 0, 0, '', '1976-0', '', 0, 0, 0, '', ''),
('race', 'iliamna', 'Iliamna', 3240, 0, 0, '', '1772-3', '', 0, 0, 0, '', ''),
('race', 'illinois_miami', 'Illinois Miami', 3250, 0, 0, '', '1359-9', '', 0, 0, 0, '', ''),
('race', 'inaja-cosmit', 'Inaja-Cosmit', 3260, 0, 0, '', '1279-9', '', 0, 0, 0, '', ''),
('race', 'inalik_diomede', 'Inalik Diomede', 3270, 0, 0, '', '1860-6', '', 0, 0, 0, '', ''),
('race', 'indiana_miami', 'Indiana Miami', 3290, 0, 0, '', '1360-7', '', 0, 0, 0, '', ''),
('race', 'indian_township', 'Indian Township', 3280, 0, 0, '', '1442-3', '', 0, 0, 0, '', ''),
('race', 'indonesian', 'Indonesian', 3300, 0, 0, '', '2038-8', '', 0, 0, 0, '', ''),
('race', 'inupiaq', 'Inupiaq', 3310, 0, 0, '', '1861-4', '', 0, 0, 0, '', ''),
('race', 'inupiat_eskimo', 'Inupiat Eskimo', 3320, 0, 0, '', '1844-0', '', 0, 0, 0, '', ''),
('race', 'iowa', 'Iowa', 3330, 0, 0, '', '1281-5', '', 0, 0, 0, '', '');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`, `subtype`, `list_options_icon`) VALUES
('race', 'iowa_of_kansas-nebraska', 'Iowa of Kansas-Nebraska', 3340, 0, 0, '', '1282-3', '', 0, 0, 0, '', ''),
('race', 'iowa_of_oklahoma', 'Iowa of Oklahoma', 3350, 0, 0, '', '1283-1', '', 0, 0, 0, '', ''),
('race', 'iowa_sac_and_fox', 'Iowa Sac and Fox', 3360, 0, 0, '', '1552-9', '', 0, 0, 0, '', ''),
('race', 'iqurmuit_russian_mission', 'Iqurmuit (Russian Mission)', 3370, 0, 0, '', '1920-8', '', 0, 0, 0, '', ''),
('race', 'iranian', 'Iranian', 3380, 0, 0, '', '2121-2', '', 0, 0, 0, '', ''),
('race', 'iraqi', 'Iraqi', 3390, 0, 0, '', '2122-0', '', 0, 0, 0, '', ''),
('race', 'irish', 'Irish', 3400, 0, 0, '', '2113-9', '', 0, 0, 0, '', ''),
('race', 'iroquois', 'Iroquois', 3410, 0, 0, '', '1285-6', '', 0, 0, 0, '', ''),
('race', 'isleta', 'Isleta', 3420, 0, 0, '', '1494-4', '', 0, 0, 0, '', ''),
('race', 'israeili', 'Israeili', 3430, 0, 0, '', '2127-9', '', 0, 0, 0, '', ''),
('race', 'italian', 'Italian', 3440, 0, 0, '', '2114-7', '', 0, 0, 0, '', ''),
('race', 'ivanof_bay', 'Ivanof Bay', 3450, 0, 0, '', '1977-8', '', 0, 0, 0, '', ''),
('race', 'iwo_jiman', 'Iwo Jiman', 3460, 0, 0, '', '2048-7', '', 0, 0, 0, '', ''),
('race', 'jamaican', 'Jamaican', 3470, 0, 0, '', '2072-7', '', 0, 0, 0, '', ''),
('race', 'jamestown', 'Jamestown', 3480, 0, 0, '', '1313-6', '', 0, 0, 0, '', ''),
('race', 'japanese', 'Japanese', 3490, 0, 0, '', '2039-6', '', 0, 0, 0, '', ''),
('race', 'jemez', 'Jemez', 3500, 0, 0, '', '1495-1', '', 0, 0, 0, '', ''),
('race', 'jena_choctaw', 'Jena Choctaw', 3510, 0, 0, '', '1157-7', '', 0, 0, 0, '', ''),
('race', 'jicarilla_apache', 'Jicarilla Apache', 3520, 0, 0, '', '1013-2', '', 0, 0, 0, '', ''),
('race', 'juaneno', 'Juaneno', 3530, 0, 0, '', '1297-1', '', 0, 0, 0, '', ''),
('race', 'kaibab', 'Kaibab', 3540, 0, 0, '', '1423-3', '', 0, 0, 0, '', ''),
('race', 'kake', 'Kake', 3550, 0, 0, '', '1823-4', '', 0, 0, 0, '', ''),
('race', 'kaktovik', 'Kaktovik', 3560, 0, 0, '', '1862-2', '', 0, 0, 0, '', ''),
('race', 'kalapuya', 'Kalapuya', 3570, 0, 0, '', '1395-3', '', 0, 0, 0, '', ''),
('race', 'kalispel', 'Kalispel', 3580, 0, 0, '', '1299-7', '', 0, 0, 0, '', ''),
('race', 'kalskag', 'Kalskag', 3590, 0, 0, '', '1921-6', '', 0, 0, 0, '', ''),
('race', 'kaltag', 'Kaltag', 3600, 0, 0, '', '1773-1', '', 0, 0, 0, '', ''),
('race', 'karluk', 'Karluk', 3610, 0, 0, '', '1995-0', '', 0, 0, 0, '', ''),
('race', 'karuk', 'Karuk', 3620, 0, 0, '', '1301-1', '', 0, 0, 0, '', ''),
('race', 'kasaan', 'Kasaan', 3630, 0, 0, '', '1824-2', '', 0, 0, 0, '', ''),
('race', 'kashia', 'Kashia', 3640, 0, 0, '', '1468-8', '', 0, 0, 0, '', ''),
('race', 'kasigluk', 'Kasigluk', 3650, 0, 0, '', '1922-4', '', 0, 0, 0, '', ''),
('race', 'kathlamet', 'Kathlamet', 3660, 0, 0, '', '1117-1', '', 0, 0, 0, '', ''),
('race', 'kaw', 'Kaw', 3670, 0, 0, '', '1303-7', '', 0, 0, 0, '', ''),
('race', 'kawaiisu', 'Kawaiisu', 3680, 0, 0, '', '1058-7', '', 0, 0, 0, '', ''),
('race', 'kawerak', 'Kawerak', 3690, 0, 0, '', '1863-0', '', 0, 0, 0, '', ''),
('race', 'kenaitze', 'Kenaitze', 3700, 0, 0, '', '1825-9', '', 0, 0, 0, '', ''),
('race', 'keres', 'Keres', 3710, 0, 0, '', '1496-9', '', 0, 0, 0, '', ''),
('race', 'kern_river', 'Kern River', 3720, 0, 0, '', '1059-5', '', 0, 0, 0, '', ''),
('race', 'ketchikan', 'Ketchikan', 3730, 0, 0, '', '1826-7', '', 0, 0, 0, '', ''),
('race', 'keweenaw', 'Keweenaw', 3740, 0, 0, '', '1131-2', '', 0, 0, 0, '', ''),
('race', 'kialegee', 'Kialegee', 3750, 0, 0, '', '1198-1', '', 0, 0, 0, '', ''),
('race', 'kiana', 'Kiana', 3760, 0, 0, '', '1864-8', '', 0, 0, 0, '', ''),
('race', 'kickapoo', 'Kickapoo', 3770, 0, 0, '', '1305-2', '', 0, 0, 0, '', ''),
('race', 'kikiallus', 'Kikiallus', 3780, 0, 0, '', '1520-6', '', 0, 0, 0, '', ''),
('race', 'king_cove', 'King Cove', 3790, 0, 0, '', '2014-9', '', 0, 0, 0, '', ''),
('race', 'king_salmon', 'King Salmon', 3800, 0, 0, '', '1978-6', '', 0, 0, 0, '', ''),
('race', 'kiowa', 'Kiowa', 3810, 0, 0, '', '1309-4', '', 0, 0, 0, '', ''),
('race', 'kipnuk', 'Kipnuk', 3820, 0, 0, '', '1923-2', '', 0, 0, 0, '', ''),
('race', 'kiribati', 'Kiribati', 3830, 0, 0, '', '2096-6', '', 0, 0, 0, '', ''),
('race', 'kivalina', 'Kivalina', 3840, 0, 0, '', '1865-5', '', 0, 0, 0, '', ''),
('race', 'klallam', 'Klallam', 3850, 0, 0, '', '1312-8', '', 0, 0, 0, '', ''),
('race', 'klamath', 'Klamath', 3860, 0, 0, '', '1317-7', '', 0, 0, 0, '', ''),
('race', 'klawock', 'Klawock', 3870, 0, 0, '', '1827-5', '', 0, 0, 0, '', ''),
('race', 'kluti_kaah', 'Kluti Kaah', 3880, 0, 0, '', '1774-9', '', 0, 0, 0, '', ''),
('race', 'knik', 'Knik', 3890, 0, 0, '', '1775-6', '', 0, 0, 0, '', ''),
('race', 'kobuk', 'Kobuk', 3900, 0, 0, '', '1866-3', '', 0, 0, 0, '', ''),
('race', 'kodiak', 'Kodiak', 3910, 0, 0, '', '1996-8', '', 0, 0, 0, '', ''),
('race', 'kokhanok', 'Kokhanok', 3920, 0, 0, '', '1979-4', '', 0, 0, 0, '', ''),
('race', 'koliganek', 'Koliganek', 3930, 0, 0, '', '1924-0', '', 0, 0, 0, '', ''),
('race', 'kongiganak', 'Kongiganak', 3940, 0, 0, '', '1925-7', '', 0, 0, 0, '', ''),
('race', 'koniag_aleut', 'Koniag Aleut', 3950, 0, 0, '', '1992-7', '', 0, 0, 0, '', ''),
('race', 'konkow', 'Konkow', 3960, 0, 0, '', '1319-3', '', 0, 0, 0, '', ''),
('race', 'kootenai', 'Kootenai', 3970, 0, 0, '', '1321-9', '', 0, 0, 0, '', ''),
('race', 'korean', 'Korean', 3980, 0, 0, '', '2040-4', '', 0, 0, 0, '', ''),
('race', 'kosraean', 'Kosraean', 3990, 0, 0, '', '2093-3', '', 0, 0, 0, '', ''),
('race', 'kotlik', 'Kotlik', 4000, 0, 0, '', '1926-5', '', 0, 0, 0, '', ''),
('race', 'kotzebue', 'Kotzebue', 4010, 0, 0, '', '1867-1', '', 0, 0, 0, '', ''),
('race', 'koyuk', 'Koyuk', 4020, 0, 0, '', '1868-9', '', 0, 0, 0, '', ''),
('race', 'koyukuk', 'Koyukuk', 4030, 0, 0, '', '1776-4', '', 0, 0, 0, '', ''),
('race', 'kwethluk', 'Kwethluk', 4040, 0, 0, '', '1927-3', '', 0, 0, 0, '', ''),
('race', 'kwigillingok', 'Kwigillingok', 4050, 0, 0, '', '1928-1', '', 0, 0, 0, '', ''),
('race', 'kwiguk', 'Kwiguk', 4060, 0, 0, '', '1869-7', '', 0, 0, 0, '', ''),
('race', 'lac_courte_oreilles', 'Lac Courte Oreilles', 4090, 0, 0, '', '1132-0', '', 0, 0, 0, '', ''),
('race', 'lac_du_flambeau', 'Lac du Flambeau', 4100, 0, 0, '', '1133-8', '', 0, 0, 0, '', ''),
('race', 'lac_vieux_desert_chippewa', 'Lac Vieux Desert Chippewa', 4110, 0, 0, '', '1134-6', '', 0, 0, 0, '', ''),
('race', 'laguna', 'Laguna', 4120, 0, 0, '', '1497-7', '', 0, 0, 0, '', ''),
('race', 'lake_minchumina', 'Lake Minchumina', 4130, 0, 0, '', '1777-2', '', 0, 0, 0, '', ''),
('race', 'lake_superior', 'Lake Superior', 4140, 0, 0, '', '1135-3', '', 0, 0, 0, '', ''),
('race', 'lake_traverse_sioux', 'Lake Traverse Sioux', 4150, 0, 0, '', '1617-0', '', 0, 0, 0, '', ''),
('race', 'laotian', 'Laotian', 4160, 0, 0, '', '2041-2', '', 0, 0, 0, '', ''),
('race', 'larsen_bay', 'Larsen Bay', 4170, 0, 0, '', '1997-6', '', 0, 0, 0, '', ''),
('race', 'lassik', 'Lassik', 4190, 0, 0, '', '1323-5', '', 0, 0, 0, '', ''),
('race', 'las_vegas', 'Las Vegas', 4180, 0, 0, '', '1424-1', '', 0, 0, 0, '', ''),
('race', 'la_jolla', 'La Jolla', 4070, 0, 0, '', '1332-6', '', 0, 0, 0, '', ''),
('race', 'la_posta', 'La Posta', 4080, 0, 0, '', '1226-0', '', 0, 0, 0, '', ''),
('race', 'lebanese', 'Lebanese', 4200, 0, 0, '', '2123-8', '', 0, 0, 0, '', ''),
('race', 'leech_lake', 'Leech Lake', 4210, 0, 0, '', '1136-1', '', 0, 0, 0, '', ''),
('race', 'lenni-lenape', 'Lenni-Lenape', 4220, 0, 0, '', '1216-1', '', 0, 0, 0, '', ''),
('race', 'levelock', 'Levelock', 4230, 0, 0, '', '1929-9', '', 0, 0, 0, '', ''),
('race', 'liberian', 'Liberian', 4240, 0, 0, '', '2063-6', '', 0, 0, 0, '', ''),
('race', 'lime', 'Lime', 4250, 0, 0, '', '1778-0', '', 0, 0, 0, '', ''),
('race', 'lipan_apache', 'Lipan Apache', 4260, 0, 0, '', '1014-0', '', 0, 0, 0, '', ''),
('race', 'little_shell_chippewa', 'Little Shell Chippewa', 4270, 0, 0, '', '1137-9', '', 0, 0, 0, '', ''),
('race', 'lone_pine', 'Lone Pine', 4280, 0, 0, '', '1425-8', '', 0, 0, 0, '', ''),
('race', 'long_island', 'Long Island', 4290, 0, 0, '', '1325-0', '', 0, 0, 0, '', ''),
('race', 'los_coyotes', 'Los Coyotes', 4300, 0, 0, '', '1048-8', '', 0, 0, 0, '', ''),
('race', 'lovelock', 'Lovelock', 4310, 0, 0, '', '1426-6', '', 0, 0, 0, '', ''),
('race', 'lower_brule_sioux', 'Lower Brule Sioux', 4320, 0, 0, '', '1618-8', '', 0, 0, 0, '', ''),
('race', 'lower_elwha', 'Lower Elwha', 4330, 0, 0, '', '1314-4', '', 0, 0, 0, '', ''),
('race', 'lower_kalskag', 'Lower Kalskag', 4340, 0, 0, '', '1930-7', '', 0, 0, 0, '', ''),
('race', 'lower_muscogee', 'Lower Muscogee', 4350, 0, 0, '', '1199-9', '', 0, 0, 0, '', ''),
('race', 'lower_sioux', 'Lower Sioux', 4360, 0, 0, '', '1619-6', '', 0, 0, 0, '', ''),
('race', 'lower_skagit', 'Lower Skagit', 4370, 0, 0, '', '1521-4', '', 0, 0, 0, '', ''),
('race', 'luiseno', 'Luiseno', 4380, 0, 0, '', '1331-8', '', 0, 0, 0, '', ''),
('race', 'lumbee', 'Lumbee', 4390, 0, 0, '', '1340-9', '', 0, 0, 0, '', ''),
('race', 'lummi', 'Lummi', 4400, 0, 0, '', '1342-5', '', 0, 0, 0, '', ''),
('race', 'machis_lower_creek_indian', 'Machis Lower Creek Indian', 4410, 0, 0, '', '1200-5', '', 0, 0, 0, '', ''),
('race', 'madagascar', 'Madagascar', 4420, 0, 0, '', '2052-9', '', 0, 0, 0, '', ''),
('race', 'maidu', 'Maidu', 4430, 0, 0, '', '1344-1', '', 0, 0, 0, '', ''),
('race', 'makah', 'Makah', 4440, 0, 0, '', '1348-2', '', 0, 0, 0, '', ''),
('race', 'malaysian', 'Malaysian', 4450, 0, 0, '', '2042-0', '', 0, 0, 0, '', ''),
('race', 'maldivian', 'Maldivian', 4460, 0, 0, '', '2049-5', '', 0, 0, 0, '', ''),
('race', 'malheur_paiute', 'Malheur Paiute', 4470, 0, 0, '', '1427-4', '', 0, 0, 0, '', ''),
('race', 'maliseet', 'Maliseet', 4480, 0, 0, '', '1350-8', '', 0, 0, 0, '', ''),
('race', 'mandan', 'Mandan', 4490, 0, 0, '', '1352-4', '', 0, 0, 0, '', ''),
('race', 'manley_hot_springs', 'Manley Hot Springs', 4500, 0, 0, '', '1780-6', '', 0, 0, 0, '', ''),
('race', 'manokotak', 'Manokotak', 4510, 0, 0, '', '1931-5', '', 0, 0, 0, '', ''),
('race', 'manzanita', 'Manzanita', 4520, 0, 0, '', '1227-8', '', 0, 0, 0, '', ''),
('race', 'mariana_islander', 'Mariana Islander', 4530, 0, 0, '', '2089-1', '', 0, 0, 0, '', ''),
('race', 'maricopa', 'Maricopa', 4540, 0, 0, '', '1728-5', '', 0, 0, 0, '', ''),
('race', 'marshall', 'Marshall', 4550, 0, 0, '', '1932-3', '', 0, 0, 0, '', ''),
('race', 'marshallese', 'Marshallese', 4560, 0, 0, '', '2090-9', '', 0, 0, 0, '', ''),
('race', 'marshantucket_pequot', 'Marshantucket Pequot', 4570, 0, 0, '', '1454-8', '', 0, 0, 0, '', ''),
('race', 'marys_igloo', 'Mary\'s Igloo', 4580, 0, 0, '', '1889-5', '', 0, 0, 0, '', ''),
('race', 'mashpee_wampanoag', 'Mashpee Wampanoag', 4590, 0, 0, '', '1681-6', '', 0, 0, 0, '', ''),
('race', 'matinecock', 'Matinecock', 4600, 0, 0, '', '1326-8', '', 0, 0, 0, '', ''),
('race', 'mattaponi', 'Mattaponi', 4610, 0, 0, '', '1354-0', '', 0, 0, 0, '', ''),
('race', 'mattole', 'Mattole', 4620, 0, 0, '', '1060-3', '', 0, 0, 0, '', ''),
('race', 'mauneluk_inupiat', 'Mauneluk Inupiat', 4630, 0, 0, '', '1870-5', '', 0, 0, 0, '', ''),
('race', 'mcgrath', 'Mcgrath', 4640, 0, 0, '', '1779-8', '', 0, 0, 0, '', ''),
('race', 'mdewakanton_sioux', 'Mdewakanton Sioux', 4650, 0, 0, '', '1620-4', '', 0, 0, 0, '', ''),
('race', 'mekoryuk', 'Mekoryuk', 4660, 0, 0, '', '1933-1', '', 0, 0, 0, '', ''),
('race', 'melanesian', 'Melanesian', 4670, 0, 0, '', '2100-6', '', 0, 0, 0, '', ''),
('race', 'menominee', 'Menominee', 4680, 0, 0, '', '1356-5', '', 0, 0, 0, '', ''),
('race', 'mentasta_lake', 'Mentasta Lake', 4690, 0, 0, '', '1781-4', '', 0, 0, 0, '', ''),
('race', 'mesa_grande', 'Mesa Grande', 4700, 0, 0, '', '1228-6', '', 0, 0, 0, '', ''),
('race', 'mescalero_apache', 'Mescalero Apache', 4710, 0, 0, '', '1015-7', '', 0, 0, 0, '', ''),
('race', 'metlakatla', 'Metlakatla', 4720, 0, 0, '', '1838-2', '', 0, 0, 0, '', ''),
('race', 'mexican_american_indian', 'Mexican American Indian', 4730, 0, 0, '', '1072-8', '', 0, 0, 0, '', ''),
('race', 'miami', 'Miami', 4740, 0, 0, '', '1358-1', '', 0, 0, 0, '', ''),
('race', 'miccosukee', 'Miccosukee', 4750, 0, 0, '', '1363-1', '', 0, 0, 0, '', ''),
('race', 'michigan_ottawa', 'Michigan Ottawa', 4760, 0, 0, '', '1413-4', '', 0, 0, 0, '', ''),
('race', 'micmac', 'Micmac', 4770, 0, 0, '', '1365-6', '', 0, 0, 0, '', ''),
('race', 'micronesian', 'Micronesian', 4780, 0, 0, '', '2085-9', '', 0, 0, 0, '', ''),
('race', 'middle_eastern_north_african', 'Middle Eastern or North African', 4790, 0, 0, '', '2118-8', '', 0, 0, 0, '', ''),
('race', 'mille_lacs', 'Mille Lacs', 4800, 0, 0, '', '1138-7', '', 0, 0, 0, '', ''),
('race', 'miniconjou', 'Miniconjou', 4810, 0, 0, '', '1621-2', '', 0, 0, 0, '', ''),
('race', 'minnesota_chippewa', 'Minnesota Chippewa', 4820, 0, 0, '', '1139-5', '', 0, 0, 0, '', ''),
('race', 'minto', 'Minto', 4830, 0, 0, '', '1782-2', '', 0, 0, 0, '', ''),
('race', 'mission_indians', 'Mission Indians', 4840, 0, 0, '', '1368-0', '', 0, 0, 0, '', ''),
('race', 'mississippi_choctaw', 'Mississippi Choctaw', 4850, 0, 0, '', '1158-5', '', 0, 0, 0, '', ''),
('race', 'missouri_sac_and_fox', 'Missouri Sac and Fox', 4860, 0, 0, '', '1553-7', '', 0, 0, 0, '', ''),
('race', 'miwok', 'Miwok', 4870, 0, 0, '', '1370-6', '', 0, 0, 0, '', ''),
('race', 'moapa', 'Moapa', 4880, 0, 0, '', '1428-2', '', 0, 0, 0, '', ''),
('race', 'modoc', 'Modoc', 4890, 0, 0, '', '1372-2', '', 0, 0, 0, '', ''),
('race', 'mohave', 'Mohave', 4900, 0, 0, '', '1729-3', '', 0, 0, 0, '', ''),
('race', 'mohawk', 'Mohawk', 4910, 0, 0, '', '1287-2', '', 0, 0, 0, '', ''),
('race', 'mohegan', 'Mohegan', 4920, 0, 0, '', '1374-8', '', 0, 0, 0, '', ''),
('race', 'molala', 'Molala', 4930, 0, 0, '', '1396-1', '', 0, 0, 0, '', ''),
('race', 'mono', 'Mono', 4940, 0, 0, '', '1376-3', '', 0, 0, 0, '', ''),
('race', 'montauk', 'Montauk', 4950, 0, 0, '', '1327-6', '', 0, 0, 0, '', ''),
('race', 'moor', 'Moor', 4960, 0, 0, '', '1237-7', '', 0, 0, 0, '', ''),
('race', 'morongo', 'Morongo', 4970, 0, 0, '', '1049-6', '', 0, 0, 0, '', ''),
('race', 'mountain_maidu', 'Mountain Maidu', 4980, 0, 0, '', '1345-8', '', 0, 0, 0, '', ''),
('race', 'mountain_village', 'Mountain Village', 4990, 0, 0, '', '1934-9', '', 0, 0, 0, '', ''),
('race', 'mowa_band_of_choctaw', 'Mowa Band of Choctaw', 5000, 0, 0, '', '1159-3', '', 0, 0, 0, '', ''),
('race', 'muckleshoot', 'Muckleshoot', 5010, 0, 0, '', '1522-2', '', 0, 0, 0, '', ''),
('race', 'munsee', 'Munsee', 5020, 0, 0, '', '1217-9', '', 0, 0, 0, '', ''),
('race', 'naknek', 'Naknek', 5030, 0, 0, '', '1935-6', '', 0, 0, 0, '', ''),
('race', 'nambe', 'Nambe', 5040, 0, 0, '', '1498-5', '', 0, 0, 0, '', ''),
('race', 'namibian', 'Namibian', 5050, 0, 0, '', '2064-4', '', 0, 0, 0, '', ''),
('race', 'nana_inupiat', 'Nana Inupiat', 5060, 0, 0, '', '1871-3', '', 0, 0, 0, '', ''),
('race', 'nansemond', 'Nansemond', 5070, 0, 0, '', '1238-5', '', 0, 0, 0, '', ''),
('race', 'nanticoke', 'Nanticoke', 5080, 0, 0, '', '1378-9', '', 0, 0, 0, '', ''),
('race', 'napakiak', 'Napakiak', 5090, 0, 0, '', '1937-2', '', 0, 0, 0, '', ''),
('race', 'napaskiak', 'Napaskiak', 5100, 0, 0, '', '1938-0', '', 0, 0, 0, '', ''),
('race', 'napaumute', 'Napaumute', 5110, 0, 0, '', '1936-4', '', 0, 0, 0, '', ''),
('race', 'narragansett', 'Narragansett', 5120, 0, 0, '', '1380-5', '', 0, 0, 0, '', ''),
('race', 'natchez', 'Natchez', 5130, 0, 0, '', '1239-3', '', 0, 0, 0, '', ''),
('race', 'native_hawaiian', 'Native Hawaiian', 5140, 0, 0, '', '2079-2', '', 0, 0, 0, '', ''),
('race', 'native_hawai_or_pac_island', 'Native Hawaiian or Other Pacific Islander', 40, 0, 0, '', '2076-8', '', 0, 0, 1, '', ''),
('race', 'nausu_waiwash', 'Nausu Waiwash', 5160, 0, 0, '', '1240-1', '', 0, 0, 0, '', ''),
('race', 'navajo', 'Navajo', 5170, 0, 0, '', '1382-1', '', 0, 0, 0, '', ''),
('race', 'nebraska_ponca', 'Nebraska Ponca', 5180, 0, 0, '', '1475-3', '', 0, 0, 0, '', ''),
('race', 'nebraska_winnebago', 'Nebraska Winnebago', 5190, 0, 0, '', '1698-0', '', 0, 0, 0, '', ''),
('race', 'nelson_lagoon', 'Nelson Lagoon', 5200, 0, 0, '', '2016-4', '', 0, 0, 0, '', ''),
('race', 'nenana', 'Nenana', 5210, 0, 0, '', '1783-0', '', 0, 0, 0, '', ''),
('race', 'nepalese', 'Nepalese', 5220, 0, 0, '', '2050-3', '', 0, 0, 0, '', ''),
('race', 'newhalen', 'Newhalen', 5250, 0, 0, '', '1939-8', '', 0, 0, 0, '', ''),
('race', 'newtok', 'Newtok', 5260, 0, 0, '', '1941-4', '', 0, 0, 0, '', ''),
('race', 'new_hebrides', 'New Hebrides', 5230, 0, 0, '', '2104-8', '', 0, 0, 0, '', ''),
('race', 'new_stuyahok', 'New Stuyahok', 5240, 0, 0, '', '1940-6', '', 0, 0, 0, '', ''),
('race', 'nez_perce', 'Nez Perce', 5270, 0, 0, '', '1387-0', '', 0, 0, 0, '', ''),
('race', 'nigerian', 'Nigerian', 5280, 0, 0, '', '2065-1', '', 0, 0, 0, '', ''),
('race', 'nightmute', 'Nightmute', 5290, 0, 0, '', '1942-2', '', 0, 0, 0, '', ''),
('race', 'nikolai', 'Nikolai', 5300, 0, 0, '', '1784-8', '', 0, 0, 0, '', ''),
('race', 'nikolski', 'Nikolski', 5310, 0, 0, '', '2017-2', '', 0, 0, 0, '', ''),
('race', 'ninilchik', 'Ninilchik', 5320, 0, 0, '', '1785-5', '', 0, 0, 0, '', ''),
('race', 'nipmuc', 'Nipmuc', 5330, 0, 0, '', '1241-9', '', 0, 0, 0, '', ''),
('race', 'nishinam', 'Nishinam', 5340, 0, 0, '', '1346-6', '', 0, 0, 0, '', ''),
('race', 'nisqually', 'Nisqually', 5350, 0, 0, '', '1523-0', '', 0, 0, 0, '', ''),
('race', 'noatak', 'Noatak', 5360, 0, 0, '', '1872-1', '', 0, 0, 0, '', ''),
('race', 'nomalaki', 'Nomalaki', 5370, 0, 0, '', '1389-6', '', 0, 0, 0, '', ''),
('race', 'nome', 'Nome', 5380, 0, 0, '', '1873-9', '', 0, 0, 0, '', ''),
('race', 'nondalton', 'Nondalton', 5390, 0, 0, '', '1786-3', '', 0, 0, 0, '', ''),
('race', 'nooksack', 'Nooksack', 5400, 0, 0, '', '1524-8', '', 0, 0, 0, '', ''),
('race', 'noorvik', 'Noorvik', 5410, 0, 0, '', '1874-7', '', 0, 0, 0, '', ''),
('race', 'northern_arapaho', 'Northern Arapaho', 5420, 0, 0, '', '1022-3', '', 0, 0, 0, '', ''),
('race', 'northern_cherokee', 'Northern Cherokee', 5430, 0, 0, '', '1095-9', '', 0, 0, 0, '', ''),
('race', 'northern_cheyenne', 'Northern Cheyenne', 5440, 0, 0, '', '1103-1', '', 0, 0, 0, '', ''),
('race', 'northern_paiute', 'Northern Paiute', 5450, 0, 0, '', '1429-0', '', 0, 0, 0, '', ''),
('race', 'northern_pomo', 'Northern Pomo', 5460, 0, 0, '', '1469-6', '', 0, 0, 0, '', ''),
('race', 'northway', 'Northway', 5470, 0, 0, '', '1787-1', '', 0, 0, 0, '', ''),
('race', 'northwest_tribes', 'Northwest Tribes', 5480, 0, 0, '', '1391-2', '', 0, 0, 0, '', ''),
('race', 'nuiqsut', 'Nuiqsut', 5490, 0, 0, '', '1875-4', '', 0, 0, 0, '', ''),
('race', 'nulato', 'Nulato', 5500, 0, 0, '', '1788-9', '', 0, 0, 0, '', ''),
('race', 'nunapitchukv', 'Nunapitchukv', 5510, 0, 0, '', '1943-0', '', 0, 0, 0, '', ''),
('race', 'oglala_sioux', 'Oglala Sioux', 5520, 0, 0, '', '1622-0', '', 0, 0, 0, '', ''),
('race', 'okinawan', 'Okinawan', 5530, 0, 0, '', '2043-8', '', 0, 0, 0, '', ''),
('race', 'oklahoma_apache', 'Oklahoma Apache', 5540, 0, 0, '', '1016-5', '', 0, 0, 0, '', ''),
('race', 'oklahoma_cado', 'Oklahoma Cado', 5550, 0, 0, '', '1042-1', '', 0, 0, 0, '', ''),
('race', 'oklahoma_choctaw', 'Oklahoma Choctaw', 5560, 0, 0, '', '1160-1', '', 0, 0, 0, '', ''),
('race', 'oklahoma_comanche', 'Oklahoma Comanche', 5570, 0, 0, '', '1176-7', '', 0, 0, 0, '', ''),
('race', 'oklahoma_delaware', 'Oklahoma Delaware', 5580, 0, 0, '', '1218-7', '', 0, 0, 0, '', ''),
('race', 'oklahoma_kickapoo', 'Oklahoma Kickapoo', 5590, 0, 0, '', '1306-0', '', 0, 0, 0, '', ''),
('race', 'oklahoma_kiowa', 'Oklahoma Kiowa', 5600, 0, 0, '', '1310-2', '', 0, 0, 0, '', ''),
('race', 'oklahoma_miami', 'Oklahoma Miami', 5610, 0, 0, '', '1361-5', '', 0, 0, 0, '', ''),
('race', 'oklahoma_ottawa', 'Oklahoma Ottawa', 5620, 0, 0, '', '1414-2', '', 0, 0, 0, '', ''),
('race', 'oklahoma_pawnee', 'Oklahoma Pawnee', 5630, 0, 0, '', '1446-4', '', 0, 0, 0, '', ''),
('race', 'oklahoma_peoria', 'Oklahoma Peoria', 5640, 0, 0, '', '1451-4', '', 0, 0, 0, '', ''),
('race', 'oklahoma_ponca', 'Oklahoma Ponca', 5650, 0, 0, '', '1476-1', '', 0, 0, 0, '', ''),
('race', 'oklahoma_sac_and_fox', 'Oklahoma Sac and Fox', 5660, 0, 0, '', '1554-5', '', 0, 0, 0, '', ''),
('race', 'oklahoma_seminole', 'Oklahoma Seminole', 5670, 0, 0, '', '1571-9', '', 0, 0, 0, '', ''),
('race', 'old_harbor', 'Old Harbor', 5680, 0, 0, '', '1998-4', '', 0, 0, 0, '', ''),
('race', 'omaha', 'Omaha', 5690, 0, 0, '', '1403-5', '', 0, 0, 0, '', ''),
('race', 'oneida', 'Oneida', 5700, 0, 0, '', '1288-0', '', 0, 0, 0, '', ''),
('race', 'onondaga', 'Onondaga', 5710, 0, 0, '', '1289-8', '', 0, 0, 0, '', ''),
('race', 'ontonagon', 'Ontonagon', 5720, 0, 0, '', '1140-3', '', 0, 0, 0, '', ''),
('race', 'oregon_athabaskan', 'Oregon Athabaskan', 5730, 0, 0, '', '1405-0', '', 0, 0, 0, '', ''),
('race', 'osage', 'Osage', 5740, 0, 0, '', '1407-6', '', 0, 0, 0, '', ''),
('race', 'oscarville', 'Oscarville', 5750, 0, 0, '', '1944-8', '', 0, 0, 0, '', ''),
('race', 'other_pacific_islander', 'Other Pacific Islander', 5760, 0, 0, '', '2500-7', '', 0, 0, 0, '', ''),
('race', 'other_race', 'Other Race', 5770, 0, 0, '', '2131-1', '', 0, 0, 0, '', ''),
('race', 'otoe-missouria', 'Otoe-Missouria', 5780, 0, 0, '', '1409-2', '', 0, 0, 0, '', ''),
('race', 'ottawa', 'Ottawa', 5790, 0, 0, '', '1411-8', '', 0, 0, 0, '', ''),
('race', 'ouzinkie', 'Ouzinkie', 5800, 0, 0, '', '1999-2', '', 0, 0, 0, '', ''),
('race', 'owens_valley', 'Owens Valley', 5810, 0, 0, '', '1430-8', '', 0, 0, 0, '', ''),
('race', 'paiute', 'Paiute', 5820, 0, 0, '', '1416-7', '', 0, 0, 0, '', ''),
('race', 'pakistani', 'Pakistani', 5830, 0, 0, '', '2044-6', '', 0, 0, 0, '', ''),
('race', 'pala', 'Pala', 5840, 0, 0, '', '1333-4', '', 0, 0, 0, '', ''),
('race', 'palauan', 'Palauan', 5850, 0, 0, '', '2091-7', '', 0, 0, 0, '', ''),
('race', 'palestinian', 'Palestinian', 5860, 0, 0, '', '2124-6', '', 0, 0, 0, '', ''),
('race', 'pamunkey', 'Pamunkey', 5870, 0, 0, '', '1439-9', '', 0, 0, 0, '', ''),
('race', 'panamint', 'Panamint', 5880, 0, 0, '', '1592-5', '', 0, 0, 0, '', ''),
('race', 'papua_new_guinean', 'Papua New Guinean', 5890, 0, 0, '', '2102-2', '', 0, 0, 0, '', ''),
('race', 'pascua_yaqui', 'Pascua Yaqui', 5900, 0, 0, '', '1713-7', '', 0, 0, 0, '', ''),
('race', 'passamaquoddy', 'Passamaquoddy', 5910, 0, 0, '', '1441-5', '', 0, 0, 0, '', ''),
('race', 'paugussett', 'Paugussett', 5920, 0, 0, '', '1242-7', '', 0, 0, 0, '', ''),
('race', 'pauloff_harbor', 'Pauloff Harbor', 5930, 0, 0, '', '2018-0', '', 0, 0, 0, '', ''),
('race', 'pauma', 'Pauma', 5940, 0, 0, '', '1334-2', '', 0, 0, 0, '', ''),
('race', 'pawnee', 'Pawnee', 5950, 0, 0, '', '1445-6', '', 0, 0, 0, '', ''),
('race', 'payson_apache', 'Payson Apache', 5960, 0, 0, '', '1017-3', '', 0, 0, 0, '', ''),
('race', 'pechanga', 'Pechanga', 5970, 0, 0, '', '1335-9', '', 0, 0, 0, '', ''),
('race', 'pedro_bay', 'Pedro Bay', 5980, 0, 0, '', '1789-7', '', 0, 0, 0, '', ''),
('race', 'pelican', 'Pelican', 5990, 0, 0, '', '1828-3', '', 0, 0, 0, '', ''),
('race', 'penobscot', 'Penobscot', 6000, 0, 0, '', '1448-0', '', 0, 0, 0, '', ''),
('race', 'peoria', 'Peoria', 6010, 0, 0, '', '1450-6', '', 0, 0, 0, '', ''),
('race', 'pequot', 'Pequot', 6020, 0, 0, '', '1453-0', '', 0, 0, 0, '', ''),
('race', 'perryville', 'Perryville', 6030, 0, 0, '', '1980-2', '', 0, 0, 0, '', ''),
('race', 'petersburg', 'Petersburg', 6040, 0, 0, '', '1829-1', '', 0, 0, 0, '', ''),
('race', 'picuris', 'Picuris', 6050, 0, 0, '', '1499-3', '', 0, 0, 0, '', ''),
('race', 'pilot_point', 'Pilot Point', 6060, 0, 0, '', '1981-0', '', 0, 0, 0, '', ''),
('race', 'pilot_station', 'Pilot Station', 6070, 0, 0, '', '1945-5', '', 0, 0, 0, '', ''),
('race', 'pima', 'Pima', 6080, 0, 0, '', '1456-3', '', 0, 0, 0, '', ''),
('race', 'pine_ridge_sioux', 'Pine Ridge Sioux', 6090, 0, 0, '', '1623-8', '', 0, 0, 0, '', ''),
('race', 'pipestone_sioux', 'Pipestone Sioux', 6100, 0, 0, '', '1624-6', '', 0, 0, 0, '', ''),
('race', 'piro', 'Piro', 6110, 0, 0, '', '1500-8', '', 0, 0, 0, '', ''),
('race', 'piscataway', 'Piscataway', 6120, 0, 0, '', '1460-5', '', 0, 0, 0, '', ''),
('race', 'pitkas_point', 'Pitkas Point', 6140, 0, 0, '', '1946-3', '', 0, 0, 0, '', ''),
('race', 'pit_river', 'Pit River', 6130, 0, 0, '', '1462-1', '', 0, 0, 0, '', ''),
('race', 'platinum', 'Platinum', 6150, 0, 0, '', '1947-1', '', 0, 0, 0, '', ''),
('race', 'pleasant_point_passamaquoddy', 'Pleasant Point Passamaquoddy', 6160, 0, 0, '', '1443-1', '', 0, 0, 0, '', ''),
('race', 'poarch_band', 'Poarch Band', 6170, 0, 0, '', '1201-3', '', 0, 0, 0, '', ''),
('race', 'pocomoke_acohonock', 'Pocomoke Acohonock', 6180, 0, 0, '', '1243-5', '', 0, 0, 0, '', ''),
('race', 'pohnpeian', 'Pohnpeian', 6190, 0, 0, '', '2094-1', '', 0, 0, 0, '', ''),
('race', 'point_hope', 'Point Hope', 6200, 0, 0, '', '1876-2', '', 0, 0, 0, '', ''),
('race', 'point_lay', 'Point Lay', 6210, 0, 0, '', '1877-0', '', 0, 0, 0, '', ''),
('race', 'pojoaque', 'Pojoaque', 6220, 0, 0, '', '1501-6', '', 0, 0, 0, '', ''),
('race', 'pokagon_potawatomi', 'Pokagon Potawatomi', 6230, 0, 0, '', '1483-7', '', 0, 0, 0, '', ''),
('race', 'polish', 'Polish', 6240, 0, 0, '', '2115-4', '', 0, 0, 0, '', ''),
('race', 'polynesian', 'Polynesian', 6250, 0, 0, '', '2078-4', '', 0, 0, 0, '', ''),
('race', 'pomo', 'Pomo', 6260, 0, 0, '', '1464-7', '', 0, 0, 0, '', ''),
('race', 'ponca', 'Ponca', 6270, 0, 0, '', '1474-6', '', 0, 0, 0, '', ''),
('race', 'poospatuck', 'Poospatuck', 6280, 0, 0, '', '1328-4', '', 0, 0, 0, '', ''),
('race', 'portage_creek', 'Portage Creek', 6340, 0, 0, '', '1948-9', '', 0, 0, 0, '', ''),
('race', 'port_gamble_klallam', 'Port Gamble Klallam', 6290, 0, 0, '', '1315-1', '', 0, 0, 0, '', ''),
('race', 'port_graham', 'Port Graham', 6300, 0, 0, '', '1988-5', '', 0, 0, 0, '', ''),
('race', 'port_heiden', 'Port Heiden', 6310, 0, 0, '', '1982-8', '', 0, 0, 0, '', ''),
('race', 'port_lions', 'Port Lions', 6320, 0, 0, '', '2000-8', '', 0, 0, 0, '', ''),
('race', 'port_madison', 'Port Madison', 6330, 0, 0, '', '1525-5', '', 0, 0, 0, '', ''),
('race', 'potawatomi', 'Potawatomi', 6350, 0, 0, '', '1478-7', '', 0, 0, 0, '', ''),
('race', 'powhatan', 'Powhatan', 6360, 0, 0, '', '1487-8', '', 0, 0, 0, '', ''),
('race', 'prairie_band', 'Prairie Band', 6370, 0, 0, '', '1484-5', '', 0, 0, 0, '', ''),
('race', 'prairie_island_sioux', 'Prairie Island Sioux', 6380, 0, 0, '', '1625-3', '', 0, 0, 0, '', ''),
('race', 'principal_creek_indian_nation', 'Principal Creek Indian Nation', 6390, 0, 0, '', '1202-1', '', 0, 0, 0, '', ''),
('race', 'prior_lake_sioux', 'Prior Lake Sioux', 6400, 0, 0, '', '1626-1', '', 0, 0, 0, '', ''),
('race', 'pueblo', 'Pueblo', 6410, 0, 0, '', '1489-4', '', 0, 0, 0, '', ''),
('race', 'puget_sound_salish', 'Puget Sound Salish', 6420, 0, 0, '', '1518-0', '', 0, 0, 0, '', ''),
('race', 'puyallup', 'Puyallup', 6430, 0, 0, '', '1526-3', '', 0, 0, 0, '', ''),
('race', 'pyramid_lake', 'Pyramid Lake', 6440, 0, 0, '', '1431-6', '', 0, 0, 0, '', ''),
('race', 'qagan_toyagungin', 'Qagan Toyagungin', 6450, 0, 0, '', '2019-8', '', 0, 0, 0, '', ''),
('race', 'qawalangin', 'Qawalangin', 6460, 0, 0, '', '2020-6', '', 0, 0, 0, '', ''),
('race', 'quapaw', 'Quapaw', 6470, 0, 0, '', '1541-2', '', 0, 0, 0, '', ''),
('race', 'quechan', 'Quechan', 6480, 0, 0, '', '1730-1', '', 0, 0, 0, '', ''),
('race', 'quileute', 'Quileute', 6490, 0, 0, '', '1084-3', '', 0, 0, 0, '', ''),
('race', 'quinault', 'Quinault', 6500, 0, 0, '', '1543-8', '', 0, 0, 0, '', ''),
('race', 'quinhagak', 'Quinhagak', 6510, 0, 0, '', '1949-7', '', 0, 0, 0, '', ''),
('race', 'ramah_navajo', 'Ramah Navajo', 6520, 0, 0, '', '1385-4', '', 0, 0, 0, '', ''),
('race', 'rampart', 'Rampart', 6530, 0, 0, '', '1790-5', '', 0, 0, 0, '', ''),
('race', 'rampough_mountain', 'Rampough Mountain', 6540, 0, 0, '', '1219-5', '', 0, 0, 0, '', ''),
('race', 'rappahannock', 'Rappahannock', 6550, 0, 0, '', '1545-3', '', 0, 0, 0, '', ''),
('race', 'red_cliff_chippewa', 'Red Cliff Chippewa', 6560, 0, 0, '', '1141-1', '', 0, 0, 0, '', ''),
('race', 'red_devil', 'Red Devil', 6570, 0, 0, '', '1950-5', '', 0, 0, 0, '', ''),
('race', 'red_lake_chippewa', 'Red Lake Chippewa', 6580, 0, 0, '', '1142-9', '', 0, 0, 0, '', ''),
('race', 'red_wood', 'Red Wood', 6590, 0, 0, '', '1061-1', '', 0, 0, 0, '', ''),
('race', 'reno-sparks', 'Reno-Sparks', 6600, 0, 0, '', '1547-9', '', 0, 0, 0, '', ''),
('race', 'rocky_boys_chippewa_cree', 'Rocky Boy\'s Chippewa Cree', 6610, 0, 0, '', '1151-0', '', 0, 0, 0, '', ''),
('race', 'rosebud_sioux', 'Rosebud Sioux', 6620, 0, 0, '', '1627-9', '', 0, 0, 0, '', ''),
('race', 'round_valley', 'Round Valley', 6630, 0, 0, '', '1549-5', '', 0, 0, 0, '', ''),
('race', 'ruby', 'Ruby', 6640, 0, 0, '', '1791-3', '', 0, 0, 0, '', ''),
('race', 'ruby_valley', 'Ruby Valley', 6650, 0, 0, '', '1593-3', '', 0, 0, 0, '', ''),
('race', 'sac_and_fox', 'Sac and Fox', 6660, 0, 0, '', '1551-1', '', 0, 0, 0, '', ''),
('race', 'saginaw_chippewa', 'Saginaw Chippewa', 6670, 0, 0, '', '1143-7', '', 0, 0, 0, '', ''),
('race', 'saipanese', 'Saipanese', 6680, 0, 0, '', '2095-8', '', 0, 0, 0, '', ''),
('race', 'salamatof', 'Salamatof', 6690, 0, 0, '', '1792-1', '', 0, 0, 0, '', ''),
('race', 'salinan', 'Salinan', 6700, 0, 0, '', '1556-0', '', 0, 0, 0, '', ''),
('race', 'salish', 'Salish', 6710, 0, 0, '', '1558-6', '', 0, 0, 0, '', ''),
('race', 'salish_and_kootenai', 'Salish and Kootenai', 6720, 0, 0, '', '1560-2', '', 0, 0, 0, '', ''),
('race', 'salt_river_pima-maricopa', 'Salt River Pima-Maricopa', 6730, 0, 0, '', '1458-9', '', 0, 0, 0, '', ''),
('race', 'samish', 'Samish', 6740, 0, 0, '', '1527-1', '', 0, 0, 0, '', ''),
('race', 'samoan', 'Samoan', 6750, 0, 0, '', '2080-0', '', 0, 0, 0, '', ''),
('race', 'sandia', 'Sandia', 6880, 0, 0, '', '1507-3', '', 0, 0, 0, '', ''),
('race', 'sand_hill', 'Sand Hill', 6860, 0, 0, '', '1220-3', '', 0, 0, 0, '', ''),
('race', 'sand_point', 'Sand Point', 6870, 0, 0, '', '2023-0', '', 0, 0, 0, '', ''),
('race', 'sans_arc_sioux', 'Sans Arc Sioux', 6890, 0, 0, '', '1628-7', '', 0, 0, 0, '', ''),
('race', 'santa_ana', 'Santa Ana', 6900, 0, 0, '', '1508-1', '', 0, 0, 0, '', ''),
('race', 'santa_clara', 'Santa Clara', 6910, 0, 0, '', '1509-9', '', 0, 0, 0, '', ''),
('race', 'santa_rosa', 'Santa Rosa', 6920, 0, 0, '', '1062-9', '', 0, 0, 0, '', ''),
('race', 'santa_rosa_cahuilla', 'Santa Rosa Cahuilla', 6930, 0, 0, '', '1050-4', '', 0, 0, 0, '', ''),
('race', 'santa_ynez', 'Santa Ynez', 6940, 0, 0, '', '1163-5', '', 0, 0, 0, '', ''),
('race', 'santa_ysabel', 'Santa Ysabel', 6950, 0, 0, '', '1230-2', '', 0, 0, 0, '', ''),
('race', 'santee_sioux', 'Santee Sioux', 6960, 0, 0, '', '1629-5', '', 0, 0, 0, '', ''),
('race', 'santo_domingo', 'Santo Domingo', 6970, 0, 0, '', '1510-7', '', 0, 0, 0, '', ''),
('race', 'san_carlos_apache', 'San Carlos Apache', 6760, 0, 0, '', '1018-1', '', 0, 0, 0, '', ''),
('race', 'san_felipe', 'San Felipe', 6770, 0, 0, '', '1502-4', '', 0, 0, 0, '', ''),
('race', 'san_ildefonso', 'San Ildefonso', 6780, 0, 0, '', '1503-2', '', 0, 0, 0, '', ''),
('race', 'san_juan', 'San Juan', 6790, 0, 0, '', '1506-5', '', 0, 0, 0, '', ''),
('race', 'san_juan_de', 'San Juan De', 6800, 0, 0, '', '1505-7', '', 0, 0, 0, '', ''),
('race', 'san_juan_pueblo', 'San Juan Pueblo', 6810, 0, 0, '', '1504-0', '', 0, 0, 0, '', ''),
('race', 'san_juan_southern_paiute', 'San Juan Southern Paiute', 6820, 0, 0, '', '1432-4', '', 0, 0, 0, '', ''),
('race', 'san_manual', 'San Manual', 6830, 0, 0, '', '1574-3', '', 0, 0, 0, '', ''),
('race', 'san_pasqual', 'San Pasqual', 6840, 0, 0, '', '1229-4', '', 0, 0, 0, '', ''),
('race', 'san_xavier', 'San Xavier', 6850, 0, 0, '', '1656-8', '', 0, 0, 0, '', ''),
('race', 'sauk-suiattle', 'Sauk-Suiattle', 6980, 0, 0, '', '1528-9', '', 0, 0, 0, '', ''),
('race', 'sault_ste_marie_chippewa', 'Sault Ste. Marie Chippewa', 6990, 0, 0, '', '1145-2', '', 0, 0, 0, '', ''),
('race', 'savoonga', 'Savoonga', 7000, 0, 0, '', '1893-7', '', 0, 0, 0, '', ''),
('race', 'saxman', 'Saxman', 7010, 0, 0, '', '1830-9', '', 0, 0, 0, '', ''),
('race', 'scammon_bay', 'Scammon Bay', 7020, 0, 0, '', '1952-1', '', 0, 0, 0, '', ''),
('race', 'schaghticoke', 'Schaghticoke', 7030, 0, 0, '', '1562-8', '', 0, 0, 0, '', ''),
('race', 'scottish', 'Scottish', 7050, 0, 0, '', '2116-2', '', 0, 0, 0, '', ''),
('race', 'scotts_valley', 'Scotts Valley', 7060, 0, 0, '', '1470-4', '', 0, 0, 0, '', ''),
('race', 'scott_valley', 'Scott Valley', 7040, 0, 0, '', '1564-4', '', 0, 0, 0, '', ''),
('race', 'selawik', 'Selawik', 7070, 0, 0, '', '1878-8', '', 0, 0, 0, '', ''),
('race', 'seldovia', 'Seldovia', 7080, 0, 0, '', '1793-9', '', 0, 0, 0, '', ''),
('race', 'sells', 'Sells', 7090, 0, 0, '', '1657-6', '', 0, 0, 0, '', ''),
('race', 'seminole', 'Seminole', 7100, 0, 0, '', '1566-9', '', 0, 0, 0, '', ''),
('race', 'seneca', 'Seneca', 7110, 0, 0, '', '1290-6', '', 0, 0, 0, '', ''),
('race', 'seneca-cayuga', 'Seneca-Cayuga', 7130, 0, 0, '', '1292-2', '', 0, 0, 0, '', ''),
('race', 'seneca_nation', 'Seneca Nation', 7120, 0, 0, '', '1291-4', '', 0, 0, 0, '', ''),
('race', 'serrano', 'Serrano', 7140, 0, 0, '', '1573-5', '', 0, 0, 0, '', ''),
('race', 'setauket', 'Setauket', 7150, 0, 0, '', '1329-2', '', 0, 0, 0, '', ''),
('race', 'shageluk', 'Shageluk', 7160, 0, 0, '', '1795-4', '', 0, 0, 0, '', ''),
('race', 'shaktoolik', 'Shaktoolik', 7170, 0, 0, '', '1879-6', '', 0, 0, 0, '', ''),
('race', 'shasta', 'Shasta', 7180, 0, 0, '', '1576-8', '', 0, 0, 0, '', ''),
('race', 'shawnee', 'Shawnee', 7190, 0, 0, '', '1578-4', '', 0, 0, 0, '', ''),
('race', 'sheldons_point', 'Sheldon\'s Point', 7200, 0, 0, '', '1953-9', '', 0, 0, 0, '', ''),
('race', 'shinnecock', 'Shinnecock', 7210, 0, 0, '', '1582-6', '', 0, 0, 0, '', ''),
('race', 'shishmaref', 'Shishmaref', 7220, 0, 0, '', '1880-4', '', 0, 0, 0, '', ''),
('race', 'shoalwater_bay', 'Shoalwater Bay', 7230, 0, 0, '', '1584-2', '', 0, 0, 0, '', ''),
('race', 'shoshone', 'Shoshone', 7240, 0, 0, '', '1586-7', '', 0, 0, 0, '', ''),
('race', 'shoshone_paiute', 'Shoshone Paiute', 7250, 0, 0, '', '1602-2', '', 0, 0, 0, '', ''),
('race', 'shungnak', 'Shungnak', 7260, 0, 0, '', '1881-2', '', 0, 0, 0, '', ''),
('race', 'siberian_eskimo', 'Siberian Eskimo', 7270, 0, 0, '', '1891-1', '', 0, 0, 0, '', ''),
('race', 'siberian_yupik', 'Siberian Yupik', 7280, 0, 0, '', '1894-5', '', 0, 0, 0, '', ''),
('race', 'siletz', 'Siletz', 7290, 0, 0, '', '1607-1', '', 0, 0, 0, '', ''),
('race', 'singaporean', 'Singaporean', 7300, 0, 0, '', '2051-1', '', 0, 0, 0, '', ''),
('race', 'sioux', 'Sioux', 7310, 0, 0, '', '1609-7', '', 0, 0, 0, '', ''),
('race', 'sisseton-wahpeton', 'Sisseton-Wahpeton', 7330, 0, 0, '', '1630-3', '', 0, 0, 0, '', ''),
('race', 'sisseton_sioux', 'Sisseton Sioux', 7320, 0, 0, '', '1631-1', '', 0, 0, 0, '', ''),
('race', 'sitka', 'Sitka', 7340, 0, 0, '', '1831-7', '', 0, 0, 0, '', ''),
('race', 'siuslaw', 'Siuslaw', 7350, 0, 0, '', '1643-6', '', 0, 0, 0, '', ''),
('race', 'skokomish', 'Skokomish', 7360, 0, 0, '', '1529-7', '', 0, 0, 0, '', ''),
('race', 'skull_valley', 'Skull Valley', 7370, 0, 0, '', '1594-1', '', 0, 0, 0, '', ''),
('race', 'skykomish', 'Skykomish', 7380, 0, 0, '', '1530-5', '', 0, 0, 0, '', ''),
('race', 'slana', 'Slana', 7390, 0, 0, '', '1794-7', '', 0, 0, 0, '', ''),
('race', 'sleetmute', 'Sleetmute', 7400, 0, 0, '', '1954-7', '', 0, 0, 0, '', ''),
('race', 'snohomish', 'Snohomish', 7410, 0, 0, '', '1531-3', '', 0, 0, 0, '', ''),
('race', 'snoqualmie', 'Snoqualmie', 7420, 0, 0, '', '1532-1', '', 0, 0, 0, '', ''),
('race', 'soboba', 'Soboba', 7430, 0, 0, '', '1336-7', '', 0, 0, 0, '', ''),
('race', 'sokoagon_chippewa', 'Sokoagon Chippewa', 7440, 0, 0, '', '1146-0', '', 0, 0, 0, '', ''),
('race', 'solomon', 'Solomon', 7450, 0, 0, '', '1882-0', '', 0, 0, 0, '', ''),
('race', 'solomon_islander', 'Solomon Islander', 7460, 0, 0, '', '2103-0', '', 0, 0, 0, '', ''),
('race', 'southeastern_indians', 'Southeastern Indians', 7510, 0, 0, '', '1244-3', '', 0, 0, 0, '', ''),
('race', 'southeast_alaska', 'Southeast Alaska', 7500, 0, 0, '', '1811-9', '', 0, 0, 0, '', ''),
('race', 'southern_arapaho', 'Southern Arapaho', 7520, 0, 0, '', '1023-1', '', 0, 0, 0, '', ''),
('race', 'southern_cheyenne', 'Southern Cheyenne', 7530, 0, 0, '', '1104-9', '', 0, 0, 0, '', ''),
('race', 'southern_paiute', 'Southern Paiute', 7540, 0, 0, '', '1433-2', '', 0, 0, 0, '', ''),
('race', 'south_american_indian', 'South American Indian', 7470, 0, 0, '', '1073-6', '', 0, 0, 0, '', ''),
('race', 'south_fork_shoshone', 'South Fork Shoshone', 7480, 0, 0, '', '1595-8', '', 0, 0, 0, '', ''),
('race', 'south_naknek', 'South Naknek', 7490, 0, 0, '', '2024-8', '', 0, 0, 0, '', ''),
('race', 'spanish_american_indian', 'Spanish American Indian', 7550, 0, 0, '', '1074-4', '', 0, 0, 0, '', ''),
('race', 'spirit_lake_sioux', 'Spirit Lake Sioux', 7560, 0, 0, '', '1632-9', '', 0, 0, 0, '', ''),
('race', 'spokane', 'Spokane', 7570, 0, 0, '', '1645-1', '', 0, 0, 0, '', ''),
('race', 'squaxin_island', 'Squaxin Island', 7580, 0, 0, '', '1533-9', '', 0, 0, 0, '', ''),
('race', 'sri_lankan', 'Sri Lankan', 7590, 0, 0, '', '2045-3', '', 0, 0, 0, '', ''),
('race', 'standing_rock_sioux', 'Standing Rock Sioux', 7650, 0, 0, '', '1633-7', '', 0, 0, 0, '', ''),
('race', 'star_clan_of_muscogee_creeks', 'Star Clan of Muscogee Creeks', 7660, 0, 0, '', '1203-9', '', 0, 0, 0, '', ''),
('race', 'stebbins', 'Stebbins', 7670, 0, 0, '', '1955-4', '', 0, 0, 0, '', ''),
('race', 'steilacoom', 'Steilacoom', 7680, 0, 0, '', '1534-7', '', 0, 0, 0, '', ''),
('race', 'stevens', 'Stevens', 7690, 0, 0, '', '1796-2', '', 0, 0, 0, '', ''),
('race', 'stewart', 'Stewart', 7700, 0, 0, '', '1647-7', '', 0, 0, 0, '', ''),
('race', 'stillaguamish', 'Stillaguamish', 7710, 0, 0, '', '1535-4', '', 0, 0, 0, '', ''),
('race', 'stockbridge', 'Stockbridge', 7720, 0, 0, '', '1649-3', '', 0, 0, 0, '', ''),
('race', 'stonyford', 'Stonyford', 7740, 0, 0, '', '1471-2', '', 0, 0, 0, '', ''),
('race', 'stony_river', 'Stony River', 7730, 0, 0, '', '1797-0', '', 0, 0, 0, '', ''),
('race', 'st_croix_chippewa', 'St. Croix Chippewa', 7600, 0, 0, '', '1144-5', '', 0, 0, 0, '', ''),
('race', 'st_george', 'St. George', 7610, 0, 0, '', '2021-4', '', 0, 0, 0, '', ''),
('race', 'st_marys', 'St. Mary\'s', 7620, 0, 0, '', '1963-8', '', 0, 0, 0, '', ''),
('race', 'st_michael', 'St. Michael', 7630, 0, 0, '', '1951-3', '', 0, 0, 0, '', ''),
('race', 'st_paul', 'St. Paul', 7640, 0, 0, '', '2022-2', '', 0, 0, 0, '', ''),
('race', 'sugpiaq', 'Sugpiaq', 7750, 0, 0, '', '2002-4', '', 0, 0, 0, '', ''),
('race', 'sulphur_bank', 'Sulphur Bank', 7760, 0, 0, '', '1472-0', '', 0, 0, 0, '', ''),
('race', 'summit_lake', 'Summit Lake', 7770, 0, 0, '', '1434-0', '', 0, 0, 0, '', ''),
('race', 'suqpigaq', 'Suqpigaq', 7780, 0, 0, '', '2004-0', '', 0, 0, 0, '', ''),
('race', 'suquamish', 'Suquamish', 7790, 0, 0, '', '1536-2', '', 0, 0, 0, '', ''),
('race', 'susanville', 'Susanville', 7800, 0, 0, '', '1651-9', '', 0, 0, 0, '', ''),
('race', 'susquehanock', 'Susquehanock', 7810, 0, 0, '', '1245-0', '', 0, 0, 0, '', ''),
('race', 'swinomish', 'Swinomish', 7820, 0, 0, '', '1537-0', '', 0, 0, 0, '', ''),
('race', 'sycuan', 'Sycuan', 7830, 0, 0, '', '1231-0', '', 0, 0, 0, '', ''),
('race', 'syrian', 'Syrian', 7840, 0, 0, '', '2125-3', '', 0, 0, 0, '', ''),
('race', 'table_bluff', 'Table Bluff', 7850, 0, 0, '', '1705-3', '', 0, 0, 0, '', ''),
('race', 'tachi', 'Tachi', 7860, 0, 0, '', '1719-4', '', 0, 0, 0, '', ''),
('race', 'tahitian', 'Tahitian', 7870, 0, 0, '', '2081-8', '', 0, 0, 0, '', ''),
('race', 'taiwanese', 'Taiwanese', 7880, 0, 0, '', '2035-4', '', 0, 0, 0, '', ''),
('race', 'takelma', 'Takelma', 7890, 0, 0, '', '1063-7', '', 0, 0, 0, '', ''),
('race', 'takotna', 'Takotna', 7900, 0, 0, '', '1798-8', '', 0, 0, 0, '', ''),
('race', 'talakamish', 'Talakamish', 7910, 0, 0, '', '1397-9', '', 0, 0, 0, '', ''),
('race', 'tanacross', 'Tanacross', 7920, 0, 0, '', '1799-6', '', 0, 0, 0, '', ''),
('race', 'tanaina', 'Tanaina', 7930, 0, 0, '', '1800-2', '', 0, 0, 0, '', ''),
('race', 'tanana', 'Tanana', 7940, 0, 0, '', '1801-0', '', 0, 0, 0, '', ''),
('race', 'tanana_chiefs', 'Tanana Chiefs', 7950, 0, 0, '', '1802-8', '', 0, 0, 0, '', ''),
('race', 'taos', 'Taos', 7960, 0, 0, '', '1511-5', '', 0, 0, 0, '', ''),
('race', 'tatitlek', 'Tatitlek', 7970, 0, 0, '', '1969-5', '', 0, 0, 0, '', ''),
('race', 'tazlina', 'Tazlina', 7980, 0, 0, '', '1803-6', '', 0, 0, 0, '', ''),
('race', 'te-moak_western_shoshone', 'Te-Moak Western Shoshone', 8020, 0, 0, '', '1596-6', '', 0, 0, 0, '', ''),
('race', 'telida', 'Telida', 7990, 0, 0, '', '1804-4', '', 0, 0, 0, '', ''),
('race', 'teller', 'Teller', 8000, 0, 0, '', '1883-8', '', 0, 0, 0, '', ''),
('race', 'temecula', 'Temecula', 8010, 0, 0, '', '1338-3', '', 0, 0, 0, '', ''),
('race', 'tenakee_springs', 'Tenakee Springs', 8030, 0, 0, '', '1832-5', '', 0, 0, 0, '', ''),
('race', 'tenino', 'Tenino', 8040, 0, 0, '', '1398-7', '', 0, 0, 0, '', ''),
('race', 'tesuque', 'Tesuque', 8050, 0, 0, '', '1512-3', '', 0, 0, 0, '', ''),
('race', 'tetlin', 'Tetlin', 8060, 0, 0, '', '1805-1', '', 0, 0, 0, '', ''),
('race', 'teton_sioux', 'Teton Sioux', 8070, 0, 0, '', '1634-5', '', 0, 0, 0, '', ''),
('race', 'tewa', 'Tewa', 8080, 0, 0, '', '1513-1', '', 0, 0, 0, '', ''),
('race', 'texas_kickapoo', 'Texas Kickapoo', 8090, 0, 0, '', '1307-8', '', 0, 0, 0, '', ''),
('race', 'thai', 'Thai', 8100, 0, 0, '', '2046-1', '', 0, 0, 0, '', ''),
('race', 'thlopthlocco', 'Thlopthlocco', 8110, 0, 0, '', '1204-7', '', 0, 0, 0, '', ''),
('race', 'tigua', 'Tigua', 8120, 0, 0, '', '1514-9', '', 0, 0, 0, '', ''),
('race', 'tillamook', 'Tillamook', 8130, 0, 0, '', '1399-5', '', 0, 0, 0, '', ''),
('race', 'timbi-sha_shoshone', 'Timbi-Sha Shoshone', 8140, 0, 0, '', '1597-4', '', 0, 0, 0, '', ''),
('race', 'tlingit', 'Tlingit', 8150, 0, 0, '', '1833-3', '', 0, 0, 0, '', ''),
('race', 'tlingit-haida', 'Tlingit-Haida', 8160, 0, 0, '', '1813-5', '', 0, 0, 0, '', ''),
('race', 'tlingit_and_haida_tribes', 'Central Council of Tlingit and Haida Tribes', 1320, 0, 0, '', '1815-0', '', 0, 0, 0, '', ''),
('race', 'tobagoan', 'Tobagoan', 8170, 0, 0, '', '2073-5', '', 0, 0, 0, '', ''),
('race', 'togiak', 'Togiak', 8180, 0, 0, '', '1956-2', '', 0, 0, 0, '', ''),
('race', 'tohono_oodham', 'Tohono O\'Odham', 8190, 0, 0, '', '1653-5', '', 0, 0, 0, '', ''),
('race', 'tok', 'Tok', 8200, 0, 0, '', '1806-9', '', 0, 0, 0, '', ''),
('race', 'tokelauan', 'Tokelauan', 8210, 0, 0, '', '2083-4', '', 0, 0, 0, '', ''),
('race', 'toksook', 'Toksook', 8220, 0, 0, '', '1957-0', '', 0, 0, 0, '', ''),
('race', 'tolowa', 'Tolowa', 8230, 0, 0, '', '1659-2', '', 0, 0, 0, '', ''),
('race', 'tonawanda_seneca', 'Tonawanda Seneca', 8240, 0, 0, '', '1293-0', '', 0, 0, 0, '', ''),
('race', 'tongan', 'Tongan', 8250, 0, 0, '', '2082-6', '', 0, 0, 0, '', ''),
('race', 'tonkawa', 'Tonkawa', 8260, 0, 0, '', '1661-8', '', 0, 0, 0, '', ''),
('race', 'torres-martinez', 'Torres-Martinez', 8270, 0, 0, '', '1051-2', '', 0, 0, 0, '', ''),
('race', 'trinidadian', 'Trinidadian', 8280, 0, 0, '', '2074-3', '', 0, 0, 0, '', ''),
('race', 'trinity', 'Trinity', 8290, 0, 0, '', '1272-4', '', 0, 0, 0, '', ''),
('race', 'tsimshian', 'Tsimshian', 8300, 0, 0, '', '1837-4', '', 0, 0, 0, '', ''),
('race', 'tuckabachee', 'Tuckabachee', 8310, 0, 0, '', '1205-4', '', 0, 0, 0, '', ''),
('race', 'tulalip', 'Tulalip', 8320, 0, 0, '', '1538-8', '', 0, 0, 0, '', ''),
('race', 'tule_river', 'Tule River', 8330, 0, 0, '', '1720-2', '', 0, 0, 0, '', ''),
('race', 'tulukskak', 'Tulukskak', 8340, 0, 0, '', '1958-8', '', 0, 0, 0, '', ''),
('race', 'tunica_biloxi', 'Tunica Biloxi', 8350, 0, 0, '', '1246-8', '', 0, 0, 0, '', ''),
('race', 'tuntutuliak', 'Tuntutuliak', 8360, 0, 0, '', '1959-6', '', 0, 0, 0, '', ''),
('race', 'tununak', 'Tununak', 8370, 0, 0, '', '1960-4', '', 0, 0, 0, '', ''),
('race', 'turtle_mountain', 'Turtle Mountain', 8380, 0, 0, '', '1147-8', '', 0, 0, 0, '', ''),
('race', 'tuscarora', 'Tuscarora', 8390, 0, 0, '', '1294-8', '', 0, 0, 0, '', ''),
('race', 'tuscola', 'Tuscola', 8400, 0, 0, '', '1096-7', '', 0, 0, 0, '', ''),
('race', 'twenty-nine_palms', 'Twenty-Nine Palms', 8410, 0, 0, '', '1337-5', '', 0, 0, 0, '', ''),
('race', 'twin_hills', 'Twin Hills', 8420, 0, 0, '', '1961-2', '', 0, 0, 0, '', ''),
('race', 'two_kettle_sioux', 'Two Kettle Sioux', 8430, 0, 0, '', '1635-2', '', 0, 0, 0, '', ''),
('race', 'tygh', 'Tygh', 8440, 0, 0, '', '1663-4', '', 0, 0, 0, '', ''),
('race', 'tyonek', 'Tyonek', 8450, 0, 0, '', '1807-7', '', 0, 0, 0, '', ''),
('race', 'ugashik', 'Ugashik', 8460, 0, 0, '', '1970-3', '', 0, 0, 0, '', ''),
('race', 'uintah_ute', 'Uintah Ute', 8470, 0, 0, '', '1672-5', '', 0, 0, 0, '', ''),
('race', 'umatilla', 'Umatilla', 8480, 0, 0, '', '1665-9', '', 0, 0, 0, '', ''),
('race', 'umkumiate', 'Umkumiate', 8490, 0, 0, '', '1964-6', '', 0, 0, 0, '', ''),
('race', 'umpqua', 'Umpqua', 8500, 0, 0, '', '1667-5', '', 0, 0, 0, '', ''),
('race', 'unalakleet', 'Unalakleet', 8510, 0, 0, '', '1884-6', '', 0, 0, 0, '', ''),
('race', 'unalaska', 'Unalaska', 8520, 0, 0, '', '2025-5', '', 0, 0, 0, '', ''),
('race', 'unangan_aleut', 'Unangan Aleut', 8530, 0, 0, '', '2006-5', '', 0, 0, 0, '', ''),
('race', 'unga', 'Unga', 8540, 0, 0, '', '2026-3', '', 0, 0, 0, '', ''),
('race', 'united_ketowah_band_of_cheroke', 'United Keetowah Band of Cherokee', 8550, 0, 0, '', '1097-5', '', 0, 0, 0, '', ''),
('race', 'upper_chinook', 'Upper Chinook', 8560, 0, 0, '', '1118-9', '', 0, 0, 0, '', ''),
('race', 'upper_sioux', 'Upper Sioux', 8570, 0, 0, '', '1636-0', '', 0, 0, 0, '', ''),
('race', 'upper_skagit', 'Upper Skagit', 8580, 0, 0, '', '1539-6', '', 0, 0, 0, '', ''),
('race', 'ute', 'Ute', 8590, 0, 0, '', '1670-9', '', 0, 0, 0, '', ''),
('race', 'ute_mountain_ute', 'Ute Mountain Ute', 8600, 0, 0, '', '1673-3', '', 0, 0, 0, '', ''),
('race', 'utu_utu_gwaitu_paiute', 'Utu Utu Gwaitu Paiute', 8610, 0, 0, '', '1435-7', '', 0, 0, 0, '', ''),
('race', 'venetie', 'Venetie', 8620, 0, 0, '', '1808-5', '', 0, 0, 0, '', ''),
('race', 'vietnamese', 'Vietnamese', 8630, 0, 0, '', '2047-9', '', 0, 0, 0, '', ''),
('race', 'waccamaw-siousan', 'Waccamaw-Siousan', 8640, 0, 0, '', '1247-6', '', 0, 0, 0, '', ''),
('race', 'wahpekute_sioux', 'Wahpekute Sioux', 8650, 0, 0, '', '1637-8', '', 0, 0, 0, '', ''),
('race', 'wahpeton_sioux', 'Wahpeton Sioux', 8660, 0, 0, '', '1638-6', '', 0, 0, 0, '', ''),
('race', 'wailaki', 'Wailaki', 8670, 0, 0, '', '1675-8', '', 0, 0, 0, '', ''),
('race', 'wainwright', 'Wainwright', 8680, 0, 0, '', '1885-3', '', 0, 0, 0, '', ''),
('race', 'wakiakum_chinook', 'Wakiakum Chinook', 8690, 0, 0, '', '1119-7', '', 0, 0, 0, '', ''),
('race', 'wales', 'Wales', 8700, 0, 0, '', '1886-1', '', 0, 0, 0, '', ''),
('race', 'walker_river', 'Walker River', 8710, 0, 0, '', '1436-5', '', 0, 0, 0, '', ''),
('race', 'walla-walla', 'Walla-Walla', 8720, 0, 0, '', '1677-4', '', 0, 0, 0, '', ''),
('race', 'wampanoag', 'Wampanoag', 8730, 0, 0, '', '1679-0', '', 0, 0, 0, '', ''),
('race', 'wappo', 'Wappo', 8740, 0, 0, '', '1064-5', '', 0, 0, 0, '', ''),
('race', 'warm_springs', 'Warm Springs', 8750, 0, 0, '', '1683-2', '', 0, 0, 0, '', ''),
('race', 'wascopum', 'Wascopum', 8760, 0, 0, '', '1685-7', '', 0, 0, 0, '', ''),
('race', 'washakie', 'Washakie', 8770, 0, 0, '', '1598-2', '', 0, 0, 0, '', ''),
('race', 'washoe', 'Washoe', 8780, 0, 0, '', '1687-3', '', 0, 0, 0, '', ''),
('race', 'wazhaza_sioux', 'Wazhaza Sioux', 8790, 0, 0, '', '1639-4', '', 0, 0, 0, '', ''),
('race', 'wenatchee', 'Wenatchee', 8800, 0, 0, '', '1400-1', '', 0, 0, 0, '', ''),
('race', 'western_cherokee', 'Western Cherokee', 8820, 0, 0, '', '1098-3', '', 0, 0, 0, '', ''),
('race', 'western_chickahominy', 'Western Chickahominy', 8830, 0, 0, '', '1110-6', '', 0, 0, 0, '', ''),
('race', 'west_indian', 'West Indian', 8810, 0, 0, '', '2075-0', '', 0, 0, 0, '', ''),
('race', 'whilkut', 'Whilkut', 8840, 0, 0, '', '1273-2', '', 0, 0, 0, '', ''),
('race', 'white', 'White', 50, 0, 0, '', '2106-3', '', 0, 0, 1, '', ''),
('race', 'white_earth', 'White Earth', 8860, 0, 0, '', '1148-6', '', 0, 0, 0, '', ''),
('race', 'white_mountain', 'White Mountain', 8870, 0, 0, '', '1887-9', '', 0, 0, 0, '', ''),
('race', 'white_mountain_apache', 'White Mountain Apache', 8880, 0, 0, '', '1019-9', '', 0, 0, 0, '', ''),
('race', 'white_mountain_inupiat', 'White Mountain Inupiat', 8890, 0, 0, '', '1888-7', '', 0, 0, 0, '', ''),
('race', 'wichita', 'Wichita', 8900, 0, 0, '', '1692-3', '', 0, 0, 0, '', ''),
('race', 'wicomico', 'Wicomico', 8910, 0, 0, '', '1248-4', '', 0, 0, 0, '', ''),
('race', 'willapa_chinook', 'Willapa Chinook', 8920, 0, 0, '', '1120-5', '', 0, 0, 0, '', ''),
('race', 'wind_river', 'Wind River', 8930, 0, 0, '', '1694-9', '', 0, 0, 0, '', ''),
('race', 'wind_river_arapaho', 'Wind River Arapaho', 8940, 0, 0, '', '1024-9', '', 0, 0, 0, '', ''),
('race', 'wind_river_shoshone', 'Wind River Shoshone', 8950, 0, 0, '', '1599-0', '', 0, 0, 0, '', ''),
('race', 'winnebago', 'Winnebago', 8960, 0, 0, '', '1696-4', '', 0, 0, 0, '', ''),
('race', 'winnemucca', 'Winnemucca', 8970, 0, 0, '', '1700-4', '', 0, 0, 0, '', ''),
('race', 'wintun', 'Wintun', 8980, 0, 0, '', '1702-0', '', 0, 0, 0, '', ''),
('race', 'wisconsin_potawatomi', 'Wisconsin Potawatomi', 8990, 0, 0, '', '1485-2', '', 0, 0, 0, '', ''),
('race', 'wiseman', 'Wiseman', 9000, 0, 0, '', '1809-3', '', 0, 0, 0, '', ''),
('race', 'wishram', 'Wishram', 9010, 0, 0, '', '1121-3', '', 0, 0, 0, '', ''),
('race', 'wiyot', 'Wiyot', 9020, 0, 0, '', '1704-6', '', 0, 0, 0, '', ''),
('race', 'wrangell', 'Wrangell', 9030, 0, 0, '', '1834-1', '', 0, 0, 0, '', ''),
('race', 'wyandotte', 'Wyandotte', 9040, 0, 0, '', '1295-5', '', 0, 0, 0, '', ''),
('race', 'yahooskin', 'Yahooskin', 9050, 0, 0, '', '1401-9', '', 0, 0, 0, '', ''),
('race', 'yakama', 'Yakama', 9060, 0, 0, '', '1707-9', '', 0, 0, 0, '', ''),
('race', 'yakama_cowlitz', 'Yakama Cowlitz', 9070, 0, 0, '', '1709-5', '', 0, 0, 0, '', ''),
('race', 'yakutat', 'Yakutat', 9080, 0, 0, '', '1835-8', '', 0, 0, 0, '', ''),
('race', 'yana', 'Yana', 9090, 0, 0, '', '1065-2', '', 0, 0, 0, '', ''),
('race', 'yanktonai_sioux', 'Yanktonai Sioux', 9110, 0, 0, '', '1641-0', '', 0, 0, 0, '', ''),
('race', 'yankton_sioux', 'Yankton Sioux', 9100, 0, 0, '', '1640-2', '', 0, 0, 0, '', ''),
('race', 'yapese', 'Yapese', 9120, 0, 0, '', '2098-2', '', 0, 0, 0, '', ''),
('race', 'yaqui', 'Yaqui', 9130, 0, 0, '', '1711-1', '', 0, 0, 0, '', ''),
('race', 'yavapai', 'Yavapai', 9140, 0, 0, '', '1731-9', '', 0, 0, 0, '', ''),
('race', 'yavapai_apache', 'Yavapai Apache', 9150, 0, 0, '', '1715-2', '', 0, 0, 0, '', ''),
('race', 'yerington_paiute', 'Yerington Paiute', 9160, 0, 0, '', '1437-3', '', 0, 0, 0, '', ''),
('race', 'yokuts', 'Yokuts', 9170, 0, 0, '', '1717-8', '', 0, 0, 0, '', ''),
('race', 'yomba', 'Yomba', 9180, 0, 0, '', '1600-6', '', 0, 0, 0, '', ''),
('race', 'yuchi', 'Yuchi', 9190, 0, 0, '', '1722-8', '', 0, 0, 0, '', ''),
('race', 'yuki', 'Yuki', 9200, 0, 0, '', '1066-0', '', 0, 0, 0, '', ''),
('race', 'yuman', 'Yuman', 9210, 0, 0, '', '1724-4', '', 0, 0, 0, '', ''),
('race', 'yupik_eskimo', 'Yupik Eskimo', 9220, 0, 0, '', '1896-0', '', 0, 0, 0, '', ''),
('race', 'yurok', 'Yurok', 9230, 0, 0, '', '1732-7', '', 0, 0, 0, '', ''),
('race', 'zairean', 'Zairean', 9240, 0, 0, '', '2066-9', '', 0, 0, 0, '', '');
INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`, `subtype`, `list_options_icon`) VALUES
('race', 'zia', 'Zia', 9250, 0, 0, '', '1515-6', '', 0, 0, 0, '', ''),
('race', 'zuni', 'Zuni', 9260, 0, 0, '', '1516-4', '', 0, 0, 0, '', ''),
('reaction', 'hives', 'Hives', 20, 0, 0, '', NULL, 'SNOMED-CT:247472004', 0, 0, 1, '', ''),
('reaction', 'nausea', 'Nausea', 30, 0, 0, '', NULL, 'SNOMED-CT:422587007', 0, 0, 1, '', ''),
('reaction', 'shortness_of_breath', 'Shortness of Breath', 40, 0, 0, '', NULL, 'SNOMED-CT:267036007', 0, 0, 1, '', ''),
('reaction', 'unassigned', 'Unassigned', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Coupon', 'Coupon', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Direct Mail', 'Direct Mail', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Employee', 'Employee', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Newspaper', 'Newspaper', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Other', 'Other', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Patient', 'Patient', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Radio', 'Radio', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Referral Card', 'Referral Card', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'T.V.', 'T.V.', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('refsource', 'Walk-In', 'Walk-In', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('religious_affiliation', 'adventist', 'Adventist', 5, 0, 0, '', '1001', '', 0, 0, 1, '', ''),
('religious_affiliation', 'african_religions', 'African Religions', 15, 0, 0, '', '1002', '', 0, 0, 1, '', ''),
('religious_affiliation', 'afro-caribbean_religions', 'Afro-Caribbean Religions', 25, 0, 0, '', '1003', '', 0, 0, 1, '', ''),
('religious_affiliation', 'agnosticism', 'Agnosticism', 35, 0, 0, '', '1004', '', 0, 0, 1, '', ''),
('religious_affiliation', 'anglican', 'Anglican', 45, 0, 0, '', '1005', '', 0, 0, 1, '', ''),
('religious_affiliation', 'animism', 'Animism', 55, 0, 0, '', '1006', '', 0, 0, 1, '', ''),
('religious_affiliation', 'assembly_of_god', 'Assembly of God', 65, 0, 0, '', '1061', '', 0, 0, 1, '', ''),
('religious_affiliation', 'atheist', 'NONE (non-theist, atheist)', 75, 0, 0, '', '1007', '', 0, 0, 1, '', ''),
('religious_affiliation', 'babi_bahai_faiths', 'Babi & Baha\'I faiths', 85, 0, 0, '', '1008', '', 0, 0, 1, '', ''),
('religious_affiliation', 'baptist', 'Baptist', 95, 0, 0, '', '1009', '', 0, 0, 1, '', ''),
('religious_affiliation', 'bon', 'Bon', 105, 0, 0, '', '1010', '', 0, 0, 1, '', ''),
('religious_affiliation', 'brethren', 'Brethren', 115, 0, 0, '', '1062', '', 0, 0, 1, '', ''),
('religious_affiliation', 'cao_dai', 'Cao Dai', 125, 0, 0, '', '1011', '', 0, 0, 1, '', ''),
('religious_affiliation', 'celticism', 'Celticism', 135, 0, 0, '', '1012', '', 0, 0, 1, '', ''),
('religious_affiliation', 'christiannoncatholicnonspecifc', 'Christian (non-Catholic, non-specific)', 145, 0, 0, '', '1013', '', 0, 0, 1, '', ''),
('religious_affiliation', 'christian_scientist', 'Christian Scientist', 155, 0, 0, '', '1063', '', 0, 0, 1, '', ''),
('religious_affiliation', 'church_of_christ', 'Church of Christ', 165, 0, 0, '', '1064', '', 0, 0, 1, '', ''),
('religious_affiliation', 'church_of_god', 'Church of God', 175, 0, 0, '', '1065', '', 0, 0, 1, '', ''),
('religious_affiliation', 'confucianism', 'Confucianism', 185, 0, 0, '', '1014', '', 0, 0, 1, '', ''),
('religious_affiliation', 'congregational', 'Congregational', 195, 0, 0, '', '1066', '', 0, 0, 1, '', ''),
('religious_affiliation', 'cyberculture_religions', 'Cyberculture Religions', 205, 0, 0, '', '1015', '', 0, 0, 1, '', ''),
('religious_affiliation', 'disciples_of_christ', 'Disciples of Christ', 215, 0, 0, '', '1067', '', 0, 0, 1, '', ''),
('religious_affiliation', 'divination', 'Divination', 225, 0, 0, '', '1016', '', 0, 0, 1, '', ''),
('religious_affiliation', 'eastern_orthodox', 'Eastern Orthodox', 235, 0, 0, '', '1068', '', 0, 0, 1, '', ''),
('religious_affiliation', 'episcopalian', 'Episcopalian', 245, 0, 0, '', '1069', '', 0, 0, 1, '', ''),
('religious_affiliation', 'evangelical_covenant', 'Evangelical Covenant', 255, 0, 0, '', '1070', '', 0, 0, 1, '', ''),
('religious_affiliation', 'fourth_way', 'Fourth Way', 265, 0, 0, '', '1017', '', 0, 0, 1, '', ''),
('religious_affiliation', 'free_daism', 'Free Daism', 275, 0, 0, '', '1018', '', 0, 0, 1, '', ''),
('religious_affiliation', 'friends', 'Friends', 285, 0, 0, '', '1071', '', 0, 0, 1, '', ''),
('religious_affiliation', 'full_gospel', 'Full Gospel', 295, 0, 0, '', '1072', '', 0, 0, 1, '', ''),
('religious_affiliation', 'gnosis', 'Gnosis', 305, 0, 0, '', '1019', '', 0, 0, 1, '', ''),
('religious_affiliation', 'hinduism', 'Hinduism', 315, 0, 0, '', '1020', '', 0, 0, 1, '', ''),
('religious_affiliation', 'humanism', 'Humanism', 325, 0, 0, '', '1021', '', 0, 0, 1, '', ''),
('religious_affiliation', 'independent', 'Independent', 335, 0, 0, '', '1022', '', 0, 0, 1, '', ''),
('religious_affiliation', 'islam', 'Islam', 345, 0, 0, '', '1023', '', 0, 0, 1, '', ''),
('religious_affiliation', 'jainism', 'Jainism', 355, 0, 0, '', '1024', '', 0, 0, 1, '', ''),
('religious_affiliation', 'jehovahs_witnesses', 'Jehovah\'s Witnesses', 365, 0, 0, '', '1025', '', 0, 0, 1, '', ''),
('religious_affiliation', 'judaism', 'Judaism', 375, 0, 0, '', '1026', '', 0, 0, 1, '', ''),
('religious_affiliation', 'latter_day_saints', 'Latter Day Saints', 385, 0, 0, '', '1027', '', 0, 0, 1, '', ''),
('religious_affiliation', 'lutheran', 'Lutheran', 395, 0, 0, '', '1028', '', 0, 0, 1, '', ''),
('religious_affiliation', 'mahayana', 'Mahayana', 405, 0, 0, '', '1029', '', 0, 0, 1, '', ''),
('religious_affiliation', 'meditation', 'Meditation', 415, 0, 0, '', '1030', '', 0, 0, 1, '', ''),
('religious_affiliation', 'messianic_judaism', 'Messianic Judaism', 425, 0, 0, '', '1031', '', 0, 0, 1, '', ''),
('religious_affiliation', 'methodist', 'Methodist', 435, 0, 0, '', '1073', '', 0, 0, 1, '', ''),
('religious_affiliation', 'mitraism', 'Mitraism', 445, 0, 0, '', '1032', '', 0, 0, 1, '', ''),
('religious_affiliation', 'native_american', 'Native American', 455, 0, 0, '', '1074', '', 0, 0, 1, '', ''),
('religious_affiliation', 'nazarene', 'Nazarene', 465, 0, 0, '', '1075', '', 0, 0, 1, '', ''),
('religious_affiliation', 'new_age', 'New Age', 475, 0, 0, '', '1033', '', 0, 0, 1, '', ''),
('religious_affiliation', 'non-roman_catholic', 'non-Roman Catholic', 485, 0, 0, '', '1034', '', 0, 0, 1, '', ''),
('religious_affiliation', 'occult', 'Occult', 495, 0, 0, '', '1035', '', 0, 0, 1, '', ''),
('religious_affiliation', 'orthodox', 'Orthodox', 505, 0, 0, '', '1036', '', 0, 0, 1, '', ''),
('religious_affiliation', 'paganism', 'Paganism', 515, 0, 0, '', '1037', '', 0, 0, 1, '', ''),
('religious_affiliation', 'pentecostal', 'Pentecostal', 525, 0, 0, '', '1038', '', 0, 0, 1, '', ''),
('religious_affiliation', 'presbyterian', 'Presbyterian', 535, 0, 0, '', '1076', '', 0, 0, 1, '', ''),
('religious_affiliation', 'process_the', 'Process, The', 545, 0, 0, '', '1039', '', 0, 0, 1, '', ''),
('religious_affiliation', 'protestant', 'Protestant', 555, 0, 0, '', '1077', '', 0, 0, 1, '', ''),
('religious_affiliation', 'protestant_no_denomination', 'Protestant, No Denomination', 565, 0, 0, '', '1078', '', 0, 0, 1, '', ''),
('religious_affiliation', 'reformed', 'Reformed', 575, 0, 0, '', '1079', '', 0, 0, 1, '', ''),
('religious_affiliation', 'reformed_presbyterian', 'Reformed/Presbyterian', 585, 0, 0, '', '1040', '', 0, 0, 1, '', ''),
('religious_affiliation', 'roman_catholic_church', 'Roman Catholic Church', 595, 0, 0, '', '1041', '', 0, 0, 1, '', ''),
('religious_affiliation', 'salvation_army', 'Salvation Army', 605, 0, 0, '', '1080', '', 0, 0, 1, '', ''),
('religious_affiliation', 'satanism', 'Satanism', 615, 0, 0, '', '1042', '', 0, 0, 1, '', ''),
('religious_affiliation', 'scientology', 'Scientology', 625, 0, 0, '', '1043', '', 0, 0, 1, '', ''),
('religious_affiliation', 'shamanism', 'Shamanism', 635, 0, 0, '', '1044', '', 0, 0, 1, '', ''),
('religious_affiliation', 'shiite_islam', 'Shiite (Islam)', 645, 0, 0, '', '1045', '', 0, 0, 1, '', ''),
('religious_affiliation', 'shinto', 'Shinto', 655, 0, 0, '', '1046', '', 0, 0, 1, '', ''),
('religious_affiliation', 'sikism', 'Sikism', 665, 0, 0, '', '1047', '', 0, 0, 1, '', ''),
('religious_affiliation', 'spiritualism', 'Spiritualism', 675, 0, 0, '', '1048', '', 0, 0, 1, '', ''),
('religious_affiliation', 'sunni_islam', 'Sunni (Islam)', 685, 0, 0, '', '1049', '', 0, 0, 1, '', ''),
('religious_affiliation', 'taoism', 'Taoism', 695, 0, 0, '', '1050', '', 0, 0, 1, '', ''),
('religious_affiliation', 'theravada', 'Theravada', 705, 0, 0, '', '1051', '', 0, 0, 1, '', ''),
('religious_affiliation', 'unitarian-universalism', 'Unitarian-Universalism', 725, 0, 0, '', '1052', '', 0, 0, 1, '', ''),
('religious_affiliation', 'unitarian_universalist', 'Unitarian Universalist', 715, 0, 0, '', '1081', '', 0, 0, 1, '', ''),
('religious_affiliation', 'united_church_of_christ', 'United Church of Christ', 735, 0, 0, '', '1082', '', 0, 0, 1, '', ''),
('religious_affiliation', 'universal_life_church', 'Universal Life Church', 745, 0, 0, '', '1053', '', 0, 0, 1, '', ''),
('religious_affiliation', 'vajrayana_tibetan', 'Vajrayana (Tibetan)', 755, 0, 0, '', '1054', '', 0, 0, 1, '', ''),
('religious_affiliation', 'veda', 'Veda', 765, 0, 0, '', '1055', '', 0, 0, 1, '', ''),
('religious_affiliation', 'voodoo', 'Voodoo', 775, 0, 0, '', '1056', '', 0, 0, 1, '', ''),
('religious_affiliation', 'wicca', 'Wicca', 785, 0, 0, '', '1057', '', 0, 0, 1, '', ''),
('religious_affiliation', 'yaohushua', 'Yaohushua', 795, 0, 0, '', '1058', '', 0, 0, 1, '', ''),
('religious_affiliation', 'zen_buddhism', 'Zen Buddhism', 805, 0, 0, '', '1059', '', 0, 0, 1, '', ''),
('religious_affiliation', 'zoroastrianism', 'Zoroastrianism', 815, 0, 0, '', '1060', '', 0, 0, 1, '', ''),
('riskfactors', 'all', 'Allergies', 14, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'ast', 'Asthma', 16, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'br', 'Breast Disease', 12, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'cl', 'Contact Lenses', 18, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'coc', 'Contraceptive Complication (specify)', 19, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'db', 'Diabetes', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'dpr', 'Depression', 13, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'ep', 'Epilepsy', 17, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'fib', 'Fibroids', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'gb', 'Gall Bladder Condition', 11, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'hd', 'Heart Disease', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'hep', 'Hepatitis', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'ht', 'Hypertension', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'inf', 'Infertility', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'mig', 'Severe Migraine', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'oth', 'Other (specify)', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'pid', 'PID (Pelvic Inflammatory Disease)', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'sc', 'Sickle Cell', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'str', 'Thrombosis/Stroke', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('riskfactors', 'vv', 'Varicose Veins', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('risklevel', 'high', 'High', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('risklevel', 'low', 'Low', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('risklevel', 'medium', 'Medium', 2, 1, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_appointment', 'Appointment', 160, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_bmi', 'BMI', 43, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_bp', 'Blood Pressure', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_colon_cancer_screen', 'Colon Cancer Screening', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_exercise', 'Exercise', 47, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_eye', 'Opthalmic', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_foot', 'Podiatric', 100, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_hemo_a1c', 'Hemoglobin A1C', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_influvacc', 'Influenza Vaccine', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_lab_inr', 'INR', 150, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_mammo', 'Mammogram', 110, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_nutrition', 'Nutrition', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_pap', 'Pap Smear', 120, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_penicillin_allergy', 'Penicillin Allergy', 157, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_pneumovacc', 'Pneumococcal Vaccine', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_prostate_cancer_screen', 'Prostate Cancer Screening', 140, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_soc_sec', 'Social Security Number', 155, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_tobacco', 'Tobacco', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_urine_alb', 'Urine Microalbumin', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action', 'act_wt', 'Weight', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_assess', 'Assessment', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_edu', 'Education', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_exam', 'Examination', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_inter', 'Intervention', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_measure', 'Measurement', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_remind', 'Reminder', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_action_category', 'act_cat_treat', 'Treatment', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_age_intervals', 'month', 'Month', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_age_intervals', 'year', 'Year', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_comparisons', 'EXIST', 'Exist', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_comparisons', 'ge', 'Greater Than or Equal To', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_comparisons', 'gt', 'Greater Than', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_comparisons', 'le', 'Less Than or Equal To', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_comparisons', 'lt', 'Less Than', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_acute_inp_or_ed', 'encounter acute inpatient or ED', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_hea_and_beh', 'encounter health and behavior assessment', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_influenza', 'encounter influenza', 150, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_nonac_inp_out_or_opth', 'Encounter: encounter non-acute inpt, outpatient, or ophthalmology', 140, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_nurs_discharge', 'encounter nursing discharge', 130, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_nurs_fac', 'encounter nursing facility', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_occ_ther', 'encounter occupational therapy', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_off_vis', 'encounter office visit', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_outpatient', 'encounter outpatient', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_out_pcp_obgyn', 'encounter outpatient w/PCP & obgyn', 110, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pregnancy', 'encounter pregnancy', 120, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pre_ind_counsel', 'encounter preventive medicine - individual counseling', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pre_med_group_counsel', 'encounter preventive medicine group counseling', 90, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pre_med_other_serv', 'encounter preventive medicine other services', 100, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pre_med_ser_18_older', 'encounter preventive medicine services 18 and older', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_pre_med_ser_40_older', 'encounter preventive medicine 40 and older', 75, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_enc_types', 'enc_psych_and_psych', 'encounter psychiatric & psychologic', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_age_max', 'Maximum Age', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_age_min', 'Minimum Age', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_database', 'Database', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_diagnosis', 'Diagnosis', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_lists', 'Lists', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_proc', 'Procedure', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_filters', 'filt_sex', 'Gender', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_due_opt', 'due', 'Due', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_due_opt', 'not_due', 'Not Due', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_due_opt', 'past_due', 'Past Due', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_due_opt', 'soon_due', 'Due Soon', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_inactive_opt', 'auto', 'Automatic', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_inactive_opt', 'due_status_update', 'Due Status Update', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_inactive_opt', 'manual', 'Manual', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_intervals', 'month', 'Month', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_intervals', 'week', 'Week', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_methods', 'clinical_reminder_post', 'Soon Due Interval (Clinical Reminders)', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_methods', 'clinical_reminder_pre', 'Past Due Interval (Clinical Reminders)', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_methods', 'patient_reminder_post', 'Soon Due Interval (Patient Reminders)', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_reminder_methods', 'patient_reminder_pre', 'Past Due Interval (Patient Reminders)', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_targets', 'target_appt', 'Appointment', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_targets', 'target_database', 'Database', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_targets', 'target_interval', 'Interval', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_targets', 'target_proc', 'Procedure', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'day', 'Day', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'flu_season', 'Flu Season', 80, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'hour', 'Hour', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'minute', 'Minute', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'month', 'Month', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'second', 'Second', 70, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'week', 'Week', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('rule_target_intervals', 'year', 'Year', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('severity_ccda', 'fatal', 'Fatal', 80, 0, 0, '', NULL, 'SNOMED-CT:399166001', 0, 0, 1, '', ''),
('severity_ccda', 'life_threatening_severity', 'Life threatening severity', 70, 0, 0, '', NULL, 'SNOMED-CT:442452003', 0, 0, 1, '', ''),
('severity_ccda', 'mild', 'Mild', 20, 0, 0, '', NULL, 'SNOMED-CT:255604002', 0, 0, 1, '', ''),
('severity_ccda', 'mild_to_moderate', 'Mild to moderate', 30, 0, 0, '', NULL, 'SNOMED-CT:371923003', 0, 0, 1, '', ''),
('severity_ccda', 'moderate', 'Moderate', 40, 0, 0, '', NULL, 'SNOMED-CT:6736007', 0, 0, 1, '', ''),
('severity_ccda', 'moderate_to_severe', 'Moderate to severe', 50, 0, 0, '', NULL, 'SNOMED-CT:371924009', 0, 0, 1, '', ''),
('severity_ccda', 'severe', 'Severe', 60, 0, 0, '', NULL, 'SNOMED-CT:24484000', 0, 0, 1, '', ''),
('severity_ccda', 'unassigned', 'Unassigned', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sex', 'Female', 'Female', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sex', 'Male', 'Male', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('smoking_status', '1', 'Current every day smoker', 10, 0, 0, '', NULL, 'SNOMED-CT:449868002', 0, 0, 1, '', ''),
('smoking_status', '15', 'Heavy tobacco smoker', 70, 0, 0, '', NULL, 'SNOMED-CT:428071000124103', 0, 0, 1, '', ''),
('smoking_status', '16', 'Light tobacco smoker', 80, 0, 0, '', NULL, 'SNOMED-CT:428061000124105', 0, 0, 1, '', ''),
('smoking_status', '2', 'Current some day smoker', 20, 0, 0, '', NULL, 'SNOMED-CT:428041000124106', 0, 0, 1, '', ''),
('smoking_status', '3', 'Former smoker', 30, 0, 0, '', NULL, 'SNOMED-CT:8517006', 0, 0, 1, '', ''),
('smoking_status', '4', 'Never smoker', 40, 0, 0, '', NULL, 'SNOMED-CT:266919005', 0, 0, 1, '', ''),
('smoking_status', '5', 'Smoker, current status unknown', 50, 0, 0, '', NULL, 'SNOMED-CT:77176002', 0, 0, 1, '', ''),
('smoking_status', '9', 'Unknown if ever smoked', 60, 0, 0, '', NULL, 'SNOMED-CT:266927001', 0, 0, 1, '', ''),
('state', 'AK', 'Alaska', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'AL', 'Alabama', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'AR', 'Arkansas', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'AZ', 'Arizona', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'CA', 'California', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'CO', 'Colorado', 6, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'CT', 'Connecticut', 7, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'DC', 'District of Columbia', 9, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'DE', 'Delaware', 8, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'FL', 'Florida', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'GA', 'Georgia', 11, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'HI', 'Hawaii', 12, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'IA', 'Iowa', 16, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'ID', 'Idaho', 13, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'IL', 'Illinois', 14, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'IN', 'Indiana', 15, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'KS', 'Kansas', 17, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'KY', 'Kentucky', 18, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'LA', 'Louisiana', 19, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MA', 'Massachusetts', 22, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MD', 'Maryland', 21, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'ME', 'Maine', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MI', 'Michigan', 23, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MN', 'Minnesota', 24, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MO', 'Missouri', 26, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MS', 'Mississippi', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'MT', 'Montana', 27, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NC', 'North Carolina', 34, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'ND', 'North Dakota', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NE', 'Nebraska', 28, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NH', 'New Hampshire', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NJ', 'New Jersey', 31, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NM', 'New Mexico', 32, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NV', 'Nevada', 29, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'NY', 'New York', 33, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'OH', 'Ohio', 36, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'OK', 'Oklahoma', 37, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'OR', 'Oregon', 38, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'PA', 'Pennsylvania', 39, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'RI', 'Rhode Island', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'SC', 'South Carolina', 41, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'SD', 'South Dakota', 42, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'TN', 'Tennessee', 43, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'TX', 'Texas', 44, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'UT', 'Utah', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'VA', 'Virginia', 47, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'VT', 'Vermont', 46, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'WA', 'Washington', 48, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'WI', 'Wisconsin', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'WV', 'West Virginia', 49, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('state', 'WY', 'Wyoming', 51, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sub_relation', 'child', 'Child', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sub_relation', 'other', 'Other', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sub_relation', 'self', 'Self', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('sub_relation', 'spouse', 'Spouse', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('surgery_issue_list', 'appendectomy', 'appendectomy', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('surgery_issue_list', 'cholecystectomy', 'cholecystectomy', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('surgery_issue_list', 'tonsillectomy', 'tonsillectomy', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('titles', 'Dr.', 'Dr.', 4, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('titles', 'Mr.', 'Mr.', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('titles', 'Mrs.', 'Mrs.', 2, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('titles', 'Ms.', 'Ms.', 3, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions', 'LBTbill', 'Billing', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions', 'LBTlegal', 'Legal', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions', 'LBTphreq', 'Physician Request', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions', 'LBTptreq', 'Patient Request', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions', 'LBTref', 'Referral', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('transactions_modifiers', '59', '59', 20, 0, 0, '', '', '', 0, 0, 1, '', ''),
('transactions_modifiers', 'GP', 'GP', 10, 0, 0, '', '', '', 0, 0, 1, '', ''),
('transactions_modifiers', 'KX', 'KX', 30, 0, 0, '', '', '', 0, 0, 1, '', ''),
('ub_admit_source', '1', 'Physician Referral', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '2', 'Clinic Referral', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '3', 'HMO Referral', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '4', 'Transfer from Hospital', 25, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '5', 'Transfer from SNF', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '6', 'Transfer From Another Health Care Facility', 35, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '7', 'Emergency Room', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '8', 'Court/Law Enforcement', 45, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_source', '9', 'Information Not Available', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '1', 'Emergency', 10, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '2', 'Urgent', 20, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '3', 'Elective', 30, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '4', 'Newborn', 40, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '5', 'Trauma', 50, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('ub_admit_type', '9', 'Information Not Available', 60, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist1', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist2', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist3', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist4', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist5', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist6', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('userlist7', 'sample', 'Sample', 1, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('warehouse', 'onsite', 'On Site', 5, 0, 0, '', NULL, '', 0, 0, 1, '', ''),
('yesno', 'NO', 'NO', 1, 0, 0, '', 'N', '', 0, 0, 1, '', ''),
('yesno', 'YES', 'YES', 2, 0, 0, '', 'Y', '', 0, 0, 1, '', '');

CREATE TABLE `log` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `comments` longtext,
  `user_notes` longtext,
  `patient_id` bigint(20) DEFAULT NULL,
  `success` tinyint(1) DEFAULT '1',
  `checksum` longtext,
  `crt_user` varchar(255) DEFAULT NULL,
  `log_from` varchar(20) DEFAULT 'LibreEHR',
  `menu_item_id` int(11) DEFAULT NULL,
  `ccda_doc_id` int(11) DEFAULT NULL COMMENT 'CCDA document id from ccda'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `log_comment_encrypt` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `encrypt` enum('Yes','No') NOT NULL DEFAULT 'No',
  `checksum` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `misc_address_book` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `street` varchar(60) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notes` (
  `id` int(11) NOT NULL DEFAULT '0',
  `foreign_id` int(11) NOT NULL DEFAULT '0',
  `note` varchar(255) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `revision` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notification_log` (
  `iLogId` int(11) NOT NULL,
  `pid` int(7) NOT NULL,
  `pc_eid` int(11) UNSIGNED DEFAULT NULL,
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
  `dSentDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notification_settings` (
  `SettingsId` int(3) NOT NULL,
  `Send_SMS_Before_Hours` int(3) NOT NULL,
  `Send_Email_Before_Hours` int(3) NOT NULL,
  `SMS_gateway_username` varchar(100) NOT NULL,
  `SMS_gateway_password` varchar(100) NOT NULL,
  `SMS_gateway_apikey` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `notification_settings` (`SettingsId`, `Send_SMS_Before_Hours`, `Send_Email_Before_Hours`, `SMS_gateway_username`, `SMS_gateway_password`, `SMS_gateway_apikey`, `type`) VALUES
(1, 150, 150, 'sms username', 'sms password', 'sms api key', 'SMS/Email Settings');

CREATE TABLE `onsite_documents` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `onsite_mail` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `owner` varchar(128) DEFAULT NULL,
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
  `is_msg_encrypted` tinyint(2) DEFAULT '0' COMMENT 'Whether messsage encrypted 0-Not encrypted, 1-Encrypted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `onsite_messages` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `message` longtext,
  `ip` varchar(15) NOT NULL,
  `date` datetime NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'who sent id',
  `recip_id` varchar(255) NOT NULL COMMENT 'who to id array'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Portal messages';

CREATE TABLE `onsite_online` (
  `hash` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_update` datetime NOT NULL,
  `username` varchar(64) NOT NULL,
  `userid` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `onsite_portal_activity` (
  `id` bigint(20) NOT NULL,
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
  `checksum` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `onsite_signatures` (
  `id` bigint(20) NOT NULL,
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
  `ip` varchar(46) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `patient_access_onsite` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `portal_username` varchar(100) DEFAULT NULL,
  `portal_pwd` varchar(100) DEFAULT NULL,
  `portal_pwd_status` tinyint(4) DEFAULT '1' COMMENT '0=>Password Created Through Demographics by The provider or staff. Patient Should Change it at first time it.1=>Pwd updated or created by patient itself',
  `portal_salt` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `patient_data` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(255) NOT NULL DEFAULT '',
  `financial` varchar(255) NOT NULL DEFAULT '',
  `fname` varchar(255) NOT NULL DEFAULT '',
  `lname` varchar(255) NOT NULL DEFAULT '',
  `mname` varchar(255) NOT NULL DEFAULT '',
  `nickname` text,
  `DOB` date DEFAULT NULL,
  `facility` int(11) DEFAULT NULL,
  `street` varchar(255) NOT NULL DEFAULT '',
  `postal_code` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT '',
  `country_code` varchar(255) NOT NULL DEFAULT '',
  `drivers_license` varchar(255) NOT NULL DEFAULT '',
  `ss` varchar(255) NOT NULL DEFAULT '',
  `occupation` longtext,
  `phone_home` varchar(255) NOT NULL DEFAULT '',
  `phone_biz` varchar(255) NOT NULL DEFAULT '',
  `phone_contact` varchar(255) NOT NULL DEFAULT '',
  `phone_cell` varchar(255) NOT NULL DEFAULT '',
  `pharmacy_id` int(11) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT '',
  `contact_relationship` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `sex` varchar(255) NOT NULL DEFAULT '',
  `referrer` varchar(255) NOT NULL DEFAULT '',
  `referrerID` varchar(255) NOT NULL DEFAULT '',
  `providerID` int(11) DEFAULT NULL,
  `ref_providerID` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `email_direct` varchar(255) NOT NULL DEFAULT '',
  `contact_pref` varchar(10) NOT NULL DEFAULT '' COMMENT 'Patient Contact Preference - email, text, phone call',
  `ethnoracial` varchar(255) NOT NULL DEFAULT '',
  `race` varchar(255) NOT NULL DEFAULT '',
  `ethnicity` varchar(255) NOT NULL DEFAULT '',
  `religion` varchar(40) NOT NULL DEFAULT '',
  `interpretter` varchar(255) NOT NULL DEFAULT '',
  `migrantseasonal` varchar(255) NOT NULL DEFAULT '',
  `family_size` varchar(255) NOT NULL DEFAULT '',
  `monthly_income` varchar(255) NOT NULL DEFAULT '',
  `billing_note` text,
  `homeless` varchar(255) NOT NULL DEFAULT '',
  `financial_review` datetime DEFAULT NULL,
  `pubpid` varchar(255) NOT NULL DEFAULT '',
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `hipaa_mail` varchar(3) NOT NULL DEFAULT '',
  `hipaa_voice` varchar(3) NOT NULL DEFAULT '',
  `hipaa_notice` varchar(3) NOT NULL DEFAULT '',
  `hipaa_message` varchar(20) NOT NULL DEFAULT '',
  `hipaa_allowsms` varchar(3) NOT NULL DEFAULT 'NO',
  `hipaa_allowemail` varchar(3) NOT NULL DEFAULT 'NO',
  `referral_source` varchar(30) NOT NULL DEFAULT '',
  `pricelevel` varchar(255) NOT NULL DEFAULT 'standard',
  `regdate` date DEFAULT NULL COMMENT 'Registration Date',
  `contrastart` date DEFAULT NULL COMMENT 'Date contraceptives initially used',
  `completed_ad` varchar(3) NOT NULL DEFAULT 'NO',
  `ad_reviewed` date DEFAULT NULL,
  `vfc` varchar(255) NOT NULL DEFAULT '',
  `mothersname` varchar(255) NOT NULL DEFAULT '',
  `guardiansname` text,
  `guardian_fname` text,
  `guardian_mname` text,
  `guardian_lname` text,
  `guardian_relationship` text,
  `guardian_sex` varchar(255) NOT NULL DEFAULT '',
  `guardian_address` varchar(255) NOT NULL DEFAULT '',
  `guardian_city` varchar(255) NOT NULL DEFAULT '',
  `guardian_state` varchar(2) NOT NULL DEFAULT '',
  `guardian_postal_code` varchar(50) NOT NULL DEFAULT '',
  `guardian_country` varchar(50) NOT NULL DEFAULT '',
  `guardian_home_phone` varchar(15) NOT NULL DEFAULT '',
  `guardian_work_phone` varchar(15) NOT NULL DEFAULT '',
  `guardian_mobile_phone` varchar(15) NOT NULL DEFAULT '',
  `guardian_email` varchar(150) NOT NULL DEFAULT '',
  `guardian_pid` int(11) DEFAULT NULL,
  `allow_imm_reg_use` varchar(255) NOT NULL DEFAULT '',
  `allow_imm_info_share` varchar(255) NOT NULL DEFAULT '',
  `allow_health_info_ex` varchar(255) NOT NULL DEFAULT '',
  `allow_patient_portal` varchar(31) NOT NULL DEFAULT '',
  `deceased_date` datetime DEFAULT NULL,
  `deceased_reason` varchar(255) NOT NULL DEFAULT '',
  `soap_import_status` tinyint(4) DEFAULT NULL COMMENT '1-Prescription Press 2-Prescription Import 3-Allergy Press 4-Allergy Import',
  `care_team` int(11) DEFAULT NULL,
  `county` varchar(40) NOT NULL DEFAULT '',
  `statement_y_n` text,
  `industry` text,
  `patient_pref_schd` text,
  `pref_facility_id` int(5) DEFAULT NULL COMMENT 'patient preferred treatment facility id from db.facility',
  `work_status` varchar(25) NOT NULL DEFAULT '',
  `pcpID` int(11) DEFAULT NULL,
  `picture_url` varchar(2000) NOT NULL DEFAULT '',
  `transaction_billing_note` text COMMENT 'Transaction Screen Notes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `patient_reminders` (
  `id` bigint(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 if active and 0 if not active',
  `date_inactivated` datetime DEFAULT NULL,
  `reason_inactivated` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_inactive_opt',
  `due_status` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_due_opt',
  `pid` bigint(20) NOT NULL COMMENT 'id from patient_data table',
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table',
  `date_created` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `voice_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 if not sent and 1 if sent',
  `sms_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 if not sent and 1 if sent',
  `email_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 if not sent and 1 if sent',
  `mail_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 if not sent and 1 if sent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `patient_tracker` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `apptdate` date DEFAULT NULL,
  `appttime` time DEFAULT NULL,
  `eid` bigint(20) NOT NULL DEFAULT '0',
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `original_user` varchar(255) NOT NULL DEFAULT '' COMMENT 'This is the user that created the original record',
  `encounter` bigint(20) NOT NULL DEFAULT '0',
  `lastseq` varchar(4) NOT NULL DEFAULT '' COMMENT 'The element file should contain this number of elements',
  `random_drug_test` tinyint(1) DEFAULT NULL COMMENT 'NULL if not randomized. If randomized, 0 is no, 1 is yes',
  `drug_screen_completed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `patient_tracker_element` (
  `pt_tracker_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'maps to id column in patient_tracker table',
  `start_datetime` datetime DEFAULT NULL,
  `room` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(31) NOT NULL DEFAULT '',
  `seq` varchar(4) NOT NULL DEFAULT '' COMMENT 'This is a numerical sequence for this pt_tracker_id events',
  `user` varchar(255) NOT NULL DEFAULT '' COMMENT 'This is the user that created this element',
  `reason` varchar(255) NOT NULL DEFAULT '' COMMENT 'This is the reason for cancellation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `dtime` datetime NOT NULL,
  `encounter` bigint(20) NOT NULL DEFAULT '0',
  `user` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `amount1` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount2` decimal(12,2) NOT NULL DEFAULT '0.00',
  `posted1` decimal(12,2) NOT NULL DEFAULT '0.00',
  `posted2` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `payment_gateway_details` (
  `id` int(11) NOT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `transaction_key` varchar(255) DEFAULT NULL,
  `md5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pharmacies` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `transmit_method` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `phone_numbers` (
  `id` int(11) NOT NULL DEFAULT '0',
  `country_code` varchar(5) DEFAULT NULL,
  `area_code` char(3) DEFAULT NULL,
  `prefix` char(3) DEFAULT NULL,
  `number` varchar(4) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `foreign_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pnotes` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `body` longtext,
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) DEFAULT NULL,
  `activity` tinyint(4) DEFAULT NULL,
  `authorized` tinyint(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `assigned_to` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0' COMMENT 'flag indicates note is deleted',
  `message_status` varchar(20) NOT NULL DEFAULT 'New',
  `portal_relation` varchar(100) DEFAULT NULL,
  `is_msg_encrypted` tinyint(2) DEFAULT '0' COMMENT 'Whether messsage encrypted 0-Not encrypted, 1-Encrypted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `filled_by_id` int(11) DEFAULT NULL,
  `pharmacy_id` int(11) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `date_modified` date DEFAULT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `encounter` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `drug` varchar(150) DEFAULT NULL,
  `drug_id` int(11) NOT NULL DEFAULT '0',
  `rxnorm_drugcode` int(11) DEFAULT NULL,
  `form` int(3) DEFAULT NULL,
  `dosage` varchar(100) DEFAULT NULL,
  `quantity` varchar(31) DEFAULT NULL,
  `size` varchar(16) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `route` int(11) DEFAULT NULL,
  `interval` int(11) DEFAULT NULL,
  `substitute` int(11) DEFAULT NULL,
  `refills` int(11) DEFAULT NULL,
  `per_refill` int(11) DEFAULT NULL,
  `filled_date` date DEFAULT NULL,
  `medication` int(11) DEFAULT NULL,
  `note` text,
  `active` int(11) NOT NULL DEFAULT '1',
  `datetime` datetime DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `prescriptionguid` varchar(50) DEFAULT NULL,
  `erx_source` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-LibreEHR 1-External',
  `erx_uploaded` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Pending NewCrop upload 1-Uploaded to NewCrop',
  `drug_info_erx` text,
  `external_id` varchar(20) DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `indication` text,
  `prn` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `prices` (
  `pr_id` varchar(11) NOT NULL DEFAULT '',
  `pr_selector` varchar(255) NOT NULL DEFAULT '' COMMENT 'template selector for drugs, empty for codes',
  `pr_level` varchar(31) NOT NULL DEFAULT '',
  `pr_price` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'price in local currency'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_answers` (
  `procedure_order_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11) NOT NULL DEFAULT '0' COMMENT 'references procedure_order_code.procedure_order_seq',
  `question_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'references procedure_questions.question_code',
  `answer_seq` int(11) NOT NULL COMMENT 'supports multiple-choice questions',
  `answer` varchar(255) NOT NULL DEFAULT '' COMMENT 'answer data'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_order` (
  `procedure_order_id` bigint(20) NOT NULL,
  `provider_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references users.id, the ordering provider',
  `patient_id` bigint(20) NOT NULL COMMENT 'references patient_data.pid',
  `encounter_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references form_encounter.encounter',
  `date_collected` datetime DEFAULT NULL COMMENT 'time specimen collected',
  `date_ordered` date DEFAULT NULL,
  `order_priority` varchar(31) NOT NULL DEFAULT '',
  `order_status` varchar(31) NOT NULL DEFAULT '' COMMENT 'pending,routed,complete,canceled',
  `patient_instructions` text,
  `activity` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 if deleted',
  `control_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'This is the CONTROL ID that is sent back from lab',
  `lab_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references procedure_providers.ppid',
  `specimen_type` varchar(31) NOT NULL DEFAULT '' COMMENT 'from the Specimen_Type list',
  `specimen_location` varchar(31) NOT NULL DEFAULT '' COMMENT 'from the Specimen_Location list',
  `specimen_volume` varchar(30) NOT NULL DEFAULT '' COMMENT 'from a text input field',
  `date_transmitted` datetime DEFAULT NULL COMMENT 'time of order transmission, null if unsent',
  `clinical_hx` varchar(255) NOT NULL DEFAULT '' COMMENT 'clinical history text that may be relevant to the order',
  `external_id` varchar(20) DEFAULT NULL,
  `history_order` enum('0','1') DEFAULT '0' COMMENT 'references order is added for history purpose only.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_order_code` (
  `procedure_order_id` bigint(20) NOT NULL COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11) NOT NULL COMMENT 'supports multiple tests per order',
  `procedure_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'like procedure_type.procedure_code',
  `procedure_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'descriptive name of the procedure code',
  `procedure_source` char(1) NOT NULL DEFAULT '1' COMMENT '1=original order, 2=added after order sent',
  `diagnoses` text COMMENT 'diagnoses and maybe other coding (e.g. ICD9:111.11)',
  `do_not_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = normal, 1 = do not transmit to lab',
  `procedure_order_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_providers` (
  `ppid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `npi` varchar(15) NOT NULL DEFAULT '',
  `send_app_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Sending application ID (MSH-3.1)',
  `send_fac_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Sending facility ID (MSH-4.1)',
  `recv_app_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Receiving application ID (MSH-5.1)',
  `recv_fac_id` varchar(255) NOT NULL DEFAULT '' COMMENT 'Receiving facility ID (MSH-6.1)',
  `DorP` char(1) NOT NULL DEFAULT 'D' COMMENT 'Debugging or Production (MSH-11)',
  `direction` char(1) NOT NULL DEFAULT 'B' COMMENT 'Bidirectional or Results-only',
  `protocol` varchar(15) NOT NULL DEFAULT 'DL',
  `remote_host` varchar(255) NOT NULL DEFAULT '',
  `login` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `orders_path` varchar(255) NOT NULL DEFAULT '',
  `results_path` varchar(255) NOT NULL DEFAULT '',
  `notes` text,
  `lab_director` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_questions` (
  `lab_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references procedure_providers.ppid to identify the lab',
  `procedure_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'references procedure_type.procedure_code to identify this order type',
  `question_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'code identifying this question',
  `seq` int(11) NOT NULL DEFAULT '0' COMMENT 'sequence number for ordering',
  `question_text` varchar(255) NOT NULL DEFAULT '' COMMENT 'descriptive text for question_code',
  `required` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = required, 0 = not',
  `maxsize` int(11) NOT NULL DEFAULT '0' COMMENT 'maximum length if text input field',
  `fldtype` char(1) NOT NULL DEFAULT 'T' COMMENT 'Text, Number, Select, Multiselect, Date, Gestational-age',
  `options` text COMMENT 'choices for fldtype S and T',
  `tips` varchar(255) NOT NULL DEFAULT '' COMMENT 'Additional instructions for answering the question',
  `activity` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = active, 0 = inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_report` (
  `procedure_report_id` bigint(20) NOT NULL,
  `procedure_order_id` bigint(20) DEFAULT NULL COMMENT 'references procedure_order.procedure_order_id',
  `procedure_order_seq` int(11) NOT NULL DEFAULT '1' COMMENT 'references procedure_order_code.procedure_order_seq',
  `date_collected` datetime DEFAULT NULL,
  `date_collected_tz` varchar(5) DEFAULT '' COMMENT '+-hhmm offset from UTC',
  `date_report` datetime DEFAULT NULL,
  `date_report_tz` varchar(5) DEFAULT '' COMMENT '+-hhmm offset from UTC',
  `source` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references users.id, who entered this data',
  `specimen_num` varchar(63) NOT NULL DEFAULT '',
  `report_status` varchar(31) NOT NULL DEFAULT '' COMMENT 'received,complete,error',
  `review_status` varchar(31) NOT NULL DEFAULT 'received' COMMENT 'pending review status: received,reviewed',
  `report_notes` text COMMENT 'notes from the lab'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_result` (
  `procedure_result_id` bigint(20) NOT NULL,
  `procedure_report_id` bigint(20) NOT NULL COMMENT 'references procedure_report.procedure_report_id',
  `result_data_type` char(1) NOT NULL DEFAULT 'S' COMMENT 'N=Numeric, S=String, F=Formatted, E=External, L=Long text as first line of comments',
  `result_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'LOINC code, might match a procedure_type.procedure_code',
  `result_text` varchar(255) NOT NULL DEFAULT '' COMMENT 'Description of result_code',
  `date` datetime DEFAULT NULL COMMENT 'lab-provided date specific to this result',
  `facility` varchar(255) NOT NULL DEFAULT '' COMMENT 'lab-provided testing facility ID',
  `units` varchar(31) NOT NULL DEFAULT '',
  `result` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `abnormal` varchar(31) NOT NULL DEFAULT '' COMMENT 'no,yes,high,low',
  `comments` text COMMENT 'comments from the lab',
  `document_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references documents.id if this result is a document',
  `result_status` varchar(31) NOT NULL DEFAULT '' COMMENT 'preliminary, cannot be done, final, corrected, incompete...etc.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `procedure_type` (
  `procedure_type_id` bigint(20) NOT NULL,
  `parent` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references procedure_type.procedure_type_id',
  `name` varchar(63) NOT NULL DEFAULT '' COMMENT 'name for this category, procedure or result type',
  `lab_id` bigint(20) NOT NULL DEFAULT '0' COMMENT 'references procedure_providers.ppid, 0 means default to parent',
  `procedure_code` varchar(31) NOT NULL DEFAULT '' COMMENT 'code identifying this procedure',
  `procedure_type` varchar(31) NOT NULL DEFAULT '' COMMENT 'see list proc_type',
  `body_site` varchar(31) NOT NULL DEFAULT '' COMMENT 'where to do injection, e.g. arm, buttok',
  `specimen` varchar(31) NOT NULL DEFAULT '' COMMENT 'blood, urine, saliva, etc.',
  `route_admin` varchar(31) NOT NULL DEFAULT '' COMMENT 'oral, injection',
  `laterality` varchar(31) NOT NULL DEFAULT '' COMMENT 'left, right, ...',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT 'descriptive text for procedure_code',
  `standard_code` varchar(255) NOT NULL DEFAULT '' COMMENT 'industry standard code type and code (e.g. CPT4:12345)',
  `related_code` varchar(255) NOT NULL DEFAULT '' COMMENT 'suggested code(s) for followup services if result is abnormal',
  `units` varchar(31) NOT NULL DEFAULT '' COMMENT 'default for procedure_result.units',
  `range` varchar(255) NOT NULL DEFAULT '' COMMENT 'default for procedure_result.range',
  `seq` int(11) NOT NULL DEFAULT '0' COMMENT 'sequence number for ordering',
  `activity` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=active, 0=inactive',
  `notes` varchar(255) NOT NULL DEFAULT '' COMMENT 'additional notes to enhance description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `product_warehouse` (
  `pw_drug_id` int(11) NOT NULL,
  `pw_warehouse` varchar(31) NOT NULL,
  `pw_min_level` float DEFAULT '0',
  `pw_max_level` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pt_accident_claim` (
  `pac_id` int(20) NOT NULL,
  `pac_case_number` int(20) NOT NULL COMMENT 'case_number in pt_case table',
  `pac_pid` int(20) NOT NULL COMMENT 'patient_data.pid',
  `pac_claim_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Auto accident or Workers Comp',
  `pac_state` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'State where accident occurred for auto accident',
  `pac_provider_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'MCO Provider/Auto Insurance Name',
  `pac_claim_no` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'MCO Provider/Auto Insurance Claim Number',
  `pac_rep_name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'MCO Provider/Auto Insurance Rep name',
  `pac_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'MCO Provider/Auto Insurance Rep contact number',
  `pac_notes` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'accident claim notes',
  `pac_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pac_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pt_case` (
  `case_number` int(20) NOT NULL,
  `pc_patient_id` int(11) NOT NULL COMMENT 'patient_data.pid',
  `pc_case_status` enum('OPEN','CLOSED','CANCELED') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'OPEN',
  `pc_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pc_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `pt_case_info` (
  `pci_id` int(20) NOT NULL,
  `pci_case_number` int(20) NOT NULL COMMENT 'case_number in pt_case table',
  `pci_case_injury_type` text COLLATE utf8_unicode_ci COMMENT 'injury type from patient intake',
  `pci_case_injury_date` date DEFAULT NULL COMMENT 'date of injury',
  `pci_insurance_data_id` int(20) DEFAULT NULL,
  `pci_case_auto_accident` tinyint(1) DEFAULT NULL COMMENT 'Is this an auto accident case? 1=yes',
  `pci_case_workers_comp` tinyint(1) DEFAULT NULL COMMENT 'Is this a workers comp case? 1=yes',
  `pci_case_accident_claim_id` int(20) DEFAULT NULL COMMENT 'References pt_accident_claim.pac_id',
  `pci_surgery` tinyint(1) DEFAULT NULL COMMENT 'Did the patient have recent surgery?',
  `pci_surgery_date` date DEFAULT NULL COMMENT 'date of the surgery',
  `pci_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pci_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pci_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `registry` (`name`, `state`, `directory`, `id`, `sql_run`, `unpackaged`, `date`, `priority`, `category`, `nickname`) VALUES
('New Encounter Form', 1, 'patient_encounter', 1, 1, 1, '2003-09-14 15:16:45', 0, 'Administrative', ''),
('Speech Dictation', 1, 'dictation', 10, 1, 1, '2003-09-14 15:16:45', 0, 'Clinical', ''),
('Vitals', 1, 'vitals', 12, 1, 1, '2005-03-03 00:16:34', 0, 'Clinical', ''),
('Fee Sheet', 1, 'fee_sheet', 14, 1, 1, '2007-07-28 00:00:00', 0, 'Administrative', ''),
('Misc Billing Options HCFA', 1, 'misc_billing_options', 15, 1, 1, '2007-07-28 00:00:00', 0, 'Administrative', ''),
('Procedure Order', 1, 'procedure_order', 16, 1, 1, '2010-02-25 00:00:00', 0, 'Administrative', '');

CREATE TABLE `report_itemized` (
  `report_id` bigint(20) NOT NULL,
  `itemized_test_id` smallint(6) NOT NULL,
  `numerator_label` varchar(25) NOT NULL DEFAULT '' COMMENT 'Only used in special cases',
  `pass` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is fail, 1 is pass, 2 is excluded,9 is off',
  `pid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `report_results` (
  `report_id` bigint(20) NOT NULL,
  `field_id` varchar(31) NOT NULL DEFAULT '',
  `field_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rule_action` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `group_id` bigint(20) NOT NULL DEFAULT '1' COMMENT 'Contains group id to identify collection of targets in a rule',
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule_action` (`id`, `group_id`, `category`, `item`) VALUES
('rule_htn_bp_measure', 1, 'act_cat_measure', 'act_bp'),
('rule_tob_use_assess', 1, 'act_cat_assess', 'act_tobacco'),
('rule_tob_cess_inter', 1, 'act_cat_inter', 'act_tobacco'),
('rule_adult_wt_screen_fu', 1, 'act_cat_measure', 'act_wt'),
('rule_wt_assess_couns_child', 1, 'act_cat_measure', 'act_wt'),
('rule_wt_assess_couns_child', 2, 'act_cat_edu', 'act_wt'),
('rule_wt_assess_couns_child', 3, 'act_cat_edu', 'act_nutrition'),
('rule_wt_assess_couns_child', 4, 'act_cat_edu', 'act_exercise'),
('rule_wt_assess_couns_child', 5, 'act_cat_measure', 'act_bmi'),
('rule_influenza_ge_50', 1, 'act_cat_treat', 'act_influvacc'),
('rule_pneumovacc_ge_65', 1, 'act_cat_treat', 'act_pneumovacc'),
('rule_dm_hemo_a1c', 1, 'act_cat_measure', 'act_hemo_a1c'),
('rule_dm_urine_alb', 1, 'act_cat_measure', 'act_urine_alb'),
('rule_dm_eye', 1, 'act_cat_exam', 'act_eye'),
('rule_dm_foot', 1, 'act_cat_exam', 'act_foot'),
('rule_cs_mammo', 1, 'act_cat_measure', 'act_mammo'),
('rule_cs_pap', 1, 'act_cat_exam', 'act_pap'),
('rule_cs_colon', 1, 'act_cat_assess', 'act_colon_cancer_screen'),
('rule_cs_prostate', 1, 'act_cat_assess', 'act_prostate_cancer_screen'),
('rule_inr_monitor', 1, 'act_cat_measure', 'act_lab_inr'),
('rule_socsec_entry', 1, 'act_cat_assess', 'act_soc_sec'),
('rule_penicillin_allergy', 1, 'act_cat_assess', 'act_penicillin_allergy'),
('rule_blood_pressure', 1, 'act_cat_measure', 'act_bp'),
('rule_inr_measure', 1, 'act_cat_measure', 'act_lab_inr');

CREATE TABLE `rule_action_item` (
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_action_category',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_action',
  `clin_rem_link` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom html link in clinical reminder widget',
  `reminder_message` text COMMENT 'Custom message in patient reminder',
  `custom_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 indexed to rule_patient_data, 0 indexed within main schema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule_action_item` (`category`, `item`, `clin_rem_link`, `reminder_message`, `custom_flag`) VALUES
('act_cat_assess', 'act_colon_cancer_screen', '', '', 1),
('act_cat_assess', 'act_penicillin_allergy', '', '', 1),
('act_cat_assess', 'act_prostate_cancer_screen', '', '', 1),
('act_cat_assess', 'act_soc_sec', '', '', 0),
('act_cat_assess', 'act_tobacco', '', '', 0),
('act_cat_edu', 'act_exercise', '', '', 1),
('act_cat_edu', 'act_nutrition', '', '', 1),
('act_cat_edu', 'act_wt', '', '', 1),
('act_cat_exam', 'act_eye', '', '', 1),
('act_cat_exam', 'act_foot', '', '', 1),
('act_cat_exam', 'act_pap', '', '', 1),
('act_cat_inter', 'act_tobacco', '', '', 1),
('act_cat_measure', 'act_bmi', '', '', 0),
('act_cat_measure', 'act_bp', '', '', 0),
('act_cat_measure', 'act_hemo_a1c', '', '', 1),
('act_cat_measure', 'act_lab_inr', '', '', 0),
('act_cat_measure', 'act_mammo', '', '', 1),
('act_cat_measure', 'act_urine_alb', '', '', 1),
('act_cat_measure', 'act_wt', '', '', 0),
('act_cat_treat', 'act_influvacc', '', '', 0),
('act_cat_treat', 'act_pneumovacc', '', '', 0);

CREATE TABLE `rule_filter` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `include_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is exclude and 1 is include',
  `required_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is required and 1 is optional',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_filters',
  `method_detail` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options lists rule__intervals',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule_filter` (`id`, `include_flag`, `required_flag`, `method`, `method_detail`, `value`) VALUES
('rule_htn_bp_measure', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::HTN'),
('rule_tob_cess_inter', 1, 1, 'filt_database', '', 'LIFESTYLE::tobacco::current'),
('rule_adult_wt_screen_fu', 1, 1, 'filt_age_min', 'year', '18'),
('rule_wt_assess_couns_child', 1, 1, 'filt_age_max', 'year', '18'),
('rule_wt_assess_couns_child', 1, 1, 'filt_age_min', 'year', '2'),
('rule_influenza_ge_50', 1, 1, 'filt_age_min', 'year', '50'),
('rule_pneumovacc_ge_65', 1, 1, 'filt_age_min', 'year', '65'),
('rule_dm_hemo_a1c', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::diabetes'),
('rule_dm_urine_alb', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::diabetes'),
('rule_dm_eye', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::diabetes'),
('rule_dm_foot', 1, 0, 'filt_lists', 'medical_problem', 'CUSTOM::diabetes'),
('rule_cs_mammo', 1, 1, 'filt_age_min', 'year', '40'),
('rule_cs_mammo', 1, 1, 'filt_sex', '', 'Female'),
('rule_cs_pap', 1, 1, 'filt_age_min', 'year', '18'),
('rule_cs_pap', 1, 1, 'filt_sex', '', 'Female'),
('rule_cs_colon', 1, 1, 'filt_age_min', 'year', '50'),
('rule_cs_prostate', 1, 1, 'filt_age_min', 'year', '50'),
('rule_cs_prostate', 1, 1, 'filt_sex', '', 'Male'),
('rule_inr_monitor', 1, 0, 'filt_lists', 'medication', 'coumadin'),
('rule_inr_monitor', 1, 0, 'filt_lists', 'medication', 'warfarin'),
('rule_penicillin_allergy', 1, 0, 'filt_lists', 'allergy', 'penicillin');

CREATE TABLE `rule_patient_data` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `pid` bigint(20) NOT NULL,
  `category` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the category item in the rule_action_item table',
  `item` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the item column in the rule_action_item table',
  `complete` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list yesno',
  `result` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rule_reminder` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_methods',
  `method_detail` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_reminder_intervals',
  `value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule_reminder` (`id`, `method`, `method_detail`, `value`) VALUES
('rule_htn_bp_measure', 'clinical_reminder_pre', 'week', '2'),
('rule_htn_bp_measure', 'clinical_reminder_post', 'month', '1'),
('rule_htn_bp_measure', 'patient_reminder_pre', 'week', '2'),
('rule_htn_bp_measure', 'patient_reminder_post', 'month', '1'),
('rule_tob_use_assess', 'clinical_reminder_pre', 'week', '2'),
('rule_tob_use_assess', 'clinical_reminder_post', 'month', '1'),
('rule_tob_use_assess', 'patient_reminder_pre', 'week', '2'),
('rule_tob_use_assess', 'patient_reminder_post', 'month', '1'),
('rule_tob_cess_inter', 'clinical_reminder_pre', 'week', '2'),
('rule_tob_cess_inter', 'clinical_reminder_post', 'month', '1'),
('rule_tob_cess_inter', 'patient_reminder_pre', 'week', '2'),
('rule_tob_cess_inter', 'patient_reminder_post', 'month', '1'),
('rule_adult_wt_screen_fu', 'clinical_reminder_pre', 'week', '2'),
('rule_adult_wt_screen_fu', 'clinical_reminder_post', 'month', '1'),
('rule_adult_wt_screen_fu', 'patient_reminder_pre', 'week', '2'),
('rule_adult_wt_screen_fu', 'patient_reminder_post', 'month', '1'),
('rule_wt_assess_couns_child', 'clinical_reminder_pre', 'week', '2'),
('rule_wt_assess_couns_child', 'clinical_reminder_post', 'month', '1'),
('rule_wt_assess_couns_child', 'patient_reminder_pre', 'week', '2'),
('rule_wt_assess_couns_child', 'patient_reminder_post', 'month', '1'),
('rule_influenza_ge_50', 'clinical_reminder_pre', 'week', '2'),
('rule_influenza_ge_50', 'clinical_reminder_post', 'month', '1'),
('rule_influenza_ge_50', 'patient_reminder_pre', 'week', '2'),
('rule_influenza_ge_50', 'patient_reminder_post', 'month', '1'),
('rule_pneumovacc_ge_65', 'clinical_reminder_pre', 'week', '2'),
('rule_pneumovacc_ge_65', 'clinical_reminder_post', 'month', '1'),
('rule_pneumovacc_ge_65', 'patient_reminder_pre', 'week', '2'),
('rule_pneumovacc_ge_65', 'patient_reminder_post', 'month', '1'),
('rule_dm_hemo_a1c', 'clinical_reminder_pre', 'week', '2'),
('rule_dm_hemo_a1c', 'clinical_reminder_post', 'month', '1'),
('rule_dm_hemo_a1c', 'patient_reminder_pre', 'week', '2'),
('rule_dm_hemo_a1c', 'patient_reminder_post', 'month', '1'),
('rule_dm_urine_alb', 'clinical_reminder_pre', 'week', '2'),
('rule_dm_urine_alb', 'clinical_reminder_post', 'month', '1'),
('rule_dm_urine_alb', 'patient_reminder_pre', 'week', '2'),
('rule_dm_urine_alb', 'patient_reminder_post', 'month', '1'),
('rule_dm_eye', 'clinical_reminder_pre', 'week', '2'),
('rule_dm_eye', 'clinical_reminder_post', 'month', '1'),
('rule_dm_eye', 'patient_reminder_pre', 'week', '2'),
('rule_dm_eye', 'patient_reminder_post', 'month', '1'),
('rule_dm_foot', 'clinical_reminder_pre', 'week', '2'),
('rule_dm_foot', 'clinical_reminder_post', 'month', '1'),
('rule_dm_foot', 'patient_reminder_pre', 'week', '2'),
('rule_dm_foot', 'patient_reminder_post', 'month', '1'),
('rule_cs_mammo', 'clinical_reminder_pre', 'week', '2'),
('rule_cs_mammo', 'clinical_reminder_post', 'month', '1'),
('rule_cs_mammo', 'patient_reminder_pre', 'week', '2'),
('rule_cs_mammo', 'patient_reminder_post', 'month', '1'),
('rule_cs_pap', 'clinical_reminder_pre', 'week', '2'),
('rule_cs_pap', 'clinical_reminder_post', 'month', '1'),
('rule_cs_pap', 'patient_reminder_pre', 'week', '2'),
('rule_cs_pap', 'patient_reminder_post', 'month', '1'),
('rule_cs_colon', 'clinical_reminder_pre', 'week', '2'),
('rule_cs_colon', 'clinical_reminder_post', 'month', '1'),
('rule_cs_colon', 'patient_reminder_pre', 'week', '2'),
('rule_cs_colon', 'patient_reminder_post', 'month', '1'),
('rule_cs_prostate', 'clinical_reminder_pre', 'week', '2'),
('rule_cs_prostate', 'clinical_reminder_post', 'month', '1'),
('rule_cs_prostate', 'patient_reminder_pre', 'week', '2'),
('rule_cs_prostate', 'patient_reminder_post', 'month', '1'),
('rule_inr_monitor', 'clinical_reminder_pre', 'week', '2'),
('rule_inr_monitor', 'clinical_reminder_post', 'month', '1'),
('rule_inr_monitor', 'patient_reminder_pre', 'week', '2'),
('rule_inr_monitor', 'patient_reminder_post', 'month', '1'),
('rule_socsec_entry', 'clinical_reminder_pre', 'week', '2'),
('rule_socsec_entry', 'clinical_reminder_post', 'month', '1'),
('rule_socsec_entry', 'patient_reminder_pre', 'week', '2'),
('rule_socsec_entry', 'patient_reminder_post', 'month', '1'),
('rule_penicillin_allergy', 'clinical_reminder_pre', 'week', '2'),
('rule_penicillin_allergy', 'clinical_reminder_post', 'month', '1'),
('rule_penicillin_allergy', 'patient_reminder_pre', 'week', '2'),
('rule_penicillin_allergy', 'patient_reminder_post', 'month', '1'),
('rule_blood_pressure', 'clinical_reminder_pre', 'week', '2'),
('rule_blood_pressure', 'clinical_reminder_post', 'month', '1'),
('rule_blood_pressure', 'patient_reminder_pre', 'week', '2'),
('rule_blood_pressure', 'patient_reminder_post', 'month', '1'),
('rule_inr_measure', 'clinical_reminder_pre', 'week', '2'),
('rule_inr_measure', 'clinical_reminder_post', 'month', '1'),
('rule_inr_measure', 'patient_reminder_pre', 'week', '2'),
('rule_inr_measure', 'patient_reminder_post', 'month', '1');

CREATE TABLE `rule_target` (
  `id` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to the id column in the clinical_rules table',
  `group_id` bigint(20) NOT NULL DEFAULT '1' COMMENT 'Contains group id to identify collection of targets in a rule',
  `include_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is exclude and 1 is include',
  `required_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 is required and 1 is optional',
  `method` varchar(31) NOT NULL DEFAULT '' COMMENT 'Maps to list_options list rule_targets',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT 'Data is dependent on the method',
  `interval` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Only used in interval entries'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rule_target` (`id`, `group_id`, `include_flag`, `required_flag`, `method`, `value`, `interval`) VALUES
('rule_htn_bp_measure', 1, 1, 1, 'target_interval', 'year', 1),
('rule_htn_bp_measure', 1, 1, 1, 'target_database', '::form_vitals::bps::::::ge::1', 0),
('rule_htn_bp_measure', 1, 1, 1, 'target_database', '::form_vitals::bpd::::::ge::1', 0),
('rule_tob_use_assess', 1, 1, 1, 'target_database', 'LIFESTYLE::tobacco::', 0),
('rule_tob_cess_inter', 1, 1, 1, 'target_interval', 'year', 1),
('rule_tob_cess_inter', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_inter::act_tobacco::YES::ge::1', 0),
('rule_adult_wt_screen_fu', 1, 1, 1, 'target_database', '::form_vitals::weight::::::ge::1', 0),
('rule_wt_assess_couns_child', 1, 1, 1, 'target_database', '::form_vitals::weight::::::ge::1', 0),
('rule_wt_assess_couns_child', 1, 1, 1, 'target_interval', 'year', 3),
('rule_wt_assess_couns_child', 2, 1, 1, 'target_database', 'CUSTOM::act_cat_edu::act_wt::YES::ge::1', 0),
('rule_wt_assess_couns_child', 2, 1, 1, 'target_interval', 'year', 3),
('rule_wt_assess_couns_child', 3, 1, 1, 'target_database', 'CUSTOM::act_cat_edu::act_nutrition::YES::ge::1', 0),
('rule_wt_assess_couns_child', 3, 1, 1, 'target_interval', 'year', 3),
('rule_wt_assess_couns_child', 4, 1, 1, 'target_database', 'CUSTOM::act_cat_edu::act_exercise::YES::ge::1', 0),
('rule_wt_assess_couns_child', 4, 1, 1, 'target_interval', 'year', 3),
('rule_wt_assess_couns_child', 5, 1, 1, 'target_database', '::form_vitals::BMI::::::ge::1', 0),
('rule_wt_assess_couns_child', 5, 1, 1, 'target_interval', 'year', 3),
('rule_influenza_ge_50', 1, 1, 1, 'target_interval', 'flu_season', 1),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::15::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::16::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::88::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::111::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::125::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::126::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::127::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::128::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::135::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::140::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::141::ge::1', 0),
('rule_influenza_ge_50', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::144::ge::1', 0),
('rule_pneumovacc_ge_65', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::33::ge::1', 0),
('rule_pneumovacc_ge_65', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::100::ge::1', 0),
('rule_pneumovacc_ge_65', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::109::ge::1', 0),
('rule_pneumovacc_ge_65', 1, 1, 0, 'target_database', '::immunizations::cvx_code::eq::133::ge::1', 0),
('rule_dm_hemo_a1c', 1, 1, 1, 'target_interval', 'month', 3),
('rule_dm_hemo_a1c', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_measure::act_hemo_a1c::YES::ge::1', 0),
('rule_dm_urine_alb', 1, 1, 1, 'target_interval', 'year', 1),
('rule_dm_urine_alb', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_measure::act_urine_alb::YES::ge::1', 0),
('rule_dm_eye', 1, 1, 1, 'target_interval', 'year', 1),
('rule_dm_eye', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_exam::act_eye::YES::ge::1', 0),
('rule_dm_foot', 1, 1, 1, 'target_interval', 'year', 1),
('rule_dm_foot', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_exam::act_foot::YES::ge::1', 0),
('rule_cs_mammo', 1, 1, 1, 'target_interval', 'year', 1),
('rule_cs_mammo', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_measure::act_mammo::YES::ge::1', 0),
('rule_cs_pap', 1, 1, 1, 'target_interval', 'year', 1),
('rule_cs_pap', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_exam::act_pap::YES::ge::1', 0),
('rule_cs_colon', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_assess::act_colon_cancer_screen::YES::ge::1', 0),
('rule_cs_prostate', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_assess::act_prostate_cancer_screen::YES::ge::1', 0),
('rule_inr_monitor', 1, 1, 1, 'target_interval', 'week', 3),
('rule_inr_monitor', 1, 1, 1, 'target_proc', 'INR::CPT4:85610::::::ge::1', 0),
('rule_socsec_entry', 1, 1, 1, 'target_database', '::patient_data::ss::::::ge::1', 0),
('rule_penicillin_allergy', 1, 1, 1, 'target_interval', 'year', 1),
('rule_penicillin_allergy', 1, 1, 1, 'target_database', 'CUSTOM::act_cat_assess::act_penicillin_allergy::YES::ge::1', 0),
('rule_blood_pressure', 1, 1, 1, 'target_database', '::form_vitals::bps::::::ge::1', 0),
('rule_blood_pressure', 1, 1, 1, 'target_database', '::form_vitals::bpd::::::ge::1', 0),
('rule_inr_measure', 1, 1, 1, 'target_proc', 'INR::CPT4:85610::::::ge::1', 0);

CREATE TABLE `sequences` (
  `id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sequences` (`id`) VALUES
(1);

CREATE TABLE `shared_attributes` (
  `pid` bigint(20) NOT NULL,
  `encounter` bigint(20) NOT NULL COMMENT '0 if patient attribute, else encounter attribute',
  `field_id` varchar(31) NOT NULL COMMENT 'references layout_options.field_id',
  `last_update` datetime NOT NULL COMMENT 'time of last update',
  `user_id` bigint(20) NOT NULL COMMENT 'user who last updated',
  `field_value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `standardized_tables_track` (
  `id` int(11) NOT NULL,
  `imported_date` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT 'name of standardized tables such as RXNORM',
  `revision_version` varchar(255) NOT NULL DEFAULT '' COMMENT 'revision of standardized tables that were imported',
  `revision_date` datetime DEFAULT NULL COMMENT 'revision of standardized tables that were imported',
  `file_checksum` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `supported_external_dataloads` (
  `load_id` bigint(20) UNSIGNED NOT NULL,
  `load_type` varchar(24) NOT NULL DEFAULT '',
  `load_source` varchar(24) NOT NULL DEFAULT 'CMS',
  `load_release_date` date NOT NULL,
  `load_filename` varchar(256) NOT NULL DEFAULT '',
  `load_checksum` varchar(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `supported_external_dataloads` (`load_id`, `load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES
(1, 'ICD10', 'CMS', '2019-10-01', '2020-ICD-10-CM-Codes.zip', '745546b3c94af3401e84003e1b143b9b'),
(2, 'ICD10', 'CMS', '2019-10-01', '2020-ICD-10-PCS-Order.zip', '8dc136d780ec60916e9e1fc999837bc8');

CREATE TABLE `syndromic_surveillance` (
  `id` bigint(20) NOT NULL,
  `lists_id` bigint(20) NOT NULL,
  `submission_date` datetime NOT NULL,
  `filename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `pid` bigint(20) DEFAULT NULL,
  `user` varchar(255) NOT NULL DEFAULT '',
  `groupname` varchar(255) NOT NULL DEFAULT '',
  `authorized` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `transactions_log` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) NOT NULL COMMENT 'Ex: Charges added to superbill',
  `encounter` int(11) NOT NULL,
  `change_made` varchar(255) NOT NULL COMMENT 'the change from one payment amount to another. ex: $10 to $20',
  `billing_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'authorized user who effects the change'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

CREATE TABLE `updater_settings` (
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `updater_users` (
  `authUserId` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `updater_user_mode_backup_entry` (
  `filename` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `old_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `updater_user_mode_download_entry` (
  `filename` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `old_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` longtext,
  `authorized` tinyint(4) DEFAULT NULL,
  `info` longtext,
  `source` tinyint(4) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `federaltaxid` varchar(255) DEFAULT NULL,
  `federaldrugid` varchar(255) DEFAULT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `facility_id` int(11) NOT NULL DEFAULT '0',
  `fullscreen_page` text NOT NULL,
  `fullscreen_enable` int(11) NOT NULL DEFAULT '0',
  `menu_role` varchar(100) NOT NULL DEFAULT 'Default Role',
  `see_auth` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `npi` varchar(15) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `billname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_direct` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) DEFAULT NULL,
  `assistant` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `valedictory` varchar(255) DEFAULT NULL,
  `street` varchar(60) DEFAULT NULL,
  `streetb` varchar(60) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `street2` varchar(60) DEFAULT NULL,
  `streetb2` varchar(60) DEFAULT NULL,
  `city2` varchar(30) DEFAULT NULL,
  `state2` varchar(30) DEFAULT NULL,
  `zip2` varchar(20) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `phonew1` varchar(30) DEFAULT NULL,
  `phonew2` varchar(30) DEFAULT NULL,
  `phonecell` varchar(30) DEFAULT NULL,
  `notes` text,
  `cal_ui` tinyint(4) NOT NULL DEFAULT '1',
  `taxonomy` varchar(30) NOT NULL DEFAULT '207Q00000X',
  `calendar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = appears in calendar',
  `abook_type` varchar(31) NOT NULL DEFAULT '',
  `pwd_expiration_date` date DEFAULT NULL,
  `pwd_history1` longtext,
  `pwd_history2` longtext,
  `default_warehouse` varchar(31) NOT NULL DEFAULT '',
  `state_license_number` varchar(25) DEFAULT NULL,
  `newcrop_user_role` varchar(30) DEFAULT NULL,
  `cpoe` tinyint(1) DEFAULT NULL,
  `physician_type` varchar(50) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `picture_url` varchar(2000) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'needed for laravel',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'needed for laravel',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `login_attempts` int(2) NOT NULL DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_acl` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `deletedocuments`                  tinyint(1) DEFAULT 0,
  `batchcom`                         tinyint(1) DEFAULT 0,
  `eob`                              tinyint(1) DEFAULT 0,
  `bill`                             tinyint(1) DEFAULT 0,
  `billing_reports`                  tinyint(1) DEFAULT 0,
  `report_select_any_provider`       tinyint(1) DEFAULT 0,
  `super`                            tinyint(1) DEFAULT 0,
  `edit_drugs`                       tinyint(1) DEFAULT 0,
  `prices`                           tinyint(1) DEFAULT 0,
  `sensitive`                        tinyint(1) DEFAULT 0,
  `create_encounters`                tinyint(1) DEFAULT 0,
  `encounter_notes`                  tinyint(1) DEFAULT 0,
  `anyones_encounter`                tinyint(1) DEFAULT 0,
  `link_issue_encounter`             tinyint(1) DEFAULT 0,
  `encounter_date_edit`              tinyint(1) DEFAULT 0,
  `Dx_edit`                          tinyint(1) DEFAULT 0,
  `fee_sheet`                        tinyint(1) DEFAULT 0,
  `fee_sheet_any`                    tinyint(1) DEFAULT 0,
  `language`                         tinyint(1) DEFAULT 0,
  `patients_add`                     tinyint(1) DEFAULT 0,
  `patient_dems`                     tinyint(1) DEFAULT 0,
  `patients_edit_dems`               tinyint(1) DEFAULT 0,
  `messages`                         tinyint(1) DEFAULT 0,
  `patient_alerts`                   tinyint(1) DEFAULT 0,
  `orders_procedures`                tinyint(1) DEFAULT 0,
  `chart_amendments`                 tinyint(1) DEFAULT 0,
  `sign_orders`                      tinyint(1) DEFAULT 0,
  `practice_admin`                   tinyint(1) DEFAULT 0,
  `calendar_add`                     tinyint(1) DEFAULT 0,
  `calendar_edit`                    tinyint(1) DEFAULT 0,
  `calendar_super`                   tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users_acl` (`id`,`user`, `deletedocuments`, `batchcom`, `eob`,
 `bill`, `billing_reports`, `report_select_any_provider`, `super`, `edit_drugs`,
  `prices`, `sensitive`, `create_encounters`, `encounter_notes`, `anyones_encounter`,
   `link_issue_encounter`, `encounter_date_edit`, `Dx_edit`, `fee_sheet`, `fee_sheet_any`,
    `language`, `patients_add`, `patient_dems`, `patients_edit_dems`, `messages`,
     `patient_alerts`, `orders_procedures`, `chart_amendments`, `sign_orders`,
      `practice_admin`, `calendar_add`, `calendar_edit`, `calendar_super`) VALUES
(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);


CREATE TABLE `users_facility` (
  `tablename` varchar(64) NOT NULL,
  `table_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='joins users or patient_data to facility table';

CREATE TABLE `users_secure` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password_history1` varchar(255) DEFAULT NULL,
  `salt_history1` varchar(255) DEFAULT NULL,
  `password_history2` varchar(255) DEFAULT NULL,
  `salt_history2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user_settings` (
  `setting_user` bigint(20) NOT NULL DEFAULT '0',
  `setting_label` varchar(63) NOT NULL,
  `setting_value` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_settings` (`setting_user`, `setting_label`, `setting_value`) VALUES
(0, 'allergy_ps_expand', '1'),
(0, 'amendments_ps_expand', '1'),
(0, 'appointments_ps_expand', '1'),
(0, 'billing_ps_expand', '0'),
(0, 'clinical_reminders_ps_expand', '1'),
(0, 'demographics_ps_expand', '0'),
(0, 'dental_ps_expand', '1'),
(0, 'directives_ps_expand', '1'),
(0, 'disclosures_ps_expand', '0'),
(0, 'future_appointments_ps_expand', '1'),
(0, 'immunizations_ps_expand', '1'),
(0, 'insurance_ps_expand', '0'),
(0, 'labdata_ps_expand', '1'),
(0, 'medical_problem_ps_expand', '1'),
(0, 'medication_ps_expand', '1'),
(0, 'patient_reminders_ps_expand', '0'),
(0, 'pnotes_ps_expand', '0'),
(0, 'prescriptions_ps_expand', '1'),
(0, 'surgery_ps_expand', '1'),
(0, 'vitals_ps_expand', '1');

CREATE TABLE `version` (
  `v_major` int(11) NOT NULL DEFAULT '0',
  `v_minor` int(11) NOT NULL DEFAULT '0',
  `v_patch` int(11) NOT NULL DEFAULT '0',
  `v_realpatch` int(11) NOT NULL DEFAULT '0',
  `v_tag` varchar(31) NOT NULL DEFAULT '',
  `v_database` int(11) NOT NULL DEFAULT '0',
  `v_acl` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `version` (`v_major`, `v_minor`, `v_patch`, `v_realpatch`, `v_tag`, `v_database`, `v_acl`) VALUES
(3, 0, 0, 0, '', 9, 0);

CREATE TABLE `x12_partners` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `x12_sender_id` varchar(255) DEFAULT NULL,
  `x12_receiver_id` varchar(255) DEFAULT NULL,
  `x12_version` varchar(255) DEFAULT NULL,
  `processing_format` enum('standard','medi-cal','cms','proxymed') DEFAULT NULL,
  `x12_isa01` varchar(2) NOT NULL DEFAULT '00' COMMENT 'User logon Required Indicator',
  `x12_isa02` varchar(10) NOT NULL DEFAULT '          ' COMMENT 'User Logon',
  `x12_isa03` varchar(2) NOT NULL DEFAULT '00' COMMENT 'User password required Indicator',
  `x12_isa04` varchar(10) NOT NULL DEFAULT '          ' COMMENT 'User Password',
  `x12_isa05` char(2) NOT NULL DEFAULT 'ZZ',
  `x12_isa07` char(2) NOT NULL DEFAULT 'ZZ',
  `x12_isa14` char(1) NOT NULL DEFAULT '0',
  `x12_isa15` char(1) NOT NULL DEFAULT 'P',
  `x12_gs02` varchar(15) NOT NULL DEFAULT '',
  `x12_per06` varchar(80) NOT NULL DEFAULT '',
  `x12_gs03` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id` (`foreign_id`);

ALTER TABLE `amc_misc_data`
  ADD KEY `amc_id` (`amc_id`,`pid`,`map_id`);

ALTER TABLE `amendments`
  ADD PRIMARY KEY (`amendment_id`),
  ADD KEY `amendment_pid` (`pid`);

ALTER TABLE `amendments_history`
  ADD KEY `amendment_history_id` (`amendment_id`);

ALTER TABLE `ar_activity`
  ADD PRIMARY KEY (`sequence_no`,`pid`,`encounter`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `payment` (`pid`,`pay_amount`,`adj_amount`);

ALTER TABLE `ar_session`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_closed` (`user_id`,`closed`),
  ADD KEY `deposit_date` (`deposit_date`);

ALTER TABLE `audit_details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `audit_master`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `automatic_notification`
  ADD PRIMARY KEY (`notification_id`);

ALTER TABLE `background_services`
  ADD PRIMARY KEY (`name`);

ALTER TABLE `batchcom`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `cases_to_documents`
  ADD PRIMARY KEY (`case_id`,`document_id`),
  ADD KEY `FK_categories_to_documents_documents` (`document_id`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`),
  ADD KEY `lft` (`lft`,`rght`);

ALTER TABLE `categories_seq`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories_to_documents`
  ADD PRIMARY KEY (`category_id`,`document_id`);

ALTER TABLE `ccda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`pid`,`encounter`,`time`);

ALTER TABLE `ccda_components`
  ADD PRIMARY KEY (`ccda_components_id`);

ALTER TABLE `ccda_field_mapping`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ccda_sections`
  ADD PRIMARY KEY (`ccda_sections_id`);

ALTER TABLE `ccda_table_mapping`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `chart_tracker`
  ADD PRIMARY KEY (`ct_pid`,`ct_when`);

ALTER TABLE `claims`
  ADD PRIMARY KEY (`patient_id`,`encounter_id`,`version`);

ALTER TABLE `clinical_plans`
  ADD PRIMARY KEY (`id`,`pid`);

ALTER TABLE `clinical_plans_rules`
  ADD PRIMARY KEY (`plan_id`,`rule_id`);

ALTER TABLE `clinical_rules_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `category` (`category`);

ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `code_type` (`code_type`);

ALTER TABLE `code_types`
  ADD PRIMARY KEY (`ct_key`),
  ADD UNIQUE KEY `ct_id` (`ct_id`);

ALTER TABLE `dated_reminders`
  ADD PRIMARY KEY (`dr_id`),
  ADD KEY `dr_from_ID` (`dr_from_ID`,`dr_message_due_date`);

ALTER TABLE `dated_reminders_link`
  ADD PRIMARY KEY (`dr_link_id`),
  ADD KEY `to_id` (`to_id`),
  ADD KEY `dr_id` (`dr_id`);

ALTER TABLE `direct_message_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msg_id` (`msg_id`),
  ADD KEY `patient_id` (`patient_id`);

ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revision` (`revision`),
  ADD KEY `foreign_id` (`foreign_id`),
  ADD KEY `owner` (`owner`);

ALTER TABLE `drugs`
  ADD PRIMARY KEY (`drug_id`);

ALTER TABLE `drug_inventory`
  ADD PRIMARY KEY (`inventory_id`);

ALTER TABLE `drug_sales`
  ADD PRIMARY KEY (`sale_id`);

ALTER TABLE `drug_templates`
  ADD PRIMARY KEY (`drug_id`,`selector`);

ALTER TABLE `eligibility_response`
  ADD PRIMARY KEY (`response_id`);

ALTER TABLE `eligibility_verification`
  ADD PRIMARY KEY (`verification_id`),
  ADD KEY `insurance_id` (`insurance_id`);

ALTER TABLE `employer_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `enc_category_map`
  ADD KEY `rule_enc_id` (`rule_enc_id`,`main_cat_id`);

ALTER TABLE `erx_ttl_touch`
  ADD PRIMARY KEY (`patient_id`,`process`);

ALTER TABLE `esign_signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tid` (`tid`),
  ADD KEY `table` (`table`);

ALTER TABLE `extended_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid_encounter` (`pid`,`encounter`),
  ADD KEY `form_id` (`form_id`);

ALTER TABLE `form_dictation`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `form_encounter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid_encounter` (`pid`,`encounter`),
  ADD KEY `encounter_date` (`date`);

ALTER TABLE `form_misc_billing_options`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `form_vitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `geo_country_reference`
  ADD PRIMARY KEY (`countries_id`),
  ADD KEY `IDX_COUNTRIES_NAME` (`countries_name`);

ALTER TABLE `geo_zone_reference`
  ADD PRIMARY KEY (`zone_id`);

ALTER TABLE `globals`
  ADD PRIMARY KEY (`gl_name`,`gl_index`);

ALTER TABLE `gprelations`
  ADD PRIMARY KEY (`type1`,`id1`,`type2`,`id2`),
  ADD KEY `key2` (`type2`,`id2`);

ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `history_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `icd10_dx_order_code`
  ADD UNIQUE KEY `dx_id` (`dx_id`),
  ADD KEY `formatted_dx_code` (`formatted_dx_code`),
  ADD KEY `active` (`active`);

ALTER TABLE `icd10_gem_dx_9_10`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `icd10_gem_dx_10_9`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `icd10_gem_pcs_9_10`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `icd10_gem_pcs_10_9`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `icd10_pcs_order_code`
  ADD UNIQUE KEY `pcs_id` (`pcs_id`),
  ADD KEY `pcs_code` (`pcs_code`),
  ADD KEY `active` (`active`);

ALTER TABLE `icd10_reimbr_dx_9_10`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `icd10_reimbr_pcs_9_10`
  ADD UNIQUE KEY `map_id` (`map_id`);

ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

ALTER TABLE `insurance_companies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `insurance_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pid_type_date_inactivetime` (`pid`,`type`,`date`,`inactive_time`);

ALTER TABLE `insurance_numbers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `issue_encounter`
  ADD PRIMARY KEY (`pid`,`list_id`,`encounter`);

ALTER TABLE `issue_types`
  ADD PRIMARY KEY (`category`,`type`);

ALTER TABLE `lang_constants`
  ADD UNIQUE KEY `cons_id` (`cons_id`),
  ADD KEY `constant_name` (`constant_name`(100));

ALTER TABLE `lang_definitions`
  ADD UNIQUE KEY `def_id` (`def_id`),
  ADD KEY `cons_id` (`cons_id`);

ALTER TABLE `lang_languages`
  ADD UNIQUE KEY `lang_id` (`lang_id`);

ALTER TABLE `layout_options`
  ADD PRIMARY KEY (`form_id`,`field_id`,`seq`);

ALTER TABLE `lbf_data`
  ADD PRIMARY KEY (`form_id`,`field_id`);

ALTER TABLE `lbt_data`
  ADD PRIMARY KEY (`form_id`,`field_id`);

ALTER TABLE `libreehr_postcalendar_categories`
  ADD PRIMARY KEY (`pc_catid`),
  ADD KEY `basic_cat` (`pc_catname`,`pc_catcolor`);

ALTER TABLE `libreehr_postcalendar_events`
  ADD PRIMARY KEY (`pc_eid`),
  ADD KEY `basic_event` (`pc_catid`,`pc_aid`,`pc_eventDate`,`pc_endDate`,`pc_eventstatus`,`pc_sharing`,`pc_topic`),
  ADD KEY `pc_eventDate` (`pc_eventDate`);

ALTER TABLE `libreehr_session_info`
  ADD PRIMARY KEY (`pn_sessid`);

ALTER TABLE `lims_analysisrequests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `type` (`type`);

ALTER TABLE `lists_touch`
  ADD PRIMARY KEY (`pid`,`type`);

ALTER TABLE `list_options`
  ADD PRIMARY KEY (`list_id`,`option_id`);

ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `log_comment_encrypt`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `misc_address_book`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id` (`owner`),
  ADD KEY `foreign_id_2` (`foreign_id`),
  ADD KEY `date` (`date`);

ALTER TABLE `notification_log`
  ADD PRIMARY KEY (`iLogId`);

ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`SettingsId`);

ALTER TABLE `onsite_documents`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `onsite_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`owner`);

ALTER TABLE `onsite_messages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `onsite_online`
  ADD PRIMARY KEY (`hash`);

ALTER TABLE `onsite_portal_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`);

ALTER TABLE `onsite_signatures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pid` (`pid`,`user`),
  ADD KEY `encounter` (`encounter`);

ALTER TABLE `patient_access_onsite`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `patient_data`
  ADD UNIQUE KEY `pid` (`pid`),
  ADD KEY `id` (`id`);

ALTER TABLE `patient_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `category` (`category`,`item`);

ALTER TABLE `patient_tracker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eid` (`eid`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `patient_tracker_element`
  ADD KEY `pt_tracker_id` (`pt_tracker_id`,`seq`);

ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `payment_gateway_details`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pharmacies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_id` (`foreign_id`);

ALTER TABLE `pnotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`);

ALTER TABLE `prices`
  ADD PRIMARY KEY (`pr_id`,`pr_selector`,`pr_level`);

ALTER TABLE `procedure_answers`
  ADD PRIMARY KEY (`answer_seq`,`procedure_order_id`,`procedure_order_seq`,`question_code`);

ALTER TABLE `procedure_order`
  ADD PRIMARY KEY (`procedure_order_id`),
  ADD KEY `datepid` (`date_ordered`,`patient_id`),
  ADD KEY `patient_id` (`patient_id`);

ALTER TABLE `procedure_order_code`
  ADD PRIMARY KEY (`procedure_order_seq`,`procedure_order_id`);

ALTER TABLE `procedure_providers`
  ADD PRIMARY KEY (`ppid`);

ALTER TABLE `procedure_questions`
  ADD PRIMARY KEY (`lab_id`,`procedure_code`,`question_code`);

ALTER TABLE `procedure_report`
  ADD PRIMARY KEY (`procedure_report_id`),
  ADD KEY `procedure_order_id` (`procedure_order_id`);

ALTER TABLE `procedure_result`
  ADD PRIMARY KEY (`procedure_result_id`),
  ADD KEY `procedure_report_id` (`procedure_report_id`);

ALTER TABLE `procedure_type`
  ADD PRIMARY KEY (`procedure_type_id`),
  ADD KEY `parent` (`parent`);

ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`pw_drug_id`,`pw_warehouse`);

ALTER TABLE `pt_accident_claim`
  ADD PRIMARY KEY (`pac_id`);

ALTER TABLE `pt_case`
  ADD PRIMARY KEY (`case_number`);

ALTER TABLE `pt_case_info`
  ADD PRIMARY KEY (`pci_id`),
  ADD KEY `pci_case_number` (`pci_case_number`);

ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `report_itemized`
  ADD KEY `report_id` (`report_id`,`itemized_test_id`,`numerator_label`,`pass`);

ALTER TABLE `report_results`
  ADD PRIMARY KEY (`report_id`,`field_id`);

ALTER TABLE `rule_action`
  ADD KEY `id` (`id`);

ALTER TABLE `rule_action_item`
  ADD PRIMARY KEY (`category`,`item`);

ALTER TABLE `rule_filter`
  ADD KEY `id` (`id`);

ALTER TABLE `rule_patient_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`),
  ADD KEY `category` (`category`,`item`);

ALTER TABLE `rule_reminder`
  ADD KEY `id` (`id`);

ALTER TABLE `rule_target`
  ADD KEY `id` (`id`);

ALTER TABLE `shared_attributes`
  ADD PRIMARY KEY (`pid`,`encounter`,`field_id`);

ALTER TABLE `standardized_tables_track`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `supported_external_dataloads`
  ADD UNIQUE KEY `load_id` (`load_id`);

ALTER TABLE `syndromic_surveillance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lists_id` (`lists_id`);

ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `transactions_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `users_acl`
  ADD PRIMARY KEY (`id`,`user`);
ALTER TABLE `users_acl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `users_facility`
  ADD PRIMARY KEY (`tablename`,`table_id`,`facility_id`);

ALTER TABLE `users_secure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `USERNAME_ID` (`id`,`username`);

ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`setting_user`,`setting_label`);

ALTER TABLE `x12_partners`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `amendments`
  MODIFY `amendment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Amendment ID';

ALTER TABLE `amendments_history`
  MODIFY `amendment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Amendment ID';

ALTER TABLE `ar_activity`
  MODIFY `sequence_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ar_session`
  MODIFY `session_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `audit_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `audit_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `automatic_notification`
  MODIFY `notification_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `batchcom`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ccda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ccda_components`
  MODIFY `ccda_components_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `ccda_field_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ccda_sections`
  MODIFY `ccda_sections_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

ALTER TABLE `ccda_table_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `clinical_rules_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dated_reminders`
  MODIFY `dr_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dated_reminders_link`
  MODIFY `dr_link_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `direct_message_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `drugs`
  MODIFY `drug_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `drug_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `drug_sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `eligibility_response`
  MODIFY `response_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `eligibility_verification`
  MODIFY `verification_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `employer_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `esign_signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `extended_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `forms`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `form_dictation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `form_encounter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `form_misc_billing_options`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `form_vitals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `geo_country_reference`
  MODIFY `countries_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

ALTER TABLE `geo_zone_reference`
  MODIFY `zone_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

ALTER TABLE `groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `history_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_dx_order_code`
  MODIFY `dx_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_gem_dx_9_10`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_gem_dx_10_9`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_gem_pcs_9_10`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_gem_pcs_10_9`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_pcs_order_code`
  MODIFY `pcs_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_reimbr_dx_9_10`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `icd10_reimbr_pcs_9_10`
  MODIFY `map_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `immunizations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `insurance_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lang_constants`
  MODIFY `cons_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lang_definitions`
  MODIFY `def_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lang_languages`
  MODIFY `lang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `lbf_data`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'references forms.form_id';

ALTER TABLE `libreehr_postcalendar_categories`
  MODIFY `pc_catid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `libreehr_postcalendar_events`
  MODIFY `pc_eid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `lims_analysisrequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lists`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `log_comment_encrypt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `misc_address_book`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notification_log`
  MODIFY `iLogId` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `notification_settings`
  MODIFY `SettingsId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `onsite_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `onsite_mail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `onsite_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `onsite_portal_activity`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `onsite_signatures`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `patient_access_onsite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `patient_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `patient_reminders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `patient_tracker`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `payment_gateway_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pnotes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `procedure_answers`
  MODIFY `answer_seq` int(11) NOT NULL AUTO_INCREMENT COMMENT 'supports multiple-choice questions';

ALTER TABLE `procedure_order`
  MODIFY `procedure_order_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `procedure_order_code`
  MODIFY `procedure_order_seq` int(11) NOT NULL AUTO_INCREMENT COMMENT 'supports multiple tests per order';

ALTER TABLE `procedure_providers`
  MODIFY `ppid` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `procedure_report`
  MODIFY `procedure_report_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `procedure_result`
  MODIFY `procedure_result_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `procedure_type`
  MODIFY `procedure_type_id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pt_accident_claim`
  MODIFY `pac_id` int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pt_case`
  MODIFY `case_number` int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pt_case_info`
  MODIFY `pci_id` int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `registry`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `rule_patient_data`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `standardized_tables_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `supported_external_dataloads`
  MODIFY `load_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `syndromic_surveillance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `transactions_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `cases_to_documents`
  ADD CONSTRAINT `cases_to_documents_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pt_case_info`
  ADD CONSTRAINT `pci_fk_case_number` FOREIGN KEY (`pci_case_number`) REFERENCES `pt_case` (`case_number`) ON DELETE NO ACTION ON UPDATE NO ACTION;


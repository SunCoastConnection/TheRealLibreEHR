--
--  Comment Meta Language Constructs:
--
--  #IfNotTable
--    argument: table_name
--    behavior: if the table_name does not exist,  the block will be executed

--  #IfTable
--    argument: table_name
--    behavior: if the table_name does exist, the block will be executed

--  #IfColumn
--    arguments: table_name colname
--    behavior:  if the table and column exist,  the block will be executed

--  #IfMissingColumn
--    arguments: table_name colname
--    behavior:  if the table exists but the column does not,  the block will be executed

--  #IfNotColumnType
--    arguments: table_name colname value
--    behavior:  If the table table_name does not have a column colname with a data type equal to value, then the block will be executed

--  #IfNotRow
--    arguments: table_name colname value
--    behavior:  If the table table_name does not have a row where colname = value, the block will be executed.

--  #IfNotRow2D
--    arguments: table_name colname value colname2 value2
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2, the block will be executed.

--  #IfNotRow3D
--    arguments: table_name colname value colname2 value2 colname3 value3
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2 AND colname3 = value3, the block will be executed.

--  #IfNotRow4D
--    arguments: table_name colname value colname2 value2 colname3 value3 colname4 value4
--    behavior:  If the table table_name does not have a row where colname = value AND colname2 = value2 AND colname3 = value3 AND colname4 = value4, the block will be executed.

--  #IfNotRow2Dx2
--    desc:      This is a very specialized function to allow adding items to the list_options table to avoid both redundant option_id and title in each element.
--    arguments: table_name colname value colname2 value2 colname3 value3
--    behavior:  The block will be executed if both statements below are true:
--               1) The table table_name does not have a row where colname = value AND colname2 = value2.
--               2) The table table_name does not have a row where colname = value AND colname3 = value3.

--  #IfRow2D
--    arguments: table_name colname value colname2 value2
--    behavior:  If the table table_name does have a row where colname = value AND colname2 = value2, the block will be executed.

--  #IfRow3D
--        arguments: table_name colname value colname2 value2 colname3 value3
--        behavior:  If the table table_name does have a row where colname = value AND colname2 = value2 AND colname3 = value3, the block will be executed.

--  #IfIndex
--    desc:      This function is most often used for dropping of indexes/keys.
--    arguments: table_name colname
--    behavior:  If the table and index exist the relevant statements are executed, otherwise not.

--  #IfNotIndex
--    desc:      This function will allow adding of indexes/keys.
--    arguments: table_name colname
--    behavior:  If the index does not exist, it will be created

--  #EndIf
--    all blocks are terminated with a #EndIf statement.

--  #IfNotListReaction
--    Custom function for creating Reaction List

--  #IfNotListOccupation
--    Custom function for creating Occupation List

--  #IfTextNullFixNeeded
--    desc: convert all text fields without default null to have default null.
--    arguments: none

--  #IfTableEngine
--    desc:      Execute SQL if the table has been created with given engine specified.
--    arguments: table_name engine
--    behavior:  Use when engine conversion requires more than one ALTER TABLE

--  #IfInnoDBMigrationNeeded
--    desc: find all MyISAM tables and convert them to InnoDB.
--    arguments: none
--    behavior: can take a long time.

#IfMissingColumn facility inactive
  ALTER TABLE `facility` ADD COLUMN `inactive` TINYINT(1)  NOT NULL DEFAULT 0 ;
#EndIf

#IfNotTable cases_to_documents
CREATE TABLE IF NOT EXISTS `cases_to_documents` (
 `case_id` int(11) NOT NULL DEFAULT '0',
 `document_id` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`case_id`,`document_id`),
 KEY `FK_categories_to_documents_documents` (`document_id`),
 CONSTRAINT `cases_to_documents_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
#EndIf
#IfMissingColumn ar_activity billing_id
  ALTER TABLE `ar_activity` ADD COLUMN `billing_id` INT(11) NOT NULL AFTER `sequence_no`;
#EndIf
#IfNotIndex ar_activity payment
  ALTER TABLE `ar_activity` ADD INDEX `payment` (pid,pay_amount,adj_amount);
#EndIf
#IfMissingColumn insurance_data family_deductible
  ALTER TABLE `insurance_data` ADD COLUMN `family_deductible` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `inactive_time`;
#EndIf

#IfMissingColumn insurance_data family_deductible_met
  ALTER TABLE `insurance_data` ADD COLUMN `family_deductible_met` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `family_deductible`;
#EndIf

#IfMissingColumn insurance_data individual_deductible
  ALTER TABLE `insurance_data` ADD COLUMN `individual_deductible` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `family_deductible_met`;
#EndIf

#IfMissingColumn insurance_data individual_deductible_met
  ALTER TABLE `insurance_data` ADD COLUMN `individual_deductible_met` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `individual_deductible`;
#EndIf

#IfMissingColumn insurance_data pays_at
  ALTER TABLE `insurance_data` ADD COLUMN `pays_at` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `individual_deductible_met`;
#EndIf

#IfMissingColumn insurance_data max_out_of_pocket
  ALTER TABLE `insurance_data` ADD COLUMN `max_out_of_pocket` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `pays_at`;
#EndIf

#IfMissingColumn insurance_data out_of_pocket_met
  ALTER TABLE `insurance_data` ADD COLUMN `out_of_pocket_met` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 0 AFTER `max_out_of_pocket`;
#EndIf

#IfNotRow2D list_options list_id lists option_id transactions_modifiers
INSERT INTO list_options (list_id,option_id,title,seq,is_default,option_value,mapping,notes,codes,toggle_setting_1,toggle_setting_2,activity,subtype) VALUES
('lists','transactions_modifiers','Transactions Screen Modifiers',0,0,0,'','','',0,0,1,''),
('transactions_modifiers','GP','GP',10,0,0,'','','',0,0,1,''),
('transactions_modifiers','59','59',20,0,0,'','','',0,0,1,''),
('transactions_modifiers','KX','KX',30,0,0,'','','',0,0,1,'');
#Endif

#IfMissingColumn  ar_activity  unapplied
   ALTER TABLE `ar_activity`  ADD COLUMN `unapplied` TINYINT(1) NOT NULL DEFAULT '0' AFTER `reason_code`;
#Endif

#IfMissingColumn  billing  ready_to_bill
   ALTER TABLE `billing`  ADD COLUMN `ready_to_bill` TINYINT(1) NOT NULL DEFAULT '0';
#Endif

#IfNotRow2D list_options list_id lists option_id insurance_payment_method
INSERT INTO list_options (list_id,option_id,title,seq,is_default,option_value,mapping,notes,codes,toggle_setting_1,toggle_setting_2,activity,subtype) VALUES
('lists','insurance_payment_method','Insurance Payment Method',0,0,0,'','','',0,0,1,''),
('insurance_payment_method','check_payment','Check Payment',10,0,0,'','','',0,0,1,''),
('insurance_payment_method','credit_card','Credit Card',20,0,0,'','','',0,0,1,'');
#Endif

#IfMissingColumn  form_encounter  coding_complete
   ALTER TABLE `form_encounter`  ADD COLUMN `coding_complete` TINYINT(1) NOT NULL DEFAULT '0';
#Endif

#IfMissingColumn  form_encounter  case_number
   ALTER TABLE `form_encounter`  ADD COLUMN `case_number` INT(20) NOT NULL AFTER `coding_complete`;
#Endif

#IfMissingColumn  form_encounter  case_body_part
   ALTER TABLE `form_encounter`  ADD COLUMN `case_body_part` VARCHAR(25) NOT NULL AFTER `case_number`;
#Endif

#IfMissingColumn ar_activity date_closed
 ALTER TABLE `ar_activity` ADD COLUMN `date_closed` date COMMENT 'Date closed';
#Endif

#IfMissingColumn libreehr_postcalendar_categories pc_icon_color
  ALTER TABLE `libreehr_postcalendar_categories` MODIFY COLUMN `pc_categories_icon` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `pc_seq`;
  ALTER TABLE `libreehr_postcalendar_categories` ADD COLUMN `pc_icon_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `pc_categories_icon`;
  ALTER TABLE `libreehr_postcalendar_categories` ADD COLUMN `pc_icon_bg_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `pc_icon_color`;
#Endif

#IfColumn insurance_companies ins_co_initials
 ALTER TABLE `insurance_companies` CHANGE `ins_co_initials` `ins_co_initials` VARCHAR(10) NOT NULL ;
#ENDIF

#IfMissingColumn  users  locked
   ALTER TABLE `users`  ADD COLUMN `locked` TINYINT(1) NOT NULL DEFAULT '0';
#Endif

#IfMissingColumn  users  login_attempts
   ALTER TABLE `users`  ADD COLUMN `login_attempts` INT(2) NOT NULL DEFAULT '0';
#Endif

#IfMissingColumn  users  last_login
   ALTER TABLE `users`  ADD COLUMN `last_login` timestamp;
#Endif

#IfNotRow2D list_options list_id lists option_id insurance_account_type
INSERT INTO list_options (list_id,option_id,title,seq,is_default,option_value,mapping,notes,codes,toggle_setting_1,toggle_setting_2,activity,subtype) VALUES
('lists','insurance_account_type','Insurance Account Types',0,0,0,'','','',0,0,1,''),
('insurance_account_type','CL','COLLECTIONS',10,0,0,'','','',0,0,1,''),
('insurance_account_type','BC','BCBS',15,0,0,'','','',0,0,1,''),
('insurance_account_type','SP','SELF PAY',20,0,0,'','','',0,0,1,''),
('insurance_account_type','CP','WORKERS COMP',30,0,0,'','','',0,0,1,'');
#Endif

#IfMissingColumn insurance_companies account_type
 ALTER TABLE `insurance_companies` ADD `account_type` VARCHAR(15) DEFAULT NULL;
#EndIf

#IfNotTable transactions_log

CREATE TABLE IF NOT EXISTS `transactions_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `date` datetime NOT NULL,
 `description` varchar(255) NOT NULL COMMENT 'Ex: Charges added to Feesheet',
 `encounter` int(11) NOT NULL,
 `change_made` varchar(255) NOT NULL COMMENT 'the change from one payment amount to another. ex: $10 to $20',
 `billing_id` int(11) NOT NULL,
 `pid` int(11) NOT NULL,
 `user_id` int(11) NOT NULL COMMENT 'user who made the change',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;
#EndIf

#IfMissingColumn patient_data guardian_fname
  ALTER TABLE `patient_data` ADD `guardian_fname` TEXT  AFTER `guardiansname`;
#EndIf

#IfMissingColumn patient_data guardian_mname
  ALTER TABLE `patient_data` ADD `guardian_mname` TEXT  AFTER `guardian_fname`;
#EndIf

#IfMissingColumn patient_data guardian_lname
  ALTER TABLE `patient_data` ADD `guardian_lname` TEXT  AFTER `guardian_mname`;
#EndIf

#IfMissingColumn patient_data guardian_relationship
  ALTER TABLE `patient_data` ADD `guardian_relationship` TEXT  AFTER `guardian_lname`;
#EndIf

#IfMissingColumn patient_data guardian_sex
  ALTER TABLE `patient_data` ADD `guardian_sex` varchar(15) NOT NULL default ''  AFTER `guardian_relationship`;
#EndIf

#IfMissingColumn patient_data guardian_address
  ALTER TABLE `patient_data` ADD `guardian_address` varchar(255) NOT NULL default ''  AFTER `guardian_sex`;
#EndIf

#IfMissingColumn patient_data guardian_city
  ALTER TABLE `patient_data` ADD `guardian_city` varchar(255) NOT NULL default ''  AFTER `guardian_address`;
#EndIf

#IfMissingColumn patient_data guardian_state
  ALTER TABLE `patient_data` ADD `guardian_state` varchar(2) NOT NULL default ''  AFTER `guardian_city`;
#EndIf

#IfMissingColumn patient_data guardian_postal_code
  ALTER TABLE `patient_data` ADD `guardian_postal_code` varchar(50) NOT NULL default ''  AFTER `guardian_state`;
#EndIf

#IfMissingColumn patient_data guardian_country
  ALTER TABLE `patient_data` ADD `guardian_country` varchar(50) NOT NULL default ''  AFTER `guardian_postal_code`;
#EndIf

#IfMissingColumn patient_data guardian_home_phone
  ALTER TABLE `patient_data` ADD `guardian_home_phone` varchar(15) NOT NULL default ''  AFTER `guardian_country`;
#EndIf

#IfMissingColumn patient_data guardian_work_phone
  ALTER TABLE `patient_data` ADD `guardian_work_phone` varchar(15) NOT NULL default ''  AFTER `guardian_home_phone`;
#EndIf

#IfMissingColumn patient_data guardian_mobile_phone
  ALTER TABLE `patient_data` ADD `guardian_mobile_phone` varchar(15) NOT NULL default ''  AFTER `guardian_work_phone`;
#EndIf

#IfMissingColumn patient_data guardian_email
  ALTER TABLE `patient_data` ADD `guardian_email` varchar(150) NOT NULL default ''  AFTER `guardian_mobile_phone`;
#EndIf

#IfMissingColumn patient_data guardian_pid
  ALTER TABLE `patient_data` ADD `guardian_pid` int(11) default null  AFTER `guardian_email`;
#EndIf

#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2019-10-01 load_filename 2020-ICD-10-CM-Codes.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2019-10-01', '2020-ICD-10-CM-Codes.zip', '745546b3c94af3401e84003e1b143b9b');
#EndIf

#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2019-10-01 load_filename 2020-ICD-10-PCS-Order.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2019-10-01', '2020-ICD-10-PCS-Order.zip', '8dc136d780ec60916e9e1fc999837bc8');
#Endif

#IfMissingColumn ar_activity inactive
ALTER TABLE `ar_activity` ADD `inactive` BOOLEAN NOT NULL DEFAULT FALSE AFTER `date_closed`;
#EndIf

#IfMissingColumn patient_data transaction_billing_note
  ALTER TABLE `patient_data` ADD COLUMN `transaction_billing_note` TEXT  COMMENT 'Transaction Screen Notes' AFTER `billing_note`;
#EndIf
#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2020-10-01 load_filename 2021-ICD-10-CM-Codes.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2020-10-01', '2021-ICD-10-CM-Codes.zip', 'f22e7201fa662689d85b926a32359701');
#EndIf

#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2020-10-01 load_filename 2021-ICD-10-PCS-Order.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2020-10-01', '2021-ICD-10-PCS-Order.zip', '6a61cee7a8f774e23412ca1330980bbb');
#Endif

#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2020-12-01 load_filename 2021-ICD-10-CM-Codes-12-01.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2020-12-01', '2021-ICD-10-CM-Codes-12-01.zip', '29c9fced91667f9d8d8d85c2c86374ba');
#EndIf

#IfNotRow4D supported_external_dataloads load_type ICD10 load_source CMS load_release_date 2020-12-01 load_filename 2021-ICD-10-PCS-Order-12-01.zip
INSERT INTO `supported_external_dataloads` (`load_type`, `load_source`, `load_release_date`, `load_filename`, `load_checksum`) VALUES ('ICD10', 'CMS', '2020-12-01', '2021-ICD-10-PCS-Order-12-01.zip', '7de51527f44928ea5627a89038747302');
#Endif

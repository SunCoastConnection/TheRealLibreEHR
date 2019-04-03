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

#IfMissingColumn ar_activity date_closed
 ALTER TABLE `ar_activity` ADD COLUMN `date_closed` date COMMENT 'Date closed';
#Endif

#IfMissingColumn libreehr_postcalendar_categories pc_icon_color
  ALTER TABLE `libreehr_postcalendar_categories` MODIFY COLUMN `pc_categories_icon` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `pc_seq`;
  ALTER TABLE `libreehr_postcalendar_categories` ADD COLUMN `pc_icon_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `pc_categories_icon`;
  ALTER TABLE `libreehr_postcalendar_categories` ADD COLUMN `pc_icon_bg_color` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `pc_icon_color`;
#Endif

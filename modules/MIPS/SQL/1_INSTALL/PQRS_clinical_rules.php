<?php
/* Copyright (C) 2015 - 2017      Suncoast Connection
 * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @author  Bryan lee <leebc@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */

$query =
"DROP TABLE IF EXISTS `clinical_rules`;";
sqlStatementNoLog($query);

$query =
"CREATE TABLE `clinical_rules` (
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
  `active` tinyint(4) DEFAULT NULL COMMENT 'Is this measure turned on?');";
sqlStatementNoLog($query);

$query =
"INSERT INTO `clinical_rules` (`id`, `pid`, `active_alert_flag`, `passive_alert_flag`, `patient_reminder_flag`, `release_version`, `web_reference`, `access_control`, `pqrs_code`, `pqrs_individual_2016_flag`, `pqrs_group_type`, `active`) VALUES

('PQRS_0001', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0001', 1, 'X', 0),
('PQRS_0005', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0005', 1, 'X', 0),
('PQRS_0006', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0006', 1, 'X', 0),
('PQRS_0007', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0007', 1, 'X', 0),
('PQRS_0008', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0008', 1, 'X', 0),
('PQRS_0012', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0012', 1, 'X', 0),
('PQRS_0014', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0014', 1, 'X', 0),
('PQRS_0019', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0019', 1, 'X', 0),
('PQRS_0021', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0021', 1, 'X', 0),
('PQRS_0023', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0023', 1, 'X', 0),
('PQRS_0024', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0024', 1, 'X', 0),
('PQRS_0039', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0039', 1, 'X', 0),
('PQRS_0043', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0043', 1, 'X', 0),
('PQRS_0044', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0044', 1, 'X', 0),
('PQRS_0046', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0046', 1, 'X', 0),
('PQRS_0047', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0047', 1, 'X', 0),
('PQRS_0048', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0048', 1, 'X', 0),
('PQRS_0050', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0050', 1, 'X', 0),
('PQRS_0051', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0051', 1, 'X', 0),
('PQRS_0052', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0052', 1, 'X', 0),
('PQRS_0065', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0065', 1, 'X', 0),
('PQRS_0066', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0066', 1, 'X', 0),
('PQRS_0067', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0067', 1, 'X', 0),
('PQRS_0068', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0068', 1, 'X', 0),
('PQRS_0069', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0069', 1, 'X', 0),
('PQRS_0070', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0070', 1, 'X', 0),
('PQRS_0076', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0076', 1, 'X', 0),
('PQRS_0091', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0091', 1, 'X', 0),
('PQRS_0093', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0093', 1, 'X', 0),
('PQRS_0099', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0099', 1, 'X', 0),
('PQRS_0100', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0100', 1, 'X', 0),
('PQRS_0102', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0102', 1, 'X', 0),
('PQRS_0104', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0104', 1, 'X', 0),
('PQRS_0109', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0109', 1, 'X', 0),
('PQRS_0110', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0110', 1, 'X', 0),
('PQRS_0111', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0111', 1, 'X', 0),
('PQRS_0112', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0112', 1, 'X', 0),
('PQRS_0113', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0113', 1, 'X', 0),
('PQRS_0116', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0116', 1, 'X', 0),
('PQRS_0117', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0117', 1, 'X', 0),
('PQRS_0118', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0118', 1, 'X', 0),
('PQRS_0119', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0119', 1, 'X', 0),
('PQRS_0122', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0122', 1, 'X', 0),
('PQRS_0126', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0126', 1, 'X', 0),
('PQRS_0127', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0127', 1, 'X', 0),
('PQRS_0128', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0128', 1, 'X', 0),
('PQRS_0130', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0130', 1, 'X', 0),
('PQRS_0131', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0131', 1, 'X', 0),
('PQRS_0134', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0134', 1, 'X', 0),
('PQRS_0137', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0137', 1, 'X', 0),
('PQRS_0138', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0138', 1, 'X', 0),
('PQRS_0140', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0140', 1, 'X', 0),
('PQRS_0141', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0141', 1, 'X', 0),
('PQRS_0143', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0143', 1, 'X', 0),
('PQRS_0144', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0144', 1, 'X', 0),
('PQRS_0145', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0145', 1, 'X', 0),
('PQRS_0146', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0146', 1, 'X', 0),
('PQRS_0147', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0147', 1, 'X', 0),
('PQRS_0154', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0154', 1, 'X', 0),
('PQRS_0155', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0155', 1, 'X', 0),
('PQRS_0156', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0156', 1, 'X', 0),
('PQRS_0164', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0164', 1, 'X', 0),
('PQRS_0165', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0165', 1, 'X', 0),
('PQRS_0166', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0166', 1, 'X', 0),
('PQRS_0167', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0167', 1, 'X', 0),
('PQRS_0168', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0168', 1, 'X', 0),
('PQRS_0176', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0176', 1, 'X', 0),
('PQRS_0177', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0177', 1, 'X', 0),
('PQRS_0178', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0178', 1, 'X', 0),
('PQRS_0179', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0179', 1, 'X', 0),
('PQRS_0180', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0180', 1, 'X', 0),
('PQRS_0181', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0181', 1, 'X', 0),
('PQRS_0182', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0182', 1, 'X', 0),
('PQRS_0185', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0185', 1, 'X', 0),
('PQRS_0187', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0187', 1, 'X', 0),
('PQRS_0191', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0191', 1, 'X', 0),
('PQRS_0192', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0192', 1, 'X', 0),
('PQRS_0195', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0195', 1, 'X', 0),
('PQRS_0204', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0204', 1, 'X', 0),
('PQRS_0205', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0205', 1, 'X', 0),
('PQRS_0217', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0217', 1, 'X', 0),
('PQRS_0218', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0218', 1, 'X', 0),
('PQRS_0219', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0219', 1, 'X', 0),
('PQRS_0220', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0220', 1, 'X', 0),
('PQRS_0221', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0221', 1, 'X', 0),
('PQRS_0222', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0222', 1, 'X', 0),
('PQRS_0223', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0223', 1, 'X', 0),
('PQRS_0224', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0224', 1, 'X', 0),
('PQRS_0225', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0225', 1, 'X', 0),
('PQRS_0226', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0226', 1, 'X', 0),
('PQRS_0236', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0236', 1, 'X', 0),
('PQRS_0238', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0238', 1, 'X', 0),
('PQRS_0243', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0243', 1, 'X', 0),
('PQRS_0249', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0249', 1, 'X', 0),
('PQRS_0250', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0250', 1, 'X', 0),
('PQRS_0251', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0251', 1, 'X', 0),
('PQRS_0254', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0254', 1, 'X', 0),
('PQRS_0255', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0255', 1, 'X', 0),
('PQRS_0257', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0257', 1, 'X', 0),
('PQRS_0258', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0258', 1, 'X', 0),
('PQRS_0259', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0259', 1, 'X', 0),
('PQRS_0260', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0260', 1, 'X', 0),
('PQRS_0261', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0261', 1, 'X', 0),
('PQRS_0262', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0262', 1, 'X', 0),
('PQRS_0263', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0263', 1, 'X', 0),
('PQRS_0264', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0264', 1, 'X', 0),
('PQRS_0265', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0265', 1, 'X', 0),
('PQRS_0268', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0268', 1, 'X', 0),
('PQRS_0271', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0271', 1, 'X', 0),
('PQRS_0275', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0275', 1, 'X', 0),
('PQRS_0276', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0276', 1, 'X', 0),
('PQRS_0277', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0277', 1, 'X', 0),
('PQRS_0278', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0278', 1, 'X', 0),
('PQRS_0279', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0279', 1, 'X', 0),
('PQRS_0282', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0282', 1, 'X', 0),
('PQRS_0283', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0283', 1, 'X', 0),
('PQRS_0286', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0286', 1, 'X', 0),
('PQRS_0288', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0288', 1, 'X', 0),
('PQRS_0290', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0290', 1, 'X', 0),
('PQRS_0291', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0291', 1, 'X', 0),
('PQRS_0293', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0293', 1, 'X', 0),
('PQRS_0303', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0303', 1, 'X', 0),
('PQRS_0304', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0304', 1, 'X', 0),
('PQRS_0317', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0317', 1, 'X', 0),
('PQRS_0320', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0320', 1, 'X', 0),
('PQRS_0322', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0322', 1, 'X', 0),
('PQRS_0323', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0323', 1, 'X', 0),
('PQRS_0324', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0324', 1, 'X', 0),
('PQRS_0325', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0325', 1, 'X', 0),
('PQRS_0326', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0326', 1, 'X', 0),
('PQRS_0327', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0327', 1, 'X', 0),
('PQRS_0328', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0328', 1, 'X', 0),
('PQRS_0329', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0329', 1, 'X', 0),
('PQRS_0330', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0330', 1, 'X', 0),
('PQRS_0331', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0331', 1, 'X', 0),
('PQRS_0332', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0332', 1, 'X', 0),
('PQRS_0333', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0333', 1, 'X', 0),
('PQRS_0334', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0334', 1, 'X', 0),
('PQRS_0335', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0335', 1, 'X', 0),
('PQRS_0336', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0336', 1, 'X', 0),
('PQRS_0337', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0337', 1, 'X', 0),
('PQRS_0338', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0338', 1, 'X', 0),
('PQRS_0340', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0340', 1, 'X', 0),
('PQRS_0342', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0342', 1, 'X', 0),
('PQRS_0343', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0343', 1, 'X', 0),
('PQRS_0344', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0344', 1, 'X', 0),
('PQRS_0345', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0345', 1, 'X', 0),
('PQRS_0346', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0346', 1, 'X', 0),
('PQRS_0347', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0347', 1, 'X', 0),
('PQRS_0348', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0348', 1, 'X', 0),
('PQRS_0350', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0350', 1, 'X', 0),
('PQRS_0351', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0351', 1, 'X', 0),
('PQRS_0352', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0352', 1, 'X', 0),
('PQRS_0353', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0353', 1, 'X', 0),
('PQRS_0354', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0354', 1, 'X', 0),
('PQRS_0355', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0355', 1, 'X', 0),
('PQRS_0356', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0356', 1, 'X', 0),
('PQRS_0357', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0357', 1, 'X', 0),
('PQRS_0358', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0358', 1, 'X', 0),
('PQRS_0359', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0359', 1, 'X', 0),
('PQRS_0360', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0360', 1, 'X', 0),
('PQRS_0361', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0361', 1, 'X', 0),
('PQRS_0362', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0362', 1, 'X', 0),
('PQRS_0363', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0363', 1, 'X', 0),
('PQRS_0364', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0364', 1, 'X', 0),
('PQRS_0370', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0370', 1, 'X', 0),
('PQRS_0383', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0383', 1, 'X', 0),
('PQRS_0384', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0384', 1, 'X', 0),
('PQRS_0385', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0385', 1, 'X', 0),
('PQRS_0386', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0386', 1, 'X', 0),
('PQRS_0387', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0387', 1, 'X', 0),
('PQRS_0388', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0388', 1, 'X', 0),
('PQRS_0389', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0389', 1, 'X', 0),
('PQRS_0390', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0390', 1, 'X', 0),
('PQRS_0391', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0391', 1, 'X', 0),
('PQRS_0392', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0392', 1, 'X', 0),
('PQRS_0393', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0393', 1, 'X', 0),
('PQRS_0394', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0394', 1, 'X', 0),
('PQRS_0395', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0395', 1, 'X', 0),
('PQRS_0396', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0396', 1, 'X', 0),
('PQRS_0397', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0397', 1, 'X', 0),
('PQRS_0398', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0398', 1, 'X', 0),
('PQRS_0400', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0400', 1, 'X', 0),
('PQRS_0401', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0401', 1, 'X', 0),
('PQRS_0402', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0402', 1, 'X', 0),
('PQRS_0403', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0403', 1, 'X', 0),
('PQRS_0404', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0404', 1, 'X', 0),
('PQRS_0405', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0405', 1, 'X', 0),
('PQRS_0406', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0406', 1, 'X', 0),
('PQRS_0407', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0407', 1, 'X', 0),
('PQRS_0408', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0408', 1, 'X', 0),
('PQRS_0409', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0409', 1, 'X', 0),
('PQRS_0410', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0410', 1, 'X', 0),
('PQRS_0411', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0411', 1, 'X', 0),
('PQRS_0412', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0412', 1, 'X', 0),
('PQRS_0413', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0413', 1, 'X', 0),
('PQRS_0414', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0414', 1, 'X', 0),
('PQRS_0415', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0415', 1, 'X', 0),
('PQRS_0416', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0416', 1, 'X', 0),
('PQRS_0417', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0417', 1, 'X', 0),
('PQRS_0418', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0418', 1, 'X', 0),
('PQRS_0419', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0419', 1, 'X', 0),
('PQRS_0420', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0420', 1, 'X', 0),
('PQRS_0421', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0421', 1, 'X', 0),
('PQRS_0422', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0422', 1, 'X', 0),
('PQRS_0423', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0423', 1, 'X', 0),
('PQRS_0424', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0424', 1, 'X', 0),
('PQRS_0425', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0425', 1, 'X', 0),
('PQRS_0426', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0426', 1, 'X', 0),
('PQRS_0427', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0427', 1, 'X', 0),
('PQRS_0428', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0428', 1, 'X', 0),
('PQRS_0429', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0429', 1, 'X', 0),
('PQRS_0430', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0430', 1, 'X', 0),
('PQRS_0431', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0431', 1, 'X', 0),
('PQRS_0432', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0432', 1, 'X', 0),
('PQRS_0433', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0433', 1, 'X', 0),
('PQRS_0434', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0434', 1, 'X', 0),
('PQRS_0435', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0435', 1, 'X', 0),
('PQRS_0436', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0436', 1, 'X', 0),
('PQRS_0437', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0437', 1, 'X', 0),
('PQRS_0438', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0438', 1, 'X', 0),
('PQRS_0439', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0439', 1, 'X', 0),
('PQRS_0440', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0440', 1, 'X', 0),
('PQRS_0441', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0441', 1, 'X', 0),
('PQRS_0442', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0442', 1, 'X', 0),
('PQRS_0443', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0443', 1, 'X', 0),
('PQRS_0444', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0444', 1, 'X', 0),
('PQRS_0445', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0445', 1, 'X', 0),
('PQRS_0446', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0446', 1, 'X', 0),
('PQRS_0447', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0447', 1, 'X', 0),
('PQRS_0448', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0448', 1, 'X', 0),
('PQRS_0449', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0449', 1, 'X', 0),
('PQRS_0450', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0450', 1, 'X', 0),
('PQRS_0451', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0451', 1, 'X', 0),
('PQRS_0452', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0452', 1, 'X', 0),
('PQRS_0453', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0453', 1, 'X', 0),
('PQRS_0454', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0454', 1, 'X', 0),
('PQRS_0455', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0455', 1, 'X', 0),
('PQRS_0456', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0456', 1, 'X', 0),
('PQRS_0457', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0457', 1, 'X', 0),
('PQRS_0459', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0459', 1, 'X', 0),
('PQRS_0460', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0460', 1, 'X', 0),
('PQRS_0461', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0461', 1, 'X', 0),
('PQRS_0463', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0463', 1, 'X', 0),
('PQRS_0464', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0464', 1, 'X', 0),
('PQRS_0465', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0465', 1, 'X', 0),
('PQRS_0466', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0466', 1, 'X', 0),
('PQRS_0467', 0, 0, 0, 0, '2017', '', 'patients:med', 'PQRS_0467', 1, 'X', 0),


( 'pre_0005', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0005', 1, 'Z', 0),
( 'pre_0007', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0007', 1, 'Z', 0),
( 'pre_0008', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0008', 1, 'Z', 0),
( 'pre_0048', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0048', 1, 'Z', 0),
( 'pre_0050', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0050', 1, 'Z', 0),
( 'pre_0052', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0052', 1, 'Z', 0),
( 'pre_0065', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0065', 1, 'Z', 0),
( 'pre_0066', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0066', 1, 'Z', 0),
( 'pre_0068', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0068', 1, 'Z', 0),
( 'pre_0099', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0099', 1, 'Z', 0),
( 'pre_0100', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0100', 1, 'Z', 0),
( 'pre_0102', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0102', 1, 'Z', 0),
( 'pre_0104', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0104', 1, 'Z', 0),
( 'pre_0111', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0111', 1, 'Z', 0),
( 'pre_0112', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0112', 1, 'Z', 0),
( 'pre_0113', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0113', 1, 'Z', 0),
( 'pre_0116', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0116', 1, 'Z', 0),
( 'pre_0117', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0117', 1, 'Z', 0),
( 'pre_0118', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0118', 1, 'Z', 0),
( 'pre_0119', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0119', 1, 'Z', 0),
( 'pre_0146', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0146', 1, 'Z', 0),
( 'pre_0154', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0154', 1, 'Z', 0),
( 'pre_0155', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0155', 1, 'Z', 0),
( 'pre_0167', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0167', 1, 'Z', 0),
( 'pre_0176', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0176', 1, 'Z', 0),
( 'pre_0204', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0204', 1, 'Z', 0),
( 'pre_0205', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0205', 1, 'Z', 0),
( 'pre_0217', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0217', 1, 'Z', 0),
( 'pre_0218', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0218', 1, 'Z', 0),
( 'pre_0219', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0219', 1, 'Z', 0),
( 'pre_0220', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0220', 1, 'Z', 0),
( 'pre_0221', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0221', 1, 'Z', 0),
( 'pre_0222', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0222', 1, 'Z', 0),
( 'pre_0223', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0223', 1, 'Z', 0),
( 'pre_0224', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0224', 1, 'Z', 0),
( 'pre_0225', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0225', 1, 'Z', 0),
( 'pre_0236', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0236', 1, 'Z', 0),
( 'pre_0238', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0238', 1, 'Z', 0),
( 'pre_0249', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0249', 1, 'Z', 0),
( 'pre_0250', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0250', 1, 'Z', 0),
( 'pre_0251', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0251', 1, 'Z', 0),
( 'pre_0258', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0258', 1, 'Z', 0),
( 'pre_0259', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0259', 1, 'Z', 0),
( 'pre_0260', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0260', 1, 'Z', 0),
( 'pre_0262', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0262', 1, 'Z', 0),
( 'pre_0263', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0263', 1, 'Z', 0),
( 'pre_0264', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0264', 1, 'Z', 0),
( 'pre_0271', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0271', 1, 'Z', 0),
( 'pre_0278', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0278', 1, 'Z', 0),
( 'pre_0279', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0279', 1, 'Z', 0),
( 'pre_0326', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0326', 1, 'Z', 0),
( 'pre_0327', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0327', 1, 'Z', 0),
( 'pre_0329', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0329', 1, 'Z', 0),
( 'pre_0330', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0330', 1, 'Z', 0),
( 'pre_0332', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0332', 1, 'Z', 0),
( 'pre_0337', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0337', 1, 'Z', 0),
( 'pre_0340', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0340', 1, 'Z', 0),
( 'pre_0344', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0344', 1, 'Z', 0),
( 'pre_0345', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0345', 1, 'Z', 0),
( 'pre_0346', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0346', 1, 'Z', 0),
( 'pre_0347', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0347', 1, 'Z', 0),
( 'pre_0348', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0348', 1, 'Z', 0),
( 'pre_0358', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0358', 1, 'Z', 0),
( 'pre_0364', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0364', 1, 'Z', 0),
( 'pre_0370', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0370', 1, 'Z', 0),
( 'pre_0384', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0384', 1, 'Z', 0),
( 'pre_0385', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0385', 1, 'Z', 0),
( 'pre_0386', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0386', 1, 'Z', 0),
( 'pre_0388', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0388', 1, 'Z', 0),
( 'pre_0391', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0391', 1, 'Z', 0),
( 'pre_0394', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0394', 1, 'Z', 0),
( 'pre_0395', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0395', 1, 'Z', 0),
( 'pre_0396', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0396', 1, 'Z', 0),
( 'pre_0397', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0397', 1, 'Z', 0),
( 'pre_0403', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0403', 1, 'Z', 0),
( 'pre_0404', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0404', 1, 'Z', 0),
( 'pre_0405', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0405', 1, 'Z', 0),
( 'pre_0406', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0406', 1, 'Z', 0),
( 'pre_0408', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0408', 1, 'Z', 0),
( 'pre_0410', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0410', 1, 'Z', 0),
( 'pre_0411', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0411', 1, 'Z', 0),
( 'pre_0412', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0412', 1, 'Z', 0),
( 'pre_0413', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0413', 1, 'Z', 0),
( 'pre_0414', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0414', 1, 'Z', 0),
( 'pre_0415', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0415', 1, 'Z', 0),
( 'pre_0416', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0416', 1, 'Z', 0),
( 'pre_0417', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0417', 1, 'Z', 0),
( 'pre_0418', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0418', 1, 'Z', 0),
( 'pre_0419', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0419', 1, 'Z', 0),
( 'pre_0421', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0421', 1, 'Z', 0),
( 'pre_0424', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0424', 1, 'Z', 0),
( 'pre_0425', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0425', 1, 'Z', 0),
( 'pre_0426', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0426', 1, 'Z', 0),
( 'pre_0427', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0427', 1, 'Z', 0),
( 'pre_0429', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0429', 1, 'Z', 0),
( 'pre_0430', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0430', 1, 'Z', 0),
( 'pre_0437', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0437', 1, 'Z', 0),
( 'pre_0438', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0438', 1, 'Z', 0),
( 'pre_0440', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0440', 1, 'Z', 0),
( 'pre_0441', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0441', 1, 'Z', 0),
( 'pre_0442', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0442', 1, 'Z', 0),
( 'pre_0443', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0443', 1, 'Z', 0),
( 'pre_0444', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0444', 1, 'Z', 0),
( 'pre_0447', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0447', 1, 'Z', 0),
( 'pre_0448', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0448', 1, 'Z', 0),
( 'pre_0449', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0449', 1, 'Z', 0),
( 'pre_0450', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0450', 1, 'Z', 0),
( 'pre_0452', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0452', 1, 'Z', 0),
( 'pre_0453', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0453', 1, 'Z', 0),
( 'pre_0454', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0454', 1, 'Z', 0),
( 'pre_0455', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0455', 1, 'Z', 0),
( 'pre_0456', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0456', 1, 'Z', 0),
( 'pre_0457', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0457', 1, 'Z', 0),
( 'pre_0459', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0459', 1, 'Z', 0),
( 'pre_0460', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0460', 1, 'Z', 0),
( 'pre_0461', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0461', 1, 'Z', 0),
( 'pre_0463', 0, 0, 0, 0, '2017', '', 'patients:med',  'pre_0463', 1, 'Z', 0),
( 'HCC_0001', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0001', 1, 'Z', 0),
( 'HCC_0002', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0002', 1, 'Z', 0),
( 'HCC_0006', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0006', 1, 'Z', 0),
( 'HCC_0008', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0008', 1, 'Z', 0),
( 'HCC_0009', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0009', 1, 'Z', 0),
( 'HCC_0010', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0010', 1, 'Z', 0),
( 'HCC_0011', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0011', 1, 'Z', 0),
( 'HCC_0012', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0012', 1, 'Z', 0),
( 'HCC_0017', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0017', 1, 'Z', 0),
( 'HCC_0018', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0018', 1, 'Z', 0),
( 'HCC_0019', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0019', 1, 'Z', 0),
( 'HCC_0021', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0021', 1, 'Z', 0),
( 'HCC_0022', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0022', 1, 'Z', 0),
( 'HCC_0023', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0023', 1, 'Z', 0),
( 'HCC_0027', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0027', 1, 'Z', 0),
( 'HCC_0028', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0028', 1, 'Z', 0),
( 'HCC_0029', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0029', 1, 'Z', 0),
( 'HCC_0033', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0033', 1, 'Z', 0),
( 'HCC_0034', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0034', 1, 'Z', 0),
( 'HCC_0035', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0035', 1, 'Z', 0),
( 'HCC_0039', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0039', 1, 'Z', 0),
( 'HCC_0040', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0040', 1, 'Z', 0),
( 'HCC_0046', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0046', 1, 'Z', 0),
( 'HCC_0047', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0047', 1, 'Z', 0),
( 'HCC_0048', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0048', 1, 'Z', 0),
( 'HCC_0054', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0054', 1, 'Z', 0),
( 'HCC_0055', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0055', 1, 'Z', 0),
( 'HCC_0057', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0057', 1, 'Z', 0),
( 'HCC_0058', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0058', 1, 'Z', 0),
( 'HCC_0070', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0070', 1, 'Z', 0),
( 'HCC_0071', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0071', 1, 'Z', 0),
( 'HCC_0072', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0072', 1, 'Z', 0),
( 'HCC_0073', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0073', 1, 'Z', 0),
( 'HCC_0074', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0074', 1, 'Z', 0),
( 'HCC_0075', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0075', 1, 'Z', 0),
( 'HCC_0076', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0076', 1, 'Z', 0),
( 'HCC_0077', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0077', 1, 'Z', 0),
( 'HCC_0078', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0078', 1, 'Z', 0),
( 'HCC_0079', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0079', 1, 'Z', 0),
( 'HCC_0080', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0080', 1, 'Z', 0),
( 'HCC_0082', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0082', 1, 'Z', 0),
( 'HCC_0083', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0083', 1, 'Z', 0),
( 'HCC_0084', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0084', 1, 'Z', 0),
( 'HCC_0085', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0085', 1, 'Z', 0),
( 'HCC_0086', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0086', 1, 'Z', 0),
( 'HCC_0087', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0087', 1, 'Z', 0),
( 'HCC_0088', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0088', 1, 'Z', 0),
( 'HCC_0096', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0096', 1, 'Z', 0),
( 'HCC_0099', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0099', 1, 'Z', 0),
( 'HCC_0100', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0100', 1, 'Z', 0),
( 'HCC_0103', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0103', 1, 'Z', 0),
( 'HCC_0104', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0104', 1, 'Z', 0),
( 'HCC_0106', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0106', 1, 'Z', 0),
( 'HCC_0107', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0107', 1, 'Z', 0),
( 'HCC_0108', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0108', 1, 'Z', 0),
( 'HCC_0110', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0110', 1, 'Z', 0),
( 'HCC_0111', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0111', 1, 'Z', 0),
( 'HCC_0112', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0112', 1, 'Z', 0),
( 'HCC_0114', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0114', 1, 'Z', 0),
( 'HCC_0115', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0115', 1, 'Z', 0),
( 'HCC_0122', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0122', 1, 'Z', 0),
( 'HCC_0124', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0124', 1, 'Z', 0),
( 'HCC_0134', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0134', 1, 'Z', 0),
( 'HCC_0135', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0135', 1, 'Z', 0),
( 'HCC_0136', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0136', 1, 'Z', 0),
( 'HCC_0137', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0137', 1, 'Z', 0),
( 'HCC_0157', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0157', 1, 'Z', 0),
( 'HCC_0158', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0158', 1, 'Z', 0),
( 'HCC_0161', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0161', 1, 'Z', 0),
( 'HCC_0162', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0162', 1, 'Z', 0),
( 'HCC_0166', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0166', 1, 'Z', 0),
( 'HCC_0167', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0167', 1, 'Z', 0),
( 'HCC_0169', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0169', 1, 'Z', 0),
( 'HCC_0170', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0170', 1, 'Z', 0),
( 'HCC_0173', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0173', 1, 'Z', 0),
( 'HCC_0176', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0176', 1, 'Z', 0),
( 'HCC_0186', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0186', 1, 'Z', 0),
( 'HCC_0188', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0188', 1, 'Z', 0),
( 'HCC_0189', 0, 0, 0, 0, '2018', '', 'patients:med',  'HCC_0189', 1, 'Z', 0);";
sqlStatementNoLog($query);

$query =
"ALTER TABLE `clinical_rules`
  ADD PRIMARY KEY (`id`,`pid`);";
sqlStatementNoLog($query);

?>

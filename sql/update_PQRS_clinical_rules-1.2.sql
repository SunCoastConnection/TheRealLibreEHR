/*
 * Copyright (C) 2016 Suncoast Connection
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package OpenEMR
 * @author  Suncoast Connection
 * @author  leebc
 * @link    http://suncoastconnection.com
 * @link    http://www.oemr.org
 * @version	1.1 - Updated to include Group Measure in addition to Individual
*/

ALTER TABLE `clinical_rules` ADD `pqrs_2015_flag` tinyint;
ALTER TABLE `clinical_rules` ADD `pqrs_code` varchar(35);
INSERT INTO `clinical_rules` (`id`, `pid`, `active_alert_flag`, `passive_alert_flag`, `cqm_flag`, `cqm_2011_flag`, `cqm_2014_flag`, `cqm_nqf_code`, `cqm_pqri_code`, `amc_flag`, `amc_2011_flag`, `amc_2014_flag`, `amc_code`, `amc_code_2014`, `amc_2014_stage1_flag`, `amc_2014_stage2_flag`, `patient_reminder_flag`, `developer`, `funding_source`, `release_version`, `web_reference`, `access_control`, `pqrs_code`, `pqrs_2015_flag`) VALUES
('PQRS_0001', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0001', '1')
('PQRS_0005', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0005', '1')
('PQRS_0006', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0006', '1')
('PQRS_0007', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0007', '1')
('PQRS_0008', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0008', '1')
('PQRS_0012', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0012', '1')
('PQRS_0014', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0014', '1')
('PQRS_0019', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0019', '1')
('PQRS_0021', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0021', '1')
('PQRS_0022', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0022', '1')
('PQRS_0023', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0023', '1')
('PQRS_0024', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0024', '1')
('PQRS_0032', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0032', '1')
('PQRS_0033', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0033', '1')
('PQRS_0039', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0039', '1')
('PQRS_0040', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0040', '1')
('PQRS_0041', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0041', '1')
('PQRS_0043', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0043', '1')
('PQRS_0044', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0044', '1')
('PQRS_0046', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0046', '1')
('PQRS_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0047', '1')
('PQRS_0048', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0048', '1')
('PQRS_0050', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0050', '1')
('PQRS_0051', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0051', '1')
('PQRS_0052', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0052', '1')
('PQRS_0053', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0053', '1')
('PQRS_0054', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0054', '1')
('PQRS_0065', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0065', '1')
('PQRS_0066', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0066', '1')
('PQRS_0067', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0067', '1')
('PQRS_0068', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0068', '1')
('PQRS_0069', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0069', '1')
('PQRS_0070', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0070', '1')
('PQRS_0071', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0071', '1')
('PQRS_0072', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0072', '1')
('PQRS_0076', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0076', '1')
('PQRS_0081', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0081', '1')
('PQRS_0082', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0082', '1')
('PQRS_0091', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0091', '1')
('PQRS_0093', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0093', '1')
('PQRS_0099', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0099', '1')
('PQRS_0100', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0100', '1')
('PQRS_0102', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0102', '1')
('PQRS_0104', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0104', '1')
('PQRS_0109', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0109', '1')
('PQRS_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0110', '1')
('PQRS_0111', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0111', '1')
('PQRS_0112', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0112', '1')
('PQRS_0113', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0113', '1')
('PQRS_0116', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0116', '1')
('PQRS_0117', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0117', '1')
('PQRS_0118', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0118', '1')
('PQRS_0119', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0119', '1')
('PQRS_0121', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0121', '1')
('PQRS_0122', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0122', '1')
('PQRS_0126', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0126', '1')
('PQRS_0127', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0127', '1')
('PQRS_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0128', '1')
('PQRS_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0130', '1')
('PQRS_0131', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0131', '1')
('PQRS_0134', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0134', '1')
('PQRS_0137', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0137', '1')
('PQRS_0138', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0138', '1')
('PQRS_0140', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0140', '1')
('PQRS_0141', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0141', '1')
('PQRS_0143', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0143', '1')
('PQRS_0144', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0144', '1')
('PQRS_0145', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0145', '1')
('PQRS_0146', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0146', '1')
('PQRS_0147', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0147', '1')
('PQRS_0154', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0154', '1')
('PQRS_0155', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0155', '1')
('PQRS_0156', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0156', '1')
('PQRS_0163', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0163', '1')
('PQRS_0164', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0164', '1')
('PQRS_0165', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0165', '1')
('PQRS_0166', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0166', '1')
('PQRS_0167', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0167', '1')
('PQRS_0168', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0168', '1')
('PQRS_0172', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0172', '1')
('PQRS_0173', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0173', '1')
('PQRS_0178', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0178', '1')
('PQRS_0181', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0181', '1')
('PQRS_0182', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0182', '1')
('PQRS_0185', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0185', '1')
('PQRS_0187', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0187', '1')
('PQRS_0191', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0191', '1')
('PQRS_0192', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0192', '1')
('PQRS_0193', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0193', '1')
('PQRS_0194', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0194', '1')
('PQRS_0195', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0195', '1')
('PQRS_0204', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0204', '1')
('PQRS_0205', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0205', '1')
('PQRS_0217', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0217', '1')
('PQRS_0218', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0218', '1')
('PQRS_0219', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0219', '1')
('PQRS_0220', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0220', '1')
('PQRS_0221', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0221', '1')
('PQRS_0222', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0222', '1')
('PQRS_0223', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0223', '1')
('PQRS_0224', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0224', '1')
('PQRS_0225', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0225', '1')
('PQRS_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0226', '1')
('PQRS_0236', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0236', '1')
('PQRS_0238', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0238', '1')
('PQRS_0242', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0242', '1')
('PQRS_0243', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0243', '1')
('PQRS_0249', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0249', '1')
('PQRS_0250', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0250', '1')
('PQRS_0251', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0251', '1')
('PQRS_0254', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0254', '1')
('PQRS_0255', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0255', '1')
('PQRS_0257', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0257', '1')
('PQRS_0258', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0258', '1')
('PQRS_0259', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0259', '1')
('PQRS_0260', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0260', '1')
('PQRS_0261', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0261', '1')
('PQRS_0262', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0262', '1')
('PQRS_0263', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0263', '1')
('PQRS_0264', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0264', '1')
('PQRS_0265', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0265', '1')
('PQRS_0268', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0268', '1')
('PQRS_0270', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0270', '1')
('PQRS_0271', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0271', '1')
('PQRS_0274', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0274', '1')
('PQRS_0275', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0275', '1')
('PQRS_0303', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0303', '1')
('PQRS_0304', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0304', '1')
('PQRS_0317', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0317', '1')
('PQRS_0320', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0320', '1')
('PQRS_0322', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0322', '1')
('PQRS_0323', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0323', '1')
('PQRS_0324', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0324', '1')
('PQRS_0325', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0325', '1')
('PQRS_0326', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0326', '1')
('PQRS_0327', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0327', '1')
('PQRS_0328', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0328', '1')
('PQRS_0329', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0329', '1')
('PQRS_0330', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0330', '1')
('PQRS_0331', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0331', '1')
('PQRS_0332', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0332', '1')
('PQRS_0333', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0333', '1')
('PQRS_0334', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0334', '1')
('PQRS_0335', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0335', '1')
('PQRS_0336', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0336', '1')
('PQRS_0337', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0337', '1')
('PQRS_0342', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0342', '1')
('PQRS_0343', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0343', '1')
('PQRS_0344', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0344', '1')
('PQRS_0345', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0345', '1')
('PQRS_0346', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0346', '1')
('PQRS_0347', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0347', '1')
('PQRS_0348', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0348', '1')
('PQRS_0349', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0349', '1')
('PQRS_0358', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0358', '1')
('PQRS_0383', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0383', '1')
('PQRS_0384', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0384', '1')
('PQRS_0385', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0385', '1')
('PQRS_0386', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0386', '1')
('PQRS_0387', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0387', '1')
('PQRS_0388', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0388', '1')
('PQRS_0389', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0389', '1')
('PQRS_0390', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0390', '1')
('PQRS_0391', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0391', '1')
('PQRS_0392', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0392', '1')
('PQRS_0393', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0393', '1')
('PQRS_0394', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0394', '1')
('PQRS_0395', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0395', '1')
('PQRS_0396', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0396', '1')
('PQRS_0397', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0397', '1')
('PQRS_0398', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0398', '1')
('PQRS_0399', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0399', '1')
('PQRS_0400', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0400', '1')
('PQRS_0401', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0401', '1')
('PQRS_0402', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_0402', '1')
('PQRS_always_met', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_always_met', '1')
('PQRS_Group_AOE_0091', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0091', '1')
('PQRS_Group_AOE_0093', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0093', '1')
('PQRS_Group_AOE_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0130', '1')
('PQRS_Group_AOE_0131', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0131', '1')
('PQRS_Group_AOE_0154', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0154', '1')
('PQRS_Group_AOE_0155', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0155', '1')
('PQRS_Group_AOE_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0226', '1')
('PQRS_Group_AOE_0317', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_AOE_0317', '1')
('PQRS_Group_Asthma_0053', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0053', '1')
('PQRS_Group_Asthma_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0110', '1')
('PQRS_Group_Asthma_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0128', '1')
('PQRS_Group_Asthma_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0130', '1')
('PQRS_Group_Asthma_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0226', '1')
('PQRS_Group_Asthma_0402', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Asthma_0402', '1')
('PQRS_Group_CABG_0043', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0043', '1')
('PQRS_Group_CABG_0044', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0044', '1')
('PQRS_Group_CABG_0164', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0164', '1')
('PQRS_Group_CABG_0165', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0165', '1')
('PQRS_Group_CABG_0166', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0166', '1')
('PQRS_Group_CABG_0167', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0167', '1')
('PQRS_Group_CABG_0168', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CABG_0168', '1')
('PQRS_Group_CAD_0006', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0006', '1')
('PQRS_Group_CAD_0007', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0007', '1')
('PQRS_Group_CAD_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0128', '1')
('PQRS_Group_CAD_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0130', '1')
('PQRS_Group_CAD_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0226', '1')
('PQRS_Group_CAD_0242', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CAD_0242', '1')
('PQRS_Group_Cataracts_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0130', '1')
('PQRS_Group_Cataracts_0191', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0191', '1')
('PQRS_Group_Cataracts_0192', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0192', '1')
('PQRS_Group_Cataracts_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0226', '1')
('PQRS_Group_Cataracts_0303', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0303', '1')
('PQRS_Group_Cataracts_0304', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0304', '1')
('PQRS_Group_Cataracts_0388', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0388', '1')
('PQRS_Group_Cataracts_0389', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Cataracts_0389', '1')
('PQRS_Group_CKD_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0047', '1')
('PQRS_Group_CKD_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0110', '1')
('PQRS_Group_CKD_0121', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0121', '1')
('PQRS_Group_CKD_0122', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0122', '1')
('PQRS_Group_CKD_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0130', '1')
('PQRS_Group_CKD_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_CKD_0226', '1')
('PQRS_Group_COPD_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0047', '1')
('PQRS_Group_COPD_0051', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0051', '1')
('PQRS_Group_COPD_0052', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0052', '1')
('PQRS_Group_COPD_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0110', '1')
('PQRS_Group_COPD_0111', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0111', '1')
('PQRS_Group_COPD_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0130', '1')
('PQRS_Group_COPD_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_COPD_0226', '1')
('PQRS_Group_Dementia_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0047', '1')
('PQRS_Group_Dementia_0280', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0280', '1')
('PQRS_Group_Dementia_0281', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0281', '1')
('PQRS_Group_Dementia_0282', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0282', '1')
('PQRS_Group_Dementia_0283', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0283', '1')
('PQRS_Group_Dementia_0284', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0284', '1')
('PQRS_Group_Dementia_0285', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0285', '1')
('PQRS_Group_Dementia_0286', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0286', '1')
('PQRS_Group_Dementia_0287', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0287', '1')
('PQRS_Group_Dementia_0288', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Dementia_0288', '1')
('PQRS_Group_Diabetes_0001', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0001', '1')
('PQRS_Group_Diabetes_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0110', '1')
('PQRS_Group_Diabetes_0117', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0117', '1')
('PQRS_Group_Diabetes_0119', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0119', '1')
('PQRS_Group_Diabetes_0163', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0163', '1')
('PQRS_Group_Diabetes_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Diabetes_0226', '1')
('PQRS_Group_General_Surgery_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0130', '1')
('PQRS_Group_General_Surgery_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0226', '1')
('PQRS_Group_General_Surgery_0354', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0354', '1')
('PQRS_Group_General_Surgery_0355', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0355', '1')
('PQRS_Group_General_Surgery_0356', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0356', '1')
('PQRS_Group_General_Surgery_0357', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0357', '1')
('PQRS_Group_General_Surgery_0358', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Surgery_0358', '1')
('PQRS_Group_HepatitisC_0084', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0084', '1')
('PQRS_Group_HepatitisC_0085', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0085', '1')
('PQRS_Group_HepatitisC_0087', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0087', '1')
('PQRS_Group_HepatitisC_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0130', '1')
('PQRS_Group_HepatitisC_0183', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0183', '1')
('PQRS_Group_HepatitisC_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0226', '1')
('PQRS_Group_HepatitisC_0390', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0390', '1')
('PQRS_Group_HepatitisC_0401', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HepatitisC_0401', '1')
('PQRS_Group_HF_0005', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0005', '1')
('PQRS_Group_HF_0008', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0008', '1')
('PQRS_Group_HF_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0047', '1')
('PQRS_Group_HF_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0110', '1')
('PQRS_Group_HF_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0130', '1')
('PQRS_Group_HF_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HF_0226', '1')
('PQRS_Group_HIVAIDS_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0047', '1')
('PQRS_Group_HIVAIDS_0134', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0134', '1')
('PQRS_Group_HIVAIDS_0160', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0160', '1')
('PQRS_Group_HIVAIDS_0205', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0205', '1')
('PQRS_Group_HIVAIDS_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0226', '1')
('PQRS_Group_HIVAIDS_0338', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0338', '1')
('PQRS_Group_HIVAIDS_0339', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0339', '1')
('PQRS_Group_HIVAIDS_0340', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_HIVAIDS_0340', '1')
('PQRS_Group_IBD_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0110', '1')
('PQRS_Group_IBD_0111', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0111', '1')
('PQRS_Group_IBD_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0226', '1')
('PQRS_Group_IBD_0270', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0270', '1')
('PQRS_Group_IBD_0271', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0271', '1')
('PQRS_Group_IBD_0274', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0274', '1')
('PQRS_Group_IBD_0275', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_IBD_0275', '1')
('PQRS_Group_Oncology_0071', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0071', '1')
('PQRS_Group_Oncology_0072', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0072', '1')
('PQRS_Group_Oncology_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0110', '1')
('PQRS_Group_Oncology_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0130', '1')
('PQRS_Group_Oncology_0143', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0143', '1')
('PQRS_Group_Oncology_0144', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0144', '1')
('PQRS_Group_Oncology_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Oncology_0226', '1')
('PQRS_Group_OPEIR_0359', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0359', '1')
('PQRS_Group_OPEIR_0360', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0360', '1')
('PQRS_Group_OPEIR_0361', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0361', '1')
('PQRS_Group_OPEIR_0362', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0362', '1')
('PQRS_Group_OPEIR_0363', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0363', '1')
('PQRS_Group_OPEIR_0364', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_OPEIR_0364', '1')
('PQRS_Group_Parkinsons_0047', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0047', '1')
('PQRS_Group_Parkinsons_0289', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0289', '1')
('PQRS_Group_Parkinsons_0290', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0290', '1')
('PQRS_Group_Parkinsons_0291', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0291', '1')
('PQRS_Group_Parkinsons_0292', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0292', '1')
('PQRS_Group_Parkinsons_0293', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0293', '1')
('PQRS_Group_Parkinsons_0294', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Parkinsons_0294', '1')
('PQRS_Group_Preventive_0039', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0039', '1')
('PQRS_Group_Preventive_0048', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0048', '1')
('PQRS_Group_Preventive_0110', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0110', '1')
('PQRS_Group_Preventive_0111', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0111', '1')
('PQRS_Group_Preventive_0112', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0112', '1')
('PQRS_Group_Preventive_0113', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0113', '1')
('PQRS_Group_Preventive_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0128', '1')
('PQRS_Group_Preventive_0134', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0134', '1')
('PQRS_Group_Preventive_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Preventive_0226', '1')
('PQRS_Group_RA_0108', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0108', '1')
('PQRS_Group_RA_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0128', '1')
('PQRS_Group_RA_0131', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0131', '1')
('PQRS_Group_RA_0176', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0176', '1')
('PQRS_Group_RA_0177', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0177', '1')
('PQRS_Group_RA_0178', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0178', '1')
('PQRS_Group_RA_0179', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0179', '1')
('PQRS_Group_RA_0180', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_RA_0180', '1')
('PQRS_Group_Sinusitis_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0130', '1')
('PQRS_Group_Sinusitis_0131', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0131', '1')
('PQRS_Group_Sinusitis_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0226', '1')
('PQRS_Group_Sinusitis_0331', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0331', '1')
('PQRS_Group_Sinusitis_0332', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0332', '1')
('PQRS_Group_Sinusitis_0333', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sinusitis_0333', '1')
('PQRS_Group_Sleep_Apnea_0128', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0128', '1')
('PQRS_Group_Sleep_Apnea_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0130', '1')
('PQRS_Group_Sleep_Apnea_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0226', '1')
('PQRS_Group_Sleep_Apnea_0276', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0276', '1')
('PQRS_Group_Sleep_Apnea_0277', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0277', '1')
('PQRS_Group_Sleep_Apnea_0278', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0278', '1')
('PQRS_Group_Sleep_Apnea_0279', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_Sleep_Apnea_0279', '1')
('PQRS_Group_TKR_0130', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0130', '1')
('PQRS_Group_TKR_0226', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0226', '1')
('PQRS_Group_TKR_0350', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0350', '1')
('PQRS_Group_TKR_0351', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0351', '1')
('PQRS_Group_TKR_0352', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0352', '1')
('PQRS_Group_TKR_0353', '0', '0', '0', '0', NULL, NULL, '', '', '0', '0', '0', '', '', '0', NULL, '0', '', '', '2015', '', 'patients:med', 'PQRS_Group_TKR_0353', '1');


INSERT INTO `list_options` (`list_id`, `option_id`, `title`, `seq`, `is_default`, `option_value`, `mapping`, `notes`, `codes`, `toggle_setting_1`, `toggle_setting_2`, `activity`) VALUES
('clinical_rules', 'PQRS_0001', 'Measure PQRS_0001', '5000', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0005', 'Measure PQRS_0005', '5010', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0006', 'Measure PQRS_0006', '5020', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0007', 'Measure PQRS_0007', '5030', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0008', 'Measure PQRS_0008', '5040', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0012', 'Measure PQRS_0012', '5050', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0014', 'Measure PQRS_0014', '5060', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0019', 'Measure PQRS_0019', '5070', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0021', 'Measure PQRS_0021', '5080', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0022', 'Measure PQRS_0022', '5090', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0023', 'Measure PQRS_0023', '5100', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0024', 'Measure PQRS_0024', '5110', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0032', 'Measure PQRS_0032', '5120', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0033', 'Measure PQRS_0033', '5130', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0039', 'Measure PQRS_0039', '5140', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0040', 'Measure PQRS_0040', '5150', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0041', 'Measure PQRS_0041', '5160', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0043', 'Measure PQRS_0043', '5170', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0044', 'Measure PQRS_0044', '5180', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0046', 'Measure PQRS_0046', '5190', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0047', 'Measure PQRS_0047', '5200', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0048', 'Measure PQRS_0048', '5210', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0050', 'Measure PQRS_0050', '5220', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0051', 'Measure PQRS_0051', '5230', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0052', 'Measure PQRS_0052', '5240', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0053', 'Measure PQRS_0053', '5250', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0054', 'Measure PQRS_0054', '5260', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0065', 'Measure PQRS_0065', '5270', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0066', 'Measure PQRS_0066', '5280', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0067', 'Measure PQRS_0067', '5290', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0068', 'Measure PQRS_0068', '5300', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0069', 'Measure PQRS_0069', '5310', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0070', 'Measure PQRS_0070', '5320', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0071', 'Measure PQRS_0071', '5330', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0072', 'Measure PQRS_0072', '5340', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0076', 'Measure PQRS_0076', '5350', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0081', 'Measure PQRS_0081', '5360', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0082', 'Measure PQRS_0082', '5370', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0091', 'Measure PQRS_0091', '5380', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0093', 'Measure PQRS_0093', '5390', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0099', 'Measure PQRS_0099', '5400', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0100', 'Measure PQRS_0100', '5410', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0102', 'Measure PQRS_0102', '5420', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0104', 'Measure PQRS_0104', '5430', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0109', 'Measure PQRS_0109', '5440', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0110', 'Measure PQRS_0110', '5450', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0111', 'Measure PQRS_0111', '5460', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0112', 'Measure PQRS_0112', '5470', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0113', 'Measure PQRS_0113', '5480', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0116', 'Measure PQRS_0116', '5490', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0117', 'Measure PQRS_0117', '5500', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0118', 'Measure PQRS_0118', '5510', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0119', 'Measure PQRS_0119', '5520', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0121', 'Measure PQRS_0121', '5530', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0122', 'Measure PQRS_0122', '5540', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0126', 'Measure PQRS_0126', '5550', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0127', 'Measure PQRS_0127', '5560', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0128', 'Measure PQRS_0128', '5570', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0130', 'Measure PQRS_0130', '5580', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0131', 'Measure PQRS_0131', '5590', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0134', 'Measure PQRS_0134', '5600', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0137', 'Measure PQRS_0137', '5610', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0138', 'Measure PQRS_0138', '5620', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0140', 'Measure PQRS_0140', '5630', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0141', 'Measure PQRS_0141', '5640', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0143', 'Measure PQRS_0143', '5650', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0144', 'Measure PQRS_0144', '5660', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0145', 'Measure PQRS_0145', '5670', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0146', 'Measure PQRS_0146', '5680', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0147', 'Measure PQRS_0147', '5690', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0154', 'Measure PQRS_0154', '5700', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0155', 'Measure PQRS_0155', '5710', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0156', 'Measure PQRS_0156', '5720', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0163', 'Measure PQRS_0163', '5730', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0164', 'Measure PQRS_0164', '5740', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0165', 'Measure PQRS_0165', '5750', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0166', 'Measure PQRS_0166', '5760', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0167', 'Measure PQRS_0167', '5770', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0168', 'Measure PQRS_0168', '5780', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0172', 'Measure PQRS_0172', '5790', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0173', 'Measure PQRS_0173', '5800', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0178', 'Measure PQRS_0178', '5810', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0181', 'Measure PQRS_0181', '5820', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0182', 'Measure PQRS_0182', '5830', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0185', 'Measure PQRS_0185', '5840', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0187', 'Measure PQRS_0187', '5850', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0191', 'Measure PQRS_0191', '5860', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0192', 'Measure PQRS_0192', '5870', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0193', 'Measure PQRS_0193', '5880', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0194', 'Measure PQRS_0194', '5890', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0195', 'Measure PQRS_0195', '5900', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0204', 'Measure PQRS_0204', '5910', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0205', 'Measure PQRS_0205', '5920', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0217', 'Measure PQRS_0217', '5930', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0218', 'Measure PQRS_0218', '5940', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0219', 'Measure PQRS_0219', '5950', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0220', 'Measure PQRS_0220', '5960', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0221', 'Measure PQRS_0221', '5970', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0222', 'Measure PQRS_0222', '5980', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0223', 'Measure PQRS_0223', '5990', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0224', 'Measure PQRS_0224', '6000', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0225', 'Measure PQRS_0225', '6010', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0226', 'Measure PQRS_0226', '6020', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0236', 'Measure PQRS_0236', '6030', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0238', 'Measure PQRS_0238', '6040', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0242', 'Measure PQRS_0242', '6050', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0243', 'Measure PQRS_0243', '6060', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0249', 'Measure PQRS_0249', '6070', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0250', 'Measure PQRS_0250', '6080', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0251', 'Measure PQRS_0251', '6090', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0254', 'Measure PQRS_0254', '6100', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0255', 'Measure PQRS_0255', '6110', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0257', 'Measure PQRS_0257', '6120', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0258', 'Measure PQRS_0258', '6130', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0259', 'Measure PQRS_0259', '6140', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0260', 'Measure PQRS_0260', '6150', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0261', 'Measure PQRS_0261', '6160', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0262', 'Measure PQRS_0262', '6170', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0263', 'Measure PQRS_0263', '6180', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0264', 'Measure PQRS_0264', '6190', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0265', 'Measure PQRS_0265', '6200', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0268', 'Measure PQRS_0268', '6210', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0270', 'Measure PQRS_0270', '6220', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0271', 'Measure PQRS_0271', '6230', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0274', 'Measure PQRS_0274', '6240', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0275', 'Measure PQRS_0275', '6250', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0303', 'Measure PQRS_0303', '6260', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0304', 'Measure PQRS_0304', '6270', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0317', 'Measure PQRS_0317', '6280', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0320', 'Measure PQRS_0320', '6290', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0322', 'Measure PQRS_0322', '6300', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0323', 'Measure PQRS_0323', '6310', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0324', 'Measure PQRS_0324', '6320', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0325', 'Measure PQRS_0325', '6330', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0326', 'Measure PQRS_0326', '6340', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0327', 'Measure PQRS_0327', '6350', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0328', 'Measure PQRS_0328', '6360', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0329', 'Measure PQRS_0329', '6370', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0330', 'Measure PQRS_0330', '6380', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0331', 'Measure PQRS_0331', '6390', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0332', 'Measure PQRS_0332', '6400', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0333', 'Measure PQRS_0333', '6410', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0334', 'Measure PQRS_0334', '6420', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0335', 'Measure PQRS_0335', '6430', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0336', 'Measure PQRS_0336', '6440', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0337', 'Measure PQRS_0337', '6450', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0342', 'Measure PQRS_0342', '6460', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0343', 'Measure PQRS_0343', '6470', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0344', 'Measure PQRS_0344', '6480', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0345', 'Measure PQRS_0345', '6490', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0346', 'Measure PQRS_0346', '6500', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0347', 'Measure PQRS_0347', '6510', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0348', 'Measure PQRS_0348', '6520', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0349', 'Measure PQRS_0349', '6530', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0358', 'Measure PQRS_0358', '6540', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0383', 'Measure PQRS_0383', '6550', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0384', 'Measure PQRS_0384', '6560', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0385', 'Measure PQRS_0385', '6570', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0386', 'Measure PQRS_0386', '6580', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0387', 'Measure PQRS_0387', '6590', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0388', 'Measure PQRS_0388', '6600', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0389', 'Measure PQRS_0389', '6610', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0390', 'Measure PQRS_0390', '6620', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0391', 'Measure PQRS_0391', '6630', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0392', 'Measure PQRS_0392', '6640', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0393', 'Measure PQRS_0393', '6650', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0394', 'Measure PQRS_0394', '6660', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0395', 'Measure PQRS_0395', '6670', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0396', 'Measure PQRS_0396', '6680', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0397', 'Measure PQRS_0397', '6690', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0398', 'Measure PQRS_0398', '6700', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0399', 'Measure PQRS_0399', '6710', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0400', 'Measure PQRS_0400', '6720', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0401', 'Measure PQRS_0401', '6730', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_0402', 'Measure PQRS_0402', '6740', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_always_met', 'Measure PQRS_always_met', '6750', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0091', 'Measure PQRS_Group_AOE_0091', '6760', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0093', 'Measure PQRS_Group_AOE_0093', '6770', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0130', 'Measure PQRS_Group_AOE_0130', '6780', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0131', 'Measure PQRS_Group_AOE_0131', '6790', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0154', 'Measure PQRS_Group_AOE_0154', '6800', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0155', 'Measure PQRS_Group_AOE_0155', '6810', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0226', 'Measure PQRS_Group_AOE_0226', '6820', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_AOE_0317', 'Measure PQRS_Group_AOE_0317', '6830', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0053', 'Measure PQRS_Group_Asthma_0053', '6840', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0110', 'Measure PQRS_Group_Asthma_0110', '6850', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0128', 'Measure PQRS_Group_Asthma_0128', '6860', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0130', 'Measure PQRS_Group_Asthma_0130', '6870', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0226', 'Measure PQRS_Group_Asthma_0226', '6880', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Asthma_0402', 'Measure PQRS_Group_Asthma_0402', '6890', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0043', 'Measure PQRS_Group_CABG_0043', '6900', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0044', 'Measure PQRS_Group_CABG_0044', '6910', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0164', 'Measure PQRS_Group_CABG_0164', '6920', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0165', 'Measure PQRS_Group_CABG_0165', '6930', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0166', 'Measure PQRS_Group_CABG_0166', '6940', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0167', 'Measure PQRS_Group_CABG_0167', '6950', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CABG_0168', 'Measure PQRS_Group_CABG_0168', '6960', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0006', 'Measure PQRS_Group_CAD_0006', '6970', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0007', 'Measure PQRS_Group_CAD_0007', '6980', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0128', 'Measure PQRS_Group_CAD_0128', '6990', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0130', 'Measure PQRS_Group_CAD_0130', '7000', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0226', 'Measure PQRS_Group_CAD_0226', '7010', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CAD_0242', 'Measure PQRS_Group_CAD_0242', '7020', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0130', 'Measure PQRS_Group_Cataracts_0130', '7030', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0191', 'Measure PQRS_Group_Cataracts_0191', '7040', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0192', 'Measure PQRS_Group_Cataracts_0192', '7050', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0226', 'Measure PQRS_Group_Cataracts_0226', '7060', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0303', 'Measure PQRS_Group_Cataracts_0303', '7070', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0304', 'Measure PQRS_Group_Cataracts_0304', '7080', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0388', 'Measure PQRS_Group_Cataracts_0388', '7090', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Cataracts_0389', 'Measure PQRS_Group_Cataracts_0389', '7100', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0047', 'Measure PQRS_Group_CKD_0047', '7110', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0110', 'Measure PQRS_Group_CKD_0110', '7120', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0121', 'Measure PQRS_Group_CKD_0121', '7130', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0122', 'Measure PQRS_Group_CKD_0122', '7140', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0130', 'Measure PQRS_Group_CKD_0130', '7150', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_CKD_0226', 'Measure PQRS_Group_CKD_0226', '7160', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0047', 'Measure PQRS_Group_COPD_0047', '7170', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0051', 'Measure PQRS_Group_COPD_0051', '7180', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0052', 'Measure PQRS_Group_COPD_0052', '7190', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0110', 'Measure PQRS_Group_COPD_0110', '7200', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0111', 'Measure PQRS_Group_COPD_0111', '7210', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0130', 'Measure PQRS_Group_COPD_0130', '7220', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_COPD_0226', 'Measure PQRS_Group_COPD_0226', '7230', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0047', 'Measure PQRS_Group_Dementia_0047', '7240', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0280', 'Measure PQRS_Group_Dementia_0280', '7250', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0281', 'Measure PQRS_Group_Dementia_0281', '7260', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0282', 'Measure PQRS_Group_Dementia_0282', '7270', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0283', 'Measure PQRS_Group_Dementia_0283', '7280', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0284', 'Measure PQRS_Group_Dementia_0284', '7290', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0285', 'Measure PQRS_Group_Dementia_0285', '7300', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0286', 'Measure PQRS_Group_Dementia_0286', '7310', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0287', 'Measure PQRS_Group_Dementia_0287', '7320', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Dementia_0288', 'Measure PQRS_Group_Dementia_0288', '7330', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0001', 'Measure PQRS_Group_Diabetes_0001', '7340', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0110', 'Measure PQRS_Group_Diabetes_0110', '7350', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0117', 'Measure PQRS_Group_Diabetes_0117', '7360', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0119', 'Measure PQRS_Group_Diabetes_0119', '7370', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0163', 'Measure PQRS_Group_Diabetes_0163', '7380', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Diabetes_0226', 'Measure PQRS_Group_Diabetes_0226', '7390', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0130', 'Measure PQRS_Group_General_Surgery_0130', '7400', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0226', 'Measure PQRS_Group_General_Surgery_0226', '7410', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0354', 'Measure PQRS_Group_General_Surgery_0354', '7420', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0355', 'Measure PQRS_Group_General_Surgery_0355', '7430', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0356', 'Measure PQRS_Group_General_Surgery_0356', '7440', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0357', 'Measure PQRS_Group_General_Surgery_0357', '7450', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_General_Surgery_0358', 'Measure PQRS_Group_General_Surgery_0358', '7460', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0084', 'Measure PQRS_Group_HepatitisC_0084', '7470', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0085', 'Measure PQRS_Group_HepatitisC_0085', '7480', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0087', 'Measure PQRS_Group_HepatitisC_0087', '7490', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0130', 'Measure PQRS_Group_HepatitisC_0130', '7500', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0183', 'Measure PQRS_Group_HepatitisC_0183', '7510', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0226', 'Measure PQRS_Group_HepatitisC_0226', '7520', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0390', 'Measure PQRS_Group_HepatitisC_0390', '7530', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HepatitisC_0401', 'Measure PQRS_Group_HepatitisC_0401', '7540', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0005', 'Measure PQRS_Group_HF_0005', '7550', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0008', 'Measure PQRS_Group_HF_0008', '7560', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0047', 'Measure PQRS_Group_HF_0047', '7570', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0110', 'Measure PQRS_Group_HF_0110', '7580', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0130', 'Measure PQRS_Group_HF_0130', '7590', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HF_0226', 'Measure PQRS_Group_HF_0226', '7600', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0047', 'Measure PQRS_Group_HIVAIDS_0047', '7610', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0134', 'Measure PQRS_Group_HIVAIDS_0134', '7620', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0160', 'Measure PQRS_Group_HIVAIDS_0160', '7630', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0205', 'Measure PQRS_Group_HIVAIDS_0205', '7640', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0226', 'Measure PQRS_Group_HIVAIDS_0226', '7650', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0338', 'Measure PQRS_Group_HIVAIDS_0338', '7660', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0339', 'Measure PQRS_Group_HIVAIDS_0339', '7670', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_HIVAIDS_0340', 'Measure PQRS_Group_HIVAIDS_0340', '7680', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0110', 'Measure PQRS_Group_IBD_0110', '7690', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0111', 'Measure PQRS_Group_IBD_0111', '7700', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0226', 'Measure PQRS_Group_IBD_0226', '7710', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0270', 'Measure PQRS_Group_IBD_0270', '7720', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0271', 'Measure PQRS_Group_IBD_0271', '7730', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0274', 'Measure PQRS_Group_IBD_0274', '7740', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_IBD_0275', 'Measure PQRS_Group_IBD_0275', '7750', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0071', 'Measure PQRS_Group_Oncology_0071', '7760', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0072', 'Measure PQRS_Group_Oncology_0072', '7770', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0110', 'Measure PQRS_Group_Oncology_0110', '7780', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0130', 'Measure PQRS_Group_Oncology_0130', '7790', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0143', 'Measure PQRS_Group_Oncology_0143', '7800', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0144', 'Measure PQRS_Group_Oncology_0144', '7810', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Oncology_0226', 'Measure PQRS_Group_Oncology_0226', '7820', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0359', 'Measure PQRS_Group_OPEIR_0359', '7830', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0360', 'Measure PQRS_Group_OPEIR_0360', '7840', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0361', 'Measure PQRS_Group_OPEIR_0361', '7850', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0362', 'Measure PQRS_Group_OPEIR_0362', '7860', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0363', 'Measure PQRS_Group_OPEIR_0363', '7870', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_OPEIR_0364', 'Measure PQRS_Group_OPEIR_0364', '7880', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0047', 'Measure PQRS_Group_Parkinsons_0047', '7890', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0289', 'Measure PQRS_Group_Parkinsons_0289', '7900', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0290', 'Measure PQRS_Group_Parkinsons_0290', '7910', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0291', 'Measure PQRS_Group_Parkinsons_0291', '7920', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0292', 'Measure PQRS_Group_Parkinsons_0292', '7930', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0293', 'Measure PQRS_Group_Parkinsons_0293', '7940', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Parkinsons_0294', 'Measure PQRS_Group_Parkinsons_0294', '7950', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0039', 'Measure PQRS_Group_Preventive_0039', '7960', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0048', 'Measure PQRS_Group_Preventive_0048', '7970', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0110', 'Measure PQRS_Group_Preventive_0110', '7980', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0111', 'Measure PQRS_Group_Preventive_0111', '7990', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0112', 'Measure PQRS_Group_Preventive_0112', '8000', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0113', 'Measure PQRS_Group_Preventive_0113', '8010', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0128', 'Measure PQRS_Group_Preventive_0128', '8020', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0134', 'Measure PQRS_Group_Preventive_0134', '8030', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Preventive_0226', 'Measure PQRS_Group_Preventive_0226', '8050', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0108', 'Measure PQRS_Group_RA_0108', '8060', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0128', 'Measure PQRS_Group_RA_0128', '8070', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0131', 'Measure PQRS_Group_RA_0131', '8080', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0176', 'Measure PQRS_Group_RA_0176', '8090', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0177', 'Measure PQRS_Group_RA_0177', '8100', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0178', 'Measure PQRS_Group_RA_0178', '8110', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0179', 'Measure PQRS_Group_RA_0179', '8120', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_RA_0180', 'Measure PQRS_Group_RA_0180', '8130', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0130', 'Measure PQRS_Group_Sinusitis_0130', '8140', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0131', 'Measure PQRS_Group_Sinusitis_0131', '8150', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0226', 'Measure PQRS_Group_Sinusitis_0226', '8160', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0331', 'Measure PQRS_Group_Sinusitis_0331', '8170', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0332', 'Measure PQRS_Group_Sinusitis_0332', '8180', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sinusitis_0333', 'Measure PQRS_Group_Sinusitis_0333', '8190', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0128', 'Measure PQRS_Group_Sleep_Apnea_0128', '8200', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0130', 'Measure PQRS_Group_Sleep_Apnea_0130', '8210', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0226', 'Measure PQRS_Group_Sleep_Apnea_0226', '8220', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0276', 'Measure PQRS_Group_Sleep_Apnea_0276', '8230', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0277', 'Measure PQRS_Group_Sleep_Apnea_0277', '8240', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0278', 'Measure PQRS_Group_Sleep_Apnea_0278', '8250', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_Sleep_Apnea_0279', 'Measure PQRS_Group_Sleep_Apnea_0279', '8260', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0130', 'Measure PQRS_Group_TKR_0130', '8270', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0226', 'Measure PQRS_Group_TKR_0226', '8280', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0350', 'Measure PQRS_Group_TKR_0350', '8290', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0351', 'Measure PQRS_Group_TKR_0351', '8300', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0352', 'Measure PQRS_Group_TKR_0352', '8310', '0', '0', '', '', '', '0', '0', '1'),
('clinical_rules', 'PQRS_Group_TKR_0353', 'Measure PQRS_Group_TKR_0353', '8320', '0', '0', '', '', '', '0', '0', '1');

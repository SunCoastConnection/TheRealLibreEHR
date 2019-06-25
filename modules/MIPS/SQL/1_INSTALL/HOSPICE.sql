<?php
/* Copyright (C) 2019    Suncoast Connection
 * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 *
 * Please support this product by sharing your changes with the LibreEHR.org community.
 */


$query =
"DROP TABLE IF EXISTS MIPS_hospice;";
sqlStatementNoLog($query);

$query =
"CREATE TABLE `MIPS_hospice` (
id int NOT NULL auto_increment,
code varchar(15),
PRIMARY KEY  (`id`)
);";
sqlStatementNoLog($query);

$query =
"INSERT INTO HOSPICE (`code`) VALUES
('G9330'),
('G9687'),
('G9688'),
('G9690'),
('G9691'),
('G9692'),
('G9693'),
('G9694'),
('G9700'),
('G9702'),
('G9707'),
('G9710'),
('G9713'),
('G9714'),
('G9715'),
('G9718'),
('G9720'),
('G9725'),
('G9740'),
('G9741'),
('G9747'),
('G9749'),
('G9758'),
('G9760'),
('G9761'),
('G9768'),
('G9761'),
('G9802'),
('G9805'),
('G9809'),
('M1022'),
('M1025'),
('M1026'),
('Z51.5');";
sqlStatementNoLog($query);

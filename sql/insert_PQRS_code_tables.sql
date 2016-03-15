/*
 * Copyright (C) 2016      Suncoast Connection
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
 * @author  meggerc
 * @link    http://www.oemr.org
 * @link    http://suncoastconnection.com
 */

DROP TABLE IF EXISTS pqrs_ccco;
CREATE TABLE IF NOT EXISTS `pqrs_ccco` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS pqrs_poph;
CREATE TABLE IF NOT EXISTS `pqrs_poph` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS pqrs_efcc;
CREATE TABLE IF NOT EXISTS `pqrs_efcc` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS pqrs_ecr;
CREATE TABLE IF NOT EXISTS `pqrs_ecr` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS pqrs_ptsf;
CREATE TABLE IF NOT EXISTS `pqrs_ptsf` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);

DROP TABLE IF EXISTS pqrs_ptct;
CREATE TABLE IF NOT EXISTS `pqrs_ptct` (
id int NOT NULL auto_increment,
type varchar(15),
code varchar(15),
PRIMARY KEY  (`id`)
);



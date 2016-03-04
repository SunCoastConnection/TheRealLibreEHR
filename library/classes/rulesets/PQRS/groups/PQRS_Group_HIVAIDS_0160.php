<?php
/*
 * PQRS Measure Group_HIVAIDS_0160 -- Call to createPopulationCriteria()
 *
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
 * @link    http://suncoastconnection.com
 * @link    http://www.oemr.org
*/

class PQRS_Group_HIVAIDS_0160 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
         return new $populationCriteria;    
    }
}

?>

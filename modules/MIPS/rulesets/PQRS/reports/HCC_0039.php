
<?php
/**
 * HCC Measure HCC_0039 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2018      Suncoast Connection
  * 
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details. 
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 * 
 * @author  Art Eaton <art@suncoastconnection.com>
 * @package LibreEHR 
 * @link    http://suncoastconnection.com
 * @link    http://LibreEHR.org
 *
 * Please support this product by sharing your changes with the Libre.io community.
 */

class HCC_0039 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
        return new HCC_0039_PopulationCriteria();
    }
}

?>

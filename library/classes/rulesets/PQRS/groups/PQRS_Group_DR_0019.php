<?php
/**
 * PQRS Measure Group_DR_0019 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
 */

class PQRS_Group_DR_0019 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
        return new PQRS_Group_DR_0019_PopulationCriteria();
    }
}

?>

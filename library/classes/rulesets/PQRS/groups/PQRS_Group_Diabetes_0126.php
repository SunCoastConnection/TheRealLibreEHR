<?php
/**
 * PQRS Measure Group_Diabetes_0126 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
 */

class PQRS_Group_Diabetes_0126 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
        return new PQRS_Group_Diabetes_0126_PopulationCriteria();
    }
}

?>

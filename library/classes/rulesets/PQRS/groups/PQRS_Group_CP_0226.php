<?php
/**
 * PQRS Measure Group_CP_226 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2016      Suncoast Connection
 *
 * @package OpenEMR
 * @link    http://suncoastconnection.com
 * @author  Suncoast Connection
 */

class PQRS_Group_CP_0226 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
        return new PQRS_Group_CP_0226_PopulationCriteria();
    }
}

?>

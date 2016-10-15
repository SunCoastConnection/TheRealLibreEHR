<?php
/**
 * PQRS Measure Group_HepatitisC_0084 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2016      Suncoast Connection

 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 
*/

class PQRS_Group_HepatitisC_0084 extends AbstractPQRSReport
{   
    public function createPopulationCriteria()
    {
         return new PQRS_Group_HepatitisC_0084_PopulationCriteria();    
    }
}

?>


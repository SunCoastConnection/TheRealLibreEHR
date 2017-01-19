<?php
/**
 * PQRS Measure 0438 -- Call to createPopulationCriteria()
 *
 * Copyright (C) 2016      Suncoast Connection
 * @package PQRS_Gateway 
 * @link    http://suncoastconnection.com
 * @author  Bryan lee <bryan@suncoastconnection.com>
 * @author  Art Eaton <art@suncoastconnection.com>
 */

class pre_0438 extends AbstractPQRSReport {   
    public function createPopulationCriteria() {
		$populationCriteria = array();

		$populationCriteria[] = new pre_0438_PopulationCriteria();
		return $populationCriteria;    
    }

}

?>

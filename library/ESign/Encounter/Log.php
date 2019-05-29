<?php

namespace ESign;

/**
 * Encounter implementation of LogIF interface, which is used to
 * display the signature log.
 * 
 * Copyright (C) 2013 OEMR 501c3 www.oemr.org
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://opensource.org/licenses/gpl-license.php>;.
 *
 * @package LibreEHR
 * @author  Ken Chapple <ken@mi-squared.com>
 * @author  Medical Information Integration, LLC
 * @link    http://LibreEHR.org
 **/

require_once $GLOBALS['srcdir'].'/ESign/LogIF.php';
require_once $GLOBALS['srcdir'].'/ESign/Viewer.php';

class Encounter_Log implements LogIF
{
    protected $_viewer = null;
    
    /**
     * Create a new instance of Encounter_Log. 
     * 
     * We pass custom variables needed to render log through
     * the constructor because they aren't necessarily available
     * through the SignableIF interface when render() function is called.
     * 
     * @param unknown $encounterId
     */
    public function __construct( $encounterId )
    {
        $this->_viewer = new Viewer(); 
        $this->_viewer->encounterId = $encounterId;
        $this->_viewer->logId = "encounter-".$encounterId;
    }
    
    public function render( SignableIF $signable )
    {
        $this->_viewer->signatures = $signable->getSignatures();
        $this->_viewer->verified = $signable->verify();
        return $this->_viewer->render( $this );
    }
    
    public function getHtml( SignableIF $signable )
    {
        $this->_viewer->verified = $signable->verify();
        $this->_viewer->signatures = $signable->getSignatures();
        return $this->_viewer->getHtml( $this );
    }
    
    public function getViewScript()
    {
        return $GLOBALS['srcdir'].'/ESign/views/default/esign_signature_log.php';
    }

    /**
     * Check if the log is viewable.
     *
     * @return boolean
     */
    public function isViewable()
    {
        $viewable = false;
        if ( $GLOBALS['esign_all'] ) {
            $viewable = true;
        }
        
        return $viewable;
    }
}

<?php
 // Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

class Controller_detail extends BaseController {

    function _action_view() {
        $ruleId = _get('id');
        $rule = $this->getRuleManager()->getRule( $ruleId );
        if ( is_null( $rule ) ) {
            $this->redirect("index.php?action=browse!list");
        } else {
            // Instantiating object if does not exist to avoid
            // "creating default object from empty value" warning.
            if (!isset($this->viewBean)) {
                $this->viewBean = new stdClass();
            }

            $this->viewBean->rule = $rule;
            $this->set_view( "view.php" );
        }
    }

}
?>

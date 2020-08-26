<?php
/**
 * Script to configure the Rules.
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
 * @author  Ensoftek
 
 * @link    http://LibreEHR.org
 */

require_once(dirname(__FILE__)."/../../../../../../modules/ACL/acl.inc.php"); 

require_once(dirname(__FILE__)."/../../../../../globals.php");
require_once($GLOBALS['srcdir']."/headers.inc.php");
?>

<table class="header">
  <tr>
        <td class="title"><?php echo out( xl('Clinical Decision Rules Alert Manager') ); ?></td>
        
  </tr>
  <tr>
        <td>
        	<a href="javascript:document.cdralertmgr.submit();" class="css_button cp-submit" onclick="top.restoreSession()"><span><?php echo out( xl('Save') ); ?></span></a><a href="javascript:document.cdralertmgr.reset();" class="css_button cp-negative" onclick="top.restoreSession()"><span><?php echo out( xl('Reset') ); ?></span></a>
        </td>
  </tr>        
</table>

&nbsp;

<form name="cdralertmgr" method="post" action="index.php?action=alerts!submitactmgr" onsubmit="return top.restoreSession()">
<table cellpadding="1" cellspacing="0" class="showborder">
        <tr class="showborder_head">
                <th width="250px"><?php echo out( xl('Title') ); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo out( xl('Active Alert') ); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo out( xl('Passive Alert') ); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="10px"><?php echo out( xl('Patient Reminder') ); ?></th>
                <th width="40px">&nbsp;</th>
                <th width="100px"><?php echo out( xl('Access Control') ); ?> <span title='<?php echo out( xl('User is required to have this access control for Active Alerts and Passive Alerts') ); ?>'>?</span></th>
                <th></th>
        </tr>
        <?php $index = -1; ?>
        <?php foreach($viewBean->rules as $rule) {?>
        <?php $index++; ?>
        <tr height="22">
                <td><?php echo out( xl($rule->get_rule()) );?></td>
				<td>&nbsp;</td>
				<?php if ($rule->active_alert_flag() == "1"){  ?>
                	<td><input type="checkbox" name="active[<?php echo $index ?>]" checked="yes"></td>
                <?php }else {?>
                	<td><input type="checkbox" name="active[<?php echo $index ?>]" ></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->passive_alert_flag() == "1"){ ?>
                	<td><input type="checkbox" name="passive[<?php echo $index ?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="passive[<?php echo $index ?>]]"></td>
				<?php } ?>                
				<td>&nbsp;</td>
                <?php if ($rule->patient_reminder_flag() == "1"){ ?>
                	<td><input type="checkbox" name="reminder[<?php echo $index ?>]]" checked="yes"></td>
                <?php }else {?>
	                <td><input type="checkbox" name="reminder[<?php echo $index ?>]]"></td>
				<?php } ?>               
                 <td>&nbsp;</td>
                <td><input style="display:none" name="id[<?php echo $index ?>]]" value=<?php echo out($rule->get_id()); ?> /></td>								
        </tr>
		<?php }?>
</table>
</form>



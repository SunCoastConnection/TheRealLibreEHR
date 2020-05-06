<?php
 // Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
 //
 // This program is free software; you can redistribute it and/or
 // modify it under the terms of the GNU General Public License
 // as published by the Free Software Foundation; either version 2
 // of the License, or (at your option) any later version.

 require_once(dirname(__FILE__)."/../../../../../globals.php");
 require_once($GLOBALS['srcdir']."/headers.inc.php");

 $rules = sqlStatement("SELECT * FROM list_options WHERE list_id='clinical_rules' ORDER BY title");?>

<script language="javascript" src="<?php js_src('list.js') ?>"></script>
<script language="javascript" src="<?php js_src('jQuery.fn.sortElements.js') ?>"></script>

<script type="text/javascript">
    var list = new list_rules();
    list.init();
</script>

<table class="header">
  <tr>
        <td class="title"><?php echo out( xl( 'Plans Configuration' ) ); ?></td>
        <td>
            <a href="index.php?action=browse!plans_config" class="iframe_medium css_button cp-misc">
                <span><?php echo out( xl( 'Go' ) ); ?></span>
            </a>
        </td>
  </tr>
  <tr>
        <td class="title"><?php echo out( xl( 'Rules Configuration' ) ); ?></td>
        <td>
            <a href="index.php?action=edit!summary" class="iframe_medium css_button cp-positive" onclick="top.restoreSession()">
                <span><?php echo out( xl( 'Add new' ) ); ?></span>
            </a>
        </td>
  </tr>
</table>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Type</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($rules as $i => $rule) { ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td class="rule_title"><a href="index.php?action=detail!view" id="<?php echo $rule['option_id']; ?>"> <?php echo xlt($rule["title"]); ?></a></td>
                    <td class="rule_type"><a href="index.php?action=detail!view"><?php echo xlt('Clinical Rule'); ?></a></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

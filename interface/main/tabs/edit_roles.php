<div id="manage_roles" class="tab-pane fade">
    <!-- izi-frames to popup modals-->
    <div id="addRole-iframe"></div>
    <div id="editRole-iframe"></div>
    <h1 style="padding-left: 10px;"><?php echo xlt("Manage Roles") ?></h1>
    <div style="padding-left: 10px;">
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>
                    <tr height="22">
                        <th><b>Role title</b></th>
                    </tr>
                    <?php foreach($role_list as $role_title) {?>
                    <tr>
                        <td> <span class="text">  <?php echo $role_title; ?> </span> </td>
                        <td> <a href="../../interface/roles/role_edit.php?title=<?php echo $role_title; ?>"  class="editRole" onclick="top.restoreSession()"> Edit  </a> </td>
                        <td> <a href="#"  class="iframe_medium" onclick="confirmDelete('<?php echo $role_title; ?>')"> Delete </a> </td>
                    </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </div>
        <a href="../../interface/roles/role_create.php" class="css_button cp-positive addRole"><span><?php echo xlt('Add Role'); ?></span></a>
    </div>
</div>

<script type = "text/javascript">
    function confirmDelete(title) {
        var return_value = confirm("Are you sure you want to delete this Role: " + title + " ?");
        if( return_value == true ) {
            window.location.href = "../../interface/roles/role_delete.php?title=" + title;
            return true;
        } else {
            return false;
        }
    }
</script>

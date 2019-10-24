<div id="edit_menu" class="tab-pane fade in active">
    <form id="menuData" name="menuData">
        <input type="hidden" id="menuEdits" name="menuEdits" value="">
    </form>

    <?php echo xlt("Save Menu Changes for site ID") . ': ' . $_SESSION['site_id'];?> <input type="button" id="saveDocument" class='cp-submit' value="Save" />
    <p class="clearfix"></p>
    <div id="jsoneditor"></div>
</div>

<script type="text/javascript">
    // create the editor
    var editor = new JSONEditor(document.getElementById('jsoneditor'));

    // Load a JSON document
    var menujson = '<?php echo $menu_json_fixed; ?>';
    editor.setText(menujson);

    // Save a JSON document
    document.getElementById('saveDocument').onclick = function () {
        // Save Dialog
        $.ajax({
            type: 'post',
            url: '../../interface/super/save_edit_settings.php',
            data: {menuEdits: editor.getText()},
            success: function(data) {
                alert(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    };
</script>


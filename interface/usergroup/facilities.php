<div id="facilities" class="tab-pane fade">
    <!-- to initialize the iziModal -->
  <div id="addFacilities-iframe"></div>
  <div id="editFacilities-iframe"></div>

<div>
    <div>
    <table>
        <tr>
            <td>
                <b><?php echo xlt('Facilities'); ?></b>&nbsp;
            </td>
            <td>
                 <a href="#" class="css_button cp-positive addFacilities"><span><?php echo xlt('Add');?></span></a>
            </td>
        </tr>
    </table>
    </div>
    <br>
    <div>
        <div>
    <form name='facilitylist' id="active_form" method='post' action='../super/save_edit_settings.php' onsubmit='return top.restoreSession()'><br>
    <input type='checkbox' name='form_inactive' id="inactive_checkbox" onclick="toggleActive()" value='1''/>
    <span class='text'> <?php echo xlt('Include inactive facilities'); ?> </span>
    </form>
    <table class="table table-hover">
    <tr>
        <th><?php echo xlt('Name'); ?></th>
        <th><?php echo xlt('Address'); ?></th>
        <th><?php echo xlt('Phone'); ?></th>
    </tr>
     <?php
        $fres = 0;
        //if ($form_inactive) {
        $fres = sqlStatement("select * from facility order by name");
        // } else {
        //   $fres = sqlStatement("select * from facility WHERE inactive = '0' order by name");
        // }
        if ($fres) {
          $result2 = array();
          for ($iter3 = 0;$frow = sqlFetchArray($fres);$iter3++)
            $result2[$iter3] = $frow;
          foreach($result2 as $iter3) {
            $varstreet="";//these are assigned conditionally below,blank assignment is done so that old values doesn't get propagated to next level.
            $varcity="";
            $varstate="";
          $varstreet = $iter3['street'];
          if ($iter3['street'] != "") $varstreet = $iter3['street'].",";
          if ($iter3['city'] != "")$varcity = $iter3['city'].",";
          if ($iter3['state']!= "")$varstate = $iter3['state'].",";
    ?>
    <tr height="22" <?php if($iter3['inactive'] == 1){ echo 'class="facility_row" hidden'; } ?>>
       <td><b><a href="#" data-text="<?php echo $iter3['id'];?>" class="editFacilities"><span><?php echo htmlspecialchars($iter3['name']);?></span></a></b>&nbsp;</td>
       <td><?php echo htmlspecialchars($varstreet.$varcity.$varstate.$iter3['country_code']." ".$iter3['postal_code']); ?>&nbsp;</td>
       <td><?php echo htmlspecialchars($iter3['phone']);?>&nbsp;</td>
    </tr>
<?php
  }
}
 if (count($result2)<=0)
  {?>
  <tr height="25">
        <td colspan="3"> <?php echo xlt( "Currently there are no facilities." ); ?></td>
    </tr>
  <?php }
?>
    </table>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

  // Toggle inactive facilities
  function toggleActive() {
    // Toggle inactive facilities
    if ($('#inactive_checkbox').prop("checked") == true) {
      $('.facility_row').removeAttr('hidden');
    } else if($('#inactive_checkbox').prop("checked") == false) {
      $('.facility_row').attr('hidden', true);
    } else {
      $('.facility_row').attr('hidden', true);
    }
  }

$(document).ready(function(){

    //iziModal for adding new facilities
    $(".addFacilities").on("click", function (event) {
      event.preventDefault();
      $("#addFacilities-iframe").iziModal('open');
    });

    $("#addFacilities-iframe").iziModal({
      title: 'Add Facility',
      subtitle: 'Enter details about the new facility',
      headerColor: '#88A0B9',
      closeOnEscape: true,
      fullscreen: true,
      overlayClose: false,
      closeButton: true,
      theme: 'light',
      iframe: true,
      width: 700,
      focusInput: true,
      padding: 5,
      iframeHeight: 700,
      iframeURL: "../usergroup/facilities_add.php"
    });

    //iziModal for editing existing facilities
    $(".editFacilities").on("click", function (event) {
      event.preventDefault();
      var dyn_link = parseInt($(this).attr("data-text"));
      initIziLink(dyn_link);

    });

    function initIziLink(link) {
      $("#editFacilities-iframe").iziModal({
        title: 'Edit Facility',
        subtitle: 'Edit details about the facility',
        headerColor: '#88A0B9',
        closeOnEscape: true,
        fullscreen: true,
        overlayClose: false,
        closeButton: true,
        theme: 'light',
        iframe: true,
        width: 700,
        focusInput: true,
        padding: 5,
        iframeHeight: 700,
        iframeURL: "../usergroup/facility_admin.php?fid=" + link,
      });

      setTimeout(function () {
        call_izi();
      }, 100);
    }

    function call_izi() {
      $("#editFacilities-iframe").iziModal('open');
    }

});

<?php
  if ($alertmsg = trim($alertmsg)) {
    echo "alert('$alertmsg');\n";
  }
?>
</script>

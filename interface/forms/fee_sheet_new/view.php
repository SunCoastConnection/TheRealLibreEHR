<?php
require_once("../../globals.php");
require_once("$srcdir/headers.inc.php");
call_required_libraries(['bootstrap-4-0','font-awesome','vuejs']);
require_once 'components/feesheet_window.html';
require_once 'components/quick_pick_component.html';
?>
<title>Feesheet</title>
<style>
    .border-dark {
        border: 2px solid #000 !important;
    }
</style>

<div id="fee_sheet_screen">
    <div class="col-sm-12 bg-light text-center" ref="button_area">
        <button class="btn btn-lg" @click="buttonClicked('duplicate')">Duplicate</button>
        <button class="btn btn-lg" @click="buttonClicked('quick_pick')">Quick Pick</button>
        <button class="btn btn-lg" @click="buttonClicked('search')">Search</button>
        <button class="btn btn-lg" @click="buttonClicked('authorise')">Authorise</button>
        <button class="btn btn-lg" @click="buttonClicked('save')">Save</button>
    </div>


    <div class="col-sm-12 bg-light text-center" ref="control_area">
        <br/>
        <fee-sheet-window name="Duplicate" linked_to_button="duplicate">
        </fee-sheet-window>


        <fee-sheet-window name="Quick Pick" linked_to_button="quick_pick">
            <quick-pick-component></quick-pick-component>
        </fee-sheet-window>



        <fee-sheet-window name="Search" linked_to_button="search">
        </fee-sheet-window>
        <fee-sheet-window name="Authorise" linked_to_button="authorise">
        </fee-sheet-window>
        <fee-sheet-window name="Save" linked_to_button="save">
        </fee-sheet-window>
    </div>
</div>

<script type="text/javascript">
    // all events occuring on feesheet would be conducted through this bus
    const fee_sheet_bus = new Vue({})

</script>
<script type="text/javascript" src="components/feesheet_window.js"></script>
<script type="text/javascript" src="components/quick_pick_component.js"></script>
<script type="text/javascript">
    new Vue({
        el: "#fee_sheet_screen",
        mounted: function() {
            this.$refs.control_area.style.display = 'none'
        },
        data: {
            name: ""
        },
        created: function() {
            const self = this

            fee_sheet_bus.$on("button_clicked", (name)=> {
                this.name = name
                self.$refs.control_area.style.display = 'block'

            })

            fee_sheet_bus.$on("frame_close_clicked", ()=> {
                self.$refs.control_area.style.display = 'none'
            })
        },
        methods: {
            buttonClicked: function(name) {
                fee_sheet_bus.$emit("button_clicked", name)
            }
        }
    })
</script>
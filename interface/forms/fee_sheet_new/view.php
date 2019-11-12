<?php
require_once("../../globals.php");
require_once("$srcdir/headers.inc.php");
call_required_libraries(['bootstrap-4-0','font-awesome','vuejs']);
require_once 'components/feesheet_window.html';
?>
<title>Feesheet</title>
<style>
	.border-dark {
		border: 5px solid #000 !important;
	}
</style>

<div id="fee_sheet_screen">
	<div class="col-sm-12 bg-light text-center" ref="button_area">
		<button class="btn btn-lg" @click="buttonClicked('Duplicate')">Duplicate</button>
		<button class="btn btn-lg" @click="buttonClicked('Quick Pick')">Quick Pick</button>
		<button class="btn btn-lg" @click="buttonClicked('Search')">Search</button>
		<button class="btn btn-lg" @click="buttonClicked('Authorise')">Authorise</button>
		<button class="btn btn-lg" @click="buttonClicked('Save')">Save</button>
	</div>


	<div class="col-sm-12 bg-light text-center" ref="control_area">
		<fee-sheet-window :name="name"></fee-sheet-window>
	</div>
</div>

<script type="text/javascript">
	// all events occuring on feesheet would be conducted through this bus
	const fee_sheet_bus = new Vue({})

</script>
<script type="text/javascript" src="components/feesheet_window.js"></script>
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
				self.$refs.button_area.style.display ='none'
				self.$refs.control_area.style.display = 'block'

			})

			fee_sheet_bus.$on("frame_close_clicked", ()=> {
				self.$refs.button_area.style.display='block'
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
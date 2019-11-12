Vue.component('fee-sheet-window', {
	template: "#feesheet_window_component",
	data: function () {
		return {
			name: ""
		}
	},
	props: {
		name: {
			type:String,
			default: ""
		}
	},
	methods: {
		closeFrame() {
			fee_sheet_bus.$emit('frame_close_clicked')
		}
	}
})
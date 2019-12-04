Vue.component('quick-pick-component', {
	template: "#quick_pick_component_template",
	data: function () {
			return {
				codes:[
					{
						code_type: "CPT4",
						modifiers: "AB CD EF EF",
						description: " some desc",
						code: "12345",
						is_selected: false,
					},

					{
						code_type: "ICD10",
						modifiers: "AB CD EF EF",
						description: " some desc",
						code: "45678",
						is_selected: false,
					},

				],
				selected_codes:[]
			}
	},

	methods: {
		pickCode(index, code) {
			if (!this.selected_codes.includes(code)) {
				this.selected_codes.push(code)
				this.codes[index].is_selected = true
			}
			else {
				
				this.codes[index].is_selected = false
				this.selected_codes.splice(this.selected_codes.indexOf(code),1)
			}
		}
	}
})
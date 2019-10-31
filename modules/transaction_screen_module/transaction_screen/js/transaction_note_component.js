Vue.component('transaction-note-component', {

	template: "#transaction_note_component",

	data:function() {
		return {
			transaction_note: null,
			pid:this.pidProp,
			disable_transaction_note:true
		}
	},

	props: {
		pidProp: {
			type:String,
			default:null
		}
	},

	created() {
		transaction_bus.$on('global-pid-changed', (pid)=> {
			this.pid = pid
			this.getTransactionNote()
		})

		transaction_bus.$on('open-transaction-note-modal', ()=>{
			if (this.pid != null && this.pid != "") {
				$(this.$refs.transaction_note_modal).modal('show')
			}
			else {
				alert("choose a patient before adding notes")
			}
		});
	},


	methods: {

		editTransactionNote() {
			this.disable_transaction_note = false
			$(this.$refs.transaction_note_textarea).focus()
		},

		getTransactionNote() {
			if (this.pid != null) {

				this.$http.get("transaction_screen/ajax/ajax_note_save.php?get_notes=true&pid="+ this.pid)
				.then(response=> {
					
					this.transaction_note = response.body

				}, response=> {
					
				})

			}
		},

		saveTransactionNote() {

			if (this.pid != null) {

				const transactionObject =  {
					pid: this.pid,
					transaction_note: this.transaction_note
				}
				this.$http.post("transaction_screen/ajax/ajax_note_save.php?save_notes=true",
				 transactionObject,
				 {emulateJSON:true})
				.then(response=> {
					$(this.$refs.transaction_note_modal).modal('hide')
				}, response=> {
					
				})

			}
		}


	}


})
Vue.component('fee-sheet-window', {
    template: "#feesheet_window_component",
    created() {
        const self = this
        fee_sheet_bus.$on("button_clicked", (name)=> {

            if (name != self.linked_to_button) {
                // then this window should hide
                self.$refs.total_window.style.display = 'none'
        }
            else {
                self.$refs.total_window.style.display = 'block'
            }
        })
    },
    props: {
        name: {
            type:String,
            default: ""
        },
        linked_to_button: {
            type:String
        }
    },
    methods: {
        closeFrame() {
            fee_sheet_bus.$emit('frame_close_clicked')
        }
    }
})
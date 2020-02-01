Vue.component("quick-pick-component", {
    template: "#quick_pick_component_template",
  mounted() {
    this.getCodes();
  },
    data: function () {
            return {
                codes:[
                    {
          codeType: "CPT4",
                        modifiers: "AB CD EF EF",
                        description: " some desc",
                        code: "12345",
          isSelected: false,
          serviceCategory: "foo"
        }
      ],
      selectedCodes: []
    };
                    },

  methods: {
    extractCodesAndAddServiceCategory(codes, serviceCategory) {
      return codes.map(e => ({
        ...e,
        serviceCategory: serviceCategory,
        isSelected: false,
      }));
                    },

    parseRawResponseToCodes(rawResponse) {
      let codes = [];
      for (item of rawResponse) {
        codes = codes.concat(
          this.extractCodesAndAddServiceCategory(
            item.codes,
            item.serviceCategory
          )
        );
            }

      return codes;
    },

    getCodes() {
      this.$http.get("api/api.get_codes.php").then(response => {
        const rawResponse = response.body;
        const codes = this.parseRawResponseToCodes(rawResponse);
        console.log(codes);
        this.codes = codes;
      });
    },

        pickCode(index, code) {
      console.log(code)
      if (!this.selectedCodes.includes(code)) {
        this.selectedCodes.push(code);
        this.codes[index].isSelected = true;
      } else {
        this.codes[index].isSelected = false;
        this.selectedCodes.splice(this.selectedCodes.indexOf(code), 1);
            }
        }
    }
});

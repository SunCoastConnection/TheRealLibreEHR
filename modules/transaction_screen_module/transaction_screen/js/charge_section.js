// this section object needs to be serialized while posting data
const CHARGE_SECTION_OBJECT = {}

n =  new Date();
y = n.getFullYear();
m = n.getMonth() + 1;
d = n.getDate();

CHARGE_SECTION_OBJECT.units = 0
CHARGE_SECTION_OBJECT.singleUnitFee = 0.00
CHARGE_SECTION_OBJECT.CPT_CODE = ""
CHARGE_SECTION_OBJECT.description = ""
CHARGE_SECTION_OBJECT.Amount = 0.00
CHARGE_SECTION_OBJECT.mod_1 = ""
CHARGE_SECTION_OBJECT.mod_2 = ""
CHARGE_SECTION_OBJECT.modal_date = m + "-" + d + "-" + y;
CHARGE_SECTION_OBJECT.code_type = null

$(document).ready(function() {


    // saving the charges and adding the row
    $(document).on('click', '#charge_section_modal_add_charge', function(event) {
        event.preventDefault();
        charges_post_object = {}

        // creating the post object
        for (key in CHARGE_SECTION_OBJECT) {
            let changedKey = "charges_" + key.toLowerCase()
            charges_post_object[changedKey] = CHARGE_SECTION_OBJECT[key]
        }

        const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
        charges_post_object["charges_pid"] = headerDataStorage.tableHeaderRowPid
        charges_post_object["case_number"] = headerDataStorage.tableHeaderRowCaseNumber
        charges_post_object["charges_encounter"] = headerDataStorage.tableHeaderRowEncounter
        charges_post_object["charges_code_type"] = "CPT4"

        $.post('save_payments.php', charges_post_object, function(data, textStatus, xhr) {
           showDetails(headerDataStorage.tableHeaderRowPid)
           $('#charge_modal').modal('hide');
           // data creation event indicates something was added to the main table
           window.dispatchEvent(DATA_CREATION_EVENT)

        });

    });




    $('#charge_section_date').val(CHARGE_SECTION_OBJECT.modal_date)

    $('#charge_section_date').on('change', function(event) {
        CHARGE_SECTION_OBJECT.modal_date = $('#charge_section_date').val()
    })

    $('#charge_section_add_charge').click(function () {
        makePaymentModal(CHARGE_SECTION_OBJECT)
    });

    $('#charge_section_charge').on("select2:select", function(e) {
       const description = $('#charge_section_charge').select2('data')['0']['description'];
       const singleUnitFee = $('#charge_section_charge').select2('data')['0']['fee'];
       CHARGE_SECTION_OBJECT.code_type = $('#charge_section_charge').select2('data')['0']['code_type'];
       CHARGE_SECTION_OBJECT.singleUnitFee = parseFloat(singleUnitFee)
       CHARGE_SECTION_OBJECT.CPT_CODE = e.target.value;
       CHARGE_SECTION_OBJECT.description = description
       CHARGE_SECTION_OBJECT.Amount = CHARGE_SECTION_OBJECT.units * CHARGE_SECTION_OBJECT.singleUnitFee

       $('#charge_section_description').text(description).change();
       $('#charge_section_amount').text(Number(CHARGE_SECTION_OBJECT.Amount).toFixed(2)).change();

    });

    $('#charge_section_units').on('change', function(event) {
        event.preventDefault();
        CHARGE_SECTION_OBJECT.units = parseFloat($(this).val())
        CHARGE_SECTION_OBJECT.Amount = CHARGE_SECTION_OBJECT.units * CHARGE_SECTION_OBJECT.singleUnitFee
        $('#charge_section_amount').text(Number(CHARGE_SECTION_OBJECT.Amount).toFixed(2))
    });

    $('#charge_section_mod_1, #charge_section_mod_2').on("select2:select", function(e) {
        const id = $(this).attr('id')
        if (id == "charge_section_mod_1") {
            CHARGE_SECTION_OBJECT.mod_1 = e.target.value
        }
        if (id == "charge_section_mod_2") {
            CHARGE_SECTION_OBJECT.mod_2 = e.target.value
        }
    });

    $("#charge_section_charge").select2({
        theme: "classic",
        ajax: {
            url: 'transaction_screen/ajax/ajax_code_search.php',
            data: function (params) {
                var query = {
                    search_term: params.term,
                    code_type: 'CPT4'
                }
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: function (data) {
                var results = [];
                const response = JSON.parse(data)
                $.each(response, function (index, object) {
                    results.push({
                        id: object.code,
                        description: object.code_text,
                        fee: object.fee,
                        text: object.code,
                        code_type: object.code_type
                    });
                });
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: results
                };
            }
        }
    });

    $("#charge_section_mod_1, #charge_section_mod_2").select2({
        theme: "classic",
        ajax: {
            url: 'transaction_screen/ajax/ajax_modifiers.php',
            processResults: function (data) {
                var results = [];
                const response = JSON.parse(data)

                $.each(response, function (index, object) {
                    results.push({
                        id: object.title,
                        text: object.title
                    });
                });
                // Tranforms the top-level key of the response object from 'items' to 'results'
                return {
                    results: results
                };
            }
        }
    });

});

function showPaymentModalFromData(paymentModalHtml) {
    $("#charge_modal .modal-body").html("");
    $("#charge_modal .modal-body").html(paymentModalHtml);
    if (MAIN_TABLE_HEADER_DATA != null) {
        MAIN_TABLE_HEADER_DATA.refresh()
    }
    $('#charge_modal').modal('show');
}

function makePaymentModal(paymentSectionObject) {
    let charge_modal_data = { payment_object: paymentSectionObject}
    $.post('transaction_screen/screens/charge_modal.php', {charge_modal_data: charge_modal_data}, function(data, textStatus, xhr) {
        showPaymentModalFromData(data)
    });
}


$('#clear_charges').click(function(event) {

    $('#charge_section_description').text("");
    $('#charge_section_amount').text("");
    $("#charge_section_mod_1, #charge_section_mod_2, #charge_section_charge").val('').trigger('change');
     $('#charge_section_units, #charge_section_date').val("");

});
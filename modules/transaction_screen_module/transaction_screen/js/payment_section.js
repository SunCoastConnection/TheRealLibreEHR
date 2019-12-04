// payment_type in the payment section, enumeration used to compare in this section
const PaymentSectionType = {
    PRIMARY_PAYMENT:0,
    SECONDARY_PAYMENT:1,
    TERTIARY_PAYMENT:2,
    PATIENT_PAYMENT:3
}

    function resetPaymentForm() {
        $('#payment_amount, #payment_acct_ref, #payment_method').val("")
        $('input[name="payment_type"]').prop('checked', false);
    }

    $('#clear_payment').click(function(event) {
        resetPaymentForm();
    });



    // This functions get the values from the payment section and fills the modal
    function showConfirmPayment() {

        $('#modal_date').html(getCurrentDate());
        const paymentObject = createPaymentObject()
        for (var key in paymentObject) {
            $('#modal_'+key).html(paymentObject[key])
        }

        if (checkIfDefinedAndNotNull(paymentObject, "please choose a row to create payment")) {
            $('#payment-modal').modal('show');
        }
    }

    function checkIfDefinedAndNotNull(variable, message, showAlertFlag=true) {

        if (typeof variable !== 'undefined' && variable != null) {
            return true
        }
        else {
            if(showAlertFlag) {
                showDangerAlert(message)
            }
            return false
        }
    }



    function createPaymentObject() {
        if (checkIfDefinedAndNotNull(MAIN_TABLE_HEADER_DATA, "please choose a row to create payement", false)) {

            const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
            payment_object = {}
            payment_object["case"] = headerDataStorage.tableHeaderRowCaseNumber
            payment_object["description"] = headerDataStorage.tableHeaderRowCaseDescription
            payment_object["service_date"] = headerDataStorage.tableHeaderRowDate
            payment_object["facility"] = headerDataStorage.tableHeaderRowFacility
            payment_object["pid"] = headerDataStorage.tableHeaderRowPid
            payment_object["encounter"] = headerDataStorage.tableHeaderRowEncounter

            const paymentHelperDataStorage = NFORM_PAYMENT_HELPER.getDataStorage()

            for (var key in paymentHelperDataStorage) {
                let custom_key = key.replace("#payment_", "")
                payment_object[custom_key] = paymentHelperDataStorage[key]
            }
            payment_object["type"] = $('input[name=payment_type]:checked').val()
            return payment_object
        }
    }



    $('#save_payment_button').click(function() {

            // the payment object holds data with payment section
            SERVICE_MODAL_OBJECT.paymentObject = createPaymentObject()

            if ($('#payment_patient').is(':checked')) {
                showConfirmPayment();
            }
            else {
                if($('#payment_primary').is(':checked')) {

                    showServiceDetails(MAIN_TABLE_HEADER_DATA.clickedHeaderRowNumber, ServiceModalPaymentType.PRIMARY_PAID,
                        ServiceModalTriggeringLocation.PAYMENT_MODAL);
                }
                if($('#payment_secondary').is(':checked')) {

                    showServiceDetails(MAIN_TABLE_HEADER_DATA.clickedHeaderRowNumber, ServiceModalPaymentType.SECONDARY_PAID,
                        ServiceModalTriggeringLocation.PAYMENT_MODAL);
                }
                if($('#payment_tertiary').is(':checked')) {

                    showServiceDetails(MAIN_TABLE_HEADER_DATA.clickedHeaderRowNumber, ServiceModalPaymentType.TERTIARY_PAID,
                        ServiceModalTriggeringLocation.PAYMENT_MODAL);
                }

            }
    });



// this function is used to save patient payment
function savePatientPayment() {
    const paymentObject = createPaymentObject()
    const postPaymentObject = {}
    for (var key in paymentObject) {
        postPaymentObject["payment_"+key] = paymentObject[key]
    }
    console.log(postPaymentObject)
    // add a custom key to support it on backend, payment_primary, payment_secondary
    // payment_tertiary, payment_patient is added in the backend
    postPaymentObject[$("input[name='payment_type']:checked").attr("id")] = $("input[name='payment_type']:checked").val()

    $.post('save_payments.php', postPaymentObject, function(data, textStatus, xhr) {
        console.log(data)
        $('#payment-modal').modal('hide')
        showSuccessAlert(postPaymentObject["payment_type"] + " has been added");
        // make the payment, send the change event (used for refreshing audit transactions)
        window.dispatchEvent(DATA_CREATION_EVENT)
        resetPaymentForm();
    });
}

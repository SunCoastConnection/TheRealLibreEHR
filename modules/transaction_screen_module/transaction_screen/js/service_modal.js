// if primary and secondary fields change then the balance should
// be updated accordingly

function replaceNaNWithZero(number) {
    if (isNaN(number)) {
        return 0
    }
    else {
        return number
    }
}

// listen for service modal opening
window.addEventListener("SERVICE_MODAL_OPENED", function() {
    var unapplied_amount = 0.00
    $('#service_modal').find('td.service-modal-patient-payment-amount').each(function() {

        let unapplied = parseFloat($(this).data('unapplied'))
        if (unapplied === 1) {
            if (!isNaN(parseFloat($(this).text()))) {
                unapplied_amount += parseFloat($(this).text())
            }
        }

    });
    $('#service-modal-unapplied').text(unapplied_amount.toFixed(2))
    setStateForCloseVisitButton();

})

function setStateForCloseVisitButton() {
    // if not be able to close the visit, disable the button
    if(canCloseVisitByApplyingPayment()) {
        $('#service_modal_close_visit').attr('disabled', false)
    }
    else {
        $('#service_modal_close_visit').attr('disabled', true)
    }
}


function updateTotalBalanceBasedOnInputChangeEvent(selectedElement) {
    let balance = 0

    selectedElement.closest('table').find('td.service-modal-balance').each(function () {
        balance += parseFloat($(this).text())
    });

    // update the balance section
    $('#service-modal-header-balance').text(Number(balance).toFixed(2))
    var real_balance = balance - parseFloat($('#service-modal-unapplied').text())
    $('#service-modal-header-real-balance').text(Math.abs(Number(real_balance).toFixed(2)))
}

jQuery.fn.exists = function(){ return this.length > 0; }

function getAllClassList(element) {
    return $(element).find('.service-modal-data-storage').attr('class').split(' ');
}

function calculateServiceModalChargeRowBalance(element) {
    // check if balance row exists, or else dont check patient payment rows
    if ($(element).closest('tr').find('.service-modal-balance').exists()){

        let primaryPayment = $(element).closest('tr').find('.service-modal-primary-payment').val()
        primaryPayment  = replaceNaNWithZero(parseFloat(primaryPayment))

        let secondaryPayment = $(element).closest('tr').find('.service-modal-secondary-payment').val()
        secondaryPayment = replaceNaNWithZero(parseFloat(secondaryPayment))

        let tertiaryPayment = $(element).closest('tr').find('.service-modal-tertiary-payment').val()
        tertiaryPayment = replaceNaNWithZero(parseFloat(tertiaryPayment))

        let adjustmentAmount = $(element).closest('tr').find('.service-modal-adjustment').val()
        adjustmentAmount = replaceNaNWithZero(parseFloat(adjustmentAmount))

        let amount = $(element).closest('tr').find('.service-modal-amount').text()
        amount = replaceNaNWithZero(parseFloat(amount))

        let balance = amount - (primaryPayment + secondaryPayment + adjustmentAmount + tertiaryPayment)
        formatted_balance = Number(balance).toFixed(2)
        return formatted_balance
    }
    else {
        let adjustmentAmount = $(element).closest('tr').find('.service-modal-adjustment > input').val()
        adjustmentAmount = replaceNaNWithZero(parseFloat(adjustmentAmount))
        return -Number(adjustmentAmount).toFixed(2)
    }
}

$(document).on('input', '.service-modal-primary-payment, .service-modal-secondary-payment, .service-modal-tertiary-payment, .service-modal-adjustment',function(){

        let className = $(this).closest('tr').find('.service-modal-data-storage').data('classname')
        //console.log($(this).closest('tr').find('.service-modal-data-storage'))
        let balanceTotal = 0

        $('.'+ className).each(function(index, el) {
            balanceTotal += parseFloat(calculateServiceModalChargeRowBalance(el.closest('tr')))
        });

        let id = className.replace("-elements", "")

        $('#'+id).closest("tr").find('.service-modal-balance').text(Number(balanceTotal).toFixed(2))

        // this updates modal header balance
        updateTotalBalanceBasedOnInputChangeEvent($(this));

        // this sets the state for the close visit button
        setStateForCloseVisitButton()

});

$(document).on('click', '.service-modal-patient-payment-checkbox', function(event) {
    event.preventDefault();
    SERVICE_MODAL_PATIENT_PAYMENT_CHECKBOX_CLICKED_ROW = $(this).closest('tr')
    $('#service_modal').modal('hide');
    let td = $(this).closest('td');
    let pid = td.data('pid');
    let encounter = td.data('encounter')
    let sequence_no = td.data('sequenceNo')
    reversePaymentOnCheckboxClick(encounter, pid, sequence_no);
});

function copyNodeText(source, destination, identifier) {
    let sourceValue = source.find(identifier).html()
    destination.find(identifier).html(sourceValue)
}

function copyNodeData(source, destination, identifier, attributeName) {
    let sourceValue = source.find(identifier).data(attributeName)
    destination.find(identifier).data(attributeName, sourceValue)
}

function copyEssentialAttributesToAdditionalAdjustmentRow(clickedRow, clonedRow) {
    // copy the needed attributes
    copyNodeText(clickedRow, clonedRow, '.service-modal-adjustment-add-column')
    copyNodeText(clickedRow, clonedRow, '.service-modal-adjustment')
    copyNodeText(clickedRow, clonedRow, '.service-modal-adjustment-reason')
}

$(document).on('click', '.service-modal-adjustment-add', function(event) {
    let clickedRow = $(this).closest('tr')
    let clonedRow = clickedRow.clone();

    // remove all the id and html from table
    clonedRow.find('*').removeAttr("id")
    clonedRow.find('td').html('');

    copyEssentialAttributesToAdditionalAdjustmentRow(clickedRow, clonedRow);

    // set up child column description
    clonedRow.closest('tr').addClass('bg-light')
    clonedRow.find('.service-modal-description').text('Additional Adjustment')

    // remove balance column from child row, the parent and child should sum to get a balance
    clonedRow.find('td.service-modal-balance').removeClass('service-modal-balance')

    copyNodeData(clickedRow, clonedRow, ".service-modal-data-storage", "className")
    clonedRow.insertAfter(clickedRow)
});

function updatePatientPaymentRowOnServiceModal() {
    // usually when patient payment is  made the balance is negative of what is reversed
    let clickedRowClone = SERVICE_MODAL_PATIENT_PAYMENT_CHECKBOX_CLICKED_ROW.clone();
    let amount = clickedRowClone.find(".service-modal-amount").text()

    amount = parseFloat(amount)
    amount = -amount

    clickedRowClone.find(".service-modal-amount").text(Number(amount).toFixed(2))
    clickedRowClone.insertAfter(SERVICE_MODAL_PATIENT_PAYMENT_CHECKBOX_CLICKED_ROW)
    $('#service_modal').modal('show')
}


// function to convert table header keys to postable form
function prepareCustomServiceModalSerializationKey(string) {

    return string.toLowerCase().replace(" ", "_")

}

// extractable keys indicates what fields should be extracted from
// the service modal, the extractable keys should match the table headers
// since the entire table is iterated against <th> tag, extractable keys
// should be same as th tag
function getSerializedServiceModalRowData(extractableKeys) {
    var serviceModalTableRows = { serviceModalTableRows: [] };
    const rowObject = {}
    var $th = $('#service-modal-row-table th');

    $('#service-modal-row-table tbody tr').each(function(i, tr){
        var obj = {}, $tds = $(tr).find('td');
        $th.each(function(index, th){
            const value = $tds.eq(index).find('input').val()
            const text = $tds.eq(index).text();

            // the table has both input fields and text content
            // so check which is not null, prefer the input field
            var key_value = text
            if (value !== 'undefined' && value != null) {
                key_value = value
            }
            const custom_key = prepareCustomServiceModalSerializationKey($(th).text())

            if (custom_key == "adjustment_reason") {
                key_value = $tds.eq(index).find('select option:selected').val()
            }

            if (extractableKeys.includes(custom_key)) {
                obj[custom_key] = key_value
            }


        });
        serviceModalTableRows.serviceModalTableRows.push(obj);
    });

    return serviceModalTableRows
}

// if the patient paid == balance then it should return true, since it can be applied
function canCloseVisitByApplyingPayment() {
    let unapplied = parseFloat($('#service-modal-unapplied').text())
    let balance = parseFloat($('#service-modal-header-real-balance').text())
    if (unapplied === balance) {
        return true
    }
    else {
        return false
    }
}

function getServiceModalBalance() {
    return parseFloat($('#service-modal-header-real-balance').text())
}


function getServiceModalUnapplied() {
    return parseFloat($('#service-modal-unapplied').text())
}

// this method changes all the adjustment item and put it in the top row
// if additonal adjustment are made then it needed to be added to main row array
// it needed to be added to adjustment_item field in the main row,
// the child rows get removed and at the end we get all the parent rows with
// adjustment items added to it in the adjustment_item array field
function formatTableDataSuitableForPost(tableDataRows) {

    let skippableCategories = ["Secondary Insurance Payment", "Primary Insurance Payment", "Tertiary Insurance Payment"]

    let index = 0
    // this variable holds all the changed rows
    let newTableDataRows = []

    let previousIndex = 0

    tableDataRows.forEach( function(row, i) {

        if (row.description === "Additional Adjustment") {
            newTableDataRows[previousIndex].adjustment_reason.push(row.adjustment_reason)
            newTableDataRows[previousIndex].adjustment_item.push(row.adjustment_item)
        }
        else if(!skippableCategories.includes(row.description)) {
            previousIndex = index
            const main_row_adjustment_value = row.adjustment_item
            row.adjustment_item = [main_row_adjustment_value]
            row.adjustment_reason = [row.adjustment_reason]
            newTableDataRows[index] = row
            index +=  1
        }
    });
    return newTableDataRows
}

// close visit by posting the data
function closeVisitPostMethod() {

    close_visit_post_object = {}
    const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
    close_visit_post_object["close_visit_encounter"] = headerDataStorage.tableHeaderRowEncounter
    close_visit_post_object["close_visit_balance_fee"] = getServiceModalBalance()
    close_visit_post_object["close_visit_unapplied_fee"] = getServiceModalUnapplied()
    $.post('save_payments.php', close_visit_post_object, function(data, textStatus, xhr) {
        $('#confirmation-modal').modal('hide')
        $('#service_modal').modal('hide')
        window.dispatchEvent(DATA_CREATION_EVENT)
    });

}

$('#service_modal_close_visit').click(function(event) {
    closeVisit();
});

function closeVisit() {

        if(canCloseVisitByApplyingPayment()) {
            $('#cv_remaining_balance').text(Number(getServiceModalBalance()).toFixed(2))
            $('#cv_patient_payment').text(Number(getServiceModalUnapplied()).toFixed(2))
            $('#confirmation-modal').modal('show')
        }
    }


function saveServiceModal() {


        //triggered from payment section? different process of saving

        const keysToBeExtracted = ["mod_1", "mod_2", "mod_3", "mod_4", "adjustment_item", "description", "billing_id", "adjustment_reason"]
        keysToBeExtracted.push(ServiceModalPaymentTypeText[SERVICE_MODAL_OBJECT.paymentType])
        const tableData = getSerializedServiceModalRowData(keysToBeExtracted)
        SERVICE_MODAL_OBJECT.tableObject = formatTableDataSuitableForPost(tableData.serviceModalTableRows)

        $.post('save_payments.php', SERVICE_MODAL_OBJECT, function(data, textStatus, xhr) {
            if (data !=null && data.result != null && data.result.error_message != null) {
                showDangerAlert(data.result.error_message)
            }
            else {
                // means success on payment, clear payment section
                resetPaymentForm();
            }
            $('#service_modal').modal('hide')
            window.dispatchEvent(DATA_CREATION_EVENT)
        });

}


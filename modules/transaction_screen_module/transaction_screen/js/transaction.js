// this function gets data and updates the tabs
// everything we need is present inside a single column data attribute

// set detail rows visibility
function setDetailRowsVisibility(canShowDetailRow=true) {
    var visibility = 1
    if (!canShowDetailRow) {
        visibility = '0.5'
    }

    $('.detail_row').each(function() {
        $(this).css({ opacity: visibility });
    });
}


function changeExpandIcon(element, clickedHeaderRowNumber) {
    let expandButtonText = $(element).text().replace(" ", "")

    if (expandButtonText == "+") {
        $(element).text("-")
         setDetailRowsVisibility(false)
         // make selected row only visible
        $("#header-row-identifier-"+clickedHeaderRowNumber).css({ opacity: 1 })

    }
    else {
        $(element).text("+")
        setDetailRowsVisibility(true)
    }
}





function getTabsInfo(element, clickedHeaderRowNumber, pid=null, case_number=null, encounter=null) {

    const num = clickedHeaderRowNumber

    changeExpandIcon(element, clickedHeaderRowNumber)

    const isClosed = $(element).text().replace(" ", "") === "+"


    let headerObject = $('#table-header-row-data-'+clickedHeaderRowNumber).data()
    // find the child row data storage
    // intention: to find the first billing id of that row
    headerObject.tableHeaderRowBillingId = $(element).closest('tr').next('tr').find('td.td-data-storage-row-'+headerObject.tableHeaderChildRowCount).data('billingId')

    headerObject.clickedHeaderRowNumber = clickedHeaderRowNumber
    MAIN_TABLE_HEADER_DATA = new NFormOneWayBindingDataStorage(headerObject, ".")

    MAIN_TABLE_HEADER_DATA.transformKey  = function (key) {
        let newKey = key.toLowerCase().replace("tableheaderrow", "")
        newKey = "observe_header_"+ newKey.toLowerCase()
        return newKey
    }

    MAIN_TABLE_HEADER_DATA.initialise()

    // make the clicked row number as a property so it is used by payment modal
    MAIN_TABLE_HEADER_DATA.clickedHeaderRowNumber = clickedHeaderRowNumber

    getSummaryObject(pid,encounter)
    // update audit trial on encounter click
    const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()

    if (isClosed) {
        // since closed we need to get the whole overview data
        transaction_bus.$emit('overview-object-fetch-from-api', GLOBAL_PID)
    }
    else {
        transaction_bus.$emit('overview-object-fetch-from-api', pid, encounter)
    }
    updateAuditTrial(headerDataStorage.tableHeaderRowPid, headerDataStorage.tableHeaderRowEncounter)


}

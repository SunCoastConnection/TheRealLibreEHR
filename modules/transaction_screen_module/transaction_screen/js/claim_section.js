// controls all claim section


$('#submit_claim_button').click(function() {

    showClaim();
    console.log(createClaimObject())
});




// This functions get the values from the claim section and fills the claim modal
function showClaim() {
	const claim_object = createClaimObject()
	for (var key in claim_object) {
		$('#claim_modal_'+ key).html(claim_object[key])
	}
    $('#claim_modal_date').html(getCurrentDate());
    $('#claim-modal').modal('show');
}


function createClaimObject() {
	const claim_object = {}	    	
	const headerDataStorage = MAIN_TABLE_HEADER_DATA.getData()
	claim_object["case"] = headerDataStorage.tableHeaderRowCaseNumber
	claim_object["description"] = headerDataStorage.tableHeaderRowCaseDescription
	claim_object["service_date"] = headerDataStorage.tableHeaderRowDate
	claim_object["facility"] = headerDataStorage.tableHeaderRowFacility
	claim_object["pid"] = headerDataStorage.tableHeaderRowPid
	claim_object["encounter"] = headerDataStorage.tableHeaderRowEncounter
	claim_object["billing_id"] = headerDataStorage.tableHeaderRowBillingId
	
	const claim_data = NFORM_CLAIM_HELPER.getCurrentUiValues()
	for (var key in claim_data) {
		const custom_key = key.replace("#","").replace("claim_", "")
		claim_object[custom_key] = claim_data[key] 
	}
	claim_object["claim_type"] = $("input[name=claim_type]:checked").val()
	return claim_object

}

// save claim
function saveClaim() {
	const claim_object = createClaimObject()
	const post_claim_object = {}
	for (var key in claim_object) {
		const custom_key = "claim_" + key
		post_claim_object[custom_key] = claim_object[key] 
	}

    $.post('save_payments.php', post_claim_object, function(data, textStatus, xhr) {
        console.log(data)
    	$('#claim-modal').modal('hide')
        showSuccessAlert("claim has been filed");
        // send creation event
        window.dispatchEvent(DATA_CREATION_EVENT)           
    });
 
}

<?php
require_once(__DIR__.DIRECTORY_SEPARATOR."../../../../interface/globals.php");
require_once("$srcdir/formatting.inc.php");
require_once("$srcdir/sql.inc");
require_once("../classes/class.TemplateLoader.php");
require_once("../classes/class.ServiceModalDataManager.php");
require_once("../classes/class.ServiceModalRowDataManager.php");
//ServiceRowDataModelManager

// output all rows based on datastructure
if (isset($_REQUEST)) {
    if (!empty($_REQUEST)) {
        $rowData = "";
        $rowElementsData = $_REQUEST['rowData']['rowElements'];

        // row id is to introduce uniquness in the service modal
        $row_id = 0;
        $query = "SELECT option_id, title FROM `list_options` WHERE list_id='adjreason'";
        $result = sqlStatement($query, array());
        $option_text = "";

        while ($row = sqlFetchArray($result)) {
            $value = $row['option_id'];
            $title = $row['title'];
            $option_text .= "<option value='$value'>$title</option>";
        }

        foreach ($rowElementsData as $key) {
            $key['ServiceModalTriggeringLocation'] = $_REQUEST['rowData']['ServiceModalTriggeringLocation'];

            $key['ServiceModalPaymentType'] = $_REQUEST['rowData']['ServiceModalPaymentType'];
            $key['adjustment_reason_option_text'] = $option_text;
            $key['row_id'] = $row_id;
            $serviceModalRowDataManager = new ServiceModalRowDataManager($key);

            $rowTemplate = new TemplateLoader($serviceModalRowDataManager);
            $rowData .= $rowTemplate->getOutput();
            $row_id++;
        }

        $payment_type = $_REQUEST['rowData']['ServiceModalPaymentType'];
        $headerData = $_REQUEST['rowData']['modalHeaderData'];
        $caseNumber = $headerData['tableHeaderRowCaseNumber'];
        $description = $headerData['tableHeaderRowCaseDescription'];
        $facility = $headerData['tableHeaderRowFacility'];
        $clinician = $headerData['tableHeaderRowTherapistName'];
        $charges = $headerData['tableHeaderRowCharges'];
        $balance = $headerData['tableHeaderRowBalance'];

        $real_balance = $headerData['tableHeaderRowRealBalance'];

        $templateDataManagerInstance = new ServiceModalDataManager($caseNumber, $description, $facility, $clinician, $charges, $balance, $rowData, $payment_type, $real_balance);
        $templateLoader = new TemplateLoader($templateDataManagerInstance);

        echo $templateLoader->getOutput();
        //echo $rowData;
    }
}

?>

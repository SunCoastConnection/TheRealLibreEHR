<?php
/*  Facility Based Access Control functions.
*   @author Art@suncoastconnection.com
*   @package TheRealLibreEHR
*/


//First make sure this is on in case anyone calls it without checking
if ( $GLOBALS['facility_acl']==1 ) {
///////////////////////////////////////////////////////////////////////////////
////get_facilities_to_show is central function used by the others////////
function get_facilities_to_show( $username )
{
    // User facility is stored in users_facility table as facility_id
    $sql = "SELECT UF.facility_id, U.facility_id AS default_facility
        FROM users U
        JOIN users_facility UF
        ON UF.table_id = U.id
        WHERE
            U.username = ? AND
            UF.tablename = ?";
    $result = sqlStatement( $sql, array( $username, 'users') );
    $facilitiesToShow = array();
    $found = false;
    while ( $row = sqlFetchArray( $result ) ) {
        if ( $found === false ) {
            $facilitiesToShow[]= $row['default_facility'];
            $found = true;
        }
        $facilitiesToShow[]= $row['facility_id'];
    }

    return $facilitiesToShow;
}

///////////////////dynamic_finder_ajax.php line 60//////////////////////////////
function filter_patient_select( $username )
{
    $facilitiesToShow = get_facilities_to_show( $username );
    // Facility is id in patient_data
    $where = " patient_data.facility = '-1' ";
    if ( count( $facilitiesToShow ) ) {
        $facilityString = implode( ",", $facilitiesToShow );
        $where = " patient_data.facility IN ( $facilityString ) ";
    }

    return $where;
}

///////////////////////get_provider_events.php line 28//////////////////////////////////
function filter_patient_facility_calendar( $username )
{
    $facilitiesToShow = get_facilities_to_show( $username );
    $where = " pd.facility = '-1' ";
    if ( count( $facilitiesToShow ) ) {
        $facilityString = implode(",", $facilitiesToShow);
        $where = " pd.facility IN ( $facilityString ) ";
    }

    return $where;
}

/*  demographics_check_auth used in
encounters.php line 67
demographics.php line 516
*/
function demographics_check_auth( $args )
{
    $pid = $args['pid'];
    $sql = "SELECT * FROM patient_data WHERE pid = ? LIMIT 1";
    $row = sqlQuery( $sql, array( $pid ) );
    $username = $args['username'];
    $facilitiesToShow = get_facilities_to_show( $username );
    $found = false;
    foreach ( $facilitiesToShow as $fid ) {
        if ( $fid == $row['facility'] ) {
            $found = true;
            break;
        }
    }

    if ( !$found ) {
        die(xl('Accessing this patient\'s demographics is not authorized.'));
    }
}



//////////////////////////////////////////////////////////////////////
}
else {
    error_log("facacl.inc.php was called but GLOBAL 'facility_acl' = false");  }
?>

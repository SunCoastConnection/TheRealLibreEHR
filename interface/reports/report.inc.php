<?php
// +-----------------------------------------------------------------------------+
//
// Common php functions are stored in this page.
//
// Copyright (C) 2011 Z&H Consultancy Services Private Limited <sam@zhservices.com>
//
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
//
// A copy of the GNU General Public License is included along with this program:
// libreehr/interface/login/GnuGPL.html
// For more information write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// Author:   Eldho Chacko <eldho@zhservices.com>
//           Paul Simon K <paul@zhservices.com>
//
// +------------------------------------------------------------------------------+

function stripslashes_deep($value)
{
    $value = is_array($value) ? array_map('stripslashes_deep', $value) : strip_escape_custom($value);
    return $value;
}

//Parses the search value part of the criteria and prepares for sql.
function PrepareSearchItem($SearchItem)
 {
  $SplitArray=explode(' like ',$SearchItem);
  if(isset($SplitArray[1]))
   {
    $SplitArray[1] = substr($SplitArray[1], 0, -1);
    $SplitArray[1] = substr($SplitArray[1], 1);
    $SearchItem=$SplitArray[0].' like '."'".add_escape_custom($SplitArray[1])."'";
   }
  else
   {
      $SplitArray=explode(' = ',$SearchItem);
      if(isset($SplitArray[1]))
       {
        $SplitArray[1] = substr($SplitArray[1], 0, -1);
        $SplitArray[1] = substr($SplitArray[1], 1);
        $SearchItem=$SplitArray[0].' = '."'".add_escape_custom($SplitArray[1])."'";
       }
   }
  return($SearchItem);
 }

//Parses the database value and prepares for display.
function BuildArrayForReport($Query)
 {
  $array_data=array();
  $res = sqlStatement($Query);
  while($row=sqlFetchArray($res))
   {
    $array_data[$row['id']]=htmlspecialchars($row['name'],ENT_QUOTES);
   }
  return $array_data;
 }

 function AccountTypeDisplay() {


    echo '<table class="table table-responsive" id="account_type_element">

        <tr>
          <td>
            <div class="form-group">
              <select v-model="selected_account_types" multiple id="selected_account_type_selection_box" v-select2>
                  <template v-for="item in account_type_data">
                      <option :value="item">{{ item.title }}</option>
                  </template>
              </select>
            </div>
          </td>
        </tr>
    </table>';

 }

//The criteria  "Insurance Company" is coded here.The ajax one
function InsuranceCompanyDisplay()
 {
  global $ThisPageSearchCriteriaDisplay,$ThisPageSearchCriteriaKey,$ThisPageSearchCriteriaIndex,$web_root;

    // below is a vue template, the handler code is in billing_report.php
    // it is rendered based on that code

    echo '<table class="table table-responsive" id="insurance_company_chooser">

        <tr>
          <td>
            <div class="form-group">
              <select v-model="selected_insurance_companies" multiple id="insurance_companies_selection_box" v-select2>
                  <template v-for="item in insurance_companies_data">
                      <option :value="item">{{ item.name }}</option>
                  </template>
              </select>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <small><input type="checkbox" v-model="is_companies_excluded"> Exclude these companies</small>
          </td>
        </tr>

    </table>';

 }



 function FacilityDisplay() {

    echo '<table class="table table-responsive" id="facility_chooser">

        <tr>
          <td>
            <div class="form-group">
              <select v-model="selected_facilities" multiple id="facility_selection_box" v-select2>
                  <template v-for="item in facility_data">
                      <option :value="item">{{ item.name }}</option>
                  </template>
              </select>
            </div>
          </td>
        </tr>
    </table>';
 }

function ClaimDisplay() {

    echo '<table class="table table-responsive" id="claim_chooser">

        <tr>
          <td>
            <div class="form-group">
              <template v-for="item in claim_data">
                <input type="radio" :value="item" v-model="selected_claim_type"> {{ item }}<br/>
              </template>
            </div>
          </td>
        </tr>
    </table>';

 }
?>

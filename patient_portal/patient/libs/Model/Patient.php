<?php
/** @package    Libre EHR::Model */

/**
 *
 * Copyright (C) 2016-2017 Jerry Padgett <sjpadgett@gmail.com>
 *
 * LICENSE: This Source Code Form is subject to the terms of the Mozilla Public License, v. 2.0
 * See the Mozilla Public License for more details.
 * If a copy of the MPL was not distributed with this file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @package Libre EHR
 * @author Jerry Padgett <sjpadgett@gmail.com>
 * @link http://LibreEHR.org
 */

/** import supporting libraries */
require_once("DAO/PatientDAO.php");
require_once("PatientCriteria.php");

/**
 * The Patient class extends PatientDAO which provides the access
 * to the datastore.
 *
 * @package Libre EHR::Model
 * @author ClassBuilder
 * @version 1.0
 */
class Patient extends PatientDAO
{
    public $Note;
    /**
     * Override default validation
     * @see Phreezable::Validate()
     */
    public function Validate()
    {
        // example of custom validation
        // $this->ResetValidationErrors();
        // $errors = $this->GetValidationErrors();
        // if ($error == true) $this->AddValidationError('FieldName', 'Error Information');
        // return !$this->HasValidationErrors();

        return parent::Validate();
    }

    /**
     * @see Phreezable::OnSave()
     */
    public function OnSave($insert)
    {
        // the controller create/update methods validate before saving.  this will be a
        // redundant validation check, however it will ensure data integrity at the model
        // level based on validation rules.  comment this line out if this is not desired
        if (!$this->Validate()) {
            throw new Exception('Unable to Save Patient: ' .  implode(', ', $this->GetValidationErrors()));
        }

        // OnSave must return true or Phreeze will cancel the save operation
        return true;
    }

}

?>

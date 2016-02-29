<?php
// Copyright (C) 2011 Ken Chapple <ken@mi-squared.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
class PQRS_always_met_Numerator2 implements PQRSFilterIF
{
    public function getTitle()
    {
        return "Numerator 2";
    }

    public function test( PQRSPatient $patient, $beginDate, $endDate )
    {
        return true;
    }
}

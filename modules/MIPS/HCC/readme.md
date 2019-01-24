HCC Service extension written using the PHP-CPP library and MariaDB Connector/C mariadb++.
Copyright 2019 SunCoast Connection Inc. Art Eaton.

This directory contains this compiled extension, and eventually the cpp and header files (and makefile)
 used to create it as well as the sample php.ini extension file sample tested to work on our current server.
This version is not for deployment to production (yet).


Functions:
HCC_test(arg0)  arg0 is a string you want it to return.  No argument returns "Howdy!"
HCC_get_available_versions() returns array of strings with available versions.
HCC_set_version(arg0) arg0 must === "V22" at the moment to work.  Returns true if it can update.  
HCC_get_current_version() returns version string (V22 at the moment).

HCC_run_measures(arg0)  <update=true:false>
HCC_run_patient(arg0)   <with update since latest issue date vs.DOS =true:false>
HCC_run_hierarchy(arg0)  <current_patient only=true:false>  -Seems broken at the moment.
HCC_show_RAF(pid) calculates and returns RAF score
HCC_get_RAF_status(pid) Returns 0 if patient has no current HCC lines in arrays copied from `lists` tables, 1 if has items, but status not indicating hierarchy checked, 2 if items and properly calculated total.
HCC_provider_counts(begdate,enddate*optional default NOW) returns array rows NPI,average RAF, total encounters.  Eventually this will be quite different.
HCC_provider_list_patients(NPI,begdate*,enddate*) Returns array of PID's and the RAF score *for that time period only*  Argument 0 required (npi) and Default argument 1 and 2 are year-to-date.

TODO:
  HCC_show_reports() -to bring up a list of dates and parameters and ID's of HCC_run_measures() output.
  HCC_set_report() -to set or load all data to a specific version of the data sets.
  HCC_magic() -to do all standard tasks sequentially, store the results.
  HCC_show_magic() -returns a full data set of reports and offers a download of csv's

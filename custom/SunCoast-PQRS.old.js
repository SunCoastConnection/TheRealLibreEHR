/*PQRS - XML file writer to be used to spit out the final XML file for PQRS submittal
* 
* currently uses/plans to use Node module jsonfile Copyright (c) 2012-2015, JP Richardson <jprichardson@gmail.com> MIT license attached
* currently uses Node module xml-writer Copyright 2011 Nicolas Thouvenin <nthouvenin@gmail.com> MIT license attached
*
* @author DPRoberts
* write to xml for pqrs in NodeJS
* nvm use 5.0
* learn to use nvm moron (me not you)
*
* *variables to write into XML Defined Below
	/*my kluuuge is modification of xml-writer.js with a PQRS specific loop variable
	* hopefully that file is included here
	 * stuffed in which is specific to the PQRS data but takes it from the loop function from the var
	 * list defined here.
	 * 
	 * Conceptually this should read in a CSV file and pull all of the var from positions in that file...
*/
	
	var ReportCreationDate = 12;
	var ReportCreationTime =12;
	var ReportCreationRegistry = "lou";
	var FileAuditDataVersion = 1;
	var FileNumber =1;
	var NumberOfFiles =1 ;
	var RegistryName = "lou";
	var RegistryId = 1;
	var SubmissionType = 1 ; // one or two or A?
	var SubmissionMethod = 1;
	var numberOmeasures = 2;// this should really be dynamically read
	var MeasureDataArray = ['A',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,'B',22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,'C',41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60];
	var loopcount = 3; // this is number of measures reported
	var bob;
	

/* variables to write into XML Defined Above*/

	var XMLWriter = require('xml-writer'),
               fs = require('fs');
	var ws = fs.createWriteStream('PQRS.xml');
	ws.on('close', function() {
			console.log(fs.readFileSync('PQRS.xml', 'UTF-8'));
	});
	xw = new XMLWriter(true, function(string, encoding) {
			ws.write(string, encoding);

	});
	
	// ------Below is the document to XML code from REWRITTEN xml-writer.js
   
   	xw.startDocument('1.0', 'UTF-8')
   	.startElement('submission')
    	.writeAttribute('type','PQRS-REGISTRY')
    	.endAttribute('type')
    	.writeAttribute('version','7.0')
    	.endAttribute('version')
   	.startElement('file-audit-data')
   	.writeElement('create-date', ReportCreationDate)
   	.writeElement('create-time', ReportCreationTime)
   	.writeElement('create-by',ReportCreationRegistry)
   	.writeElement('version', FileAuditDataVersion)
   	.writeElement('file-number',FileNumber)
   	.writeElement('number-of-files',NumberOfFiles)
   	.endElement('file-auidt-data')
   	.startElement('registry')
   	.writeElement('registry-name',RegistryName)
   	.writeElement('registry-id',RegistryId)
   	.writeElement('submission-type',SubmissionType)
  	.writeElement('submission-method',SubmissionMethod)
   	.endElement('registry')
	.writePQRSMeasureLoopElement(loopcount,MeasureDataArray);
 	ws.end();
 	
 /* currently no graceful failure
  * 
  * 
  */


<?php
//------------Forms created by elizabeth 2019/06/07
include_once(dirname(__FILE__).'/../../globals.php');
include_once($GLOBALS["srcdir"]."/api.inc");
function nursing_assessment_report( $pid, $encounter, $cols, $id) {
$count = 0;
$data = formFetch("form_nursing_assessment", $id);
if ($data) {
print "<table><tr>";
foreach($data as $key => $value) {
if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date" || 
	$value == "" || $value == " " || $value == "0000-00-00 00:00:00") {
	continue;
}

$key=ucwords(str_replace("ass_comments","Assessment Comments",$key));
$key=ucwords(str_replace("PN_reason","Reason for  Communication",$key));
$key=ucwords(str_replace("PN_role","Provider Name/role",$key));
$key=ucwords(str_replace("PN_method","Method of Communication",$key));
$key=ucwords(str_replace("PN_response","Notification response",$key));
$key=ucwords(str_replace("V_temperature","Temperature",$key));
$key=ucwords(str_replace("V_source","Temp Source",$key));
$key=ucwords(str_replace("pulse","Pulse",$key));
$key=ucwords(str_replace("V_RespiratoryRate","Respiratory Rate",$key));
$key=ucwords(str_replace("SpO2","SpO2 (%)",$key));
$key=ucwords(str_replace("FiO2","FiO2 (%)",$key));
$key=ucwords(str_replace("V_roomAir","Room air(yes/no)",$key));
$key=ucwords(str_replace("V_deliveryMethod","O2 Delivery Method",$key));
$key=ucwords(str_replace("V_flowRate","O2 flow rate(LPM)",$key));
$key=ucwords(str_replace("V_bp","Blood Pressure",$key));
$key=ucwords(str_replace("V_bpMean","BP mean",$key));
$key=ucwords(str_replace("V_bpLocation","Bp location",$key));
$key=ucwords(str_replace("V_bpPosition","Bp patient Position",$key));
$key=ucwords(str_replace("BG_level","Blood Glucose Level",$key));
$key=ucwords(str_replace("BG_interventions","Related Interventions",$key));
$key=ucwords(str_replace("pt_behavior","Patient Behaviour",$key));
$key=ucwords(str_replace("pt_support","Patient Support",$key));
$key=ucwords(str_replace("pt_response","Patient Response",$key));
$key=ucwords(str_replace("ADL_location","Patient Location",$key));
$key=ucwords(str_replace("ADL_activity","Patient Activity",$key));
$key=ucwords(str_replace("ADL_position","Patient Position",$key));
$key=ucwords(str_replace("ADL_care","Care Elements Performed",$key));
$key=ucwords(str_replace("ADL_bath","Bath/Shower",$key));
$key=ucwords(str_replace("ADL_bed","Bed/Position",$key));
$key=ucwords(str_replace("ADL_assistance","ADL Assistance Level",$key));
$key=ucwords(str_replace("ADL_mobilisation","Mobilisation",$key));
$key=ucwords(str_replace("ADL_scd","SCD's or Ted Hose",$key));
$key=ucwords(str_replace("Pain_scale","Pain Scale",$key));
$key=ucwords(str_replace("Pain_gaol","Patient's Pain Goal",$key));
$key=ucwords(str_replace("Pain_rating","Pain rating",$key));
$key=ucwords(str_replace("Pain_location","Pain Location",$key));
$key=ucwords(str_replace("Pain_description","Pain description",$key));
$key=ucwords(str_replace("Pain_frequency","Pain Frequency",$key));
$key=ucwords(str_replace("Pain_interventions","Pain Interventions",$key));
$key=ucwords(str_replace("Pain_medSideEffects","Medications side effects",$key));
$key=ucwords(str_replace("pasero_sedation_score","Pasero Sedation Score",$key));
$key=ucwords(str_replace("repiratory_pattern","Repiratory Pattern",$key));
$key=ucwords(str_replace("thermoregulation","Thermoregulation type",$key));
$key=ucwords(str_replace("NM_location","Neuro Motor Location",$key));
$key=ucwords(str_replace("NM_limbMovnt","Limb Movements",$key));
$key=ucwords(str_replace("NM_strength","Motor Strength",$key));
$key=ucwords(str_replace("NM_sensation","Neuro Motor Sensation",$key));
$key=ucwords(str_replace("GCS_eyeOpening","Eye opening",$key));
$key=ucwords(str_replace("GCS_bestVerbal","Best Verbal",$key));
$key=ucwords(str_replace("GCS_bestMotor","Best Motor",$key));
$key=ucwords(str_replace("GCS_total","Total Score",$key));
$key=ucwords(str_replace("GCS_remarks","Glasgow coma scale Comments/Remarks",$key));
$key=ucwords(str_replace("NE_Orientaion","Neurological exam Orientation",$key));
$key=ucwords(str_replace("NE_cry","cry",$key));
$key=ucwords(str_replace("NE_pr_bilat","Pupil reaction/bilat",$key));
$key=ucwords(str_replace("NE_pr_left","Pupil reaction/left",$key));
$key=ucwords(str_replace("NE_pr_right","Pupil reaction/right",$key));
$key=ucwords(str_replace("NE_oculomotor","Oculomotor",$key));
$key=ucwords(str_replace("NE_fontanel","fontanel",$key));
$key=ucwords(str_replace("NE_reflexes","reflexes",$key));
$key=ucwords(str_replace("NE_seizure_activity","seizure activity",$key));
$key=ucwords(str_replace("NE_monitoring","neuro monitoring",$key));
$key=ucwords(str_replace("NE_collar","c-collar",$key));
$key=ucwords(str_replace("psy_Orientaion","Orientation",$key));
$key=ucwords(str_replace("psy_mood","Mood/affect",$key));
$key=ucwords(str_replace("psy_memory","Concentration/Memory",$key));
$key=ucwords(str_replace("psy_appearance","Appearance",$key));
$key=ucwords(str_replace("psy_behaviour","Behavior",$key));
$key=ucwords(str_replace("psy_eyeContact","Eye contact",$key));
$key=ucwords(str_replace("psy_thought","Thought",$key));
$key=ucwords(str_replace("pys_judgment","Insight/Judgement",$key));
$key=ucwords(str_replace("pys_interactions","Patient/Caregiver interactions",$key));
$key=ucwords(str_replace("psy_riskPrecaution","Ongoing risk precautions",$key));
$key=ucwords(str_replace("Psy_escalated_behavior","Escalated behavior",$key));
$key=ucwords(str_replace("cardio_heartSounds","Heart sounds",$key));
$key=ucwords(str_replace("cardio_PMI","PMI",$key));
$key=ucwords(str_replace("cardio_rhythm","Rhythm",$key));
$key=ucwords(str_replace("cardio_arrythmia","arrythmia",$key));
$key=ucwords(str_replace("cardio_arryfreq","arrythmia frequency",$key));
$key=ucwords(str_replace("cardio_interventions","cardio interventions",$key));
$key=ucwords(str_replace("cardio_crc","cap refill central",$key));
$key=ucwords(str_replace("cardio_crp","cap refill peripheral",$key));
$key=ucwords(str_replace("cardio_crRUE","cap refill RUE",$key));
$key=ucwords(str_replace("cardio_crLUE","cap refill LUE",$key));
$key=ucwords(str_replace("cardio_crRLE","cap refill RLE",$key));
$key=ucwords(str_replace("cardio_crLLE","cap refill LLE",$key));
$key=ucwords(str_replace("cardio_centralColor","Central Color/Temp",$key));
$key=ucwords(str_replace("cardio_PeripheralColor","Peripheral Color/Temp",$key));
$key=ucwords(str_replace("cardio_colorRUE","Color/Temp RUE",$key));
$key=ucwords(str_replace("cardio_colorLUE","Color/Temp LUE",$key));
$key=ucwords(str_replace("cardio_colorRLE","Color/Temp RLE",$key));
$key=ucwords(str_replace("cardio_colorLLE","Color/Temp LLE",$key));
$key=ucwords(str_replace("cardio_centralPulses","Central pulses",$key));
$key=ucwords(str_replace("cardio_pheripheralPulses","Pheripheral pulses",$key));
$key=ucwords(str_replace("cardio_pulseRUE","Pulse RUE",$key));
$key=ucwords(str_replace("cardio_pulseLUE","Pulse LUE",$key));
$key=ucwords(str_replace("cardio_pulseRLE","Pulse RLE",$key));
$key=ucwords(str_replace("cardio_pulseLLE","Pulse LLE",$key));
$key=ucwords(str_replace("resp_pattern","Respiratory pattern",$key));
$key=ucwords(str_replace("resp_retractions","Retractions",$key));
$key=ucwords(str_replace("resp_cough","cough",$key));
$key=ucwords(str_replace("resp_appearance","respiratory appearance",$key));
$key=ucwords(str_replace("resp_bsallLobes","Breath sounds all lobes",$key));
$key=ucwords(str_replace("resp_bsRUL","Breath sounds RUL",$key));
$key=ucwords(str_replace("resp_bsRML","Breath sounds RML",$key));
$key=ucwords(str_replace("resp_bsRLL","Breath sounds RLL",$key));
$key=ucwords(str_replace("resp_bsLUL","Breath sounds LUL",$key));
$key=ucwords(str_replace("resp_bsLLL","Breath sounds LLL",$key));
$key=ucwords(str_replace("resp_interventions","Respiratory interventions",$key));
$key=ucwords(str_replace("resp_suctiontype","Suctioning type",$key));
$key=ucwords(str_replace("resp_oralSec","Oral secretions",$key));
$key=ucwords(str_replace("resp_nasalSec","Nasal secretions",$key));
$key=ucwords(str_replace("resp_airwaySec","Airway secretions",$key));
$key=ucwords(str_replace("GI_abdAsssess","Abd assessment",$key));
$key=ucwords(str_replace("GI_girth","Abd girth (cm)",$key));
$key=ucwords(str_replace("GI_liverPos","Liver position",$key));
$key=ucwords(str_replace("GI_symptoms","GI symptoms",$key));
$key=ucwords(str_replace("GI_interventions","GI interventions",$key));
$key=ucwords(str_replace("GI_bsAllQuad","Bowel sounds-all quadrants",$key));
$key=ucwords(str_replace("GI_bsRUG","BS RUQ",$key));
$key=ucwords(str_replace("GI_bsRLG","BS RLQ",$key));
$key=ucwords(str_replace("GI_bsLUG","BS LUQ",$key));
$key=ucwords(str_replace("GI_bsLLG","BS LLQ",$key));
$key=ucwords(str_replace("GI_epigastric","Epigastric",$key));
$key=ucwords(str_replace("GU_symptoms","GU symptoms",$key));
$key=ucwords(str_replace("GU_interventions","GU interventions",$key));
$key=ucwords(str_replace("GU_bladderScan","Bladder scan residual amount (ml)",$key));
$key=ucwords(str_replace("GU_drainage","perineal drainage",$key));
$key=ucwords(str_replace("GU_genitalia","describe genitalia",$key));
$key=ucwords(str_replace("msk_dlocation","Deficit Location",$key));
$key=ucwords(str_replace("msk_glocation","girth/circum location",$key));
$key=ucwords(str_replace("msk_gcircum","girth/circumference (cm)",$key));
$key=ucwords(str_replace("msk_muscle","Muscle tone",$key));
$key=ucwords(str_replace("msk_motion","MSK/ORTHO system motion",$key));
$key=ucwords(str_replace("msk_appearance","MSK/ORTHO system Appearance",$key));
$key=ucwords(str_replace("msk_support","Support device",$key));
$key=ucwords(str_replace("msk_weight","Weight bearing",$key));
$key=ucwords(str_replace("msk_degree","CPM degree",$key));
$key=ucwords(str_replace("msk_state","CPM on/off",$key));
$key=ucwords(str_replace("msk_traction","Traction (lbs)",$key));
$key=ucwords(str_replace("msk_assessment","Traction assessment",$key));
$key=ucwords(str_replace("msk_cap","cap refill",$key));
$key=ucwords(str_replace("msk_sensation","motion sensation",$key));
$key=ucwords(str_replace("msk_extColorT","extremity color/temp",$key));
$key=ucwords(str_replace("msk_intervention","CMS check intervention",$key));
$key=ucwords(str_replace("skin_assessment","Skin assessment",$key));
$key=ucwords(str_replace("skin_location","Edema location",$key));
$key=ucwords(str_replace("skin_description","Edema description",$key));
$key=ucwords(str_replace("skin_rlocation","Rash location",$key));
$key=ucwords(str_replace("skin_rdescription","Rash description",$key));
$key=ucwords(str_replace("skin_lassessement","Laceration assessment",$key));
$key=ucwords(str_replace("skin_NBlocation","Nodule/Bump location",$key));
$key=ucwords(str_replace("skin_NBdescription","Nodule/Bump description",$key));
$key=ucwords(str_replace("skin_wlocation","Wound location",$key));
$key=ucwords(str_replace("skin_appearance","Skin Appearance",$key));
$key=ucwords(str_replace("skin_TfirstNoticed","Time first noticed",$key));
$key=ucwords(str_replace("skin_DfirstNoticed","Date first noticed",$key));
$key=ucwords(str_replace("skin_intervention","skin interventions",$key));
$key=ucwords(str_replace("skin_dressing","Dressing",$key));
$key=ucwords(str_replace("skin_drainage","Drainage",$key));
$key=ucwords(str_replace("skin_treatment","Topical Treatment",$key));
$key=ucwords(str_replace("skin_DfirstdressingApp","Date Dressing applied/changed",$key));
$key=ucwords(str_replace("skin_comment","skin Comments/Remarks",$key));

print "<td><span class=bold>$key: </span><span class=text>$value</span></td>";
$count++;
if ($count == $cols) {
$count = 0;
print "</tr><tr>\n";
}
}
}
print "</tr></table>";
}
?>
<?php

require_once ($GLOBALS['fileroot'] . "/library/classes/Controller.class.php");
require_once ($GLOBALS['fileroot'] . "/library/forms.inc");
require_once("FormROS.class.php");

class C_FormROS extends Controller {

    var $template_dir;
                    var $form_action;
                    var $dont_save_link;
                    var $style;
                    var $form;

    function __construct($template_mod = "general") {
        parent::__construct();
        $returnurl = 'encounter_top.php';
        $this->template_mod = $template_mod;
        $this->template_dir = dirname(__FILE__) . "/templates/ros/";

                    $this->form_action = $GLOBALS['web_root'];
                    $this->dont_save_link = $GLOBALS['webroot'] . "/interface/patient_file/encounter/$returnurl";
                    $this->style = $GLOBALS['style'];
    }

    function default_action() {
        $ros = new FormROS();

                    $this->form = $ros;
                    ob_start(); //Start output Buffer
                    require_once($this->template_dir . $this->template_mod . "_new.php");
                    $echoed_content = ob_get_clean(); // gets content, discards buffer
                    return $echoed_content;
    }

    function view_action($form_id) {

        if (is_numeric($form_id)) {
            $ros = new FormROS($form_id);
        }
        else {
            $ros = new FormROS();
        }

                    $this->form = $ros;
                    ob_start(); //Start output Buffer
                    require_once($this->template_dir . $this->template_mod . "_new.php");
                    $echoed_content = ob_get_clean(); // gets content, discards buffer
                    return $echoed_content;


    }

    function default_action_process() {
        if ($_POST['process'] != "true"){

            return;
        }
        $this->ros = new FormROS($_POST['id']);

        parent::populate_object($this->ros);
        $this->ros->persist();

        if ($GLOBALS['encounter'] == "") {
            $GLOBALS['encounter'] = date("Ymd");
        }
        if(empty($_POST['id']))
        {
            addForm($GLOBALS['encounter'], "Review Of Systems", $this->ros->id, "ros", $GLOBALS['pid'], $_SESSION['userauthorized']);
            $_POST['process'] = "";
        }
        return;
    }

    function save_ros_form() {
        $_POST['activity'] = 1; // We need to know how to obtain the activity
        $set_ros_form_data =  "pid = '" . $_SESSION['pid'] . "',
            activity = '" . formData('activity') . "',
            date = '" . date('Y-m-d H:i:s') . "',
            weight_change = '" . formData('weight_change') . "',
            weakness = '" . formData('weakness') . "',
            fatigue = '" . formData('fatigue') . "',
            anorexia = '" . formData('anorexia') . "',
            fever = '" . formData('fever') . "',
            chills = '" . formData('chills') . "',
            night_sweats = '" . formData('night_sweats') . "',
            insomnia = '" . formData('insomnia') . "',
            irritability = '" . formData('irritability') . "',
            heat_or_cold = '" . formData('heat_or_cold') . "',
            intolerance = '" . formData('intolerance') . "',
            change_in_vision = '" . formData('change_in_vision') . "',
            glaucoma_history = '" . formData('glaucoma_history') . "',
            eye_pain = '" . formData('eye_pain') . "',
            irritation = '" . formData('irritation') . "',
            redness = '" . formData('redness') . "',
            excessive_tearing = '" . formData('excessive_tearing') . "',
            double_vision = '" . formData('double_vision') . "',
            blind_spots = '" . formData('blind_spots') . "',
            photophobia = '" . formData('photophobia') . "',
            hearing_loss = '" . formData('hearing_loss') . "',
            discharge = '" . formData('discharge') . "',
            pain = '" . formData('pain') . "',
            vertigo = '" . formData('vertigo') . "',
            tinnitus = '" . formData('tinnitus') . "',
            frequent_colds = '" . formData('frequent_colds') . "',
            sore_throat = '" . formData('sore_throat') . "',
            sinus_problems = '" . formData('sinus_problems') . "',
            post_nasal_drip = '" . formData('post_nasal_drip') . "',
            nosebleed = '" . formData('nosebleed') . "',
            snoring = '" . formData('snoring') . "',
            apnea = '" . formData('apnea') . "',
            breast_mass = '" . formData('breast_mass') . "',
            breast_discharge = '" . formData('breast_discharge') . "',
            biopsy = '" . formData('biopsy') . "',
            abnormal_mammogram = '" . formData('abnormal_mammogram') . "',
            cough = '" . formData('cough') . "',
            sputum = '" . formData('sputum') . "',
            shortness_of_breath = '" . formData('shortness_of_breath') . "',
            wheezing = '" . formData('wheezing') . "',
            hemoptsyis = '" . formData('hemoptsyis') . "',
            asthma = '" . formData('asthma') . "',
            copd = '" . formData('copd') . "',
            chest_pain = '" . formData('chest_pain') . "',
            palpitation = '" . formData('palpitation') . "',
            syncope = '" . formData('syncope') . "',
            pnd = '" . formData('pnd') . "',
            doe = '" . formData('doe') . "',
            orthopnea = '" . formData('orthopnea') . "',
            peripheal = '" . formData('peripheal') . "',
            edema = '" . formData('edema') . "',
            legpain_cramping = '" . formData('legpain_cramping') . "',
            history_murmur = '" . formData('history_murmur') . "',
            arrhythmia = '" . formData('arrhythmia') . "',
            heart_problem = '" . formData('heart_problem') . "',
            dysphagia = '" . formData('dysphagia') . "',
            heartburn = '" . formData('heartburn') . "',
            bloating = '" . formData('bloating') . "',
            belching = '" . formData('belching') . "',
            flatulence = '" . formData('flatulence') . "',
            nausea = '" . formData('nausea') . "',
            vomiting = '" . formData('vomiting') . "',
            hematemesis = '" . formData('hematemesis') . "',
            gastro_pain = '" . formData('gastro_pain') . "',
            food_intolerance = '" . formData('food_intolerance') . "',
            hepatitis = '" . formData('hepatitis') . "',
            jaundice = '" . formData('jaundice') . "',
            hematochezia = '" . formData('hematochezia') . "',
            changed_bowel = '" . formData('changed_bowel') . "',
            diarrhea = '" . formData('diarrhea') . "',
            constipation = '" . formData('constipation') . "',
            polyuria = '" . formData('polyuria') . "',
            polydypsia = '" . formData('polydypsia') . "',
            dysuria = '" . formData('dysuria') . "',
            hematuria = '" . formData('hematuria') . "',
            frequency = '" . formData('frequency') . "',
            urgency = '" . formData('urgency') . "',
            incontinence = '" . formData('incontinence') . "',
            renal_stones = '" . formData('renal_stones') . "',
            utis = '" . formData('utis') . "',
            hesitancy = '" . formData('hesitancy') . "',
            dribbling = '" . formData('dribbling') . "',
            stream = '" . formData('stream') . "',
            nocturia = '" . formData('nocturia') . "',
            erections = '" . formData('erections') . "',
            ejaculations = '" . formData('ejaculations') . "',
            g = '" . formData('g') . "',
            p = '" . formData('p') . "',
            ap = '" . formData('ap') . "',
            lc = '" . formData('lc') . "',
            mearche = '" . formData('mearche') . "',
            menopause = '" . formData('menopause') . "',
            lmp = '" . formData('lmp') . "',
            f_frequency = '" . formData('f_frequency') . "',
            f_flow = '" . formData('f_flow') . "',
            f_symptoms = '" . formData('f_symptoms') . "',
            abnormal_hair_growth = '" . formData('abnormal_hair_growth') . "',
            f_hirsutism = '" . formData('f_hirsutism') . "',
            joint_pain = '" . formData('joint_pain') . "',
            swelling = '" . formData('swelling') . "',
            m_redness = '" . formData('m_redness') . "',
            m_warm = '" . formData('m_warm') . "',
            m_stiffness = '" . formData('m_stiffness') . "',
            muscle = '" . formData('muscle') . "',
            m_aches = '" . formData('m_aches') . "',
            fms = '" . formData('fms') . "',
            arthritis = '" . formData('arthritis') . "',
            loc = '" . formData('loc') . "',
            seizures = '" . formData('seizures') . "',
            stroke = '" . formData('stroke') . "',
            tia = '" . formData('tia') . "',
            n_numbness = '" . formData('n_numbness') . "',
            n_weakness = '" . formData('n_weakness') . "',
            paralysis = '" . formData('paralysis') . "',
            intellectual_decline = '" . formData('intellectual_decline') . "',
            memory_problems = '" . formData('memory_problems') . "',
            dementia = '" . formData('dementia') . "',
            n_headache = '" . formData('n_headache') . "',
            s_cancer = '" . formData('s_cancer') . "',
            psoriasis = '" . formData('psoriasis') . "',
            s_acne = '" . formData('s_acne') . "',
            s_other = '" . formData('s_other') . "',
            s_disease = '" . formData('s_disease') . "',
            p_diagnosis = '" . formData('p_diagnosis') . "',
            p_medication = '" . formData('p_medication') . "',
            depression = '" . formData('depression') . "',
            anxiety = '" . formData('anxiety') . "',
            social_difficulties = '" . formData('social_difficulties') . "',
            thyroid_problems = '" . formData('thyroid_problems') . "',
            diabetes = '" . formData('diabetes') . "',
            abnormal_blood = '" . formData('abnormal_blood') . "',
            anemia = '" . formData('anemia') . "',
            fh_blood_problems = '" . formData('fh_blood_problems') . "',
            bleeding_problems = '" . formData('bleeding_problems') . "',
            allergies = '" . formData('allergies') . "',
            frequent_illness = '" . formData('frequent_illness') . "',
            hiv = '" . formData('hiv') . "',
            hai_status = '" . formData('hai_status') . "'";

        $existing_form_ros = $this->get_existing_ros_form_entry($_SESSION['pid'], $_POST['activity']);

        // update or insert form_ros
        if (!empty($existing_form_ros)) {
            sqlStatement("UPDATE form_ros SET $set_ros_form_data WHERE pid = ? AND activity = ?", array($_SESSION['pid'], $_POST['activity']));
        } else {
            sqlInsert("INSERT INTO form_ros SET $set_ros_form_data");
        }
        return;
    }

    // Checking if we already have an entry
    function get_existing_ros_form_entry($pid, $activity) {
        $res = sqlQuery("SELECT `activity` FROM form_ros WHERE pid = ? AND activity = ?", array($pid, $activity));
        return $res;
    }

}



?>

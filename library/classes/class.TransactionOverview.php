<?php 

class TransactionOverview {

	// this class is used by the transaction section in order to obtain the information
	// for the transaction
	public function __construct($pid, $encounter="", $case_number="") {
		$this->pid = $pid; 
		$this->encounter = $encounter;
		$this->case_number = $case_number;
	}

	public function applyFilters($query_object, $table_name) {
		// encounter id will be provided if a single row in the
		// transaction is clicked.so that time we need to filter by the 
		// encounter id.

		// if the encounter supplied to class then put it in where condition
		if ($this->encounter != "") {
			$query_object = $query_object->where($table_name.'.encounter', $this->encounter);
		}

		if ($this->case_number != "") {
			$query_object = $query_object->where($table_name.'.case_number', $this->case_number);
		}

		return $query_object;


	}

	private function getUnbilled() {

		$unbilled_query = ORM::for_table('form_encounter')
								 ->join('billing', array('form_encounter.encounter', '=', 'billing.encounter'))
								 ->where('form_encounter.pid', $this->pid)
								->where('billing.code_type', 'CPT4')
								->where('billing.activity', 1)
								->where('billing.billed', 0)
								 ->select_expr('(SELECT SUM(billing.fee))', 'unbilled');

		$unbilled_query = $this->applyFilters($unbilled_query, "form_encounter")->find_array();

		return $unbilled_query[0]['unbilled'];

	}

	private function getPayments() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->select_expr("(SELECT SUM(ar_activity.pay_amount))", 'payments');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['payments'];



	}

	private function getAdjustments() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->select_expr("(SELECT SUM(ar_activity.adj_amount))", 'adjustments');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['adjustments'];


	}


	private function getPrimaryAdjustments() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->where('ar_activity.payer_type', 1)
			->where_not_equal('ar_activity.adj_amount', 0)
			->select_expr("(SELECT SUM(ar_activity.adj_amount))", 'primary_adjustments');

		$query = $this->applyFilters($query, "form_encounter")->find_array();
		return $query[0]['primary_adjustments'];


	}	

	private function getSecondaryAdjustments() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->where_raw('(ar_activity.payer_type = ? OR ar_activity.payer_type = ?)', array(2, 3))
			->where_not_equal('ar_activity.adj_amount', 0)
			->select_expr("(SELECT SUM(ar_activity.adj_amount))", 'secondary_adjustments');

		$query = $this->applyFilters($query, "form_encounter")->find_array();
		return $query[0]['secondary_adjustments'];


	}	

	private function getPrimaryPaid() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->where('ar_activity.payer_type', 1)
			->select_expr("(SELECT SUM(ar_activity.pay_amount))", 'primary_paid');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['primary_paid'];


	}

	private function getSecondaryPaid() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->where_raw('(ar_activity.payer_type = ? OR ar_activity.payer_type = ?)', array(2, 3))
			->select_expr("(SELECT SUM(ar_activity.pay_amount))", 'secondary_paid');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['secondary_paid'];

	}


	private function getPatientPaid() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.inactive', 0)
			->where_raw('(ar_activity.account_code = ? OR ar_activity.account_code = ?)', array("PP", "PCP"))
			->select_expr("(SELECT SUM(ar_activity.pay_amount))", 'patient_paid');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['patient_paid'];


	}


	private function getCharges() {

		$query = ORM::for_table('form_encounter')
			->join('billing', array('form_encounter.encounter', '=', 'billing.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('billing.code_type', 'CPT4')
			->where('billing.activity', 1)
			//->where('billing.billed', 1)
			->select_expr("(SELECT SUM(billing.fee))", 'charges');

		$query = $this->applyFilters($query, "form_encounter")->find_array();

		return $query[0]['charges'];

	}

	private function getUnapplied() {

		$query = ORM::for_table('form_encounter')
			->join('ar_activity', array('form_encounter.encounter', '=', 'ar_activity.encounter'))
			->where('form_encounter.pid', $this->pid)
			->where('ar_activity.unapplied', 1)
			->where('ar_activity.inactive', 0)
			->select_expr("(SELECT SUM(ar_activity.pay_amount))", 'unapplied');
		$query = $this->applyFilters($query, "form_encounter")->find_array();
		return $query[0]['unapplied'];
	}

	public function getData() {
		$result = array();
		$result['unbilled'] = $this->getUnbilled();
		$result['charges'] = $this->getCharges();
		$result['payments'] = $this->getPayments();
		$result['adjustments'] = $this->getAdjustments();
		$result['primary_paid'] = $this->getPrimaryPaid();
		$result['secondary_paid'] = $this->getSecondaryPaid();
		$result['patient_paid'] = $this->getPatientPaid();
		$result['unapplied'] = $this->getUnapplied();
		$result['primary_adjustments'] = $this->getPrimaryAdjustments();
		$result['secondary_adjustments'] = $this->getSecondaryAdjustments();
		// division by zero error can occur if charges
		// are zero, so check charges are not zero
		$result['case_collection'] = 0;
		
		if ($this->encounter != "") {
			// if a encounter is supplied then return the encounter
			// helpful in identifying whether the overview is for group
			// or for a single encounter
			$result['encounter'] = $this->encounter;
		}
		
		if ($result['charges'] != 0) {
			$result['case_collection'] = ($result['payments'] / $result['charges']) * 100;
		}
		
		return $result;
	}

}

?>
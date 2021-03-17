<?php

class patient
{
#==================================================================================================
#--------------------------------------------------------------------------------------------------
	public $con;
	public $id_patient,$patient_name,$admission,$description,$table="patient";
#--------------------------------------------------------------------------------------------------
	public function __construct($obj1)
	{
		$this->con=$obj1;
	}
#--------------------------------------------------------------------------------------------------
	public function ReadPatient($records_per_page,$from_record_num)
	{
		$query = "SELECT  id_patient, patient_name, admission, description
		FROM patient ORDER BY id_patient
		ASC LIMIT {$from_record_num} , {$records_per_page} ";

		$stmt = $this->con->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->execute();

		return $stmt;
	}
#--------------------------------------------------------------------------------------------------
	public function countpages()
	{
		$query = "SELECT id_patient FROM " . $this->table . "";

		$stmt = $this->con->prepare( $query );
		$stmt->execute();
		$num = $stmt->rowCount();

		return $num;
	}
#--------------------------------------------------------------------------------------------------
	public function ReadOne($id)
	{
		try {// prepare select query
			$query = "SELECT id_patient, patient_name, admission, description
			FROM patient WHERE id_patient = $id LIMIT 0,1";
			$stmt = $this->con->prepare( $query );
			$stmt->bindParam(1, $id);// this is the first question mark
			$stmt->execute();// execute our query
			$row = $stmt->fetch(PDO::FETCH_ASSOC);// store retrieved row to a variable

			// values to fill up our form
			$this->id_patient = $row['id_patient'];
			$this->patient_name = $row['patient_name'];
			$this->description = $row['description'];
			$this->admission = $row['admission'];
		}
		// show error
		catch(PDOException $exception){
			die('ERROR: ' .$exception->getMessage());
		}

		return $stmt;
	}
#--------------------------------------------------------------------------------------------------
	public function ReadOneV02($id_user)
	{
		$query = "SELECT id_patient, patient_name, admission, description
		FROM patient WHERE id_patient = :id_user ";
		$stmt = $this->con->prepare( $query );
		$stmt->bindParam(':id_user',$id_user);
		$stmt->execute();// execute our query
		$row = $stmt->fetch(PDO::FETCH_ASSOC);// store retrieved row to a variable

		return $row;
	}
#--------------------------------------------------------------------------------------------------
	public function UpdatePatient($id_patient)
	{
		$query = "UPDATE patient
		SET patient_name=:patient_name, admission=:admission, description=:description
		WHERE id_patient = $id_patient";
		$stmt = $this->con->prepare($query);// prepare query for excecution

		$this->patient_name=htmlspecialchars(strip_tags($this->patient_name));
		$this->admission=htmlspecialchars(strip_tags($this->admission));
		$this->description=htmlspecialchars(strip_tags($this->description));

		$stmt->bindParam(':patient_name',$this->patient_name);
		$stmt->bindParam(':admission',$this->admission);
		$stmt->bindParam(':description',$this->description);

		if($stmt->execute()){
			echo "<div class='alert alert-success'>Record was updated.</div>";
		}else{
			echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
		}

		$information=array($this->patient_name,$this->admission,$this->description);

		return $information;
	}
#--------------------------------------------------------------------------------------------------
	public function DeletePatient($id)
	{
		$query = "DELETE FROM patient where id_patient=$id order by id_patient";
		$stmt=$this->con->prepare($query);
		$stmt->bindParam(1, $id);

		if($stmt->execute()){
		// redirect to read records page and
		// tell the user record was deleted
			header('Location: index.php?action=deleted');
		}else{
			die('Unable to delete record.');
		}

		return $stmt;
	}
#--------------------------------------------------------------------------------------------------
	public function createRecord()
	{
		$query = "INSERT INTO " . $this->table . " SET id_patient= :id_patient,
		patient_name= :patient_name, admission= :admission,
		description=:description,created=:created ";

		$stmt = $this->con->prepare($query);// prepare query for execution
		$this->id_patient=htmlspecialchars(strip_tags($this->id_patient));
		$this->patient_name=htmlspecialchars(strip_tags($this->patient_name));
		$this->description=htmlspecialchars(strip_tags($this->description));
		$this->admission=htmlspecialchars(strip_tags($this->admission));

		// bind the parameters
		$stmt->bindParam(':id_patient', $this->id_patient);
		$stmt->bindParam(':patient_name', $this->patient_name);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':admission', $this->admission);

		// specify when this record was inserted to the database
		$created=date('Y-m-d H:i:s');
		$stmt->bindParam(':created', $created);

		if($stmt->execute()){
			echo "<div class='alert alert-success'>Record was saved.</div>";
		}else{
			echo "<div class='alert alert-danger'>Unable to save record.</div>";
		}

		return $stmt;
	}
#--------------------------------------------------------------------------------------------------
	public function print_user($id_user)
	{
		try {// prepare select query
			$row = ReadOneV($id_user);
			//$row = ReadOneV02($id_user);
			//$this->dataStyleV00($row);
			//return $result;
			//$endresult=$pdf->Output();
		}
		// show error
		catch(PDOException $exception){
			die('ERROR: ' .$exception->getMessage());
		}
	}
#--------------------------------------------------------------------------------------------------
	function paparPdf($row)
	{
		ob_start();
		require('fpdf/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',14);
		$pdf->Output();
		ob_end_flush();
		#
	}
#--------------------------------------------------------------------------------------------------
	function debugDataSqlDaa($row)
	{
		semakPembolehubah($row,'data row');
		if(isset($this->id_patient)) semakPembolehubah($this->id_patient,'this->id_patient');
		if(isset($this->patient_name)) semakPembolehubah($this->patient_name,'this->patient_name');
		if(isset($this->description)) semakPembolehubah($this->description,'this->description');
		if(isset($this->admission)) semakPembolehubah($this->admission,'this->admission');
	}
#--------------------------------------------------------------------------------------------------
	function dataStyleV01()
	{
		// values to fill up our form
		/*$this->id_patient = $row['id_patient'];
		$this->patient_name = $row['patient_name'];
		$this->description = $row['description'];
		$this->admission = $row['admission'];*/
	}
#--------------------------------------------------------------------------------------------------
	function dataStyleV02()
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$this->id_patient = $row['id_patient'];
			$this->patient_name = $row['patient_name'];
			$this->description = $row['description'];
			$this->admission = $row['admission'];
			/*$pdf->Cell(20,10,$this->id_patient,1);
			$pdf->Cell(40,10,$this->patient_name,1);
			$pdf->Cell(80,10,$this->description,1);
			$pdf->Cell(40,10,$this->admission,1);
			$pdf->Ln();*/
		}
	}
#--------------------------------------------------------------------------------------------------
#==================================================================================================
}

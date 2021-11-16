<?php
include('connection.php');

class ApiQuery extends DBConnection {
	
	/*****************************************
	 * READY-MADE/SIMPLIFIED API FOR SH**
	 * DEVELEPED AT DONNEKT/GADRAWINGZ (FRAMEWORK)
	 * COPYRIGHT @DONNEKT 2021 NOVERMBER
	 * ***************************************/

	public function __construct() {
		$obj = new DBConnection;
		$this->conLink= $obj->connect();
	}

	public function registerFarmer($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $dst, $sct, $cll, $vlg) {
		$sql= "INSERT INTO `farmer`(`firstname`, `lastname`, `gender`, `dob`, `national_id`, `telephone`, `password`, `district`, `sector`, `cell`, `village`) VALUES ('$fnm', '$lnm', '$gdr', '$dob', '$nid', '$tel', '$pwd', '$dst', '$sct', '$cll', '$vlg')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function farmerLogin($tel, $pass) {
		$sql = "SELECT * FROM `farmer` WHERE telephone='$tel' AND password='$pass' ";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewFarmer($id) {
		$sql = " SELECT * FROM `farmer` WHERE farmer_id='$id' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function editFarmerMain($id, $fnm, $lnm, $gdr, $dob, $nid, $tel) {
		$sql="UPDATE farmer SET firstname='$fnm', lastname='$lnm', gender='$gdr', dob='$dob', national_id='$nid', telephone='$tel', gender='$gd', staff_role='$rl', password='$ps' WHERE staff_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function editFarmerAddress($id, $dst, $sct, $cll, $vlg) {
		$sql="UPDATE farmer SET district='$dst', sector='$sct', cell='$cll', village='$vlg' WHERE farmer_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function deleteFarmer($id) {
		$sql= "DELETE FROM farmer WHERE farmer_id='$id' ";
		$query = $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	// ================================================================
	public function checkFarmerExistence($phone, $nid) {
		$sql = "SELECT COUNT(*) FROM farmer WHERE telephone='$phone' OR national_id='$nid' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countFarmer($id) {
		$sql = "SELECT COUNT(*) FROM farmer WHERE farmer_id='$id' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	/*******************************************
	 * READY-MADE/SIMPLIFIED API FOR PHP APPS
	 * DEVELEPED AT DONNEKT/GADRAWINGZ (FRAMEWORK)
	 * COPYRIGHT @DONNEKT NOV.2021 donnekt.com
	 * *****************************************/

	public function farmerRequest($farm_id, $seed_id, $seed_qt, $fert_id, $fert_qt, $pest_id, $pest_qt, $seas_yr, $seas_tm) {
		$sql= "INSERT INTO `requests`(`farmer_id`, `seed_id`, `seed_qty`, `fert_id`, `fert_qty`, `pest_id`, `pest_qty`, `season_year`, `season_term`) VALUES ('$farm_id', '$seed_id', '$seed_qt', '$fert_id', '$fert_qt', '$pest_id', '$pest_qt', '$seas_yr', '$seas_tm')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function checkReqForMaking($farm_id, $seed_id, $fert_id, $pest_id, $seas_yr, $seas_tm) {
		$sql = "SELECT COUNT(*) FROM `requests` WHERE seed_id='$seed_id' AND fert_id='$fert_id' AND pest_id='$pest_id' AND `season_year`='$seas_yr' AND `season_term`='$seas_tm' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}
}
?>
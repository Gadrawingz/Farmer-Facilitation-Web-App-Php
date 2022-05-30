<?php
require_once('connection.php');

class Query extends DBConnection {
	
	/*****************************************
	 * READY-MADE/SIMPLIFIED API FOR SH**
	 * DEVELEPED AT DONNEKT/GADRAWINGZ
	 * COPYRIGHT @DONNEKT 2021 SEPTEMBER
	 * ***************************************/

	public function __construct() {
		$obj = new DBConnection;
		$this->conLink= $obj->connect();
	}

	public function registerAdmin($fn, $ln, $gd, $em, $ph, $ps) {
		$sql= "INSERT INTO `admin`(`firstname`, `lastname`, `gender`, `email`, `telephone`, `password`) VALUES ('$fn', '$ln', '$gd', '$em', '$ph', '$ps')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}


	public function adminLogin($email, $pass) {
        $sql= "SELECT * FROM `admin` WHERE email='$email' AND password='$pass' ";
        $stmt=$this->conLink->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

	public function viewAllAdmins() {
		$sql= "SELECT * FROM admin ORDER BY created_at ASC";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewAdmin($id) {
		$sql = " SELECT * FROM admin WHERE admin_id='$id'";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function updateAdmin($id, $fn, $ln, $gd, $em, $ph, $ps) {
		$sql="UPDATE admin SET firstname='$fn', lastname='$ln', email='$em', telephone='$ph', gender='$gd', password='$ps' WHERE admin_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function enableAdmin($id) {
		$sql="UPDATE admin SET status='active' WHERE admin_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function disableAdmin($id) {
		$sql="UPDATE admin SET status='inactive' WHERE admin_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function deleteAdmin($id) {
		$sql="DELETE FROM admin WHERE admin_id='$id' ";
		$query = $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	// ===================@gadrawin lines =========================
	public function checkAdminLogin($email, $pass) {
		$sql = "SELECT COUNT(*) FROM admin WHERE email='$email' AND password='$pass' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function checkAdminExistence($email, $phone) {
		$sql = "SELECT COUNT(*) FROM admin WHERE email='$email' OR telephone='$phone' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countAdmins() {
		$sql = "SELECT COUNT(*) FROM admin ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countActiveAdmins() {
		$sql = "SELECT COUNT(*) FROM admin WHERE status='active' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countInactiveAdmins($id) {
		$sql = "SELECT COUNT(*) FROM admin WHERE status='inactive' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}


	/*********************************************************/

	public function checkFarmerExistenceByAdmin($phone, $nid) {
		$sql = "SELECT COUNT(*) FROM farmer WHERE telephone='$phone' OR national_id='$nid' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function registerFarmerByAdmin($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $are, $pro, $dst, $sct, $cll, $vlg) {

		$sql= "INSERT INTO `farmer`(`firstname`, `lastname`, `gender`, `dob`, `national_id`, `telephone`, `password`, `land_area`, `province`, `district`, `sector`, `cell`, `village`, `status`) VALUES ('$fnm', '$lnm', '$gdr', '$dob', '$nid', '$tel', '$pwd', '$are', '$pro', '$dst', '$sct', '$cll', '$vlg', 'active')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function viewRecentFarmers() {
		$sql= "SELECT * FROM farmer WHERE status='inactive'  ORDER BY created_at ASC";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewConfirmedFarmers() {
		$sql= "SELECT * FROM farmer WHERE status='active' ORDER BY created_at ASC";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewFarmer($id) {
		$sql = " SELECT * FROM farmer WHERE farmer_id='$id'";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	// ===========================
	public function confirmFarmer($id) {
		$sql="UPDATE farmer SET status='active' WHERE farmer_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function cancelFarmer($id) {
		$sql="UPDATE farmer SET status='inactive' WHERE farmer_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function countFarmers() {
		$sql = "SELECT COUNT(*) FROM farmer ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}



	// Donnekt Miracles:
	public function pushMotherfuckinItem($name, $type, $quantity, $price, $thing) {
		$i_name = ucfirst($name);
		if($thing=='FERT') {
			$sql= "INSERT INTO `fertilizer`(`item_name`, `item_type`, `quantity`, `unit_price`) VALUES('$i_name', '$type', '$quantity', '$price')";
		} else if($thing=='PEST') {
			$sql= "INSERT INTO `pesticide`(`item_name`, `item_type`, `quantity`, `unit_price`) VALUES('$i_name', '$type', '$quantity', '$price')";
		} else if($thing=='SEED') {
			$sql= "INSERT INTO `seeds`(`item_name`, `item_type`, `quantity`, `unit_price`) VALUES('$i_name', '$type', '$quantity', '$price')";
		}
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function viewAllDamnItems($thing) {
		if($thing=='FERT') {
			$sql= "SELECT * FROM `fertilizer` ORDER BY created_at";
		} else if($thing=='PEST') {
			$sql= "SELECT * FROM `pesticide` ORDER BY created_at";
		} else if($thing=='SEED') {
			$sql= "SELECT * FROM `seeds` ORDER BY created_at";
		}

		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewDamnItem($id, $thing) {
		if($thing=='FERT') {
			$sql= "SELECT * FROM `fertilizer` WHERE item_id='$id' ORDER BY created_at";
		} else if($thing=='PEST') {
			$sql= "SELECT * FROM `pesticide` WHERE item_id='$id' ORDER BY created_at";
		} else if($thing=='SEED') {
			$sql= "SELECT * FROM `seeds` WHERE item_id='$id' ORDER BY created_at";
		}

		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function deleteDamnItem($id, $thing) {
		if($thing=='FERT') {
			$sql= "DELETE FROM `fertilizer` WHERE item_id='$id'";
		} else if($thing=='PEST') {
			$sql= "DELETE FROM `pesticide` WHERE item_id='$id'";
		} else if($thing=='SEED') {
			$sql= "DELETE FROM `seeds` WHERE item_id='$id'";
		}

		$query = $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function updateDamnItem($id, $name, $type, $quantity, $price, $thing) {
		if($thing=='FERT') {
			$sql="UPDATE `fertilizer` SET item_name='$name', item_type='$type', quantity='$quantity', unit_price='$price' WHERE item_id='$id' ";
		} else if($thing=='PEST') {
			$sql="UPDATE `pesticide` SET item_name='$name', item_type='$type', quantity='$quantity', unit_price='$price' WHERE item_id='$id' ";
		} else if($thing=='SEED') {
			$sql="UPDATE `seeds` SET item_name='$name', item_type='$type', quantity='$quantity', unit_price='$price' WHERE item_id='$id' ";
		}

		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function checkDamnItem($name, $thing) {
		if($thing=='FERT') {
			$sql = "SELECT COUNT(*) FROM `fertilizer` WHERE item_name='$name' ";
		} else if($thing=='PEST') {
			$sql = "SELECT COUNT(*) FROM `pesticide` WHERE item_name='$name' ";
		} else if($thing=='SEED') {
			$sql = "SELECT COUNT(*) FROM `seeds` WHERE item_name='$name' ";
		}
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countAllDamnItems($thing) {
		if($thing=='FERT') {
			$sql = "SELECT COUNT(*) FROM `fertilizer` ";
		} else if($thing=='PEST') {
			$sql = "SELECT COUNT(*) FROM `pesticide` ";
		} else if($thing=='SEED') {
			$sql = "SELECT COUNT(*) FROM `seeds` ";
		}

		$sql = "SELECT COUNT(*) FROM admin ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	//======================== REQ MUHFUCKIN SHITS @Gadrawingz =======================

	public function viewRequestsByStatus($status) {
		if($status=="Rej") {
			$r_status = "Rejected";
		} else if ($status=="Acp") {
			$r_status = "Accepted";
		}  else if ($status=="Pnd") {
			$r_status = "Pending";
		} else {
			$r_status = "Pending";
		}

		$sql="SELECT rq.req_id, rq.farmer_id, fm.firstname, fm.lastname, rq.seed_id, sd.item_name AS s_name, rq.seed_qty, sd.unit_price AS s_price, rq.fert_id, ft.item_name AS f_name, rq.fert_qty, ft.unit_price AS f_price, rq.pest_id, ps.item_name AS p_name, rq.pest_qty, ps.unit_price AS p_price, rq.season_year, rq.season_term, rq.req_status, rq.is_paid, rq.req_date FROM requests rq JOIN farmer fm ON fm.farmer_id = rq.farmer_id JOIN fertilizer ft ON ft.item_id = rq.fert_id JOIN pesticide ps ON ps.item_id = rq.pest_id JOIN seeds sd ON sd.item_id = rq.seed_id WHERE req_status='$r_status' ORDER BY req_date DESC";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewRequest($req) {
		$sql="SELECT rq.req_id, rq.farmer_id, fm.telephone, fm.land_area, fm.national_id, fm.firstname, fm.lastname, rq.seed_id, sd.item_name AS s_name, rq.seed_qty, sd.unit_price AS s_price, rq.fert_id, ft.item_name AS f_name, rq.fert_qty, ft.unit_price AS f_price, rq.pest_id, ps.item_name AS p_name, rq.pest_qty, ps.unit_price AS p_price, rq.season_year, rq.season_term, rq.req_status, rq.is_paid, rq.req_date FROM requests rq JOIN farmer fm ON fm.farmer_id = rq.farmer_id JOIN fertilizer ft ON ft.item_id = rq.fert_id JOIN pesticide ps ON ps.item_id = rq.pest_id JOIN seeds sd ON sd.item_id = rq.seed_id WHERE rq.req_id='$req' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function confirmFRequest($id) {
		$sql="UPDATE requests SET req_status='Accepted' WHERE req_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function cancelFRequest($id) {
		$sql="UPDATE requests SET req_status='Pending' WHERE req_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}


	public function rejectRequest($id) {
		$sql="UPDATE requests SET req_status='Rejected' WHERE req_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function penRequestCounts() {
		$sql="SELECT COUNT(*) FROM `requests` WHERE req_status='Pending' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function acpRequestCounts() {
		$sql="SELECT COUNT(*) FROM `requests` WHERE req_status='Accepted' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function newHarvestCounts() {
		$sql="SELECT COUNT(*) FROM `harvest` WHERE status='unchecked' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}


	// Harvests
	public function viewHarvests() {
		$sql= "SELECT hv.harvest_id, fm.farmer_id, fm.firstname, fm.lastname, fm.telephone, hv.item_type, hv.quantity, hv.harvest_price, hv.season_year, hv.season_term, hv.status, hv.created_at AS hv_date FROM `harvest` hv LEFT JOIN farmer fm ON fm.farmer_id=hv.farmer_id WHERE hv.status='unchecked' ORDER BY hv.harvest_id DESC ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewHarvest($id) {
		$sql= "SELECT hv.harvest_id, fm.farmer_id, fm.firstname, fm.lastname, fm.telephone, hv.item_type, hv.quantity, hv.harvest_price, hv.season_year, hv.season_term, hv.status, hv.created_at AS hv_date FROM `harvest` hv LEFT JOIN farmer fm ON fm.farmer_id=hv.farmer_id WHERE hv.harvest_id='$id' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewCheckedHarvests() {
		$sql= "SELECT hv.harvest_id, fm.farmer_id, fm.firstname, fm.lastname, fm.telephone,  hv.item_type, hv.quantity, hv.harvest_price, hv.season_year, hv.season_term, hv.status, hv.created_at AS hv_date FROM `harvest` hv LEFT JOIN farmer fm ON fm.farmer_id=hv.farmer_id WHERE hv.status='checked' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function confirmHarvest($id) {
		$sql="UPDATE harvest SET status='checked' WHERE harvest_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}
	
	public function cancelHarvest($id) {
		$sql="UPDATE harvest SET status='unchecked' WHERE harvest_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	// Announcement
	public function addAnnouncement($title, $text) {
		$sql= "INSERT INTO `announcement`(`ann_title`, `announcement`) VALUES ('$title', '$text')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;

	}

	public function updateAnnouncement($id, $title, $text){
		$sql="UPDATE announcement SET ann_title='$title', announcement='$text' WHERE ann_id='$id'";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function checkAnnDuplicx($title, $text) {
		$sql="SELECT COUNT(*) FROM `announcement` WHERE ann_title='$title' AND announcement='$text'";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function viewAnnouncement($id) {
		$sql= "SELECT * FROM announcement WHERE ann_id='$id' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewAnnouncements() {
		$sql= "SELECT * FROM announcement ORDER BY ann_id DESC";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function deleteAnnouncement($id) {
		$sql="DELETE FROM announcement WHERE ann_id='$id' ";
		$query = $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}


	// LIMITATIONS::
	public function viewLimitations() {
		$sql= "SELECT * FROM limitation ORDER BY item_id ASC";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}


	public function viewLimitation($id) {
		$sql= "SELECT * FROM limitation WHERE item_id='$id'";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function updateLimitations($id, $seed_id, $fert_id, $pest_id){
		$sql="UPDATE limitation SET q_seeds='$seed_id', q_fertilizer='$fert_id', q_pesticide='$pest_id' WHERE item_id='$id'";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}



}
?>
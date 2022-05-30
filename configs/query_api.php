<?php
require_once('connection.php');

class ApiQuery extends DBConnection {
	
	/*****************************************
	 * READY-MADE/SIMPLIFIED API FOR SH**
	 * DEVELEPED AT DONNEKT (FRAMEWORK)
	 * COPYRIGHT @DONNEKT 2021 NOVERMBER
	 * ***************************************/

	public function __construct() {
		$obj = new DBConnection;
		$this->conLink= $obj->connect();
	}

	public function registerFarmer($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $are, $pro, $dst, $sct, $cll, $vlg) {
		$sql= "INSERT INTO `farmer`(`firstname`, `lastname`, `gender`, `dob`, `national_id`, `telephone`, `password`, `land_area`, `province`, `district`, `sector`, `cell`, `village`) VALUES ('$fnm', '$lnm', '$gdr', '$dob', '$nid', '$tel', '$pwd', '$are', '$pro', '$dst', '$sct', '$cll', '$vlg')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function updateFarmer($id, $fnm, $lnm, $tel, $nid, $pwd, $are) {
		$sql="UPDATE farmer SET firstname='$fnm', lastname='$lnm', land_area='$are', national_id='$nid', telephone='$tel', password='$pwd' WHERE farmer_id='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;			
	}

	public function checkFarmerLogin($tel, $pass) {
		$sql = "SELECT COUNT(*) FROM `farmer` WHERE telephone='$tel' AND password='$pass' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function isLoginAllowed($tel) {
		$sql = "SELECT COUNT(*) FROM `farmer` WHERE telephone='$tel' AND status='active' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
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
	 * DEVELEPED AT DONNEKT (FRAMEWORK)
	 * COPYRIGHT @DONNEKT NOV.2021 donnekt.com
	 * *****************************************/

	public function farmerRequest($farm_id, $seed_id, $seed_qt, $fert_id, $fert_qt, $pest_id, $pest_qt, $seas_yr, $seas_tm, $py_status) {
		$sql= "INSERT INTO `requests`(`farmer_id`, `seed_id`, `seed_qty`, `fert_id`, `fert_qty`, `pest_id`, `pest_qty`, `season_year`, `season_term`, `is_paid`) VALUES ('$farm_id', '$seed_id', '$seed_qt', '$fert_id', '$fert_qt', '$pest_id', '$pest_qt', '$seas_yr', '$seas_tm', '$py_status')";
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



	// Harvest
	public function registerHarvest($farmer, $type, $quantity, $price, $s_year, $s_term) {
		$sql= "INSERT INTO `harvest`(`farmer_id`, `item_type`, `quantity`, `harvest_price`, `season_year`, `season_term`) VALUES ('$farmer', '$type', '$quantity', '$price', '$s_year', '$s_term')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	// Update
	public function updateHarvest($id, $type, $quantity, $price, $s_year, $s_term) {
		$sql= "UPDATE `harvest` SET `item_type`='$type', `quantity`='$quantity', `harvest_price`='$price', `season_year`='$s_year', `season_term`='$s_term' WHERE `harvest_id`='$id' ";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

	public function checkHarvestDuplicats($farm_id, $name) {
		$sql = "SELECT COUNT(*) FROM `harvest` WHERE farmer_id='$farm_id' AND item_type='$name' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function viewHarvests() {
		$sql= "SELECT hv.harvest_id, fm.farmer_id, fm.firstname, fm.lastname, fm.telephone, hv.item_type, hv.quantity, hv.harvest_price, hv.season_year, hv.season_term, hv.status, hv.created_at AS hv_date FROM `harvest` hv LEFT JOIN farmer fm ON fm.farmer_id=hv.farmer_id ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewHarvestsByFarmer($id) {
		$sql= "SELECT hv.harvest_id, fm.farmer_id, fm.firstname, fm.lastname, fm.telephone, hv.item_type, hv.quantity, hv.harvest_price, hv.season_year, hv.season_term, hv.status, hv.created_at AS hv_date FROM `harvest` hv LEFT JOIN farmer fm ON fm.farmer_id=hv.farmer_id WHERE fm.farmer_id='$id' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function countHarvests() {
		$sql = "SELECT COUNT(*) FROM harvest ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countHarvestsByFarmer($id) {
		$sql = "SELECT COUNT(*) FROM harvest WHERE farmer_id='$id'";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}


	// View & Counts
	public function viewSeeds() {
		$sql= "SELECT * FROM seeds";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewFertilizers() {
		$sql= "SELECT * FROM fertilizer";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function viewPesticides() {
		$sql= "SELECT * FROM pesticide";
		$stmt=$this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	// *******************

	public function countFertilizers() {
		$sql = "SELECT COUNT(*) FROM fertilizer ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countPesticides() {
		$sql = "SELECT COUNT(*) FROM pesticide ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function countSeeds() {
		$sql = "SELECT COUNT(*) FROM seeds ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}



	// PAYMENT
    public function get_single_order($id){
        $query= $this->con->prepare("SELECT * FROM api_payment WHERE card_id=? ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update_payments($price, $payment_id, $reference, $message) {
        $sql = "UPDATE api_paymnet SET status='Success', reference='$reference' WHERE payment_id='".$payment_id."' ";
        $query= $this->con->prepare($sql);
        $query->execute();
        $count= $query->rowCount();
        return $count;
    }

    public function delete_old_payment($order_id){
        try {
            $query = $this->con->prepare("DELETE FROM momopay WHERE order_id = ?");
            $query->execute([$order_id]);
        } catch (\Exception $e){
            throw new Exception($e->getMessage(), 1);
        }
        return true;
    }

    public function view_orders() {
        $query= $this->con->prepare("SELECT * FROM all_orders ");
        $query->execute();
        return $query;
    }

    public function get_payment($id){
        $query= $this->con->prepare("SELECT * FROM api_payment WHERE payment_id=? ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update_payment($id, $status){
        try{
            $query = $this->con->prepare("UPDATE api_payment SET status = ? WHERE payment_id = ?");
            $query->execute([$status, $id]);
        } catch(\Exception $e){
            throw new Exception($e->getMessage(), 1);
            
        }
        return true;
    }










    // Query Limitations:
    public function countLimitation($area) {
		$sql = "SELECT COUNT(*) FROM `limitation` WHERE land_area<='$area' ORDER BY item_id ASC LIMIT 1";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function getLimitationStats($area) {
		$sql = "SELECT * FROM `limitation` WHERE land_area<='$area' ORDER BY item_id ASC LIMIT 1 ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}


	// ORDER

	public function viewRequest($req) {
		$sql="SELECT rq.req_id, rq.farmer_id, fm.telephone, fm.land_area, fm.national_id, fm.firstname, fm.lastname, rq.seed_id, sd.item_name AS s_name, rq.seed_qty, sd.unit_price AS s_price, rq.fert_id, ft.item_name AS f_name, rq.fert_qty, ft.unit_price AS f_price, rq.pest_id, ps.item_name AS p_name, rq.pest_qty, ps.unit_price AS p_price, rq.season_year, rq.season_term, rq.req_status, rq.is_paid, rq.req_date FROM requests rq JOIN farmer fm ON fm.farmer_id = rq.farmer_id JOIN fertilizer ft ON ft.item_id = rq.fert_id JOIN pesticide ps ON ps.item_id = rq.pest_id JOIN seeds sd ON sd.item_id = rq.seed_id WHERE rq.req_id='$req' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}


	public function viewRequestByFarmer($id) {
		$sql="SELECT rq.req_id, rq.farmer_id, fm.telephone, fm.land_area, fm.national_id, fm.firstname, fm.lastname, rq.seed_id, sd.item_name AS s_name, rq.seed_qty, sd.unit_price AS s_price, rq.fert_id, ft.item_name AS f_name, rq.fert_qty, ft.unit_price AS f_price, rq.pest_id, ps.item_name AS p_name, rq.pest_qty, ps.unit_price AS p_price, rq.season_year, rq.season_term, rq.req_status, rq.is_paid, rq.req_date FROM requests rq JOIN farmer fm ON fm.farmer_id = rq.farmer_id JOIN fertilizer ft ON ft.item_id = rq.fert_id JOIN pesticide ps ON ps.item_id = rq.pest_id JOIN seeds sd ON sd.item_id = rq.seed_id WHERE rq.farmer_id='$id' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

    public function countRequestByFarmer($id) {
		$sql = "SELECT COUNT(*) FROM requests rq JOIN farmer fm ON fm.farmer_id = rq.farmer_id JOIN fertilizer ft ON ft.item_id = rq.fert_id JOIN pesticide ps ON ps.item_id = rq.pest_id JOIN seeds sd ON sd.item_id = rq.seed_id WHERE rq.farmer_id='$id' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}




    public function countOrderByReq($id) {
		$sql= "SELECT COUNT(*) FROM `orders` WHERE req_id='$id' ";
		$stmt= $this->conLink->query($sql)->fetchColumn();
		return $stmt;
	}

	public function viewOrderDetails($req) {
		$sql="SELECT * FROM orders WHERE req_id='$req' ";
		$stmt= $this->conLink->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

	public function saveOrderByReq($req_id, $status, $telno, $amount, $ref) {
		$sql= "INSERT INTO `orders`(`req_id`, `order_status`, `paid_telno`, `amount`, `reference`) VALUES ('$req_id', '$status', '$telno', '$amount', '$ref')";
		$query= $this->conLink->prepare($sql);
		$query->execute();
		$count= $query->rowCount();
		return $count;
	}

}
?>
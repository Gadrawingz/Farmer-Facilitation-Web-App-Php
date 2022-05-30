<?php
include('configs/functions.php');
$func = new Functions;

include('configs/query_api.php');
$object = new ApiQuery;


/*include('config1/functions.php');
$func = new Functions;

include('config1/query_api.php');
$object = new ApiQuery;*/

// Registration
if(isset($_GET['action']) && $_GET['action']=='register') {
    $response = array();

    if($_SERVER['REQUEST_METHOD']=='POST') {
        $fnm = $_POST['firstname'];
        $lnm = $_POST['lastname'];
        $gdr = $_POST['gender'];
        $dob = $_POST['dob'];
        $nid = $_POST['national_id'];
        $tel = $_POST['telephone'];
        $pwd = $_POST['password'];
        $are = $_POST['land_area'];
        $pro = strtoupper($_POST['province']);
        $dst = strtoupper($_POST['district']);
        $sct = strtoupper($_POST['sector']);
        $cll = strtoupper($_POST['cell']);
        $vlg = strtoupper($_POST['village']);
 
        if($object->checkFarmerExistence($tel, $nid)==0){
            if($fnm!='' && $lnm!='' && $gdr!='' && $dob!='' && $nid!='' && $tel!='' && $pwd!='' && $dst!='' && $pro!='' && $sct!='' && $cll!='' && $vlg!='' && $are!=''){

                if($object->registerFarmer($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $are, $pro, $dst, $sct, $cll, $vlg)=='1') {
                    $response['success'] = true;
                    $response['message'] = "You (".$fnm.") are registered!";
                    echo json_encode($response);
                } else {
                    $response['success'] = false;
                    $response['message'] = "Cannot perform registration!";
                    echo json_encode($response);
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Some fields are empty";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Sorry, Number or National ID was used before!";
            echo json_encode($response);
        }
    }
}


// Registration
if(isset($_GET['action']) && $_GET['action']=='login') {
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST') {

        $response = array();
        $tel = $_POST['telephone'];
        $pas = $_POST['password'];

        if(!empty($tel) || !empty($pas)) {
            if($object->checkFarmerLogin($tel, $pas) > 0) {
                if($object->isLoginAllowed($tel) != 0) {
                    $stmt= $object->farmerLogin($tel, $pas);
                    $row = $stmt->FETCH(PDO::FETCH_ASSOC);

                    $response['success'] = true;
                    $response['status'] = "ok";
                    $response['message'] = "Login successful!";
                    $response['details'][] = $row;
                    echo json_encode($response);
                } else {
                    $response['success'] = false;
                    $response['error'] = true;
                    $response['message'] = "Your account is not verified to login!";
                    echo json_encode($response);   
                }
            } else {
                $response['success'] = false;
                $response['error'] = true;
                $response['message'] = "Invalid email or password. Try again!";
                echo json_encode($response);
            }
        } else {
            $response['success'] = "0";
            $response['message'] = "Some fields are empty, Try again!";
            echo json_encode($response);
            die();
        }
    } else {
        echo "Server error!";
    }
}


if(isset($_GET['viewfarmer'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {    
        $id = $_GET['viewfarmer'];
        
        if($object->countFarmer($id) > 0) {
            $stmt = $object->viewFarmer($id);
            $row = $stmt->FETCH(PDO::FETCH_ASSOC);
            $response["farmer"][] = $row;
            $response['status'] = "fetched";
            $response["counts"] = $object->countFarmer($id);
            echo json_encode($response);
        } else {
            $response['status'] = "failed";
            $response["counts"] = $object->countFarmer($id);
            $response['message'] = "No farmer associated with ".$id."!";
            echo json_encode($response);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Server error!";
        echo json_encode($response);
    }
}




if(isset($_GET['deletefarmer'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {    
        $id = $_GET['deletefarmer'];
        
        if($id!='' && ($object->countFarmer($id)>0)){
            if($object->deleteFarmer($id)==1){
                $object->deleteFarmer($id);
                $response['success'] = true;
                $response["message"] = "Deleted successfully!";
                echo json_encode($response);
            } else {
                $response['success'] = false;
                $response["message"] = "You cannot delete this record!";
                echo json_encode($response);                
            }
        } else {
            $response['success'] = false;
            $response["message"] = "Failed to delete!";
            echo json_encode($response);
        }
    } else {
        echo "Server error!";
    }
}



if(isset($_GET['updatemain'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {
        $id = $_GET['updatemain'];   
        $fnm = $_POST['firstname'];
        $lnm = $_POST['lastname'];
        $gdr = $_POST['gender'];
        $dob = $_POST['dob'];
        $nid = $_POST['national_id'];
        $tel = $_POST['telephone'];

        if($fnm!='' && $lnm!='' && $gdr!='' && $dob!='' && $nid!='' && $tel!=''){
            if($object->checkFarmerExistence($tel, $nid)<=0) {
                $object->editFarmerMain($id, $fnm, $lnm, $gdr, $dob, $nid, $tel);
                $response["message"] = "Update is successful";
                echo json_encode($response);
            } else {
                $response['success'] = false;
                $response["message"] = "Phone or NID have been used!";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response["message"] = "These fields cannot be empty!";
            echo json_encode($response);
        }
    } else {
        $response['success'] = false;
        $response["message"] = "Server error!";
        echo json_encode($response);
    }
}



if(isset($_GET['updateaddress'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {
        $id = $_GET['updateaddress'];   
        $dst = $_POST['district'];
        $sct = $_POST['sector'];
        $cll = $_POST['cell'];
        $vlg = $_POST['village'];

        if($dst!='' && $sct!='' && $cll!='' && $vlg!=''){
            if($object->checkFarmerExistence($tel, $nid)==0) {
                editFarmerAddress($id, $dst, $sct, $cll, $vlg); 
                $response["message"] = "Update is successful";
                echo json_encode($response);
            } else {
                $response['success'] = false;
                $response["message"] = "Phone or NID have been used!";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response["message"] = "These fields cannot be empty!";
            echo json_encode($response);
        }
    } else {
        $response['success'] = false;
        $response["message"] = "Server error!";
        echo json_encode($response);
    }
}


if((isset($_GET['action']) && $_GET['action']=='update') && isset($_GET['upd_farmer'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {
        $id = $_GET['upd_farmer'];

        $fnm = $_POST['firstname'];
        $lnm = $_POST['lastname'];
        $tel = $_POST['telephone'];
        $nid = $_POST['national_id'];
        $pwd = $_POST['password'];
        $are = $_POST['land_area'];

        if($object->checkFarmerExistence($tel, $nid)<=1){

            if($fnm!='' && $lnm!='' && $nid!='' && $tel!='' && $pwd!='' && $are!=''){
                if($object->updateFarmer($id, $fnm, $lnm, $tel, $nid, $pwd, $are)=='1') {
                    $response['success'] = true;
                    $response['message'] = "Farmer (".$fnm.") is updated!";
                    echo json_encode($response);
                } else {
                    $response['success'] = false;
                    $response['message'] = "Cannot update!";
                    echo json_encode($response);
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, Some fields are empty";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Farmer details does exist!";
            echo json_encode($response);
        }
    }
}


/********************************************
* READY-MADE/SIMPLIFIED API FOR PHP APPS
* DEVELEPED AT DONNEKT/GADRAWINGZ (FRAMEWORK)
* COPYRIGHT @DONNEKT NOV.2021 donnekt.com
* ******************************************/


// Registration
if(isset($_GET['action']) && $_GET['action']=='frequest') {
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $pstatus = $_POST['is_paid'];
        $farm_id = $_POST['farmer_id'];
        $seed_id = $_POST['seed_id'];
        $seed_qt = $_POST['seed_qty'];
        $fert_id = $_POST['fert_id'];
        $fert_qt = $_POST['fert_qty'];
        $pest_id = $_POST['pest_id'];
        $pest_qt = $_POST['pest_qty'];
        $seas_yr = $_POST['season_year'];
        $seas_tm = $_POST['season_term'];

        if($object->checkReqForMaking($farm_id, $seed_id, $fert_id, $pest_id, $seas_yr, $seas_tm)==0){
            if($pstatus!='' && $farm_id!='' && $seed_id!='' && $seed_qt!='' && $fert_id!='' && $fert_qt!='' && $pest_id!='' && $pest_qt!='' && $seas_yr!='' && $seas_tm!=''){

                if($object->farmerRequest($farm_id, $seed_id, $seed_qt, $fert_id, $fert_qt, $pest_id, $pest_qt, $seas_yr, $seas_tm, $pstatus)=='1') {
                    $response['success'] = true;
                    $response['message'] = "Request has been sent!";
                    // After that we gon deal with order requests
                    echo "<script>window.location='configs/init_payment?req_id=$farm_id'</script>";
                    echo json_encode($response);
                } else {
                    $response['success'] = false;
                    $response['message'] = "Request cannot be made!";
                    echo json_encode($response);
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, Some fields are empty";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "This request has been already made!";
            echo json_encode($response);
        }
    }
}


// Registration
if(isset($_GET['action']) && $_GET['action']=='kick_order') {
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $request_id = $_POST['req_id'];
        $paid_amount = $_POST['paid_amount'];
        $paid_telno = $_POST['paid_telno'];

        if($object->countOrderByReq($request_id)==0){
            if($request_id!='' && $paid_amount!='' && $paid_telno!=''){

                $stmt= $object->viewRequest($request_id);
                $result= $stmt->FETCH(PDO::FETCH_ASSOC);
                $farmer_id = $result['farmer_id'];
                $momo_phone = $paid_telno;

                if(empty($request_id)) {
                    $response['success'] = false;
                    $response['message'] = "No request to be paid!";
                    echo json_encode($response);
                } if(empty($momo_phone)) {
                    $response['success'] = false;
                    $response['message'] = "Please Provide phone number!";
                    echo json_encode($response);
                } if(!preg_match("/^07[2,3,8]{1}\d{7}$/", $momo_phone) ){
                    $response['success'] = false;
                    $response['message'] = "Invalid Phone Number!";
                    echo json_encode($response);
                }
                $file = "configs/payment.ini";
                if(!$settings = @parse_ini_file( dirname(__FILE__).'/'.$file, TRUE)){
                    $response['success'] = false;
                    $response['message'] = 'Unable to open '. dirname(__FILE__).'/'.$file.'.';
                    echo json_encode($response);
                    // throw new exception();
                } if($request_id) {
                    $reference = substr($momo_phone, -7).mt_rand(100, 999);
                    $data = array(
                        "api_key" => $settings['payment']['api_key'],
                        "api_secret" => $settings['payment']['api_secret'],
                        "amount" => $settings['payment']['default_price'],
                        "phone_number" => "250" . substr($momo_phone, -9),
                        "reference" => $reference,
                    );

                    $url = $settings['payment']['end_point'];
                    $data = http_build_query($data);
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch,CURLOPT_POST,true);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
                    $result = curl_exec($ch);
                    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    curl_close($ch);
                    $response = json_decode($result);

                    if($httpcode == 200 && is_object($response)){
                        if(!$response->success) {
                            $response['success'] = false;
                            $response['message'] = $response->message;
                            echo json_encode($response);
                        } else {
                            /*$object->saveOrderByReq(
                                $request_id, 
                                $response->message,
                                $paid_telno, 
                                $paid_amount,
                                $response->reference
                            );*/
                        } if($data) {
                            $object->saveOrderByReq(
                                $request_id, 
                                $response->message,
                                $paid_telno, 
                                $paid_amount,
                                $response->reference
                            );
                            echo json_encode([
                                "success" => true,
                                "message" => "If Prompt is not appearing on phone, Dial *182*7*1#" 
                            ]);
                        } else {
                            $response['success'] = false;
                            $response['message'] = "Momo action is done!";
                            echo json_encode($response);
                        }
                    }
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Sorry, Some fields are empty";
                echo json_encode($response);
            } // End Shit about MM
        } else {
            $response['success'] = false;
            $response['message'] = "Order has been set already!";
            echo json_encode($response);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid Request found";
        echo json_encode($response);
    }
}



// Request by farmer in order to finalize order
if((isset($_GET['action']) && $_GET['action']=='view') && isset($_GET['req_farmer'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {    
        $id = $_GET['req_farmer'];
        if($object->countRequestByFarmer($id) > 0) {
            $stmt = $object->viewRequestByFarmer($id);
            $row = $stmt->FETCH(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response["farmer_req"][] = $row;
            $response['status'] = "fetched";
            $response["counts"] = $object->countRequestByFarmer($id);
            echo json_encode($response);
        } else {
            $response['success'] = false;
            $response["counts"] = $object->countRequestByFarmer($id);
            $response['status'] = "unfetched";
            $response['message'] = "No data with ".$id." id found!";
            echo json_encode($response);
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Server error!";
        echo json_encode($response);
    }
}



// Register harvest
if(isset($_GET['action']) && $_GET['action']=='reg_harvest') {
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST') {

        $farmer = $_POST['farmer_id'];
        $type = $_POST['item_type'];
        $quantity = $_POST['quantity'];
        $price = $_POST['harvest_price'];
        $s_year = $_POST['season_year'];
        $s_term = $_POST['season_term'];
 
        if($object->checkHarvestDuplicats($farmer, $type)==0 || $object->checkHarvestDuplicats($farmer, $type)!=0){
            if($farmer!='' && $type!='' && $quantity!='' && $price!='' && $s_year!=''){
                if($object->registerHarvest($farmer, $type, $quantity, $price, $s_year, $s_term)=='1') {
                    $response['success'] = true;
                    $response['message'] = "(".$type.") is registered!";
                    echo json_encode($response);
                } else {
                    $response['success'] = false;
                    $response['message'] = "Cannot perform registration!";
                    echo json_encode($response);
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Some fields are empty";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Sorry, There is duplication!";
            echo json_encode($response);
        }
    }
}


// SEED, FERTILIZER, PESTICIDE
if(isset($_GET['action']) && $_GET['action']=='view_seeds') {
    if($object->countSeeds() > 0) {
        $stmt = $object->viewSeeds();

        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countSeeds();
            $response["seeds"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countSeeds();
        $response['message'] = "No seeds found!";
        echo json_encode($response);
    }
}


if(isset($_GET['action']) && $_GET['action']=='view_pesticides') {

    if($object->countPesticides() > 0) {
        $stmt = $object->viewPesticides();

        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countPesticides();
            $response["pesticides"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countPesticides();
        $response['message'] = "No pesticides found!";
        echo json_encode($response);
    }
}


if(isset($_GET['action']) && $_GET['action']=='view_fertilizers') {
        
    if($object->countFertilizers() > 0) {
        $stmt = $object->viewFertilizers();

        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countFertilizers();
            $response["fertilizers"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countFertilizers();
        $response['message'] = "No fertilizers found!";
        echo json_encode($response);
    }
}


if(isset($_GET['action']) && $_GET['action']=='view_harvest') {
        
    if($object->countHarvests() > 0) {
        $stmt = $object->viewHarvests();

        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countHarvests();
            $response["harvests"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countHarvests();
        $response['message'] = "No harvests found!";
        echo json_encode($response);
    }
}


if((isset($_GET['action']) && $_GET['action']=='view') && isset($_GET['hv_farmer'])) {
    $farmer = $_GET['hv_farmer'];
    if($object->countHarvestsByFarmer($farmer) > 0) {
        $stmt = $object->viewHarvestsByFarmer($farmer);

        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countHarvestsByFarmer($farmer);
            $response["harvests"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countHarvestsByFarmer($farmer);
        $response['message'] = "No harvests found!";
        echo json_encode($response);
    }
}


if((isset($_GET['action']) && $_GET['action']=='update') && isset($_GET['upd_harvest'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {
        $id = $_GET['upd_harvest'];

        $type = $_POST['item_type'];
        $quantity = $_POST['quantity'];
        $price = $_POST['harvest_price'];
        $s_year = $_POST['season_year'];
        $s_term = $_POST['season_term'];

        if($id!='' && $type!='' && $quantity!='' && $price!='' && $s_year!=''){
            if($object->updateHarvest($id, $type, $quantity, $price, $s_year, $s_term)=='1') {
                $response['success'] = true;
                $response['message'] = "(".$type.") is updated!";
                echo json_encode($response);
            } else {
                $response['success'] = false;
                $response['message'] = "Cannot update!";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Some fields are empty";
            echo json_encode($response);
        }
    }
}



if(isset($_GET['action']) && $_GET['action']=='test_view') {
        
    if($object->countFertilizers() > 0) {
        $stmt = $object->viewFertilizers();

        //$response = array();
        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            //$response['success'] = true;
            //$response['status'] = "fetched";
            //$response["counts"] = $object->countFertilizers();
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response["counts"] = $object->countFertilizers();
        $response['message'] = "No fertilizers found!";
        echo json_encode($response);
    }
}


if(isset($_GET['limitation']) && $_GET['land_area']!='') {
    $response = array();
        
    if($object->countLimitation($_GET['land_area']) > 0) {
        $stmt = $object->getLimitationStats($_GET['land_area']);
        while($row = $stmt->FETCH(PDO::FETCH_ASSOC)) {
            $response['success'] = true;
            $response['status'] = "fetched";
            $response["counts"] = $object->countLimitation($_GET['land_area']);
            $response["limitations"][] = $row;
        }
        echo json_encode($response);
    } else {
        $response['status'] = "failed";
        $response['counts'] = $object->countLimitation($_GET['land_area']);
        $response['message'] = "Short Land area";
        $response['limitations'][] = array('land_area' => $object->countLimitation($_GET['land_area']), 'q_seeds' => '20', 'q_fertilizer'=>'10', 'q_pesticide'=>'15');
        echo json_encode($response);
    }
}


?>
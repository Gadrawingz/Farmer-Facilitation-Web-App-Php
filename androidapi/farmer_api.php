<?php
include('../configs/functions.php');
$func = new Functions;

include('../configs/query_api.php');
$object = new ApiQuery;

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
        $dst = $_POST['district'];
        $sct = $_POST['sector'];
        $cll = $_POST['cell'];
        $vlg = $_POST['village'];
 
        if($object->checkFarmerExistence($tel, $nid)==0){
            if($fnm!='' && $lnm!='' && $gdr!='' && $dob!='' && $nid!='' && $tel!='' && $pwd!='' && $dst!='' && $sct!='' && $cll!='' && $vlg!=''){

                if($object->registerFarmer($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $dst, $sct, $cll, $vlg)=='1') {
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



if(isset($_GET['viewfarmer'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {    
        $id = $_GET['viewfarmer'];
        
        if($object->countFarmer($id) > 0) {
            $stmt = $object->viewFarmer($id);
            $row = $stmt->FETCH(PDO::FETCH_ASSOC);
            $response["farmer"][] = $row;
            $response['status'] = "fetched";
            $response["counts"] = $object->countStudent($id);
            echo json_encode($response);
        } else {
            $response['status'] = "failed";
            $response["counts"] = $object->countStudent($id);
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
        $id = $_GET['deletestud'];
        
        if($id!='' && ($object->countStudent($id)>0)){
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
            if($object->checkFarmerExistence($tel, $nid)==0) {
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

/********************************************
* READY-MADE/SIMPLIFIED API FOR PHP APPS
* DEVELEPED AT DONNEKT/GADRAWINGZ (FRAMEWORK)
* COPYRIGHT @DONNEKT NOV.2021 donnekt.com
* ******************************************/


// Registration
if(isset($_GET['action']) && $_GET['action']=='frequest') {
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST') {
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
            if($farm_id!='' && $seed_id!='' && $seed_qt!='' && $fert_id!='' && $fert_qt!='' && $pest_id!='' && $pest_qt!='' && $seas_yr!='' && $seas_tm!=''){

                if($object->farmerRequest($farm_id, $seed_id, $seed_qt, $fert_id, $fert_qt, $pest_id, $pest_qt, $seas_yr, $seas_tm)=='1') {
                    $response['success'] = true;
                    $response['message'] = "Request has been sent!";
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


?>
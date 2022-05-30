<?php
include('configs/query.php');
$object = new Query;

if(isset($_GET['call'])) {

    switch($_GET['call']){
        
        case 'reg_admin':
        $response = array();
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['telephone'];
            $password = $_POST['password'];

            if(!$object->checkAdminExistence($email, $phone)){
                if($fname!='' && $lname!='' && $gender!='' && $email!='' && $phone!='' && $password!=''){
                    if($object->registerAdmin($fname, $lname, $gender, $email, $phone, $password)==1) {
                        echo "Admin is registered!";
                        }
                    } else {
                       echo "Some fields are empty!";
                    }
                } else {
                    echo "This admin has been saved already!";
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Server error!";
                echo json_encode($response);
            }
        break;

        // Default shit
        default:
        echo "Invalid operation is called";
    }
}


if(isset($_GET['updatemod'])) {
    $response = array();
    if($_SERVER['REQUEST_METHOD']) {    
        $id = $_GET['updatemod'];
        $name = $_POST['module_name'];
        $code = $_POST['module_code'];
        $lect_id = $_POST['lecturer_id'];

        if($name!='' && $code!='' && $lect_id!=''){
            if($id!='' && ($object->countModule($id)>0) && $object->checkModuleExistence($code)==0){
                $object->updateModule($id, $name, $code, $lect_id);
                $response['success'] = true;
                $response["message"] = "Updation is successful";
                echo json_encode($response);
            } else {
                $response['success'] = false;
                $response["message"] = "Id to update is not found!";
                echo json_encode($response);
            }
        } else {
            $response['success'] = false;
            $response["message"] = "Failed to update!";
            echo json_encode($response);
        }
    } else {
        echo "Server error!";
    }
}


?>
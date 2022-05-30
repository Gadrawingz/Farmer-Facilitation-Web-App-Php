        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');

        $criteria = "PEST";
        $main_item= "pesticide";
        // @Gadrawingz
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <?php
            if(isset($_GET['conf']) && isset($_GET['f_id'])) { 
              
              if($query->confirmFRequest($_GET['conf'])) {
                $stmt2= $query->viewRequest($_GET['conf']);
                $res2= $stmt2->FETCH(PDO::FETCH_ASSOC);

                $pest_total = $res2['pest_qty'] * $res2['p_price'];
                $fert_total = $res2['fert_qty'] * $res2['f_price'];
                $seed_total = $res2['seed_qty'] * $res2['s_price'];
                $grand_total = ($pest_total + $fert_total + $seed_total);

                $pest_data = $res2['p_name'].": ".$res2['pest_qty'].": ".$pest_total." rwf";
                $fert_data = $res2['f_name'].": ".$res2['fert_qty'].": ".$fert_total." rwf";
                $seed_data = $res2['s_name'].": ".$res2['seed_qty'].": ".$seed_total." rwf";

                $names = $res2['firstname']." ".$res2['lastname'];
                $phone = $res2['telephone'];
                $farm_id = $res2['farmer_id'];

                if($res2['is_paid']=='Yes') {
                  $py_info = "Wishyuye na Momo";
                } else {
                  $py_info = "Wafashe Inguzanyo(LOAN)";
                }

                // If Payment order has been made!
                if($api_query->countOrderByReq($_GET['conf'])>0) {
                  $data = array(
                    "sender"=>'KIGALIGAS',
                    "recipients"=>$phone,
                    "message"=>"Ubusabe bwawe (".$names.") bw'ibyo ukenewe bwemejwe, (".$pest_data."), (".$fert_data."), (".$seed_data." ), igiciro cya byose ni (".$grand_total.") rwf, ".$py_info.", Murakoze!");
                  $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
                  $data = http_build_query ($data);
                  $username="benii"; 
                  $password="Ben@1234";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
                  curl_setopt($ch,CURLOPT_POST,true);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                  curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
                  $result = curl_exec($ch);
                  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                  curl_close($ch);
                  echo "<script>alert('PAID REQUEST IS ACCEPTED!')</script>";
                  echo "<script>window.location='?view_conf'</script>";
                } else {
                  echo "<script>alert('REQUEST IS NOT PAID YET')</script>";
                  echo "<script>window.location='?view_conf'</script>";
                }
              } else {
              	echo "<script>alert('FAILED TO ACCEPTED!')</script>";
                echo "<script>window.location='?view_pend'</script>";
              }
            }

            if(isset($_GET['deny'])) { 
              if($query->cancelFRequest($_GET['deny'])) {
                echo "<script>alert('REQUEST IS CANCELLED!')</script>";
                echo "<script>window.location='?view_pend'</script>";
              } else {
              	echo "<script>alert('FAILED TO BE CANCELLED!')</script>";
                echo "<script>window.location='?view_pend'</script>";
              }
            }

            if(isset($_GET['rej']) && isset($_GET['f_id'])) { 
              if($query->rejectRequest($_GET['rej'])) {

              $stmt= $query->viewFarmer($_GET['f_id']);
              $result1= $stmt->FETCH(PDO::FETCH_ASSOC);

              $names = $result1['firstname']." ".$result1['lastname'];
              $phone = $result1['telephone'];

              $data = array(
                "sender"=>'KIGALIGAS',
                "recipients"=>$phone,
                "message"=>"Ibyo mwasabye (".$names.") byanzwe, ku bindi bisobanuro mwahamagara kuri izi numero (".$_SESSION['telephone'].") Murakoze!");
              
              $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
              $data = http_build_query ($data);
              $username="benii"; 
              $password="Ben@1234";
              $ch = curl_init();
              curl_setopt($ch,CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_USERPWD, $username.":".$password);
              curl_setopt($ch,CURLOPT_POST,true);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
              curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
              $result = curl_exec($ch);
              $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
              curl_close($ch);
              echo "<script>alert('REQUEST IS REJECTED!')</script>";
              echo "<script>window.location='?view_pend'</script>";
            } else {
              echo "<script>alert('FAILED TO BE REJECTED!')</script>";
              echo "<script>window.location='?view_pend'</script>";
            }
          }
          ?>


            <?php if(isset($_GET['view_pend'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>View all pending requests</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No. </th>
                          <th> Names </th>
                          <th> Seed </th>
                          <th> Fertilizer </th>
                          <th> Pesticide </th>
                          <th> Request Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewRequestsByStatus('Pnd');
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['s_name']; ?> </td>
                          <td> <?php echo $result['f_name']; ?> </td>
                          <td> <?php echo $result['p_name']; ?> </td>
                          <td> <?php echo $result['req_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?det=<?php echo $result['req_id']; ?>" class="btn btn-sm btn-primary" title="Details">
                                <strong>Details</strong>
                              </a>

                              <a href="?conf=<?php echo $result['req_id']; ?>&f_id=<?php echo $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to accept this Request?')" class="btn btn-sm btn-success" title="Accept">
                                <strong>Accept</strong>
                              </a>

                              <a href="?rej=<?php echo $result['req_id']; ?>&f_id=<?php echo $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to reject this Request?')" class="btn btn-sm btn-danger" title="Reject">
                                <strong>Reject</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_conf" class="btn btn-md btn-primary">View accepted requests</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>






            <?php if(isset($_GET['view_conf'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>View all accepted requests</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No. </th>
                          <th> Names </th>
                          <th> Seed </th>
                          <th> Fertilizer </th>
                          <th> Pesticide </th>
                          <th> Request Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewRequestsByStatus('Acp');
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['s_name']; ?> </td>
                          <td> <?php echo $result['f_name']; ?> </td>
                          <td> <?php echo $result['p_name']; ?> </td>
                          <td> <?php echo $result['req_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?det=<?php echo $result['req_id']; ?>" class="btn btn-primary" title="Details">
                                <strong>Details</strong>
                              </a>

                              <!-- <a href="?deny=<?php // $result['req_id']; ?>&f_id=<?php // $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to cancel this Request?')" class="btn btn-danger" title="Remove">
                                <strong>Cancel</strong>
                              </a> -->
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_pend" class="btn btn-md btn-primary">View pending requests</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>






            <?php if(isset($_GET['view_rej'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>View all rejected requests</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No. </th>
                          <th> Names </th>
                          <th> Seed </th>
                          <th> Fertilizer </th>
                          <th> Pesticide </th>
                          <th> Request Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewRequestsByStatus('Rej');
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['s_name']; ?> </td>
                          <td> <?php echo $result['f_name']; ?> </td>
                          <td> <?php echo $result['p_name']; ?> </td>
                          <td> <?php echo $result['req_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?det=<?php echo $result['req_id']; ?>" class="btn btn-primary" title="Details">
                                <strong>Details</strong>
                              </a>

                              <a href="?conf=<?php echo $result['req_id']; ?>&f_id=<?php echo $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to accept this Request?')" class="btn btn-success" title="Accept">
                                <strong>Accept</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_pend" class="btn btn-md btn-primary">View pending requests</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>



            <?php if(isset($_GET['det'])) {
            $stmt= $query->viewRequest($_GET['det']);
            $res= $stmt->FETCH(PDO::FETCH_ASSOC);
            ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th colspan="3" class="text-center"> <h4><strong>Request by (<?php echo $res['firstname']." ".$res['lastname']; ?>)</strong></h4> </th>
                          <td class="text-right"><a href="?view_pend" class="btn btn-md btn-primary">Exit</a></td>
                        </tr>
                      </thead>

                      <?php
                        $pest_total = $res['pest_qty'] * $res['p_price'];
                        $fert_total = $res['fert_qty'] * $res['f_price'];
                        $seed_total = $res['seed_qty'] * $res['s_price'];
                        $grand_total = $pest_total + $fert_total + $seed_total;
                      ?>

                      <tbody>
                        <tr>
                          <td class="table-info"> <strong>Seed Name</strong> </td>
                          <td class="table-info"> <?php echo $res['s_name']; ?> </td>
                          <td> Quantity <strong>(<?php echo $res['seed_qty']; ?> kgs) / <?php echo $res['s_price']; ?> rwf</strong></strong> </td>
                          <td class="table-info"> Total Price <b>(<?php echo $seed_total; ?> rwf)</b> </td>
                        </tr>

                        <tr>
                          <td class="table-info"> <strong>Fertilizer</strong> </td>
                          <td class="table-info"> <?php echo $res['f_name']; ?> </td>
                          <td> Quantity <strong>(<?php echo $res['fert_qty']; ?> kgs) / <?php echo $res['f_price']; ?> rwf</strong> </td>
                          <td class="table-info"> Total Price <b>(<?php echo$fert_total; ?> rwf)</b> </td>
                        </tr>

                        <tr>
                          <td class="table-info"> <strong>Pesticide</strong> </td>
                          <td class="table-info"> <?php echo $res['p_name']; ?> </td>
                          <td> Quantity <strong>(<?php echo $res['pest_qty']; ?> doses) / <?php echo $res['p_price']; ?> rwf</strong></strong> </td>
                          <td class="table-info"> Unit Price <b>(<?php echo $pest_total; ?> rwf)</b> </td>
                        </tr>
                        <tr><td colspan="4"></td></tr>

                        <tr>
                          <td colspan="2"><strong>Request Status</strong></td>
                          <td class="table-primary"><strong>Total</strong></td>
                          <td class="table-primary"><strong>Payment info</strong></td>
                        </tr>

                        <tr>
                          <td colspan="2" class="text-success"><b><?php echo $res['req_status']; ?></b></td>
                          <td><strong><?php echo $grand_total; ?></strong> rwf</td>
                          <td>
                            <strong>
                              <?php
                              if($res['is_paid']=='Yes') {
                                echo '<mark class="text-primary">(Paid)</mark>';
                                if($api_query->countOrderByReq($res['req_id'])!='0') {
                                  $stmt50= $api_query->viewOrderDetails($res['req_id']);
                                  $result50= $stmt50->FETCH(PDO::FETCH_ASSOC);
                                  echo " // <i>".$result50['order_status']."</i>";
                                }
                              } else {
                                echo '<mark class="text-danger">(Loan)</mark>';
                              }
                              ?>
                            </strong>
                        </td>
                        </tr>

                        <tr><td colspan="4"></td></tr>

                        <tr>
                          <td colspan="2"><strong>Order date</strong></td>
                          <td class="table-success"> <strong>Season Year</strong> </td>
                          <td class="table-success"> <strong>Season Term</strong> </td>
                        </tr>

                        <tr>
                          <td colspan="2"><?php echo $res['req_date']; ?></td>
                          <td> <?php echo $res['season_year']; ?> </td>
                          <td> <?php echo $res['season_term']; ?> </td>
                        </tr>
                        
                      </tbody>
                    </table><br>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>










          </div>
          <!-- content-wrapper ends -->

          <?php
          include('../configs/footer.php');
          ?>
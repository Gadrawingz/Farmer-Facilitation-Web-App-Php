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
            if(isset($_GET['conf'])) { 
              if($query->confirmFRequest($_GET['conf'])) {
                echo "<script>alert('REQUEST IS CONFRIMED!')</script>";
                echo "<script>window.location='?view_conf'</script>";
              } else {
              	echo "<script>alert('FAILED TO CONFRIM!')</script>";
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
                      $stmt= $query->viewAllRequests();
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

                              <a href="?conf=<?php echo $result['req_id']; ?>" onclick="return confirm('Are you sure you want to confirm this Request?')" class="btn btn-warning" title="Remove">
                                <strong>Confirm</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_conf" class="btn btn-md btn-primary">View confirmed requests</a>
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
                      $stmt= $query->viewConfRequests();
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

                              <a href="?deny=<?php echo $result['req_id']; ?>" onclick="return confirm('Are you sure you want to cancel this Request?')" class="btn btn-danger" title="Remove">
                                <strong>Cancel</strong>
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
                          <th colspan="6" class="text-center"> <strong>Request by <?php echo $res['firstname']." ".$res['lastname']; ?></strong> on <?php echo $res['req_date']; ?> </th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr class="table-info">
                          <td> <strong>Seed Name</strong> </td>
                          <td> <?php echo $res['s_name']; ?> </td>
                          <td> <strong>Quantity</strong> </td>
                          <td> <?php echo $res['seed_qty']; ?> </td>
                          <td> <strong>Unit Price</strong> </td>
                          <td> <?php echo $res['s_price']; ?> </td>
                        </tr>

                        <tr>
                          <td> <strong>Fertilizer</strong> </td>
                          <td> <?php echo $res['f_name']; ?> </td>
                          <td> <strong>Quantity</strong> </td>
                          <td> <?php echo $res['fert_qty']; ?> </td>
                          <td> <strong>Unit Price</strong> </td>
                          <td> <?php echo $res['f_price']; ?> </td>
                        </tr>

                        <tr class="table-primary">
                          <td> <strong>Pesticide</strong> </td>
                          <td> <?php echo $res['p_name']; ?> </td>
                          <td> <strong>Quantity</strong> </td>
                          <td> <?php echo $res['pest_qty']; ?> </td>
                          <td> <strong>Unit Price</strong> </td>
                          <td> <?php echo $res['p_price']; ?> </td>
                        </tr>

                        <tr>
                          <td colspan="6"></td>
                        </tr>

                        <tr>
                          <td> <strong>Season Year</strong> </td>
                          <td> <?php echo $res['season_year']; ?> </td>
                          <td colspan="2" class="table-secondary text-center"><a href="?view_pend" class="btn btn-md btn-primary">Exit</a></td>
                          <td> <strong>Season Year</strong> </td>
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
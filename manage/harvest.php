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
            if(isset($_GET['check'])) { 
              if($query->confirmHarvest($_GET['check'])) {
                echo "<script>alert('HARVEST IS CHECKED!')</script>";
                echo "<script>window.location='?view_conf'</script>";
              } else {
              	echo "<script>alert('FAILED TO CHECK!')</script>";
                echo "<script>window.location='?view_pend'</script>";
              }
            }

            if(isset($_GET['uncheck'])) { 
              if($query->cancelHarvest($_GET['uncheck'])) {
                echo "<script>alert('HRVEST IS CANCELLED!')</script>";
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
                    <h4><strong>View all received harvests</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No. </th>
                          <th> Names </th>
                          <th> Type </th>
                          <th> Quantity </th>
                          <th> Price </th>
                          <th> Season year </th>
                          <th> Season term </th>
                          <th> Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>
                      <?php
                      $num = 1;
                      $stmt= $query->viewHarvests();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>

                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['item_type']; ?> </td>
                          <td> <?php echo $result['quantity']; ?> </td>
                          <td> <?php echo $result['harvest_price']; ?> </td>
                          <td> <?php echo $result['season_year']; ?> </td>
                          <td> <?php echo $result['season_term']; ?> </td>
                          <td> <?php echo $result['hv_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?check=<?php echo $result['harvest_id']; ?>" onclick="return confirm('Are you sure you want to confirm this Harvest?')" class="btn btn-warning" title="Confirm">
                                <strong>Confirm</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_conf" class="btn btn-md btn-primary">View confirmed harvests</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>





            <?php if(isset($_GET['view_checked'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>View all checked harvests</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No. </th>
                          <th> Names </th>
                          <th> Type </th>
                          <th> Price </th>
                          <th> Season year </th>
                          <th> Season term </th>
                          <th> Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>
                      <?php
                      $num = 1;
                      $stmt= $query->viewCheckedHarvests();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>

                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['item_type']; ?> </td>
                          <td> <?php echo $result['quantity']; ?> </td>
                          <td> <?php echo $result['harvest_price']; ?> </td>
                          <td> <?php echo $result['season_year']; ?> </td>
                          <td> <?php echo $result['season_term']; ?> </td>
                          <td> <?php echo $result['hv_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?uncheck=<?php echo $result['harvest_id']; ?>" onclick="return confirm('Are you sure you want to cancel this Harvest?')" class="btn btn-danger" title="Rejec harvest">
                                <strong>Reject</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?view_checked" class="btn btn-md btn-primary">View checked harvests</a>
                    </p>
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
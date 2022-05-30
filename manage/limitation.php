        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        $page_name= "announcement";
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <?php
            if(isset($_GET['del'])) { 
              if($query->deleteAnnouncement($_GET['del'])) {
                echo "<script>alert('ANNOUNCEMENT IS REMOVED!')</script>";
                echo "<script>window.location='?view_all'</script>";
              }
              echo "<script>alert('THIS ANNOUNCEMENT FAILED TO BE REMOVED!')</script>";
              echo "<script>window.location='?view_all'</script>";
            }?>

            <?php if(isset($_GET['view_all'])) {
            ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2><strong>View all recent <?php echo $page_name."s";?></strong></h2><hr>
                    <?php if(isset($_GET['upd_item']) && isset($_GET['view_all'])) {
                    $stmt= $query->viewLimitation($_GET['upd_item']);
                    $res= $stmt->FETCH(PDO::FETCH_ASSOC);

                    if(isset($_POST['update_btn'])) {
                      if($query->updateLimitations($_GET['upd_item'], $_POST['seeds_qty'], $_POST['fert_qty'], $_POST['pest_qty'])) {
                        echo "<script>alert('ITEM IS UPDATED SUCCESSFULLY!')</script>";
                        echo "<script>window.location='?view_all'</script>";
                      } else {
                        echo "<script>alert('ERROR IN UPDATING!')</script>";
                        echo "<script>window.location='?view_all'</script>";
                      }
                    }
                    ?>
                    <h4>Update Info</h4><hr>
                    <form class="form-sample" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Land Area</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="land_area" value="<?php echo $res['land_area'].' m^2'; ?>" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Seeds Quantity</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="seeds_qty" value="<?php echo $res['q_seeds']; ?>" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Fert.Quantity</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="fert_qty" value="<?php echo $res['q_fertilizer']; ?>" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Pest.Quantity</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="pest_qty" value="<?php echo $res['q_pesticide']; ?>" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" name="update_btn" class="btn btn-success mr-2">Save</button>
                          <button class="btn btn-warning">Cancel</button>
                        </div>
                      </div>
                    </form><br>
                    <?php } ?>


                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> <strong>No </strong></th>
                          <th> <strong>Land area</strong> </th>
                          <th> <strong>Allowed Seeds</strong> </th>
                          <th> <strong>Allowed fertilizers</strong> </th>
                          <th> <strong>Allowed pesticide</strong> </th>
                          <th class="text-center"> <strong>Action</strong> </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewLimitations();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // get all rows
                      ?>
                      <tbody>
                        <tr>
                          <td> <strong><?php echo $num; ?></strong> </td>
                          <td> <?php echo $result['land_area']; ?>m<sup>2</sup> </td>
                          <td> <b><?php echo $result['q_seeds']; ?></b> kgs </td>
                          <td> <b><?php echo $result['q_fertilizer']; ?></b> kgs </td>
                          <td> <i><?php echo $result['q_pesticide']; ?> doses</i> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a href="?view_all&upd_item=<?php echo $result['item_id']; ?>" class="btn btn-primary" title="Update">
                                <i class="mdi mdi-pencil"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table>
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
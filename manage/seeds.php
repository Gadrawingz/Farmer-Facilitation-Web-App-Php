        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');

        $criteria = "SEED";
        $main_item= "seed";
        // @Gadrawingz
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">


            <?php if(isset($_GET['register'])) { ?>
            <div class="row">
              <?php
              if(isset($_POST['save_btn'])) {
                if(!$query->checkDamnItem($_POST['item_name'], $criteria)) {
                  if($query->pushMotherfuckinItem($_POST['item_name'], $_POST['item_type'], $_POST['quantity'], $_POST['unit_price'], $criteria)) {
                    echo "<script>alert('".strtoupper($main_item)." IS SAVED!')</script>";
                    echo "<script>window.location='?register'</script>";
                    // @Gadrawingz
                  } else {
                    echo "<script>alert('ERROR IN SAVING')</script>";
                    echo "<script>window.location='?view_all'</script>";
                  }
                } else {
                  echo "<script>alert('ALREADY REGISTERED!')</script>";
                }
              } ?>
              <div class="col-md-12"><!-- <div class="col-12 grid-margin"> -->
                <div class="card">
                  <div class="card-body">
                    <h3>Add new <?php echo ucfirst($main_item); ?></h3><hr>
                    <form class="form-sample" method="POST">
                      <p class="card-description"> Make sure to fill all required fields to continue </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="item_name" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Type</strong></label>
                            <div class="col-md-9">
                              <select name="item_type" class="form-control" required>
                                <option value="Planting">Planting</option>
                                <option value="Nitrogen">Nitrogen</option>
                                <option value="Calcium">Calcium</option>
                                <option value="Micronutrient">Micronutrient</option>
                                <option value="Weeding">Weeding</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Quantity</strong></label>
                            <div class="col-md-9">
                              <input type="number" name="quantity" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Unit Price</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="unit_price" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" name="save_btn" class="btn btn-success mr-2">Save</button>
                          <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>





            <?php if(isset($_GET['upd_item'])) {
              $stmt= $query->viewDamnItem($_GET['upd_item'], $criteria);
              $res= $stmt->FETCH(PDO::FETCH_ASSOC);
            ?>
            
            <div class="row">
              <?php
              if(isset($_POST['update_btn'])) {
                // @Gadrawingz
                if(!$query->checkDamnItem($_POST['item_name'], $criteria)) {
                  if($query->updateDamnItem($_GET['upd_item'], $_POST['item_name'], $_POST['item_type'], $_POST['quantity'], $_POST['unit_price'], $criteria)) {
                    echo "<script>alert('".strtoupper($main_item)." IS UPDATED!')</script>";
                    echo "<script>window.location='?view_all'</script>";
                  } else {
                    echo "<script>alert('ERROR IN UPDATING!')</script>";
                    echo "<script>window.location='?view_all'</script>";
                  }
                } else {
                  echo "<script>alert('DATA EXISTS IN DATABASE!')</script>";
                }
                // @Gadrawingz
              } ?>
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h3>Update <?php echo ucfirst($main_item); ?></h3><hr>
                    <form class="form-sample" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="item_name" class="form-control" value="<?php echo $res['item_name']; ?>" required/>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Type</strong></label>
                            <div class="col-md-9">
                              <select name="item_type" class="form-control" required>
                                <option value="<?php echo $res['item_type']; ?>"><?php echo $res['item_type']; ?></option>
                                <option value="Planting">Planting</option>
                                <option value="Nitrogen">Nitrogen</option>
                                <option value="Calcium">Calcium</option>
                                <option value="Micronutrient">Micronutrient</option>
                                <option value="Weeding">Weeding</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong><?php echo ucfirst($main_item); ?> Quantity</strong></label>
                            <div class="col-md-9">
                              <input type="number" name="quantity" value="<?php echo $res['quantity'];?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Unit Price</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="unit_price"  value="<?php echo $res['unit_price'];?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" name="update_btn" class="btn btn-success mr-2">Update</button>
                          <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>


            <?php
            if(isset($_GET['del'])) { 
              if($query->deleteDamnItem($_GET['del'], $criteria)) {
                echo "<script>alert('ITEM WITH ".$_GET['del']." IS REMOVED!')</script>";
                echo "<script>window.location='?view_all'</script>";
              }
              echo "<script>alert('ITEM WITH ".$_GET['del']." CANNOT BE REMOVED!')</script>";
              echo "<script>window.location='?view_all'</script>";
            }
            ?>


            <?php if(isset($_GET['view_all'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>View all <?php echo $main_item."s";?></strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No </th>
                          <th> Name </th>
                          <th> Type </th>
                          <th> Unit Price </th>
                          <th> Total Price </th>
                          <th> Reg.Date </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewAllDamnItems($criteria);
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['item_name']; ?> </td>
                          <td> <?php echo $result['item_type']; ?> </td>
                          <td> <?php echo $result['quantity']; ?> </td>
                          <td> <?php echo $result['unit_price']; ?> </td>
                          <td> <?php echo $result['created_at']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a data-toggle="tooltip" data-placement="top" href="?upd_item=<?php echo $result['item_id']; ?>" class="btn btn-primary" title="Update">
                                <i class="mdi mdi-pencil"></i>
                              </a>

                              <a href="?del=<?php echo $result['item_id']; ?>" onclick="return confirm('Are you sure you want to remove this item?')" class="btn btn-danger" title="Remove">
                                <strong>Remove</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><br>
                    <p class="text-center">
                      <a href="?register" class="btn btn-md btn-primary">Add new <?php echo $main_item; ?></a>
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
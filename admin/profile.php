        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <?php
            if(!isset($_GET['upd'])) {

              $stmt= $query->viewAdmin($_SESSION['admin_id']);
              $result= $stmt->FETCH(PDO::FETCH_ASSOC);
            ?>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="bg-dark text-warning text-center" style="padding: 9px!important;">My profile (<?php echo $result['firstname']." ".$result['lastname']; ?>)
                    </h2><hr>

                    <div class="row">
                      <div class="col-md-6 m-t-25">
                        <address class="text-primary">
                          <p class="font-weight-bold"> Firstname </p>
                          <p class="mb-2"> <?php echo $result['firstname']; ?> </p>
                          <p class="font-weight-bold"> Lastname </p>
                          <p> <?php echo $result['lastname']; ?> </p><hr style="background-color: cadetblue; height: 6px;">

                          <p class="font-weight-bold"> Gender </p>
                          <p class="mb-2"> <?php echo $result['gender']; ?> </p>
                          <p class="font-weight-bold"> Wporking status </p>
                          <p class="mb-2"> <?php echo $result['status']; ?> </p>
                        </address>
                      </div>

                      <div class="col-md-6">
                        <address class="text-primary">
                          <p class="font-weight-bold"> Email address</p>
                          <p class="mb-2"> <?php echo $result['email']; ?> </p>
                          <p class="font-weight-bold"> Telephone </p>
                          <p> <?php echo $result['telephone']; ?> </p>
                        </address>
                      </div>
                    </div>
                    <h2 class="bg-dark text-warning text-center" style="padding: 9px!important;">
                      <a href="?upd=<?php echo $result['admin_id']; ?>" class="btn btn-outline-success">Edit profile</a>
                    </h2><hr>
                  </div>

                </div>
              </div>
            </div>
            <?php } ?>

            <?php if(isset($_GET['upd'])) {
              $stmt= $query->viewAdmin($_GET['upd']);
              $result= $stmt->FETCH(PDO::FETCH_ASSOC);
            ?>

            <div class="row">
              <?php
              if(isset($_POST['update_btn'])) {
                if(!$query->checkAdminExistence($_POST['email'], $_POST['telephone']) || $query->checkAdminExistence($_POST['email'], $_POST['telephone'])) {
                  if($query->updateAdmin($_GET['upd'], $_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['email'], $_POST['telephone'], $_POST['password'])) {
                    echo "<script>alert('PROFILE IS UPDATED!')</script>";
                    echo "<script>window.location='profile'</script>";
                  } else {
                    echo "<script>alert('ERROR IN UPDATING!')</script>";
                    echo "<script>window.location='profile'</script>";
                  }
                } else {
                  echo "<script>alert('ALREADY EXIST IN DATABASE!')</script>";
                  echo "<script>window.location='profile'</script>";
                }
              } ?>
              <div class="col-md-12"><!-- <div class="col-12 grid-margin"> -->
                <div class="card">
                  <div class="card-body">
                    <h3>Update profile</h3><hr>
                    <form class="form-sample" method="POST">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>First Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="firstname" value="<?php echo $result['firstname']; ?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Last Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="lastname" value="<?php echo $result['lastname']; ?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Gender</strong></label>
                            <div class="col-md-9">
                              <select name="gender" class="form-control" required>
                              	<option value="<?php echo $result['gender']; ?>"><?php echo $result['gender']; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Email</strong></label>
                            <div class="col-md-9">
                              <input type="email" name="email" value="<?php echo $result['email']; ?>" class="form-control" required />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Tel.Number</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="telephone" value="<?php echo $result['telephone']; ?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Password</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="password" value="<?php echo $result['password']; ?>" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                      	<div class="col-md-6">
                          <button type="submit" name="update_btn" class="btn btn-success mr-2">Update</button>
                          <button type="reset" class="btn btn-warning">Cancel</button>
                        </div>
                      </div>
                    </form>
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
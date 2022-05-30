
        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">


            <?php if(isset($_GET['register'])) { ?>
            <div class="row">
              <div class="col-md-12"><!-- <div class="col-12 grid-margin"> -->
                <div class="card">
                  <div class="card-body">
                    <h3>Register new admin</h3><hr>
                    <div class="cool-text text-primary">
                      <?php
                      if(isset($_POST['save_btn'])) {
                        $data = array(
                          'firstname' => $_POST['firstname'],
                          'lastname' => $_POST['lastname'],
                          'telephone' => $_POST['telephone'],
                          'gender' => $_POST['gender'],
                          'email' => $_POST['email'],
                          'password' => $_POST['password'],
                          'email' => $_POST['email']);

                        echo $func->httpPost("http://localhost/farmer-app/api_transfer?call=reg_admin", $data);
                      }
                      echo ".";
                      ?>
                    </div>
                    <form class="form-sample" method="POST">
                      <p class="card-description"> This is registration for new admin for system </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>First Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="firstname" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Last Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="lastname" class="form-control" required/>
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
                              <input type="email" name="email" class="form-control" required />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Tel.Number</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="telephone" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Password</strong></label>
                            <div class="col-md-9">
                              <input type="password" name="password" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                      	<div class="col-md-6">
                          <button type="submit" name="save_btn" class="btn btn-success mr-2">Save</button>
                          <button type="reset" class="btn btn-warning">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>

            <?php
            if(isset($_GET['disable'])) { 
              $query->disableAdmin($_GET['disable']);
              echo "<script>window.location='?view_all'</script>";
            }

            if(isset($_GET['enable'])) { 
              $query->enableAdmin($_GET['enable']);
              echo "<script>window.location='?view_all'</script>";
            }

            if(isset($_GET['del'])) { 
              $query->deleteAdmin($_GET['del']);
              echo "<script>window.location='?view_all'</script>";
            }

            ?>

            <?php if(isset($_GET['view_all'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4>View all admins</h4>

                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No </th>
                          <th> First name </th>
                          <th> Last name </th>
                          <th> Gender </th>
                          <th> Email </th>
                          <th> Phone </th>
                          <th> Status </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
        
                      $num = 1;
                      $stmt= $query->viewAllAdmins();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      
                      ?>

                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']; ?> </td>
                          <td> <?php echo $result['lastname']; ?> </td>
                          <td> <?php echo $result['gender']; ?> </td>
                          <td> <?php echo $result['email']; ?> </td>
                          <td> <?php echo $result['telephone']; ?> </td>
                          <td> <?php echo ucfirst($result['status']); ?> </td>
                          <td> 
                            <div class="btn-group" role="group">
                              <?php if($result['status']=='active') { ?>
                              <a data-toggle="tooltip" data-placement="top" href="?view_all&disable=<?php echo $result['admin_id']; ?>" class="btn btn-warning" title="Disable">
                                <i class="mdi mdi-account-off"></i>
                              </a>
                              <?php } else if($result['status']=='inactive') { ?>
                              <a data-toggle="tooltip" data-placement="top" href="?view_all&enable=<?php echo $result['admin_id']; ?>" class="btn btn-primary" title="Enable">
                                <i class="mdi mdi-account-check"></i>
                              </a>
                              <?php } ?>

                              <a href="?view_all&del=<?php echo $result['admin_id']; ?>" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" title="Remove">
                                <strong><i class="mdi mdi-lg mdi-trash-can"></i></strong>
                              </a>
                          
                          </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php } $num++; ?>
                    </table><hr>
                    <p class="text-center">
                      <a href="?register" class="btn btn-primary">Register new</a>
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
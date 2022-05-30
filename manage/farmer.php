        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <?php if(isset($_GET['register'])) { ?>
            <div class="row">
              <?php
              if(isset($_POST['save_btn'])) {
                $fnm = $_POST['firstname'];
                $lnm = $_POST['lastname'];
                $gdr = $_POST['gender'];
                $dob = $_POST['dob'];
                $nid = $_POST['national_id'];
                $tel = $_POST['telephone'];
                $are = $_POST['land_area'];
                $pwd = '1234';
                $pro = strtoupper($_POST['province']);
                $dst = strtoupper($_POST['district']);
                $sct = strtoupper($_POST['sector']);
                $cll = strtoupper($_POST['cell']);
                $vlg = strtoupper($_POST['village']);

                if($query->checkFarmerExistenceByAdmin($tel, $nid)==0){
                  if($fnm!='' && $lnm!='' && $gdr!='' && $dob!='' && $nid!='' && $tel!='' && $are!='' &&  $pwd!='' && $pro!='' && $dst!='' && $sct!='' && $cll!='' && $vlg!=''){
                    if($query->registerFarmerByAdmin($fnm, $lnm, $gdr, $dob, $nid, $tel, $pwd, $are, $pro, $dst, $sct, $cll, $vlg)=='1'){
                      echo "<script>alert('FARMER HAS BEEN SAVED!')</script>";
                    } else {
                      echo "<script>alert('Cannot perform registration!!')</script>";
                    }
                  } else {
                    echo "<script>alert('Some fields are empty!')</script>";
                  }
                } else {
                  echo "<script>alert('Sorry, Number or National ID was used before')</script>";
                }
              } ?>
              <div class="col-md-12"><!-- <div class="col-12 grid-margin"> -->
                <div class="card">
                  <div class="card-body">
                    <h3>Register new farmer</h3><hr>
                    <form class="form-sample" method="POST">
                      <p class="card-description text-primary"><strong> Personal info </strong></p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>First Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="firstname" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Last Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="lastname" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Gender</strong></label>
                            <div class="col-md-9">
                              <select class="form-control" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Year of Birth</strong></label>
                            <div class="col-md-9">
                              <input type="number" min="1900" max="3000" class="form-control" name="dob" placeholder="1998" required/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>N.I.D</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" name="national_id" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Tel.Number</strong></label>
                            <div class="col-md-9">
                              <input type="text" name="telephone" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                      <hr><p class="card-description text-primary"><strong> Address </strong></p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Province</label>
                            <div class="col-md-9">
                              <select class="form-control" name="province" required>
                                <option value="East">East</option>
                                <option value="West">West</option>
                                <option value="North">North</option>
                                <option value="South">South</option>
                                <option value="Kigali City">Kigali City</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">District</label>
                            <div class="col-md-9">
                              <input type="text" name="district" class="form-control" required/>
                              <!-- <select class="form-control" name="district" required>
                                <option value="Huye">Huye</option>
                                <option value="Nyanza">Nyanza</option>
                                <option value="Muhanga">Muhanga</option>
                              </select> -->
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sector</label>
                            <div class="col-md-9">
                              <input type="text" name="sector" class="form-control" required/>
                              <!-- <select class="form-control" name="sector" required>
                                <option value="Tumba">Tumba</option>
                                <option value="Rango">Rango</option>
                              </select> -->
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Cell</label>
                            <div class="col-md-9">
                              <input type="text" name="cell" class="form-control" required/>
                              <!-- <select class="form-control" name="cell" required>
                                <option value="Cyarwa">Cyarwa</option>
                                <option value="Gitesanyi">Gitesanyi</option>
                              </select> -->
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Village</label>
                            <div class="col-md-9">
                              <input type="text" name="village" class="form-control" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Land Area</label>
                            <div class="col-md-9">
                              <input type="text" name="land_area" class="form-control" required />
                            </div>
                          </div>
                        </div>
                       
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" name="save_btn" class="btn btn-success mr-2">Save</button>
                          <button class="btn btn-warning">Cancel</button>&nbsp;&nbsp;
                          <a class="btn btn-primary" href="?view_conf">View all farmers</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <?php } ?>



            <!-- @gadrawingz -->



            <?php
            if(isset($_GET['cancel'])) { 
              $query->cancelFarmer($_GET['cancel']);
              echo "<script>window.location='?view_all'</script>";
            }

            if(isset($_GET['conf'])) { 
              $query->confirmFarmer($_GET['conf']);

              $stmt= $query->viewFarmer($_GET['conf']);
              $result1= $stmt->FETCH(PDO::FETCH_ASSOC);

              $names = $result1['firstname']." ".$result1['lastname'];
              $l_area= $result1['land_area'];
              $phone = $result1['telephone'];

              $data = array(
                "sender"=>'KIGALIGAS',
                "recipients"=>$phone,
                "message"=>"Ubusabe bwa konti yawe nka ".$names." uhinga ku buso bwa ".$l_area."(m/area) bwemewe Murakoze!");
              
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

              echo "<script>window.location='?view_conf'</script>";
            }
            ?>

            <?php if(isset($_GET['view_all'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>List of recent farmers</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No </th>
                          <th> Names </th>
                          <th> Gender </th>
                          <th> Date Of Birth </th>
                          <th> Telephone </th>
                          <th> National.ID </th>
                          <th> Status </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewRecentFarmers();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>

                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['gender']; ?> </td>
                          <td> <?php echo $result['dob']; ?> </td>
                          <td> <?php echo $result['telephone']; ?> </td>
                          <td> <?php echo $result['national_id']; ?> </td>
                          <td> <?php echo ucfirst($result['status']); ?> </td>
                          <td> 
                            <div class="btn-group" role="group">
                              <a data-toggle="tooltip" data-placement="top" href="?view_one=<?php echo $result['farmer_id']; ?>" class="btn btn-primary" title="Enable">
                                <i class="mdi mdi-eye"></i>
                              </a>

                              <a href="?view_all&conf=<?php echo $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to confirm?')" class="btn btn-success" title="Confirm">
                                <strong>Confirm</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><hr>
                    <p class="text-center">
                      <a href="?view_conf" class="btn btn-md btn-primary">View confirmed farmers</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>


            <!-- @gadrawingz -->



            <?php if(isset($_GET['view_conf'])) { ?>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4><strong>List of confirmed farmers</strong></h4>
                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> No </th>
                          <th> Names </th>
                          <th> Gender </th>
                          <th> Date Of Birth </th>
                          <th> Telephone </th>
                          <th> National.ID </th>
                          <th> Status </th>
                          <th colspan="2" class="text-center"> Action </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewConfirmedFarmers();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      ?>

                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['firstname']." ".$result['lastname']; ?> </td>
                          <td> <?php echo $result['gender']; ?> </td>
                          <td> <?php echo $result['dob']; ?> </td>
                          <td> <?php echo $result['telephone']; ?> </td>
                          <td> <?php echo $result['national_id']; ?> </td>
                          <td> <?php echo ucfirst($result['status']); ?> </td>
                          <td> 
                            <div class="btn-group" role="group">
                              <a data-toggle="tooltip" data-placement="top" href="?view_one=<?php echo $result['farmer_id']; ?>" class="btn btn-primary" title="View">
                                <i class="mdi mdi-eye"></i>
                              </a>

                              <a href="?view_all&cancel=<?php echo $result['farmer_id']; ?>" onclick="return confirm('Are you sure you want to cancel?')" class="btn btn-danger" title="Cancel">
                                <strong>Cancel</strong>
                              </a>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    <?php $num++; } ?>
                    </table><hr>
                    <p class="text-center">
                      <a href="?view_all" class="btn btn-md btn-primary">View recent farmers</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>



            <!-- @gadrawingz -->



            <?php
            if(isset($_GET['view_one'])) {
              $stmt= $query->viewFarmer($_GET['view_one']);
              $result= $stmt->FETCH(PDO::FETCH_ASSOC);
            ?>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h2 class="">Details of <?php echo $result['firstname']." ".$result['lastname']; ?>
                      <a href="?view_all" class="btn btn-outline-primary">Back</a>
                    </h2><hr>

                    <div class="row">
                      <div class="col-md-6 m-t-25">
                        <address class="text-primary">
                          <p class="font-weight-bold"> Firstname </p>
                          <p class="mb-2"> <?php echo $result['firstname']; ?> </p>
                          <p class="font-weight-bold"> Lastname </p>
                          <p> <?php echo $result['lastname']; ?> </p><hr>

                          <p class="font-weight-bold"> Gender </p>
                          <p class="mb-2"> <?php echo $result['gender']; ?> </p>
                          <p class="font-weight-bold"> Date of Birth </p>
                          <p class="mb-2"> <?php echo $result['dob']; ?> </p>
                        </address>
                      </div>

                      <div class="col-md-6">
                        <address class="text-primary">
                          <p class="font-weight-bold"> National ID </p>
                          <p class="mb-2"> <?php echo $result['national_id']; ?> </p>
                          <p class="font-weight-bold"> Telephone </p>
                          <p> <?php echo $result['telephone']; ?> </p><hr>

                          <p class="font-weight-bold"> District </p>
                          <p class="mb-2"> <?php echo $result['district']; ?> </p>
                          <p class="font-weight-bold"> Sector </p>
                          <p class="mb-2"> <?php echo $result['sector']; ?> </p>
                        </address>
                      </div>
                    </div>
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
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
                    <?php
                    if(!isset($_GET['upd_item'])) {

                    if(isset($_POST['save_ann'])) {
                      $title= $_POST['title'];
                      $ann_text = $_POST['announcement'];                      

                        if($query->checkAnnDuplicx($title, addslashes($ann_text))<=1) {
                          if($query->addAnnouncement($title, addslashes($ann_text))) {
                            // FORWARD SMS

                            $stmt= $query->viewConfirmedFarmers();
                            while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                              $subject = $title;
                              $real_text = $ann_text;
                              $phone = $result['telephone'];
                              $farmerNames = $result['firstname']." ".$result['lastname'];
                              $currentDate = date('Y-m-d H:i:sa');

                              $data = array(
                                "sender"=>'KIGALIGAS',
                                "recipients"=>$phone,
                                "message"=>$subject." | ".stripslashes($real_text)." Murakoze!");

                              $url= "https://www.intouchsms.co.rw/api/sendsms/.json";
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
                            }

                            echo "<script>alert('ANNOUNCEMENT IS ADDED!')</script>";
                            echo "<script>window.location='?view_all'</script>";

                          } else {
                            echo "<script>alert('ERROR IN ADDING ANNOUNCEMENT')</script>";
                            echo "<script>window.location='?view_all'</script>";
                          }
                        } else {
                          echo "<script>alert('THERE IS OTHER ANNOUNCEMENT!')</script>";
                        }
                    }
                    //echo date('r', time());
                    ?>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title"><br><br>

                        <label for="exampleTextarea1">Announcement</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="2" name="announcement"></textarea>
                      </div>
                      <button type="submit" name="save_ann" class="btn btn-success mr-2">Submit</button>
                      <button class="btn btn-danger">Cancel</button>
                    </form><hr>
                    <?php } if(isset($_GET['upd_item']) && isset($_GET['view_all'])) {
                    $stmt= $query->viewAnnouncement($_GET['upd_item']);
                    $res= $stmt->FETCH(PDO::FETCH_ASSOC);

                    if(isset($_POST['update_btn'])) {
                      if($query->checkAnnDuplicx($_POST['title'], $_POST['announcement'])<1){

                        if($query->updateAnnouncement($_GET['upd_item'], $_POST['title'], addslashes($_POST['announcement']))) {
                          echo "<script>alert('ANNOUNCEMENT IS UPDATED!')</script>";
                          echo "<script>window.location='?view_all'</script>";
                        } else {
                          echo "<script>alert('ERROR IN UPDATING ANNOUNCEMENT')</script>";
                          echo "<script>window.location='?view_all'</script>";
                        }
                      } else {
                        echo "<script>alert('ANNOUNCEMENT DOES EXIST!')</script>";
                      }
                    }
                    ?>
                    <form class="forms-sample" method="POST">
                      <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $res['ann_title']; ?>"><br><br>
                        <label for="exampleTextarea1">Announcement</label>
                        <textarea class="form-control" id="exampleTextarea1" rows="2" name="announcement"><?php echo $res['announcement']; ?></textarea>
                      </div>
                      <button type="submit" name="update_btn" class="btn btn-success mr-2">Update</button>
                      <button class="btn btn-danger">Cancel</button>
                    </form><hr>
                    <?php } ?>

                    <table class="table table-bordered">
                      <thead>
                        <tr style="font-weight: bolder!important;">
                          <th> <strong>No </strong></th>
                          <th> <strong>Title</strong> </th>
                          <th> <strong>Announcement</strong> </th>
                          <th> <strong>Date</strong> </th>
                          <th colspan="2" class="text-center"> <strong>Action</strong> </th>
                        </tr>
                      </thead>

                      <?php
                      $num = 1;
                      $stmt= $query->viewAnnouncements();
                      while($result= $stmt->FETCH(PDO::FETCH_ASSOC)) {
                      // @Gadrawingz
                      ?>
                      <tbody>
                        <tr>
                          <td> <?php echo $num; ?> </td>
                          <td> <?php echo $result['ann_title']; ?> </td>
                          <td><p style="font-size: 12px!important; width: 100px!important; word-wrap: pre-wrap!important; "> <?php echo substr($result['announcement'], 0, 20)."..."; ?></p> </td>
                          <td> <?php echo $result['ann_date']; ?> </td>
                          <td class="text-center"> 
                            <div class="btn-group" role="group">
                              <a data-toggle="tooltip" data-placement="top" href="?view_all&upd_item=<?php echo $result['ann_id']; ?>" class="btn btn-primary" title="Update">
                                <i class="mdi mdi-pencil"></i>
                              </a>

                              <a href="?del=<?php echo $result['ann_id']; ?>" onclick="return confirm('Are you sure you want to remove this item?')" class="btn btn-danger" title="Remove">
                                <strong>Remove</strong>
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
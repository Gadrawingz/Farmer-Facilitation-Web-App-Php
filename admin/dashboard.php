        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-md-12">
                <div class="row">

                  <!-- STATISTICS -->
                  <div class="col-md-4 grid-margin stretch-card average-price-card">
                    <div class="card text-warning">
                      <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 align-items-center">
                          <h2 class="font-weight-semibold mb-0"><?php echo $acpRequestCount; ?></h2>
                          <div class="icon-holder">
                            <i class="mdi mdi-briefcase-outline"></i>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between">
                          <h5 class="text-warning font-weight-semibold mb-0">Accepted requests</h5>
                          <p class="text-white mb-0">This month</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator bg-danger mr-2"></div>
                              <p class="mb-0">Farmers</p>
                            </div>
                            <h4 class="font-weight-semibold"><?php echo $farmersCount; ?></h4>
                            <div class="progress progress-md">
                              <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                            </div>
                          </div>
                          <div class="col-md-6 mt-4 mt-md-0">
                            <div class="d-flex align-items-center pb-2">
                              <div class="dot-indicator bg-success mr-2"></div>
                              <p class="mb-0">Harvests</p>
                            </div>
                            <h4 class="font-weight-semibold"><?php echo $recHarvestCount; ?></h4>
                            <div class="progress progress-md">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 grid-margin stretch-card average-price-card">
                    <div class="card text-white">
                      <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 align-items-center">
                          <h2 class="font-weight-semibold mb-0"><?php echo $penRequestCount; ?></h2>
                          <div class="icon-holder">
                            <i class="mdi mdi-briefcase-outline"></i>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between">
                          <h5 class="font-weight-semibold mb-0">Pending Requests</h5>
                          <p class="text-white mb-0">This month</p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-0"><b>Market product Overview</b></h4>
                        <div class="d-flex align-items-center justify-content-between w-100">
                          <p class="mb-0">This is graphic representation showing data statistics</p>
                          <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dateSorter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">This Month</button>
                            <div class="dropdown-menu" aria-labelledby="dateSorter">
                              <div class="dropdown-item" id="market-overview_1">Daily</div>
                              <div class="dropdown-item" id="market-overview_2">Weekly</div>
                              <div class="dropdown-item" id="market-overview_3">Monthly</div>
                            </div>
                          </div>
                        </div>
                        
                        <canvas class="mt-4" height="100" id="market-overview-chart"></canvas>
                      </div>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php
          include('../configs/footer.php');
          ?>
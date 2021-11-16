
        <?php
        include('../configs/header.php');
        include('../configs/sidebar.php');
        ?>

        <!-- DASHBOARD -->
        <div class="main-panel">
          <div class="content-wrapper">

            <div class="row">
              <div class="col-md-12"><!-- <div class="col-12 grid-margin"> -->
                <div class="card">
                  <div class="card-body">
                    <h3>Register new farmer</h3><hr>
                    <form class="form-sample">
                      <!-- <p class="card-description"> Personal info </p> -->
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>First Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Last Name</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Gender</strong></label>
                            <div class="col-md-9">
                              <select class="form-control">
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Date of Birth</strong></label>
                            <div class="col-md-9">
                              <input type="date" class="form-control" placeholder="dd/mm/yyyy" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>N.I.D</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label"><strong>Tel.Number</strong></label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" />
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
                              <select class="form-control">
                                <option>East</option>
                                <option>West</option>
                                <option>North</option>
                                <option>South</option>
                                <option>Kigali City</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">District</label>
                            <div class="col-md-9">
                              <select class="form-control">
                                <option>Huye</option>
                                <option>West</option>
                                <option>North</option>
                                <option>South</option>
                                <option>Kigali City</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>



                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Sector</label>
                            <div class="col-md-9">
                              <select class="form-control">
                                <option>Tumba</option>
                                <option>West</option>
                                <option>North</option>
                                <option>South</option>
                                <option>Kigali City</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Cell</label>
                            <div class="col-md-9">
                              <select class="form-control">
                                <option>Agateme</option>
                                <option>West</option>
                                <option>North</option>
                                <option>South</option>
                                <option>Kigali City</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                      	<div class="col-md-6">
                          <button type="submit" class="btn btn-success mr-2">Submit</button>
                          <button class="btn btn-warning">Cancel</button>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 col-form-label">Village</label>
                            <div class="col-md-9">
                              <input type="text" class="form-control" />
                            </div>
                          </div>
                        </div>
                       
                      </div>
                    </form>
                  </div>
                </div>
              </div>


            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php
          include('../configs/footer.php');
          ?>
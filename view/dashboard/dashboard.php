<div class="row">

          <!-- order-card start -->
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-blue order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">Children</h6>
                      <h2 class="text-right"><i class="fa fa-child f-left"></i><span id="txtChildrenCounter">--</span></h2>
                      <p class="m-b-0"> <span class="f-left" id="MaleKidsCounter">--</span>   <span class="f-right" id="FeMaleKidsCounter" >--</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-green order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">Birthdays</h6>
                      <h2 class="text-center"><i class="fa fa-birthday-cake f-center"></i><span></span></h2>
                      <p class="m-b-0">Today<span class="f-right" id="birthdaysCounter">--</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-yellow order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">Tasks</h6>
                      <h2 class="text-right"><i class="ti-list f-left"></i><span>7</span></h2>
                      <p class="m-b-0">Due Today <span class="f-right">3</span></p>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-3">
              <div class="card bg-c-pink order-card">
                  <div class="card-block">
                      <h6 class="m-b-20">Attendance</h6>
                      <h2 class="text-center"><i class="fa fa-check f-center"></i><span></span></h2>
                      <p class="m-b-0">Today<span class="f-right">2</span></p>
                  </div>
              </div>
          </div>
          <!-- order-card end -->

          <!-- statustic and process start -->
          <div class="col-lg-12 col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h5>Children Assessment Statistics</h5>
                      <div class="card-header-right">
                          <ul class="list-unstyled card-option">
                              <li><i class="fa fa-chevron-left"></i></li>
                              <li><i class="fa fa-window-maximize full-card"></i></li>
                              <li><i class="fa fa-minus minimize-card"></i></li>
                              <li><i class="fa fa-refresh reload-card"></i></li>
                          </ul>
                      </div>
                  </div>
                  <div class="card-block"><iframe class="chartjs-hidden-iframe" style="display: block; overflow: hidden; border: 0px none; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;" tabindex="-1"></iframe><iframe class="chartjs-hidden-iframe" style="display: block; overflow: hidden; border: 0px none; margin: 0px; inset: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;" tabindex="-1"></iframe>
                      <canvas id="Statistics-chart" height="200" style="display: block; width: 634px; height: 200px;" width="634"></canvas>
                  </div>
              </div>
          </div>

          <!-- statustic and process end -->
<!-- tabs card start -->
          <div class="col-sm-12" style="display:none;">
              <div class="card tabs-card">
                  <div class="card-block p-0">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs md-tabs" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#home3" role="tab"><i class="fa fa-home"></i>Home</a>
                              <div class="slide"></div>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#profile3" role="tab"><i class="fa fa-key"></i>Security</a>
                              <div class="slide"></div>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#messages3" role="tab"><i class="fa fa-play-circle"></i>Entertainment</a>
                              <div class="slide"></div>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#settings3" role="tab"><i class="fa fa-database"></i>Big Data</a>
                              <div class="slide"></div>
                          </li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content card-block">
                          <div class="tab-pane active" id="home3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tbody><tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod2.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002344</td>
                                          <td>John Deo</td>
                                          <td>05-01-2017</td>
                                          <td><span class="label label-danger">Faild</span></td>
                                          <td>#7234486</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod3.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002653</td>
                                          <td>Eugine Turner</td>
                                          <td>04-01-2017</td>
                                          <td><span class="label label-success">Delivered</span></td>
                                          <td>#7234417</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod4.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-01-2017</td>
                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </tbody></table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                          <div class="tab-pane" id="profile3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tbody><tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod3.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002653</td>
                                          <td>Eugine Turner</td>
                                          <td>04-01-2017</td>
                                          <td><span class="label label-success">Delivered</span></td>
                                          <td>#7234417</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod4.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-01-2017</td>
                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </tbody></table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                          <div class="tab-pane" id="messages3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tbody><tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod1.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002413</td>
                                          <td>Jane Elliott</td>
                                          <td>06-01-2017</td>
                                          <td><span class="label label-primary">Shipping</span></td>
                                          <td>#7234421</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod4.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002156</td>
                                          <td>Jacqueline Howell</td>
                                          <td>03-01-2017</td>
                                          <td><span class="label label-warning">Pending</span></td>
                                          <td>#7234454</td>
                                      </tr>
                                  </tbody></table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                          <div class="tab-pane" id="settings3" role="tabpanel">

                              <div class="table-responsive">
                                  <table class="table">
                                      <tbody><tr>
                                          <th>Image</th>
                                          <th>Product Code</th>
                                          <th>Customer</th>
                                          <th>Purchased On</th>
                                          <th>Status</th>
                                          <th>Transaction ID</th>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod1.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002413</td>
                                          <td>Jane Elliott</td>
                                          <td>06-01-2017</td>
                                          <td><span class="label label-primary">Shipping</span></td>
                                          <td>#7234421</td>
                                      </tr>
                                      <tr>
                                          <td><img src="assets/images/product/prod2.jpg" alt="prod img" class="img-fluid"></td>
                                          <td>PNG002344</td>
                                          <td>John Deo</td>
                                          <td>05-01-2017</td>
                                          <td><span class="label label-danger">Faild</span></td>
                                          <td>#7234486</td>
                                      </tr>
                                  </tbody></table>
                              </div>
                              <div class="text-center">
                                  <button class="btn btn-outline-primary btn-round btn-sm">Load More</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- tabs card end -->





</div>

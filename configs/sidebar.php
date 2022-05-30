        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav bg-dark">
            <br>
            <li class="nav-item">
              <a class="nav-link" href="../manage/announcing?view_all">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Announcement</span>
              </a>
            </li>

            <li class="nav-item" style="border-bottom: 2px solid #FFF!important; margin-bottom: 10px;">
              <a class="nav-link" data-toggle="collapse" href="#harvests" aria-expanded="false" aria-controls="harvests">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Harvests</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="harvests">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/harvest?view_pend"> Unchecked harvests </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/harvest?view_checked"> Checked harvests </a>
                  </li>
                </ul>
              </div>
            </li>


            <!-- Manage -->
            <li class="nav-item nav-category">Main Menu</li>
 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#reqs" aria-expanded="false" aria-controls="reqs">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Requests+Report</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="reqs">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link text-primary" href="../manage/limitation?view_all">Request Limits </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/requests?view_pend"> Pending requests </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/requests?view_conf"> Accepted requests </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="../manage/requests?view_rej"> Rejected requests </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Adminstrators</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="admins">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/admin?register"> Register </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/admin?view_all"> View </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#farmers" aria-expanded="false" aria-controls="farmers">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Farmers</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="farmers">
                <ul class="nav flex-column sub-menu">

                  <li class="nav-item">
                    <a class="nav-link" href="../manage/farmer?register"> Register farmer</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="../manage/farmer?view_all"> View pending</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/farmer?view_conf"> View confirmed</a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#fertilizers" aria-expanded="false" aria-controls="fertilizers">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Fertilizers</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="fertilizers">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/fertilizer?register"> Register </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/fertilizer?view_all"> View all </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#seeds" aria-expanded="false" aria-controls="seeds">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Seeds</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="seeds">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/seeds?register"> Add new </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/seeds?view_all"> View all </a>
                  </li>
                </ul>
              </div>

            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#pesticide" aria-expanded="false" aria-controls="pesticide">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">Pesticide</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="pesticide">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/pesticide?register"> Add new </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../manage/pesticide?view_all"> View all</a>
                  </li>
                </ul>
              </div>
            </li>
            
          </ul>
        </nav>
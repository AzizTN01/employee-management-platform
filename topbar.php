<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['login_id'])): ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    <?php endif;
    
    ?>
      <li>
        <a class="nav-link text-white"  href="./" role="button"> <large><b><?php echo $_SESSION['system']['name'] ?></b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
   
			        <ul class="navbar-nav mr-auto">
			            <li class="nav-item dropdown notifications-dropdown">
			                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="badge badge-danger"></span> <i class="fas fa-bell"></i>
			                </a>
			                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
				                <div class="dropdown-menu-header">
					                Notifications
				                </div>
        
				                <div class="dropdown-item">
					                <div class="row">
						                
						                <div class="col-md-10">
							                <a href="">
                            
                                
                              
							                    <b>Axel</b> commented on your photo.
							                    <br>
							                    <small>10 minutes ago</small>
							                </a>
						                </div>
					                </div>
				                </div> 
				                <div class="dropdown-item">
					                <div class="row no-gutters">
						               
						                <div class="col-md-10">
							                <a href="">
							                    <b>Axel</b> liked your post.
							                    <br>
							                    <small>10 minutes ago</small>
							                </a>
						                </div>
					                </div>
				                </div>

			                </div>
			            </li>
			        </ul>
            
			    </div>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
          
        </a>
      </li>
     <li class="nav-item dropdown">
            <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-felx badge-pill">
                  <span class="fa fa-user mr-2"></span>
                  <span><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
                  <span class="fa fa-angle-down ml-2"></span>
                </div>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
              <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage Account</a>
              <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
            </div>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->
  <script>
     $('#manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
      })
  </script>

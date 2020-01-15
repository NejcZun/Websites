<?php
function main_nav(){
	echo '<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
       <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
			<h5 style="padding-top:10px;">Krypt Picture</h5>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">';
          if(isset($_COOKIE['user'])){
			echo '<li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/system/user.png" alt="profile"/>
              <span class="nav-profile-name">'.db_get_firstName(get_username_from_cookie()).' '.db_get_lastName(get_username_from_cookie()).'</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>';
		  }else{
			 echo '<li class="nav-item nav-profile dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" href="#" data-toggle="dropdown" aria-expanded="false">
              <img src="images/system/user.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
			  <a class="dropdown-item" href="login.php">
                <i class="mdi mdi-login text-primary"></i>
                Login
              </a>
			<a class="dropdown-item" href="register.php">
                <i class="mdi mdi-account-card-details text-primary"></i>
                Register
              </a>
            </div>
          </li>'; 
		  }
        echo '</ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>';	
}
function main_nav_admin(){
	echo '<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
       <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
			<h5 style="padding-top:10px;">Krypt Picture</h5>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">';
          if(isset($_COOKIE['user'])){
			echo '<li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../images/system/user.png" alt="profile"/>
              <span class="nav-profile-name">'.db_get_firstName(get_username_from_cookie()).' '.db_get_lastName(get_username_from_cookie()).'</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../logout.php">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>';
		  }else{
			 echo '<li class="nav-item nav-profile dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" href="#" data-toggle="dropdown" aria-expanded="false">
              <img src="../images/system/user.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
			  <a class="dropdown-item" href="login.php">
                <i class="mdi mdi-login text-primary"></i>
                Login
              </a>
			<a class="dropdown-item" href="register.php">
                <i class="mdi mdi-account-card-details text-primary"></i>
                Register
              </a>
            </div>
          </li>'; 
		  }
        echo '</ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>';	
}
function side_nav(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>';
		  if(isset($_COOKIE['user'])){
			  echo '<li class="nav-item">
				<a class="nav-link" href="history.php">
				  <i class="mdi mdi-history menu-icon"></i>
				  <span class="menu-title">History</span>
				</a>
			  </li>';
		  }
		  if(! isset($_COOKIE['user'])){
          echo '<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu" style="list-style-type:none;">
                <li class="nav-item"> <a class="nav-link" href="login.php"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="register.php"> Register </a></li>
              </ul>
            </div>
          </li>';
		  }
		 if(isset($_COOKIE['user'])){
			 if(check_if_user_admin()){
			  echo '<li class="nav-item">
				<a class="nav-link" href="./admin/index.php" style="color:red;">
				  <i class="mdi mdi-account-network menu-icon"></i>
				  <span class="menu-title">Admin</span>
				</a>
			  </li>';
			 }
		  }
        echo '</ul>
      </nav>';
}
function side_nav_admin(){
	echo '<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>';
		  if(isset($_COOKIE['user'])){
			  echo '<li class="nav-item">
				<a class="nav-link" href="../history.php">
				  <i class="mdi mdi-history menu-icon"></i>
				  <span class="menu-title">History</span>
				</a>
			  </li>';
		  }
		  if(! isset($_COOKIE['user'])){
          echo '<li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="mdi mdi-account menu-icon"></i>
              <span class="menu-title">User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu" style="list-style-type:none;">
                <li class="nav-item"> <a class="nav-link" href="../login.php"> Login </a></li>
                <li class="nav-item"> <a class="nav-link" href="../register.php"> Register </a></li>
              </ul>
            </div>
          </li>';
		  }
		 if(isset($_COOKIE['user'])){
			 if(check_if_user_admin()){
			  echo '<li class="nav-item">
				<a class="nav-link" href="index.php" style="color:red;">
				  <i class="mdi mdi-account-network menu-icon"></i>
				  <span class="menu-title">Admin</span>
				</a>
			  </li>';
			 }
		  }
        echo '</ul>
      </nav>';
}

?>
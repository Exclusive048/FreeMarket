<?php
  include ("config.php");
  include ("bd.php");
  if (!empty($_SESSION['email']))
  {
    $email = $_SESSION['email'];
    $result = mysql_query("SELECT * FROM user WHERE email_user='$email'",$db);
    $myrow = mysql_fetch_array($result);
  }
?>
<nav class="navbar navbar-expand-lg fixed-top  navbar-dark" style="background-color: #3CA1D9;">
      <div class="container">
        <a class="navbar-brand" href="all_advert.php?page=1">Объявления</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php if($myrow['admin_user']==1) {echo "adminProfile.php";}else {echo "page.php"; }?>">Профиль             
              </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="exit.php">Выход            
                </a>
              </li>
          </ul>
        </div>
      </div>
</nav>

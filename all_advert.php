<?php
  include ("config.php");
  include ("bd.php");
  if (isset($_SESSION['id'])) 
  {
    $id = $_SESSION['id'];  
  }

  $per_page=12;
//put FROM and WHERE parts into separate  variable
//getting total number of records 
$res=mysql_query("SELECT count(*) FROM advert WHERE advertAction_ad=1 ");
$row=mysql_fetch_row($res);
$total_rows=$row[0];

//Process GET variables to get $start value for LIMIT
if (isset($_GET['page'])) 
  $CUR_PAGE=($_GET['page']); 
else 
  $CUR_PAGE=1;
$start=abs(($_GET['page']-1)*$per_page);

//getting records from database into array
$query="SELECT * FROM advert WHERE advertAction_ad=1 ORDER BY id_ad DESC LIMIT $start,$per_page";
$res=mysql_query($query);


//Getting page URL without query string
$uri=strtok($_SERVER['REQUEST_URI'],"?")."?";

//create a new query string without a page variable
if (isset($_GET['page'])) 
  unset($_GET['page']);
if (count($_GET)) 
{
  foreach ($_GET as $k => $v) 
  {
    if ($k != "page") $uri.=urlencode($k)."=".urlencode($v)."&";
  }
}

//getting total number of pages and filling an array with links
$num_pages=ceil($total_rows/$per_page);
for($i=1;$i<=$num_pages;$i++) 
  $PAGES[$i]=$uri.'page='.$i;

?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Объявления</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/headline.css" rel="stylesheet">
  </head>

  <body>
<?php
include("navbar.php");
?>
<div class="one"><h1>ОБЪЯВЛЕНИЯ</h1></div>
<div class="container-fluid">
<div class="col-lg-12">
<div class="row">
<?php
$result = mysql_query("SELECT * FROM user WHERE block_user=0 ",$db);
  $myrow = mysql_fetch_array($result);
  $result2 = mysql_query("SELECT * FROM advert a INNER JOIN user u ON a.id_users = u.id_user WHERE advertAction_ad=1 ORDER BY id_ad  DESC LIMIT $start,$per_page",$db);
  while($myrow2 = mysql_fetch_array($result2))
  {
?>     

                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="card h-100">
                    	<div class="card h-100">
                    	<?php  echo '<img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode( $myrow2['photo_ad'] ) . '" />'  ?>
                        <div class="card-body">
                            <h4 class="card-title">
                            <a href="viewAds.php?id=<?php echo $myrow2['id_ad'];?>"><?php echo $myrow2['name_ad'];?></a>
                            </h4>
                            <h5><?php echo $myrow2['description_ad']; ?></h5>
                            <h5><?php echo $myrow2['item_ad']?></h5>
                            <p> <?php echo $myrow['fio_user']?> </p>  
                          <?php if ($myrow2['phone_ad'] == 1): ?>
                            <p> <?php echo $myrow['phone_user']?> </p>
                          <?php endif; ?>
                          <?php if ($myrow2['email_ad'] == 1): ?>
                            <p> <?php echo $myrow['email_user']?> </p>
                          <?php endif; ?>
                          <?php if ($myrow2['address_ad'] == 1): ?>
                            <p> <?php echo $myrow['address_user']?> </p>
                          <?php endif; ?>
                           <!--  <p class="card-text">ТУТ ДОЛЖНА БЫТЬ ВАША РЕКЛАМА </p> -->
                        </div>
                        <a class="btn btn-primary" href="viewAds.php?id=<?php echo $myrow2['id_ad'];?>" role="button">Посмотреть</a>
                      </div>
                    </div>
                </div>        
<?php
}
?>
</div>
</div>
</div>

<div class ="one"  style="font-size: 1.5rem; font-weight: bold"> 
<h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">Страницы:</a></h2>
<? foreach ($PAGES as $i => $link): ?>
<? if ($i == $CUR_PAGE): ?>
<!-- <div class ="one"  style="font-size: 1.5rem; font-weight: bold"> --> 
<!-- <b><?=$i?></b> -->
<? else: ?> 
<a href="<?=$link?>"><?=$i?></a>
</div>
<? endif ?> 
<? endforeach ?> 
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     </body>
</html>
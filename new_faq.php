<?php 
include_once '_libs/dbConnect.php';
$newsifyObj = new  dbConnect();
$sql = "SELECT 
		  id, page_name, page_content 
		  FROM  `tbl_pages` 
		  WHERE  `page_name` =  'faq' Limit 1";
//$query   = $newsifyObj->db_select($sql);
$result    = mysqli_query($newsifyObj->dbCon, $sql);
$row = mysqli_fetch_array($result);
?>

<!doctype html>
<html lang="en">
<head>
  <title>The VIRALMARKETER</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>

    
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">

          <div class="col-6 col-xl-2">
            <div class="mb-0 site-logo"><img src="assets/logo_black.png" alt=""></div>
          </div>

          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-black"></span></a></div>

        </div>
      </div>

    </header>



    <div class="site-section hero" id="home-section">
      <div class="container">
         <div class="jumbotron jumbotron-fluid" style="margin-top: 10%">
            <div class="container">
              <h1 class="display-4">FAQ</h1>
              <div class="col-md-12">
                    <?php if(!empty($row['page_content'])){
						echo $row['page_content'];
					} else { ?>
						<div class="alert alert-info fade in ">
							<strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>&nbsp;&nbsp;
							No, FAQ Found!!
                        </div>
					<?php }?>
                </div>
            </div>
          </div>
      </div>
    </div>

    
    



    </div> <!-- .site-wrap -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>


    <script src="js/main.js"></script>


  </body>
  </html>

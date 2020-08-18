<?php 
include_once 'includes/header.php';
$sql = "SELECT 
		  id, page_name, page_content 
		  FROM  `tbl_pages` 
		  WHERE  `page_name` =  'faq' Limit 1";
$query   = $newsifyObj->db_select($sql);
$result    = mysqli_fetch_assoc($query);
?>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">FAQ</h3>
            <p class="title-description">Hopefully Your Questions Will Get Answers Below!!</p>
        </div>
        <section class="section">
            <div class="row pages-row">
                <div class="col-md-12">
                    <?php if(!empty($result['page_content'])){
						echo $result['page_content'];
					} else { ?>
						<div class="alert alert-info fade in ">
							<strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>&nbsp;&nbsp;
							No, FAQ Found!!
                        </div>
					<?php }?>
                </div>
            </div>
        </section>
    </article>
<?php include_once 'includes/footer.php'; ?>
<!-- MENU AREA END -->
<!-- BANNER AREA STRAT -->
<section class="bannerhead-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner-heading">
                    <h1>Blog</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MENU AREA END -->
<!-- MAP-AREA START -->
<section class="our-brand-area">
    <div class="container">
        <?php
        $sql_blogdetail = "SELECT * FROM tblblog, tblaccount WHERE tblblog.EmployeeAccID = tblaccount.AccountID AND tblblog.BlogID='$_GET[BlogID]' LIMIT 1";
        $query_blogdetail = mysqli_query($mysqli, $sql_blogdetail);


        while ($row = mysqli_fetch_array($query_blogdetail)) {
        ?>
            <div class="blog-detail">
                <div class="blog-detail-header">
                    <div><i class="fa fa-user" aria-hidden="true"></i> <span><?php echo $row['AccountName'] ?></span></div>
                    <div><i class="fa fa-calendar" aria-hidden="true"></i> <span><?php echo date("d/m/Y", strtotime($row['PostDate'])) ?></span></div>
                </div>
                <h1><?php echo $row['BlogTitle'] ?></h1>
                <div style="display:flex;align-items: center;justify-content: center;margin:50px 0;">
                    <img style="width:50%; " class="primary-img" src="admin/modules/blogManagement/uploads/<?php echo $row['Image'] ?>" alt="" />
                </div>
                <p style="line-height: 2;"><?php echo $row['Content'] ?></p>
            </div>
        <?php } ?>
        <div class="text-center">
            <div class="section-titel">
                <h3>OUR BRANDS</h3>
            </div>
        </div>
        <div class="row blog-area">
            <div id="ourbrand-owl">
                <div class="col-md-12"><img src="img/other-pg/brand-logo-1.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-2.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-3.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-4.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-5.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-3.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-1.jpg" alt="" /></div>
                <div class="col-md-12"><img src="img/other-pg/brand-logo-2.jpg" alt="" /></div>
            </div>
        </div>
    </div>
</section>
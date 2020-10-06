<?php
/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
$ver = time();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <title>Dịch vụ :: Holistic Anti Aging Institute</title>
  <?php include 'layout/head.php' ;?>
</head>

<body>
  <!--Navigation-->
  <?php include 'layout/navigation.php'; ?>
  <?php include 'layout/banner.php'; ?>
  <main role="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 left-col">
          <h1 class="category-detail-title">Điểm danh những nguyên nhân bất ngờ gây lên sẹo rỗ</h1>
          <div class="category-detail-desc">Có thể bạn không biết rặng việc dùng tay nặn mụn hay phơi nắng có thể khiến da mặt để lại sẹo rỗ</div>
          <div class="row category-wrapper">
            <?php for ($i=0; $i < 10; $i++) { ?>
              <div class="col-sm-4 category-items">
                <a href="service-article.php" class="category-link">
                  <span class="category-thumb">
                    <img class="img-responsive" src="/frontend/images/category-detail-thumb.jpg" >
                  </span>
                  <span class="animate category-detail-subtitles">ĐIỀU TRỊ SẸO LÕM</span>
                  <span class="animate category-detail-subtitles-desc">Đây là 1 dòng mô tả quá trình - thành tựu đạt được, có thêm ý kiến  đấnh gái từ chuyên gia cùng ngành thì sẽ tốt hơn.</span>
                </a>
              </div>
            <?php } ?>
          </div>
          <div class="booknow-wrapper">
            <a href="/dat-lich-kham.php" ="button" class="btn btn-primary rad0 btn-lg btn-block">Đặt lịch khám</a>
          </div>
        </div>
        <div class="col-sm-3 right-col">
          <div class="sponsor">
            <a href="#">
              <a href="http://maiamaia.vn/tin-tuc-khuyen-mai"><img src="/standee-V2-2.png" class="img-responsive"></a>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include 'layout/footer.php'; ?>
  <?php ?>

</body>

</html>

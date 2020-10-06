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
  <title>Trang chủ :: Holistic Anti Aging Institute</title>
  <?php include 'layout/head.php' ;?>
</head>

<body>
  <!--Navigation-->
  <?php include 'layout/navigation.php'; ?>
  <?php include 'layout/banner.php'; ?>
  <main role="main">
    <div class="container">
      <?php include 'include/feature.php' ?>
      <div class="my-service">
        <h2 class="home-title">
          Dịch vụ của chúng tôi
        </h2>
        <div class="row my-service-wrapper">
          <?php for ($i=0; $i < 6; $i++) { ?>
          <div class="col-sm-4 my-service-item">
            <div class="my-service-icon"></div>
            <div class="my-service-text">Use the alignment options to decide</div>
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="good-for-you row">
        <?php for ($g=0; $g < 3; $g++) { ?>
        <div class="col-sm-4 good-for-you-item pad0">
          <div class="good-for-you-box">
            <h3 class="good-for-you-item-title">Tiết kiệm thời gian</h3>
            <div class="good-for-you-item-subtitles">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
            <a href="#" class="good-for-you-item-more">Xem thêm</a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php include 'include/why-choose-us.php'; ?>
    <div class="work-together">
      <div class="container">
        <h2 class="work-together-title ">Làm việc cùng chuyên gia</h2>
        <h3 class="work-together-subtitles">Đội ngũ bác sỹ lành nghề chuyên gia da liễu đến từ các cơ sở y tế</h3>
        <div class="work-together-wrapper">
          <?php for ($w=1; $w < 6; $w++) { ?>
          <div class="work-together-item">
            <a href="doctor.php">
              <div class="work-together-content">
                <span class="member-images"><img class="img-responsive" src="/frontend/images/doctor-<?php echo $w ?>.jpg" ></span>
                <h4 class="member-title">Nguyễn Văn A</h4>
                <span class="member-subtitles">Bác sĩ - Thạc sĩ</span>
              </div>
            </a>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'include/testimonial.php'; ?>
</main>
<?php include 'layout/footer.php'; ?>
<?php ?>

</body>

</html>

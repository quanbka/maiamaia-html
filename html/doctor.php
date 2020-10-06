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
  <title>Trang bác sỹ</title>
  <?php include 'layout/head.php' ;?>
</head>

<body>
  <!--Navigation-->
  <?php include 'layout/navigation.php'; ?>
  <banner class="">
    <img class="img-responsive" src="frontend/images/banner-bac-sy.jpg">
  </banner>
  <main role="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <h2 class="doctor-info-title">
            Giới thiệu
          </h2>
          <div class="doctor-info-box arrow_box2">
            <h4>Quá trình làm việc</h4>
            <p>Với nhiều năm kinh nghiệm làm việc trong lĩnh vực thẩm mỹ không phẫu thuật, Thạc sĩ – Bác sĩ Nguyễn Văn Hoàn vô cùng thấu hiểu những mong muốn và tâm tư của khách hàng.</p>
            <p>Để đáp ứng nhu cầu ngày càng tăng hiện nay trong lĩnh vực làm đẹp không cần tới phẫu thuật.</p>
            <p> Thạc sĩ – Bác sĩ Nguyễn Văn Hoàn với hàng chục nghìn ca điều trị và thẩm mỹ da liễu thành công đã góp phần giúp Phòng Khám Da Liễu Maia nói chung 
            và bác sĩ Hoàn nói riêng nhận được rất nhiều sự tin tưởng và ủng hộ của khách hàng.</p>
            <p>Luôn nỗ lực nâng cao chuyên môn để mang đến hiệu quả khám và điều trị bệnh an toàn, nhanh chóng cho</p>
            <a class="more-doctor" href="javascript:;">Xem thêm</a>
          </div>
        </div>
        <div class="col-sm-6">
          <h3 class="doctor-info-title">
            Infographic
          </h3>
          <div class="doctor-infographic-box">
            <div class="row">
              <div class="col-sm-6 text-center">
                <span class="radius-box">
                  <i class="fas fa-map-marker-alt"></i>
                </span>
                <name>Tiểu sử</name>
              </div>
              <div class="col-sm-6 text-center">
                <span class="radius-box">
                  <i class="far fa-calendar-alt"></i>
                </span>
                <name>Tiểu sử</name>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 text-center">
                <span class="radius-box">
                  <i class="fas fa-book"></i>
                </span>
                <name>Tiểu sử</name>
              </div>
              <div class="col-sm-6 text-center">
                <span class="radius-box">
                  <i class="fas fa-user"></i>
                </span>
                <name>Tiểu sử</name>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="achievements">
        <h2>
          Thành tựu lĩnh vực
        </h2>

        <div class="row">
          <div class="col-sm-6">
            <number>
              01
            </number>
            <h3>
              Thành tựu hoạt động
            </h3>
            <ul>
              <li>Là bác sỹ điều trị chính tại VTM Maia&Maia từ 2009
                <ul>
                  <li>Bác sỹ điều trị tại Bệnh viện da liễu TW
                    <ul>
                      <li>Điều trị Mụn trứng cá: trên 30.000 ca</li>
                      <li>Điều trị Sẹo lõm: trên 10.000 ca </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
            <span class="dotted"></span>
          </div>

          <div class="col-sm-6">
            <number>
              02
            </number>
            <h3>
              Thành tựu hoạt động
            </h3>
            <ul>
              <li>Là bác sỹ điều trị chính tại VTM Maia&Maia từ 2009
                <ul>
                  <li>Bác sỹ điều trị tại Bệnh viện da liễu TW
                    <ul>
                      <li>Điều trị Mụn trứng cá: trên 30.000 ca</li>
                      <li>Điều trị Sẹo lõm: trên 10.000 ca </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
            <span class="dotted"></span>
          </div>
        </div>

        <div class="filter-box row">
          <div class="col-sm-6">
            <?php for ($f =0; $f < 3; $f++) { ?>
            <div class="media">
              <div class="media-left">
                <i class="fas fa-plus-circle fa-2x"></i>
              </div>
              <div class="media-body">
                <h3 class="media-heading">John Doe</h3>
              </div>
            </div>
            <?php } ?>
          </div>

          <div class="col-sm-6">
            <?php for ($f2 =0; $f2 < 3; $f2++) { ?>
            <div class="media">
              <div class="media-left">
                <i class="fas fa-plus-circle fa-2x"></i>
              </div>
              <div class="media-body">
                <h3 class="media-heading">John Doe</h3>
              </div>
            </div>
            <?php } ?>
          </div>

          
        </div>



      </div>


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
  </main>
  <?php include 'layout/footer.php'; ?>
  <?php ?>

</body>

</html>

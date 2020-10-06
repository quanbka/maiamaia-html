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
  <title>Đặt lịch khám</title>
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
          <h1 class="category-title">Đặt lịch khám</h1>
          <div class="article-content">
            <p>Để dịch vụ được đáp ứng nhanh chóng và tiện lợi, chúng tôi đã thành lập hệ thống đặt lịch trực tuyến</p>
            <p>Hotline:  +024 3933 6868 /+024 3933 6969 </p>
            <form name="myform">
              <div class="form-group">
                <label for="myName">Tên của bạn *</label>
                <input id="myName" name="myName" class="form-control" type="text" placeholder="Nhập tên của bạn">
              </div>
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="age">Tuổi *</label>
                  <input id="age" name="age"  class="form-control" type="text"  placeholder="Tuổi hiện tại của bạn" >
                </div>
                <div class="form-group col-sm-6">
                  <label for="gender">Giới tính</label>
                  <select name="gender" id="gender" class="form-control">
                    <option selected>Nam</option>
                    <option>Nữ</option>
                    <option>Khác</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="phone">Di động *</label>
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Di động của bạn">
                </div>
                <div class="form-group col-sm-4">
                  <label for="phone">Email của bạn *</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="Email của bạn">
                </div>
                <div class="form-group col-sm-4">
                  <label for="phone">Ngày muốn khám *</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="<?php echo date("d/m/Y"); ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="disc">Phần phẫu thuật mong muốn</label>
                <div class="center-block">
                   <label class="checkbox-inline"><input type="checkbox" value="">Mắt</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Mũi</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Xương hàm</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Cằm</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Ngực</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Cơ thể</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Bụng</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Chống lão</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Nối xương</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Nha khoa</label>
                   <label class="checkbox-inline"><input type="checkbox" value="">Thẩm mỹ</label>
                </div>
              </div>
              
              <div class="form-group">
                <label for="disc">Yêu cầu khác</label>
                <textarea class="form-control" rows="3"></textarea>
              </div>

              <button id="submit" type="submit" value="submit" class="btn btn-primary rad0 center">Đăng ký khám</button>

            </form>


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

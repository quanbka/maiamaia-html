<footer id="main-footer">
  <div class="footer-top container">
    <div class="footer-box footer-left col-sm-4 pad0">
      <div class="footer-items">
        <div class="footer-icon">
          <i class="fas fa-map-marker-alt fa-lg"></i>
        </div>
        <div class="footer-text">
          <b>Địa điểm</b><br>
          9 Hoàng Cầu, Đống Đa, Hà Nội
        </div>
      </div>
    </div>
    <div class="footer-box col-sm-4 pad0">
      <div class="footer-items">
        <div class="footer-icon">
          <i class="fas fa-phone-volume fa-lg"></i>
        </div>
        <div class="footer-text">
          <b>Điện thoại</b><br>
          +024 3933 6868 /+024 3933 6969
        </div>
      </div>
    </div>
    <div class="footer-box col-sm-4 pad0">
      <div class="footer-items">
        <div class="footer-icon">
          <i class="fas fa-envelope fa-lg"></i>
        </div>
        <div class="footer-text">
          <b>Email</b><br>
          info@maiamaiabeauty.com

        </div>
      </div>
    </div>
    <div class="clr"></div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="footer-bottom-logo">
            <img src="/frontend/images/logo-white.png" class="img-responsive">
          </div>
          <div class="footer-bottom-desc">
            Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt như rễ cây khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt,
          </div>
          <div class="footer-bottom-social">
            <ul class="social-network social-circle">
              <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
              <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
            </ul>
          </div>
          <div class="footer-bottom-search">
            <div class="input-group">
              <input type="text" class="form-control rad0" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary rad0" type="button">Tìm kiếm!</button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="fb-page" data-href="https://www.facebook.com/kynangchame" data-tabs="timeline" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kynangchame" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kynangchame">Kỹ Năng Làm Cha Mẹ</a></blockquote></div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control rad0 bg0 co0" placeholder="Enter name" required="required" />
          </div>
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" class="form-control rad0 bg0 co0" placeholder="Enter email" required="required" />
          </div>
          <div class="form-group">
            <label for="name"> Message</label>
            <textarea name="message" id="message" class="form-control rad0 bg0 co0" rows="4" cols="25" required="required"placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary rad0" id="btnContactUs">Send Message</button>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.12&appId=774585716058250&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
</footer>
<script src="frontend/js/jquery.min.js?v=<?php echo $ver?>" type="text/javascript"></script>
<script src="frontend/js/bootstrap.min.js?v=<?php echo $ver?>" type="text/javascript"></script>
<script src="frontend/js/slick.min.js?v=<?php echo $ver?>" type="text/javascript"></script>
<script src="frontend/js/script.js?v=<?php echo $ver?>" type="text/javascript"></script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution="setup_tool"
  page_id="1584483324924465"
  theme_color="#44bec7"
  logged_in_greeting="Xin chào, bạn cần Maiamaia tư vấn ?"
  logged_out_greeting="Xin chào, bạn cần Maiamaia tư vấn ?">
</div>

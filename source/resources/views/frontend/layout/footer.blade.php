<footer id="main-footer">
    <div class="footer-top container">
        <div class="footer-box footer-left col-sm-4 pad0">
            <div class="footer-items">
                <div class="footer-icon">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </div>
                <div class="footer-text">
                    <a href="https://www.google.com/maps/place/9+Ho%C3%A0ng+C%E1%BA%A7u+M%C6%A1%CC%81i,+%C3%94+Ch%E1%BB%A3+D%E1%BB%ABa,+%C4%90%E1%BB%91ng+%C4%90a,+H%C3%A0+N%E1%BB%99i/@21.0193041,105.825612,17z/data=!4m5!3m4!1s0x3135ab79b7173bd9:0xb20a915f2ca1a7f!8m2!3d21.0196005!4d105.8254636" style="color: white" target="_blank">
                        <b>Địa điểm</b><br>
                        9 Hoàng Cầu, Đống Đa, Hà Nội
                    </a>
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
                    02439336868 / 02439336969
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
                    <div class="footer-bottom-desc" style="font-size: 18px; padding-bottom: 0px;">
                        Thạc sỹ, bác sỹ da liễu chuyên môn cao
                    </div>
                    <div>
                        <form class="" action="/tim-kiem" method="get">

                            <div class="input-group">
                                <input type="text" name="q" value="" class="form-control" placeholder="Tìm kiếm">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                              </div>
                        </form>

                    </div>
                    <div class="footer-bottom-social">
                        <ul class="social-network social-circle">
                            <li><a href="https://www.facebook.com/phongkhammaia/" target="_blank" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        </ul>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="fb-page" data-href="https://www.facebook.com/phongkhammaia" data-tabs="timeline" data-height="350" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kynangchame" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kynangchame">Kỹ Năng Làm Cha Mẹ</a></blockquote></div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" id="name" class="form-control rad0 bg0 co0" placeholder="Enter name" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="email">Số điện thoại</label>
                        <input type="text" id="email" class="form-control rad0 bg0 co0" placeholder="Enter phone" required="required" />
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung</label>
                        <textarea name="message" id="message" class="form-control rad0 bg0 co0" rows="4" cols="25" required="required" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary rad0" id="btnContactUs">Gửi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>




<a href="tel:02439336868" title="Gọi 02439336868"  id="floating-phone">
    <i class="uk-icon-phone"></i>
</a>

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
  logged_in_greeting="Xin chào, Maiamaia có thể giúp gì cho bạn?"
  logged_out_greeting="Xin chào, Maiamaia có thể giúp gì cho bạn?">
</div>

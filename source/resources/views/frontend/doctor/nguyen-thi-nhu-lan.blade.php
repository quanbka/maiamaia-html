@extends('frontend.layout.master', ['title' => 'Maiamaia'])
@section('content')
    <banner class="">
    <img class="img-responsive" src="/frontend/images/banner-bac-sy.jpg">
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
                <name>Giới thiệu</name>
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
                <name>Kinh nghiệm - Thành tựu</name>
              </div>
              <div class="col-sm-6 text-center">
                <span class="radius-box">
                  <i class="fas fa-user"></i>
                </span>
                <name>Nhận xét của bệnh nhân</name>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="achievements">
          <h2>
              Tiểu sử
          </h2>

          <div class="">
              <p>Tiểu sử tại đây</p>
          </div>
      </div>

      <div class="achievements">
          <h2>
              Thành tựu
          </h2>

          <div class="">
              <p>Thành tựu tại đây</p>
          </div>
      </div>

      {{-- <div class="testimonial-wrapper"> --}}
      <div class="row">


          <div class="container">
              <div id="testimonial4" class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x" data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
                  <div class="testimonial4_header">
                      <h4>Bệnh nhân nói về bác sỹ Hoàn</h4>
                  </div>
                  <ol class="carousel-indicators">
                      <li data-target="#testimonial4" data-slide-to="0" class="active"></li>
                      <li data-target="#testimonial4" data-slide-to="1"></li>
                      <li data-target="#testimonial4" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner" role="listbox">
                      <div class="carousel-item item active">
                          <div class="testimonial4_slide">
                              <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt như rễ cây
                                  khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt, vết rạn
                                  mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                  Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                  <h4>Hồng Nhung 3</h4>
                                  <p>MC - Diễn viên - Người mẫu ảnh</p>
                              </div>
                          </div>
                          <div class="carousel-item item">
                              <div class="testimonial4_slide">
                                  <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt như rễ cây
                                      khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt, vết rạn
                                      mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                      Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                      <h4>Hồng Nhung 4</h4>
                                      <p>MC - Diễn viên - Người mẫu ảnh</p>
                                  </div>
                              </div>
                              <div class="carousel-item item">
                                  <div class="testimonial4_slide">
                                      <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt như rễ cây
                                          khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt, vết rạn
                                          mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                          Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                          <h4>Hồng Nhung 5</h4>
                                          <p>MC - Diễn viên - Người mẫu ảnh</p>
                                      </div>
                                  </div>

                      </div>
                      {{-- <a class="left carousel-control" href="#testimonial4" role="button" data-slide="prev">
                      <span class="fa fa-chevron-left"></span>
                  </a>
                  <a class="right carousel-control" href="#testimonial4" role="button" data-slide="next">
                  <span class="fa fa-chevron-right"></span>
              </a> --}}
          </div>
      </div>
            </div>

  {{-- </div> --}}


    @include('frontend.common.work-together')


    </div>
  </main>

@endsection

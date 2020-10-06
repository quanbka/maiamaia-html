@extends('frontend.layout.master', ['title' => 'Maiamaia'])
@section('content')

    <style media="screen">
        .img-responsive{
            width: 100%;
        }
    </style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <?php
        $config = \App\Models\Setting::where('key', 'storeWidget')->first();
        $config = json_decode($config['value']);
        ?>

            <div class="carousel-inner">
                @foreach ($config as $key => $item)
                <div class="item {{ $key == 0 ? "active" : ""}}" >
                        <a href="{{ $item->description }}" style="width: 100%" target="_blank">
                            <img class="banner-images img-responsive" src="{{ $item->banner_url }}">
                        </a>
                    </div>
                @endforeach

            </div>


      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <main role="main">
        <div class="container">
            <div class="row feature-wrapper">
                <div class="col-md-3 col-sm-6 feature-item">
                    <a href="/benh-ly-da-lieu">
                        <span class="feature-image">
                            <img class="img-responsive" src="/frontend/images/feature-1.jpg">
                        </span>
                        <h2 class="feature-title">
                            Bệnh lý da liễu
                        </h2>

                    </a>
                </div>
                <div class="col-md-3 col-sm-6 feature-item">
                    <a href="/tham-my-cong-nghe-cao">
                        <span class="feature-image">
                            <img class="img-responsive" src="/frontend/images/feature-2.jpg">
                        </span>
                        <h2 class="feature-title">
                            Thẩm mỹ công nghệ cao
                        </h2>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 feature-item">
                    <a href="/tin-tuc-suc-khoe">
                        <span class="feature-image">
                            <img class="img-responsive" src="/frontend/images/feature-3.jpg">
                        </span>
                        <h2 class="feature-title">
                            Tin tức sức khỏe
                        </h2>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 feature-item">
                    <a href="/cau-chuyen-khach-hang">
                        <span class="feature-image">
                            <img class="img-responsive" src="/frontend/images/feature-4.jpg">
                        </span>
                        <h2 class="feature-title">
                            Câu chuyện khách hàng
                        </h2>
                    </a>
                </div>
            </div>
            <div class="my-service">
                <h2 class="home-title">
                    Dịch vụ của chúng tôi
                </h2>
                <div class="row my-service-wrapper">
                    <?php
                        $blogs = [
                            [
                                'url' => '/benh-ly-da-lieu',
                                'text' => 'Khám và điều trị các bệnh lý khó về da',
                            ],
                            [
                                'url' => '/benh-ly-da-lieu',
                                'text' => 'Khám và điều trị các bệnh lây truyền qua đường tình dục',
                            ],
                            [
                                'url' => '/tham-my-cong-nghe-cao',
                                'text' => 'Điều trị da thẩm mỹ không phẫu thuật',
                            ],
                            [
                                'url' => '/tham-my-cong-nghe-cao',
                                'text' => 'Trị sẹo lồi - sẹo lõm, sẹo rỗ',
                            ],
                            [
                                'url' => '/dieu-tri-cham-soc-da',
                                'text' => 'Chăm sóc da toàn diện',
                            ],
                            [
                                'url' => '/dieu-tri-cham-soc-da',
                                'text' => 'Điều trị mụn trứng cá chuẩn y khoa',
                            ],
                        ];
                    ?>

                    @foreach ($blogs as $key => $blog)
                        <div class="col-sm-6 my-service-item">
                            <a href="<?= $blog['url'] ?>" style="width: 100%">
                                <div class="my-service-icon" style="float: left">
                                    <img src="/frontend/images/logo-white.png" style="max-width: 100%; max-height: 100%">
                                </div>
                                <div class="my-service-text"><?= $blog['text'] ?></div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <div>
            <div class="why-choose-us-wrapper">
                <div class="container-fluid">
                    <h2 class="home-title center-block text-center pad0 mar0">
                        Tại sao lại chọn chúng tôi
                    </h2>
                    <div class="why-choose-us-box">
                        <div class="row">
                            @if($whyChooseUsBlogs)
                                @foreach ($whyChooseUsBlogs as $key => $blog)
                                    <div class="col-sm-3 why-choose-us-item">
                                        <div class="why-choose-us-content">
                                                    <span class="why-choose-us-image">
                                                        <img src="{{ $blog->image?$blog->image:"/frontend/images/why-us-1.jpg" }}"
                                                             class="img-responsive">
                                                    </span>
                                            <h3 class="why-choose-us-title">
                                                {!! $blog->title !!}
                                            </h3>
                                            <span class="why-choose-us-subtitles">
                                                        {{ $blog->description }}
                                                    </span>
                                            <a href="/dich-vu/{{ $blog->slug }}">Xem thêm</a>
                                        </div>
                                    </div>
                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            @include('frontend.common.work-together')

        </div>
        <div class="testimonial-wrapper">
            <div class="container">
                <div id="testimonial4"
                     class="carousel slide testimonial4_indicators testimonial4_control_button thumb_scroll_x swipe_x"
                     data-ride="carousel" data-pause="hover" data-interval="5000" data-duration="2000">
                    <div class="testimonial4_header">
                        <h4>Khách hàng nói về chúng tôi</h4>
                    </div>
                    <ol class="carousel-indicators">
                        <li data-target="#testimonial4" data-slide-to="0" class="active"></li>
                        <li data-target="#testimonial4" data-slide-to="1"></li>
                        <li data-target="#testimonial4" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="testimonial4_slide">
                                <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt
                                    như rễ cây
                                    khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt,
                                    vết rạn
                                    mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                    Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                <h4>Hồng Nhung</h4>
                                <p>MC - Diễn viên - Người mẫu ảnh</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial4_slide">
                                <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt
                                    như rễ cây
                                    khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt,
                                    vết rạn
                                    mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                    Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                <h4>Hồng Nhung</h4>
                                <p>MC - Diễn viên - Người mẫu ảnh</p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimonial4_slide">
                                <p>‘’Sinh xong đã lâu mà thân hình mình vẫn cứ sồ sề, xấu xí, những vết rạn chằng chịt
                                    như rễ cây
                                    khắp bụng, đùi và ngực, rất mất tự tin. Điều trị Mixel 2018 xong mà da cứ căng mướt,
                                    vết rạn
                                    mờ nhạt hẳn đi đều màu với vùng da xung quanh rồi, sờ cũng không thấy hõm nữa.
                                    Đặc biệt Nhung còn cảm thấy bụng đỡ hẳn cả chùng nhão, săn chắc thích lắm!” </p>
                                <h4>Hồng Nhung</h4>
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
        <div class="container">
            <div class="good-for-you row" style="margin-bottom: 50px">
                <div class="col-sm-4 good-for-you-item pad0">
                    <div class="good-for-you-box">
                        <h3 class="good-for-you-item-title">Phòng khám <br> da liễu</h3>
                        <div class="good-for-you-item-subtitles">
                        </div>
                        <a href="/phong-kham" class="good-for-you-item-more">Xem thêm</a>
                    </div>
                </div>
                <div class="col-sm-4 good-for-you-item pad0">
                    <div class="good-for-you-box">
                        <h3 class="good-for-you-item-title">Thẩm mỹ <br> công nghệ cao</h3>
                        <div class="good-for-you-item-subtitles">
                        </div>
                        <a href="/tham-my-khong-phau-thuat" class="good-for-you-item-more">Xem thêm</a>
                    </div>
                </div>
                <div class="col-sm-4 good-for-you-item pad0">
                    <div class="good-for-you-box">
                        <h3 class="good-for-you-item-title">Trị liệu <br>& chăm sóc da</h3>
                        <div class="good-for-you-item-subtitles">
                        </div>
                        <a href="/dieu-tri-cham-soc-da" class="good-for-you-item-more">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

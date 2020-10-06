@extends('frontend.layout.master', ['title' => $blog->title ])

@section('content')
    <main role="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 left-col">
                    <h1 class="category-title"><?= $blog->title ?></h1>
                    <div class="article-content">
                        <?= $blog->content ?>
                    </div>
                    <style media="screen">
                        .register-form ul{

                            list-style-image: url('');
                        }
                    </style>
                    <div class="row register-form" style="background: linear-gradient(45deg, #3c9edc, #084086); color :white;">
                        <h3 class="text-center" style="margin-bottom: 0px;">ĐĂNG KÝ NGAY</h3>
                        <div class="col-md-8" style=" padding: 60px; padding-top: 30px;">
                            <h5>TẠI SAO NÊN CHỌN PHÒNG KHÁM CHUYÊN KHOA DA LIỄU MAIA&MAIA</h5>
                            <ul>
                                <li>Địa chỉ khám và chữa bệnh đúng bệnh – đúng thuốc, uy tín, tin cậy</li>
                                <li>Quy trình khám khoa học, nhanh chóng, tiết kiệm thời gian và chi phí tối đa cho khách hàng</li>
                                <li>Được Sở Y tế TP Hà Nội cấp phép khám - chữa các bệnh về da và điều trị các bệnh lý bằng Laser</li>
                                <li>Đội ngũ thạc sỹ, bác sỹ hơn 10 năm kinh nghiệm, chuyên môn cao</li>
                                <li>Trang thiết bị hiện đại, đầy đủ kiểm định chất lượng CO/CQ chuẩn quốc tế</li>
                            </ul>

                        </div>
                        <div class="col-md-4" style="  padding: 40px;  padding-top: 10px;">
                            <form action="/dang-ky-kham" method="POST">
                              <div class="form-group">
                                <label for="">Số điện thoại *</label>
                                <input type="text" class="form-control" id="phone" name="phone" required="">
                              </div>
                              <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="name">
                              </div>
                              <input type="hidden" name="service" value="<?= $blog->title ?>">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-success btn-block">Đăng ký   </button>
                            </form>
                        </div>
                    </div>

                    <div class="">
                        <h4>Bài viết liên quan</h4>
                        <ul>
                            @foreach ($relatedBlogs as $item)
                            <li><a href="/dich-vu/{{ $item->slug }}">{{ $item->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>





                </div>
                <div class="col-sm-3 right-col">
                    <div class="sponsor">
                            <a href="http://maiamaia.vn/tin-tuc-khuyen-mai"><img src="/standee.jpg" class="img-responsive"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

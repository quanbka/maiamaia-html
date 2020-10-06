@extends('frontend.layout.master', ['title' => "Đăng ký khám" ])
<style media="screen">
    div.category-detail-subtitles{
        display: block;
    }
</style>
@section('content')
    <main role="main">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 left-col">
            @if(session('status'))
                <div class="alert alert-success">
                  <strong>Cảm ơn!</strong> Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.
                </div>
            @endif

            <div class="col-md-6 col-md-offset-3">
                <form action="/dang-ky-kham" method="POST">
                  <div class="form-group">
                    <label for="">Số điện thoại *</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                  </div>
                  <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                  @if (isset($service))
                      <input type="hidden" name="service" value="<?= $service ?>">
                  @endif
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-success btn-block">Đăng ký   </button>
                </form>
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

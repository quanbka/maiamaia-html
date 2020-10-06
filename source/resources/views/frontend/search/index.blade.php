@extends('frontend.layout.master', ['title' => "Kết quả tìm kiếm" ])
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
          <h1 class="category-detail-title">Kết quả tìm kiếm</h1>
          <div class="row category-wrapper">
             @foreach ($posts as $key => $post)
                 <div class="col-sm-3 category-items">
                     <a href="/dich-vu/{{ $post->slug }}" class="category-link">
                         <span class="category-thumb">
                             <img class="img-responsive" src="{{ $post->image?$post->image:"/frontend/images/category-detail-thumb.jpg" }}" >
                         </span>
                         <div class="animate category-detail-subtitles">{{ $post->title }}</div>
                         <span class="animate category-detail-subtitles-desc">{{ $post->description }}</span>
                     </a>
                 </div>
             @endforeach
             @if(count($posts) == 0)
                 <div class="col-sm-12">
                     <p>Hiện tại danh mục này không có bài viết nào!</p>
                 </div>
             @endif


          </div>
          <div class="row">
              {{ $posts->render() }}
          </div>
          <div class="booknow-wrapper">
            <a href="{{ route('dang-ky-kham') }}" type="button" class="btn btn-primary rad0 btn-lg btn-block">Đặt lịch khám</a>
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

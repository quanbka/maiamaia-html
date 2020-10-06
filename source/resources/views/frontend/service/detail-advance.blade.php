@extends('frontend.layout.master', ['title' => $blog->title ])
<?php $content = json_decode($blog->content);?>
@section('content')
    <main role="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 left-col">
                    <h1 class="category-title"><?= $blog->title ?></h1>
                    <div class="focus-desc">
                        <?= $blog->description ?>
                    </div>
                    <div class="category-list-wrapper">
                        <?php if (isset($content->intro) && $content->intro) { ?>
                            <div class="category-list-items">
                                <h2 class="category-list-title">Giới thiệu</h2>
                                <h3 class="category-list-subtitles"><?=$blog->title?></h3>
                                <div class="category-list-long-desc">
                                    <?= $content->intro ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($content->faculty) && $content->faculty) { ?>
                            <div class="category-list-items">
                                <h2 class="category-list-title">Công dụng</h2>
                                <h3 class="category-list-subtitles"><?=$blog->title?></h3>
                                <div class="category-list-long-desc">
                                    <?= $content->faculty ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($content->procedure) && count($content->procedure) > 0) { ?>
                            <div class="category-list-items">
                                <h3 class="category-list-subtitles">Quy trình điều trị</h3>
                                <div class="category-list-long-desc">
                                    <?php foreach ($content->procedure as $key => $item) { ?>
                                    <div class="step-by-step">
                                        <h4><span> <?php echo $key + 1; ?> </span>Bước <?= $key + 1 ?>:</h4>
                                        <?= $item ?>
                                        <div class="clr"></div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($content->forte) && $content->forte) { ?>
                            <div class="category-list-items">
                                <h2 class="category-list-title">Ưu điểm</h2>
                                <h3 class="category-list-subtitles"><?=$blog->title?></h3>
                                <div class="category-list-long-desc">
                                    <?= $content->forte ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="booknow-wrapper">
                        <a href="/dang-ky-kham" type="button" class="btn btn-primary rad0 btn-lg btn-block">Đặt lịch khám</a>
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

<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".main-nav" aria-expanded="false">
                        <span class="sr-only">NAV</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/frontend/images/logo.png" ></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <?php
                $menu = [
                    [
                        'title' => "Giới thiệu",
                        'children' => [
                            [

                                'items' => [
                                    "Giới thiệu phòng khám",
                                    "Sứ mệnh & Tầm nhìn",
                                    "Cơ sở vật chất"
                                ]

                            ],
                        ]
                    ],
                    [
                        'title' => "Bệnh lý da liễu",
                        'children' => [
                            [

                                'items' => [
                                    "Bệnh viêm da",
                                    "Bệnh vẩy nến",
                                    "Bệnh tổ đỉa",
                                    "Bệnh á sừng",
                                    "Bệnh nấm da",
                                    "Bệnh mề đay",
                                    "Bệnh ghẻ",
                                    "Bệnh lang ben",
                                    "Bệnh hắc lào"
                                ]

                            ],
                            [

                                'items' => [
                                    "Mụn hạt cơm",
                                    "Mụn thịt",
                                    "Nốt ruồi",
                                    "U mềm treo",
                                    "U mềm lây",
                                    "Chàm - Bớt",
                                    "Bệnh Zona",
                                    "Bệnh herpes",
                                    "Bệnh thủy đậu",
                                ]

                            ],
                            [

                                'items' => [
                                    "Bệnh sùi mào gà",
                                    "Bệnh giang mai",
                                    "Bệnh lậu",
                                    "Bệnh lý da liễu khác"
                                ]

                            ],
                        ]
                    ],
                    [
                        'title' => "Thẩm mỹ công nghệ cao",
                        'children' => [
                            [

                                'items' => [
                                    "Căng da bằng công nghệ Ultherapy",
                                    "Căng da bằng công nghệ Thermage",
                                    "Căng da bằng chỉ thường",
                                    "Căng da bằng chỉ vàng",
                                    "Xóa nếp nhăn mắt công nghệ Gold Laser",
                                    "Trẻ hóa da toàn diện công nghệ Laser Yag",
                                    "Căng bóng da Glossy Skin"

                                ]

                            ],
                            [

                                'items' => [
                                    "Điều trị nám - tàn nhang công nghệ Picoris Laser",
                                    "Điều trị rạn da công nghệ cao",
                                    "Trị sẹo lồi công nghệ Laser Mixel",
                                    "Trị sẹo lõm công nghệ New Mixel ",
                                    "Trị hôi nách công nghệ Mira Sonic ",
                                    "Giảm béo công nghệ Ultra Shape"

                                ]

                            ],
                            [

                                'items' => [
                                    "Giãn mao mạch",
                                    "Nâng mũi S-line",
                                    "Tạo viềm hàm V-line",
                                    "Xóa bọng mắt",
                                    "Nâng cung mày",

                                ]

                            ],
                        ]
                    ],
                    [
                        'title' => "Điều trị & Chăm sóc da",
                        'children' => [
                            [
                                'heading' => "Điều trị mụn",
                                'items' => [
                                    "Mụn trứng cá",
                                    "Mụn ẩn",
                                    "Mụn đầu đen",
                                    "Mụn viêm, mụn mủ, mụn bọc",

                                ]

                            ],

                            [
                                'heading' => "Chăm sóc da mặt",
                                'items' => [

                                    "Làm sạch Maia MC",
                                    "Trị liệu chuyên nghiệp",
                                    "Trị liệu chuyên sâu da mụn (cấp độ nặng)",
                                    "Trị liệu vùng mắt",
                                    "Trị liệu bổ sung Collagen",
                                    "Jet Peel",

                                ]

                            ],
                            [
                                'heading' => "Chăm sóc da toàn thân",
                                'items' => [
                                    "Massage toàn thân",
                                    "Massage Thái Lan",
                                    "Massage đá nóng",
                                    "Tẩy da chết muối đường",
                                    "Tẩy da chết hương quế gừng",
                                    "Parafin tay",
                                    "Parafin chân",
                                    "Triệt lông công nghệ 5G+",


                                ]

                            ],
                            [
                                'heading' => "Điều trị thâm",
                                'items' => [
                                    "Thâm do mụn",
                                    "Thâm do tai nạn",
                                    "Thâm do gãi ngứa",
                                    "Thâm vùng nách"

                                ]

                            ],
                        ]
                    ],
                    [
                        'title' => "Video & Ảnh điều trị",
                        'children' => [
                            [
                                'heading' => "Video điều trị",
                                'items' => [
                                    "Video khách hàng điều trị",
                                    "Video bác sỹ tư vấn",
                                    "Gặp thầy thuốc nổi tiếng JOY FM",
                                ]

                            ],
                            [
                                'items' => [
                                    "Ảnh khách hàng trước & sau điều trị",


                                ]

                            ],
                        ]
                    ],
                    [
                        'title' => "Tin tức",
                        'children' => [
                            [
                                'items' => [
                                    "Tin tức khuyến mại",
                                    "Tin tức sức khỏe",
                                    "Tin tức nổi bật",

                                ]

                            ],
                        ]
                    ],
                ];
                ?>
                <div class="collapse navbar-collapse main-nav">
                    <ul class="nav navbar-nav fr">
                        @foreach ($menu as $item)
                            @if(isset($item['children']))
                                <li class="dropdown dropdown-large">
                                    <a href="/{{ str_slug($item['title']) }}" class="dropdown-toggle" data-toggle="dropdown">{!! $item['title'] !!} <b class="caret"></b></a>

                                    <ul class="dropdown-menu dropdown-menu-large row">
                                        <div class="container">
                                            <div class="row">
                                                @foreach($item['children'] as $child1)
                                                    <ul class="col-md-4 col-sm-6">
                                                        @if(isset($child1['heading']))
                                                            <h3><a href="javascript:void(0)">{{ $child1['heading'] }}</a></h3>
                                                        @endif
                                                        @foreach($child1['items'] as $child2)
                                                            <li><a href="/{{ str_slug($child2) }}">{!! $child2 !!}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endforeach
                                            </div>
                                        </div>




                                    </ul>

                                </li>
                            @else
                                <li><a href="/{{ str_slug($item['title']) }}">{!! $item['title'] !!}</a></li>
                            @endif
                        @endforeach
                        <!-- <li><a href="/gioi-thieu">Giới thiệu<br> MAIA & MAIA</a></li>
                        <li><a href="/phong-kham">Phòng khám <br>da liễu</a></li>
                        <li><a href="/tham-my-khong-phau-thuat">Thẩm mỹ <br>công nghệ cao</a></li>
                        <li><a href="/dieu-tri-cham-soc-da">Trị liệu <br>& chăm sóc da</a></li>
                        <li><a href="/kien-thuc-lam-dep">Kiến thức<br> Làm đẹp</a></li>
                        <li><a href="/video-lam-dep">Video <br>& Làm đẹp</a></li>
                        <li><a href="/dang-ky-kham">Đặt lịch <br>khám ngay</a></li>
                        <li class="dropdown dropdown-large">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Sản phẩm <b class="caret"></b></a>

                        <ul class="dropdown-menu dropdown-menu-large row">
                        <div class="container">
                        <div class="row">
                        <ul class="col-md-3 col-sm-6">
                        <h3><a href="javascript:void(0)">Heading 3</a></h3>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                        <li><a href="javascript:void(0)">Example</a></li>
                    </ul>
                    <ul class="col-md-3 col-sm-6">
                    <h3><a href="javascript:void(0)">Heading 3</a></h3>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                    <li><a href="javascript:void(0)">Example</a></li>
                </ul>
                <ul class="col-md-3 col-sm-6">
                <h3><a href="javascript:void(0)">Heading 3</a></h3>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
                <li><a href="javascript:void(0)">Example</a></li>
            </ul>
            <ul class="col-md-3 col-sm-6">
            <h3><a href="javascript:void(0)">Heading 3</a></h3>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
            <li><a href="javascript:void(0)">Example</a></li>
        </ul>
    </div>
</div>




</ul>

</li> -->
</ul>
</div>
<div class="clr"></div>
</div>
</div>
</nav>
</header>

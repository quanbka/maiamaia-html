<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <title>{{ isset($title) ? $title : "" }}</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/frontend/images/favicon.ico?1521443197" type="image/x-icon" />

    <meta name="theme-color" content="#a50051">
    <meta name="msapplication-navbutton-color" content="#a50051">
    <meta name="apple-mobile-web-app-status-bar-style" content="#a50051">
    <link rel="icon" sizes="192x192" href="/frontend/images/favicon.png?1521443197">

    <!--CSS-->
    <link href="/frontend/css/bootstrap.css?1521443197" rel="stylesheet" type="text/css" media="all"/>
    <link href="/frontend/fonts/fontawesome/css/fontawesome.css?1521443197" rel="stylesheet" type="text/css" media="all"/>
    <link href="/frontend/fonts/fontawesome/css/fontawesome-all.css?1521443197" rel="stylesheet" type="text/css" media="all"/>
    <!-- <link href="/frontend/css/slick.css?1521443197" rel="stylesheet" type="text/css" media="all"/> -->
    <link href="/frontend/css/style.css?1521443197" rel="stylesheet" type="text/css" media="all"/>
    <link href="/frontend/css/responsive.css?1521443197" rel="stylesheet" type="text/css" media="all"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500" rel="stylesheet">
    <link rel="stylesheet" href="/frontend/css/custom.css?1521443197">
    <!--[if lt IE 9]>
    <script src="frontend/js/html5shiv.min.js"></script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
     fbq('init', '709755602492553');
    fbq('track', 'PageView');
    </script>
    <noscript>
     <img height="1" width="1"
    src="https://www.facebook.com/tr?id=709755602492553&ev=PageView
    &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <!--Navigation-->
    @include('frontend.layout.header')
    <banner id="main-banner">

    </banner>

    @yield('content')

    @include('frontend.layout.footer')

    <script src="/frontend/js/jquery.min.js?v=1521443197" type="text/javascript"></script>
    <script src="/frontend/js/bootstrap.min.js?v=1521443197" type="text/javascript"></script>
    <!-- <script src="/frontend/js/slick.min.js?v=1521443197" type="text/javascript"></script> -->
    <script src="/frontend/js/script.js?v=1521443197" type="text/javascript"></script>

</body>

</html>

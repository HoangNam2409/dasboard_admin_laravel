<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">
    <link href="/template/css/customize.css" rel="stylesheet">
    @if (isset($config['css']) && is_array($config['css']))
        @foreach ($config['css'] as $key => $val)
            {!! '<link href="' . $val . '" rel="stylesheet">' !!}
        @endforeach
    @endif
    <script src="/template/js/jquery-2.1.1.js"></script>
    <script src="/template/library/library.js"></script>

</head>

<body>
    <div id="wrapper">
        @include('dashboard/component/sidebar')

        <div id="page-wrapper" class="gray-bg">
            @include('dashboard/component/nav')
            @include($template)
            @include('dashboard/component/footer')
        </div>
    </div>

    @include('dashboard/component/script')
</body>

</html>

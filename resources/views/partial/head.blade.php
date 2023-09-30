<meta charset="utf-8" />
<title>Studio | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="@yield('metaDescription')" />
<meta name="author" content="@yield('metaAuthor')" />
<meta name="keywords" content="@yield('metaKeywords')" />

@stack('metaTag')

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="/assets/css/vendor.min.css" rel="stylesheet" />
<link href="/assets/css/app.min.css" rel="stylesheet" />
<!-- ================== END BASE CSS STYLE ================== -->

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/xcode.min.css" /> --}}

<link rel="stylesheet" href="dist/css/bootstrap-select-country.min.css" />

@stack('css')

<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
          content="The leading real estate marketplace. Search millions of for-sale and rental listings, compare RyoLand® home values and connect with local professionals.">
    <meta name="keywords"
          content="ryoland, real estate, mls, commercial real estate, foreclosure, real estate agent, realty, buying a house, real estate broker, real estate news, free real estate">
    <meta name="author" content="RyoDev">
    <title>@yield('title') | {{ env('APP_NAME') }} - Real Estate, Apartments, Mortgages &amp; Home Values</title>

    @include('panels.styles')
</head>

<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">

    @include('panels.main.header')

    @include('panels.main.cart_menu')

    @include('panels.main.mobile_menu')

    <div class="ltn__utilize-overlay"></div>

    @include('panels.main.breadcrumb')

    @yield('content')

<!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Looking for a dream home?</h1>
                            <p>We can help you realize your dream of a new home</p>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="contact.html">Explore Properties <i
                                    class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->

    @include('panels.main.footer')

</div>
<!-- Body main wrapper end -->

@include('panels.scripts')
</body>
</html>

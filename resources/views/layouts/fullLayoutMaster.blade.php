@isset($pageConfigs)
{!! ThemeHelper::updatePageConfig($pageConfigs) !!}
@endisset

    <!DOCTYPE html>
@php $configData = ThemeHelper::applClasses() @endphp

<html class="loading {{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
      lang="@if (session()->has('locale')){{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }}@endif"
      data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
      @if ($configData['theme'] === 'dark') data-layout="dark-layout"@endif>

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
    <title>@yield('title') - Real Estate, Apartments, Mortgages &amp; Home Values</title>
    @include('panels.favicon')

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')
</head>


<body
    class="vertical-layout vertical-menu-modern {{ $configData['bodyClass'] }} {{ $configData['theme'] === 'dark' ? 'dark-layout' : '' }} {{ $configData['blankPageClass'] }} blank-page"
    data-menu="vertical-menu-modern" data-col="blank-page" data-framework="laravel"
    data-asset-path="{{ asset('/') }}">

<!-- BEGIN: Content-->
<div class="app-content content {{ $configData['pageClass'] }}">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-body">

            {{-- Include Startkit Content --}}
            @yield('content')

        </div>
    </div>
</div>
<!-- End: Content-->

{{-- include default scripts --}}
@include('panels/scripts')

<script type="text/javascript">
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

</body>

</html>

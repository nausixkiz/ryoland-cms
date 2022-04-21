<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

@stack('modals')
@livewireScripts
<script defer src="{{ asset(mix('vendors/js/alpinejs/alpine.js')) }}"></script>

<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script>
    @if(\Illuminate\Support\Facades\Session::has('toastr-success-message'))
        toastr['success']('{{ \Illuminate\Support\Facades\Session::get('toastr-success-message') }}', 'Success!', {
        closeButton: true,
        tapToDismiss: false,
        rtl: false
    });
    @endif
        @if(\Illuminate\Support\Facades\Session::has('toastr-error-message'))
        toastr['error']('{{ \Illuminate\Support\Facades\Session::get('toastr-error-message') }}', 'Error!', {
        closeButton: true,
        tapToDismiss: false,
        rtl: false
    });
    @endif
</script>

@stack('override-script')

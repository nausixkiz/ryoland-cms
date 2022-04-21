<!-- BEGIN: Footer-->
<footer
    class="footer footer-light {{($configData['footerType'] === 'footer-hidden') ? 'd-none':''}} {{$configData['footerType']}}">
    <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy;
      <script>document.write(new Date().getFullYear())</script><a class="ms-25"
                                                                  href="{{ \Illuminate\Support\Facades\Config::get('app.url') }}"
                                                                  target="_blank">{{ \Illuminate\Support\Facades\Config::get('app.name') }}</a>,
      <span class="d-none d-sm-inline-block">All rights Reserved</span>
    </span>
    </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

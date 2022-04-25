
@extends('layouts/contentLayoutMaster')

@section('title', 'Pricing')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/pages/page-pricing.css')}}">
@endsection

@section('content')
    <section id="pricing-plan">
        <!-- title text and switch button -->
        <div class="text-center">
            <h1 class="mt-5">Pricing Plans</h1>
            <p class="mb-2 pb-75">
                {{ config('app.name') }} offers competitive rates and pricing plans to help you find one that fits the needs and budget of your business.
            </p>
            <div class="d-flex align-items-center justify-content-center mb-5 pb-50">
                <h6 class="me-1 mb-0">Monthly</h6>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="priceSwitch" />
                    <label class="form-check-label" for="priceSwitch"></label>
                </div>
                <h6 class="ms-50 mb-0">Yearly</h6>
            </div>
        </div>
        <!--/ title text and switch button -->

        <!-- pricing plan cards -->
        <div class="row pricing-card">
            <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
                <div class="row">
                    <!-- basic plan -->
                    <div class="col-12 col-md-4">
                        <div class="card basic-pricing text-center">
                            <div class="card-body">
                                <img src="{{asset('images/illustration/Pot1.svg')}}" class="mb-2 mt-5" alt="svg img" />
                                <h3>Basic</h3>
                                <p class="card-text">A simple start for everyone</p>
                                <div class="annual-plan">
                                    <div class="plan-price mt-2">
                                        <span class="pricing-basic-value fw-bolder text-primary">{{ currency(19) }}</span>
                                    </div>
                                </div>
                                <ul class="list-group list-group-circle text-start">
                                    <li class="list-group-item">100 listing a month</li>
                                    <li class="list-group-item">Unlimited forms and surveys</li>
                                    <li class="list-group-item">Unlimited fields</li>
                                    <li class="list-group-item">Basic form creation tools</li>
                                    <li class="list-group-item">Support slowly</li>
                                </ul>
                                <div id="paypal-basic-button-container"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ basic plan -->

                    <!-- standard plan -->
                    <div class="col-12 col-md-4">
                        <div class="card standard-pricing popular text-center">
                            <div class="card-body">
                                <div class="pricing-badge text-end">
                                    <span class="badge rounded-pill badge-light-primary">Popular</span>
                                </div>
                                <img src="{{asset('images/illustration/Pot2.svg')}}" class="mb-1" alt="svg img" />
                                <h3>Standard</h3>
                                <p class="card-text">For small to medium businesses</p>
                                <div class="annual-plan">
                                    <div class="plan-price mt-2">
                                        <span class="pricing-standard-value fw-bolder text-primary">{{ currency(49) }}</span>
                                    </div>
                                </div>
                                <ul class="list-group list-group-circle text-start">
                                    <li class="list-group-item">Include <strong>Basic</strong></li>
                                    <li class="list-group-item">Unlimited listing</li>
                                    <li class="list-group-item">Unlimited forms and surveys</li>
                                    <li class="list-group-item">File upload up to 5GB storage</li>
                                </ul>
                                <div id="paypal-standard-button-container"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ standard plan -->

                    <!-- enterprise plan -->
                    <div class="col-12 col-md-4">
                        <div class="card enterprise-pricing text-center">
                            <div class="card-body">
                                <img src="{{asset('images/illustration/Pot3.svg')}}" class="mb-2" alt="svg img" />
                                <h3>Enterprise</h3>
                                <p class="card-text">Solution for big organizations</p>
                                <div class="annual-plan">
                                    <div class="plan-price mt-2">
                                        <span class="pricing-enterprise-value fw-bolder text-primary">{{ currency(99) }}</span>
                                    </div>
                                </div>
                                <ul class="list-group list-group-circle text-start">
                                    <li class="list-group-item">Include <strong>Basic</strong> and <strong>Standard</strong></li>
                                    <li class="list-group-item">Logic Jumps</li>
                                    <li class="list-group-item">Unlimited file upload size</li>
                                    <li class="list-group-item">Unlimited form creation tools</li>
                                    <li class="list-group-item">Support 24/7</li>
                                </ul>
                                <div  class="mt-2" id="smart-button-container">
                                    <div style="text-align: center;">
                                        <div id="paypal-enterprise-button-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ enterprise plan -->
                </div>
            </div>
        </div>
        <!--/ pricing plan cards -->
    </section>
@endsection

@section('page-script')
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('paypal.sandbox.client_id') }}&enable-funding=venmo&currency={{ currency()->getUserCurrency() }}" data-sdk-integration-source="button-factory"></script>
    <script>
        const priceSwitch = $('#priceSwitch'),
            priceBasicValue = $('.pricing-basic-value'),
            priceStandardValue = $('.pricing-standard-value'),
            priceEnterpriseValue = $('.pricing-enterprise-value');

        const basicYearlyPlan = '{{ currency(239) }}';
        const basicMonthlyPlan = '{{ currency(19) }}';
        const standardYearlyPlan = '{{ currency(499) }}';
        const standardMonthlyPlan = '{{ currency(49) }}';
        const enterpriseYearlyPlan = '{{ currency(1199) }}';
        const enterpriseMonthlyPlan = '{{ currency(99) }}';


        priceSwitch.on('change', function () {
            if ($(this).is(':checked')) {
                priceEnterpriseValue.html(enterpriseYearlyPlan);
                priceStandardValue.html(standardYearlyPlan);
                priceBasicValue.html(basicYearlyPlan);
            } else {
                priceEnterpriseValue.html(enterpriseMonthlyPlan);
                priceStandardValue.html(standardMonthlyPlan);
                priceBasicValue.html(basicMonthlyPlan);
            }
        });
        function initPayPalButton(element, currencyCode, amountValue) {
            paypal.Buttons({
                style: {
                    shape: 'pill',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'buynow',

                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"description":"Listing Permission","amount":{"currency_code":currencyCode,"value":amountValue}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                        if(orderData.status === 'COMPLETED')
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type:'POST',
                                url:'{{ route('api.payments.order.paypal.callback') }}',
                                data: {
                                    orderData:orderData,
                                    user_slug:'{{\Illuminate\Support\Facades\Auth::user()->slug}}'
                                },
                                dataType: "JSON",
                                success:function(data) {
                                    toastr['success']('Order ' + orderData.id + ' is successfully', 'Success!', {
                                        closeButton: true,
                                        tapToDismiss: false,
                                        rtl: false
                                    });
                                },
                                error:function(data) {
                                    toastr['error']('Something wrong. Please contact administrator or try again later!', 'Error!', {
                                        closeButton: true,
                                        tapToDismiss: false,
                                        rtl: false
                                    });
                                },
                            });
                        }
                    });
                },

                onError: function(err) {
                    console.log(err);
                }
            }).render(element);
        }
        initPayPalButton('#paypal-basic-button-container', '{{ currency()->getUserCurrency() }}', 19);
        initPayPalButton('#paypal-standard-button-container', '{{ currency()->getUserCurrency() }}', 49);
        initPayPalButton('#paypal-enterprise-button-container', '{{ currency()->getUserCurrency() }}', 99);
    </script>
@endsection

@extends('front.layout.layout')
@section('content')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
@endsection
<?php
// phpinfo();
// exit;
?>
<style>
    .card {

        border: none;
    }

    .card-header {
        padding: .5rem 1rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: none;
    }

    .btn-light:focus {
        color: #212529;
        background-color: #e2e6ea;
        border-color: #dae0e5;
        box-shadow: 0 0 0 0.2rem rgba(216, 217, 219, .5);
    }

    .form-control {

        height: 50px;
        border: 2px solid #eee;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #039be5;
        outline: 0;
        box-shadow: none;

    }

    .input {

        position: relative;
    }

    .input i {

        position: absolute;
        top: 16px;
        left: 11px;
        color: #989898;
    }

    .input input {

        text-indent: 25px;
    }

    .card-text {

        font-size: 13px;
        margin-left: 6px;
    }

    .certificate-text {

        font-size: 12px;
    }


    .billing {
        font-size: 11px;
    }

    .super-price {

        top: 0px;
        font-size: 22px;
    }

    .super-month {

        font-size: 11px;
    }


    .line {
        color: #bfbdbd;
    }

    .free-button {

        background: #1565c0;
        height: 52px;
        font-size: 15px;
        border-radius: 8px;
    }


    .payment-card-body {

        flex: 1 1 auto;
        padding: 24px 1rem !important;

    }

    .btn {
        font-family: "Open Sans", sans-serif !important;
        border-radius: 10px !important;
        padding: 14px 25px !important;
        font-size: 18px !important;
        line-height: 1 !important;
        transition: 0.2s !important;
    }
</style>
<!-- Content -->
<main class="main">
    <section class="section-box">
        <div class="container pt-50">
            <div class="w-50 w-md-100 mx-auto text-center">
                <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Payment Method</h1>
                <p class="mb-30 text-muted wow animate__animated animate__fadeInUp font-md">Submit your payment</p>
            </div>
        </div>
    </section>
    <div class="container mt-md-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <section class="mb-50">
                    <div class="row">
                        <div class="col-xl-9 col-md-12 mx-auto">
                            <!-- Success Message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <h1>Select Payment Method</h1>
                        <div class="container d-flex justify-content-center mt-5 mb-5">

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <span>Payment Method</span>
                                    <div class="card">

                                        <div class="accordion" id="accordionExample">

                                            <div class="card">
                                                <div class="card-header p-0" id="headingTwo">
                                                    <h2 class="mb-0">
                                                        <button
                                                            class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#collapseTwo" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">

                                                                <span>Paypal</span>
                                                                <img src="https://i.imgur.com/7kQEsHU.png"
                                                                    width="30">

                                                            </div>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                    data-parent="#accordionExample">
                                                    {{-- <form action="{{ route('paypal.create') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="amount" value="100.00">
                                                        <button type="submit" class="btn btn-primary mt-3 mb-3">Pay
                                                            with PayPal</button>
                                                    </form> --}}
                                                    <div class="card-body">
                                                        <form id="order-place-paypal" method="POST" action="{{ route('order.place') }}">
                                                            <input type="hidden" name="price"
                                                                value="{{ (float) $price ?? 0 }}" />

                                                            <!-- Hidden fields for PayPal data -->
                                                            <input type="hidden" name="payment_status"
                                                                value="" />
                                                            <input type="hidden" name="payment_id" value="" />
                                                            <input type="hidden" name="payer_id" value="" />
                                                            <input type="hidden" name="payment_method"
                                                                value="paypal" />
                                                            <input type="hidden" name="subscription_box" value="{{ $sub_type }}">

                                                            <div id="paypal-button-container-popup"></div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header p-0">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-light btn-block text-left p-3 rounded-0"
                                                            data-toggle="collapse" data-target="#collapseOne"
                                                            aria-expanded="true" aria-controls="collapseOne">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">

                                                                <span>Credit card</span>
                                                                <div class="icons">
                                                                    <img src="https://i.imgur.com/2ISgYja.png"
                                                                        width="30">
                                                                    <img src="https://i.imgur.com/W1vtnOV.png"
                                                                        width="30">
                                                                    <img src="https://i.imgur.com/35tC99g.png"
                                                                        width="30">
                                                                    <img src="https://i.imgur.com/2ISgYja.png"
                                                                        width="30">
                                                                </div>

                                                            </div>
                                                        </button>
                                                    </h2>
                                                </div>

                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                    data-parent="#accordionExample">
                                                    <form id="order-place-stripe" method="POST" action="{{ route('order.place') }}">
                                                        @csrf
                                                        <input type="hidden" name="payment_method" value="stripe">
                                                        <input type="hidden" name="subscription_box" value="{{ $sub_type }}">
                                                        <input type="hidden" name="price" value="{{ (float) $price ?? 0 }}" />
                                                        <div class="stripe-form-wrapper require-validation"
                                                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                            data-cc-on-file="false">
                                                            <div id="card-element"></div>
                                                            <div id="card-errors" role="alert"></div>
                                                            <div class="form-group">
                                                                <button class="btn btn-red btn-block blue-custom" type="button"
                                                                    id="stripe-submit">Pay Now
                                                                    ${{ (float) $price ?? 0 }}</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
<!-- End Content -->
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let paypalAmount = parseFloat('{{ $price }}'); // Set the amount to the value passed from the controller

    paypal.Button.render({
        env: 'sandbox', // Change to 'production' for live transactions

        style: {
            label: 'checkout',
            size: 'responsive',
            shape: 'rect',
            color: 'gold'
        },
        client: {
            sandbox: 'AR0NWTUnnZIoWXQR_CVmMcExhY7gigkcBfMzRAarXxJAhMk1M0Cb5vXwRbx24IUU5HY_r94D_dBSro2F',
            // production:'AQvr4F-7nIL9x_75uXUyX3X2gQgHfcg-jf_5V2ptEXECMLaXH-DFv-vTktIfZqHG8XZAEhv0wv40zl38',
        },
        validate: function(actions) {
            actions.disable();
            paypalActions = actions;
        },

        onClick: function(e) {
            paypalActions.enable();
            console.log(123213);
        },
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [{
                        amount: {
                            total: paypalAmount.toFixed(
                            2), // Ensure the amount is in the correct format
                            currency: 'USD'
                        }
                    }]
                }
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Handle payment success
                $.toast({
                    heading: 'Success!',
                    position: 'bottom-right',
                    text: 'Payment Authorized',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 1000,
                    stack: 6
                });

                var params = {
                    payment_status: 'Completed',
                    paymentID: data.paymentID,
                    payerID: data.payerID
                };

                console.log(123213);

                $('input[name="payment_status"]').val('Completed');
                $('input[name="payment_id"]').val(data.paymentID);
                $('input[name="payer_id"]').val(data.payerID);
                $('input[name="payment_method"]').val('paypal');
                $('#order-place-paypal').submit();
            });
        },
        onCancel: function(data, actions) {
            var params = {
                payment_status: 'Failed',
                paymentID: data.paymentID
            };
            // Handle payment cancellation
            $('input[name="payment_status"]').val('Failed');
            $('input[name="payment_id"]').val(data.paymentID);
            $('input[name="payer_id"]').val('');
            $('input[name="payment_method"]').val('paypal');
        }
    }, '#paypal-button-container-popup');

    // $(document).ready(function() {
    //     $('#order-place-paypal').on('submit', function(e) {
    //         e.preventDefault(); // Prevent default form submission

    //         // Capture the form data
    //         let formData = $(this).serializeArray();

    //         // Submit the form data via AJAX
    //         $.ajax({
    //             url: '{{ route("order.place") }}', // Adjust this URL as necessary
    //             type: 'POST',
    //             data: formData,
    //             success: function(response) {
    //                 // Handle success (e.g., redirect to a success page)
    //                 location.reload();
    //             },
    //             error: function(xhr, status, error) {
    //                 // Handle error (e.g., show an error message)
    //                 $.toast({
    //                     heading: 'Error!',
    //                     position: 'bottom-right',
    //                     text: 'There was an issue placing your order. Please try again.',
    //                     loaderBg: '#ff6849',
    //                     icon: 'error',
    //                     hideAfter: 5000,
    //                     stack: 6
    //                 });
    //             }
    //         });
    //     });
    // });

    var stripe = Stripe("{{ env('STRIPE_KEY') }}");

        // Create an instance of Elements.
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {
            style: style
        });
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                $(displayError).show();
                displayError.textContent = event.error.message;
            } else {
                $(displayError).hide();
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('order-place-stripe');

        $('#stripe-submit').click(function() {
            stripe.createToken(card).then(function(result) {
                var errorCount = checkEmptyFileds();
                if ((result.error) || (errorCount == 1)) {
                    // Inform the user if there was an error.
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        $(errorElement).show();
                        errorElement.textContent = result.error.message;
                    } else {
                        $.toast({
                            heading: 'Alert!',
                            position: 'bottom-right',
                            text: 'Please fill the required fields before proceeding to pay',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 5000,
                            stack: 6
                        });
                    }
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('order-place-stripe');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            console.log(form);
            // $('#payment_method').val('stripe');
            form.appendChild(hiddenInput);
            form.submit();
        }


        function checkEmptyFileds() {
            var errorCount = 0;
            $('form#order-place-stripe').find('.form-control').each(function() {
                if ($(this).prop('required')) {
                    if (!$(this).val()) {
                        $(this).parent().find('.invalid-feedback').addClass('d-block');
                        $(this).parent().find('.invalid-feedback strong').html('Field is Required');
                        errorCount = 1;
                    }
                }
            });
            return errorCount;
        }

    // $(document).ready(function() {
    //     const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    //     const elements = stripe.elements();

    //     const cardNumber = elements.create('cardNumber');
    //     cardNumber.mount('#card-number');

    //     const cardExpiry = elements.create('cardExpiry');
    //     cardExpiry.mount('#card-expiry');

    //     const cardCvc = elements.create('cardCvc');
    //     cardCvc.mount('#card-cvc');

    //     $('.order-place').on('submit', function(e) {
    //         e.preventDefault(); // Prevent default form submission

    //         stripe.createToken(cardNumber).then(function(result) {
    //             if (result.error) {
    //                 // Display error message to the user
    //                 $.toast({
    //                     heading: 'Error!',
    //                     position: 'bottom-right',
    //                     text: result.error.message,
    //                     loaderBg: '#ff6849',
    //                     icon: 'error',
    //                     hideAfter: 5000,
    //                     stack: 6
    //                 });
    //             } else {
    //                 // Add the Stripe token to the form data
    //                 let formData = $('.order-place').serializeArray();
    //                 console.log(formData);
    //                 formData.push({ name: 'stripeToken', value: result.token.id });

    //                 let csrfToken = $('meta[name="csrf-token"]').attr('content');

    //                 // Submit the form data via AJAX
    //                 $.ajax({
    //                     url: '{{ route("order.place") }}', // Adjust this URL as necessary
    //                     type: 'POST',
    //                     data: formData,
    //                     headers: {
    //                         'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
    //                     },
    //                     success: function(response) {
    //                         // Handle success (e.g., redirect to a success page)
    //                         if(response.error){
    //                             $.toast({
    //                                 heading: 'Error!',
    //                                 position: 'bottom-right',
    //                                 text: response.error,
    //                                 loaderBg: '#ff6849',
    //                                 icon: 'error',
    //                                 hideAfter: 5000,
    //                                 stack: 6
    //                             });
    //                         }else if(response.success){
    //                             $.toast({
    //                                 heading: 'Success!',
    //                                 position: 'bottom-right',
    //                                 text: response.success,
    //                                 loaderBg: '#ff6849',
    //                                 icon: 'success',
    //                                 hideAfter: 5000,
    //                                 stack: 6
    //                             });
    //                         }
    //                         console.log(response);
    //                         // location.reload();
    //                     },
    //                     error: function(xhr, status, error) {
    //                         // Handle error (e.g., show an error message)
    //                         $.toast({
    //                             heading: 'Error!',
    //                             position: 'bottom-right',
    //                             text: 'There was an issue placing your order. Please try again.',
    //                             loaderBg: '#ff6849',
    //                             icon: 'error',
    //                             hideAfter: 5000,
    //                             stack: 6
    //                         });
    //                     }
    //                 });
    //             }
    //         });
    //     });
    // });

</script>
@endsection

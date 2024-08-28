<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ecommerce website for BU Internship 2024">
    <meta name="keywords" content="Ecommerce, Bethlehem University, Frontend, Backend, Laravel, Internship">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Ecommerce BU Internship</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    @include('home.css')

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .breadcrumb-section {
            background: url('img/breadcrumb.jpg') no-repeat center center;
            background-size: cover;
            padding: 50px 0;
            color: #fff;
            text-align: center;
        }
        .breadcrumb-section h2 {
            margin-bottom: 20px;
            font-size: 36px;
        }
        .breadcrumb-section .breadcrumb__option a {
            color: #fff;
            text-decoration: none;
        }
        .breadcrumb-section .breadcrumb__option span {
            color: #f1f1f1;
        }
        .checkout {
            padding: 50px 0;
        }
        .panel {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
        }
        .panel-heading {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 20px;
        }
        .panel-title {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .panel-body {
            padding: 40px;
            background-color: #fff;
        }
        .form-row {
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            box-shadow: none;
            border: 1px solid #ddd;
            padding: 15px;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            padding: 15px;
            font-size: 20px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .alert {
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }
        .error {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('home.header')
    @include('home.Humberger')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ url('/') }}">Home</a>
                            <span>Checkout with card</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Section Begin -->
    <section class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payment Details</h3>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif

                            <form 
    role="form" 
    action="{{ route('stripe.post') }}" 
    method="post" 
    class="require-validation"
    data-cc-on-file="false"
    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
    id="payment-form">
    @csrf

    <input type="hidden" name="amount" value="{{ $totalPrice }}">

    <div class='form-row'>
        <div class='col-xs-12 form-group required'>
            <label class='control-label'>Name on Card</label>
            <input class='form-control' size='4' type='text' required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col-xs-12 form-group card required'>
            <label class='control-label'>Card Number</label>
            <input autocomplete='off' class='form-control card-number' size='20' type='text' required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col-xs-12 col-md-4 form-group cvc required'>
            <label class='control-label'>CVC</label>
            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' required>
        </div>
        <div class='col-xs-12 col-md-4 form-group expiration required'>
            <label class='control-label'>Expiration Month</label>
            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' required>
        </div>
        <div class='col-xs-12 col-md-4 form-group expiration required'>
            <label class='control-label'>Expiration Year</label>
            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' required>
        </div>
    </div>

    <div class='form-row'>
        <div class='col-md-12 error form-group hide'>
            <div class='alert alert-danger'>Please correct the errors and try again.</div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ number_format($totalPrice, 2) }})</button>
        </div>
    </div>
</form>
                        </div>
                    </div>        
                </div>
            </div>
        </div>               
    </section>

    @include('home.script')

</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
<script type="text/javascript">
  
$(function() {
  
    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/
    
    var $form = $(".require-validation");
     
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');
    
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
     
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    
    });
      
    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
                 
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
     
});
</script>
@include('home.script')
@include('home.footer')

</html>
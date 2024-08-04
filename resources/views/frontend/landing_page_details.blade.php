

<!doctype html>
@php
    $rtl = get_session_language()->rtl;
@endphp

@if ($rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name') . ' | ' . get_setting('site_motto'))</title>

    <meta charset="utf-8">
   

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))">
    @yield('meta')
    <!-- Favicon -->

    @php
        $site_icon = uploaded_asset(get_setting('site_icon'));
    @endphp
    <link rel="icon" href="{{ $site_icon }}">
    <link rel="apple-touch-icon" href="{{ $site_icon }}">

    {{-- goggle fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
    {{-- <link href="{{ asset('public/assets/landingPage') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('public/assets/landingPage') }}/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />






    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if ($rtl == 1)
        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?v=') }}{{ rand(1000, 9999) }}">
    <link rel="stylesheet" href="{{ static_asset('assets/css/custom-style.css') }}">

    <style>
     icon-shape {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    vertical-align: middle;
}

.icon-sm {
    width: 2rem;
    height: 2rem;
    
} 
    </style>

</head>

<body>
    <div id="app">
    <header id="header" class="pb-5">
        <div class="container header">
            <div class="row">
                <div class="col-lg-12 text-center mt-3">
                    <a class="testh py-20px mr-3 ml-0" href="{{ route('home') }}">
                        @php
                            $header_logo = get_setting('header_logo');
                        @endphp
                        @if ($header_logo != null)
                            <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"
                                class="header_logo">
                        @else
                            <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"
                                class="header_logo">
                        @endif
                    </a>
                    {{-- <a href="#">
                        <img class="img-fluid" src="assets/uploads/logo2.png">
                    </a> --}}
                </div>
            </div>
        </div>
        <div class="container banner pt-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-block text-center">
                    <h2 class="banner_headind mb-4">{{ $landingPage->title_1 }}</h2>
                    @if ($landingPage->top_video != null)
                        {!! $landingPage->top_video !!}
                    @else
                        @if ($landingPage->image_1 != null)
                            <img class="banner_image" src="{{ uploaded_asset($landingPage->image_1) }}"
                                class="rounded">
                        @endif
                    @endif
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-block">
                    <div class="description_1 mt-4">
                        {!! $landingPage->description !!}
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- section 2 --}}
    @if ($landingPage->title_2 != null || $landingPage->description_2 != null || $landingPage->image_2 != null)
        <div id="feature">
            <div class="Container">
                <div class="row">
                    <div class="col-lg-12 text-center mt-3 mb-3">
                        <h3 class="feature_title h1">{{ $landingPage->title_2 }}</h3>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center mt-5">
                        <div class="description_1">
                            {!! $landingPage->description_2 !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        @if ($landingPage->image_2 != null)
                            <img src="{{ uploaded_asset($landingPage->image_2) }}" width="100%"
                                class="rounded feature_image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- video section 1 --}}
    @if ($landingPage->video1_title != null || $landingPage->video1_link != null)
        <div id="video_1" class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="h1 mt-5">{{ $landingPage->video1_title }}</h3>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="mt-5 mb-5">
                            {!! $landingPage->video1_link !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- section 2 --}}
    @if ($landingPage->title_3 != null || $landingPage->description_3 != null || $landingPage->image_3 != null)
        <div id="feature">
            <div class="Container">
                <div class="row">
                    <div class="col-lg-12 col-12 text-center mt-3 mb-3">
                        <h3 class="feature_title h1">{{ $landingPage->title_3 }}</h3>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-center mt-5">
                        <div class="description_1">
                            {!! $landingPage->description_3 !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        @if ($landingPage->image_3 != null)
                            <img src="{{ uploaded_asset($landingPage->image_3) }}" width="100%"
                                class="rounded feature_image">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- video section 1 --}}
    @if ($landingPage->video2_title != null || $landingPage->video2_link != null)
        <div id="video_1" class="text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <h3 class="h1 mt-5">{{ $landingPage->video2_title }}</h3>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="mt-5 mb-5">
                            {!! $landingPage->video2_link !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- mobile section --}}

    <div id="mobile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center mobile">
                    <a href="tel:{{ $landingPage->phone }}">বিস্তারিত জানতে কল করুনঃ
                        {{ $landingPage->phone ?? null }}</a>
                </div>
            </div>
        </div>
    </div>

    {{-- review section --}}
    <div id="review">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center text-white mb-5">
                    <h3 class="h1 mt-5">Reviews</h3>
                </div>
            </div>
            <div class="row">
                @if ($landingPage->slide_image_1 != null)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <img src="{{ uploaded_asset($landingPage->slide_image_1) }}" alt="review"
                            class="review_image">
                    </div>
                @endif
                @if ($landingPage->slide_image_2 != null)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <img src="{{ uploaded_asset($landingPage->slide_image_2) }}" alt="review"
                            class="review_image">
                    </div>
                @endif
                @if ($landingPage->slide_image_3 != null)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <img src="{{ uploaded_asset($landingPage->slide_image_3) }}" alt="review"
                            class="review_image">
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- product section --}}
    <div id="product">
        <div class="container">
            <div class="row">
                @foreach ($landingPage->landing_page_products as $key => $flash_deal_product)
                    @php
                        $product = get_single_product($flash_deal_product->product_id);
                    @endphp
                    @if ($product != null && $product->published != 0)
                        @php
                            $product_url = route('product', $product->slug);
                            if ($product->auction_product == 1) {
                                $product_url = route('auction-product', $product->slug);
                            }
                        @endphp
                        @php
                            $cart_added = [];
                        @endphp
                        @php
                            $product_url = route('product', $product->slug);
                            if ($product->auction_product == 1) {
                                $product_url = route('auction-product', $product->slug);
                            }
                        @endphp
                        {{-- <div class="col text-center border-right border-bottom has-transition hov-shadow-out z-1">
                            @include('frontend.partials.product_box_1',['product' => $product])
                        </div> --}}
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-center" style="margin-bottom: 40px">
                            {{-- new --}}
                            <div class="card "  style="width: 18rem;">
                                <div class="card_imageposition-relative h-140px h-md-200px img-fit overflow-hidden">
                                <a href="{{ $product_url }}" class="">
                                    <img class="card-img-top"
                                        src="{{ $product->thumbnail != null ? my_asset($product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        alt="{{ $product->getTranslation('name') }}"
                                        title="{{ $product->getTranslation('name') }}">
                                </a>
                            </div>
                                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                              
                                <div class="card-body">
                                    <!-- Product name -->
                                    <div class="card-title ">
                                        <a href="{{ $product_url }}" class="d-block text-reset hov-text-primary"
                                            title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>

                                    </div>
                                    @if ($product->auction_product == 0)
                                        <!-- Previous price -->
                                        @if (home_base_price($product) != home_discounted_base_price($product))
                                            <div class="disc-amount has-transition">
                                                <del
                                                    class="fw-bolder text-secondary mr-1">{{ home_base_price($product) }}</del>
                                            </div>
                                        @endif
                                        <!-- price -->
                                        <div class="product_price">
                                            <span
                                                class="fw-bolder text-danger">{{ home_discounted_base_price($product) }}</span>
                                        </div>
                                    @endif
                                    @if ($product->auction_product == 1)
                                        <!-- Bid Amount -->
                                        <div class="">
                                            <span
                                                class="fw-700 text-primary">{{ single_price($product->starting_bid) }}</span>
                                        </div>
                                    @endif
                                   {{--@dd(json_decode($product->colors))--}}
                                    {{-- <form action="{{ route('landingCart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price" value="{{ home_base_price($product) }}">
                                        <button type="submit" class="btn btn-danger mt-2">Order Now</button>
                                    </form> --}}
                                    {{-- <a href="{{ $product_url }}" class="btn btn-danger mt-2">Order Now</a> --}}
                                    <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white bg-danger fs-13 fw-700 d-flex flex-column justify-content-center align-items-center @if (in_array($product->id, $cart_added)) active @endif"
                                        {{-- onclick="showAddToCartModal({{ $product->id }})" --}}
                                        @click="addTocard({{ $product }})">
                                 

                    
                                        <span><i class="las la-2x la-shopping-cart"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                 
                @endforeach
            </div>
        </div>
    </div>

   
    <section class="container mb-5">
        <div class="container-fluid">
            <div class="checkout">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-12 order">
                        <div class="section_main">
                            <h6 class="text-center my-3"><strong>অর্ডার কনফার্ম করতে আপনার নাম, ঠিকানা, মোবাইল নাম্বার
                                    লিখে অর্ডার কনফার্ম করুন বাটনে ক্লিক করুন</strong></h6>

                            <form class="form-default" data-toggle="validator"
                                action="{{ route('checkout.without_auth') }}" role="form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="customer_name" class="form-label">আপনার নাম</label>
                                            <input type="text" class="form-control" name="customer_name"
                                                id="customer_name" value="{{ Auth::user()->name ?? '' }}" required
                                                placeholder="আপনার নাম">
                                        </div>
                                        <div class="mb-3">
                                            <label for="mobile_number" class="form-label">আপনার মোবাইল নাম্বার</label>
                                            <input type="text" class="form-control" id="mobile_number"
                                                name="phone" placeholder="01900000000" required>
                                        </div>

                                       
                                     
                                        <div class="mb-3">
                                            <label for="City" class="form-label">আপনার এরিয়া সিলেক্ট করুন</label>
                                            <select class="form-control" v-model="selectedShipping" @change="getShippingValue" required>
                                        
                                                <option selected disabled>আপনার এরিয়া সিলেক্ট করুন</option>
                                                @php
                                                    $shippings=App\Models\Shipping::where('status',1)->get();
                                                
                                                @endphp
                                                {{--@dd($shippings)--}}
                                                @foreach ($shippings as $shipping)
                                                <option :value="{{ $shipping->cost }}">{{ $shipping->name }}</option>   
                                                @endforeach
                                            </select>
                                            {{-- <input type="number " name="shipping_id" value="1" hidden> --}}
                                        </div>
                                    </div>
                                </div>

                                <h3 class="fs-16 fw-700 text-dark mb-0">
                                    {{ translate('Select a payment option') }}
                                </h3>
                            </div>
                            <!-- Payment Options -->
                            <div class="text-center  pt-0">
                                <div class="row m-0">
                                    <!--Uddoktapay-->
                                    @if (get_setting('uddoktapay_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="uddoktapay" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-3">
                                                    <img src="{{ static_asset('assets/img/cards/uddoktapay.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-600 fs-15">{{ translate('BD Payment Methods') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- Paypal -->
                                    @if (get_setting('paypal_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="paypal" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/paypal.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Paypal') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!--Stripe -->
                                    @if (get_setting('stripe_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="stripe" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/stripe.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Stripe') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- Mercadopago -->
                                    @if (get_setting('mercadopago_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="mercadopago" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/mercadopago.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Mercadopago') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- sslcommerz -->
                                    @if (get_setting('sslcommerz_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="sslcommerz" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/sslcommerz.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('sslcommerz') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- instamojo -->
                                    @if (get_setting('instamojo_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="instamojo" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/instamojo.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Instamojo') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- razorpay -->
                                    @if (get_setting('razorpay') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="razorpay" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/rozarpay.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Razorpay') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- paystack -->
                                    @if (get_setting('paystack') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="paystack" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/paystack.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Paystack') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- voguepay -->
                                    @if (get_setting('voguepay') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="voguepay" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/vogue.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('VoguePay') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- payhere -->
                                    @if (get_setting('payhere') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="payhere" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/payhere.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('payhere') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- ngenius -->
                                    @if (get_setting('ngenius') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="ngenius" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/ngenius.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('ngenius') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- iyzico -->
                                    @if (get_setting('iyzico') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="iyzico" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/iyzico.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Iyzico') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- nagad -->
                                    @if (get_setting('nagad') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="nagad" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/nagad.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Nagad') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- bkash -->
                                    @if (get_setting('bkash') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="bkash" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/bkash.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Bkash') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- aamarpay -->
                                    @if (get_setting('aamarpay') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="aamarpay" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/aamarpay.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Aamarpay') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- authorizenet -->
                                    @if (get_setting('authorizenet') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="authorizenet" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/authorizenet.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Authorize Net') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- payku -->
                                    @if (get_setting('payku') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="payku" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/payku.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Payku') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- African Payment Getaway -->
                                    @if (addon_is_activated('african_pg'))
                                        <!-- flutterwave -->
                                        @if (get_setting('flutterwave') == 1)
                                            <div class="col-6 col-xl-3 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="flutterwave" class="online_payment"
                                                        type="radio" name="payment_option" checked>
                                                    <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                        <img src="{{ static_asset('assets/img/cards/flutterwave.png') }}"
                                                            class="img-fit mb-2">
                                                        <span class="d-block text-center">
                                                            <span
                                                                class="d-block fw-500 fs-12">{{ translate('flutterwave') }}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                        <!-- payfast -->
                                        @if (get_setting('payfast') == 1)
                                            <div class="col-6 col-xl-3 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="payfast" class="online_payment" type="radio"
                                                        name="payment_option" checked>
                                                    <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                        <img src="{{ static_asset('assets/img/cards/payfast.png') }}"
                                                            class="img-fit mb-2">
                                                        <span class="d-block text-center">
                                                            <span
                                                                class="d-block fw-500 fs-12">{{ translate('payfast') }}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                    @endif
                                    <!--paytm -->
                                    @if (addon_is_activated('paytm') && get_setting('paytm_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="paytm" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/paytm.jpg') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Paytm') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- toyyibpay -->
                                    @if (addon_is_activated('paytm') && get_setting('toyyibpay_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="toyyibpay" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/toyyibpay.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('ToyyibPay') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- myfatoorah -->
                                    @if (addon_is_activated('paytm') && get_setting('myfatoorah') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="myfatoorah" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                    <img src="{{ static_asset('assets/img/cards/myfatoorah.png') }}"
                                                        class="img-fit mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('MyFatoorah') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- khalti -->
                                    @if (addon_is_activated('paytm') && get_setting('khalti_payment') == 1)
                                        <div class="col-6 col-xl-3 col-md-4">
                                            <label class="aiz-megabox d-block mb-3">
                                                <input value="Khalti" class="online_payment" type="radio"
                                                    name="payment_option" checked>
                                                <span class="d-block aiz-megabox-elem p-2">
                                                    <img src="{{ static_asset('assets/img/cards/khalti.png') }}"
                                                        class="img-fluid mb-2">
                                                    <span class="d-block text-center">
                                                        <span
                                                            class="d-block fw-500 fs-12">{{ translate('Khalti') }}</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endif
                                    <!-- Cash Payment -->
                                    @if (get_setting('cash_payment') == 1)
                                        {{-- @php
                                            $digital = 0;
                                            $cod_on = 1;
                                            foreach ($carts as $cartItem) {
                                                $product = get_single_product($cartItem['product_id']);
                                                if ($product['digital'] == 1) {
                                                    $digital = 1;
                                                }
                                                if ($product['cash_on_delivery'] == 0) {
                                                    $cod_on = 0;
                                                }
                                            }
                                        @endphp --}}
                                        {{-- @if ($digital != 1 && $cod_on == 1) --}}
                                            <div class="col-6 col-xl-3 col-md-4">
                                                <label class="aiz-megabox d-block mb-3">
                                                    <input value="cash_on_delivery" class="online_payment"
                                                        type="radio" name="payment_option" checked>
                                                    <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                        <img src="{{ static_asset('assets/img/cards/cod.png') }}"
                                                            class="img-fit mb-2">
                                                        <span class="d-block text-center">
                                                            <span
                                                                class="d-block fw-500 fs-12">{{ translate('Cash on Delivery') }}</span>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        {{-- @endif --}}
                                    @endif
                                    @if (Auth::check())
                                        <!-- Offline Payment -->
                                        @if (addon_is_activated('offline_payment'))
                                            @foreach (get_all_manual_payment_methods() as $method)
                                                <div class="col-6 col-xl-3 col-md-4">
                                                    <label class="aiz-megabox d-block mb-3">
                                                        <input value="{{ $method->heading }}" type="radio"
                                                            name="payment_option" class="offline_payment_option"
                                                            onchange="toggleManualPaymentData({{ $method->id }})"
                                                            data-id="{{ $method->id }}" checked>
                                                        <span class="d-block aiz-megabox-elem rounded-0 p-2">
                                                            <img src="{{ uploaded_asset($method->photo) }}"
                                                                class="img-fit mb-2">
                                                            <span class="d-block text-center">
                                                                <span
                                                                    class="d-block fw-500 fs-12">{{ $method->heading }}</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
        
                                            @foreach (get_all_manual_payment_methods() as $method)
                                                <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                    @php echo $method->description @endphp
                                                    @if ($method->bank_info != null)
                                                        <ul>
                                                            @foreach (json_decode($method->bank_info) as $key => $info)
                                                                <li>{{ translate('Bank Name') }} -
                                                                    {{ $info->bank_name }},
                                                                    {{ translate('Account Name') }} -
                                                                    {{ $info->account_name }},
                                                                    {{ translate('Account Number') }} -
                                                                    {{ $info->account_number }},
                                                                    {{ translate('Routing Number') }} -
                                                                    {{ $info->routing_number }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
        
                                <!-- Offline Payment Fields -->
                                @if (addon_is_activated('offline_payment'))
                                    <div class="d-none mb-3 rounded border bg-white p-3 text-left">
                                        <div id="manual_payment_description">
        
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>{{ translate('Transaction ID') }} <span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control mb-3" name="trx_id"
                                                    id="trx_id" placeholder="{{ translate('Transaction ID') }}"
                                                    >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">{{ translate('Photo') }}</label>
                                            <div class="col-md-9">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose image') }}
                                                    </div>
                                                    <input type="hidden" name="photo" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
        
                                <!-- Wallet Payment -->
                                {{-- @if (Auth::check() && get_setting('wallet_system') == 1)
                                    <div class="py-4 px-4 text-center bg-soft-warning mt-4">
                                        <div class="fs-14 mb-3">
                                            <span class="opacity-80">{{ translate('Or, Your wallet balance :') }}</span>
                                            <span class="fw-700">{{ single_price(Auth::user()->balance) }}</span>
                                        </div>
                                        @if (Auth::user()->balance < $total)
                                            <button type="button" class="btn btn-secondary" disabled>
                                                {{ translate('Insufficient balance') }}
                                            </button>
                                        @else
                                            <button type="button" onclick="use_wallet()" class="btn btn-primary fs-14 fw-700 px-5 rounded-0">
                                                {{ translate('Pay with wallet') }}
                                            </button>
                                        @endif
                                    </div>
                                @endif --}}
                            </div>
                                <!-- Agree Box -->
                                <div class="pt-2  fs-14">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" required id="agree_checkbox">
                                        <span class="aiz-square-check"></span>
                                        <span>{{ translate('I agree to the') }}</span>
                                    </label>
                                    <a href="{{ route('terms') }}"
                                        class="fw-700">{{ translate('terms and conditions') }}</a>,
                                    <a href="{{ route('returnpolicy') }}"
                                        class="fw-700">{{ translate('return policy') }}</a> &
                                    <a href="{{ route('privacypolicy') }}"
                                        class="fw-700">{{ translate('privacy policy') }}</a>
                                </div>
                                <div class="row align-items-center pt-3  mb-4">
                                    <!-- Return to shop -->
                                    <div class="col-lg-6 col-12 ">
                                        <a href="{{ route('home') }}" class="btn btn-link fs-14 fw-700 px-0">
                                            <i class="las la-arrow-left fs-16"></i>
                                            {{ translate('Return to shop') }}
                                        </a>
                                    </div>
                                    <!-- Complete Ordert -->
                                    <div class="col-lg-6 col-12  text-right order_btn">
                                        <button type="button" @click="submitOrder()"
                                            class="btn btn-primary fs-14 fw-700 rounded-0 px-4">অর্ডার কনফার্ম
                                            করুন</button>
                                    </div>
                                </div>

                            </form>
                        </div>
           

                    <div class="col-lg-7 col-md-7 col-12 order summary_last">
                        <div class="section_main">
                            <h6 class="text-center my-3"><strong>অর্ডার ইনফরমেশন</strong></h6>
                            <div class="mb-4" id="cart-summary">
                                <div style="overflow-x:auto;">
                                    <table class="table table-borderless responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col"style="width:40px"></th>
                                                <th scope="col" style="width:80px">{{ translate('Product') }}</th>
                                                {{--<th scope="col">{{ translate('Product Name') }}</th>--}}
                                                {{-- <th scope="col">{{ translate('Size') }}</th>
                                                <th scope="col">{{ translate('Color') }}</th> --}}

                                                <th scope="col" style="width:100px">{{ translate('Price') }}</th>
                                                <th scope="col" style="width:60px" class="text-center">{{ translate('Qty') }}</th>
                                                <th scope="col" style="width:100px">{{ translate('Total Price') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item,index) in product" :key="item.id">
                                                <td>
                                                    <a href="javascript:void(0)"  @click="removeFromCart(item)"
                                                    class="btn btn-icon btn-sm btn-soft-primary bg-soft-warning hov-bg-primary btn-circle">
                                                    <i class="las la-trash fs-16"></i>
                                                </a>
                                                    </td>
                                                    <td>
                                                        <img :src="item.image" alt="Product Image" style="width: 50px; height: 50px;">
                                                        <p class="mt-2">@{{item.name}}</p>
                                                    </td>
                                                {{-- <td>
                                                    <select class="custom-select w-50 " id="inlineFormCustomSelect">
                                                        <option selected>Choose...</option>
                                                        <option v-for="size in item.sizes" :key="size" :value="size">@{{ size }}</option>  
                                                      </select>
                                                </td> --}}
                                                {{-- <td>
                                                    
                                            
                                                </td> --}}

                                                <td>
                                                    <i class="fa-solid fa-bangladeshi-taka-sign"></i>   @{{item.prices}}
                                                
                                                    {{--<span v-for="color in item.color" :key="color" class="aiz-megabox pl-0 mr-2 mb-0" :data-toggle="'tooltip'" >
                                                        <label>
                                                            <input
                                                                type="radio"
                                                                name="color"
                                                                :value="color"
                                                                :checked="index === 0"
                                                               
                                                        
                                                            >
                                                            <span class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">
                                                                <span class="size-25px d-inline-block rounded" :style="{ backgroundColor: color }"></span>
                                                            </span>
                                                        </label>
                                                    </span>--}}
                                                </td>
                                                <td>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="input-group w-auto justify-content-end align-items-center" style="display: contents !important;">
                                                                <input type="button" value="-" @click="decrement(item)" class="button-minus border rounded-circle icon-shape icon-sm mx-1 btn btn-icon btn-sm btn-soft-primary bg-soft-warning hov-bg-primary btn-circle" data-field="quantity">

                                                                <input type="number" step="1" max="10" v-model="item.quantity" class="quantity-field border-0 text-center w-25">
                                                                <input type="button" value="+" @click="increment(item)" class="button-plus border rounded-circle icon-shape icon-sm btn btn-icon btn-sm btn-soft-primary bg-soft-warning hov-bg-primary btn-circle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </div>
                                                    {{--@{{item.quantity}}--}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <i class="fa-solid fa-bangladeshi-taka-sign"></i>   @{{item.prices * item.quantity}}
                                                </td>

                                                {{--<td><a :href="item.url" target="_blank">Link</a></td>
                                                <td>{{ item.base_price }}</td>
                                                <td>{{ item.discounted_price }}</td>
                                                <td>{{ item.starting_bid }}</td>
                                                <td>{{ item.auction_product ? 'Yes' : 'No' }}</td>
                                                <td><button @click="greet(item)">Add to Cart</button></td>--}}
                                              
                                            </tr>
                                            <tr class="">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                {{-- <td></td>
                                                <td></td> --}}
                                                
                                                <td  >Sub Total</td>
                                                <td  ><i class="fa-solid fa-bangladeshi-taka-sign"></i>  @{{ totalPrice }}</td>
                                        </tr>
                                            <tr class="">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                {{-- <td></td>
                                                <td></td> --}}
                                                
                                                <td  >Shipping</td>
                                                <td  ><i class="fa-solid fa-bangladeshi-taka-sign"></i>  @{{ selectedShipping }}</td>
                                        </tr>
                                            <tr class="">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                {{-- <td></td>
                                                <td></td> --}}
                                                
                                                <td >Total</td>
                                        </button>
                                        <td ><i class="fa-solid fa-bangladeshi-taka-sign"></i>  @{{ totalPrice + selectedShipping }}</td>
                                        </tr>
                                        </tbody>
                                        
                                     
                                
                                    </table>

                                </div>
                                {{-- <div class="row mt-3">
                                    <div class="col-6 text-center">
                                        @guest
                                            <strong>অ্যাকাউন্ট থাকলে লগিন করুন</strong> <a
                                                href="{{ route('user.login') }}"
                                                class="btn btn-primary btn-sm ml-2">login</a>
                                        @endguest
                                    </div>
                                    <div class="col-6 text-center">
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#couponModal">
                                            কূপন থাকলে এপ্লাই করুন
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>



</div>



 {{--<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>--}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js" integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://unpkg.com/vue@3.0.0"></script>

 <script>
    const { createApp, ref, onMounted ,computed } = Vue;

    createApp({
        setup() {
            const message = ref('Hello imteaj sajid vue!');
            const product = ref([]);
         const selectedShipping =ref(0);
         const shipping =ref('');
      
            const addTocard = (data) => {
                console.log(data);
                console.log(data.thumbnail);
                console.log(window.location.origin + '/public/' + data.thumbnail.file_name);
                    
                let data_futch = product.value.find((item) => item.id == data.id);

                if (data_futch) {
                    data_futch.quantity = data_futch.quantity + 1;
                }
                else {
                    data.quantity = 1;
                  //  product.value.push(data);
                  product.value.push(
                    { 
                        id: data.id,
                      name: data.name,
                      image:(window.location.origin + '/public/' + data.thumbnail.file_name),
                      url: data.url,
                      quantity: 1,
                      prices: data.unit_price - data.discount,

                    }
                  )
                }
                //quantity update
                data_futch.quantity = data_futch.quantity ++;

            };
            const removeFromCart = (data) => {
               //remove from cart
               let datas = product.value.find((item) => item.id == data.id);
               let item = product.value.indexOf(datas);
               console.log(item);
                product.value.splice(item, 1);

            }
          

            const greet = (item) => {
                //addTocard(item);
                console.log(item);
            };
            const getSizes = (item) => {
                console.log(item.sizes);
            if (item.sizes && item.sizes.length > 0) {
                return item.sizes.values;
            }
            return [];
        };
            const data_futch = () => {
                
                product.value = [
                    @foreach ($landingPage->landing_page_products as $key => $flash_deal_product)
                        @php
                            $product = get_single_product($flash_deal_product->product_id);
                            $sizeOptions = json_decode($product->choice_options, true);
                            $sizes = isset($sizeOptions[0]['values']) ? json_encode($sizeOptions[0]['values']) : '[]';
                            $color = $product->colors;
                            //$price= home_base_price($product) - home_discounted_base_price($product);
                          
                            $price = $product->unit_price - $product->discount ;
                     
                        @endphp
 
                        @if ($product != null && $product->published != 0)
                            {
                                id: {{ $product->id }},
                                name: '{{ $product->name }}',
                                image: '{{ my_asset($product->thumbnail->file_name) }}',
                                url: '{{ $product->url }}',
                                base_price: '{{ home_base_price($product) }}',
                                discounted_price: '{{ home_discounted_base_price($product) }}',
                                starting_bid: '{{ $product->starting_bid }}',
                                auction_product: {{ $product->auction_product ? 'true' : 'false' }},
                                sizes: {!! $sizes !!},
                                color:{!! $color !!},
                                prices: '{{ $price }}',
                                quantity: 1,
                            },
                        @endif
                    @endforeach
                ];
            };

            const increment = (item) => {
            if (item.quantity < 10) {
                item.quantity++;
                console.log(`Incremented: ${item.name}, new quantity: ${item.quantity}`);
            }
        };

        const decrement = (item) => {
           
                if (item.quantity > 1) {
                item.quantity--;
                console.log(`Incremented: ${item.name}, new quantity: ${item.quantity}`);
                }
        };

        const getShippingValue = () =>{
            
          
        };

        const totalPrice = computed(() => {
            return product.value.reduce((total, item) => {
                return total + (item.prices * item.quantity) ;
            }, 0);
        });



        const printProduct = () => {
                console.log(product.value[0]);
            
            };

        const submitOrder = () => {
            alert('Order Submitted');
            console.log(product.value[0].id);
        }
          
            onMounted(() => {
               
                data_futch();
                add_city();
             
            });
           
            return {
                product,
                message,
                greet,
                addTocard,
                printProduct,
                getSizes,
                increment,
                decrement,removeFromCart,
                totalPrice,
                getShippingValue,
                selectedShipping,
                shipping,
                submitOrder
                 
                
            };
        }
    }).mount('#app');
</script>

<script src="{{ asset('public/assets/landingPage') }}/js/bootstrap.bundle.min.js"></>
    <script src="{{ asset('public/assets/landingPage') }}/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ static_asset('assets/js/aiz-core.js?v=') }}{{ rand(1000, 9999) }}"></script>



   <script>


   function data(id){
    // alert(id);
    if(!$('#modal-size').hasClass('modal-lg')){
        $('#modal-size').addClass('modal-lg');
    }
    $('#addToCart-modal-body').html(null);
    $('#addToCart').modal();
    $('.c-preloader').show();
    $.post('{{ route('cart.showCartModal') }}', 
    {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id}, function(data){
            $('#addToCart').modal();
        console.log(data);
        $('.c-preloader').hide();
        $('#addToCart-modal-body').html(data);
        AIZ.plugins.slickCarousel();
        AIZ.plugins.zoom();
        AIZ.extra.plusMinus();
        getVariantPrice();
    });
}
</script>
</body>

</html>

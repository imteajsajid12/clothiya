@extends('frontend.layouts.app')

@section('content')
    <style>
        @media (max-width: 767px){
            #flash_deal .flash-deals-baner{
                height: 203px !important;
            }
        }

        .aiz-category-menu .sub-cat-menu {
            /* display: none; */
            position: absolute;
            width: calc(100% - 185px);
            left: calc(155px);
            /* height: calc(100% + 20px); */
            height: 460px;
            overflow: hidden;
            top: 0;
            z-index: -1;
            background-color: #fff;
            overflow-y: auto;
            transition: 0.5s;
            opacity: 0;
        }

        .aiz-user-top-menu .user-top-nav-element:hover > a, .aiz-category-menu .category-nav-element:hover > a {
            z-index: 0;
        }

        .ctry-bg {
            background-color: #332525cf;
            color: #fff;
        }

        .heading-6 {
            font-size: 1rem !important;
        }

        .badge_title {
            padding: .45em 1.45em;
            font-size: 0.625rem;
            font-weight: 400;
        }

        .flash-content.c-scrollbar {
            overflow-y: auto;
            padding: 8px;
        }

        .c-height {
            height: 430px;
            max-height: 440px;
            min-height: 400px;
        }

        .flash-deal-item {
            background: #fff;
            border-radius: 7px;
            overflow: hidden;
            padding: 5px;
            margin-bottom: 10px;
            filter: drop-shadow(3px 4px 6px #eee);
        }

        .flash-deal-item:hover {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .flash-deal-item .img img {
            height: 54px;
        }

    </style>
    @php $lang = get_system_language()->code;  @endphp



    <!-- new Sliders -->
    <div class="home-banner-area mb-3">
        <div class="container" style="border-radius: 20px; margin-top: 10px">
            <div class="row no-gutters d-flex flex-wrap position-relative">
                <div class="col-lg-2 position-static d-none d-lg-block">
                    @include('frontend.'.get_setting("homepage_select").'.partials.category_menu')
                </div>

                <!--new Sliders -->
                <div class="col-lg-8 col-md-12">
                    <div class="home-slide">
                        @if (get_setting('home_slider_images', null, $lang) != null)
                           
                           

                            <div class="aiz-carousel dots-inside-bottom" data-autoplay="true" data-infinite="true" data-arrows="true" data-dots="true">
                                @php
                                    $decoded_slider_images = json_decode(get_setting('home_slider_images', null, $lang), true);
                                    $sliders = get_slider_images($decoded_slider_images);

                                    $home_slider_links = get_setting('home_slider_links', null, $lang);
                                    $home_slider_links = json_decode($home_slider_links, true );
                                   // rsort($home_slider_links);
                                @endphp
                            @foreach ($sliders as $key => $slider)
                                    <div>
                    
                                        <a href="{{ isset($home_slider_links [$key]) ? $home_slider_links[$key] : '' }}">
                                            <!-- Image -->
                                            <img class="d-block w-100 h-180px h-md-320px h-lg-460px lazyload overflow-hidden"
                                                src="{{ $slider ? my_asset($slider->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                alt="{{ env('APP_NAME') }} promo"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Todays deal -->
                {{-- @if(count($todays_deal_products) > 0) --}}
                <div class="col-lg-2 position-static d-none d-lg-block">
                    <div class="title text-center p-2 ctry-bg">
                        <h3 class="heading-6 mb-0">
                            {{ translate('Todays Deal') }}
                            <span class="badge badge_title badge-danger">{{ translate('Hot') }}</span>
                        </h3>
                    </div>
                    <div class="flash-content c-scrollbar c-height" style="background-color: #fff">
                        @php
                            $lang = get_system_language()->code;
                            $todays_deal_banner = get_setting('todays_deal_banner', null, $lang);
                            $todays_deal_banner_small = get_setting('todays_deal_banner_small', null, $lang);
                        @endphp
                        @foreach (filter_products(\App\Models\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key => $product)
                            @if ($product != null)
                                <a href="{{ route('product', $product->slug) }}" class="d-block flash-deal-item">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-5">
                                            <div class="img">
                                                <img class="lazyload img-fit"
                                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                data-src="{{ get_image($product->thumbnail) }}"
                                                alt="{{ $product->getTranslation('name') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                >
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="price ml-2 fw-700">
                                                <span class="d-block text-danger">{{ home_discounted_base_price($product) }}</span>
                                                @if(home_base_price($product) != home_discounted_base_price($product))
                                                    <del class="d-block text-danger">{{ home_base_price($product) }}</del>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
    



    <!-- Old Sliders -->
    {{-- <div class="home-banner-area mb-3">
        <div class="container" style="border-radius: 20px; margin-top: 10px">
            <div class="d-flex flex-wrap position-relative">
                <div class="position-static d-none d-xl-block">
                    @include('frontend.'.get_setting("homepage_select").'.partials.category_menu')
                </div>

                <!-- Sliders -->
                <div class="home-slider">
                    @if (get_setting('home_slider_images', null, $lang) != null)
                        <div class="aiz-carousel dots-inside-bottom" data-autoplay="false" data-infinite="true">
                            @php
                                $decoded_slider_images = json_decode(get_setting('home_slider_images', null, $lang), true);
                                $sliders = get_slider_images($decoded_slider_images);
                                $home_slider_links = get_setting('home_slider_links', null, $lang);
                            @endphp
                            @foreach ($sliders as $key => $slider)
                                <div class="carousel-box">
                                    <a href="{{ isset(json_decode($home_slider_links, true)[$key]) ? json_decode($home_slider_links, true)[$key] : '' }}">
                                        <!-- Image -->
                                        <img class="d-block mw-100 img-fit overflow-hidden h-180px h-md-320px h-lg-460px overflow-hidden"
                                            src="{{ $slider ? my_asset($slider->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                            alt="{{ env('APP_NAME') }} promo"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Featured Categories -->

    @if (count($featured_categories) > 0)
        <section class="mb-1 mb-md-1 mt-1 mt-md-1 " id="featured_categorie">
            <div class="container">
                <div class="bg-white">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Featured Categories') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                               href="{{ route('categories.all') }}">{{ translate('View All Categories') }}</a>
                        </div>
                    </div>
                </div>
                <!-- Categories -->
                <div class="bg-white px-sm-3">
                    <div class="aiz-carousel sm-gutters-17" data-items="8" data-xxl-items="8" data-xl-items="6" data-rows="2"
                         data-lg-items="5" data-md-items="4" data-sm-items="3" data-xs-items="2" data-arrows="true"
                         data-dots="false" data-autoplay="true" data-infinite="true">
                        @foreach ($featured_categories as $key => $category)
                            @php
                                $category_name = $category->getTranslation('name');
                            @endphp
                            <div
                                class="carousel-box position-relative text-center has-transition hov-scale-img hov-animate-outline border-right border-top border-bottom @if ($key == 0) border-left @endif">
                                <a href="{{ route('products.category', $category->slug) }}" class="d-block">
                                    <img
                                        src="{{ isset($category->bannerImage->file_name) ? my_asset($category->bannerImage->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="lazyload h-130px mx-auto has-transition p-2 p-sm-4 mw-100"
                                        alt="{{ $category->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </a>
                                <h6 class="text-dark mb-3 h-40px text-truncate-2">
                                    <a class="text-reset fw-700 fs-14 hov-text-primary"
                                       href="{{ route('products.category', $category->slug) }}"
                                       title="{{ $category_name }}">
                                        {{ $category_name }}
                                    </a>
                                </h6>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Flash Deal -->
    @php
        $flash_deal = get_featured_flash_deal();
    @endphp
    @if ($flash_deal != null)
        <section class="mb-1 mb-md-1 mt-1 mt-md-1" id="flash_deal">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                <!-- Top Section -->
                <div class="d-flex flex-wrap mb-2 mb-md-3 align-items-baseline">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="d-inline-block">{{ translate('Flash Sale') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                            class="ml-3">
                            <path id="Path_28795" data-name="Path 28795"
                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                transform="translate(-15 -5)" fill="#fcc201" />
                        </svg>
                    </h3>
                    <div>
                        <div class="aiz-count-down-circle"
                             end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>

                    </div>
                    <!-- Links -->


                </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="row gutters-16 gutters-md-16">
                    <!-- Flash Deals Products -->
                    {{-- <div class="col-xxl-12 col-lg-12 col-12">
                        <!-- Top Section -->
                        <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        </div>
                        @php
                            $flash_deal_products = get_flash_deal_products($flash_deal->id);
                        @endphp
                        <div class="aiz-carousel border-top arrow-inactive-none arrow-x-0"
                        data-items="5" data-xxl-items="8" data-xl-items="6" data-rows="1"
                        data-lg-items="5" data-md-items="4" data-sm-items="3" data-xs-items="1" data-arrows="true"
                        data-dots="false" data-autoplay="true" data-infinite="true">
                            @foreach ($flash_deal_products as $key => $flash_deal_product)
                                @php
                                    $product = get_single_product($flash_deal_product->product_id);
                                @endphp
                                @php
                                    $product_url = route('product', $flash_deal_product->product->slug);
                                    if ($flash_deal_product->product->auction_product == 1) {
                                        $product_url = route('auction-product', $flash_deal_product->product->slug);
                                    }
                                @endphp
                                <div
                                    class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center has-transition hov-shadow-out z-1"
                                    style="width: 100%; display: inline-block;">
                                    <a href="{{ $product_url }}"
                                       class="d-block py-md-3 overflow-hidden hov-scale-img"
                                       title="{{ $flash_deal_product->product->getTranslation('name') }}"
                                       tabindex="0">
                                        <!-- Image -->
                                        <img src="{{ get_image($flash_deal_product->product->thumbnail) }}"
                                             class="lazyload h-60px h-md-100px h-lg-140px mw-100 mx-auto has-transition"
                                             alt="{{ $flash_deal_product->product->getTranslation('name') }}"
                                             onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        <!-- Price -->
                                        <div
                                            class="fs-10 fs-md-14 mt-md-3 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price lh-1-5">
                                            <span
                                                class="d-block text-primary fw-700">{{ home_discounted_base_price($flash_deal_product->product) }}</span>
                                            @if (home_base_price($flash_deal_product->product) != home_discounted_base_price($flash_deal_product->product))
                                                <del
                                                    class="d-block fw-400 text-secondary">{{ home_base_price($flash_deal_product->product) }}</del>
                                            @endif
                                        </div>
                                    </a>
                                </div>

                            @endforeach
                        </div>

                    </div> --}}
                    <!-- new Flash Deals Products -->
                    <div class="col-xxl-12 col-lg-12 col-12">
                        <!-- Top Section -->
                        <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        </div>
                        @php
                            $flash_deal_products = get_flash_deal_products($flash_deal->id);
                        @endphp
                        <div class="aiz-carousel border-top arrow-inactive-none arrow-x-0"
                        data-items="5" data-xxl-items="8" data-xl-items="6" data-rows="1"
                        data-lg-items="5" data-md-items="4" data-sm-items="3" data-xs-items="2" data-arrows="true"
                        data-dots="false" data-autoplay="false" data-infinite="true">
                            @foreach ($flash_deal_products as $key => $flash_deal_product)
                                @php
                                    $product = get_single_product($flash_deal_product->product_id);
                                @endphp
                                @php
                                    $product_url = route('product', $flash_deal_product->product->slug);
                                    if ($flash_deal_product->product->auction_product == 1) {
                                        $product_url = route('auction-product', $flash_deal_product->product->slug);
                                    }
                                @endphp
                                <div class="carousel-box position-relative px-0 has-transition hov-animate-outline">
                                    <div class="px-3">
                                        @php
                                            $cart_added = [];
                                        @endphp
                                        <div class="aiz-card-box h-auto py-3 hov-scale-img">
                                            <div class="position-relative h-140px h-md-200px img-fit overflow-hidden">
                                                @php
                                                    $product_url = route('product', $product->slug);
                                                    if ($product->auction_product == 1) {
                                                        $product_url = route('auction-product', $product->slug);
                                                    }
                                                @endphp
                                                <!-- Image -->
                                                <a href="{{ $product_url }}" class="d-block h-100">
                                                    <img class="lazyload mx-auto img-fit has-transition"
                                                        src="{{ get_image($product->thumbnail) }}"
                                                        alt="{{ $product->getTranslation('name') }}" title="{{ $product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>

                                                <!-- Discount percentage tag -->
                                                @if (discount_in_percentage($product) > 0)
                                                    <span class="absolute-top-left bg-primary ml-1 mt-1 fs-11 fw-700 text-white w-35px text-center"
                                                        style="padding-top:8px;padding-bottom:8px;">-{{ discount_in_percentage($product) }}%</span>
                                                @endif
                                                <!-- Wholesale tag -->
                                                @if ($product->wholesale_product)
                                                    <span class="absolute-top-left fs-11 text-white fw-700 px-2 lh-1-8 ml-1 mt-1"
                                                        style="background-color: #455a64; @if (discount_in_percentage($product) > 0) top:25px; @endif">
                                                        {{ translate('Wholesale') }}
                                                    </span>
                                                @endif
                                                @if ($product->auction_product == 0)
                                                    <!-- wishlisht & compare icons -->
                                                    <div class="absolute-top-right aiz-p-hov-icon">
                                                        <a href="javascript:void(0)" class="hov-svg-white" onclick="addToWishList({{ $product->id }})"
                                                            data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4" viewBox="0 0 16 14.4">
                                                                <g id="_51a3dbe0e593ba390ac13cba118295e4" data-name="51a3dbe0e593ba390ac13cba118295e4"
                                                                    transform="translate(-3.05 -4.178)">
                                                                    <path id="Path_32649" data-name="Path 32649"
                                                                        d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                                                                        transform="translate(0 0)" fill="#919199" />
                                                                    <path id="Path_32650" data-name="Path 32650"
                                                                        d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                                                                        transform="translate(0 0)" fill="#919199" />
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <a href="javascript:void(0)" class="hov-svg-white" onclick="addToCompare({{ $product->id }})"
                                                            data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                                    d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                                    transform="translate(-2.037 -2.038)" fill="#919199" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <!-- add to cart -->
                                                    <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column justify-content-center align-items-center @if (in_array($product->id, $cart_added)) active @endif"
                                                        href="javascript:void(0)"
                                                        onclick="showAddToCartModal({{ $product->id }})">
                                                        <span class="cart-btn-text">
                                                            {{ translate('Add to Cart') }}
                                                        </span>
                                                        <span><i class="las la-2x la-shopping-cart"></i></span>
                                                    </a>
                                                @endif
                                                @if (
                                                    $product->auction_product == 1 &&
                                                        $product->auction_start_date <= strtotime('now') &&
                                                        $product->auction_end_date >= strtotime('now'))
                                                    <!-- Place Bid -->
                                                    @php
                                                        $carts = get_user_cart();
                                                        if (count($carts) > 0) {
                                                            $cart_added = $carts->pluck('product_id')->toArray();
                                                        }
                                                        $highest_bid = $product->bids->max('amount');
                                                        $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $product->starting_bid;
                                                    @endphp
                                                    <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column justify-content-center align-items-center @if (in_array($product->id, $cart_added)) active @endif"
                                                        href="javascript:void(0)" onclick="bid_single_modal({{ $product->id }}, {{ $min_bid_amount }})">
                                                        <span class="cart-btn-text">{{ translate('Place Bid') }}</span>
                                                        <br>
                                                        <span><i class="las la-2x la-gavel"></i></span>
                                                    </a>
                                                @endif
                                            </div>

                                            <div class="p-2 p-md-3 text-left">
                                                <!-- Product name -->
                                                <h3 class="fw-400 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px text-center">
                                                    <a href="{{ $product_url }}" class="d-block text-reset hov-text-primary"
                                                        title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 d-flex justify-content-center mt-3">
                                                    @if ($product->auction_product == 0)
                                                        <!-- Previous price -->
                                                        @if (home_base_price($product) != home_discounted_base_price($product))
                                                            <div class="disc-amount has-transition">
                                                                <del class="fw-400 text-secondary mr-1">{{ home_base_price($product) }}</del>
                                                            </div>
                                                        @endif
                                                        <!-- price -->
                                                        <div class="">
                                                            <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($product->auction_product == 1)
                                                        <!-- Bid Amount -->
                                                        <div class="">
                                                            <span class="fw-700 text-primary">{{ single_price($product->starting_bid) }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if (!$product->variant_product)
                                                <a class="btn btn-primary p-1 rounded-0 buy-now add-to-cart d-block mt-3"
                                                    href="javascript:void(0)"
                                                    onclick="productBuyNow({{ $product->id }})">
                                                    <span class="cart-btn-text">
                                                        {{ translate('অর্ডার করুন') }}
                                                    </span>
                                                </a>
                                                @else
                                                <a class="btn btn-primary p-1 rounded-0 buy-now add-to-cart d-block mt-3"
                                                    href="javascript:void(0)"
                                                    onclick="showAddToCartModal({{ $product->id }})">
                                                    <span class="cart-btn-text">
                                                        {{ translate('অর্ডার করুন') }}
                                                    </span>
                                                </a>    
                                                @endif    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>

        </section>

    @endif

    <!-- Today's deal -->
    {{-- <div id="todays_deal" class="mb-q mb-md-1 mt-1 mt-md-1">

    </div> --}}


    <!-- Banner section 1 -->
    @php $homeBanner1Images = get_setting('home_banner1_images', null, $lang);   @endphp
    @if ($homeBanner1Images != null)
        <div class="mb-1 mb-md-1 mt-1 mt-md-1">
            <div class="container">
                @php
                    $banner_1_imags = json_decode($homeBanner1Images);
                    $data_md = count($banner_1_imags) >= 2 ? 2 : 1;
                    $home_banner1_links = get_setting('home_banner1_links', null, $lang);
                @endphp
                <div class="w-100">
                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                        data-items="{{ count($banner_1_imags) }}" data-xxl-items="{{ count($banner_1_imags) }}"
                        data-xl-items="{{ count($banner_1_imags) }}" data-lg-items="{{ $data_md }}"
                        data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                        data-dots="false">
                        @foreach ($banner_1_imags as $key => $value)
                            <div class="carousel-box overflow-hidden hov-scale-img">
                                <a href="{{ isset(json_decode($home_banner1_links, true)[$key]) ? json_decode($home_banner1_links, true)[$key] : '' }}"
                                    class="d-block text-reset overflow-hidden">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                        class="img-fluid lazyload w-100 has-transition"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Featured Products -->
    <!-- <div id="section_featured">

    </div> -->
    @include('frontend.classic.partials.featured_products_section')
    <!-- Banner Section 2 -->
    @php $homeBanner2Images = get_setting('home_banner2_images', null, $lang);   @endphp
    @if ($homeBanner2Images != null)
        <div class="mb-1 mb-md-1 mt-1 mt-md-1">
            <div class="container">
                @php
                    $banner_2_imags = json_decode($homeBanner2Images);
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                    $home_banner2_links = get_setting('home_banner2_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner2_links, true)[$key]) ? json_decode($home_banner2_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif




    <div class="container" style="border-radius: 20px !important">
        <div class="row">
            <div class="col-xl-6">
    <!-- Best Selling  -->
    @include('frontend.minima.partials.best_selling_section')
            </div>
            <div class="col-xl-6">
    <!-- New Products -->
    @include('frontend.minima.partials.newest_products_section')
            </div>
        </div>
    </div>


    <!-- Banner Section 3 -->
    @php $homeBanner3Images = get_setting('home_banner3_images', null, $lang);   @endphp
    @if ($homeBanner3Images != null)
        <div class="mb-1 mb-md-1 mt-1 mt-md-1">
            <div class="container">
                @php
                    $banner_3_imags = json_decode($homeBanner3Images);
                    $data_md = count($banner_3_imags) >= 2 ? 2 : 1;
                    $home_banner3_links = get_setting('home_banner3_links', null, $lang);
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_3_imags) }}" data-xxl-items="{{ count($banner_3_imags) }}"
                    data-xl-items="{{ count($banner_3_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_3_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ isset(json_decode($home_banner3_links, true)[$key]) ? json_decode($home_banner3_links, true)[$key] : '' }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Auction Product -->
    @if (addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif

    <!-- Cupon -->
    {{--    @if (get_setting('coupon_system') == 1)--}}
    {{--        <div class="mb-2 mb-md-3 mt-2 mt-md-3"--}}
    {{--            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row py-5">--}}
    {{--                    <div class="col-xl-8 text-center text-xl-left">--}}
    {{--                        <div class="d-lg-flex">--}}
    {{--                            <div class="mb-3 mb-lg-0">--}}
    {{--                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"--}}
    {{--                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">--}}
    {{--                                    <defs>--}}
    {{--                                        <clipPath id="clip-pathcup">--}}
    {{--                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"--}}
    {{--                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"--}}
    {{--                                                stroke-width="2" />--}}
    {{--                                        </clipPath>--}}
    {{--                                    </defs>--}}
    {{--                                    <g id="Group_24326" data-name="Group 24326"--}}
    {{--                                        transform="translate(-274.201 -5254.611)">--}}
    {{--                                        <g id="Mask_Group_23" data-name="Mask Group 23"--}}
    {{--                                            transform="translate(-3652.459 1785.452) rotate(-45)"--}}
    {{--                                            clip-path="url(#clip-pathcup)">--}}
    {{--                                            <g id="Group_24322" data-name="Group 24322"--}}
    {{--                                                transform="translate(207 18.136)">--}}
    {{--                                                <g id="Subtraction_167" data-name="Subtraction 167"--}}
    {{--                                                    transform="translate(-12177 -8458)" fill="none">--}}
    {{--                                                    <path--}}
    {{--                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"--}}
    {{--                                                        stroke="none" />--}}
    {{--                                                    <path--}}
    {{--                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"--}}
    {{--                                                        stroke="none" fill="#fff" />--}}
    {{--                                                </g>--}}
    {{--                                            </g>--}}
    {{--                                        </g>--}}
    {{--                                        <g id="Group_24321" data-name="Group 24321"--}}
    {{--                                            transform="translate(-3514.477 1653.317) rotate(-45)">--}}
    {{--                                            <g id="Subtraction_167-2" data-name="Subtraction 167"--}}
    {{--                                                transform="translate(-12177 -8458)" fill="none">--}}
    {{--                                                <path--}}
    {{--                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"--}}
    {{--                                                    stroke="none" />--}}
    {{--                                                <path--}}
    {{--                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"--}}
    {{--                                                    stroke="none" fill="#fff" />--}}
    {{--                                            </g>--}}
    {{--                                            <g id="Group_24325" data-name="Group 24325">--}}
    {{--                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"--}}
    {{--                                                    height="2" transform="translate(120 5287)" fill="#fff" />--}}
    {{--                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"--}}
    {{--                                                    height="2" transform="translate(132 5287)" fill="#fff" />--}}
    {{--                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"--}}
    {{--                                                    height="2" transform="translate(144 5287)" fill="#fff" />--}}
    {{--                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"--}}
    {{--                                                    height="2" transform="translate(108 5287)" fill="#fff" />--}}
    {{--                                            </g>--}}
    {{--                                        </g>--}}
    {{--                                    </g>--}}
    {{--                                </svg>--}}
    {{--                            </div>--}}
    {{--                            <div class="ml-lg-3">--}}
    {{--                                <h5 class="fs-36 fw-400 text-white mb-3">{{ translate(get_setting('cupon_title')) }}</h5>--}}
    {{--                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-xl-4 text-center text-xl-right mt-4">--}}
    {{--                        <a href="{{ route('coupons.all') }}"--}}
    {{--                            class="btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-4"--}}
    {{--                            style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    @endif--}}









    <!-- Category wise Products -->

    <div id="section_home_categories" class="mb-2 mb-md-3 mt-2 mt-md-3">

    </div>

    <!-- Classified Product -->
    @if (get_setting('classified_product') == 1)
        @php
            $classified_products = get_home_page_classified_products(6);
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container ">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('Classified Ads') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>
                        </div>
                    </div>
                    <!-- Banner -->
                    @php
                        $classifiedBannerImage = get_setting('classified_banner_image', null, $lang);
                        $classifiedBannerImageSmall = get_setting('classified_banner_image_small', null, $lang);
                    @endphp
                    @if ($classifiedBannerImage != null || $classifiedBannerImageSmall != null)
                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ $classifiedBannerImageSmall != null ? uploaded_asset($classifiedBannerImageSmall) : uploaded_asset($classifiedBannerImage) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                    @endif
                    <!-- Products Section -->
                    <div class="bg-white">
                        <div class="row no-gutters border-top border-left">
                            @foreach ($classified_products as $key => $classified_product)
                                <div
                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">
                                    <div class="aiz-card-box p-2 has-transition bg-white">
                                        <div class="row hov-scale-img">
                                            <div class="col-4 col-md-5 mb-3 mb-md-0">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">
                                                    <img class="img-fluid lazyload mx-auto has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ isset($classified_product->thumbnail->file_name) ? my_asset($classified_product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h3
                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mb-3">
                                                    <span
                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>
                                                    <span
                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 p-3 text-info"
                                                        style="border-radius: 20px;">{{ translate('New') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-soft-danger fs-13 fw-700 p-3 text-danger"
                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif


    {{--    <div class="container">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-6 col-xl-6 ">--}}
    {{--                <!-- Top Sellers -->--}}
    {{--                @if (get_setting('vendor_system_activation') == 1)--}}
    {{--                    @php--}}
    {{--                        $best_selers = get_best_sellers(5);--}}
    {{--                    @endphp--}}
    {{--                    @if (count($best_selers) > 0)--}}
    {{--                        <section class="mb-1 mb-md-1 mt-1 mt-md-1 " id="top_sellers">--}}
    {{--                            <div class="container">--}}
    {{--                                <!-- Top Section -->--}}
    {{--                                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between ">--}}
    {{--                                    <!-- Title -->--}}
    {{--                                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0 ">--}}
    {{--                                        <span class="pb-3">{{ translate('Top Sellers') }}</span>--}}
    {{--                                    </h3>--}}
    {{--                                    <!-- Links -->--}}
    {{--                                    <div class="d-flex">--}}
    {{--                                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"--}}
    {{--                                           href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <!-- Sellers Section -->--}}
    {{--                                <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5"--}}
    {{--                                     data-xxl-items="5"--}}
    {{--                                     data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2"--}}
    {{--                                     data-xs-items="1.4"--}}
    {{--                                     data-arrows="true" data-dots="false">--}}
    {{--                                    @foreach ($best_selers as $key => $seller)--}}
    {{--                                        @if ($seller->user != null)--}}
    {{--                                            <div--}}
    {{--                                                class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">--}}
    {{--                                                <div class="position-relative px-3"--}}
    {{--                                                     style="padding-top: 2rem; padding-bottom:2rem;">--}}
    {{--                                                    <!-- Shop logo & Verification Status -->--}}
    {{--                                                    <div class="position-relative mx-auto size-100px size-md-120px">--}}
    {{--                                                        <a href="{{ route('shop.visit', $seller->slug) }}"--}}
    {{--                                                           class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"--}}
    {{--                                                           tabindex="0"--}}
    {{--                                                           style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">--}}
    {{--                                                            <img--}}
    {{--                                                                src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"--}}
    {{--                                                                data-src="{{ uploaded_asset($seller->logo) }}"--}}
    {{--                                                                alt="{{ $seller->name }}"--}}
    {{--                                                                class="img-fit lazyload has-transition"--}}
    {{--                                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">--}}
    {{--                                                        </a>--}}
    {{--                                                        <div--}}
    {{--                                                            class="absolute-top-right z-1 mr-md-2 mt-1 rounded-content bg-white">--}}
    {{--                                                            @if ($seller->verification_status == 1)--}}
    {{--                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001"--}}
    {{--                                                                     height="24"--}}
    {{--                                                                     viewBox="0 0 24.001 24">--}}
    {{--                                                                    <g id="Group_25929" data-name="Group 25929"--}}
    {{--                                                                       transform="translate(-480 -345)">--}}
    {{--                                                                        <circle id="Ellipse_637" data-name="Ellipse 637"--}}
    {{--                                                                                cx="12"--}}
    {{--                                                                                cy="12" r="12"--}}
    {{--                                                                                transform="translate(480 345)"--}}
    {{--                                                                                fill="#fff"/>--}}
    {{--                                                                        <g id="Group_25927" data-name="Group 25927"--}}
    {{--                                                                           transform="translate(480 345)">--}}
    {{--                                                                            <path id="Union_5" data-name="Union 5"--}}
    {{--                                                                                  d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"--}}
    {{--                                                                                  transform="translate(0 0)"--}}
    {{--                                                                                  fill="#3490f3"/>--}}
    {{--                                                                        </g>--}}
    {{--                                                                    </g>--}}
    {{--                                                                </svg>--}}
    {{--                                                            @else--}}
    {{--                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001"--}}
    {{--                                                                     height="24"--}}
    {{--                                                                     viewBox="0 0 24.001 24">--}}
    {{--                                                                    <g id="Group_25929" data-name="Group 25929"--}}
    {{--                                                                       transform="translate(-480 -345)">--}}
    {{--                                                                        <circle id="Ellipse_637" data-name="Ellipse 637"--}}
    {{--                                                                                cx="12"--}}
    {{--                                                                                cy="12" r="12"--}}
    {{--                                                                                transform="translate(480 345)"--}}
    {{--                                                                                fill="#fff"/>--}}
    {{--                                                                        <g id="Group_25927" data-name="Group 25927"--}}
    {{--                                                                           transform="translate(480 345)">--}}
    {{--                                                                            <path id="Union_5" data-name="Union 5"--}}
    {{--                                                                                  d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"--}}
    {{--                                                                                  transform="translate(0 0)"--}}
    {{--                                                                                  fill="red"/>--}}
    {{--                                                                        </g>--}}
    {{--                                                                    </g>--}}
    {{--                                                                </svg>--}}
    {{--                                                            @endif--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!-- Shop name -->--}}
    {{--                                                    <h2 class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">--}}
    {{--                                                        <a href="{{ route('shop.visit', $seller->slug) }}"--}}
    {{--                                                           class="text-reset hov-text-primary"--}}
    {{--                                                           tabindex="0">{{ $seller->name }}</a>--}}
    {{--                                                    </h2>--}}
    {{--                                                    <!-- Shop Rating -->--}}
    {{--                                                    <div class="rating rating-mr-1 text-dark mb-3">--}}
    {{--                                                        {{ renderStarRating($seller->rating) }}--}}
    {{--                                                        <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}--}}
    {{--                                                            {{ translate('Reviews') }})</span>--}}
    {{--                                                    </div>--}}
    {{--                                                    <!-- Visit Button -->--}}
    {{--                                                    <a href="{{ route('shop.visit', $seller->slug) }}"--}}
    {{--                                                       class="btn-visit">--}}
    {{--                                        <span class="circle" aria-hidden="true">--}}
    {{--                                            <span class="icon arrow"></span>--}}
    {{--                                        </span>--}}
    {{--                                                        <span class="button-text">{{ translate('Visit Store') }}</span>--}}
    {{--                                                    </a>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        @endif--}}
    {{--                                    @endforeach--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </section>--}}
    {{--                    @endif--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--            <div class="col-md-6">--}}
    {{--                <!-- Top Brands -->--}}
    {{--                @if (get_setting('top_brands') != null)--}}
    {{--                    <section class="mb-2 mb-md-3 mt-1 mt-md-1" id="top-brands">--}}
    {{--                        <div class="container">--}}
    {{--                            <!-- Top Section -->--}}
    {{--                            <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">--}}
    {{--                                <!-- Title -->--}}
    {{--                                <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>--}}
    {{--                                <!-- Links -->--}}
    {{--                                <div class="d-flex">--}}
    {{--                                    <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"--}}
    {{--                                       href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <!-- Brands Section -->--}}
    {{--                            <div class="bg-white px-3">--}}
    {{--                                <div--}}
    {{--                                    class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">--}}
    {{--                                    @php--}}
    {{--                                        $top_brands = json_decode(get_setting('top_brands'));--}}
    {{--                                        $brands = get_brands($top_brands);--}}
    {{--                                    @endphp--}}
    {{--                                    @foreach ($brands as $brand)--}}
    {{--                                        <div--}}
    {{--                                            class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">--}}
    {{--                                            <a href="{{ route('products.brand', $brand->slug) }}"--}}
    {{--                                               class="d-block p-sm-3">--}}
    {{--                                                <img--}}
    {{--                                                    src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"--}}
    {{--                                                    class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"--}}
    {{--                                                    alt="{{ $brand->getTranslation('name') }}"--}}
    {{--                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">--}}
    {{--                                                <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">--}}
    {{--                                                    {{ $brand->getTranslation('name') }}--}}
    {{--                                                </p>--}}
    {{--                                            </a>--}}
    {{--                                        </div>--}}
    {{--                                    @endforeach--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </section>--}}
    {{--                @endif--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{-- new top sellers --}}
    <!-- Top Sellers -->
    @if (get_setting('vendor_system_activation') == 1)
        @php
            $best_selers = get_best_sellers(5);
        @endphp
        @if (count($best_selers) > 0)
        {{-- <section class="mb-2 mb-md-3 mt-2 mt-md-3"> --}}
            <div class="container mt-2 mt-md-3 mb-2 mb-md-3 pb-4 pt-4" style="border-radius: 20px">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="pb-3">{{ translate('Top Sellers') }}</span>
                    </h3>
                    <!-- Links -->
                    <div class="d-flex">
                        {{-- <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary" --}}
                        <a class="font-medium px-4 py-1 text-white text-sm bg-primary rounded-pill"
                            href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>
                    </div>
                </div>
                <!-- Sellers Section -->
                <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5" data-xxl-items="5"
                    data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2" data-xs-items="1.4"
                    data-arrows="true" data-dots="false">
                    @foreach ($best_selers as $key => $seller)
                        @if ($seller->user != null)
                            <div
                                class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">
                                <div class="position-relative px-3" style="padding-top: 2rem; padding-bottom:2rem;">
                                    <!-- Shop logo & Verification Status -->
                                    <div class="position-relative mx-auto size-100px size-md-120px">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"
                                            tabindex="0"
                                            style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">
                                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                data-src="{{ uploaded_asset($seller->logo) }}" alt="{{ $seller->name }}"
                                                class="img-fit lazyload has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                        <div class="absolute-top-right z-1 mr-md-2 mt-1 rounded-content bg-white">
                                            @if ($seller->verification_status == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"
                                                    viewBox="0 0 24.001 24">
                                                    <g id="Group_25929" data-name="Group 25929"
                                                        transform="translate(-480 -345)">
                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"
                                                            cy="12" r="12" transform="translate(480 345)"
                                                            fill="#fff" />
                                                        <g id="Group_25927" data-name="Group 25927"
                                                            transform="translate(480 345)">
                                                            <path id="Union_5" data-name="Union 5"
                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                transform="translate(0 0)" fill="#3490f3" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"
                                                    viewBox="0 0 24.001 24">
                                                    <g id="Group_25929" data-name="Group 25929"
                                                        transform="translate(-480 -345)">
                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"
                                                            cy="12" r="12" transform="translate(480 345)"
                                                            fill="#fff" />
                                                        <g id="Group_25927" data-name="Group 25927"
                                                            transform="translate(480 345)">
                                                            <path id="Union_5" data-name="Union 5"
                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                transform="translate(0 0)" fill="red" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Shop name -->
                                    <h2 class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="text-reset hov-text-primary" tabindex="0">{{ $seller->name }}</a>
                                    </h2>
                                    <!-- Shop Rating -->
                                    <div class="rating rating-mr-1 text-dark mb-3">
                                        {{ renderStarRating($seller->rating) }}
                                        <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}
                                            {{ translate('Reviews') }})</span>
                                    </div>
                                    <!-- Visit Button -->
                                    <a href="{{ route('shop.visit', $seller->slug) }}" class="btn-visit">
                                        <span class="circle" aria-hidden="true">
                                            <span class="icon arrow"></span>
                                        </span>
                                        <span class="button-text">{{ translate('Visit Store') }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        {{-- </section> --}}
        @endif
    @endif

    {{-- new top sellers --}}

    {{-- new top brands --}}
    <!-- Top Brands -->
    @if (get_setting('top_brands') != null)
        {{-- <div class="mb-2 mb-md-3 mt-2 mt-md-3"> --}}
            <div class="container mt-2 mt-md-3 mb-2 mb-md-3 pb-4 pt-4" style="border-radius: 20px">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>
                    <!-- Links -->
                    <div class="d-flex">
                        {{-- <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary" --}}
                        <a class="font-medium px-4 py-1 text-white text-sm bg-primary rounded-pill"
                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>
                    </div>
                </div>
                <!-- Brands Section -->
                <div class="bg-white px-3">
                    <div
                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                        @php
                            $top_brands = json_decode(get_setting('top_brands'));
                            $brands = get_brands($top_brands);
                        @endphp
                        @foreach ($brands as $brand)
                            <div
                                class="col-sm-12 col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                    <img src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"
                                        class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                        alt="{{ $brand->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">
                                        {{ $brand->getTranslation('name') }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    @endif
    {{-- new top brands --}}

@endsection


@extends('backend.layouts.app')

@section('content')
<style>
    .stock_detail{
        padding: 1px;
        border: 2px solid red;
        display: block;
        margin-bottom: -15px;
    }
</style>
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Product wise stock report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <!--card body-->
            <div class="card-body">
                <form action="{{ route('stock_report.index') }}" method="GET">
                    <div class="form-group row offset-lg-2">
                        <label class="col-md-3 col-form-label">{{translate('Sort by Category')}} :</label>
                        <div class="col-md-5">
                            <select id="demo-ease" class="from-control aiz-selectpicker" name="category_id" required>
                                <option value="">{{ translate('Choose Category') }}</option>
                                @foreach (\App\Models\Category::all() as $key => $category)
                                    <option value="{{ $category->id }}" @if($sort_by == $category->id) selected @endif>{{ $category->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            {{-- <th>{{ translate('Stock') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                        
                              
                                <td><h6>{{ $product->getTranslation('name') }}</h6>
                                <div class="d-sm-flex justify-content-between d-block">
                                    <div class="mt-2">
                                        <p class="no-gutters">{{ translate('Total Stock :') }}@php
                                            $qty = 0;
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                            $totalOrders=App\Models\ProductStock::where('product_id',$product->id)->sum('qty');
                                            // $totalOrder=App\Models\OrderDetail::where('product_id',$product->id)->sum('quantity');
                                        @endphp
                                        {{-- <span style="font-weight: 600;">{{ $qty-$totalOrder }}</span> --}}
                                        <span style="font-weight: 600;">{{ $totalOrders }}</span>
                                        </p>
                                        @if ($product->variant_product) 
                                        {{ translate('Stock Description :') }}
                                        <p style="font-weight: 600;">
                                            @php
                                                $stockString = '';
                                                $stocksByColor = [];
                                                foreach ($product->stocks as $stock) {
                    
                                                        // $color = strtok($stock->variant, '-');
                                                        // $size = strtok('-');
                                                        $variant_parts = explode('-', $stock->variant);
                                                        $last_part = end($variant_parts);
                                                        $color = rtrim($stock->variant, '-' . $last_part);
                                                        $size = $last_part;
                                                        $quantity = $stock->qty; 
                                                        //- App\Models\OrderDetail::where('product_id', $product->id)->where('variation', $stock->variant)->sum('quantity');
                                                        
                                                        $stocksByColor[$color][$size] = $quantity;
                                                    }
                                                    foreach ($stocksByColor as $color => $sizes) {
                                                        $sizeQuantityPairs = [];
                                                        foreach ($sizes as $size => $quantity) {
                                                            $sizeQuantityPairs[] = " $size-($quantity) ";
                                                        }
                                                        $stockString .= "<span class='stock_detail'>"."$color-" . implode(',', $sizeQuantityPairs) ."</span>". "<br> ";
                                                    }
                                                    $stockString = rtrim($stockString, '<br> ');
                                                    echo $stockString;
                                            @endphp
                                        </p>
                                        @endif
                                    </div>
                                    <div>
                                        <img class="lazyload" style="width: 200px; height:200px; "
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ get_image($product->thumbnail) }}"
                                        alt="{{ $product->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </div>
                                </div>
                                    {{-- extra --}}
                                        {{-- @php
                                            $qty = 0;
                                            if($product->variant_product) {
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                    $variantSale= App\Models\OrderDetail::where('product_id',$product->id)->where('variation',$stock->variant)->sum('quantity');
                                                    $stockString = $stock->variant.'-'.'('.$stock->qty-$variantSale.')'.' , ';
                                                    echo $stockString;
                                                }
                                            }
                                        @endphp --}}
                                    {{-- extra --}}
                                </td>
                                {{-- <td>
                                    @php
                                        $qty = 0;
                                        foreach ($product->stocks as $key => $stock) {
                                            $qty += $stock->qty;
                                        }
                                        $totalOrder=App\Models\OrderDetail::where('product_id',$product->id)->sum('quantity');
                                    @endphp
                                    {{ $qty-$totalOrder }}
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $products->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Inhouse Product sale report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('in_house_sale_report.index') }}" method="GET">
                    <div class="form-group row">
                        {{-- <label class="col-md-3 col-form-label">{{translate('Sort by Category')}} :</label> --}}
                        <div class="col-md-5">
                            <select id="demo-ease" class="aiz-selectpicker" name="category_id">
                                <option value="">{{ translate('Choose Category') }}</option>
                                @foreach (\App\Models\Category::all() as $key => $category)
                                    <option value="{{ $category->id }}" @if($category->id == $sort_by) selected @endif >{{ $category->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="aiz-date-range form-control ml-2" value="{{ $date ?? null }}" name="date" placeholder="{{ translate('Filter by date') }}" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Num of Sale') }}</th>
                            <th>{{ translate('Actual Sale') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                                <td>{{ $product->getTranslation('name') }}</td>
                                <td>{{ $product->num_of_sale }}</td>
                                @php
                                if($date == null){ 
                                    $actualSale = App\Models\OrderDetail::where('product_id',$product->id)
                                    ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                                    ->where('orders.delivery_status', '!=', 'cancelled')
                                    ->sum('quantity');
                                }else {
                                    $actualSale = App\Models\OrderDetail::where('product_id',$product->id)
                                    ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
                                    ->where('orders.delivery_status', '!=', 'cancelled')
                                    ->where('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])) . '  00:00:00')
                                    ->where('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])) . '  23:59:59')
                                    ->sum('quantity');
                                }
                                @endphp
                                <td>{{ translate($actualSale) }}</td>
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

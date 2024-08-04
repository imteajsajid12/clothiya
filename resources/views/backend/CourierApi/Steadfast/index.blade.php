@extends('backend.layouts.app')

@section('content')
{{--validations--}}

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All SteadFast')}}</h1>
    </div>
</div>




<div class="container">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6">
            <div class="card">
              <div class="card-body">
            <h3 for="" class="text-center">SteadFast Access</h3><br><br>

            <form action="{{ route('steadfast.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">API URL</label>
                    <input type="text" name="api_url" class="form-control" value="{{ $datas[0]->api_url ?? 'N/A'}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Url">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your key with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">API Name</label>
                    <input type="text" class="form-control" value="" name="api_name" id="exampleInputPassword1" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">API Key</label>
                    <input type="text" class="form-control" value="" name="api_key" id="exampleInputPassword1" placeholder="Key">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Secret Key</label>
                    <input type="text" class="form-control" value="" name="api_secret" id="exampleInputPassword1" placeholder="secret">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 mt-2">
          
            <h3 for="" class="text-center">SteadFast Table</h3><br><br>
            <table class="table aiz-table mb-0 footable footable-1 breakpoint-xl " id="data-table">
                <thead>
                    <tr>
                        {{--<th>
                                    <div class="form-group">
                                        <div class="aiz-checkbox-inline">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" class="check-all" >
                                                <span class="aiz-square-check"></span>
                                            </label>
    
                                        </div>
                                    </div>
                                </th>--}}
                        <th data-breakpoints="lg">#</th>
                        <th data-breakpoints="md">{{ translate('Api Name') }}</th>
                        <th data-breakpoints="md">{{ translate('Api Key') }}</th>
                        <th data-breakpoints="md">{{ translate('Api Secret') }}</th>
                        <th data-breakpoints="md">{{ translate('options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key => $data)
                    <tr>
                        <td>
                            {{ $key+1 }}

                        </td>
                        <td>{{ $data->api_name}}</td>
                        <td>{{ $data->api_key}}</td>
                        <td>{{ $data->api_secret }}
                        </td>
                        <td>
                            <form method="post" action="{{ route('steadfast.destroy', $data->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-soft-danger btn-icon btn-circle btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                    <i class="las la-trash"></i>
                                </button>
                            </form>
                        </td>
                        @endforeach

                </tbody>
            </table>
            
        </div>
    </div>
</div>






@endsection


@section('script')
<script type="text/javascript">
    $(document).on("change", ".check-all", function() {
        if (this.checked) {
            // Iterate each checkbox
            $('.check-one:checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.check-one:checkbox').each(function() {
                this.checked = false;
            });
        }

    });

    function sort_customers(el) {
        $('#sort_customers').submit();
    }

    function confirm_ban(url) {
        $('#confirm-ban').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('confirmation').setAttribute('href', url);
    }

    function confirm_unban(url) {
        $('#confirm-unban').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('confirmationunban').setAttribute('href', url);
    }

    function bulk_delete() {
        var data = new FormData($('#sort_customers')[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: "{{route('bulk-customer-delete')}}"
            , type: 'POST'
            , data: data
            , cache: false
            , contentType: false
            , processData: false
            , success: function(response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }

</script>
@endsection

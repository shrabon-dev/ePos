@extends('layouts.backendMaster')
@section('style_body')
<link href="{{ asset('backend_assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('backend_assets') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

<link href="{{ asset('backend_assets') }}/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
<link href="{{ asset('backend_assets') }}/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
<link href="{{ asset('backend_assets') }}/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
@endsection
@section('backend_content')
{{-- Product Filter Form Start  --}}
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Search Form with valid information</h5>
        </div>
        <hr>
        <form class="row g-3" action="{{ route('sale.report') }}" method="GET">
            @csrf
            <div class="col-md-4">
                <label for="inputState" class="form-label">From Date</label>
                <input name="from_date" type="text" class="form-control datepicker picker__input" placeholder="select date..." readonly="" id="P278173751" aria-haspopup="true" aria-readonly="false" aria-owns="P278173751_root">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">To Date</label>
                <input name="to_date" type="text" class="form-control datepicker picker__input"  placeholder="select date..." readonly="" id="P278173751" aria-haspopup="true" aria-readonly="false" aria-owns="P278173751_root">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Payment Status</label>
                <select class="form-select" name="payment_status">
                    <option value="completed">Completed</option>
                    <option value="incomplete">Due</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Customer Name</label>
                <select name="customer" class="single-select select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                    <option value="" selected disabled>All</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}"  >{{ $customer->name }}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary px-5">Show</button>
                <a href="{{ route('sale.report') }}"  class="btn btn-info text-light px-5" >All Data</a>
                {{-- <button type="submit" class="btn btn-info px-5" id="clearFiltersButton">All Data</button> --}}
            </div>
        </form>
    </div>
</div>

{{-- Product Report Show Table Start  --}}
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <table class="table table-sm mb-0">
            <thead>
                <tr>
                    <th scope="col">SL. No</th>
                    <th scope="col">Sale Date</th>
                    <th scope="col">Sales By</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Invoice Total</th>
                    <th scope="col">Paid Payment</th>
                    <th scope="col">Due Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($filteredSales as $sale)
                    <tr>
                        <th scope="row">#{{ $sale->id }}</th>
                        <td>{{ $sale->created_at}}</td>
                        <td>{{ $sale->relationWithSaleBy->name }}</td>
                        <td>{{ $sale->relationWithCustomer->name }}</td>
                        <td>{{ $sale->total_price }}</td>
                        <td>{{ $sale->paid }}</td>
                        <td>{{ $sale->due }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="color: red;text-align:center;font-weight:700">Sorry, we not found any data!!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script_body')
<script src="{{ asset('backend_assets') }}/plugins/select2/js/select2.min.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/datetimepicker/js/legacy.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/datetimepicker/js/picker.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/datetimepicker/js/picker.time.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/datetimepicker/js/picker.date.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
<script src="{{ asset('backend_assets') }}/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>
<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: true
    }),
    $('.timepicker').pickatime()

    $(function () {
        $('#date-time').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#date').bootstrapMaterialDatePicker({
            time: false
        });
        $('#time').bootstrapMaterialDatePicker({
            date: false,
            format: 'HH:mm'
        });
    });
</script>
@endsection

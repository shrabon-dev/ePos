@extends('layouts.backendMaster')
@section('style_body')
<link href="{{ asset('backend_assets') }}/plugins/select2/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('backend_assets') }}/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endsection
@section('backend_content')
{{-- Product Filter Form Start  --}}
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <h5 class="mb-0 text-primary">Search Form with valid information</h5>
        </div>
        <hr>
        <form class="row g-3" action="{{ route('product.report') }}" method="GET">
            @csrf
            <div class="col-md-4">
                <label for="inputState" class="form-label">Name of Product</label>
                <select name="name_of_product" class="single-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option value="" disabled selected > -- Select A Product Name --</option>

                    @foreach ($productName as $product)
                        <option value="{{ $product->name }}" >{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Brand of Product</label>
                <select name="brand_of_product" class="single-select select2-hidden-accessible" data-select2-id="2" tabindex="-1" aria-hidden="true">
                    <option value="" disabled selected > -- Select A Brand Name --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Category Product</label>
                <select name="category_of_product" class="single-select select2-hidden-accessible" data-select2-id="3" tabindex="-1" aria-hidden="true">
                    <option value="" disabled selected > -- Select A Category Name --</option>
                    @foreach ($category as $categ)
                        <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary px-5">Show</button>
                <a href="{{ route('product.report') }}"  class="btn btn-info text-light px-5" >All Data</a>

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
                    <th scope="col">Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Category</th>
                    <th scope="col" style="color: #00696d">Current Stock</th>
                    <th scope="col" style="color: #ff5e00">Stock Value</th>
                    {{-- <th scope="col" style="color: #006eff">Total Sell</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->index+1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->relationWithBrand->name }}</td>
                    <td>{{ $product->relationWithCategory->name }}</td>
                    <td style="color: #00696d">{{ $product->quantity }} Pcs</td>
                    <td style="color: #ff5e00">TK.{{ $product->quantity*$product->price }}</td>
                    <td style="color: #006eff">
                        @foreach ($totalSales->where('product_id',$product->id) as $totalSale)
                        {{ $totalSale->quantity }} Pcs
                        @endforeach
                    </td>
                    {{-- <td>
                        <div class="font-22 text-primary">	<i class="lni lni-arrow-down"></i>
                        </div>
                        <div class="font-22 text-primary">	<i class="lni lni-arrow-up"></i>
                        </div>
                    </td> --}}
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
</script>
@endsection

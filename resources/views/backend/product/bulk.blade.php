@extends('layouts.backendMaster')

@section('backend_content')
<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Bulk Product Upload</h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.post.bulk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="form-control mb-0" name="product">
                    <p class="form-label block pt-2" style="color: rgb(255, 123, 0)">**** Upload CSV/XLSX/XLS file ****</p>
                    <button type="submit" class="btn btn-info px-5 mt-3">Submit</button>
                </form>
                 @if (session('message'))
                   <div
                    class="alert alert-primary mt-2"
                    role="alert"
                   >
                    <h4 class="alert-heading">{{ session('message') }}</h4>

                   </div>

                 @endif
            </div>
        </div>
    </div>
</div>
@endsection


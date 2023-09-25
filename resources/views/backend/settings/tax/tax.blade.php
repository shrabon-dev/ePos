@extends('layouts.backendMaster')
@section('backend_content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tax Add & Lists</li>
            </ol>
        </nav>
    </div>
</div>
<div class="card">
    <div class="card-body">
        @if ($errors->any())
         @foreach ($errors->all() as $error)
         <div class="alert alert-danger" role="alert">
            <strong>{{ $error }}</strong>
         </div>
         @endforeach
        @endif
        <div class="p-4 border rounded">
            <form class="row g-3 needs-validation" novalidate="" action="{{ route('tax.store') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tax Name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="tax_name" placeholder="name here..." required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Tax Percentage</label>
                    <input type="number" class="form-control" id="validationCustom01" name="percentage" placeholder="percentage here...">
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Status</label>
                    <select class="form-select" id="validationCustom04" name="status" required="">
                       <option value="active">Active</option>
                       <option value="deactive">Deactive</option>
                    </select>
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Create </button>
                </div>
            </form>
        </div>
    </div>
</div>
<h6 class="mb-0 text-uppercase">Tax List</h6>
<hr>
<div class="card">
    <div class="card-body">
        <table class="table mb-0 table-hover">
            <thead>
                <tr>
                    <th scope="col">SL. No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Percentage</th>
                    <th scope="col">Status</th>
                    <th scope="col">Create at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taxs as $tax)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $tax->tax_name }}</td>
                        <td>{{ $tax->percentage }}%</td>
                        <td>@if ($tax->status == 'active')
                                <span class="badge bg-primary">{{ $tax->status }}</span>
                            @else
                                <span class="badge bg-danger">{{ $tax->status }}</span>
                            @endif
                        </td>
                        <td>{{ $tax->created_at->format('d-M-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script_body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function(){
        $('.delete').click(function(e){

            var form =  $(this).closest("form");
            e.preventDefault();

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            )
            }
            })
        })
    })
</script>

@if (session('status'))
<script>
 const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: '{{ session('status') }}'
        })
</script>
@endif
@endsection

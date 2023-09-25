@extends('layouts.backendMaster')
@section('backend_content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Forms</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Brand Add & Lists</li>
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
            <form class="row g-3 needs-validation" novalidate="" action="{{ route('brand.store') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Brand name</label>
                    <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="name here..." required="">
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Brand slug</label>
                    <input type="text" class="form-control" id="validationCustom01" name="slug" placeholder="slug here...">
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
<h6 class="mb-0 text-uppercase">Brand List</h6>
<hr>
<div class="card">
    <div class="card-body">
        <table class="table mb-0 table-hover">
            <thead>
                <tr>
                    <th scope="col">SL. No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $brand->name }}</td>
                    <td>{{ $brand->slug }}</td>
                    <td>
                        @if ($brand->status == 'active')
                        <span style="font-size: 14px" class="badge text-white bg-primary">{{ $brand->status }}</span>
                        @else
                            <span style="font-size: 14px" class="badge text-white  bg-danger">{{ $brand->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal{{ $brand->id }}" style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; " title="edit" ><i class="lni lni-pencil"></i></a>
                        {{-- <a style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:blue" title="view" href="#"><i class="fadeIn animated bx bx-show"></i></a> --}}

                        <form style="display: inline-block" action="{{ route('brand.destroy',$brand->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                             <button style="display:inline-flex;width: 30px; height:30px; box-shadow: 0 0  3px 0 #00000045;font-size:16px; justify-content:center;align-items:center; color:red;background: transparent;border:none;" title="delete"  class="delete border-none" type="submit">
                                <i class="fadeIn animated bx bx-trash-alt"></i></button>
                        </form>

                    </td>
                </tr>

                <div class="col">


                    <!-- Modal -->
                    <div class="modal fade" id="exampleVerticallycenteredModal{{ $brand->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
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
                                            <form action="{{ route('brand.update', $brand->id) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="col-md-12 pb-2">
                                                    <label for="validationCustom01" class="form-label">Brand name</label>
                                                    <input type="text" class="form-control" id="validationCustom01" name="name" value="{{ $brand->name }}" placeholder="name here..." required="">
                                                </div>
                                                <div class="col-md-12 pb-2">
                                                    <label for="validationCustom01" class="form-label">Brand slug</label>
                                                    <input type="text" class="form-control" id="validationCustom01" name="slug" value="{{ $brand->slug }}" placeholder="slug here..." >
                                                </div>
                                                <div class="col-md-12 pb-2">
                                                    <label for="validationCustom04" class="form-label">Status</label>
                                                    <select class="form-select" id="validationCustom04" name="status" required="">
                                                       <option @if ($brand->status == 'active')
                                                        selected
                                                       @endif value="active">Active</option>
                                                       <option @if ($brand->status == 'deactive')
                                                        selected
                                                       @endif value="deactive">Deactive</option>
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="submit">Updated </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

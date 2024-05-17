@extends('layouts.backendMaster')
@section('backend_content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Site Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">View & Edit</li>
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
            <form action="{{ route('site.setting') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach ($siteSettings as $item)
                @if ($item->name == 'company_logo')
                <div class="row mb-3">
                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">{{ Str::title(Str::replace('_', ' ', $item->name)) }}</label>
                    <div class="col-sm-9">
                        <input type="file" name="{{ $item->name }}" class="form-control" value="{{ $item->value }}"  placeholder="name">
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <label for="inputEmailAddress2" class="col-sm-3 col-form-label">{{ Str::title(Str::replace('_', ' ', $item->name)) }}</label>
                    <div class="col-sm-9">
                        <input type="text" name="{{ $item->name }}" class="form-control" value="{{ $item->value }}"  placeholder="name">
                    </div>
                </div>
                @endif
                @endforeach
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info px-5 text-light text-bold">Update</button>
                        </div>
                    </div>
            </form>
        </div>
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

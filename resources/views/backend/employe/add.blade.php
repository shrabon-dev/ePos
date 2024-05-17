@extends('layouts.backendMaster')
@section('backend_content')
<div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
        <div class="card border-top border-0 border-4 border-info">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                        </div>
                        <h5 class="mb-0 text-info">Employe Add</h5>
                    </div>
                    <hr>

                    {{-- Error Message Alert Start --}}
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                        @endif
                    {{-- Error Message Alert End --}}

                    <form action="{{ route('employe.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row mb-3">
                                <label for="inputEnterYourName" class="col-sm-3 col-form-label">Employe Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="inputEnterYourName" placeholder="Employe name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="contact_number" class="form-control" id="inputPhoneNo2" placeholder="Phone Number">
                                </div>
                            </div>
                            {{-- Profile Image Start --}}
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-4 col-form-label">Employe Photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="photo" class="form-control" id="inputPhoneNo2" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <picture>
                                        <img style="width: 100px;height:100px;border-radius:100%;display:block;object-fit:none" src="https://cdn.vectorstock.com/i/preview-1x/48/06/image-preview-icon-picture-placeholder-vector-31284806.jpg" alt="">
                                    </picture>
                                </div>
                            </div>
                            {{-- Profile Image End --}}
                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="inputEmailAddress2" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" name="address" class="form-control" id="inputEmailAddress2" placeholder="Address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Reference</label>
                            <div class="col-sm-9">
                                <input type="text" name="reference" class="form-control" id="inputEmailAddress2" placeholder="Reference">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Job Type</label>
                            <div class="col-sm-9">
                                <select name="job_type" id="" class="form-control">
                                    <option value="" disabled selected>Select job type...</option>
                                    <option value="full_time">Full Time</option>
                                    <option value="part_time">Part Time</option>
                                    <option value="intern">Intern</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Salary</label>
                            <div class="col-sm-9">
                                <input type="number" name="salary" class="form-control" id="inputEmailAddress2" placeholder="Salary...">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info px-5">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script_body')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('message'))
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
        title: '{{ session('message') }}'
        })
</script>
@endif
@endsection

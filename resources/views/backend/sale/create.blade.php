@extends('layouts.backendMaster')
@section('backend_content')

    @livewire('pos')

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
    title: '{{ session('message') }}',
    })
</script>
@endif

@endsection


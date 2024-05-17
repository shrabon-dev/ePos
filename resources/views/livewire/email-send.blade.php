<div>
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">eCommerce</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row justify-content-center align-items-start g-2">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div class="position-relative">
                            <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                        </div>
                      <div class="ms-auto"><a wire:click="emailSendAllUser()" href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Send All</a></div>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>SL No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                    <th>Send for today</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse  ($users as $user)
                                {{-- @foreach ($sale as $item) --}}
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0 font-14">#{{ $user->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><div>{{ $user->name}}</div></td>
                                    <td><div>{{ $user->email}}</div></td>
                                    <td>
                                        <div class="toggleswitch">
                                            <input type="checkbox" wire:click="emailSend({{ $user->id }})" name="toggleswitch myButton"  class="toggleswitch-checkbox" id="myonoffswitch{{ $user->id }}" checked>
                                            <label class="toggleswitch-label" for="myonoffswitch{{ $user->id }}">
                                                  <span class="toggleswitch-inner"></span>
                                                  <span class="toggleswitch-switch"></span>
                                              </label>
                                          </div>
                                    </td>
                                    <td>
                                        @if (session()->has('sendForToday_'.$user->id))
                                            <div class="font-22 text-primary"><i class="lni lni-checkmark"></i></div>
                                        @else
                                            <div class="font-22 text-danger"><i class="lni lni-close"></i></div>
                                        @endif
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">
                                            No Sales yet!!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card text-white bg-primary">
            <div class="card-body">
                <h4 class="text-light">Email Template </h4>
                <hr>

            </div>
            </div>
        </div>
    </div>

    @if(session()->has('livewire_notification_message'))
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
        });

        Toast.fire({
            icon: 'success',
            title: @json(session('livewire_notification_message'))
        });

        setTimeout(function () {
            @this.call('clearNotification');
        }, 1000);
    </script>
@endif
<!-- Add this script in your Livewire component blade file or your layout file -->
<script>
    Livewire.on('disableButton', function () {
        // Disable the button
        document.getElementByClassName('myButton').disabled = true;

        // Enable the button after a delay (e.g., 2 seconds)
        setTimeout(function () {
            document.getElementById('myButton').disabled = false;
        }, 2000);
    });
</script>

</div>

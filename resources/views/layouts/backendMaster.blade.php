
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('backend_assets') }}/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
    <link href="{{ asset('backend_assets') }}/plugins/Drag-And-Drop/dist/imageuploadify.min.css" rel="stylesheet" />
	<link href="{{ asset('backend_assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
	<link href="{{ asset('backend_assets') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('backend_assets') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('backend_assets') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('backend_assets') }}/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('backend_assets') }}/js/pace.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<!-- Bootstrap CSS -->
	<link href="{{ asset('backend_assets') }}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('backend_assets') }}/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('backend_assets') }}/css/app.css" rel="stylesheet">
	<link href="{{ asset('backend_assets') }}/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('backend_assets') }}/css/dark-theme.css" />
	<link rel="stylesheet" href="{{ asset('backend_assets') }}/css/semi-dark.css" />
	<link rel="stylesheet" href="{{ asset('backend_assets') }}/css/header-colors.css" />
    <title>ePos</title>

    <style>
        .activeCircle{
            width: 10px;
            height: 10px;
            display: inline-block;
            background: rgb(0, 225, 255);
            border-radius: 100%;
            margin-left: 25px;
            position: relative;
            animation: scale .8s ease infinite;
        }
        .activeCircle::after{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%)
            width: 16px;
            height: 16px;
            background: rgb(0, 195, 255);
            border-radius: 100%;
            content:'';
            animation: scale .4s .2s infinite;
        }
        @keyframes scale{
            0%{
                transform: scale(1);
            }
            0%{
                transform: scale(1.3);
            }
        }
    </style>

    @yield('style_body')
    @livewireStyles
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<a href="{{ route('dashboard') }}"><img src="{{ asset('storage/logo') }}/{{ \App\Models\SiteSetting::where('name', 'company_logo')->first()->value ?? 'Default Company Name' }}" class="logo-icon" alt="logo icon"></a>
				</div>
				<div>
					<h4 class="logo-text">{{ \App\Models\SiteSetting::where('name', 'company_name')->first()->value ?? 'Default Company Name' }}</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
            @php
                $url = url()->current() ;
                $segments = explode('/', $url);
                $current_url = end($segments);
            @endphp
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{ route('dashboard') }}" >
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-user-circle"></i>
						</div>
						<div class="menu-title">User Management</div>
					</a>
					<ul>

                        @role('super-admin')
                            <li @if ( $current_url == 'add-user')class="mm-active" @endif > <a href="{{ route('add.user') }}"><i class="bx bx-right-arrow-alt"></i>Add User</a>
                            </li>
                            <li @if ( $current_url == 'user-list')class="mm-active" @endif> <a href="{{ route('user.list') }}"><i class="bx bx-right-arrow-alt"></i>User List</a>
                            </li>
                        @endrole
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-shopping-basket"></i>
						</div>
						<div class="menu-title">Product</div>
					</a>
					<ul>
                        {{-- @role('super-admin') --}}
                            <li @if ( $current_url == 'product')class="mm-active" @endif > <a href="{{ route('product.index') }}"><i class="bx bx-right-arrow-alt"></i>Products</a>
                            </li>
                            <li @if ( $current_url == 'product/create')class="mm-active" @endif > <a href="{{ route('product.create') }}"><i class="bx bx-right-arrow-alt"></i>New Product Add</a>
                            </li>
                            <li @if ( $current_url == 'product/bulk')class="mm-active" @endif > <a href="{{ route('product.add.bulk') }}"><i class="bx bx-right-arrow-alt"></i>Bulk Product Add</a>
                            </li>
                            <li @if ( $current_url == 'category')class="mm-active" @endif > <a href="{{ route('category.index') }}"><i class="bx bx-right-arrow-alt"></i>Category</a>
                            </li>
                            <li @if ( $current_url == 'brand')class="mm-active" @endif > <a href="{{ route('brand.index') }}"><i class="bx bx-right-arrow-alt"></i>Brand</a>
                            </li>
                            <li @if ( $current_url == 'barcode')class="mm-active" @endif > <a href="{{ route('barcode.index') }}"><i class="bx bx-right-arrow-alt"></i>BarCode</a>
                            </li>
                        {{-- @endrole --}}
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-grid-alt"></i>
						</div>
						<div class="menu-title">Supplier </div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'supplier.create')class="mm-active" @endif > <a href="{{ route('supplier.create') }}"><i class="bx bx-right-arrow-alt"></i>Add Supplier</a></li>
                            <li @if ( $current_url == 'supplier.index')class="mm-active" @endif > <a href="{{ route('supplier.index') }}"><i class="bx bx-right-arrow-alt"></i>Supplier List</a></li>
                        @endrole
					</ul>
				</li>
                @role('super-admin')
                <li @if ( $current_url == 'sale/create')class="mm-active" @endif > <a href="{{ route('sale.create') }}"><div class="parent-icon"><span class="material-symbols-outlined">
                    point_of_sale
                    </span>
                </div> <div class="menu-title">Pos</div> </a>
                </li>
                @endrole
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="fadeIn animated bx bx-money"></i>
						</div>
						<div class="menu-title">Sale</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'sale')class="mm-active" @endif> <a href="{{ route('sale.index') }}"><i class="bx bx-right-arrow-alt"></i>Sale List <span class="badge bg-primary" style="margin: 0 5px">{{ salesCount()->count() }}</span> <div class="spinner-grow spinner-grow-sm bg-info ml-5" role="status"> <span class="visually-hidden"></span>
                            </div></a>
                            </li>
                        @endrole
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon">
                            <i class="lni lni-users"></i>
						</div>
						<div class="menu-title">Employe Manage</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'employe.create')class="mm-active" @endif > <a href="{{ route('employe.create') }}"><i class="bx bx-right-arrow-alt"></i>Employe Add</a></li>
                            <li @if ( $current_url == 'employe.index')class="mm-active" @endif > <a href="{{ route('employe.index') }}"><i class="bx bx-right-arrow-alt"></i>Employe List <span class="badge bg-primary" style="margin: 0 5px">{{ employeCount() }}</span></a></li>
                        @endrole
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon">
                            <i class="lni lni-credit-cards"></i>
						</div>
						<div class="menu-title">Salary Management</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'salary.create')class="mm-active" @endif > <a href="{{ route('salary.create') }}"><i class="bx bx-right-arrow-alt"></i>Salary Pay</a></li>
                            <li @if ( $current_url == 'salary.index')class="mm-active" @endif > <a href="{{ route('salary.index') }}"><i class="bx bx-right-arrow-alt"></i>Salary List</a></li>
                        @endrole
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="font-22">	<i class="fadeIn animated bx bx-mail-send"></i>
                        </div>
						<div class="menu-title">Email</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'email.send')class="mm-active" @endif > <a href="{{ route('email.send') }}"><i class="bx bx-right-arrow-alt"></i>Send Mail</a></li>
                            <li @if ( $current_url == 'email.create')class="mm-active" @endif > <a href="{{ route('email.create') }}"><i class="bx bx-right-arrow-alt"></i>Email Template</a></li>
                        @endrole
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-bar-chart-alt"></i></div>
						<div class="menu-title">Report</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'product-report')class="mm-active" @endif > <a href="{{ route('product.report') }}"><i class="bx bx-right-arrow-alt"></i>Product Report </a></li>
                            <li @if ( $current_url == 'sale-report')class="mm-active" @endif > <a href="{{ route('sale.report') }}"><i class="bx bx-right-arrow-alt"></i>Sales Report </a></li>
                            <li @if ( $current_url == 'salary-report')class="mm-active" @endif > <a href="{{ route('salary.report') }}"><i class="bx bx-right-arrow-alt"></i>Salary Report </a></li>
                        @endrole
					</ul>
				</li>
                <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-cogs"></i></div>
						<div class="menu-title"> Settings</div>
					</a>
					<ul>
                        @role('super-admin')
                            <li @if ( $current_url == 'tax')class="mm-active" @endif > <a href="{{ route('tax') }}"><i class="bx bx-right-arrow-alt"></i> Tax List</a></li>
                            <li @if ( $current_url == 'site/setting')class="mm-active" @endif > <a href="{{ route('site.setting') }}"><i class="bx bx-right-arrow-alt"></i> Site Setting</a></li>
                            <li @if ( $current_url == 'invoice/setting')class="mm-active" @endif > <a href="{{ route('invoice.setting') }}"><i class="bx bx-right-arrow-alt"></i> Invoice Setting</a></li>
                        @endrole
					</ul>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						<div class="position-relative search-bar-box">
							<input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
							<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
						</div>
					</div>
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item mobile-search-icon">
								<a class="nav-link" href="#">	<i class='bx bx-search'></i>
								</a>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<div class="row row-cols-3 g-3 p-3">
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
											</div>
											<div class="app-title">Teams</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
											</div>
											<div class="app-title">Projects</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
											</div>
											<div class="app-title">Tasks</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
											</div>
											<div class="app-title">Feeds</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
											</div>
											<div class="app-title">Files</div>
										</div>
										<div class="col text-center">
											<div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
											</div>
											<div class="app-title">Alerts</div>
										</div>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">7</span>
									<i class='bx bx-bell'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Notifications</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-notifications-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec
												ago</span></h6>
													<p class="msg-info">5 new user registered</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-cart-alt"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
												ago</span></h6>
													<p class="msg-info">You have recived new orders</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class="bx bx-file"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min
												ago</span></h6>
													<p class="msg-info">The pdf files generated</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Time Response <span class="msg-time float-end">28 min
												ago</span></h6>
													<p class="msg-info">5.1 min avarage time response</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-info text-info"><i class="bx bx-home-circle"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Product Approved <span
												class="msg-time float-end">2 hrs ago</span></h6>
													<p class="msg-info">Your new product has approved</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-danger text-danger"><i class="bx bx-message-detail"></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">New customer comments recived</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
												ago</span></h6>
													<p class="msg-info">Successfully shipped your item</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-primary text-primary"><i class='bx bx-user-pin'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
												ago</span></h6>
													<p class="msg-info">24 new authors joined last week</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="notify bg-light-warning text-warning"><i class='bx bx-door-open'></i>
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks
												ago</span></h6>
													<p class="msg-info">45% less alerts last 4 weeks</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Notifications</div>
									</a>
								</div>
							</li>
							<li class="nav-item dropdown dropdown-large">
								<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-comment'></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end">
									<a href="javascript:;">
										<div class="msg-header">
											<p class="msg-header-title">Messages</p>
											<p class="msg-header-clear ms-auto">Marks all as read</p>
										</div>
									</a>
									<div class="header-message-list">
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
												ago</span></h6>
													<p class="msg-info">The standard chunk of lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
												sec ago</span></h6>
													<p class="msg-info">Many desktop publishing packages</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-3.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8 min
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
												min ago</span></h6>
													<p class="msg-info">Making this the first true generator</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-5.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22 min
												ago</span></h6>
													<p class="msg-info">Duis aute irure dolor in reprehenderit</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-6.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Cristina Jhons <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">The passage is attributed to an unknown</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-7.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">James Caviness <span class="msg-time float-end">4 hrs
												ago</span></h6>
													<p class="msg-info">The point of using Lorem</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
												ago</span></h6>
													<p class="msg-info">It was popularised in the 1960s</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-9.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">David Buckley <span class="msg-time float-end">2 hrs
												ago</span></h6>
													<p class="msg-info">Various versions have evolved over</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-10.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Thomas Wheeler <span class="msg-time float-end">2 days
												ago</span></h6>
													<p class="msg-info">If you are going to use a passage</p>
												</div>
											</div>
										</a>
										<a class="dropdown-item" href="javascript:;">
											<div class="d-flex align-items-center">
												<div class="user-online">
													<img src="{{ asset('backend_assets') }}/images/avatars/avatar-11.png" class="msg-avatar" alt="user avatar">
												</div>
												<div class="flex-grow-1">
													<h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5 days
												ago</span></h6>
													<p class="msg-info">All the Lorem Ipsum generators</p>
												</div>
											</div>
										</a>
									</div>
									<a href="javascript:;">
										<div class="text-center msg-footer">View All Messages</div>
									</a>
								</div>
							</li>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{ asset('backend_assets') }}/images/avatars/avatar-2.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{ auth()->user()->name }}</p>
								<p class="designattion mb-0">Web Designer</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>Settings</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
							</li>
							<li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
							</li>
							<li>
								<div class="dropdown-divider mb-0"></div>
							</li>
							<li>
                                              <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            </form>

							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
        @yield('backend_content')
            </div>
        </div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © 2021. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<div class="d-flex align-items-center">
				<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
				<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
			</div>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
					<label class="form-check-label" for="lightmode">Light</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
					<label class="form-check-label" for="darkmode">Dark</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
					<label class="form-check-label" for="semidark">Semi Dark</label>
				</div>
			</div>
			<hr/>
			<div class="form-check">
				<input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
				<label class="form-check-label" for="minimaltheme">Minimal Theme</label>
			</div>
			<hr/>
			<h6 class="mb-0">Header Colors</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator headercolor1" id="headercolor1"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor2" id="headercolor2"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor3" id="headercolor3"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor4" id="headercolor4"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor5" id="headercolor5"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor6" id="headercolor6"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor7" id="headercolor7"></div>
					</div>
					<div class="col">
						<div class="indigator headercolor8" id="headercolor8"></div>
					</div>
				</div>
			</div>

			<hr/>
			<h6 class="mb-0">Sidebar Backgrounds</h6>
			<hr/>
			<div class="header-colors-indigators">
				<div class="row row-cols-auto g-3">
					<div class="col">
						<div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
					</div>
					<div class="col">
						<div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('backend_assets') }}/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('backend_assets') }}/js/jquery.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/chartjs/js/Chart.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('backend_assets') }}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/jquery-knob/excanvas.js"></script>
	<script src="{{ asset('backend_assets') }}/plugins/jquery-knob/jquery.knob.js"></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src="{{ asset('backend_assets') }}/js/index.js"></script>
	<!--app JS-->
	<script src="{{ asset('backend_assets') }}/js/app.js"></script>


    @yield('script_body')
    @livewireScripts
</body>
</html>

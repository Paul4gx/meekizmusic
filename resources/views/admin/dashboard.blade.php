@php($title = 'Admin Dashboard')
@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<section class="content-inner-2 pt-0">
    <div class="container">
    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                    <i class="fa-solid fa-users" style="
                        font-size:20px;
                        background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        padding:10px;">
                    </i>
                </span>
                                    <div class="dz-info bg-gray">
                    <h6 class="dz-subtitle"><a>Total Users</a></h6>
                    <h5 class="dz-title"><a>{{ $totalUsers }}</a></h5>
                    <span>{{ $newUsersThisMonth }} this month</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                    <i class="fa-solid fa-music" style="
                        font-size:20px;
                        background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        padding:10px;">
                    </i>
                </span>
                                    <div class="dz-info bg-gray">
                    <h6 class="dz-subtitle"><a>Total Beats</a></h6>
                    <h5 class="dz-title"><a>{{ $totalBeats }}</a></h5>
                    <span>{{ $newBeatsThisMonth }} this month</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                    <i class="fa-solid fa-shopping-cart" style="
                        font-size:20px;
                        background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        padding:10px;">
                    </i>
                </span>
                                    <div class="dz-info bg-gray">
                    <h6 class="dz-subtitle"><a>Total Orders</a></h6>
                    <h5 class="dz-title"><a>{{ $totalOrders }}</a></h5>
                    <span>{{ $newOrdersThisMonth }} this month</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="dz-card style-2 blog-half overlay-shine dz-img-effect zoom m-b30 wow flipInX" data-wow-delay="1.6s" style="visibility: visible; animation-delay: 1.6s; animation-name: flipInX;">
                <span style="background-color:white;border-radius:50%;display:flex;justify-content:center;align-items:center;position:absolute;bottom:10px;right:15px;z-index:100;width:40px;height:40px;">
                    <i class="fa-solid fa-dollar-sign" style="
                        font-size:20px;
                        background: linear-gradient(90deg, #FF421D -2.36%, #D01266 101.57%);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        padding:10px;">
                    </i>
                </span>
                                    <div class="dz-info bg-gray">
                    <h6 class="dz-subtitle"><a>Total Revenue</a></h6>
                    <h5 class="dz-title"><a>${{ number_format($totalRevenue, 2) }}</a></h5>
                    <span>${{ number_format($revenueThisMonth, 2) }} this month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <section class="content-inner-1">
				<div class="row justify-content-between align-items-end">
					<div class="text-center text-xl-start col-xl-6">
						<div class="section-head ">
							<h3 class="title wow flipInX animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: undefined;">Recent Orders</h3>
						</div>
					</div>
					<div class="text-center text-xl-end col-xl-6 m-b30 m-lg-b40">
						<a href="{{ route('admin.orders.index') }}" class="btn-link btn-gradient wow flipInX animated" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: undefined;">View All</a>
					</div>
				</div>
				<div class="row dz-tooltip-blog wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                    @foreach($recentOrders as $order)
                    <div class="col-12">
						<div class="dz-card style-4">
							<div class="row dz-info justify-content-between">
								<div class="col-lg-2">
                                    <span class="small-title">Date:</span>
									<h5 class="dz-title"><a>{{ $order->created_at->format('M d, Y') }}</a></h5>
								</div>
								<div class="col-lg-3">
                                    <span class="small-title">Customer Name:</span>
									<h5 class="dz-title"><a>{{ $order->user->name }}</a></h5>
								</div>
								<div class="col-lg-2">
                                    <span class="small-title">Beat Title:</span>
									<h5 class="dz-title"><a>{{ $order->beat->title }}</a></h5>
								</div>
								<div class="col-lg-2">
                                    <span class="small-title">Amount Sold:</span>
									<h5 class="dz-title"><a>${{ number_format($order->amount, 2) }}</a></h5>
								</div>
								<div class="col-lg-1">
                                    <span class="small-title">Status:</span>
									<span class="badge bg-success">Completed</span>
								</div>
							</div>
						</div>
					</div>
                    @endforeach
								</div>
		</section>

        <!-- Revenue Chart -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="admin-card">
                    <div class="row justify-content-between align-items-end">
                        <div class="text-center text-xl-start col-xl-6">
                            <div class="section-head ">
                                <h3 class="title wow flipInX animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: undefined;">Revenue Overview</h3>
                            </div>
                        </div>
                    </div>
                    <div class="admin-card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <section class="content-inner-1">

    <div class="row">
        <div class="col-12">
                <div class="row justify-content-between align-items-end">
					<div class="text-center text-xl-start col-xl-6">
						<div class="section-head ">
							<h3 class="title wow flipInX animated" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: undefined;">Recent Users</h3>
						</div>
					</div>
					<div class="text-center text-xl-end col-xl-6 m-b30 m-lg-b40">
						<a href="{{ route('admin.users.index') }}" class="btn-link btn-gradient wow flipInX animated" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: undefined;">View All</a>
					</div>
				</div>
                    <div class="row">
                        @foreach($recentUsers as $user)
                        <div class="col-md-4 p-1 d-flex justify-content-center flex-column align-items-center" style="border-left: #FF421D 2px solid">
                                    <h6 class=""><i class="la la-user-circle me-2" style="color:black"></i> {{ $user->name }}</h6>
                                    <p class="pb-0 m-0">{{ $user->email }}</p>
                                    <em class="p-0" style="font-size:0.8rem">Joined on: {{ $user->created_at->format('M d') }}</em>		
                    </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>


</div>
</section>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    console.log({!! json_encode($revenueChartData['labels']) !!});
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChartData['labels']) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode($revenueChartData['data']) !!},
                borderColor: '#4e73df',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'N' + value;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection 
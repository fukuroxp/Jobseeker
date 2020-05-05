@extends('layouts.app')

@section('content')

<div class="content-header row">
</div>
<div class="content-body">
    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-primary p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-users text-primary font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">92.6k</h2>
                        <p class="mb-0">Subscribers Gained</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-success p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-credit-card text-success font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">97.5k</h2>
                        <p class="mb-0">Revenue Generated</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-danger p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">36%</h2>
                        <p class="mb-0">Quarterly Sales</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column align-items-start pb-0">
                        <div class="avatar bg-rgba-warning p-50 m-0">
                            <div class="avatar-content">
                                <i class="feather icon-package text-warning font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="text-bold-700 mt-1">97.5K</h2>
                        <p class="mb-0">Orders Received</p>
                    </div>
                    <div class="card-content">
                        <div id="line-area-chart-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">Pendapatan</h4>
                        <p class="font-medium-5 mb-0"><i class="feather icon-settings text-muted cursor-pointer"></i></p>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-start">
                                <div class="mr-2">
                                    <p class="mb-50 text-bold-600">Laba Bersih</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">Rp</sup>
                                        <span class="text-success">{{ number_format($profit['bersih'], 2, ',' , '.') }}</span>
                                    </h2>
                                </div>
                                <div>
                                    <p class="mb-50 text-bold-600">Laba Kotor</p>
                                    <h2 class="text-bold-400">
                                        <sup class="font-medium-1">Rp</sup>
                                        <span>{{ number_format($profit['kotor'], 2, ',' , '.') }}</span>
                                    </h2>
                                </div>

                            </div>
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->

</div>
@endsection

@section('js')
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
@endsection
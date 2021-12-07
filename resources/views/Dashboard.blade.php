@extends('Layout.App')
@section('title','CPS - Dashboard')
@section('content')
<!-- *************************************************************** -->
<!-- Start First Cards -->
<!-- *************************************************************** -->
<div class="card-group">
    <div class="card border-right gradiant_1">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="mb-1 font-weight-medium">{{ $total_pending }}</h2>
                        {{-- <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span> --}}
                    </div>
                    <h6 class=" font-weight-normal mb-0 w-100 text-truncate">Total Pending Request</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-9 text-white"><i data-feather="user-plus"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right gradiant_3">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class=" mb-1 w-100 text-truncate font-weight-medium">{{ $total_approve }}</h2>
                    <h6 class=" font-weight-normal mb-0 w-100 text-truncate">Total Approved
                    </h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-9  text-white"><i data-feather="check"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-right gradiant_2">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <div class="d-inline-flex align-items-center">
                        <h2 class="mb-1 font-weight-medium">{{ $total_reject}}</h2>
                       
                    </div>
                    <h6 class="font-weight-normal mb-0 w-100 text-truncate">Total Rejected</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-9  text-white"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body">
            <div class="d-flex d-lg-flex d-md-block align-items-center">
                <div>
                    <h2 class="text-dark mb-1 font-weight-medium">864</h2>
                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Projects</h6>
                </div>
                <div class="ml-auto mt-md-3 mt-lg-0">
                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!-- *************************************************************** -->
<!-- End First Cards -->
<!-- *************************************************************** -->

@endsection
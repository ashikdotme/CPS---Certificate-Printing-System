@extends('Pages.PageLayout')
@section('title','CPS - Home')
@section('content')
<div class="banner-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="banner-left">
                    <img src="assets/images/Cert.jpg" alt="certificate">
                </div>
            </div>
            <div class="col-md-6">
                <div class="banner-right">
                    <h1>Certificate Printing <br> System</h1>
                    <br>
                    <a class="btn btn-success" href="{{ url('download-certificate') }}">Download Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="easy-steps">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="easy-step-img">
                    <img src="assets/images/easy-step.png" alt="easy step">
                </div>
            </div>
            <div class="col-md-6">
                <div class="easy-step-content">
                    <h2>Easy Steps</h2>
                    <ul class="easy-step-list">
                        <li><i class="fa fa-check"></i> Registration</li>
                        <li><i class="fa fa-check"></i> Verify OTP</li>
                        <li><i class="fa fa-check"></i> Approve by Administrator</li>
                        <li><i class="fa fa-check"></i> Ready to Download</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
     
<script>



</script>
    
 @endsection
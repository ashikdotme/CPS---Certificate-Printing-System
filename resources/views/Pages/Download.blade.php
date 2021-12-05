@extends('Pages.PageLayout')
@section('title','CPS - Download Certificate')
@section('content')
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="page-wappper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
               
                <div class="col-lg-10 col-md-10 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/logo-icon.png" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Download</h2> 
                        <p class="text-center">Download your Certificate.</p>
                        <form class="mt-4" method="POST" action="" id="downloadForm">
                            <div class="row" id="step_1">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="name">Student ID</label>
                                        <input class="form-control" id="st_id" type="text" placeholder="Student ID">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="mobile_number">Mobile Number</label>
                                        <input class="form-control" id="mobile_number" type="text" placeholder="Mobile Number">
                                    </div>
                                </div>
                                   
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="download_btn" class="btn btn-block btn-success">Download Now</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    
                                </div>
                            </div>
                            
                        </form>
                       
                        {{-- step 2 --}}
                        <form method="POST" action="" id="otpForm">
                            <div class="row" id="step_2">
                                <p class="text-center">Please check your Mobile SMS then submit the OTP.</p>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="m_otp">OTP</label>
                                        <input class="form-control" id="m_otp" type="text" placeholder="OTP">
                                    </div>
                                </div> 
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="otp_btn" class="btn btn-block btn-success">Submit</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
 @endsection
 @section('scripts')
     
 <script>
    
    $('#downloadForm').on('submit',function(e){
        e.preventDefault(); 
        var st_id=$('#st_id').val();
        var mobile_number=$('#mobile_number').val();
         
        if(st_id.length==0){
            toastr.error('Student ID is Required!');
        } 
        else if(mobile_number.length==0){
            toastr.error('Mobile Number is Required!');
        } 
        else{ 
            $('#download_btn').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
            axios.post('/api-certificate-view-check',{
                st_id:st_id,
                mobile_number:mobile_number
            })
            .then(function(response){
                if(response.status==200){  
                    if(response.data==2){
                        toastr.success('Now Verify OTP!'); 
                        $('#download_btn').html('Download Now'); 
                        $('#downloadForm').hide();
                        $('#step_2').show();
                    }
                    else{
                        toastr.error(response.data);
                        $('#download_btn').html('Download Now'); 
                    } 
                }else{
                    toastr.error('Something went wrong!');
                    $('#download_btn').html('Download Now'); 
                }
            })
            .catch(function (error) {
                toastr.error('Something went wrong!');
            })
        }
    
    });

    $('#otpForm').on('submit',function(e){
        e.preventDefault();
    
        var m_otp=$('#m_otp').val();
        var st_id=$('#st_id').val();
        var mobile_number=$('#mobile_number').val();
         
        if(m_otp.length==0){
            toastr.error('OTP is Required!');
        } 
        else if(mobile_number.length==0){
            toastr.error('Mobile Number is Required!');
        } 
        else{ 
            $('#otp_btn').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
            axios.post('/api-certificate-download-otp-confirm',{
                m_otp:m_otp,
                st_id:st_id,
                mobile_number:mobile_number
            })
            .then(function(response){
                if(response.status==200){ 
                    if(response.data !=''){
                        let id = response.data['id'];
                        let status = response.data['status']; 
                        
                        if(status==1){
                            $('#otp_btn').html('Submit');
                            toastr.success('Your Certificate is Ready for Download!');  
                            window.location = "/certificate-view?id="+id;
                            $('#m_otp').val('');
                        }
                        else{
                            toastr.error(response.data);
                            $('#otp_btn').html('Submit');
                        }
                    } 
                }else{
                    toastr.error('Something went wrong!');
                    $('#otp_btn').html('Submit');
                }
            })
            .catch(function (error) {
                toastr.error('Something went wrong!');
            })
        }
    
    });
    </script>
    
 @endsection
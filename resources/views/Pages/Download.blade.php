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
                        <p class="text-center">Print/Download your Certificate.</p>
                        <form class="mt-4" method="POST" action="" id="regiForm">
                            <div class="row" id="step_1">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="name">Student ID</label>
                                        <input class="form-control" id="name" type="text" placeholder="Student ID">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="mobile_number">Mobile Number</label>
                                        <input class="form-control" id="mobile_number" type="text" placeholder="Mobile Number">
                                    </div>
                                </div>
                                   
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="regi_btn" class="btn btn-block btn-success">Download Now</button>
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
    
    $('#otpForm').on('submit',function(e){
        e.preventDefault();
    
        var m_otp=$('#m_otp').val();
        var mobile=$('#mobile').val();
         
        if(m_otp.length==0){
            toastr.error('OTP is Required!');
        } 
        else if(mobile.length==0){
            toastr.error('Mobile Number is Required!');
        } 
        else{
    
            $('#otp_btn').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
            axios.post('/api-student-registration-otp-confirm',{
                m_otp:m_otp,
                mobile:mobile
            })
            .then(function(response){
                if(response.status==200){ 
                    if(response.data==1){
                        $('#otp_btn').html('Submit'); 
                        toastr.success('We will notify you soon!');   
                        toastr.success('Submit Successfully!');  
                        $('#m_otp').val('');
                    }
                    else{
                        toastr.error(response.data);
                        $('#otp_btn').html('Submit');
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
    
    $('#regiForm').on('submit',function(e){
        e.preventDefault();
    
        var name=$('#name').val();
        var father_name=$('#father_name').val();
        var mother_name=$('#mother_name').val();
        var st_id=$('#st_id').val();
        var department=$('#department').val();
        var session=$('#session').val(); 
        var batch=$('#batch').val();
        var shift=$('#shift').val();
        var email=$('#email').val();
        var mobile=$('#mobile').val();
         
        if(name.length==0){
            toastr.error('Name is Required!');
        }
        else if(father_name.length==0){
            toastr.error('Father Name is Required!');
        }
        else if(father_name.length==0){
            toastr.error("Father's Name is Required!");
        }
        else if(mother_name.length==0){
            toastr.error("Mothers's Name is Required!");
        }
        else if(st_id.length==0){
            toastr.error("ID is Required!");
        }
        else if(department.length==0){
            toastr.error("Department is Required!");
        }
        else if(mobile.length==0){
            toastr.error("Mobile Number is Required!");
        }
        else if(mobile.length!=11){
            toastr.error("Mobile Number Must be 11 Digit!");
        }
        else{
    
            $('#regi_btn').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
            axios.post('/api-student-registration',{
                name:name,
                father_name:father_name,
                mother_name:mother_name,
                st_id:st_id,
                department:department,
                session:session,
                batch:batch,
                shift:shift,
                email:email,
                mobile:mobile
            })
            .then(function(response){
                if(response.status==200){ 
                    if(response.data==2){
                        toastr.error('Please verify your OTP!');  
                        $('#regiForm').hide();
                        $('#step_2').show();
                    }
                    else if(response.data==1){
                        toastr.success('Submit Successfully!'); 
                        $('#regi_btn').html('Next');
                        $('#regiForm').hide();
                        $('#step_2').show();
                    }
                    else{
                        toastr.error(response.data);
                        $('#regi_btn').html('Next');
                    }
                }else{
                    toastr.error('Something went wrong!');
                    $('#regi_btn').html('Next');
                }
            })
            .catch(function (error) {
                toastr.error('Something went wrong!');
            })
        }
    
    });
    
    </script>
    
 @endsection
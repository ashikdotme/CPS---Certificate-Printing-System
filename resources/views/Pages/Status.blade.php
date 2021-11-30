@extends('Pages.PageLayout')
@section('title','CPS - Check Status')
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
                        <h2 class="mt-3 text-center">Check Status</h2> 
                        <p class="text-center">Check your Certificate Status</p>
                        <form class="mt-4" method="POST" action="" id="statusForm">
                            <div class="row" id="step_1">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="st_id">Student ID</label>
                                        <input class="form-control" id="st_id" type="text" placeholder="Student ID">
                                    </div>
                                </div> 
                                <div class="col-lg-12 text-center">
                                    <button type="submit" id="status_btn" class="btn btn-block btn-success">Check Status</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    
                                </div>
                            </div>
                            
                        </form>
                        <div class="success__msg"> </div> 
                        
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
    
    $('#statusForm').on('submit',function(e){
        e.preventDefault();
    
        var st_id=$('#st_id').val(); 
         
        if(st_id.length==0){
            toastr.error('Student ID Required!');
        }  
        else{
    
            $('#status_btn').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
            axios.post('/api-check-status',{
                st_id:st_id
            })
            .then(function(response){
                if(response.status==200){ 
                    console.log(response.data);
                    if(response.data == 0){
                        toastr.error('Student ID Not Found!');
                        $('#status_btn').html('Check Status');
                    }
                    else{
                        
                        let status = response.data[0]['status'];

                        if(status == 0){
                            $('.success__msg').html('<div class="alert alert-warning">Hello, <b>'+response.data[0]['name']+'</b> your Request is Pending!</div>');
                            $('#status_btn').html('Check Status');
                        }
                        else if(status == 2){
                            $('.success__msg').html('<div class="alert alert-danger">Hello, <b>'+response.data[0]['name']+'</b> your Request is Rejected!</div>');
                            $('#status_btn').html('Check Status');
                        }
                        else if(status == 1){
                            $('.success__msg').html('<div class="alert alert-success">Hello, <b>'+response.data[0]['name']+'</b> your Request is Approved! <br><br> <a class="btn btn-success" href="/download-certificate">Download Certificate</a></div>');
                            $('#status_btn').html('Check Status');
                        }
                    }
                     
                }else{
                    toastr.error('Something went wrong!');
                    $('#status_btn').html('Submit');
                }
            })
            .catch(function (error) {
                toastr.error('Something went wrong!');
            })
        }
    
    });
     
    
    </script>
    
 @endsection
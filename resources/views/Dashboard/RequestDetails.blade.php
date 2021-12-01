@extends('Layout.App')
@section('title','CPS - Pending Details')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title border-bottom">Request Details:</h4>  
                <div class="table-responsive">
                    <table id="PendingRequestTable" class="table table-striped table-bordered display no-wrap" style="width:100%">
                        <tr>
                           <td><b>Name:</b></td>
                           <td><span class="name">{{ $details[0]['name'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Student ID:</b></td>
                            <td><span class="st_id">{{ $details[0]['st_id'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Session:</b></td>
                            <td><span class="session">{{ $details[0]['session'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Batch:</b></td>
                            <td><span class="batch">{{ $details[0]['batch'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Shift:</b></td>
                            <td><span class="shift">{{ $details[0]['shift'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Department:</b></td>
                            <td><span class="department">{{ $details[0]['department'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Father's Name:</b></td>
                            <td><span class="fathers_name">{{ $details[0]['fathers_name'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Mother's Name:</b></td>
                            <td><span class="mothers_name">{{ $details[0]['mothers_name'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Mobile:</b></td>
                            <td><span class="mobile">{{ $details[0]['mobile'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><span class="email">{{ $details[0]['email'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>OTP Status:</b></td>
                            <td><span class="otp_verify">
                            @if($details[0]['otp_verify'] == 1) 
                            <div class="badge badge-success">Verified</div>   
                            @else 
                            <div class="badge badge-danger">Not Verified</div>   
                            @endif
                            </span></td>
                        </tr>
                        <tr>
                            <td><b>Status:</b></td>
                            <td><span class="status">
                            @if($details[0]['status'] == 1) 
                            <div class="badge badge-success">Approved</div>   
                            @elseif($details[0]['status'] == 2) 
                            <div class="badge badge-danger">Reject</div>   
                            @elseif($details[0]['status'] == 0) 
                            <div class="badge badge-warning">Pending</div>   
                            @endif</span></td>
                        </tr>
                        <tr>
                            <td><b>Request Date:</b></td>
                            <td><span class="date">{{ date('h:i:sA d-M-Y ',strtotime($details[0]['created_at'])) }}</span></td>
                        </tr>
                        @if($details[0]['status'] == 1)
                        <tr>
                            <td><b>CGPA</b></td>
                            <td><span class="badge badge-info">{{ $details[0]['cgpa'] }}</span></td>
                        </tr>
                        <tr>
                            <td><b>Last Update:</b></td>
                            <td><span class="date">{{ date('h:i:sA d-M-Y ',strtotime($details[0]['updated_at'])) }}</span></td>
                        </tr>
                        @endif
                        @if($details[0]['status'] == 0)
                        <tr>
                            <td><b>CGPA</b></td>
                            <td><span><input type="text"  class="form-control" id="st_cgpa"></span></td>
                        </tr>

                        <tr>
                            <input type="hidden" name="st_id" id="st_id" value="{{ $details[0]['id'] }}">
                            <td><button type="submit" id="form_approve" class="btn btn-success">Approve</button></td>
                            <td><button type="submit"  id="form_reject" class="btn btn-danger">Reject</button></td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script> 
$('#form_reject').click(function(){
    var st_id2 = $('#st_id').val(); 
    
    $('#form_reject').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
    axios.post('/api-reject-pending-request',{
        st_id2:st_id2
    })
    .then(function(response){
        if(response.status==200){ 
            if(response.data==1){
                toastr.success('Reject Successfully!');  
                $('#form_reject').html('Reject');
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
                
            }
            else if(response.data==0){
                toastr.error('Approve Failed!');  
                $('#form_reject').html('Reject');
            }
           
        }else{
            toastr.error('Something went wrong!');
            $('#form_reject').html('Reject');
        }
    })
 

    return false;
});

$('#form_approve').click(function(){
    var st_id = $('#st_id').val();
    var st_cgpa = $('#st_cgpa').val();
    if(st_cgpa.length == 0){
        toastr.error('CGPA is Required!');
    }
    else if(st_cgpa>4 || st_cgpa<1){
        toastr.error('CGPA value is Wrong!');
    }
    else{
        $('#form_approve').html('Loading <div class="spinner-grow spinner-grow-sm" role="status"><span class="sr-only">Loading...</span></div>');
        axios.post('/api-approve-pending-request',{
            st_id:st_id,
            st_cgpa:st_cgpa
        })
        .then(function(response){
            if(response.status==200){ 
                if(response.data==1){
                    toastr.success('Approve Successfully!');  
                    $('#form_approve').html('Approve');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                   
                }
                else if(response.data==0){
                    toastr.error('Approve Failed!');  
                    $('#form_approve').html('Approve');
                }
                else{
                    toastr.error(response.data);
                    $('#form_approve').html('Approve');
                }
            }else{
                toastr.error('Something went wrong!');
                $('#form_approve').html('Approve');
            }
        })

    }

    return false;
});
</script>
@endsection
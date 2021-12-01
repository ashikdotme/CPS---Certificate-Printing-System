@extends('Layout.App')
@section('title','CPS - Pending Details')
@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title border-bottom">Request Details:</h4> 
                {{ $details }}
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
                                @if($details[0]['otp_verify'] == 1) 
                            <div class="badge badge-success">Verified</div>   
                            @else 
                            <div class="badge badge-danger">Not Verified</div>   
                            @endif</span></td>
                        </tr>
                        <tr>
                            <td><b>Request Date:</b></td>
                            <td><span class="date">{{ $details[0]['created_at'] }}</span></td>
                        </tr>
                        
                        <tr>
                            <td><b>CGPA</b></td>
                            <td><span><input type="text"  class="form-control" id="st_cgpa"></span></td>
                        </tr>

                        <tr>
                            <td><button type="submit" class="btn btn-success">Approved</button></td>
                            <td><button type="submit" class="btn btn-danger">Reject</button></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
AllPendingRequest();
function AllPendingRequest() {
    axios.get('/api-pending-certificate-request-list')
        .then(function(response) {
            if(response.status == 200) {
                console.log(response.data);

                // $('#loader').addClass('d-none');
                // $('#usersTable').removeClass('d-none');

                $('#PendingRequestTable').DataTable().destroy();
                $('#tableRow').empty();
                var jsonData = response.data;
                var a = 1;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        '<td> '+a+'</td>'+
                        '<td>' + jsonData[i].name +'</td>'+
                        '<td>' + jsonData[i].st_id +'</td>'+
                        '<td>'+ jsonData[i].mobile +'</td>'+
                        '<td>'+ jsonData[i].department +" ~ "+ jsonData[i].batch+'</td>'+
                        '<td>'+ otp_verify_status() +'</td>'+   
                        '<td>'+ status() +'</td>'+   
                        '<td>'+ button() +'</td>'
                    ).appendTo('#tableRow');
                    a++;

                    function otp_verify_status(){
                        let otp_status = jsonData[i].otp_verify;
                        if(otp_status == 1){
                            return '<span class="badge badge-success">Verified</span>';
                        }
                        else{
                            return '<span class="badge badge-danger">Not Verified</span>';
                        }
                    }
                    function status(){
                        let newstatus = jsonData[i].status;
                        if(newstatus == '0'){
                            return '<span class="badge badge-warning">Pending</span>';
                        }else if(newstatus == '1'){
                            return '<span class="badge badge-success">Approved</span>';
                        }else if(newstatus == "2"){
                            return '<span class="badge badge-danger">Rejected</span>';
                        }
                    }

                    function button(){
                        return '<a href="/request-details?id='+jsonData[i].id+'"  data-id='+jsonData[i].id+' class="btn btn-success btn-sm ViewBtn"><i class="fa fa-eye"></i> View</a>';
                    }

                });
 
                $('#PendingRequestTable').DataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": true,
                    "bAutoWidth": false,
                    "bDestroy": true
                });
                $('.dataTables_length').addClass('bs-select');

            }

        }).catch(function(error) {

    })
}


</script>
@endsection
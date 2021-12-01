@extends('Layout.App')
@section('title','CPS - Pending Request')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Approved Request List</h4>
                 
                <div class="table-responsive">
                    <table id="PendingRequestTable" class="table table-striped table-bordered display no-wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Mobile</th>
                                <th>Department</th>
                                <th>OTP Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableRow"></tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
AllApproveRequest();
function AllApproveRequest() {
    axios.get('/api-approve-certificate-list')
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
                        return '<a href="/request-details?id='+jsonData[i].id+'"  data-id='+jsonData[i].id+' class="btn btn-success btn-sm ViewBtn"><i class="fa fa-eye"></i> View</a> &nbsp;'+
                       '<a href="/certificate-view?id='+jsonData[i].id+'"  data-id='+jsonData[i].id+' class="btn btn-info btn-sm PrintBtn"><i class="fa fa-print"></i> Print</a>';
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
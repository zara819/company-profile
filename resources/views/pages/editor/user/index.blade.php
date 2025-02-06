@extends('layout.main')
@section('title')
    User
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        
       
            <div class="input-group-append">
                    <button type="button" id="add_new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add</button>
                </div>
       
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Tuser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                           
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form id="addForm" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new user</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-grop row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span id="togglePassword" class="fas fa-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Password Confirm</label>
                                <div class="input-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span id="togglePasswordC" class="fas fa-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button" id="proses_add" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<form id="updateForm" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update user</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="hidden" id="id_update" name="id" class="form-control">
                                <label for="">Name</label>
                                <input type="text" id="name_update" name="name" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" id="email_update" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button" id="proses_update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script>
    $('document').ready(function(e){
        var Tuser = $('#Tuser').DataTable({
            "responsive": true,
            'searching': false,
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "paging":true,
            "ajax":{
                "url":"{{ route('editor.users.data') }}",
                "data":function(parm){
                    parm.search = function(){
                        return $('#cari').val()
                    }
                },
                   
            },
            "columns":[
                {"data": "name","orderable":false},
                
                {"data": "email","orderable":false},
                {
                    "data": "id","orderable":false,render: function ( data, type, row ){
                        var idData = row.id;
                        let isVerified = row.verified;
                        let btn ='<div class="btn-group" role="group" aria-label="Basic example">';
                        if(isVerified == 0){
                            btn += '<button type="button" class="btn btn-success btnVerified">Verified</button>';
                        }
                        btn += '<button type="button" class="btn btn-warning btnUpdate">Update</button>';
                        btn += '<button type="button" class="btn btn-danger btnDelete">Delete</button>';
                        btn += '</div>';
                        return btn;
                    }
                },
            ]
        });
        function redraw(){
            Tuser.draw();
        }
        $("#add_new").click(function(){
            $("#addModal").modal("show");
        });
        $('#togglePassword').on('click', function() {
            // Toggle tipe input
            const passwordField = $('#password');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
        $('#togglePasswordC').on('click', function() {
            // Toggle tipe input
            const passwordField = $('#password_confirmation');
            const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
            passwordField.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
        $("#proses_add").click(function(){
            var postData = new FormData($("#addForm")[0]);
            $.ajax({
                url:"{{ URL::route('editor.users.store') }}",
                data:postData,
                type:"POST",
                dataType:"JSON",
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.loading-clock').css('display','flex');
                },
                success:function(data){
                    if(data.success == 1){
                        // Reset form
                        $('#addForm')[0].reset();
                        // Remove image preview
                        $("#addModal").modal("hide");
                        toastr_success(data.messages);
                        redraw();
                    }else{
                        toastr_error(data.messages);
                    }
                },
                complete: function(){
                    $('.loading-clock').css('display','none');
                },
            });
        });
        $("#btn-cari").click(function(){
            let search = $("#cari").val();
            Tuser.draw();
        });
        $("#Tuser tbody").on('click','.btnUpdate',function(){
            let data = Tuser.row( $(this).parents('tr') ).data();
            let idData = data.id;
            $.ajax({
                url:"{{ URL::route('editor.users.detail') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': idData
                },
                dataType: "JSON",
                cache: false,
                beforeSend: function(){
                    $('.loading-clock').css('display','flex');
                },
                success: function(data) {
                    if(data.success == 1){
                        let id = data.data.id;
                        let name = data.data.name;
                        
                        let email = data.data.email;
                        $("#id_update").val(id);
                        $("#name_update").val(name);
                        
                        $("#email_update").val(email);
                    } else{
                        toastr_error(data.messages);
                    }
                },
                complete: function(){
                    $('.loading-clock').css('display','none');
                },
            })
            $("#updateModal").modal("show");
        });
        $("#proses_update").click(function(){
            var postData = new FormData($("#updateForm")[0]);
            $.ajax({
                url:"{{ URL::route('editor.users.update') }}",
                data:postData,
                type:"POST",
                dataType:"JSON",
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('.loading-clock').css('display','flex');
                },
                success:function(data){
                    if(data.success == 1){
                        $("#updateModal").modal("hide");
                        toastr_success(data.messages);
                        redraw();
                    }else{
                        toastr_error(data.messages);
                    }
                },
                complete: function(){
                    $('.loading-clock').css('display','none');
                },
            });
        });
        $("#Tuser tbody").on('click','.btnDelete',function(){
            let data = Tuser.row( $(this).parents('tr') ).data();
            let idData = data.id;
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"{{ URL::route('editor.users.delete') }}",
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': idData
                        },
                        dataType: "JSON",
                        cache: false,
                        beforeSend: function(){
                            $('.loading-clock').css('display','flex');
                        },
                        success: function(data) {
                            if(data.success == 1){
                                toastr_success(data.messages);
                                redraw();
                            } else{
                                toastr_error(data.messages);
                            }
                        },
                        complete: function(){
                            $('.loading-clock').css('display','none');
                        },
                    }); 
                }
                });
        });
    });
    function toastr_success(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: msg
        });
    }
    function toastr_error(msg){
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "error",
            title: msg
        });
    }
    
</script>
@endsection
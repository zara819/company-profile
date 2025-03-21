@extends('layout.main')
@section('title')
Contact
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact</h1>

        <div class="input-group-append">
            <button type="button" class="btn btn-outline-primary " id="add_new">Add</button>

        </div>

    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Contact</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="Tcontact" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const Tcontact = $('#Tcontact').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('editor.contact.data') }}",
                data: d => d.search = $('#cari').val()
            },
            columns: [{
                    data: "name"
                },
                {
                    data: "email"
                },
                {
                    data: "phone"
                },
                {
                    data: "message"
                },
                {
                    data: "id",
                    render: id => `
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>`
                }
            ]
        });

        $('#btn-cari').click(() => Tcontact.draw());

        $('#Tcontact tbody').on('click', '.btnDelete', function() {
            const data = Tcontact.row($(this).parents('tr')).data();
            let idData = data.id;

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ URL::route('editor.contact.delete') }}",
                        type: "DELETE",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'id': idData
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            $('.loading-clock').css('display', 'flex');
                        },
                        success: function(data) {
                            $('.loading-clock').css('display', 'none'); // Hentikan loading
                            if (data.success == 1) {
                                toastr_success(data.messages);
                                Tcontact.draw(); // Refresh tabel
                            } else {
                                toastr_error(data.messages);
                            }
                        },
                        error: function(xhr, status, error) {
                            $('.loading-clock').css('display', 'none'); // Hentikan loading pada error
                            toastr_error("Something went wrong. Please try again.");
                        }
                    });
                }
            });
        });

        function toastr_success(msg) {
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

        function toastr_error(msg) {
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
    });
</script>
@endsection
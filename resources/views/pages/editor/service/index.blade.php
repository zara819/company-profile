@extends('layout.main')
@section('title')
    Service
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        
        <div class="input-group-append">
        <button type="button" class="btn btn-outline-primary " id="add_new" >Add</button>
         
    </div>
    </div>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Service</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="service" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
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
                    <h5 class="modal-title">Add new Service</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" id="title" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" id="description" name="description" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file">Image</label>
                        <div id="imagev" class="my-2"></div> <!-- Tempat untuk menampilkan pratinjau gambar -->
                        <input type="file" id="file" name="file" class="form-control" onchange="previewImage(this, '#imagev');">
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
                    <h5 class="modal-title">Update Service</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="hidden" id="id_update" name="id" class="form-control">
                                <input type="text" id="title_update" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Description</label>
                                <input type="text" id="description_update" name="description" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Image</label> 
                        <div id="imagev_update" class="my-2"></div>
                        <input type="file" id="file_update" name="file" class="form-control" onchange="previewImage(this, '#imagev_update');">
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
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const service = $('#service').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('editor.service.data') }}",
                data: d => d.search = $('#cari').val()
            },
            columns: [
                { data: "title" },
                { data: "description" },
                {
                    data: "image",
                    render: data => `<img src="{{ asset('storage') }}/${data}" class="rounded float-left" width="100">`
                },
                {
                    data: "id",
                    render: id => `
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-warning btnUpdate">Update</button>
                            <button type="button" class="btn btn-danger btnDelete">Delete</button>
                        </div>`
                }
            ]
        });

        $('#btn-cari').click(() => service.draw());

        $('#add_new').click(() => {
            $('#addForm')[0].reset();
            $('#imagev').empty();
            $('#addModal').modal('show');
        });

        $('#proses_add').click(() => {
            const formData = new FormData($('#addForm')[0]);
            $.ajax({
                url: "{{ route('editor.service.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    if (res.success) {
                        $('#addModal').modal('hide');
                        service.draw();
                        toastr_success(res.messages || 'Data berhasil disimpan.');
                    } else {
                        toastr_error(res.messages || 'Gagal menyimpan data.');
                    }
                },
                error: () => {
                    toastr_error('Terjadi kesalahan saat menghubungi server.');
                }
            });
        });

        $('#service tbody').on('click', '.btnUpdate', function () {
            const data = service.row($(this).parents('tr')).data();
            $.get("{{ route('editor.service.detail') }}", { id: data.id }, res => {
                if (res.success) {
                    $('#id_update').val(res.data.id);
                    $('#title_update').val(res.data.title);
                    $('#description_update').val(res.data.description);
                    $('#imagev_update').html(`<img src="{{ asset('storage') }}/${res.data.image}" class="img-fluid rounded" style="max-width: 300px; max-height: 300px;">`);
                    $('#updateModal').modal('show');
                } else {
                    toastr_error(res.messages || 'Gagal mengambil data.');
                }
            });
        });

        $('#proses_update').click(() => {
            const formData = new FormData($('#updateForm')[0]);
            $.ajax({
                url: "{{ route('editor.service.update') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    if (res.success) {
                        $('#updateModal').modal('hide');
                        service.draw();
                        toastr_success(res.messages || 'Data berhasil diperbarui.');
                    } else {
                        toastr_error(res.messages || 'Gagal memperbarui data.');
                    }
                },
                error: () => {
                    toastr_error('Terjadi kesalahan saat menghubungi server.');
                }
            });
        });

        $('#service tbody').on('click', '.btnDelete', function () {
            const data = service.row($(this).parents('tr')).data();
            let idData = data.id;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Tindakan ini tidak dapat dibatalkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "{{ URL::route('editor.service.delete') }}",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': idData
                    },
                    dataType: "JSON",
                    beforeSend: function () {
                        $('.loading-clock').css('display', 'flex');
                    },
                    success: function (data) {
                        $('.loading-clock').css('display', 'none'); // Hentikan loading
                        if (data.success == 1) {
                            toastr_success(data.messages);
                            service.draw(); // Refresh tabel
                        } else {
                            toastr_error(data.messages);
                        }
                    },
                    error: function (xhr, status, error) {
                        $('.loading-clock').css('display', 'none'); // Hentikan loading pada error
                        toastr_error("Something went wrong. Please try again.");
                    }
                });
                }
            });
        });

        function previewImage(input, previewSelector) {
            const file = input.files[0]; // Mengambil file pertama yang dipilih
            if (file) {
                // Memastikan file yang dipilih adalah gambar dengan format yang valid
                const validTypes = ["image/jpeg", "image/png", "image/jpg"];
                if (!validTypes.includes(file.type)) {
                    alert("Hanya file gambar dengan format JPEG, PNG yang diperbolehkan!");
                    input.value = ""; // Reset file input jika file tidak valid
                    $(previewSelector).empty(); // Hapus pratinjau gambar
                    return;
                }

                // Membaca file gambar menggunakan FileReader
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Menampilkan gambar di dalam elemen previewSelector (contohnya #imagev)
                    $(previewSelector).html(
                        `<img src="${e.target.result}" class="img-fluid rounded" style="max-width: 300px; max-height: 300px;">`
                    );
                };
                reader.readAsDataURL(file); // Membaca file sebagai data URL untuk pratinjau
            } else {
                $(previewSelector).empty(); // Hapus pratinjau jika tidak ada file yang dipilih
            }
}


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
    });
</script>
@endsection

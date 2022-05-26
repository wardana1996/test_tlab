<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <title>Data Master</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('datamasterkategori.index') }}">Data master</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"href="{{ route('dataresep.index') }}">Data Resep</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="h5">Kategori dan Bahan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah kategori</button>
            <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCreate" method="POST">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Kategori</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="kategori" class="form-control form-control-sm" id="kategori" placeholder="masukkan nama kategori">
                                        <span class="text-danger small" id="kategorierror"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="dataMasterKategoriTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formUpdate" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kategori</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kategori" class="form-control form-control-sm" id="kategori_edit" required>
                                    <span class="text-danger small" id="kategori_editerror"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="buttonUpdate" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            <h5 class="h5">Kategori dan Bahan</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateBahan">Tambah bahan</button>
            <div class="modal fade" id="modalCreateBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Bahan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCreateBahan" method="POST">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Bahan</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="bahan" class="form-control form-control-sm" id="bahan" placeholder="masukkan nama bahan">
                                        <span class="text-danger small" id="bahanerror"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display" id="dataMasterBahanTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalEditBahan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Bahan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formUpdateBahan" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bahan</label>
                                <div class="col-sm-8">
                                    <input type="text" name="bahan" class="form-control form-control-sm" id="bahan_edit" required>
                                    <span class="text-danger small" id="bahan_editerror"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="buttonUpdateBahan" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $('#dataMasterKategoriTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength : 6,
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
            ajax: {
                url: "{{ route('datamasterkategori.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                { data: 'kategori', name: 'kategori' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']]
        });

        $('#dataMasterBahanTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength : 6,
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
            ajax: {
                url: "{{ route('datamasterbahan.index') }}",
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                { data: 'bahan', name: 'bahan' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']]
        });

        $(document).on('submit', '#formCreate', function(event){  
            event.preventDefault();  
            var kategori = $('#kategori').val();       
            $.ajax({
                url: "{{ route('datamasterkategori.create') }}",
                cache: false,  
                method:'POST',  
                data:  $(this).serialize(),
                success: function(data){
                    Swal.fire({
                        title: 'Berhasil',
                        text: "sukses",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        confirmButtonText: 'Yes',
                        allowOutsideClick: false
                    });
                    $('#formCreate')[0].reset(); 
                    $('#modalCreate').modal('hide');  
                    $('#dataMasterKategoriTable').DataTable().ajax.reload( null, false ); 
                },
                error:function (response) {
                    $("#kategorierror").hide().text(response.responseJSON.errors.kategori).fadeIn('slow').delay(2000).hide(1);
                }
            })
        }); 

        $(document).on('submit', '#formCreateBahan', function(event){  
            event.preventDefault();  
            var bahan = $('#bahan').val();       
            $.ajax({
                url: "{{ route('datamasterbahan.create') }}",
                cache: false,  
                method:'POST',  
                data:  $(this).serialize(),
                success: function(data){
                    Swal.fire({
                        title: 'Berhasil',
                        text: "sukses",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        confirmButtonText: 'Yes',
                        allowOutsideClick: false
                    });
                    $('#formCreateBahan')[0].reset(); 
                    $('#modalCreateBahan').modal('hide');  
                    $('#dataMasterBahanTable').DataTable().ajax.reload( null, false ); 
                },
                error:function (response) {
                    $("#bahanerror").hide().text(response.responseJSON.errors.bahan).fadeIn('slow').delay(2000).hide(1);
                }
            })
        }); 

        $(document).on("click", ".editDataMasterKategori", function () {
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                url: "{{ url('/datamasterkategori/edit') }}"+'/'+id,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#modalEdit').modal('show');
                    $('#id').val(res.id);
                    $('#kategori_edit').val(res.kategori);
                }
            });
        });

        $(document).on("click", ".editDataMasterBahan", function () {
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                url: "{{ url('/datamasterbahan/edit') }}"+'/'+id,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#modalEditBahan').modal('show');
                    $('#id').val(res.id);
                    $('#bahan_edit').val(res.bahan);
                }
            });
        });

        $(document).on('click', '#buttonUpdate', function(event){  
            event.preventDefault(); 
            var kategori =$('#kategori_edit').val();
            var id = $('#id').val();  
            $.ajax({
                url: "{{ url('/datamasterkategori/update') }}"+'/'+id,
                cache: false,
                method:"POST",
                data: $('#formUpdate').serialize(),
                success: function(data){
                    Swal.fire({
                        title: 'data berhasil diupdate',
                        text: "sukses",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        confirmButtonText: 'Oke',
                        allowOutsideClick: false
                    });
                    $('#formUpdate')[0].reset(); 
                    $('#modalEdit').modal('hide');
                    $('#dataMasterKategoriTable').DataTable().ajax.reload( null, false );      
                },
                error:function (response) {
                    $('#kategori_editerror').hide().text(response.responseJSON.errors.kategori).fadeIn('slow').delay(2000).hide(1);
                }
            })
        });  

        $(document).on('click', '#buttonUpdateBahan', function(event){  
            event.preventDefault(); 
            var bahan =$('#bahan_edit').val();
            var id = $('#id').val();  
            $.ajax({
                url: "{{ url('/datamasterbahan/update') }}"+'/'+id,
                cache: false,
                method:"POST",
                data: $('#formUpdateBahan').serialize(),
                success: function(data){
                    Swal.fire({
                        title: 'data berhasil diupdate',
                        text: "sukses",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        confirmButtonText: 'Oke',
                        allowOutsideClick: false
                    });
                    $('#formUpdateBahan')[0].reset(); 
                    $('#modalEditBahan').modal('hide');
                    $('#dataMasterBahanTable').DataTable().ajax.reload( null, false );      
                },
                error:function (response) {
                    $('#bahan_editerror').hide().text(response.responseJSON.errors.bahan).fadeIn('slow').delay(2000).hide(1);
                }
            })
        });  

        $(document).on('click', '.delete', function(){  
            var id = $(this).attr("data-id");  
            Swal.fire({
                title: 'Apakah anda yakin untuk menghapus data ini ?',
                text: "data akan dihapus secara permanen !",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#004028',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/datamasterkategori/delete') }}"+'/'+id,
                        cache: false,
                        method:"DELETE",  
                        data: { id: id },
                        success: function(data){
                            $('#dataMasterKategoriTable').DataTable().ajax.reload( null, false );       
                        },
                        error: function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'Maaf...',
                                text: 'Ada Kesalahan !',
                            })
                        }
                    }),
                    Swal.fire({
                        title: 'Terhapus',
                        text: "Data berhasil dihapus",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        allowOutsideClick: false
                    })
                }
            });
        }); 

        $(document).on('click', '.deletebahan', function(){  
            var id = $(this).attr("data-id");  
            Swal.fire({
                title: 'Apakah anda yakin untuk menghapus data ini ?',
                text: "data akan dihapus secara permanen !",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#004028',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                allowOutsideClick: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{ url('/datamasterbahan/delete') }}"+'/'+id,
                        cache: false,
                        method:"DELETE",  
                        data: { id: id },
                        success: function(data){
                            $('#dataMasterBahanTable').DataTable().ajax.reload( null, false );       
                        },
                        error: function(){
                            Swal.fire({
                                icon: 'error',
                                title: 'Maaf...',
                                text: 'Ada Kesalahan !',
                            })
                        }
                    }),
                    Swal.fire({
                        title: 'Terhapus',
                        text: "Data berhasil dihapus",
                        icon: 'success',
                        confirmButtonColor: '#004028',
                        allowOutsideClick: false
                    })
                }
            });
        }); 
    });
</script>
</body>
</html>
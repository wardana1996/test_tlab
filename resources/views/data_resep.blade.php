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
  <style>
        .dataTables_filter, .dataTables_info { 
            display: none; 
        }
  </style>
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
            <h5 class="h5">Resep</h5>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah resep</button>
            <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Resep</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCreate" method="POST">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Resep</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="resep" class="form-control form-control-sm" id="resep" placeholder="masukkan nama resep">
                                        <span class="text-danger small" id="reseperror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kategori</label>
                                    <div class="col-sm-8">
                                        <select name="kategori_id" id="kategori_id" class="form-control form-control-sm obat_id" style='width: 300px;'></select>
                                        <span class="text-danger small" id="kategori_iderror"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bahan</label>
                                    <div class="col-sm-8">
                                        <select name="bahan[]" id="bahan" class="form-control form-control-sm obat_id" style='width: 300px;'></select>
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
            <div class="form-group row ml-1">
                <select id="searchKategori" class="form-control mr-2" style='width: 300px;'></select>
            </div>
            <br>
            <div class="table-responsive">
                <table class="display" id="dataResepTable" width="100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Resep</th>
                            <th>Nama Kategori</th>
                            <th>Nama Bahan</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Resep</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formUpdate" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Nama Resep</label>
                                <div class="col-sm-8">
                                    <input type="text" name="resep" class="form-control form-control-sm" id="resep_edit">
                                    <span class="text-danger small" id="resepediterror"></span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Kategori</label>
                                <div class="col-sm-8">
                                    <select name="kategori_selected" id="kategori_id_edit" class="form-control form-control-sm kategori_id_edit" style='width: 300px;' >
                                    </select>
                                    <span class="text-danger small" id="kategori_idediterror"></span>
                                </div>
                                <input type="hidden" name="kategori_id" id="kategori_id_box"/>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Bahan</label>
                                <div class="col-sm-8">
                                    <span>bahan : <div id="bahan_edit_master"></div></span>
                                    <select name="bahan_selected" id="bahan_edit" class="form-control form-control-sm bahan_edit" style='width: 300px;' >
                                    </select>
                                    <span class="text-danger small" id="bahanediterror"></span>
                                </div>
                                <input type="hidden" name="bahan[]" id="bahan_box"/>
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

        $('select[name="kategori_selected"]').on('change', function() {
            var kategoriID = $(this).val();
            $('#kategori_id_box').val(kategoriID);  
        });

        $('select[name="bahan_selected"]').on('change', function() {
            var bahan = $(this).val();
            $('#bahan_box').val(bahan);  
        });
    
        var table = $('#dataResepTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            pageLength : 6,
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']],
            ajax: {
                url: "{{ route('dataresep.index') }}",
                type: 'GET',
                data: function (d) {
                    d.kategori_id = $('#searchKategori').val(),
                    d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false },
                { data: 'resep', name: 'resep' },
                { data: 'kategori', name: 'kategori' },
                { data: 'bahan', name: 'bahan' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            order: [[0, 'desc']]
        });

        $("#searchKategori").change(function(){
            table.draw();
        });

        $('#searchKategori').select2({
            placeholder: '-- pilih kategori --',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{ route('dataresep.kategori') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kategori, 
                                id: item.id
                            }     
                        })
                    };
                },
                cache: true
            }
        });

        $('#kategori_id').select2({
            placeholder: '-- pilih kategori --',
            theme: 'bootstrap-5',
            ajax: {
                url: "{{ route('dataresep.kategori') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.kategori, 
                                id: item.id
                            }     
                        })
                    };
                },
                cache: true
            }
        });

        $('#bahan').select2({
            placeholder: '-- pilih bahan --',
            theme: 'bootstrap-5',
            multiple: true,
            ajax: {
                url: "{{ route('dataresep.bahan') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (item) {
                            return {
                                text: item.bahan, 
                                id: item.bahan
                            }     
                        })
                    };
                },
                cache: true
            }
        });

        $(document).on('submit', '#formCreate', function(event){  
            event.preventDefault();  
            var resep = $('#resep').val();   
            var kategori_id = $('#kategori_id').val();    
            var bahan = $('#bahan').val();      
            $.ajax({
                url: "{{ route('dataresep.create') }}",
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
                    $('#kategori_id').val(null).trigger('change');
                    $('#bahan').val(null).trigger('change');
                    $('#dataResepTable').DataTable().ajax.reload( null, false ); 
                },
                error:function (response) {
                    $("#reseperror").hide().text(response.responseJSON.errors.resep).fadeIn('slow').delay(2000).hide(1);
                    $("#kategori_iderror").hide().text(response.responseJSON.errors.kategori_id).fadeIn('slow').delay(2000).hide(1);
                    $("#bahanerror").hide().text(response.responseJSON.errors.bahan).fadeIn('slow').delay(2000).hide(1);
                }
            })
        }); 

        $(document).on("click", ".editResep", function () {
            var id = $(this).data('id');
            $.ajax({
                type:"POST",
                url: "{{ url('/dataresep/edit') }}"+'/'+id,
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    $('#modalEdit').modal('show');
                    $('#id').val(res.id);
                    $('#resep_edit').val(res.resep);
                    $('#kategori_id_edit').val(res.kategori_id);
                    $('#kategori_id_box').val(res.kategori_id);
                    $('#kategori_id_edit').select2({
                        placeholder: res.kategori,
                        theme: 'bootstrap-5',
                        ajax: {
                            url: "{{ route('dataresep.kategori') }}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    results:  $.map(data, function (item) {
                                        return {
                                            text: item.kategori, 
                                            id: item.id
                                        }     
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                    $('#bahan_edit_master').text(res.bahan);
                    $('#bahan_edit').val(res.bahan);
                    $('#bahan_box').val(res.bahan);
                    $('#bahan_edit').select2({
                        theme: 'bootstrap-5',
                        multiple: true,
                        ajax: {
                            url: "{{ route('dataresep.bahan') }}",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    results:  $.map(data, function (item) {
                                        return {
                                            text: item.bahan, 
                                            id: item.bahan
                                        }     
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                }
            });
        });

        $(document).on('click', '#buttonUpdate', function(event){  
            event.preventDefault(); 
            var resep = $('#resep_edit').val();
            var kategori_id = $('#kategori_id_box').val();
            var bahan = $('#bahan_edit').val();
            var id = $('#id').val();  
            $.ajax({
                url: "{{ url('/dataresep/update') }}"+'/'+id,
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
                    $('#kategori_id_edit').val(null).trigger('change');
                    $('#bahan_edit').val(null).trigger('change');
                    $('#dataResepTable').DataTable().ajax.reload( null, false );      
                },
                error:function (response) {
                    $('#resepediterror').hide().text(response.responseJSON.errors.resep).fadeIn('slow').delay(2000).hide(1);
                    $('#kategori_idediterror').hide().text(response.responseJSON.errors.kategori_id).fadeIn('slow').delay(2000).hide(1);
                    $('#bahanediterror').hide().text(response.responseJSON.errors.bahan).fadeIn('slow').delay(2000).hide(1);
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
                        url: "{{ url('/dataresep/delete') }}"+'/'+id,
                        cache: false,
                        method:"DELETE",  
                        data: { id: id },
                        success: function(data){
                            $('#dataResepTable').DataTable().ajax.reload( null, false );       
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
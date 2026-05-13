@extends('admin.layout')
@section('content')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-content-center justify-content-between">
                        <h3 class="font-weight-bold text-xl">Data Kavling</h3>
                        <div class="d-flex align-items-center">
                             @if (isset($permissions['tambah']) && $permissions['tambah'] == 1)
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm">
                                    <i class="bi bi-plus-lg"></i> Tambah Kavling
                                </button>
                            @endif
                            <a href="{{ route('kavling.cetakPdf', 0) }}" target="_blank"
                                class="btn btn-danger btn-rounded btn-sm ms-2" title="Cetak PDF">
                                <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                            </a>
                            <a href="{{ route('kavling.cetakExcel', 0) }}" target="_blank"
                                class="btn btn-success btn-rounded btn-sm ms-2" title="Cetak Excel">
                                <i class="bi bi-file-earmark-excel"></i> Cetak Excel
                            </a>
                            <a href="javascript:void(0);" onclick="reloadTable()"
                                class="btn btn-light btn-rounded btn-sm ms-2" title="Reload Tabel">
                                <i class="bi bi-arrow-clockwise"></i> Reload
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table data-table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50px">No</th>
                                    <th>Nama Cluster</th>
                                    <th>Panjang</th>
                                    <th>Lebar</th>
                                    <th>Luas</th>
                                    <th>Harga</th>
                                    <th width="200px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modalFormLabel">Form Kavling</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="formData">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" id="primary_id" name="primary_id">

                        <div class="container-fluid">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="id_lokasi" class="form-label">Nama Cluster</label>
                                    <select name="id_lokasi" id="id_lokasi"
                                        class="form-control select-lokasi">
                                        <option value=""></option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="kode_kavling" class="form-label">Kode Kavling</label>
                                    <input type="text" name="kode_kavling" id="kode_kavling"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="panjang_kanan" class="form-label">Panjang Kanan</label>

                                    <div class="input-group">
                                        <input type="number"
                                            name="panjang_kanan"
                                            id="panjang_kanan"
                                            class="form-control"
                                            placeholder="0">

                                        <span class="input-group-text">m2</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="panjang_kiri" class="form-label">Panjang Kiri</label>

                                    <div class="input-group">
                                        <input type="number"
                                            name="panjang_kiri"
                                            id="panjang_kiri"
                                            class="form-control"
                                            placeholder="0">

                                        <span class="input-group-text">m2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="lebar_depan" class="form-label">Lebar Depan</label>

                                    <div class="input-group">
                                        <input type="number"
                                            name="lebar_depan"
                                            id="lebar_depan"
                                            class="form-control"
                                            placeholder="0">

                                        <span class="input-group-text">m2</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="lebar_belakang" class="form-label">Lebar Belakang</label>

                                    <div class="input-group">
                                        <input type="number"
                                            name="lebar_belakang"
                                            id="lebar_belakang"
                                            class="form-control"
                                            placeholder="0">

                                        <span class="input-group-text">m2</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="luas_tanah" class="form-label">Luas Tanah</label>

                                    <input type="number"
                                        name="luas_tanah"
                                        id="luas_tanah"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="hrg_meter" class="form-label">
                                        Harga Per Meter
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>

                                        <input type="text"
                                            name="hrg_meter"
                                            id="hrg_meter"
                                            class="form-control rupiah">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="hrg_jual" class="form-label">
                                        Harga Jual
                                    </label>

                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>

                                        <input type="text"
                                            name="hrg_jual"
                                            id="hrg_jual"
                                            class="form-control rupiah">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="keterangan" class="form-label">Keterangan</label>

                                    <textarea name="keterangan"
                                        id="keterangan"
                                        rows="4"
                                        class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal">
                            <span class="button-text">Batal</span>
                        </button>

                        <button type="submit"
                            class="btn btn-primary ms-1"
                            id="submitBtn">

                            <span class="spinner-border spinner-border-sm me-2 d-none"
                                role="status"
                                aria-hidden="true"></span>

                            <span class="button-text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var permissions = @json($permissions);
        var showActionColumn = (permissions['edit'] == 1 || permissions['hapus'] == 1);
        var audio = new Audio('{{ asset('audio/notification.ogg') }}');
        var table;

         $(document).ready(function() {
               $('.select-lokasi').select2({
                    dropdownParent: $('#modalForm'),
                    width: '100%',
                    placeholder: 'Pilih Lokasi',
                    allowClear: true,

                    ajax: {
                        url: "{{ route('kavling.getLokasi') }}",
                        dataType: 'json',
                        delay: 250,

                        processResults: function (response) {

                            return {
                                results: $.map(response, function (item) {
                                    return {
                                        id: item.id,
                                        text: item.nama_kavling
                                    };
                                })
                            };

                        },

                        cache: true
                    }
                });
                if ($('body').hasClass('dark')) {
                    $('.select2-container').addClass('select2-dark');
                }
            });
            
         $('.rupiah').on('keyup', function() {
            let angka = $(this).val().replace(/[^,\d]/g, '').toString();
            let split = angka.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            $(this).val(rupiah);
        });
        
        var permissions = @json($permissions);
        var showActionColumn = (permissions['edit'] == 1);

        $(function() {
            table = $('.data-table').DataTable({
                processing: false,
                serverSide: true,
                ordering: false,
                responsive: true,
                ajax: "{{ route('kavling.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'nama_cluster',
                        name: 'nama_cluster',
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row) {
                            return data + '<br><small class="text-muted">Blok ' + row.lokasi + '</small>';
                        }
                    },
                    {
                        data: 'panjang',
                        name: 'panjang',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'lebar',
                        name: 'lebar',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'luas',
                        name: 'luas',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        visible: showActionColumn,
                        className: 'text-center'
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }]
            });
        });

        $(document).on('click', '.edit-button', function() {
            var url = $(this).data('url');
            $.get(url, function(response) {
                if (response.success) {
                    $('#primary_id').val(response.data.id);
                    var option = new Option(response.data.lokasi.nama_kavling, response.data.id_lokasi, true, true);
                    $('#id_lokasi').append(option).trigger('change');
                    $('#id_lokasi').prop('disabled', true);
                    $('#kode_kavling').val(response.data.kode_kavling).prop('readonly', true);
                    $('#panjang_kanan').val(response.data.panjang_kanan);
                    $('#panjang_kiri').val(response.data.panjang_kiri);
                    $('#lebar_depan').val(response.data.lebar_depan);
                    $('#lebar_belakang').val(response.data.lebar_belakang);
                    $('#luas_tanah').val(response.data.luas_tanah);
                    $('#hrg_meter').val(response.data.hrg_meter.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                    $('#hrg_jual').val(response.data.hrg_jual.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                    $('#keterangan').val(response.data.keterangan);

                    $('#modalFormLabel').text('Edit Kavling');
                    $('#modalForm').modal('show');
                }
            });
        });

        function reloadTable() {
            table.ajax.reload(null, false);
        }

        $('#modalForm').on('hidden.bs.modal', function () {
            $('#formData')[0].reset();

            $('#primary_id').val('');
            $('#id_lokasi').val('').trigger('change').prop('disabled', false);
            $('#kode_kavling').val('').prop('readonly', false);
            $('#panjang_kanan').val('');
            $('#panjang_kiri').val('');
            $('#lebar_depan').val('');
            $('#lebar_belakang').val('');
            $('#luas_tanah').val('');
            $('#hrg_meter').val('');
            $('#hrg_jual').val('');
            $('#keterangan').val('');

            $('#modalFormLabel').text('Form Kavling');

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            $('.error-text').text('');

            let submitBtn = $('#submitBtn');
            let spinner = submitBtn.find('.spinner-border');
            let btnText = submitBtn.find('.button-text');

            spinner.addClass('d-none');
            btnText.text('Simpan');
            submitBtn.prop('disabled', false);
        });


         $('#formData').on('submit', function(e) {
            e.preventDefault();

            let submitBtn = $('#submitBtn');
            let spinner = submitBtn.find('.spinner-border');
            let btnText = submitBtn.find('.button-text');

            spinner.removeClass('d-none');
            btnText.text('Menyimpan...');
            submitBtn.prop('disabled', true);

            let id = $('#primary_id').val();
            let url = id ? '{{ route('kavling.update', ['kavling' => ':id']) }}'.replace(':id',
                    id) :
                '{{ route('kavling.store') }}';
            let method = id ? 'PUT' : 'POST';

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            let formData = new FormData(this);
            formData.append('_method', method);

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.success) {
                        $('#modalForm').modal('hide');
                        audio.play();
                        let msg = id ? "Data berhasil diupdate!" : "Data berhasil ditambahkan!";
                        toastr.success(msg, "BERHASIL", {
                            progressBar: true,
                            timeOut: 3500,
                            positionClass: "toast-bottom-right",
                        });
                        $('.data-table').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        audio.play();
                        toastr.error("Ada inputan yang salah!", "GAGAL!", {
                            progressBar: true,
                            timeOut: 3500,
                            positionClass: "toast-bottom-right",
                        });

                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, val) {
                            let input = $('#' + key);
                            input.addClass('is-invalid');
                            input.parent().find('.invalid-feedback').remove();
                            input.parent().append(
                                '<span class="invalid-feedback" role="alert"><strong>' +
                                val[0] + '</strong></span>'
                            );
                        });
                    } else {
                        audio.play();
                        let msg = xhr.responseJSON?.message || "Terjadi kesalahan server!";
                        toastr.error(msg, "ERROR!", {
                            progressBar: true,
                            timeOut: 3500,
                            positionClass: "toast-bottom-right",
                        });
                    }
                },
                complete: function() {
                    spinner.addClass('d-none');
                    btnText.text('Simpan');
                    submitBtn.prop('disabled', false);
                }
            });
        });

       $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();

            const form = $(this).closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '<span class="swal-btn-text">Ya, Hapus</span>',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: false,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary'
                },
                preConfirm: () => {
                    return new Promise((resolve) => {
                        const confirmBtn = Swal.getConfirmButton();
                        const btnText = confirmBtn.querySelector('.swal-btn-text');

                        btnText.innerHTML =
                            `<span class="spinner-border spinner-border-sm mx-2" role="status" aria-hidden="true"></span> Menghapus...`;
                        confirmBtn.disabled = true;

                        $.ajax({
                            url: form.attr('action'),
                            method: 'POST',
                            data: form.serialize(),
                            success: function(res) {
                                if (res.success) {
                                    audio.play();
                                    toastr.success("Data berhasil dihapus!",
                                        "BERHASIL", {
                                            progressBar: true,
                                            timeOut: 3500,
                                            positionClass: "toast-bottom-right"
                                        });

                                    $('.data-table').DataTable().ajax.reload(null,
                                        false);
                                    Swal.close();
                                }
                            },
                            error: function() {
                                audio.play();
                                toastr.error("Gagal menghapus Pengguna.",
                                    "GAGAL!", {
                                        progressBar: true,
                                        timeOut: 3500,
                                        positionClass: "toast-bottom-right"
                                    });

                                btnText.innerHTML = `Ya, Hapus`;
                                confirmBtn.disabled = false;
                            }
                        });
                    });
                }
            });
        });
    </script>
@endpush

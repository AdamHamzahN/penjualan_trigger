@extends('template.layout')
@section('title', 'data barang')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <h1>Data Barang</h1>
            <div class="card-header">
                <button class="btn btn-success btnTambahBarang" data-bs-target="#modalForm" data-bs-toggle="modal"
                    attr-href={{ route('barang.tambah') }}><i class="bi bi-plus-lg"></i>Tambah</button>
            </div>
            <div class="card-body">
                <table class="table DataTable table-hovered table-bordered table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
        {{-- modal --}}
        <div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btnSimpanBarang"><i class="bi bi-save"></i>Simpan</button>
                        <button class="btn btn-primary " data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('footer')
    <script type="module">
        const barangModal = document.querySelector('#modalForm');
        const modal = bootstrap.Modal.getOrCreateInstance(barangModal);
        var table = $('.DataTable').DataTable({
            processing: true,
            ServerSide: true,
            ajax: "{!! route('barang.data') !!}",
            columns: [{
                    data: 'kode_barang',
                    name: 'kode_barang',
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang',
                },
                {
                    render: function(data, type, row) {
                        return row.stok.jumlah;
                    }
                },
                {
                    render: function(data, type, row) {
                        return "<btn class='btn btn-primary editBtn' data-bs-toggle='modal' data-bs-target='#modalForm' attr-href='{!! url('/barang/edit/"+row.id_barang+"') !!}'><i class='bi bi-pencil'></i>Edit</btn><btn class='btn btn-danger'><i class='bi bi-trash'></i>Hapus</btn>"
                    }
                }
            ]
        });

        //tombol tambah barang
        $('.btnTambahBarang').on('click', function(a) {
            changeHTML('#modalForm', '.modal-title', 'Tambah Data Barang');
            const modalForm = document.getElementById('modalForm');
            modalForm.addEventListener('shown.bs.modal', function(eventTambah) {
                eventTambah.preventDefault();
                eventTambah.stopImmediatePropagation();
                const link = eventTambah.relatedTarget.getAttribute('attr-href');
                // alert(link);
                //const modalData = document.querySelector('#modalForm .modal-body');
                // $(".modal-header .modal-title").html("Tambah data Barang Baru");
                axios.get(link).then(response => {
                    $("#modalForm .modal-body").html(response.data);
                });
                //Contoh Ajax
                //
                // $.ajax(({
                //     url:link,
                //     method: 'GET',
                //     success: function(response){
                //         $('modalForm .modal-body').html('p');
                //     }
                //}))

                //simpan
                $('.btnSimpanBarang').on('click', function(submitEvent) {
                    submitEvent.stopImmediatePropagation();
                    var data = {
                        'kode_barang': $('#kode_barang').val(),
                        'nama_barang': $('#nama_barang').val(),
                        'harga': $('#harga').val(),
                        '_token': "{{ csrf_token() }}"
                    }
                    if (data.kode_barang !== '' && data.nama_barang !== '' && data.harga !== '') {
                        axios.post('{{ url("/barang/simpan") }}', data).then(resp => {
                            if (resp.data.status == 'success') {
                                //tampilkan pop up berhasil;
                                Swal.fire({
                                    title: "berhasil!",
                                    text: resp.data.pesan,
                                    icon: "success"
                                }).then( () => {
                                    //close modal
                                    modal.hide();
                                    //reload tabel
                                    table.ajax.reload();
                                    
                                });
                            } else {
                                //tampilkan pop up gagal
                                Swal.fire({
                                    title: "GAGAL",
                                    text: resp.data.pesan,
                                    icon: "error"
                                });
                            }
                        });
                    } else {
                        alert('data tidak boleh kosong');
                    }

                });
            });
            modalForm.addEventListener('hidden.bs.modal', function(closeEvent) {
                closeEvent.preventDefault();
                closeEvent.stopImmediatePropagation();

                $('#modalForm').removeData();
            });
        });

        $('.DataTable tbody').on('click', '.editBtn', function(event) {
            changeHTML('#modalForm', '.modal-title', 'Edit Data Barang');
            let modalForm = document.getElementById('modalForm');
            modalForm.addEventListener('shown.bs.modal', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                const link = event.relatedTarget.getAttribute('attr-href');

                axios.get(link).then(response => {
                    $('#modalForm .modal-body').html(response.data);
                    // $(".modal-title").html("Edit Data Barang Baru");
                })
            })
        //     $('.btnSimpanBarang').on('click', function(submitEvent) {
        //             submitEvent.stopImmediatePropagation();
        //             var data = {
        //                 'id_barang' : $('#id_barang').val(),
        //                 'kode_barang': $('#kode_barang').val(),
        //                 'nama_barang': $('#nama_barang').val(),
        //                 'harga': $('#harga').val(),
        //                 '_token': "{{ csrf_token() }}"
        //             }
        //             if (data.id_barang != '' && data.kode_barang !== '' && data.nama_barang !== '' && data.harga !== '') {
        //                 axios.post('{{ url("/barang/simpan") }}', data).then(resp => {
        //                     if (resp.data.status == 'success') {
        //                         //tampilkan pop up berhasil;
        //                         Swal.fire({
        //                             title: "berhasil!",
        //                             text: resp.data.pesan,
        //                             icon: "success"
        //                         }).then( () => {
        //                             //close modal
        //                             modal.hide();
        //                             //reload tabel
        //                             table.ajax.reload();
                                    
        //                         });
        //                     } else {
        //                         //tampilkan pop up gagal
        //                         Swal.fire({
        //                             title: "GAGAL",
        //                             text: resp.data.pesan,
        //                             icon: "error"
        //                         });
        //                     }
        //                 });
        //             } else {
        //                 alert('data tidak boleh kosong');
        //             }

        //         });
         });

        function changeHTML(element,find,text){
            $(element).find(find).html();
            return $(element).find(find).html(text).promise().done();
        }

    </script>
@endsection

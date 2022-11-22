@extends('template.layout')
@section('title')
    Siswa
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Siswa</h1>
        </div>

       <!-- Data Siswa -->
        <div class="col-12-col-md-12-col-lg-12">
            <div class="card">
                <!-- Judul -->
                <div class="card-header">
                   <div class="col-12-col-md-10-col-lg-10">
                    <h4>Data Siswa</h4>
                   </div>
                   <div class="col-12-col-md-2-col-lg-2">
                    <button type="button" onclick="addForm('{{route('siswa.store')}}')"class="btn btn-success shadow-sm rounded-pill"><i class="fa fa-print"></i>Print</button>
                    <button type="button" onclick="addForm('{{ route('siswa.store') }}')" class="btn btn-primary shadow-sm rounded-pill"><i class="fa fa-plus"></i>Tambah</button>
                   </div> 
                </div>

                <!-- Tabel -->
                <div class="card-body">
                            <table class="table table-striped text-nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td scope="col" style="width: 50px;">No</td>
                                        <td scope="col">Nama</td>
                                        <td scope="col">Jurusan</td>
                                        <td scope="col">Asal Sekolah</td>
                                        <td scope="col" style="width: 120px;">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
            </div>
        </div>
    </section>
    
@include('siswa.form')

@endsection

@push('script')
<script>
    // Data Tables
    let table;
    $(function() {
        table = $('.table').DataTable({
            proccesing: true,
            autowidth: false,
            ajax: {
                url: '{{ route('siswa.data') }}'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
                {data: 'jurusan'},
                {data: 'asal_sekolah'},
                {data: 'aksi'}
            ]
        });
    })
    $('.table').on('submit', function(e){
            if(! e.preventDefault()){
                $.post($('.table form').attr('action'), $('.table form').serialize())
                .done((response) => {
                    $('.table form')[0].reset();
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data gagal disimpan',
                        position: 'topRight'
                    })
                    return;
                })
            }
    })

    $('#modalForm').on('submit', function(e){
        if(! e.preventDefault()){
            $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
            .done((response) => {
                $('#modalForm').modal('hide');
                table.ajax.reload();
                iziToast.success({
                    title: 'Sukses',
                    message: 'Data berhasil disimpan',
                    position: 'topRight'
                })
            })
            .fail((errors) => {
                iziToast.error({
                    title: 'Gagal',
                    message: 'Data gagal disimpan',
                    position: 'topRight'
                })
                return;
            })
        }
    })

    function addForm(url){
            $('#modalForm').modal('show');
            $('#modalForm .modal-title').text('Tambah Data Siswa');
            $('#modalForm form')[0].reset();
            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('post');
    }

    function editData(url){
            $('#modalForm').modal('show');
            $('#modalForm .modal-title').text('Edit Data Siswa');
            $('#modalForm form')[0].reset();
            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('put');
            $.get (url)
                .done((response) => {
                    $('#modalForm [name=nama]').val(response.nama);
                    $('#modalForm [name=kelas]').val(response.kelas);
                    $('#modalForm [name=jurusan]').val(response.jurusan);
                    $('#modalForm [name=asal_sekolah]').val(response.asal_sekolah);
                    // console.log(response.nama);
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menampilkan Data');
                    return;
                })
    }

        function deleteData(url){
            swal({
                title: "Apa anda yakin menghapus data ini?",
                text: "Jika anda klik OK, maka data akan terhapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.post(url, {
                    '_token' : $('[name=csrf-token]').attr('content'),
                    '_method' : 'delete'
                })
                .done((response) => {
                    swal({
                    title: "Sukses",
                    text: "Data berhasil dihapus!",
                    icon: "success",
                    });
                })
                .fail((errors) => {
                    swal({
                    title: "Gagal",
                    text: "Data gagal dihapus!",
                    icon: "error",
                    });
                })
                table.ajax.reload();
                }
            });
        }
    </script>
@endpush
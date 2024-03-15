<style>
  .btn-primary {
    background-color: #617a6b !important;
    border: #617a6b !important;
  }
</style>

@extends('layout.main')
@section('main-content')
  <div class="row mb-3">
    <div class="col-md-3">
      <button class="btn btn-primary" id="btnadd" onclick="add()">
        <span class="bi bi-plus"></span>
        Tambah
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm" id="tablecars" style="width: 100%">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Merk</th>
          <th class="text-center">Jenis Mobil</th>
          <th class="text-center">Plat Nomor</th>
          <th class="text-center">Tahun</th>
          <th class="text-center">Sewa Perhari (Rp)</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  {{-- MODAL ADD --}}
  <div class="modal fade" id="modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mobil</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger d-none">
            <ul class="message">
            </ul>
          </div>
          <form action="#" method="POST" id="formadd">
            @csrf
            <div class="form-group col-md-12">
              <label for="merk" class="control-label" style="font-weight:bold">Merk Mobil</label>
              <input type="text" class="form-control" name="merk" id="merk" placeholder="Tuliskan Merk Mobil">
            </div>
            <div class="form-group col-md-12">
              <label for="jenis" class="control-label" style="font-weight:bold">Jenis Mobil</label>
              <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Tuliskan Jenis Mobil">
            </div>
            <div class="form-group col-md-12">
              <label for="plat" class="control-label" style="font-weight:bold">Plat Nomor</label>
              <input type="text" class="form-control" name="plat" id="plat" placeholder="Tuliskan Plat Nomor Mobil">
            </div>
            <div class="form-group col-md-12">
              <label for="transmisi" class="control-label" style="font-weight: bold">Transmisi</label>
              <select name="transmisi" class="form-control" id="transmisi">
                <option value="0" selected disabled>Pilih Jenis Transmisi</option>
                <option value="Matic">Matic</option>
                <option value="Manual">Manual</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="tahun" class="control-label" style="font-weight:bold">Tahun</label>
              <input type="number" class="form-control" name="tahun" id="tahun" placeholder="Tuliskan Tahun Mobil">
            </div>
            <div class="form-group col-md-12">
              <label for="harga" class="control-label" style="font-weight:bold">Harga Sewa</label>
              <input type="number" class="form-control" name="harga_weekdays" id="harga_weekdays" placeholder="Tuliskan Harga Sewa Weekdays">
              <input type="number" class="form-control" name="harga_weekend" id="harga_weekend" placeholder="Tuliskan Harga Sewa Weekend">
            </div>
          </form>
          <div class="col-md-12 mt-3">
            <button type="button" class="btn btn-primary col-md-12" id="btnsave" onclick="save()">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      $('#web-title').html('HM Rent Car - Data Mobil');
      $('#page-title').html('Data Mobil');
      $('#btnmobil').addClass('active');

      $('#tablecars').DataTable({
        "responsive": true,
        "processing":true,
        "serverside": true,
        "ajax": {
          "url": "/get-cars",
          "type": "GET",
        },
        "columns": [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
          {data: 'merk', name: 'Merk'},
          {data: 'jenis', name: 'Jenis Mobil'},
          {data: 'plat_nomor', name: 'Plat Nomor'},
          {data: 'tahun', name: 'Tahun'},
          {data: 'harga', name: 'Harga'},
          {data: 'aksi', name: 'Aksi'}
        ],
        "columnDefs": [
          { "targets": [0, 6], "className": "text-center" },
          // { "targets": [4], width: 1 },
        ],
        "language": {
          "processing": '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
        }
      });
    })

    function add(){
      $('#modaladd').modal('show');
      $('#formadd')[0].reset();
      $('.alert-danger').addClass('d-none');
    }

    function save(){
      const formAdd = $('#formadd');
      const modalAdd = $('#modaladd');
      $.ajax({
        type: "POST",
        url: "post-cars",
        data: formAdd.serialize(),
        dataType: "JSON",

        beforeSend: function(){
          $('#btnsave').attr('disabled', true);
          $('#btnsave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        },

        complete: function(){
          $('#btnsave').attr('disabled', false);
          $('#btnsave').html('Simpan');
        },

        success: function(response){
          if(response.success){
            Swal.fire({
              icon: 'success',
              title: 'Data Berhasil Ditambahkan!',
              showConfirmButton: false,
              timer: 1500
            });
            modalAdd.modal('hide');
            $('#tablecars').DataTable().ajax.reload();
          } else {
            $('.message').empty();
            $('.alert-danger').removeClass('d-none');
            $.each(response.error, function(key,value){
              $('.message').append("<li>" + value + "</li>")
            });
          }
        }
      })
    }
  </script>
@endsection
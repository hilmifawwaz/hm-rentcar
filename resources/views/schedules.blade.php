<style>
  .control-label{
    font-weight: bold;
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
    <table class="table table-striped table-sm" id="tableschedule" style="width: 100%">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th class="text-center">Penyewa</th>
          <th class="text-center">Mobil</th>
          {{-- <th class="text-center">Plat Nomor</th> --}}
          <th class="text-center">Tanggal</th>
          <th class="text-center">Total Harga (Rp)</th>
          <th class="text-center">Jaminan</th>
          <th class="text-center">Status</th>
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
              <label for="penyewa" class="control-label">Pelanggan</label>
              <div class="form-check">
                <input class="form-check-input penyewa" type="radio" name="penyewa" id="penyewa1" value="Lama">
                <label class="form-check-label" for="penyewa1">
                  Lama
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input penyewa" type="radio" name="penyewa" id="penyewa2" value="Baru">
                <label class="form-check-label" for="penyewa2">
                  Baru
                </label>
              </div>
              <select name="pelanggan" id="pelanggan" class="form-control d-none" style="width: 100%">
                <option value="0" selected disabled>Pilih Nama Pelanggan</option>
                <option value="1">1</option>
                <option value="1">2</option>
                <option value="1">3</option>
              </select>
            </div>
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
              <label for="tahun" class="control-label" style="font-weight:bold">Tahun</label>
              <input type="number" class="form-control" name="tahun" id="tahun" placeholder="Tuliskan Tahun Mobil">
            </div>
            <div class="form-group col-md-12">
              <label for="harga" class="control-label" style="font-weight:bold">Harga Sewa</label>
              <input type="number" class="form-control" name="harga_weekdays" id="harga" placeholder="Tuliskan Harga Sewa Weekdays">
              <input type="number" class="form-control" name="harga_weekend" id="harga" placeholder="Tuliskan Harga Sewa Weekend">
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
    $(document).ready(function() {
      $('#web-title').html('HM Rent Car - Jadwal Sewa');
      $('#page-title').html('Jadwal Sewa');
      $('#btnjadwal').addClass('active');
    })

    function add(){
      $('#modaladd').modal('show');
      $('#formadd')[0].reset();
      $('.alert-danger').addClass('d-none');
    }

    $('.penyewa').on('click', function(){
      $value = $(this).val();
      if ($value == 'Lama'){
        $('#pelanggan').select2({
          theme: 'bootstrap-5'
        });
        $('#pelanggan').removeClass('d-none');
      } else if ($value == "Baru") {
        $('#pelanggan').hide();
      }
    })
  </script>
@endsection
<form action="#" id="form-button">
  @csrf
  <button type="button" data-id="{{ $data->id_mobil }}" class="btn btn-primary btn-sm edit" id="btnEdit{{ $data->id_mobil }}">
    <i class="bi bi-pencil-square"></i>
    
  </button>
  <button type="button" data-id="{{ $data->id_mobil }}" class="btn btn-danger btn-sm delete" id="btnDelete{{ $data->id_mobil }}">
    <i class="bi bi-trash"></i>
  </button>
</form>
@section('judul')
Detail Folder
@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop

@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 d-flex align-items-stretch grid-margin">
		<div class="row flex-grow">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">
							Detail Folder 
              @php 
              $h = $jumKb / 1024;
              @endphp
              @if ($h >= 20000)
                  Habis
              @else 
                  <a href="#" data-toggle="modal" data-target="#add" class="btn btn-primary btn-rounded btn-sm"> <i class="fa fa-plus"></i> Upload File</a>
              @endif
							<a href="{{ url('/') }}" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</h4>
            <div class="row">
              <div class="col-md-2">
                <p>Nama Folder</p>
                <p>Pembuat</p>
                <p>Tanggal Buat</p>
                <p>Tanggal Ubah</p>
              </div>
              <div class="col-md-6">
                <p>: <b>{{ $detail->nm_folder }}</b></p>
                <p>: <b>{{ $detail->name }}</b></p>
                <p>: <b>{{ $detail->created_at }}</b></p>
                <p>: <b>{{ $detail->updated_at }}</b></p>
              </div>
            </div>
						<hr>
						<div class="form-group">
							<div class="col-md-12">
								<div class="table table-responsive">
									<table class="table table-striped" id="table">
										<thead>
											<tr>
												<td>No.</td>
												<td>Nama File</td>
                        <td>Tanggal Buat</td>
												<td>Ukuran</td>
												<td>Opsi</td>
											</tr>
										</thead>
										<tbody>
											@php $no = 1; @endphp
											@foreach($dataFile as $data)
											<tr>
												<td>{{ $no++ }}</td>
												<td>{{ $data->nm_file }}</td>
                        <td>{{ $data->created_at }}</td>
												<td>{{ number_format($data->ukuran / 1024, 1) }} Kb</td>
												<td width="10%">
                          <a href="{{ url('file/' . $data->file . '/download') }}" class="btn btn-success">
                            <i class="fa fa-download"></i>
                          </a>
                           <a href="{{ url('file/' . $data->id_file . '/hapusFile') }}" class="btn btn-danger" onclick="return confirm('Yakin data akan dihapus?')">
                            <i class="fa fa-trash"></i>
                          </a>
                          {{-- <a href="{{ url('email/' . $data->id_file) }}" class="btn btn-info">
                            <i class="fa fa-share"></i>
                          </a> --}}
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Modal Upload --}}
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('file.upload') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('nm_file') ? ' has-error' : '' }}">
            <label>Nama File</label>
            <input type="text" class="form-control" name="nm_file">
            <input type="hidden" name="folder" class="form-control" value="{{$detail->id_folder}}" readonly="">
            @if ($errors->has('nm_file'))
            <span class="help-block">
              <strong>{{ $errors->first('nm_file') }}</strong>
            </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label>Ambil File</label>
            <input type="file" class="form-control" name="file[]" required="" multiple="true">
            @if ($errors->has('file'))
            <span class="help-block">
            	<strong>{{ $errors->first('file') }}</strong>
            </span>
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
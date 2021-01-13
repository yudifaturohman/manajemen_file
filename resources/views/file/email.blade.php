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
							Detail File 
							<a href="{{ route('file.index') }}" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</h4>
            <div class="row">
              <div class="col-md-2">
                <p>Nama Folder</p>
                <p>Nama File</p>
                <p>Nama Pembuat</p>
                <p>File</p>
                <p>Tanggal Buat</p>
                <p>Tanggal Ubah</p>
              </div>
              <div class="col-md-6">
                <p>: <b>{{ $file->nm_folder }}</b></p>
                <p>: <b>{{ $file->nm_file }}</b></p>
                <p>: <b>{{ $file->name }}</b></p>
                <p>: <b>{{ $file->file }}</b></p>
                <p>: <b>{{ $file->created_at }}</b></p>
                <p>: <b>{{ $file->updated_at }}</b></p>
              </div>
            </div>
						<hr>
						<div class="form-group">
							<div class="col-md-6">
								<form method="POST" action="{{ route('email.kirim', $file->id_file) }}">
                  {{ csrf_field() }}
                  <label>Alamat E-Mail</label>
                  <select name="to" class="form-control">
                    <option value=""></option>
                    @foreach($users as $u)
                    <option value="{{ $u->email }}">{{ $u->email }}</option>
                    @endforeach
                  </select>
                  <br>
                  <label></label>
                  <input type="text" name="isi" value="{{ $file->file }}" class="form-control">
                  <br>
                  <label>Pengirim</label>
                  <input type="text" name="from" value="{{ Auth::user()->email }}" class="form-control" readonly="">
                  <br>
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-send"></i> Kirim File
                  </button>
                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
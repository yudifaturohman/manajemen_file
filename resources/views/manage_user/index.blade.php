@section('judul')
	Management User
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('#table').DataTable({
			"iDisplayLength" : 50
		});
	})
</script>
@stop
@extends('layouts.app')

@section('content')

<div class="row" style="margin-top: 20px">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">
					Management User
				</h4>
				<div class="table table-responsive">
					<table class="table table-striped" id="table">
						<thead>
							<tr>
                <th>No</th>
								<th>Nama</th>
								<th>Username</th>
                <th>Level</th>
								<th width="10%">Opsi</th>
							</tr>
						</thead>
						<tbody>
              @php $no=1; @endphp
							@foreach($datas as $data)
							<tr>
                <td>{{ $no++ }}</td>
								<td>{{ $data->name }}</td>
								<td>{{ $data->username }}</td>
                <td>{{ $data->level }}</td>
								<td>
                  <a href="{{ route('manage_user.edit', $data->id) }}" class="btn btn-info">
                    <i class="fa fa-edit"></i> Ganti Password
                  </a>
                  <form action="{{ route('manage_user.destroy', $data->id) }}" class="pull-left" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button class="btn btn-danger" onclick="return confirm('Yakin data akan dihapus ?')">
                      <i class="fa fa-trash"></i> Hapus User
                    </button>
                  </form>
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

<!-- Modal Tambah Data -->
<div class="modal fade" id="tmb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST" action="{{ route('guru.store') }}">
      		{{ csrf_field() }}
      		<div class="form-group {{ $errors->has('nik') ? 'has-error' : '' }}">
      			<label>NIP</label>
      			<input type="number" name="nik" class="form-control" value="{{ old('nik') }}" required>
      			@if($errors->has('nik'))
      				<span class="help-block">
      					<strong>{{ $errors->first('nik') }}</strong>
      				</span>
      			@endif
      		</div>
      		<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
      			<label>Nama Lengkap</label>
      			<input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
      			@if ($errors->has('nama'))
      				<span class="help-block">
      					<strong>{{ $errors->first('nama') }}</strong>
      				</span>
      			@endif
      		</div>
      		<div class="form-group {{ $errors->has('tmp_lhr') ? 'has-error' : '' }}">
      			<label>Tempat Lahir</label>
      			<input type="text" name="tmp_lhr" class="form-control" value="{{ old('tmp_lhr') }}" required>
      			@if ($errors->has('tmp_lhr'))
      				<span class="help-block">
      					<strong>{{ $errors->first('tmp_lhr') }}</strong>
      				</span>
      			@endif
      		</div>
      		<div class="form-group {{ $errors->has('tgl_lhr') ? 'has-error' : '' }}">
      			<label>Tanggal Lahir</label>
      			<input type="date" name="tgl_lhr" class="form-control" value="{{ old('tgl_lhr') }}" required>
      			@if ($errors->has('tgl_lhr'))
      				<span class="help-block">
      					<strong>{{ $errors->first('tgl_lhr') }}</strong>
      				</span>
      			@endif
      		</div>
      		<div class="form-group {{ $errors->has('jk') ? 'has-error' : '' }}">
      			<label>Jenis Kelamin</label>
      			<select class="form-control" required name="jk">
      				<option value=""></option>
      				<option value="L">Laki-Laki</option>
      				<option value="P">Perempuan</option>
      			</select>
      		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
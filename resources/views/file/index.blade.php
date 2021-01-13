@section('judul')
	Data File
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
@if(Auth::user()->level == 'admin')
<div class="row">
	<div class="col-lg-2">
		<a href="#" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal" data-target="#tmb"><i class="fa fa-plus"></i>
			Buat Folder Baru
		</a>
	</div>
	<div class="col-lg-12">
		@if (Session::has('message'))
			<div class="alert alert-{{Session::get('message_type')}}" id="waktu2" style="margin-left: 10px; margin-bottom: 10px">
				{{ Session::get('message') }}
			</div>
		@endif
	</div>
</div>
@endif
<div class="row" style="margin-top: 20px">
	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">
					Data File
				</h4>
				<div class="table table-responsive">
					<table class="table table-striped" id="table">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th><i class="fa fa-folder"></i> Nama Folder</th>
                <th><i class="fa fa-user"></i> Pembuat</th>
                <th><i class="fa fa-calendar"></i> Dibuat</th>
								<th width="10%"></th>
							</tr>
						</thead>
						<tbody>
              @php $no = 1; @endphp
							@foreach($datas as $data)
							<tr>
								<td>{{ $no++ }}</td>
								<td> <a href="{{ route('file.show', $data->id_folder) }}">
                  <i class="fa fa-folder"></i> {{ $data->nm_folder }} </a>
                </td>
                <td><i class="fa fa-user"></i> {{ $data->name }}</td>
                <td>{{ $data->created_at->diffForHumans() }}</td>
								<td>
                  @if(Auth::user()->level == 'admin')
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opsi</button>
                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      {{-- <a class="dropdown-item" href="{{ route('file.edit', $data->id_folder) }}"> <i class="fa fa-edit"></i> Ubah Nama Folder </a> --}}
                      <form action="{{ route('file.destroy', $data->id_folder) }}" class="pull-left"  method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button class="dropdown-item" onclick="return confirm('Menghapus folder ini akan menghapus seluruh file di dalamnya')"> <i class="fa fa-trash"></i> Hapus
                        </button>
                      </form>
                    </div>
                  </div>
                  @endif
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Folder</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form method="POST" action="{{ route('file.store') }}">
      		{{ csrf_field() }}
      		<div class="form-group {{ $errors->has('nm_folder') ? 'has-error' : '' }}">
      			<label>Nama Folder</label>
      			<input type="text" name="nm_folder" class="form-control" value="{{ old('nm_folder') }}" required>
      			@if($errors->has('nm_folder'))
      				<span class="help-block">
      					<strong>{{ $errors->first('nm_folder') }}</strong>
      				</span>
      			@endif
      		</div>
      		<div class="form-group {{ $errors->has('id_user') ? 'has-error' : '' }}">
      			<label>Untuk User :</label>
      			<select class="form-control" required name="id_user">
      				<option value=""></option>
              @foreach($data_user as $u)
      				<option value="{{ $u->id }}">{{ $u->name }} - {{ $u->level }}</option>
              @endforeach
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
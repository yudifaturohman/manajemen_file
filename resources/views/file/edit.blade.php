@section('judul')
Ubah Nama Folder
@endsection

@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 d-flex align-items-stretch grid-margin">
		<div class="row flex-grow">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">
							Ubah Nama Folder
							<a href="{{ route('file.index') }}" class="btn btn-default">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</h4>
						<div class="form-group">
							<div class="col-md-6">
								<form method="POST" action="{{ route('file.update', $data->id_folder) }}">
                  {{ csrf_field() }}
                  {{ method_field('put') }}
                  <label>Nama Folder</label>
                  <input type="text" name="isi" value="{{ $data->nm_folder }}" class="form-control">
                  <br>
                  <button type="submit" class="btn btn-info">
                    <i class="fa fa-edit"></i> Ubah Nama
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
@section('judul')
	Edit Data User Guru
@endsection

@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12 d-flex align-items-stretch grid-margin">
		<div class="row flex-grow">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">
							Edit Data <b>{{ $data->name }}</b>
							<a href="{{ route('manage_user.index') }}" class="btn btn-info pull-right">Kembali</a>
						</h4>
						<form class="form-sample" method="POST" action="{{ route('manage_user.update', $data->id) }}">
							{{ csrf_field() }}
							{{ method_field('put') }}
							<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
									<input type="text" name="username" class="form-control" value="{{ $data->username }}" required readonly="">
									@if ($errors->has('username'))
										<span class="help-block">
											<strong>{{ $errors->first('username') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Nama Lengkap</label>
								<div class="col-md-6">
									<input type="text" name="name" class="form-control" value="{{ $data->name }}" required readonly="">
									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Masukan Password Baru</label>
								<div class="col-md-6">
									<input type="password" name="password" class="form-control" required>
									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<button type="submit" class="btn btn-success">
								<i class="fa fa-save"></i> Simpan Data
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
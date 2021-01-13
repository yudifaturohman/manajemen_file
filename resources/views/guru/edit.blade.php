@section('judul')
	Edit Data Guru
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
							Edit Data <b>{{ $detail->nama }}</b>
							<a href="{{ route('guru.index') }}" class="btn btn-info pull-right">Kembali</a>
						</h4>
						<form class="form-sample" method="POST" action="{{ route('guru.update', $detail->id_guru) }}">
							{{ csrf_field() }}
							{{ method_field('put') }}
							<div class="form-group {{ $errors->has('nik') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">NIP</label>
								<div class="col-md-6">
									<input type="text" name="nik" class="form-control" value="{{ $detail->nik }}" required readonly="">
									@if ($errors->has('nik'))
										<span class="help-block">
											<strong>{{ $errors->first('nik') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('nama') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Nama Lengkap</label>
								<div class="col-md-6">
									<input type="text" name="nama" class="form-control" value="{{ $detail->nama }}" required>
									@if ($errors->has('nama'))
										<span class="help-block">
											<strong>{{ $errors->first('nama') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('tmp_lhr') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Tempat Lahir</label>
								<div class="col-md-6">
									<input type="text" name="tmp_lhr" class="form-control" value="{{ $detail->tmp_lhr }}" required>
									@if ($errors->has('tmp_lhr'))
										<span class="help-block">
											<strong>{{ $errors->first('tmp_lhr') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('tgl_lhr') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Tanggal Lahir</label>
								<div class="col-md-6">
									<input type="text" name="tgl_lhr" class="form-control" value="{{ $detail->tgl_lhr }}" required>
									@if ($errors->has('tgl_lhr'))
										<span class="help-block">
											<strong>{{ $errors->first('tgl_lhr') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('jk') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Jenis Kelamin</label>
								<div class="col-md-6">
									<select class="form-control" name="jk" required>
										<option value=""></option>
										<option value="L" {{ $detail->jk === 'L' ? "selected" : ""}}>Laki-Laki</option>
										<option value="P" {{ $detail->jk === 'P' ? "selected" : ""}}>Perempuan</option>
									</select>
									@if ($errors->has('jk'))
										<span class="help-block">
											<strong>{{ $errors->first('jk') }}</strong>
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
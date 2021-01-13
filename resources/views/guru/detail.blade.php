@section('judul')
	Detail Data Guru
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
							Detail <b>{{ $detail->nama }}</b>
							<a href="{{ route('guru.index') }}" class="btn btn-info pull-right">Kembali</a>
						</h4>
						<form class="form-sample">
							{{-- <div class="form-group">
								<div class="col-md-6">
								<img class="product" width="200" height="200" @if($detail->user->foto) src="{{ asset('images/user/'.$detail->user->foto) }}" @endif/>	
								</div>
							</div> --}}
							<div class="form-group {{ $errors->has('nik') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">NIP</label>
								<div class="col-md-6">
									<input type="text" name="nik" class="form-control" value="{{ $detail->nik }}" readonly>
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
									<input type="text" name="nama" class="form-control" value="{{ $detail->nama }}" readonly>
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
									<input type="text" name="tmp_lhr" class="form-control" value="{{ $detail->tmp_lhr }}" readonly>
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
									<input type="text" name="tgl_lhr" class="form-control" value="{{ $detail->tgl_lhr }}" readonly>
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
									<input type="text" name="jk" class="form-control" value="@if ($detail->jk == 'L') Laki-Laki @else Perempuan @endif" readonly>
									@if ($errors->has('jk'))
										<span class="help-block">
											<strong>{{ $errors->first('jk') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
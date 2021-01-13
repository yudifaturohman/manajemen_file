@section('judul')
	Register Akun
@endsection
@section('js')

<script type="text/javascript">

var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('submit').disabled = false;
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('submit').disabled = true;
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
    </script>

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
							Register Akun <b>{{ $register->nama }}</b>
							<a href="{{ route('guru.index') }}" class="btn btn-info pull-right">Kembali</a>
						</h4>
						<form class="form-sample" method="POST" action="{{ route('guru.addUser') }}" enctype="multipart/form-data">
							{{ csrf_field() }}
							<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Username</label>
								<div class="col-md-6">
									<input type="text" name="username" class="form-control" value="{{ $register->nik }}" required readonly="">
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
									<input type="text" name="name" class="form-control" value="{{ $register->nama }}" required readonly="">
									@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">E-Mail</label>
								<div class="col-md-6">
									<input type="text" name="email" class="form-control" required>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password</label>
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" onkeyup='check();' name="password" required>
	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
                        	</div>
	                        <div class="form-group">
	                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
	                            <div class="col-md-6">
	                                <input id="confirm_password" type="password" onkeyup="check()" class="form-control" name="password_confirmation" required>
	                                <span id='message'></span>
	                            </div>
	                        </div>
							<div class="form-group {{ $errors->has('foto') ? 'has-error' : ''}}">
								<label class="col-md-4 control-label">Foto</label>
								<div class="col-md-6">
									<input type="file" name="foto" class="form-control" required>
									@if ($errors->has('foto'))
										<span class="help-block">
											<strong>{{ $errors->first('foto') }}</strong>
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
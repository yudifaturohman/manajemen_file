@section('judul')
    Dashboard
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
<div class="row" >
    @if(Auth::user()->level == 'admin')
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-account text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">
                            Data Guru
                        </p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                                {{$jumG }}
                            </h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true">
                    </i> Total Seluruh Guru
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-folder text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">
                            Data Folder
                        </p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                                {{ $jumF }}
                            </h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true">
                    </i> Total Seluruh Folder
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-file text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">
                            Data File
                        </p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                                {{ $jumFl }}
                            </h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true">
                    </i> Total Seluruh File
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-disk text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">
                            Penyimpanan
                        </p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                                {{ number_format($jumKbA / 1024, 1) }} Kb
                            </h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true">
                    </i> Total Penyimpanan Pengguna
                </p>
            </div>
        </div>
    </div>
    @endif
    @if(Auth::user()->level == 'guru')
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-left">
                        <i class="mdi mdi-disk text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                        <p class="mb-0 text-right">
                            Penyimpanan
                        </p>
                        <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">
                                @php 
                                    $h = $jumKb / 1024;
                                @endphp
                                @if ($h >= 20000)
                                    Habis
                                @else 
                                    {{ number_format($h,1) }} Kb
                                @endif
                            </h3>
                        </div>
                    </div>
                </div>
                <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true">
                    </i> Total Penyimpanan Hanya 20 MB
                </p>
            </div>
        </div>
    </div>
</div>
@endif
@if(Auth::user()->level == 'guru')
<div class="row" style="margin-top: 20px">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Data File 
                    @if ($h >= 20000)
                        Habis
                    @else 
                        <a href="#" class="btn btn-primary btn-rounded btn-fw" data-toggle="modal" data-target="#tmb"><i class="fa fa-plus"></i>
                            Buat Folder Baru
                        </a>
                    @endif
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
                                <td> <a href="{{ route('home.show', $data->id_folder) }}">
                  <i class="fa fa-folder"></i> {{ $data->nm_folder }} </a>
                </td>
                <td><i class="fa fa-user"></i> {{ $data->name }}</td>
                <td>{{ $data->created_at->diffForHumans() }}</td>
                                <td>
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
        <form method="POST" action="{{ route('home.store') }}">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('nm_folder') ? 'has-error' : '' }}">
                <label>Nama Folder</label>
                <input type="text" name="nm_folder" class="form-control" value="{{ old('nm_folder') }}" required>
                <input type="text" name="id_user" class="form-control" value="{{ Auth::user()->id }}" required>
                @if($errors->has('nm_folder'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nm_folder') }}</strong>
                    </span>
                @endif
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
@endif
@endsection

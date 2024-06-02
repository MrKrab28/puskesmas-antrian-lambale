@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian=gigi'" class="btn btn-primary text-white">POLI GIGI </button></h3>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">

                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $gigi->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian=umum'" class="btn btn-primary text-white">POLI UMUM </button></h3>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">

                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $umum->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian=kia'" class="btn btn-primary text-white">POLI KIA </button></h3>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">
                            {{-- <table id="table" class="table table-hover mt-5" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. Antrian</th>
                                        <th>Nama Lengkap</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>G12</td>
                                        <td>IMAM ASHARI</td>
                                        <th></th>
                                    </tr>
                                </tbody>
                            </table> --}}
                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $kia->count() }}</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- @foreach ( $antrian as $antrian )
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-primary">
                        <h3 class="text-light"><button onclick="document.location.href = '?jenis_antrian={{ $antrian->jenis_antrian }}'" class="btn btn-primary text-white">POLI GIGI </button></h3>
                    </div>
                    <div class="mb-3">
                        <div class="table-responsive">

                            <h3>Jumlah Antrian :</h3>
                            <h3 class="text-center">{{ $gigi->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}

    </div>
@endsection

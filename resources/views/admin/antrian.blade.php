@extends('admin.layout')

@section('content')
    <div class="row">
        @foreach ($data_antrian as $jenis_antrian => $jumlah_antrian)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="card-header  @if ($jenis_antrian == 'kia') bg-primary text-light
                                    @elseif ($jenis_antrian == 'umum')
                                   bg-success text-dark
                                    @elseif ($jenis_antrian = 'gigi')
                                    bg-danger @endif bg-primary rounded">
                            <h3 class="text-light text-center">

                                <button onclick="document.location.href = '?jenis_antrian={{ $jenis_antrian }}'"
                                    class="btn btn-@if ($jenis_antrian == 'kia') primary text-white @elseif($jenis_antrian == 'umum')success text-dark @elseif($jenis_antrian == 'gigi')danger text-white @endif">
                                    @if ($jenis_antrian == 'kia')
                                        <i class="ti ti-baby-carriage"></i>
                                    @elseif ($jenis_antrian == 'umum')
                                        <i class="ti ti-first-aid-kit"></i>
                                    @elseif ($jenis_antrian = 'gigi')
                                        <i class="ti ti-dental"></i>
                                    @endif
                                    POLI {{ strtoupper($jenis_antrian) }}
                                </button>
                            </h3>
                        </div>
                        <div class="mt-3">

                            <h3 class="text-center text-primary">Jumlah Antrian </h3>
                            <h3 class="text-center">{{ $jumlah_antrian->count() }}</h3>
                        </div>
                        <div class="mt-3 text-center">
                            @if (!$antrian_tutup[$jenis_antrian])
                                <form action="{{ route('admin.tutup-antrian', $jenis_antrian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Tutup Antrian
                                        {{ strtoupper($jenis_antrian) }}</button>
                                </form>
                            @else
                                <p class="text-danger font-weight-bold">Antrian {{ strtoupper($jenis_antrian) }} sedang
                                    ditutup</p>
                                <form action="{{ route('admin.buka-antrian', $jenis_antrian) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Buka Antrian
                                        {{ strtoupper($jenis_antrian) }}</button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

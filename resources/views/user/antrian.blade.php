@extends('user.layout')


@section('content')
    <section id="counts" class="counts">
        <div class="container">

            <div class="row">

                @foreach ($data_antrian as $jenis_antrian => $jumlah_antrian)
                    <div class="col-lg-4 col-md-6">
                        <div class="count-box">
                            <i class="fas fa-user-md"></i>
                            <span>{{ $jumlah_antrian->count() }}</span>
                            <h4>POLI {{ strtoupper($jenis_antrian) }} </h4>
                            <p>Kuota Nomor Antrian Tersisa 9</p>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
                    <div class="count-box">
                        <i class="far fa-hospital"></i>
                        <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <h4>POLI UMUM</h4>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
                    <div class="count-box">
                        <i class="fas fa-flask"></i>
                        <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <h4>POLI GIGI</h4>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
      <div class="count-box">
        <i class="fas fa-award"></i>
        <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
        <p>Awards</p>
      </div>
    </div> --}}

            </div>

        </div>
    </section>
    
@endsection

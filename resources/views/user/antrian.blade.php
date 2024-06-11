@extends('user.layout')


@section('content')
    <section id="counts" class="counts">
        <div class="container">
            <div class="section-title">
                <h2 style="color: #1977cc">Antrian Layanan</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>
            <div class="row">
                @php
                    $jenisAntrian = ['kia', 'umum', 'gigi'];

                @endphp
                @foreach ($jenisAntrian as $jenis )

                        <div class="col-lg-4 col-md-6">
                            <div class="count-box" style="border-radius: 20px">
                                @if($jenis == 'kia')
                                <i class="ti ti-baby-carriage"></i>
                                @elseif ($jenis == 'umum')
                                <i class="fa fa-user-md "></i>
                                @elseif ($jenis = 'gigi')
                                <i class="ti ti-dental"></i>
                                @endif
                                <span>{{ strtoupper(Str::substr($jenis, 0, 1)) }}-{{ $data_antrian[$jenis] }} </span>
                                <h4>POLI {{ strtoupper($jenis) }} </h4>
                                <p>Kuota Nomor Antrian Tersisa 9</p>
                                @auth('user')
                                    @if (!auth()->user()->antrian)
                                        <form action="{{ route('user-antrian.store', $jenis) }}" method="POST">
                                            @csrf
                                            <input type="text" value="{{ $jenis }}" name="jenis_antrian" hidden>
                                            <button class="btn btn-primary mt-2" type="submit">Ambil Antrian</button>
                                        </form>
                                    @endif
                                @endauth
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

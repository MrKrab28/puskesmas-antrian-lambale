<section id="services" class="services">
    <div class="container">

        <div class="row mt-0">
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="">
                    {{-- <div class="icon"><i class="fas fa-heartbeat"></i></div>
        <h4><a href="">POLI KIA</a></h4>
        <h5><a href="">Kesehatan Ibu dan Anak</a></h5>
        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p> --}}
                </div>
            </div>



            @php

                $antrian = auth()->user()->antrian()->whereIn('status', ['menunggu', 'dipanggil'])->whereDate('created_at', Carbon\Carbon::today())->first();


            @endphp

            @if ($antrian)
                {{-- @foreach ($antrian as $antrianUser) --}}
                <div class="col-lg-4 col-md-6 align-item-center align-items-stretch mb-3 mt-0 mt-lg-0 rounded">
                    <div class="icon-box" style="border-radius: 25px">
                        <div class="icon">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <h4 class="fs-6"><a class="" href="">NOMOR ANTRIAN ANDA</a></h4>
                        <div class="me-3 ms-3">
                            <h4 class="fs-1"><a
                                    href="">{{ strtoupper(Str::substr($antrian->jenis_antrian, 0, 1)) }}-{{ $antrian->no_antrian }}</a>
                            </h4>

                        </div>
                        <h4 class="title"><a href="">POLI {{ strtoupper($antrian->jenis_antrian) }}</a>
                        </h4>
                    </div>
                </div>
                <div style="font-size: 15px;text-align:center" class="mb-0">
                    @if ($antrian->created_at != $antrian->updated_at)
                    <div class="alert alert-info">
                        <p class="m-0"> Antrian Anda Dipercepat Dikarenakan Ada Antrian Yang Telah Dilewati </p>
                    </div>
                    @endif

                    <h6>Catatan :</h6> <span style="font-size: 15px;text-align:center">*Nomor Antrian Anda Diperkirakan
                        Akan
                        Dipanggil Pada Pukul <b>
                            {{ Carbon\Carbon::parse($antrian->batas_waktu)->subMinutes(10)->isoFormat('HH:mm')  }}</b>
                        WITA</span><br>
                    <span style="">Mohon Untuk Berada Di Puskesmas 30 Menit Sebelum Waktu
                        Pemanggilan Antrian Anda </span>
                </div>
                {{-- @endforeach --}}
            @endif

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="">
                    {{-- <div class="icon"><i class="fas fa-notes-medical"></i></div>
        <h4><a href="">POLI GIGI</a></h4>
        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p> --}}
                </div>
            </div>

        </div>

    </div>
</section>


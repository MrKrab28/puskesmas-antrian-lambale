@extends('admin.layout')


@section('content')
    <div class="container-fluid content-inner mt-5">
       <div class="row">
        <div class="col-sm-12">
            <h2 class="text text-primary text-center fs-8 fw-bolder">ANTRIAN</h2>
            <h1 class="text-center mb-5 fw-bolder">PUSKESMAS LAMBALE</h1>
        </div>
       </div>
        <div class="row">

            <div class="col-sm-3">
                <div class="card bg bg-danger py-4 rounded-3">
                    {{-- @foreach ($data_antrian as $antrian ) --}}



                        <div class="card-body">

                            <h3 class="fs-6 fw-bolder text-light my-0 text-center">Jumlah Antrian </h3>
                            <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">
                            <h3 class="fs-8 text-light mb-0 text-center">
                               {{ $antrian->count() }}
                            </h3>
                        </div>
                        {{-- @endforeach --}}

                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-warning py-4 rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-light text-center">Antrian Menunggu</h3>
                        <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">

                        <h3 class="fs-8 text-light mb-0 text-center"> {{ $antrian->where('status', 'menunggu')->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-primary py-4 rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-light text-center">Antrian Dipanggil</h3>
                        <hr style="color: white;border:3px solid white;border-widht:100%" class="my-1">


                            <h3 class="fs-8 text-light mb-0 text-center">
                                {{ $antrian->where('status', 'dipanggil')->count() }}
                            </h3>

                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card bg-success py-4 rounded-3">
                    <div class="card-body">
                        <h3 class="fs-6 fw-bolder text-dark text-center">Antrian Selesai</h3>
                        <hr style="color: white;border:3px solid black;border-widht:100%" class="my-1">

                        <h3 class="fs-8 text-dark mb-0 text-center"> {{ $antrian->where('status', 'selesai')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('styles')
    @include('includes.choices-js.styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush

@push('scripts')
    @include('includes.choices-js.scripts')


@endpush

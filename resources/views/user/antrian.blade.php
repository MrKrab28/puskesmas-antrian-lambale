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
                @foreach ($jenisAntrian as $jenis)
                    <div class="col-lg-4 col-md-6 mt-5">
                        <div class="count-box" style="border-radius: 20px">
                            @if ($jenis == 'kia')
                                <i class="ti ti-baby-carriage"></i>
                            @elseif ($jenis == 'umum')
                                <i class="fa fa-user-md "></i>
                            @elseif ($jenis = 'gigi')
                                <i class="ti ti-dental"></i>
                            @endif
                            <span
                                id="nomor-antrian-{{ $jenis }}">{{ strtoupper(Str::substr($jenis, 0, 1)) }}-{{ $data_antrian[$jenis] }}
                            </span>
                            <h4>POLI {{ strtoupper($jenis) }} </h4>
                            <p id="kuota-antrian-{{ $jenis }}">Kuota Nomor Antrian Tersisa {{ $kuota[$jenis] }}</p>
                            <div id="antrian-action-{{ $jenis }}">
                                @auth('user')
                                    @if (!auth()->user()->antrian && $kuota[$jenis] > 0)
                                        <form action="{{ route('user-antrian.store', $jenis) }}" method="POST">
                                            @csrf
                                            <input type="text" value="{{ $jenis }}" name="jenis_antrian" hidden>
                                            <button class="btn btn-primary mt-2" type="submit">Ambil Antrian</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <p id="antrian-closed-{{ $jenis }}"
                                style="display: none; color: red; font-weight: bold;">
                                Antrian sedang ditutup
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Pusher.logToConsole = true;
                var pusher = new Pusher('31a00261f5424be7ca0c', {
                    cluster: 'ap1'
                });
                var channel = pusher.subscribe('antrian');
                channel.bind('antrian-update', function(data) {
                    if (data && data.jenis_antrian && data.no_antrian && data.kuota !== undefined) {
                        // var jenisAntrian = data.jenis_antrian;
                        // var nomorElement = document.getElementById(`nomor-antrian-${jenisAntrian}`);
                        // var kuotaElement = document.getElementById(`kuota-antrian-${jenisAntrian}`);

                        // if (nomorElement && data.no_antrian) {
                        //     nomorElement.textContent = `${data.jenis_antrian.charAt(0).toUpperCase()}-${data.no_antrian}`;
                        // }

                        // if (kuotaElement && data.kuota !== undefined) {
                        //     kuotaElement.textContent = `Kuota Nomor Antrian Tersisa ${data.kuota}`;
                        // }

                        var jenisAntrianElement = document.getElementById('nomor-antrian-' + data.jenis_antrian);
                        if (jenisAntrianElement) {
                            // jenisAntrianElement.textContent = data.no_antrian;
                            jenisAntrianElement.innerHTML =
                                `<span id="nomor-antrian-${data.jenis_antrian}" style="color: #1977cc">${data.jenis_antrian.charAt(0).toUpperCase()}-${data.no_antrian}</span>`;
                        }

                        var kuotaElement = document.getElementById('kuota-antrian-${data.jenis_antrian}');
                        if (kuotaElement) {
                            kuotaElement.textContent = `Kuota Nomor Antrian Tersisa ${data.kuota}`;
                        }
                        updateAntrianUI(data);

                    } else {
                        console.error('Invalid data structure received:', data);
                    }

                    // function updateAntrianUI(data) {
                    //     var element = document.getElementById('nomor-antrian-' + data.jenis_antrian);
                    //     if (element) {
                    //         element.textContent = data.jenis_antrian.charAt(0).toUpperCase() + '-' + data
                    //             .no_antrian;
                    //     }
                    //     var jenisAntrian = data.jenis_antrian;
                    //     var actionElement = document.getElementById(`antrian-action-${jenisAntrian}`);
                    //     var closedElement = document.getElementById(`antrian-closed-${jenisAntrian}`);
                    //     var kuotaElement = document.getElementById(`kuota-antrian-${jenisAntrian}`);

                    //     if (data.isClosed) {
                    //         // Kode untuk menutup antrian
                    //         if (actionElement) actionElement.style.display = 'none';
                    //         if (closedElement) closedElement.style.display = 'block';
                    //         if (kuotaElement) kuotaElement.textContent = '(Mohon Maaf, Antrian Sudah Ditutup)';
                    //     } else {
                    //         // Kode untuk membuka antrian
                    //         if (actionElement) actionElement.style.display = 'block';
                    //         if (closedElement) closedElement.style.display = 'none';
                    //         if (kuotaElement) kuotaElement.textContent =
                    //             `Kuota Nomor Antrian Tersisa ${data.kuota || '-'}`;
                    //     }
                    //     Update elemen UI lainnya sesuai kebutuhan
                    // }

                    if (data.jenis_antrian) {
                        var jenisAntrian = data.jenis_antrian;
                        var actionElement = document.getElementById(`antrian-action-${jenisAntrian}`);
                        var closedElement = document.getElementById(`antrian-closed-${jenisAntrian}`);
                        var kuotaElement = document.getElementById(`kuota-antrian-${jenisAntrian}`);

                        if (data.isClosed) {
                            // Kode untuk menutup antrian
                            if (actionElement) actionElement.style.display = 'none';
                            if (closedElement) closedElement.style.display = 'block';
                            if (kuotaElement) kuotaElement.textContent = 'Antrian Sudah Ditutup';
                        } else {
                            // Kode untuk membuka antrian
                            if (actionElement) actionElement.style.display = 'block';
                            if (closedElement) closedElement.style.display = 'none';
                            if (kuotaElement) kuotaElement.textContent =
                                `Kuota Nomor Antrian Tersisa ${data.kuota || '-'}`;
                        }
                    }





                    function updateAntrianUI(data) {
                        var jenisAntrian = data.jenis_antrian;
                        var nomorElement = document.getElementById(`nomor-antrian-${jenisAntrian}`);
                        var kuotaElement = document.getElementById(`kuota-antrian-${jenisAntrian}`);
                        var actionElement = document.getElementById(`antrian-action-${jenisAntrian}`);
                        var closedElement = document.getElementById(`antrian-closed-${jenisAntrian}`);

                        if (nomorElement && data.no_antrian) {
                            nomorElement.innerHTML =
                                `<span style="color: #1977cc">${jenisAntrian.charAt(0).toUpperCase()}-${data.no_antrian}</span>`;
                        }

                        if (kuotaElement && data.kuota !== undefined) {
                            kuotaElement.textContent = `Kuota Nomor Antrian Tersisa ${data.kuota}`;
                        }

                        if (data.isClosed !== undefined) {
                            if (actionElement) actionElement.style.display = data.isClosed ? 'none' : 'block';
                            if (closedElement) closedElement.style.display = data.isClosed ? 'block' : 'none';
                            if (kuotaElement && data.isClosed) kuotaElement.textContent =
                                'Antrian Sudah Ditutup';
                        }
                    }
                });
            });
        </script>
        @php
            $closedAntrian = [];
            foreach ($jenisAntrian as $jenis) {
                if (Cache::get('antrian_' . $jenis . '_tutup')) {
                    $closedAntrian[] = $jenis;
                }
            }
        @endphp
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var closedAntrian = @json($closedAntrian);
                closedAntrian.forEach(function(jenis) {
                    var actionElement = document.getElementById(`antrian-action-${jenis}`);
                    var closedElement = document.getElementById(`antrian-closed-${jenis}`);
                    var kuotaElement = document.getElementById(`kuota-antrian-${jenis}`);

                    if (actionElement) {
                        actionElement.style.display = 'none';
                    }

                    if (closedElement) {
                        closedElement.style.display = 'block';
                    }

                    if (kuotaElement) {
                        kuotaElement.textContent = '-';
                    }
                });
            });
        </script>
    </section>

    </script>
@endsection
@push('styles')
    @include('includes.styles')
@endpush
@push('scripts')
    @include('includes.choices-js.scripts')
    @include('includes.scripts')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        function deleteData(id) {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data Ini Akan Terhapus Dari Database",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formDelete' + id).submit()
                }
            });
        }
    </script>
    @if (Session::has('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('success') }}",
                icon: "success"
            });
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ Session::get('info') }}",
                icon: "info"
            });
        </script>
    @endif
@endpush
{{-- @section('scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('antrian');
        channel.bind('antrian.updated', function(data) {
            // Periksa apakah antrian yang diperbarui adalah milik pengguna saat ini
            @if (auth()->check() && auth()->user()->antrian)
                if (data.id === {{ auth()->user()->antrian->id }}) {
                    // Perbarui tampilan nomor antrian
                    document.getElementById('nomor-antrian').textContent = data.no_antrian;
                }
            @endif
        });
    </script>
@endsection --}}

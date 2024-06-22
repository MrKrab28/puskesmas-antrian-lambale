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

        @php
            $closedAntrian = [];
            foreach ($jenisAntrian as $jenis) {
                if (Cache::get('antrian_' . $jenis . '_tutup')) {
                    $closedAntrian[] = $jenis;
                }
            }
        @endphp
    </section>
@endsection
@push('styles')
    @include('includes.styles')
@endpush
@push('scripts')
    @include('includes.choices-js.scripts')
    @include('includes.scripts')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
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

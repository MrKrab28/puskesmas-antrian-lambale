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

            @php
                $jenisAntrian = ['kia', 'umum', 'gigi'];
            @endphp

            @livewire('data-antrian-layanan', ['jenisAntrian' => $jenisAntrian])
        </div>
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

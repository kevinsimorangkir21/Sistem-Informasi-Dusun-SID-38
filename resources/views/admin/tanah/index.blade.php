@extends('layouts.theme.backend.master')
@section('title')
    Data Tanah Terkini
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">@yield('title')</h5>
                <div class="card-body">
                    <form action="" class="row">
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label">Cari Nomor</label>
                            <input type="text" placeholder="nomor rumah" name="nomor" class="form-control">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="form-label">Cari Pemilik</label>
                            <input type="text" placeholder="pemilik" name="pemilik" class="form-control">
                        </div>
                        <div class="mb-3 col-md-4">
                            <button type="submit" class="btn btn-primary mt-4">Cari</button>
                            <a href="{{ route('admin.tanah.index') }}" class="btn btn-danger mt-4">Reset</a>
                            <a href="{{ route('admin.tanah.export') }}" class="btn btn-outline-info mt-4">Export Excel</a>
                        </div>
                    </form>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor</th>
                                    <th>Pemilik Terbaru</th>
                                    <th>Pemilik Sebelumnya</th>
                                    <th>Objek Tanah</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomor }}</td>
                                        <td>
                                            <strong>{{ $item->nama_terbaru }}</strong>
                                        </td>
                                        <td>
                                            <strong>{{ $item->nama_sebelumnya ?? '-' }}</strong>
                                        </td>
                                        <td>
                                            Luas Bangunan : {{ $item->luas_bangunan }} m<sup>2</sup>
                                            <br>
                                            Luas Tanah : {{ $item->luas_tanah }} m<sup>2</sup>
                                            <br>
                                        </td>
                                        <td class="d-flex">
                                            <a href="{{ route('admin.tanah.edit', $item->id) }}"
                                                class="btn btn-icon btn-outline-primary">
                                                <span class="tf-icons bx bx-edit"></span>
                                            </a>

                                            <form method="POST" action="{{ route('admin.tanah.destroy', $item->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger deleteBtn ms-2"><i
                                                        class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data Not Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-primary justify-content-center">
                                    {!! $data->links() !!}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.deleteBtn').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah kamu ingin menghapus data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

@extends('layouts.theme.backend.master')
@section('title')
    Struktur Desa
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Tabel Data Struktur Dusun</h5>
                        <a href="{{ route('admin.struktur.create') }}" class="btn btn-primary btn-sm">Tambah Baru</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Foto</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" class="avatar avatar-xs pull-up" title=""
                                                    data-bs-original-title="{{ $item->name }}">
                                                    <img src="{{ url('storage/image/' . $item->image) }}" alt="Avatar"
                                                        class="rounded-circle">
                                                </li>
                                            </ul>
                                        </td>
                                        <td><strong>{{ $item->name }}</strong>
                                        </td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-outline-info me-3"
                                                    href="{{ route('admin.struktur.edit', $item->id) }}"><i
                                                        class="bx bx-edit-alt me-2"></i> Edit</a>
                                                <form method="POST"
                                                    action="{{ route('admin.struktur.destroy', $item->id) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-outline-danger deleteBtn"><i
                                                            class="bx bx-trash me-2"></i> Delete</button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
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
                title: 'Anda yakin?',
                text: "Apakah kamu ingin menghapus data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

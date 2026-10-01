<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bahan Pembersih</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                Laundry Management
            </span>
        </div>
    </nav>

    <div class="container py-5">

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1">Data Bahan Pembersih</h2>
                        <p class="text-muted mb-0">
                            Kelola stok bahan pembersih laundry
                        </p>
                    </div>

                    <a href="/bahan-pembersih/create" class="btn btn-primary">
                        + Tambah Bahan
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Merek</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($bahanPembersih as $index => $bahan)

                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $bahan->nama_bahan }}
                                    </td>

                                    <td>
                                        {{ $bahan->merek ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $bahan->stok }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $bahan->satuan }}
                                    </td>

                                    <td>

                                        <form
                                            action="/bahan-pembersih/{{ $bahan->id }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus bahan ini?')"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center py-5">

                                        <div class="text-muted">

                                            <h5>Belum ada data</h5>

                                            <p class="mb-3">
                                                Belum ada bahan pembersih yang ditambahkan.
                                            </p>

                                            <a
                                                href="/bahan-pembersih/create"
                                                class="btn btn-primary"
                                            >
                                                + Tambah Bahan
                                            </a>

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
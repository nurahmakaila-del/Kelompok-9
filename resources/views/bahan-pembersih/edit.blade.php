<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Bahan Pembersih</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #FAFAF7;
        }

        .navbar {
            background-color: #2F5D50;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .btn-primary {
            background-color: #2F5D50;
            border-color: #2F5D50;
        }

        .btn-primary:hover {
            background-color: #24483e;
            border-color: #24483e;
        }

        .card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/bahan-pembersih') }}">
            Sistem Operasional Laundry
        </a>
    </div>
</nav>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="fw-bold mb-4">
                        Edit Bahan Pembersih
                    </h3>

                    <form
                        action="{{ route('bahan-pembersih.update', $bahanPembersih->id) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_bahan" class="form-label">
                                Nama Bahan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="nama_bahan"
                                name="nama_bahan"
                                value="{{ old('nama_bahan', $bahanPembersih->nama_bahan) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="merek" class="form-label">
                                Merek
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="merek"
                                name="merek"
                                value="{{ old('merek', $bahanPembersih->merek) }}"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="stok" class="form-label">
                                Stok
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="stok"
                                name="stok"
                                min="0"
                                value="{{ old('stok', $bahanPembersih->stok) }}"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="satuan" class="form-label">
                                Satuan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="satuan"
                                name="satuan"
                                value="{{ old('satuan', $bahanPembersih->satuan) }}"
                                required
                            >
                        </div>

                        <div class="d-flex gap-2">
                            <a
                                href="{{ route('bahan-pembersih.index') }}"
                                class="btn btn-secondary"
                            >
                                Batal
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
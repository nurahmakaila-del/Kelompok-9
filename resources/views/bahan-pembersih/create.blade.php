<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Bahan Pembersih</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm">

        <div class="container">

            <a href="/bahan-pembersih"
                class="navbar-brand">
                Laundry Management
            </a>

        </div>

    </nav>


    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-7 col-lg-6">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        <h2 class="mb-1">
                            Tambah Bahan Pembersih
                        </h2>

                        <p class="text-muted mb-4">
                            Masukkan informasi bahan pembersih baru.
                        </p>


                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <strong>
                                    Ada kesalahan:
                                </strong>

                                <ul class="mb-0 mt-2">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            action="/bahan-pembersih"
                            method="POST"
                        >

                            @csrf


                            <div class="mb-3">

                                <label
                                    for="nama_bahan"
                                    class="form-label"
                                >
                                    Nama Bahan
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama_bahan"
                                    name="nama_bahan"
                                    value="{{ old('nama_bahan') }}"
                                    placeholder="Contoh: Deterjen"
                                    required
                                >

                            </div>


                            <div class="mb-3">

                                <label
                                    for="merek"
                                    class="form-label"
                                >
                                    Merek
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="merek"
                                    name="merek"
                                    value="{{ old('merek') }}"
                                    placeholder="Contoh: Rinso"
                                >

                            </div>


                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label
                                        for="stok"
                                        class="form-label"
                                    >
                                        Stok
                                    </label>

                                    <input
                                        type="number"
                                        class="form-control"
                                        id="stok"
                                        name="stok"
                                        value="{{ old('stok') }}"
                                        min="0"
                                        placeholder="0"
                                        required
                                    >

                                </div>


                                <div class="col-md-6 mb-3">

                                    <label
                                        for="satuan"
                                        class="form-label"
                                    >
                                        Satuan
                                    </label>

                                    <select
                                        class="form-select"
                                        id="satuan"
                                        name="satuan"
                                        required
                                    >

                                        <option value="">
                                            Pilih satuan
                                        </option>

                                        <option value="kg">
                                            Kilogram (kg)
                                        </option>

                                        <option value="liter">
                                            Liter
                                        </option>

                                        <option value="pcs">
                                            Pcs
                                        </option>

                                        <option value="botol">
                                            Botol
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="d-flex gap-2 mt-3">

                                <a
                                    href="/bahan-pembersih"
                                    class="btn btn-secondary"
                                >
                                    Kembali
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Simpan Bahan
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
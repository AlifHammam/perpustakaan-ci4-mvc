<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2 class="mb-4"><?= esc($title) ?></h2>

                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="/buku/update/<?= $buku['id'] ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control"
                                   value="<?= old('isbn', $buku['isbn']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control"
                                   value="<?= old('judul', $buku['judul']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" name="penulis" class="form-control"
                                   value="<?= old('penulis', $buku['penulis']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" name="tahun" class="form-control"
                                   value="<?= old('tahun', $buku['tahun']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control"
                                   value="<?= old('stok', $buku['stok']) ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/buku" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>

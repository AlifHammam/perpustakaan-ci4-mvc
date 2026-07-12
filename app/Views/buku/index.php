<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><?= esc($title) ?></h2>
        <a href="/buku/tambah" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    <?php if (session()->getFlashdata('sukses')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('sukses') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('gagal')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('gagal') ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ISBN</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($buku)) : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data buku.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($buku as $b) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($b['isbn']) ?></td>
                                <td><?= esc($b['judul']) ?></td>
                                <td><?= esc($b['penulis']) ?></td>
                                <td><?= esc($b['tahun']) ?></td>
                                <td>
                                    <?php if ($b['stok'] <= 0) : ?>
                                        <span class="badge bg-danger">Habis</span>
                                    <?php else : ?>
                                        <span class="badge bg-success"><?= esc($b['stok']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end">
                                    <a href="/buku/edit/<?= $b['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="/buku/hapus/<?= $b['id'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin ingin menghapus buku ini?');">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>

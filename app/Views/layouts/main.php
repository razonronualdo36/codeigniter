<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title><?= esc($title ?? 'POS Manager') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="<?= site_url('/') ?>"><span>R</span> Razon POS</a>
            <nav aria-label="Primary navigation"><a href="<?= site_url('/') ?>">Dashboard</a><a href="<?= site_url('customers') ?>">Customers</a><a href="<?= site_url('users') ?>">Users</a></nav>
        </div>
    </header>
    <main class="container main-content">
        <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success" role="status"><?= esc(session()->getFlashdata('success')) ?></div><?php endif ?>
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="site-footer"><div class="container">Razon POS Account Management &middot; TFA3</div></footer>
</body>
</html>

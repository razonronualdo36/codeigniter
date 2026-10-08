<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="form-page login-page">
    <div class="page-heading compact">
        <div>
            <span class="eyebrow">Staff access</span>
            <h1>Log in</h1>
            <p>Use your POS user account to manage customers and users.</p>
        </div>
    </div>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors !== []): ?>
        <div class="alert alert-error" role="alert">
            <strong>Please correct the following:</strong>
            <ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul>
        </div>
    <?php endif ?>

    <form class="form-card" method="post" action="<?= site_url('login') ?>">
        <?= csrf_field() ?>
        <div class="field">
            <label for="username">Username <span>*</span></label>
            <input id="username" name="username" type="text" maxlength="50" autocomplete="username" required value="<?= esc(old('username')) ?>">
        </div>
        <div class="field">
            <label for="password">Password <span>*</span></label>
            <input id="password" name="password" type="password" maxlength="72" autocomplete="current-password" required>
        </div>
        <div class="form-actions">
            <button class="button button-primary" type="submit">Log in</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

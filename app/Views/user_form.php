<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="form-page">
    <div class="page-heading compact"><div><span class="eyebrow">User account</span><h1><?= esc($title) ?></h1><p>Fields marked with an asterisk are required.</p></div></div>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors !== []): ?><div class="alert alert-error" role="alert"><strong>Please correct the following:</strong><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
    <form class="form-card" action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?php if ($user !== null): ?>
            <?php $avatarUrl = ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode($user['avatar'])) : base_url('assets/avatar-placeholder.svg'); ?>
            <div class="profile-preview"><img src="<?= esc($avatarUrl) ?>" alt="Current avatar"><div><strong>Current profile picture</strong><small>A new upload will replace this image.</small></div></div>
        <?php endif ?>
        <div class="field"><label for="username">Username <span>*</span></label><input id="username" name="username" type="text" maxlength="50" required value="<?= old('username', $user['username'] ?? '') ?>"><small>Usernames must be unique.</small></div>
        <div class="field"><label for="full_name">Full name <span>*</span></label><input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= old('full_name', $user['full_name'] ?? '') ?>"></div>
        <div class="field"><label for="password">Password <?= $user === null ? '<span>*</span>' : '' ?></label><input id="password" name="password" type="password" minlength="8" maxlength="72" autocomplete="new-password" <?= $user === null ? 'required' : '' ?>><small><?= $user === null ? 'Use at least 8 characters.' : 'Leave blank to keep the current password.' ?></small></div>
        <?php if ($user !== null): ?><div class="field"><label for="avatar">Profile picture</label><input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png"><small>JPG or PNG only, maximum 2 MB. The image will be cropped to a 256 &times; 256 thumbnail.</small></div><?php endif ?>
        <div class="form-actions"><a class="button button-ghost" href="<?= site_url('users') ?>">Cancel</a><button class="button button-primary" type="submit">Save user</button></div>
    </form>
</div>
<?= $this->endSection() ?>

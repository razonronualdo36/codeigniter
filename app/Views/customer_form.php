<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="form-page">
    <div class="page-heading compact"><div><span class="eyebrow">Customer account</span><h1><?= esc($title) ?></h1><p>Fields marked with an asterisk are required.</p></div></div>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors !== []): ?><div class="alert alert-error" role="alert"><strong>Please correct the following:</strong><ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach ?></ul></div><?php endif ?>
    <form class="form-card" action="<?= esc($action) ?>" method="post">
        <?= csrf_field() ?>
        <div class="field"><label for="full_name">Full name <span>*</span></label><input id="full_name" name="full_name" type="text" maxlength="100" required value="<?= old('full_name', $customer['full_name'] ?? '') ?>"></div>
        <div class="field"><label for="email">Email address <span>*</span></label><input id="email" name="email" type="email" maxlength="100" required value="<?= old('email', $customer['email'] ?? '') ?>"></div>
        <div class="field"><label for="phone">Phone number</label><input id="phone" name="phone" type="tel" maxlength="20" value="<?= old('phone', $customer['phone'] ?? '') ?>"></div>
        <div class="form-actions"><a class="button button-ghost" href="<?= site_url('customers') ?>">Cancel</a><button class="button button-primary" type="submit">Save customer</button></div>
    </form>
</div>
<?= $this->endSection() ?>

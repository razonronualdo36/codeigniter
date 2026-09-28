<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<section class="hero">
    <div>
        <span class="eyebrow">Account management</span>
        <h1>POS Control Center</h1>
        <p>Manage customer information and staff user accounts from one clean dashboard.</p>
        <div class="hero-actions">
            <a class="button button-primary" href="<?= site_url('customers/new') ?>">Add customer</a>
            <a class="button button-secondary" href="<?= site_url('users/new') ?>">Add user</a>
        </div>
    </div>
    <div class="hero-mark" aria-hidden="true">POS</div>
</section>

<section class="stats-grid" aria-label="Account totals">
    <article class="stat-card stat-card-customer">
        <div class="stat-icon">C</div>
        <div>
            <span class="stat-label">Customers</span>
            <strong><?= esc($customerCount) ?></strong>
            <a href="<?= site_url('customers') ?>">View customer accounts &rarr;</a>
        </div>
    </article>

    <article class="stat-card stat-card-user">
        <div class="stat-icon">U</div>
        <div>
            <span class="stat-label">Users</span>
            <strong><?= esc($userCount) ?></strong>
            <a href="<?= site_url('users') ?>">View user accounts &rarr;</a>
        </div>
    </article>
</section>

<section class="quick-actions">
    <div class="section-heading">
        <div><span class="eyebrow">Quick access</span><h2>Common tasks</h2></div>
    </div>
    <div class="action-grid">
        <a class="action-card" href="<?= site_url('customers/new') ?>"><span>01</span><strong>Register a customer</strong><small>Create a new customer account with validated contact details.</small></a>
        <a class="action-card" href="<?= site_url('users/new') ?>"><span>02</span><strong>Create a user</strong><small>Add a staff account with a unique username.</small></a>
        <a class="action-card" href="<?= site_url('users') ?>"><span>03</span><strong>Manage profile photos</strong><small>Open a user account to upload or replace its avatar.</small></a>
    </div>
</section>
<?= $this->endSection() ?>

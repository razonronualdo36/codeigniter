<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div><span class="eyebrow">Team access</span><h1>User Accounts</h1><p>Manage staff identities and profile pictures.</p></div>
    <a class="button button-primary" href="<?= site_url('users/new') ?>">+ New user</a>
</div>

<div class="table-card"><div class="table-scroll"><table>
    <thead><tr><th>User</th><th>Username</th><th>Created</th><th><span class="sr-only">Actions</span></th></tr></thead>
    <tbody>
        <?php if ($users === []): ?><tr><td colspan="4" class="empty-state">No user accounts found.</td></tr><?php endif ?>
        <?php foreach ($users as $user): ?>
            <?php $avatarUrl = ! empty($user['avatar']) ? base_url('uploads/avatars/' . rawurlencode($user['avatar'])) : base_url('assets/avatar-placeholder.svg'); ?>
            <tr>
                <td><div class="user-cell"><img class="avatar" src="<?= esc($avatarUrl) ?>" alt="<?= esc($user['full_name']) ?> avatar"><div><strong><?= esc($user['full_name']) ?></strong><small>#<?= esc($user['id']) ?></small></div></div></td>
                <td><span class="username">@<?= esc($user['username']) ?></span></td>
                <td class="muted"><?= esc(date('M j, Y', strtotime($user['created_at']))) ?></td>
                <td class="table-action"><a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table></div></div>
<?= $this->endSection() ?>

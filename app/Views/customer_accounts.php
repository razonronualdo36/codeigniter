<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-heading">
    <div><span class="eyebrow">Directory</span><h1>Customer Accounts</h1><p>Review and update customer contact information.</p></div>
    <a class="button button-primary" href="<?= site_url('customers/new') ?>">+ New customer</a>
</div>

<div class="table-card"><div class="table-scroll"><table>
    <thead><tr><th>ID</th><th>Full name</th><th>Email</th><th>Phone</th><th>Created</th><th><span class="sr-only">Actions</span></th></tr></thead>
    <tbody>
        <?php if ($customers === []): ?><tr><td colspan="6" class="empty-state">No customer accounts found.</td></tr><?php endif ?>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td class="muted">#<?= esc($customer['id']) ?></td>
                <td><strong><?= esc($customer['full_name']) ?></strong></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone'] ?: '—') ?></td>
                <td class="muted"><?= esc(date('M j, Y', strtotime($customer['created_at']))) ?></td>
                <td class="table-action"><a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table></div></div>
<?= $this->endSection() ?>

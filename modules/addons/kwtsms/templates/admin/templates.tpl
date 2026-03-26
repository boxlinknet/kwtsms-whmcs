<?php
declare(strict_types=1);
use KwtSMS\WHMCS\GatewayManager;

// Load current template settings for Phase 1 events
$events = [
    'client_registration' => [
        'label'       => 'Client Registration',
        'description' => 'Sent to a new client when their account is created in WHMCS.',
        'placeholders'=> ['{firstname}', '{fullname}'],
    ],
    'invoice_paid' => [
        'label'       => 'Invoice Paid',
        'description' => 'Sent to a client when an invoice is marked as paid.',
        'placeholders'=> ['{firstname}', '{fullname}', '{invoiceid}', '{invoiceamount}', '{invoiceduedate}'],
    ],
    'admin_new_order' => [
        'label'       => 'New Order (Admin Alert)',
        'description' => 'Sent to admin phones when a new order is placed via shopping cart.',
        'placeholders'=> ['{orderid}', '{fullname}', '{firstname}'],
    ],
];

$tplData = [];
foreach ($events as $key => $meta) {
    $tplData[$key] = [
        'enabled' => GatewayManager::get('evt_' . $key),
        'content' => GatewayManager::get('tpl_' . $key),
    ];
}
?>
<?php include __DIR__ . '/_style.php'; ?>
<div class="kwt-wrap">
<?php include __DIR__ . '/_nav.php'; ?>

<div class="kwt-alert kwt-alert-info">
    <strong>Phase 1 Templates.</strong> These templates cover the three Phase 1 events. Additional event templates will be available in a future update.
</div>

<div class="kwt-card">
    <div class="kwt-card-title">SMS Templates</div>
    <p style="font-size:13px;color:#666;margin:0 0 20px">
        Customize the SMS text for each event. Use <code style="background:#f0f0f0;padding:2px 5px;border-radius:3px;font-size:12px">{placeholders}</code> to insert dynamic values.
        Messages are billed per page: 160 chars (English) or 70 chars (Arabic).
    </p>

    <?php foreach ($events as $key => $meta): ?>
    <?php $d = $tplData[$key]; ?>
    <div class="kwt-tpl-event" id="kwt-tpl-<?= $key ?>">
        <div class="kwt-tpl-event-header">
            <div>
                <div class="kwt-tpl-event-title"><?= htmlspecialchars($meta['label']) ?></div>
                <div class="kwt-tpl-event-desc"><?= htmlspecialchars($meta['description']) ?></div>
            </div>
            <label class="kwt-switch" title="Enable or disable this event">
                <input type="checkbox" class="kwt-tpl-toggle" data-event="<?= $key ?>" <?= ($d['enabled'] ?? '1') !== '0' ? 'checked' : '' ?>>
                <span class="kwt-slider"></span>
            </label>
        </div>
        <textarea class="kwt-tpl-textarea" id="kwt-tpl-content-<?= $key ?>" rows="3"
            placeholder="Enter SMS template text..."><?= htmlspecialchars($d['content'] ?? '') ?></textarea>
        <div class="kwt-char-count">
            <span id="kwt-tpl-chars-<?= $key ?>">0</span> chars
            &nbsp;|&nbsp; Placeholders:
            <?php foreach ($meta['placeholders'] as $ph): ?>
                <code class="kwt-ph"><?= htmlspecialchars($ph) ?></code>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

    <div class="kwt-actions-row" style="margin-top:20px">
        <button class="btn-kwt" onclick="kwtSaveTemplates()">Save All Templates</button>
        <button class="btn-kwt-muted" onclick="kwtResetTemplates()" title="Restore default template text for all events">Reset to Defaults</button>
    </div>
    <div id="kwt-tpl-msg" class="kwt-msg"></div>
</div>

<!-- Placeholder Reference -->
<div class="kwt-card">
    <div class="kwt-card-title">Placeholder Reference</div>
    <table class="kwt-ph-table">
        <thead>
            <tr>
                <th>Placeholder</th>
                <th>Description</th>
                <th>Events</th>
            </tr>
        </thead>
        <tbody>
            <tr><td><code class="kwt-ph">{firstname}</code></td><td>Client first name</td><td>All client events</td></tr>
            <tr><td><code class="kwt-ph">{fullname}</code></td><td>Client full name (first + last)</td><td>All events</td></tr>
            <tr><td><code class="kwt-ph">{invoiceid}</code></td><td>Invoice number</td><td>Invoice Paid</td></tr>
            <tr><td><code class="kwt-ph">{invoiceamount}</code></td><td>Invoice total with currency symbol</td><td>Invoice Paid</td></tr>
            <tr><td><code class="kwt-ph">{invoiceduedate}</code></td><td>Invoice due date</td><td>Invoice Paid</td></tr>
            <tr><td><code class="kwt-ph">{orderid}</code></td><td>Order ID</td><td>New Order (Admin)</td></tr>
        </tbody>
    </table>
</div>

</div>

<script>
(function(){
const kwtML    = <?= json_encode($modulelink) ?>;
const kwtToken = <?= json_encode($whmcs_token) ?>;
const kwtAjax  = kwtML + '&ajax=gateway_action';

// Char count live updates
const events = <?= json_encode(array_keys($events)) ?>;
events.forEach(function(evt) {
    const ta = document.getElementById('kwt-tpl-content-' + evt);
    const ct = document.getElementById('kwt-tpl-chars-' + evt);
    if (ta && ct) {
        const update = () => { ct.textContent = ta.value.length; };
        ta.addEventListener('input', update);
        update();
    }
});

function showMsg(msg, type) {
    const el = document.getElementById('kwt-tpl-msg');
    el.style.display = 'block';
    el.className = 'kwt-msg kwt-alert-' + type;
    el.textContent = msg;
}

window.kwtSaveTemplates = async function() {
    const payload = {action: 'save_templates'};
    events.forEach(function(evt) {
        const toggle  = document.querySelector('.kwt-tpl-toggle[data-event="' + evt + '"]');
        const content = document.getElementById('kwt-tpl-content-' + evt);
        if (toggle)  payload['evt_' + evt] = toggle.checked ? '1' : '0';
        if (content) payload['tpl_' + evt] = content.value;
    });
    const fd = new FormData();
    fd.append('token', kwtToken);
    for (const [k, v] of Object.entries(payload)) fd.append(k, v);
    try {
        const r = await fetch(kwtAjax, {method: 'POST', body: fd});
        const d = await r.json();
        showMsg(d.success ? 'Templates saved.' : (d.error || 'Save failed.'), d.success ? 'success' : 'danger');
    } catch(e) {
        showMsg('Request failed.', 'danger');
    }
};

window.kwtResetTemplates = async function() {
    if (!confirm('Reset all templates to their default text? Your customizations will be lost.')) return;
    // Reload page - defaults are seeded in activate(); if content is empty they show defaults
    // A future iteration can add a dedicated reset endpoint
    showMsg('To reset, deactivate and reactivate the module from Setup > Addon Modules.', 'info');
};
})();
</script>

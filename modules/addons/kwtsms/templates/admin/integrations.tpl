<?php declare(strict_types=1); ?>
<?php include __DIR__ . '/_style.php'; ?>
<div class="kwt-wrap">
<?php include __DIR__ . '/_nav.php'; ?>

<div class="kwt-card">
    <div class="kwt-card-title">Admin Notifications</div>
    <p style="font-size:13px;color:#666;margin:0 0 20px">
        Configure which WHMCS events trigger SMS alerts to your admin phone numbers.
        Admin phone numbers are set in the <a href="<?= htmlspecialchars($modulelink) ?>&tab=settings" style="color:#FFA200">Settings tab</a>.
    </p>

    <!-- Phase 1: New Order -->
    <div class="kwt-integration-item">
        <div class="kwt-integration-info">
            <h4>New Order Placed</h4>
            <p>Alert when a new order is submitted via the WHMCS shopping cart (AfterShoppingCartCheckout).</p>
        </div>
        <label class="kwt-switch">
            <input type="checkbox" id="kwt-admin-evt-order" <?= ($admin_evt_new_order ?? '') === '1' ? 'checked' : '' ?>>
            <span class="kwt-slider"></span>
        </label>
    </div>

    <!-- Phase 2 stubs (display only) -->
    <div class="kwt-integration-item kwt-coming-soon">
        <div class="kwt-integration-info">
            <h4>New Support Ticket <span class="kwt-badge kwt-badge-phase2">Phase 2</span></h4>
            <p>Alert when a client opens a new support ticket.</p>
        </div>
        <label class="kwt-switch"><input type="checkbox" disabled><span class="kwt-slider"></span></label>
    </div>

    <div class="kwt-integration-item kwt-coming-soon">
        <div class="kwt-integration-info">
            <h4>Ticket Reply from Client <span class="kwt-badge kwt-badge-phase2">Phase 2</span></h4>
            <p>Alert when a client replies to a support ticket.</p>
        </div>
        <label class="kwt-switch"><input type="checkbox" disabled><span class="kwt-slider"></span></label>
    </div>

    <div class="kwt-integration-item kwt-coming-soon">
        <div class="kwt-integration-info">
            <h4>Invoice Paid <span class="kwt-badge kwt-badge-phase2">Phase 2</span></h4>
            <p>Alert when any client pays an invoice.</p>
        </div>
        <label class="kwt-switch"><input type="checkbox" disabled><span class="kwt-slider"></span></label>
    </div>

    <div class="kwt-integration-item kwt-coming-soon">
        <div class="kwt-integration-info">
            <h4>Cancellation Request <span class="kwt-badge kwt-badge-phase2">Phase 2</span></h4>
            <p>Alert when a client submits a cancellation request.</p>
        </div>
        <label class="kwt-switch"><input type="checkbox" disabled><span class="kwt-slider"></span></label>
    </div>

    <div class="kwt-integration-item kwt-coming-soon">
        <div class="kwt-integration-info">
            <h4>Admin Login <span class="kwt-badge kwt-badge-phase2">Phase 2</span></h4>
            <p>Alert when an admin account logs in to WHMCS.</p>
        </div>
        <label class="kwt-switch"><input type="checkbox" disabled><span class="kwt-slider"></span></label>
    </div>

    <div style="margin-top:20px">
        <button class="btn-kwt" onclick="kwtSaveIntegrations()">Save</button>
        <div id="kwt-int-msg" class="kwt-msg"></div>
    </div>
</div>

<!-- Client Notifications (Phase 2 preview) -->
<div class="kwt-card">
    <div class="kwt-card-title">Client Notifications <span class="kwt-badge kwt-badge-phase2" style="vertical-align:middle">Phase 2</span></div>
    <p style="font-size:13px;color:#888;margin:0 0 14px">Coming in the next version: per-event toggle for all client-facing SMS notifications.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:8px">
    <?php
    $phase2ClientEvents = [
        'Client Registration', 'Client Login', 'Invoice Created', 'Invoice Paid',
        'Invoice Reminder', 'Invoice Overdue', 'Ticket Admin Reply', 'Ticket Status Change',
        'Service Created', 'Service Suspended', 'Service Terminated', 'Service Unsuspended',
        'Domain Registration', 'Domain Renewal', 'Domain Transfer', 'Cancellation Request', 'Birthday SMS',
    ];
    foreach ($phase2ClientEvents as $evtName):
    ?>
    <div style="padding:8px 12px;background:#f8f8f8;border-radius:4px;font-size:12px;color:#888;display:flex;align-items:center;gap:8px">
        <span style="width:8px;height:8px;background:#ddd;border-radius:50%;display:inline-block"></span>
        <?= htmlspecialchars($evtName) ?>
    </div>
    <?php endforeach; ?>
    </div>
</div>

</div>

<script>
(function(){
const kwtML    = <?= json_encode($modulelink) ?>;
const kwtToken = <?= json_encode($whmcs_token) ?>;
const kwtAjax  = kwtML + '&ajax=gateway_action';

function showMsg(msg, type) {
    const el = document.getElementById('kwt-int-msg');
    el.style.display = 'block';
    el.className = 'kwt-msg kwt-alert-' + type;
    el.textContent = msg;
}

window.kwtSaveIntegrations = async function() {
    const fd = new FormData();
    fd.append('token', kwtToken);
    fd.append('action', 'save_settings');
    fd.append('admin_evt_admin_new_order', document.getElementById('kwt-admin-evt-order').checked ? '1' : '0');
    try {
        const r = await fetch(kwtAjax, {method: 'POST', body: fd});
        const d = await r.json();
        showMsg(d.success ? 'Settings saved.' : (d.error || 'Save failed.'), d.success ? 'success' : 'danger');
    } catch(e) {
        showMsg('Request failed.', 'danger');
    }
};
})();
</script>

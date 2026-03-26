<div class="kwt-tabbar">
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=dashboard" class="<?= $tab === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=settings"  class="<?= $tab === 'settings'  ? 'active' : '' ?>">Settings</a>
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=templates" class="<?= $tab === 'templates' ? 'active' : '' ?>">Templates</a>
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=integrations" class="<?= $tab === 'integrations' ? 'active' : '' ?>">Integrations</a>
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=logs"      class="<?= $tab === 'logs'      ? 'active' : '' ?>">SMS Logs</a>
    <a href="<?= htmlspecialchars($modulelink) ?>&tab=help"      class="<?= $tab === 'help'      ? 'active' : '' ?>">Help</a>
</div>

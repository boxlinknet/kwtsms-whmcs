<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
<style>
.kwt-wrap{font-family:'Lato',sans-serif;color:#434345;padding:0 0 40px}
.kwt-tabbar{display:flex;flex-wrap:wrap;border-bottom:3px solid #FFA200;margin-bottom:24px}
.kwt-tabbar a{display:inline-block;padding:9px 18px;font-family:'Montserrat',sans-serif;font-weight:700;font-size:11px;text-transform:uppercase;letter-spacing:.6px;color:#434345;text-decoration:none;border-radius:4px 4px 0 0;transition:background .15s,color .15s}
.kwt-tabbar a:hover{background:#fff3e0;color:#FFA200;text-decoration:none}
.kwt-tabbar a.active{background:#FFA200;color:#fff}
.kwt-card{background:#fff;border:1px solid #e8e8e8;border-radius:4px;padding:24px;margin-bottom:20px;box-shadow:0 1px 3px rgba(0,0,0,.05)}
.kwt-card-title{font-family:'Montserrat',sans-serif;font-weight:700;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:#FFA200;margin:0 0 18px;padding-bottom:10px;border-bottom:1px solid #f0f0f0}
.kwt-stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:20px}
.kwt-stat{background:#fff;border:1px solid #e8e8e8;border-radius:4px;padding:18px 20px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.04)}
.kwt-stat-label{font-size:10px;text-transform:uppercase;letter-spacing:.7px;color:#888;margin-bottom:8px;font-family:'Montserrat',sans-serif;font-weight:700}
.kwt-stat-value{font-size:20px;font-weight:700;color:#434345;line-height:1.2}
.kwt-badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.3px}
.kwt-badge-on{background:#27ae60;color:#fff}
.kwt-badge-off{background:#e74c3c;color:#fff}
.kwt-badge-test{background:#79CCF2;color:#fff}
.kwt-badge-warn{background:#f39c12;color:#fff}
.kwt-badge-phase2{background:#ddd;color:#888;font-size:10px}
.btn-kwt{background:#FFA200;border:none;color:#fff;padding:8px 20px;border-radius:4px;font-family:'Montserrat',sans-serif;font-weight:700;font-size:12px;cursor:pointer;letter-spacing:.3px;transition:background .2s;display:inline-block;text-decoration:none}
.btn-kwt:hover{background:#e69100;color:#fff;text-decoration:none}
.btn-kwt:disabled{background:#ffd580;cursor:not-allowed}
.btn-kwt-outline{background:#fff;border:1.5px solid #FFA200;color:#FFA200;padding:7px 18px;border-radius:4px;font-family:'Montserrat',sans-serif;font-weight:700;font-size:12px;cursor:pointer;letter-spacing:.3px;transition:all .2s;display:inline-block;text-decoration:none}
.btn-kwt-outline:hover{background:#FFA200;color:#fff;text-decoration:none}
.btn-kwt-danger{background:#e74c3c;border:none;color:#fff;padding:8px 18px;border-radius:4px;font-size:12px;cursor:pointer;font-family:'Montserrat',sans-serif;font-weight:700;transition:background .2s}
.btn-kwt-danger:hover{background:#c0392b}
.btn-kwt-muted{background:#f5f5f5;border:1px solid #ddd;color:#434345;padding:8px 18px;border-radius:4px;font-size:12px;cursor:pointer;transition:all .2s;font-family:'Lato',sans-serif}
.btn-kwt-muted:hover{border-color:#FFA200;color:#FFA200}
.kwt-form-group{margin-bottom:16px}
.kwt-form-group label{display:block;font-size:12px;font-weight:700;color:#434345;margin-bottom:6px;font-family:'Montserrat',sans-serif;letter-spacing:.2px}
.kwt-form-group input[type=text],.kwt-form-group input[type=password],.kwt-form-group textarea,.kwt-form-group select{width:100%;max-width:420px;padding:8px 12px;border:1px solid #ddd;border-radius:4px;font-size:13px;color:#434345;font-family:'Lato',sans-serif;transition:border .2s;box-sizing:border-box}
.kwt-form-group input:focus,.kwt-form-group textarea:focus,.kwt-form-group select:focus{border-color:#FFA200;outline:none;box-shadow:0 0 0 3px rgba(255,162,0,.12)}
.kwt-form-group textarea{min-height:80px;resize:vertical}
.kwt-form-group .kwt-notice{color:#888;font-size:12px;margin-top:4px}
.kwt-toggle-row{display:flex;align-items:center;gap:12px;padding:10px 0}
.kwt-toggle-row .kwt-toggle-info h4{margin:0 0 2px;font-size:13px;font-weight:700;font-family:'Montserrat',sans-serif}
.kwt-toggle-row .kwt-toggle-info p{margin:0;font-size:12px;color:#888}
.kwt-switch{position:relative;display:inline-block;width:44px;height:24px;flex-shrink:0}
.kwt-switch input{opacity:0;width:0;height:0}
.kwt-slider{position:absolute;cursor:pointer;inset:0;background:#ccc;border-radius:24px;transition:.3s}
.kwt-slider:before{content:'';position:absolute;width:18px;height:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.3s}
.kwt-switch input:checked+.kwt-slider{background:#FFA200}
.kwt-switch input:checked+.kwt-slider:before{transform:translateX(20px)}
.kwt-table{width:100%;border-collapse:collapse;font-size:13px}
.kwt-table th{background:#f8f8f8;padding:10px 12px;text-align:left;font-family:'Montserrat',sans-serif;font-size:11px;text-transform:uppercase;letter-spacing:.4px;color:#888;border-bottom:2px solid #eee;font-weight:700;white-space:nowrap}
.kwt-table td{padding:10px 12px;border-bottom:1px solid #f0f0f0;color:#434345;vertical-align:middle}
.kwt-table tr:last-child td{border-bottom:none}
.kwt-table tr:hover td{background:#fafafa}
.kwt-result-ok{color:#27ae60;font-weight:700}
.kwt-result-err{color:#e74c3c;font-weight:700}
.kwt-alert{padding:12px 16px;border-radius:4px;margin-bottom:20px;font-size:13px;line-height:1.5}
.kwt-alert-info{background:#fff8e1;border-left:4px solid #FFA200;color:#7a5c00}
.kwt-alert-success{background:#d4edda;border-left:4px solid #27ae60;color:#155724}
.kwt-alert-danger{background:#f8d7da;border-left:4px solid #e74c3c;color:#721c24}
.kwt-msg{display:none;padding:10px 14px;border-radius:4px;font-size:13px;margin-top:12px}
.kwt-actions-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
.kwt-separator{border:none;border-top:1px solid #f0f0f0;margin:20px 0}
.kwt-subtabs{display:flex;gap:0;border-bottom:1px solid #eee;margin-bottom:20px}
.kwt-subtabs a{padding:8px 16px;font-size:11px;font-family:'Montserrat',sans-serif;font-weight:700;text-transform:uppercase;letter-spacing:.4px;color:#888;text-decoration:none;border-bottom:3px solid transparent;margin-bottom:-1px;transition:all .2s}
.kwt-subtabs a:hover{color:#FFA200;text-decoration:none}
.kwt-subtabs a.active{color:#FFA200;border-bottom-color:#FFA200}
.kwt-pagination{display:flex;gap:6px;align-items:center;margin-top:16px;flex-wrap:wrap}
.kwt-pagination a,.kwt-pagination span{padding:5px 10px;border:1px solid #ddd;border-radius:4px;font-size:12px;color:#434345;text-decoration:none;transition:all .2s}
.kwt-pagination a:hover{border-color:#FFA200;color:#FFA200;text-decoration:none}
.kwt-pagination span.current{background:#FFA200;border-color:#FFA200;color:#fff}
.kwt-ph-table{width:100%;border-collapse:collapse;font-size:13px}
.kwt-ph-table th{background:#fff3e0;padding:8px 12px;text-align:left;font-family:'Montserrat',sans-serif;font-size:11px;text-transform:uppercase;color:#FFA200;border-bottom:1px solid #ffe0b2;font-weight:700}
.kwt-ph-table td{padding:8px 12px;border-bottom:1px solid #f5f5f5}
code.kwt-ph{background:#fff3e0;color:#e08000;padding:2px 6px;border-radius:3px;font-family:monospace;font-size:12px}
.kwt-setup-step{display:flex;gap:14px;align-items:flex-start;padding:14px 0;border-bottom:1px solid #f5f5f5}
.kwt-setup-step:last-child{border-bottom:none}
.kwt-step-num{min-width:28px;width:28px;height:28px;background:#FFA200;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Montserrat',sans-serif;font-weight:700;font-size:13px}
.kwt-step-content h4{margin:0 0 4px;font-family:'Montserrat',sans-serif;font-size:13px;font-weight:700;color:#434345}
.kwt-step-content p{margin:0;font-size:13px;color:#666;line-height:1.5}
.kwt-integration-item{display:flex;align-items:center;justify-content:space-between;padding:14px 0;border-bottom:1px solid #f5f5f5;gap:16px}
.kwt-integration-item:last-child{border-bottom:none}
.kwt-integration-info h4{margin:0 0 3px;font-size:13px;font-weight:700;font-family:'Montserrat',sans-serif}
.kwt-integration-info p{margin:0;font-size:12px;color:#888}
.kwt-coming-soon{opacity:.45}
.kwt-tpl-event{padding:20px;border:1px solid #e8e8e8;border-radius:4px;margin-bottom:16px}
.kwt-tpl-event-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;gap:12px}
.kwt-tpl-event-title{font-family:'Montserrat',sans-serif;font-weight:700;font-size:13px;color:#434345}
.kwt-tpl-event-desc{font-size:12px;color:#888;margin-top:2px}
.kwt-tpl-textarea{width:100%;padding:10px 12px;border:1px solid #ddd;border-radius:4px;font-size:13px;font-family:'Lato',sans-serif;resize:vertical;min-height:90px;box-sizing:border-box;transition:border .2s}
.kwt-tpl-textarea:focus{border-color:#FFA200;outline:none;box-shadow:0 0 0 3px rgba(255,162,0,.12)}
.kwt-char-count{font-size:11px;color:#aaa;text-align:right;margin-top:4px}
.kwt-row{display:flex;gap:20px;flex-wrap:wrap}
.kwt-col{flex:1;min-width:220px}
@media(max-width:640px){.kwt-stat-grid{grid-template-columns:1fr 1fr}.kwt-tabbar a{padding:8px 12px;font-size:10px}}
</style>

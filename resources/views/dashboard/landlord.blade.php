<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledger — Landlord Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landlord.css') }}">
</head>

<body>

    <div class="app">
        <div class="backdrop-sidebar" id="backdrop"></div>

        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-mark">L</div>
                <div>
                    <div class="brand-name">Ledger</div>
                    <div class="brand-sub">Landlord Console</div>
                </div>
            </div>

            <div class="property-switch">
                <label>Property</label>
                <select id="propertySelect">
                    <option>Casa Marbella Apartments</option>
                    <option>Sampaguita Duplex (2 units)</option>
                </select>
            </div>

            <nav class="navlinks">
                <button class="navlink active" data-view="overview">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M3 11L12 4l9 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        <path d="M5 10v9a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9" stroke="currentColor"
                            stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    Overview
                </button>
                <button class="navlink" data-view="tenants">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <circle cx="9" cy="8" r="3.2" stroke="currentColor" stroke-width="2" />
                        <path d="M3.5 19c.5-3.5 3-5.5 5.5-5.5s5 2 5.5 5.5" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                        <circle cx="17" cy="9" r="2.4" stroke="currentColor" stroke-width="1.8" />
                        <path d="M15.5 19c.2-2.4 1.7-3.9 3.5-4" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    Units &amp; Tenants
                </button>
                <button class="navlink" data-view="ledger">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor"
                            stroke-width="2" />
                        <path d="M8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" />
                    </svg>
                    Rent Ledger
                    <span class="badge" id="overdueBadge">2</span>
                </button>
                <button class="navlink" data-view="maintenance">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M14.7 6.3a3 3 0 1 0-4.2 4.2L4 17v3h3l6.5-6.5a3 3 0 1 0 4.2-4.2l-2 2-2-1-1-2 2-2z"
                            stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                    </svg>
                    Maintenance
                    <span class="badge" id="maintBadge">3</span>
                </button>
                <button class="navlink" data-view="notices">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none">
                        <path d="M4 5h16v11H9l-5 4V5z" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                    Notices
                </button>
            </nav>

            <div class="sidebar-foot">
                <div class="owner-chip">
                    <div class="owner-avatar">R</div>
                    <div>
                        <div class="owner-name">Raineil</div>
                        <div class="owner-role">Property Owner</div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="main">
            <div class="topbar">
                <div>
                    <div class="eyebrow" id="viewEyebrow">Casa Marbella Apartments</div>
                    <h1 id="viewTitle">Overview</h1>
                </div>
                <div class="topbar-actions" id="topbarActions"></div>
                <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M4 6h16M4 12h16M4 18h16" stroke="#22303F" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <!-- OVERVIEW -->
            <div class="view active" id="view-overview">
                <div class="stats-grid" id="statsGrid"></div>

                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>This month's ledger</h2>
                            <div class="sub">Rent due on the 5th of every month</div>
                        </div>
                        <select class="month-select" id="monthSelect">
                            <option>August 2026</option>
                            <option>September 2026</option>
                        </select>
                    </div>
                    <div class="ledger-list" id="overviewLedger"></div>
                </section>

                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Open maintenance requests</h2>
                        </div>
                        <button class="btn btn-ghost btn-sm" data-goto="maintenance">View all</button>
                    </div>
                    <div id="overviewMaint"></div>
                </section>
            </div>

            <!-- TENANTS -->
            <div class="view" id="view-tenants">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Units &amp; Tenants</h2>
                            <div class="sub" id="occupancySub"></div>
                        </div>
                        <input class="search-input" id="tenantSearch" placeholder="Search unit or tenant name…">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Unit</th>
                                <th>Tenant</th>
                                <th>Rent</th>
                                <th>Lease ends</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tenantsBody"></tbody>
                    </table>
                </section>
            </div>

            <!-- LEDGER -->
            <div class="view" id="view-ledger">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Rent Ledger — August 2026</h2>
                            <div class="sub">Tap a receipt to mark it paid</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="recordPaymentBtn">+ Record payment</button>
                    </div>
                    <div class="ledger-list" id="fullLedger"></div>
                </section>
            </div>

            <!-- MAINTENANCE -->
            <div class="view" id="view-maintenance">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Maintenance requests</h2>
                            <div class="sub">Drag between columns as work progresses</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newRequestBtn">+ New request</button>
                    </div>
                    <div class="kanban" id="kanbanBoard"></div>
                </section>
            </div>

            <!-- NOTICES -->
            <div class="view" id="view-notices">
                <section class="panel">
                    <div class="panel-head">
                        <div>
                            <h2>Notices</h2>
                            <div class="sub">Reminders and lease notices you've sent tenants</div>
                        </div>
                        <button class="btn btn-primary btn-sm" id="newNoticeBtn">+ Draft notice</button>
                    </div>
                    <div id="noticesList"></div>
                </section>
            </div>

        </main>
    </div>

    <!-- Payment modal -->
    <div class="modal-overlay" id="paymentModal">
        <div class="modal">
            <h3>Record a payment</h3>
            <div class="modal-sub">Log rent received from a tenant.</div>
            <div class="field">
                <label>Tenant / Unit</label>
                <select id="pmTenant"></select>
            </div>
            <div class="field">
                <label>Amount received (₱)</label>
                <input type="number" id="pmAmount" placeholder="e.g. 12000">
            </div>
            <div class="field">
                <label>Date received</label>
                <input type="date" id="pmDate">
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="paymentModal">Cancel</button>
                <button class="btn btn-primary" id="pmSave">Save payment</button>
            </div>
        </div>
    </div>

    <!-- Maintenance modal -->
    <div class="modal-overlay" id="maintModal">
        <div class="modal">
            <h3>New maintenance request</h3>
            <div class="modal-sub">Log an issue reported by a tenant, or one you've spotted.</div>
            <div class="field">
                <label>Unit</label>
                <select id="mmUnit"></select>
            </div>
            <div class="field">
                <label>What's the issue?</label>
                <textarea id="mmDesc" placeholder="e.g. Kitchen faucet leaking"></textarea>
            </div>
            <div class="field">
                <label>Priority</label>
                <select id="mmPriority">
                    <option value="low">Low</option>
                    <option value="med" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="maintModal">Cancel</button>
                <button class="btn btn-primary" id="mmSave">Add request</button>
            </div>
        </div>
    </div>

    <!-- Notice modal -->
    <div class="modal-overlay" id="noticeModal">
        <div class="modal">
            <h3>Draft a notice</h3>
            <div class="modal-sub">Send a reminder or lease notice to a tenant.</div>
            <div class="field">
                <label>Send to</label>
                <select id="ntTenant"></select>
            </div>
            <div class="field">
                <label>Subject</label>
                <input type="text" id="ntSubject" placeholder="e.g. Rent reminder — due Sept 5">
            </div>
            <div class="field">
                <label>Message</label>
                <textarea id="ntMessage" placeholder="Write your note to the tenant…"></textarea>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" data-close="noticeModal">Cancel</button>
                <button class="btn btn-primary" id="ntSave">Save notice</button>
            </div>
        </div>
    </div>

    <div class="toast" id="toast"></div>

    <script>
        (function() {

            // ---------- Data ----------
            let units = [{
                    id: 'A1',
                    tenant: 'Marisol Dela Peña',
                    rent: 12000,
                    leaseEnds: '2027-01-31',
                    status: 'paid',
                    avatar: 'M'
                },
                {
                    id: 'A2',
                    tenant: 'Jun Torralba',
                    rent: 11000,
                    leaseEnds: '2026-12-15',
                    status: 'paid',
                    avatar: 'J'
                },
                {
                    id: 'A3',
                    tenant: 'Ella Ramoso',
                    rent: 12500,
                    leaseEnds: '2026-09-30',
                    status: 'due',
                    avatar: 'E'
                },
                {
                    id: 'B1',
                    tenant: 'Carlo Nieves',
                    rent: 10500,
                    leaseEnds: '2027-03-01',
                    status: 'overdue',
                    avatar: 'C'
                },
                {
                    id: 'B2',
                    tenant: 'Fatima Uy',
                    rent: 13000,
                    leaseEnds: '2026-11-20',
                    status: 'paid',
                    avatar: 'F'
                },
                {
                    id: 'B3',
                    tenant: null,
                    rent: 11500,
                    leaseEnds: null,
                    status: 'vacant',
                    avatar: ''
                },
                {
                    id: 'C1',
                    tenant: 'Renz Ababon',
                    rent: 12000,
                    leaseEnds: '2027-05-10',
                    status: 'overdue',
                    avatar: 'R'
                },
            ];

            let payments = [{
                    unit: 'A1',
                    tenant: 'Marisol Dela Peña',
                    amount: 12000,
                    date: '2026-08-03',
                    status: 'paid'
                },
                {
                    unit: 'A2',
                    tenant: 'Jun Torralba',
                    amount: 11000,
                    date: '2026-08-04',
                    status: 'paid'
                },
                {
                    unit: 'B2',
                    tenant: 'Fatima Uy',
                    amount: 13000,
                    date: '2026-08-02',
                    status: 'paid'
                },
                {
                    unit: 'A3',
                    tenant: 'Ella Ramoso',
                    amount: 12500,
                    date: null,
                    status: 'due'
                },
                {
                    unit: 'B1',
                    tenant: 'Carlo Nieves',
                    amount: 10500,
                    date: null,
                    status: 'overdue'
                },
                {
                    unit: 'C1',
                    tenant: 'Renz Ababon',
                    amount: 12000,
                    date: null,
                    status: 'overdue'
                },
            ];

            let maintenance = [{
                    id: 1,
                    unit: 'B1',
                    desc: 'Kitchen faucet leaking steadily',
                    priority: 'high',
                    col: 'new'
                },
                {
                    id: 2,
                    unit: 'A3',
                    desc: 'Aircon not cooling in bedroom',
                    priority: 'med',
                    col: 'new'
                },
                {
                    id: 3,
                    unit: 'C1',
                    desc: 'Front gate lock is stiff',
                    priority: 'low',
                    col: 'progress'
                },
                {
                    id: 4,
                    unit: 'A2',
                    desc: 'Replace hallway light bulb',
                    priority: 'low',
                    col: 'done'
                },
            ];

            let notices = [{
                    to: 'Carlo Nieves (B1)',
                    subject: 'Rent reminder — 5 days overdue',
                    date: 'Aug 10, 2026'
                },
                {
                    to: 'Renz Ababon (C1)',
                    subject: 'Rent reminder — 5 days overdue',
                    date: 'Aug 10, 2026'
                },
            ];

            const peso = n => '₱' + n.toLocaleString('en-PH');
            const toast = (msg) => {
                const t = document.getElementById('toast');
                t.innerHTML = msg;
                t.classList.add('show');
                clearTimeout(t._timer);
                t._timer = setTimeout(() => t.classList.remove('show'), 2600);
            };

            // ---------- Nav / views ----------
            const views = ['overview', 'tenants', 'ledger', 'maintenance', 'notices'];
            const titles = {
                overview: 'Overview',
                tenants: 'Units & Tenants',
                ledger: 'Rent Ledger',
                maintenance: 'Maintenance',
                notices: 'Notices'
            };

            function showView(name) {
                views.forEach(v => {
                    document.getElementById('view-' + v).classList.toggle('active', v === name);
                });
                document.querySelectorAll('.navlink').forEach(b => b.classList.toggle('active', b.dataset.view ===
                    name));
                document.getElementById('viewTitle').textContent = titles[name];
                closeSidebar();
            }

            document.querySelectorAll('.navlink').forEach(btn => {
                btn.addEventListener('click', () => showView(btn.dataset.view));
            });
            document.querySelectorAll('[data-goto]').forEach(btn => {
                btn.addEventListener('click', () => showView(btn.dataset.goto));
            });

            // Mobile sidebar
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('backdrop');
            document.getElementById('hamburgerBtn').addEventListener('click', () => {
                sidebar.classList.add('open');
                backdrop.classList.add('show');
            });

            function closeSidebar() {
                sidebar.classList.remove('open');
                backdrop.classList.remove('show');
            }
            backdrop.addEventListener('click', closeSidebar);

            // ---------- Stats ----------
            function renderStats() {
                const occupied = units.filter(u => u.status !== 'vacant').length;
                const vacant = units.filter(u => u.status === 'vacant').length;
                const collected = payments.filter(p => p.status === 'paid').reduce((s, p) => s + p.amount, 0);
                const outstanding = payments.filter(p => p.status !== 'paid').reduce((s, p) => s + p.amount, 0);
                const overdueCount = units.filter(u => u.status === 'overdue').length;

                const cards = [{
                        label: 'Occupied units',
                        value: `${occupied}/${units.length}`,
                        delta: `${vacant} vacant`,
                        cls: vacant ? 'down' : 'up'
                    },
                    {
                        label: 'Collected this month',
                        value: peso(collected),
                        delta: '3 payments in',
                        cls: 'up'
                    },
                    {
                        label: 'Outstanding',
                        value: peso(outstanding),
                        delta: `${overdueCount} overdue`,
                        cls: overdueCount ? 'down' : 'up'
                    },
                    {
                        label: 'Open maintenance',
                        value: String(maintenance.filter(m => m.col !== 'done').length),
                        delta: `${maintenance.filter(m=>m.priority==='high'&&m.col!=='done').length} high priority`,
                        cls: 'down'
                    },
                ];
                document.getElementById('statsGrid').innerHTML = cards.map(c => `
      <div class="stat-card">
        <div class="stat-label">${c.label}</div>
        <div class="stat-value">${c.value}</div>
        <div class="stat-delta ${c.cls}">${c.delta}</div>
      </div>`).join('');
            }

            // ---------- Ledger ----------
            function receiptHTML(p, compact) {
                const statusClass = p.status === 'paid' ? '' : (p.status === 'due' ? 'is-due' : 'is-overdue');
                const stampText = p.status === 'paid' ? 'PAID' : (p.status === 'due' ? 'DUE' : 'OVERDUE');
                return `
      <div class="receipt ${statusClass}" data-unit="${p.unit}">
        <div class="receipt-amt mono">${peso(p.amount)}</div>
        <div class="receipt-meta">
          <div class="who"><span class="unit-tag">${p.unit}</span> &nbsp;${p.tenant}</div>
          <div class="what">${p.status==='paid' ? 'Received '+formatDate(p.date) : 'Rent due Aug 5, 2026'}</div>
        </div>
        ${p.status!=='paid' ? `<div class="receipt-action"><button class="btn btn-ghost btn-sm mark-paid" data-unit="${p.unit}">Mark paid</button></div>` : ''}
        <div class="stamp">${stampText}</div>
      </div>`;
            }

            function formatDate(iso) {
                if (!iso) return '';
                const d = new Date(iso + 'T00:00:00');
                return d.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
            }

            function renderLedger() {
                const sorted = [...payments].sort((a, b) => {
                    const order = {
                        overdue: 0,
                        due: 1,
                        paid: 2
                    };
                    return order[a.status] - order[b.status];
                });
                document.getElementById('fullLedger').innerHTML = sorted.map(p => receiptHTML(p)).join('');
                document.getElementById('overviewLedger').innerHTML = sorted.slice(0, 4).map(p => receiptHTML(p)).join(
                    '');
                document.getElementById('overdueBadge').textContent = payments.filter(p => p.status === 'overdue')
                    .length;
                attachMarkPaid();
            }

            function attachMarkPaid() {
                document.querySelectorAll('.mark-paid').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const unitId = btn.dataset.unit;
                        const p = payments.find(x => x.unit === unitId);
                        if (p) {
                            p.status = 'paid';
                            p.date = new Date().toISOString().slice(0, 10);
                        }
                        const u = units.find(x => x.id === unitId);
                        if (u) u.status = 'paid';
                        renderLedger();
                        renderStats();
                        renderTenants();
                        toast(`Marked ${unitId} as paid ✓`);
                    });
                });
            }

            // ---------- Tenants ----------
            function renderTenants(filter) {
                const q = (filter || '').toLowerCase();
                const rows = units.filter(u => {
                    if (!q) return true;
                    return u.id.toLowerCase().includes(q) || (u.tenant || '').toLowerCase().includes(q);
                });
                document.getElementById('tenantsBody').innerHTML = rows.map(u => {
                        if (u.status === 'vacant') {
                            return `<tr class="tenant-row">
          <td data-label="Unit"><span class="unit-tag">${u.id}</span></td>
          <td data-label="Tenant" colspan="1" style="color:var(--ink-soft);">— vacant —</td>
          <td data-label="Rent" class="mono">${peso(u.rent)}</td>
          <td data-label="Lease ends">—</td>
          <td data-label="Status"><span class="status-pill vacant">Vacant</span></td>
        </tr>`;
                        }
                        return `<tr class="tenant-row">
        <td data-label="Unit"><span class="unit-tag">${u.id}</span></td>
        <td data-label="Tenant">
          <div class="name-cell">
            <div class="avatar-sm">${u.avatar}</div>
            <div>${u.tenant}<div class="lease-note">Lease ends ${formatDate(u.leaseEnds)}</div></div>
          </div>
        </td>
        <td data-label="Rent" class="mono">${peso(u.rent)}</td>
        <td data-label="Lease ends">${formatDate(u.leaseEnds)}</td>
        <td data-label="Status"><span class="status-pill ${u.status}">${u.status.charAt(0).toUpperCase()+u.status.slice(1)}</span></td>
      </tr>`;
                    }).join('') ||
                    `<tr><td colspan="5"><div class="empty-state"><div class="em-title">No matches</div>Try a different unit or name.</div></td></tr>`;

                const occ = units.filter(u => u.status !== 'vacant').length;
                document.getElementById('occupancySub').textContent = `${occ} of ${units.length} units occupied`;
            }
            document.getElementById('tenantSearch').addEventListener('input', e => renderTenants(e.target.value));

            // ---------- Maintenance ----------
            const cols = [{
                    key: 'new',
                    label: 'New',
                    color: 'var(--rust)'
                },
                {
                    key: 'progress',
                    label: 'In progress',
                    color: 'var(--brass)'
                },
                {
                    key: 'done',
                    label: 'Done',
                    color: 'var(--sage)'
                },
            ];

            function renderKanban() {
                document.getElementById('kanbanBoard').innerHTML = cols.map(c => {
                    const items = maintenance.filter(m => m.col === c.key);
                    return `<div>
        <div class="kcol-head"><span class="dot" style="background:${c.color}"></span>${c.label} (${items.length})</div>
        ${items.map(m=>`
                  <div class="kcard" draggable="true" data-id="${m.id}">
                    <div class="ktitle">${m.desc}</div>
                    <div class="kmeta">
                      <span class="unit-tag" style="font-size:10.5px;padding:2px 7px;">${m.unit}</span>
                      <span class="priority ${m.priority}">${m.priority}</span>
                    </div>
                  </div>`).join('') || `<div class="empty-state" style="padding:16px 8px;font-size:12.5px;">Nothing here</div>`}
      </div>`;
                }).join('');

                const overviewOpen = maintenance.filter(m => m.col !== 'done').slice(0, 3);
                document.getElementById('overviewMaint').innerHTML = overviewOpen.length ? overviewOpen.map(m => `
      <div class="receipt" style="border-style:solid;">
        <div class="receipt-meta">
          <div class="who"><span class="unit-tag">${m.unit}</span> &nbsp;${m.desc}</div>
          <div class="what">Status: ${cols.find(c=>c.key===m.col).label}</div>
        </div>
        <span class="priority ${m.priority}">${m.priority}</span>
      </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">All caught up</div>No open maintenance requests.</div>`;

                document.getElementById('maintBadge').textContent = maintenance.filter(m => m.col !== 'done').length;
                attachDrag();
            }

            function attachDrag() {
                let dragId = null;
                document.querySelectorAll('.kcard').forEach(card => {
                    card.addEventListener('dragstart', () => {
                        dragId = card.dataset.id;
                    });
                });
                document.querySelectorAll('#kanbanBoard > div').forEach((colEl, idx) => {
                    colEl.addEventListener('dragover', e => e.preventDefault());
                    colEl.addEventListener('drop', () => {
                        const item = maintenance.find(m => String(m.id) === String(dragId));
                        if (item) {
                            item.col = cols[idx].key;
                            renderKanban();
                            renderStats();
                            toast('Request moved to ' + cols[idx].label);
                        }
                    });
                });
            }

            // ---------- Notices ----------
            function renderNotices() {
                document.getElementById('noticesList').innerHTML = notices.length ? notices.map(n => `
      <div class="receipt" style="border-style:solid;">
        <div class="receipt-meta">
          <div class="who">${n.subject}</div>
          <div class="what">To ${n.to} · ${n.date}</div>
        </div>
      </div>`).join('') :
                    `<div class="empty-state"><div class="em-title">No notices yet</div>Draft one when a reminder is due.</div>`;
            }

            // ---------- Modals ----------
            function openModal(id) {
                document.getElementById(id).classList.add('open');
            }

            function closeModal(id) {
                document.getElementById(id).classList.remove('open');
            }
            document.querySelectorAll('[data-close]').forEach(btn => {
                btn.addEventListener('click', () => closeModal(btn.dataset.close));
            });
            document.querySelectorAll('.modal-overlay').forEach(ov => {
                ov.addEventListener('click', e => {
                    if (e.target === ov) ov.classList.remove('open');
                });
            });

            function populateTenantSelects() {
                const occupiedUnits = units.filter(u => u.status !== 'vacant');
                const opts = occupiedUnits.map(u => `<option value="${u.id}">${u.id} — ${u.tenant}</option>`).join('');
                document.getElementById('pmTenant').innerHTML = opts;
                document.getElementById('ntTenant').innerHTML = opts;
                document.getElementById('mmUnit').innerHTML = units.map(u =>
                    `<option value="${u.id}">${u.id}${u.tenant? ' — '+u.tenant:' — vacant'}</option>`).join('');
            }

            document.getElementById('recordPaymentBtn').addEventListener('click', () => {
                populateTenantSelects();
                document.getElementById('pmDate').value = new Date().toISOString().slice(0, 10);
                openModal('paymentModal');
            });
            document.getElementById('pmSave').addEventListener('click', () => {
                const unitId = document.getElementById('pmTenant').value;
                const amount = Number(document.getElementById('pmAmount').value);
                const date = document.getElementById('pmDate').value;
                if (!unitId || !amount) {
                    toast('Add an amount to save this payment');
                    return;
                }
                const p = payments.find(x => x.unit === unitId);
                if (p) {
                    p.amount = amount;
                    p.status = 'paid';
                    p.date = date;
                }
                const u = units.find(x => x.id === unitId);
                if (u) u.status = 'paid';
                closeModal('paymentModal');
                document.getElementById('pmAmount').value = '';
                renderLedger();
                renderStats();
                renderTenants();
                toast(`Payment recorded for ${unitId} ✓`);
            });

            document.getElementById('newRequestBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('maintModal');
            });
            document.getElementById('mmSave').addEventListener('click', () => {
                const unit = document.getElementById('mmUnit').value;
                const desc = document.getElementById('mmDesc').value.trim();
                const priority = document.getElementById('mmPriority').value;
                if (!desc) {
                    toast('Describe the issue first');
                    return;
                }
                maintenance.push({
                    id: Date.now(),
                    unit,
                    desc,
                    priority,
                    col: 'new'
                });
                document.getElementById('mmDesc').value = '';
                closeModal('maintModal');
                renderKanban();
                renderStats();
                toast('Maintenance request added ✓');
            });

            document.getElementById('newNoticeBtn').addEventListener('click', () => {
                populateTenantSelects();
                openModal('noticeModal');
            });
            document.getElementById('ntSave').addEventListener('click', () => {
                const unitId = document.getElementById('ntTenant').value;
                const subject = document.getElementById('ntSubject').value.trim();
                const u = units.find(x => x.id === unitId);
                if (!subject) {
                    toast('Add a subject line');
                    return;
                }
                notices.unshift({
                    to: `${u.tenant} (${u.id})`,
                    subject,
                    date: new Date().toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
                    })
                });
                document.getElementById('ntSubject').value = '';
                document.getElementById('ntMessage').value = '';
                closeModal('noticeModal');
                renderNotices();
                toast('Notice saved ✓');
            });

            // ---------- Init ----------
            renderStats();
            renderLedger();
            renderTenants();
            renderKanban();
            renderNotices();

        })();
    </script>
</body>

</html>

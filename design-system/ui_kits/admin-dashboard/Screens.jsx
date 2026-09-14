const { Card, Badge, Button, IconButton, Icon, StatCard, BalanceCard, DataTable, ProgressBar, CardTile, Select, Tabs, Tooltip, AIPromptPanel, AreaChart, DonutChart, Breadcrumb, RadioCard, Input, Switch, Checkbox, SearchField, Dropdown, Avatar } = NS;

/* ══ HOME ══════════════════════════════════════════════════ */
function HomeScreen() {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
      <div className="lc-grid" style={{ gridTemplateColumns: '4fr 5fr 3fr' }}>
        <BalanceCard amount="$20,670" currency="USD" actions={<>
          <Button variant="onAccent" size="sm" glyph="↓">Deposit</Button>
          <Button variant="dark" size="sm" glyph="↗">Send</Button>
        </>} />
        <Card title="AI Enhancements" pad="md" action={<Button variant="secondary" size="sm" icon="plus">Add Enhancements</Button>}>
          <div className="lc-grid" style={{ gridTemplateColumns: 'repeat(3,1fr)' }}>
            <StatCard icon="circle-dollar-sign" label="Income" value="$14,480.24" delta="+1.78%" />
            <StatCard icon="receipt" label="Expense" value="$14,480.24" delta="+1.80%" />
            <StatCard icon="piggy-bank" label="Savings" value="$14,480.24" delta="+2.50%" />
          </div>
        </Card>
        <FinanceScore />
      </div>

      <div className="lc-grid" style={{ gridTemplateColumns: '7fr 5fr' }}>
        <CashflowPanel />
        <Card pad="lg" action={<IconButton icon="more-vertical" variant="plain" size="sm" label="Options" />}>
          <AIPromptPanel compact heading="What Can I help with?" orbSize={92} model="Choose Model"
            suggestions={['Show me my cash flow', 'Help me set a savings goal', 'Forecast my balance', 'Plan my monthly budget', 'Detect unusual transactions']} />
        </Card>
      </div>

      <div className="lc-grid" style={{ gridTemplateColumns: '5fr 4fr 3fr' }}>
        <Card title="Recent Transactions" pad="md" action={<>
          <Select value="This Month" options={['This Month', 'This Year']} />
          <IconButton icon="sliders-horizontal" variant="plain" size="sm" label="Filter" />
        </>}>
          <DataTable columns={TX_COLUMNS.slice(0, 1).concat(TX_COLUMNS.slice(3))} rows={TRANSACTIONS.slice(0, 6)} maxHeight={280} fade />
        </Card>
        <StatisticPanel />
        <ExchangePanel />
      </div>
    </div>
  );
}

/* ══ AI ASSISTANT ══════════════════════════════════════════ */
const ASSIST_CARDS = [
  { title: 'Track Cash Flow', body: 'View income, spending, and savings in real time with AI insights for smarter financial management.' },
  { title: 'Detect Unusual Transactions', body: 'Get instant alerts on suspicious charges or duplicate payments, ensuring security and keeping your finances fully protected.' },
  { title: 'Plan a Savings Goal', body: 'Set smart AI-recommended savings targets to securely fund your emergency needs or dream vacation goals.' },
  { title: 'Financial Health Score', body: 'Receive a personalized AI-powered score that evaluates your spending, saving, and investments for financial wellness.' },
];

function AssistantScreen() {
  return (
    <Card pad="lg">
      <div style={{ display: 'flex', justifyContent: 'flex-end', gap: 8, marginBottom: 4 }}>
        <Button variant="secondary" size="sm" icon="download">Export</Button>
        <Button variant="primary" size="sm" icon="sparkles">Get Plus</Button>
      </div>
      <div style={{ maxWidth: 760, margin: '0 auto', display: 'flex', flexDirection: 'column', gap: 26 }}>
        <AIPromptPanel orbSize={104}
          heading="How Can I Assist You With Your Finances?"
          subheading="Quickly track cash flow, get AI-powered insights, and manage your money—all in one place"
          model="Choose Model" />
        <div>
          <p style={{ font: 'var(--type-label)', color: 'var(--text-muted)', marginBottom: 10 }}>Get started with an example below</p>
          <div className="lc-grid" style={{ gridTemplateColumns: 'repeat(2,minmax(0,1fr))' }}>
            {ASSIST_CARDS.map((c) => (
              <Card key={c.title} surface="tile" pad="md" interactive radius="card-inner">
                <h4 style={{ font: 'var(--weight-semibold) 15px/1.2 var(--font-display)', color: 'var(--text-strong)' }}>{c.title}</h4>
                <p style={{ font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 6, lineHeight: 1.5 }}>{c.body}</p>
                <span style={{ display: 'inline-flex', alignItems: 'center', gap: 6, marginTop: 14, font: 'var(--weight-semibold) 13px/1 var(--font-ui)', color: 'var(--text-accent)' }}>
                  Learn more <Icon name="arrow-right" size={15} />
                </span>
              </Card>
            ))}
          </div>
        </div>
      </div>
    </Card>
  );
}

/* ══ TRANSACTIONS ══════════════════════════════════════════ */
function TransactionsScreen() {
  const [sel, setSel] = React.useState([]);
  const [q, setQ] = React.useState('');
  const [tab, setTab] = React.useState('all');
  const rows = TRANSACTIONS.filter((r) => {
    const okTab = tab === 'all' || (tab === 'in' && r.amt[0] === '+') || (tab === 'out' && r.amt[0] === '-') || (tab === 'pending' && r.status === 'Pending');
    const okQ = !q || (r.name + ' ' + r.cat).toLowerCase().indexOf(q.toLowerCase()) > -1;
    return okTab && okQ;
  });
  const toggle = (i) => setSel(sel.indexOf(i) > -1 ? sel.filter((x) => x !== i) : sel.concat([i]));
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
      <div className="lc-grid" style={{ gridTemplateColumns: 'repeat(4,1fr)' }}>
        <StatCard surface="card" icon="arrow-down-left" label="Money in" value="$2,550.00" delta="+12.4%" footer="7 credits this month" />
        <StatCard surface="card" icon="arrow-up-right" label="Money out" value="$413.89" delta="-3.1%" deltaTone="pending" footer="11 debits this month" />
        <StatCard surface="card" icon="clock" label="Pending" value="$138.94" delta="3 items" deltaTone="warning" footer="Clears within 48h" />
        <StatCard surface="card" icon="wallet" label="Net change" value="+$2,136.11" delta="+9.2%" footer="Compared to $1,956 last month" />
      </div>

      <Card pad="md" title="All Transactions" subtitle="Every movement across your cards and wallets."
        action={<>
          <SearchField width={230} shortcut={[]} placeholder="Search transactions" value={q} onChange={(e) => setQ(e.target.value)} />
          <Select value="This Month" options={['This Month', 'This Year', 'All time']} />
          <Button variant="secondary" size="sm" icon="download">Export</Button>
        </>}>
        <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
          <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 12, flexWrap: 'wrap' }}>
            <Tabs value={tab} onChange={setTab} items={[
              { value: 'all', label: 'All', meta: '(' + TRANSACTIONS.length + ')' },
              { value: 'in', label: 'Money in' },
              { value: 'out', label: 'Money out' },
              { value: 'pending', label: 'Pending', meta: '(3)' },
            ]} style={{ flex: 1, minWidth: 260 }} />
            {sel.length ? (
              <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                <span style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{sel.length} selected</span>
                <Button variant="secondary" size="sm" icon="tag">Categorise</Button>
                <Button variant="ghost" size="sm" icon="x" onClick={() => setSel([])}>Clear</Button>
              </div>
            ) : null}
          </div>
          <DataTable selectable selected={sel} onSelect={toggle} rows={rows} columns={[
            { header: 'Transaction Name', sortable: true, render: (r) => <NameCell row={r} /> },
            { header: 'Account', sortable: true, render: (r) => <AcctCell row={r} /> },
            { header: 'Transaction ID', render: (r) => <span style={{ color: 'var(--text-muted)' }}>{r.id}</span> },
            { header: 'Date & Time', sortable: true, render: (r) => <DateCell row={r} /> },
            { header: 'Amount', align: 'right', sortable: true, render: (r) => <Amount value={r.amt} /> },
            { header: 'Description', wrap: true, render: (r) => <span style={{ color: 'var(--text-muted)' }}>{r.note}</span> },
            { header: 'Status', render: (r) => <Badge tone={r.status === 'Completed' ? 'success' : 'pending'}>{r.status}</Badge> },
            { header: '', width: 44, render: () => <Dropdown trigger={<IconButton icon="more-horizontal" variant="plain" size="sm" label="Options" />} items={[{ label: 'View details', icon: 'eye' }, { label: 'Download receipt', icon: 'download' }, { divider: true }, { label: 'Report issue', icon: 'flag', tone: 'danger' }]} /> },
          ]} />
          {!rows.length ? <p style={{ padding: 28, textAlign: 'center', font: 'var(--type-body)', color: 'var(--text-muted)' }}>Nothing matches that filter.</p> : null}
        </div>
      </Card>
    </div>
  );
}

/* ══ WALLET ════════════════════════════════════════════════ */
function WalletScreen() {
  const [ci, setCi] = React.useState(0);
  const [wtab, setWtab] = React.useState('Wallet');
  const card = CARDS[ci];
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
      <div style={{ display: 'flex', alignItems: 'flex-end', justifyContent: 'space-between', gap: 16, flexWrap: 'wrap' }}>
        <div>
          <Breadcrumb items={['Overview', 'Balance Details']} />
          <div className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-title-1)/1.1 var(--font-numeric)', color: 'var(--text-strong)', marginTop: 6 }}>$542,25.00 <span style={{ font: 'var(--weight-medium) 18px/1 var(--font-ui)', color: 'var(--text-muted)' }}>USD</span></div>
          <p style={{ font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 4 }}>Your total balance estimate in USD at 2024-09-16 12:20</p>
        </div>
        <Button variant="primary" icon="settings-2">Manage Balance</Button>
      </div>

      <div className="lc-grid" style={{ gridTemplateColumns: '4fr 4fr 5fr' }}>
        <Card title="Your Cards" pad="md" action={<IconButton icon="plus" variant="tile" size="sm" label="Add card" />}>
          <div style={{ display: 'flex', flexDirection: 'column', gap: 8 }}>
            {CARDS.map((c, i) => (
              <RadioCard key={i} checked={ci === i} onChange={() => setCi(i)} title={c.label} meta={c.mask}
                leading={<CardTile scheme={c.scheme} tone={c.tone} width={54} />}
                trailing={<Dropdown trigger={<IconButton icon="more-horizontal" variant="plain" size="sm" label="Card options" />} items={[{ label: 'Freeze card', icon: 'snowflake' }, { label: 'Set limit', icon: 'gauge' }, { divider: true }, { label: 'Remove card', icon: 'trash-2', tone: 'danger' }]} />} />
            ))}
          </div>
        </Card>

        <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
          <Card pad="md">
            <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
              <div style={{ display: 'flex', gap: 20, justifyContent: 'space-around' }}>
                {[['plus', 'Top Up'], ['arrow-left-right', 'Transfer'], ['credit-card', 'Payment']].map(([ic, l]) => (
                  <button key={l} style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 7, background: 'transparent', border: 'none', cursor: 'pointer', color: 'var(--forest-800)' }}>
                    <span style={{ width: 42, height: 42, borderRadius: 'var(--radius-pill)', display: 'grid', placeItems: 'center', background: 'var(--surface-tile)', border: '1px solid var(--border-hairline)' }}><Icon name={ic} size={19} /></span>
                    <span style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{l}</span>
                  </button>
                ))}
              </div>
              <div style={{ height: 1, background: 'var(--border-hairline)' }} />
              <div>
                <div style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>Card Number</div>
                <div className="lc-numeric" style={{ font: 'var(--weight-semibold) 17px/1.3 var(--font-numeric)', color: 'var(--text-strong)', letterSpacing: '0.03em' }}>{card.number}</div>
              </div>
              <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 10 }}>
                {[['Expiry Date', card.expiry], ['CVC', card.cvc]].map(([l, v]) => (
                  <div key={l}>
                    <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)' }}>{l}</div>
                    <div className="lc-numeric" style={{ font: 'var(--weight-semibold) 14px var(--font-numeric)', color: 'var(--text-strong)' }}>{v}</div>
                  </div>
                ))}
                <div>
                  <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)', marginBottom: 3 }}>Status</div>
                  <Badge tone={card.status === 'Active' ? 'dark' : 'neutral'}>{card.status}</Badge>
                </div>
              </div>
            </div>
          </Card>
          <Card title="Spending Limits" pad="md" action={<IconButton icon="more-vertical" variant="plain" size="sm" label="Options" />}>
            <ProgressBar value={45} tone="split" height={12} caption="$4,500.00 spent of $10,000.00 · 45%" />
          </Card>
        </div>

        <Card title="My Wallets" pad="md" action={<Select value="Monthly" options={['Daily', 'Weekly', 'Monthly']} />}>
          <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
            <Tabs variant="underline" size="sm" value={wtab} onChange={setWtab} items={['Wallet', 'Card Transaction', 'Investment']} />
            <AreaChart height={230} marker={17} series={WALLET_SERIES} compare={WALLET_COMPARE}
              yTicks={['$100k', '$80k', '$60k', '$40k', '$20k', '0']}
              xLabels={['1', '2', '3', '4', '5', '6', '7', '8']} />
          </div>
        </Card>
      </div>

      <div className="lc-grid" style={{ gridTemplateColumns: '6fr 3fr 3fr' }}>
        <Card title="Transactions" pad="md" action={<Select value="This Month" options={['This Month', 'This Year']} />}>
          <DataTable selectable selected={[]} onSelect={() => {}} rows={TRANSACTIONS.slice(0, 6)} maxHeight={300} fade columns={[
            { header: 'Transaction Name', sortable: true, render: (r) => <NameCell row={r} /> },
            { header: 'Transaction ID', render: (r) => <span style={{ color: 'var(--text-muted)' }}>{r.id}</span> },
            { header: 'Date & Time', sortable: true, render: (r) => <DateCell row={r} /> },
            { header: 'Amount', align: 'right', render: (r) => <Amount value={r.amt} /> },
            { header: 'Status', render: (r) => <Badge tone={r.status === 'Completed' ? 'success' : 'pending'}>{r.status}</Badge> },
          ]} />
        </Card>

        <Card title="All Expenses" pad="md" action={<Select value="This Month" options={['This Month', 'This Year']} />}>
          <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 8 }}>
              {[['Daily', '$310'], ['Weekly', '$2,510'], ['Monthly', '$9,152']].map(([l, v]) => (
                <div key={l}>
                  <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)' }}>{l}</div>
                  <div className="lc-numeric" style={{ font: 'var(--weight-semibold) 15px var(--font-numeric)', color: 'var(--text-strong)' }}>{v}</div>
                </div>
              ))}
            </div>
            <div style={{ display: 'grid', placeItems: 'center' }}>
              <DonutChart size={150} thickness={22} label="Platform" value="$2,250" segments={EXPENSE_SPLIT} />
            </div>
            <div style={{ display: 'flex', flexDirection: 'column', gap: 7 }}>
              {EXPENSE_SPLIT.slice(0, 4).map((s) => (
                <div key={s.name} style={{ display: 'flex', alignItems: 'center', gap: 8, font: 'var(--type-caption)', color: 'var(--text-body)' }}>
                  <span style={{ width: 9, height: 9, borderRadius: '50%', background: s.color, flex: '0 0 auto' }} />
                  <span style={{ flex: 1 }}>{s.name}</span>
                  <span className="lc-numeric" style={{ fontWeight: 600, color: 'var(--text-strong)' }}>{s.amount}</span>
                </div>
              ))}
            </div>
          </div>
        </Card>

        <Card title="Convert" pad="md" action={<IconButton icon="more-vertical" variant="plain" size="sm" label="Options" />}>
          <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
            <Input label="You send" defaultValue="$200.00" suffix="USD" />
            <div style={{ display: 'flex', flexDirection: 'column', gap: 8, padding: 12, background: 'var(--surface-card-sunken)', borderRadius: 'var(--radius-card-inner)' }}>
              <div style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>You've <span className="lc-numeric" style={{ color: 'var(--text-strong)', fontWeight: 600 }}>$35,478.00</span> available balance</div>
              {[['− $2.23', 'Our fees'], ['= $197.77', 'Amount converted'], ['× £0.778786', 'Live rate']].map(([a, b]) => (
                <div key={b} style={{ display: 'flex', justifyContent: 'space-between', gap: 10, font: 'var(--type-caption)' }}>
                  <span className="lc-numeric" style={{ color: 'var(--text-strong)', fontWeight: 600 }}>{a}</span>
                  <span style={{ color: 'var(--text-subtle)' }}>{b}</span>
                </div>
              ))}
            </div>
            <div style={{ display: 'grid', placeItems: 'center' }}><IconButton icon="arrow-up-down" variant="tile" size="sm" label="Flip direction" /></div>
            <Input label="They get" defaultValue="£154.02" suffix="GBP" />
            <Button variant="primary" fullWidth>Continue</Button>
          </div>
        </Card>
      </div>
    </div>
  );
}

/* ══ SETTINGS ══════════════════════════════════════════════ */
function SettingsScreen() {
  const [alerts, setAlerts] = React.useState(true);
  const [weekly, setWeekly] = React.useState(true);
  const [marketing, setMarketing] = React.useState(false);
  const [twofa, setTwofa] = React.useState(true);
  return (
    <div className="lc-grid" style={{ gridTemplateColumns: '7fr 5fr' }}>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
        <Card title="Account" subtitle="How your name and contact details appear on invoices." pad="md">
          <div className="lc-grid" style={{ gridTemplateColumns: '1fr 1fr' }}>
            <Input label="Full name" defaultValue="Jenny Wilson" />
            <Input label="Email" icon="mail" defaultValue="jenny@liberacash.com" />
            <Input label="Phone" icon="phone" defaultValue="+55 11 98765-4321" />
            <Input label="Tax ID" defaultValue="123.456.789-00" hint="Used on every invoice you issue." />
          </div>
        </Card>
        <Card title="Notifications" subtitle="Choose what reaches you, and where." pad="md">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            <Switch checked={alerts} onChange={() => setAlerts(!alerts)} label="Unusual transaction alerts" description="Notify me when a charge looks duplicated or out of pattern." />
            <Switch checked={weekly} onChange={() => setWeekly(!weekly)} label="Weekly cash-flow digest" description="A Monday summary of income, spending and what changed." />
            <Switch checked={marketing} onChange={() => setMarketing(!marketing)} label="Product news" description="Occasional notes about new Libera Cash features." />
          </div>
        </Card>
        <Card title="Security" pad="md">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            <Switch checked={twofa} onChange={() => setTwofa(!twofa)} label="Two-factor authentication" description="Required for transfers above $1,000." />
            <div style={{ display: 'flex', gap: 10, flexWrap: 'wrap' }}>
              <Button variant="secondary" size="sm" icon="key-round">Change password</Button>
              <Button variant="secondary" size="sm" icon="monitor-smartphone">Manage devices</Button>
              <Button variant="danger" size="sm" icon="log-out">Sign out everywhere</Button>
            </div>
          </div>
        </Card>
      </div>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 'var(--gap-card)' }}>
        <Card title="Plan" pad="md">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 10 }}>
              <span style={{ font: 'var(--type-card-title)', color: 'var(--text-strong)' }}>Personal</span>
              <Badge tone="accent">Current</Badge>
            </div>
            <ProgressBar value={62} label="AI insights used" caption="124 of 200 this month" />
            <Button variant="primary" fullWidth glyph="↗">Upgrade your Plan</Button>
          </div>
        </Card>
        <Card surface="inverse" pad="md" title="Data export" subtitle="Take everything with you, any time.">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
            <p style={{ font: 'var(--type-caption)', color: 'var(--forest-200)' }}>Statements, transactions and invoices as CSV or PDF. We email a link when the file is ready.</p>
            <Button variant="primary" size="sm" icon="download">Request export</Button>
          </div>
        </Card>
        <Card title="Connected accounts" pad="md">
          <div style={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
            {[['Itaú', 'Checking · •••• 4471', 'success'], ['Nubank', 'Credit · •••• 9120', 'success'], ['Mercado Pago', 'Reconnect needed', 'pending']].map(([n, d, tone]) => (
              <div key={n} style={{ display: 'flex', alignItems: 'center', gap: 10, padding: '11px 12px', border: '1px solid var(--border-hairline)', borderRadius: 'var(--radius-card-inner)' }}>
                <span style={{ width: 34, height: 34, borderRadius: 'var(--radius-pill)', display: 'grid', placeItems: 'center', background: 'var(--surface-tile)', color: 'var(--forest-800)', flex: '0 0 auto' }}><Icon name="building-2" size={17} /></span>
                <span style={{ flex: 1, minWidth: 0 }}>
                  <span style={{ display: 'block', font: 'var(--weight-semibold) 14px/1.2 var(--font-ui)', color: 'var(--text-strong)' }}>{n}</span>
                  <span style={{ display: 'block', font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{d}</span>
                </span>
                <Badge tone={tone} size="sm">{tone === 'success' ? 'Linked' : 'Action'}</Badge>
              </div>
            ))}
          </div>
        </Card>
      </div>
    </div>
  );
}

/* ══ PLACEHOLDER (Invoices / Reports / Help) ═══════════════ */
function PlaceholderScreen({ screen }) {
  const meta = SCREEN_META[screen] || {};
  return (
    <Card pad="lg" style={{ minHeight: 380, display: 'grid', placeItems: 'center' }}>
      <div style={{ textAlign: 'center', maxWidth: 460, display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 12 }}>
        <span style={{ width: 56, height: 56, borderRadius: 'var(--radius-pill)', display: 'grid', placeItems: 'center', background: 'var(--surface-tile)', border: '1px solid var(--border-hairline)', color: 'var(--forest-800)' }}>
          <Icon name="square-dashed" size={24} />
        </span>
        <h3 style={{ font: 'var(--weight-semibold) var(--text-title-3)/1.2 var(--font-display)', color: 'var(--text-strong)' }}>{meta.title} is intentionally blank</h3>
        <p style={{ font: 'var(--type-body)', color: 'var(--text-muted)' }}>
          The reference material contains no design for this screen, so nothing has been invented here.
          See readme.md &gt; CAVEATS.
        </p>
      </div>
    </Card>
  );
}

Object.assign(window, { HomeScreen, AssistantScreen, TransactionsScreen, WalletScreen, SettingsScreen, PlaceholderScreen });

const { Card, Badge, Button, IconButton, Icon, StatCard, BalanceCard, BarChart, DonutChart, DataTable, ProgressBar, CardTile, Select, Tabs, Tooltip, AIPromptPanel, Input } = NS;

function Amount({ value, size = 13 }) {
  const up = String(value)[0] === '+';
  return (
    <span className="lc-numeric" style={{ font: 'var(--weight-semibold) ' + size + 'px/1.2 var(--font-numeric)', color: up ? 'var(--text-positive)' : 'var(--text-negative)' }}>{value}</span>
  );
}

function NameCell({ row }) {
  return (
    <>
      <div style={{ font: 'var(--weight-semibold) 13px/1.3 var(--font-tabular)', color: 'var(--text-strong)' }}>{row.name}</div>
      <div style={{ font: 'var(--weight-regular) 11px/1.3 var(--font-tabular)', color: 'var(--text-subtle)' }}>{row.cat}</div>
    </>
  );
}

function AcctCell({ row }) {
  return (
    <span style={{ display: 'inline-flex', alignItems: 'center', gap: 7 }}>
      <CardTile scheme={row.scheme} tone={row.scheme === 'visa' ? 'grey' : 'dark'} width={24} />
      <span style={{ color: 'var(--text-muted)' }}>{row.acct}</span>
    </span>
  );
}

function DateCell({ row }) {
  return (
    <>
      <div style={{ color: 'var(--text-body)' }}>{row.date}</div>
      <div style={{ fontSize: 11, color: 'var(--text-subtle)' }}>{row.time}</div>
    </>
  );
}

const TX_COLUMNS = [
  { header: 'Transaction Name', sortable: true, render: (r) => <NameCell row={r} /> },
  { header: 'Account', sortable: true, render: (r) => <AcctCell row={r} /> },
  { header: 'Date & Time', sortable: true, render: (r) => <DateCell row={r} /> },
  { header: 'Amount', align: 'right', sortable: true, render: (r) => <Amount value={r.amt} /> },
  { header: 'Status', render: (r) => <Badge tone={r.status === 'Completed' ? 'success' : 'pending'}>{r.status}</Badge> },
];

/* ── Finance score ─────────────────────────────────────────── */
function FinanceScore() {
  return (
    <Card title="Finance Score" action={<IconButton icon="more-horizontal" variant="plain" size="sm" label="Options" />} pad="md" style={{ height: '100%' }}>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 14, height: '100%', justifyContent: 'center' }}>
        <div>
          <div className="lc-eyebrow" style={{ marginBottom: 6 }}>FINANCE QUALITY</div>
          <div style={{ display: 'flex', alignItems: 'baseline', justifyContent: 'space-between', gap: 10 }}>
            <span style={{ font: 'var(--weight-semibold) var(--text-title-2)/1.05 var(--font-display)', color: 'var(--text-strong)' }}>Excellent</span>
            <span className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-2)/1 var(--font-numeric)', color: 'var(--text-strong)' }}>92%</span>
          </div>
        </div>
        <div style={{ display: 'flex', gap: 6, height: 22 }}>
          <div style={{ flex: 72, background: 'var(--forest-800)', borderRadius: 'var(--radius-pill)' }} />
          <div style={{ flex: 28, background: 'var(--green-500)', borderRadius: 'var(--radius-pill)' }} />
        </div>
        <p style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>Up 4 points since August. Savings rate is carrying the score.</p>
      </div>
    </Card>
  );
}

/* ── Exchange ──────────────────────────────────────────────── */
function ExchangePanel({ compact }) {
  const [from, setFrom] = React.useState('USD');
  const [to, setTo] = React.useState('GBP');
  return (
    <Card title="Exchange" action={<Badge tone="neutral">Currencies</Badge>} pad="md" style={{ height: '100%' }}>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 12 }}>
        <div style={{ textAlign: 'center', font: 'var(--type-caption)', color: 'var(--text-muted)' }}>1 {from} = 0.77 {to}</div>
        <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
          <Select value={from} onSelect={setFrom} variant="outline" options={['USD', 'GBP', 'BRL', 'EUR']} style={{ flex: 1 }} />
          <IconButton icon="arrow-left-right" variant="tile" size="sm" label="Swap currencies" onClick={() => { setFrom(to); setTo(from); }} />
          <Select value={to} onSelect={setTo} variant="outline" options={['GBP', 'USD', 'BRL', 'EUR']} style={{ flex: 1 }} />
        </div>
        <div style={{ textAlign: 'center' }}>
          <div className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-1)/1.1 var(--font-numeric)', color: 'var(--text-strong)' }}>$100.00</div>
          <div style={{ font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 2 }}>Available: <span className="lc-numeric" style={{ color: 'var(--text-strong)', fontWeight: 600 }}>$1,600.86</span></div>
        </div>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3,1fr)', gap: 8, padding: 12, background: 'var(--surface-card-sunken)', borderRadius: 'var(--radius-card-inner)' }}>
          {[['Tax (2%)', '$2.00'], ['Exchange fee (1%)', '$1.00'], ['Total amount', '€90.7']].map(([l, v]) => (
            <div key={l}>
              <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)', whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>{l}</div>
              <div className="lc-numeric" style={{ font: 'var(--weight-semibold) 15px/1.2 var(--font-numeric)', color: 'var(--text-strong)' }}>{v}</div>
            </div>
          ))}
        </div>
        <Button variant="primary" fullWidth>Exchange</Button>
      </div>
    </Card>
  );
}

/* ── Statistic (donut + legend) ────────────────────────────── */
function StatisticPanel() {
  const [tab, setTab] = React.useState('expense');
  return (
    <Card title="Statistic" action={<Select value="This Month" options={['This Month', 'This Year']} />} pad="md" style={{ height: '100%' }}>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 14 }}>
        <Tabs value={tab} onChange={setTab} size="sm" items={[{ value: 'income', label: 'Income', meta: '($4,800)' }, { value: 'expense', label: 'Expense', meta: '($3,500)' }]} />
        <div style={{ display: 'grid', placeItems: 'center' }}>
          <DonutChart size={168} thickness={24} label="Total Expense" value="$3,500" segments={EXPENSE_SPLIT} />
        </div>
        <div style={{ display: 'flex', flexDirection: 'column', gap: 9 }}>
          {EXPENSE_SPLIT.slice(0, 4).map((s) => (
            <div key={s.name} style={{ display: 'flex', alignItems: 'center', gap: 9 }}>
              <span style={{ font: 'var(--weight-semibold) 10px/1 var(--font-tabular)', color: 'var(--forest-800)', background: s.color, borderRadius: 'var(--radius-pill)', padding: '5px 7px', minWidth: 34, textAlign: 'center' }}>{s.pct}</span>
              <span style={{ flex: 1, font: 'var(--type-caption)', color: 'var(--text-body)' }}>{s.name}</span>
              <span className="lc-numeric" style={{ font: 'var(--weight-semibold) 13px var(--font-numeric)', color: 'var(--text-strong)' }}>{s.amount}</span>
            </div>
          ))}
        </div>
      </div>
    </Card>
  );
}

/* ── Cashflow ──────────────────────────────────────────────── */
function CashflowPanel({ height = 210 }) {
  const [hl, setHl] = React.useState(5);
  const d = CASHFLOW[hl == null ? 5 : hl];
  return (
    <Card title="Cashflow" action={<Select value="This Year" options={['This Month', 'This Year']} />} pad="md" style={{ height: '100%' }}>
      <div style={{ display: 'flex', flexDirection: 'column', gap: 10 }}>
        <div>
          <div style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>Total Balance</div>
          <div className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-1)/1.1 var(--font-numeric)', color: 'var(--text-strong)' }}>$562,000</div>
        </div>
        <div style={{ position: 'relative' }}>
          {d ? (
            <div style={{ position: 'absolute', left: 'calc(6% + ' + (hl == null ? 5 : hl) * 7.6 + '%)', top: 4, zIndex: 3 }}>
              <Tooltip title={d.label + ' 2029'} rows={[{ label: 'Income', value: '$' + d.a.toLocaleString() }, { label: 'Expense', value: '$' + d.b.toLocaleString(), tone: 'negative' }]} placement="bottom" />
            </div>
          ) : null}
          <BarChart data={CASHFLOW} height={height} highlight={hl} onHighlight={setHl} />
        </div>
      </div>
    </Card>
  );
}

Object.assign(window, { Amount, NameCell, AcctCell, DateCell, TX_COLUMNS, FinanceScore, ExchangePanel, StatisticPanel, CashflowPanel });

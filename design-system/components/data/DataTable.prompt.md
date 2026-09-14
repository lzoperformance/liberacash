Transactions table. Plus Jakarta Sans at 13px, sticky grey header, hairline rules, no vertical lines.

```jsx
<DataTable selectable selected={sel} onSelect={toggle} fade maxHeight={320}
  columns={[
    { header: 'Transaction Name', sortable: true, render: r => (
        <><div style={{font:'var(--weight-semibold) 13px var(--font-tabular)',color:'var(--text-strong)'}}>{r.name}</div>
          <div style={{font:'var(--weight-regular) 11px var(--font-tabular)',color:'var(--text-subtle)'}}>{r.category}</div></>) },
    { header: 'Amount', align: 'right', render: r => <Amount value={r.amount} /> },
    { header: 'Status', render: r => <Badge tone={r.status === 'Completed' ? 'success' : 'pending'}>{r.status}</Badge> },
  ]}
  rows={rows} />
```

The name cell is always two lines: transaction name in semibold forest, category in 11px grey
underneath. Amounts are right-aligned, signed and coloured. Status is always a Badge.

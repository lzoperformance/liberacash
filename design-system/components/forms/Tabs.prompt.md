In-card tab switcher. The green 2px underline is the system's signature active indicator.

```jsx
<Tabs value={t} onChange={setT} items={[
  { value: 'income', label: 'Income', meta: '($4,800)' },
  { value: 'expense', label: 'Expense', meta: '($3,500)' },
]} />
<Tabs variant="segmented" items={['Wallet','Card Transaction','Investment']} />
```

Use `meta` to hang the figure off the label — the reference does this on every statistic card.

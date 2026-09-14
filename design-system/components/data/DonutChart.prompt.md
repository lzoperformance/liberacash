Expense-breakdown ring with the total in the hole.

```jsx
<DonutChart size={180} label="Total Expense" value="$3,500" segments={[
  { value: 60, color: 'var(--chart-series-1)' },
  { value: 15, color: 'var(--chart-series-2)' },
  { value: 12, color: 'var(--chart-series-3)' },
  { value: 8,  color: 'var(--chart-series-4)' },
]} />
```

Order segments dark → light clockwise and put the legend beside it as a percentage / name / amount
list, not as labels on the ring.

Intentional addition — one primitive covering both the chart value card and plain hover hints, so
charts don't own bespoke popovers.

```jsx
<Tooltip title="June 2029" rows={[
  { label: 'Income', value: '$6,000' },
  { label: 'Expense', value: '$4,000', tone: 'negative' } ]} />

<Tooltip variant="plain" title="Balance excludes pending charges">
  <Icon name="info" size={15} />
</Tooltip>
```

Chart tooltips always carry their baseline in `caption`.

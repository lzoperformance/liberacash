The KPI tile. Label small and grey above, figure large in Space Grotesk, signed delta chip beside it.

```jsx
<StatCard icon="circle-dollar-sign" label="Income" value="$14,480.24" delta="+1.78%" />
<StatCard label="Total Expense" value="$43,000" delta="-1.78%" deltaTone="pending" surface="tile" />
```

Three or four of these sit inside one parent Card — they are tiles, not standalone cards, so the
default surface is `hairline` with no shadow.

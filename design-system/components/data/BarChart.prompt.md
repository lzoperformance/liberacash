The Cashflow chart — a diverging column pair, forest up and green down from a hairline zero rule.

```jsx
<BarChart height={220} highlight={i} onHighlight={setI}
  data={[{label:'Jan',a:5200,b:3600},{label:'Feb',a:4100,b:4800}]} />
```

Hovering a column drops the others to 45% opacity — pair it with a Tooltip showing that month's
income and expense. Bars grow from the zero line once on mount and never re-animate.

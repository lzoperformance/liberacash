Every module on a Libera Cash screen is a Card. Title + optional right-hand action, then body.

```jsx
<Card title="Cashflow" action={<Select value="This Year" options={['This Month','This Year']} />}>
  <BarChart series={data} />
</Card>
```

Shadow **or** border, never both: `card` on the grey desk, `hairline` when the card sits on white.
`tile` is the faint white→grey gradient for secondary panels, `inverse` is forest for dark
sections, `selected` gives the accent-faint wash used for a chosen row or card.

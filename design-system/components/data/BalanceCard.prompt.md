The one green card on the screen — total balance, with the blurred ribbon art behind it.

```jsx
<BalanceCard amount="$20,670" currency="USD" actions={<>
  <Button variant="onAccent" glyph="↓">Deposit</Button>
  <Button variant="dark" glyph="↗">Send</Button>
</>} />
```

Never place two of these on one screen, never put body text on the green, and always use
`onAccent` (white) + `dark` (forest) buttons inside it — a `primary` green button would vanish.

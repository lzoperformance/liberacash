Mobile's replacement for the Sidebar — but only for the top five destinations. Everything else
lives behind the hamburger sheet, because mobile keeps every desktop feature (see readme > the brief).

```jsx
<MobileTabBar active={tab} onNavigate={setTab} items={[
  { value:'home', label:'Home', icon:'home' },
  { value:'cashflow', label:'Cashflow', icon:'chart-column' },
  { value:'transactions', label:'Activity', icon:'arrow-left-right' },
  { value:'wallet', label:'Wallet', icon:'wallet' },
  { value:'ai', label:'Assistant', icon:'wand-sparkles' },
]} />
```

Every tab is at least 44px tall (`--touch-min`).

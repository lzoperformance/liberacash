The desktop rail. Fixed 248px, grey-50 against the white content area, active item is a white
capsule-ish card with a hairline border and a whisper of shadow.

```jsx
<Sidebar base="../.." active="dashboard" onNavigate={go}
  account={{ name: 'Jenny Wilson', role: 'Personal Account' }}
  footer={<UpgradeCard />}
  sections={[
    { label: 'MAIN MENU', items: [
      { value:'dashboard', label:'Dashboard', icon:'home' },
      { value:'ai', label:'AI Assistant', icon:'wand-sparkles' },
      { value:'transactions', label:'Transactions', icon:'arrow-left-right' },
      { value:'wallet', label:'My Wallet', icon:'wallet' },
      { value:'invoices', label:'Invoices', icon:'file-text' },
      { value:'reports', label:'Reports', icon:'pie-chart' } ] },
    { label: 'PREFERENCE', items: [
      { value:'settings', label:'Settings', icon:'settings' },
      { value:'help', label:'Help Center', icon:'circle-help' } ] },
  ]} />
```

The two eyebrow labels are the only all-caps type in the product.

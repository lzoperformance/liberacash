Overflow menu behind the `…` icon on every card header and table row.

```jsx
<Dropdown trigger={<IconButton icon="more-horizontal" variant="plain" size="sm" label="Options" />}
  items={[
    { label: 'View details', icon: 'eye' },
    { label: 'Export CSV', icon: 'download' },
    { divider: true },
    { label: 'Remove card', icon: 'trash-2', tone: 'danger' },
  ]} />
```

`--shadow-popover` and a hairline border; 14px radius, not a capsule.

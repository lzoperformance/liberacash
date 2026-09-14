A selectable row — the "Your Cards" list picker. Radio dot, thumbnail, title + masked number,
overflow action.

```jsx
<RadioCard checked leading={<CardTile scheme="visa" tone="green" width={56} />}
  title="Personal" meta="•••• 8744" trailing={<IconButton icon="more-horizontal" variant="plain" size="sm" label="Options" />} />
```

Selected state is the system-wide pattern: accent-faint fill + accent border.

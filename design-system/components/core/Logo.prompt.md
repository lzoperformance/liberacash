The Libera Cash identity. Intentional addition — a wrapper so the four asset variants are used
consistently instead of hand-placed `<img>` tags.

```jsx
<Logo variant="mark" withName height={30} base="../.." />
<Logo variant="lockup" height={40} onDark base=".." />
```

`base` must point at the project root from wherever the page lives — the asset paths are
project-relative. Clear space around the lockup equals the tile's corner radius.
Never substitute a Lucide glyph or a drawn shape for the mark.

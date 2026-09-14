import React from 'react';

/* Lucide outline glyph. Renders an <i data-lucide> and lets the global lucide
   UMD script swap it for an SVG, inheriting currentColor. See readme > ICONOGRAPHY. */
export function Icon({ name, size = 20, strokeWidth = 1.75, style, ...rest }) {
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
  });
  return (
    <i
      ref={ref}
      data-lucide={name}
      aria-hidden="true"
      style={{ width: size + 'px', height: size + 'px', strokeWidth, flex: '0 0 auto', display: 'inline-block', ...style }}
      {...rest}
    />
  );
}

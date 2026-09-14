import React from 'react';

export function Breadcrumb({ items = [], style, ...rest }) {
  return (
    <nav style={{ display: 'flex', alignItems: 'center', gap: 8, flexWrap: 'wrap', ...style }} {...rest}>
      {items.map((it, i) => {
        const last = i === items.length - 1;
        const label = typeof it === 'string' ? it : it.label;
        return (
          <React.Fragment key={i}>
            {i > 0 ? <span style={{ color: 'var(--text-subtle)', font: 'var(--weight-regular) 14px/1 var(--font-ui)' }}>/</span> : null}
            <span style={{ font: 'var(--weight-' + (last ? 'semibold' : 'medium') + ') 14px/1 var(--font-display)', color: last ? 'var(--text-strong)' : 'var(--text-muted)', cursor: last ? 'default' : 'pointer' }}>{label}</span>
          </React.Fragment>
        );
      })}
    </nav>
  );
}

import React from 'react';

export function TopBar({ title, subtitle, search, actions, breadcrumb, style, ...rest }) {
  return (
    <header
      style={{
        display: 'flex', alignItems: 'center', gap: 20, flexWrap: 'wrap',
        minHeight: 'var(--topbar-height)', padding: '12px 24px',
        borderBottom: '1px solid var(--border-hairline)', background: 'var(--surface-card)',
        ...style,
      }}
      {...rest}
    >
      <div style={{ flex: 1, minWidth: 180 }}>
        {breadcrumb ? <div style={{ marginBottom: 3 }}>{breadcrumb}</div> : null}
        {title ? <h1 style={{ font: 'var(--weight-semibold) var(--text-title-3)/1.15 var(--font-display)', color: 'var(--text-strong)' }}>{title}</h1> : null}
        {subtitle ? <p style={{ font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 2 }}>{subtitle}</p> : null}
      </div>
      {search ? <div style={{ flex: '0 1 auto' }}>{search}</div> : null}
      {actions ? <div style={{ display: 'flex', alignItems: 'center', gap: 8, flex: '0 0 auto' }}>{actions}</div> : null}
    </header>
  );
}

import React from 'react';

const SURFACES = {
  card: { background: 'var(--surface-card)', boxShadow: 'var(--shadow-card)', border: '1px solid transparent' },
  hairline: { background: 'var(--surface-card)', boxShadow: 'none', border: '1px solid var(--border-hairline)' },
  tile: { background: 'var(--surface-tile)', boxShadow: 'none', border: '1px solid var(--border-hairline)' },
  sunken: { background: 'var(--surface-card-sunken)', boxShadow: 'none', border: '1px solid transparent' },
  inverse: { background: 'var(--surface-inverse)', boxShadow: 'none', border: '1px solid var(--border-inverse)' },
  accent: { background: 'var(--surface-accent-faint)', boxShadow: 'none', border: '1px solid var(--border-accent)' },
};

export function Card({
  surface = 'card', title, subtitle, action, pad = 'md', radius = 'card',
  interactive = false, selected = false, children, style, bodyStyle, ...rest
}) {
  const [hover, setHover] = React.useState(false);
  const s = selected ? SURFACES.accent : SURFACES[surface] || SURFACES.card;
  const padding = { none: 0, sm: 'var(--pad-card-sm)', md: 'var(--pad-card)', lg: 'var(--pad-card-lg)' }[pad];
  const dark = surface === 'inverse';
  return (
    <section
      onMouseEnter={interactive ? () => setHover(true) : undefined}
      onMouseLeave={interactive ? () => setHover(false) : undefined}
      style={{
        borderRadius: 'var(--radius-' + radius + ')',
        display: 'flex', flexDirection: 'column', minWidth: 0,
        transition: 'var(--transition-surface)',
        cursor: interactive ? 'pointer' : undefined,
        ...s,
        boxShadow: interactive && hover ? 'var(--shadow-raised)' : s.boxShadow,
        ...style,
      }}
      {...rest}
    >
      {(title || action) ? (
        <header style={{ display: 'flex', alignItems: 'flex-start', justifyContent: 'space-between', gap: 12, padding: padding, paddingBottom: children ? 'var(--gap-stack)' : padding }}>
          <div style={{ minWidth: 0 }}>
            {title ? <h3 style={{ font: 'var(--type-card-title)', color: dark ? 'var(--grey-0)' : 'var(--text-strong)' }}>{title}</h3> : null}
            {subtitle ? <p style={{ font: 'var(--type-caption)', color: dark ? 'var(--forest-200)' : 'var(--text-muted)', marginTop: 3 }}>{subtitle}</p> : null}
          </div>
          {action ? <div style={{ flex: '0 0 auto', display: 'flex', gap: 8, alignItems: 'center' }}>{action}</div> : null}
        </header>
      ) : null}
      {children ? (
        <div style={{ padding: padding, paddingTop: (title || action) ? 0 : padding, flex: 1, minWidth: 0, ...bodyStyle }}>{children}</div>
      ) : null}
    </section>
  );
}

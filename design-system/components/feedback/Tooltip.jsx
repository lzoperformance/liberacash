import React from 'react';

/* Two jobs: a hover hint on a control, and the chart value card. */
export function Tooltip({ title, rows = [], caption, variant = 'card', children, placement = 'top', style, ...rest }) {
  const [open, setOpen] = React.useState(false);
  const bubble = variant === 'plain'
    ? { background: 'var(--forest-800)', color: 'var(--grey-0)', padding: '7px 11px', font: 'var(--weight-medium) 12px/1.3 var(--font-ui)', border: '1px solid transparent' }
    : { background: 'var(--surface-card)', color: 'var(--text-body)', padding: '10px 12px', border: '1px solid var(--border-hairline)' };
  const pos = placement === 'top'
    ? { bottom: 'calc(100% + 8px)', left: '50%', transform: 'translateX(-50%)' }
    : { top: 'calc(100% + 8px)', left: '50%', transform: 'translateX(-50%)' };
  const content = (
    <div
      role="tooltip"
      style={{
        position: 'absolute', zIndex: 45, minWidth: 130, whiteSpace: 'nowrap',
        borderRadius: 'var(--radius-card-inner)', boxShadow: 'var(--shadow-popover)',
        ...pos, ...bubble,
      }}
    >
      {title ? <div style={{ font: variant === 'plain' ? 'inherit' : 'var(--weight-medium) 12px/1.2 var(--font-ui)', color: variant === 'plain' ? 'inherit' : 'var(--text-muted)' }}>{title}</div> : null}
      {rows.map((r, i) => (
        <div key={i} style={{ display: 'flex', justifyContent: 'space-between', gap: 18, marginTop: 5 }}>
          <span style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{r.label}</span>
          <span className="lc-numeric" style={{ font: 'var(--weight-semibold) 13px/1.2 var(--font-numeric)', color: r.tone === 'negative' ? 'var(--text-negative)' : 'var(--text-strong)' }}>{r.value}</span>
        </div>
      ))}
      {caption ? <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)', marginTop: 5 }}>{caption}</div> : null}
    </div>
  );
  if (!children) return <div style={{ position: 'relative', display: 'inline-block', ...style }} {...rest}>{content}</div>;
  return (
    <span onMouseEnter={() => setOpen(true)} onMouseLeave={() => setOpen(false)} style={{ position: 'relative', display: 'inline-flex', ...style }} {...rest}>
      {children}
      {open ? content : null}
    </span>
  );
}

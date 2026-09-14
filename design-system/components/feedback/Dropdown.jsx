import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function Dropdown({ trigger, items = [], align = 'right', onSelect, style, ...rest }) {
  const [open, setOpen] = React.useState(false);
  const [hover, setHover] = React.useState(null);
  return (
    <div style={{ position: 'relative', display: 'inline-flex', ...style }} {...rest}>
      <span onClick={() => setOpen(!open)} style={{ display: 'inline-flex', cursor: 'pointer' }}>{trigger}</span>
      {open ? (
        <>
          <span onClick={() => setOpen(false)} style={{ position: 'fixed', inset: 0, zIndex: 39 }} />
          <div
            style={{
              position: 'absolute', top: 'calc(100% + 8px)', zIndex: 40, minWidth: 190,
              left: align === 'left' ? 0 : 'auto', right: align === 'right' ? 0 : 'auto',
              background: 'var(--surface-card)', borderRadius: 'var(--radius-card-inner)',
              border: '1px solid var(--border-hairline)', boxShadow: 'var(--shadow-popover)',
              padding: 6, display: 'flex', flexDirection: 'column', gap: 1,
            }}
          >
            {items.map((it, i) => it.divider ? (
              <span key={i} style={{ height: 1, background: 'var(--border-hairline)', margin: '5px 6px' }} />
            ) : (
              <button key={i}
                onMouseEnter={() => setHover(i)} onMouseLeave={() => setHover(null)}
                onClick={() => { setOpen(false); if (onSelect) onSelect(it.value != null ? it.value : it.label); }}
                style={{
                  display: 'flex', alignItems: 'center', gap: 10, padding: '9px 11px', cursor: 'pointer',
                  borderRadius: 'var(--radius-sm)', textAlign: 'left', border: 'none',
                  background: hover === i ? 'var(--surface-hover)' : 'transparent',
                  color: it.tone === 'danger' ? 'var(--text-negative)' : 'var(--text-body)',
                  font: 'var(--weight-medium) 13px/1.3 var(--font-ui)', whiteSpace: 'nowrap',
                }}>
                {it.icon ? <Icon name={it.icon} size={16} /> : null}
                <span style={{ flex: 1 }}>{it.label}</span>
                {it.meta ? <span style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)' }}>{it.meta}</span> : null}
              </button>
            ))}
          </div>
        </>
      ) : null}
    </div>
  );
}

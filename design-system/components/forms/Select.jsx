import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function Select({ value, options = [], onSelect, size = 'sm', variant = 'outline', icon, label, style, ...rest }) {
  const [open, setOpen] = React.useState(false);
  const [hover, setHover] = React.useState(false);
  const h = size === 'md' ? 'var(--control-h)' : 'var(--control-h-sm)';
  const skins = {
    outline: { background: hover ? 'var(--surface-hover)' : 'var(--surface-card)', border: '1px solid var(--border-default)', color: 'var(--text-strong)' },
    ghost: { background: hover ? 'var(--surface-hover)' : 'transparent', border: '1px solid transparent', color: 'var(--text-muted)' },
    filled: { background: hover ? 'var(--grey-100)' : 'var(--grey-50)', border: '1px solid transparent', color: 'var(--text-strong)' },
  };
  return (
    <div style={{ position: 'relative', display: 'inline-flex', flexDirection: 'column', gap: 6, ...style }} {...rest}>
      {label ? <span style={{ font: 'var(--type-label)', color: 'var(--text-strong)' }}>{label}</span> : null}
      <button
        onClick={() => setOpen(!open)}
        onMouseEnter={() => setHover(true)}
        onMouseLeave={() => setHover(false)}
        style={{
          display: 'inline-flex', alignItems: 'center', gap: 8,
          height: h, padding: '0 12px 0 14px',
          borderRadius: 'var(--radius-control)', cursor: 'pointer',
          font: 'var(--weight-medium) 13px/1 var(--font-ui)',
          transition: 'var(--transition-control)', whiteSpace: 'nowrap',
          ...skins[variant],
        }}
      >
        {icon ? <Icon name={icon} size={16} /> : null}
        <span>{value}</span>
        <Icon name="chevron-down" size={16} style={{ transform: open ? 'rotate(180deg)' : 'none', transition: 'transform var(--duration-fast) var(--ease-out)' }} />
      </button>
      {open ? (
        <div
          style={{
            position: 'absolute', top: 'calc(100% + 6px)', right: 0, zIndex: 40, minWidth: '100%',
            background: 'var(--surface-card)', borderRadius: 'var(--radius-card-inner)',
            boxShadow: 'var(--shadow-popover)', border: '1px solid var(--border-hairline)',
            padding: 6, display: 'flex', flexDirection: 'column',
          }}
        >
          {options.map((o) => (
            <button
              key={o}
              onClick={() => { setOpen(false); if (onSelect) onSelect(o); }}
              style={{
                textAlign: 'left', padding: '8px 12px', borderRadius: 'var(--radius-sm)', cursor: 'pointer',
                background: o === value ? 'var(--surface-accent-faint)' : 'transparent',
                color: o === value ? 'var(--text-accent)' : 'var(--text-body)',
                font: 'var(--weight-medium) 13px/1.3 var(--font-ui)', whiteSpace: 'nowrap',
              }}
            >
              {o}
            </button>
          ))}
        </div>
      ) : null}
    </div>
  );
}

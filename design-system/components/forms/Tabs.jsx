import React from 'react';

export function Tabs({ items = [], value, onChange, variant = 'underline', size = 'md', style, ...rest }) {
  const cur = value != null ? value : (items[0] && (items[0].value || items[0]));
  const norm = items.map((i) => (typeof i === 'string' ? { value: i, label: i } : i));
  if (variant === 'segmented') {
    return (
      <div style={{ display: 'inline-flex', gap: 4, padding: 4, background: 'var(--grey-50)', borderRadius: 'var(--radius-pill)', ...style }} {...rest}>
        {norm.map((t) => {
          const on = t.value === cur;
          return (
            <button key={t.value} onClick={() => onChange && onChange(t.value)}
              style={{
                padding: '8px 16px', borderRadius: 'var(--radius-pill)', cursor: 'pointer',
                font: 'var(--weight-semibold) 13px/1 var(--font-ui)',
                background: on ? 'var(--surface-card)' : 'transparent',
                color: on ? 'var(--text-strong)' : 'var(--text-muted)',
                boxShadow: on ? 'var(--shadow-xs)' : 'none',
                transition: 'var(--transition-control)', whiteSpace: 'nowrap',
              }}>
              {t.label}
            </button>
          );
        })}
      </div>
    );
  }
  return (
    <div role="tablist" style={{ display: 'flex', gap: 24, borderBottom: '1px solid var(--border-hairline)', ...style }} {...rest}>
      {norm.map((t) => {
        const on = t.value === cur;
        return (
          <button key={t.value} role="tab" aria-selected={on} onClick={() => onChange && onChange(t.value)}
            style={{
              padding: size === 'sm' ? '0 0 8px' : '0 0 11px', cursor: 'pointer', background: 'transparent', border: 'none',
              borderBottom: '2px solid ' + (on ? 'var(--green-500)' : 'transparent'),
              marginBottom: -1,
              font: 'var(--weight-' + (on ? 'semibold' : 'medium') + ') ' + (size === 'sm' ? '13px' : '14px') + '/1 var(--font-ui)',
              color: on ? 'var(--text-strong)' : 'var(--text-muted)',
              transition: 'var(--transition-control)', whiteSpace: 'nowrap',
              display: 'flex', alignItems: 'baseline', gap: 5,
            }}>
            {t.label}
            {t.meta ? <span style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)' }}>{t.meta}</span> : null}
          </button>
        );
      })}
    </div>
  );
}

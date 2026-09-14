import React from 'react';

export function RadioCard({ checked = false, onChange, leading, title, meta, trailing, style, ...rest }) {
  const [hover, setHover] = React.useState(false);
  return (
    <label
      onMouseEnter={() => setHover(true)}
      onMouseLeave={() => setHover(false)}
      style={{
        display: 'flex', alignItems: 'center', gap: 12, cursor: 'pointer',
        padding: '12px 14px', borderRadius: 'var(--radius-card-inner)',
        background: checked ? 'var(--surface-accent-faint)' : hover ? 'var(--surface-hover)' : 'var(--surface-card)',
        border: '1px solid ' + (checked ? 'var(--border-accent)' : 'var(--border-hairline)'),
        transition: 'var(--transition-control)',
        ...style,
      }}
      {...rest}
    >
      <input type="radio" checked={checked} onChange={onChange} style={{ position: 'absolute', opacity: 0, width: 0, height: 0 }} />
      <span style={{ width: 18, height: 18, borderRadius: '50%', flex: '0 0 auto', display: 'grid', placeItems: 'center', border: '1px solid ' + (checked ? 'var(--forest-700)' : 'var(--border-strong)'), background: 'var(--surface-card)' }}>
        {checked ? <span style={{ width: 9, height: 9, borderRadius: '50%', background: 'var(--green-500)', boxShadow: '0 0 0 1px var(--forest-700)' }} /> : null}
      </span>
      {leading ? <span style={{ flex: '0 0 auto', display: 'flex' }}>{leading}</span> : null}
      <span style={{ flex: 1, minWidth: 0 }}>
        <span style={{ display: 'block', font: 'var(--weight-semibold) 15px/1.2 var(--font-display)', color: 'var(--text-strong)' }}>{title}</span>
        {meta ? <span style={{ display: 'block', font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 2, letterSpacing: '0.06em' }}>{meta}</span> : null}
      </span>
      {trailing ? <span style={{ flex: '0 0 auto' }}>{trailing}</span> : null}
    </label>
  );
}

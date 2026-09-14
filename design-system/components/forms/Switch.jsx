import React from 'react';

export function Switch({ checked = false, onChange, label, description, disabled = false, style, ...rest }) {
  return (
    <label style={{ display: 'flex', alignItems: description ? 'flex-start' : 'center', gap: 12, cursor: disabled ? 'not-allowed' : 'pointer', opacity: disabled ? 0.4 : 1, ...style }}>
      <input type="checkbox" role="switch" checked={checked} onChange={onChange} disabled={disabled} style={{ position: 'absolute', opacity: 0, width: 0, height: 0 }} {...rest} />
      <span
        style={{
          width: 40, height: 23, borderRadius: 'var(--radius-pill)', flex: '0 0 auto',
          background: checked ? 'var(--green-500)' : 'var(--grey-300)',
          padding: 3, display: 'flex', justifyContent: checked ? 'flex-end' : 'flex-start',
          transition: 'background-color var(--duration-base) var(--ease-out)',
          marginTop: description ? 2 : 0,
        }}
      >
        <span style={{ width: 17, height: 17, borderRadius: '50%', background: 'var(--grey-0)', boxShadow: 'var(--shadow-xs)', transition: 'transform var(--duration-base) var(--ease-out)' }} />
      </span>
      {(label || description) ? (
        <span style={{ minWidth: 0 }}>
          {label ? <span style={{ display: 'block', font: 'var(--type-label)', color: 'var(--text-strong)' }}>{label}</span> : null}
          {description ? <span style={{ display: 'block', font: 'var(--type-caption)', color: 'var(--text-muted)', marginTop: 2 }}>{description}</span> : null}
        </span>
      ) : null}
    </label>
  );
}

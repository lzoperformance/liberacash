import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function Checkbox({ checked = false, onChange, label, disabled = false, style, ...rest }) {
  return (
    <label style={{ display: 'inline-flex', alignItems: 'center', gap: 10, cursor: disabled ? 'not-allowed' : 'pointer', opacity: disabled ? 0.4 : 1, ...style }}>
      <input type="checkbox" checked={checked} onChange={onChange} disabled={disabled} style={{ position: 'absolute', opacity: 0, width: 0, height: 0 }} {...rest} />
      <span
        style={{
          width: 18, height: 18, borderRadius: 5, flex: '0 0 auto',
          display: 'grid', placeItems: 'center',
          background: checked ? 'var(--forest-800)' : 'var(--surface-card)',
          border: '1px solid ' + (checked ? 'var(--forest-800)' : 'var(--border-strong)'),
          color: 'var(--green-400)',
          transition: 'var(--transition-control)',
        }}
      >
        {checked ? <Icon name="check" size={13} style={{ strokeWidth: 3 }} /> : null}
      </span>
      {label ? <span style={{ font: 'var(--type-label)', color: 'var(--text-body)' }}>{label}</span> : null}
    </label>
  );
}

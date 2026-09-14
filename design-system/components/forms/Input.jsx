import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function Input({
  label, hint, error, icon, suffix, size = 'md', disabled = false,
  value, onChange, placeholder, type = 'text', id, style, ...rest
}) {
  const [focus, setFocus] = React.useState(false);
  const h = size === 'lg' ? 'var(--control-h-lg)' : size === 'sm' ? 'var(--control-h-sm)' : 'var(--control-h)';
  const border = error ? 'var(--red-500)' : focus ? 'var(--border-focus)' : 'var(--border-default)';
  return (
    <label htmlFor={id} style={{ display: 'flex', flexDirection: 'column', gap: 6, minWidth: 0, ...style }}>
      {label ? <span style={{ font: 'var(--type-label)', color: 'var(--text-strong)' }}>{label}</span> : null}
      <span
        style={{
          display: 'flex', alignItems: 'center', gap: 10,
          height: h, padding: '0 14px',
          background: disabled ? 'var(--grey-50)' : 'var(--surface-card)',
          border: '1px solid ' + border,
          borderRadius: 'var(--radius-field)',
          boxShadow: focus ? 'var(--ring-focus)' : 'none',
          transition: 'var(--transition-control)',
          opacity: disabled ? 0.55 : 1,
          color: 'var(--text-muted)',
        }}
      >
        {icon ? <Icon name={icon} size={18} /> : null}
        <input
          id={id} type={type} value={value} onChange={onChange} placeholder={placeholder} disabled={disabled}
          onFocus={() => setFocus(true)} onBlur={() => setFocus(false)}
          style={{
            flex: 1, minWidth: 0, border: 'none', outline: 'none', background: 'transparent',
            font: 'var(--weight-regular) 14px/1 var(--font-ui)', color: 'var(--text-strong)',
          }}
          {...rest}
        />
        {suffix ? <span style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)', flex: '0 0 auto' }}>{suffix}</span> : null}
      </span>
      {(hint || error) ? (
        <span style={{ font: 'var(--type-caption)', color: error ? 'var(--text-negative)' : 'var(--text-subtle)' }}>{error || hint}</span>
      ) : null}
    </label>
  );
}

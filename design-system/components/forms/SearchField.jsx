import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function SearchField({ placeholder = 'Search anything', shortcut = ['⌘', 'F'], value, onChange, width, style, ...rest }) {
  const [focus, setFocus] = React.useState(false);
  return (
    <div
      style={{
        display: 'flex', alignItems: 'center', gap: 10,
        height: 'var(--control-h)', padding: '0 8px 0 14px', width,
        background: 'var(--surface-card)',
        border: '1px solid ' + (focus ? 'var(--border-focus)' : 'var(--border-default)'),
        borderRadius: 'var(--radius-control)',
        boxShadow: focus ? 'var(--ring-focus)' : 'none',
        transition: 'var(--transition-control)', color: 'var(--text-subtle)',
        ...style,
      }}
    >
      <Icon name="search" size={18} />
      <input
        value={value} onChange={onChange} placeholder={placeholder}
        onFocus={() => setFocus(true)} onBlur={() => setFocus(false)}
        style={{ flex: 1, minWidth: 0, border: 'none', outline: 'none', background: 'transparent', font: 'var(--weight-regular) 14px/1 var(--font-ui)', color: 'var(--text-strong)' }}
        {...rest}
      />
      {shortcut && shortcut.length ? (
        <span style={{ display: 'flex', gap: 4, flex: '0 0 auto' }}>
          {shortcut.map((k) => (
            <kbd key={k} style={{ font: 'var(--weight-medium) 11px/1 var(--font-tabular)', color: 'var(--text-muted)', background: 'var(--grey-50)', border: '1px solid var(--border-hairline)', borderRadius: 6, padding: '5px 7px' }}>{k}</kbd>
          ))}
        </span>
      ) : null}
    </div>
  );
}

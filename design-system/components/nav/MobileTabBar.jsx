import React from 'react';
import { Icon } from '../core/Icon.jsx';

export function MobileTabBar({ items = [], active, onNavigate, style, ...rest }) {
  return (
    <nav
      style={{
        display: 'flex', alignItems: 'stretch', gap: 2,
        minHeight: 'var(--mobile-tabbar-height)',
        padding: '8px 10px calc(8px + env(safe-area-inset-bottom))',
        background: 'rgba(255,255,255,.88)', backdropFilter: 'blur(12px)',
        WebkitBackdropFilter: 'blur(12px)',
        borderTop: '1px solid var(--border-hairline)',
        ...style,
      }}
      {...rest}
    >
      {items.map((it) => {
        const on = it.value === active;
        return (
          <button key={it.value} onClick={() => onNavigate && onNavigate(it.value)}
            style={{
              flex: 1, minWidth: 0, minHeight: 'var(--touch-min)', cursor: 'pointer',
              display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', gap: 4,
              background: 'transparent', border: 'none', borderRadius: 'var(--radius-card-inner)',
              color: on ? 'var(--text-strong)' : 'var(--text-subtle)',
              transition: 'var(--transition-control)',
            }}>
            <span style={{ display: 'grid', placeItems: 'center', width: 42, height: 26, borderRadius: 'var(--radius-pill)', background: on ? 'var(--surface-accent-soft)' : 'transparent', transition: 'var(--transition-control)' }}>
              <Icon name={it.icon} size={19} />
            </span>
            <span style={{ font: 'var(--weight-' + (on ? 'semibold' : 'medium') + ') 10px/1 var(--font-ui)' }}>{it.label}</span>
          </button>
        );
      })}
    </nav>
  );
}

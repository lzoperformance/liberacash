import React from 'react';
import { Icon } from '../core/Icon.jsx';
import { Button } from '../core/Button.jsx';

export function UpgradeCard({
  title = 'Upgrade plan',
  body = '“Upgrade Libera Cash today to unlock smarter insights and financial control.”',
  cta = 'Upgrade your Plan', icon = 'layers', onAction, style, ...rest
}) {
  return (
    <div
      style={{
        background: 'var(--surface-card)', border: '1px solid var(--border-hairline)',
        borderRadius: 'var(--radius-card)', boxShadow: 'var(--shadow-xs)',
        padding: 'var(--pad-card)', textAlign: 'center',
        display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 8, ...style,
      }}
      {...rest}
    >
      <span style={{ width: 40, height: 40, borderRadius: '50%', display: 'grid', placeItems: 'center', background: 'var(--surface-accent-faint)', color: 'var(--forest-700)' }}>
        <Icon name={icon} size={20} />
      </span>
      <h4 style={{ font: 'var(--weight-semibold) 15px/1.2 var(--font-display)', color: 'var(--text-strong)' }}>{title}</h4>
      <p style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{body}</p>
      <Button variant="dark" size="sm" glyph="↗" fullWidth onClick={onAction} style={{ marginTop: 4 }}>{cta}</Button>
    </div>
  );
}

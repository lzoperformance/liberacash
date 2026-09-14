import React from 'react';
import { Icon } from '../core/Icon.jsx';
import { Badge } from '../core/Badge.jsx';

export function StatCard({ label, value, delta, deltaTone = 'success', icon, surface = 'hairline', action, footer, style, ...rest }) {
  const skins = {
    hairline: { background: 'var(--surface-card)', border: '1px solid var(--border-hairline)', boxShadow: 'none' },
    card: { background: 'var(--surface-card)', border: '1px solid transparent', boxShadow: 'var(--shadow-card)' },
    tile: { background: 'var(--surface-tile)', border: '1px solid var(--border-hairline)', boxShadow: 'none' },
    accent: { background: 'var(--surface-accent-faint)', border: '1px solid var(--border-accent)', boxShadow: 'none' },
  };
  return (
    <div
      style={{
        display: 'flex', flexDirection: 'column', gap: 10, minWidth: 0,
        padding: 'var(--pad-card-sm)', borderRadius: 'var(--radius-card-inner)',
        ...(skins[surface] || skins.hairline), ...style,
      }}
      {...rest}
    >
      <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 8 }}>
        <span style={{ display: 'flex', alignItems: 'center', gap: 8, minWidth: 0 }}>
          {icon ? (
            <span style={{ width: 28, height: 28, borderRadius: '50%', flex: '0 0 auto', display: 'grid', placeItems: 'center', background: 'var(--surface-accent-faint)', color: 'var(--forest-700)' }}>
              <Icon name={icon} size={15} />
            </span>
          ) : null}
          <span style={{ font: 'var(--type-label)', color: 'var(--text-muted)', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{label}</span>
        </span>
        {action ? <span style={{ flex: '0 0 auto' }}>{action}</span> : null}
      </div>
      <div style={{ display: 'flex', alignItems: 'baseline', gap: 8, flexWrap: 'wrap' }}>
        <span className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-2)/1.05 var(--font-numeric)', color: 'var(--text-strong)' }}>{value}</span>
        {delta ? <Badge tone={deltaTone} size="sm" delta={delta} /> : null}
      </div>
      {footer ? <div style={{ font: 'var(--type-caption)', color: 'var(--text-subtle)' }}>{footer}</div> : null}
    </div>
  );
}

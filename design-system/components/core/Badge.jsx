import React from 'react';
import { Icon } from './Icon.jsx';

const TONES = {
  success: { color: 'var(--status-success-fg)', background: 'var(--status-success-bg)' },
  pending: { color: 'var(--status-pending-fg)', background: 'var(--status-pending-bg)' },
  warning: { color: 'var(--status-warning-fg)', background: 'var(--status-warning-bg)' },
  neutral: { color: 'var(--status-neutral-fg)', background: 'var(--status-neutral-bg)' },
  accent: { color: 'var(--forest-800)', background: 'var(--green-200)' },
  dark: { color: 'var(--grey-0)', background: 'var(--forest-800)' },
};

export function Badge({ tone = 'neutral', size = 'md', icon, delta, children, style, ...rest }) {
  const t = TONES[tone] || TONES.neutral;
  const small = size === 'sm';
  return (
    <span
      style={{
        display: 'inline-flex', alignItems: 'center', gap: 4,
        padding: small ? '3px 8px' : '5px 11px',
        borderRadius: 'var(--radius-badge)',
        font: 'var(--weight-semibold) ' + (small ? '11px' : '12px') + '/1.2 var(--font-ui)',
        whiteSpace: 'nowrap', ...t, ...style,
      }}
      {...rest}
    >
      {icon ? <Icon name={icon} size={small ? 12 : 14} /> : null}
      {delta ? <span style={{ fontFamily: 'var(--font-tabular)' }}>{delta}</span> : null}
      {children}
    </span>
  );
}

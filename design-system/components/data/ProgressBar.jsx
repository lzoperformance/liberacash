import React from 'react';

export function ProgressBar({ value = 0, tone = 'accent', height = 8, track = 'soft', label, caption, style, ...rest }) {
  const pct = Math.max(0, Math.min(100, value));
  const fills = {
    accent: 'var(--green-500)',
    dark: 'var(--forest-800)',
    split: 'linear-gradient(90deg,var(--forest-800) 0 60%,var(--green-500) 60% 100%)',
  };
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 7, minWidth: 0, ...style }} {...rest}>
      {(label || caption) ? (
        <div style={{ display: 'flex', justifyContent: 'space-between', gap: 10, alignItems: 'baseline' }}>
          {label ? <span style={{ font: 'var(--type-label)', color: 'var(--text-strong)' }}>{label}</span> : null}
          {caption ? <span style={{ font: 'var(--type-caption)', color: 'var(--text-muted)', fontFamily: 'var(--font-tabular)' }}>{caption}</span> : null}
        </div>
      ) : null}
      <div style={{ height, borderRadius: 'var(--radius-pill)', background: track === 'soft' ? 'var(--green-100)' : 'var(--grey-150)', overflow: 'hidden' }}>
        <div style={{ width: pct + '%', height: '100%', borderRadius: 'var(--radius-pill)', background: fills[tone] || fills.accent, transition: 'width var(--duration-chart) var(--ease-out)' }} />
      </div>
    </div>
  );
}

import React from 'react';

/* The hero balance card: --gradient-hero plus the blurred ribbon motif.
   The one decorative element in the system (readme > VISUAL FOUNDATIONS > Backgrounds). */
export function BalanceCard({ label = 'Total Balance', amount, currency, actions, note, height, style, ...rest }) {
  return (
    <div
      style={{
        position: 'relative', overflow: 'hidden', minWidth: 0, height,
        borderRadius: 'var(--radius-card)', background: 'var(--gradient-hero)',
        padding: 'var(--pad-card)', display: 'flex', flexDirection: 'column',
        justifyContent: 'space-between', gap: 20, ...style,
      }}
      {...rest}
    >
      <div aria-hidden="true" style={{ position: 'absolute', top: '-42%', right: '-14%', width: 300, height: 300, borderRadius: '50%', border: '30px solid rgba(255,255,255,.22)', filter: 'blur(7px)', pointerEvents: 'none' }} />
      <div aria-hidden="true" style={{ position: 'absolute', bottom: '-52%', left: '-18%', width: 270, height: 270, borderRadius: '50%', border: '24px solid rgba(255,255,255,.18)', filter: 'blur(6px)', pointerEvents: 'none' }} />
      <div aria-hidden="true" style={{ position: 'absolute', top: '18%', right: '22%', width: 150, height: 150, borderRadius: '50%', border: '16px solid rgba(255,255,255,.14)', filter: 'blur(8px)', pointerEvents: 'none' }} />
      <div style={{ position: 'relative' }}>
        <div style={{ font: 'var(--weight-medium) 14px/1.2 var(--font-ui)', color: 'var(--forest-800)' }}>{label}</div>
        <div className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-hero)/1.05 var(--font-numeric)', color: 'var(--forest-900)', marginTop: 3, display: 'flex', alignItems: 'baseline', gap: 8, flexWrap: 'wrap' }}>
          {amount}
          {currency ? <span style={{ font: 'var(--weight-medium) 17px/1 var(--font-ui)', color: 'var(--forest-700)' }}>{currency}</span> : null}
        </div>
        {note ? <div style={{ font: 'var(--type-caption)', color: 'var(--forest-700)', marginTop: 6 }}>{note}</div> : null}
      </div>
      {actions ? <div style={{ position: 'relative', display: 'flex', gap: 10, flexWrap: 'wrap' }}>{actions}</div> : null}
    </div>
  );
}

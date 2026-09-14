import React from 'react';

/* Ring chart drawn with conic-gradient. Centre slot carries the label + total. */
export function DonutChart({ segments = [], size = 180, thickness = 26, label, value, style, ...rest }) {
  const total = segments.reduce((s, x) => s + (x.value || 0), 0) || 1;
  let acc = 0;
  const stops = segments.map((s) => {
    const from = (acc / total) * 360;
    acc += s.value || 0;
    const to = (acc / total) * 360;
    return (s.color || 'var(--chart-series-2)') + ' ' + from + 'deg ' + to + 'deg';
  }).join(',');
  return (
    <div style={{ position: 'relative', width: size, height: size, flex: '0 0 auto', ...style }} {...rest}>
      <div style={{ width: '100%', height: '100%', borderRadius: '50%', background: 'conic-gradient(from -90deg,' + stops + ')' }} />
      <div style={{ position: 'absolute', inset: thickness, borderRadius: '50%', background: 'var(--surface-card)', boxShadow: '0 0 0 4px var(--surface-card)', display: 'grid', placeItems: 'center', textAlign: 'center', padding: 8 }}>
        <div>
          {label ? <div style={{ font: 'var(--type-caption)', color: 'var(--text-muted)' }}>{label}</div> : null}
          {value ? <div className="lc-numeric" style={{ font: 'var(--weight-bold) var(--text-figure-2)/1.1 var(--font-numeric)', color: 'var(--text-strong)' }}>{value}</div> : null}
        </div>
      </div>
    </div>
  );
}

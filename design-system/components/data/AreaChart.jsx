import React from 'react';

/* Smooth single- or dual-series area chart. SVG path, --chart-area-fill under the line. */
function path(points, w, h, max, min) {
  const span = max - min || 1;
  const step = points.length > 1 ? w / (points.length - 1) : w;
  const pts = points.map((v, i) => [i * step, h - ((v - min) / span) * h]);
  let d = 'M ' + pts[0][0] + ' ' + pts[0][1];
  for (let i = 0; i < pts.length - 1; i++) {
    const [x0, y0] = pts[i], [x1, y1] = pts[i + 1];
    const cx = (x0 + x1) / 2;
    d += ' C ' + cx + ' ' + y0 + ', ' + cx + ' ' + y1 + ', ' + x1 + ' ' + y1;
  }
  return { d, pts };
}

export function AreaChart({
  series = [], compare, height = 180, yTicks = [], xLabels = [], marker,
  fill = true, style, ...rest
}) {
  const W = 600, H = height - (xLabels.length ? 22 : 0);
  const all = series.concat(compare || []);
  const max = Math.max(...all, 1), min = Math.min(...all, 0);
  const main = series.length ? path(series, W, H, max, min) : null;
  const cmp = compare && compare.length ? path(compare, W, H, max, min) : null;
  const mk = main && marker != null && main.pts[marker] ? main.pts[marker] : null;
  return (
    <div style={{ display: 'flex', gap: 10, minWidth: 0, ...style }} {...rest}>
      {yTicks.length ? (
        <div style={{ display: 'flex', flexDirection: 'column', justifyContent: 'space-between', height: H, font: 'var(--weight-medium) 10px/1 var(--font-tabular)', color: 'var(--chart-axis-label)', flex: '0 0 auto', textAlign: 'right' }}>
          {yTicks.map((t) => <span key={t}>{t}</span>)}
        </div>
      ) : null}
      <div style={{ flex: 1, minWidth: 0 }}>
        <svg viewBox={'0 0 ' + W + ' ' + H} preserveAspectRatio="none" style={{ width: '100%', height: H, display: 'block', overflow: 'visible' }}>
          <defs>
            <linearGradient id="lcAreaFill" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stopColor="var(--green-500)" stopOpacity="0.28" />
              <stop offset="100%" stopColor="var(--green-500)" stopOpacity="0" />
            </linearGradient>
          </defs>
          {cmp ? <path d={cmp.d} fill="none" stroke="var(--chart-series-1)" strokeWidth="2.5" strokeLinecap="round" vectorEffect="non-scaling-stroke" /> : null}
          {main && fill ? <path d={main.d + ' L ' + W + ' ' + H + ' L 0 ' + H + ' Z'} fill="url(#lcAreaFill)" stroke="none" /> : null}
          {main ? <path d={main.d} fill="none" stroke="var(--chart-series-2)" strokeWidth="2.5" strokeLinecap="round" vectorEffect="non-scaling-stroke" /> : null}
          {mk ? <line x1={mk[0]} y1="0" x2={mk[0]} y2={H} stroke="var(--green-500)" strokeWidth="1.5" strokeDasharray="4 4" vectorEffect="non-scaling-stroke" /> : null}
        </svg>
        {mk ? (
          <div style={{ position: 'relative', height: 0 }}>
            <span style={{ position: 'absolute', left: (mk[0] / W) * 100 + '%', top: -H + mk[1] - 5, width: 10, height: 10, borderRadius: '50%', background: 'var(--green-500)', border: '2px solid var(--grey-0)', boxShadow: 'var(--shadow-sm)', transform: 'translateX(-50%)' }} />
          </div>
        ) : null}
        {xLabels.length ? (
          <div style={{ display: 'flex', justifyContent: 'space-between', marginTop: 8, font: 'var(--weight-medium) 10px/1 var(--font-tabular)', color: 'var(--chart-axis-label)' }}>
            {xLabels.map((l, i) => <span key={i}>{l}</span>)}
          </div>
        ) : null}
      </div>
    </div>
  );
}

import React from 'react';

/* Diverging two-series column chart: series A grows up from the zero line,
   series B down. The reference's Cashflow card. Pure CSS, no chart library. */
export function BarChart({
  data = [], height = 200, labels = ['Income', 'Expense'],
  highlight, onHighlight, showLegend = true, showAxis = true, style, ...rest
}) {
  const max = Math.max(1, ...data.map((d) => Math.max(d.a || 0, d.b || 0)));
  const half = (height - (showAxis ? 22 : 0)) / 2;
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: 12, minWidth: 0, ...style }} {...rest}>
      {showLegend ? (
        <div style={{ display: 'flex', gap: 16, justifyContent: 'flex-end' }}>
          {[['var(--chart-series-1)', labels[0]], ['var(--chart-series-2)', labels[1]]].map(([c, l]) => (
            <span key={l} style={{ display: 'inline-flex', alignItems: 'center', gap: 6, font: 'var(--type-caption)', color: 'var(--text-muted)' }}>
              <span style={{ width: 9, height: 9, borderRadius: 2, background: c }} />{l}
            </span>
          ))}
        </div>
      ) : null}
      <div style={{ display: 'flex', alignItems: 'stretch', gap: 8, minWidth: 0 }}>
        {showAxis ? (
          <div style={{ display: 'flex', flexDirection: 'column', justifyContent: 'space-between', height: half * 2, font: 'var(--weight-medium) 10px/1 var(--font-tabular)', color: 'var(--chart-axis-label)', flex: '0 0 auto', textAlign: 'right' }}>
            <span>8K</span><span>4K</span><span>0</span><span>-4K</span><span>-8K</span>
          </div>
        ) : null}
        <div style={{ flex: 1, minWidth: 0 }}>
          <div style={{ position: 'relative', height: half * 2, display: 'flex', alignItems: 'center', gap: 'clamp(3px,0.8%,10px)' }}>
            <div style={{ position: 'absolute', left: 0, right: 0, top: '50%', height: 1, background: 'var(--chart-grid)' }} />
            {data.map((d, i) => {
              const on = highlight === i;
              return (
                <div key={i}
                  onMouseEnter={() => onHighlight && onHighlight(i)}
                  onMouseLeave={() => onHighlight && onHighlight(null)}
                  style={{ flex: 1, minWidth: 0, height: '100%', display: 'flex', flexDirection: 'column', justifyContent: 'center', cursor: onHighlight ? 'pointer' : 'default', position: 'relative' }}>
                  <div style={{ height: half, display: 'flex', alignItems: 'flex-end' }}>
                    <div style={{ width: '100%', height: ((d.a || 0) / max) * half, background: 'var(--chart-series-1)', borderRadius: '5px 5px 0 0', opacity: highlight == null || on ? 1 : 0.45, transition: 'opacity var(--duration-fast) var(--ease-out), height var(--duration-chart) var(--ease-out)' }} />
                  </div>
                  <div style={{ height: half, display: 'flex', alignItems: 'flex-start' }}>
                    <div style={{ width: '100%', height: ((d.b || 0) / max) * half, background: 'var(--chart-series-2)', borderRadius: '0 0 5px 5px', opacity: highlight == null || on ? 1 : 0.45, transition: 'opacity var(--duration-fast) var(--ease-out), height var(--duration-chart) var(--ease-out)' }} />
                  </div>
                </div>
              );
            })}
          </div>
          {showAxis ? (
            <div style={{ display: 'flex', gap: 'clamp(3px,0.8%,10px)', marginTop: 8 }}>
              {data.map((d, i) => (
                <span key={i} style={{ flex: 1, textAlign: 'center', font: 'var(--weight-medium) 10px/1 var(--font-tabular)', color: highlight === i ? 'var(--text-strong)' : 'var(--chart-axis-label)', overflow: 'hidden' }}>{d.label}</span>
              ))}
            </div>
          ) : null}
        </div>
      </div>
    </div>
  );
}

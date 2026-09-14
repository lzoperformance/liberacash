import React from 'react';

/* Miniature payment-card thumbnail used in card pickers and wallet lists.
   Not a real card rendering — a 1.58:1 chip with a scheme wordmark. */
const TONES = {
  green: { background: 'linear-gradient(135deg,#9AE472 0%,#6BCE52 100%)', color: 'var(--forest-800)' },
  dark: { background: 'linear-gradient(135deg,#16562D 0%,#07231A 100%)', color: 'var(--grey-0)' },
  grey: { background: 'linear-gradient(135deg,#BFBFBF 0%,#8A8A8A 100%)', color: 'var(--grey-0)' },
};

export function CardTile({ scheme = 'visa', tone = 'green', width = 56, style, ...rest }) {
  const t = TONES[tone] || TONES.green;
  const h = Math.round(width / 1.58);
  return (
    <span
      style={{
        width, height: h, borderRadius: Math.max(4, Math.round(width * 0.09)),
        display: 'flex', alignItems: 'flex-start', justifyContent: 'flex-start',
        padding: Math.round(width * 0.08), flex: '0 0 auto', overflow: 'hidden',
        boxShadow: 'var(--shadow-xs)', ...t, ...style,
      }}
      {...rest}
    >
      {scheme === 'visa' ? (
        <span style={{ font: 'var(--weight-bold) ' + Math.round(width * 0.16) + 'px/1 var(--font-display)', letterSpacing: '0.02em', fontStyle: 'italic' }}>VISA</span>
      ) : scheme === 'mastercard' ? (
        <span style={{ display: 'flex' }}>
          <span style={{ width: Math.round(width * 0.16), height: Math.round(width * 0.16), borderRadius: '50%', background: 'currentColor', opacity: 0.95 }} />
          <span style={{ width: Math.round(width * 0.16), height: Math.round(width * 0.16), borderRadius: '50%', background: 'currentColor', opacity: 0.55, marginLeft: Math.round(width * -0.06) }} />
        </span>
      ) : null}
    </span>
  );
}

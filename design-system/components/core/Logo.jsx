import React from 'react';

const ASSETS = {
  lockup: 'assets/logo-lockup.png',
  mark: 'assets/logo-mark.png',
  wordmark: 'assets/logo-wordmark.png',
  lockupOnDark: 'assets/logo-lockup-on-dark.png',
};

export function Logo({ variant = 'lockup', height = 32, base = '', withName = false, onDark = false, style, ...rest }) {
  const key = variant === 'lockup' && onDark ? 'lockupOnDark' : variant;
  const src = (base ? base.replace(/\/$/, '') + '/' : '') + ASSETS[key];
  if (variant === 'mark' && withName) {
    return (
      <span style={{ display: 'inline-flex', alignItems: 'center', gap: 10, ...style }} {...rest}>
        <img src={src} alt="" style={{ height, width: height, borderRadius: 'calc(' + height + 'px * 0.28)' }} />
        <span style={{ font: 'var(--weight-semibold) ' + Math.round(height * 0.62) + 'px/1 var(--font-display)', letterSpacing: 'var(--tracking-tight)', color: onDark ? 'var(--grey-0)' : 'var(--forest-800)' }}>
          Libera<span style={{ color: 'var(--green-500)' }}>Cash</span>
        </span>
      </span>
    );
  }
  return <img src={src} alt="Libera Cash" style={{ height, width: 'auto', display: 'block', ...style }} {...rest} />;
}

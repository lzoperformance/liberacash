import React from 'react';

const SIZES = { xs: 24, sm: 32, md: 40, lg: 48 };

export function Avatar({ src, name = '', size = 'md', ring = false, status, style, ...rest }) {
  const px = typeof size === 'number' ? size : SIZES[size] || 40;
  const initials = name.split(' ').filter(Boolean).slice(0, 2).map((w) => w[0]).join('').toUpperCase();
  return (
    <span style={{ position: 'relative', display: 'inline-flex', flex: '0 0 auto', ...style }} {...rest}>
      <span
        style={{
          width: px, height: px, borderRadius: 'var(--radius-avatar)', overflow: 'hidden',
          display: 'grid', placeItems: 'center',
          background: 'var(--forest-100)', color: 'var(--forest-700)',
          font: 'var(--weight-semibold) ' + Math.round(px * 0.36) + 'px/1 var(--font-ui)',
          boxShadow: ring ? '0 0 0 2px var(--grey-0), 0 0 0 3px var(--green-400)' : 'none',
        }}
      >
        {src ? <img src={src} alt={name} style={{ width: '100%', height: '100%', objectFit: 'cover' }} /> : initials}
      </span>
      {status ? (
        <span style={{
          position: 'absolute', right: -1, bottom: -1,
          width: Math.max(8, px * 0.26), height: Math.max(8, px * 0.26), borderRadius: '50%',
          background: status === 'online' ? 'var(--green-500)' : 'var(--grey-400)',
          border: '2px solid var(--grey-0)',
        }} />
      ) : null}
    </span>
  );
}

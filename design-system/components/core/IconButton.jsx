import React from 'react';
import { Icon } from './Icon.jsx';

const SIZES = { sm: 32, md: 40, lg: 48, xl: 56 };
const GLYPH = { sm: 16, md: 20, lg: 22, xl: 26 };

export function IconButton({ icon, variant = 'tile', size = 'md', label, active = false, disabled = false, style, ...rest }) {
  const [hover, setHover] = React.useState(false);
  const px = SIZES[size] || SIZES.md;
  const skins = {
    tile: { background: hover ? 'var(--grey-0)' : 'var(--surface-tile)', border: '1px solid var(--border-hairline)', color: 'var(--forest-800)' },
    plain: { background: hover ? 'var(--surface-hover)' : 'transparent', border: '1px solid transparent', color: 'var(--text-muted)' },
    solid: { background: hover ? 'var(--forest-700)' : 'var(--forest-800)', border: '1px solid transparent', color: 'var(--grey-0)' },
    accent: { background: hover ? 'var(--green-600)' : 'var(--green-500)', border: '1px solid transparent', color: 'var(--forest-800)' },
    onAccent: { background: 'var(--grey-0)', border: '1px solid transparent', color: 'var(--forest-800)' },
  };
  const skin = active ? { background: 'var(--surface-accent-faint)', border: '1px solid var(--border-accent)', color: 'var(--forest-700)' } : skins[variant] || skins.tile;
  return (
    <button
      aria-label={label}
      disabled={disabled}
      onMouseEnter={() => setHover(true)}
      onMouseLeave={() => setHover(false)}
      style={{
        width: px, height: px, minWidth: px,
        display: 'inline-grid', placeItems: 'center',
        borderRadius: 'var(--radius-control)',
        cursor: disabled ? 'not-allowed' : 'pointer',
        opacity: disabled ? 0.4 : 1,
        transition: 'var(--transition-control)',
        ...skin, ...style,
      }}
      {...rest}
    >
      <Icon name={icon} size={GLYPH[size] || 20} />
    </button>
  );
}

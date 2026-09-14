import React from 'react';
import { Icon } from './Icon.jsx';

function useInteractive() {
  const [hover, setHover] = React.useState(false);
  const [press, setPress] = React.useState(false);
  return {
    hover, press,
    bind: {
      onMouseEnter: () => setHover(true),
      onMouseLeave: () => { setHover(false); setPress(false); },
      onMouseDown: () => setPress(true),
      onMouseUp: () => setPress(false),
    },
  };
}

const SIZES = {
  sm: { height: 'var(--control-h-sm)', padding: '0 14px', font: 'var(--weight-semibold) 13px/1 var(--font-ui)', icon: 16 },
  md: { height: 'var(--control-h)', padding: '0 20px', font: 'var(--weight-semibold) 14px/1 var(--font-ui)', icon: 18 },
  lg: { height: 'var(--control-h-lg)', padding: '0 28px', font: 'var(--weight-semibold) 15px/1 var(--font-ui)', icon: 20 },
};

function skin(variant, hover) {
  switch (variant) {
    case 'dark':
      return { background: hover ? 'var(--forest-700)' : 'var(--forest-800)', color: 'var(--text-on-dark)', border: '1px solid transparent' };
    case 'secondary':
      return { background: hover ? 'var(--surface-hover)' : 'var(--surface-card)', color: 'var(--text-strong)', border: '1px solid var(--border-default)' };
    case 'ghost':
      return { background: hover ? 'var(--surface-hover)' : 'transparent', color: 'var(--text-strong)', border: '1px solid transparent' };
    case 'onAccent':
      return { background: hover ? 'var(--grey-50)' : 'var(--grey-0)', color: 'var(--forest-800)', border: '1px solid transparent' };
    case 'danger':
      return { background: hover ? 'var(--red-600)' : 'var(--red-500)', color: 'var(--grey-0)', border: '1px solid transparent' };
    default:
      return { background: hover ? 'var(--green-600)' : 'var(--green-500)', color: 'var(--text-on-accent)', border: '1px solid transparent' };
  }
}

export function Button({
  variant = 'primary', size = 'md', icon, iconAfter, glyph,
  fullWidth = false, disabled = false, href, children, style, ...rest
}) {
  const { hover, press, bind } = useInteractive();
  const s = SIZES[size] || SIZES.md;
  const Tag = href ? 'a' : 'button';
  return (
    <Tag
      href={href}
      disabled={Tag === 'button' ? disabled : undefined}
      {...bind}
      style={{
        display: fullWidth ? 'flex' : 'inline-flex',
        width: fullWidth ? '100%' : undefined,
        alignItems: 'center', justifyContent: 'center', gap: 'var(--gap-inline)',
        height: s.height, padding: s.padding, font: s.font,
        borderRadius: 'var(--radius-control)',
        letterSpacing: 'var(--tracking-normal)',
        cursor: disabled ? 'not-allowed' : 'pointer',
        opacity: disabled ? 0.4 : 1,
        textDecoration: 'none', whiteSpace: 'nowrap',
        transform: press && !disabled ? 'scale(var(--press-scale))' : 'none',
        transition: 'var(--transition-control), transform var(--duration-instant) var(--ease-out)',
        boxShadow: variant === 'primary' && hover && !disabled ? 'var(--shadow-accent)' : 'none',
        ...skin(variant, hover && !disabled),
        ...style,
      }}
      {...rest}
    >
      {icon ? <Icon name={icon} size={s.icon} /> : null}
      <span>{children}</span>
      {glyph ? <span style={{ fontSize: '1.05em', lineHeight: 1 }}>{glyph}</span> : null}
      {iconAfter ? <Icon name={iconAfter} size={s.icon} /> : null}
    </Tag>
  );
}

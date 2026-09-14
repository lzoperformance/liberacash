import React from 'react';
import { Icon } from '../core/Icon.jsx';
import { Logo } from '../core/Logo.jsx';
import { Avatar } from '../core/Avatar.jsx';

export function SidebarItem({ icon, label, active = false, onClick, style, ...rest }) {
  const [hover, setHover] = React.useState(false);
  return (
    <button
      onClick={onClick}
      onMouseEnter={() => setHover(true)}
      onMouseLeave={() => setHover(false)}
      style={{
        display: 'flex', alignItems: 'center', gap: 12, width: '100%',
        minHeight: 42, padding: '0 14px', cursor: 'pointer', textAlign: 'left',
        borderRadius: 'var(--radius-card-inner)', border: '1px solid ' + (active ? 'var(--border-hairline)' : 'transparent'),
        background: active ? 'var(--surface-card)' : hover ? 'var(--grey-100)' : 'transparent',
        color: active ? 'var(--text-strong)' : 'var(--text-muted)',
        font: 'var(--weight-' + (active ? 'semibold' : 'medium') + ') 14px/1 var(--font-ui)',
        boxShadow: active ? 'var(--shadow-xs)' : 'none',
        transition: 'var(--transition-control)',
        ...style,
      }}
      {...rest}
    >
      <Icon name={icon} size={19} />
      <span style={{ flex: 1, minWidth: 0, overflow: 'hidden', textOverflow: 'ellipsis' }}>{label}</span>
    </button>
  );
}

export function Sidebar({
  sections = [], active, onNavigate, account, footer, base = '', width, style, ...rest
}) {
  return (
    <nav
      style={{
        width: width || 'var(--sidebar-width)', flex: '0 0 auto',
        background: 'var(--surface-page)', borderRight: '1px solid var(--border-hairline)',
        display: 'flex', flexDirection: 'column', gap: 18, padding: 16, minHeight: 0,
        ...style,
      }}
      {...rest}
    >
      <div style={{ padding: '4px 6px 0' }}>
        <Logo variant="mark" withName height={30} base={base} />
      </div>

      {account ? (
        <button
          style={{
            display: 'flex', alignItems: 'center', gap: 10, width: '100%', padding: '9px 11px', cursor: 'pointer',
            background: 'var(--surface-card)', border: '1px solid var(--border-hairline)',
            borderRadius: 'var(--radius-card-inner)', boxShadow: 'var(--shadow-xs)', textAlign: 'left',
          }}
        >
          <Avatar name={account.name} size="sm" />
          <span style={{ flex: 1, minWidth: 0 }}>
            <span style={{ display: 'block', font: 'var(--weight-semibold) 13px/1.2 var(--font-ui)', color: 'var(--text-strong)', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{account.name}</span>
            <span style={{ display: 'block', font: 'var(--type-caption)', color: 'var(--text-muted)', overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>{account.role}</span>
          </span>
          <Icon name="chevron-down" size={16} style={{ color: 'var(--text-subtle)' }} />
        </button>
      ) : null}

      <div style={{ flex: 1, minHeight: 0, overflowY: 'auto', display: 'flex', flexDirection: 'column', gap: 18 }}>
        {sections.map((s, si) => (
          <div key={si} style={{ display: 'flex', flexDirection: 'column', gap: 3 }}>
            {s.label ? <span className="lc-eyebrow" style={{ padding: '0 14px 6px' }}>{s.label}</span> : null}
            {s.items.map((it) => (
              <SidebarItem key={it.value} icon={it.icon} label={it.label}
                active={it.value === active}
                onClick={() => onNavigate && onNavigate(it.value)} />
            ))}
          </div>
        ))}
      </div>

      {footer ? <div style={{ flex: '0 0 auto' }}>{footer}</div> : null}
    </nav>
  );
}

import React from 'react';
import { Icon } from '../core/Icon.jsx';
import { Button } from '../core/Button.jsx';
import { IconButton } from '../core/IconButton.jsx';

export function AIPromptPanel({
  heading = 'What Can I help with?', subheading, suggestions = [], orbSize = 100,
  placeholder = 'Ask anything…', model, onSend, tools = ['mic', 'paperclip', 'image'],
  compact = false, style, ...rest
}) {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', gap: compact ? 14 : 20, minWidth: 0, ...style }} {...rest}>
      <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 10, textAlign: 'center' }}>
        <div aria-hidden="true" style={{ width: orbSize, height: orbSize, borderRadius: '50%', background: 'var(--gradient-ai-orb)', filter: 'blur(5px)' }} />
        <h3 style={{ font: 'var(--weight-semibold) ' + (compact ? '17px' : 'var(--text-title-2)') + '/1.2 var(--font-display)', color: 'var(--text-strong)' }}>{heading}</h3>
        {subheading ? <p style={{ font: 'var(--type-body)', color: 'var(--text-muted)', maxWidth: 420 }}>{subheading}</p> : null}
      </div>

      {suggestions.length ? (
        <div style={{ display: 'flex', flexWrap: 'wrap', gap: 8, justifyContent: 'center' }}>
          {suggestions.map((s) => (
            <span key={s} style={{ display: 'inline-flex', alignItems: 'center', gap: 6, padding: '7px 13px', borderRadius: 'var(--radius-pill)', background: 'var(--surface-card)', border: '1px solid var(--border-hairline)', font: 'var(--weight-medium) 12px/1 var(--font-ui)', color: 'var(--text-muted)', cursor: 'pointer' }}>
              <Icon name="sparkles" size={13} />{s}
            </span>
          ))}
        </div>
      ) : null}

      <div style={{ background: 'var(--surface-card)', border: '1px solid var(--border-hairline)', borderRadius: 'var(--radius-card-inner)', padding: 12, display: 'flex', flexDirection: 'column', gap: 12 }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 9, color: 'var(--text-subtle)' }}>
          <Icon name="wand-sparkles" size={17} />
          <input placeholder={placeholder} style={{ flex: 1, minWidth: 0, border: 'none', outline: 'none', background: 'transparent', font: 'var(--weight-regular) 14px/1 var(--font-ui)', color: 'var(--text-strong)' }} />
        </div>
        <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 10, flexWrap: 'wrap' }}>
          <div style={{ display: 'flex', gap: 6, alignItems: 'center' }}>
            {tools.map((t) => <IconButton key={t} icon={t} variant="plain" size="sm" label={t} />)}
            {model ? <span style={{ marginLeft: 4, padding: '6px 12px', borderRadius: 'var(--radius-pill)', background: 'var(--grey-50)', font: 'var(--weight-medium) 12px/1 var(--font-ui)', color: 'var(--text-muted)' }}>{model}</span> : null}
          </div>
          <Button variant="primary" size="sm" icon="arrow-up" onClick={onSend}>Send</Button>
        </div>
      </div>
    </div>
  );
}

import React from 'react';
import { Icon } from '../core/Icon.jsx';
import { Checkbox } from '../forms/Checkbox.jsx';

export function DataTable({
  columns = [], rows = [], selectable = false, selected = [], onSelect,
  maxHeight, fade = false, style, ...rest
}) {
  const [hover, setHover] = React.useState(null);
  return (
    <div style={{ position: 'relative', minWidth: 0, ...style }} {...rest}>
      <div style={{ overflow: 'auto', maxHeight }}>
        <table style={{ width: '100%', borderCollapse: 'collapse', fontFamily: 'var(--font-tabular)' }}>
          <thead>
            <tr>
              {selectable ? <th style={{ width: 36, padding: '9px 0 9px 12px', background: 'var(--surface-card-sunken)', position: 'sticky', top: 0, zIndex: 1 }} /> : null}
              {columns.map((c, i) => (
                <th key={i} style={{
                  textAlign: c.align || 'left', padding: '9px 12px', whiteSpace: 'nowrap',
                  font: 'var(--weight-medium) 12px/1 var(--font-tabular)', color: 'var(--text-subtle)',
                  background: 'var(--surface-card-sunken)', position: 'sticky', top: 0, zIndex: 1,
                  borderTopLeftRadius: i === 0 && !selectable ? 10 : 0, borderTopRightRadius: i === columns.length - 1 ? 10 : 0,
                  width: c.width,
                }}>
                  <span style={{ display: 'inline-flex', alignItems: 'center', gap: 4 }}>
                    {c.header}
                    {c.sortable ? <Icon name="chevrons-up-down" size={12} /> : null}
                  </span>
                </th>
              ))}
            </tr>
          </thead>
          <tbody>
            {rows.map((r, ri) => {
              const on = selected.indexOf(ri) > -1;
              return (
                <tr key={ri}
                  onMouseEnter={() => setHover(ri)} onMouseLeave={() => setHover(null)}
                  style={{
                    background: on ? 'var(--surface-accent-faint)' : hover === ri ? 'var(--surface-hover)' : 'transparent',
                    transition: 'background-color var(--duration-fast) var(--ease-out)',
                  }}>
                  {selectable ? (
                    <td style={{ padding: '11px 0 11px 12px', borderBottom: '1px solid var(--border-hairline)' }}>
                      <Checkbox checked={on} onChange={() => onSelect && onSelect(ri)} />
                    </td>
                  ) : null}
                  {columns.map((c, ci) => (
                    <td key={ci} style={{
                      padding: '11px 12px', textAlign: c.align || 'left',
                      borderBottom: '1px solid var(--border-hairline)',
                      font: 'var(--type-table-cell)', color: 'var(--text-body)', whiteSpace: c.wrap ? 'normal' : 'nowrap',
                    }}>
                      {c.render ? c.render(r, ri) : r[c.key]}
                    </td>
                  ))}
                </tr>
              );
            })}
          </tbody>
        </table>
      </div>
      {fade ? <div aria-hidden="true" style={{ position: 'absolute', left: 0, right: 0, bottom: 0, height: 56, background: 'var(--scrim-bottom)', pointerEvents: 'none' }} /> : null}
    </div>
  );
}

import * as React from 'react';

export interface TooltipRow {
  label?: React.ReactNode;
  value?: React.ReactNode;
  tone?: 'default' | 'negative';
}
export interface TooltipProps extends React.HTMLAttributes<HTMLElement> {
  /** Header line — a month, a metric name. */
  title?: React.ReactNode;
  /** label/value pairs rendered in the tabular numeric face. */
  rows?: TooltipRow[];
  /** Baseline line under the rows, e.g. "Compared to $5,441 last month". */
  caption?: React.ReactNode;
  /** card = white value card (chart tooltip, default) · plain = forest hint bubble */
  variant?: 'card' | 'plain';
  placement?: 'top' | 'bottom';
  /** Wrap a trigger to get hover behaviour; omit to place the bubble yourself. */
  children?: React.ReactNode;
}
export declare function Tooltip(props: TooltipProps): JSX.Element;

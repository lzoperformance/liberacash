import * as React from 'react';

export interface BarDatum {
  label: string;
  /** Upward series — income. Rendered in --chart-series-1 (forest). */
  a: number;
  /** Downward series — expense. Rendered in --chart-series-2 (green). */
  b: number;
}
export interface BarChartProps extends React.HTMLAttributes<HTMLDivElement> {
  data?: BarDatum[];
  height?: number;
  /** Legend labels, defaults to ["Income","Expense"]. */
  labels?: [string, string];
  /** Index of the emphasised column; the rest drop to 45% opacity. */
  highlight?: number | null;
  onHighlight?: (index: number | null) => void;
  showLegend?: boolean;
  showAxis?: boolean;
}
export declare function BarChart(props: BarChartProps): JSX.Element;

import * as React from 'react';

export interface DonutSegment {
  label?: string;
  value: number;
  /** A --chart-series-* token. Order them dark → light clockwise. */
  color?: string;
}
export interface DonutChartProps extends React.HTMLAttributes<HTMLDivElement> {
  segments?: DonutSegment[];
  size?: number;
  /** Ring width in px. */
  thickness?: number;
  /** Centre caption, e.g. "Total Expense". */
  label?: React.ReactNode;
  /** Centre figure, e.g. "$3,500". */
  value?: React.ReactNode;
}
export declare function DonutChart(props: DonutChartProps): JSX.Element;

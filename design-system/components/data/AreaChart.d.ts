import * as React from 'react';

export interface AreaChartProps extends React.HTMLAttributes<HTMLDivElement> {
  /** Primary series — drawn green with the 28%→0% area fill. */
  series?: number[];
  /** Optional second series — drawn as a forest line with no fill. */
  compare?: number[];
  height?: number;
  /** Y-axis labels, top to bottom, e.g. ["$100k","$80k","$60k","$40k","$20k","0"]. */
  yTicks?: string[];
  xLabels?: string[];
  /** Index on the primary series to mark with a dashed rule + dot. Pair with a Tooltip. */
  marker?: number | null;
  fill?: boolean;
}
export declare function AreaChart(props: AreaChartProps): JSX.Element;

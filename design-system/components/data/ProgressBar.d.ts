import * as React from 'react';

export interface ProgressBarProps extends React.HTMLAttributes<HTMLDivElement> {
  /** 0–100. */
  value?: number;
  /** accent = green · dark = forest · split = the forest/green two-tone spending-limit bar */
  tone?: 'accent' | 'dark' | 'split';
  height?: number;
  /** soft = green-100 track (default) · plain = grey-150 */
  track?: 'soft' | 'plain';
  label?: React.ReactNode;
  /** Right-aligned figure above the bar, e.g. "$4,500.00 spent of $10,000.00". */
  caption?: React.ReactNode;
}
export declare function ProgressBar(props: ProgressBarProps): JSX.Element;

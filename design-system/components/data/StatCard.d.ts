import * as React from 'react';

/**
 * Label / figure / delta KPI tile — the Income · Expense · Savings trio, the
 * Total Expense / Savings / Income row on the wallet screen.
 *
 * @startingPoint section="Data" subtitle="KPI tiles — label, figure, signed delta" viewport="700x180"
 */
export interface StatCardProps extends React.HTMLAttributes<HTMLDivElement> {
  label?: React.ReactNode;
  /** Pre-formatted figure string, e.g. "$14,480.24". */
  value?: React.ReactNode;
  /** Signed change chip, e.g. "+1.78%". */
  delta?: string;
  deltaTone?: 'success' | 'pending' | 'warning' | 'neutral';
  /** Lucide glyph in a green circular tile beside the label. */
  icon?: string;
  surface?: 'hairline' | 'card' | 'tile' | 'accent';
  /** Right-hand header slot — an overflow IconButton. */
  action?: React.ReactNode;
  footer?: React.ReactNode;
}
export declare function StatCard(props: StatCardProps): JSX.Element;

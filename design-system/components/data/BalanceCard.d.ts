import * as React from 'react';

/**
 * The green hero card. Exactly one per screen — it is the brand moment.
 *
 * @startingPoint section="Data" subtitle="Green hero balance card with the ribbon motif" viewport="700x260"
 */
export interface BalanceCardProps extends React.HTMLAttributes<HTMLDivElement> {
  label?: React.ReactNode;
  /** Pre-formatted figure, e.g. "$20,670". */
  amount?: React.ReactNode;
  /** Trailing currency code, rendered at ~40% of the figure size. */
  currency?: string;
  /** Buttons row. Use <Button variant="onAccent"> and <Button variant="dark"> together. */
  actions?: React.ReactNode;
  /** Small line under the figure — a timestamp or estimate caveat. */
  note?: React.ReactNode;
  height?: number | string;
}
export declare function BalanceCard(props: BalanceCardProps): JSX.Element;

import * as React from 'react';

export interface UpgradeCardProps extends React.HTMLAttributes<HTMLDivElement> {
  title?: React.ReactNode;
  /** Quoted soft-sell line stating the payoff — see readme > CONTENT FUNDAMENTALS. */
  body?: React.ReactNode;
  cta?: React.ReactNode;
  icon?: string;
  onAction?: () => void;
}
export declare function UpgradeCard(props: UpgradeCardProps): JSX.Element;

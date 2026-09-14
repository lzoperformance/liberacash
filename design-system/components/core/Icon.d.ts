import * as React from 'react';

export interface IconProps extends React.HTMLAttributes<HTMLElement> {
  /** Lucide icon name, kebab-case — e.g. "wallet", "arrow-left-right". */
  name: string;
  /** 18 in table rows, 20 in controls and nav, 24 standalone, 28 in circular tiles. */
  size?: number;
  /** Always 1.75 unless you have a reason. */
  strokeWidth?: number;
}
export declare function Icon(props: IconProps): JSX.Element;

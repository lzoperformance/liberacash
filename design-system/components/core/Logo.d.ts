import * as React from 'react';

export interface LogoProps extends React.HTMLAttributes<HTMLElement> {
  /** lockup = tile + wordmark · mark = the green "Lc" tile alone · wordmark = type only */
  variant?: 'lockup' | 'mark' | 'wordmark';
  /** Rendered height in px. */
  height?: number;
  /** Path prefix to the project root, e.g. ".." from a components subfolder. */
  base?: string;
  /** With variant="mark", sets the wordmark as live type beside the tile. */
  withName?: boolean;
  /** Swaps to the on-dark lockup / white wordmark. */
  onDark?: boolean;
}
export declare function Logo(props: LogoProps): JSX.Element;

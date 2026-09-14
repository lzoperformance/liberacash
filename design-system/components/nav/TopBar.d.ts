import * as React from 'react';

export interface TopBarProps extends React.HTMLAttributes<HTMLElement> {
  title?: React.ReactNode;
  /** One sentence stating the job of the screen — see readme > CONTENT FUNDAMENTALS. */
  subtitle?: React.ReactNode;
  /** Usually <SearchField width={320} />. */
  search?: React.ReactNode;
  /** IconButtons and the account Avatar. */
  actions?: React.ReactNode;
  breadcrumb?: React.ReactNode;
}
export declare function TopBar(props: TopBarProps): JSX.Element;

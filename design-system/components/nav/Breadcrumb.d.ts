import * as React from 'react';

export interface BreadcrumbProps extends React.HTMLAttributes<HTMLElement> {
  /** Strings or { label, href }. The last entry is the current page and is semibold forest. */
  items?: (string | { label: React.ReactNode; href?: string })[];
}
export declare function Breadcrumb(props: BreadcrumbProps): JSX.Element;

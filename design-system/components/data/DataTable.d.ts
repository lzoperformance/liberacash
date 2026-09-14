import * as React from 'react';

export interface DataColumn<Row = any> {
  key?: string;
  header?: React.ReactNode;
  /** Custom cell renderer — use it for the two-line name/category cell, amounts and Badges. */
  render?: (row: Row, index: number) => React.ReactNode;
  align?: 'left' | 'right' | 'center';
  sortable?: boolean;
  width?: number | string;
  wrap?: boolean;
}

/**
 * The transactions table. Sticky sunken header, hairline row rules, optional
 * checkbox column and a bottom protection gradient for long lists.
 *
 * @startingPoint section="Data" subtitle="Transactions table — sticky header, status badges" viewport="700x320"
 */
export interface DataTableProps extends React.HTMLAttributes<HTMLDivElement> {
  columns?: DataColumn[];
  rows?: any[];
  selectable?: boolean;
  /** Indices of selected rows. */
  selected?: number[];
  onSelect?: (index: number) => void;
  /** Caps the scrollable body height. */
  maxHeight?: number | string;
  /** Fades the last rows into the card with --scrim-bottom. */
  fade?: boolean;
}
export declare function DataTable(props: DataTableProps): JSX.Element;

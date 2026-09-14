import * as React from 'react';

export interface TabItem {
  value: string;
  label: React.ReactNode;
  /** Parenthetical figure beside the label, e.g. "($4,800)". */
  meta?: React.ReactNode;
}
export interface TabsProps {
  /** Strings or {value,label,meta} objects. */
  items?: (TabItem | string)[];
  value?: string;
  onChange?: (value: string) => void;
  /** underline = green 2px rule under the active label (default) · segmented = capsule pill group */
  variant?: 'underline' | 'segmented';
  size?: 'sm' | 'md';
  style?: React.CSSProperties;
}
export declare function Tabs(props: TabsProps): JSX.Element;

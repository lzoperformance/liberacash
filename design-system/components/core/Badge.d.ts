import * as React from 'react';

export interface BadgeProps extends React.HTMLAttributes<HTMLSpanElement> {
  /** success = Completed · pending = Pending (red) · warning · neutral · accent · dark */
  tone?: 'success' | 'pending' | 'warning' | 'neutral' | 'accent' | 'dark';
  size?: 'sm' | 'md';
  /** Lucide glyph before the label. */
  icon?: string;
  /** A signed figure rendered in the tabular face, e.g. "+1.78%". */
  delta?: string;
  children?: React.ReactNode;
}
export declare function Badge(props: BadgeProps): JSX.Element;

import * as React from 'react';

export interface SelectProps {
  /** Currently displayed label. */
  value?: string;
  options?: string[];
  onSelect?: (value: string) => void;
  size?: 'sm' | 'md';
  /** outline = card-header time filter (default) · ghost · filled */
  variant?: 'outline' | 'ghost' | 'filled';
  icon?: string;
  label?: React.ReactNode;
  style?: React.CSSProperties;
}
export declare function Select(props: SelectProps): JSX.Element;

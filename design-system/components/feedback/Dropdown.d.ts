import * as React from 'react';

export interface DropdownItem {
  label?: React.ReactNode;
  value?: string;
  icon?: string;
  /** Right-aligned hint, e.g. a shortcut. */
  meta?: React.ReactNode;
  tone?: 'default' | 'danger';
  /** Renders a hairline rule instead of an item. */
  divider?: boolean;
}
export interface DropdownProps extends React.HTMLAttributes<HTMLDivElement> {
  /** The clickable element — usually an IconButton. */
  trigger?: React.ReactNode;
  items?: DropdownItem[];
  align?: 'left' | 'right';
  onSelect?: (value: string) => void;
}
export declare function Dropdown(props: DropdownProps): JSX.Element;

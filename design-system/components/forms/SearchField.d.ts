import * as React from 'react';

export interface SearchFieldProps extends React.InputHTMLAttributes<HTMLInputElement> {
  placeholder?: string;
  /** Keyboard-shortcut chips on the trailing edge. Pass [] to hide. */
  shortcut?: string[];
  width?: number | string;
}
export declare function SearchField(props: SearchFieldProps): JSX.Element;

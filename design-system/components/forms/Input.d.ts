import * as React from 'react';

export interface InputProps extends React.InputHTMLAttributes<HTMLInputElement> {
  label?: React.ReactNode;
  hint?: React.ReactNode;
  /** Replaces the hint and turns the field red. */
  error?: React.ReactNode;
  /** Lucide glyph inside the leading edge. */
  icon?: string;
  /** Trailing static text — a currency code, a unit. */
  suffix?: React.ReactNode;
  size?: 'sm' | 'md' | 'lg';
}
export declare function Input(props: InputProps): JSX.Element;

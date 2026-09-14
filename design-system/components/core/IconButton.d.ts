import * as React from 'react';

export interface IconButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  /** Lucide icon name. */
  icon: string;
  /** tile = the grey gradient circle used on marketing + toolbars · plain = topbar ghost · solid = forest · accent = green · onAccent = white on green */
  variant?: 'tile' | 'plain' | 'solid' | 'accent' | 'onAccent';
  size?: 'sm' | 'md' | 'lg' | 'xl';
  /** Accessible name. Required in practice — there is no visible label. */
  label?: string;
  active?: boolean;
  disabled?: boolean;
}
export declare function IconButton(props: IconButtonProps): JSX.Element;

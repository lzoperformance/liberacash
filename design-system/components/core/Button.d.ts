import * as React from 'react';

/**
 * Capsule button. Primary is brand green with forest text; dark is the forest
 * counterpart used beside it on the hero card.
 *
 * @startingPoint section="Core" subtitle="Capsule buttons — primary, dark, secondary, ghost" viewport="700x200"
 */
export interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  /** primary = green · dark = forest · secondary = white+border · ghost · onAccent (white, for use on green) · danger */
  variant?: 'primary' | 'dark' | 'secondary' | 'ghost' | 'onAccent' | 'danger';
  size?: 'sm' | 'md' | 'lg';
  /** Lucide name rendered before the label. */
  icon?: string;
  /** Lucide name rendered after the label. */
  iconAfter?: string;
  /** Typographic arrow after the label, e.g. "↗" or "↓" — the reference's Send ↗ / Deposit ↓ pattern. */
  glyph?: string;
  fullWidth?: boolean;
  disabled?: boolean;
  /** Renders an <a> instead of a <button>. */
  href?: string;
  children?: React.ReactNode;
}
export declare function Button(props: ButtonProps): JSX.Element;

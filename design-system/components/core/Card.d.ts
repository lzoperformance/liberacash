import * as React from 'react';

/**
 * The container everything in the product lives in — white, 20px radius, wide soft
 * shadow, no visible border.
 *
 * @startingPoint section="Core" subtitle="Card surfaces — white, tile, sunken, inverse, selected" viewport="700x280"
 */
export interface CardProps extends React.HTMLAttributes<HTMLElement> {
  /** card = white + shadow (default) · hairline = white + border, no shadow · tile = grey gradient · sunken · inverse = forest · accent = selected wash */
  surface?: 'card' | 'hairline' | 'tile' | 'sunken' | 'inverse' | 'accent';
  title?: React.ReactNode;
  subtitle?: React.ReactNode;
  /** Right-aligned header slot — a Select time filter, an IconButton, a Badge. */
  action?: React.ReactNode;
  pad?: 'none' | 'sm' | 'md' | 'lg';
  radius?: 'card' | 'card-inner' | 'lg' | 'xl' | 'shell';
  /** Lifts to --shadow-raised on hover. */
  interactive?: boolean;
  /** Forces the accent-faint + accent-border selected treatment. */
  selected?: boolean;
  children?: React.ReactNode;
  bodyStyle?: React.CSSProperties;
}
export declare function Card(props: CardProps): JSX.Element;

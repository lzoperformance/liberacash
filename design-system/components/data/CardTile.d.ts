import * as React from 'react';

export interface CardTileProps extends React.HTMLAttributes<HTMLSpanElement> {
  /** visa renders the wordmark · mastercard the two circles · none leaves it blank */
  scheme?: 'visa' | 'mastercard' | 'none';
  /** green = the selected personal card · dark = forest business card · grey = inactive */
  tone?: 'green' | 'dark' | 'grey';
  /** Height follows at 1:1.58. */
  width?: number;
}
export declare function CardTile(props: CardTileProps): JSX.Element;

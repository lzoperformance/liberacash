import * as React from 'react';

export interface RadioCardProps {
  checked?: boolean;
  onChange?: React.ChangeEventHandler<HTMLInputElement>;
  /** A CardTile thumbnail, an icon tile, a flag. */
  leading?: React.ReactNode;
  title?: React.ReactNode;
  /** Secondary line — a masked card number, an account type. */
  meta?: React.ReactNode;
  /** Right slot, usually an overflow IconButton. */
  trailing?: React.ReactNode;
  style?: React.CSSProperties;
}
export declare function RadioCard(props: RadioCardProps): JSX.Element;

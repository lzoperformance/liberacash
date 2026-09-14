import * as React from 'react';

export interface AvatarProps extends React.HTMLAttributes<HTMLSpanElement> {
  src?: string;
  /** Used for the alt text and for the initials fallback. */
  name?: string;
  size?: 'xs' | 'sm' | 'md' | 'lg' | number;
  /** White + green halo, for the topbar account avatar. */
  ring?: boolean;
  status?: 'online' | 'offline';
}
export declare function Avatar(props: AvatarProps): JSX.Element;

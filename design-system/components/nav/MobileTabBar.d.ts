import * as React from 'react';

/**
 * Fixed bottom tab bar for the mobile app — translucent white with a blur, sitting
 * above the safe-area inset. The active tab gets a green capsule behind its glyph.
 *
 * @startingPoint section="Navigation" subtitle="Mobile bottom tab bar, translucent + blurred" viewport="390x120"
 */
export interface MobileTabBarProps extends React.HTMLAttributes<HTMLElement> {
  items?: { value: string; label: React.ReactNode; icon: string }[];
  active?: string;
  onNavigate?: (value: string) => void;
}
export declare function MobileTabBar(props: MobileTabBarProps): JSX.Element;

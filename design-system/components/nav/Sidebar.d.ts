import * as React from 'react';

export interface SidebarNavItem {
  value: string;
  label: React.ReactNode;
  /** Lucide icon name. */
  icon: string;
}
export interface SidebarSection {
  /** All-caps eyebrow — MAIN MENU, PREFERENCE. Omit for an unlabelled group. */
  label?: string;
  items: SidebarNavItem[];
}

export interface SidebarItemProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  icon: string;
  label?: React.ReactNode;
  active?: boolean;
}
export declare function SidebarItem(props: SidebarItemProps): JSX.Element;

/**
 * The 248px desktop rail: logo, account switcher, eyebrow-labelled nav sections,
 * and a footer slot for the UpgradeCard.
 *
 * @startingPoint section="Navigation" subtitle="248px desktop rail with account switcher" viewport="700x420"
 */
export interface SidebarProps extends React.HTMLAttributes<HTMLElement> {
  sections?: SidebarSection[];
  active?: string;
  onNavigate?: (value: string) => void;
  /** { name, role } — renders the account-switcher button under the logo. */
  account?: { name: string; role: string };
  /** Bottom slot. Almost always <UpgradeCard/>. */
  footer?: React.ReactNode;
  /** Path prefix to the project root, for the logo asset. */
  base?: string;
  width?: number | string;
}
export declare function Sidebar(props: SidebarProps): JSX.Element;

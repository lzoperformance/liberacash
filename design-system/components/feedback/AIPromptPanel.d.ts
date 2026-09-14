import * as React from 'react';

/**
 * The AI assistant's resting state: blurred orb, question heading, suggestion chips
 * and the composer. Used full-bleed on the assistant screen and shrunk into a
 * dashboard card with compact.
 *
 * @startingPoint section="Feedback" subtitle="AI assistant panel — orb, suggestions, composer" viewport="700x420"
 */
export interface AIPromptPanelProps extends React.HTMLAttributes<HTMLDivElement> {
  /** A question. "What Can I help with?" / "How Can I Assist You With Your Finances?" */
  heading?: React.ReactNode;
  subheading?: React.ReactNode;
  /** Suggestion chip labels, e.g. "Show me my cash flow". */
  suggestions?: string[];
  orbSize?: number;
  placeholder?: string;
  /** Model-picker chip label, e.g. "Choose Model". */
  model?: React.ReactNode;
  onSend?: () => void;
  /** Lucide names for the composer tool row. */
  tools?: string[];
  /** Card-sized rather than screen-sized. */
  compact?: boolean;
}
export declare function AIPromptPanel(props: AIPromptPanelProps): JSX.Element;

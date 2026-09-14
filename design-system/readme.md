# Libera Cash — Design System

Libera Cash is a personal + small-business money platform. The product surface this system
describes is an **admin dashboard**: a single place to watch balance, cash flow, transactions,
cards and wallets, with an AI assistant layered on top. It ships as a desktop web app and a
companion mobile app, and it is fronted by a short marketing site.

The brief that produced this system, verbatim from the client:

> admin Dashboard moderno, clean, agradavel visualmente e com as melhores praticas de UI/UX,
> com acesso tbm mobile completo mas sem perder recursos importantes no desktop

Translated into design constraints, that means: (1) desktop is the full-power surface and loses
nothing, (2) mobile is a complete product rather than a cut-down viewer, (3) density is earned
through hierarchy and whitespace, not through shrinking everything.

---

## Sources this system was built from

| Source | What it gave us |
| --- | --- |
| `uploads/logoLC.png` | The Libera Cash lockup — green rounded-square "Lc" tile + `LiberaCash` wordmark. The only real brand asset provided. Copied to `assets/logo-lockup.png`, `assets/logo-mark.png`, `assets/logo-wordmark.png`. |
| `uploads/WhatsApp Image 2026-08-19 at 19.29.35.jpeg` | The lockup on a dark forest-green field → `assets/logo-lockup-on-dark.png`. Establishes that the mark is designed to sit on dark green as well as white. |
| 29 browser screenshots of a Behance case study | The visual direction. All 29 are frames of one published concept project: **"AI Finance Management SaaS & UX UI Dashboard Design"** (project name *Fynix*, Finance / Technology, New York, 2025) at `https://www.behance.net/gallery/234937291/AI-Finance-Management-SaaS-UX-UI-DashboardDesign`. The case study itself states its type stack (Space Grotesk / Urbanist / Plus Jakarta Sans), its icon philosophy, and shows a desktop dashboard, an AI assistant screen, a wallet screen, a transactions table, a mobile app and a marketing landing page. Normalised copies live in `shots/01.png … shots/29.png`. |

**What is and is not borrowed.** The screenshots are a *reference for visual language* — palette
temperature, card construction, radii, shadow weight, chart styling, layout rhythm, type stack.
They are **not** a brand to copy. Everything in this system carries Libera Cash identity: the
Libera Cash lockup, the Libera Cash green sampled from the actual logo file, Libera Cash product
nouns. No mark, illustration or logotype from the reference project has been reproduced, and the
reference project's bird mark is deliberately absent.

**No code or Figma source was provided.** Every screen in `ui_kits/` is therefore a
screenshot-guided reconstruction rather than a code-accurate port. Values were read off the
frames and rationalised into the token set below; where a value was unreadable, it was chosen to
be internally consistent rather than guessed. See CAVEATS at the bottom.

---

## CONTENT FUNDAMENTALS

**Language.** The product is Brazilian-Portuguese-facing (the brief is in pt-BR) but the
reference material and all the sample copy in this system are in English. Ship product copy in
**pt-BR**; the English strings in the UI kits are placeholders, and the kits are marked where
they'd be translated. Currency in samples is USD because the reference used it — real Libera Cash
surfaces are BRL (`R$ 20.670,00`, comma decimal, period thousands).

**Voice: plain, second person, slightly reassuring.** Copy addresses the user directly as *you*
and describes what the product does for them, never what the company built. It does not perform
excitement.

- Page subtitles are a single sentence stating the job of the screen:
  *"Track finances easily with AI insights and recommendations."*
  *"Securely store, track, and manage your money."*
- The AI assistant greets, then asks: *"Good to see you!"* → *"How Can I Assist You With Your Finances?"* → *"Quickly track cash flow, get AI-powered insights, and manage your money—all in one place"*
- Feature blurbs are two clauses, benefit then mechanism: *"View income, spending, and savings in real time with AI insights for smarter financial management."*
- Marketing headlines are short imperatives or promises: *"Get paid early."* / *"Access your earnings sooner with Libera Cash"*
- Upsell is soft and states the payoff: *"Upgrade Libera Cash today to unlock smarter insights and financial control."*

**Casing.** Sentence case for body, blurbs and subtitles. Title Case for card titles, nav items,
buttons and tab labels (`Total Balance`, `Recent Transactions`, `My Wallet`, `Transfer Funds`,
`Get Started`). ALL-CAPS is used *only* for sidebar section eyebrows (`MAIN MENU`, `PREFERENCE`)
at 11px with `--tracking-label`. Never all-caps a button or a heading.

**Numbers are the loudest text on any screen.** A figure gets Space Grotesk, bold, and at least
twice the size of its label. Labels sit above figures in small grey type (`Total Balance` 13px
grey → `$20,670` 40px forest). Currency codes trail the figure at half its size (`$20,670 USD`).
Deltas are signed and coloured (`+$200.00` forest, `-$154.20` red, `↑1.9%`).

**Microcopy patterns.**
- Time filters read `This Month`, `This Year`, `Monthly`, `Last 15 days`.
- Statuses are one word: `Completed`, `Pending`, `Active`.
- Empty/assistant prompts are questions: *"What Can I help with?"*, *"Ask anything…"*
- Comparisons carry their baseline: *"Compared to $5,441 last month"*, *"$4,500.00 spent of $10,000.00"*.
- Alerts are short and non-alarming: *"Spending limit's near!"*

**No emoji.** Zero emoji appear in the reference material and none belong in this product; flags
are the one exception, used as country markers in currency selectors (🇺🇸 USD, 🇬🇧 GBP) — and even
those should be replaced with flag SVGs in production.

**Vibe.** Calm, competent, a little optimistic. Green does the optimism so the words don't have to.

---

## VISUAL FOUNDATIONS

### Colour

Two hues and a grey. Everything else is semantic.

- **Brand green `--green-500` #82E166** — sampled directly from the logo tile, which is itself a
  `#86E160 → #76DF7D` gradient. It is a bright, slightly yellow spring green. It appears as: the
  hero balance card, primary CTAs on light grounds, the positive chart series, selected states,
  and the logo tile. It is *not* used for body text — at 15px it fails contrast. Text on green is
  always `--forest-800`.
- **Forest `--forest-800` #0E3223** — the ink. Headings, body, figures, dark buttons, the dominant
  chart series, dark card tiles. `--forest-700` #16562D is the logo's lettermark green and is used
  for links and accent text.
- **Grey desk** — the page is `--surface-desk` #E9E9E9, a mid-light grey, and cards are white or a
  white→grey tile gradient sitting on it. This is the single most identifying move in the system:
  the app is never white-on-white. Marketing pages use `--surface-page` #F7F7F7 instead.
- **Semantics** — red `#E5484D` on `#FDECEC` for negative amounts and `Pending`; forest on
  `--green-50` for `Completed`; amber for soft warnings; blue almost never.
- **Max two background colours per screen.** Grey desk + white cards, or forest + green for
  dark sections. Never three.

### Type

Three Google Fonts, each with a job:

- **Space Grotesk** — display and numerals. Big marketing headlines, page titles, card titles,
  every currency figure. Its single-storey `a` and tight apertures are what make the reference
  frames recognisable. `--font-display`, `--font-numeric`.
- **Urbanist** — the UI and body face. Nav, labels, blurbs, buttons, captions. Geometric, light,
  wide counters; sits quietly under Space Grotesk. `--font-ui`, `--font-body`.
- **Plus Jakarta Sans** — dense tabular content: transaction rows, table headers, ID columns.
  Slightly narrower and more neutral, so 13px table text stays legible. `--font-tabular`.

Scale is in `tokens/typography.css`: display 44–72px, page titles 26–32px, card titles 17px, body
15px, captions 13px, eyebrows 11px. Hero figures 40px, KPI figures 28px. Line height is tight for
display (1.06–1.2) and comfortable for body (1.45). Tracking is negative on display
(`-0.02em`) and only ever positive on the 11px all-caps eyebrows (`+0.08em`).

### Spacing & layout

4px base; card interiors land on 14 / 20 / 24. `--gap-card: 16px` between dashboard cards,
`--pad-card: 20px` inside them. Sidebar is a fixed 248px, topbar 64px, mobile tab bar 72px.

The desktop shell is the signature layout: a **rounded 28px plate** (`--radius-shell`) inset 16px
from the viewport edge, floating on the grey desk with `--shadow-shell` and a 1px
`--border-accent` hairline glow. Sidebar and content scroll inside the plate; the plate itself is
fixed. Dashboard content is a 12-column grid at `--gap-card`; the canonical home layout is
`4 / 5 / 3` (balance / AI enhancements / finance score), then `7 / 5` (cashflow / AI assistant),
then `5 / 4 / 3` (transactions / statistic / exchange).

Mobile keeps every one of those modules — it stacks them and swaps the sidebar for a bottom tab
bar plus a hamburger sheet. Nothing is removed. Charts become horizontally scrollable rather than
simplified.

### Backgrounds & imagery

No photography in the product. Three background treatments exist:

1. **Flat grey desk** — the default.
2. **Tile gradient** `--surface-tile`, a 160° white→`--grey-100` wash used on secondary panels and
   icon tiles. Very low contrast; reads as a faint sheen, not a gradient.
3. **Hero green with organic swirl** — the balance card. `--gradient-hero` plus a set of soft
   concentric ribbon shapes at ~18% white, drawn as large overlapping ellipses with a blur. This is
   the one decorative element in the system.

The AI assistant has a single motif: a **soft blurred orb**, `--gradient-ai-orb`, a 100px circle
with a heavy blur going green-highlight → brand green → forest. It stands in for an avatar.

Marketing pages use a near-invisible large-scale wireframe cityscape watermark behind the hero at
about 4% opacity. Illustration is otherwise absent; **do not add any**. The reference project
contained no illustration set and none was provided.

Imagery colour vibe, if photography is ever introduced: cool, high-key, desaturated, no grain —
it must not fight the green.

### Corners, borders, cards

- Everything is round. Cards 20px, inner panels 14px, the shell 28px, icon tiles 22px. Buttons,
  chips, selects, badges and avatars are **full capsules** (`--radius-pill`). Text inputs are the
  single exception at 12px soft-rect.
- Cards are white, `--radius-card`, with `--shadow-card` (a 1px near-invisible ambient plus a wide
  24px lift) and **no visible border**. When a card needs definition against white, it takes a
  `--border-hairline` instead of a shadow, never both.
- Selected rows and cards get `--surface-accent-faint` fill + `--border-accent` 1px + a 3px
  forest bar on the leading edge.
- Dark cards (`--surface-inverse`) use `--border-inverse` at 14% white and no shadow.

### Shadows

Soft, wide, nearly colourless, tinted with forest rather than black:
`--shadow-card` for resting cards, `--shadow-raised` for hovered/pulled-forward cards,
`--shadow-popover` for menus and tooltips, `--shadow-shell` for the app plate,
`--shadow-accent` for a green primary button that needs to pop. Inner shadows are used only as a
1px top highlight (`--shadow-inner-top`) on grey tiles.

### Protection gradients vs capsules

Both are used, for different problems. **Capsules** (a white or `rgba(255,255,255,.85)` pill
behind a control) protect controls that sit on the green hero card or on imagery — the
`Deposit` button, currency chips. **Protection gradients** (`--scrim-bottom`) fade the bottom of
long scroll lists into the card so rows don't collide with the card edge; `--scrim-dark` does the
same over dark sections. Never stack a scrim under a capsule.

### Transparency & blur

Sparingly and only for depth, never for decoration. Blur appears in exactly three places: the AI
orb, the hero card's ribbon art, and `backdrop-filter: blur(12px)` on the mobile sheet overlay and
sticky mobile header. Transparency: `rgba(255,255,255,.85)` capsules on green, `--border-inverse`
on dark cards, chart area fills at 28%→0%. No frosted-glass cards.

### Motion

Restrained and short. `--duration-fast 140ms` for control state changes, `--duration-base 200ms`
for surfaces, `--duration-slow 320ms` for sheets and drawers, `--duration-chart 700ms` for chart
draw-in. Easing is `--ease-out cubic-bezier(.22,.7,.3,1)` almost everywhere — a gentle
deceleration. **Nothing bounces, nothing overshoots, nothing spins.** Transitions are fades and
small translations (≤8px). Charts animate once on mount: bars grow from the zero line, area
charts wipe left-to-right. Numbers do not count up.

### Interaction states

- **Hover, light surfaces:** background steps one level (`--surface-card` → `--surface-hover`), or
  shadow lifts `--shadow-card` → `--shadow-raised`. Never a colour-shift on text alone.
- **Hover, dark button:** `--forest-800` → `--forest-700` (lighter).
- **Hover, green button:** `--green-500` → `--green-600` (darker). Green goes darker on hover,
  forest goes lighter — both move *toward* each other.
- **Hover, ghost/icon button:** `--surface-hover` fill appears; the glyph stays put.
- **Press:** `transform: scale(.98)` (`--press-scale`) plus one more colour step. No ripple.
- **Focus:** `--ring-focus`, a 3px 45%-opacity green halo. On green surfaces use
  `--ring-focus-dark`.
- **Selected:** accent-faint fill + accent border, described above. Sidebar's active item is a
  white capsule on the grey sidebar with forest text and a forest icon.
- **Disabled:** 40% opacity, `cursor: not-allowed`, no state changes.

### Fixed elements

Sidebar, topbar and the upgrade card at the sidebar's foot are fixed within the shell plate. On
mobile the header and the bottom tab bar are fixed; the tab bar sits above the safe-area inset.
Tables scroll their body with a sticky header row.

---

## ICONOGRAPHY

**What the reference uses.** The case study devotes a frame to icons: *"Libera Cash–style icons
ensure clear, intuitive navigation for all key features"* is the reference project's own claim
about its set. The icons shown are **single-weight outline glyphs, ~1.5px stroke on a 24px grid,
rounded caps and joins, no fill, no duotone** — home, question-mark-circle, paperclip, wallet,
gear, clipboard, pie-chart, currency-with-arrow, magnifier, microphone, image, sparkle-wand,
command-key. They are presented in 56px white circular tiles. The family is consistent with
**Iconsax / Solar**-type sets.

**What ships here, and the substitution.** No icon files were provided and no codebase was
attached, so there is nothing to copy in. This system therefore standardises on
**[Lucide](https://lucide.dev)**, loaded from CDN — it is the closest freely-licensed match on
stroke weight (2px, dialled to 1.75 via `stroke-width`), rounded terminals and geometric
construction. **This is a substitution and it is visible:** Lucide's glyphs are slightly more
angular than the reference's. ⚠️ *If Libera Cash owns or licenses an icon set, send the SVGs and
this should be swapped.*

```html
<script src="https://unpkg.com/lucide@0.454.0/dist/umd/lucide.js"></script>
<script>lucide.createIcons();</script>
<i data-lucide="wallet" style="width:20px;height:20px;stroke-width:1.75"></i>
```

Rules:
- Stroke only. Never fill an icon, never mix a filled set in.
- 20px inside controls and nav, 24px standalone, 18px in table rows, 28px in circular tiles.
- Stroke inherits `currentColor`; `stroke-width: 1.75` everywhere.
- Icons in circular tiles: 44px tile (`--surface-tile`), 56px on marketing.
- No unicode characters as icons — with two exceptions kept from the reference: the `⌘`/`F`
  keyboard-shortcut chips in the search field, and arrow glyphs `↗ ↓ ↑` inside button labels
  (`Send ↗`, `Deposit ↓`). Both are typographic, not iconographic.
- No emoji. Country flags in currency pickers are the only pictographic exception and should be
  flag SVGs in production.
- Brand mark: use `assets/logo-mark.png` (never a Lucide glyph) for the app identity.

---

## INDEX

**Root**
- `styles.css` — the one file consumers link. `@import`s only.
- `readme.md` — this file.
- `SKILL.md` — Agent-Skills front matter, for using this system inside Claude Code.
- `thumbnail.html` — homepage tile for the design system.

**`tokens/`** — `fonts.css`, `colors.css`, `typography.css`, `spacing.css`, `radii.css`,
`shadows.css`, `motion.css`, `base.css`. All reachable from `styles.css`.

**`assets/`** — `logo-lockup.png`, `logo-mark.png`, `logo-wordmark.png`,
`logo-lockup-on-dark.png`.

**`shots/`** — `01.png … 29.png`, the normalised reference frames. Not shipped to consumers;
kept so a future reader can check any decision against the source.

**`guidelines/`** — foundation specimen cards (Colors, Type, Spacing, Brand groups in the
Design System tab) plus deeper prose.

**`components/`** — reusable primitives, grouped by concern:

| Group | Components |
| --- | --- |
| `core/` | `Button`, `IconButton`, `Badge`, `Card`, `Avatar`, `Logo` |
| `forms/` | `Input`, `SearchField`, `Select`, `Checkbox`, `RadioCard`, `Switch`, `Tabs` |
| `data/` | `StatCard`, `BalanceCard`, `DataTable`, `BarChart`, `DonutChart`, `AreaChart`, `ProgressBar`, `CardTile` |
| `nav/` | `Sidebar`, `TopBar`, `MobileTabBar`, `Breadcrumb` |
| `feedback/` | `Dropdown`, `Tooltip`, `UpgradeCard`, `AIPromptPanel` |

**`ui_kits/`** — full-screen recreations:

| Kit | Screens |
| --- | --- |
| `admin-dashboard/` | Home, AI Assistant, Transactions, Wallet, Settings — click-through desktop shell |
| `mobile-app/` | Home, Cashflow, Transactions, Wallet, Assistant in a phone frame |
| `landing/` | Marketing homepage — hero, features, metrics, CTA |

### Intentional additions

The reference defines screens, not a component library, so the primitive inventory below was
*derived* from what those screens repeat. Two items have no direct counterpart in the frames and
exist because the system needs them:

- **`Logo`** — a wrapper so the lockup/mark/wordmark variants and their dark-ground versions are
  used consistently instead of hand-placed `<img>` tags.
- **`Tooltip`** — the reference shows chart tooltips but no general-purpose one; a single
  primitive covers both rather than having charts own bespoke popovers.

---

## CAVEATS

1. **Screenshots were the only visual source.** No Figma file, no repository. Paddings, radii and
   type sizes are read off browser screenshots at ~1.5× and rationalised — they are faithful in
   proportion, not pixel-exact.
2. **The reference is a third-party concept project**, not Libera Cash's own product. Where its
   content and Libera Cash's brand disagreed, the brand won.
3. **Fonts load from Google Fonts CDN**; no binaries ship. ⚠️ If Libera Cash has licensed
   webfonts, send them and `tokens/fonts.css` should become real `@font-face` rules.
4. **Icons are Lucide, substituted** for the reference's Iconsax-like set. ⚠️ Send the real SVGs.
5. **No illustration set, no photography, no product screenshots of the real app** were provided;
   none were invented.
6. **Currency and language** in the kits are USD/English, mirroring the reference. Real surfaces
   are BRL/pt-BR.

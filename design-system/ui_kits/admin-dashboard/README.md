# UI kit — Admin Dashboard (desktop)

The primary Libera Cash surface. One `index.html` with a click-through shell: pick any item in the
left rail and the content area swaps. Built entirely from the primitives in `components/` — nothing
is re-implemented here.

## Files

| File | What's in it |
| --- | --- |
| `index.html` | The shell — grey desk, 28px floating plate, `Sidebar` + `TopBar` + scrolling content. Also holds the responsive rules and the hamburger sheet. |
| `data.js` | Sample data and the nav/screen tables. Plain script, no JSX. |
| `Panels.jsx` | Composite panels reused across screens: `FinanceScore`, `ExchangePanel`, `StatisticPanel`, `CashflowPanel`, plus the table cell renderers (`NameCell`, `AcctCell`, `DateCell`, `Amount`). |
| `Screens.jsx` | `HomeScreen`, `AssistantScreen`, `TransactionsScreen`, `WalletScreen`, `SettingsScreen`, `PlaceholderScreen`. |

## Screens

- **Home** — `4 / 5 / 3` (balance · AI enhancements · finance score), then `7 / 5`
  (cashflow · assistant), then `5 / 4 / 3` (transactions · statistic · exchange). This is the
  canonical grid described in readme.md.
- **AI Assistant** — full-bleed `AIPromptPanel` with the four example cards beneath.
- **Transactions** — four KPI tiles, then the full eight-column table with search, tab filters,
  row selection and a bulk-action bar.
- **Wallet** — breadcrumb + balance figure, card picker, card detail, spending limits, the wallet
  area chart, then transactions / all-expenses / convert.
- **Settings** — account, notifications, security, plan, data export, connected accounts.
- **Invoices · Reports · Help Center** — deliberately blank with a note. The reference material
  contains no design for them and none was invented.

## Responsive behaviour

The brief asks for a complete mobile experience without losing desktop features, so nothing is
removed at small widths — it reflows:

- **≤1180px** — every dashboard grid collapses to a single column. Card order is preserved.
- **≤900px** — the fixed plate becomes a normal document, the rail hides behind a hamburger that
  opens the same `Sidebar` as a blurred overlay sheet, and the page scrolls with the body.

Tables scroll horizontally inside their card rather than dropping columns.

## Notes

- All figures, names and dates are sample data mirroring the reference case study (USD/English).
  Real surfaces are BRL/pt-BR.
- Icons are Lucide from CDN — see readme.md > ICONOGRAPHY for the substitution note.
- The plate's 1px green hairline (`--border-accent`) is deliberate; it is how the reference
  separates the app from the desk.

const NS = window.LiberaCashDesignSystem_78af32 || {};

const MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

const CASHFLOW = [
  { label:'Jan', a:5200, b:3600 }, { label:'Feb', a:4100, b:4800 },
  { label:'Mar', a:4600, b:4200 }, { label:'Apr', a:6400, b:2600 },
  { label:'May', a:4400, b:3900 }, { label:'Jun', a:6000, b:4000 },
  { label:'Jul', a:3600, b:4100 }, { label:'Aug', a:4300, b:4600 },
  { label:'Sep', a:6200, b:2900 }, { label:'Oct', a:5000, b:3400 },
  { label:'Nov', a:3700, b:4900 }, { label:'Dec', a:4800, b:3300 },
];

const TRANSACTIONS = [
  { name:'Dividend Payout',    cat:'Investments', scheme:'visa',       acct:'Platinum Plus Visa',  id:'4567890139', date:'2024-09-25', time:'10:00', amt:'+$200.00',   status:'Completed', note:'Quarterly dividend' },
  { name:'Grocery Shopping',   cat:'Food & Dining', scheme:'visa',     acct:'Platinum Plus Visa',  id:'4567890123', date:'2024-09-24', time:'14:30', amt:'-$154.20',   status:'Completed', note:'Weekly groceries' },
  { name:'Freelance Payment',  cat:'Income',      scheme:'mastercard', acct:'Freedom Unlimited',   id:'4567890140', date:'2024-09-23', time:'15:00', amt:'+$850.00',   status:'Completed', note:'Design retainer' },
  { name:'Electricity Bill',   cat:'Utilities',   scheme:'mastercard', acct:'Freedom Unlimited',   id:'4567890128', date:'2024-09-22', time:'09:15', amt:'-$120.75',   status:'Completed', note:'September usage' },
  { name:'Gym Membership',     cat:'Healthcare',  scheme:'visa',       acct:'Platinum Plus Visa',  id:'4567890125', date:'2024-09-22', time:'07:00', amt:'-$45.00',    status:'Pending',   note:'Monthly gym fee for health' },
  { name:'Online Subscription',cat:'Services',    scheme:'visa',       acct:'Platinum Plus Visa',  id:'4567890118', date:'2024-09-18', time:'08:00', amt:'-$12.99',    status:'Pending',   note:'Streaming plan' },
  { name:'Consulting Fee',     cat:'Services',    scheme:'mastercard', acct:'Freedom Unlimited',   id:'4567890141', date:'2024-09-17', time:'14:00', amt:'+$1,500.00', status:'Completed', note:'Advisory session' },
  { name:'Amazon Purchase',    cat:'Food & Dining', scheme:'visa',     acct:'Platinum Plus Visa',  id:'4567890124', date:'2024-09-16', time:'15:45', amt:'-$80.95',    status:'Pending',   note:'Kitchen appliances' },
];

const CARDS = [
  { label:'Personal', mask:'•••• 8744', scheme:'visa',       tone:'green', number:'5582 5574 8376 5487', expiry:'05/25', cvc:'411', status:'Active' },
  { label:'Business', mask:'•••• 5641', scheme:'visa',       tone:'grey',  number:'4021 7745 1190 5641', expiry:'11/26', cvc:'204', status:'Active' },
  { label:'Business', mask:'•••• 9007', scheme:'mastercard', tone:'dark',  number:'5310 6621 8842 9007', expiry:'02/27', cvc:'318', status:'Frozen' },
];

const EXPENSE_SPLIT = [
  { pct:'60%', name:'Rent & Living',  amount:'$2,100', value:60, color:'var(--chart-series-1)' },
  { pct:'15%', name:'Investment',     amount:'$525',   value:15, color:'var(--chart-series-2)' },
  { pct:'12%', name:'Education',      amount:'$420',   value:12, color:'var(--chart-series-3)' },
  { pct:'8%',  name:'Food & Drink',   amount:'$280',   value:8,  color:'var(--chart-series-4)' },
  { pct:'5%',  name:'Other',          amount:'$175',   value:5,  color:'var(--grey-300)' },
];

const WALLET_SERIES = [22,28,26,31,29,35,33,42,38,46,44,53,49,61,57,59,64,62,72,78,74,76,81,79];
const WALLET_COMPARE = [30,29,31,33,36,38,40,42,44,46,47,49,52,54,55,57,58,60,61,63,64,65,66,68];

const NAV_SECTIONS = [
  { label:'MAIN MENU', items:[
    { value:'dashboard',    label:'Dashboard',    icon:'home' },
    { value:'assistant',    label:'AI Assistant', icon:'wand-sparkles' },
    { value:'transactions', label:'Transactions', icon:'arrow-left-right' },
    { value:'wallet',       label:'My Wallet',    icon:'wallet' },
    { value:'invoices',     label:'Invoices',     icon:'file-text' },
    { value:'reports',      label:'Reports',      icon:'pie-chart' },
  ]},
  { label:'PREFERENCE', items:[
    { value:'settings', label:'Settings',    icon:'settings' },
    { value:'help',     label:'Help Center', icon:'circle-help' },
  ]},
];

const SCREEN_META = {
  dashboard:    { title:'Home',         subtitle:'Track finances easily with AI insights and recommendations.' },
  assistant:    { title:'AI Assistant', subtitle:'Get smart financial insights, forecasts, and tips.' },
  transactions: { title:'Transactions', subtitle:'Every movement across your cards and wallets, in one list.' },
  wallet:       { title:'Wallet',       subtitle:'Securely store, track, and manage your money.' },
  invoices:     { title:'Invoices',     subtitle:'Issue, send and reconcile invoices.' },
  reports:      { title:'Reports',      subtitle:'Build and export a view of any period.' },
  settings:     { title:'Settings',     subtitle:'Account, security and notification preferences.' },
  help:         { title:'Help Center',  subtitle:'Guides, answers and a way to reach a human.' },
};

Object.assign(window, { NS, MONTHS, CASHFLOW, TRANSACTIONS, CARDS, EXPENSE_SPLIT, WALLET_SERIES, WALLET_COMPARE, NAV_SECTIONS, SCREEN_META });

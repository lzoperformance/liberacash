Wallet growth / cash-flow trend line. Green line with a fading fill; optional forest comparison line.

```jsx
<AreaChart height={190} marker={5}
  series={[22,31,29,42,38,61,57,64,72,78,74,81]}
  compare={[30,28,33,36,40,44,47,52,55,58,61,66]}
  yTicks={['$100k','$80k','$60k','$40k','$20k','0']}
  xLabels={['1','2','3','4','5','6','7','8']} />
```

The marker is the reference's hover affordance: dashed vertical rule + a green dot, with a
Tooltip carrying the value and its baseline.

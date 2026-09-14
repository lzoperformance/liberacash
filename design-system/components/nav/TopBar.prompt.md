Screen header inside the shell: title + one-sentence subtitle on the left, search and actions right.

```jsx
<TopBar title="Home" subtitle="Track finances easily with AI insights and recommendations."
  search={<SearchField width={320} />}
  actions={<>
    <IconButton icon="settings" variant="plain" label="Settings" />
    <IconButton icon="circle-help" variant="plain" label="Help" />
    <Avatar name="Jenny Wilson" ring />
  </>} />
```

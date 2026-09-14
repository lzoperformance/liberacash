/* @ds-bundle: {"format":4,"namespace":"LiberaCashDesignSystem_78af32","components":[{"name":"Avatar","sourcePath":"components/core/Avatar.jsx"},{"name":"Badge","sourcePath":"components/core/Badge.jsx"},{"name":"Button","sourcePath":"components/core/Button.jsx"},{"name":"Card","sourcePath":"components/core/Card.jsx"},{"name":"Icon","sourcePath":"components/core/Icon.jsx"},{"name":"IconButton","sourcePath":"components/core/IconButton.jsx"},{"name":"Logo","sourcePath":"components/core/Logo.jsx"},{"name":"AreaChart","sourcePath":"components/data/AreaChart.jsx"},{"name":"BalanceCard","sourcePath":"components/data/BalanceCard.jsx"},{"name":"BarChart","sourcePath":"components/data/BarChart.jsx"},{"name":"CardTile","sourcePath":"components/data/CardTile.jsx"},{"name":"DataTable","sourcePath":"components/data/DataTable.jsx"},{"name":"DonutChart","sourcePath":"components/data/DonutChart.jsx"},{"name":"ProgressBar","sourcePath":"components/data/ProgressBar.jsx"},{"name":"StatCard","sourcePath":"components/data/StatCard.jsx"},{"name":"AIPromptPanel","sourcePath":"components/feedback/AIPromptPanel.jsx"},{"name":"Dropdown","sourcePath":"components/feedback/Dropdown.jsx"},{"name":"Tooltip","sourcePath":"components/feedback/Tooltip.jsx"},{"name":"UpgradeCard","sourcePath":"components/feedback/UpgradeCard.jsx"},{"name":"Checkbox","sourcePath":"components/forms/Checkbox.jsx"},{"name":"Input","sourcePath":"components/forms/Input.jsx"},{"name":"RadioCard","sourcePath":"components/forms/RadioCard.jsx"},{"name":"SearchField","sourcePath":"components/forms/SearchField.jsx"},{"name":"Select","sourcePath":"components/forms/Select.jsx"},{"name":"Switch","sourcePath":"components/forms/Switch.jsx"},{"name":"Tabs","sourcePath":"components/forms/Tabs.jsx"},{"name":"Breadcrumb","sourcePath":"components/nav/Breadcrumb.jsx"},{"name":"MobileTabBar","sourcePath":"components/nav/MobileTabBar.jsx"},{"name":"SidebarItem","sourcePath":"components/nav/Sidebar.jsx"},{"name":"Sidebar","sourcePath":"components/nav/Sidebar.jsx"},{"name":"TopBar","sourcePath":"components/nav/TopBar.jsx"}],"sourceHashes":{"components/core/Avatar.jsx":"543a1d2f3867","components/core/Badge.jsx":"2d43691aebca","components/core/Button.jsx":"b8d9d17641a3","components/core/Card.jsx":"40954563208e","components/core/Icon.jsx":"3662e8967c6f","components/core/IconButton.jsx":"05b66aa6fdb6","components/core/Logo.jsx":"887c11aa3c1f","components/data/AreaChart.jsx":"a81d1923ebb9","components/data/BalanceCard.jsx":"3b7e8e9f4603","components/data/BarChart.jsx":"b454fb0241cb","components/data/CardTile.jsx":"b6f79e2b8626","components/data/DataTable.jsx":"7a76531f191b","components/data/DonutChart.jsx":"a9af9a37f024","components/data/ProgressBar.jsx":"2af2a188974e","components/data/StatCard.jsx":"84644685d83b","components/feedback/AIPromptPanel.jsx":"7bb6f5fb0000","components/feedback/Dropdown.jsx":"be778e6d2cd2","components/feedback/Tooltip.jsx":"5c705580064e","components/feedback/UpgradeCard.jsx":"83bfddab4624","components/forms/Checkbox.jsx":"ffdc4b9f2624","components/forms/Input.jsx":"c3dcb9b5e383","components/forms/RadioCard.jsx":"1ab6aff27ef7","components/forms/SearchField.jsx":"1541405ad3cb","components/forms/Select.jsx":"f04c64943c94","components/forms/Switch.jsx":"dc85eeeeebb0","components/forms/Tabs.jsx":"13bcd74382d4","components/nav/Breadcrumb.jsx":"eba351bbdb2f","components/nav/MobileTabBar.jsx":"f367c3390747","components/nav/Sidebar.jsx":"e0ef50cfbcd2","components/nav/TopBar.jsx":"c68a147dcf96","ui_kits/admin-dashboard/Panels.jsx":"afa4eaa9a3b5","ui_kits/admin-dashboard/Screens.jsx":"6534b9916934","ui_kits/admin-dashboard/data.js":"3f91efa6e905"},"inlinedExternals":[],"unexposedExports":[]} */

(() => {

const __ds_ns = (window.LiberaCashDesignSystem_78af32 = window.LiberaCashDesignSystem_78af32 || {});

const __ds_scope = {};

(__ds_ns.__errors = __ds_ns.__errors || []);

// components/core/Avatar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const SIZES = {
  xs: 24,
  sm: 32,
  md: 40,
  lg: 48
};
function Avatar({
  src,
  name = '',
  size = 'md',
  ring = false,
  status,
  style,
  ...rest
}) {
  const px = typeof size === 'number' ? size : SIZES[size] || 40;
  const initials = name.split(' ').filter(Boolean).slice(0, 2).map(w => w[0]).join('').toUpperCase();
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      position: 'relative',
      display: 'inline-flex',
      flex: '0 0 auto',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    style: {
      width: px,
      height: px,
      borderRadius: 'var(--radius-avatar)',
      overflow: 'hidden',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--forest-100)',
      color: 'var(--forest-700)',
      font: 'var(--weight-semibold) ' + Math.round(px * 0.36) + 'px/1 var(--font-ui)',
      boxShadow: ring ? '0 0 0 2px var(--grey-0), 0 0 0 3px var(--green-400)' : 'none'
    }
  }, src ? /*#__PURE__*/React.createElement("img", {
    src: src,
    alt: name,
    style: {
      width: '100%',
      height: '100%',
      objectFit: 'cover'
    }
  }) : initials), status ? /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'absolute',
      right: -1,
      bottom: -1,
      width: Math.max(8, px * 0.26),
      height: Math.max(8, px * 0.26),
      borderRadius: '50%',
      background: status === 'online' ? 'var(--green-500)' : 'var(--grey-400)',
      border: '2px solid var(--grey-0)'
    }
  }) : null);
}
Object.assign(__ds_scope, { Avatar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Avatar.jsx", error: String((e && e.message) || e) }); }

// components/core/Card.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const SURFACES = {
  card: {
    background: 'var(--surface-card)',
    boxShadow: 'var(--shadow-card)',
    border: '1px solid transparent'
  },
  hairline: {
    background: 'var(--surface-card)',
    boxShadow: 'none',
    border: '1px solid var(--border-hairline)'
  },
  tile: {
    background: 'var(--surface-tile)',
    boxShadow: 'none',
    border: '1px solid var(--border-hairline)'
  },
  sunken: {
    background: 'var(--surface-card-sunken)',
    boxShadow: 'none',
    border: '1px solid transparent'
  },
  inverse: {
    background: 'var(--surface-inverse)',
    boxShadow: 'none',
    border: '1px solid var(--border-inverse)'
  },
  accent: {
    background: 'var(--surface-accent-faint)',
    boxShadow: 'none',
    border: '1px solid var(--border-accent)'
  }
};
function Card({
  surface = 'card',
  title,
  subtitle,
  action,
  pad = 'md',
  radius = 'card',
  interactive = false,
  selected = false,
  children,
  style,
  bodyStyle,
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  const s = selected ? SURFACES.accent : SURFACES[surface] || SURFACES.card;
  const padding = {
    none: 0,
    sm: 'var(--pad-card-sm)',
    md: 'var(--pad-card)',
    lg: 'var(--pad-card-lg)'
  }[pad];
  const dark = surface === 'inverse';
  return /*#__PURE__*/React.createElement("section", _extends({
    onMouseEnter: interactive ? () => setHover(true) : undefined,
    onMouseLeave: interactive ? () => setHover(false) : undefined,
    style: {
      borderRadius: 'var(--radius-' + radius + ')',
      display: 'flex',
      flexDirection: 'column',
      minWidth: 0,
      transition: 'var(--transition-surface)',
      cursor: interactive ? 'pointer' : undefined,
      ...s,
      boxShadow: interactive && hover ? 'var(--shadow-raised)' : s.boxShadow,
      ...style
    }
  }, rest), title || action ? /*#__PURE__*/React.createElement("header", {
    style: {
      display: 'flex',
      alignItems: 'flex-start',
      justifyContent: 'space-between',
      gap: 12,
      padding: padding,
      paddingBottom: children ? 'var(--gap-stack)' : padding
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      minWidth: 0
    }
  }, title ? /*#__PURE__*/React.createElement("h3", {
    style: {
      font: 'var(--type-card-title)',
      color: dark ? 'var(--grey-0)' : 'var(--text-strong)'
    }
  }, title) : null, subtitle ? /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: dark ? 'var(--forest-200)' : 'var(--text-muted)',
      marginTop: 3
    }
  }, subtitle) : null), action ? /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '0 0 auto',
      display: 'flex',
      gap: 8,
      alignItems: 'center'
    }
  }, action) : null) : null, children ? /*#__PURE__*/React.createElement("div", {
    style: {
      padding: padding,
      paddingTop: title || action ? 0 : padding,
      flex: 1,
      minWidth: 0,
      ...bodyStyle
    }
  }, children) : null);
}
Object.assign(__ds_scope, { Card });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Card.jsx", error: String((e && e.message) || e) }); }

// components/core/Icon.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Lucide outline glyph. Renders an <i data-lucide> and lets the global lucide
   UMD script swap it for an SVG, inheriting currentColor. See readme > ICONOGRAPHY. */
function Icon({
  name,
  size = 20,
  strokeWidth = 1.75,
  style,
  ...rest
}) {
  const ref = React.useRef(null);
  React.useEffect(() => {
    if (window.lucide && window.lucide.createIcons) window.lucide.createIcons();
  });
  return /*#__PURE__*/React.createElement("i", _extends({
    ref: ref,
    "data-lucide": name,
    "aria-hidden": "true",
    style: {
      width: size + 'px',
      height: size + 'px',
      strokeWidth,
      flex: '0 0 auto',
      display: 'inline-block',
      ...style
    }
  }, rest));
}
Object.assign(__ds_scope, { Icon });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Icon.jsx", error: String((e && e.message) || e) }); }

// components/core/Badge.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const TONES = {
  success: {
    color: 'var(--status-success-fg)',
    background: 'var(--status-success-bg)'
  },
  pending: {
    color: 'var(--status-pending-fg)',
    background: 'var(--status-pending-bg)'
  },
  warning: {
    color: 'var(--status-warning-fg)',
    background: 'var(--status-warning-bg)'
  },
  neutral: {
    color: 'var(--status-neutral-fg)',
    background: 'var(--status-neutral-bg)'
  },
  accent: {
    color: 'var(--forest-800)',
    background: 'var(--green-200)'
  },
  dark: {
    color: 'var(--grey-0)',
    background: 'var(--forest-800)'
  }
};
function Badge({
  tone = 'neutral',
  size = 'md',
  icon,
  delta,
  children,
  style,
  ...rest
}) {
  const t = TONES[tone] || TONES.neutral;
  const small = size === 'sm';
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 4,
      padding: small ? '3px 8px' : '5px 11px',
      borderRadius: 'var(--radius-badge)',
      font: 'var(--weight-semibold) ' + (small ? '11px' : '12px') + '/1.2 var(--font-ui)',
      whiteSpace: 'nowrap',
      ...t,
      ...style
    }
  }, rest), icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: small ? 12 : 14
  }) : null, delta ? /*#__PURE__*/React.createElement("span", {
    style: {
      fontFamily: 'var(--font-tabular)'
    }
  }, delta) : null, children);
}
Object.assign(__ds_scope, { Badge });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Badge.jsx", error: String((e && e.message) || e) }); }

// components/core/Button.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function useInteractive() {
  const [hover, setHover] = React.useState(false);
  const [press, setPress] = React.useState(false);
  return {
    hover,
    press,
    bind: {
      onMouseEnter: () => setHover(true),
      onMouseLeave: () => {
        setHover(false);
        setPress(false);
      },
      onMouseDown: () => setPress(true),
      onMouseUp: () => setPress(false)
    }
  };
}
const SIZES = {
  sm: {
    height: 'var(--control-h-sm)',
    padding: '0 14px',
    font: 'var(--weight-semibold) 13px/1 var(--font-ui)',
    icon: 16
  },
  md: {
    height: 'var(--control-h)',
    padding: '0 20px',
    font: 'var(--weight-semibold) 14px/1 var(--font-ui)',
    icon: 18
  },
  lg: {
    height: 'var(--control-h-lg)',
    padding: '0 28px',
    font: 'var(--weight-semibold) 15px/1 var(--font-ui)',
    icon: 20
  }
};
function skin(variant, hover) {
  switch (variant) {
    case 'dark':
      return {
        background: hover ? 'var(--forest-700)' : 'var(--forest-800)',
        color: 'var(--text-on-dark)',
        border: '1px solid transparent'
      };
    case 'secondary':
      return {
        background: hover ? 'var(--surface-hover)' : 'var(--surface-card)',
        color: 'var(--text-strong)',
        border: '1px solid var(--border-default)'
      };
    case 'ghost':
      return {
        background: hover ? 'var(--surface-hover)' : 'transparent',
        color: 'var(--text-strong)',
        border: '1px solid transparent'
      };
    case 'onAccent':
      return {
        background: hover ? 'var(--grey-50)' : 'var(--grey-0)',
        color: 'var(--forest-800)',
        border: '1px solid transparent'
      };
    case 'danger':
      return {
        background: hover ? 'var(--red-600)' : 'var(--red-500)',
        color: 'var(--grey-0)',
        border: '1px solid transparent'
      };
    default:
      return {
        background: hover ? 'var(--green-600)' : 'var(--green-500)',
        color: 'var(--text-on-accent)',
        border: '1px solid transparent'
      };
  }
}
function Button({
  variant = 'primary',
  size = 'md',
  icon,
  iconAfter,
  glyph,
  fullWidth = false,
  disabled = false,
  href,
  children,
  style,
  ...rest
}) {
  const {
    hover,
    press,
    bind
  } = useInteractive();
  const s = SIZES[size] || SIZES.md;
  const Tag = href ? 'a' : 'button';
  return /*#__PURE__*/React.createElement(Tag, _extends({
    href: href,
    disabled: Tag === 'button' ? disabled : undefined
  }, bind, {
    style: {
      display: fullWidth ? 'flex' : 'inline-flex',
      width: fullWidth ? '100%' : undefined,
      alignItems: 'center',
      justifyContent: 'center',
      gap: 'var(--gap-inline)',
      height: s.height,
      padding: s.padding,
      font: s.font,
      borderRadius: 'var(--radius-control)',
      letterSpacing: 'var(--tracking-normal)',
      cursor: disabled ? 'not-allowed' : 'pointer',
      opacity: disabled ? 0.4 : 1,
      textDecoration: 'none',
      whiteSpace: 'nowrap',
      transform: press && !disabled ? 'scale(var(--press-scale))' : 'none',
      transition: 'var(--transition-control), transform var(--duration-instant) var(--ease-out)',
      boxShadow: variant === 'primary' && hover && !disabled ? 'var(--shadow-accent)' : 'none',
      ...skin(variant, hover && !disabled),
      ...style
    }
  }, rest), icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: s.icon
  }) : null, /*#__PURE__*/React.createElement("span", null, children), glyph ? /*#__PURE__*/React.createElement("span", {
    style: {
      fontSize: '1.05em',
      lineHeight: 1
    }
  }, glyph) : null, iconAfter ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: iconAfter,
    size: s.icon
  }) : null);
}
Object.assign(__ds_scope, { Button });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Button.jsx", error: String((e && e.message) || e) }); }

// components/core/IconButton.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const SIZES = {
  sm: 32,
  md: 40,
  lg: 48,
  xl: 56
};
const GLYPH = {
  sm: 16,
  md: 20,
  lg: 22,
  xl: 26
};
function IconButton({
  icon,
  variant = 'tile',
  size = 'md',
  label,
  active = false,
  disabled = false,
  style,
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  const px = SIZES[size] || SIZES.md;
  const skins = {
    tile: {
      background: hover ? 'var(--grey-0)' : 'var(--surface-tile)',
      border: '1px solid var(--border-hairline)',
      color: 'var(--forest-800)'
    },
    plain: {
      background: hover ? 'var(--surface-hover)' : 'transparent',
      border: '1px solid transparent',
      color: 'var(--text-muted)'
    },
    solid: {
      background: hover ? 'var(--forest-700)' : 'var(--forest-800)',
      border: '1px solid transparent',
      color: 'var(--grey-0)'
    },
    accent: {
      background: hover ? 'var(--green-600)' : 'var(--green-500)',
      border: '1px solid transparent',
      color: 'var(--forest-800)'
    },
    onAccent: {
      background: 'var(--grey-0)',
      border: '1px solid transparent',
      color: 'var(--forest-800)'
    }
  };
  const skin = active ? {
    background: 'var(--surface-accent-faint)',
    border: '1px solid var(--border-accent)',
    color: 'var(--forest-700)'
  } : skins[variant] || skins.tile;
  return /*#__PURE__*/React.createElement("button", _extends({
    "aria-label": label,
    disabled: disabled,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => setHover(false),
    style: {
      width: px,
      height: px,
      minWidth: px,
      display: 'inline-grid',
      placeItems: 'center',
      borderRadius: 'var(--radius-control)',
      cursor: disabled ? 'not-allowed' : 'pointer',
      opacity: disabled ? 0.4 : 1,
      transition: 'var(--transition-control)',
      ...skin,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: GLYPH[size] || 20
  }));
}
Object.assign(__ds_scope, { IconButton });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/IconButton.jsx", error: String((e && e.message) || e) }); }

// components/core/Logo.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
const ASSETS = {
  lockup: 'assets/logo-lockup.png',
  mark: 'assets/logo-mark.png',
  wordmark: 'assets/logo-wordmark.png',
  lockupOnDark: 'assets/logo-lockup-on-dark.png'
};
function Logo({
  variant = 'lockup',
  height = 32,
  base = '',
  withName = false,
  onDark = false,
  style,
  ...rest
}) {
  const key = variant === 'lockup' && onDark ? 'lockupOnDark' : variant;
  const src = (base ? base.replace(/\/$/, '') + '/' : '') + ASSETS[key];
  if (variant === 'mark' && withName) {
    return /*#__PURE__*/React.createElement("span", _extends({
      style: {
        display: 'inline-flex',
        alignItems: 'center',
        gap: 10,
        ...style
      }
    }, rest), /*#__PURE__*/React.createElement("img", {
      src: src,
      alt: "",
      style: {
        height,
        width: height,
        borderRadius: 'calc(' + height + 'px * 0.28)'
      }
    }), /*#__PURE__*/React.createElement("span", {
      style: {
        font: 'var(--weight-semibold) ' + Math.round(height * 0.62) + 'px/1 var(--font-display)',
        letterSpacing: 'var(--tracking-tight)',
        color: onDark ? 'var(--grey-0)' : 'var(--forest-800)'
      }
    }, "Libera", /*#__PURE__*/React.createElement("span", {
      style: {
        color: 'var(--green-500)'
      }
    }, "Cash")));
  }
  return /*#__PURE__*/React.createElement("img", _extends({
    src: src,
    alt: "Libera Cash",
    style: {
      height,
      width: 'auto',
      display: 'block',
      ...style
    }
  }, rest));
}
Object.assign(__ds_scope, { Logo });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/core/Logo.jsx", error: String((e && e.message) || e) }); }

// components/data/AreaChart.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Smooth single- or dual-series area chart. SVG path, --chart-area-fill under the line. */
function path(points, w, h, max, min) {
  const span = max - min || 1;
  const step = points.length > 1 ? w / (points.length - 1) : w;
  const pts = points.map((v, i) => [i * step, h - (v - min) / span * h]);
  let d = 'M ' + pts[0][0] + ' ' + pts[0][1];
  for (let i = 0; i < pts.length - 1; i++) {
    const [x0, y0] = pts[i],
      [x1, y1] = pts[i + 1];
    const cx = (x0 + x1) / 2;
    d += ' C ' + cx + ' ' + y0 + ', ' + cx + ' ' + y1 + ', ' + x1 + ' ' + y1;
  }
  return {
    d,
    pts
  };
}
function AreaChart({
  series = [],
  compare,
  height = 180,
  yTicks = [],
  xLabels = [],
  marker,
  fill = true,
  style,
  ...rest
}) {
  const W = 600,
    H = height - (xLabels.length ? 22 : 0);
  const all = series.concat(compare || []);
  const max = Math.max(...all, 1),
    min = Math.min(...all, 0);
  const main = series.length ? path(series, W, H, max, min) : null;
  const cmp = compare && compare.length ? path(compare, W, H, max, min) : null;
  const mk = main && marker != null && main.pts[marker] ? main.pts[marker] : null;
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      display: 'flex',
      gap: 10,
      minWidth: 0,
      ...style
    }
  }, rest), yTicks.length ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'space-between',
      height: H,
      font: 'var(--weight-medium) 10px/1 var(--font-tabular)',
      color: 'var(--chart-axis-label)',
      flex: '0 0 auto',
      textAlign: 'right'
    }
  }, yTicks.map(t => /*#__PURE__*/React.createElement("span", {
    key: t
  }, t))) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1,
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("svg", {
    viewBox: '0 0 ' + W + ' ' + H,
    preserveAspectRatio: "none",
    style: {
      width: '100%',
      height: H,
      display: 'block',
      overflow: 'visible'
    }
  }, /*#__PURE__*/React.createElement("defs", null, /*#__PURE__*/React.createElement("linearGradient", {
    id: "lcAreaFill",
    x1: "0",
    y1: "0",
    x2: "0",
    y2: "1"
  }, /*#__PURE__*/React.createElement("stop", {
    offset: "0%",
    stopColor: "var(--green-500)",
    stopOpacity: "0.28"
  }), /*#__PURE__*/React.createElement("stop", {
    offset: "100%",
    stopColor: "var(--green-500)",
    stopOpacity: "0"
  }))), cmp ? /*#__PURE__*/React.createElement("path", {
    d: cmp.d,
    fill: "none",
    stroke: "var(--chart-series-1)",
    strokeWidth: "2.5",
    strokeLinecap: "round",
    vectorEffect: "non-scaling-stroke"
  }) : null, main && fill ? /*#__PURE__*/React.createElement("path", {
    d: main.d + ' L ' + W + ' ' + H + ' L 0 ' + H + ' Z',
    fill: "url(#lcAreaFill)",
    stroke: "none"
  }) : null, main ? /*#__PURE__*/React.createElement("path", {
    d: main.d,
    fill: "none",
    stroke: "var(--chart-series-2)",
    strokeWidth: "2.5",
    strokeLinecap: "round",
    vectorEffect: "non-scaling-stroke"
  }) : null, mk ? /*#__PURE__*/React.createElement("line", {
    x1: mk[0],
    y1: "0",
    x2: mk[0],
    y2: H,
    stroke: "var(--green-500)",
    strokeWidth: "1.5",
    strokeDasharray: "4 4",
    vectorEffect: "non-scaling-stroke"
  }) : null), mk ? /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      height: 0
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      position: 'absolute',
      left: mk[0] / W * 100 + '%',
      top: -H + mk[1] - 5,
      width: 10,
      height: 10,
      borderRadius: '50%',
      background: 'var(--green-500)',
      border: '2px solid var(--grey-0)',
      boxShadow: 'var(--shadow-sm)',
      transform: 'translateX(-50%)'
    }
  })) : null, xLabels.length ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      justifyContent: 'space-between',
      marginTop: 8,
      font: 'var(--weight-medium) 10px/1 var(--font-tabular)',
      color: 'var(--chart-axis-label)'
    }
  }, xLabels.map((l, i) => /*#__PURE__*/React.createElement("span", {
    key: i
  }, l))) : null));
}
Object.assign(__ds_scope, { AreaChart });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/AreaChart.jsx", error: String((e && e.message) || e) }); }

// components/data/BalanceCard.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* The hero balance card: --gradient-hero plus the blurred ribbon motif.
   The one decorative element in the system (readme > VISUAL FOUNDATIONS > Backgrounds). */
function BalanceCard({
  label = 'Total Balance',
  amount,
  currency,
  actions,
  note,
  height,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      overflow: 'hidden',
      minWidth: 0,
      height,
      borderRadius: 'var(--radius-card)',
      background: 'var(--gradient-hero)',
      padding: 'var(--pad-card)',
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'space-between',
      gap: 20,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      position: 'absolute',
      top: '-42%',
      right: '-14%',
      width: 300,
      height: 300,
      borderRadius: '50%',
      border: '30px solid rgba(255,255,255,.22)',
      filter: 'blur(7px)',
      pointerEvents: 'none'
    }
  }), /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      position: 'absolute',
      bottom: '-52%',
      left: '-18%',
      width: 270,
      height: 270,
      borderRadius: '50%',
      border: '24px solid rgba(255,255,255,.18)',
      filter: 'blur(6px)',
      pointerEvents: 'none'
    }
  }), /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      position: 'absolute',
      top: '18%',
      right: '22%',
      width: 150,
      height: 150,
      borderRadius: '50%',
      border: '16px solid rgba(255,255,255,.14)',
      filter: 'blur(8px)',
      pointerEvents: 'none'
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--weight-medium) 14px/1.2 var(--font-ui)',
      color: 'var(--forest-800)'
    }
  }, label), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-hero)/1.05 var(--font-numeric)',
      color: 'var(--forest-900)',
      marginTop: 3,
      display: 'flex',
      alignItems: 'baseline',
      gap: 8,
      flexWrap: 'wrap'
    }
  }, amount, currency ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--weight-medium) 17px/1 var(--font-ui)',
      color: 'var(--forest-700)'
    }
  }, currency) : null), note ? /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--forest-700)',
      marginTop: 6
    }
  }, note) : null), actions ? /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      display: 'flex',
      gap: 10,
      flexWrap: 'wrap'
    }
  }, actions) : null);
}
Object.assign(__ds_scope, { BalanceCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/BalanceCard.jsx", error: String((e && e.message) || e) }); }

// components/data/BarChart.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Diverging two-series column chart: series A grows up from the zero line,
   series B down. The reference's Cashflow card. Pure CSS, no chart library. */
function BarChart({
  data = [],
  height = 200,
  labels = ['Income', 'Expense'],
  highlight,
  onHighlight,
  showLegend = true,
  showAxis = true,
  style,
  ...rest
}) {
  const max = Math.max(1, ...data.map(d => Math.max(d.a || 0, d.b || 0)));
  const half = (height - (showAxis ? 22 : 0)) / 2;
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12,
      minWidth: 0,
      ...style
    }
  }, rest), showLegend ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 16,
      justifyContent: 'flex-end'
    }
  }, [['var(--chart-series-1)', labels[0]], ['var(--chart-series-2)', labels[1]]].map(([c, l]) => /*#__PURE__*/React.createElement("span", {
    key: l,
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 6,
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 9,
      height: 9,
      borderRadius: 2,
      background: c
    }
  }), l))) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'stretch',
      gap: 8,
      minWidth: 0
    }
  }, showAxis ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      justifyContent: 'space-between',
      height: half * 2,
      font: 'var(--weight-medium) 10px/1 var(--font-tabular)',
      color: 'var(--chart-axis-label)',
      flex: '0 0 auto',
      textAlign: 'right'
    }
  }, /*#__PURE__*/React.createElement("span", null, "8K"), /*#__PURE__*/React.createElement("span", null, "4K"), /*#__PURE__*/React.createElement("span", null, "0"), /*#__PURE__*/React.createElement("span", null, "-4K"), /*#__PURE__*/React.createElement("span", null, "-8K")) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1,
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative',
      height: half * 2,
      display: 'flex',
      alignItems: 'center',
      gap: 'clamp(3px,0.8%,10px)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      left: 0,
      right: 0,
      top: '50%',
      height: 1,
      background: 'var(--chart-grid)'
    }
  }), data.map((d, i) => {
    const on = highlight === i;
    return /*#__PURE__*/React.createElement("div", {
      key: i,
      onMouseEnter: () => onHighlight && onHighlight(i),
      onMouseLeave: () => onHighlight && onHighlight(null),
      style: {
        flex: 1,
        minWidth: 0,
        height: '100%',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        cursor: onHighlight ? 'pointer' : 'default',
        position: 'relative'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        height: half,
        display: 'flex',
        alignItems: 'flex-end'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        width: '100%',
        height: (d.a || 0) / max * half,
        background: 'var(--chart-series-1)',
        borderRadius: '5px 5px 0 0',
        opacity: highlight == null || on ? 1 : 0.45,
        transition: 'opacity var(--duration-fast) var(--ease-out), height var(--duration-chart) var(--ease-out)'
      }
    })), /*#__PURE__*/React.createElement("div", {
      style: {
        height: half,
        display: 'flex',
        alignItems: 'flex-start'
      }
    }, /*#__PURE__*/React.createElement("div", {
      style: {
        width: '100%',
        height: (d.b || 0) / max * half,
        background: 'var(--chart-series-2)',
        borderRadius: '0 0 5px 5px',
        opacity: highlight == null || on ? 1 : 0.45,
        transition: 'opacity var(--duration-fast) var(--ease-out), height var(--duration-chart) var(--ease-out)'
      }
    })));
  })), showAxis ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 'clamp(3px,0.8%,10px)',
      marginTop: 8
    }
  }, data.map((d, i) => /*#__PURE__*/React.createElement("span", {
    key: i,
    style: {
      flex: 1,
      textAlign: 'center',
      font: 'var(--weight-medium) 10px/1 var(--font-tabular)',
      color: highlight === i ? 'var(--text-strong)' : 'var(--chart-axis-label)',
      overflow: 'hidden'
    }
  }, d.label))) : null)));
}
Object.assign(__ds_scope, { BarChart });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/BarChart.jsx", error: String((e && e.message) || e) }); }

// components/data/CardTile.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Miniature payment-card thumbnail used in card pickers and wallet lists.
   Not a real card rendering — a 1.58:1 chip with a scheme wordmark. */
const TONES = {
  green: {
    background: 'linear-gradient(135deg,#9AE472 0%,#6BCE52 100%)',
    color: 'var(--forest-800)'
  },
  dark: {
    background: 'linear-gradient(135deg,#16562D 0%,#07231A 100%)',
    color: 'var(--grey-0)'
  },
  grey: {
    background: 'linear-gradient(135deg,#BFBFBF 0%,#8A8A8A 100%)',
    color: 'var(--grey-0)'
  }
};
function CardTile({
  scheme = 'visa',
  tone = 'green',
  width = 56,
  style,
  ...rest
}) {
  const t = TONES[tone] || TONES.green;
  const h = Math.round(width / 1.58);
  return /*#__PURE__*/React.createElement("span", _extends({
    style: {
      width,
      height: h,
      borderRadius: Math.max(4, Math.round(width * 0.09)),
      display: 'flex',
      alignItems: 'flex-start',
      justifyContent: 'flex-start',
      padding: Math.round(width * 0.08),
      flex: '0 0 auto',
      overflow: 'hidden',
      boxShadow: 'var(--shadow-xs)',
      ...t,
      ...style
    }
  }, rest), scheme === 'visa' ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--weight-bold) ' + Math.round(width * 0.16) + 'px/1 var(--font-display)',
      letterSpacing: '0.02em',
      fontStyle: 'italic'
    }
  }, "VISA") : scheme === 'mastercard' ? /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: Math.round(width * 0.16),
      height: Math.round(width * 0.16),
      borderRadius: '50%',
      background: 'currentColor',
      opacity: 0.95
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: Math.round(width * 0.16),
      height: Math.round(width * 0.16),
      borderRadius: '50%',
      background: 'currentColor',
      opacity: 0.55,
      marginLeft: Math.round(width * -0.06)
    }
  })) : null);
}
Object.assign(__ds_scope, { CardTile });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/CardTile.jsx", error: String((e && e.message) || e) }); }

// components/data/DonutChart.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Ring chart drawn with conic-gradient. Centre slot carries the label + total. */
function DonutChart({
  segments = [],
  size = 180,
  thickness = 26,
  label,
  value,
  style,
  ...rest
}) {
  const total = segments.reduce((s, x) => s + (x.value || 0), 0) || 1;
  let acc = 0;
  const stops = segments.map(s => {
    const from = acc / total * 360;
    acc += s.value || 0;
    const to = acc / total * 360;
    return (s.color || 'var(--chart-series-2)') + ' ' + from + 'deg ' + to + 'deg';
  }).join(',');
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      width: size,
      height: size,
      flex: '0 0 auto',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      width: '100%',
      height: '100%',
      borderRadius: '50%',
      background: 'conic-gradient(from -90deg,' + stops + ')'
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      inset: thickness,
      borderRadius: '50%',
      background: 'var(--surface-card)',
      boxShadow: '0 0 0 4px var(--surface-card)',
      display: 'grid',
      placeItems: 'center',
      textAlign: 'center',
      padding: 8
    }
  }, /*#__PURE__*/React.createElement("div", null, label ? /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, label) : null, value ? /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-2)/1.1 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, value) : null)));
}
Object.assign(__ds_scope, { DonutChart });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/DonutChart.jsx", error: String((e && e.message) || e) }); }

// components/data/ProgressBar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function ProgressBar({
  value = 0,
  tone = 'accent',
  height = 8,
  track = 'soft',
  label,
  caption,
  style,
  ...rest
}) {
  const pct = Math.max(0, Math.min(100, value));
  const fills = {
    accent: 'var(--green-500)',
    dark: 'var(--forest-800)',
    split: 'linear-gradient(90deg,var(--forest-800) 0 60%,var(--green-500) 60% 100%)'
  };
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 7,
      minWidth: 0,
      ...style
    }
  }, rest), label || caption ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      justifyContent: 'space-between',
      gap: 10,
      alignItems: 'baseline'
    }
  }, label ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-strong)'
    }
  }, label) : null, caption ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      fontFamily: 'var(--font-tabular)'
    }
  }, caption) : null) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      height,
      borderRadius: 'var(--radius-pill)',
      background: track === 'soft' ? 'var(--green-100)' : 'var(--grey-150)',
      overflow: 'hidden'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      width: pct + '%',
      height: '100%',
      borderRadius: 'var(--radius-pill)',
      background: fills[tone] || fills.accent,
      transition: 'width var(--duration-chart) var(--ease-out)'
    }
  })));
}
Object.assign(__ds_scope, { ProgressBar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/ProgressBar.jsx", error: String((e && e.message) || e) }); }

// components/data/StatCard.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function StatCard({
  label,
  value,
  delta,
  deltaTone = 'success',
  icon,
  surface = 'hairline',
  action,
  footer,
  style,
  ...rest
}) {
  const skins = {
    hairline: {
      background: 'var(--surface-card)',
      border: '1px solid var(--border-hairline)',
      boxShadow: 'none'
    },
    card: {
      background: 'var(--surface-card)',
      border: '1px solid transparent',
      boxShadow: 'var(--shadow-card)'
    },
    tile: {
      background: 'var(--surface-tile)',
      border: '1px solid var(--border-hairline)',
      boxShadow: 'none'
    },
    accent: {
      background: 'var(--surface-accent-faint)',
      border: '1px solid var(--border-accent)',
      boxShadow: 'none'
    }
  };
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 10,
      minWidth: 0,
      padding: 'var(--pad-card-sm)',
      borderRadius: 'var(--radius-card-inner)',
      ...(skins[surface] || skins.hairline),
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8,
      minWidth: 0
    }
  }, icon ? /*#__PURE__*/React.createElement("span", {
    style: {
      width: 28,
      height: 28,
      borderRadius: '50%',
      flex: '0 0 auto',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--surface-accent-faint)',
      color: 'var(--forest-700)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 15
  })) : null, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-muted)',
      overflow: 'hidden',
      textOverflow: 'ellipsis',
      whiteSpace: 'nowrap'
    }
  }, label)), action ? /*#__PURE__*/React.createElement("span", {
    style: {
      flex: '0 0 auto'
    }
  }, action) : null), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'baseline',
      gap: 8,
      flexWrap: 'wrap'
    }
  }, /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-2)/1.05 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, value), delta ? /*#__PURE__*/React.createElement(__ds_scope.Badge, {
    tone: deltaTone,
    size: "sm",
    delta: delta
  }) : null), footer ? /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)'
    }
  }, footer) : null);
}
Object.assign(__ds_scope, { StatCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/StatCard.jsx", error: String((e && e.message) || e) }); }

// components/feedback/AIPromptPanel.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function AIPromptPanel({
  heading = 'What Can I help with?',
  subheading,
  suggestions = [],
  orbSize = 100,
  placeholder = 'Ask anything…',
  model,
  onSend,
  tools = ['mic', 'paperclip', 'image'],
  compact = false,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: compact ? 14 : 20,
      minWidth: 0,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      gap: 10,
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      width: orbSize,
      height: orbSize,
      borderRadius: '50%',
      background: 'var(--gradient-ai-orb)',
      filter: 'blur(5px)'
    }
  }), /*#__PURE__*/React.createElement("h3", {
    style: {
      font: 'var(--weight-semibold) ' + (compact ? '17px' : 'var(--text-title-2)') + '/1.2 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, heading), subheading ? /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-body)',
      color: 'var(--text-muted)',
      maxWidth: 420
    }
  }, subheading) : null), suggestions.length ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexWrap: 'wrap',
      gap: 8,
      justifyContent: 'center'
    }
  }, suggestions.map(s => /*#__PURE__*/React.createElement("span", {
    key: s,
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 6,
      padding: '7px 13px',
      borderRadius: 'var(--radius-pill)',
      background: 'var(--surface-card)',
      border: '1px solid var(--border-hairline)',
      font: 'var(--weight-medium) 12px/1 var(--font-ui)',
      color: 'var(--text-muted)',
      cursor: 'pointer'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "sparkles",
    size: 13
  }), s))) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      background: 'var(--surface-card)',
      border: '1px solid var(--border-hairline)',
      borderRadius: 'var(--radius-card-inner)',
      padding: 12,
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 9,
      color: 'var(--text-subtle)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "wand-sparkles",
    size: 17
  }), /*#__PURE__*/React.createElement("input", {
    placeholder: placeholder,
    style: {
      flex: 1,
      minWidth: 0,
      border: 'none',
      outline: 'none',
      background: 'transparent',
      font: 'var(--weight-regular) 14px/1 var(--font-ui)',
      color: 'var(--text-strong)'
    }
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 10,
      flexWrap: 'wrap'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 6,
      alignItems: 'center'
    }
  }, tools.map(t => /*#__PURE__*/React.createElement(__ds_scope.IconButton, {
    key: t,
    icon: t,
    variant: "plain",
    size: "sm",
    label: t
  })), model ? /*#__PURE__*/React.createElement("span", {
    style: {
      marginLeft: 4,
      padding: '6px 12px',
      borderRadius: 'var(--radius-pill)',
      background: 'var(--grey-50)',
      font: 'var(--weight-medium) 12px/1 var(--font-ui)',
      color: 'var(--text-muted)'
    }
  }, model) : null), /*#__PURE__*/React.createElement(__ds_scope.Button, {
    variant: "primary",
    size: "sm",
    icon: "arrow-up",
    onClick: onSend
  }, "Send"))));
}
Object.assign(__ds_scope, { AIPromptPanel });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/AIPromptPanel.jsx", error: String((e && e.message) || e) }); }

// components/feedback/Dropdown.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Dropdown({
  trigger,
  items = [],
  align = 'right',
  onSelect,
  style,
  ...rest
}) {
  const [open, setOpen] = React.useState(false);
  const [hover, setHover] = React.useState(null);
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      display: 'inline-flex',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    onClick: () => setOpen(!open),
    style: {
      display: 'inline-flex',
      cursor: 'pointer'
    }
  }, trigger), open ? /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("span", {
    onClick: () => setOpen(false),
    style: {
      position: 'fixed',
      inset: 0,
      zIndex: 39
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      top: 'calc(100% + 8px)',
      zIndex: 40,
      minWidth: 190,
      left: align === 'left' ? 0 : 'auto',
      right: align === 'right' ? 0 : 'auto',
      background: 'var(--surface-card)',
      borderRadius: 'var(--radius-card-inner)',
      border: '1px solid var(--border-hairline)',
      boxShadow: 'var(--shadow-popover)',
      padding: 6,
      display: 'flex',
      flexDirection: 'column',
      gap: 1
    }
  }, items.map((it, i) => it.divider ? /*#__PURE__*/React.createElement("span", {
    key: i,
    style: {
      height: 1,
      background: 'var(--border-hairline)',
      margin: '5px 6px'
    }
  }) : /*#__PURE__*/React.createElement("button", {
    key: i,
    onMouseEnter: () => setHover(i),
    onMouseLeave: () => setHover(null),
    onClick: () => {
      setOpen(false);
      if (onSelect) onSelect(it.value != null ? it.value : it.label);
    },
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10,
      padding: '9px 11px',
      cursor: 'pointer',
      borderRadius: 'var(--radius-sm)',
      textAlign: 'left',
      border: 'none',
      background: hover === i ? 'var(--surface-hover)' : 'transparent',
      color: it.tone === 'danger' ? 'var(--text-negative)' : 'var(--text-body)',
      font: 'var(--weight-medium) 13px/1.3 var(--font-ui)',
      whiteSpace: 'nowrap'
    }
  }, it.icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: it.icon,
    size: 16
  }) : null, /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1
    }
  }, it.label), it.meta ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)'
    }
  }, it.meta) : null)))) : null);
}
Object.assign(__ds_scope, { Dropdown });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/Dropdown.jsx", error: String((e && e.message) || e) }); }

// components/feedback/Tooltip.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
/* Two jobs: a hover hint on a control, and the chart value card. */
function Tooltip({
  title,
  rows = [],
  caption,
  variant = 'card',
  children,
  placement = 'top',
  style,
  ...rest
}) {
  const [open, setOpen] = React.useState(false);
  const bubble = variant === 'plain' ? {
    background: 'var(--forest-800)',
    color: 'var(--grey-0)',
    padding: '7px 11px',
    font: 'var(--weight-medium) 12px/1.3 var(--font-ui)',
    border: '1px solid transparent'
  } : {
    background: 'var(--surface-card)',
    color: 'var(--text-body)',
    padding: '10px 12px',
    border: '1px solid var(--border-hairline)'
  };
  const pos = placement === 'top' ? {
    bottom: 'calc(100% + 8px)',
    left: '50%',
    transform: 'translateX(-50%)'
  } : {
    top: 'calc(100% + 8px)',
    left: '50%',
    transform: 'translateX(-50%)'
  };
  const content = /*#__PURE__*/React.createElement("div", {
    role: "tooltip",
    style: {
      position: 'absolute',
      zIndex: 45,
      minWidth: 130,
      whiteSpace: 'nowrap',
      borderRadius: 'var(--radius-card-inner)',
      boxShadow: 'var(--shadow-popover)',
      ...pos,
      ...bubble
    }
  }, title ? /*#__PURE__*/React.createElement("div", {
    style: {
      font: variant === 'plain' ? 'inherit' : 'var(--weight-medium) 12px/1.2 var(--font-ui)',
      color: variant === 'plain' ? 'inherit' : 'var(--text-muted)'
    }
  }, title) : null, rows.map((r, i) => /*#__PURE__*/React.createElement("div", {
    key: i,
    style: {
      display: 'flex',
      justifyContent: 'space-between',
      gap: 18,
      marginTop: 5
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, r.label), /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 13px/1.2 var(--font-numeric)',
      color: r.tone === 'negative' ? 'var(--text-negative)' : 'var(--text-strong)'
    }
  }, r.value))), caption ? /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)',
      marginTop: 5
    }
  }, caption) : null);
  if (!children) return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      display: 'inline-block',
      ...style
    }
  }, rest), content);
  return /*#__PURE__*/React.createElement("span", _extends({
    onMouseEnter: () => setOpen(true),
    onMouseLeave: () => setOpen(false),
    style: {
      position: 'relative',
      display: 'inline-flex',
      ...style
    }
  }, rest), children, open ? content : null);
}
Object.assign(__ds_scope, { Tooltip });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/Tooltip.jsx", error: String((e && e.message) || e) }); }

// components/feedback/UpgradeCard.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function UpgradeCard({
  title = 'Upgrade plan',
  body = '“Upgrade Libera Cash today to unlock smarter insights and financial control.”',
  cta = 'Upgrade your Plan',
  icon = 'layers',
  onAction,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      background: 'var(--surface-card)',
      border: '1px solid var(--border-hairline)',
      borderRadius: 'var(--radius-card)',
      boxShadow: 'var(--shadow-xs)',
      padding: 'var(--pad-card)',
      textAlign: 'center',
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      gap: 8,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 40,
      height: 40,
      borderRadius: '50%',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--surface-accent-faint)',
      color: 'var(--forest-700)'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 20
  })), /*#__PURE__*/React.createElement("h4", {
    style: {
      font: 'var(--weight-semibold) 15px/1.2 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, title), /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, body), /*#__PURE__*/React.createElement(__ds_scope.Button, {
    variant: "dark",
    size: "sm",
    glyph: "\u2197",
    fullWidth: true,
    onClick: onAction,
    style: {
      marginTop: 4
    }
  }, cta));
}
Object.assign(__ds_scope, { UpgradeCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/feedback/UpgradeCard.jsx", error: String((e && e.message) || e) }); }

// components/forms/Checkbox.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Checkbox({
  checked = false,
  onChange,
  label,
  disabled = false,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 10,
      cursor: disabled ? 'not-allowed' : 'pointer',
      opacity: disabled ? 0.4 : 1,
      ...style
    }
  }, /*#__PURE__*/React.createElement("input", _extends({
    type: "checkbox",
    checked: checked,
    onChange: onChange,
    disabled: disabled,
    style: {
      position: 'absolute',
      opacity: 0,
      width: 0,
      height: 0
    }
  }, rest)), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 18,
      height: 18,
      borderRadius: 5,
      flex: '0 0 auto',
      display: 'grid',
      placeItems: 'center',
      background: checked ? 'var(--forest-800)' : 'var(--surface-card)',
      border: '1px solid ' + (checked ? 'var(--forest-800)' : 'var(--border-strong)'),
      color: 'var(--green-400)',
      transition: 'var(--transition-control)'
    }
  }, checked ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "check",
    size: 13,
    style: {
      strokeWidth: 3
    }
  }) : null), label ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-body)'
    }
  }, label) : null);
}
Object.assign(__ds_scope, { Checkbox });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Checkbox.jsx", error: String((e && e.message) || e) }); }

// components/data/DataTable.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function DataTable({
  columns = [],
  rows = [],
  selectable = false,
  selected = [],
  onSelect,
  maxHeight,
  fade = false,
  style,
  ...rest
}) {
  const [hover, setHover] = React.useState(null);
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      minWidth: 0,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      overflow: 'auto',
      maxHeight
    }
  }, /*#__PURE__*/React.createElement("table", {
    style: {
      width: '100%',
      borderCollapse: 'collapse',
      fontFamily: 'var(--font-tabular)'
    }
  }, /*#__PURE__*/React.createElement("thead", null, /*#__PURE__*/React.createElement("tr", null, selectable ? /*#__PURE__*/React.createElement("th", {
    style: {
      width: 36,
      padding: '9px 0 9px 12px',
      background: 'var(--surface-card-sunken)',
      position: 'sticky',
      top: 0,
      zIndex: 1
    }
  }) : null, columns.map((c, i) => /*#__PURE__*/React.createElement("th", {
    key: i,
    style: {
      textAlign: c.align || 'left',
      padding: '9px 12px',
      whiteSpace: 'nowrap',
      font: 'var(--weight-medium) 12px/1 var(--font-tabular)',
      color: 'var(--text-subtle)',
      background: 'var(--surface-card-sunken)',
      position: 'sticky',
      top: 0,
      zIndex: 1,
      borderTopLeftRadius: i === 0 && !selectable ? 10 : 0,
      borderTopRightRadius: i === columns.length - 1 ? 10 : 0,
      width: c.width
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 4
    }
  }, c.header, c.sortable ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "chevrons-up-down",
    size: 12
  }) : null))))), /*#__PURE__*/React.createElement("tbody", null, rows.map((r, ri) => {
    const on = selected.indexOf(ri) > -1;
    return /*#__PURE__*/React.createElement("tr", {
      key: ri,
      onMouseEnter: () => setHover(ri),
      onMouseLeave: () => setHover(null),
      style: {
        background: on ? 'var(--surface-accent-faint)' : hover === ri ? 'var(--surface-hover)' : 'transparent',
        transition: 'background-color var(--duration-fast) var(--ease-out)'
      }
    }, selectable ? /*#__PURE__*/React.createElement("td", {
      style: {
        padding: '11px 0 11px 12px',
        borderBottom: '1px solid var(--border-hairline)'
      }
    }, /*#__PURE__*/React.createElement(__ds_scope.Checkbox, {
      checked: on,
      onChange: () => onSelect && onSelect(ri)
    })) : null, columns.map((c, ci) => /*#__PURE__*/React.createElement("td", {
      key: ci,
      style: {
        padding: '11px 12px',
        textAlign: c.align || 'left',
        borderBottom: '1px solid var(--border-hairline)',
        font: 'var(--type-table-cell)',
        color: 'var(--text-body)',
        whiteSpace: c.wrap ? 'normal' : 'nowrap'
      }
    }, c.render ? c.render(r, ri) : r[c.key])));
  })))), fade ? /*#__PURE__*/React.createElement("div", {
    "aria-hidden": "true",
    style: {
      position: 'absolute',
      left: 0,
      right: 0,
      bottom: 0,
      height: 56,
      background: 'var(--scrim-bottom)',
      pointerEvents: 'none'
    }
  }) : null);
}
Object.assign(__ds_scope, { DataTable });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/data/DataTable.jsx", error: String((e && e.message) || e) }); }

// components/forms/Input.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Input({
  label,
  hint,
  error,
  icon,
  suffix,
  size = 'md',
  disabled = false,
  value,
  onChange,
  placeholder,
  type = 'text',
  id,
  style,
  ...rest
}) {
  const [focus, setFocus] = React.useState(false);
  const h = size === 'lg' ? 'var(--control-h-lg)' : size === 'sm' ? 'var(--control-h-sm)' : 'var(--control-h)';
  const border = error ? 'var(--red-500)' : focus ? 'var(--border-focus)' : 'var(--border-default)';
  return /*#__PURE__*/React.createElement("label", {
    htmlFor: id,
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 6,
      minWidth: 0,
      ...style
    }
  }, label ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-strong)'
    }
  }, label) : null, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10,
      height: h,
      padding: '0 14px',
      background: disabled ? 'var(--grey-50)' : 'var(--surface-card)',
      border: '1px solid ' + border,
      borderRadius: 'var(--radius-field)',
      boxShadow: focus ? 'var(--ring-focus)' : 'none',
      transition: 'var(--transition-control)',
      opacity: disabled ? 0.55 : 1,
      color: 'var(--text-muted)'
    }
  }, icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 18
  }) : null, /*#__PURE__*/React.createElement("input", _extends({
    id: id,
    type: type,
    value: value,
    onChange: onChange,
    placeholder: placeholder,
    disabled: disabled,
    onFocus: () => setFocus(true),
    onBlur: () => setFocus(false),
    style: {
      flex: 1,
      minWidth: 0,
      border: 'none',
      outline: 'none',
      background: 'transparent',
      font: 'var(--weight-regular) 14px/1 var(--font-ui)',
      color: 'var(--text-strong)'
    }
  }, rest)), suffix ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)',
      flex: '0 0 auto'
    }
  }, suffix) : null), hint || error ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: error ? 'var(--text-negative)' : 'var(--text-subtle)'
    }
  }, error || hint) : null);
}
Object.assign(__ds_scope, { Input });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Input.jsx", error: String((e && e.message) || e) }); }

// components/forms/RadioCard.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function RadioCard({
  checked = false,
  onChange,
  leading,
  title,
  meta,
  trailing,
  style,
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  return /*#__PURE__*/React.createElement("label", _extends({
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => setHover(false),
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      cursor: 'pointer',
      padding: '12px 14px',
      borderRadius: 'var(--radius-card-inner)',
      background: checked ? 'var(--surface-accent-faint)' : hover ? 'var(--surface-hover)' : 'var(--surface-card)',
      border: '1px solid ' + (checked ? 'var(--border-accent)' : 'var(--border-hairline)'),
      transition: 'var(--transition-control)',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("input", {
    type: "radio",
    checked: checked,
    onChange: onChange,
    style: {
      position: 'absolute',
      opacity: 0,
      width: 0,
      height: 0
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 18,
      height: 18,
      borderRadius: '50%',
      flex: '0 0 auto',
      display: 'grid',
      placeItems: 'center',
      border: '1px solid ' + (checked ? 'var(--forest-700)' : 'var(--border-strong)'),
      background: 'var(--surface-card)'
    }
  }, checked ? /*#__PURE__*/React.createElement("span", {
    style: {
      width: 9,
      height: 9,
      borderRadius: '50%',
      background: 'var(--green-500)',
      boxShadow: '0 0 0 1px var(--forest-700)'
    }
  }) : null), leading ? /*#__PURE__*/React.createElement("span", {
    style: {
      flex: '0 0 auto',
      display: 'flex'
    }
  }, leading) : null, /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--weight-semibold) 15px/1.2 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, title), meta ? /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 2,
      letterSpacing: '0.06em'
    }
  }, meta) : null), trailing ? /*#__PURE__*/React.createElement("span", {
    style: {
      flex: '0 0 auto'
    }
  }, trailing) : null);
}
Object.assign(__ds_scope, { RadioCard });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/RadioCard.jsx", error: String((e && e.message) || e) }); }

// components/forms/SearchField.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function SearchField({
  placeholder = 'Search anything',
  shortcut = ['⌘', 'F'],
  value,
  onChange,
  width,
  style,
  ...rest
}) {
  const [focus, setFocus] = React.useState(false);
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10,
      height: 'var(--control-h)',
      padding: '0 8px 0 14px',
      width,
      background: 'var(--surface-card)',
      border: '1px solid ' + (focus ? 'var(--border-focus)' : 'var(--border-default)'),
      borderRadius: 'var(--radius-control)',
      boxShadow: focus ? 'var(--ring-focus)' : 'none',
      transition: 'var(--transition-control)',
      color: 'var(--text-subtle)',
      ...style
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "search",
    size: 18
  }), /*#__PURE__*/React.createElement("input", _extends({
    value: value,
    onChange: onChange,
    placeholder: placeholder,
    onFocus: () => setFocus(true),
    onBlur: () => setFocus(false),
    style: {
      flex: 1,
      minWidth: 0,
      border: 'none',
      outline: 'none',
      background: 'transparent',
      font: 'var(--weight-regular) 14px/1 var(--font-ui)',
      color: 'var(--text-strong)'
    }
  }, rest)), shortcut && shortcut.length ? /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'flex',
      gap: 4,
      flex: '0 0 auto'
    }
  }, shortcut.map(k => /*#__PURE__*/React.createElement("kbd", {
    key: k,
    style: {
      font: 'var(--weight-medium) 11px/1 var(--font-tabular)',
      color: 'var(--text-muted)',
      background: 'var(--grey-50)',
      border: '1px solid var(--border-hairline)',
      borderRadius: 6,
      padding: '5px 7px'
    }
  }, k))) : null);
}
Object.assign(__ds_scope, { SearchField });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/SearchField.jsx", error: String((e && e.message) || e) }); }

// components/forms/Select.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Select({
  value,
  options = [],
  onSelect,
  size = 'sm',
  variant = 'outline',
  icon,
  label,
  style,
  ...rest
}) {
  const [open, setOpen] = React.useState(false);
  const [hover, setHover] = React.useState(false);
  const h = size === 'md' ? 'var(--control-h)' : 'var(--control-h-sm)';
  const skins = {
    outline: {
      background: hover ? 'var(--surface-hover)' : 'var(--surface-card)',
      border: '1px solid var(--border-default)',
      color: 'var(--text-strong)'
    },
    ghost: {
      background: hover ? 'var(--surface-hover)' : 'transparent',
      border: '1px solid transparent',
      color: 'var(--text-muted)'
    },
    filled: {
      background: hover ? 'var(--grey-100)' : 'var(--grey-50)',
      border: '1px solid transparent',
      color: 'var(--text-strong)'
    }
  };
  return /*#__PURE__*/React.createElement("div", _extends({
    style: {
      position: 'relative',
      display: 'inline-flex',
      flexDirection: 'column',
      gap: 6,
      ...style
    }
  }, rest), label ? /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-strong)'
    }
  }, label) : null, /*#__PURE__*/React.createElement("button", {
    onClick: () => setOpen(!open),
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => setHover(false),
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 8,
      height: h,
      padding: '0 12px 0 14px',
      borderRadius: 'var(--radius-control)',
      cursor: 'pointer',
      font: 'var(--weight-medium) 13px/1 var(--font-ui)',
      transition: 'var(--transition-control)',
      whiteSpace: 'nowrap',
      ...skins[variant]
    }
  }, icon ? /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 16
  }) : null, /*#__PURE__*/React.createElement("span", null, value), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "chevron-down",
    size: 16,
    style: {
      transform: open ? 'rotate(180deg)' : 'none',
      transition: 'transform var(--duration-fast) var(--ease-out)'
    }
  })), open ? /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      top: 'calc(100% + 6px)',
      right: 0,
      zIndex: 40,
      minWidth: '100%',
      background: 'var(--surface-card)',
      borderRadius: 'var(--radius-card-inner)',
      boxShadow: 'var(--shadow-popover)',
      border: '1px solid var(--border-hairline)',
      padding: 6,
      display: 'flex',
      flexDirection: 'column'
    }
  }, options.map(o => /*#__PURE__*/React.createElement("button", {
    key: o,
    onClick: () => {
      setOpen(false);
      if (onSelect) onSelect(o);
    },
    style: {
      textAlign: 'left',
      padding: '8px 12px',
      borderRadius: 'var(--radius-sm)',
      cursor: 'pointer',
      background: o === value ? 'var(--surface-accent-faint)' : 'transparent',
      color: o === value ? 'var(--text-accent)' : 'var(--text-body)',
      font: 'var(--weight-medium) 13px/1.3 var(--font-ui)',
      whiteSpace: 'nowrap'
    }
  }, o))) : null);
}
Object.assign(__ds_scope, { Select });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Select.jsx", error: String((e && e.message) || e) }); }

// components/forms/Switch.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Switch({
  checked = false,
  onChange,
  label,
  description,
  disabled = false,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("label", {
    style: {
      display: 'flex',
      alignItems: description ? 'flex-start' : 'center',
      gap: 12,
      cursor: disabled ? 'not-allowed' : 'pointer',
      opacity: disabled ? 0.4 : 1,
      ...style
    }
  }, /*#__PURE__*/React.createElement("input", _extends({
    type: "checkbox",
    role: "switch",
    checked: checked,
    onChange: onChange,
    disabled: disabled,
    style: {
      position: 'absolute',
      opacity: 0,
      width: 0,
      height: 0
    }
  }, rest)), /*#__PURE__*/React.createElement("span", {
    style: {
      width: 40,
      height: 23,
      borderRadius: 'var(--radius-pill)',
      flex: '0 0 auto',
      background: checked ? 'var(--green-500)' : 'var(--grey-300)',
      padding: 3,
      display: 'flex',
      justifyContent: checked ? 'flex-end' : 'flex-start',
      transition: 'background-color var(--duration-base) var(--ease-out)',
      marginTop: description ? 2 : 0
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 17,
      height: 17,
      borderRadius: '50%',
      background: 'var(--grey-0)',
      boxShadow: 'var(--shadow-xs)',
      transition: 'transform var(--duration-base) var(--ease-out)'
    }
  })), label || description ? /*#__PURE__*/React.createElement("span", {
    style: {
      minWidth: 0
    }
  }, label ? /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--type-label)',
      color: 'var(--text-strong)'
    }
  }, label) : null, description ? /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 2
    }
  }, description) : null) : null);
}
Object.assign(__ds_scope, { Switch });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Switch.jsx", error: String((e && e.message) || e) }); }

// components/forms/Tabs.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Tabs({
  items = [],
  value,
  onChange,
  variant = 'underline',
  size = 'md',
  style,
  ...rest
}) {
  const cur = value != null ? value : items[0] && (items[0].value || items[0]);
  const norm = items.map(i => typeof i === 'string' ? {
    value: i,
    label: i
  } : i);
  if (variant === 'segmented') {
    return /*#__PURE__*/React.createElement("div", _extends({
      style: {
        display: 'inline-flex',
        gap: 4,
        padding: 4,
        background: 'var(--grey-50)',
        borderRadius: 'var(--radius-pill)',
        ...style
      }
    }, rest), norm.map(t => {
      const on = t.value === cur;
      return /*#__PURE__*/React.createElement("button", {
        key: t.value,
        onClick: () => onChange && onChange(t.value),
        style: {
          padding: '8px 16px',
          borderRadius: 'var(--radius-pill)',
          cursor: 'pointer',
          font: 'var(--weight-semibold) 13px/1 var(--font-ui)',
          background: on ? 'var(--surface-card)' : 'transparent',
          color: on ? 'var(--text-strong)' : 'var(--text-muted)',
          boxShadow: on ? 'var(--shadow-xs)' : 'none',
          transition: 'var(--transition-control)',
          whiteSpace: 'nowrap'
        }
      }, t.label);
    }));
  }
  return /*#__PURE__*/React.createElement("div", _extends({
    role: "tablist",
    style: {
      display: 'flex',
      gap: 24,
      borderBottom: '1px solid var(--border-hairline)',
      ...style
    }
  }, rest), norm.map(t => {
    const on = t.value === cur;
    return /*#__PURE__*/React.createElement("button", {
      key: t.value,
      role: "tab",
      "aria-selected": on,
      onClick: () => onChange && onChange(t.value),
      style: {
        padding: size === 'sm' ? '0 0 8px' : '0 0 11px',
        cursor: 'pointer',
        background: 'transparent',
        border: 'none',
        borderBottom: '2px solid ' + (on ? 'var(--green-500)' : 'transparent'),
        marginBottom: -1,
        font: 'var(--weight-' + (on ? 'semibold' : 'medium') + ') ' + (size === 'sm' ? '13px' : '14px') + '/1 var(--font-ui)',
        color: on ? 'var(--text-strong)' : 'var(--text-muted)',
        transition: 'var(--transition-control)',
        whiteSpace: 'nowrap',
        display: 'flex',
        alignItems: 'baseline',
        gap: 5
      }
    }, t.label, t.meta ? /*#__PURE__*/React.createElement("span", {
      style: {
        font: 'var(--type-caption)',
        color: 'var(--text-subtle)'
      }
    }, t.meta) : null);
  }));
}
Object.assign(__ds_scope, { Tabs });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/forms/Tabs.jsx", error: String((e && e.message) || e) }); }

// components/nav/Breadcrumb.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function Breadcrumb({
  items = [],
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("nav", _extends({
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8,
      flexWrap: 'wrap',
      ...style
    }
  }, rest), items.map((it, i) => {
    const last = i === items.length - 1;
    const label = typeof it === 'string' ? it : it.label;
    return /*#__PURE__*/React.createElement(React.Fragment, {
      key: i
    }, i > 0 ? /*#__PURE__*/React.createElement("span", {
      style: {
        color: 'var(--text-subtle)',
        font: 'var(--weight-regular) 14px/1 var(--font-ui)'
      }
    }, "/") : null, /*#__PURE__*/React.createElement("span", {
      style: {
        font: 'var(--weight-' + (last ? 'semibold' : 'medium') + ') 14px/1 var(--font-display)',
        color: last ? 'var(--text-strong)' : 'var(--text-muted)',
        cursor: last ? 'default' : 'pointer'
      }
    }, label));
  }));
}
Object.assign(__ds_scope, { Breadcrumb });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/nav/Breadcrumb.jsx", error: String((e && e.message) || e) }); }

// components/nav/MobileTabBar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function MobileTabBar({
  items = [],
  active,
  onNavigate,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("nav", _extends({
    style: {
      display: 'flex',
      alignItems: 'stretch',
      gap: 2,
      minHeight: 'var(--mobile-tabbar-height)',
      padding: '8px 10px calc(8px + env(safe-area-inset-bottom))',
      background: 'rgba(255,255,255,.88)',
      backdropFilter: 'blur(12px)',
      WebkitBackdropFilter: 'blur(12px)',
      borderTop: '1px solid var(--border-hairline)',
      ...style
    }
  }, rest), items.map(it => {
    const on = it.value === active;
    return /*#__PURE__*/React.createElement("button", {
      key: it.value,
      onClick: () => onNavigate && onNavigate(it.value),
      style: {
        flex: 1,
        minWidth: 0,
        minHeight: 'var(--touch-min)',
        cursor: 'pointer',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        justifyContent: 'center',
        gap: 4,
        background: 'transparent',
        border: 'none',
        borderRadius: 'var(--radius-card-inner)',
        color: on ? 'var(--text-strong)' : 'var(--text-subtle)',
        transition: 'var(--transition-control)'
      }
    }, /*#__PURE__*/React.createElement("span", {
      style: {
        display: 'grid',
        placeItems: 'center',
        width: 42,
        height: 26,
        borderRadius: 'var(--radius-pill)',
        background: on ? 'var(--surface-accent-soft)' : 'transparent',
        transition: 'var(--transition-control)'
      }
    }, /*#__PURE__*/React.createElement(__ds_scope.Icon, {
      name: it.icon,
      size: 19
    })), /*#__PURE__*/React.createElement("span", {
      style: {
        font: 'var(--weight-' + (on ? 'semibold' : 'medium') + ') 10px/1 var(--font-ui)'
      }
    }, it.label));
  }));
}
Object.assign(__ds_scope, { MobileTabBar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/nav/MobileTabBar.jsx", error: String((e && e.message) || e) }); }

// components/nav/Sidebar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function SidebarItem({
  icon,
  label,
  active = false,
  onClick,
  style,
  ...rest
}) {
  const [hover, setHover] = React.useState(false);
  return /*#__PURE__*/React.createElement("button", _extends({
    onClick: onClick,
    onMouseEnter: () => setHover(true),
    onMouseLeave: () => setHover(false),
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 12,
      width: '100%',
      minHeight: 42,
      padding: '0 14px',
      cursor: 'pointer',
      textAlign: 'left',
      borderRadius: 'var(--radius-card-inner)',
      border: '1px solid ' + (active ? 'var(--border-hairline)' : 'transparent'),
      background: active ? 'var(--surface-card)' : hover ? 'var(--grey-100)' : 'transparent',
      color: active ? 'var(--text-strong)' : 'var(--text-muted)',
      font: 'var(--weight-' + (active ? 'semibold' : 'medium') + ') 14px/1 var(--font-ui)',
      boxShadow: active ? 'var(--shadow-xs)' : 'none',
      transition: 'var(--transition-control)',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: icon,
    size: 19
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      minWidth: 0,
      overflow: 'hidden',
      textOverflow: 'ellipsis'
    }
  }, label));
}
function Sidebar({
  sections = [],
  active,
  onNavigate,
  account,
  footer,
  base = '',
  width,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("nav", _extends({
    style: {
      width: width || 'var(--sidebar-width)',
      flex: '0 0 auto',
      background: 'var(--surface-page)',
      borderRight: '1px solid var(--border-hairline)',
      display: 'flex',
      flexDirection: 'column',
      gap: 18,
      padding: 16,
      minHeight: 0,
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      padding: '4px 6px 0'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Logo, {
    variant: "mark",
    withName: true,
    height: 30,
    base: base
  })), account ? /*#__PURE__*/React.createElement("button", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10,
      width: '100%',
      padding: '9px 11px',
      cursor: 'pointer',
      background: 'var(--surface-card)',
      border: '1px solid var(--border-hairline)',
      borderRadius: 'var(--radius-card-inner)',
      boxShadow: 'var(--shadow-xs)',
      textAlign: 'left'
    }
  }, /*#__PURE__*/React.createElement(__ds_scope.Avatar, {
    name: account.name,
    size: "sm"
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--weight-semibold) 13px/1.2 var(--font-ui)',
      color: 'var(--text-strong)',
      overflow: 'hidden',
      textOverflow: 'ellipsis',
      whiteSpace: 'nowrap'
    }
  }, account.name), /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      overflow: 'hidden',
      textOverflow: 'ellipsis',
      whiteSpace: 'nowrap'
    }
  }, account.role)), /*#__PURE__*/React.createElement(__ds_scope.Icon, {
    name: "chevron-down",
    size: 16,
    style: {
      color: 'var(--text-subtle)'
    }
  })) : null, /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1,
      minHeight: 0,
      overflowY: 'auto',
      display: 'flex',
      flexDirection: 'column',
      gap: 18
    }
  }, sections.map((s, si) => /*#__PURE__*/React.createElement("div", {
    key: si,
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 3
    }
  }, s.label ? /*#__PURE__*/React.createElement("span", {
    className: "lc-eyebrow",
    style: {
      padding: '0 14px 6px'
    }
  }, s.label) : null, s.items.map(it => /*#__PURE__*/React.createElement(SidebarItem, {
    key: it.value,
    icon: it.icon,
    label: it.label,
    active: it.value === active,
    onClick: () => onNavigate && onNavigate(it.value)
  }))))), footer ? /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '0 0 auto'
    }
  }, footer) : null);
}
Object.assign(__ds_scope, { SidebarItem, Sidebar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/nav/Sidebar.jsx", error: String((e && e.message) || e) }); }

// components/nav/TopBar.jsx
try { (() => {
function _extends() { return _extends = Object.assign ? Object.assign.bind() : function (n) { for (var e = 1; e < arguments.length; e++) { var t = arguments[e]; for (var r in t) ({}).hasOwnProperty.call(t, r) && (n[r] = t[r]); } return n; }, _extends.apply(null, arguments); }
function TopBar({
  title,
  subtitle,
  search,
  actions,
  breadcrumb,
  style,
  ...rest
}) {
  return /*#__PURE__*/React.createElement("header", _extends({
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 20,
      flexWrap: 'wrap',
      minHeight: 'var(--topbar-height)',
      padding: '12px 24px',
      borderBottom: '1px solid var(--border-hairline)',
      background: 'var(--surface-card)',
      ...style
    }
  }, rest), /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 1,
      minWidth: 180
    }
  }, breadcrumb ? /*#__PURE__*/React.createElement("div", {
    style: {
      marginBottom: 3
    }
  }, breadcrumb) : null, title ? /*#__PURE__*/React.createElement("h1", {
    style: {
      font: 'var(--weight-semibold) var(--text-title-3)/1.15 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, title) : null, subtitle ? /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 2
    }
  }, subtitle) : null), search ? /*#__PURE__*/React.createElement("div", {
    style: {
      flex: '0 1 auto'
    }
  }, search) : null, actions ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8,
      flex: '0 0 auto'
    }
  }, actions) : null);
}
Object.assign(__ds_scope, { TopBar });
})(); } catch (e) { __ds_ns.__errors.push({ path: "components/nav/TopBar.jsx", error: String((e && e.message) || e) }); }

// ui_kits/admin-dashboard/Panels.jsx
try { (() => {
const {
  Card,
  Badge,
  Button,
  IconButton,
  Icon,
  StatCard,
  BalanceCard,
  BarChart,
  DonutChart,
  DataTable,
  ProgressBar,
  CardTile,
  Select,
  Tabs,
  Tooltip,
  AIPromptPanel,
  Input
} = NS;
function Amount({
  value,
  size = 13
}) {
  const up = String(value)[0] === '+';
  return /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) ' + size + 'px/1.2 var(--font-numeric)',
      color: up ? 'var(--text-positive)' : 'var(--text-negative)'
    }
  }, value);
}
function NameCell({
  row
}) {
  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--weight-semibold) 13px/1.3 var(--font-tabular)',
      color: 'var(--text-strong)'
    }
  }, row.name), /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--weight-regular) 11px/1.3 var(--font-tabular)',
      color: 'var(--text-subtle)'
    }
  }, row.cat));
}
function AcctCell({
  row
}) {
  return /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 7
    }
  }, /*#__PURE__*/React.createElement(CardTile, {
    scheme: row.scheme,
    tone: row.scheme === 'visa' ? 'grey' : 'dark',
    width: 24
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--text-muted)'
    }
  }, row.acct));
}
function DateCell({
  row
}) {
  return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("div", {
    style: {
      color: 'var(--text-body)'
    }
  }, row.date), /*#__PURE__*/React.createElement("div", {
    style: {
      fontSize: 11,
      color: 'var(--text-subtle)'
    }
  }, row.time));
}
const TX_COLUMNS = [{
  header: 'Transaction Name',
  sortable: true,
  render: r => /*#__PURE__*/React.createElement(NameCell, {
    row: r
  })
}, {
  header: 'Account',
  sortable: true,
  render: r => /*#__PURE__*/React.createElement(AcctCell, {
    row: r
  })
}, {
  header: 'Date & Time',
  sortable: true,
  render: r => /*#__PURE__*/React.createElement(DateCell, {
    row: r
  })
}, {
  header: 'Amount',
  align: 'right',
  sortable: true,
  render: r => /*#__PURE__*/React.createElement(Amount, {
    value: r.amt
  })
}, {
  header: 'Status',
  render: r => /*#__PURE__*/React.createElement(Badge, {
    tone: r.status === 'Completed' ? 'success' : 'pending'
  }, r.status)
}];

/* ── Finance score ─────────────────────────────────────────── */
function FinanceScore() {
  return /*#__PURE__*/React.createElement(Card, {
    title: "Finance Score",
    action: /*#__PURE__*/React.createElement(IconButton, {
      icon: "more-horizontal",
      variant: "plain",
      size: "sm",
      label: "Options"
    }),
    pad: "md",
    style: {
      height: '100%'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14,
      height: '100%',
      justifyContent: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    className: "lc-eyebrow",
    style: {
      marginBottom: 6
    }
  }, "FINANCE QUALITY"), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'baseline',
      justifyContent: 'space-between',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--weight-semibold) var(--text-title-2)/1.05 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, "Excellent"), /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-2)/1 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, "92%"))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 6,
      height: 22
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 72,
      background: 'var(--forest-800)',
      borderRadius: 'var(--radius-pill)'
    }
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      flex: 28,
      background: 'var(--green-500)',
      borderRadius: 'var(--radius-pill)'
    }
  })), /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, "Up 4 points since August. Savings rate is carrying the score.")));
}

/* ── Exchange ──────────────────────────────────────────────── */
function ExchangePanel({
  compact
}) {
  const [from, setFrom] = React.useState('USD');
  const [to, setTo] = React.useState('GBP');
  return /*#__PURE__*/React.createElement(Card, {
    title: "Exchange",
    action: /*#__PURE__*/React.createElement(Badge, {
      tone: "neutral"
    }, "Currencies"),
    pad: "md",
    style: {
      height: '100%'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: 'center',
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, "1 ", from, " = 0.77 ", to), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8
    }
  }, /*#__PURE__*/React.createElement(Select, {
    value: from,
    onSelect: setFrom,
    variant: "outline",
    options: ['USD', 'GBP', 'BRL', 'EUR'],
    style: {
      flex: 1
    }
  }), /*#__PURE__*/React.createElement(IconButton, {
    icon: "arrow-left-right",
    variant: "tile",
    size: "sm",
    label: "Swap currencies",
    onClick: () => {
      setFrom(to);
      setTo(from);
    }
  }), /*#__PURE__*/React.createElement(Select, {
    value: to,
    onSelect: setTo,
    variant: "outline",
    options: ['GBP', 'USD', 'BRL', 'EUR'],
    style: {
      flex: 1
    }
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-1)/1.1 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, "$100.00"), /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 2
    }
  }, "Available: ", /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      color: 'var(--text-strong)',
      fontWeight: 600
    }
  }, "$1,600.86"))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(3,1fr)',
      gap: 8,
      padding: 12,
      background: 'var(--surface-card-sunken)',
      borderRadius: 'var(--radius-card-inner)'
    }
  }, [['Tax (2%)', '$2.00'], ['Exchange fee (1%)', '$1.00'], ['Total amount', '€90.7']].map(([l, v]) => /*#__PURE__*/React.createElement("div", {
    key: l
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)',
      whiteSpace: 'nowrap',
      overflow: 'hidden',
      textOverflow: 'ellipsis'
    }
  }, l), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 15px/1.2 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, v)))), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    fullWidth: true
  }, "Exchange")));
}

/* ── Statistic (donut + legend) ────────────────────────────── */
function StatisticPanel() {
  const [tab, setTab] = React.useState('expense');
  return /*#__PURE__*/React.createElement(Card, {
    title: "Statistic",
    action: /*#__PURE__*/React.createElement(Select, {
      value: "This Month",
      options: ['This Month', 'This Year']
    }),
    pad: "md",
    style: {
      height: '100%'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14
    }
  }, /*#__PURE__*/React.createElement(Tabs, {
    value: tab,
    onChange: setTab,
    size: "sm",
    items: [{
      value: 'income',
      label: 'Income',
      meta: '($4,800)'
    }, {
      value: 'expense',
      label: 'Expense',
      meta: '($3,500)'
    }]
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      placeItems: 'center'
    }
  }, /*#__PURE__*/React.createElement(DonutChart, {
    size: 168,
    thickness: 24,
    label: "Total Expense",
    value: "$3,500",
    segments: EXPENSE_SPLIT
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 9
    }
  }, EXPENSE_SPLIT.slice(0, 4).map(s => /*#__PURE__*/React.createElement("div", {
    key: s.name,
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 9
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--weight-semibold) 10px/1 var(--font-tabular)',
      color: 'var(--forest-800)',
      background: s.color,
      borderRadius: 'var(--radius-pill)',
      padding: '5px 7px',
      minWidth: 34,
      textAlign: 'center'
    }
  }, s.pct), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      font: 'var(--type-caption)',
      color: 'var(--text-body)'
    }
  }, s.name), /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 13px var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, s.amount))))));
}

/* ── Cashflow ──────────────────────────────────────────────── */
function CashflowPanel({
  height = 210
}) {
  const [hl, setHl] = React.useState(5);
  const d = CASHFLOW[hl == null ? 5 : hl];
  return /*#__PURE__*/React.createElement(Card, {
    title: "Cashflow",
    action: /*#__PURE__*/React.createElement(Select, {
      value: "This Year",
      options: ['This Month', 'This Year']
    }),
    pad: "md",
    style: {
      height: '100%'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, "Total Balance"), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-figure-1)/1.1 var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, "$562,000")), /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'relative'
    }
  }, d ? /*#__PURE__*/React.createElement("div", {
    style: {
      position: 'absolute',
      left: 'calc(6% + ' + (hl == null ? 5 : hl) * 7.6 + '%)',
      top: 4,
      zIndex: 3
    }
  }, /*#__PURE__*/React.createElement(Tooltip, {
    title: d.label + ' 2029',
    rows: [{
      label: 'Income',
      value: '$' + d.a.toLocaleString()
    }, {
      label: 'Expense',
      value: '$' + d.b.toLocaleString(),
      tone: 'negative'
    }],
    placement: "bottom"
  })) : null, /*#__PURE__*/React.createElement(BarChart, {
    data: CASHFLOW,
    height: height,
    highlight: hl,
    onHighlight: setHl
  }))));
}
Object.assign(window, {
  Amount,
  NameCell,
  AcctCell,
  DateCell,
  TX_COLUMNS,
  FinanceScore,
  ExchangePanel,
  StatisticPanel,
  CashflowPanel
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/admin-dashboard/Panels.jsx", error: String((e && e.message) || e) }); }

// ui_kits/admin-dashboard/Screens.jsx
try { (() => {
const {
  Card,
  Badge,
  Button,
  IconButton,
  Icon,
  StatCard,
  BalanceCard,
  DataTable,
  ProgressBar,
  CardTile,
  Select,
  Tabs,
  Tooltip,
  AIPromptPanel,
  AreaChart,
  DonutChart,
  Breadcrumb,
  RadioCard,
  Input,
  Switch,
  Checkbox,
  SearchField,
  Dropdown,
  Avatar
} = NS;

/* ══ HOME ══════════════════════════════════════════════════ */
function HomeScreen() {
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '4fr 5fr 3fr'
    }
  }, /*#__PURE__*/React.createElement(BalanceCard, {
    amount: "$20,670",
    currency: "USD",
    actions: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Button, {
      variant: "onAccent",
      size: "sm",
      glyph: "\u2193"
    }, "Deposit"), /*#__PURE__*/React.createElement(Button, {
      variant: "dark",
      size: "sm",
      glyph: "\u2197"
    }, "Send"))
  }), /*#__PURE__*/React.createElement(Card, {
    title: "AI Enhancements",
    pad: "md",
    action: /*#__PURE__*/React.createElement(Button, {
      variant: "secondary",
      size: "sm",
      icon: "plus"
    }, "Add Enhancements")
  }, /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: 'repeat(3,1fr)'
    }
  }, /*#__PURE__*/React.createElement(StatCard, {
    icon: "circle-dollar-sign",
    label: "Income",
    value: "$14,480.24",
    delta: "+1.78%"
  }), /*#__PURE__*/React.createElement(StatCard, {
    icon: "receipt",
    label: "Expense",
    value: "$14,480.24",
    delta: "+1.80%"
  }), /*#__PURE__*/React.createElement(StatCard, {
    icon: "piggy-bank",
    label: "Savings",
    value: "$14,480.24",
    delta: "+2.50%"
  }))), /*#__PURE__*/React.createElement(FinanceScore, null)), /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '7fr 5fr'
    }
  }, /*#__PURE__*/React.createElement(CashflowPanel, null), /*#__PURE__*/React.createElement(Card, {
    pad: "lg",
    action: /*#__PURE__*/React.createElement(IconButton, {
      icon: "more-vertical",
      variant: "plain",
      size: "sm",
      label: "Options"
    })
  }, /*#__PURE__*/React.createElement(AIPromptPanel, {
    compact: true,
    heading: "What Can I help with?",
    orbSize: 92,
    model: "Choose Model",
    suggestions: ['Show me my cash flow', 'Help me set a savings goal', 'Forecast my balance', 'Plan my monthly budget', 'Detect unusual transactions']
  }))), /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '5fr 4fr 3fr'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    title: "Recent Transactions",
    pad: "md",
    action: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Select, {
      value: "This Month",
      options: ['This Month', 'This Year']
    }), /*#__PURE__*/React.createElement(IconButton, {
      icon: "sliders-horizontal",
      variant: "plain",
      size: "sm",
      label: "Filter"
    }))
  }, /*#__PURE__*/React.createElement(DataTable, {
    columns: TX_COLUMNS.slice(0, 1).concat(TX_COLUMNS.slice(3)),
    rows: TRANSACTIONS.slice(0, 6),
    maxHeight: 280,
    fade: true
  })), /*#__PURE__*/React.createElement(StatisticPanel, null), /*#__PURE__*/React.createElement(ExchangePanel, null)));
}

/* ══ AI ASSISTANT ══════════════════════════════════════════ */
const ASSIST_CARDS = [{
  title: 'Track Cash Flow',
  body: 'View income, spending, and savings in real time with AI insights for smarter financial management.'
}, {
  title: 'Detect Unusual Transactions',
  body: 'Get instant alerts on suspicious charges or duplicate payments, ensuring security and keeping your finances fully protected.'
}, {
  title: 'Plan a Savings Goal',
  body: 'Set smart AI-recommended savings targets to securely fund your emergency needs or dream vacation goals.'
}, {
  title: 'Financial Health Score',
  body: 'Receive a personalized AI-powered score that evaluates your spending, saving, and investments for financial wellness.'
}];
function AssistantScreen() {
  return /*#__PURE__*/React.createElement(Card, {
    pad: "lg"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      justifyContent: 'flex-end',
      gap: 8,
      marginBottom: 4
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "sm",
    icon: "download"
  }, "Export"), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "sm",
    icon: "sparkles"
  }, "Get Plus")), /*#__PURE__*/React.createElement("div", {
    style: {
      maxWidth: 760,
      margin: '0 auto',
      display: 'flex',
      flexDirection: 'column',
      gap: 26
    }
  }, /*#__PURE__*/React.createElement(AIPromptPanel, {
    orbSize: 104,
    heading: "How Can I Assist You With Your Finances?",
    subheading: "Quickly track cash flow, get AI-powered insights, and manage your money\u2014all in one place",
    model: "Choose Model"
  }), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-label)',
      color: 'var(--text-muted)',
      marginBottom: 10
    }
  }, "Get started with an example below"), /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: 'repeat(2,minmax(0,1fr))'
    }
  }, ASSIST_CARDS.map(c => /*#__PURE__*/React.createElement(Card, {
    key: c.title,
    surface: "tile",
    pad: "md",
    interactive: true,
    radius: "card-inner"
  }, /*#__PURE__*/React.createElement("h4", {
    style: {
      font: 'var(--weight-semibold) 15px/1.2 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, c.title), /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 6,
      lineHeight: 1.5
    }
  }, c.body), /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'inline-flex',
      alignItems: 'center',
      gap: 6,
      marginTop: 14,
      font: 'var(--weight-semibold) 13px/1 var(--font-ui)',
      color: 'var(--text-accent)'
    }
  }, "Learn more ", /*#__PURE__*/React.createElement(Icon, {
    name: "arrow-right",
    size: 15
  }))))))));
}

/* ══ TRANSACTIONS ══════════════════════════════════════════ */
function TransactionsScreen() {
  const [sel, setSel] = React.useState([]);
  const [q, setQ] = React.useState('');
  const [tab, setTab] = React.useState('all');
  const rows = TRANSACTIONS.filter(r => {
    const okTab = tab === 'all' || tab === 'in' && r.amt[0] === '+' || tab === 'out' && r.amt[0] === '-' || tab === 'pending' && r.status === 'Pending';
    const okQ = !q || (r.name + ' ' + r.cat).toLowerCase().indexOf(q.toLowerCase()) > -1;
    return okTab && okQ;
  });
  const toggle = i => setSel(sel.indexOf(i) > -1 ? sel.filter(x => x !== i) : sel.concat([i]));
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: 'repeat(4,1fr)'
    }
  }, /*#__PURE__*/React.createElement(StatCard, {
    surface: "card",
    icon: "arrow-down-left",
    label: "Money in",
    value: "$2,550.00",
    delta: "+12.4%",
    footer: "7 credits this month"
  }), /*#__PURE__*/React.createElement(StatCard, {
    surface: "card",
    icon: "arrow-up-right",
    label: "Money out",
    value: "$413.89",
    delta: "-3.1%",
    deltaTone: "pending",
    footer: "11 debits this month"
  }), /*#__PURE__*/React.createElement(StatCard, {
    surface: "card",
    icon: "clock",
    label: "Pending",
    value: "$138.94",
    delta: "3 items",
    deltaTone: "warning",
    footer: "Clears within 48h"
  }), /*#__PURE__*/React.createElement(StatCard, {
    surface: "card",
    icon: "wallet",
    label: "Net change",
    value: "+$2,136.11",
    delta: "+9.2%",
    footer: "Compared to $1,956 last month"
  })), /*#__PURE__*/React.createElement(Card, {
    pad: "md",
    title: "All Transactions",
    subtitle: "Every movement across your cards and wallets.",
    action: /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(SearchField, {
      width: 230,
      shortcut: [],
      placeholder: "Search transactions",
      value: q,
      onChange: e => setQ(e.target.value)
    }), /*#__PURE__*/React.createElement(Select, {
      value: "This Month",
      options: ['This Month', 'This Year', 'All time']
    }), /*#__PURE__*/React.createElement(Button, {
      variant: "secondary",
      size: "sm",
      icon: "download"
    }, "Export"))
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 12,
      flexWrap: 'wrap'
    }
  }, /*#__PURE__*/React.createElement(Tabs, {
    value: tab,
    onChange: setTab,
    items: [{
      value: 'all',
      label: 'All',
      meta: '(' + TRANSACTIONS.length + ')'
    }, {
      value: 'in',
      label: 'Money in'
    }, {
      value: 'out',
      label: 'Money out'
    }, {
      value: 'pending',
      label: 'Pending',
      meta: '(3)'
    }],
    style: {
      flex: 1,
      minWidth: 260
    }
  }), sel.length ? /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, sel.length, " selected"), /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "sm",
    icon: "tag"
  }, "Categorise"), /*#__PURE__*/React.createElement(Button, {
    variant: "ghost",
    size: "sm",
    icon: "x",
    onClick: () => setSel([])
  }, "Clear")) : null), /*#__PURE__*/React.createElement(DataTable, {
    selectable: true,
    selected: sel,
    onSelect: toggle,
    rows: rows,
    columns: [{
      header: 'Transaction Name',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(NameCell, {
        row: r
      })
    }, {
      header: 'Account',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(AcctCell, {
        row: r
      })
    }, {
      header: 'Transaction ID',
      render: r => /*#__PURE__*/React.createElement("span", {
        style: {
          color: 'var(--text-muted)'
        }
      }, r.id)
    }, {
      header: 'Date & Time',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(DateCell, {
        row: r
      })
    }, {
      header: 'Amount',
      align: 'right',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(Amount, {
        value: r.amt
      })
    }, {
      header: 'Description',
      wrap: true,
      render: r => /*#__PURE__*/React.createElement("span", {
        style: {
          color: 'var(--text-muted)'
        }
      }, r.note)
    }, {
      header: 'Status',
      render: r => /*#__PURE__*/React.createElement(Badge, {
        tone: r.status === 'Completed' ? 'success' : 'pending'
      }, r.status)
    }, {
      header: '',
      width: 44,
      render: () => /*#__PURE__*/React.createElement(Dropdown, {
        trigger: /*#__PURE__*/React.createElement(IconButton, {
          icon: "more-horizontal",
          variant: "plain",
          size: "sm",
          label: "Options"
        }),
        items: [{
          label: 'View details',
          icon: 'eye'
        }, {
          label: 'Download receipt',
          icon: 'download'
        }, {
          divider: true
        }, {
          label: 'Report issue',
          icon: 'flag',
          tone: 'danger'
        }]
      })
    }]
  }), !rows.length ? /*#__PURE__*/React.createElement("p", {
    style: {
      padding: 28,
      textAlign: 'center',
      font: 'var(--type-body)',
      color: 'var(--text-muted)'
    }
  }, "Nothing matches that filter.") : null)));
}

/* ══ WALLET ════════════════════════════════════════════════ */
function WalletScreen() {
  const [ci, setCi] = React.useState(0);
  const [wtab, setWtab] = React.useState('Wallet');
  const card = CARDS[ci];
  return /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'flex-end',
      justifyContent: 'space-between',
      gap: 16,
      flexWrap: 'wrap'
    }
  }, /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement(Breadcrumb, {
    items: ['Overview', 'Balance Details']
  }), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-bold) var(--text-title-1)/1.1 var(--font-numeric)',
      color: 'var(--text-strong)',
      marginTop: 6
    }
  }, "$542,25.00 ", /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--weight-medium) 18px/1 var(--font-ui)',
      color: 'var(--text-muted)'
    }
  }, "USD")), /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)',
      marginTop: 4
    }
  }, "Your total balance estimate in USD at 2024-09-16 12:20")), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    icon: "settings-2"
  }, "Manage Balance")), /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '4fr 4fr 5fr'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    title: "Your Cards",
    pad: "md",
    action: /*#__PURE__*/React.createElement(IconButton, {
      icon: "plus",
      variant: "tile",
      size: "sm",
      label: "Add card"
    })
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 8
    }
  }, CARDS.map((c, i) => /*#__PURE__*/React.createElement(RadioCard, {
    key: i,
    checked: ci === i,
    onChange: () => setCi(i),
    title: c.label,
    meta: c.mask,
    leading: /*#__PURE__*/React.createElement(CardTile, {
      scheme: c.scheme,
      tone: c.tone,
      width: 54
    }),
    trailing: /*#__PURE__*/React.createElement(Dropdown, {
      trigger: /*#__PURE__*/React.createElement(IconButton, {
        icon: "more-horizontal",
        variant: "plain",
        size: "sm",
        label: "Card options"
      }),
      items: [{
        label: 'Freeze card',
        icon: 'snowflake'
      }, {
        label: 'Set limit',
        icon: 'gauge'
      }, {
        divider: true
      }, {
        label: 'Remove card',
        icon: 'trash-2',
        tone: 'danger'
      }]
    })
  })))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 20,
      justifyContent: 'space-around'
    }
  }, [['plus', 'Top Up'], ['arrow-left-right', 'Transfer'], ['credit-card', 'Payment']].map(([ic, l]) => /*#__PURE__*/React.createElement("button", {
    key: l,
    style: {
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      gap: 7,
      background: 'transparent',
      border: 'none',
      cursor: 'pointer',
      color: 'var(--forest-800)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 42,
      height: 42,
      borderRadius: 'var(--radius-pill)',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--surface-tile)',
      border: '1px solid var(--border-hairline)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: ic,
    size: 19
  })), /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, l)))), /*#__PURE__*/React.createElement("div", {
    style: {
      height: 1,
      background: 'var(--border-hairline)'
    }
  }), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, "Card Number"), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 17px/1.3 var(--font-numeric)',
      color: 'var(--text-strong)',
      letterSpacing: '0.03em'
    }
  }, card.number)), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(3,1fr)',
      gap: 10
    }
  }, [['Expiry Date', card.expiry], ['CVC', card.cvc]].map(([l, v]) => /*#__PURE__*/React.createElement("div", {
    key: l
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)'
    }
  }, l), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 14px var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, v))), /*#__PURE__*/React.createElement("div", null, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)',
      marginBottom: 3
    }
  }, "Status"), /*#__PURE__*/React.createElement(Badge, {
    tone: card.status === 'Active' ? 'dark' : 'neutral'
  }, card.status))))), /*#__PURE__*/React.createElement(Card, {
    title: "Spending Limits",
    pad: "md",
    action: /*#__PURE__*/React.createElement(IconButton, {
      icon: "more-vertical",
      variant: "plain",
      size: "sm",
      label: "Options"
    })
  }, /*#__PURE__*/React.createElement(ProgressBar, {
    value: 45,
    tone: "split",
    height: 12,
    caption: "$4,500.00 spent of $10,000.00 \xB7 45%"
  }))), /*#__PURE__*/React.createElement(Card, {
    title: "My Wallets",
    pad: "md",
    action: /*#__PURE__*/React.createElement(Select, {
      value: "Monthly",
      options: ['Daily', 'Weekly', 'Monthly']
    })
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14
    }
  }, /*#__PURE__*/React.createElement(Tabs, {
    variant: "underline",
    size: "sm",
    value: wtab,
    onChange: setWtab,
    items: ['Wallet', 'Card Transaction', 'Investment']
  }), /*#__PURE__*/React.createElement(AreaChart, {
    height: 230,
    marker: 17,
    series: WALLET_SERIES,
    compare: WALLET_COMPARE,
    yTicks: ['$100k', '$80k', '$60k', '$40k', '$20k', '0'],
    xLabels: ['1', '2', '3', '4', '5', '6', '7', '8']
  })))), /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '6fr 3fr 3fr'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    title: "Transactions",
    pad: "md",
    action: /*#__PURE__*/React.createElement(Select, {
      value: "This Month",
      options: ['This Month', 'This Year']
    })
  }, /*#__PURE__*/React.createElement(DataTable, {
    selectable: true,
    selected: [],
    onSelect: () => {},
    rows: TRANSACTIONS.slice(0, 6),
    maxHeight: 300,
    fade: true,
    columns: [{
      header: 'Transaction Name',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(NameCell, {
        row: r
      })
    }, {
      header: 'Transaction ID',
      render: r => /*#__PURE__*/React.createElement("span", {
        style: {
          color: 'var(--text-muted)'
        }
      }, r.id)
    }, {
      header: 'Date & Time',
      sortable: true,
      render: r => /*#__PURE__*/React.createElement(DateCell, {
        row: r
      })
    }, {
      header: 'Amount',
      align: 'right',
      render: r => /*#__PURE__*/React.createElement(Amount, {
        value: r.amt
      })
    }, {
      header: 'Status',
      render: r => /*#__PURE__*/React.createElement(Badge, {
        tone: r.status === 'Completed' ? 'success' : 'pending'
      }, r.status)
    }]
  })), /*#__PURE__*/React.createElement(Card, {
    title: "All Expenses",
    pad: "md",
    action: /*#__PURE__*/React.createElement(Select, {
      value: "This Month",
      options: ['This Month', 'This Year']
    })
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 14
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      gridTemplateColumns: 'repeat(3,1fr)',
      gap: 8
    }
  }, [['Daily', '$310'], ['Weekly', '$2,510'], ['Monthly', '$9,152']].map(([l, v]) => /*#__PURE__*/React.createElement("div", {
    key: l
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-subtle)'
    }
  }, l), /*#__PURE__*/React.createElement("div", {
    className: "lc-numeric",
    style: {
      font: 'var(--weight-semibold) 15px var(--font-numeric)',
      color: 'var(--text-strong)'
    }
  }, v)))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      placeItems: 'center'
    }
  }, /*#__PURE__*/React.createElement(DonutChart, {
    size: 150,
    thickness: 22,
    label: "Platform",
    value: "$2,250",
    segments: EXPENSE_SPLIT
  })), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 7
    }
  }, EXPENSE_SPLIT.slice(0, 4).map(s => /*#__PURE__*/React.createElement("div", {
    key: s.name,
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 8,
      font: 'var(--type-caption)',
      color: 'var(--text-body)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 9,
      height: 9,
      borderRadius: '50%',
      background: s.color,
      flex: '0 0 auto'
    }
  }), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1
    }
  }, s.name), /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      fontWeight: 600,
      color: 'var(--text-strong)'
    }
  }, s.amount)))))), /*#__PURE__*/React.createElement(Card, {
    title: "Convert",
    pad: "md",
    action: /*#__PURE__*/React.createElement(IconButton, {
      icon: "more-vertical",
      variant: "plain",
      size: "sm",
      label: "Options"
    })
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement(Input, {
    label: "You send",
    defaultValue: "$200.00",
    suffix: "USD"
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 8,
      padding: 12,
      background: 'var(--surface-card-sunken)',
      borderRadius: 'var(--radius-card-inner)'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, "You've ", /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      color: 'var(--text-strong)',
      fontWeight: 600
    }
  }, "$35,478.00"), " available balance"), [['− $2.23', 'Our fees'], ['= $197.77', 'Amount converted'], ['× £0.778786', 'Live rate']].map(([a, b]) => /*#__PURE__*/React.createElement("div", {
    key: b,
    style: {
      display: 'flex',
      justifyContent: 'space-between',
      gap: 10,
      font: 'var(--type-caption)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    className: "lc-numeric",
    style: {
      color: 'var(--text-strong)',
      fontWeight: 600
    }
  }, a), /*#__PURE__*/React.createElement("span", {
    style: {
      color: 'var(--text-subtle)'
    }
  }, b)))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'grid',
      placeItems: 'center'
    }
  }, /*#__PURE__*/React.createElement(IconButton, {
    icon: "arrow-up-down",
    variant: "tile",
    size: "sm",
    label: "Flip direction"
  })), /*#__PURE__*/React.createElement(Input, {
    label: "They get",
    defaultValue: "\xA3154.02",
    suffix: "GBP"
  }), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    fullWidth: true
  }, "Continue")))));
}

/* ══ SETTINGS ══════════════════════════════════════════════ */
function SettingsScreen() {
  const [alerts, setAlerts] = React.useState(true);
  const [weekly, setWeekly] = React.useState(true);
  const [marketing, setMarketing] = React.useState(false);
  const [twofa, setTwofa] = React.useState(true);
  return /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '7fr 5fr'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    title: "Account",
    subtitle: "How your name and contact details appear on invoices.",
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    className: "lc-grid",
    style: {
      gridTemplateColumns: '1fr 1fr'
    }
  }, /*#__PURE__*/React.createElement(Input, {
    label: "Full name",
    defaultValue: "Jenny Wilson"
  }), /*#__PURE__*/React.createElement(Input, {
    label: "Email",
    icon: "mail",
    defaultValue: "jenny@liberacash.com"
  }), /*#__PURE__*/React.createElement(Input, {
    label: "Phone",
    icon: "phone",
    defaultValue: "+55 11 98765-4321"
  }), /*#__PURE__*/React.createElement(Input, {
    label: "Tax ID",
    defaultValue: "123.456.789-00",
    hint: "Used on every invoice you issue."
  }))), /*#__PURE__*/React.createElement(Card, {
    title: "Notifications",
    subtitle: "Choose what reaches you, and where.",
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(Switch, {
    checked: alerts,
    onChange: () => setAlerts(!alerts),
    label: "Unusual transaction alerts",
    description: "Notify me when a charge looks duplicated or out of pattern."
  }), /*#__PURE__*/React.createElement(Switch, {
    checked: weekly,
    onChange: () => setWeekly(!weekly),
    label: "Weekly cash-flow digest",
    description: "A Monday summary of income, spending and what changed."
  }), /*#__PURE__*/React.createElement(Switch, {
    checked: marketing,
    onChange: () => setMarketing(!marketing),
    label: "Product news",
    description: "Occasional notes about new Libera Cash features."
  }))), /*#__PURE__*/React.createElement(Card, {
    title: "Security",
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 16
    }
  }, /*#__PURE__*/React.createElement(Switch, {
    checked: twofa,
    onChange: () => setTwofa(!twofa),
    label: "Two-factor authentication",
    description: "Required for transfers above $1,000."
  }), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      gap: 10,
      flexWrap: 'wrap'
    }
  }, /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "sm",
    icon: "key-round"
  }, "Change password"), /*#__PURE__*/React.createElement(Button, {
    variant: "secondary",
    size: "sm",
    icon: "monitor-smartphone"
  }, "Manage devices"), /*#__PURE__*/React.createElement(Button, {
    variant: "danger",
    size: "sm",
    icon: "log-out"
  }, "Sign out everywhere"))))), /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 'var(--gap-card)'
    }
  }, /*#__PURE__*/React.createElement(Card, {
    title: "Plan",
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      font: 'var(--type-card-title)',
      color: 'var(--text-strong)'
    }
  }, "Personal"), /*#__PURE__*/React.createElement(Badge, {
    tone: "accent"
  }, "Current")), /*#__PURE__*/React.createElement(ProgressBar, {
    value: 62,
    label: "AI insights used",
    caption: "124 of 200 this month"
  }), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    fullWidth: true,
    glyph: "\u2197"
  }, "Upgrade your Plan"))), /*#__PURE__*/React.createElement(Card, {
    surface: "inverse",
    pad: "md",
    title: "Data export",
    subtitle: "Take everything with you, any time."
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 10
    }
  }, /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-caption)',
      color: 'var(--forest-200)'
    }
  }, "Statements, transactions and invoices as CSV or PDF. We email a link when the file is ready."), /*#__PURE__*/React.createElement(Button, {
    variant: "primary",
    size: "sm",
    icon: "download"
  }, "Request export"))), /*#__PURE__*/React.createElement(Card, {
    title: "Connected accounts",
    pad: "md"
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      display: 'flex',
      flexDirection: 'column',
      gap: 10
    }
  }, [['Itaú', 'Checking · •••• 4471', 'success'], ['Nubank', 'Credit · •••• 9120', 'success'], ['Mercado Pago', 'Reconnect needed', 'pending']].map(([n, d, tone]) => /*#__PURE__*/React.createElement("div", {
    key: n,
    style: {
      display: 'flex',
      alignItems: 'center',
      gap: 10,
      padding: '11px 12px',
      border: '1px solid var(--border-hairline)',
      borderRadius: 'var(--radius-card-inner)'
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 34,
      height: 34,
      borderRadius: 'var(--radius-pill)',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--surface-tile)',
      color: 'var(--forest-800)',
      flex: '0 0 auto'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "building-2",
    size: 17
  })), /*#__PURE__*/React.createElement("span", {
    style: {
      flex: 1,
      minWidth: 0
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--weight-semibold) 14px/1.2 var(--font-ui)',
      color: 'var(--text-strong)'
    }
  }, n), /*#__PURE__*/React.createElement("span", {
    style: {
      display: 'block',
      font: 'var(--type-caption)',
      color: 'var(--text-muted)'
    }
  }, d)), /*#__PURE__*/React.createElement(Badge, {
    tone: tone,
    size: "sm"
  }, tone === 'success' ? 'Linked' : 'Action')))))));
}

/* ══ PLACEHOLDER (Invoices / Reports / Help) ═══════════════ */
function PlaceholderScreen({
  screen
}) {
  const meta = SCREEN_META[screen] || {};
  return /*#__PURE__*/React.createElement(Card, {
    pad: "lg",
    style: {
      minHeight: 380,
      display: 'grid',
      placeItems: 'center'
    }
  }, /*#__PURE__*/React.createElement("div", {
    style: {
      textAlign: 'center',
      maxWidth: 460,
      display: 'flex',
      flexDirection: 'column',
      alignItems: 'center',
      gap: 12
    }
  }, /*#__PURE__*/React.createElement("span", {
    style: {
      width: 56,
      height: 56,
      borderRadius: 'var(--radius-pill)',
      display: 'grid',
      placeItems: 'center',
      background: 'var(--surface-tile)',
      border: '1px solid var(--border-hairline)',
      color: 'var(--forest-800)'
    }
  }, /*#__PURE__*/React.createElement(Icon, {
    name: "square-dashed",
    size: 24
  })), /*#__PURE__*/React.createElement("h3", {
    style: {
      font: 'var(--weight-semibold) var(--text-title-3)/1.2 var(--font-display)',
      color: 'var(--text-strong)'
    }
  }, meta.title, " is intentionally blank"), /*#__PURE__*/React.createElement("p", {
    style: {
      font: 'var(--type-body)',
      color: 'var(--text-muted)'
    }
  }, "The reference material contains no design for this screen, so nothing has been invented here. See readme.md > CAVEATS.")));
}
Object.assign(window, {
  HomeScreen,
  AssistantScreen,
  TransactionsScreen,
  WalletScreen,
  SettingsScreen,
  PlaceholderScreen
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/admin-dashboard/Screens.jsx", error: String((e && e.message) || e) }); }

// ui_kits/admin-dashboard/data.js
try { (() => {
const NS = window.LiberaCashDesignSystem_78af32 || {};
const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const CASHFLOW = [{
  label: 'Jan',
  a: 5200,
  b: 3600
}, {
  label: 'Feb',
  a: 4100,
  b: 4800
}, {
  label: 'Mar',
  a: 4600,
  b: 4200
}, {
  label: 'Apr',
  a: 6400,
  b: 2600
}, {
  label: 'May',
  a: 4400,
  b: 3900
}, {
  label: 'Jun',
  a: 6000,
  b: 4000
}, {
  label: 'Jul',
  a: 3600,
  b: 4100
}, {
  label: 'Aug',
  a: 4300,
  b: 4600
}, {
  label: 'Sep',
  a: 6200,
  b: 2900
}, {
  label: 'Oct',
  a: 5000,
  b: 3400
}, {
  label: 'Nov',
  a: 3700,
  b: 4900
}, {
  label: 'Dec',
  a: 4800,
  b: 3300
}];
const TRANSACTIONS = [{
  name: 'Dividend Payout',
  cat: 'Investments',
  scheme: 'visa',
  acct: 'Platinum Plus Visa',
  id: '4567890139',
  date: '2024-09-25',
  time: '10:00',
  amt: '+$200.00',
  status: 'Completed',
  note: 'Quarterly dividend'
}, {
  name: 'Grocery Shopping',
  cat: 'Food & Dining',
  scheme: 'visa',
  acct: 'Platinum Plus Visa',
  id: '4567890123',
  date: '2024-09-24',
  time: '14:30',
  amt: '-$154.20',
  status: 'Completed',
  note: 'Weekly groceries'
}, {
  name: 'Freelance Payment',
  cat: 'Income',
  scheme: 'mastercard',
  acct: 'Freedom Unlimited',
  id: '4567890140',
  date: '2024-09-23',
  time: '15:00',
  amt: '+$850.00',
  status: 'Completed',
  note: 'Design retainer'
}, {
  name: 'Electricity Bill',
  cat: 'Utilities',
  scheme: 'mastercard',
  acct: 'Freedom Unlimited',
  id: '4567890128',
  date: '2024-09-22',
  time: '09:15',
  amt: '-$120.75',
  status: 'Completed',
  note: 'September usage'
}, {
  name: 'Gym Membership',
  cat: 'Healthcare',
  scheme: 'visa',
  acct: 'Platinum Plus Visa',
  id: '4567890125',
  date: '2024-09-22',
  time: '07:00',
  amt: '-$45.00',
  status: 'Pending',
  note: 'Monthly gym fee for health'
}, {
  name: 'Online Subscription',
  cat: 'Services',
  scheme: 'visa',
  acct: 'Platinum Plus Visa',
  id: '4567890118',
  date: '2024-09-18',
  time: '08:00',
  amt: '-$12.99',
  status: 'Pending',
  note: 'Streaming plan'
}, {
  name: 'Consulting Fee',
  cat: 'Services',
  scheme: 'mastercard',
  acct: 'Freedom Unlimited',
  id: '4567890141',
  date: '2024-09-17',
  time: '14:00',
  amt: '+$1,500.00',
  status: 'Completed',
  note: 'Advisory session'
}, {
  name: 'Amazon Purchase',
  cat: 'Food & Dining',
  scheme: 'visa',
  acct: 'Platinum Plus Visa',
  id: '4567890124',
  date: '2024-09-16',
  time: '15:45',
  amt: '-$80.95',
  status: 'Pending',
  note: 'Kitchen appliances'
}];
const CARDS = [{
  label: 'Personal',
  mask: '•••• 8744',
  scheme: 'visa',
  tone: 'green',
  number: '5582 5574 8376 5487',
  expiry: '05/25',
  cvc: '411',
  status: 'Active'
}, {
  label: 'Business',
  mask: '•••• 5641',
  scheme: 'visa',
  tone: 'grey',
  number: '4021 7745 1190 5641',
  expiry: '11/26',
  cvc: '204',
  status: 'Active'
}, {
  label: 'Business',
  mask: '•••• 9007',
  scheme: 'mastercard',
  tone: 'dark',
  number: '5310 6621 8842 9007',
  expiry: '02/27',
  cvc: '318',
  status: 'Frozen'
}];
const EXPENSE_SPLIT = [{
  pct: '60%',
  name: 'Rent & Living',
  amount: '$2,100',
  value: 60,
  color: 'var(--chart-series-1)'
}, {
  pct: '15%',
  name: 'Investment',
  amount: '$525',
  value: 15,
  color: 'var(--chart-series-2)'
}, {
  pct: '12%',
  name: 'Education',
  amount: '$420',
  value: 12,
  color: 'var(--chart-series-3)'
}, {
  pct: '8%',
  name: 'Food & Drink',
  amount: '$280',
  value: 8,
  color: 'var(--chart-series-4)'
}, {
  pct: '5%',
  name: 'Other',
  amount: '$175',
  value: 5,
  color: 'var(--grey-300)'
}];
const WALLET_SERIES = [22, 28, 26, 31, 29, 35, 33, 42, 38, 46, 44, 53, 49, 61, 57, 59, 64, 62, 72, 78, 74, 76, 81, 79];
const WALLET_COMPARE = [30, 29, 31, 33, 36, 38, 40, 42, 44, 46, 47, 49, 52, 54, 55, 57, 58, 60, 61, 63, 64, 65, 66, 68];
const NAV_SECTIONS = [{
  label: 'MAIN MENU',
  items: [{
    value: 'dashboard',
    label: 'Dashboard',
    icon: 'home'
  }, {
    value: 'assistant',
    label: 'AI Assistant',
    icon: 'wand-sparkles'
  }, {
    value: 'transactions',
    label: 'Transactions',
    icon: 'arrow-left-right'
  }, {
    value: 'wallet',
    label: 'My Wallet',
    icon: 'wallet'
  }, {
    value: 'invoices',
    label: 'Invoices',
    icon: 'file-text'
  }, {
    value: 'reports',
    label: 'Reports',
    icon: 'pie-chart'
  }]
}, {
  label: 'PREFERENCE',
  items: [{
    value: 'settings',
    label: 'Settings',
    icon: 'settings'
  }, {
    value: 'help',
    label: 'Help Center',
    icon: 'circle-help'
  }]
}];
const SCREEN_META = {
  dashboard: {
    title: 'Home',
    subtitle: 'Track finances easily with AI insights and recommendations.'
  },
  assistant: {
    title: 'AI Assistant',
    subtitle: 'Get smart financial insights, forecasts, and tips.'
  },
  transactions: {
    title: 'Transactions',
    subtitle: 'Every movement across your cards and wallets, in one list.'
  },
  wallet: {
    title: 'Wallet',
    subtitle: 'Securely store, track, and manage your money.'
  },
  invoices: {
    title: 'Invoices',
    subtitle: 'Issue, send and reconcile invoices.'
  },
  reports: {
    title: 'Reports',
    subtitle: 'Build and export a view of any period.'
  },
  settings: {
    title: 'Settings',
    subtitle: 'Account, security and notification preferences.'
  },
  help: {
    title: 'Help Center',
    subtitle: 'Guides, answers and a way to reach a human.'
  }
};
Object.assign(window, {
  NS,
  MONTHS,
  CASHFLOW,
  TRANSACTIONS,
  CARDS,
  EXPENSE_SPLIT,
  WALLET_SERIES,
  WALLET_COMPARE,
  NAV_SECTIONS,
  SCREEN_META
});
})(); } catch (e) { __ds_ns.__errors.push({ path: "ui_kits/admin-dashboard/data.js", error: String((e && e.message) || e) }); }

__ds_ns.Avatar = __ds_scope.Avatar;

__ds_ns.Badge = __ds_scope.Badge;

__ds_ns.Button = __ds_scope.Button;

__ds_ns.Card = __ds_scope.Card;

__ds_ns.Icon = __ds_scope.Icon;

__ds_ns.IconButton = __ds_scope.IconButton;

__ds_ns.Logo = __ds_scope.Logo;

__ds_ns.AreaChart = __ds_scope.AreaChart;

__ds_ns.BalanceCard = __ds_scope.BalanceCard;

__ds_ns.BarChart = __ds_scope.BarChart;

__ds_ns.CardTile = __ds_scope.CardTile;

__ds_ns.DataTable = __ds_scope.DataTable;

__ds_ns.DonutChart = __ds_scope.DonutChart;

__ds_ns.ProgressBar = __ds_scope.ProgressBar;

__ds_ns.StatCard = __ds_scope.StatCard;

__ds_ns.AIPromptPanel = __ds_scope.AIPromptPanel;

__ds_ns.Dropdown = __ds_scope.Dropdown;

__ds_ns.Tooltip = __ds_scope.Tooltip;

__ds_ns.UpgradeCard = __ds_scope.UpgradeCard;

__ds_ns.Checkbox = __ds_scope.Checkbox;

__ds_ns.Input = __ds_scope.Input;

__ds_ns.RadioCard = __ds_scope.RadioCard;

__ds_ns.SearchField = __ds_scope.SearchField;

__ds_ns.Select = __ds_scope.Select;

__ds_ns.Switch = __ds_scope.Switch;

__ds_ns.Tabs = __ds_scope.Tabs;

__ds_ns.Breadcrumb = __ds_scope.Breadcrumb;

__ds_ns.MobileTabBar = __ds_scope.MobileTabBar;

__ds_ns.SidebarItem = __ds_scope.SidebarItem;

__ds_ns.Sidebar = __ds_scope.Sidebar;

__ds_ns.TopBar = __ds_scope.TopBar;

})();

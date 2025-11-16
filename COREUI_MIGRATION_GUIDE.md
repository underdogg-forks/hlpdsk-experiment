# CoreUI Template Migration Guide

This document explains the migration from AdminLTE to CoreUI 2.16 template system with CSS custom properties.

## Overview

The Faveo HELPDESK application has been refactored to use CoreUI 2.16 instead of AdminLTE, providing:
- Modern CSS custom properties for easy theming
- Better responsive design
- Cleaner component structure
- Dark mode support (variables defined)
- RTL support
- AdminLTE backward compatibility classes

## What Has Been Changed

### 1. Build System
- **package.json**: Added CoreUI 2.1.16, Bootstrap 4.6.2, jQuery, and SCSS dependencies
- **webpack.mix.js**: Updated to compile SCSS instead of plain CSS
- **New Files**:
  - `resources/scss/coreui.scss` - Main CoreUI configuration with CSS variables
  - `resources/scss/app.scss` - Application-specific styles
  - `resources/js/app.js` - CoreUI JavaScript initialization

### 2. CSS Custom Properties

All colors, spacing, and component styles now use CSS variables defined in `:root`:

```css
:root {
  --primary: #321fdb;
  --secondary: #ced2d8;
  --success: #2eb85c;
  --info: #39f;
  --warning: #f9b115;
  --danger: #e55353;
  --sidebar-bg: #2c384a;
  --navbar-bg: #fff;
  --body-bg: #e4e5e6;
  /* ... and many more */
}
```

### 3. Layout Files Converted

The following main layout files have been converted to CoreUI:

#### Admin Layout (`layouts/admin.blade.php`)
- CoreUI header with navbar
- Sidebar with minimization support
- Modern card-based content area
- Footer with company information
- Full responsive support

#### Agent Layout (`layouts/agent.blade.php`)
- Similar to admin layout
- Agent-specific navigation
- Department dropdowns in sidebar
- Ticket management features

#### Client Layout (`layouts/client.blade.php`)
- Public-facing design
- Simple navigation
- Login dropdown
- Footer with customizable sections

### 4. AdminLTE Compatibility Classes

To minimize breaking changes, AdminLTE classes are mapped to CoreUI equivalents:

```scss
.main-header { @extend .app-header; }
.main-sidebar { @extend .sidebar; }
.content-wrapper { @extend .app-body; }
.box { @extend .card; }
```

This means existing views using these classes will still work.

### 5. Component Compatibility

The following AdminLTE components have CoreUI equivalents with compatibility styles:

- **Small Box**: Dashboard info boxes with icons
- **Info Box**: Stat display boxes
- **Callout**: Alert-style callouts
- **Box**: Maps to Card component
- **Users List**: User grid/list display

## How to Use

### Using CSS Variables in Your Views

You can now easily customize colors using CSS variables:

```html
<div style="background-color: var(--primary); color: #fff;">
  Primary colored box
</div>

<button class="btn" style="background-color: var(--success);">
  Success Button
</button>
```

### Changing Theme Colors

To change the theme globally, simply override the CSS variables in your custom CSS:

```css
:root {
  --primary: #ff0000;  /* Change primary color to red */
  --sidebar-bg: #1a1a1a;  /* Dark sidebar */
}
```

### Dark Mode

Dark mode is pre-configured. To enable it, add the `data-theme="dark"` attribute to the HTML or body tag:

```html
<html data-theme="dark">
```

## Migration Checklist

- [x] Set up CoreUI 2.16 dependencies
- [x] Create SCSS architecture with CSS variables
- [x] Compile and test assets
- [x] Convert admin layout to CoreUI
- [x] Convert agent layout to CoreUI
- [x] Convert client layout to CoreUI
- [x] Add AdminLTE compatibility classes
- [ ] Convert remaining layouts (guest, blank, installer, kb, login, register)
- [ ] Update admin panel views to use CoreUI classes
- [ ] Update agent panel views to use CoreUI classes
- [ ] Update client panel views to use CoreUI classes
- [ ] Update common/shared components
- [ ] Test all functionality
- [ ] Create documentation for developers

## File Structure

```
resources/
├── scss/
│   ├── coreui.scss          # Main CoreUI config with CSS variables
│   └── app.scss             # Application styles
├── js/
│   └── app.js               # CoreUI initialization
└── views/
    └── themes/
        └── default1/
            ├── layouts/
            │   ├── admin.blade.php      # CoreUI admin layout
            │   ├── agent.blade.php      # CoreUI agent layout
            │   ├── client.blade.php     # CoreUI client layout
            │   ├── admin.blade.php.adminlte.bak   # Backup
            │   ├── agent.blade.php.adminlte.bak   # Backup
            │   └── client.blade.php.adminlte.bak  # Backup
            └── coreui-layouts/   # CoreUI template originals
```

## Testing

After migration, test the following:

1. **Admin Panel**:
   - Login and navigation
   - Sidebar toggle and minimization
   - All admin functions (users, tickets, settings)
   - Responsive behavior on mobile

2. **Agent Panel**:
   - Agent login
   - Ticket management
   - Department navigation
   - Profile and logout

3. **Client Panel**:
   - Public ticket submission
   - Client login
   - Ticket viewing
   - Responsive design

## Next Steps

1. Convert remaining layout files (guest, blank, installer, kb, login, register)
2. Update individual view files to use CoreUI components where applicable
3. Remove old AdminLTE CSS/JS files to reduce bundle size
4. Update documentation for developers
5. Create a style guide showing available CoreUI components

## Resources

- [CoreUI Documentation](https://coreui.io/docs/2.1/getting-started/introduction/)
- [Bootstrap 4 Documentation](https://getbootstrap.com/docs/4.6/)
- [CSS Custom Properties](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)

## Support

For questions or issues related to the CoreUI migration, please refer to:
- Project repository custom instructions
- CoreUI documentation
- This migration guide

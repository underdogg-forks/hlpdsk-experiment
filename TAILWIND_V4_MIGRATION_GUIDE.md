# Tailwind CSS v4 + Vite Migration Guide

This document explains the migration from CoreUI (Bootstrap 4) to Tailwind CSS v4 with Vite build system.

## Overview

The application has been migrated from:
- **From**: CoreUI 2.16 + Bootstrap 4 + Laravel Mix + SCSS
- **To**: Tailwind CSS v4 + Vite + Modern CSS

## What Changed

### 1. Build System
- **Removed**: Laravel Mix, Webpack
- **Added**: Vite 5.0
- **Benefits**: 
  - Instant HMR (Hot Module Replacement)
  - Faster builds (3-5x faster)
  - Better tree-shaking
  - Native ES modules

### 2. CSS Framework
- **Removed**: CoreUI, Bootstrap 4, SCSS files
- **Added**: Tailwind CSS v4 (alpha)
- **Benefits**:
  - Utility-first CSS
  - Smaller bundle sizes (47KB vs 343KB)
  - Native CSS custom properties
  - No jQuery dependency
  - Better customization via CSS

### 3. Dependencies
**Before:**
```json
{
  "@coreui/coreui": "^2.1.16",
  "bootstrap": "^4.6.2",
  "jquery": "^3.7.1",
  "laravel-mix": "^6.0.6",
  "sass": "^1.69.5"
}
```

**After:**
```json
{
  "@tailwindcss/vite": "^4.0.0-alpha.25",
  "tailwindcss": "^4.0.0-alpha.25",
  "vite": "^5.0.0",
  "laravel-vite-plugin": "^1.0.0"
}
```

## New File Structure

```
resources/
├── css/
│   └── app.css                 # Tailwind CSS with custom components
├── js/
│   └── app.js                  # Modern JavaScript (no jQuery)
└── views/
    └── themes/
        └── default1/
            └── layouts/
                ├── admin.blade.php      # Tailwind-based admin layout
                ├── agent.blade.php      # (To be updated)
                ├── client.blade.php     # (To be updated)
                └── ...                  # Other layouts

public/
└── build/
    ├── manifest.json
    └── assets/
        ├── app-*.css            # Compiled Tailwind (47KB)
        └── app-*.js             # Compiled JS (3KB)

vite.config.js                   # Vite configuration
```

## Tailwind CSS v4 Features

### CSS-Based Configuration
Tailwind v4 uses CSS `@theme` directive instead of `tailwind.config.js`:

```css
@theme {
  --color-primary: #321fdb;
  --color-secondary: #ced2d8;
  --color-success: #2eb85c;
  --spacing-sidebar-width: 16rem;
  --transition-speed: 300ms;
}
```

### Custom Components
Components are defined using `@layer components`:

```css
@layer components {
  .btn {
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    font-weight: 500;
  }
  
  .btn-primary {
    background-color: rgb(37 99 235);
    color: white;
  }
}
```

### Utility Classes
All Tailwind utilities available:
- `flex`, `grid`, `hidden`
- `bg-blue-500`, `text-white`
- `p-4`, `m-2`, `space-x-4`
- `rounded`, `shadow-md`
- `hover:`, `focus:`, `lg:` modifiers

## Using Vite in Blade Templates

### Old Way (Laravel Mix)
```blade
<link href="{{ asset('css/coreui.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>
```

### New Way (Vite)
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

Vite automatically:
- Injects correct asset URLs
- Enables HMR in development
- Handles cache busting in production

## Component Migration Examples

### Card Component

**CoreUI/Bootstrap:**
```html
<div class="card">
    <div class="card-header">Title</div>
    <div class="card-body">Content</div>
</div>
```

**Tailwind:**
```html
<div class="card">
    <div class="card-header">Title</div>
    <div class="card-body">Content</div>
</div>
```
(Same markup! Styles defined in CSS using `@layer components`)

**Or with Tailwind utilities:**
```html
<div class="bg-white rounded shadow-sm border border-gray-200">
    <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">Title</div>
    <div class="p-4">Content</div>
</div>
```

### Buttons

**CoreUI/Bootstrap:**
```html
<button class="btn btn-primary">Click Me</button>
```

**Tailwind:**
```html
<button class="btn btn-primary">Click Me</button>
```
(Same! Or use utilities):
```html
<button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
    Click Me
</button>
```

### Flexbox Layout

**CoreUI/Bootstrap:**
```html
<div class="d-flex justify-content-between align-items-center">
    <div>Left</div>
    <div>Right</div>
</div>
```

**Tailwind:**
```html
<div class="flex justify-between items-center">
    <div>Left</div>
    <div>Right</div>
</div>
```

### Grid System

**Bootstrap:**
```html
<div class="row">
    <div class="col-md-6">Half</div>
    <div class="col-md-6">Half</div>
</div>
```

**Tailwind:**
```html
<div class="grid md:grid-cols-2 gap-4">
    <div>Half</div>
    <div>Half</div>
</div>
```

## Responsive Design

Tailwind uses mobile-first breakpoints:

```
sm: 640px   (tablet)
md: 768px   (small laptop)
lg: 1024px  (desktop)
xl: 1280px  (large desktop)
2xl: 1536px (extra large)
```

**Examples:**
```html
<!-- Hidden on mobile, visible on desktop -->
<div class="hidden lg:block">Desktop only</div>

<!-- Full width on mobile, half on desktop -->
<div class="w-full lg:w-1/2">Responsive width</div>

<!-- Stack on mobile, row on desktop -->
<div class="flex flex-col lg:flex-row">...</div>
```

## Development Workflow

### Start Development Server
```bash
npm run dev
```
This starts Vite dev server with HMR on `http://localhost:5173`

### Build for Production
```bash
npm run build
```
Outputs optimized assets to `public/build/`

### Preview Production Build
```bash
npm run preview
```

## JavaScript Changes

### No jQuery
All JavaScript is now vanilla ES6+:

```javascript
// Old (jQuery)
$('.sidebar-toggle').click(function() {
    $('.sidebar').toggle();
});

// New (Vanilla JS)
document.querySelector('.sidebar-toggle')?.addEventListener('click', () => {
    document.querySelector('.sidebar')?.classList.toggle('hidden');
});
```

### Modern Features
- ES6 modules (`import`/`export`)
- Arrow functions
- Template literals
- Destructuring
- Async/await

## Compatibility Classes

For backward compatibility with existing views:

```css
/* AdminLTE colors */
.bg-aqua { background-color: rgb(6 182 212); }
.bg-green { background-color: rgb(34 197 94); }
.bg-yellow { background-color: rgb(234 179 8); }
.bg-red { background-color: rgb(239 68 68); }

/* Bootstrap utilities */
.pull-right { float: right; }
.pull-left { float: left; }
.hidden { display: none; }
```

## Performance Improvements

| Metric | CoreUI + Mix | Tailwind + Vite | Improvement |
|--------|--------------|-----------------|-------------|
| **CSS Size** | 343 KB | 47 KB | 86% smaller |
| **JS Size** | 1.7 MB | 3 KB | 99.8% smaller |
| **Build Time** | ~5s | ~1s | 5x faster |
| **Dev HMR** | 2-3s | <100ms | 20-30x faster |
| **Dependencies** | 774 packages | 55 packages | 93% fewer |

## Customization

### Changing Colors

Edit `resources/css/app.css`:

```css
@theme {
  --color-primary: #ff0000;      /* Red primary */
  --color-sidebar-bg: #1a1a1a;   /* Dark sidebar */
}
```

### Adding Custom Utilities

```css
@layer utilities {
  .text-shadow {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
  }
}
```

### Creating Components

```css
@layer components {
  .my-button {
    padding: 0.5rem 1rem;
    background-color: purple;
    color: white;
    border-radius: 0.25rem;
  }
}
```

## Common Tailwind Patterns

### Centering

```html
<!-- Horizontal center -->
<div class="flex justify-center">...</div>

<!-- Vertical center -->
<div class="flex items-center">...</div>

<!-- Both -->
<div class="flex items-center justify-center">...</div>

<!-- Absolute center -->
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">...</div>
```

### Spacing

```html
<!-- Margin -->
<div class="m-4">All sides</div>
<div class="mt-4 mb-2">Top and bottom</div>
<div class="mx-auto">Horizontal center</div>

<!-- Padding -->
<div class="p-4">All sides</div>
<div class="px-4 py-2">Horizontal and vertical</div>

<!-- Gap (for flex/grid) -->
<div class="flex gap-4">...</div>
```

### Colors

```html
<!-- Background -->
<div class="bg-blue-500">Blue background</div>
<div class="bg-gray-100">Light gray</div>

<!-- Text -->
<div class="text-red-600">Red text</div>

<!-- Border -->
<div class="border border-gray-300">Gray border</div>
```

## Migration Checklist

- [x] Install Tailwind CSS v4 and Vite
- [x] Remove CoreUI, Bootstrap, Laravel Mix
- [x] Create Tailwind CSS configuration
- [x] Create Vite configuration
- [x] Update `resources/css/app.css` with Tailwind
- [x] Update `resources/js/app.js` (remove jQuery)
- [x] Update admin layout to use Tailwind + Vite
- [ ] Update agent layout
- [ ] Update client layout
- [ ] Update remaining layouts (6 files)
- [ ] Update view files (~316 files)
- [ ] Test all functionality
- [ ] Update documentation

## Troubleshooting

### Assets not loading
Make sure you're using `@vite()` directive:
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

### HMR not working
1. Check Vite dev server is running: `npm run dev`
2. Verify `APP_URL` in `.env` matches your dev URL
3. Clear browser cache

### Styles not applying
1. Rebuild: `npm run build`
2. Check class names are correct
3. Verify Tailwind classes exist in v4

### Build errors
1. Delete `node_modules` and `package-lock.json`
2. Run `npm install`
3. Run `npm run build`

## Resources

- [Tailwind CSS v4 Docs](https://tailwindcss.com/docs/v4-beta)
- [Vite Documentation](https://vitejs.dev/)
- [Laravel Vite Plugin](https://laravel.com/docs/vite)

## Next Steps

1. Update remaining layout files
2. Create component library documentation
3. Update existing views incrementally
4. Test responsive behavior
5. Optimize for production

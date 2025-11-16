# Blade View Refactoring Guide

This guide provides detailed instructions for converting remaining blade views from AdminLTE to CoreUI.

## Overview

All 9 layout files have been converted to CoreUI. The remaining ~316 blade files need to be updated to use CoreUI classes and components instead of AdminLTE.

## Conversion Strategy

### Automated Conversion (Phase 1)
A PHP script (`blade-migration-script.php`) has been created to automatically convert common AdminLTE classes to CoreUI equivalents.

**To run the automated conversion:**
```bash
php blade-migration-script.php
```

This script will:
- Scan all blade files (excluding layouts)
- Replace AdminLTE classes with CoreUI equivalents
- Create backups with `.adminlte.bak` extension
- Generate a report of changes made

### Manual Review (Phase 2)
After automated conversion, manually review and update:
1. Complex components (data tables, modals, widgets)
2. JavaScript initialization code
3. Custom inline styles
4. Asset references

## Class Mapping Reference

### Layout Classes
| AdminLTE | CoreUI |
|----------|--------|
| `.wrapper` | `.app` |
| `.main-header` | `.app-header.navbar` |
| `.main-sidebar` | `.sidebar` |
| `.content-wrapper` | `.main` |
| `.main-footer` | `.app-footer` |
| `.content` | `.container-fluid` |

### Box/Card Components
| AdminLTE | CoreUI |
|----------|--------|
| `.box` | `.card` |
| `.box-header` | `.card-header` |
| `.box-body` | `.card-body` |
| `.box-footer` | `.card-footer` |
| `.box-title` | `.card-title` |
| `.box-primary` | `.card.border-primary` |
| `.box-success` | `.card.border-success` |
| `.box-info` | `.card.border-info` |
| `.box-warning` | `.card.border-warning` |
| `.box-danger` | `.card.border-danger` |
| `.box-solid` | `.card` |

### Button Classes
| AdminLTE | CoreUI |
|----------|--------|
| `.btn-default` | `.btn-secondary` |
| `.btn-primary` | `.btn-primary` |
| `.btn-success` | `.btn-success` |
| `.btn-info` | `.btn-info` |
| `.btn-warning` | `.btn-warning` |
| `.btn-danger` | `.btn-danger` |
| `.btn-flat` | `.btn` |

### Color/Background Classes
| AdminLTE | CoreUI |
|----------|--------|
| `.bg-aqua` | `.bg-info` |
| `.bg-green` | `.bg-success` |
| `.bg-yellow` | `.bg-warning` |
| `.bg-red` | `.bg-danger` |
| `.text-aqua` | `.text-info` |
| `.text-green` | `.text-success` |
| `.text-yellow` | `.text-warning` |
| `.text-red` | `.text-danger` |

### Grid System (Bootstrap 3 to 4)
| Bootstrap 3 (AdminLTE) | Bootstrap 4 (CoreUI) |
|------------------------|----------------------|
| `.col-xs-*` | `.col-*` |
| `.col-sm-*` | `.col-sm-*` |
| `.col-md-*` | `.col-md-*` |
| `.col-lg-*` | `.col-lg-*` |
| `.col-xs-offset-*` | `.offset-*` |
| `.col-sm-offset-*` | `.offset-sm-*` |

### Utility Classes
| AdminLTE | CoreUI |
|----------|--------|
| `.pull-right` | `.float-right` |
| `.pull-left` | `.float-left` |
| `.hidden-xs` | `.d-none.d-sm-inline` |
| `.hidden-sm` | `.d-sm-none.d-md-inline` |
| `.visible-xs` | `.d-inline.d-sm-none` |
| `.visible-sm` | `.d-none.d-sm-inline.d-md-none` |
| `.center-block` | `.mx-auto` |
| `.text-center` | `.text-center` (same) |

### Form Classes
| AdminLTE | CoreUI |
|----------|--------|
| `.form-group` | `.form-group.mb-3` |
| `.form-control` | `.form-control` (same) |
| `.input-group` | `.input-group` (same) |
| `.input-group-addon` | `.input-group-prepend`/`.input-group-append` |
| `.has-error` | `.is-invalid` |
| `.has-success` | `.is-valid` |
| `.help-block` | `.invalid-feedback` |

## Component Conversions

### Small Box (Dashboard Widgets)
**AdminLTE:**
```blade
<div class="small-box bg-aqua">
    <div class="inner">
        <h3>150</h3>
        <p>New Orders</p>
    </div>
    <div class="icon">
        <i class="fa fa-shopping-cart"></i>
    </div>
    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
</div>
```

**CoreUI (Already styled via compatibility classes):**
Same markup works! The CSS has compatibility styles.

### Info Box
**AdminLTE:**
```blade
<div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope"></i></span>
    <div class="info-box-content">
        <span class="info-box-text">Messages</span>
        <span class="info-box-number">1,410</span>
    </div>
</div>
```

**CoreUI (Already styled via compatibility classes):**
Same markup works! The CSS has compatibility styles.

### Data Tables
**AdminLTE:**
```blade
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <!-- content -->
        </table>
    </div>
</div>
```

**CoreUI:**
```blade
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Table</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-responsive">
            <!-- content -->
        </table>
    </div>
</div>
```

### Modals
**AdminLTE:**
```blade
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body">
                <!-- content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
```

**CoreUI:**
```blade
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
```

### Forms with Validation
**AdminLTE:**
```blade
<div class="form-group has-error">
    <label>Email</label>
    <input type="email" class="form-control" />
    <span class="help-block">This field is required</span>
</div>
```

**CoreUI:**
```blade
<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control is-invalid" />
    <div class="invalid-feedback">This field is required</div>
</div>
```

## Asset References

### CSS Files to Remove
After conversion, you can remove these old AdminLTE CSS files:
- `AdminLTE.min.css`
- `_all-skins.min.css`
- Any Bootstrap 3 CSS files

### CSS Files to Keep/Add
- `css/coreui.css` (already compiled)
- `css/app.css` (already compiled)
- Font Awesome 5+ (already included in layouts)

### JavaScript Files
CoreUI uses Bootstrap 4 and includes:
- `js/app.js` (CoreUI + Bootstrap 4 + jQuery)

Remove old AdminLTE JS files:
- `app.min.js` (AdminLTE)
- Bootstrap 3 JS
- Old jQuery versions

## Testing Checklist

After converting views, test the following:

### Functionality Testing
- [ ] All forms submit correctly
- [ ] Validation messages display properly
- [ ] Modals open and close
- [ ] Dropdowns work
- [ ] Data tables load and function
- [ ] Pagination works
- [ ] Search functionality
- [ ] Filters apply correctly

### Visual Testing
- [ ] Layout looks correct on desktop
- [ ] Layout looks correct on tablet
- [ ] Layout looks correct on mobile
- [ ] All colors match theme
- [ ] Icons display correctly
- [ ] Buttons are styled properly
- [ ] Cards/boxes have proper spacing
- [ ] Tables are responsive

### Browser Testing
- [ ] Chrome
- [ ] Firefox
- [ ] Safari
- [ ] Edge

## Common Issues and Solutions

### Issue: Buttons too small
**Solution:** CoreUI uses different padding. Add `.btn-lg` or `.btn-sm` as needed.

### Issue: Grid layout broken
**Solution:** Check for `col-xs-*` classes and convert to `col-*`.

### Issue: Modal header layout wrong
**Solution:** Update modal header structure (close button position changed).

### Issue: Form validation not showing
**Solution:** Replace `.has-error` and `.help-block` with `.is-invalid` and `.invalid-feedback`.

### Issue: Icons not displaying
**Solution:** Check Font Awesome version. Update from FA4 to FA5 syntax if needed:
- `fa-icon` → `fas fa-icon` (solid)
- `fa-icon` → `far fa-icon` (regular)
- `fa-icon` → `fab fa-icon` (brands)

## Progress Tracking

Track your conversion progress:

### Admin Panel Views
- [ ] Dashboard views
- [ ] Agent management views
- [ ] Department views
- [ ] Team views
- [ ] Group views
- [ ] Email management views
- [ ] Template views
- [ ] Settings views
- [ ] Language views
- [ ] Label views
- [ ] Queue views
- [ ] Ticket views
- [ ] Knowledge base views

### Agent Panel Views
- [ ] Dashboard
- [ ] Ticket views
- [ ] User management
- [ ] Organization views
- [ ] Report views
- [ ] Canned responses
- [ ] Knowledge base views

### Client Panel Views
- [ ] Home page
- [ ] Ticket submission
- [ ] My tickets
- [ ] Profile views
- [ ] Guest user views
- [ ] Knowledge base views

## Need Help?

Refer to:
- COREUI_MIGRATION_GUIDE.md for overall strategy
- CoreUI documentation: https://coreui.io/docs/2.1/
- Bootstrap 4 migration guide: https://getbootstrap.com/docs/4.6/migration/

## Automated Script Details

The `blade-migration-script.php` script performs these conversions automatically:
1. Class name replacements
2. Grid system updates
3. Utility class updates
4. Layout class updates
5. Creates backups before modification
6. Generates conversion report

**Always review automated changes before committing!**

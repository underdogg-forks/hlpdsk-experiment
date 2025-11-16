// Modern JavaScript for Tailwind CSS application

// Sidebar toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar toggle
    const sidebarToggles = document.querySelectorAll('[data-toggle="sidebar"]');
    const sidebar = document.querySelector('.sidebar');
    const body = document.body;
    
    sidebarToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.toggle('sidebar-open');
            
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');
            }
        });
    });
    
    // Desktop sidebar minimize
    const minimizeToggles = document.querySelectorAll('[data-toggle="sidebar-minimize"]');
    
    minimizeToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            body.classList.toggle('sidebar-minimized');
        });
    });
    
    // Dropdown functionality
    const dropdownToggles = document.querySelectorAll('[data-toggle="dropdown"]');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const menu = this.nextElementSibling;
            
            if (menu && menu.classList.contains('dropdown-menu')) {
                // Close other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.classList.add('hidden');
                });
                
                menu.classList.toggle('hidden');
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[data-toggle="dropdown"]')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
    
    // Modal functionality
    const modalToggles = document.querySelectorAll('[data-toggle="modal"]');
    
    modalToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const modal = document.querySelector(targetId);
            
            if (modal) {
                modal.classList.remove('hidden');
                body.classList.add('overflow-hidden');
            }
        });
    });
    
    // Modal close functionality
    const modalCloses = document.querySelectorAll('[data-dismiss="modal"]');
    
    modalCloses.forEach(close => {
        close.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal');
            
            if (modal) {
                modal.classList.add('hidden');
                body.classList.remove('overflow-hidden');
            }
        });
    });
    
    // Alert close functionality
    const alertCloses = document.querySelectorAll('[data-dismiss="alert"]');
    
    alertCloses.forEach(close => {
        close.addEventListener('click', function(e) {
            e.preventDefault();
            const alert = this.closest('.alert');
            
            if (alert) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            }
        });
    });
    
    // Tab functionality
    const tabToggles = document.querySelectorAll('[data-toggle="tab"]');
    
    tabToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href') || this.getAttribute('data-target');
            const target = document.querySelector(targetId);
            
            if (target) {
                // Hide all tab panes
                const tabContent = target.closest('.tab-content');
                if (tabContent) {
                    tabContent.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.add('hidden');
                        pane.classList.remove('active');
                    });
                }
                
                // Deactivate all tabs
                const tabList = this.closest('[role="tablist"]');
                if (tabList) {
                    tabList.querySelectorAll('[data-toggle="tab"]').forEach(tab => {
                        tab.classList.remove('active');
                        tab.setAttribute('aria-selected', 'false');
                    });
                }
                
                // Activate clicked tab
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                
                // Show target pane
                target.classList.remove('hidden');
                target.classList.add('active');
            }
        });
    });
    
    // Tooltip functionality (simple implementation)
    const tooltips = document.querySelectorAll('[data-toggle="tooltip"]');
    
    tooltips.forEach(el => {
        el.addEventListener('mouseenter', function() {
            const title = this.getAttribute('title') || this.getAttribute('data-original-title');
            if (title) {
                const tooltip = document.createElement('div');
                tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg';
                tooltip.textContent = title;
                tooltip.style.bottom = '100%';
                tooltip.style.left = '50%';
                tooltip.style.transform = 'translateX(-50%)';
                tooltip.style.marginBottom = '5px';
                
                this.style.position = 'relative';
                this.appendChild(tooltip);
                this._tooltip = tooltip;
            }
        });
        
        el.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.remove();
                delete this._tooltip;
            }
        });
    });
});

// Export for use in other scripts if needed
export default {};


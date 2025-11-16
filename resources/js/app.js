// Import CoreUI and dependencies
import '@coreui/coreui';
import 'bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;

// CoreUI Perfect Scrollbar (optional but recommended for sidebar)
// import PerfectScrollbar from 'perfect-scrollbar';

// Initialize CoreUI App
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggler = document.querySelector('.sidebar-toggler');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggler && sidebar) {
        sidebarToggler.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('sidebar-minimized');
        });
    }
    
    // Mobile sidebar toggle
    const mobileSidebarToggler = document.querySelector('[data-toggle="sidebar"]');
    if (mobileSidebarToggler) {
        mobileSidebarToggler.addEventListener('click', function(e) {
            e.preventDefault();
            document.body.classList.toggle('sidebar-show');
        });
    }
});

#!/usr/bin/env php
<?php
/**
 * Blade View Migration Script
 * Converts AdminLTE classes and components to CoreUI equivalents
 * 
 * Usage: php blade-migration-script.php
 */

$baseDir = __DIR__ . '/resources/views/themes/default1';
$excludeDirs = ['layouts', 'coreui-layouts'];

// Class mapping from AdminLTE to CoreUI
$classMapping = [
    // Layout classes
    'wrapper' => 'app',
    'main-header' => 'app-header navbar',
    'main-sidebar' => 'sidebar',
    'content-wrapper' => 'main',
    'main-footer' => 'app-footer',
    
    // Box/Card classes
    'box' => 'card',
    'box-header' => 'card-header',
    'box-body' => 'card-body',
    'box-footer' => 'card-footer',
    'box-title' => 'card-title',
    'box-primary' => 'card border-primary',
    'box-success' => 'card border-success',
    'box-info' => 'card border-info',
    'box-warning' => 'card border-warning',
    'box-danger' => 'card border-danger',
    
    // Button classes
    'btn-default' => 'btn-secondary',
    
    // Alert classes (AdminLTE color scheme)
    'bg-aqua' => 'bg-info',
    'bg-green' => 'bg-success',
    'bg-yellow' => 'bg-warning',
    'bg-red' => 'bg-danger',
    
    // Panel classes
    'panel' => 'card',
    'panel-heading' => 'card-header',
    'panel-body' => 'card-body',
    'panel-footer' => 'card-footer',
    'panel-default' => 'card',
    'panel-primary' => 'card border-primary',
    
    // Form classes
    'form-group' => 'form-group mb-3',
    
    // Table responsive
    'table-responsive' => 'table-responsive',
    
    // Utilities
    'pull-right' => 'float-right',
    'pull-left' => 'float-left',
    'hidden-xs' => 'd-none d-sm-inline',
    'hidden-sm' => 'd-sm-none d-md-inline',
    'visible-xs' => 'd-inline d-sm-none',
    'visible-sm' => 'd-none d-sm-inline d-md-none',
];

// Pattern replacements
$patterns = [
    // Update @extends directives
    "/@extends\('themes\.default1\.layouts\.admin'\)/i" => "@extends('themes.default1.layouts.admin')",
    "/@extends\('themes\.default1\.layouts\.agent'\)/i" => "@extends('themes.default1.layouts.agent')",
    "/@extends\('themes\.default1\.layouts\.client'\)/i" => "@extends('themes.default1.layouts.client')",
    
    // Replace col-xs with col-12 (Bootstrap 4 change)
    "/col-xs-(\d+)/i" => "col-$1",
    "/col-sm-(\d+)/i" => "col-sm-$1",
    "/col-md-(\d+)/i" => "col-md-$1",
    "/col-lg-(\d+)/i" => "col-lg-$1",
];

function findBladeFiles($dir, $excludeDirs = []) {
    $files = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $path = $file->getPathname();
            $shouldExclude = false;
            
            foreach ($excludeDirs as $excludeDir) {
                if (strpos($path, '/' . $excludeDir . '/') !== false) {
                    $shouldExclude = true;
                    break;
                }
            }
            
            if (!$shouldExclude) {
                $files[] = $path;
            }
        }
    }
    
    return $files;
}

function convertClassNames($content, $classMapping) {
    // Replace class names in class attributes
    $content = preg_replace_callback(
        '/class=["\']([^"\']*)["\']/',
        function($matches) use ($classMapping) {
            $classes = explode(' ', $matches[1]);
            $newClasses = [];
            
            foreach ($classes as $class) {
                $class = trim($class);
                if (isset($classMapping[$class])) {
                    $newClasses[] = $classMapping[$class];
                } else {
                    $newClasses[] = $class;
                }
            }
            
            return 'class="' . implode(' ', $newClasses) . '"';
        },
        $content
    );
    
    return $content;
}

function applyPatterns($content, $patterns) {
    foreach ($patterns as $pattern => $replacement) {
        $content = preg_replace($pattern, $replacement, $content);
    }
    
    return $content;
}

function generateMigrationReport($file, $changes) {
    if (empty($changes)) {
        return null;
    }
    
    return [
        'file' => $file,
        'changes' => count($changes),
        'details' => $changes
    ];
}

// Main execution
echo "CoreUI Blade Migration Script\n";
echo "==============================\n\n";

echo "Scanning for blade files in: $baseDir\n";
$files = findBladeFiles($baseDir, $excludeDirs);
echo "Found " . count($files) . " blade files to process.\n\n";

$processedFiles = 0;
$modifiedFiles = 0;
$report = [];

foreach ($files as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Apply conversions
    $content = convertClassNames($content, $classMapping);
    $content = applyPatterns($content, $patterns);
    
    if ($content !== $originalContent) {
        // Create backup
        $backupFile = $file . '.adminlte.bak';
        if (!file_exists($backupFile)) {
            copy($file, $backupFile);
        }
        
        // Write updated content
        file_put_contents($file, $content);
        $modifiedFiles++;
        
        echo "✓ Updated: " . basename($file) . "\n";
    }
    
    $processedFiles++;
}

echo "\n";
echo "Migration Complete!\n";
echo "===================\n";
echo "Processed: $processedFiles files\n";
echo "Modified: $modifiedFiles files\n";
echo "Backups created with .adminlte.bak extension\n";

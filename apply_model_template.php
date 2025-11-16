#!/usr/bin/env php
<?php

/**
 * Model Template Generator
 * 
 * This script applies the standardized model template to existing models
 */

if ($argc < 2) {
    echo "Usage: php apply_model_template.php <model_file_path>\n";
    exit(1);
}

$modelPath = $argv[1];

if (!file_exists($modelPath)) {
    echo "Error: File not found: $modelPath\n";
    exit(1);
}

// Read the existing model
$content = file_get_contents($modelPath);

// Extract namespace
preg_match('/namespace\s+([^;]+);/', $content, $namespaceMatch);
$namespace = $namespaceMatch[1] ?? 'App\\Model';

// Extract class name
preg_match('/class\s+(\w+)\s+extends/', $content, $classMatch);
$className = $classMatch[1] ?? 'Model';

// Extract table name if exists
preg_match('/protected\s+\$table\s*=\s*[\'"]([^\'"]+)/', $content, $tableMatch);
$table = $tableMatch[1] ?? null;

// Extract fillable/guarded
preg_match('/protected\s+\$fillable\s*=\s*\[(.*?)\];/s', $content, $fillableMatch);
preg_match('/protected\s+\$guarded\s*=\s*\[(.*?)\];/s', $content, $guardedMatch);

// Extract timestamps setting
preg_match('/public\s+\$timestamps\s*=\s*(true|false);/', $content, $timestampsMatch);
$timestamps = $timestampsMatch[1] ?? 'true';

// Extract existing methods for relationships, scopes, etc.
$relationships = [];
$scopes = [];
$accessors = [];
$mutators = [];

// Find relationship methods (hasMany, belongsTo, etc.)
preg_match_all('/public\s+function\s+(\w+)\s*\([^)]*\)\s*\{[^}]*return\s+\$this->(hasMany|belongsTo|hasOne|belongsToMany|morphTo|morphMany)/s', $content, $relMatches);
if (!empty($relMatches[0])) {
    $relationships = $relMatches[0];
}

// Find scope methods
preg_match_all('/public\s+function\s+scope\w+\s*\([^)]*\)[^{]*\{[^}]*\}/s', $content, $scopeMatches);
if (!empty($scopeMatches[0])) {
    $scopes = $scopeMatches[0];
}

// Find accessor methods
preg_match_all('/public\s+function\s+get\w+Attribute\s*\([^)]*\)[^{]*\{[^}]*\}/s', $content, $accessorMatches);
if (!empty($accessorMatches[0])) {
    $accessors = $accessorMatches[0];
}

// Find mutator methods
preg_match_all('/public\s+function\s+set\w+Attribute\s*\([^)]*\)[^{]*\{[^}]*\}/s', $content, $mutatorMatches);
if (!empty($mutatorMatches[0])) {
    $mutators = $mutatorMatches[0];
}

// Generate new model content
$template = "<?php\n\nnamespace {$namespace};\n\n";
$template .= "use App\\Models\\BaseModel;\n";
$template .= "use Illuminate\\Database\\Eloquent\\Model;\n\n";
$template .= "class {$className} extends BaseModel\n{\n";

if ($table) {
    $template .= "    protected \$table = '{$table}';\n\n";
}

$template .= "    public \$timestamps = {$timestamps};\n\n";
$template .= "    protected \$casts = [];\n\n";
$template .= "    protected \$guarded = [];\n\n";

$template .= "    #region Static Methods\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Static Methods\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n\n";
$template .= "    #endregion\n\n";

$template .= "    #region Relationships\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Relationships\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n\n";
foreach ($relationships as $relationship) {
    $template .= "    " . trim($relationship) . "\n\n";
}
$template .= "    #endregion\n\n";

$template .= "    #region Accessors\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Accessors\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n\n";
foreach ($accessors as $accessor) {
    $template .= "    " . trim($accessor) . "\n\n";
}
$template .= "    #endregion\n\n";

$template .= "    #region Mutators\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Mutators\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n\n";
foreach ($mutators as $mutator) {
    $template .= "    " . trim($mutator) . "\n\n";
}
$template .= "    #endregion\n\n";

$template .= "    #region Scopes\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Scopes\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n\n";
foreach ($scopes as $scope) {
    $template .= "    " . trim($scope) . "\n\n";
}
$template .= "    #endregion\n\n";

$template .= "    #region Factory\n";
$template .= "    /*\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    | Factory\n";
$template .= "    |--------------------------------------------------------------------------\n";
$template .= "    */\n";
$template .= "    #endregion\n";
$template .= "}\n";

// Backup original file
$backupPath = $modelPath . '.backup';
copy($modelPath, $backupPath);

// Write new content
file_put_contents($modelPath, $template);

echo "✓ Applied template to: {$modelPath}\n";
echo "  Backup saved to: {$backupPath}\n";
echo "  - Relationships: " . count($relationships) . "\n";
echo "  - Scopes: " . count($scopes) . "\n";
echo "  - Accessors: " . count($accessors) . "\n";
echo "  - Mutators: " . count($mutators) . "\n";

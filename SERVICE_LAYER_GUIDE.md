# Service Layer and Model Template Implementation Guide

## Overview

This document explains the Service Layer pattern and Model Template structure that has been implemented as a reference for the Groups module. This pattern should be applied to all models in the codebase.

## What Was Implemented

### 1. Model Template (`app/Models/Group.php`)

The Groups model now follows a consistent structure with clear regions:

```php
<?php

namespace App\Models;

use App\Models\BaseModel;

class Group extends BaseModel
{
    protected $table = 'groups';
    public $timestamps = true;
    protected $casts = [...];
    protected $guarded = [];

    #region Static Methods
    // Class-level utility methods
    public static function existsById($id) { ... }
    #endregion

    #region Relationships
    // Eloquent relationships
    public function users() { ... }
    public function departmentAssignments() { ... }
    #endregion

    #region Accessors
    // Computed attributes
    public function getStatusTextAttribute() { ... }
    #endregion

    #region Mutators
    // Attribute setters
    #endregion

    #region Scopes
    // Query scopes
    public function scopeActive($query) { ... }
    public function scopeHasAssignedAgents($query) { ... }
    #endregion

    #region Factory
    // Factory definitions
    #endregion
}
```

**Benefits:**
- Clear organization with #region markers
- Easy navigation in IDEs
- Consistent structure across all models
- Relationships and methods are immediately findable

### 2. Service Layer (`app/Services/GroupService.php`)

Business logic has been extracted from the controller into a dedicated service:

```php
<?php

namespace App\Services;

class GroupService
{
    public function create(array $data) { ... }
    public function update($id, array $data) { ... }
    public function delete($id) { ... }
    public function find($id) { ... }
    public function getAll() { ... }
    public function getActive() { ... }
    public function hasAssignedAgents($id) { ... }
    
    private function updateFields($group, $data) { ... }
}
```

**Responsibilities:**
- ✅ Business logic (validation, rules, calculations)
- ✅ Database operations (CRUD)
- ✅ Complex queries
- ✅ Data transformation
- ❌ HTTP concerns (requests, responses, redirects)
- ❌ View rendering

### 3. Thin Controller (`app/Http/Controllers/Admin/helpdesk/GroupController.php`)

The controller now focuses only on HTTP concerns:

```php
class GroupController extends Controller
{
    protected $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->middleware('auth');
        $this->middleware('roles');
        $this->groupService = $groupService;
    }

    public function store(GroupRequest $request)
    {
        try {
            $this->groupService->create($request->all());
            return redirect('groups')->with('success', Lang::get('lang.group_created_successfully'));
        } catch (Exception $e) {
            return $this->redirectWithError('lang.group_can_not_create', $e->getMessage());
        }
    }
}
```

**Responsibilities:**
- ✅ HTTP request handling
- ✅ Response formatting (redirects, JSON, views)
- ✅ Session flash messages
- ✅ Middleware application
- ❌ Business logic
- ❌ Database queries

### 4. PHPUnit Tests (`tests/Unit/Controllers/GroupControllerTest.php`)

Tests follow the `it_` naming convention:

```php
class GroupControllerTest extends TestCase
{
    public function it_displays_groups_index_page() { ... }
    public function it_creates_a_new_group_with_valid_data() { ... }
    public function it_updates_an_existing_group() { ... }
    public function it_deletes_a_group_successfully() { ... }
}
```

## How to Apply This Pattern to Other Models

### Step 1: Create the Model in `app/Models/`

```bash
# Example for Department model
php artisan make:model Models/Department
```

Update the model to follow the template:

```php
<?php

namespace App\Models;

use App\Models\BaseModel;

class Department extends BaseModel
{
    protected $table = 'department';
    public $timestamps = true;
    protected $casts = [];
    protected $guarded = [];

    #region Static Methods
    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    #endregion

    #region Relationships
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Example: A department has many tickets
    public function tickets()
    {
        return $this->hasMany(\App\Model\helpdesk\Ticket\Tickets::class, 'dept_id');
    }

    // Example: A department has many agents
    public function agents()
    {
        return $this->belongsToMany(\App\User::class, 'department_assign_agents');
    }

    #endregion

    #region Accessors
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    #endregion

    #region Mutators
    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    #endregion

    #region Scopes
    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    #endregion

    #region Factory
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */
    #endregion
}
```

### Step 2: Create the Service in `app/Services/`

```php
<?php

namespace App\Services;

use App\Model\helpdesk\Agent\Department;
use Exception;

class DepartmentService
{
    public function create(array $data)
    {
        try {
            $department = new Department();
            $department->fill($data);
            $department->save();
            return $department;
        } catch (Exception $e) {
            throw new Exception("Failed to create department: " . $e->getMessage());
        }
    }

    public function update($id, array $data)
    {
        $department = Department::find($id);
        
        if (!$department) {
            throw new Exception("Department not found");
        }

        try {
            $department->fill($data);
            $department->save();
            return $department;
        } catch (Exception $e) {
            throw new Exception("Failed to update department: " . $e->getMessage());
        }
    }

    public function delete($id)
    {
        // Check if department has active tickets
        $department = Department::find($id);
        
        if (!$department) {
            throw new Exception("Department not found");
        }

        if ($department->tickets()->exists()) {
            throw new Exception("Cannot delete department with active tickets");
        }

        return $department->delete();
    }

    public function find($id)
    {
        return Department::find($id);
    }

    public function getAll()
    {
        return Department::all();
    }
}
```

### Step 3: Refactor the Controller

Update the existing controller to use the service:

```php
<?php

namespace App\Http\Controllers\Admin\helpdesk;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use Exception;
use Lang;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->middleware('auth');
        $this->middleware('roles');
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        try {
            $departments = $this->departmentService->getAll();
            return view('departments.index', compact('departments'));
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $this->departmentService->create($request->all());
            return redirect('departments')->with('success', 'Department created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('fails', $e->getMessage());
        }
    }

    // ... other methods follow same pattern
}
```

### Step 4: Create Tests

```php
<?php

namespace Tests\Unit\Controllers;

use App\Services\DepartmentService;
use App\User;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    public function it_displays_departments_index_page()
    {
        $response = $this->actingAs($this->createAdminUser())
            ->get(route('departments.index'));
        
        $response->assertStatus(200);
    }

    public function it_creates_a_new_department_with_valid_data()
    {
        $data = [
            'name' => 'Support Department',
            'status' => 1,
        ];

        $response = $this->actingAs($this->createAdminUser())
            ->post(route('departments.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
    }

    // Helper method
    private function createAdminUser()
    {
        return User::factory()->create(['role' => 'admin']);
    }
}
```

## Migration Checklist

For each model you refactor:

- [ ] Create new model in `app/Models/` with template structure
- [ ] Define all relationships in #region Relationships
- [ ] Add useful scopes in #region Scopes
- [ ] Create service class in `app/Services/`
- [ ] Move all create/update/delete logic to service
- [ ] Refactor controller to inject and use service
- [ ] Remove business logic from controller
- [ ] Create/update tests with `it_` prefix
- [ ] Test CRUD operations work correctly
- [ ] Update documentation if needed

## Benefits of This Pattern

### For Developers

1. **Predictable Structure**: All models follow same organization
2. **Easy Navigation**: #region markers make code browsable
3. **Clear Separation**: Controllers handle HTTP, Services handle logic
4. **Testable**: Services can be unit tested in isolation
5. **Reusable**: Same service used by web, API, CLI

### For the Codebase

1. **Maintainability**: Changes are localized to appropriate layer
2. **Scalability**: Easy to add new features without bloating controllers
3. **Consistency**: Same patterns used throughout
4. **Documentation**: Structure is self-documenting
5. **Quality**: Easier to review and understand code

## Current Status

### ✅ Completed (Reference Implementation)

- Groups Model (`app/Models/Group.php`)
- GroupService (`app/Services/GroupService.php`)
- GroupController (refactored to use service)
- GroupControllerTest (with `it_` prefix tests)

### 🔄 To Be Implemented (112 models remaining)

The pattern should be applied to all models in:
- `app/Model/helpdesk/Agent/` (Departments, Teams, etc.)
- `app/Model/helpdesk/Ticket/` (Tickets, Threads, etc.)
- `app/Model/helpdesk/Settings/` (various settings models)
- `app/Model/kb/` (Articles, Categories, Pages)
- `app/Model/Common/` (Templates, etc.)
- And all other model directories

## Next Steps

1. **Prioritize Models**: Start with most frequently used models (Tickets, Users, Departments)
2. **Batch Implementation**: Group similar models together
3. **Test Thoroughly**: Ensure existing functionality isn't broken
4. **Update Documentation**: Add examples as patterns emerge
5. **Code Review**: Have refactored code reviewed before merging

## Getting Help

- Review `GroupController` and `GroupService` as reference
- Check `.junie/guidelines.md` for detailed patterns
- See `.github/copilot-instructions.md` for AI assistance guidelines
- Ask questions in PR comments for clarification

## Conclusion

This pattern modernizes the codebase while maintaining backward compatibility. The reference implementation (Groups) demonstrates all aspects of the pattern and serves as a template for refactoring the remaining 112 models.

Start with one model at a time, test thoroughly, and gradually apply the pattern across the entire codebase.

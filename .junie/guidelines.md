# Coding Guidelines

This document outlines the coding standards and best practices for this Laravel-based helpdesk application.

## Core Principles

### 1. SOLID Principles

#### Single Responsibility Principle (SRP)
- Each class should have only one reason to change
- Controllers should only handle HTTP requests and delegate business logic to services
- Models should only handle data representation and database interactions
- Services should contain reusable business logic

#### Open/Closed Principle (OCP)
- Classes should be open for extension but closed for modification
- Use dependency injection and interfaces to allow extending functionality without modifying existing code

#### Liskov Substitution Principle (LSP)
- Derived classes must be substitutable for their base classes
- Maintain consistent behavior across implementations of interfaces

#### Interface Segregation Principle (ISP)
- Clients should not be forced to depend on interfaces they don't use
- Create focused, specific interfaces rather than large, general-purpose ones

#### Dependency Inversion Principle (DIP)
- Depend on abstractions, not concretions
- Use dependency injection through constructors
- Type-hint against interfaces rather than concrete implementations

### 2. DRY (Don't Repeat Yourself)

- Eliminate duplicate code by extracting common functionality into reusable methods or services
- Use Laravel's features like traits, service providers, and repositories to avoid repetition
- Create helper functions for commonly used operations
- Use form requests for validation logic that's shared across multiple controllers

### 3. Early Returns

Use early returns to improve code readability and reduce nesting:

**Bad:**
```php
public function process($data)
{
    if ($data !== null) {
        if ($this->isValid($data)) {
            // Long processing logic
            return $result;
        } else {
            return null;
        }
    } else {
        return null;
    }
}
```

**Good:**
```php
public function process($data)
{
    if ($data === null) {
        return null;
    }
    
    if (!$this->isValid($data)) {
        return null;
    }
    
    // Long processing logic
    return $result;
}
```

### 4. Dynamic Programming

- Use memoization to cache results of expensive operations
- Leverage Laravel's cache system for frequently accessed data
- Implement lazy loading where appropriate
- Use database query optimization techniques (eager loading, select specific columns, etc.)

## Code Style

### Naming Conventions

- **Classes**: PascalCase (e.g., `GroupController`, `TicketService`)
- **Methods**: camelCase (e.g., `getUserById`, `processTicket`)
- **Variables**: camelCase (e.g., `$userId`, `$ticketData`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `MAX_ATTEMPTS`, `DEFAULT_TIMEOUT`)
- **Database tables**: snake_case, plural (e.g., `tickets`, `user_groups`)
- **Database columns**: snake_case (e.g., `created_at`, `user_id`)

### Test Methods

All test methods must:
- Start with `it_` prefix
- Be grammatically correct when read as a sentence
- Clearly describe what is being tested

**Examples:**
```php
public function it_creates_a_new_ticket_successfully()
public function it_validates_email_format_correctly()
public function it_returns_error_when_user_not_found()
public function it_prevents_duplicate_ticket_numbers()
```

### Method Organization

Organize methods in controllers as follows:
1. Constructor
2. Resource methods (index, create, store, show, edit, update, destroy)
3. Custom public methods (alphabetically)
4. Protected methods (alphabetically)
5. Private methods (alphabetically)

### Exception Handling

- Use specific exception types
- Catch the most specific exception first
- Log errors appropriately
- Return user-friendly error messages
- Use early returns in catch blocks when possible

**Example:**
```php
public function store(Request $request)
{
    try {
        $data = $this->validate($request);
        $ticket = $this->ticketService->create($data);
        
        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket created successfully');
            
    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (Exception $e) {
        Log::error('Ticket creation failed: ' . $e->getMessage());
        return back()->with('error', 'Failed to create ticket. Please try again.');
    }
}
```

## Laravel Best Practices

### Routing

- Group related routes together
- Use route names for all routes
- Organize routes by topic in separate files
- Use route model binding where appropriate
- Apply middleware at the route group level

### Controllers

- Keep controllers thin - delegate to services
- Use Form Request classes for validation
- Return consistent response types
- Use resource controllers for RESTful resources

### Models

- Define fillable or guarded properties
- Use accessors and mutators for data transformation
- Define relationships clearly
- Use scopes for common queries
- Add meaningful docblocks

### Services

- Create service classes for complex business logic
- Make services testable through dependency injection
- Keep services focused on a single domain
- Return consistent data structures

### Validation

- Use Form Request classes for complex validation
- Define validation rules as array or pipe-separated string
- Use custom validation rules for complex logic
- Provide clear, user-friendly error messages

## Database

### Migrations

- Never modify existing migrations that have been run in production
- Use descriptive migration names
- Keep migrations focused on a single change
- Always provide `down()` method for rollback

### Queries

- Use Eloquent ORM for standard queries
- Use Query Builder for complex queries
- Always use parameter binding to prevent SQL injection
- Eager load relationships to avoid N+1 queries
- Use database transactions for operations that modify multiple tables

## Security

- Validate and sanitize all user input
- Use prepared statements (Eloquent/Query Builder does this by default)
- Implement proper authentication and authorization
- Use CSRF protection on all forms
- Never store sensitive data in plain text
- Follow OWASP security guidelines

## Performance

- Use caching strategically
- Optimize database queries
- Use queue jobs for time-consuming tasks
- Implement pagination for large datasets
- Profile and monitor application performance

## Documentation

- Add PHPDoc blocks to all classes and methods
- Document complex business logic
- Keep README.md up to date
- Document API endpoints
- Maintain changelog for releases

## Version Control

- Write clear, descriptive commit messages
- Keep commits focused on a single change
- Use feature branches for new development
- Review code before merging
- Keep the main branch deployable at all times

## Testing

- Write tests for all new features
- Maintain test coverage above 70%
- Use meaningful test names with `it_` prefix
- Test edge cases and error conditions
- Keep tests independent and isolated
- Use factories for test data generation

## Model Template Standard

All models should follow this consistent structure for better organization and maintainability:

```php
<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class ModelName extends BaseModel
{
    public $timestamps = false;

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

**Key Points:**
- Extend `BaseModel` instead of Eloquent's Model directly
- Use `#region` comments for clear code organization
- Define relationships explicitly in the Relationships section
- Group static methods, accessors, mutators, and scopes logically
- Keep the structure consistent across all models

## Service Layer Pattern

### Why Use Services?

Services encapsulate business logic and provide several benefits:
- **Separation of Concerns**: Controllers handle HTTP, Services handle business logic
- **Reusability**: Service methods can be called from multiple controllers or commands
- **Testability**: Easier to test business logic in isolation
- **Maintainability**: Changes to business logic are centralized

### Service Structure

```php
<?php

namespace App\Services;

use Exception;

class ModelService
{
    /**
     * Create a new resource
     *
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function create(array $data)
    {
        // Validation logic
        // Business logic
        // Database operations
        return $model;
    }

    /**
     * Update an existing resource
     *
     * @param int $id
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function update($id, array $data)
    {
        // Find model
        // Validate business rules
        // Update model
        return $model;
    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete($id)
    {
        // Check dependencies
        // Perform deletion
        return true;
    }

    /**
     * Helper methods (private)
     */
    private function validateBusinessRules($data)
    {
        // Business validation logic
    }
}
```

### Controller Using Service

Controllers should be thin and delegate to services:

```php
<?php

namespace App\Http\Controllers;

use App\Services\ModelService;
use Exception;

class ModelController extends Controller
{
    protected $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function store(Request $request)
    {
        try {
            $model = $this->modelService->create($request->all());
            return redirect()->route('model.index')
                ->with('success', 'Created successfully');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
```

### Benefits

1. **Thin Controllers**: Controllers only handle HTTP concerns
2. **Fat Services**: Business logic centralized in services
3. **Testable**: Services can be mocked in controller tests
4. **Reusable**: Same service used by web, API, and console
5. **Single Responsibility**: Each service handles one model/domain

## Example Implementation

See `GroupController`, `GroupService`, and `app/Models/Group.php` for a complete example of:
- Model template structure with regions
- Service layer handling business logic
- Thin controller using dependency injection
- PHPUnit tests with `it_` prefix


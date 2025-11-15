# GitHub Copilot Instructions

This document provides instructions for AI assistants (like GitHub Copilot) working on this Laravel-based helpdesk application.

## Project Overview

This is a helpdesk/ticketing system built with Laravel. The application manages support tickets, user management, knowledge base articles, and various administrative functions.

## Key Architectural Patterns

### MVC Architecture
- **Models**: Located in `app/Model/` - handle data and business logic
- **Views**: Located in `resources/views/` - Blade templates for UI
- **Controllers**: Located in `app/Http/Controllers/` - handle HTTP requests and coordinate between models and views

### Namespace Structure
- `App\Http\Controllers\Admin` - Admin panel functionality
- `App\Http\Controllers\Agent` - Agent/staff functionality
- `App\Http\Controllers\Client` - Customer-facing functionality
- `App\Http\Controllers\Auth` - Authentication and authorization
- `App\Http\Controllers\Common` - Shared functionality

## Code Generation Guidelines

### When Creating Controllers

1. **Follow SOLID Principles**
   - Single Responsibility: Each controller handles one resource
   - Dependency Injection: Inject dependencies through constructor
   - Type hinting: Always type-hint parameters and return types

2. **Use Early Returns**
   ```php
   public function update($id, Request $request)
   {
       if (!$this->authorize($request)) {
           return $this->unauthorizedResponse();
       }
       
       if (!$this->validate($request)) {
           return $this->validationErrorResponse();
       }
       
       // Main logic here
       return $this->successResponse();
   }
   ```

3. **Apply DRY Principle**
   - Extract repeated logic into private methods
   - Use traits for shared functionality across controllers
   - Leverage Form Requests for validation
   - Create service classes for complex business logic

4. **Error Handling**
   ```php
   try {
       // Main logic
       return $this->successResponse($data);
   } catch (ModelNotFoundException $e) {
       return $this->notFoundResponse();
   } catch (ValidationException $e) {
       return $this->validationErrorResponse($e->errors());
   } catch (Exception $e) {
       Log::error('Operation failed: ' . $e->getMessage());
       return $this->errorResponse();
   }
   ```

### When Creating Tests

1. **Test Method Naming**
   - ALWAYS use `it_` prefix
   - Make test names grammatically correct
   - Be descriptive about what is being tested
   
   ```php
   public function it_creates_a_ticket_with_valid_data()
   public function it_returns_validation_error_when_email_is_invalid()
   public function it_prevents_unauthorized_access_to_admin_panel()
   public function it_successfully_assigns_ticket_to_agent()
   ```

2. **Test Structure**
   - Arrange: Set up test data and conditions
   - Act: Perform the action being tested
   - Assert: Verify the expected outcome
   
   ```php
   public function it_creates_a_new_user_successfully()
   {
       // Arrange
       $userData = [
           'name' => 'John Doe',
           'email' => 'john@example.com',
       ];
       
       // Act
       $response = $this->post(route('users.store'), $userData);
       
       // Assert
       $response->assertStatus(201);
       $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
   }
   ```

### When Creating Routes

1. **Route Organization**
   - Group routes by functionality (auth, admin, agent, client)
   - Use route names for all routes
   - Apply middleware at group level
   - Use resource routes where appropriate

2. **Route File Structure**
   ```php
   // routes/admin.php
   Route::middleware(['auth', 'role:admin'])->group(function () {
       Route::resource('groups', GroupController::class);
       Route::resource('departments', DepartmentController::class);
       // ... more routes
   });
   ```

### When Refactoring Code

1. **Identify Code Smells**
   - Long methods (>20 lines should be reviewed)
   - Deeply nested conditionals (>3 levels)
   - Duplicate code
   - Large classes (>300 lines should be reviewed)

2. **Apply Refactoring Patterns**
   - Extract Method: Break large methods into smaller ones
   - Extract Class: Move related methods to a new class
   - Replace Conditional with Polymorphism
   - Introduce Parameter Object for methods with many parameters

3. **Use Early Returns to Reduce Nesting**
   - Check error conditions first
   - Return early for special cases
   - Main logic comes last with minimal nesting

### Dynamic Programming Patterns

When implementing features that involve repetitive calculations or data access:

1. **Use Caching**
   ```php
   public function getTicketStats($userId)
   {
       return Cache::remember("ticket_stats_{$userId}", 3600, function () use ($userId) {
           return $this->calculateTicketStats($userId);
       });
   }
   ```

2. **Eager Loading**
   ```php
   // Bad: N+1 query problem
   $tickets = Ticket::all();
   foreach ($tickets as $ticket) {
       echo $ticket->user->name; // Separate query for each ticket
   }
   
   // Good: Single query with eager loading
   $tickets = Ticket::with('user')->get();
   foreach ($tickets as $ticket) {
       echo $ticket->user->name;
   }
   ```

3. **Lazy Loading with Collections**
   ```php
   public function processLargeDataset()
   {
       Ticket::chunk(100, function ($tickets) {
           foreach ($tickets as $ticket) {
               // Process each ticket
           }
       });
   }
   ```

## Common Patterns in This Project

### Authentication
- Uses Laravel's built-in authentication
- Custom role-based access control (admin, agent, user)
- Middleware: `auth`, `roles`, `role.agent`

### Database
- Models are in `app/Model/` directory
- Uses Eloquent ORM
- Migrations in `database/migrations/`

### Views
- Blade templating engine
- Located in `resources/views/themes/default1/`
- Separate views for admin, agent, and client

### Form Validation
- Form Request classes in `app/Http/Requests/`
- Validation rules defined in request classes
- Error messages handled by Laravel's validation system

## Things to Avoid

1. **Don't** create God objects (classes that do too much)
2. **Don't** use global state or static methods for business logic
3. **Don't** mix business logic with presentation logic
4. **Don't** create long parameter lists (>4 parameters)
5. **Don't** use magic numbers (define constants instead)
6. **Don't** ignore exceptions or catch them without proper handling
7. **Don't** write tests without the `it_` prefix
8. **Don't** create overly complex queries in controllers (use query scopes or repositories)

## Code Review Checklist

When suggesting code changes, ensure:
- [ ] SOLID principles are followed
- [ ] Early returns are used to reduce nesting
- [ ] No duplicate code (DRY principle)
- [ ] Proper error handling is in place
- [ ] Type hints are used for parameters and return types
- [ ] PHPDoc comments are added for complex methods
- [ ] Tests use `it_` prefix and are descriptive
- [ ] Routes are properly named and organized
- [ ] Security best practices are followed
- [ ] Performance considerations are addressed

## Laravel-Specific Patterns

### Service Providers
- Register services in `app/Providers/`
- Use for binding interfaces to implementations
- Use for registering event listeners

### Middleware
- Custom middleware in `app/Http/Middleware/`
- Applied at route or route group level
- Used for authentication, authorization, request modification

### Events and Listeners
- Events in `app/Events/`
- Listeners in `app/Listeners/`
- Register in `EventServiceProvider`

### Jobs and Queues
- Queue jobs in `app/Jobs/`
- Use for time-consuming operations
- Process asynchronously

## Database Conventions

- Table names: plural, snake_case (e.g., `ticket_threads`)
- Foreign keys: `{model}_id` (e.g., `user_id`)
- Pivot tables: alphabetically ordered model names (e.g., `department_user`)
- Timestamps: `created_at`, `updated_at`
- Soft deletes: `deleted_at`

## Response Formats

### JSON Responses
```php
// Success
return response()->json([
    'success' => true,
    'data' => $data,
    'message' => 'Operation completed successfully'
], 200);

// Error
return response()->json([
    'success' => false,
    'message' => 'Operation failed',
    'errors' => $errors
], 422);
```

### Redirects with Flash Messages
```php
return redirect()
    ->route('resource.index')
    ->with('success', 'Resource created successfully');
```

## Testing Guidelines

### What to Test
- All controller actions
- Custom validation rules
- Model relationships and scopes
- Service class methods
- Critical business logic
- Authorization policies

### Test Factories
- Use factories for creating test data
- Located in `database/factories/`
- Keep factories simple and focused

### Test Database
- Use in-memory SQLite for faster tests
- Use database transactions for test isolation
- Configure in `phpunit.xml`

## Performance Considerations

1. **Database Queries**
   - Use `select()` to limit columns retrieved
   - Eager load relationships to avoid N+1 queries
   - Use database indexing appropriately
   - Use query caching for expensive queries

2. **Caching Strategy**
   - Cache frequently accessed data
   - Use cache tags for grouped invalidation
   - Set appropriate TTL values

3. **Asset Optimization**
   - Minify CSS and JavaScript
   - Use Laravel Mix for asset compilation
   - Implement CDN for static assets

## Security Best Practices

1. **Input Validation**
   - Always validate user input
   - Use Form Requests for complex validation
   - Sanitize data before display

2. **Authentication & Authorization**
   - Use Laravel's authentication system
   - Implement proper authorization checks
   - Use policies for resource authorization

3. **SQL Injection Prevention**
   - Always use parameter binding (Eloquent does this automatically)
   - Never concatenate user input into queries

4. **XSS Prevention**
   - Blade's `{{ }}` syntax auto-escapes output
   - Use `{!! !!}` only when absolutely necessary and with trusted data

5. **CSRF Protection**
   - Include `@csrf` directive in all forms
   - Verify CSRF tokens on state-changing requests

## Useful Commands

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter it_creates_a_ticket

# Clear cache
php artisan cache:clear

# Run migrations
php artisan migrate

# Create controller
php artisan make:controller Admin/ExampleController --resource

# Create test
php artisan make:test ExampleTest --unit

# Create model with migration
php artisan make:model Example -m
```

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [PHP The Right Way](https://phptherightway.com/)
- [SOLID Principles](https://en.wikipedia.org/wiki/SOLID)
- [Refactoring Guru](https://refactoring.guru/)

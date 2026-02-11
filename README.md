[![CI](https://github.com/veldre/task-manager/actions/workflows/ci.yml/badge.svg)](https://github.com/veldre/task-manager/actions/workflows/ci.yml)

# Task Manager API — OOP & SOLID Practice Project

A backend-only REST API built with Laravel 12 to demonstrate:

- Object-Oriented Programming (OOP)
- SOLID principles
- Clean architecture
- Test-driven development
- Token-based authentication
- Policy-based authorization
- Swagger/OpenAPI documentation
- CI-enforced quality control

This project focuses on architectural quality and maintainability rather than feature quantity.

---

## Tech Stack

- PHP 8.x
- Laravel 12
- MySQL
- SQLite (in-memory for testing)
- Laravel Sanctum (API authentication)
- PHPUnit (Feature + Unit tests)
- Laravel Pint (code style)
- L5-Swagger (OpenAPI documentation)
- GitHub Actions (CI)

---

## Architectural Philosophy

The project enforces:

- Thin controllers
- Business logic outside the HTTP layer
- Explicit data contracts (DTOs)
- Repository abstraction
- Dependency Inversion Principle
- Policy-based authorization
- CI-required test passing before merge

The code grows in complexity only when architecturally justified.

---

## Project Structure

### Controllers (`app/Http/Controllers`)

Controllers:

- Handle HTTP only
- Delegate validation to Form Requests
- Delegate business logic to Actions
- Return API Resources
- Contain no domain logic

---

### Actions (`app/Actions`)

Each Action represents a single use case:

- CreateTaskAction
- UpdateTaskAction
- DeleteTaskAction
- ListTasksAction
- RegisterUserAction
- LoginUserAction

Actions:

- Accept DTOs
- Do not depend on HTTP
- Depend on abstractions
- Are unit-testable in isolation

---

### DTOs (`app/Actions/**/DTO`)

DTOs:

- Define explicit input contracts
- Replace raw arrays between layers
- Improve clarity and maintainability
- Make refactoring safer

---

### Repository Layer (`app/Repositories`)

- TaskRepositoryInterface
- DatabaseTaskRepository

Bound via a Service Provider.

Benefits:

- Swappable persistence layer
- Easy mocking for unit tests
- Proper Dependency Inversion

---

### Models (`app/Models`)

Models represent persistence only.

Business rules live inside Actions and policies.

---

## Authentication (Laravel Sanctum)

Implemented:

- User registration
- User login
- Token generation
- Logout (token invalidation)
- Authenticated `/me` endpoint
- All task routes protected by `auth:sanctum`

Token-based authentication using Bearer tokens.

---

## Authorization

Task access is enforced via:

- TaskPolicy
- Ownership check using `user_id`
- Users can only view, update, or delete their own tasks

---

## API Documentation (Swagger / OpenAPI)

Interactive API documentation is available via Swagger:

```
/api/documentation
```

Example (local environment):

```
http://task-manager.test/api/documentation#/Tasks
```

Documentation includes:

- Auth endpoints
- Task endpoints
- Request/response schemas
- Example payloads
- Authentication requirements

OpenAPI annotations are maintained alongside the codebase.

---

## Implemented Features

### Authentication

- Register
- Login
- Logout
- Get current user
- Token-based API access

### Tasks

- Create task
- Update task (partial updates)
- Delete task
- Show single task
- List tasks (paginated)
- Ownership enforcement
- Validation via Form Requests
- API Resource formatting

### Architecture

- Action pattern
- DTO pattern
- Repository abstraction
- Policy authorization
- Dependency injection
- Service Provider bindings

### Quality

- Feature tests for endpoints
- Unit tests for Actions (mocked repositories)
- SQLite in-memory test database
- Laravel Pint lint enforcement
- Swagger documentation
- GitHub Actions CI
- Protected main branch requiring passing checks

---

## API Endpoints

### Auth

POST   /api/v1/auth/register  
POST   /api/v1/auth/login  
POST   /api/v1/auth/logout  
GET    /api/v1/auth/me  

### Tasks (Authenticated)

GET     /api/v1/tasks  
POST    /api/v1/tasks  
GET     /api/v1/tasks/{task}  
PATCH   /api/v1/tasks/{task}  
DELETE  /api/v1/tasks/{task}  

All task routes require a Bearer token.

---

## Running Locally

```bash
git clone https://github.com/veldre/task-manager
cd task-manager

composer install

cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan serve
```

Swagger will be available at:

```
http://localhost:8000/api/documentation
```

---

## Running Tests

```bash
php artisan test
```

Lint check:

```bash
./vendor/bin/pint --test
```

---

## Continuous Integration

Every push and pull request runs:

1. Composer install
2. Pint lint check
3. Full test suite

The `main` branch is protected and requires passing checks before merging.

---

## TODO / Future Improvements

- Task completion state
- Task filtering and sorting
- Rate limiting
- API versioning strategy
- Role-based authorization
- Caching exploration
- Dockerized environment
- Event-driven architecture exploration

---

## Purpose

This project exists to:

- Practice clean architecture in Laravel
- Demonstrate SOLID principles in real code
- Showcase testable design
- Provide a portfolio-ready backend example
- Show CI discipline and documentation standards

# Task Manager API — OOP & SOLID Practice Project

This project is a **backend-only Task Manager API** built in Laravel, created specifically to practice and demonstrate **OOP principles**, **SOLID design**, and **testable architecture**.

The project is intentionally **work-in-progress**.  
The goal is not feature completeness, but **clean structure, clear responsibilities, and extensibility**.

---

## Tech Stack

- **PHP:** 8.x
- **Framework:** Laravel 12
- **API Style:** REST
- **Database:** MySQL  
- **Testing Database:** SQLite (in-memory)
- **Testing:** PHPUnit (Feature + Unit tests)
- **Authentication:** Not yet implemented (planned: Laravel Sanctum)

---

## Architectural Goals

This project is built with the following goals in mind:

- Explicit separation of concerns
- Business logic outside controllers
- High testability
- The code starts simple and grows in complexity only when there is a real need

---

## Current Structure

### Controllers
Located in `app/Http/Controllers`

Controllers are intentionally **thin**:
- Request validation is handled by Form Requests
- Business logic is delegated to Actions
- Controllers only coordinate input/output

---

### Actions
Located in `app/Actions`

Actions encapsulate **single use cases**, for example:
- Creating a task
- Updating task status

They:
- Accept DTOs
- Contain no HTTP-specific logic
- Are easy to unit test

---

### DTOs (Data Transfer Objects)
Located in `app/Actions/Tasks/DTO`

DTOs are used to:
- Explicitly define input data
- Avoid passing raw arrays between layers
- Make method contracts clear

---

### Repository Layer
Located in `app/Repositories`

- `TaskRepositoryInterface` defines the contract
- `DatabaseTaskRepository` is the current implementation
- Bound via a Service Provider

This allows:
- Swapping persistence layers
- Testing Actions without a database
- Following the Dependency Inversion Principle

---

### Models
Located in `app/Models`

Models are kept **lean** and primarily represent persistence.
Business rules live in Actions and domain logic, not in controllers.

---

### Testing Strategy

- **Feature tests** for API endpoints
- **Unit tests** for Actions using mocked repositories
- SQLite in-memory database for fast, isolated automated tests
- Model factories for generating test data
- Database seeders for local development and testing

---

## Implemented Features

- Create task endpoint
- Update task endpoint
- Delete task endpoint
- Task listing with pagination
- Request validation via Form Requests
- Task creation via Action + DTO
- Repository abstraction
- Unit test for Action (no database)
- Feature tests for API endpoints

---

## TODO / Planned Improvements

- Authentication and authorization (Laravel Sanctum)
- User registration and login
- Token-based API access
- Task ownership and access control
- Policies for task actions
- Task completion / status transitions
- OpenAPI / Swagger documentation
- Additional unit tests for edge cases

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

### Running Tests

The test suite uses an in-memory SQLite database for fast and isolated execution.

Run all tests with:

```bash
php artisan test

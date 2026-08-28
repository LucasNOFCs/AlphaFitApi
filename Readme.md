# AlphaFit API

RESTful API for gym management, developed with Laravel.

AlphaFit API is a backend project focused on managing gym members, plans and payments, with authentication, authorization and email verification.

## Features

- User authentication with Laravel Sanctum
- User profile management
- Role-Based Access Control (RBAC)
- Roles and permissions
- Email verification
- Gym plan management
- Member management
- Plan assignment to members
- Payment management
- Monthly payment uniqueness per member
- Authorization through Laravel Policies
- Request validation
- RESTful API architecture

## Tech Stack

- PHP
- Laravel
- Laravel Sanctum
- MySQL
- REST API
- Git
- GitHub

## Architecture

The API follows Laravel's application architecture, separating responsibilities between:

- Controllers
- Form Requests
- Models
- Policies
- API Resources
- Middleware
- Services

Authentication and authorization are handled through Laravel Sanctum, middleware and Policies.

## Authentication

The API uses Laravel Sanctum for token-based authentication.

Authenticated users can:

- Log in
- Access their own profile
- Log out
- Revoke authentication tokens

Email verification is also implemented for users who require a verified account.

## Authorization

AlphaFit API implements Role-Based Access Control (RBAC).

Available roles include:

- User
- Assistant
- Admin

Permissions are enforced through middleware and Laravel Policies where appropriate.

## Main Resources

### Plans

Plans represent the available gym membership plans.

Supported operations:

- Create plan
- List plans
- View plan
- Update plan
- Delete plan

### Members

Members represent users registered as gym members.

Supported operations:

- Create member
- List members
- View member
- Update member
- Delete member
- Assign a plan to a member

### Payments

Payments are associated with members and their billing period.

The API enforces a business rule that prevents more than one payment from being registered for the same member within the same payment month.

## API Endpoints

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/login` | Authenticate user |
| GET | `/api/me` | Get authenticated user |
| POST | `/api/logout` | Revoke authentication token |

### Plans

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/plans` | List plans |
| POST | `/api/plans` | Create plan |
| GET | `/api/plans/{id}` | Get plan |
| PUT | `/api/plans/{id}` | Update plan |
| DELETE | `/api/plans/{id}` | Delete plan |

### Members

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/members` | List members |
| POST | `/api/members` | Create member |
| GET | `/api/members/{id}` | Get member |
| PUT | `/api/members/{id}` | Update member |
| DELETE | `/api/members/{id}` | Delete member |

### Payments

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/payments` | List payments |
| POST | `/api/payments` | Create payment |
| GET | `/api/payments/{id}` | Get payment |
| PUT | `/api/payments/{id}` | Update payment |
| DELETE | `/api/payments/{id}` | Delete payment |

> Endpoint availability and authorization depend on the authenticated user's role and permissions.

## Installation

Clone the repository:

    git clone <repository-url>
    cd AlphaFitApi

Install dependencies:

    composer install

Create the environment file:

    cp .env.example .env

Generate the application key:

    php artisan key:generate

Configure the database in `.env`.

Run the migrations:

    php artisan migrate

Start the development server:

    php artisan serve

The API will be available at:

    http://127.0.0.1:8000

## Environment

Configure the required environment variables in `.env`.

Never commit `.env`, credentials, API keys, tokens or other secrets to the repository.

## Testing

Run the test suite with:

    php artisan test

## Security

Security is considered part of the application's development process.

The project includes:

- Token-based authentication
- Role-Based Access Control
- Resource-level authorization
- Request validation
- Laravel Policies
- Database constraints

For information about reporting security vulnerabilities, see `SECURITY.md`.

## Development Workflow

Development follows a branch-based workflow.

    main
     |
     +-- feature/*
     +-- fix/*
     +-- refactor/*
     +-- hotfix/*
            |
            v
        Pull Request
            |
            v
          Review
            |
            v
          Merge
            |
            v
           main

Each feature, fix or relevant change is developed in its own branch and submitted through a Pull Request before being merged into `main`.

## Project Status

AlphaFit API is a completed backend study project focused on consolidating Laravel, REST API and backend development practices.

The project was developed from scratch as a practical environment for studying and applying:

- Laravel
- RESTful API development
- Authentication
- Authorization
- RBAC
- Database design
- Business rules
- Security practices
- Git and GitHub workflows

## License

This project is licensed under the MIT License.

See the `LICENSE` file for more information.

## Author

**Lucas Nobre**

Backend Developer

- PHP
- Laravel
- REST APIs
- MySQL
- Software Development
- Information Security

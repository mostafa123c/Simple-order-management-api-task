# Laravel Order API Task

A simple RESTful API for managing orders built with Laravel.

## Features

-   **Order Processing**: Create, list and update orders with product details and status tracking
-   **Order Statistics**: Get insights into order data including total revenue and status breakdowns
-   **Input Validation**: Comprehensive validation for all API requests
-   **Status Filtering**: Filter orders by their status (pending/shipped)

## API Endpoints

| Method | Endpoint            | Description                                     |
| ------ | ------------------- | ----------------------------------------------- |
| POST   | `/api/orders`       | Create a new order                              |
| GET    | `/api/orders`       | List all orders (with optional status filter)   |
| PUT    | `/api/orders/{id}`  | Update an order's status                        |
| GET    | `/api/orders/stats` | Get order statistics (revenue, count by status) |

## Tech Stack

-   **Framework**: Laravel 12.x
-   **Database**: MySQL
-   **PHP Version**: 8.2+

## Getting Started

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   MySQL

### Installation

1. Clone the repository

    ```bash
    git clone https://github.com/mostafa123c/Simple-order-management-api-task.git
    cd Simple-order-management-api-task
    ```

2. Install dependencies

    ```bash
    composer install
    ```

3. Set up environment variables

    ```bash
    cp .env.example .env
    # Edit the .env file with your database credentials
    ```

4. Generate application key

    ```bash
    php artisan key:generate
    ```

5. Run migrations and seed the database

    ```bash
    php artisan migrate --seed
    ```

6. Start the development server
    ```bash
    php artisan serve
    ```

The API will be available at `http://localhost:8000/api/`

## Using the API

### Create an Order

```bash
curl -X POST http://localhost:8000/api/orders \
  -H "Content-Type: application/json" \
  -d '{"customer_id":1,"product_name":"Smartphone","quantity":1,"price":799.99}'
```

### List Orders

```bash
# All orders
curl http://localhost:8000/api/orders

# Only shipped orders
curl http://localhost:8000/api/orders?status=shipped
```

### Update Order Status

```bash
curl -X PUT http://localhost:8000/api/orders/1 \
  -H "Content-Type: application/json" \
  -d '{"status":"shipped"}'
```

### Get Order Statistics

```bash
curl http://localhost:8000/api/orders/stats
```

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── OrderController.php
├── Models/
│   ├── Customer.php
│   └── Order.php
└── ...
```

## Scaling Roadmap

Future enhancements planned for this API include:

-   Customer management API endpoints
-   Authentication with Laravel Sanctum
-   Expanded product catalog with categories
-   Order items and relationships to products
-   Payment processing integration
-   Advanced filtering and sorting options
-   API versioning
-   Comprehensive test coverage
-   Performance optimizations with caching
-   Containerization with Docker

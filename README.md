# Car Dealer Management System

This project implements comprehensive logic for managing a car dealership. It provides a robust backend system using Laravel that handles various operations such as creating, updating, listing, and deleting car records. The system includes detailed validation, standardized API responses, and integration with Laravel's Resource classes for data serialization.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)

## Features

- **Car Management**: Create, update, view, and delete car records with comprehensive validation and error handling.
- **Standardized API Responses**: Consistent and structured JSON responses across all endpoints.
- **Automated Testing**: PHPUnit tests for ensuring the reliability and correctness of the application's functionality.
- **RESTful API**: Clean and well-structured API endpoints following RESTful principles.
- **Data Serialization**: Use of Laravel's Resource classes to transform and format data efficiently.
- **Error Handling**: Detailed validation and error handling to provide clear feedback for API consumers.
- **Authentication with Sanctum**: Secure API authentication using Laravel Sanctum for controlled access to system operations.

## Installation

To get started with the project, follow these steps:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/josemagno/cardealer.git
    cd cardealer
    ```

2. **Install dependencies**:

    ```bash
    composer install
    ```

3. **Set up environment variables**:

    Copy the `.env.example` file to `.env` and configure your environment variables, including your database connection details.

    ```bash
    cp .env.example .env
    ```

4. **Generate application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run migrations**:

    ```bash
    php artisan migrate
    ```

## Usage

To start the development server, run:

```bash
php artisan serve

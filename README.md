# BookVerse - Library Management System

## Project Overview
BookVerse is a comprehensive Library Management System designed to facilitate the borrowing and management of books. It features a modern, responsive user interface, role-based access control (Admin/User), and a seamless borrowing process.

## Features
- **User Authentication**: Secure login and registration with email and Google OAuth.
- **Role Management**: Admin and User roles with separate dashboards.
- **Book Management (CRUD)**: Admins can Create, Read, Update, and Delete books and categories.
- **Book Browsing**: Users can browse books, view details, and search dynamically (AJAX).
- **Borrowing System**: Users can request to borrow books; Admins manage requests (Approve/Reject/Return).
- **Wishlist**: Users can add books to their wishlist.
- **Reviews**: Users can rate and review books.
- **API Support**: JSON API available for accessing book data.
- **Responsive Design**: Built with Bootstrap 5 for mobile and desktop compatibility.

## Setup Instructions

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Installation
1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd bookverse
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   Copy the example environment file and configure your database settings.
   ```bash
   cp .env.example .env
   ```
   Update `.env` with your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

6. **Build Frontend Assets:**
   ```bash
   npm run build
   ```

7. **Serve the Application:**
   ```bash
   php artisan serve
   ```
   Access the app at `http://localhost:8000`.

## API Usage
The application exposes the following API endpoints:

- **GET /api/books**: List all books (includes category and reviews).
- **GET /api/books/{id}**: Get details of a specific book.

## Usage Guide
- **Home**: Landing page with featured books.
- **Login/Register**: Access your account or create a new one.
- **Dashboard**:
    - **User**: View borrow history, wishlist, and profile settings.
    - **Admin**: Manage books, categories, users, and borrowing requests.
- **Search**: Use the search bar in the header to find books instantly.

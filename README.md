# Api Book_Category

## revreiw

This project is a web application built using the Laravel framework, allowing users to perform CRUD operations on books. Users can create, read, update, and delete book entries, specifying the category to which each book belongs.

## Features

-   Create a new book and assign it to a specific category.
-   View a list of all books and their details.
-   Update book information, including the category.
-   Delete books from the system.
-   CRUD Category
-   Show Books Assigned to category

## Requirments

-   PHP Version 8.3 or earlier
-   Laravel Version 11 or earlier
-   composer
-   XAMPP: Local development environment (or a similar solution)

## API Endpoint

### Authentication

    - POST /api/register : Register with name , email and password
    - POST /api/login: Log in with email and password
    - POST /api/logout: Log out the current user
    - GET /api/me: display info currently user

### CRUD Book

    - POST /api/Book : Create Book
    - GET /api/Book : show all Book
    - GET /api/Book/{book_id} : show Book by ID
    - PUT /api/Book/{book_ID} : update Book by ID
    - DELETE /api/Role/{book_ID} : delete Book by ID

## CRUD Categories

    - POST /api/Categories : Create Category by admin
    - GET /api/Categories : show all Categories by admin
    - GET /api/Categories/{role_id} : show Category by ID
    - PUT /api/Categories/{Category_id} : update Category by ID
    - DELETE /api/Categories/{Category_ID} : delete Category by ID
    - GET /api/categories/{categoryId}/books : Get books assigned to category

## Postman Collection:

You can access the Postman collection for this project by following this [link](https://documenter.getpostman.com/view/37833857/2sAXqy2eV1). The collection includes all the necessary API requests for testing the application.

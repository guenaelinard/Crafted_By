# Crafted_By

## Client's Needs:

The client wants the design of an e-commerce site that showcases their artisanal products with the following objectives:

1. Creation of an aesthetic site highlighting artisanal products.
   Facilitation of navigation between different product categories such as jewelry, art, decoration, etc.

2. Integration of advanced search features allowing search by material, artist or style.

3. Implementation of an intuitive shopping cart with product customization options (e.g., choice of color, size).

4. Ensure a smooth and aesthetic user experience with an artistic layout.

5. Implementation of a user management system for customer accounts including necessary delivery information.

6. Creation of a dedicated space for artists/artisans to present their profiles and creations.
   Each product will be accompanied by a story or anecdote about the craftsmanship behind its creation.

7. Implementation of dedicated pages for artisans including information about the artisan, their story, their way of making objects, their specialties, their approximate location, etc.
   *Possibility to add custom artisanal products on request.*

8. Integration of social media sharing tools to promote creations.
   Artists and artisans will have the opportunity to manage their own accounts and update their creations.
   Use of several visual themes for a different layout, which the artist or artisan can choose to highlight their products.

# Remarks

### Prerequisites to respect:

- Limit the use of carousels
- Favor a simple, clean design, adapted to the web
- Avoid JavaScript / CSS animations
- Adapt texts to the web
- Avoid redirects

### UML elaborated for the project:

![UML_CraftedBy.png](resources\images\UML_CraftedBy.png)

## Installation

Follow these steps to set up the project on your local machine:

### Prerequisites

Ensure you have the following installed on your local system:

- PHP 7.4 or higher
- Composer
- Node.js and npm
- MySQL

### Step 1: Clone the repository

First, clone the repository to your local machine. You can do this by running the following command in your terminal:

```bash
git clone https://github.com/<your-github-username>/crafted_by.git
### Step 2: Install PHP dependencies

Navigate to the project directory and install the PHP dependencies using Composer:
```bash
cd crafted_by
composer install
```

### Step 3: Configure environment variables

Copy the example environment file to create your own:

```bash
cp .env .env
```
Then, open the .env file and update the database connection details as necessary.

### Step 4: Generate application key

Generate a new application key:

```bash
php artisan key:generate
```

### Step 5: Run database migrations

Run the database migrations:

```bash
php artisan migrate
```

### Step 6: Start the application

Finally, start the application:

```bash
php artisan serve
```
You should now be able to access the application at http://localhost:8000.

# Postman Collection

<a href="https://documenter.getpostman.com/view/31362035/2sA3BhdZnX">Click Here</a>

<h1 align="center" id="title">User Management System API</h1>

<p id="description">The user management system API provide CRUD services to the User model</p>

<h2>🛠️ Installation Steps:</h2>

<p>1. Install the dependencies</p>

```
composer install
```

<p>2. Create your .env file</p>

```
cp .env.example .env
```

<p>3. Generate App Key</p>

```
php artisan key:generate
```

<p>4. Add your DB credentials</p>

```
DB_CONNECTION=(mysql or pgsql or oracle)
DB_HOST=(DB Host)
DB_PORT=(DB Port)
DB_DATABASE=yourDB
DB_USERNAME=yourUsername
DB_PASSWORD=yourPassword
```

<p>5. Run the migrations</p>

```
php artisan migrate
```

<p>6. Create Passport Client</p>

```
php artisan passport:install
```

<p>7. Run the seeders</p>

```
php artisan db:seed
```

<h2> Start the server </h2>

```
php artisan serve
```

<h2> Run tests </h2>

```
php artisan test
```

<h2> go to the "/docs/api" route to see the API documentation </h2>
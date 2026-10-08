# Razon POS Account Management

This CodeIgniter 4 project manages customer and staff user accounts. TFA4 adds session-based authentication to the customer and user CRUD features from TFA3.

## TFA4 features

- Login using a username and hashed password
- Password verification with `password_verify()`
- Session data for the authenticated user
- Authentication Filter protecting all customer and user management routes
- Logout that destroys the session
- Password creation and optional password changes for user accounts
- Existing customer CRUD, user CRUD, validation, and avatar uploads

## Local setup

1. Create a MySQL database named `pos_db`.
2. For a fresh database, import `pos_db.sql`.
3. If upgrading the existing TFA3 database, import `tfa4_update.sql` once instead.
4. Configure the database connection and `app.baseURL` in `.env`.
5. Run `php spark serve` from the project directory.
6. Open `http://localhost:8080`.

## Sample login

All five users included in `pos_db.sql` use the following temporary password:

- Username: `juan`, `maria`, `jose`, `ana`, or `carlo`
- Password: `password`

Change a user's password from the Edit User page after logging in.

## InfinityFree update

1. Back up the hosted files and database.
2. Import `tfa4_update.sql` into the existing hosted database once.
3. Upload the updated `app` and `public/assets` files.
4. Keep the hosted `.env` database credentials and hosted base URL.
5. Confirm that logged-out access to `/customers` or `/users` redirects to `/login`.

Do not commit real hosting passwords or database passwords to GitHub.

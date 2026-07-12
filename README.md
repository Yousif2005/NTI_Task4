# MyShop - E-commerce Website (PHP + Sessions + Validation)

A simple 3-page e-commerce website built with PHP, Bootstrap 4, and PHP Sessions,
including full server-side form validation.

## Pages

1. **index.php** — Home page
   - Navbar (Home / All Products / Account links, site name/logo on the left)
   - Header section with a background image and "Welcome to our store" text

2. **products.php** — All Products page
   - Associative array `$products` holding 6 products (name => [price, img, desc])
   - `foreach` loop that displays each product inside a Bootstrap card

3. **account.php** — Account page (two states, based on PHP session)
   - **Not logged in:** shows a login form (email, password). On submit, the data
     is validated. If there are errors, a message is shown next to the relevant
     field. If valid, the data is stored in `$_SESSION` and the user is
     redirected to `products.php`.
   - **Logged in:** shows a "complete your profile" form (username, password,
     email, phone number, Facebook/Twitter/Instagram URLs). Every field is
     validated individually. If valid, the data is stored in `$_SESSION` and
     the user is redirected to `index.php`.

4. **logout.php** — destroys the session (`session_destroy()`) and redirects
   back to the home page. A "Logout" link appears in the navbar on every page
   once the user is logged in.

## Folder structure

```
ecommerce_project/
├── index.php
├── products.php
├── account.php
├── logout.php
├── includes/
│   └── navbar.php        (shared navbar, included on every page)
├── css/
│   └── style.css
└── images/
    ├── header-bg.jpg      (home page header background)
    └── product1.png ... product6.png
```

## How to run it

You need PHP installed (PHP 7.4+ or PHP 8.x).

1. Open a terminal inside the `ecommerce_project` folder.
2. Start PHP's built-in server:
   ```
   php -S localhost:8000
   ```
3. Open your browser at: `http://localhost:8000/index.php`

Alternatively, copy the whole `ecommerce_project` folder into your
XAMPP/WAMP/MAMP `htdocs` (or `www`) directory and browse to
`http://localhost/ecommerce_project/index.php`.

> Note: The pages load Bootstrap 4 and jQuery from public CDNs, so an internet
> connection is needed for the styling/JS to appear. You can download Bootstrap
> locally and update the `<link>`/`<script>` tags in each page if you need it
> to work fully offline.

## Notes on validation

- **Email:** required + valid email format (`filter_var(..., FILTER_VALIDATE_EMAIL)`)
- **Password:** required + minimum 6 characters
- **Username:** required, 3-20 characters, letters/numbers/underscore only
- **Phone number:** required, must match an Egyptian mobile format (e.g. `01012345678`)
- **Facebook / Twitter / Instagram URLs:** required, must be a valid URL and
  contain the matching domain (facebook.com / twitter.com or x.com / instagram.com)

All error messages are displayed right under the relevant input field, and any
previously entered (non-password) values are kept in the form after a failed
submission so the user doesn't have to retype everything.

## Replacing the images

The `images/` folder currently contains simple generated placeholder graphics
so the project runs out of the box. Feel free to replace `header-bg.jpg` and
`product1.png` … `product6.png` with your own images — just keep the same
file names, or update the paths inside `products.php` / `css/style.css`
accordingly.

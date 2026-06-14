# Segment 29: Root Configuration & Core Entry Points

## Purpose
This segment covers the primary entry points and configuration foundation of the Moodle application. It is responsible for initial user routing, securing the document root, establishing database connections, defining global settings (`$CFG`), and declaring the system version for upgrade checks.

## Architecture & Main Components

*   **`config-dist.php`**: The template configuration file. It must be copied to `config.php` and edited with site-specific details (database credentials, `$CFG->wwwroot`, `$CFG->dataroot`). It establishes the foundational global `$CFG` object.
*   **`index.php` (Root)**: A security mechanism. If accessed directly (outside the proper web root routing), it throws an exception to prevent accidental exposure of the root directory contents.
*   **`public/config.php`**: The actual configuration loader for requests entering via the web root. It checks for the existence of the global `config.php` (one level up). If missing, it directs the user to `install.php`. Otherwise, it includes it to bootstrap the environment.
*   **`public/index.php`**: The main Moodle frontpage script. It acts as a lightweight router for the site root, managing tasks such as:
    *   Checking if a major upgrade is required.
    *   Evaluating homepage preferences (e.g., redirecting logged-in users to their Dashboard/My courses if configured).
    *   Rendering the site home (frontpage) using the `core_renderer` if no redirection occurs.
*   **`public/editmode.php`**: A utility endpoint to quickly toggle the user's editing mode on or off, subsequently redirecting them back to their previous page.
*   **`public/help.php`**: A script that retrieves and renders help tooltips/strings, often called via AJAX or displayed in popups. It sets `NO_MOODLE_COOKIES` to minimize session overhead.
*   **`public/version.php`**: Defines core version constants (e.g., `$version`, `$release`, `$branch`). These are essential during the bootstrap sequence and upgrade routines to determine if the database schema or cached data is stale.

## Interaction Flow
When a user visits the root of a Moodle site, the web server typically serves `public/index.php`. This file immediately requires `public/config.php`, which in turn locates and includes the global `config.php`. Once the database and `$CFG` are established, `public/index.php` evaluates user session state and site settings to decide whether to render the frontpage or redirect the user to their personalized dashboard. Constants from `public/version.php` are implicitly utilized during these early bootstrapping phases to ensure system integrity before rendering any content.

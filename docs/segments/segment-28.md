# Segment 28: Localization & Error Handling

## Overview
This segment covers two critical subsystems in Moodle: Localization (managing language strings and translations) and Error Handling (displaying HTTP errors and handling early bootstrap failures).

These systems are located in:
- `public/lang/`: The root directory for language packs and string definitions.
- `public/error/`: The directory containing generic error page handlers.

## Architecture and Main Components

### 1. Localization (`public/lang/`)
Moodle uses a robust string management system for localization, allowing the interface to be translated into many different languages.

*   **Language Packs:** Languages are distributed as packs, typically placed in directories named with their ISO code (e.g., `en` for English). The English pack (`public/lang/en/`) serves as the default and fallback language.
*   **String Definitions (`.php` files):** Each language pack contains numerous PHP files. These files do not contain active logic or classes. Instead, they define associative arrays of strings (usually assigning values to the `$string` variable). Each file generally corresponds to a specific component, plugin, or core subsystem (e.g., `moodle.php` for core strings, `error.php` for error messages, `course.php` for course-related strings).
*   **Usage:** Throughout the Moodle codebase, developers use functions like `get_string('stringidentifier', 'component')` to fetch the localized version of a string. The localization system looks up the string in the currently active language pack, falling back to the default English pack if a translation is missing.
*   **Language Pack Management:** As noted in `public/lang/README.txt`, administrators can install new language packs via the Moodle GUI, which downloads and places them in the `dataroot` directory, or they can be manually placed in the `public/lang/` directory.

### 2. Error Handling (`public/error/`)
The error handling directory provides fail-safes and specific handlers for errors that occur outside the normal flow of the application or very early in the request lifecycle.

*   **`index.php` (404 Error Handler):**
    This script acts as the global 404 (Not Found) error handler. It is intended to be configured at the webserver level (e.g., using `ErrorDocument 404 /error/index.php` in Apache). When a user requests a non-existent file or route, the webserver passes the request to this script, which then bootstraps enough of Moodle to render a friendly, localized 404 page using the active site theme.
*   **`plainpage.php` (Generic Early Bootstrap Page):**
    This file provides a highly resilient, generic HTML template. It is used to display critical system errors or messages (such as database connection failures or maintenance mode notices) that occur very early in the Moodle bootstrap process, *before* the full rendering engine or theming system can be initialized.
    *   **Design Constraints:** To guarantee it can be displayed under adverse conditions, this file must not rely on dynamically generated Moodle resources (like PHP-generated theme CSS). All styles and essential elements are typically inlined directly within the file to ensure independence from the rest of the system's state.

## Interaction
The error handling scripts often rely on the localization system. For example, when `index.php` processes a 404 error, it uses Moodle's core string functions to fetch localized error messages (defined in files like `public/lang/en/error.php`) to present to the user. Similarly, while `plainpage.php` is minimalist, the content injected into it (like "Database connection failed") is often localized using the string definitions found in the `public/lang/` directory.

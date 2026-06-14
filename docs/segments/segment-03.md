# Segment 3: User Management & Authentication

## Purpose
This segment covers the core functionality related to Moodle's user management, authentication systems, and the login flow. It outlines how user records are managed, how users authenticate against various identity providers, and how user identity data, including passwords and profile pictures, is handled.

## Scope Paths
- `public/user/`: Core user management functions and interfaces.
- `public/auth/`: Authentication plugins and base authentication classes.
- `public/login/`: The main entry points and workflows for user login, signup, password resets, and sessions.
- `public/userpix/`: The subsystem for rendering and managing user profile pictures.

## Architecture & Main Components

### 1. User Management (`public/user/`)
The user module defines the primary abstraction over user records in Moodle.

* **Core Functions (`lib.php`)**: Acts as the external API for creating, updating, deleting, and fetching user data. This file centralizes operations to ensure consistency across the application when dealing with user entities.
* **Participant Listing (`index.php`)**: Provides the interface for viewing users in a given context (usually a course). It handles pagination, filtering (by role, group, enrolment status), and enforcement of viewing capabilities.

### 2. Login Flow (`public/login/`)
The login directory handles the entry pathways into the system and identity verification processes.

* **Login Entry (`index.php`)**: The main login page script. It initiates the session, checks for maintenance or upgrade modes, manages redirect URLs after successful authentication, and delegates the actual credential validation to the configured active authentication plugins.
* **Utilities (`lib.php`)**: Contains functions critical to authentication lifecycle events outside of a standard login. This includes processing "forgot password" requests, generating secure reset tokens, validating these tokens, and sending appropriate notification emails to users.

### 3. Authentication Subsystem (`public/auth/`)
Moodle supports a flexible, plugin-based authentication architecture.

* **Authentication Plugins**: Stored as subdirectories within `public/auth/`, each plugin provides a mechanism for verifying a user's identity against a specific backend or protocol. Common examples include:
    * `manual`: The default standard username/password authentication against the local Moodle database.
    * `ldap`: Integrates with Active Directory or standard LDAP directories.
    * `oauth2`: Modern authentication via OIDC/OAuth 2.0 providers (e.g., Google, Microsoft).
    * `lti`: Allows Moodle to act as a tool consumer or provider within an LTI framework.
    * `shibboleth`: SAML-based federated identity integration.
* **Testing and Configuration**: Files like `test_settings.php` allow administrators to dry-run configuration parameters for complex plugins like LDAP before enabling them globally.

### 4. User Profile Pictures (`public/userpix/`)
A small but important subsystem that handles the rendering of user avatars.

* **Overview (`index.php`)**: A simple utility script that queries the database for all active users who have uploaded a custom profile picture and displays them in a gallery format.

## Component Interaction

1. **Authentication Request**: A user visits `public/login/index.php` and submits their credentials.
2. **Plugin Delegation**: The login script queries the active plugins in `public/auth/` in a predefined sequence until one successfully authenticates the credentials.
3. **User Record Verification**: Once authenticated, the plugin interfaces with the core API in `public/user/lib.php` to fetch the corresponding local user record. If the user does not exist locally (and auto-creation is enabled for the plugin), a new record is provisioned.
4. **Session Establishment**: A secure session is created, and the user is redirected to their intended destination within Moodle.
5. **Account Recovery**: If a user forgets their password, they interact with the scripts in `public/login/` (aided by `login/lib.php`), which handles the secure token generation and email dispatch, completely bypassing the standard `auth/` plugin flow until they attempt to log in again with their new password.
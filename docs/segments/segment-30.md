# Segment 30: Development Workflows & Tooling

## Purpose
This segment covers the development workflows, dependency management, task automation, and continuous integration configuration of the Moodle repository. The goal is to provide insight into how Moodle builds, tests, and manages its complex front-end and back-end dependencies.

## Architecture & Components

Moodle uses a mix of traditional and modern tooling to handle its sprawling architecture, integrating tools native to both PHP and JavaScript ecosystems.

### 1. Build Processes and Task Automation
* **NPM (`package.json`)**: Serves as the backbone for managing Node.js dependencies, executing pre-/post-install scripts (e.g., `update-packages.mjs`), and mapping scripts for testing (Jest).
* **Grunt (`Gruntfile.js`)**: Moodle relies heavily on Grunt as its primary task runner for processing frontend assets. It orchestrates a variety of tasks like transcompiling JavaScript (AMD, ES Modules, React via `.grunt/tasks/`), processing CSS/SCSS (Boost/Classic themes), linting code (`eslint`, `stylelint`, `gherkinlint`), and watching for changes (`grunt watch`).

### 2. Dependency Management
* **Composer (`composer.json`)**: Manages the PHP backend dependencies. It defines strict requirements (e.g., PHP >= 8.3), autoloading rules (`psr-0`, `psr-4`), and integrations with core libraries like Guzzle, Monolog, and AWS SDK.
* **Custom Third-Party Package Scripts (`scripts/`)**: Includes bespoke `.mjs` scripts (orchestrated by `scripts/update-packages.mjs`) used to fetch and update embedded third-party libraries (such as `@moodlehq/design-system` and `react`). This enables Moodle to strictly vendor external front-end resources into the source tree (`lib/bundles/`).

### 3. CI/CD Workflows (`.github/workflows/`)
GitHub Actions provide robust testing across multiple operating systems, PHP versions, and database permutations.
* **`push.yml`**: The core workflow that runs on branch pushes. It ensures Grunt tasks build without uncommitted artifacts, runs `npm test` (Jest), and executes PHPUnit across various OS, PHP version, and Database (PostgreSQL, MySQLi) matrices.
* **`composed.yml`**: Specializes in testing a "Composed" dockerized environment matrix.
* **`windows.yml`**: Targets specifically Windows runner edge cases using PowerShell setup logic for PostgreSQL/MySQL and `nssm` for services.
* **`web-installer-test.yml`**: Validates Moodle's UI-based web installer process.

### 4. Testing Environments
* **PHPUnit (`phpunit.xml.dist`)**: The extensive configuration file orchestrating Moodle's PHP unit testing suite. It partitions tests into dozens of specific testsuites covering everything from core DDL/DML, plugins, backups, to specific sub-systems (`core_user`, `core_course`). It also hooks into Moodle's custom `core\tests\phpunit\moodle_extension` bootstrap.
* **Jest (`.jest/`)**: For modern frontend testing (especially React components). The `globalSetup.ts` handles mocking AMD modules and localization strings to allow decoupled, isolated unit testing of UI logic.

## Interaction Summary
The typical workflow for a Moodle developer involves running `npm install` and `composer install` to hydrate environments. Moodle's `scripts/update-packages.mjs` triggers post-install to vendor specific UI bundles. While developing, `grunt watch` actively handles JS transcompilation and SCSS building. Pushing code directly activates the `.github/` workflows which strictly enforce both Jest (frontend) and PHPUnit (backend) constraints.

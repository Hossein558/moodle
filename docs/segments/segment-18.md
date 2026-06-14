# Segment 18: Backup, Restore & Data Formats

## Purpose
This segment covers the mechanisms for course backup and restore, data format exports, and portfolio exporting within Moodle. It provides robust tools for site administrators and educators to protect course data, export records (e.g., in CSV or Excel), and enable students to export their work to external portfolios.

## Architecture & Main Components

### 1. Backup and Restore (`public/backup/`)
The backup system handles archiving course structures, user data, activities, and settings.
- **Controllers:** `backup_controller` and `restore_controller` orchestrate the backup and restore processes. They manage execution plans, prechecks, temporary tables, and user interfaces.
- **Tasks and Steps:** The Moodle 2 backup format divides the process into a series of tasks (e.g., course task, activity task) and steps that execute database queries, file inclusions, and XML generation or parsing.
- **Converters:** Support for migrating/converting older backup formats to the current standard.

### 2. Data Formats (`public/dataformat/`)
Provides standard interfaces for exporting tabular data from Moodle plugins (like reports or gradebooks) to different file formats.
- **Formats:** Supports formats such as CSV, Excel, HTML, JSON, ODS, and PDF.
- **Writers:** Each format provides a `writer` class. Many of these (like CSV, Excel, ODS) extend a base class (`core\dataformat\spout_base`) to stream standard outputs using underlying libraries, while others (like JSON, PDF, HTML) extend `core\dataformat\base` to output native formats directly or via wrapping Moodle libraries.

### 3. Portfolios (`public/portfolio/`)
Allows users (especially students) to push/export their content (e.g., forum posts, assignments) from Moodle to external portfolio systems.
- **Plugins:** Includes specific integrations such as Google Docs (a push-based plugin connecting to Google Drive via the native Google client) and a basic Download plugin.
- Core classes and interfaces (`portfolio_plugin_pull_base`, `portfolio_plugin_push_base`) to handle file packaging, metadata formatting, and pushing data to external APIs.

## Interactions
- **Backup & Portfolios:** When exporting data, these systems frequently interact with Moodle's central File API and repository functions to package and transfer files.
- **Dataformats & Other Plugins:** Any Moodle report or table generator can use the dataformat plugins to present a consistent "Download as..." option to the end user.

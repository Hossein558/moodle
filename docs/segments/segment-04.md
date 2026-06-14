# Segment 4: Enrollment & Privacy

## Purpose
This document provides an overview of the Enrollment, Privacy, and Local plugins systems in Moodle, covering the directories `public/enrol/`, `public/privacy/`, and `public/local/`. This segment is fundamental to how users gain access to courses, how their data is managed in compliance with privacy regulations like GDPR, and how local site-specific customisations are integrated.

## Main Components and Architecture

### 1. Enrollment Plugins (`public/enrol/`)
The `enrol` directory contains Moodle's enrollment plugins. These plugins determine how users are enrolled into courses.

*   **Architecture:** All enrollment modules extend a base class `enrol_plugin` (defined in `lib/enrollib.php`). The `course_enrolment_manager` (in `public/enrol/locallib.php`) provides a targeted interface for managing enrollments tied to a specific course.
*   **Key Plugins:** The directory includes numerous standard plugins:
    *   `manual`: Manual enrollments managed by teachers or administrators.
    *   `self`: Self-enrollment by users, often with an enrollment key.
    *   `cohort`: Enrollment based on site-wide user cohorts.
    *   `guest`: Guest access with potentially limited permissions.
    *   `lti`, `paypal`, `ldap`, `meta`: Integrations for external systems and payment gateways.
*   **Interaction:** The core system calls upon the active enrollment plugins to authenticate a user's right to access a course. External services (via `externallib.php`) can also interact with course participations and enrollments.

### 2. Privacy API and GDPR Framework (`public/privacy/`)
The `privacy` directory holds the core Privacy API, which was introduced to ensure compliance with the General Data Protection Regulation (GDPR) and similar privacy laws globally.

*   **Architecture:** The subsystem operates on a provider/consumer model. Components (plugins, core subsystems) implement specific interfaces (e.g., `local\metadata\provider`, `local\request\core_user_data_provider`) to declare what personal data they store and to provide mechanisms to export or delete it.
*   **Core Manager:** The `core_privacy\manager` class (`public/privacy/classes/manager.php`) is the central unit of work. It acts as a facade, communicating with and collating privacy data from all relevant components.
*   **Key Processes:**
    *   **Data Export:** Allows users to download all their personal data stored within Moodle. The manager queries all components for data belonging to a specific user and packages it.
    *   **Data Erasure:** Handles requests to delete a user's personal data. The manager signals components to anonymize or delete the relevant records.

### 3. Local Plugins (`public/local/`)
The `local` directory is a designated space for site-specific customisations and plugins that do not fit into other standard Moodle plugin types (like blocks, modules, or themes).

*   **Mechanism:** Local plugins behave similarly to other plugins, requiring a `version.php`, but are generally used for extending core functionality, adding new admin settings, defining custom capabilities (`access.php`), or handling custom events (`events.php`) without modifying core Moodle code.
*   **Usage:** It provides a clean, upgrade-safe way to implement custom business logic, scripts, or hooks that are unique to a specific Moodle installation. The `readme.txt` details how they can extend navigation, handle database changes (`db/install.xml`), and provide web services.

## Summary of Interaction
The **Enrollment** system dictates user access and course participation. When a user interacts with a course, various modules store their data. The **Privacy** subsystem provides the necessary hooks and the central manager to aggregate, export, or erase this data across the Enrollment system and all other Moodle components, ensuring regulatory compliance. The **Local** directory provides a standardized, separate space to inject custom logic that might touch upon enrollment, privacy, or any other area, without corrupting the core architecture.

# Segment 24: Calendar, Events & Blogs

## Purpose
This segment covers the internal and core functionality for Moodle's calendar system, events representation, internal blogs, and the customized user dashboard (often referred to as "My Moodle"). It also encapsulates the student notes system, providing users with personalized space and timeline functionalities.

## Architecture & Main Components

The segment spans four primary directories within the `public/` directory:

1. **`public/calendar/` (Calendar & Events)**
   - **Purpose:** Manages the display and underlying logic of Moodle calendars (site, course, group, and user-level events).
   - **Key Components:**
     - `calendar_event` (`lib.php`): Represents and manages individual events (insert, update, delete).
     - `calendar_information` (`lib.php`): Structures information about dates, courses, and view modes for displaying calendar views.
     - Event export and import functionalities (iCalendar / `.ics` integration).
     - Event type system allowing custom activities or components to hook into calendar occurrences.

2. **`public/blog/` (Blogs)**
   - **Purpose:** Provides a lightweight native blogging tool inside Moodle. Users can maintain personal blogs, or post entries relevant to specific courses and modules.
   - **Key Components:**
     - Capabilities checks and options mappings (`lib.php`): Handles permissions for viewing and creating entries contextually.
     - External blog sync (`blog_external`): Allows Moodle to synchronize entries from RSS feeds natively.
     - Tagging Integration: Integrates firmly with Moodle’s global tagging subsystem for sorting and classifying posts.

3. **`public/my/` (User Dashboard / My Moodle)**
   - **Purpose:** Renders the customized dashboard for a user, containing courses, timelines, and block configurations tailored to the user.
   - **Key Components:**
     - Page Management (`lib.php`): Tools to fetch, copy, or reset customized user pages (`my_pages` database representation).
     - `my_syspage_block_manager`: Subclasses standard block management to ensure blocks on default dashboard pages correctly evaluate their contexts while viewed by users.

4. **`public/notes/` (Student Notes)**
   - **Purpose:** Enables teachers and administrators to attach notes to users contextually (site, course, or personal draft notes).
   - **Key Components:**
     - Note Data Handlers (`lib.php`): `note_save`, `note_delete`, `note_load` functions interact with the standard `post` table (with `module` set to `notes`).
     - State representation: Constants and logic for filtering and mapping the visibility of notes.

## How They Interact
- **Calendar & My Moodle:** The timeline and upcoming events blocks displayed on the `my/` dashboard heavily consume `calendar_get_events()` from the calendar API.
- **Blogs, Notes, & Database Structure:** Interestingly, both the native internal blog entries and the notes system reuse Moodle's generic `post` database table (historically designed for multiple post types). They differentiate their records using the `module` field (e.g., `module = 'blog_external'`, `module = 'notes'`).
- **Context Awareness:** All four subsystems are deeply context-aware. They consistently use `$CFG`, user capabilities, and Moodle's `\context_course` or `\context_user` context classes to restrict viewing and interactions based on role assignments and course enrollments.
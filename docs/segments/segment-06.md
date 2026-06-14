# Segment 6: Activity Modules – Core Assignments & Forums

This document provides an overview of the core assignments (`mod_assign`) and forums (`mod_forum`) activity modules in Moodle. It covers their purpose, architecture, main components, and how they interact with other Moodle subsystems.

## 1. Assignment Module (`mod_assign`)

The Assignment module allows teachers to collect work from students, review it, and provide grades and feedback.

### 1.1 Purpose
The purpose of the Assignment module is to provide a comprehensive framework for submitting and grading tasks. It supports various submission types (e.g., file uploads, online text) and feedback mechanisms (e.g., feedback files, online text feedback, grading worksheets). It also features advanced grading options, such as rubrics and marking guides, and supports group submissions and blind marking.

### 1.2 Architecture
The Assignment module is structured around the `assign` class located in `mod/assign/locallib.php`, which acts as the main controller. It utilizes a plugin-based architecture for both submissions and feedback, allowing the core functionality to be easily extended without modifying the core code.

### 1.3 Main Components
* **Core Controller (`mod/assign/locallib.php`):** The `assign` class orchestrates the overall flow, managing instances, submissions, grading, and interactions with plugins.
* **Submission Plugins (`mod/assign/submission/`):** These plugins define how students can submit their work. Standard plugins include:
    * `file`: Allows students to upload files.
    * `onlinetext`: Allows students to type text directly into a text editor.
    * `comments`: Allows students to add comments to their submission.
* **Feedback Plugins (`mod/assign/feedback/`):** These plugins define how teachers can provide feedback. Standard plugins include:
    * `comments`: Allows teachers to provide text feedback.
    * `file`: Allows teachers to upload feedback files.
    * `offline`: Provides a grading worksheet for offline grading.
    * `editpdf`: Enables annotating student PDF submissions directly in the browser.
* **Grading Interfaces:** The module provides different views for grading, including a summary view, a detailed grading table, and a specialized interface for the `editpdf` plugin.
* **Library (`mod/assign/lib.php`):** Contains the standard Moodle API functions that the core system calls (e.g., `assign_add_instance`, `assign_update_instance`, `assign_delete_instance`, `assign_supports`).

### 1.4 Interactions
* **Gradebook (`mod/grade/`):** The assignment module pushes grades to the Moodle gradebook via the `assign_grade_item_update` and `assign_update_grades` functions.
* **File API (`lib/filelib.php`):** Extensively used by both submission and feedback plugins to store and retrieve files. The `assign_get_file_info` function in `lib.php` integrates with the file browser.
* **Calendar (`calendar/`):** Assignments create events in the calendar for due dates and cutoff dates.
* **Completion (`completion/`):** Assignments integrate with the course completion tracking system.

## 2. Forum Module (`mod_forum`)

The Forum module allows students and teachers to exchange ideas by posting comments as part of a thread.

### 2.1 Purpose
The Forum module facilitates asynchronous discussion. It supports different types of forums (e.g., standard forum, single simple discussion, Q&A forum, each person posts one discussion) and various subscription modes. It includes features for tracking read/unread posts, pinning discussions, and grading/rating user participation.

### 2.2 Architecture
The Forum module is primarily procedural, centered around functions defined in `mod/forum/lib.php`. However, newer parts of the module, especially rendering and grading, have been refactored into classes within `mod/forum/classes/`. It is deeply integrated with the Moodle event system and message system.

### 2.3 Main Components
* **Core Library (`mod/forum/lib.php`):** Contains the core logic for managing forums, discussions, and posts. Key functions include `forum_add_instance`, `forum_add_discussion`, `forum_add_new_post`, and `forum_user_can_post`.
* **Rendering (`mod/forum/classes/output/`):** Modern classes (e.g., `forum_post`, `forum_actionbar`) implement the `renderable` and `templatable` interfaces, separating presentation from logic.
* **Grading/Rating:** The forum supports rating posts, which can be aggregated to form a grade. The `forum_gradeitem` class in `mod/forum/classes/grades/` handles the interaction with the gradebook.
* **Tracking Subsystem:** A complex set of functions (e.g., `forum_tp_mark_posts_read`, `forum_tp_get_course_unread_posts`) manages the state of which posts a user has read.
* **Subscriptions:** Functions manage whether users receive notifications for new posts (e.g., `forum_post_subscription`, `forum_get_user_digest_options`).

### 2.4 Interactions
* **Messaging (`message/`):** Forums use the messaging system to send notifications (emails/digests) to subscribed users when new posts are made.
* **Gradebook (`mod/grade/`):** Ratings given to forum posts are sent to the gradebook via functions like `forum_grade_item_update`.
* **File API (`lib/filelib.php`):** Used for handling attachments to forum posts.
* **Search (`search/`):** Forums are indexed by the global search engine, allowing users to find specific posts or discussions.
* **Groups (`group/`):** Forums heavily utilize group modes (separate/visible groups) to restrict who can see and participate in discussions.
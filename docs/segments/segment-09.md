# Segment 9: Collaborative Activity Modules

## Overview
This segment covers the core collaborative activity modules in Moodle: Workshop, Wiki, Glossary, and Database. These modules allow students to engage in peer assessment, collaborative document creation, shared terminology management, and structured data collection.

## Modules

### 1. Workshop (`public/mod/workshop/`)
The Workshop module is a peer assessment activity with a complex workflow. It allows students to submit work, receive allocations for peer review, evaluate peers' submissions based on defined grading strategies, and finally receive grades for both their submission and their assessment skills.

**Key Components:**
*   **Phases:** The workshop transitions through various phases (Setup, Submission, Assessment, Grading evaluation, Closed) managed by the teacher.
*   **Grading Strategies:** Evaluates submissions using different criteria (Accumulative, Comments, Errors, Rubric).
*   **Allocations:** Mechanisms for distributing submissions to peers for review (Manual, Random, Scheduled).
*   **Evaluators:** Determines the final grades based on the aggregated peer assessments.

### 2. Wiki (`public/mod/wiki/`)
The Wiki module enables students to collaboratively author web pages. It supports different wiki formats and keeps a full history of edits, allowing users to compare versions and revert changes if necessary.

**Key Components:**
*   **Subwikis:** Depending on the wiki settings (individual or collaborative), subwikis are instantiated to manage the pages.
*   **Pages and History:** Each page tracks its content, formatting, and the complete history of edits (versions).
*   **Parsers/Formats:** Supports multiple markup languages like Creole, NWiki, and HTML, parsed into a unified format for display.

### 3. Glossary (`public/mod/glossary/`)
The Glossary module allows participants to create and maintain a list of definitions, like a dictionary. Entries can be searched, browsed, and automatically linked across the Moodle course.

**Key Components:**
*   **Entries:** The core data containing the concept and its definition, potentially with aliases.
*   **Categories:** For organizing entries.
*   **Formats:** Different display formats for the glossary (e.g., dictionary style, encyclopedia, continuous).
*   **Auto-linking:** The ability to automatically highlight and link glossary concepts when they appear in other course texts.

### 4. Database (`public/mod/data/`)
The Database module allows the teacher and/or students to build, display, and search a bank of record entries about any conceivable topic. The format and structure of these entries can be almost unlimited, including images, files, URLs, numbers, and text.

**Key Components:**
*   **Fields:** Defines the structure of the database (e.g., text, picture, file, date).
*   **Presets:** Allows saving and sharing database structures (fields and templates).
*   **Templates:** Controls the layout and presentation of the entries (List template, Single template, Add template, etc.).
*   **Records/Entries:** The actual data instances submitted by users conforming to the defined fields.

## Architecture and Interaction
These modules are standard Moodle activity plugins (`mod_` plugin type). They integrate deeply with Moodle's core APIs:
*   **Course and Module APIs:** Hooking into Moodle's course structure, backup/restore, and grading APIs.
*   **Form API (`moodleform`):** Extensive use of Moodle's form library for configuration, submission, and assessment interfaces.
*   **Database API:** Managing their respective schemas for storing module instances, submissions, and related metadata.
*   **Event API:** Triggering and listening to Moodle events (e.g., submission created, page viewed).
*   **File API:** Handling attachments in wiki pages, glossary entries, database records, and workshop submissions.

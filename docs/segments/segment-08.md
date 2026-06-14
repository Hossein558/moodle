# Segment 8: Multimedia & Interactive Content (H5P & SCORM)

This segment covers the multimedia and interactive learning modules within the Moodle LMS. These modules provide instructors with tools to build interactive, media-rich courses and seamlessly integrate widely adopted e-learning standards.

## Scope
* `public/h5p/`
* `public/mod/h5pactivity/`
* `public/mod/lesson/`
* `public/mod/scorm/`

## Architecture & Components

### SCORM (`public/mod/scorm/`)
SCORM (Sharable Content Object Reference Model) is a set of technical standards for e-learning software products. This module allows Moodle to upload, interpret, and play SCORM packages.
* **`lib.php`**: Core library for the SCORM module, providing functions for CRUD operations.
* **`locallib.php`**: Contains specific logic for parsing the XML manifest, rendering the structure, and manipulating SCO (Sharable Content Object) properties.
* **`player.php`**: The entry point for rendering the SCORM layout and player. It embeds the content and provides navigation hooks.
* **`datamodel.php` & `aicc.php`**: These files act as communication endpoints. `datamodel.php` handles AJAX interactions to save progress based on the SCORM data model (e.g., CMI objectives, score, location). `aicc.php` handles similar endpoints for older AICC HACP packages.
* **`module.js` & `request.js`**: JavaScript files for client-side API implementations and navigation tree management.

### Lesson (`public/mod/lesson/`)
The Lesson module provides a flexible mechanism to deliver content and questions sequentially or through branching paths based on student choices.
* **`lib.php`**: Contains the standard module APIs (add, update, delete, events).
* **`locallib.php`**: Contains the core logic of a lesson, including flow control, rendering pages (content vs. question pages), evaluating student answers, and determining branching paths.
* **`view.php`**: Displays the active lesson page to the user and manages page progression.
* **`continue.php`**: Handles the submission of user responses and computes the target "next page" logic.

### H5P Core (`public/h5p/`)
This directory contains the core Moodle subsystem wrapper around the third-party H5P libraries. H5P allows the creation, sharing, and reuse of interactive HTML5 content.
* **`lib.php`**: Core callbacks and handlers for H5P packages, such as routing file requests and managing the autoloader.
* **`embed.php`**: The page that safely embeds an H5P content instance using an iFrame.
* **`ajax.php`**: Processes interactions from the H5P player/editor, like saving content states and fetching libraries.

### H5P Activity (`public/mod/h5pactivity/`)
While `public/h5p/` provides the underlying system wrapper, `public/mod/h5pactivity/` is the standard Moodle Activity module used in a course.
* **`lib.php`**: Manages the instances of the H5P activity, integrating with Moodle’s course system, completion tracking, and grading framework.
* **`view.php`**: The main interface when a user clicks the activity. It retrieves display configurations and invokes the core H5P player.

## Interaction Flow
1. **Creation:** Instructors upload standard ZIP files (SCORM/H5P) or build pages natively (Lesson) using standard forms (`mod_form.php`).
2. **Delivery:** Modules employ specialized players (`embed.php` for H5P, `player.php` for SCORM, `view.php` for Lesson) which parse the underlying structure and present it interactively.
3. **Tracking & State:** As users interact, client-side scripts send requests to server endpoints (e.g., `datamodel.php` or `ajax.php`) to persist grades, attempt progress, and interactive state.

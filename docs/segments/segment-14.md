# Segment 14: System Libraries – Front-end & UI Tools

This document provides details on the front-end libraries and UI tools used in Moodle, specifically within the paths `public/lib/yuilib/`, `public/lib/editor/`, `public/lib/jquery/`, and `public/lib/amd/`.

## Purpose
The purpose of this segment is to document the integration of key front-end technologies that power the user interface and interactions within Moodle. These include legacy systems maintained for backward compatibility (YUI), fundamental DOM manipulation libraries (jQuery), text editing capabilities (TinyMCE, Textarea), and the modern modular JavaScript architecture (AMD via RequireJS).

## Architecture & Main Components

### 1. YUI Library (`public/lib/yuilib/`)
YUI (Yahoo! User Interface Library) is a legacy JavaScript library that was formerly the primary front-end framework in Moodle. While Moodle has been migrating towards more modern frameworks (like AMD modules and native JS/jQuery), YUI is still present for backwards compatibility and older components.

- **Versions Included:**
  - **YUI 2 (2.9.0):** Maintained in `public/lib/yuilib/2in3/` to support legacy code.
  - **YUI 3 (3.18.1):** The more recent version used in Moodle before the shift to AMD. It is contained within `public/lib/yuilib/3.18.1/`.
  - **YUI 3 Gallery:** Specific modules from the YUI 3 Gallery (e.g., `gallery-sm-treeview`) are included in `public/lib/yuilib/gallery/`.
- **Integration Notes:**
  - The integration does not include test coverage files.
  - Rollup files (like `yui-moodlesimple.js`) are utilized to improve performance.

### 2. Text Editors (`public/lib/editor/`)
Moodle supports a flexible, pluggable text editor architecture allowing different editors to be used contextually.

- **TinyMCE (`public/lib/editor/tiny/`):**
  - Moodle uses a custom build of TinyMCE, maintaining a clone of the official repository for repeatable builds and security patching.
  - This is currently the standard and recommended editor in modern Moodle versions. It supports a rich set of plugins, custom language string integrations, and is highly customizable. The integration layer (`public/lib/editor/tiny/classes/editor.php`) handles dynamic configuration loading and integration with Moodle's file picker and format handling.
- **Textarea (`public/lib/editor/textarea/`):**
  - A fallback "failsafe" text editor that uses a standard HTML `<textarea>`. It handles raw text or HTML without visual formatting capabilities. Implemented via the `textarea_texteditor` class.

### 3. jQuery Integrations (`public/lib/jquery/`)
jQuery is integrated to facilitate DOM manipulation, event handling, and Ajax requests across the platform.

- **Core Library:**
  - Contains compressed and uncompressed versions of jQuery (e.g., `jquery-3.7.1.js`).
- **jQuery UI (`public/lib/jquery/ui-*/`):**
  - Provides a set of user interface interactions, effects, widgets, and themes built on top of jQuery.
  - Moodle includes specific jQuery UI themes (like `smoothness`).
- **Integration & Usage Guidelines:**
  - The loading of jQuery and its plugins is managed by a centralized configuration file (`public/lib/jquery/plugins.php`). This ensures that plugins are aliases properly for the RequireJS loader and prevents conflicts.
  - Moodle relies heavily on modern vanilla JavaScript when possible, so older jQuery conventions (like `jQuery.trim()`) are discouraged in new Moodle code in favor of native implementations (`String.prototype.trim()`).

### 4. AMD / RequireJS (`public/lib/amd/`)
Moodle's modern JavaScript architecture is based on Asynchronous Module Definition (AMD), managed via RequireJS. This allows for modular, scalable, and manageable JavaScript development.

- **Structure:**
  - **`public/lib/amd/src/`:** Contains the unminified source code for all the core Moodle JavaScript modules (e.g., `ajax.js`, `modal.js`, `notification.js`, `templates.js`).
  - **`public/lib/amd/build/`:** Contains the minified `.min.js` files and sourcemaps generated during the build process (e.g., via Grunt). These are the files actually served to the browser.
- **Key Features:**
  - Modules are loaded asynchronously, improving page load times.
  - Includes important utilities such as:
    - `ajax`: Handling requests to Moodle's web services.
    - `templates`: Rendering Mustache templates (`mustache.js` is included here as a core AMD module).
    - `str`: Managing language strings fetched from the server.
    - `notification` & `modal`: Managing UI alerts and dialogue boxes.
    - `dragdrop`, `scroll_manager`: Reusable UI interaction handlers.

## Interaction Summary
The AMD architecture (`public/lib/amd/`) serves as the foundational layer for modern Moodle JavaScript development, gradually replacing direct interactions with YUI and raw jQuery. New UI components are built as AMD modules. Text editors (`public/lib/editor/`) integrate via PHP configurations but heavily rely on this JavaScript architecture (either native JS or AMD modules) for frontend rendering and interactions. jQuery (`public/lib/jquery/`) is available as an AMD module for DOM operations where vanilla JavaScript is insufficient or too verbose. YUI (`public/lib/yuilib/`) is maintained independently for legacy subsystems that have not yet been modernized to the AMD standard.

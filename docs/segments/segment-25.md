# Segment 25: Content Bank & Filtering

## Purpose
This segment covers two distinct but important Moodle subsystems:
1. **Content Bank (`public/contentbank/`)**: The Content Bank is a repository area introduced to manage, store, and edit third-party content types, most notably H5P. It provides an architecture for uploading, editing, and tracking usage of rich interactive content files.
2. **Text Filtering (`public/filter/`)**: The Filtering subsystem evaluates strings and text throughout Moodle prior to output, applying specific transformations such as auto-linking glossary terms, rendering mathematical formulas (e.g., MathJax, Algebra), embedding multimedia plugins, or processing multilingual strings.

## Architecture & Main Components

### Content Bank (`public/contentbank/`)

The Content Bank system relies on a plugin architecture (the `contenttype` plugin type) and a core management layer that orchestrates them.

- **`core_contentbank\contentbank` (`public/contentbank/classes/contentbank.php`)**:
  This is the main entry point and manager class. It retrieves enabled content types using `core\plugininfo`, searches for existing content within a given context, and handles creating new content files.

- **`core_contentbank\contenttype` (`public/contentbank/classes/contenttype.php`)**:
  An abstract base class that all specific content type plugins (e.g. `contenttype_h5p`) must extend. It dictates common capabilities such as uploading, downloading, moving, or deleting content, and defines plugin-specific implementation hooks (`is_upload_allowed`, `is_manage_allowed`).

- **`core_contentbank\content` (`public/contentbank/classes/content.php`)**:
  This represents an individual piece of content within the bank. It abstracts the database layer operations and the file storage layer, tracking metadata like visibility, time created, user, and context, while also retrieving the physical file using the Moodle File API (`stored_file`).

- **`core_contentbank\helper` (`public/contentbank/classes/helper.php`)**:
  A utility class that helps set up the Moodle page structure, layout, and breadcrumb navigation contextually (e.g. at the system, course category, or course level).

### Filtering System (`public/filter/`)

The Filtering subsystem evaluates pieces of text using an ordered chain of active filters configured per context.

- **`core_filters\filter_manager` (`public/filter/classes/filter_manager.php`)**:
  The orchestrator singleton that applies text filters. It loads the active filters for the given context, instantiates them into an array of objects, and executes their filter stages sequentially via `apply_filter_chain()`.

- **`core_filters\text_filter` (`public/filter/classes/text_filter.php`)**:
  The abstract base class for a specific filter. A filter plugin must extend this class and override the `filter()` method or specific stage methods (e.g. `filter_stage_pre_format`, `filter_stage_post_clean`) to manipulate strings at different phases of the text formatting pipeline.

- **`core_filters\filter_object` (`public/filter/classes/filter_object.php`)**:
  A standard object structure to define regular expressions and replacement rules. Complex filters often use these objects to perform large scale regex substitutions via `filter_phrases()`.

## Interactions

**Content Bank Flow:**
When a user uploads a new interactive file (e.g. an `.h5p` file), the `contentbank` manager queries the available `contenttype` plugins to see which one supports the file extension. The corresponding plugin's `upload_content()` method is invoked to store the file and create a new `content` record in the database.

**Filter Execution Flow:**
When text is passed through core functions like `format_text()` or `format_string()`, the `filter_manager` singleton is invoked. It checks the active filters for the text's context, creates the `text_filter` chain, and passes the text through each filter. Some filters will hook into early stages (`pre_format`) while others wait until HTML is finalized (`post_clean`).

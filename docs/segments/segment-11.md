# Segment 11: Blocks & Themes

## Overview
This segment covers the UI side of the Moodle application, specifically documenting how blocks (side-panel widgets) function and explaining the theming engine, which includes the Boost and Classic themes. These components work together to dictate the overall layout, style, and modular widget placement across the application.

## 1. Blocks (`public/blocks/`)

### Purpose
Blocks are modular user interface widgets that are typically placed in designated regions on the page (such as `side-pre` or `side-post`). They provide supplementary functionality alongside the main content of the page, such as navigation, recent activity, calendars, and more.

### Architecture
*   **`block_base` (in `public/blocks/moodleblock.class.php`)**: This is the abstract parent class for all block plugins. It provides the standard lifecycle, structure, and essential methods that block plugins must implement or inherit from.
    *   **Properties**: Contains state for the block's title, content type (text or list), the specific page and context it is instantiated on, and instance configurations.
    *   **Methods**: Includes `get_content()` which must be implemented by derived classes to populate the actual widget contents. Other methods handle block display, HTML attributes, and capabilities checks.
*   **`block_list`**: A specialized sub-class extending `block_base` for displaying blocks with lists of items (icons/text labels) rather than generic text.
*   **Directory Structure**: The `public/blocks/` directory contains numerous specific block implementations (e.g., `calendar_month/`, `navigation/`, `recent_activity/`), each extending the base block classes to provide distinct UI widgets.

## 2. Themes (`public/theme/`)

### Purpose
The theming engine controls the visual presentation, page layouts, and CSS/JS integrations of the application. It dictates the overall look and feel, as well as where blocks can be positioned on the screen.

### Architecture
Themes are configured via a `config.php` file, which defines the theme name, parents, stylesheets, and most importantly, the page **layouts**.

#### Boost Theme (`public/theme/boost/`)
*   **Role**: The modern core theme for Moodle, built on top of the Bootstrap framework.
*   **`config.php`**: Defines layouts mapped to specific files (like `drawers.php`, `login.php`, `columns1.php`). For layouts that support blocks, it specifies the regions available (e.g., `'regions' => array('side-pre')`). Boost heavily relies on a single side drawer or panel (`side-pre`) for block placement.
*   **Key Features**: It acts as the parent theme for many others, providing core SCSS generation (`theme_boost_get_main_scss_content()`), font-awesome icon integrations, and settings for activity headers.

#### Classic Theme (`public/theme/classic/`)
*   **Role**: A child theme of Boost, designed to provide a more traditional, legacy Moodle look and feel.
*   **`config.php`**: Inherits from `boost` but overrides layout files (mapping mostly to `columns.php`). Crucially, it re-introduces the multi-column layout paradigm by defining both `'side-pre'` and `'side-post'` regions for blocks in standard and course layouts.
*   **Key Features**: Provides alternative SCSS callbacks (`theme_classic_get_main_scss_content()`) and disables certain modern editing switches to retain the classic interaction model.

## Interaction Summary
Themes and Blocks are fundamentally tied together through **Regions**.
1.  **Themes define the canvas**: The active theme's `config.php` specifies the layouts for different page types (course, admin, dashboard) and declares which block regions (`side-pre`, `side-post`) exist on those layouts.
2.  **Blocks populate the canvas**: Individual block instances are assigned to these specific regions by the end-user or site administrator. The `block_base` class manages the rendering of the block's content, which the theme then wraps in the appropriate HTML/CSS layout structure defined by the theme's templates.
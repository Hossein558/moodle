# Segment 26: Tags, RSS & Favorites

This document summarizes the core components and architecture of the global tagging system, RSS feed generation, and the favorites (starring) subsystems in Moodle.

## 1. Tags (`public/tag/`)
**Purpose:** Provides a global system for applying metadata labels (tags) to various entities (courses, blog posts, users, etc.) throughout the Moodle platform.
**Architecture & Main Components:**
*   **Collections (`core_tag_collection`):** Tags are organized into collections (e.g., "Default collection"). Collections allow for separating tags used in different contexts.
*   **Areas (`core_tag_area`):** Define which components (e.g., `core_course`) and item types (e.g., `course`) can be tagged, and to which tag collection they belong.
*   **Tag (`core_tag_tag`):** Represents an individual tag instance. It contains utility methods for tagging items, removing tags, and searching for tags.
*   **Output/Rendering:** Includes various classes for generating tag clouds (`tagcloud`), tag feeds (`tagfeed`), and lists (`taglist`).

## 2. RSS (`public/rss/`)
**Purpose:** Handles the generation and serving of RSS feeds for different components like forums, glossaries, or blogs.
**Architecture & Main Components:**
*   **Entry Point (`file.php`):** Acts as the primary router for RSS requests. It securely authenticates requests via URL tokens (avoiding cookie-based sessions for feeds), determines the requested component, and invokes the component-specific RSS generation logic.
*   **Renderer (`core_rss_renderer`):** Responsible for outputting UI elements related to RSS, such as the RSS feed link icons.
*   **Integration:** Components providing feeds must implement specific callback functions (e.g., `plugin_rss_get_feed`) to check permissions and generate the cached XML feed.

## 3. Favorites (`public/favourites/`)
**Purpose:** Provides a generic, centralized API for users to "star" or "favorite" items across Moodle (e.g., starring a course or a conversation).
**Architecture & Main Components:**
*   **Entity (`favourite`):** Represents a single favorite record, linking a specific user to a specific item within a context.
*   **Services (`user_favourite_service`, `component_favourite_service`):** Expose the business logic for adding, removing, and finding favorites. The user service is scoped to a specific user context, while the component service provides broader operations.
*   **Service Factory (`service_factory`):** A locator/factory class providing clean access to the service objects.
*   **Repository (`favourite_repository`):** Handles the actual database persistence (CRUD operations) for favorite entities.

## Interaction
These subsystems act as horizontal features that can be attached to almost any other component in Moodle. For example, the `core_course` component might interact with `public/tag/` to allow users to tag courses, and with `public/favourites/` to let users star their preferred courses. The `mod_forum` component interacts heavily with `public/rss/` to distribute forum posts as RSS feeds.

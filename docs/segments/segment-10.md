# Segment 10: External Resources & LTI Integrations

## Purpose
This segment covers external tool integrations via the LTI (Learning Tools Interoperability) standard, real-time web conferencing through BigBlueButton, and standard internal static content modules that provide resources to users, including the Resource, URL, Page, and Label modules. These modules facilitate presenting static information or integrating completely separate web-based interactive services within the LMS seamlessly.

## Architecture & Components
The functionality of this segment is split across six primary modules within the `public/mod/` directory:

### 1. `mod_lti` (LTI Integrations)
- **Path:** `public/mod/lti/`
- **Description:** Implements the LTI Consumer capabilities for the platform, allowing integration with external LTI-compliant tools. It manages the launch sequences, tool configuration, signature generation (OAuth), grade passback, and content-item messaging.
- **Key Files:**
  - `locallib.php`: Contains core logic for tool registration, launch data construction, and tool type management.
  - `OAuth.php`: Implements OAuth 1.0/1.0a signatures utilized by LTI to secure request launches and API communications.
  - `servicelib.php`: Handles standard LTI services such as grade read/write operations and XML response parsing.

### 2. `mod_bigbluebuttonbn` (BigBlueButton)
- **Path:** `public/mod/bigbluebuttonbn/`
- **Description:** An activity module that integrates BigBlueButton, an open-source web conferencing system, into the LMS. It supports creating meeting rooms, recording playback, event calendaring, and managing active sessions.
- **Key Files:**
  - `lib.php`: Exposes Moodle core integration hooks (e.g., adding/updating/deleting instances, supporting features like completion).
  - Interfaces heavily with BigBlueButton APIs to retrieve joining URLs and manage recordings.

### 3. `mod_resource` (Resource Module)
- **Path:** `public/mod/resource/`
- **Description:** A simple module for serving individual files (e.g., PDFs, Word documents) to students. It integrates heavily with the platform's File API to serve files either as direct downloads or embedded in the interface.
- **Key Components:**
  - Standard activity lifecycle implementations (`lib.php` and `locallib.php`).
  - Handling of Drag-and-Drop file uploads directly onto the course page.

### 4. `mod_url` (URL Module)
- **Path:** `public/mod/url/`
- **Description:** Allows teachers to provide a web link as a course resource. Supports parsing and displaying the link with varying parameters, such as embedding the remote page in an iframe, or popping it up in a new window.

### 5. `mod_page` (Page Module)
- **Path:** `public/mod/page/`
- **Description:** Enables teachers to create web pages directly within the platform using a rich-text editor (WYSIWYG). It acts as a lightweight CMS tool for serving textual and multimedia content.
- **Interaction:** Hooks into the editor library and file repository to manage embedded images or media inside the page text.

### 6. `mod_label` (Label Module)
- **Path:** `public/mod/label/`
- **Description:** A spacer/content module that displays text, multimedia, or layout elements directly on the course page without requiring the student to click a link to view it. It is primarily used for course organization and aesthetics.

## Component Interactions
- **Course Integration:** All modules implement standard Moodle APIs (`*_add_instance`, `*_update_instance`, `*_delete_instance`, `*_supports`) in their respective `lib.php` files to ensure they can be added to courses, backed up, restored, and have completion tracked.
- **Event Logging:** Each module has dedicated event classes (`classes/event/*`) to log user interactions, such as viewing a resource or launching an LTI tool.
- **File Handling:** The Resource, Page, and Label modules heavily rely on the `pluginfile` hook in `lib.php` to securely serve files stored in the centralized file system to users who have appropriate access permissions.
- **External Communication:** `mod_lti` and `mod_bigbluebuttonbn` differentiate themselves from the others by functioning as consumers to remote services. They construct HTTP requests (often cryptographically signed) and parse XML/JSON responses to synchronize state (like grades or recordings) between the external server and the LMS.

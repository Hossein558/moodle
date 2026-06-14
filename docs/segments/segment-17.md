# Segment 17: File System, Repositories & Media

## Purpose

This segment covers Moodle's File API, media players, file serving scripts, and external file repositories. This encompasses the storage, retrieval, playback, and external fetching of digital assets across the platform.

## Architecture

Moodle has a mature and robust file storage architecture known as the File API. Instead of storing files using standard physical directory structures, it utilizes a content-addressable storage mechanism:

1. **File Storage System:**
   - Physical files are stored in the Moodle data directory (`$CFG->dataroot/filedir/`) using SHA-1 hashes of their content.
   - Database tables (e.g., `mdl_files`) maintain the metadata (filename, file area, context ID, user, mimetype, etc.).
   - This prevents duplication and makes moving data between contexts quick and efficient.
2. **Repositories (`public/repository/`):**
   - Provide a consistent UI/API for fetching files from various locations.
   - Allow students and educators to fetch files via the File Picker.
   - Integrate with multiple external services: Google Drive, Dropbox, Nextcloud, S3, Flickr, Equella, and YouTube, alongside internal sources like "Recent Files" and "Server Files" (filesystem).
   - Repositories can link to external files (references) or copy them internally depending on plugin support and configuration.
3. **Media (`public/media/`):**
   - Media classes are responsible for embedding video and audio content.
   - It provides abstract base classes (`core_media_player`, `core_media_manager`) to manage native and external media players (e.g., VideoJS).
4. **File Serving Scripts:**
   - Instead of linking directly to physical files, Moodle serves files via PHP scripts which handle security, context, and permissions checks.
   - `public/pluginfile.php`: The primary script for serving internal files. It routes requests to the appropriate plugin's file callback.
   - `public/draftfile.php`: Serves temporary/draft files while a user is authoring content.
   - `public/file.php`: A legacy script for serving files in older courses (`course->legacyfiles`).

## Main Components

- **`core_files` namespace & `archive_writer` (`public/files/`):** Abstractions for handling files and archiving them (e.g., generating zip downloads).
- **`repository` base class (`public/repository/lib.php`):** The abstract class that all repository plugins must extend. It defines the contract for browsing, searching, and fetching files.
- **`repository_type` (`public/repository/lib.php`):** Manages repository plugin configuration at the global level.
- **`core_media_manager` (`public/media/classes/manager.php`):** Resolves URLs to media files and returns HTML to embed them.
- **`core_media_player` (`public/media/classes/player.php`):** Base class for media players that know how to render a specific mimetype.
- **`pluginfile.php`:** The gateway for almost all file access.

## Interactions

When a user uploads a file, it is placed in a draft area. At this stage, it is served via `draftfile.php`. When the user saves their form, the file is moved from the draft area to the target file area (using the File API).

When a user views content containing an embedded image or file link, the URL usually points to `pluginfile.php`. This script identifies the context, component, and file area, checks if the user has permission to view it (by calling a callback in the component), and then streams the file from the underlying SHA-1 hashed storage via the File API.

If the file is external (e.g., selected from a Google Drive repository as an alias/reference), the repository plugin may be invoked to fetch the latest version or an authentication token, or `pluginfile.php` might redirect the user to the external source or stream it offline depending on the repository's configuration.

For media links, text filters or UI components pass URLs to `core_media_manager`, which iterates through registered media players (derived from `core_media_player`) to find one capable of handling the media format, returning the appropriate HTML embed code.

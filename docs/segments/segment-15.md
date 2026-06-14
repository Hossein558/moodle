# Segment 15: System Libraries – Document Generation & Utilities

## Purpose
This segment covers external system libraries utilized by Moodle for dynamic document generation, file parsing, and legacy database interactions. The scope includes generating PDF documents, creating and parsing Excel/CSV files, sanitizing HTML input, and utilizing older database abstractions. Since these are primarily third-party libraries, Moodle interacts with them through dedicated wrapper classes (like `lib/pdflib.php`, `lib/excellib.class.php`) that exist outside these directories. The documentation inside the libraries focuses exclusively on Moodle-specific modifications and extensions.

## Architecture & Main Components

### TCPDF (`public/lib/tcpdf/`)
- **Purpose**: Generates dynamic PDF documents (e.g., user reports, certificates).
- **Integration**: Moodle uses an external wrapper class (`pdf` in `lib/pdflib.php`) to instantiate and configure TCPDF safely, preventing direct exposure to underlying API changes. This segment holds the unmodified third-party TCPDF library, including fonts, and barcode generators.

### PhpSpreadsheet (`public/lib/phpspreadsheet/`)
- **Purpose**: Modern library used for both reading and writing spreadsheets (Excel, CSV, ODS).
- **Integration**: Replaces older libraries like Excel5/OLE. It handles complex formulas, styling, and data formats.
- **Moodle Modifications**: Moodle applies a specific hack to `PhpSpreadsheet\Shared\File::sysGetTempDir()` to ensure that the library utilizes Moodle's `make_temp_directory` function. This confines temporary file generation to Moodle’s `dataroot` structure.

### HTMLPurifier (`public/lib/htmlpurifier/`)
- **Purpose**: Cleans and sanitizes user-input HTML to prevent XSS (Cross-Site Scripting) attacks, ensuring safe rendering on the front-end.
- **Integration**: Embedded heavily in Moodle’s text filtering and text editor processing chains.
- **Moodle Modifications**: Includes `locallib.php`, which defines custom URI schemes (`rtsp`, `rtmp`, `irc`, `mms`, `gopher`, `teamspeak`) specifically tailored for validating content across Moodle instances.

### ADOdb (`public/lib/adodb/`)
- **Purpose**: A legacy database abstraction library.
- **Integration**: Historically, ADOdb was the core database layer for Moodle. It is now mostly deprecated for core functions but is retained primarily because it is still required by legacy database enrollment (`enrol_database`) and authentication plugins.

### OpenSpout (`public/lib/openspout/`)
- **Purpose**: A fast, lightweight library used for reading and writing spreadsheet files (CSV, XLSX, ODS) in a scalable way.
- **Integration**: Provides an alternative to PhpSpreadsheet for tasks requiring highly efficient memory usage, especially when handling very large exports (e.g., massive log exports or large cohorts) where a stream-based approach is optimal.

## Component Interaction
These libraries typically do not interact with one another. Instead, they provide isolated utility services hooked into Moodle's core logic:
- **File APIs and Exports**: Moodle’s Dataformat subsystem (`public/dataformat/`) relies on PhpSpreadsheet and OpenSpout to handle user data export requests securely.
- **Content Security**: HTMLPurifier is invoked systematically via Moodle's text cleaning functions (e.g., `clean_text()`) before storing or outputting HTML content.
- **Reporting**: Core reporting plugins feed structured data to TCPDF or OpenSpout, allowing users to download localized, formatted reports.
# Documentation Prompts for Developers

Use the following 30 prompts to assign each of the 30 developers their respective documentation tasks. Each prompt is designed to clearly define their scope and instruct them not to interfere with other segments.

---

### Developer 1: Core Administration & Installation
**Prompt:**
> "Hello! You have been assigned **Segment 1: Core Administration & Installation**. Your specific scope is limited to the `public/admin/`, `public/install/`, and `public/install.php` directories/files. Your task is to document the core administration dashboard, settings interfaces, and the Moodle installation process (including environment checks and database initialization). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 2: Course Management & Cohorts
**Prompt:**
> "Hello! You have been assigned **Segment 2: Course Management & Cohorts**. Your specific scope is limited to the `public/course/`, `public/customfield/`, `public/cohort/`, and `public/group/` directories. Your task is to document how courses are created, configured, and managed. Detail the implementations for cohorts, groups, and custom course fields. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 3: User Management & Authentication
**Prompt:**
> "Hello! You have been assigned **Segment 3: User Management & Authentication**. Your specific scope is limited to the `public/user/`, `public/auth/`, `public/login/`, and `public/userpix/` directories. Your task is to document the user profile system, authentication plugins (LDAP, OAuth, manual, etc.), login flows, and how user avatars are handled. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 4: Enrollment & Privacy
**Prompt:**
> "Hello! You have been assigned **Segment 4: Enrollment & Privacy**. Your specific scope is limited to the `public/enrol/`, `public/privacy/`, and `public/local/` directories. Your task is to detail the enrollment plugins (manual, self, cohort, etc.) and the privacy API implementations (GDPR compliance, data export, and erasure requests). Please also cover the mechanism of the `local` plugins directory. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 5: Grading & Assessment Framework
**Prompt:**
> "Hello! You have been assigned **Segment 5: Grading & Assessment Framework**. Your specific scope is limited to the `public/grade/`, `public/rating/`, `public/competency/`, and `public/completion/` directories. Your task is to document the gradebook functionality, rating systems, competency frameworks (learning plans), and activity/course completion tracking. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 6: Activity Modules – Core Assignments & Forums
**Prompt:**
> "Hello! You have been assigned **Segment 6: Activity Modules – Core Assignments & Forums**. Your specific scope is limited to the `public/mod/assign/` and `public/mod/forum/` directories. Your task is to focus heavily on documenting Moodle's two most complex activity modules: the assignment submission/grading system and the discussion forums. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 7: Activity Modules – Quizzes & Question Bank
**Prompt:**
> "Hello! You have been assigned **Segment 7: Activity Modules – Quizzes & Question Bank**. Your specific scope is limited to the `public/mod/quiz/` and `public/question/` directories. Your task is to document the Quiz module and the underlying Question Bank subsystem, including question types, behaviors, and import/export formats. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 8: Multimedia & Interactive Content (H5P & SCORM)
**Prompt:**
> "Hello! You have been assigned **Segment 8: Multimedia & Interactive Content (H5P & SCORM)**. Your specific scope is limited to the `public/mod/scorm/`, `public/mod/lesson/`, `public/mod/h5pactivity/`, and `public/h5p/` directories. Your task is to cover interactive learning modules, specifically documenting the SCORM player, Lesson workflows, and the core H5P integration/activity module. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 9: Collaborative Activity Modules
**Prompt:**
> "Hello! You have been assigned **Segment 9: Collaborative Activity Modules**. Your specific scope is limited to the `public/mod/workshop/`, `public/mod/wiki/`, `public/mod/glossary/`, and `public/mod/data/` directories. Your task is to detail the peer-assessment (Workshop), collaborative editing (Wiki), and student-contributed content modules (Glossary and Database). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 10: External Resources & LTI Integrations
**Prompt:**
> "Hello! You have been assigned **Segment 10: External Resources & LTI Integrations**. Your specific scope is limited to the `public/mod/lti/`, `public/mod/bigbluebuttonbn/`, `public/mod/resource/`, `public/mod/url/`, `public/mod/page/`, and `public/mod/label/` directories. Your task is to document external tool integrations (LTI), BigBlueButton conferencing, and static content modules. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 11: Blocks & Themes
**Prompt:**
> "Hello! You have been assigned **Segment 11: Blocks & Themes**. Your specific scope is limited to the `public/blocks/` and `public/theme/` directories. Your task is to cover the UI side of the application, documenting how blocks (side-panel widgets) function and explaining the theming engine (including Boost and Classic themes). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 12: System Libraries – Google Integrations
**Prompt:**
> "Hello! You have been assigned **Segment 12: System Libraries – Google Integrations**. Your specific scope is limited to the `public/lib/google/` and `public/lib/google2-service/` directories. Your task is to analyze and document the Google Drive, Docs, and OAuth integrations. *Note: Focus on the application's wrapper and usage of the library, not the Google SDK itself.* **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 13: System Libraries – Cloud & HTTP Clients
**Prompt:**
> "Hello! You have been assigned **Segment 13: System Libraries – Cloud & HTTP Clients**. Your specific scope is limited to the `public/lib/aws-sdk/`, `public/lib/guzzlehttp/`, and `public/lib/giggsey/` directories. Your task is to document the integration of AWS services, HTTP client usage via Guzzle, and phone number formatting (Giggsey) across the platform. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 14: System Libraries – Front-end & UI Tools
**Prompt:**
> "Hello! You have been assigned **Segment 14: System Libraries – Front-end & UI Tools**. Your specific scope is limited to the `public/lib/yuilib/`, `public/lib/editor/`, `public/lib/jquery/`, and `public/lib/amd/` directories. Your task is to detail the legacy YUI library usage, Atto/TinyMCE text editors, jQuery integrations, and the modern AMD (RequireJS) module architecture. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 15: System Libraries – Document Generation & Utilities
**Prompt:**
> "Hello! You have been assigned **Segment 15: System Libraries – Document Generation & Utilities**. Your specific scope is limited to the `public/lib/tcpdf/`, `public/lib/phpspreadsheet/`, `public/lib/htmlpurifier/`, `public/lib/adodb/`, and `public/lib/openspout/` directories. Your task is to cover PDF generation, Excel/CSV parsing, HTML sanitization, and legacy database abstractions. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 16: Core Classes & Testing Frameworks
**Prompt:**
> "Hello! You have been assigned **Segment 16: Core Classes & Testing Frameworks**. Your specific scope is limited to the `public/lib/classes/`, `public/lib/tests/`, `public/lib/behat/` directories, and files in the root of `public/lib/`. Your task is to document the core autoloaded PHP classes, unit testing (PHPUnit) utilities, and behavioral testing (Behat) framework configuration. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 17: File System, Repositories & Media
**Prompt:**
> "Hello! You have been assigned **Segment 17: File System, Repositories & Media**. Your specific scope is limited to the `public/files/`, `public/repository/`, `public/media/`, `public/file.php`, `public/draftfile.php`, and `public/pluginfile.php` files/directories. Your task is to document the File API, media players, file serving scripts, and external file repositories (Google Drive, Dropbox, File System, etc.). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 18: Backup, Restore & Data Formats
**Prompt:**
> "Hello! You have been assigned **Segment 18: Backup, Restore & Data Formats**. Your specific scope is limited to the `public/backup/`, `public/dataformat/`, and `public/portfolio/` directories. Your task is to detail the complex course backup and restore processes, user data export formats (CSV, Excel), and the portfolio API for exporting student work. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 19: Messaging & Communication
**Prompt:**
> "Hello! You have been assigned **Segment 19: Messaging & Communication**. Your specific scope is limited to the `public/message/`, `public/communication/`, `public/comment/`, and `public/sms/` directories. Your task is to cover internal messaging, notification systems, inline commenting, communication providers (e.g., Matrix integration), and SMS messaging. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 20: Reporting & Analytics
**Prompt:**
> "Hello! You have been assigned **Segment 20: Reporting & Analytics**. Your specific scope is limited to the `public/report/`, `public/reportbuilder/`, and `public/analytics/` directories. Your task is to document site-wide and course-level reports, the custom Report Builder framework, and the machine learning-based Analytics API. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 21: Web Services, MNet & Plagiarism
**Prompt:**
> "Hello! You have been assigned **Segment 21: Web Services, MNet & Plagiarism**. Your specific scope is limited to the `public/webservice/`, `public/mnet/`, `public/plagiarism/`, and `public/iplookup/` directories. Your task is to detail the external REST/SOAP web services API, the legacy Moodle Networking (MNet) system, plagiarism plugin APIs, and IP geolocation. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 22: Caching, Search & Performance
**Prompt:**
> "Hello! You have been assigned **Segment 22: Caching, Search & Performance**. Your specific scope is limited to the `public/cache/` and `public/search/` directories. Your task is to document the Moodle Universal Cache (MUC) architecture, caching backends (Redis, Memcached), and the global search engine integration (Solr). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 23: Badges & Availability (Conditional Access)
**Prompt:**
> "Hello! You have been assigned **Segment 23: Badges & Availability (Conditional Access)**. Your specific scope is limited to the `public/badges/` and `public/availability/` directories. Your task is to cover the Open Badges implementation for gamification and the 'Restrict access' (availability) API used to conditionally unlock activities/courses. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 24: Calendar, Events & Blogs
**Prompt:**
> "Hello! You have been assigned **Segment 24: Calendar, Events & Blogs**. Your specific scope is limited to the `public/calendar/`, `public/blog/`, `public/my/`, and `public/notes/` directories. Your task is to document the event calendar system, internal blog infrastructure, the user dashboard ('My Moodle'), and student notes functionality. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 25: Content Bank & Filtering
**Prompt:**
> "Hello! You have been assigned **Segment 25: Content Bank & Filtering**. Your specific scope is limited to the `public/contentbank/` and `public/filter/` directories. Your task is to detail the Content Bank repository (used heavily for H5P) and the text filtering system (e.g., auto-linking, math rendering, multimedia embedding). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 26: Tags, RSS & Favorites
**Prompt:**
> "Hello! You have been assigned **Segment 26: Tags, RSS & Favorites**. Your specific scope is limited to the `public/tag/`, `public/rss/`, and `public/favourites/` directories. Your task is to document the global tagging system, RSS feed generation for forums and blogs, and the system for starring/favoriting courses and items. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 27: AI Integrations & Payments
**Prompt:**
> "Hello! You have been assigned **Segment 27: AI Integrations & Payments**. Your specific scope is limited to the `public/ai/` and `public/payment/` directories. Your task is to cover the relatively new AI subsystem and the payment API (used for paid course enrollments and payment gateways like PayPal/Stripe). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 28: Localization & Error Handling
**Prompt:**
> "Hello! You have been assigned **Segment 28: Localization & Error Handling**. Your specific scope is limited to the `public/lang/` and `public/error/` directories. Your task is to document the language string management system, localization overrides, and the error/exception handling mechanisms. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 29: Root Configuration & Core Entry Points
**Prompt:**
> "Hello! You have been assigned **Segment 29: Root Configuration & Core Entry Points**. Your specific scope is limited to `config-dist.php`, `index.php`, `public/config.php`, `public/index.php`, `public/editmode.php`, `public/help.php`, and `public/version.php`. Your task is to analyze the main bootstrapping sequence, global configuration file (`config.php`), entry point scripts, and versioning constants. **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

### Developer 30: Development Workflows & Tooling
**Prompt:**
> "Hello! You have been assigned **Segment 30: Development Workflows & Tooling**. Your specific scope is limited to the `scripts/`, `.github/`, `.jest/` directories, and the `Gruntfile.js`, `package.json`, `composer.json`, and `phpunit.xml.dist` files. Your task is to document the build processes (Grunt, NPM), dependency management (Composer), CI/CD workflows, and configuration for testing environments (Jest, PHPUnit). **Important:** Please strictly confine your documentation and code exploration to these paths to avoid overlapping with other developers' work."

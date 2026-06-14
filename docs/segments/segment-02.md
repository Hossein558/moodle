# Segment 2: Course Management & Cohorts

## Scope
* `public/course/`
* `public/customfield/`
* `public/cohort/`
* `public/group/`

## Overview
This segment covers the creation, configuration, and management of courses in Moodle. It includes documentation on how cohorts, groups, and custom course fields are implemented and managed within the designated directories.

### Course Management (`public/course/`)
The `public/course/` directory handles course creation, editing, category management, format display, module management within courses, course search, bulk completion, and related backend APIs. Important files include `edit.php`, `view.php`, `lib.php`, `modedit.php` and `moodleform_mod.php` for module integrations. The directory contains sub-plugins such as `format/` and `report/` specifically tied to course administration.

### Custom Fields (`public/customfield/`)
The `public/customfield/` directory implements custom fields, allowing administrators to define additional metadata for entities (such as courses). It supports different custom field types located in `field/` and manages them through classes defined in `classes/`.

### Cohorts (`public/cohort/`)
The `public/cohort/` directory manages system-wide or category-wide groups of users, known as cohorts. Key functionalities include cohort creation (`edit.php`), bulk assignment of users to cohorts (`assign.php`), and bulk uploading of cohorts (`upload.php`).

### Groups (`public/group/`)
The `public/group/` directory manages course-level grouping of users. It handles groups (a collection of users) and groupings (a collection of groups). Key functionalities include creating and editing groups (`group.php`), assigning members to groups (`members.php`), and auto-creating groups (`autogroup.php`).

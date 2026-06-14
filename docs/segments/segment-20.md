# Segment 20: Reporting & Analytics

## Purpose
This segment covers the documentation of Moodle's reporting and analytics subsystems. It encompasses site-wide and course-level reports, the custom Report Builder framework, and the machine learning-based Analytics API. The primary goal of these systems is to provide insights into user interactions, system configurations, and predictive indicators for learning outcomes.

## Architecture & Main Components

### 1. Analytics API (`public/analytics/`)
The Analytics API is a machine learning-based subsystem designed to evaluate educational and system data to generate insights and predictions.

*   **Models (`core_analytics\model`)**: Defines prediction models that connect targets (what we want to predict) with indicators (variables used for prediction) and time-splitting methods (how time is divided for evaluation).
*   **Predictors (`core_analytics\predictor`)**: The machine learning backends (e.g., Python ML backend) that evaluate models and generate predictions.
*   **Targets & Indicators**: Provide specific targets (like "students at risk of dropping out") and indicators (like "number of forum posts").
*   **Manager (`core_analytics\manager`)**: The core entry point for managing models, executing calculations, and fetching insights.

### 2. Report Builder (`public/reportbuilder/`)
The Report Builder is a highly customizable framework that allows administrators and users to generate tabular reports.

*   **System Reports (`core_reportbuilder\system_report`)**: Pre-defined reports that serve as the foundation for specific views, usually embedded in standard Moodle pages.
*   **Data Sources (`core_reportbuilder\datasource`)**: Classes that define where the data comes from, what columns are available, and default sorting/filtering.
*   **Entities (`core_reportbuilder\local\entities\base`)**: Encapsulate specific database tables or logical groupings of data (e.g., User entity, Course entity) providing reusable columns and filters.
*   **Manager (`core_reportbuilder\manager`)**: Handles the retrieval and instantiation of report instances and datasources.

### 3. Core Reports (`public/report/`)
This directory contains standard site-wide and course-level reports.

*   **Participation Report (`public/report/participation/`)**: Shows user participation in course activities based on log data.
*   **Event List (`public/report/eventlist/`)**: A developer and admin tool that lists all defined Moodle events.
*   **Config Changes (`public/report/configlog/`)**: A system report utilizing the Report Builder framework to display administrative configuration changes.
*   **Competency Report (`public/report/competency/`)**: Provides a breakdown of user competencies within a course.
*   **Log Reports (`public/report/loglive/`, etc.)**: View and monitor live user activity logs across the site.

## Interactions
*   **Report Builder & Subsystems**: Various standard reports (like the `configlog` report) use the Report Builder API to construct their views instead of using legacy table structures.
*   **Analytics & Events**: The Analytics API heavily relies on Moodle events (often viewed via the `eventlist` report) as the primary source of indicator data for training models.
*   **Outputs**: All modules rely heavily on the renderer structure and AMD modules for delivering interactive outputs, specifically YUI/AMD integrations found in their respective output and AMD directories.

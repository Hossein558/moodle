# Segment 5: Grading & Assessment Framework

## Purpose
This segment covers the core infrastructure for evaluating and tracking student progress. The framework comprises four interconnected systems: Gradebook (public/grade/), Ratings (public/rating/), Competencies (public/competency/), and Completion Tracking (public/completion/). Together, they form a comprehensive mechanism to define criteria, evaluate submissions, track progress, and map learning outcomes to formal competencies.

## Architecture & Core Components

### 1. Gradebook (`public/grade/`)
The Gradebook acts as the central repository and calculation engine for all quantifiable assessments within a course.
- **`grade_item` / `component_gradeitem`:** Represents individual assessment tasks (e.g., a quiz, an assignment) and stores scale data, grading methods, and boundaries.
- **Grading Methods:** Advanced grading APIs allow integration with various grading formats (rubrics, marking guides) via the grading manager.
- **Import/Export:** Subsystems allow data exchange with external systems (CSV, XML, Excel) making the gradebook highly interoperable.
- **Calculation & Aggregation:** Sophisticated recalculation and penalty APIs handle weighted aggregations, natural weightings, and dropping lowest scores.

### 2. Rating System (`public/rating/`)
The rating system provides a generic, decoupled way to allow users to evaluate content (like forum posts or glossary entries) anywhere in Moodle.
- **`rating` class:** Defines a single evaluation instance linked to a specific context, item, and user.
- **Aggregation:** Collects multiple ratings on a single item and converts them into a final grade (using average, count, maximum, minimum, or sum) which is then synchronized with the main Gradebook.

### 3. Competency Framework (`public/competency/`)
Competencies handle outcomes-based learning by mapping structured learning plans to course content and user evidence.
- **Framework Definitions:** Enables administrators to establish hierarchical structures of skills or standards.
- **`user_competency` & Learning Plans:** Connects specific competencies to individual users, allowing tracking independent of a single course.
- **Integration:** Hooks (e.g., `core_competency_comment_add`) and APIs trigger evaluations and notify users or reviewers when competency evidence is updated.

### 4. Completion Tracking (`public/completion/`)
Completion acts as the binary or state-driven counterpart to the quantitative gradebook.
- **`completion_completion` (Data Object):** Tracks the status of a user in an activity or course, including enrollment timestamps and completion flags.
- **Criteria Evaluation:** Completion can depend on multiple factors such as viewing an activity, achieving a minimum grade, or manual confirmation.
- **Aggregation:** Course completion is often calculated by aggregating the completion states of its constituent activities.

## Component Interaction
The systems are tightly integrated:
- **Activities** rely on the `rating` system or direct grade APIs to evaluate user work, pushing scores to the **Gradebook**.
- The **Gradebook** interacts with the **Completion** system, where achieving a specific passing grade can trigger an activity completion event.
- Activity or course **Completions** can automatically provide evidence towards fulfilling a **Competency**, linking raw coursework directly to broader learning objectives.

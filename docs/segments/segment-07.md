# Segment 7: Activity Modules – Quizzes & Question Bank

## Overview

The Quiz module and the Question Bank subsystem in Moodle are closely integrated components designed to create, manage, and deliver assessments. The Question Bank provides a centralized repository for questions that can be reused across multiple quizzes and other activities, while the Quiz module manages the assembly of these questions into a cohesive assessment experience, handling the logic for attempts, grading, and feedback.

## Scope

This segment covers the following directories:
* `public/mod/quiz/` - Contains the core functionality of the Quiz activity module, including attempts, review, reports, and settings.
* `public/question/` - Houses the Question Bank subsystem, handling question types, behaviors, categories, and import/export formats.

## Architecture & Interaction

The architecture follows a clear separation of concerns between the assessment container (Quiz) and the assessment items (Questions).

### 1. The Question Bank (`public/question/`)

The Question Bank is a powerful, extensible system for managing questions.

*   **Question Types (`public/question/type/`)**: Questions are not hardcoded; they are implemented as plugins. Moodle comes with a variety of standard question types (e.g., multiple choice, true/false, short answer, essay, calculated). Each type defines how the question is rendered, validated, graded, and saved.
*   **Question Behaviors (`public/question/behaviour/`)**: This defines how the user interacts with the question during an attempt. Examples include deferred feedback (the user answers all questions and then submits the quiz to see feedback), interactive with multiple tries (the user gets immediate feedback and can try again), and adaptive mode.
*   **Categories (`public/question/bank/`)**: Questions are organized into categories, which can be hierarchical. These categories can exist at different context levels (activity level, course level, course category level, or system level), determining their reusability.
*   **Import/Export Formats (`public/question/format/`)**: The system supports importing and exporting questions in various formats (e.g., GIFT, Moodle XML, Aiken) via plugins.
*   **The Engine (`public/question/engine/`)**: This is the core logic that ties a question definition, a question behavior, and a user's response together to produce a state (e.g., right/wrong) and a grade. It tracks the history of a user's interaction with a question (`question_usage_by_activity`).

### 2. The Quiz Module (`public/mod/quiz/`)

The Quiz module is an activity plugin that uses the Question Bank to create an assessment.

*   **Quiz Settings (`mod_quiz_mod_form` in `mod_form.php`)**: Allows instructors to configure settings such as timing (open/close dates, time limits), grading methods, layout (pagination), question behavior (deferring to the `question` subsystem), review options (what students see during and after an attempt), and access restrictions (passwords, network addresses).
*   **Attempt Management (`attempt.php`, `processattempt.php`)**: When a user starts a quiz, an "attempt" is created (`quiz_attempt` object). The system handles the loading of the quiz layout, presenting questions page by page, autosaving responses via AJAX (`autosave.ajax.php`), and processing the final submission. It uses the question engine to manage the state of each question within the attempt.
*   **Review and Feedback (`review.php`, `summary.php`)**: After submission (or during, depending on the behavior), users can review their attempts. The quiz module dictates what information (grades, specific feedback, correct answers) is shown based on the review options configured.
*   **Reports (`public/mod/quiz/report/`)**: The quiz module includes several built-in reports (e.g., grades, responses, statistics) that are implemented as sub-plugins. These reports analyze attempt data and question performance.
*   **Overrides (`overrideedit.php`, `overrides.php`)**: Allows instructors to grant specific users or groups different quiz settings (e.g., extending the time limit or changing the open/close dates).

## Interaction Flow (A Student Attempting a Quiz)

1.  **Start Attempt**: The user accesses the quiz. `startattempt.php` creates a new `quiz_attempt` record. The quiz module queries the Question Bank to build the list of questions for this attempt, potentially involving random question selection from categories. A `question_usage_by_activity` is initialized in the question engine.
2.  **Navigation**: The user navigates through the quiz pages (`attempt.php`). The quiz module asks the question engine to render the HTML for the questions on the current page.
3.  **Interaction**: The user answers questions. Responses are either autosaved (`autosave.ajax.php`) or saved when the user navigates to a new page. The question engine processes these responses, updating the state of each question according to the selected behavior.
4.  **Submission**: The user submits the quiz (`processattempt.php`). The quiz module instructs the question engine to finish all questions. The overall quiz grade is calculated based on the individual question scores and the quiz grading method.
5.  **Review**: The user views the review page (`review.php`). The quiz module retrieves the attempt data and uses the question engine to render the questions in their final state, along with appropriate feedback based on the quiz settings.

# Segment 23: Badges & Availability (Conditional Access)

## Scope
* \`public/badges/\`: Open Badges implementation for gamification.
* \`public/availability/\`: 'Restrict access' (availability) API used to conditionally unlock activities/courses.

## Purpose & Architecture
Moodle uses **Badges** to award achievements to users. This subsystem provides the gamification aspect of learning.
The **Availability** API (also known as 'Restrict access') handles the logic for unlocking activities, sections, or entire courses based on certain conditions (such as completion of other activities, grade requirements, date/time, or user profile fields).

## Main Components & Interactions

### Availability
* **\`core_availability\info\`**: Base class for conditional availability information (for module or section).
* **\`core_availability\condition\`**: Base class for all availability conditions.
* **\`core_availability\tree\`**: A tree structure representing the complex logical combinations (AND/OR) of availability conditions.
* When a user attempts to view a module or section, Moodle queries the availability tree. Each condition in the tree evaluates whether the current user meets the requirements, and returns the result (and a message if not available).

### Badges
* **\`core_badges\badge\`**: Represents a badge entity, including logic for checking criteria and issuing the badge.
* **Backpack API integrations**: Connects to external backpack providers (e.g. Badgr, Open Badges) to push/pull badges.
* **Criteria**: Defines rules for earning badges. It interacts with events, completion records, or manual triggers to determine if the user has satisfied the conditions to be awarded the badge.

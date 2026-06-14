# Segment 21: Web Services, MNet & Plagiarism

## Overview
This segment covers external integrations and core networking APIs within Moodle. It includes the architecture for exposing Moodle functions to external systems, legacy networking mechanisms, plugin architectures for academic integrity, and geographical IP resolution tools.

## Main Components and Architecture

### 1. Web Services (`public/webservice/`)
- **Purpose**: Provides a robust, secure, and standardized way for external applications (such as the Moodle Mobile app or external SIS platforms) to communicate with Moodle.
- **Architecture**: Moodle defines an external API (often via `externallib.php` files in modules) and makes it available over multiple protocols (REST, SOAP, XML-RPC).
- **Key Files**:
  - `lib.php`: Core authentication methods, token management, and generic utility functions.
  - `externallib.php`: Implements parameters validation and generic endpoints like `get_site_info`.

### 2. Moodle Networking (MNet) (`public/mnet/`)
- **Purpose**: A legacy feature originally designed to allow multiple Moodle installations to securely authenticate users and share resources transparently.
- **Architecture**: Relies heavily on XML-RPC and SSL certificate exchanges. When an administrator links two Moodle instances, they exchange public keys to establish trust.
- **Key Files**:
  - `lib.php`: Provides URI parsing (`mnet_get_hostname_from_uri`) and key retrieval functions (`mnet_get_public_key`).

### 3. Plagiarism API (`public/plagiarism/`)
- **Purpose**: Facilitates the integration of external originality and plagiarism detection services (e.g., Turnitin, Urkund) without modifying core assignment or forum code.
- **Architecture**: Defines an abstract `plagiarism_plugin` class containing hooks. Activity modules (like `mod_assign`) trigger these hooks during submission viewing or grading, allowing the active plugin to inject HTML links or process payloads.
- **Key Files**:
  - `lib.php`: Defines the `plagiarism_plugin` abstract class.

### 4. IP Lookup (`public/iplookup/`)
- **Purpose**: Maps visitor IP addresses to geographical locations. Used heavily for logging and security reporting.
- **Architecture**: Relies primarily on the MaxMind GeoIP2 databases to resolve locations.
- **Key Files**:
  - `lib.php`: Contains the `iplookup_find_location` function which queries the database and returns an array representing city, country, and coordinates.

## Interactions
- **Web Services** and **MNet** historically serve similar high-level goals (external integration) but follow different paradigms (MNet is Moodle-to-Moodle, Web Services are general API endpoints). Web Services have largely supplanted MNet for modern integrations.
- **Plagiarism plugins** may internally use components of Web Services or core HTTP clients to transmit submission contents to remote analysis servers.
- **IP Lookup** is a utility consumed throughout the system, including within authentication routines (which may encompass Web Service or MNet authentications) to map login attempts geographically.

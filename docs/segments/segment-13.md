# Segment 13: System Libraries – Cloud & HTTP Clients

## Overview
This segment covers three external libraries integrated into Moodle to support cloud service interactions, outbound HTTP requests, and phone number formatting. The libraries are:
- **AWS SDK for PHP** (`public/lib/aws-sdk/`)
- **Guzzle HTTP Client** (`public/lib/guzzlehttp/`)
- **Giggsey libphonenumber-for-php-lite** (`public/lib/giggsey/`)

These dependencies are updated via Composer and bundled directly into Moodle to ensure stable API functionality across all environments without requiring host-level modifications.

## 1. AWS SDK (`public/lib/aws-sdk/`)
### Purpose
Moodle includes the official `aws/aws-sdk-php` to interact with Amazon Web Services. This is commonly utilized by core Moodle features and plugins that interact with AWS products such as:
- **Amazon S3:** Used for the S3 Repository (`repository_s3`), allowing users to browse and import files hosted in S3 buckets. S3 is also often used for offsite backups or media storage.
- **Amazon SES:** Simple Email Service integration for outgoing site emails.

### Architecture & Usage
The library is located in `public/lib/aws-sdk/src/` and typically accessed by instantiating `Aws\Sdk` or specific client classes like `Aws\S3\S3Client` depending on the Moodle plugin. Moodle wraps these calls through specific plugin implementations rather than exposing a global wrapper.

**Updates:**
As documented in `public/lib/aws-sdk/readme_moodle.txt`, the SDK is updated by downloading the latest release from the official repository and copying the `src` folder along with the LICENSE.

## 2. Guzzle HTTP Client (`public/lib/guzzlehttp/`)
### Purpose
Guzzle is the de facto standard PHP HTTP client used heavily across Moodle to perform external RESTful and SOAP API calls. Prior to Guzzle, Moodle relied on custom `curl` wrapper classes, but Guzzle provides an asynchronous, modern PSR-7 compliant architecture.

### Architecture & Usage
Moodle bundles:
- `guzzlehttp/guzzle`: The main HTTP client (`Client.php`).
- `guzzlehttp/psr7`: PSR-7 HTTP message interfaces implementation.
- `guzzlehttp/promises`: Promises for asynchronous HTTP requests.
- `kevinrob/guzzle-cache-middleware`: A caching middleware for Guzzle to store responses locally when headers allow.

Moodle code typically creates instances of `GuzzleHttp\Client` directly or utilizes wrappers (like `\core\http_client` or similar abstraction layers depending on the version) to ensure consistent timeout, proxy, and SSL configurations are applied site-wide.

**Updates:**
As documented in `public/lib/guzzlehttp/readme_moodle.txt`, Guzzle is updated via a temporary composer installation and then copying the specific library folders (`guzzle`, `psr7`, `promises`, `kevinrob`) over.

## 3. Giggsey libphonenumber (`public/lib/giggsey/`)
### Purpose
The `giggsey/libphonenumber-for-php-lite` library is a PHP port of Google's `libphonenumber`. It handles parsing, formatting, and validating international phone numbers.

### Architecture & Usage
Moodle uses this library to ensure consistency in phone number formatting. Key features that leverage this include:
- **User Profiles:** Validating phone numbers entered by users or synchronized via authentication plugins (e.g., LDAP/Active Directory).
- **Messaging/SMS Plugins:** SMS providers (such as AWS SNS or Twilio integrations) require phone numbers in specific E.164 formats to function properly. `libphonenumber` easily converts localized numbers into canonical formats based on region codes.

The primary entry point is the `libphonenumber\PhoneNumberUtil` class.

**Updates:**
As documented in `public/lib/giggsey/libphonenumber-for-php-lite/readme_moodle.txt`, the update process involves a temporary composer install, followed by copying the `src/` directory, `composer.json`, `LICENSE.txt`, and `README.md`.

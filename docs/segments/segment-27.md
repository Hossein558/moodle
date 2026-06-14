# Segment 27: AI Integrations & Payments

## Purpose
This segment covers two distinct subsystems in Moodle: the AI subsystem (`public/ai/`) and the Payments subsystem (`public/payment/`).
- **AI Integrations:** Provides a framework to integrate generative AI models and actions (e.g., text generation, image generation, text summarization) into Moodle in a unified, rate-limited, and policy-controlled manner.
- **Payments:** Provides an API to manage payment accounts, integrate multiple payment gateways (like PayPal or Stripe), and process transactions for paid services within Moodle (e.g., paid course enrollments).

## Architecture & Main Components

### AI Integrations (`public/ai/`)
The AI architecture utilizes a pluggable provider and placement model.
- **`core_ai\manager`**: The central orchestrator. It acts as the gateway for AI requests, determining which providers and actions are enabled, managing policies, and routing requests to the configured endpoints.
- **`core_ai\provider`**: An abstract base class for AI plugins (e.g., OpenAI, AWS Bedrock, Gemini, Deepseek, Ollama). Providers implement the actual communication with AI services to execute actions.
- **`core_ai\placement`**: Represents locations within the Moodle UI (such as the HTML editor or course assist blocks) where AI tools can be surfaced. Placements dictate which actions they support.
- **`core_ai\aiactions\base`**: Actions like `generate_text`, `generate_image`, and `summarise_text` extend this base class. They encapsulate the input and output (responses) formats for AI tasks.
- **`core_ai\rate_limiter`**: Enforces usage limits to prevent abuse and manage costs of external API calls.
- **`core_ai\helper`**: Contains utility methods like stripping structural tags from AI reasoning model outputs.

### Payments (`public/payment/`)
The Payment architecture is built around managing accounts and facilitating transactions via extensible gateway plugins.
- **`core_payment\account`**: A persistent entity mapping to `payment_accounts` table. Accounts define a payment configuration, which is linked to specific contexts (e.g., a specific course).
- **`core_payment\gateway`**: The base abstract class for all payment gateways. Gateways handle the specific API interactions with external services like PayPal or Stripe. They must declare supported currencies and configuration forms.
- **`core_payment\account_gateway`**: A persistent entity mapping a gateway configuration to a specific account.
- **`core_payment\helper`**: Offers a set of robust utility methods to the rest of the application. Components use this helper to query available gateways, calculate exact costs (including gateway-specific surcharges), deliver paid orders using callbacks, and handle the overall payment lifecycle.

## How They Interact
- **AI Integration flow:** A placement requests an action (e.g., "generate text") via the `manager`. The `manager` verifies rate limits, user policies, and configuration, then delegates the execution to the appropriate `provider`. The provider parses the result into an `aiactions\responses\response_base` object, which is handed back to the placement.
- **Payment flow:** A component (e.g., `enrol_fee`) calls `core_payment\helper::get_available_gateways()`. The user selects a gateway. The gateway plugin handles the transaction and upon success, the gateway confirms it. `core_payment\helper::deliver_order()` is then triggered to fulfill the component's service callback.

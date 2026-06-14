# Segment 22: Caching, Search & Performance

## Purpose
This segment covers two major performance and data retrieval systems within Moodle:
1.  **Moodle Universal Cache (MUC)** (`public/cache/`): Provides a unified caching API for developers to store and retrieve data efficiently, abstracting away the specifics of the backend cache systems.
2.  **Global Search Subsystem** (`public/search/`): Provides an architecture for indexing and searching content globally across the entire Moodle site, including courses, activities, and user data.

## Architecture

### Caching (MUC)
The MUC acts as an abstraction layer between Moodle's code and various backend caching technologies (stores). It is built around a "definition" system, where developers define what they want to cache (the data type, TTL, static acceleration needs, etc.), and site administrators map those definitions to specific cache stores (like Redis or APCu) via the Moodle administration interface.

### Global Search
The search architecture relies on a pluggable engine system. The core search subsystem defines the interfaces (`core_search\engine`, `core_search\manager`) and standardizes document generation and index coordination. Specific search engine plugins (like Solr or SimpleDB) implement the storage, indexing, and querying details. Various "search areas" across Moodle (e.g., courses, forums, assignments) implement a contract (`core_search\base`) to provide the documents to be indexed.

## Main Components

### Cache Subsystem (`public/cache/`)
*   **`core_cache\cache`**: The primary class developers interact with to set, get, and delete cached data.
*   **`core_cache\factory`**: Manages the instantiation and coordination of cache objects, definitions, and stores.
*   **Cache Stores**: Implementations of the caching mechanism, such as `APCu`, `Redis`, and `File`. These stores handle the actual I/O operations for saving and retrieving data.

### Search Subsystem (`public/search/`)
*   **`core_search\manager`**: The main facade for the search subsystem. It handles initiating queries, running indexing tasks (including scheduled tasks), and orchestrating documents between search areas and the engine.
*   **`core_search\engine`**: The base class that all search engine plugins must extend. It defines methods for adding documents, executing queries, and deleting index data.
*   **Search Engines**: Implementations of the engine base class (e.g., Solr, SimpleDB) that provide the backend logic for full-text search.

## Interactions
*   **Cache API Usage:** Code throughout Moodle calls `cache::make('component', 'area')` to get a cache instance based on a pre-configured definition. It then uses methods like `get()` and `set()` on this instance. The MUC handles routing this request to the appropriately configured backend store, potentially utilizing a static acceleration layer in memory to boost performance within a single request.
*   **Search API Usage:** The search `manager` iterates over all registered search areas (e.g., a forum post). The search area provides `document` objects containing the text content, URLs, and metadata. The `manager` then delegates these documents to the active `engine` (like Solr) for indexing. When a user performs a search, the query is passed from the search form through the `manager` to the `engine`, which returns results mapped back to `document` objects for rendering.
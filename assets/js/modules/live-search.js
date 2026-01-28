/**
 * Live Search Module - Furrylicious Boutique
 *
 * Provides instant AJAX-powered search functionality.
 * Features:
 * - Debounced input handling (300ms)
 * - Minimum 2 character threshold
 * - AbortController for canceling in-flight requests
 * - Loading/results/no-results state management
 * - Accessibility support with aria-live
 */

class LiveSearch {
    constructor() {
        this.searchForm = null;
        this.searchInput = null;
        this.resultsContainer = null;
        this.resultsGrid = null;
        this.loadingElement = null;
        this.noResultsElement = null;
        this.quickLinksElement = null;

        this.debounceTimer = null;
        this.debounceDelay = 300;
        this.minChars = 2;
        this.abortController = null;

        this.isInitialized = false;
    }

    /**
     * Initialize the live search functionality
     */
    init() {
        if (this.isInitialized) {
            return;
        }

        this.cacheElements();

        if (!this.searchInput || !this.resultsContainer) {
            console.warn('[LiveSearch] Required elements not found');
            return;
        }

        this.bindEvents();
        this.isInitialized = true;
    }

    /**
     * Cache DOM elements
     */
    cacheElements() {
        this.searchForm = document.querySelector('.header-search-overlay__form');
        this.searchInput = document.querySelector('#search-overlay-input');
        this.resultsContainer = document.querySelector('.header-search-overlay__results');
        this.resultsGrid = document.querySelector('.header-search-overlay__results-grid');
        this.loadingElement = document.querySelector('.header-search-overlay__loading');
        this.noResultsElement = document.querySelector('.header-search-overlay__no-results');
        this.quickLinksElement = document.querySelector('.header-search-overlay__quick-links');
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        this.searchInput.addEventListener('input', (e) => this.handleInput(e));

        // Prevent form submission on Enter key
        this.searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        // Prevent form submission entirely (catches submit button clicks too)
        if (this.searchForm) {
            this.searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
            });
        }
    }

    /**
     * Handle input events with debouncing
     */
    handleInput(e) {
        const searchTerm = e.target.value.trim();

        // Clear any pending debounce
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
        }

        // Cancel any in-flight requests
        if (this.abortController) {
            this.abortController.abort();
            this.abortController = null;
        }

        // If search term is too short, clear results and show quick links
        if (searchTerm.length < this.minChars) {
            this.clearResults();
            this.showQuickLinks();
            return;
        }

        // Debounce the search
        this.debounceTimer = setTimeout(() => {
            this.performSearch(searchTerm);
        }, this.debounceDelay);
    }

    /**
     * Perform the AJAX search
     */
    async performSearch(searchTerm) {
        // Check if live search config is available
        if (typeof furryliciousLiveSearch === 'undefined') {
            console.warn('[LiveSearch] Configuration not available');
            return;
        }

        // Show loading state
        this.showLoading();
        this.hideQuickLinks();

        // Create new abort controller for this request
        this.abortController = new AbortController();

        try {
            const formData = new FormData();
            formData.append('action', 'furrylicious_live_search');
            formData.append('nonce', furryliciousLiveSearch.nonce);
            formData.append('search', searchTerm);

            const response = await fetch(furryliciousLiveSearch.ajaxUrl, {
                method: 'POST',
                body: formData,
                signal: this.abortController.signal,
            });

            const data = await response.json();

            if (data.success && data.data.html) {
                this.showResults(data.data.html);
            } else {
                this.showNoResults();
            }
        } catch (error) {
            // Ignore abort errors (expected when user types more)
            if (error.name === 'AbortError') {
                return;
            }
            console.error('[LiveSearch] Error:', error);
            this.showNoResults();
        } finally {
            this.hideLoading();
        }
    }

    /**
     * Show loading state
     */
    showLoading() {
        if (this.loadingElement) {
            this.loadingElement.hidden = false;
        }
        if (this.noResultsElement) {
            this.noResultsElement.hidden = true;
        }
        if (this.resultsGrid) {
            this.resultsGrid.innerHTML = '';
        }
    }

    /**
     * Hide loading state
     */
    hideLoading() {
        if (this.loadingElement) {
            this.loadingElement.hidden = true;
        }
    }

    /**
     * Show search results
     */
    showResults(html) {
        if (this.resultsGrid) {
            this.resultsGrid.innerHTML = html;
        }
        if (this.noResultsElement) {
            this.noResultsElement.hidden = true;
        }
        if (this.resultsContainer) {
            this.resultsContainer.classList.add('has-results');
        }
    }

    /**
     * Show no results message
     */
    showNoResults() {
        if (this.resultsGrid) {
            this.resultsGrid.innerHTML = '';
        }
        if (this.noResultsElement) {
            this.noResultsElement.hidden = false;
        }
        if (this.resultsContainer) {
            this.resultsContainer.classList.remove('has-results');
        }
    }

    /**
     * Clear all results
     */
    clearResults() {
        if (this.debounceTimer) {
            clearTimeout(this.debounceTimer);
            this.debounceTimer = null;
        }

        if (this.abortController) {
            this.abortController.abort();
            this.abortController = null;
        }

        if (this.resultsGrid) {
            this.resultsGrid.innerHTML = '';
        }
        if (this.noResultsElement) {
            this.noResultsElement.hidden = true;
        }
        if (this.loadingElement) {
            this.loadingElement.hidden = true;
        }
        if (this.resultsContainer) {
            this.resultsContainer.classList.remove('has-results');
        }
    }

    /**
     * Show quick links section
     */
    showQuickLinks() {
        if (this.quickLinksElement) {
            this.quickLinksElement.hidden = false;
        }
    }

    /**
     * Hide quick links section
     */
    hideQuickLinks() {
        if (this.quickLinksElement) {
            this.quickLinksElement.hidden = true;
        }
    }
}

// Create singleton instance
const liveSearch = new LiveSearch();

export default liveSearch;

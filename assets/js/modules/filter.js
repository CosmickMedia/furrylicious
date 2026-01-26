/**
 * Puppy Filter Module
 *
 * Handles AJAX filtering of puppies by breed, gender, etc.
 *
 * @package Furrylicious
 */

class PuppyFilter {
    constructor() {
        this.form = document.getElementById('puppy-filter');
        this.grid = document.querySelector('.puppy-grid');
        this.resultsCount = document.querySelector('.woocommerce-result-count');
        this.isLoading = false;

        this.init();
    }

    init() {
        if (!this.form || !this.grid) {
            return;
        }

        this.bindEvents();
    }

    bindEvents() {
        // Form submit
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.filter();
        });

        // Reset button
        const resetBtn = this.form.querySelector('.puppy-filter__reset');
        if (resetBtn) {
            resetBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.reset();
            });
        }

        // Auto-filter on select change (optional)
        const selects = this.form.querySelectorAll('select');
        selects.forEach(select => {
            select.addEventListener('change', () => {
                // Debounce the filter
                clearTimeout(this.filterTimeout);
                this.filterTimeout = setTimeout(() => {
                    this.filter();
                }, 300);
            });
        });
    }

    async filter() {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoading();

        const formData = new FormData(this.form);

        try {
            const response = await fetch(furryliciousFilter.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'furrylicious_filter_puppies',
                    nonce: furryliciousFilter.nonce,
                    breed: formData.get('breed') || '',
                    gender: formData.get('gender') || '',
                    orderby: formData.get('orderby') || 'date',
                    paged: 1,
                }),
            });

            const data = await response.json();

            if (data.success) {
                this.updateGrid(data.data.html);
                this.updateResultsCount(data.data.found);
                this.updateURL(formData);
            }
        } catch (error) {
            console.error('Filter error:', error);
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    reset() {
        // Reset form
        this.form.reset();

        // Clear URL parameters
        const url = new URL(window.location);
        url.searchParams.delete('breed');
        url.searchParams.delete('gender');
        url.searchParams.delete('orderby');
        window.history.pushState({}, '', url);

        // Reload without filters
        this.filter();
    }

    showLoading() {
        this.grid.classList.add('is-loading');
        this.form.classList.add('is-loading');

        // Add loading overlay
        if (!this.grid.querySelector('.puppy-grid__loading')) {
            const loading = document.createElement('div');
            loading.className = 'puppy-grid__loading';
            loading.innerHTML = `
                <div class="puppy-grid__spinner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                    </svg>
                </div>
            `;
            this.grid.appendChild(loading);
        }
    }

    hideLoading() {
        this.grid.classList.remove('is-loading');
        this.form.classList.remove('is-loading');

        const loading = this.grid.querySelector('.puppy-grid__loading');
        if (loading) {
            loading.remove();
        }
    }

    updateGrid(html) {
        // Fade out current content
        this.grid.style.opacity = '0';

        setTimeout(() => {
            this.grid.innerHTML = html;
            this.grid.style.opacity = '1';
        }, 200);
    }

    updateResultsCount(count) {
        if (!this.resultsCount) return;

        const text = count === 1
            ? 'Showing 1 adorable puppy'
            : `Showing ${count} adorable puppies`;

        this.resultsCount.textContent = text;
    }

    updateURL(formData) {
        const url = new URL(window.location);

        const breed = formData.get('breed');
        const gender = formData.get('gender');

        if (breed) {
            url.searchParams.set('breed', breed);
        } else {
            url.searchParams.delete('breed');
        }

        if (gender) {
            url.searchParams.set('gender', gender);
        } else {
            url.searchParams.delete('gender');
        }

        window.history.pushState({}, '', url);
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new PuppyFilter();
});

export default PuppyFilter;

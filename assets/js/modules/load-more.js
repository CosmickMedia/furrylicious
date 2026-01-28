/**
 * Load More Puppies Module
 *
 * Handles AJAX loading of additional puppies on the frontpage.
 *
 * @package Furrylicious
 * @since 4.0.0
 */

(function() {
    'use strict';

    class LoadMorePuppies {
        constructor() {
            this.grid = document.getElementById('puppies-grid');
            this.button = document.getElementById('load-more-puppies');
            this.buttonWrapper = document.querySelector('.puppies-mosaic__load-more');

            if (!this.grid || !this.button) {
                return;
            }

            this.perPage = parseInt(this.grid.dataset.perPage, 10) || 6;
            this.total = parseInt(this.grid.dataset.total, 10) || 0;
            this.offset = parseInt(this.button.dataset.offset, 10) || this.perPage;
            this.isLoading = false;

            this.init();
        }

        init() {
            // Check if we should hide button initially
            this.updateButtonVisibility();

            // Bind click handler
            this.button.addEventListener('click', (e) => this.handleClick(e));
        }

        async handleClick(e) {
            e.preventDefault();

            if (this.isLoading || this.offset >= this.total) {
                return;
            }

            this.setLoading(true);

            try {
                const response = await this.fetchPuppies();

                if (response.success && response.data.html) {
                    this.appendPuppies(response.data.html);
                    this.offset = response.data.loaded_count;
                    this.button.dataset.offset = this.offset;
                    this.total = response.data.total_count;
                    this.grid.dataset.total = this.total;

                    if (!response.data.has_more) {
                        this.hideButton();
                    }
                }
            } catch (error) {
                console.error('Load more error:', error);
            } finally {
                this.setLoading(false);
            }
        }

        async fetchPuppies() {
            const formData = new FormData();
            formData.append('action', 'furrylicious_load_more_puppies');
            formData.append('offset', this.offset);
            formData.append('nonce', window.furryliciousLoadMore?.nonce || '');

            const response = await fetch(window.furryliciousLoadMore?.ajaxUrl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
            });

            return response.json();
        }

        appendPuppies(html) {
            // Create a temporary container to parse the HTML
            const temp = document.createElement('div');
            temp.innerHTML = html;

            // Get all new cards
            const newCards = temp.querySelectorAll('.puppy-card');

            // Append each card with a slight delay for animation
            newCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                this.grid.appendChild(card);

                // Trigger reflow and animate
                requestAnimationFrame(() => {
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            });
        }

        setLoading(loading) {
            this.isLoading = loading;
            this.button.classList.toggle('btn--loading', loading);
            this.button.disabled = loading;

            if (loading) {
                this.button.dataset.originalText = this.button.textContent;
                this.button.innerHTML = '<span class="btn__spinner"></span> Loading...';
            } else {
                this.button.textContent = this.button.dataset.originalText || 'Load More';
            }
        }

        updateButtonVisibility() {
            if (this.offset >= this.total) {
                this.hideButton();
            }
        }

        hideButton() {
            if (this.buttonWrapper) {
                this.buttonWrapper.style.display = 'none';
            } else {
                this.button.style.display = 'none';
            }
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => new LoadMorePuppies());
    } else {
        new LoadMorePuppies();
    }
})();

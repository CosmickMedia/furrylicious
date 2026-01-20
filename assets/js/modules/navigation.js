/**
 * Navigation Module - Furrylicious Boutique
 *
 * Premium navigation system featuring:
 * - Header scroll behavior (transparent → solid)
 * - Full-screen mobile menu with staggered animations
 * - Mega menu interactions
 * - Full-width search overlay
 * - Keyboard navigation and accessibility
 */

const Navigation = {
    // Configuration
    config: {
        scrollThreshold: 50,      // Pixels before header becomes solid
        mobileBreakpoint: 1024,   // Breakpoint for mobile menu
        animationDuration: 300,   // Animation duration in ms
    },

    // DOM Elements
    elements: {
        header: null,
        mobileToggle: null,
        mobileNav: null,
        mobileNavOverlay: null,
        searchToggle: null,
        searchOverlay: null,
        searchInput: null,
        searchClose: null,
        primaryNav: null,
        dropdownItems: [],
        mobileDropdownItems: [],
        backToTop: null,
        body: document.body,
    },

    // State
    state: {
        isMobileMenuOpen: false,
        isSearchOpen: false,
        isScrolled: false,
        lastScrollY: 0,
        focusableElements: [],
        firstFocusable: null,
        lastFocusable: null,
    },

    /**
     * Initialize navigation
     */
    init() {
        this.cacheElements();
        this.bindEvents();
        this.setupAccessibility();
        this.checkInitialScroll();
    },

    /**
     * Cache DOM elements
     */
    cacheElements() {
        this.elements.header = document.querySelector('.site-header');
        this.elements.mobileToggle = document.querySelector('.mobile-menu-toggle');
        this.elements.mobileNav = document.querySelector('.mobile-nav');
        this.elements.mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
        this.elements.searchToggle = document.querySelector('.header-actions__search');
        this.elements.searchOverlay = document.querySelector('.header-search-overlay');
        this.elements.searchInput = document.querySelector('.header-search-overlay__input');
        this.elements.searchClose = document.querySelector('.header-search-overlay__close');
        this.elements.primaryNav = document.querySelector('.primary-nav');
        this.elements.dropdownItems = document.querySelectorAll('.primary-nav__item.has-dropdown');
        this.elements.mobileDropdownItems = document.querySelectorAll('.mobile-nav__item.has-dropdown');
        this.elements.backToTop = document.querySelector('.back-to-top');

        // Debug logging (temporary)
        console.log('[Navigation] Mobile toggle:', this.elements.mobileToggle);
        console.log('[Navigation] Mobile nav:', this.elements.mobileNav);
        console.log('[Navigation] Mobile overlay:', this.elements.mobileNavOverlay);
    },

    /**
     * Bind event listeners
     */
    bindEvents() {
        // Scroll events for header and back-to-top
        window.addEventListener('scroll', this.throttle(() => this.handleScroll(), 10));

        // Mobile menu toggle
        if (this.elements.mobileToggle) {
            this.elements.mobileToggle.addEventListener('click', (e) => this.toggleMobileMenu(e));
        }

        // Mobile nav overlay click to close
        if (this.elements.mobileNavOverlay) {
            this.elements.mobileNavOverlay.addEventListener('click', () => this.closeMobileMenu());
        }

        // Mobile nav close button
        const closeButton = document.querySelector('.mobile-nav__close');
        if (closeButton) {
            closeButton.addEventListener('click', () => this.closeMobileMenu());
        }

        // Search toggle
        if (this.elements.searchToggle) {
            this.elements.searchToggle.addEventListener('click', (e) => this.toggleSearch(e));
        }

        // Search close
        if (this.elements.searchClose) {
            this.elements.searchClose.addEventListener('click', () => this.closeSearch());
        }

        // Desktop dropdown interactions
        this.elements.dropdownItems.forEach((item) => {
            item.addEventListener('mouseenter', () => this.openDropdown(item));
            item.addEventListener('mouseleave', () => this.closeDropdown(item));

            // Keyboard navigation for dropdown trigger
            const link = item.querySelector('.primary-nav__link');
            if (link) {
                link.addEventListener('keydown', (e) => this.handleDropdownKeydown(e, item));
            }

            // Keyboard navigation within dropdown
            const submenu = item.querySelector('.mega-menu, .dropdown-menu');
            if (submenu) {
                submenu.addEventListener('keydown', (e) => this.handleSubmenuKeydown(e, item));
            }
        });

        // Mobile submenu toggles
        this.elements.mobileDropdownItems.forEach((item) => {
            const toggle = item.querySelector('.mobile-nav__submenu-toggle');
            if (toggle) {
                toggle.addEventListener('click', (e) => this.toggleMobileSubmenu(e, item));
            }
        });

        // Back to top button
        if (this.elements.backToTop) {
            this.elements.backToTop.addEventListener('click', () => this.scrollToTop());
        }

        // Escape key handler
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeMobileMenu();
                this.closeSearch();
                this.closeAllDropdowns();
            }
        });

        // Close menu on resize if switching to desktop
        window.addEventListener('resize', this.debounce(() => {
            if (window.innerWidth >= this.config.mobileBreakpoint && this.state.isMobileMenuOpen) {
                this.closeMobileMenu();
            }
        }, 150));

        // Handle click outside search overlay
        if (this.elements.searchOverlay) {
            this.elements.searchOverlay.addEventListener('click', (e) => {
                if (e.target === this.elements.searchOverlay) {
                    this.closeSearch();
                }
            });
        }
    },

    /**
     * Setup accessibility features
     */
    setupAccessibility() {
        // Mobile toggle ARIA
        if (this.elements.mobileToggle) {
            this.elements.mobileToggle.setAttribute('aria-expanded', 'false');
            this.elements.mobileToggle.setAttribute('aria-controls', 'mobile-nav');
            this.elements.mobileToggle.setAttribute('aria-label', 'Toggle navigation menu');
        }

        // Mobile nav ARIA
        if (this.elements.mobileNav) {
            this.elements.mobileNav.setAttribute('aria-hidden', 'true');
            this.elements.mobileNav.id = 'mobile-nav';
        }

        // Search toggle ARIA
        if (this.elements.searchToggle) {
            this.elements.searchToggle.setAttribute('aria-expanded', 'false');
            this.elements.searchToggle.setAttribute('aria-label', 'Open search');
        }

        // Dropdown ARIA
        this.elements.dropdownItems.forEach((item) => {
            const link = item.querySelector('.primary-nav__link');
            const submenu = item.querySelector('.mega-menu, .dropdown-menu');

            if (link && submenu) {
                const id = `dropdown-${Math.random().toString(36).substr(2, 9)}`;
                submenu.id = id;
                link.setAttribute('aria-expanded', 'false');
                link.setAttribute('aria-haspopup', 'true');
                link.setAttribute('aria-controls', id);
            }
        });
    },

    /**
     * Check initial scroll position
     */
    checkInitialScroll() {
        if (window.scrollY > this.config.scrollThreshold) {
            this.handleScroll();
        }
    },

    /**
     * Handle scroll events
     */
    handleScroll() {
        const currentScrollY = window.scrollY;

        // Header scroll state
        if (currentScrollY > this.config.scrollThreshold) {
            if (!this.state.isScrolled) {
                this.state.isScrolled = true;
                this.elements.header?.classList.add('site-header--scrolled');
            }
        } else {
            if (this.state.isScrolled) {
                this.state.isScrolled = false;
                this.elements.header?.classList.remove('site-header--scrolled');
            }
        }

        // Back to top visibility
        if (this.elements.backToTop) {
            if (currentScrollY > 400) {
                this.elements.backToTop.classList.add('is-visible');
            } else {
                this.elements.backToTop.classList.remove('is-visible');
            }
        }

        this.state.lastScrollY = currentScrollY;
    },

    /**
     * Toggle mobile menu
     */
    toggleMobileMenu(e) {
        e.preventDefault();

        if (this.state.isMobileMenuOpen) {
            this.closeMobileMenu();
        } else {
            this.openMobileMenu();
        }
    },

    /**
     * Open mobile menu
     */
    openMobileMenu() {
        console.log('[Navigation] Opening mobile menu, adding is-open class');
        this.state.isMobileMenuOpen = true;

        // Close search if open
        if (this.state.isSearchOpen) {
            this.closeSearch();
        }

        if (this.elements.mobileNav) {
            this.elements.mobileNav.classList.add('is-open');
            this.elements.mobileNav.setAttribute('aria-hidden', 'false');
            console.log('[Navigation] Mobile nav classes:', this.elements.mobileNav.className);
        }

        if (this.elements.mobileNavOverlay) {
            this.elements.mobileNavOverlay.classList.add('is-active');
        }

        if (this.elements.mobileToggle) {
            this.elements.mobileToggle.setAttribute('aria-expanded', 'true');
        }

        this.elements.body.classList.add('menu-open');

        // Trap focus within mobile menu
        this.trapFocus(this.elements.mobileNav);
    },

    /**
     * Close mobile menu
     */
    closeMobileMenu() {
        this.state.isMobileMenuOpen = false;

        if (this.elements.mobileNav) {
            this.elements.mobileNav.classList.remove('is-open');
            this.elements.mobileNav.setAttribute('aria-hidden', 'true');
        }

        if (this.elements.mobileNavOverlay) {
            this.elements.mobileNavOverlay.classList.remove('is-active');
        }

        if (this.elements.mobileToggle) {
            this.elements.mobileToggle.setAttribute('aria-expanded', 'false');
            // Return focus to toggle button
            setTimeout(() => this.elements.mobileToggle.focus(), 10);
        }

        this.elements.body.classList.remove('menu-open');

        // Close all mobile submenus
        this.elements.mobileDropdownItems.forEach((item) => {
            item.classList.remove('is-open');
        });

        // Release focus trap
        this.releaseFocusTrap();
    },

    /**
     * Toggle search overlay
     */
    toggleSearch(e) {
        e.preventDefault();

        if (this.state.isSearchOpen) {
            this.closeSearch();
        } else {
            this.openSearch();
        }
    },

    /**
     * Open search overlay
     */
    openSearch() {
        this.state.isSearchOpen = true;

        // Close mobile menu if open
        if (this.state.isMobileMenuOpen) {
            this.closeMobileMenu();
        }

        if (this.elements.searchOverlay) {
            this.elements.searchOverlay.classList.add('is-active');
        }

        if (this.elements.searchToggle) {
            this.elements.searchToggle.setAttribute('aria-expanded', 'true');
        }

        this.elements.body.classList.add('search-open');

        // Focus search input
        if (this.elements.searchInput) {
            setTimeout(() => this.elements.searchInput.focus(), 100);
        }

        // Trap focus within search
        this.trapFocus(this.elements.searchOverlay);
    },

    /**
     * Close search overlay
     */
    closeSearch() {
        this.state.isSearchOpen = false;

        if (this.elements.searchOverlay) {
            this.elements.searchOverlay.classList.remove('is-active');
        }

        if (this.elements.searchToggle) {
            this.elements.searchToggle.setAttribute('aria-expanded', 'false');
            // Return focus to search toggle
            setTimeout(() => this.elements.searchToggle?.focus(), 10);
        }

        this.elements.body.classList.remove('search-open');

        // Clear search input
        if (this.elements.searchInput) {
            this.elements.searchInput.value = '';
        }

        // Release focus trap
        this.releaseFocusTrap();
    },

    /**
     * Toggle mobile submenu
     */
    toggleMobileSubmenu(e, item) {
        e.preventDefault();
        e.stopPropagation();

        // Close other open submenus
        this.elements.mobileDropdownItems.forEach((otherItem) => {
            if (otherItem !== item) {
                otherItem.classList.remove('is-open');
            }
        });

        item.classList.toggle('is-open');
    },

    /**
     * Open desktop dropdown
     */
    openDropdown(item) {
        // Close other dropdowns first
        this.elements.dropdownItems.forEach((otherItem) => {
            if (otherItem !== item) {
                this.closeDropdown(otherItem);
            }
        });

        item.classList.add('is-open');

        const link = item.querySelector('.primary-nav__link');
        if (link) {
            link.setAttribute('aria-expanded', 'true');
        }
    },

    /**
     * Close desktop dropdown
     */
    closeDropdown(item) {
        item.classList.remove('is-open');

        const link = item.querySelector('.primary-nav__link');
        if (link) {
            link.setAttribute('aria-expanded', 'false');
        }
    },

    /**
     * Close all dropdowns
     */
    closeAllDropdowns() {
        this.elements.dropdownItems.forEach((item) => {
            this.closeDropdown(item);
        });
    },

    /**
     * Handle dropdown trigger keyboard navigation
     */
    handleDropdownKeydown(e, item) {
        const submenu = item.querySelector('.mega-menu, .dropdown-menu');
        const firstLink = submenu?.querySelector('a');

        switch (e.key) {
            case 'Enter':
            case ' ':
                if (item.classList.contains('has-dropdown')) {
                    e.preventDefault();
                    this.openDropdown(item);
                    firstLink?.focus();
                }
                break;
            case 'ArrowDown':
                e.preventDefault();
                this.openDropdown(item);
                firstLink?.focus();
                break;
            case 'Escape':
                this.closeDropdown(item);
                break;
        }
    },

    /**
     * Handle submenu keyboard navigation
     */
    handleSubmenuKeydown(e, item) {
        const submenu = item.querySelector('.mega-menu, .dropdown-menu');
        const links = submenu?.querySelectorAll('a');
        const currentIndex = Array.from(links || []).indexOf(document.activeElement);

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                if (links && currentIndex < links.length - 1) {
                    links[currentIndex + 1].focus();
                }
                break;
            case 'ArrowUp':
                e.preventDefault();
                if (links && currentIndex > 0) {
                    links[currentIndex - 1].focus();
                } else {
                    // Return focus to trigger link
                    item.querySelector('.primary-nav__link')?.focus();
                }
                break;
            case 'Escape':
            case 'Tab':
                if (e.key === 'Escape' || (e.key === 'Tab' && !e.shiftKey && currentIndex === links.length - 1)) {
                    this.closeDropdown(item);
                    if (e.key === 'Escape') {
                        item.querySelector('.primary-nav__link')?.focus();
                    }
                }
                break;
        }
    },

    /**
     * Scroll to top
     */
    scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    },

    /**
     * Trap focus within an element
     */
    trapFocus(container) {
        if (!container) return;

        const focusableSelectors = [
            'a[href]',
            'button:not([disabled])',
            'input:not([disabled])',
            'select:not([disabled])',
            'textarea:not([disabled])',
            '[tabindex]:not([tabindex="-1"])',
        ];

        this.state.focusableElements = container.querySelectorAll(
            focusableSelectors.join(',')
        );

        if (this.state.focusableElements.length === 0) return;

        this.state.firstFocusable = this.state.focusableElements[0];
        this.state.lastFocusable = this.state.focusableElements[this.state.focusableElements.length - 1];

        // Store the focus trap handler so we can remove it later
        this._focusTrapHandler = (e) => {
            if (e.key !== 'Tab') return;

            if (e.shiftKey) {
                if (document.activeElement === this.state.firstFocusable) {
                    e.preventDefault();
                    this.state.lastFocusable.focus();
                }
            } else {
                if (document.activeElement === this.state.lastFocusable) {
                    e.preventDefault();
                    this.state.firstFocusable.focus();
                }
            }
        };

        container.addEventListener('keydown', this._focusTrapHandler);
    },

    /**
     * Release focus trap
     */
    releaseFocusTrap() {
        // Remove event listeners from both possible containers
        [this.elements.mobileNav, this.elements.searchOverlay].forEach(container => {
            if (container && this._focusTrapHandler) {
                container.removeEventListener('keydown', this._focusTrapHandler);
            }
        });
    },

    /**
     * Throttle function for scroll events
     */
    throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    },

    /**
     * Debounce function for resize events
     */
    debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    },
};

// Export for module usage - main.js handles initialization
export default Navigation;

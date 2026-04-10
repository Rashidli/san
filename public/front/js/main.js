/**
 * Santexnik Ustasi - Main JavaScript
 * Professional animations and interactions
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initHeader();
        initMobileMenu();
        initLanguageDropdown();
        initHeroSlider();
        initReviewsSlider();
        initFaqAccordion();
        initScrollAnimations();
        initScrollToTop();
        initCounterAnimation();
        initSmoothScroll();
        initFormValidation();
        initNavDropdown();
        initParallaxEffect();
        initLightbox();
    });

    /**
     * Header - Sticky & Scroll Effects
     */
    function initHeader() {
        const header = document.getElementById('header');
        if (!header) return;

        let lastScrollY = window.scrollY;
        let ticking = false;

        function updateHeader() {
            const currentScrollY = window.scrollY;

            // Add scrolled class after 100px
            if (currentScrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide/show header on scroll direction
            if (currentScrollY > lastScrollY && currentScrollY > 500) {
                header.classList.add('header-hidden');
            } else {
                header.classList.remove('header-hidden');
            }

            lastScrollY = currentScrollY;
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateHeader);
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * Mobile Menu
     */
    function initMobileMenu() {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileOverlay = document.getElementById('mobileOverlay');

        if (!mobileMenuBtn || !mobileMenu) return;

        function openMenu() {
            mobileMenu.classList.add('active');
            if (mobileOverlay) mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            mobileMenuBtn.classList.add('active');
        }

        function closeMenu() {
            mobileMenu.classList.remove('active');
            if (mobileOverlay) mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
            mobileMenuBtn.classList.remove('active');
        }

        mobileMenuBtn.addEventListener('click', openMenu);
        if (closeMobileMenu) closeMobileMenu.addEventListener('click', closeMenu);
        if (mobileOverlay) mobileOverlay.addEventListener('click', closeMenu);

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMenu();
            }
        });

        // Close menu on link click
        const mobileNavLinks = mobileMenu.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(function(link) {
            link.addEventListener('click', closeMenu);
        });
    }

    /**
     * Language Dropdown
     */
    function initLanguageDropdown() {
        const langDropdowns = document.querySelectorAll('.lang-dropdown');

        langDropdowns.forEach(function(dropdown) {
            const btn = dropdown.querySelector('.lang-btn');
            const menu = dropdown.querySelector('.lang-menu');

            if (!btn || !menu) return;

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('active');
            });
        });

        // Close on outside click
        document.addEventListener('click', function() {
            langDropdowns.forEach(function(dropdown) {
                dropdown.classList.remove('active');
            });
        });
    }

    /**
     * Navigation Dropdown
     */
    function initNavDropdown() {
        const navItems = document.querySelectorAll('.nav-item.has-dropdown');

        navItems.forEach(function(item) {
            const link = item.querySelector('.nav-link');
            const dropdown = item.querySelector('.dropdown-menu');

            if (!link || !dropdown) return;

            // Desktop: hover
            item.addEventListener('mouseenter', function() {
                dropdown.classList.add('show');
            });

            item.addEventListener('mouseleave', function() {
                dropdown.classList.remove('show');
            });

            // Mobile: click
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    dropdown.classList.toggle('show');
                }
            });
        });
    }

    /**
     * Hero Slider
     */
    function initHeroSlider() {
        const heroSlider = document.querySelector('.hero-slider .swiper');
        if (!heroSlider) return;

        new Swiper(heroSlider, {
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.hero-dots',
                clickable: true,
                bulletClass: 'hero-dot',
                bulletActiveClass: 'active',
            },
            navigation: {
                nextEl: '.hero-next',
                prevEl: '.hero-prev',
            },
            on: {
                slideChangeTransitionStart: function() {
                    const activeSlide = this.slides[this.activeIndex];
                    const content = activeSlide.querySelector('.hero-content');
                    if (content) {
                        content.classList.remove('animate');
                        void content.offsetWidth; // Trigger reflow
                        content.classList.add('animate');
                    }
                }
            }
        });
    }

    /**
     * Reviews Slider
     */
    function initReviewsSlider() {
        const reviewsSlider = document.querySelector('.reviews-slider .swiper');
        if (!reviewsSlider) return;

        new Swiper(reviewsSlider, {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 600,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.reviews-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.reviews-next',
                prevEl: '.reviews-prev',
            },
            breakpoints: {
                576: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 25,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });
    }

    /**
     * FAQ Accordion
     */
    function initFaqAccordion() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');

            if (!question || !answer) return;

            question.addEventListener('click', function() {
                const isActive = item.classList.contains('active');

                // Close all other items
                faqItems.forEach(function(otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherAnswer = otherItem.querySelector('.faq-answer');
                        if (otherAnswer) {
                            otherAnswer.style.maxHeight = null;
                        }
                    }
                });

                // Toggle current item
                item.classList.toggle('active');

                if (!isActive) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                } else {
                    answer.style.maxHeight = null;
                }
            });
        });

        // Open first FAQ item by default
        const firstFaq = faqItems[0];
        if (firstFaq) {
            firstFaq.classList.add('active');
            const firstAnswer = firstFaq.querySelector('.faq-answer');
            if (firstAnswer) {
                firstAnswer.style.maxHeight = firstAnswer.scrollHeight + 'px';
            }
        }
    }

    /**
     * Scroll Animations
     */
    function initScrollAnimations() {
        const animateElements = document.querySelectorAll('[data-animate]');

        if (!animateElements.length) return;

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-delay') || 0;

                    setTimeout(function() {
                        entry.target.classList.add('animated');
                    }, parseInt(delay));

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        animateElements.forEach(function(element) {
            observer.observe(element);
        });

        // Add animation classes to sections
        const sections = document.querySelectorAll('.section');
        sections.forEach(function(section) {
            const sectionObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('section-visible');
                        sectionObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            sectionObserver.observe(section);
        });
    }

    /**
     * Scroll to Top Button
     */
    function initScrollToTop() {
        const scrollTopBtn = document.getElementById('scrollTop');
        if (!scrollTopBtn) return;

        let ticking = false;

        function updateScrollButton() {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateScrollButton);
                ticking = true;
            }
        }, { passive: true });

        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    /**
     * Counter Animation
     */
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.counter-number, [data-counter]');
        if (!counters.length) return;

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target') || counter.getAttribute('data-counter') || counter.textContent);
                    const duration = 2000;
                    const startTime = performance.now();

                    function updateCounter(currentTime) {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);

                        // Easing function
                        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                        const current = Math.floor(easeOutQuart * target);

                        counter.textContent = current;

                        if (progress < 1) {
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    }

                    requestAnimationFrame(updateCounter);
                    observer.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(function(counter) {
            observer.observe(counter);
        });
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        const anchors = document.querySelectorAll('a[href^="#"]:not([href="#"])');

        anchors.forEach(function(anchor) {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);

                if (target) {
                    e.preventDefault();
                    const header = document.getElementById('header');
                    const headerHeight = header ? header.offsetHeight : 0;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    /**
     * Form Validation
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('.contact-form, form[data-validate]');

        forms.forEach(function(form) {
            const inputs = form.querySelectorAll('input, textarea, select');

            // Real-time validation
            inputs.forEach(function(input) {
                input.addEventListener('blur', function() {
                    validateField(input);
                });

                input.addEventListener('input', function() {
                    if (input.classList.contains('error')) {
                        validateField(input);
                    }
                });
            });

            // Submit validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(function(field) {
                    if (!validateField(field)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = form.querySelector('.error');
                    if (firstError) {
                        firstError.focus();
                    }
                }
            });
        });

        function validateField(field) {
            const value = field.value.trim();
            const type = field.type;
            let isValid = true;

            // Remove existing error
            field.classList.remove('error');

            // Required check
            if (field.hasAttribute('required') && !value) {
                isValid = false;
            }

            // Email check
            if (type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                }
            }

            // Phone check
            if (type === 'tel' && value) {
                const phoneRegex = /^[\d\s\-\+\(\)]{7,20}$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                }
            }

            if (!isValid) {
                field.classList.add('error');
            }

            return isValid;
        }
    }

    /**
     * GLightbox - Image Gallery
     */
    function initLightbox() {
        if (typeof GLightbox !== 'undefined') {
            GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true,
                openEffect: 'zoom',
                closeEffect: 'fade',
                cssEf498: 'fade'
            });
        }
    }

    /**
     * Parallax Effect
     */
    function initParallaxEffect() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        if (!parallaxElements.length) return;

        let ticking = false;

        function updateParallax() {
            const scrollY = window.scrollY;

            parallaxElements.forEach(function(element) {
                const speed = parseFloat(element.getAttribute('data-parallax')) || 0.5;
                const rect = element.getBoundingClientRect();
                const visible = rect.top < window.innerHeight && rect.bottom > 0;

                if (visible) {
                    const yPos = -(scrollY * speed);
                    element.style.transform = 'translate3d(0, ' + yPos + 'px, 0)';
                }
            });

            ticking = false;
        }

        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * Utility Functions
     */

    // Throttle function
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(function() {
                    inThrottle = false;
                }, limit);
            }
        };
    }

    // Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

})();

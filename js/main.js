/**
 * File main.js.
 *
 * Handles JavaScript functionality for the theme using vanilla JS
 */
document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	// Elements
	const body = document.body;
	const menuToggle = document.querySelector('.menu-toggle');
	const mobileNav = document.getElementById('mobile-navigation');
	const closeButton = document.querySelector('.close-mobile-nav');

	// Toggle off-canvas mobile menu
	if (menuToggle) {
		menuToggle.addEventListener('click', function () {
			const expanded = this.getAttribute('aria-expanded') === 'true';
			this.setAttribute('aria-expanded', !expanded);

			// Open off-canvas navigation
			mobileNav.classList.add('active');
			body.classList.add('mobile-menu-open');
			mobileNav.setAttribute('aria-hidden', 'false');

			// Set focus to the first nav link after a brief delay to allow animation
			setTimeout(function () {
				const firstNavLink = mobileNav.querySelector('.mobile-menu li:first-child a');
				if (firstNavLink) {
					firstNavLink.focus();
				}
			}, 100);
		});
	}

	// Close mobile off-canvas menu
	if (closeButton) {
		closeButton.addEventListener('click', function () {
			mobileNav.classList.remove('active');
			body.classList.remove('mobile-menu-open');
			mobileNav.setAttribute('aria-hidden', 'true');

			// Update toggle button state
			if (menuToggle) {
				menuToggle.setAttribute('aria-expanded', 'false');
				// Return focus to the toggle button
				menuToggle.focus();
			}
		});
	}

	// Close mobile menu when clicking outside
	document.addEventListener('click', function (e) {
		if (body.classList.contains('mobile-menu-open') && !e.target.closest('#mobile-navigation') && !e.target.closest('.menu-toggle')) {
			mobileNav.classList.remove('active');
			body.classList.remove('mobile-menu-open');

			// Update toggle button state
			if (menuToggle) {
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		}
	});

	// Trap focus inside the modal when it's open
	document.addEventListener('keydown', function (e) {
		if (!body.classList.contains('mobile-menu-open')) return;

		// Only run if Tab is pressed
		if (e.key !== 'Tab') return;

		// Get all focusable elements inside the off-canvas menu
		const focusableElements = mobileNav.querySelectorAll('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
		const firstElement = focusableElements[0];
		const lastElement = focusableElements[focusableElements.length - 1];

		// If shift key pressed and focus on first item, move to last item
		if (e.shiftKey && document.activeElement === firstElement) {
			e.preventDefault();
			lastElement.focus();
		}

		// If focus on last item, move to first item
		else if (!e.shiftKey && document.activeElement === lastElement) {
			e.preventDefault();
			firstElement.focus();
		}
	});

	// Close on Escape key
	document.addEventListener('keydown', function (e) {
		if (body.classList.contains('mobile-menu-open') && e.key === 'Escape') {
			mobileNav.classList.remove('active');
			body.classList.remove('mobile-menu-open');
			mobileNav.setAttribute('aria-hidden', 'true');

			// Return focus to the toggle button
			if (menuToggle) {
				menuToggle.setAttribute('aria-expanded', 'false');
				menuToggle.focus();
			}
		}
	});
	const setupDropdowns = function (parentSelector) {
		const parentMenuItems = document.querySelectorAll(parentSelector);

		parentMenuItems.forEach(function (item) {
			// Create dropdown toggle button
			const toggleButton = document.createElement('button');
			toggleButton.className = 'dropdown-toggle';
			toggleButton.setAttribute('aria-expanded', 'false');

			const screenReaderText = document.createElement('span');
			screenReaderText.className = 'screen-reader-text';
			screenReaderText.textContent = 'Open submenu';

			toggleButton.appendChild(screenReaderText);
			item.appendChild(toggleButton);

			// Add click event
			toggleButton.addEventListener('click', function (e) {
				e.preventDefault();
				e.stopPropagation();

				const expanded = this.getAttribute('aria-expanded') === 'true';
				this.setAttribute('aria-expanded', !expanded);
				this.classList.toggle('toggled-on');

				const subMenu = item.nextElementSibling;
				if (subMenu && subMenu.classList.contains('sub-menu')) {
					if (subMenu.style.display === 'block') {
						slideUp(subMenu, 200);
					} else {
						slideDown(subMenu, 200);
					}
				}
			});
		});
	};

	// Setup dropdowns for both menus
	setupDropdowns('.mobile-navigation .menu-item-has-children > a');
	setupDropdowns('.desktop-menu-container .menu-item-has-children > a');

	// Slide animation helpers (vanilla JS replacement for jQuery slideToggle)
	function slideUp(element, duration) {
		element.style.height = element.offsetHeight + 'px';
		element.style.transitionProperty = 'height, margin, padding';
		element.style.transitionDuration = duration + 'ms';
		element.offsetHeight; // Trigger reflow
		element.style.overflow = 'hidden';
		element.style.height = 0;
		element.style.paddingTop = 0;
		element.style.paddingBottom = 0;
		element.style.marginTop = 0;
		element.style.marginBottom = 0;

		setTimeout(function () {
			element.style.display = 'none';
			element.style.removeProperty('height');
			element.style.removeProperty('padding-top');
			element.style.removeProperty('padding-bottom');
			element.style.removeProperty('margin-top');
			element.style.removeProperty('margin-bottom');
			element.style.removeProperty('overflow');
			element.style.removeProperty('transition-duration');
			element.style.removeProperty('transition-property');
		}, duration);
	}

	function slideDown(element, duration) {
		element.style.removeProperty('display');
		let display = window.getComputedStyle(element).display;
		if (display === 'none') display = 'block';
		element.style.display = display;

		const height = element.offsetHeight;
		element.style.overflow = 'hidden';
		element.style.height = 0;
		element.style.paddingTop = 0;
		element.style.paddingBottom = 0;
		element.style.marginTop = 0;
		element.style.marginBottom = 0;
		element.offsetHeight; // Trigger reflow

		element.style.transitionProperty = 'height, margin, padding';
		element.style.transitionDuration = duration + 'ms';
		element.style.height = height + 'px';
		element.style.removeProperty('padding-top');
		element.style.removeProperty('padding-bottom');
		element.style.removeProperty('margin-top');
		element.style.removeProperty('margin-bottom');

		setTimeout(function () {
			element.style.removeProperty('height');
			element.style.removeProperty('overflow');
			element.style.removeProperty('transition-duration');
			element.style.removeProperty('transition-property');
		}, duration);
	}
});

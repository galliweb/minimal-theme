/**
 * Harvard Web Publishing (HWP) style navigation script
 * Vanilla JavaScript version without jQuery dependency
 */
(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initMainMenuSubmenus();
		initSiteHeaderMenu();
	});

	function initMainMenuSubmenus() {
		// Helper function to close a submenu
		function closeSubmenu(submenuElement) {
			const parentItem = submenuElement.closest('.is-open');
			if (!parentItem) return;

			parentItem.classList.remove('is-open');
			parentItem.classList.remove('hwp-main-menu__list-submenu--reversed');
			const trigger = parentItem.querySelector('.js-hwp-main-menu__submenu-trigger');
			if (trigger) {
				trigger.setAttribute('aria-expanded', 'false');
			}
		}

		// Get all submenus
		const submenus = document.querySelectorAll('.hwp-main-menu__list-submenu');

		// Handle focus leaving a submenu
		submenus.forEach(submenu => {
			submenu.addEventListener('focusout', function (event) {
				if (!this.contains(event.relatedTarget)) {
					closeSubmenu(this);
				}
			});
		});

		// Close submenus with Escape key
		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				submenus.forEach(closeSubmenu);
			}
		});

		// Close submenus when clicking outside
		document.addEventListener('click', function (event) {
			if (!event.target.closest('.hwp-main-menu__item')) {
				submenus.forEach(closeSubmenu);
			}
		});

		// Handle submenu trigger clicks
		const triggers = document.querySelectorAll('.js-hwp-main-menu__submenu-trigger');
		triggers.forEach(trigger => {
			trigger.addEventListener('click', function () {
				const submenu = this.closest('.hwp-expanded-item--wrapper').nextElementSibling;
				const parentItem = this.closest('.hwp-main-menu__item--has-submenu');

				// Close all other open submenus
				document.querySelectorAll('.hwp-main-menu__item--has-submenu.is-open').forEach(item => {
					if (item !== parentItem) {
						item.classList.remove('is-open');
						item.classList.remove('hwp-main-menu__list-submenu--reversed');
						const itemTrigger = item.querySelector('.js-hwp-main-menu__submenu-trigger');
						if (itemTrigger) itemTrigger.setAttribute('aria-expanded', 'false');
					}
				});

				// Toggle current submenu
				if (parentItem.classList.contains('is-open')) {
					// Close submenu
					this.setAttribute('aria-expanded', 'false');
					parentItem.classList.remove('is-open');
					parentItem.classList.remove('hwp-main-menu__list-submenu--reversed');
				} else {
					// Open submenu
					this.setAttribute('aria-expanded', 'true');
					parentItem.classList.add('is-open');

					// Check for right edge overflow and reposition if necessary
					if (submenu && submenu.getBoundingClientRect().right > window.innerWidth) {
						submenu.classList.add('hwp-main-menu__list-submenu--reversed');
					}
				}
			});
		});
	}

	function initSiteHeaderMenu() {
		const menuTrigger = document.querySelector('.js-header-site__menu-trigger');
		if (!menuTrigger) return;

		function closeMenu() {
			document.body.classList.remove('body--header-site-menu-open');
			menuTrigger.setAttribute('aria-expanded', 'false');
			menuTrigger.querySelector('div').textContent = 'Menu';
		}

		menuTrigger.addEventListener('click', function () {
			if (document.body.classList.contains('body--header-site-menu-open')) {
				closeMenu();
			} else {
				document.body.classList.add('body--header-site-menu-open');
				this.setAttribute('aria-expanded', 'true');
				this.querySelector('div').textContent = 'Close';

				// Set up keyboard trap for accessibility
				const menu = document.querySelector('.hwp-main-menu');
				if (menu) {
					const focusableElements = menu.querySelectorAll(
						'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])'
					);

					if (focusableElements.length) {
						const firstElement = focusableElements[0];
						const lastElements = [];

						// Find the last focusable element
						const lastElement = focusableElements[focusableElements.length - 1];
						const parentSubmenu = lastElement.closest('.hwp-main-menu__item--has-submenu');

						if (parentSubmenu) {
							const submenuTrigger = parentSubmenu.querySelector('.hwp-main-menu__submenu-trigger');
							if (submenuTrigger) {
								lastElements.unshift(submenuTrigger);
							}
						}

						lastElements.push(lastElement);

						// Set keyboard trap
						menu.addEventListener('keydown', function (event) {
							if (event.key === 'Tab' || event.keyCode === 9) {
								if (event.shiftKey) {
									// Shift + Tab: If focus is on first element, move to last
									if (document.activeElement === firstElement) {
										lastElements[0].focus();
										event.preventDefault();
									}
								} else {
									// Tab: If focus is on last element, move to first
									if (lastElements.includes(document.activeElement)) {
										if (document.activeElement === lastElements[0]) {
											const parentItem = parentSubmenu || null;
											if (parentItem && !parentItem.classList.contains('is-open')) {
												firstElement.focus();
												event.preventDefault();
											}
										} else {
											firstElement.focus();
											event.preventDefault();
										}
									}
								}
							}
						});
					}
				}
			}
		});

		// Close menu on resize
		let resizeTimeout;
		window.addEventListener('resize', function () {
			clearTimeout(resizeTimeout);
			resizeTimeout = setTimeout(closeMenu, 150);
		});
	}
})();
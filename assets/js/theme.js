/* global IntersectionObserver, ResizeObserver */
/**
 * Latvijai Futura theme interactions.
 */
(function () {
	'use strict';

	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var finePointer = window.matchMedia('(pointer: fine)').matches;

	function ready(fn) {
		if (document.readyState !== 'loading') {
			fn();
		} else {
			document.addEventListener('DOMContentLoaded', fn);
		}
	}

	/* Current foreground colour channels, kept in sync with the colour scheme
	 * so canvas effects (particles) match light and dark mode. */
	var fgRgb = '244,241,234';

	function readFgRgb() {
		var value = window.getComputedStyle(document.documentElement).getPropertyValue('--fg-rgb');
		fgRgb = value ? value.replace(/\s+/g, '') : '244,241,234';
	}

	ready(function () {
		readFgRgb();
		initThemeToggle();
		initHeader();
		initClock();
		initMobileMenu();
		initSearch();
		initReveal();
		initCounters();
		initParticles();
		initHeroGlow();
		initTilt();
		initCopy();
		initProgress();
		initBackToTop();
		initPreloader();
	});

	// Elementor redaktors pārzīmē logrīkus — ļauj atkārtoti palaist animācijas.
	window.LatvijaiFutura = {
		refresh: function () {
			initReveal();
			initCounters();
			initParticles();
			initHeroGlow();
			initTilt();
		}
	};

	/* ------------------------------------------------------------------
	 * Light / dark colour scheme switch
	 * ------------------------------------------------------------------ */
	function initThemeToggle() {
		var root = document.documentElement;
		var prefersLight = window.matchMedia('(prefers-color-scheme: light)');
		var buttons = document.querySelectorAll('[data-theme-toggle]');

		function effective() {
			var theme = root.getAttribute('data-theme');
			if (theme === 'auto') {
				return prefersLight.matches ? 'light' : 'dark';
			}
			return theme === 'light' ? 'light' : 'dark';
		}

		function sync() {
			var isLight = effective() === 'light';
			readFgRgb();
			Array.prototype.forEach.call(buttons, function (button) {
				button.setAttribute('aria-pressed', isLight ? 'true' : 'false');
			});
		}

		Array.prototype.forEach.call(buttons, function (button) {
			button.addEventListener('click', function () {
				var next = effective() === 'light' ? 'dark' : 'light';
				root.setAttribute('data-theme', next);
				try {
					window.localStorage.setItem('latvijai-theme', next);
				} catch (e) {
					/* Storage may be unavailable (private mode); the switch still works for this page. */
				}
				sync();
			});
		});

		if (prefersLight.addEventListener) {
			prefersLight.addEventListener('change', sync);
		}

		sync();
	}

	/* ------------------------------------------------------------------
	 * Header state
	 * ------------------------------------------------------------------ */
	function initHeader() {
		var header = document.querySelector('[data-header]');
		if (!header) {
			return;
		}

		var update = function () {
			header.classList.toggle('is-scrolled', window.scrollY > 16);
		};

		update();
		window.addEventListener('scroll', update, { passive: true });
	}

	/* ------------------------------------------------------------------
	 * Riga clock
	 * ------------------------------------------------------------------ */
	function initClock() {
		var nodes = document.querySelectorAll('[data-riga-time]');
		if (!nodes.length) {
			return;
		}

		var formatter;
		try {
			formatter = new Intl.DateTimeFormat('lv-LV', {
				timeZone: 'Europe/Riga',
				hour: '2-digit',
				minute: '2-digit',
				hour12: false
			});
		} catch (error) {
			formatter = null;
		}

		var tick = function () {
			var now = new Date();
			var value;
			try {
				value = formatter ? formatter.format(now) : now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
			} catch (error) {
				value = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
			}
			nodes.forEach(function (node) {
				node.textContent = value;
			});
		};

		tick();
		window.setInterval(tick, 15000);
	}

	/* ------------------------------------------------------------------
	 * Mobile navigation
	 * ------------------------------------------------------------------ */
	function initMobileMenu() {
		var toggle = document.querySelector('[data-menu-toggle]');
		var panel = document.querySelector('[data-mobile-panel]');
		if (!toggle || !panel) {
			return;
		}

		var lastFocus = null;

		function open() {
			lastFocus = document.activeElement;
			panel.classList.add('is-open');
			panel.removeAttribute('inert');
			panel.setAttribute('aria-hidden', 'false');
			toggle.setAttribute('aria-expanded', 'true');
			toggle.setAttribute('aria-label', 'Aizvērt izvēlni');
			document.body.classList.add('nav-open');

			var firstLink = panel.querySelector('a, button');
			if (firstLink) {
				window.setTimeout(function () {
					firstLink.focus();
				}, 60);
			}
		}

		function close(returnFocus) {
			panel.classList.remove('is-open');
			panel.setAttribute('inert', '');
			panel.setAttribute('aria-hidden', 'true');
			toggle.setAttribute('aria-expanded', 'false');
			toggle.setAttribute('aria-label', 'Atvērt izvēlni');
			document.body.classList.remove('nav-open');

			if (returnFocus !== false && lastFocus) {
				lastFocus.focus();
			}
		}

		toggle.addEventListener('click', function () {
			if (panel.classList.contains('is-open')) {
				close();
			} else {
				open();
			}
		});

		panel.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				close();
			}
			trapFocus(panel, event);
		});

		panel.addEventListener('click', function (event) {
			if (event.target.closest('a')) {
				close(false);
			}
		});

		window.addEventListener('resize', function () {
			if (window.innerWidth > 1080 && panel.classList.contains('is-open')) {
				close(false);
			}
		});
	}

	/* ------------------------------------------------------------------
	 * Search overlay
	 * ------------------------------------------------------------------ */
	function initSearch() {
		var overlay = document.querySelector('[data-search-overlay]');
		var openBtn = document.querySelector('[data-search-open]');
		var closeBtn = document.querySelector('[data-search-close]');
		if (!overlay || !openBtn) {
			return;
		}

		var input = overlay.querySelector('input[type="search"]');
		var lastFocus = null;

		function open() {
			lastFocus = document.activeElement;

			if (document.body.classList.contains('nav-open')) {
				var menuToggle = document.querySelector('[data-menu-toggle]');
				if (menuToggle) {
					menuToggle.click();
				}
			}

			overlay.classList.add('is-open');
			overlay.removeAttribute('inert');
			overlay.setAttribute('aria-hidden', 'false');
			openBtn.setAttribute('aria-expanded', 'true');
			document.body.classList.add('search-open');

			window.setTimeout(function () {
				if (input) {
					input.focus();
					input.select();
				}
			}, 120);
		}

		function close() {
			overlay.classList.remove('is-open');
			overlay.setAttribute('inert', '');
			overlay.setAttribute('aria-hidden', 'true');
			openBtn.setAttribute('aria-expanded', 'false');
			document.body.classList.remove('search-open');

			if (lastFocus) {
				lastFocus.focus();
			}
		}

		openBtn.addEventListener('click', open);

		if (closeBtn) {
			closeBtn.addEventListener('click', close);
		}

		overlay.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				close();
			}
			trapFocus(overlay, event);
		});

		overlay.addEventListener('click', function (event) {
			if (event.target === overlay) {
				close();
			}
		});
	}

	/* ------------------------------------------------------------------
	 * Scroll reveals
	 * ------------------------------------------------------------------ */
	function initReveal() {
		var items = document.querySelectorAll('.reveal');
		if (!items.length) {
			return;
		}

		if (reduceMotion || !('IntersectionObserver' in window)) {
			items.forEach(function (item) {
				item.classList.add('is-visible');
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-visible');
						observer.unobserve(entry.target);
					}
				});
			},
			{
				threshold: 0.12,
				rootMargin: '0px 0px -40px 0px'
			}
		);

		items.forEach(function (item) {
			observer.observe(item);
		});
	}

	/* ------------------------------------------------------------------
	 * Animated number counters
	 * ------------------------------------------------------------------ */
	function initCounters() {
		// Elementor virsraksta logrīks: skaitlis ir .stat-number iekšējā elementā.
		document.querySelectorAll('.stat-number:not([data-count]) .elementor-heading-title').forEach(function (node) {
			var text = node.textContent.trim();
			if (/^\d+$/.test(text) && !node.hasAttribute('data-count')) {
				node.setAttribute('data-count', text);
				node.textContent = '0';
			}
		});

		var counters = document.querySelectorAll('[data-count]');
		if (!counters.length) {
			return;
		}

		var animate = function (node) {
			var target = parseInt(node.getAttribute('data-count'), 10) || 0;
			var duration = reduceMotion ? 0 : 1500;
			var start = null;

			if (!duration) {
				node.textContent = target.toLocaleString('lv-LV');
				return;
			}

			var step = function (timestamp) {
				if (start === null) {
					start = timestamp;
				}
				var progress = Math.min((timestamp - start) / duration, 1);
				var eased = 1 - Math.pow(1 - progress, 3);
				node.textContent = Math.round(target * eased).toLocaleString('lv-LV');

				if (progress < 1) {
					window.requestAnimationFrame(step);
				}
			};

			window.requestAnimationFrame(step);
		};

		if (!('IntersectionObserver' in window)) {
			counters.forEach(animate);
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						animate(entry.target);
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.5 }
		);

		counters.forEach(function (counter) {
			observer.observe(counter);
		});
	}

	/* ------------------------------------------------------------------
	 * Hero particle constellation
	 * ------------------------------------------------------------------ */
	function initParticles() {
		var canvas = document.querySelector('[data-particles]');
		if (!canvas) {
			return;
		}

		var context = canvas.getContext('2d');
		if (!context) {
			return;
		}

		var particles = [];
		var width = 0;
		var height = 0;
		var dpr = Math.min(window.devicePixelRatio || 1, 2);
		var frame = null;
		var visible = true;

		function resize() {
			var rect = canvas.getBoundingClientRect();
			width = rect.width;
			height = rect.height;
			canvas.width = Math.round(width * dpr);
			canvas.height = Math.round(height * dpr);
			context.setTransform(dpr, 0, 0, dpr, 0, 0);

			var count = Math.min(74, Math.max(26, Math.floor(width / 20)));
			particles = [];

			for (var i = 0; i < count; i++) {
				particles.push({
					x: Math.random() * width,
					y: Math.random() * height,
					vx: (Math.random() - 0.5) * 0.22,
					vy: (Math.random() - 0.5) * 0.22,
					r: Math.random() * 1.5 + 0.6,
					red: Math.random() > 0.76
				});
			}

			if (reduceMotion) {
				draw(true);
			}
		}

		function draw(staticFrame) {
			context.clearRect(0, 0, width, height);

			var i;
			var j;
			var a;
			var b;
			var dx;
			var dy;
			var distance;
			var limit = 130;

			for (i = 0; i < particles.length; i++) {
				a = particles[i];

				if (!staticFrame) {
					a.x += a.vx;
					a.y += a.vy;

					if (a.x < -10) {
						a.x = width + 10;
					}
					if (a.x > width + 10) {
						a.x = -10;
					}
					if (a.y < -10) {
						a.y = height + 10;
					}
					if (a.y > height + 10) {
						a.y = -10;
					}
				}

				for (j = i + 1; j < particles.length; j++) {
					b = particles[j];
					dx = a.x - b.x;
					dy = a.y - b.y;
					distance = Math.sqrt(dx * dx + dy * dy);

					if (distance < limit) {
						context.beginPath();
						context.strokeStyle = 'rgba(' + fgRgb + ',' + (0.08 * (1 - distance / limit)).toFixed(3) + ')';
						context.lineWidth = 1;
						context.moveTo(a.x, a.y);
						context.lineTo(b.x, b.y);
						context.stroke();
					}
				}

				context.beginPath();
				context.fillStyle = a.red ? 'rgba(225,29,63,0.75)' : 'rgba(' + fgRgb + ',0.42)';
				context.arc(a.x, a.y, a.r, 0, Math.PI * 2);
				context.fill();

				if (a.red) {
					context.beginPath();
					context.fillStyle = 'rgba(225,29,63,0.12)';
					context.arc(a.x, a.y, a.r * 4, 0, Math.PI * 2);
					context.fill();
				}
			}
		}

		function loop() {
			if (visible) {
				draw(false);
			}
			frame = window.requestAnimationFrame(loop);
		}

		resize();

		if (!reduceMotion) {
			loop();
		}

		var resizeTimer;
		window.addEventListener('resize', function () {
			window.clearTimeout(resizeTimer);
			resizeTimer = window.setTimeout(resize, 180);
		});

		if ('IntersectionObserver' in window) {
			var observer = new IntersectionObserver(function (entries) {
				visible = entries[0].isIntersecting;
			});
			observer.observe(canvas);
		}

		document.addEventListener('visibilitychange', function () {
			if (document.hidden && frame) {
				window.cancelAnimationFrame(frame);
				frame = null;
			} else if (!document.hidden && !reduceMotion && !frame) {
				loop();
			}
		});
	}

	/* ------------------------------------------------------------------
	 * Hero cursor glow
	 * ------------------------------------------------------------------ */
	function initHeroGlow() {
		var hero = document.querySelector('[data-hero]') || document.querySelector('.hero');
		if (!hero || reduceMotion || !finePointer) {
			return;
		}

		var pending = false;
		var lastEvent = null;

		function apply() {
			pending = false;
			if (!lastEvent) {
				return;
			}
			var rect = hero.getBoundingClientRect();
			var x = ((lastEvent.clientX - rect.left) / rect.width) * 100;
			var y = ((lastEvent.clientY - rect.top) / rect.height) * 100;
			hero.style.setProperty('--mx', x.toFixed(2) + '%');
			hero.style.setProperty('--my', y.toFixed(2) + '%');
		}

		hero.addEventListener('pointermove', function (event) {
			lastEvent = event;
			if (!pending) {
				pending = true;
				window.requestAnimationFrame(apply);
			}
		});
	}

	/* ------------------------------------------------------------------
	 * Card tilt
	 * ------------------------------------------------------------------ */
	function initTilt() {
		if (reduceMotion || !finePointer) {
			return;
		}

		document.querySelectorAll('.tilt').forEach(function (card) {
			var frame = null;
			var event = null;

			function apply() {
				frame = null;
				if (!event) {
					return;
				}
				var rect = card.getBoundingClientRect();
				var px = (event.clientX - rect.left) / rect.width;
				var py = (event.clientY - rect.top) / rect.height;
				var rx = (0.5 - py) * 7;
				var ry = (px - 0.5) * 7;

				card.style.transform = 'perspective(900px) rotateX(' + rx.toFixed(2) + 'deg) rotateY(' + ry.toFixed(2) + 'deg) translateY(-4px)';
				card.style.setProperty('--gx', (px * 100).toFixed(1) + '%');
				card.style.setProperty('--gy', (py * 100).toFixed(1) + '%');
			}

			card.addEventListener('pointermove', function (pointerEvent) {
				event = pointerEvent;
				if (!frame) {
					frame = window.requestAnimationFrame(apply);
				}
			});

			card.addEventListener('pointerleave', function () {
				event = null;
				if (frame) {
					window.cancelAnimationFrame(frame);
					frame = null;
				}
				card.style.transform = '';
				card.style.removeProperty('--gx');
				card.style.removeProperty('--gy');
			});
		});
	}

	/* ------------------------------------------------------------------
	 * Copy-to-clipboard buttons
	 * ------------------------------------------------------------------ */
	function initCopy() {
		var buttons = document.querySelectorAll('[data-copy-url]');
		if (!buttons.length) {
			return;
		}

		buttons.forEach(function (button) {
			var original = button.innerHTML;
			var timer = null;

			function fallbackCopy(value) {
				var input = document.createElement('textarea');
				input.value = value;
				input.setAttribute('readonly', '');
				input.style.position = 'fixed';
				input.style.opacity = '0';
				document.body.appendChild(input);
				input.select();
				try {
					document.execCommand('copy');
				} catch (error) {
					/* noop */
				}
				document.body.removeChild(input);
			}

			function success() {
				var copied = button.getAttribute('data-copied-label') || 'Nokopēts';
				button.classList.add('is-copied');
				button.innerHTML = '<span>' + copied + '</span>';
				window.clearTimeout(timer);
				timer = window.setTimeout(function () {
					button.classList.remove('is-copied');
					button.innerHTML = original;
				}, 2200);
			}

			button.addEventListener('click', function () {
				var value = button.getAttribute('data-copy-url');
				if (!value) {
					return;
				}

				if (navigator.clipboard && window.isSecureContext) {
					navigator.clipboard.writeText(value).then(success).catch(function () {
						fallbackCopy(value);
						success();
					});
				} else {
					fallbackCopy(value);
					success();
				}
			});
		});
	}

	/* ------------------------------------------------------------------
	 * Reading progress
	 * ------------------------------------------------------------------ */
	function initProgress() {
		var progress = document.querySelector('[data-progress] span');
		if (!progress) {
			return;
		}

		var update = function () {
			var height = document.documentElement.scrollHeight - window.innerHeight;
			var ratio = height > 0 ? window.scrollY / height : 0;
			progress.style.width = Math.min(100, Math.max(0, ratio * 100)) + '%';
		};

		update();
		window.addEventListener('scroll', update, { passive: true });
		window.addEventListener('resize', update);
	}

	/* ------------------------------------------------------------------
	 * Back to top
	 * ------------------------------------------------------------------ */
	function initBackToTop() {
		var button = document.querySelector('[data-to-top]');
		if (!button) {
			return;
		}

		var update = function () {
			button.classList.toggle('is-visible', window.scrollY > 700);
		};

		update();
		window.addEventListener('scroll', update, { passive: true });

		button.addEventListener('click', function () {
			window.scrollTo({
				top: 0,
				behavior: reduceMotion ? 'auto' : 'smooth'
			});
		});
	}

	/* ------------------------------------------------------------------
	 * Preloader
	 * ------------------------------------------------------------------ */
	function initPreloader() {
		var preloader = document.getElementById('preloader');
		if (!preloader) {
			return;
		}

		var minDuration = 800;
		try {
			var duration = parseInt(preloader.dataset.duration, 10);
			if (!isNaN(duration)) {
				minDuration = duration;
			}
		} catch (error) {
			// ignore
		}

		var startTime = Date.now();

		var hide = function () {
			var elapsed = Date.now() - startTime;
			var remaining = minDuration - elapsed;
			if (remaining > 0) {
				setTimeout(hide, remaining);
				return;
			}
			preloader.classList.add('is-hidden');
			// Remove from DOM after transition
			setTimeout(function () {
				if (preloader.parentNode) {
					preloader.parentNode.removeChild(preloader);
				}
			}, 600);
		};

		if (document.readyState === 'complete') {
			hide();
		} else {
			window.addEventListener('load', hide);
		}
	}

	/* ------------------------------------------------------------------
	 * Focus trap helper
	 * ------------------------------------------------------------------ */
	function trapFocus(container, event) {
		if (event.key !== 'Tab') {
			return;
		}

		var focusable = container.querySelectorAll(
			'a[href], button:not([disabled]), input:not([disabled]), textarea:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])'
		);

		if (!focusable.length) {
			return;
		}

		var first = focusable[0];
		var last = focusable[focusable.length - 1];

		if (event.shiftKey && document.activeElement === first) {
			event.preventDefault();
			last.focus();
		} else if (!event.shiftKey && document.activeElement === last) {
			event.preventDefault();
			first.focus();
		}
	}
})();

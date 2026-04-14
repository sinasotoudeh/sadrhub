# Sadrhub — WordPress as middleware

[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759B?style=flat-square&logo=wordpress)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=flat-square&logo=php)](https://php.net)
[![CSS3](https://img.shields.io/badge/CSS3-Modern-1572B6?style=flat-square&logo=css3)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=flat-square&logo=javascript)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

A production-ready WordPress theme built as a SaaS landing page and user portal. The theme handles the full user journey — from a marketing landing page to OTP-based registration, profile management, and store creation — all integrated with an external SaaS API while using WordPress purely as a rendering and routing layer.

---

## ✨ Key Features

- 🎨 **HSL-based design token system** — entire color palette derived from a single CSS variable
- 🔐 **OTP-based auth** — full registration and login flow with no WordPress user accounts
- 🌐 **WordPress as middleware** — routing, rendering, and secure API proxy in one layer
- ⚡ **Performance-first CSS** — GPU-promoted animations, `will-change`, and zero-breakpoint responsive grids
- 🧩 **Modular JS architecture** — each feature isolated in its own `init` function, no bundler required
- 🔄 **BFF session bridging** — cookie proxy pattern for seamless server-to-server auth forwarding
- 🏗️ **Multi-step store creation wizard** — debounced domain check, sequential Lottie animations, async polling
- 🛡️ **CSRF protection on every AJAX handler** — nonce verification as the first operation
- 📱 **Mobile-first UX details** — `inputmode="numeric"`, OTP paste handling, RTL-aware input ordering
- 🔁 **Seamless infinite scroll** — clone-based marquee with zero visual jump

---

## 📋 Table of Contents

- [✨ Key Features](#-key-features)
- [🗺️ Overview](#️-overview)
- [📁 Project Structure](#-project-structure)
- [🚀 Installation](#-installation)
- [📄 Shortcodes & Usage](#-shortcodes--usage)
- [🏛️ Architecture & Code Quality](#️-architecture--code-quality)
  - [🎨 CSS Architecture](#-css-architecture)
  - [⚙️ JavaScript Patterns](#️-javascript-patterns)
  - [🔐 PHP & WordPress Integration](#-php--wordpress-integration)
  - [🔑 Auth & Profile System](#-auth--profile-system)
  - [🏗️ Store Creation Flow](#️-store-creation-flow)
- [👤 Author](#-author)

---

## 🗺️ Overview

Sadrhub is organized as a single WordPress theme that serves three distinct purposes:

- **Landing page** (`front-page.php`) — a fully animated, responsive marketing page
- **Auth system** (`page-register.php` + `js/auth.js`) — OTP-based registration and login with no WordPress user accounts
- **User portal** (`page-profile.php`, `page-create.php`) — store management dashboard integrated with an external SaaS API

WordPress is used as a middleware layer: it handles routing, template rendering, and acts as a secure proxy between the browser and the external API. All business logic, authentication, and data live outside WordPress.

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

## 📁 Project Structure

```text
sadrhub/
├── style.css              # Theme declaration + all styles
├── functions.php          # Asset enqueuing, AJAX handlers, auth hooks
│
├── header.php
├── footer.php
│
├── front-page.php         # Landing page template
├── page.php               # Default page template
├── page-register.php      # OTP registration/login template
├── page-create.php        # Store creation wizard template
├── page-profile.php       # User profile & store list template
├── index.php
├── single.php             # Blog post template
├── blog-category.php      # Blog category template
│
├── landing.js
│
├── js/
│   ├── auth.js
│   ├── create-store.js
│   ├── profile.js
│   ├── blog-category.js
│   ├── single-post.js
│   └── lottie-player.js
│
├── css/                   # Blog and category styles
│
├── assets/                # Theme images & Lottie animations
│   ├── badges/
│   └── testimonials/
│
├── fonts/                 # PeydaWeb font family
├── icons/                 # Remixicon icon font
└── aos/                   # AOS scroll animation library
```

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

## 🚀 Installation

1. Upload the `sadrhub` folder to `/wp-content/themes/`
2. Activate the theme from **Appearance → Themes**
3. Create the following pages and assign their templates:
   - **Home** → `Sadrhub Front` template
   - **Register / Login** → `page-register.php` template
   - **Profile** → `page-profile.php` template
   - **Create Store** → `page-create.php` template
4. Set **Home** as the static front page under **Settings → Reading**

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

## 📄 Usage

Page templates are assigned directly via the WordPress template hierarchy. Each template self-manages its own asset loading and access control.

| Template            | Slug         | Access                               |
| ------------------- | ------------ | ------------------------------------ |
| `front-page.php`    | `/`          | Public                               |
| `page-register.php` | `/register/` | Guests only (redirects if logged in) |
| `page-profile.php`  | `/profile/`  | Auth required                        |
| `page-create.php`   | `/create/`   | Auth required                        |

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

## 🏛️ Architecture & Code Quality

This section documents the technical decisions and patterns used throughout the codebase.

---

### 🎨 CSS Architecture

The CSS architecture is built upon a highly scalable, performance-first foundation utilizing a centralized HSL-based design token system for dynamic theming and root-level variables for fluid, breakpoint-free responsive typography. To ensure optimal rendering performance, the architecture heavily relies on GPU-promoted animations via `will-change`, context-aware positioning, and complex CSS-only UI components such as gradient borders using `padding-box` techniques and seamless, mathematical infinite scrolling (e.g., precise transforms utilizing calculated values like $1600\text{px}$). Layouts are handled through modern CSS Grid features like `auto-fit` and `minmax` to eliminate unnecessary media queries, while strict variable-based z-index management and compound transforms ensure a robust, maintainable, and visually sophisticated presentation layer devoid of layout reflow bottlenecks.

<details>
<summary>🎨 HSL-based Design Token System</summary>

The entire color palette is derived from a single `--hue-color` variable:

```css
--hue-color: 250;
--first-color: hsl(var(--hue-color), 96%, 60%);
--first-color-alt: hsl(var(--hue-color), 96%, 50%);
--first-color-light: hsl(var(--hue-color), 96%, 95%);
```

Changing `--hue-color` propagates through the entire theme. This is the same approach used in design systems like Material and Radix.

</details>

<details>
<summary>📐 Responsive Typography via CSS Variable Override</summary>

Instead of writing dozens of `font-size` overrides per breakpoint, variables are overridden once at the `:root` level:

```css
:root {
  --h1-font-size: 2rem;
}

@media screen and (min-width: 968px) {
  :root {
    --h1-font-size: 2.5rem;
  }
}
```

Every element using `var(--h1-font-size)` updates automatically.

</details>

<details>
<summary>📦 Z-index Management</summary>

```css
--z-tooltip: 10;
--z-fixed: 100;
--z-modal: 1000;
```

Stacking context is managed through variables, eliminating the z-index chaos that accumulates in large projects.

</details>

<details>
<summary>✨ Gradient Text</summary>

```css
.gradient-text {
  background: var(--text-gradient);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  display: inline-block;
}
```

Both the vendor-prefixed and standard `background-clip` are declared. `display: inline-block` is required because `background-clip: text` does not work correctly on `inline` elements — an easy-to-miss browser edge case.

</details>

<details>
<summary>🪟 Glassmorphism Header</summary>

```css
.header.scroll-header {
  background-color: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(12px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}
```

`backdrop-filter` is only activated after scroll via a JS class toggle — not on initial load. This is a deliberate performance decision since `backdrop-filter` on fixed elements has a non-trivial rendering cost.

</details>

<details>
<summary>🖼️ 3D Hero Image</summary>

```css
.hero__image-wrapper {
  perspective: 1000px;
}

.hero__img {
  transform: rotateY(-10deg) rotateX(5deg);
  transition: transform 0.5s ease;
}

.hero__container:hover .hero__img {
  transform: rotateY(0) rotateX(0);
}
```

The hover is placed on the parent container, not the image itself. This keeps the transition smooth even when the cursor exits the image boundary.

</details>

<details>
<summary>🎬 Staggered Entrance Animation</summary>

```css
.hero__title {
  animation: fadeInUp 0.6s ease-out 0.1s backwards;
}
.hero__description {
  animation: fadeInUp 0.6s ease-out 0.2s backwards;
}
```

The `backwards` fill-mode keeps elements in their `from` state during the delay period. Without it, elements would flash visible before the animation starts.

</details>

<details>
<summary>📱 Responsive Grid Without Media Queries</summary>

```css
.about__grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}
```

`auto-fit` combined with `minmax` creates a fully responsive grid with zero breakpoints.

</details>

<details>
<summary>↔️ Zigzag Layout via nth-child + order</summary>

```css
.feature__item:nth-child(even) .feature__content {
  order: 2;
}
.feature__item:nth-child(even) .feature__image {
  order: 1;
}
```

Alternating image/text layout is handled entirely in CSS. No extra HTML classes needed per item.

</details>

<details>
<summary>⚡ GPU Optimization for Animated Blobs</summary>

```css
.gradient-blob {
  will-change: transform;
  filter: blur(60px);
  animation-timing-function: ease-in-out;
}
```

`will-change: transform` promotes the element to its own GPU layer. This is important here because `filter: blur(60px)` is one of the most expensive CSS properties to paint.

</details>

<details>
<summary>🌈 Gradient Border with padding-box / border-box</summary>

```css
.auth-box {
  border: 3px solid transparent;
  background:
    linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9))
      padding-box,
    linear-gradient(90deg, #4f46e5 0%, #e11d48 100%) border-box;
}
```

Two background layers: the first covers only the padding area, the second covers the full border box. Since the border is `transparent`, the gradient shows through. This is the only native CSS approach for gradient borders that also supports `border-radius`.

</details>

<details>
<summary>🔲 Pseudo-element Gradient Border (Alternative)</summary>

```css
.free-offer .pricing__card::before {
  content: "";
  position: absolute;
  inset: 0;
  z-index: -1;
  margin: -3px;
  border-radius: inherit;
  background: linear-gradient(135deg, #6cf377 0%, #ffffff 50%, #da0000 100%);
}
```

`border-image` does not work with `border-radius`, so a `::before` pseudo-element is used instead. `margin: -3px` matches the border width exactly. `border-radius: inherit` copies the radius from the parent. `inset: 0` is the modern shorthand for `top: 0; right: 0; bottom: 0; left: 0`.

</details>

<details>
<summary>🔘 CSS-only Toggle Switch</summary>

```css
.toggle__input {
  opacity: 0;
  width: 0;
  height: 0;
}

.toggle__input:checked + .toggle__slider {
  background-color: var(--first-color);
}

.toggle__input:checked + .toggle__slider:before {
  transform: translateX(22px);
}
```

The adjacent sibling selector (`+`) drives the toggle state from a hidden checkbox. `opacity: 0` is used instead of `display: none` so the element remains in the DOM and is clickable.

</details>

<details>
<summary>🔁 Seamless Infinite Scroll</summary>

```css
.partners__track {
  display: flex;
  width: calc(200px * 16);
  animation: scroll 30s linear infinite;
}

@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(calc(-200px * 8));
  }
}
```

The track contains 16 items (8 originals + 8 clones). The animation moves exactly half the total width — $200 \times 8 = 1600\text{px}$ — so when it resets, the visual position is identical and no jump occurs.

</details>

<details>
<summary>🌫️ Theme-aware Fade Edges</summary>

```css
.partners__slider::before {
  background: linear-gradient(to right, var(--body-color), transparent);
}
.partners__slider::after {
  background: linear-gradient(to left, var(--body-color), transparent);
}
```

`var(--body-color)` is used instead of a hardcoded color. If the theme changes, the fade edges update automatically.

</details>

<details>
<summary>🔽 Animated Dropdown with opacity + visibility + transform</summary>

```css
.custom-options {
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: all 0.3s ease;
}
.custom-select-wrapper.open .custom-options {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
```

`display: none` cannot be animated. `opacity: 0` alone leaves the element clickable. `visibility: hidden` disables pointer events. `transform: translateY` adds the slide effect. This three-property combination is the standard pattern for accessible animated dropdowns.

</details>

<details>
<summary>✨ Shine Effect Timing Trick</summary>

```css
@keyframes shine {
  0% {
    left: -150%;
  }
  20% {
    left: 150%;
  }
  100% {
    left: 150%;
  }
}
```

The element moves from `0%` to `20%` of the animation duration, then holds position for the remaining `80%`. This creates a natural pause between shine passes without needing multiple animations. `pointer-events: none` ensures the overlay does not interfere with clicks.

</details>

<details>
<summary>💳 Pricing Card Hover — Compound Transform</summary>

```css
.pricing__card--popular {
  transform: scale(1.05);
}

.pricing__card--popular:hover {
  transform: scale(1.05) translateY(-5px);
}
```

Both `scale` and `translateY` are declared together on hover. Writing only `translateY(-5px)` would override and remove the `scale(1.05)` — a common mistake that is correctly handled here.

</details>

<details>
<summary>⬆️ Scroll-top Context-aware Positioning</summary>

```css
.scroll-top {
  bottom: -20%;
}
.show-scroll {
  bottom: 2rem;
}

@media screen and (max-width: 768px) {
  .show-scroll {
    bottom: 5rem;
  }
}
```

Position-based show/hide instead of `display: none` enables CSS transitions. On mobile, `bottom` is increased to avoid overlapping the floating CTA button.

</details>

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

### ⚙️ JavaScript Patterns

The JavaScript ecosystem of the theme eschews heavy module bundlers in favor of a lightweight, highly modular `init` function pattern that enforces strict separation of concerns and utilizes defensive guard clauses for fail-safe execution. Performance and accessibility are prioritized through the implementation of native browser APIs, such as `IntersectionObserver` for efficient, non-blocking scroll tracking, and `requestAnimationFrame` for buttery-smooth $60\text{fps}$ UI updates derived from precise frame-rate mathematics (e.g., calculating durations via $\lfloor 1500 / 16 \rfloor \approx 94$ frames). Furthermore, the codebase demonstrates a deep understanding of DOM mechanics and WCAG standards by employing precise event delegation paradigms (`e.target` versus `e.currentTarget`), stateful CSS-driven animations via dynamic `scrollHeight` calculations, and comprehensive keyboard navigation fallbacks.

<details>
<summary>🧩 Init Function Pattern</summary>

```js
document.addEventListener("DOMContentLoaded", () => {
  initMobileMenu();
  initHeaderScroll();
  initPricingToggle();
  initScrollTop();
  // ...
});
```

Each feature is isolated in its own function. This simulates separation of concerns without a module bundler.

</details>

<details>
<summary>🛡️ Defensive Guard Clauses</summary>

```js
const initPricingToggle = () => {
  if (!toggleInput) return;
};
```

Early returns prevent null reference errors and keep functions flat and readable.

</details>

<details>
<summary>👁️ IntersectionObserver for Counter Animation</summary>

```js
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting && !started) {
        startCounting();
        started = true;
      }
    });
  },
  { threshold: 0.5 },
);

observer.observe(statsSection);
```

`IntersectionObserver` is used instead of a scroll event listener. Scroll listeners fire on every frame and run on the main thread. `IntersectionObserver` is browser-native and does not. The `started` flag ensures the counter runs only once (idempotency).

</details>

<details>
<summary>🎞️ requestAnimationFrame for Counter</summary>

```js
const increment = target / (duration / 16); // ~60fps

const updateCount = () => {
  const c = +counter.innerText;
  if (c < target) {
    counter.innerText = Math.ceil(c + increment);
    requestAnimationFrame(updateCount);
  } else {
    counter.innerText = target;
  }
};
```

`rAF` syncs with the monitor's refresh rate and prevents frame drops. The increment is calculated as `target / (duration / 16)` — where `16ms` is one frame at 60fps — so the animation completes in exactly `duration` milliseconds regardless of the target value. For example, a 1500ms animation at 60fps runs for $\lfloor 1500 / 16 \rfloor \approx 94$ frames.

</details>

<details>
<summary>🪗 CSS-driven FAQ Accordion</summary>

```js
function openFAQItem(item) {
  const content = item.querySelector(".faq__answer");
  item.classList.add("faq-open");
  content.style.height = content.scrollHeight + "px";
}

function closeFAQItem(item) {
  content.style.height = "0";
}
```

`scrollHeight` gives the real content height. CSS transitions handle the animation. This avoids `display: none` toggling which cannot be animated and causes layout reflow.

</details>

<details>
<summary>🖼️ Event Target vs currentTarget in Lightbox</summary>

```js
lightbox.addEventListener("click", (e) => {
  if (e.target === lightbox) closeLightbox();
});
```

`e.target` is the element that was actually clicked. `e.currentTarget` is the element the listener is attached to. Checking `e.target === lightbox` ensures clicks on the image itself do not close the lightbox — only clicks on the backdrop do.

</details>

<details>
<summary>⌨️ Keyboard Accessibility</summary>

```js
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && lightbox.style.display === "block") {
    closeLightbox();
  }
});
```

`Escape` key support for closing the lightbox is a WCAG requirement that is frequently skipped.

</details>

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

### 🔐 PHP & WordPress Integration

In this architecture, WordPress is strictly utilized as a routing and rendering middleware, leveraging conditional, template-level asset enqueuing to achieve highly efficient, bundler-free code splitting. The integration employs robust security and data-handling patterns, mandating CSRF nonce verification as the primary gatekeeper for all authenticated and guest AJAX handlers, while seamlessly bridging server-side context to the client via `wp_localize_script`. Additionally, the backend logic demonstrates meticulous attention to API interoperability and data integrity, featuring custom MIME-type overrides for precise file handling, strict type casting (such as converting empty arrays to `(object)[]` to enforce JSON object structures), and optimized Unicode encoding configurations to ensure flawless bidirectional communication with external SaaS microservices.

<details>
<summary>📦 Conditional Asset Loading</summary>

```php
if ( is_page_template('page-register.php') ) {
wp_enqueue_script('sadrhub-auth', ...);
wp_localize_script('sadrhub-auth', 'sadrhub_auth_obj', [...]);
}

if ( is_page_template('page-create.php') ) {
wp_enqueue_script('sadrhub-create', ...);
wp_enqueue_script('lottie-player-js', ...);
}
```

Each page loads only its own assets. Lottie — a heavy library — is only loaded on the create page. This is code splitting at the WordPress template level, without a bundler.

</details>

<details>
<summary>🌉 wp_localize_script as PHP→JS Bridge</summary>

```php
wp_localize_script('sadrhub-auth', 'sadrhub_auth_obj', array(
'root_url' => home_url(),
'redirect_url' => home_url('/profile/'),
'ajax_url' => admin_url('admin-ajax.php'),
'nonce' => wp_create_nonce('sadrhub_auth_nonce')
));
```

The standard WordPress pattern for injecting server-side context into JavaScript. No URLs are hardcoded in JS files — the code is fully environment-agnostic across local, staging, and production.

</details>

<details>
<summary>🛡️ CSRF Protection on Every AJAX Handler</summary>

```php
check_ajax_referer('sadrhub_auth_nonce', 'security');
```

Nonce verification is the first operation in every AJAX handler.

</details>

<details>
<summary>👥 Both AJAX Hooks</summary>

```php
add_action('wp_ajax_nopriv_sadrhub_send_otp', 'sadrhub_handle_send_otp');
add_action('wp_ajax_sadrhub_send_otp', 'sadrhub_handle_send_otp');
```

Covers both authenticated and guest users — required for a registration page.

</details>

<details>
<summary>📎 MIME Type Fix for JSON Upload</summary>

```php
function sadrhub_fix_json_mime_type($data, $file, $filename, $mimes) {
$exploded = explode('.', $filename);
$ext = strtolower(end($exploded));

if ( $ext === 'json' ) {
$data['ext'] = 'json';
$data['type'] = 'application/json';
}

return $data;
}
add_filter('wp_check_filetype_and_ext', 'sadrhub_fix_json_mime_type', 10, 4);
```

WordPress uses `finfo` or `mime_content_type` to detect file types, which often misidentifies JSON. This filter overrides the result. `end(explode('.', $filename))` correctly handles filenames like `file.backup.json`.

</details>

<details>
<summary>🔧 (object)[] Cast for Empty JSON Object</summary>

```php
if (empty($prevData)) {
$body_data['prevData'] = (object)[];
}
```

In PHP, `json_encode([])` produces `[]` (a JSON array). The external API expects `{}` (a JSON object). Casting to `(object)[]` produces the correct output.

</details>

<details>
<summary>🌐 JSON_UNESCAPED_UNICODE for Persian Text</summary>

```php
$json_payload = json_encode($body_data, JSON_UNESCAPED_UNICODE);
```

Without this flag, Persian characters are encoded as Unicode escape sequences (`\u0641\u0631\u0648\u0634...`), which breaks readability and can cause issues with some APIs.

</details>

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

### 🔑 Auth & Profile System

The authentication and user profile infrastructure completely bypasses native WordPress user management in favor of a sophisticated Backend-For-Frontend (BFF) cookie proxy pattern, securely bridging sessions with an external SaaS API using exact TTL calculations (e.g., $60 \times 60 \times 24 \times 7 = 604800$ seconds). This zero-trust auth flow employs bidirectional routing protection, rigorous API response normalization across varying data types, and comprehensive cookie invalidation upon logout by aggressively shifting expirations (e.g., $time() - 3600$). On the frontend, the multi-step OTP registration provides a frictionless, mobile-first user experience through intelligent clipboard parsing, automated input normalization, explicit DOM optimizations like `inputmode="numeric"`, and robust `finally` blocks in asynchronous operations to guarantee UI stability under network failure conditions.

<details>
<summary>🔓 WordPress-independent Session Layer</summary>

```php
function sadrhub_is_api_logged_in() {
return isset($_COOKIE['token']) && !empty($_COOKIE['token']);
}
```

Authentication state is read from the external SaaS API's cookie, not from WordPress. WordPress has no user accounts for SaaS users. This is a deliberate architectural boundary — WordPress is the rendering layer, the external API is the auth provider.

</details>

<details>
<summary>🍪 Cookie Proxy Pattern</summary>

```php
foreach ($server_cookies as $cookie_str) {
$parts = explode(';', $cookie_str);
$first_part = explode('=', $parts[0], 2);

if (count($first_part) == 2) {
$name = trim($first_part[0]);
$value = trim($first_part[1]);
setcookie($name, $value, time() + 604800, "/", "", false, true);
}
}
```

PHP parses `Set-Cookie` headers from the external API response and re-sets them on the browser. The `explode('=', ..., 2)` limit prevents splitting values that contain `=` (such as base64 strings). This is a BFF (Backend For Frontend) pattern for session bridging. The cookie lifetime is set to $604800$ seconds, which equals exactly 7 days: $60 \times 60 \times 24 \times 7 = 604800$.

</details>

<details>
<summary>📡 Cookie Forwarding in Server-to-Server Requests</summary>

```php
$cookies_str = '';
foreach ($_COOKIE as $name => $value) {
$cookies_str .= $name . '=' . $value . '; ';
}

$response = wp_remote_get($endpoint, array(
'headers' => array(
'Authorization' => 'Bearer ' . $token,
'Cookie' => $cookies_str,
),
));
```

The browser's cookies (which include the external session) are forwarded in server-to-server requests to the API. This is required for cookie-based authentication systems where the session must travel with every request.

</details>

<details>
<summary>↔️ Bidirectional Auth Redirect</summary>

```php
function sadrhub_protect_pages() {
if ( is_page($profile_slug) && !sadrhub_is_api_logged_in() ) {
wp_redirect( home_url('/' . $login_slug . '/') );
exit;
}
if ( is_page($login_slug) && sadrhub_is_api_logged_in() ) {
wp_redirect( home_url('/' . $profile_slug . '/') );
exit;
}
}
add_action('template_redirect', 'sadrhub_protect_pages');
```

Two independent protection layers: one in the template itself, one in `functions.php` via `template_redirect`. The redirect is bidirectional — authenticated users cannot access the register page, and unauthenticated users cannot access the profile page.

</details>

<details>
<summary>🔄 Defensive API Response Normalization</summary>

```php
$is_success = false;
if (trim($raw_body) === 'true') $is_success = true;
elseif ($json_body === true) $is_success = true;
elseif (isset($json_body['message']) && $json_body['message'] === 'done') $is_success = true;
elseif (isset($json_body['status']) && $json_body['status'] === 'done') $is_success = true;
```

The external API may return `"true"` (string), `true` (boolean), or `{"message":"done"}` depending on the endpoint. All variants are handled — a pattern that reflects real experience with APIs that are still evolving.

</details>

<details>
<summary>⏱️ OTP State Management with Graceful Degradation</summary>

```php
if (isset($body['Result']) && $body['Result'] === 'OTPAlreadyExists') {
wp_send_json_success([
'status'            => 'already_sent',
'timeLeftInSeconds' => isset($body['TimeLeftInSeconds'])
? intval($body['TimeLeftInSeconds'])
: 120
]);
}
```

Distinct states (`sent`, `already_sent`) are returned to the client with the remaining countdown. If the API does not return a time value, it falls back to 120 seconds — graceful degradation at the business logic level.

</details>

<details>
<summary>🚪 Complete Cookie Invalidation on Logout</summary>

```php
setcookie('token', '', time() - 3600, '/');
setcookie('customer_session', '', time() - 3600, '/');
setcookie('csrftoken', '', time() - 3600, '/');
setcookie('sadr_user_mobile', '', time() - 3600, '/');
wp_redirect(home_url());
exit;
```

All session-related cookies are expired simultaneously. `time() - 3600` sets the expiry to one hour in the past, which triggers immediate deletion in the browser.

</details>

<details>
<summary>📋 Multi-step OTP Form</summary>

```js
step1Form.style.display = "none";
step2Form.style.display = "block";
```

Two-step form without page reload. State is held in memory, which avoids re-entering the phone number if validation fails on step 2.

</details>

<details>
<summary>⏳ async/await with finally for Button State</summary>

```js
try {
  const result = await sendRequest("sadrhub_send_otp", { mobile: finalNumber });
} catch (error) {
  msgBox.innerText = "خطای شبکه یا سرور";
} finally {
  if (btn) btn.disabled = false;
}
```

`finally` re-enables the submit button regardless of whether the request succeeded or failed. Without it, a network error would leave the button permanently disabled.

</details>

<details>
<summary>📋 OTP Paste Handling</summary>

```js
input.addEventListener("paste", (e) => {
  e.preventDefault();
  const pasteData = (e.clipboardData || window.clipboardData)
    .getData("text")
    .replace(/[^0-9]/g, "");

  const chars = pasteData.split("");
  otpInputs.forEach((inp, i) => {
    if (chars[i]) inp.value = chars[i];
  });

  const lastIndex = Math.min(chars.length, otpInputs.length) - 1;
  if (lastIndex >= 0) otpInputs[lastIndex].focus();
  updateFinalOtp();
});
```

`e.clipboardData || window.clipboardData` provides a fallback for older browsers. Pasting a full OTP code auto-fills all inputs and moves focus to the last filled field.

</details>

<details>
<summary>🔢 Input Normalization</summary>

```js
if (rawNumber.length === 10 && rawNumber.startsWith("9")) {
  rawNumber = "0" + rawNumber;
}
```

If the user enters `912...` instead of `0912...`, it is normalized automatically before validation.

</details>

<details>
<summary>💬 Granular Validation Messages</summary>

```js
if (rawNumber.length < 11) showMobileError("شماره موبایل باید ۱۱ رقم باشد.");
else if (rawNumber.length > 11)
  showMobileError("شماره موبایل معتبر نیست (تعداد ارقام زیاد).");
else if (!rawNumber.startsWith("09"))
  showMobileError("شماره موبایل باید با 09 شروع شود.");
```

Each validation condition produces a specific error message rather than a generic one.

</details>

<details>
<summary>📱 inputmode="numeric" vs type="number"</summary>

```html
<input
  type="text"
  class="otp-input"
  maxlength="1"
  inputmode="numeric"
  pattern="[0-9]*"
/>
```

`inputmode="numeric"` shows the numeric keyboard on mobile without using `type="number"`, which has known issues: it shows a spinner, does not support leading zeros, and behaves inconsistently across browsers.

</details>

<details>
<summary>🔀 Display Input / Hidden Input Separation</summary>

```html
<input
  type="tel"
  id="mobile-display"
  placeholder="912 345 6789"
  inputmode="numeric"
/>
<input type="hidden" id="final-mobile" name="mobile" />
```

The user interacts with the display input. The normalized value is stored in the hidden input. This is separation of concerns at the UI layer.

</details>

<details>
<summary>↩️ dir="ltr" on OTP Container</summary>

```html
<div class="otp-group" dir="ltr"></div>
```

On an RTL Persian site, without this attribute the OTP input order would be reversed.

</details>

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

### 🏗️ Store Creation Flow

The store creation flow is engineered as a highly responsive, multi-step asynchronous wizard that optimizes both perceived and actual performance through advanced state synchronization. Network traffic is strictly minimized via custom-built debouncing mechanics for domain availability checks (enforcing a $500\text{ms}$ delay threshold), while a robust polling architecture elegantly decouples and synchronizes long-running API resolutions with sequential Lottie animations to drastically improve perceived wait times. The UI implementation remains remarkably lean, utilizing intelligent CSS Grid techniques to autonomously handle dynamic, odd-count component layouts and scoped global namespaces for specific interactive closures, ensuring a seamless, app-like domain generation experience without the overhead of heavy client-side frameworks.

<details>
<summary>⏱️ Debounced Domain Availability Check</summary>

```js
clearTimeout(domainCheckTimeout);
domainCheckTimeout = setTimeout(function () {
  checkDomainAvailability(val);
}, 500);
```

Manual debounce implementation — no request is sent until the user stops typing for 500ms. This prevents an API call on every keystroke.

</details>

<details>
<summary>🔄 Polling for Async Completion</summary>

```js
let checkReady = setInterval(() => {
  if (isStoreReady) {
    clearInterval(checkReady);
    window.location.href = redirectUrl;
  }
}, 1000);
```

When the AJAX response arrives before the loading animation finishes, polling waits for both to complete before redirecting. This synchronizes two independent async operations without coupling them.

</details>

<details>
<summary>🎬 Sequential Lottie Animation</summary>

```js
animationInterval = setInterval(() => {
  currentAnimIndex++;
  lottiePlayer.setAttribute("src", animSequences[currentAnimIndex]);
  if (typeof lottiePlayer.load === "function") lottiePlayer.load(newSrc);
}, timePerAnim);
```

Different animations play in sequence during a long loading process — a perceived performance technique that makes wait times feel shorter.

</details>

<details>
<summary>🌐 window Namespace for Inline Handlers</summary>

```js
window.selectCategory = function (element, value) { ... };
window.togglePlatform = function (element) { ... };
```

Functions called from HTML `onclick` attributes must be globally accessible. Only these functions are attached to `window`; all other state and logic remain inside the closure. This shows awareness of the difference between module scope and global scope.

</details>

<details>
<summary>🔲 CSS Grid for Odd-count Items</summary>

```css
.categories-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.75rem;
}
.cat-card:last-child {
  grid-column: span 2;
}
```

When there is an odd number of category cards, the last card spans both columns automatically.

</details>

<details>
<summary>✔️ ::after Pseudo-element for Checkmark</summary>

```css
.platform-card.selected::after {
  content: "✔";
  position: absolute;
  top: 8px;
  left: 8px;
}
```

The checkmark indicator is rendered via CSS, not HTML. No extra markup is needed per card.

</details>

[⬆ Back to Top](#sadrhub--wordpress-saas-landing-page-theme)

---

## 👤 Author

**Sina Sotoudeh** — Front-end Developer

- 🌐 [sinasotoudeh.ir](https://sinasotoudeh.ir)
- 💼 [linkedin.com/in/sinasotoudeh](https://linkedin.com/in/sinasotoudeh)
- 🐙 [github.com/sinasotoudeh](https://github.com/sinasotoudeh)
- 📧 [s.sotoudeh1@gmail.com](mailto:s.sotoudeh1@gmail.com)

---
name: SAPA SOSIAL Pelayanan Terpadu
colors:
  surface: '#f9f9ff'
  surface-dim: '#cfdaf2'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f3ff'
  surface-container: '#e7eeff'
  surface-container-high: '#dee8ff'
  surface-container-highest: '#d8e3fb'
  on-surface: '#111c2d'
  on-surface-variant: '#434752'
  inverse-surface: '#263143'
  inverse-on-surface: '#ecf1ff'
  outline: '#737783'
  outline-variant: '#c3c6d3'
  surface-tint: '#2e5bb0'
  primary: '#003883'
  on-primary: '#ffffff'
  primary-container: '#1e4fa3'
  on-primary-container: '#afc6ff'
  inverse-primary: '#afc6ff'
  secondary: '#855300'
  on-secondary: '#ffffff'
  secondary-container: '#fea619'
  on-secondary-container: '#684000'
  tertiary: '#00433d'
  on-tertiary: '#ffffff'
  tertiary-container: '#005d55'
  on-tertiary-container: '#6bd8ca'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d9e2ff'
  primary-fixed-dim: '#afc6ff'
  on-primary-fixed: '#001944'
  on-primary-fixed-variant: '#074397'
  secondary-fixed: '#ffddb8'
  secondary-fixed-dim: '#ffb95f'
  on-secondary-fixed: '#2a1700'
  on-secondary-fixed-variant: '#653e00'
  tertiary-fixed: '#89f5e7'
  tertiary-fixed-dim: '#6bd8cb'
  on-tertiary-fixed: '#00201d'
  on-tertiary-fixed-variant: '#005049'
  background: '#f9f9ff'
  on-background: '#111c2d'
  surface-variant: '#d8e3fb'
  surface-canvas: '#FFFFFF'
  surface-subtle: '#F5F8FC'
  surface-card: '#FFFFFF'
  surface-border: '#E2E8F0'
  status-success-bg: '#ECFDF5'
  status-success-text: '#065F46'
  status-success-border: '#A7F3D0'
  status-process-bg: '#EFF6FF'
  status-process-text: '#1E40AF'
  status-process-border: '#BFDBFE'
  status-warning-bg: '#FFFBEB'
  status-warning-text: '#92400E'
  status-warning-border: '#FDE68A'
  status-danger-bg: '#FEF2F2'
  status-danger-text: '#991B1B'
  status-danger-border: '#FECACA'
  status-neutral-bg: '#F1F5F9'
  status-neutral-text: '#475569'
  status-neutral-border: '#CBD5E1'
typography:
  headline-xl:
    fontFamily: Public Sans
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
  headline-xl-mobile:
    fontFamily: Public Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
  headline-lg:
    fontFamily: Public Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
  headline-lg-mobile:
    fontFamily: Public Sans
    fontSize: 22px
    fontWeight: '700'
    lineHeight: 30px
  headline-md:
    fontFamily: Public Sans
    fontSize: 22px
    fontWeight: '600'
    lineHeight: 28px
  headline-sm:
    fontFamily: Public Sans
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 26px
  body-lg:
    fontFamily: Public Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Public Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Public Sans
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-lg:
    fontFamily: Public Sans
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 20px
  label-md:
    fontFamily: Public Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 18px
  label-sm:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 2rem
  margin-mobile: 1rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
---

## Brand & Style

This design system establishes a trustworthy, humane, and accessible public service portal for local government social services. Balancing authoritative civic legitimacy with gentle civic hospitality, the visual language avoids intimidating bureaucratic stiffness and instead communicates warm stewardship, absolute clarity, and proactive guidance.

The design movement combines **Modern Civic Minimalism** with purposeful **Tactile Humanism**:
- High clarity and legibility prioritizing diverse demographics, including elderly residents, rural citizens, and users with lower-end mobile devices.
- Uncluttered compositions with generous whitespace, intuitive grouping, clear visual landmarks, and explicit microcopy in polite, non-technical Indonesian.
- Empathic accessibility at every layer, adhering strictly to WCAG AA contrast, oversized tap targets (minimum 44px to 48px), and progressive multi-step flows that de-escalate anxiety during emergency assistance requests.

## Colors

The color palette is engineered around public trust, clarity, and rapid cognitive recognition:
- **Primary (`#1E4FA3`)**: Deep institutional sapphire blue representing state authority, reliability, and security. Used for headers, primary navigation landmarks, and core functional actions.
- **Secondary (`#F59E0B`)**: Warm solar amber providing high-salience contrast. Reserved specifically for primary citizen calls-to-action (e.g., submission buttons, critical attention notices, and priority triage tags).
- **Tertiary (`#0D9488`)**: A stabilizing deep teal utilized for health and wellness sub-classifications, progress checkpoints, and informational callout ribbons.
- **Neutral (`#1E293B`)**: Dark slate ink replacing harsh pure black to deliver soft, fatigue-free typographic reading contrast on desktop and mobile screens.

### Semantic Status Palette
Status indicators rely on high-contrast paired fills and borders to guarantee legibility under varying lighting conditions:
- **Success (`#065F46` on `#ECFDF5`)**: For `Selesai`, `Terbit`, and `Aktif Kembali`.
- **In-Process (`#1E40AF` on `#EFF6FF`)**: For `Dalam Proses`, `Pemeriksaan Berkas`, and `Verifikasi`.
- **Warning / Action Required (`#92400E` on `#FFFBEB`)**: For `Menunggu Verifikasi`, `Perlu Perbaikan`, and `Darurat Medis`.
- **Danger / Invalid (`#991B1B` on `#FEF2F2`)**: For `Ditolak`, `Tidak Valid`, and `Tidak Ditemukan`.
- **Neutral / Inactive (`#475569` on `#F1F5F9`)**: For `Duplikat`, `Diarsipkan`, and `Kedaluwarsa`.

## Typography

The design system standardizes on **Public Sans**, an open, humanist sans-serif originally developed for civic interfaces. Its tall x-height, distinct letterforms (such as capital `I`, numeral `1`, and lowercase `l`), and open apertures ensure effortless comprehension across varied screen resolutions and reading conditions.

### Typographic Hierarchy Guidelines
- **Headings**: Rendered in weight `700` or `600`. Tight tracking avoids awkward line wrapping on narrow smartphone displays.
- **Body Text**: Baseline reading font size is standard at `16px` (`body-md`) with a generous `1.5` line-height (`24px`). Critical legal or procedural paragraphs scale up to `18px` (`body-lg`) to assist aging eyes.
- **Labels & Microcopy**: Form labels, field helper text, and validation states are rendered at `14px` (`label-md` or `body-sm`) with crisp `600` or `500` weights to prevent visual ambiguity.

## Layout & Spacing

The layout is built around a responsive 12-column grid system designed for mobile-first utility:
- **Mobile (< 768px)**: 4-column structure with `margin-mobile` of `1rem` (16px) and `gutter-mobile` of `1rem` (16px). Form controls and cards occupy full width to avoid cramped inputs.
- **Tablet (768px - 1024px)**: 8-column layout with `1.5rem` margins and gutters, accommodating split screen previews and 2-column card catalogs.
- **Desktop (> 1024px)**: 12-column layout with a maximum container boundary of `1200px`, centered on the viewport with `margin` of `2rem` (32px) and `gutter` of `1.5rem` (24px).

### Spacing Rhythm
Vertical rhythm adheres to an 8px modular baseline:
- `space-xs` (4px): Micro-spacing between paired label badges and tiny icon offsets.
- `space-sm` (8px): Gaps between labels and input controls; distance inside compact list cells.
- `space-md` (16px): Standard internal padding for cards, standard gap between stack elements.
- `space-lg` (24px): Card layout internal padding on desktop; gap between fieldset sections.
- `space-xl` (32px): Major component separations, hero block buffers, and section headers.

## Elevation & Depth

This system avoids heavy, dark skeuomorphic drops, relying instead on clean surface tints, delicate hairline outlines, and soft ambient light:
- **Level 0 (Flat Ground)**: Base background `#FFFFFF` or section background `#F5F8FC`. No shadow.
- **Level 1 (Interactive Cards & Containers)**: `#FFFFFF` surface accompanied by a crisp low-contrast boundary (`border: 1px solid #E2E8F0`) and a soft ambient shadow: `0 1px 3px 0 rgba(30, 79, 163, 0.04), 0 1px 2px -1px rgba(30, 79, 163, 0.02)`.
- **Level 2 (Hovered Cards & Action Sheets)**: Elevated state for interactive cards and bottom sheets: `0 4px 6px -1px rgba(30, 79, 163, 0.07), 0 2px 4px -2px rgba(30, 79, 163, 0.05)`.
- **Level 3 (Modals, Floating Navigation & Alerts)**: For persistent bottom shortcuts and modal overlays: `0 10px 15px -3px rgba(15, 23, 42, 0.08), 0 4px 6px -4px rgba(15, 23, 42, 0.04)`.

## Shapes

The interface embraces a gentle, welcoming contour:
- **Standard Corners (`rounded-md`, 8px)**: Used for input fields, text areas, dropdown triggers, and interactive list tiles.
- **Container Corners (`rounded-lg` / `rounded-xl`, 12px to 16px)**: Applied to all primary content cards, modal dialogs, status alert banners, and file dropzones.
- **Pill Shapes (`rounded-full`)**: Strictly reserved for status badges, numeric step counters, tag filters, and floating quick-action buttons.

## Components

### Buttons & Interactive Controls
- **Primary CTA**: Filled with warm amber (`#F59E0B`), text `#1E293B` (or `#000000`) at `600` weight, min-height `48px`. Hover: `#D97706`. Focus ring: 2px offset deep blue.
- **Secondary CTA**: Filled with deep sapphire blue (`#1E4FA3`), text `#FFFFFF` at `600` weight, min-height `48px`. Hover: `#183F83`.
- **Tertiary / Ghost Button**: Transparent background, border `1.5px solid #CBD5E1`, text `#1E4FA3`.
- **Touch Target Rule**: All clickable links, buttons, and radio selection cards must satisfy a minimum boundary box of `48px × 48px`.

### Badges & Status Indicators
- Structured as pill components with padding `4px 12px`, typography `label-sm` (`12px`, weight `600`).
- Composed of 3 tokens: light background fill, contrasting colored text, and a matched border stroke (`1px`).
- Example `Selesai`: background `#ECFDF5`, border `#A7F3D0`, text `#065F46`, prefixed with a subtle checkmark icon.

### Form Inputs & File Uploads
- **Text Inputs & Dropdowns**: Minimum height `48px`, background `#FFFFFF`, border `1px solid #CBD5E1`, border-radius `8px`. Active focus state shows a `2px solid #1E4FA3` ring.
- **Helper & Validation Text**: Always displayed below inputs. Errors display in `#991B1B` alongside an alert circle icon.
- **Upload Dropzone**: Outlined with an inviting `2px dashed #93C5FD` border over `#F5F8FC` surface. Features an upload cloud icon, file constraint helper text, and instant preview row with remove actions.

### Cards & Steppers
- **Layanan Cards**: White cards with `#E2E8F0` border, `12px` border radius, containing service title, agency category badge, 2-line preview, processing duration badge, and bottom right action buttons.
- **Progress Stepper (Multi-step & Cek Status)**:
  - Vertical layout on mobile screens, horizontal on desktop viewports.
  - Step icon nodes are `32px` circles: filled deep blue with checkmark when finished, pulsing blue outline when active, and muted light slate `#E2E8F0` when upcoming.
  - Accompanied by date, officer notes, and clear contextual instructions.

### Sticky Mobile Shortcuts
- A persistent bottom dock fixed on mobile viewports (`height: 64px`) elevated at Level 3, containing direct access shortcuts: *Ajukan Layanan*, *Pengaduan*, and *Cek Status*.
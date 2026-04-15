# Profile — Split-Screen Timeline

A single-file PHP landing page that presents a portfolio of events and achievements in a split-screen layout.

![Preview](screenshot.png)

## Layout

| Panel | Content |
|-------|---------|
| **Left** | Detail view — title, type badge, description, and tags for the selected event |
| **Right** | Scrollable timeline grouped by year; click any item to load its details |

## Features

- Split-screen 50/50 layout, stacks vertically on mobile (≤ 768 px)
- Timeline events grouped by year with a vertical track line and animated dot indicators
- Smooth fade-in transition when switching between events
- No dependencies — pure HTML, CSS, and vanilla JavaScript inside a single `.php` file

## Usage

Serve with PHP's built-in server:

```bash
php -S localhost:8080
```

Then open `http://localhost:8080/index.php` in your browser.

## Customising events

Edit the `events` array at the bottom of `index.php`. Each entry accepts:

```js
{
    id:          1,           // unique integer
    year:        2026,        // used for grouping
    date:        "Mar 2026",  // displayed in the timeline and detail panel
    type:        "Launch",    // badge label (Award, Role, Project, Talk, …)
    title:       "…",
    subtitle:    "…",         // shown under the title in the timeline
    description: "…",         // long-form text shown in the detail panel
    tags:        ["Tag1", "Tag2"]
}
```

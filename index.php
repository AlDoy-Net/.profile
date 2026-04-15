<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            overflow: hidden;
            background: #0f0f0f;
            color: #e0e0e0;
        }

        /* ── Left panel: event detail ── */
        #detail-panel {
            width: 50%;
            height: 100vh;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #141414;
            border-right: 1px solid #2a2a2a;
            transition: opacity 0.35s ease;
            overflow-y: auto;
        }

        #detail-panel .placeholder {
            text-align: center;
            opacity: 0.25;
        }

        #detail-panel .placeholder svg {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            stroke: #888;
        }

        #detail-panel .placeholder p {
            font-size: 14px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .detail-year {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6c63ff;
            margin-bottom: 12px;
        }

        .detail-title {
            font-size: 36px;
            font-weight: 700;
            line-height: 1.2;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .detail-badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(108, 99, 255, 0.15);
            border: 1px solid rgba(108, 99, 255, 0.4);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #6c63ff;
            margin-bottom: 24px;
        }

        .detail-description {
            font-size: 16px;
            line-height: 1.8;
            color: #a0a0a0;
            margin-bottom: 32px;
        }

        .detail-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .detail-tag {
            padding: 5px 14px;
            background: #1e1e1e;
            border: 1px solid #2e2e2e;
            border-radius: 4px;
            font-size: 12px;
            color: #888;
        }

        /* ── Right panel: timeline ── */
        #timeline-panel {
            width: 50%;
            height: 100vh;
            overflow-y: auto;
            padding: 60px 50px;
            background: #0f0f0f;
            scrollbar-width: thin;
            scrollbar-color: #2a2a2a transparent;
        }

        #timeline-panel::-webkit-scrollbar { width: 4px; }
        #timeline-panel::-webkit-scrollbar-track { background: transparent; }
        #timeline-panel::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 4px; }

        .timeline-header {
            margin-bottom: 48px;
        }

        .timeline-header h1 {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 8px;
        }

        .timeline-header p {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
        }

        /* Year group */
        .year-group {
            margin-bottom: 40px;
        }

        .year-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #444;
            margin-bottom: 16px;
            padding-left: 28px;
        }

        /* Timeline track */
        .timeline-track {
            position: relative;
            padding-left: 28px;
        }

        .timeline-track::before {
            content: '';
            position: absolute;
            left: 7px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #1e1e1e;
        }

        /* Individual event item */
        .timeline-item {
            position: relative;
            padding: 16px 20px;
            margin-bottom: 8px;
            border-radius: 8px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: background 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        .timeline-item:hover {
            background: #1a1a1a;
            border-color: #2a2a2a;
            transform: translateX(4px);
        }

        .timeline-item.active {
            background: #1a1835;
            border-color: rgba(108, 99, 255, 0.5);
            transform: translateX(4px);
        }

        /* Dot on the track */
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -23px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #2a2a2a;
            border: 2px solid #333;
            transition: background 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .timeline-item:hover::before,
        .timeline-item.active::before {
            background: #6c63ff;
            border-color: #6c63ff;
            box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
        }

        .item-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .item-type {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 3px;
            color: #6c63ff;
            background: rgba(108, 99, 255, 0.1);
        }

        .item-date {
            font-size: 11px;
            color: #444;
        }

        .item-title {
            font-size: 15px;
            font-weight: 600;
            color: #d0d0d0;
            line-height: 1.3;
        }

        .timeline-item.active .item-title {
            color: #ffffff;
        }

        .item-subtitle {
            font-size: 12px;
            color: #555;
            margin-top: 3px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                overflow: auto;
                height: auto;
            }

            #detail-panel,
            #timeline-panel {
                width: 100%;
                height: auto;
                min-height: 50vh;
                border-right: none;
            }

            #detail-panel {
                border-bottom: 1px solid #2a2a2a;
            }
        }
    </style>
</head>
<body>

<!-- Left: detail view -->
<section id="detail-panel">
    <div class="placeholder" id="placeholder">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <p>Select an event to view details</p>
    </div>
    <div id="detail-content" style="display:none;">
        <div class="detail-year" id="d-year"></div>
        <h2 class="detail-title" id="d-title"></h2>
        <span class="detail-badge" id="d-type"></span>
        <p class="detail-description" id="d-desc"></p>
        <div class="detail-tags" id="d-tags"></div>
    </div>
</section>

<!-- Right: timeline -->
<section id="timeline-panel">
    <div class="timeline-header">
        <h1>Portfolio</h1>
        <p>Events &amp; Achievements</p>
    </div>
    <div id="timeline-container"></div>
</section>

<script>
    // ── Data ───────────────────────────────────────────────────────────────
    const events = [
        {
            id: 1,
            year: 2026,
            date: "Mar 2026",
            type: "Launch",
            title: "Open-Source AI Toolkit",
            subtitle: "Personal project · 3.2k GitHub stars",
            description: "Released an open-source toolkit that simplifies integrating large-language-model APIs into web applications. The library abstracts token management, streaming, and retry logic, letting developers focus on product rather than plumbing. Gained 3,200 stars in the first two weeks.",
            tags: ["TypeScript", "Node.js", "OpenAI", "Streaming"]
        },
        {
            id: 2,
            year: 2025,
            date: "Nov 2025",
            type: "Award",
            title: "Developer of the Year",
            subtitle: "Regional Tech Summit",
            description: "Recognised at the annual Regional Tech Summit for outstanding contributions to developer tooling and open-source communities. Accepted the award alongside a keynote on building maintainable, human-first software in an AI-assisted world.",
            tags: ["Community", "Recognition", "Keynote"]
        },
        {
            id: 3,
            year: 2025,
            date: "Jun 2025",
            type: "Role",
            title: "Senior Engineer — Platform",
            subtitle: "Acme Corp · Full-time",
            description: "Joined Acme Corp to lead the platform engineering team. Responsible for the internal developer platform serving 200+ engineers, cutting deploy times by 60% through pipeline optimisations and a self-service infrastructure portal built on Kubernetes and Terraform.",
            tags: ["Kubernetes", "Terraform", "Platform Eng", "Leadership"]
        },
        {
            id: 4,
            year: 2024,
            date: "Sep 2024",
            type: "Publication",
            title: "\"Scaling Without Drama\"",
            subtitle: "Medium Engineering · Featured article",
            description: "Wrote a deep-dive on zero-downtime database migrations for high-traffic services, covering blue-green deployments, read-replica cut-overs, and rollback strategies. The article was featured in the Medium Engineering newsletter and read by over 40,000 engineers.",
            tags: ["PostgreSQL", "Migrations", "Scaling", "Writing"]
        },
        {
            id: 5,
            year: 2024,
            date: "Jan 2024",
            type: "Certification",
            title: "Certified Kubernetes Administrator",
            subtitle: "CNCF · CKA credential",
            description: "Passed the CKA exam with a score of 91%, validating expertise in cluster architecture, workloads, scheduling, networking, storage, and troubleshooting. This certification formalised years of hands-on experience running production Kubernetes clusters.",
            tags: ["Kubernetes", "DevOps", "CNCF", "Cloud Native"]
        },
        {
            id: 6,
            year: 2023,
            date: "Jul 2023",
            type: "Project",
            title: "Real-Time Analytics Dashboard",
            subtitle: "Client project · Fintech",
            description: "Designed and delivered a real-time trading analytics dashboard for a fintech client, ingesting 50k events per second via Kafka, aggregating them in ClickHouse, and serving sub-second queries to a React frontend. Project went live on schedule and under budget.",
            tags: ["Kafka", "ClickHouse", "React", "Fintech"]
        },
        {
            id: 7,
            year: 2023,
            date: "Feb 2023",
            type: "Talk",
            title: "\"The Hidden Cost of Microservices\"",
            subtitle: "JSConf EU · Berlin",
            description: "Delivered a 30-minute talk at JSConf EU exploring the operational complexity microservices introduce and when a well-structured monolith is the better choice. The talk sparked a lively hallway conversation and was later published on the conference YouTube channel.",
            tags: ["Architecture", "Microservices", "Conference", "JavaScript"]
        },
        {
            id: 8,
            year: 2022,
            date: "May 2022",
            type: "Role",
            title: "Mid-Level Engineer — Backend",
            subtitle: "StartupXYZ · Full-time",
            description: "First engineering hire at an early-stage SaaS startup. Wore many hats — built the core API in Node.js, set up CI/CD from scratch on GitHub Actions, and helped the company scale from 0 to 10,000 paying customers over 18 months.",
            tags: ["Node.js", "PostgreSQL", "GitHub Actions", "Startup"]
        }
    ];

    // ── Group events by year ───────────────────────────────────────────────
    function groupByYear(data) {
        return data.reduce((acc, ev) => {
            (acc[ev.year] = acc[ev.year] || []).push(ev);
            return acc;
        }, {});
    }

    // ── Render timeline ────────────────────────────────────────────────────
    function renderTimeline() {
        const container = document.getElementById('timeline-container');
        const grouped = groupByYear(events);
        const years = Object.keys(grouped).sort((a, b) => b - a);

        years.forEach(year => {
            const group = document.createElement('div');
            group.className = 'year-group';

            const label = document.createElement('div');
            label.className = 'year-label';
            label.textContent = year;
            group.appendChild(label);

            const track = document.createElement('div');
            track.className = 'timeline-track';

            grouped[year].forEach(ev => {
                const item = document.createElement('div');
                item.className = 'timeline-item';
                item.dataset.id = ev.id;
                item.innerHTML = `
                    <div class="item-meta">
                        <span class="item-type">${ev.type}</span>
                        <span class="item-date">${ev.date}</span>
                    </div>
                    <div class="item-title">${ev.title}</div>
                    <div class="item-subtitle">${ev.subtitle}</div>
                `;
                item.addEventListener('click', () => selectEvent(ev.id));
                track.appendChild(item);
            });

            group.appendChild(track);
            container.appendChild(group);
        });
    }

    // ── Show event detail ──────────────────────────────────────────────────
    function selectEvent(id) {
        const ev = events.find(e => e.id === id);
        if (!ev) return;

        // Highlight active item
        document.querySelectorAll('.timeline-item').forEach(el => {
            el.classList.toggle('active', parseInt(el.dataset.id) === id);
        });

        // Populate left panel
        document.getElementById('d-year').textContent = ev.date;
        document.getElementById('d-title').textContent = ev.title;
        document.getElementById('d-type').textContent = ev.type;
        document.getElementById('d-desc').textContent = ev.description;

        const tagsEl = document.getElementById('d-tags');
        tagsEl.innerHTML = ev.tags
            .map(t => `<span class="detail-tag">${t}</span>`)
            .join('');

        document.getElementById('placeholder').style.display = 'none';
        const content = document.getElementById('detail-content');
        content.style.display = 'block';
        content.style.opacity = '0';
        requestAnimationFrame(() => {
            content.style.transition = 'opacity 0.3s ease';
            content.style.opacity = '1';
        });
    }

    // ── Init ───────────────────────────────────────────────────────────────
    renderTimeline();
</script>

</body>
</html>

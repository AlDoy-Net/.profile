<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile · Timeline</title>
    <style>
        /* ── Reset & base ─────────────────────────────────────────────── */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg:          #0a0a0f;
            --surface:     #0f0f1a;
            --surface2:    #13131f;
            --border:      #1e1e2e;
            --border2:     #252538;
            --text:        #e2e2f0;
            --muted:       #6b6b8a;
            --faint:       #2a2a40;

            /* accent */
            --accent:      #7c6dfa;
            --accent-dim:  rgba(124,109,250,.12);
            --accent-glow: rgba(124,109,250,.25);

            /* event-type palette */
            --c-launch:  #34d399; --c-launch-bg:  rgba(52,211,153,.1);
            --c-award:   #fbbf24; --c-award-bg:   rgba(251,191,36,.1);
            --c-role:    #60a5fa; --c-role-bg:    rgba(96,165,250,.1);
            --c-pub:     #fb923c; --c-pub-bg:     rgba(251,146,60,.1);
            --c-cert:    #2dd4bf; --c-cert-bg:    rgba(45,212,191,.1);
            --c-project: #c084fc; --c-project-bg: rgba(192,132,252,.1);
            --c-talk:    #f472b6; --c-talk-bg:    rgba(244,114,182,.1);
            --c-default: #94a3b8; --c-default-bg: rgba(148,163,184,.1);
        }

        html, body { height: 100%; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* ── Top bar ──────────────────────────────────────────────────── */
        #topbar {
            flex-shrink: 0;
            height: 48px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 10px;
            z-index: 10;
        }

        .topbar-dot {
            width: 12px; height: 12px;
            border-radius: 50%;
        }
        .topbar-dot:nth-child(1) { background: #ff5f57; }
        .topbar-dot:nth-child(2) { background: #febc2e; }
        .topbar-dot:nth-child(3) { background: #28c840; }

        .topbar-title {
            margin-left: auto;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        /* ── Main split ───────────────────────────────────────────────── */
        #main {
            flex: 1;
            display: flex;
            min-height: 0;
        }

        /* ── LEFT panel ───────────────────────────────────────────────── */
        #left {
            width: 50%;
            display: flex;
            flex-direction: column;
            background: var(--surface);
            border-right: 1px solid var(--border);
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--border2) transparent;
        }
        #left::-webkit-scrollbar { width: 4px; }
        #left::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }

        /* Profile hero */
        #profile {
            padding: 40px 44px 32px;
            border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }

        .avatar {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent) 0%, #c084fc 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 0 0 4px var(--accent-dim), 0 8px 24px rgba(0,0,0,.4);
        }

        .profile-name {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .profile-handle {
            font-size: 13px;
            color: var(--accent);
            margin-bottom: 12px;
            font-weight: 500;
        }

        .profile-bio {
            font-size: 13.5px;
            line-height: 1.7;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .profile-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .profile-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            background: var(--faint);
            border: 1px solid var(--border2);
            border-radius: 20px;
            font-size: 11.5px;
            color: var(--muted);
        }

        .profile-pill svg {
            width: 12px; height: 12px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }

        /* Detail area */
        #detail-area {
            flex: 1;
            padding: 36px 44px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Placeholder */
        #detail-placeholder {
            text-align: center;
            padding: 40px 0;
        }

        .placeholder-icon {
            width: 48px; height: 48px;
            margin: 0 auto 14px;
            opacity: .2;
        }

        .placeholder-icon svg {
            width: 100%; height: 100%;
            stroke: var(--text);
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .placeholder-text {
            font-size: 13px;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
            opacity: .6;
        }

        /* Event detail */
        #detail-content {
            display: none;
        }

        .detail-kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 10px;
        }

        .detail-title {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            color: #fff;
            margin-bottom: 16px;
            letter-spacing: -.02em;
        }

        .detail-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        .detail-badge::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .detail-desc {
            font-size: 15px;
            line-height: 1.85;
            color: #9090b0;
            margin-bottom: 28px;
        }

        .detail-divider {
            height: 1px;
            background: var(--border);
            margin-bottom: 24px;
        }

        .detail-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .detail-tag {
            padding: 5px 13px;
            background: var(--faint);
            border: 1px solid var(--border2);
            border-radius: 5px;
            font-size: 11.5px;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── RIGHT panel ──────────────────────────────────────────────── */
        #right {
            width: 50%;
            overflow-y: auto;
            background: var(--bg);
            scrollbar-width: thin;
            scrollbar-color: var(--border2) transparent;
        }
        #right::-webkit-scrollbar { width: 4px; }
        #right::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }

        /* Sticky header */
        #timeline-header {
            position: sticky;
            top: 0;
            z-index: 5;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .tl-heading {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .tl-count {
            font-size: 11px;
            color: var(--muted);
            background: var(--faint);
            border: 1px solid var(--border2);
            padding: 2px 9px;
            border-radius: 20px;
        }

        /* Timeline body */
        #timeline-body {
            padding: 28px 40px 60px;
        }

        /* Year group */
        .year-group { margin-bottom: 36px; }

        .year-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            padding-left: 26px;
        }

        .year-label span {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--faint);
        }

        .year-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* Track */
        .tl-track {
            position: relative;
            padding-left: 26px;
        }

        .tl-track::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: linear-gradient(to bottom, var(--border2), var(--border));
            border-radius: 2px;
        }

        /* Item */
        .tl-item {
            position: relative;
            padding: 14px 18px;
            margin-bottom: 6px;
            border-radius: 10px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: background .18s, border-color .18s, transform .18s;
            user-select: none;
        }

        .tl-item:hover {
            background: var(--surface2);
            border-color: var(--border2);
            transform: translateX(3px);
        }

        .tl-item.active {
            background: var(--surface2);
            border-color: var(--border2);
            transform: translateX(3px);
        }

        /* Dot */
        .tl-item::before {
            content: '';
            position: absolute;
            left: -21px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px; height: 10px;
            border-radius: 50%;
            background: var(--bg);
            border: 2px solid var(--border2);
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .tl-item:hover::before,
        .tl-item.active::before {
            border-color: var(--dot-color, var(--accent));
            background: var(--dot-color, var(--accent));
            box-shadow: 0 0 0 4px var(--dot-glow, var(--accent-glow));
        }

        /* Item content */
        .tl-meta {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 5px;
        }

        .tl-type {
            font-size: 9.5px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .tl-date {
            font-size: 11px;
            color: var(--muted);
        }

        .tl-title {
            font-size: 14px;
            font-weight: 600;
            color: #c8c8e0;
            line-height: 1.35;
            transition: color .18s;
        }

        .tl-item:hover .tl-title,
        .tl-item.active .tl-title { color: #fff; }

        .tl-sub {
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 2px;
        }

        /* Left border accent on active */
        .tl-item.active {
            border-left-color: var(--dot-color, var(--accent)) !important;
            border-left-width: 2px;
        }

        /* ── Responsive ───────────────────────────────────────────────── */
        @media (max-width: 820px) {
            body { overflow: auto; }
            #main { flex-direction: column-reverse; }
            #left, #right { width: 100%; min-height: 55vh; }
            #left { border-right: none; border-top: 1px solid var(--border); }
            body { overflow-y: auto; }
        }
    </style>
</head>
<body>

<!-- Top bar -->
<div id="topbar">
    <div class="topbar-dot"></div>
    <div class="topbar-dot"></div>
    <div class="topbar-dot"></div>
    <span class="topbar-title">Profile · Timeline</span>
</div>

<!-- Main -->
<div id="main">

    <!-- LEFT ── profile + detail -->
    <section id="left">

        <!-- Profile hero -->
        <div id="profile">
            <div class="avatar">A</div>
            <div class="profile-name">Alex Doyle</div>
            <div class="profile-handle">@aldoy-net</div>
            <p class="profile-bio">
                Platform engineer and open-source contributor. I build tools that
                make developers' lives easier — from internal platforms to public
                libraries. Based in Berlin.
            </p>
            <div class="profile-pills">
                <span class="profile-pill">
                    <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Berlin, DE
                </span>
                <span class="profile-pill">
                    <svg viewBox="0 0 24 24"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                    github.com/aldoy-net
                </span>
                <span class="profile-pill">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Available for work
                </span>
            </div>
        </div>

        <!-- Event detail -->
        <div id="detail-area">
            <div id="detail-placeholder">
                <div class="placeholder-icon">
                    <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <p class="placeholder-text">Select an event to view details</p>
            </div>

            <div id="detail-content">
                <div class="detail-kicker" id="d-kicker"></div>
                <h2 class="detail-title" id="d-title"></h2>
                <span class="detail-badge" id="d-badge"></span>
                <p class="detail-desc" id="d-desc"></p>
                <div class="detail-divider"></div>
                <div class="detail-tags" id="d-tags"></div>
            </div>
        </div>

    </section>

    <!-- RIGHT ── timeline -->
    <section id="right">
        <div id="timeline-header">
            <span class="tl-heading">Timeline</span>
            <span class="tl-count" id="tl-count"></span>
        </div>
        <div id="timeline-body"></div>
    </section>

</div><!-- #main -->

<script>
// ── Config: event-type colours ────────────────────────────────────────────
const TYPE_STYLE = {
    launch:      { color: '#34d399', bg: 'rgba(52,211,153,.12)'  },
    award:       { color: '#fbbf24', bg: 'rgba(251,191,36,.12)'  },
    role:        { color: '#60a5fa', bg: 'rgba(96,165,250,.12)'  },
    publication: { color: '#fb923c', bg: 'rgba(251,146,60,.12)'  },
    certification:{ color: '#2dd4bf', bg: 'rgba(45,212,191,.12)' },
    project:     { color: '#c084fc', bg: 'rgba(192,132,252,.12)' },
    talk:        { color: '#f472b6', bg: 'rgba(244,114,182,.12)' },
};

function typeStyle(type) {
    return TYPE_STYLE[type.toLowerCase()] || { color: '#94a3b8', bg: 'rgba(148,163,184,.12)' };
}

// ── Data ──────────────────────────────────────────────────────────────────
const events = [
    {
        id: 1, year: 2026, date: 'Mar 2026', type: 'Launch',
        title: 'Open-Source AI Toolkit',
        subtitle: 'Personal project · 3.2k GitHub stars',
        description: 'Released an open-source toolkit that simplifies integrating large-language-model APIs into web applications. The library abstracts token management, streaming, and retry logic — letting developers focus on product rather than plumbing. Gained 3,200 stars in the first two weeks.',
        tags: ['TypeScript', 'Node.js', 'OpenAI', 'Streaming']
    },
    {
        id: 2, year: 2025, date: 'Nov 2025', type: 'Award',
        title: 'Developer of the Year',
        subtitle: 'Regional Tech Summit',
        description: 'Recognised at the annual Regional Tech Summit for outstanding contributions to developer tooling and open-source communities. Accepted the award alongside a keynote on building maintainable, human-first software in an AI-assisted world.',
        tags: ['Community', 'Recognition', 'Keynote']
    },
    {
        id: 3, year: 2025, date: 'Jun 2025', type: 'Role',
        title: 'Senior Engineer — Platform',
        subtitle: 'Acme Corp · Full-time',
        description: 'Joined Acme Corp to lead the platform engineering team. Responsible for the internal developer platform serving 200+ engineers — cutting deploy times by 60% through pipeline optimisations and a self-service infrastructure portal built on Kubernetes and Terraform.',
        tags: ['Kubernetes', 'Terraform', 'Platform Eng', 'Leadership']
    },
    {
        id: 4, year: 2024, date: 'Sep 2024', type: 'Publication',
        title: '"Scaling Without Drama"',
        subtitle: 'Medium Engineering · Featured article',
        description: 'Wrote a deep-dive on zero-downtime database migrations for high-traffic services, covering blue-green deployments, read-replica cut-overs, and rollback strategies. Featured in the Medium Engineering newsletter and read by over 40,000 engineers.',
        tags: ['PostgreSQL', 'Migrations', 'Scaling', 'Writing']
    },
    {
        id: 5, year: 2024, date: 'Jan 2024', type: 'Certification',
        title: 'Certified Kubernetes Administrator',
        subtitle: 'CNCF · CKA credential',
        description: 'Passed the CKA exam with a score of 91%, validating expertise in cluster architecture, workloads, scheduling, networking, storage, and troubleshooting. This certification formalised years of hands-on experience running production Kubernetes clusters.',
        tags: ['Kubernetes', 'DevOps', 'CNCF', 'Cloud Native']
    },
    {
        id: 6, year: 2023, date: 'Jul 2023', type: 'Project',
        title: 'Real-Time Analytics Dashboard',
        subtitle: 'Client project · Fintech',
        description: 'Designed and delivered a real-time trading analytics dashboard for a fintech client, ingesting 50k events per second via Kafka, aggregating in ClickHouse, and serving sub-second queries to a React frontend. Project went live on schedule and under budget.',
        tags: ['Kafka', 'ClickHouse', 'React', 'Fintech']
    },
    {
        id: 7, year: 2023, date: 'Feb 2023', type: 'Talk',
        title: '"The Hidden Cost of Microservices"',
        subtitle: 'JSConf EU · Berlin',
        description: 'Delivered a 30-minute talk at JSConf EU exploring the operational complexity microservices introduce and when a well-structured monolith is the better choice. The talk was later published on the conference YouTube channel.',
        tags: ['Architecture', 'Microservices', 'Conference', 'JavaScript']
    },
    {
        id: 8, year: 2022, date: 'May 2022', type: 'Role',
        title: 'Mid-Level Engineer — Backend',
        subtitle: 'StartupXYZ · Full-time',
        description: 'First engineering hire at an early-stage SaaS startup. Built the core API in Node.js, set up CI/CD from scratch on GitHub Actions, and helped the company scale from 0 to 10,000 paying customers over 18 months.',
        tags: ['Node.js', 'PostgreSQL', 'GitHub Actions', 'Startup']
    }
];

// ── Render timeline ───────────────────────────────────────────────────────
function groupByYear(data) {
    return data.reduce((acc, ev) => {
        (acc[ev.year] = acc[ev.year] || []).push(ev);
        return acc;
    }, {});
}

function renderTimeline() {
    const body = document.getElementById('timeline-body');
    const grouped = groupByYear(events);
    const years = Object.keys(grouped).sort((a, b) => b - a);

    document.getElementById('tl-count').textContent = events.length + ' events';

    years.forEach(year => {
        const group = document.createElement('div');
        group.className = 'year-group';

        const label = document.createElement('div');
        label.className = 'year-label';
        label.innerHTML = `<span>${year}</span>`;
        group.appendChild(label);

        const track = document.createElement('div');
        track.className = 'tl-track';

        grouped[year].forEach(ev => {
            const s = typeStyle(ev.type);
            const item = document.createElement('div');
            item.className = 'tl-item';
            item.dataset.id = ev.id;
            item.style.setProperty('--dot-color', s.color);
            item.style.setProperty('--dot-glow', s.bg.replace('.12', '.3'));

            item.innerHTML = `
                <div class="tl-meta">
                    <span class="tl-type" style="color:${s.color};background:${s.bg}">${ev.type}</span>
                    <span class="tl-date">${ev.date}</span>
                </div>
                <div class="tl-title">${ev.title}</div>
                <div class="tl-sub">${ev.subtitle}</div>
            `;
            item.addEventListener('click', () => selectEvent(ev.id));
            track.appendChild(item);
        });

        group.appendChild(track);
        body.appendChild(group);
    });
}

// ── Select event ──────────────────────────────────────────────────────────
function selectEvent(id) {
    const ev = events.find(e => e.id === id);
    if (!ev) return;

    // Active state on timeline
    document.querySelectorAll('.tl-item').forEach(el => {
        el.classList.toggle('active', parseInt(el.dataset.id) === id);
    });

    // Populate detail
    const s = typeStyle(ev.type);
    document.getElementById('d-kicker').textContent = ev.date;
    document.getElementById('d-title').textContent = ev.title;

    const badge = document.getElementById('d-badge');
    badge.textContent = ev.type;
    badge.style.color = s.color;
    badge.style.background = s.bg;
    badge.style.border = `1px solid ${s.color}33`;

    document.getElementById('d-desc').textContent = ev.description;

    document.getElementById('d-tags').innerHTML = ev.tags
        .map(t => `<span class="detail-tag">${t}</span>`).join('');

    // Swap placeholder → content
    const placeholder = document.getElementById('detail-placeholder');
    const content     = document.getElementById('detail-content');
    placeholder.style.display = 'none';
    content.style.display = 'block';
    content.style.opacity = '0';
    requestAnimationFrame(() => {
        content.style.transition = 'opacity .28s ease';
        content.style.opacity = '1';
    });
}

// ── Init ──────────────────────────────────────────────────────────────────
renderTimeline();
</script>
</body>
</html>

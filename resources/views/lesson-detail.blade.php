<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $lesson['number'] === 0 ? 'Setup' : 'Lesson ' . $lesson['number'] }} — {{ $lesson['title'] }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; padding: 40px 20px; }
        .container { max-width: 740px; margin: 0 auto; }

        /* Nav */
        .nav { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; }
        .nav a { color: #f97316; text-decoration: none; font-size: 0.85rem; }
        .nav a:hover { text-decoration: underline; }
        .nav-arrows { display: flex; gap: 12px; }
        .nav-btn { background: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 6px 14px; font-size: 0.8rem; color: #94a3b8; text-decoration: none; transition: all 0.2s; }
        .nav-btn:hover { border-color: #f97316; color: #f97316; }
        .nav-btn.disabled { opacity: 0.3; pointer-events: none; }

        /* Header */
        .header-meta { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .lesson-number { font-size: 0.75rem; font-weight: 700; color: #f97316; text-transform: uppercase; letter-spacing: 0.08em; }
        .tier-badge { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 3px 9px; border-radius: 999px; }
        .tier-badge.beginner     { background: #14532d; color: #4ade80; border: 1px solid #166534; }
        .tier-badge.intermediate { background: #431407; color: #fb923c; border: 1px solid #7c2d12; }
        .tier-badge.advanced     { background: #450a0a; color: #f87171; border: 1px solid #7f1d1d; }

        h1 { font-size: 1.8rem; font-weight: 700; color: #f8fafc; margin-bottom: 16px; line-height: 1.2; }
        .summary { color: #94a3b8; line-height: 1.7; font-size: 0.95rem; margin-bottom: 28px; }

        /* Progress bar */
        .progress-section { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 20px; margin-bottom: 32px; }
        .progress-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
        .progress-title { font-size: 0.85rem; color: #64748b; }
        .progress-pct { font-size: 0.85rem; font-weight: 700; color: #f97316; }
        .progress-track { background: #0f172a; border-radius: 99px; height: 8px; overflow: hidden; margin-bottom: 14px; }
        .progress-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg, #f97316, #fb923c); transition: width 0.4s ease; }
        .progress-fill.complete { background: linear-gradient(90deg, #22c55e, #4ade80); }
        .progress-controls { display: flex; gap: 8px; flex-wrap: wrap; }
        .pct-btn { background: #0f172a; border: 1px solid #334155; border-radius: 6px; padding: 5px 12px; font-size: 0.75rem; color: #64748b; cursor: pointer; transition: all 0.2s; }
        .pct-btn:hover { border-color: #f97316; color: #f97316; }
        .pct-btn.active { border-color: #f97316; color: #f97316; background: #1e293b; }
        .complete-btn { margin-left: auto; background: #f97316; border: none; border-radius: 6px; padding: 6px 16px; font-size: 0.8rem; color: white; cursor: pointer; font-weight: 600; transition: background 0.2s; display: flex; align-items: center; gap: 6px; }
        .complete-btn:hover { background: #ea6d0a; }
        .complete-btn.done { background: #22c55e; }
        .complete-btn.done:hover { background: #16a34a; }

        /* Section label */
        .section-label { font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 10px; }

        /* Steps */
        .steps-list { list-style: none; margin-bottom: 32px; display: flex; flex-direction: column; gap: 10px; }
        .step-item { display: flex; gap: 14px; align-items: flex-start; background: #1e293b; border: 1px solid #334155; border-radius: 10px; padding: 14px 16px; }
        .step-num { flex-shrink: 0; width: 24px; height: 24px; border-radius: 50%; background: #0f172a; border: 1px solid #f97316; color: #f97316; font-size: 0.7rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }
        .step-text { font-size: 0.88rem; color: #cbd5e1; line-height: 1.6; }
        .step-text code { background: #0f172a; border: 1px solid #334155; border-radius: 4px; padding: 1px 6px; font-family: 'SF Mono', monospace; font-size: 0.82em; color: #f97316; }

        /* Concepts */
        .tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px; }
        .tag { background: #1e293b; border: 1px solid #334155; border-radius: 999px; padding: 4px 12px; font-size: 0.78rem; color: #94a3b8; font-family: monospace; }

        /* Builds on */
        .builds-on { margin-bottom: 28px; }
        .builds-on-links { display: flex; flex-wrap: wrap; gap: 8px; }
        .builds-link { background: #1e293b; border: 1px solid #f9731622; border-radius: 8px; padding: 8px 14px; text-decoration: none; color: #f97316; font-size: 0.8rem; transition: all 0.2s; }
        .builds-link:hover { border-color: #f97316; background: #1e293b; }
        .builds-link span { color: #475569; font-size: 0.7rem; display: block; margin-top: 1px; }
        .no-deps { color: #475569; font-size: 0.85rem; font-style: italic; }

        /* Code snippet */
        .code-block { background: #020617; border: 1px solid #1e293b; border-radius: 10px; padding: 20px; margin-bottom: 28px; overflow-x: auto; }
        .code-block pre { font-family: 'SF Mono', 'Fira Code', 'Fira Mono', monospace; font-size: 0.82rem; color: #94a3b8; line-height: 1.7; white-space: pre; }
        .code-label { font-size: 0.7rem; color: #334155; margin-bottom: 10px; font-family: monospace; }

        /* Takeaway */
        .takeaway { background: #1e293b; border-left: 3px solid #f97316; border-radius: 0 10px 10px 0; padding: 16px 20px; margin-bottom: 32px; }
        .takeaway p { color: #cbd5e1; font-size: 0.9rem; line-height: 1.6; }

        /* Exercise */
        .exercise { background: #0c1220; border: 1px solid #3b82f6; border-radius: 12px; padding: 20px 22px; margin-bottom: 36px; }
        .exercise-header { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; }
        .exercise-icon { font-size: 1rem; }
        .exercise-label { font-size: 0.75rem; font-weight: 700; color: #3b82f6; text-transform: uppercase; letter-spacing: 0.08em; }
        .exercise-prompt { font-size: 0.9rem; color: #cbd5e1; line-height: 1.65; margin-bottom: 12px; }
        .exercise-hint { font-size: 0.8rem; color: #475569; line-height: 1.6; }
        .exercise-hint code { background: #0f172a; border: 1px solid #1e293b; border-radius: 4px; padding: 1px 6px; font-family: 'SF Mono', monospace; font-size: 0.82em; color: #64748b; }
        .hint-toggle { background: none; border: 1px solid #1e3a5f; color: #3b82f6; border-radius: 6px; padding: 5px 12px; font-size: 0.75rem; cursor: pointer; transition: all 0.2s; margin-bottom: 8px; }
        .hint-toggle:hover { background: #1e3a5f; }
        .hint-body { display: none; }
        .hint-body.visible { display: block; }

        /* Bottom nav */
        .bottom-nav { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 40px; }
        .bottom-nav a { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 16px; text-decoration: none; color: inherit; transition: border-color 0.2s; }
        .bottom-nav a:hover { border-color: #f97316; }
        .bottom-nav .dir { font-size: 0.7rem; color: #475569; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px; }
        .bottom-nav .btitle { font-size: 0.88rem; font-weight: 600; color: #f1f5f9; }
        .bottom-nav .num { font-size: 0.75rem; color: #f97316; margin-bottom: 3px; }
        .bottom-nav a:last-child { text-align: right; }
        .bottom-nav a.empty { opacity: 0; pointer-events: none; }
    </style>
</head>
<body>
    <div class="container">

        <div class="nav">
            <a href="/lessons">← All lessons</a>
            <div class="nav-arrows">
                @if ($prev)
                    <a href="/lessons/{{ \Illuminate\Support\Str::slug($prev['title']) }}" class="nav-btn">← {{ $prev['number'] === 0 ? 'Setup' : $prev['number'] }}</a>
                @else
                    <span class="nav-btn disabled">← prev</span>
                @endif
                @if ($next)
                    <a href="/lessons/{{ \Illuminate\Support\Str::slug($next['title']) }}" class="nav-btn">{{ $next['number'] === 0 ? 'Setup' : $next['number'] }} →</a>
                @else
                    <span class="nav-btn disabled">next →</span>
                @endif
            </div>
        </div>

        <div class="header-meta">
            <span class="lesson-number">
                {{ $lesson['number'] === 0 ? 'Setup' : 'Lesson ' . $lesson['number'] . ' of 22' }}
            </span>
            <span class="tier-badge {{ $lesson['tier'] }}">{{ ucfirst($lesson['tier']) }}</span>
        </div>
        <h1>{{ $lesson['title'] }}</h1>
        <p class="summary">{{ $lesson['summary'] }}</p>

        {{-- Progress --}}
        <div class="progress-section">
            <div class="progress-top">
                <span class="progress-title">Your progress on this lesson</span>
                <span class="progress-pct" id="pct-display">0%</span>
            </div>
            <div class="progress-track">
                <div class="progress-fill" id="progress-fill" style="width:0%"></div>
            </div>
            <div class="progress-controls">
                <button class="pct-btn" onclick="setProgress(25)">25%</button>
                <button class="pct-btn" onclick="setProgress(50)">50%</button>
                <button class="pct-btn" onclick="setProgress(75)">75%</button>
                <button class="complete-btn" id="complete-btn" onclick="toggleComplete()">
                    <svg width="12" height="10" viewBox="0 0 12 10" fill="none" id="tick-icon">
                        <path d="M1 5L4.5 8.5L11 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span id="complete-label">Mark complete</span>
                </button>
            </div>
        </div>

        {{-- Steps --}}
        @if (!empty($lesson['steps']))
            <p class="section-label">Steps — do this now</p>
            <ol class="steps-list">
                @foreach ($lesson['steps'] as $i => $step)
                    <li class="step-item">
                        <div class="step-num">{{ $i + 1 }}</div>
                        <div class="step-text">
                            @php
                                // Wrap backtick content in <code> tags
                                $formatted = preg_replace('/`([^`]+)`/', '<code>$1</code>', e($step));
                            @endphp
                            {!! $formatted !!}
                        </div>
                    </li>
                @endforeach
            </ol>
        @endif

        {{-- Key concepts --}}
        <p class="section-label">Key concepts in this lesson</p>
        <div class="tags">
            @foreach ($lesson['concepts'] as $concept)
                <span class="tag">{{ $concept }}</span>
            @endforeach
        </div>

        {{-- Builds on --}}
        <div class="builds-on">
            <p class="section-label">Builds on</p>
            @if (count($buildsOn) === 0)
                <p class="no-deps">This is the first lesson — no prior concepts required.</p>
            @else
                <div class="builds-on-links">
                    @foreach ($buildsOn as $dep)
                        <a href="/lessons/{{ \Illuminate\Support\Str::slug($dep['title']) }}" class="builds-link">
                            <span>{{ $dep['number'] === 0 ? 'Setup' : 'Lesson ' . $dep['number'] }}</span>
                            {{ $dep['title'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Code snippet --}}
        <p class="section-label">Code example</p>
        <div class="code-block">
            <div class="code-label">// PHP</div>
            <pre>{{ $lesson['snippet'] }}</pre>
        </div>

        {{-- Takeaway --}}
        <div class="takeaway">
            <p class="section-label" style="margin-bottom:8px">Key takeaway</p>
            <p>{{ $lesson['takeaway'] }}</p>
        </div>

        {{-- Exercise --}}
        @if (!empty($lesson['exercise']))
            <div class="exercise">
                <div class="exercise-header">
                    <span class="exercise-icon">⚡</span>
                    <span class="exercise-label">Exercise — write the code</span>
                </div>
                <p class="exercise-prompt">{{ $lesson['exercise']['prompt'] }}</p>
                @if (!empty($lesson['exercise']['hint']))
                    <button class="hint-toggle" onclick="toggleHint(this)">Show hint</button>
                    <div class="hint-body">
                        <p class="exercise-hint">
                            @php
                                $hint = preg_replace('/`([^`]+)`/', '<code>$1</code>', e($lesson['exercise']['hint']));
                            @endphp
                            {!! $hint !!}
                        </p>
                    </div>
                @endif
            </div>
        @endif

        {{-- Bottom navigation --}}
        <div class="bottom-nav">
            @if ($prev)
                <a href="/lessons/{{ \Illuminate\Support\Str::slug($prev['title']) }}">
                    <div class="dir">← Previous</div>
                    <div class="num">{{ $prev['number'] === 0 ? 'Setup' : 'Lesson ' . $prev['number'] }}</div>
                    <div class="btitle">{{ $prev['title'] }}</div>
                </a>
            @else
                <a class="empty"></a>
            @endif

            @if ($next)
                <a href="/lessons/{{ \Illuminate\Support\Str::slug($next['title']) }}">
                    <div class="dir">Next →</div>
                    <div class="num">{{ $next['number'] === 0 ? 'Setup' : 'Lesson ' . $next['number'] }}</div>
                    <div class="btitle">{{ $next['title'] }}</div>
                </a>
            @else
                <a class="empty"></a>
            @endif
        </div>

    </div>

    <script>
        const STORAGE_KEY = 'php_course_progress';
        const LESSON_NUM  = {{ $lesson['number'] }};

        function getProgress() {
            try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}; }
            catch { return {}; }
        }

        function saveProgress(pct) {
            const p = getProgress();
            p[LESSON_NUM] = pct;
            localStorage.setItem(STORAGE_KEY, JSON.stringify(p));
        }

        function render(pct) {
            const fill  = document.getElementById('progress-fill');
            const disp  = document.getElementById('pct-display');
            const btn   = document.getElementById('complete-btn');
            const label = document.getElementById('complete-label');
            const done  = pct >= 100;

            fill.style.width = pct + '%';
            fill.className   = 'progress-fill' + (done ? ' complete' : '');
            disp.textContent = pct + '%';
            disp.style.color = done ? '#22c55e' : '#f97316';

            btn.className   = 'complete-btn' + (done ? ' done' : '');
            label.textContent = done ? 'Completed!' : 'Mark complete';

            document.querySelectorAll('.pct-btn').forEach(b => {
                b.classList.toggle('active', parseInt(b.textContent) === pct);
            });
        }

        function setProgress(pct) {
            saveProgress(pct);
            render(pct);
        }

        function toggleComplete() {
            const p = getProgress();
            const current = p[LESSON_NUM] || 0;
            setProgress(current >= 100 ? 0 : 100);
        }

        function toggleHint(btn) {
            const body = btn.nextElementSibling;
            body.classList.toggle('visible');
            btn.textContent = body.classList.contains('visible') ? 'Hide hint' : 'Show hint';
        }

        const stored = getProgress()[LESSON_NUM] || 0;
        render(stored);
    </script>
</body>
</html>

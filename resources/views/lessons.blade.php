<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Course — From Zero to Laravel</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; padding: 40px 20px; }
        .container { max-width: 900px; margin: 0 auto; }

        h1 { font-size: 2rem; font-weight: 700; color: #f8fafc; margin-bottom: 6px; }
        .subtitle { color: #94a3b8; margin-bottom: 28px; font-size: 0.95rem; }
        .subtitle span { color: #f97316; font-weight: 600; }

        /* Overall progress */
        .progress-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .progress-label { font-size: 0.85rem; color: #94a3b8; }
        .progress-count { font-size: 0.85rem; color: #f97316; font-weight: 700; }
        .progress-bar-track { background: #1e293b; border-radius: 99px; height: 8px; margin-bottom: 40px; overflow: hidden; border: 1px solid #334155; }
        .progress-bar-fill { height: 100%; background: linear-gradient(90deg, #f97316, #fb923c); border-radius: 99px; transition: width 0.4s ease; }

        /* Tier section */
        .tier-section { margin-bottom: 44px; }
        .tier-header { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #1e293b; }
        .tier-badge { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; padding: 4px 10px; border-radius: 999px; }
        .tier-badge.beginner     { background: #14532d; color: #4ade80; border: 1px solid #166534; }
        .tier-badge.intermediate { background: #431407; color: #fb923c; border: 1px solid #7c2d12; }
        .tier-badge.advanced     { background: #450a0a; color: #f87171; border: 1px solid #7f1d1d; }
        .tier-title { font-size: 1.05rem; font-weight: 700; color: #f1f5f9; }
        .tier-meta  { font-size: 0.8rem; color: #475569; margin-left: auto; }

        /* Grid */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 12px; }

        /* Card */
        .card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 18px 18px 16px; text-decoration: none; color: inherit; display: block; transition: border-color 0.2s, transform 0.15s; position: relative; }
        .card:hover { border-color: #f97316; transform: translateY(-2px); }
        .card.done { border-color: #22c55e44; }
        .card.done:hover { border-color: #22c55e; }
        .card.setup { border-color: #6366f144; }
        .card.setup:hover { border-color: #6366f1; }

        .card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 8px; }
        .lesson-num { font-size: 0.7rem; font-weight: 700; color: #f97316; text-transform: uppercase; letter-spacing: 0.06em; }
        .card.done .lesson-num { color: #22c55e; }
        .card.setup .lesson-num { color: #6366f1; }

        .tick { width: 20px; height: 20px; border-radius: 50%; border: 2px solid #334155; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; background: transparent; }
        .card.done .tick { background: #22c55e; border-color: #22c55e; }
        .tick svg { display: none; }
        .card.done .tick svg { display: block; }

        .lesson-title { font-size: 0.9rem; font-weight: 600; color: #f1f5f9; line-height: 1.4; }

        .card-progress { margin-top: 12px; }
        .card-progress-track { background: #0f172a; border-radius: 99px; height: 4px; overflow: hidden; }
        .card-progress-fill { height: 100%; border-radius: 99px; background: #f97316; width: 0%; transition: width 0.4s ease; }
        .card.done .card-progress-fill { background: #22c55e; width: 100% !important; }
        .card-progress-label { font-size: 0.7rem; color: #475569; margin-top: 4px; }
        .card.done .card-progress-label { color: #22c55e; }

        .footer { margin-top: 48px; text-align: center; color: #475569; font-size: 0.8rem; line-height: 1.8; }
        .reset-btn { background: none; border: 1px solid #334155; color: #64748b; border-radius: 6px; padding: 6px 14px; font-size: 0.75rem; cursor: pointer; margin-top: 10px; transition: all 0.2s; }
        .reset-btn:hover { border-color: #ef4444; color: #ef4444; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP — From Zero to Laravel</h1>
        <p class="subtitle">
            <span>23 lessons</span> — install PHP, build a tracker app from scratch, and end up reading Laravel like a native.
        </p>

        <div class="progress-header">
            <span class="progress-label">Overall progress</span>
            <span class="progress-count" id="progress-text">0 / 23 complete</span>
        </div>
        <div class="progress-bar-track">
            <div class="progress-bar-fill" id="overall-bar" style="width:0%"></div>
        </div>

        @php
            $tiers = [
                'beginner'     => ['label' => 'Beginner',     'meta' => 'Lessons 0–8 · Core PHP'],
                'intermediate' => ['label' => 'Intermediate', 'meta' => 'Lessons 9–15 · OOP & Tooling'],
                'advanced'     => ['label' => 'Advanced',     'meta' => 'Lessons 16–22 · Pro Patterns & Laravel'],
            ];
        @endphp

        @foreach ($tiers as $tierKey => $tierInfo)
            @php
                $tierLessons = array_filter($lessons, fn($l) => $l['tier'] === $tierKey);
            @endphp
            <div class="tier-section">
                <div class="tier-header">
                    <span class="tier-badge {{ $tierKey }}">{{ $tierInfo['label'] }}</span>
                    <span class="tier-title">{{ $tierInfo['label'] }}</span>
                    <span class="tier-meta">{{ $tierInfo['meta'] }}</span>
                </div>
                <div class="grid">
                    @foreach ($tierLessons as $lesson)
                        @php $slug = \Illuminate\Support\Str::slug($lesson['title']); @endphp
                        <a href="/lessons/{{ $slug }}"
                           class="card {{ $lesson['number'] === 0 ? 'setup' : '' }}"
                           id="card-{{ $lesson['number'] }}"
                           data-num="{{ $lesson['number'] }}">
                            <div class="card-top">
                                <div class="lesson-num">
                                    {{ $lesson['number'] === 0 ? 'Setup' : 'Lesson ' . $lesson['number'] }}
                                </div>
                                <div class="tick">
                                    <svg width="10" height="8" viewBox="0 0 10 8" fill="none">
                                        <path d="M1 4L3.5 6.5L9 1" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="lesson-title">{{ $lesson['title'] }}</div>
                            <div class="card-progress">
                                <div class="card-progress-track">
                                    <div class="card-progress-fill" id="bar-{{ $lesson['number'] }}"></div>
                                </div>
                                <div class="card-progress-label" id="label-{{ $lesson['number'] }}">Not started</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="footer">
            Built with Laravel {{ app()->version() }} · PHP {{ PHP_VERSION }}
            <br>
            <button class="reset-btn" onclick="resetProgress()">Reset all progress</button>
        </div>
    </div>

    <script>
        const STORAGE_KEY = 'php_course_progress';
        const TOTAL = 23;

        function getProgress() {
            try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}; }
            catch { return {}; }
        }

        function renderProgress() {
            const progress = getProgress();
            let completed = 0;

            for (let num = 0; num <= 22; num++) {
                const pct    = progress[num] || 0;
                const isDone = pct >= 100;
                const card   = document.getElementById('card-' + num);
                const bar    = document.getElementById('bar-' + num);
                const label  = document.getElementById('label-' + num);

                if (!card) continue;

                if (isDone) {
                    card.classList.add('done');
                    completed++;
                    label.textContent = 'Complete';
                } else if (pct > 0) {
                    card.classList.remove('done');
                    bar.style.width = pct + '%';
                    label.textContent = 'In progress — ' + pct + '%';
                } else {
                    card.classList.remove('done');
                    bar.style.width = '0%';
                    label.textContent = 'Not started';
                }
            }

            const pct = Math.round((completed / TOTAL) * 100);
            document.getElementById('overall-bar').style.width = pct + '%';
            document.getElementById('progress-text').textContent = completed + ' / ' + TOTAL + ' complete';
        }

        function resetProgress() {
            if (confirm('Reset all lesson progress?')) {
                localStorage.removeItem(STORAGE_KEY);
                renderProgress();
            }
        }

        renderProgress();
    </script>
</body>
</html>

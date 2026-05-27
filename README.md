# php-codealong

A self-hosted code-along course that takes you from **installing PHP for the first time** to **reading and writing Laravel fluently** — in 23 structured lessons.

The course runs in your browser as a local web app. Each lesson has a plain-English explanation, a code example, step-by-step instructions to follow in your own editor, and an exercise to complete. Your progress is tracked automatically.

---

## What you'll build

Throughout the course you'll build a project called **`tracker/`** — a PHP lesson-tracking app — starting with a single `echo` statement and ending with a working router, Composer packages, and OOP architecture. By Lesson 22 you'll open this very Laravel app and recognise every pattern inside it.

| Tier | Lessons | Topics |
|---|---|---|
| 🟢 Beginner | 0–8 | Setup, echo, variables, operators, strings, control flow, loops, arrays, functions |
| 🟡 Intermediate | 9–15 | OOP, classes, inheritance, interfaces, traits, exceptions, namespaces, JSON, file I/O |
| 🔴 Advanced | 16–22 | Enums, generators, Composer packages, higher-order functions, slugify, build a router, Laravel |

---

## Prerequisites

You'll need the following before you start. If you don't have them, **Lesson 0 (Environment Setup) walks you through each one.**

| Tool | Version | Check |
|---|---|---|
| PHP | 8.1 or higher | `php --version` |
| Composer | 2.x | `composer --version` |
| Git | any | `git --version` |
| An IDE | VS Code recommended | — |

> **Mac:** Install PHP and Composer with Homebrew — `brew install php composer`
>
> **Windows:** Download PHP from [php.net](https://php.net/downloads) and Composer from [getcomposer.org](https://getcomposer.org)

---

## Getting started

### 1. Clone the repo

```bash
git clone https://github.com/thrillburn/php-codealong.git
cd php-codealong
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create your environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Set up the database

The app uses SQLite — no database server needed.

```bash
php artisan migrate
```

### 5. Start the local server

```bash
php artisan serve
```

Open your browser at **[http://localhost:8000/lessons](http://localhost:8000/lessons)**

That's it. The course is running.

---

## How to use it

### The course dashboard

Go to **`/lessons`** to see all 23 lessons grouped by tier. Each card shows your progress on that lesson. Click any card to open it.

### Inside a lesson

Each lesson page has five sections:

1. **Summary** — what this lesson is about and why it matters
2. **Steps** — numbered instructions to follow right now in your editor
3. **Key concepts** — the PHP features covered, shown as tags
4. **Code example** — a snippet you can read, copy, and run
5. **Exercise** — something to build yourself (tap "Show hint" if you get stuck)

### Tracking your progress

Use the progress bar at the top of each lesson to mark where you are — 25%, 50%, 75%, or complete. Progress is saved in your browser automatically. You can reset it any time from the dashboard.

### The `tracker/` project

Create a folder called `tracker/` somewhere on your machine — this is your personal project for the whole course. Each lesson's **Steps** section tells you exactly what to add to it. By Lesson 21 it will be a working PHP web app with its own router.

---

## Running the app again later

Next time you want to open the course, just run:

```bash
cd php-codealong
php artisan serve
```

Then go to [http://localhost:8000/lessons](http://localhost:8000/lessons).

---

## Pulling updates

If the course content is updated:

```bash
git pull
```

Your progress is stored in your browser's `localStorage` — it won't be affected by pulling new content.

---

## Project structure

```
php-codealong/
├── app/
│   └── Data/
│       └── Lessons.php        ← all 23 lessons live here
├── resources/
│   └── views/
│       ├── lessons.blade.php       ← course dashboard
│       ├── lesson-detail.blade.php ← individual lesson page
│       └── welcome.blade.php       ← home page
├── routes/
│   └── web.php                ← three routes: /, /lessons, /lessons/{slug}
└── .env.example               ← copy this to .env on first setup
```

The entire course content is in `app/Data/Lessons.php` as a plain PHP array. If you want to add notes, tweak a description, or add your own lessons — that's the only file you need to edit.

---

## Tech stack

- **PHP 8.1+**
- **Laravel 11** — routing, Blade templates, Artisan CLI
- **SQLite** — zero-config local database
- No npm, no build step, no JavaScript framework

---

## License

MIT — do whatever you like with it.

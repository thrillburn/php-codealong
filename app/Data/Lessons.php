<?php

namespace App\Data;

class Lessons
{
    public static function all(): array
    {
        return [
            // ── LESSON 0 ─────────────────────────────────────────────────────
            [
                'number'    => 0,
                'title'     => 'Environment Setup',
                'tier'      => 'beginner',
                'summary'   => 'Before writing a single line of PHP you need three things installed: PHP itself, Composer (the PHP package manager), and a code editor. This lesson gets your machine ready and confirms everything works.',
                'builds_on' => [],
                'concepts'  => ['PHP install', 'Composer', 'VS Code', 'PHP built-in server', 'terminal basics'],
                'snippet'   => '# Mac (Homebrew)
brew install php composer

# Windows — download from:
# https://php.net/downloads  (PHP)
# https://getcomposer.org    (Composer)

# Verify both installed correctly
php --version      # PHP 8.x.x
composer --version # Composer 2.x.x

# Create your course project folder
mkdir tracker && cd tracker

# Start PHP\'s built-in web server
php -S localhost:9000',
                'takeaway'  => 'php -S localhost:9000 is PHP\'s built-in development server — no Apache or Nginx needed. Every file in your folder is instantly served at localhost:9000. You\'ll use this throughout the course.',
                'steps'     => [
                    'Install PHP: on Mac run `brew install php`, on Windows download the installer from php.net. Run `php --version` to confirm it worked.',
                    'Install Composer: on Mac run `brew install composer`, on Windows use getcomposer.org. Run `composer --version` to confirm.',
                    'Open VS Code and install the "PHP Intelephense" extension (search in the Extensions panel). This gives you autocomplete and error highlighting.',
                    'Create a folder called `tracker/` on your Desktop — this is the project you\'ll build throughout all 22 lessons.',
                    'Open `tracker/` in VS Code (`File → Open Folder`), then open a terminal inside VS Code and run `php -S localhost:9000`.',
                    'Open your browser at `http://localhost:9000` — you\'ll see a directory listing. That means PHP is running. You\'re ready.',
                ],
                'exercise'  => [
                    'prompt' => 'Create a file called `test.php` inside `tracker/` with `<?php echo "PHP is working!";`. Open `localhost:9000/test.php` in your browser and confirm you see the message. Then delete `test.php` — it was just a sanity check.',
                    'hint'   => 'If you see the PHP code as plain text instead of running it, make sure the file starts with <?php and that your server is running.',
                ],
            ],

            // ── LESSON 1 ─────────────────────────────────────────────────────
            [
                'number'    => 1,
                'title'     => 'Hello World & echo',
                'tier'      => 'beginner',
                'summary'   => 'Every PHP file starts with <?php. The echo keyword sends output to the browser or terminal. Every statement ends with a semicolon — miss one and PHP throws a parse error.',
                'builds_on' => [],
                'concepts'  => ['echo', 'print', 'string interpolation', 'semicolons', '<?php tag'],
                'snippet'   => '<?php
$name = "Morgan";
echo "Hello, $name!";       // double quotes interpolate
echo \'Hello, \' . $name;    // dot concatenates',
                'takeaway'  => 'PHP is a server-side language — your code runs on the server and the output (HTML, JSON, text) is what gets sent back.',
                'steps'     => [
                    'Inside `tracker/`, create a file called `index.php`.',
                    'On line 1, type `<?php` — this tells PHP everything that follows is PHP code.',
                    'On line 2, type `echo "Welcome to my PHP tracker!";` and save.',
                    'In your terminal (with the server running), open `localhost:9000/index.php` — you should see your message.',
                    'Try changing the double quotes to single quotes: `echo \'Hello\';`. Both work, but single quotes don\'t interpolate variables.',
                ],
                'exercise'  => [
                    'prompt' => 'Make `index.php` output two lines: your name on the first line, and today\'s date on the second. Use PHP\'s built-in `date(\'Y-m-d\')` for the date — no variables needed yet.',
                    'hint'   => 'echo date(\'Y-m-d\'); — the format string Y-m-d means year-month-day.',
                ],
            ],

            // ── LESSON 2 ─────────────────────────────────────────────────────
            [
                'number'    => 2,
                'title'     => 'Variables & Data Types',
                'tier'      => 'beginner',
                'summary'   => 'Variables start with $. PHP is dynamically typed — you don\'t declare a type, PHP infers it from the value assigned. You can cast types explicitly when needed.',
                'builds_on' => [1],
                'concepts'  => ['$variables', 'int', 'float', 'string', 'bool', 'null', 'gettype()', 'type casting'],
                'snippet'   => '$age    = 28;          // int
$price  = 9.99;        // float
$name   = "Alice";     // string
$active = true;        // bool
$empty  = null;        // null

echo (int)"7" + 3;     // cast then add → 10',
                'takeaway'  => 'PHP\'s loose typing is powerful but can bite you — use === (strict comparison, covered in Lesson 3) whenever type matters.',
                'steps'     => [
                    'Open `index.php` and replace its content — you\'re building a data structure for one lesson.',
                    'Add: `$lesson_number = 1;` `$lesson_title = "Hello World";` `$is_complete = false;` `$progress = 0;`',
                    'Echo them together: `echo "$lesson_number: $lesson_title";`',
                    'Add `var_dump($is_complete);` — this shows you the type (bool) and value (false). Useful for debugging.',
                    'Try `echo gettype($lesson_number);` — it prints "integer". Do the same for each variable.',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `$summary` variable (a string describing the lesson) and a `$builds_on` variable set to `null` (lesson 1 has no prerequisites). Print all 6 variables with labels, e.g. "Title: Hello World".',
                    'hint'   => 'Use echo to print each one on its own line. You can use the newline character \\n inside double quotes.',
                ],
            ],

            // ── LESSON 3 ─────────────────────────────────────────────────────
            [
                'number'    => 3,
                'title'     => 'Operators',
                'tier'      => 'beginner',
                'summary'   => 'Operators act on the variables from Lesson 2. The most important distinction in PHP is == (loose, coerces types) vs === (strict, type must also match). Getting this wrong is the source of many PHP bugs.',
                'builds_on' => [1, 2],
                'concepts'  => ['arithmetic', 'comparison', '== vs ===', 'logical &&/||', 'modulo %', 'exponent **', 'spaceship <=>'],
                'snippet'   => 'var_dump(0 == "0");    // true  — types coerced
var_dump(0 === "0");   // false — int !== string

$a = 10 ** 3;          // 1000 (exponentiation)
$r = 10 % 3;           // 1   (remainder)
$c = 5 <=> 10;         // -1  (spaceship: left < right)',
                'takeaway'  => 'Always use === in comparisons unless you explicitly want type coercion. The spaceship operator <=> is used for sorting (Lesson 19).',
                'steps'     => [
                    'Add `$progress = 75;` to your `index.php` from Lesson 2.',
                    'Write `var_dump($progress == "75");` — what do you expect? Run it. Now write `var_dump($progress === "75");`. Different result — why?',
                    'Add a check: `if ($progress >= 100) { echo "Complete!"; } else { echo "In progress: $progress%"; }`',
                    'Try `$progress = $progress + 25;` then re-run. The lesson is now complete.',
                    'Use the shorthand: `$progress += 25;` — same result, fewer characters. PHP has +=, -=, *=, /= for all arithmetic operators.',
                ],
                'exercise'  => [
                    'prompt' => 'Add a second lesson (`$lesson2_progress = 0;`). Write a check that uses `&&` to test if BOTH lessons are complete. Print "Course done!" if true, or "Keep going — X% average" if not, where X is the average of the two progress values.',
                    'hint'   => 'Average = ($progress + $lesson2_progress) / 2. Use intdiv() if you want a whole number.',
                ],
            ],

            // ── LESSON 4 ─────────────────────────────────────────────────────
            [
                'number'    => 4,
                'title'     => 'Strings & String Functions',
                'tier'      => 'beginner',
                'summary'   => 'Strings are one of PHP\'s most-used types (Lesson 2). The standard library has dozens of built-in string functions. Single-quoted strings are literal — no interpolation. Double-quoted strings expand $variables.',
                'builds_on' => [1, 2, 3],
                'concepts'  => ['strlen', 'trim', 'strtolower/upper', 'str_replace', 'substr', 'strpos', 'heredoc', 'concatenation .'],
                'snippet'   => '$s = "  Hello World  ";
echo trim($s);                    // "Hello World"
echo strtoupper(trim($s));        // "HELLO WORLD"
echo str_replace("World","PHP", trim($s)); // "Hello PHP"
echo substr(trim($s), 6, 5);     // "World"

// Heredoc — multiline, variables interpolated
$text = <<<EOT
    Line one
    Line two
EOT;',
                'takeaway'  => 'PHP strings are byte arrays, not unicode-aware by default. For emoji or multilingual text, use the mbstring functions (mb_strlen, mb_strtolower).',
                'steps'     => [
                    'Set `$lesson_title = "  hello world & echo  ";` — messy input, like data you\'d get from a user or a file.',
                    'Chain functions to clean it: `echo strtolower(trim($lesson_title));`',
                    'Use `str_replace` to make it URL-safe: `echo str_replace([" ", "&"], ["-", "and"], trim($lesson_title));`',
                    'Check if a word appears: `var_dump(strpos($lesson_title, "echo") !== false);` — note: use !== false, not just if(strpos()), because strpos returns 0 for position 0 which is falsy.',
                    'Use `strlen` to see how long the title is before and after `trim`. The difference is the whitespace you stripped.',
                ],
                'exercise'  => [
                    'prompt' => 'Write a function-free "slug" — take your lesson title, lowercase it, trim whitespace, and replace spaces with hyphens using str_replace. The title "Hello World & echo" should become "hello-world-&-echo". (We\'ll improve this in Lesson 20.)',
                    'hint'   => 'strtolower(trim(str_replace(" ", "-", $title))) — chain them.',
                ],
            ],

            // ── LESSON 5 ─────────────────────────────────────────────────────
            [
                'number'    => 5,
                'title'     => 'Control Flow',
                'tier'      => 'beginner',
                'summary'   => 'Control flow decides which code runs. It combines variables (Lesson 2) and operators (Lesson 3) to branch logic. PHP 8\'s match expression is a strict, cleaner alternative to switch.',
                'builds_on' => [2, 3],
                'concepts'  => ['if/elseif/else', 'ternary ?:', 'null coalescing ??', 'match expression', 'switch'],
                'snippet'   => '$score = 78;
$grade = match(true) {
    $score >= 90 => "A",
    $score >= 80 => "B",
    $score >= 70 => "C",
    default      => "F",
};

// Null coalescing — essential for config & user input
$port = $config["port"] ?? 3306;',
                'takeaway'  => 'Prefer match over switch — it\'s strict (===), has no fall-through, and is an expression (can be assigned to a variable).',
                'steps'     => [
                    'Add `$progress = 75;` to your file. Use a ternary to set a status: `$status = $progress >= 100 ? "complete" : "in-progress";`',
                    'Now replace the ternary with a `match` expression that handles three states: 0 = "not started", 1-99 = "in progress", 100 = "complete".',
                    'Use the null coalescing operator: `$label = $lesson_title ?? "Untitled";` — set `$lesson_title = null;` first to see it kick in.',
                    'Write an `if/elseif/else` that prints a different message for each status. Then rewrite it as a `match($status)` — notice how much cleaner it reads.',
                    'Run both versions and confirm the output is identical. Delete the `if/elseif/else` version.',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `$tier` variable set to one of "beginner", "intermediate", or "advanced". Use a match expression to assign a colour code: beginner = "#22c55e", intermediate = "#f97316", advanced = "#ef4444". Echo: "Tier: beginner (#22c55e)".',
                    'hint'   => '$colour = match($tier) { "beginner" => "#22c55e", ... };',
                ],
            ],

            // ── LESSON 6 ─────────────────────────────────────────────────────
            [
                'number'    => 6,
                'title'     => 'Loops',
                'tier'      => 'beginner',
                'summary'   => 'Loops repeat code while a condition (Lesson 5) is true, or iterate over collections (Lesson 7). foreach is the idiomatic PHP way to iterate — you\'ll use it constantly.',
                'builds_on' => [2, 3, 5],
                'concepts'  => ['for', 'while', 'do-while', 'foreach', 'break', 'continue'],
                'snippet'   => '// for — when you know the count
for ($i = 0; $i < 5; $i++) { echo $i; }

// foreach — over any iterable (arrays, generators)
foreach ($items as $key => $value) {
    if ($value === "skip") continue;
    if ($value === "stop") break;
    echo "$key: $value\n";
}',
                'takeaway'  => 'do-while runs the body at least once before checking the condition — useful for "try at least once" logic like prompting for valid input.',
                'steps'     => [
                    'Create an array of lesson titles: `$titles = ["Hello World", "Variables", "Operators", "Strings", "Control Flow"];`',
                    'Loop over them with `foreach`: `foreach ($titles as $i => $title) { echo ($i+1) . ": $title\n"; }`',
                    'Add a `continue` to skip lesson 3: `if ($i === 2) continue;` — confirm "Operators" is missing from the output.',
                    'Change the foreach to add a `break` when you reach "Strings" — the loop should stop at lesson 3.',
                    'Rewrite the same output using a `for` loop with an index. Compare the two — which feels more readable?',
                ],
                'exercise'  => [
                    'prompt' => 'Loop through 22 lesson numbers (1-22) and print each one. If the number is divisible by 5 (hint: use % from Lesson 3), print "--- checkpoint ---" after it. Output should have checkpoints after lessons 5, 10, 15, and 20.',
                    'hint'   => 'if ($i % 5 === 0) — the modulo operator gives you the remainder.',
                ],
            ],

            // ── LESSON 7 ─────────────────────────────────────────────────────
            [
                'number'    => 7,
                'title'     => 'Arrays',
                'tier'      => 'beginner',
                'summary'   => 'PHP arrays are ordered maps — a single structure that acts as a list, dictionary, stack, or queue. Mastering array functions eliminates most manual loops. These are the backbone of nearly every PHP application.',
                'builds_on' => [2, 6],
                'concepts'  => ['indexed arrays', 'associative arrays', 'multidimensional', 'array_map', 'array_filter', 'array_reduce', 'sort/usort', 'implode/explode'],
                'snippet'   => '$users = [
    ["name" => "Alice", "age" => 28],
    ["name" => "Bob",   "age" => 34],
];

// map — transform each element
$names = array_map(fn($u) => $u["name"], $users);

// filter — keep matching elements
$adults = array_filter($users, fn($u) => $u["age"] >= 18);

// reduce — collapse to a single value
$total = array_reduce($users, fn($sum, $u) => $sum + $u["age"], 0);',
                'takeaway'  => 'array_map, array_filter, and array_reduce cover 80% of data transformation needs without a single manual loop. Arrow functions (fn, from Lesson 8) make these even cleaner.',
                'steps'     => [
                    'Replace your individual `$lesson_*` variables with a single associative array: `$lesson = ["number" => 1, "title" => "Hello World", "progress" => 0, "complete" => false];`',
                    'Access values: `echo $lesson["title"];` — square brackets, not ->. This is a plain array, not an object.',
                    'Create `$lessons` as an array of 3 such lesson arrays. Echo the title of each using `foreach`.',
                    'Use `array_filter` to get only incomplete lessons: `$incomplete = array_filter($lessons, fn($l) => !$l["complete"]);`',
                    'Use `array_map` to extract just the titles: `$titles = array_map(fn($l) => $l["title"], $lessons);` Then `echo implode(", ", $titles);`',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `progress` key (0-100) to each lesson array. Use `array_reduce` to calculate the average progress across all lessons. Print: "Average progress: 42%".',
                    'hint'   => 'array_reduce($lessons, fn($sum, $l) => $sum + $l["progress"], 0) / count($lessons)',
                ],
            ],

            // ── LESSON 8 ─────────────────────────────────────────────────────
            [
                'number'    => 8,
                'title'     => 'Functions',
                'tier'      => 'beginner',
                'summary'   => 'Functions wrap reusable logic (Lessons 1-7) into named, callable units. PHP 7.4+ type hints enforce argument and return types. Arrow functions (fn) capture outer scope implicitly, enabling the functional patterns in Lesson 19.',
                'builds_on' => [2, 3, 4, 5, 6, 7],
                'concepts'  => ['type hints', 'default params', 'variadic ...', 'return types', 'closures', 'arrow functions fn', 'first-class callables'],
                'snippet'   => '// Type-hinted, default param, typed return
function greet(string $name, string $hi = "Hello"): string {
    return "$hi, $name!";
}

// Variadic — any number of arguments
function sum(int ...$nums): int { return array_sum($nums); }

// Arrow function — $factor captured from outer scope
$multiplier = 3;
$triple = fn($n) => $n * $multiplier;',
                'takeaway'  => 'Functions are first-class in PHP — they can be stored in variables, passed as arguments, and returned from other functions. This is the foundation of Lesson 19.',
                'steps'     => [
                    'Extract your progress calculation from Lesson 7 into a function: `function averageProgress(array $lessons): float { ... }`',
                    'Add a type hint for the parameter and a return type: `array` in, `float` out.',
                    'Write `function formatLesson(array $lesson): string` that returns a formatted string like "1. Hello World (0%)".',
                    'Write `function countComplete(array $lessons): int` that returns how many have progress >= 100.',
                    'Try calling `formatLesson` inside `array_map`: `$formatted = array_map(\'formatLesson\', $lessons);` — functions can be passed by name as strings.',
                ],
                'exercise'  => [
                    'prompt' => 'Write a function `getStatus(int $progress): string` that returns "not started", "in progress", or "complete" (reusing your Lesson 5 match logic). Then write `function renderLesson(array $lesson): string` that uses `getStatus` and `formatLesson` internally and returns a full one-line summary.',
                    'hint'   => 'Functions can call other functions. Think of each function as a small, tested building block.',
                ],
            ],

            // ── LESSON 9 ─────────────────────────────────────────────────────
            [
                'number'    => 9,
                'title'     => 'OOP — Classes & Objects',
                'tier'      => 'intermediate',
                'summary'   => 'Object-Oriented Programming groups related data (properties) and behaviour (methods) into a class. An object is a running instance of that class. PHP 8\'s constructor promotion eliminates the boilerplate of declaring and assigning properties separately.',
                'builds_on' => [2, 8],
                'concepts'  => ['class', 'object', 'properties', 'methods', 'constructor promotion', 'visibility', '__toString', 'readonly'],
                'snippet'   => 'class BankAccount {
    private float $balance;

    public function __construct(
        private string $owner,   // promoted: declared + assigned
        float $initial = 0.0
    ) {
        $this->balance = $initial;
    }

    public function deposit(float $amount): void {
        $this->balance += $amount;
    }

    public function __toString(): string {
        return "{$this->owner}: \${$this->balance}";
    }
}',
                'takeaway'  => 'private means only this class can access it. public means anyone can. protected (Lesson 10) means this class and its children. Start everything private and loosen only when needed.',
                'steps'     => [
                    'Create a new file `Lesson.php` in `tracker/`. Define `class Lesson { }` inside it.',
                    'Add constructor promotion: `public function __construct(public readonly int $number, public string $title, public int $progress = 0) {}`',
                    'Add a method: `public function isComplete(): bool { return $this->progress >= 100; }`',
                    'Add `__toString`: `public function __toString(): string { return "$this->number: $this->title ($this->progress%)"; }`',
                    'Back in `index.php`, `require "Lesson.php";` then: `$l = new Lesson(1, "Hello World", 75); echo $l;`',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `getStatus(): string` method to your `Lesson` class that returns "not started", "in progress", or "complete" based on `$this->progress`. Create 3 Lesson objects with different progress values and print each one\'s status.',
                    'hint'   => 'Use your match logic from Lesson 5 inside the method. $this->progress gives you the current value.',
                ],
            ],

            // ── LESSON 10 ────────────────────────────────────────────────────
            [
                'number'    => 10,
                'title'     => 'Inheritance & Interfaces',
                'tier'      => 'intermediate',
                'summary'   => 'Inheritance lets a child class reuse and extend a parent class (Lesson 9). An interface defines a contract — "any class implementing this must have these methods" — without providing the implementation.',
                'builds_on' => [9],
                'concepts'  => ['extends', 'parent::', 'override', 'interface', 'implements', 'abstract', 'polymorphism'],
                'snippet'   => 'interface Printable {
    public function render(): string;   // contract — no body
}

class Animal {
    public function __construct(protected string $name) {}
    public function speak(): string { return "{$this->name} speaks."; }
}

class Dog extends Animal implements Printable {
    public function speak(): string {         // override
        return parent::speak() . " Woof!";   // + parent\'s version
    }
    public function render(): string {
        return "<dog>{$this->name}</dog>";
    }
}',
                'takeaway'  => 'Prefer interfaces over inheritance where possible — a class can implement many interfaces but only extend one parent. This avoids the "fragile base class" problem.',
                'steps'     => [
                    'Create `Trackable.php` with an interface: `interface Trackable { public function getProgress(): int; public function isComplete(): bool; }`',
                    'Make your `Lesson` class implement it: `class Lesson implements Trackable`.',
                    'Create a `CourseItem` base class with a `protected string $title` and a `getTitle(): string` method.',
                    'Have `Lesson extends CourseItem implements Trackable`. Call `parent::__construct($title)` from `Lesson`\'s constructor.',
                    'Create a second class `Module` that also extends `CourseItem implements Trackable` but represents a group of lessons.',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `render(): string` method to both `Lesson` and `Module` that returns an HTML list item — e.g. `<li>1. Hello World — 75%</li>`. Because both implement the same interface, you can call `render()` on either without knowing which type it is.',
                    'hint'   => 'This is polymorphism — the same method name works on different types. The caller doesn\'t need to know the concrete class.',
                ],
            ],

            // ── LESSON 11 ────────────────────────────────────────────────────
            [
                'number'    => 11,
                'title'     => 'Traits',
                'tier'      => 'intermediate',
                'summary'   => 'Traits solve the problem PHP classes have: you can only extend one parent (Lesson 10), but you often want to share methods across unrelated classes. A trait is like a "mixin" — a bundle of methods you paste into any class.',
                'builds_on' => [9, 10],
                'concepts'  => ['trait', 'use', 'multiple traits', 'conflict resolution', 'abstract trait methods'],
                'snippet'   => 'trait Timestamps {
    private ?string $createdAt = null;

    public function touch(): void {
        $this->createdAt ??= date("Y-m-d H:i:s");
    }
}

trait SoftDelete {
    private bool $deleted = false;
    public function delete(): void  { $this->deleted = true; }
    public function isDeleted(): bool { return $this->deleted; }
}

class Post {
    use Timestamps, SoftDelete;  // two traits, zero inheritance needed
}',
                'takeaway'  => 'In Laravel (Lesson 22), the HasFactory, Notifiable, and SoftDeletes traits are all over the codebase — you\'ll recognise them immediately now.',
                'steps'     => [
                    'Create `Timestamps.php` with a trait: `trait Timestamps { private string $updatedAt = ""; public function touch(): void { $this->updatedAt = date("Y-m-d H:i:s"); } public function getUpdatedAt(): string { return $this->updatedAt; } }`',
                    'Add `use Timestamps;` inside your `Lesson` class. Now every Lesson has `touch()` and `getUpdatedAt()` without any inheritance.',
                    'Call `$lesson->touch()` when you update progress, and print `$lesson->getUpdatedAt()` to confirm it records the timestamp.',
                    'Create a second trait `HasSlug` with a `getSlug(): string` method that lowercases and hyphenates `$this->title`.',
                    'Add `use Timestamps, HasSlug;` to `Lesson` — both traits active at once.',
                ],
                'exercise'  => [
                    'prompt' => 'Create a `Completable` trait with two methods: `markComplete(): void` (sets progress to 100 and calls `touch()` if available) and `reset(): void` (sets progress back to 0). Add it to Lesson. Confirm that after `markComplete()`, `isComplete()` returns true.',
                    'hint'   => 'Traits can call methods that exist on the class using them — even if those methods come from another trait. PHP resolves them at runtime.',
                ],
            ],

            // ── LESSON 12 ────────────────────────────────────────────────────
            [
                'number'    => 12,
                'title'     => 'Error Handling & Exceptions',
                'tier'      => 'intermediate',
                'summary'   => 'Exceptions are objects (Lesson 9) that represent something going wrong. try/catch lets you handle them gracefully. finally always runs — perfect for cleanup like closing database connections. Custom exception classes (Lesson 10 inheritance) make error types explicit.',
                'builds_on' => [9, 10],
                'concepts'  => ['try/catch/finally', 'throw', 'Exception class', 'custom exceptions', 'catch multiple types', 'set_exception_handler'],
                'snippet'   => 'class InsufficientFundsException extends RuntimeException {
    public function __construct(float $attempted, float $available) {
        parent::__construct(
            "Tried to withdraw \$$attempted but only \$$available available."
        );
    }
}

try {
    if ($amount > $balance) throw new InsufficientFundsException($amount, $balance);
    $balance -= $amount;
} catch (InsufficientFundsException $e) {
    echo "Caught: " . $e->getMessage();
} finally {
    echo "Transaction attempted.";  // always runs
}',
                'takeaway'  => 'Never catch Exception as a catch-all in production — you\'ll swallow bugs silently. Catch specific types and let unexpected exceptions surface.',
                'steps'     => [
                    'Create `InvalidProgressException.php`: `class InvalidProgressException extends InvalidArgumentException {}`',
                    'In `Lesson`, add validation to your progress setter: `if ($progress < 0 || $progress > 100) throw new InvalidProgressException("Progress must be 0-100, got: $progress");`',
                    'Wrap the problematic call in a try/catch: `try { $lesson->progress = 150; } catch (InvalidProgressException $e) { echo "Error: " . $e->getMessage(); }`',
                    'Add a `finally` block that prints "Validation complete." — confirm it runs whether or not an exception was thrown.',
                    'Try catching both `InvalidProgressException` and `TypeError` in one block using the pipe syntax: `catch (InvalidProgressException | TypeError $e)`.',
                ],
                'exercise'  => [
                    'prompt' => 'Create a `LessonNotFoundException` class. Write a function `findLesson(array $lessons, int $number): Lesson` that throws it if no lesson with that number exists. Call it with a number that doesn\'t exist and handle the exception gracefully — print a user-friendly message rather than letting PHP crash.',
                    'hint'   => 'foreach the lessons array looking for a match. If the loop finishes without finding one, throw the exception after the loop.',
                ],
            ],

            // ── LESSON 13 ────────────────────────────────────────────────────
            [
                'number'    => 13,
                'title'     => 'Namespaces & Autoloading',
                'tier'      => 'intermediate',
                'summary'   => 'As projects grow, class name collisions happen. Namespaces prefix class names with a path (like folders). Composer\'s PSR-4 autoloader maps those namespace paths to actual folders — eliminating every manual require() call.',
                'builds_on' => [9, 10, 12],
                'concepts'  => ['namespace', 'use', 'PSR-4', 'Composer autoload', 'composer.json', 'vendor/autoload.php'],
                'snippet'   => '// src/Models/User.php
namespace App\\Models;

class User { ... }

// src/Services/UserService.php
namespace App\\Services;
use App\\Models\\User;     // import by full namespace

class UserService {
    public function find(int $id): ?User { ... }
}

// composer.json — tells Composer where App\\ lives
// "autoload": { "psr-4": { "App\\\\": "src/" } }',
                'takeaway'  => 'The single line require __DIR__ . \'/vendor/autoload.php\' at the top of a PHP file activates Composer\'s autoloader for every installed package and your own classes.',
                'steps'     => [
                    'In `tracker/`, run `composer init` (accept defaults). This creates `composer.json`.',
                    'Add PSR-4 autoloading to `composer.json`: `"autoload": { "psr-4": { "Tracker\\\\": "src/" } }`',
                    'Move your `Lesson.php` into `tracker/src/Models/Lesson.php`. Add `namespace Tracker\\Models;` as the very first line after `<?php`.',
                    'Run `composer dump-autoload` in your terminal. This regenerates the autoloader map.',
                    'In `index.php`, replace all your `require` calls with a single: `require __DIR__ . \'/vendor/autoload.php\';`. Add `use Tracker\\Models\\Lesson;` at the top. Everything still works.',
                ],
                'exercise'  => [
                    'prompt' => 'Move your exceptions into `src/Exceptions/` with the namespace `Tracker\\Exceptions`. Create a `src/Services/LessonService.php` (namespace `Tracker\\Services`) with a `findOrFail(int $number): Lesson` method that uses your exception. Update `index.php` to use the service via `use` statements — no more manual requires.',
                    'hint'   => 'Run composer dump-autoload every time you add a new file or namespace.',
                ],
            ],

            // ── LESSON 14 ────────────────────────────────────────────────────
            [
                'number'    => 14,
                'title'     => 'JSON',
                'tier'      => 'intermediate',
                'summary'   => 'JSON is the universal format for APIs and config files. It maps directly to PHP arrays (Lesson 7): objects become associative arrays, arrays become indexed arrays. json_encode and json_decode are built into PHP — no package needed.',
                'builds_on' => [4, 7],
                'concepts'  => ['json_encode', 'json_decode', 'JSON_PRETTY_PRINT', 'json_last_error', 'API responses', 'config files'],
                'snippet'   => '// PHP array → JSON string
$data = ["name" => "Alice", "tags" => ["admin"]];
$json = json_encode($data, JSON_PRETTY_PRINT);

// JSON string → PHP array (true = associative array)
$decoded = json_decode($json, true);
echo $decoded["name"];   // Alice

// Safe decode with error check
$result = json_decode($untrustedInput, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    throw new \InvalidArgumentException("Invalid JSON");
}',
                'takeaway'  => 'In Laravel (Lesson 22), return response()->json($data) wraps json_encode and sets the correct Content-Type header automatically.',
                'steps'     => [
                    'Take your `$lessons` array from Lesson 7 and encode it: `$json = json_encode($lessons, JSON_PRETTY_PRINT);` then `echo $json;`.',
                    'Decode it back: `$decoded = json_decode($json, true);` — pass `true` to get an associative array, not an object.',
                    'Add a broken JSON string: `$bad = \'{"title": missing_quotes}\';` — run `json_decode($bad, true)` then check `json_last_error_msg()`. You should see an error.',
                    'Wrap your decode in a try/catch that throws `new InvalidArgumentException` if `json_last_error() !== JSON_ERROR_NONE`.',
                    'Write a `saveProgress(array $lessons, string $path): void` function that json_encodes the lessons and saves them to a file. We\'ll use this in Lesson 15.',
                ],
                'exercise'  => [
                    'prompt' => 'Build a mini "API response" function: `function jsonResponse(mixed $data, int $status = 200): string` that returns a JSON string with two keys: `"status"` (the integer) and `"data"` (the payload). Call it with your lessons array and print the result.',
                    'hint'   => 'json_encode(["status" => $status, "data" => $data], JSON_PRETTY_PRINT)',
                ],
            ],

            // ── LESSON 15 ────────────────────────────────────────────────────
            [
                'number'    => 15,
                'title'     => 'File I/O',
                'tier'      => 'intermediate',
                'summary'   => 'PHP can read, write, and manipulate files directly. Always use __DIR__ (the current file\'s directory) rather than relative paths — relative paths depend on where PHP is invoked from, not where the file lives.',
                'builds_on' => [4, 7, 12],
                'concepts'  => ['file_get_contents', 'file_put_contents', 'file()', 'FILE_APPEND', 'file_exists', 'unlink', '__DIR__'],
                'snippet'   => '$path = __DIR__ . "/data.txt";

// Write (overwrites)
file_put_contents($path, "Line 1\nLine 2\n");

// Append
file_put_contents($path, "Line 3\n", FILE_APPEND);

// Read entire file
$content = file_get_contents($path);

// Read into array of lines
$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Always check before reading untrusted paths
if (!file_exists($path)) throw new RuntimeException("Missing file");',
                'takeaway'  => 'In Laravel, the Storage facade wraps file I/O with drivers for local disk, S3, and more — so the same code works locally and in production.',
                'steps'     => [
                    'Use the `saveProgress` function you wrote in Lesson 14 to write your lessons array to `tracker/data/progress.json`.',
                    'Create a `loadProgress(string $path): array` function that reads the file, decodes the JSON, and returns the array.',
                    'Add a `file_exists` check — if the file doesn\'t exist yet, return an empty array instead of crashing.',
                    'Simulate a user completing a lesson: load progress, update one lesson\'s progress to 100, save it back. Reload and confirm the change persisted.',
                    'Add a simple log: every time progress is saved, append a line to `tracker/data/log.txt` with the current timestamp using `FILE_APPEND`.',
                ],
                'exercise'  => [
                    'prompt' => 'Refactor `saveProgress` and `loadProgress` into a `ProgressStore` class (in `src/Services/`) that has `save(array $lessons): void` and `load(): array` methods. The file path should be passed into the constructor and stored as a private property.',
                    'hint'   => 'private string $path in the constructor. Use $this->path inside save() and load().',
                ],
            ],

            // ── LESSON 16 ────────────────────────────────────────────────────
            [
                'number'    => 16,
                'title'     => 'Enums (PHP 8.1+)',
                'tier'      => 'advanced',
                'summary'   => 'Enums replace "magic strings" and integer constants with proper types. Instead of $status = "active" (a string that could be typo\'d), you use Status::Active (a type the compiler checks). Backed enums store a value; pure enums have identity only.',
                'builds_on' => [5, 9],
                'concepts'  => ['pure enum', 'backed enum', 'enum methods', 'from()', 'tryFrom()', 'enum in match'],
                'snippet'   => 'enum Status: string {
    case Active   = "active";
    case Inactive = "inactive";
    case Banned   = "banned";

    public function label(): string {
        return match($this) {
            Status::Active   => "Active user",
            Status::Inactive => "Inactive account",
            Status::Banned   => "Account suspended",
        };
    }
}

$s = Status::from("active");      // from DB value → enum
$s = Status::tryFrom("deleted");  // returns null if unknown',
                'takeaway'  => 'Enums are objects (Lesson 9) with match (Lesson 5) inside their methods — you can see the concepts stacking. Laravel\'s Eloquent supports casting DB columns to enums automatically.',
                'steps'     => [
                    'Create `src/Enums/LessonStatus.php` with `namespace Tracker\\Enums;` and a backed string enum: `enum LessonStatus: string { case NotStarted = "not_started"; case InProgress = "in_progress"; case Complete = "complete"; }`',
                    'Add a `label(): string` method using a match expression that returns a human-readable string for each case.',
                    'Update your `Lesson` class to use `LessonStatus` instead of a plain string. The `getStatus()` method now returns `LessonStatus` instead of `string`.',
                    'Try `LessonStatus::from("complete")` — it returns the enum case. Try `LessonStatus::tryFrom("invalid")` — it returns null instead of crashing.',
                    'Add a `colour(): string` method to the enum that returns a hex colour code for each status. Use this when rendering the lesson card.',
                ],
                'exercise'  => [
                    'prompt' => 'Create a `Tier` enum (backed by string) with cases: Beginner, Intermediate, Advanced. Add a `lessonRange(): string` method that returns "1–8", "9–15", or "16–22". Add a `$tier` property to your `Lesson` class that uses this enum.',
                    'hint'   => 'Tier::Beginner->lessonRange() should return "1–8". The method lives on the enum itself.',
                ],
            ],

            // ── LESSON 17 ────────────────────────────────────────────────────
            [
                'number'    => 17,
                'title'     => 'Generators & yield',
                'tier'      => 'advanced',
                'summary'   => 'A generator (Lesson 8 — it\'s a special function) produces values one at a time using yield, pausing between each. Unlike returning an array (Lesson 7), it never loads the full dataset into memory. Essential for large files, paginated APIs, or infinite sequences.',
                'builds_on' => [6, 7, 8],
                'concepts'  => ['yield', 'Generator object', 'current/next/send', 'infinite sequences', 'memory efficiency', 'lazy evaluation'],
                'snippet'   => '// Infinite counter — impossible as a plain array
function integers(int $start = 0): Generator {
    while (true) yield $start++;
}

$gen = integers(1);
echo $gen->current();  // 1
$gen->next();
echo $gen->current();  // 2

// Process a huge CSV without loading it all
function readCsvRows(string $file): Generator {
    $handle = fopen($file, "r");
    while (($row = fgetcsv($handle)) !== false) {
        yield $row;
    }
    fclose($handle);
}',
                'takeaway'  => 'PHP\'s foreach (Lesson 6) works directly on any Generator — it calls current() and next() automatically. Laravel\'s Cursor queries use generators under the hood.',
                'steps'     => [
                    'Write a generator `lessonNumbers(int $from, int $to): Generator` that yields each integer from $from to $to.',
                    'Use it in a foreach: `foreach (lessonNumbers(1, 22) as $n) { echo $n . "\\n"; }` — notice it looks identical to iterating an array.',
                    'Add memory monitoring: `echo memory_get_usage();` before and after. Compare it to building an array of 22 items — the difference is tiny here, but scales dramatically with large datasets.',
                    'Write a `paginateLessons(array $lessons, int $pageSize): Generator` that yields one page (a slice of the array) at a time.',
                    'Use `send()` to pass a value back into the generator: make a generator that accepts a "stop" signal via `$signal = yield $lesson;` and breaks if signal equals "stop".',
                ],
                'exercise'  => [
                    'prompt' => 'Write a `streamProgressLog(string $path): Generator` that reads your `log.txt` file (from Lesson 15) one line at a time using `fgets()` and yields each line. This means even a 1GB log file never fully loads into memory.',
                    'hint'   => '$handle = fopen($path, "r"); while (!feof($handle)) { yield fgets($handle); } fclose($handle);',
                ],
            ],

            // ── LESSON 18 ────────────────────────────────────────────────────
            [
                'number'    => 18,
                'title'     => 'Composer Packages — Carbon',
                'tier'      => 'advanced',
                'summary'   => 'Carbon is the most downloaded PHP package for date/time manipulation. It wraps PHP\'s built-in DateTime with a fluent, readable API. Installing it demonstrates the full Composer workflow: require, autoload (Lesson 13), and use.',
                'builds_on' => [4, 8, 9, 13],
                'concepts'  => ['Carbon::now()', 'addDay/subWeek', 'parse()', 'diffForHumans()', 'format()', 'date periods', 'composer require'],
                'snippet'   => 'use Carbon\Carbon;

$now = Carbon::now();
echo $now->toDateTimeString();          // 2026-05-22 10:00:00
echo $now->addDays(7)->toDateString();  // 2026-05-29
echo $now->diffForHumans();             // "just now"

// Parse natural language
$meeting = Carbon::parse("next Monday 9am");

// Iterate a date range
foreach (Carbon::parse("2026-01-01")->daysUntil("2026-01-05") as $day) {
    echo $day->toDateString() . "\n";
}',
                'takeaway'  => 'Every Composer package follows the same pattern: composer require → vendor/autoload.php loads it → use the class. Carbon just happens to be the best example of a package that saves you from writing 200 lines yourself.',
                'steps'     => [
                    'In your `tracker/` folder, run: `composer require nesbot/carbon`. Watch Composer resolve and download it into `vendor/`.',
                    'Open `vendor/nesbot/carbon/src/Carbon/Carbon.php` — this is real production PHP. You can read it because you now understand OOP (Lesson 9), traits (Lesson 11), and namespaces (Lesson 13).',
                    'Add `use Carbon\\Carbon;` to `index.php` and try: `echo Carbon::now()->diffForHumans();`',
                    'Update your `Timestamps` trait (Lesson 11) to use `Carbon::now()->toDateTimeString()` instead of `date()`.',
                    'Add a `$startedAt` Carbon property to `Lesson`. When `touch()` is called for the first time, set it. Display "Started 3 days ago" using `diffForHumans()`.',
                ],
                'exercise'  => [
                    'prompt' => 'Add a `$completedAt` property to `Lesson` that stores a Carbon instance when `markComplete()` is called. Write a method `timeToComplete(): ?string` that returns null if not complete, or a human string like "Completed in 2 days" based on the difference between `$startedAt` and `$completedAt`.',
                    'hint'   => '$this->completedAt->diffForHumans($this->startedAt) — Carbon\'s diff methods accept another Carbon as a reference point.',
                ],
            ],

            // ── LESSON 19 ────────────────────────────────────────────────────
            [
                'number'    => 19,
                'title'     => 'Higher-Order Functions',
                'tier'      => 'advanced',
                'summary'   => 'Higher-order functions take other functions as arguments or return them. This builds on closures (Lesson 8) and array functions (Lesson 7). The spaceship operator <=> from Lesson 3 is the basis of all custom sorting here.',
                'builds_on' => [3, 7, 8],
                'concepts'  => ['closures as arguments', 'function factories', 'pipeline pattern', 'usort + spaceship', 'memoization', 'partial application'],
                'snippet'   => '// Factory — returns a configured closure
function makeMultiplier(int $factor): Closure {
    return fn($n) => $n * $factor;   // $factor captured
}
$double = makeMultiplier(2);
echo $double(7);   // 14

// Pipeline — chain transforms
function pipeline(mixed $val, callable ...$fns): mixed {
    foreach ($fns as $fn) $val = $fn($val);
    return $val;
}
echo pipeline("  Hello World  ", "trim", "strtolower");  // "hello world"

// Sort objects by property using spaceship <=>
usort($users, fn($a, $b) => $a["age"] <=> $b["age"]);',
                'takeaway'  => 'Memoization (caching a function\'s result by input) is a pattern used in Laravel\'s once() helper and many performance-critical libraries — and it\'s just a closure wrapping another closure.',
                'steps'     => [
                    'Write a `sortBy(string $key): Closure` factory that returns a comparator for `usort`. Use it: `usort($lessons, sortBy("number"));`',
                    'Write a `pipeline` function that chains callables. Test it: `pipeline("  Hello World  ", "trim", "strtolower", fn($s) => str_replace(" ", "-", $s))` → "hello-world".',
                    'Write a `memoize(callable $fn): Closure` that caches results by argument. Test with a slow function (add `usleep(100000)`) — second call should be instant.',
                    'Write a `filterBy(string $key, mixed $value): Closure` factory. Use it: `$beginnerLessons = array_filter($lessons, filterBy("tier", "beginner"));`',
                    'Combine them: use your `pipeline` to take raw lesson data, sort it, filter it, and format it — all without a single loop in the calling code.',
                ],
                'exercise'  => [
                    'prompt' => 'Write a `groupBy(string $key): Closure` function that takes an array and groups it into a nested array by the value of a given key. `groupBy("tier")($lessons)` should return `["beginner" => [...], "intermediate" => [...], "advanced" => [...]]`.',
                    'hint'   => 'array_reduce is perfect here. Build an associative array where each key is a tier and each value is an array of lessons with that tier.',
                ],
            ],

            // ── LESSON 20 ────────────────────────────────────────────────────
            [
                'number'    => 20,
                'title'     => 'Slugify — from scratch',
                'tier'      => 'advanced',
                'summary'   => 'A slug is a URL-safe string. Building it from scratch shows how string functions (Lesson 4), regular expressions (a type of operator on strings, Lesson 3), and step-by-step transforms combine. No package needed for English — but packages handle multilingual edge cases.',
                'builds_on' => [3, 4, 8],
                'concepts'  => ['strtolower', 'iconv transliteration', 'preg_replace', 'trim', 'regular expressions', 'cocur/slugify package'],
                'snippet'   => 'function slugify(string $text): string {
    $text = strtolower($text);
    // transliterate accented chars → ASCII
    $text = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $text);
    // replace non-alphanumeric runs with a hyphen
    $text = preg_replace("/[^a-z0-9]+/", "-", $text);
    // strip leading/trailing hyphens
    return trim($text, "-");
}

slugify("Hello World!")          // "hello-world"
slugify("PHP 8.5 is FAST!!!")    // "php-8-5-is-fast"
slugify("Morgan\'s Blog Post")    // "morgan-s-blog-post"
// (apostrophe → hyphen is where cocur/slugify improves on this)',
                'takeaway'  => 'preg_replace is the key — [^a-z0-9]+ is a regex meaning "one or more characters that are NOT a-z or 0-9". The + is a quantifier meaning "one or more".',
                'steps'     => [
                    'Write the slugify function step by step — lowercase first, then iconv, then preg_replace, then trim. Test each step independently.',
                    'Test it on lesson titles from your tracker: "OOP — Classes & Objects" should become "oop-classes-objects".',
                    'Open `localhost:9000/lessons/oop-classes-objects` in your head — this is how URL routing will use your slug in Lesson 21.',
                    'Add `getSlug(): string` to your `Lesson` class using this function. Replace the simpler version you wrote in the `HasSlug` trait (Lesson 11).',
                    'Run `composer require cocur/slugify` and compare its output to yours on edge cases like "Ñoño" or "日本語". Your version handles ASCII only; the package handles all of Unicode.',
                ],
                'exercise'  => [
                    'prompt' => 'Write a `slugToTitle(array $lessons): array` function that returns an associative array mapping each lesson\'s slug to the lesson array itself — e.g. `["hello-world" => [...], "variables-data-types" => [...]]`. This is the data structure a router needs to look up a lesson by URL.',
                    'hint'   => 'array_combine(array_map(fn($l) => $l->getSlug(), $lessons), $lessons) — or use array_reduce if you prefer.',
                ],
            ],

            // ── LESSON 21 ────────────────────────────────────────────────────
            [
                'number'    => 21,
                'title'     => 'Build a Router from scratch',
                'tier'      => 'advanced',
                'summary'   => 'A router is the heart of every web framework. It maps an incoming URL + HTTP method to a piece of code. Building one from scratch — using classes (Lesson 9), closures (Lesson 8), and regular expressions (Lesson 20) — demystifies Laravel\'s Route::get() completely.',
                'builds_on' => [5, 8, 9, 19, 20],
                'concepts'  => ['route registration', 'regex path matching', 'named parameters {id}', 'HTTP methods', 'dispatch', '404 handling'],
                'snippet'   => 'class Router {
    private array $routes = [];

    public function get(string $path, callable $handler): void {
        $this->routes["GET"][$path] = $handler;
    }

    private function pathToRegex(string $path): string {
        return "#^" . preg_replace("/\{([a-z]+)\}/", "(?P<$1>[^/]+)", $path) . "$#";
    }

    public function dispatch(string $method, string $uri): string {
        foreach ($this->routes[$method] ?? [] as $path => $fn) {
            if (preg_match($this->pathToRegex($path), $uri, $m)) {
                return $fn(array_filter($m, "is_string", ARRAY_FILTER_USE_KEY));
            }
        }
        return "404 Not Found";
    }
}
// This is Route::get() in Laravel — same concept, more features.',
                'takeaway'  => 'Open routes/web.php in this Laravel app. Every Route::get() call is doing exactly what your Router::get() does — registering a path and a handler. The concepts are identical.',
                'steps'     => [
                    'Create `src/Router.php` with the `Router` class above. Copy it exactly first, then read each method and make sure you understand it.',
                    'In `index.php`, create a `$router = new Router();` and register two routes: `$router->get("/lessons", fn() => "list all lessons");` and `$router->get("/lessons/{slug}", fn($params) => "show lesson: " . $params["slug"]);`',
                    'Get the current URL from `$_SERVER["REQUEST_URI"]` and dispatch: `echo $router->dispatch($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"]);`',
                    'Make the `/lessons` route return real HTML — loop over your lessons array and output a list of links.',
                    'Make the `/lessons/{slug}` route look up the lesson by slug (using your `slugToTitle` map from Lesson 20) and render it. Return "404 Not Found" if the slug doesn\'t match.',
                ],
                'exercise'  => [
                    'prompt' => 'Now open `routes/web.php` in THIS Laravel app (the one you\'re looking at right now). You\'ll see `Route::get(\'/lessons/{slug}\', ...)`. Compare it line-by-line to your `$router->get(\'/lessons/{slug}\', ...)`. They are the same pattern. Write a short comment in your `Router.php` explaining what Laravel adds on top of your version.',
                    'hint'   => 'Laravel adds: middleware, named routes, route groups, dependency injection into handlers, and caching. But the core pattern — register a path + handler, match with regex, extract params — is identical to what you built.',
                ],
            ],

            // ── LESSON 22 ────────────────────────────────────────────────────
            [
                'number'    => 22,
                'title'     => 'What a Framework gives you',
                'tier'      => 'advanced',
                'summary'   => 'A framework is not magic — it is every concept from Lessons 1-21 organised into conventions. Laravel\'s Router is Lesson 21. Eloquent is Lesson 9 classes connected to a database. Blade templates are Lesson 5 control flow in HTML. Migrations are version control for your schema.',
                'builds_on' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
                'concepts'  => ['Eloquent ORM', 'Blade templates', 'Migrations', 'Artisan CLI', 'DI Container', 'Middleware', 'Queues', 'Service Providers'],
                'snippet'   => '// Eloquent (Lesson 9 OOP + database)
$user = User::find(42);           // SELECT * FROM users WHERE id = 42
$user->posts()->published()->get(); // JOIN, filtered

// Blade (Lesson 5 control flow in HTML)
// @foreach ($users as $user)
//   <li>{{ $user->name }}</li>   ← auto-escaped
// @endforeach

// Migrations (Lesson 15 File I/O for schema)
// php artisan make:migration create_posts_table
// php artisan migrate
// php artisan migrate:rollback',
                'takeaway'  => 'You now understand PHP from the ground up. Every line of Laravel code traces back to a concept you have studied. The framework\'s job is to apply those concepts consistently across a full application.',
                'steps'     => [
                    'Open the Laravel app you\'ve been using for this course (`my_laravel_app/`). Look at `app/Data/Lessons.php` — it\'s a plain PHP class (Lesson 9) returning an array (Lesson 7).',
                    'Open `routes/web.php` — three `Route::get()` calls. This is your Lesson 21 router. Laravel\'s version handles middleware, auth, caching, and 200 other things, but the pattern is identical.',
                    'Open `resources/views/lessons.blade.php` — find the `@foreach`. It\'s your Lesson 6 loop. `{{ $lesson[\'title\'] }}` is your Lesson 1 echo, with auto HTML-escaping added.',
                    'Run `php artisan route:list` in the terminal inside `my_laravel_app/`. See your three routes listed. Now run `php artisan tinker` and type `app()->version()` — you\'re in a PHP REPL inside your app.',
                    'You\'ve now built the tracker app twice: once from scratch (Lessons 1-21) and once with Laravel (this app). You understand both. The framework saves time; your knowledge explains why.',
                ],
                'exercise'  => [
                    'prompt' => 'Final challenge: add a fourth route to this Laravel app — `Route::get(\'/progress\', ...)` — that returns a JSON response (Lesson 14 style) with a summary of all 23 lessons: total count, how many are in each tier, and the list of concept tags across all lessons. Return it with `response()->json($data)`.',
                    'hint'   => 'Use array_map, array_filter, and array_reduce (Lesson 7/19) to build the summary from Lessons::all(). response()->json() is Laravel\'s wrapper around json_encode.',
                ],
            ],
        ];
    }

    public static function find(string $slug): ?array
    {
        foreach (self::all() as $lesson) {
            if (\Illuminate\Support\Str::slug($lesson['title']) === $slug) {
                return $lesson;
            }
        }
        return null;
    }

    public static function findByNumber(int $number): ?array
    {
        foreach (self::all() as $lesson) {
            if ($lesson['number'] === $number) return $lesson;
        }
        return null;
    }
}

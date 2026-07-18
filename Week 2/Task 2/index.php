<?php

declare(strict_types=1);
require_once 'Post.php';
require_once 'Comment.php';

use wad\Post;
use wad\Comment;

// $testPost = new Post(1, 2);

$posts = [
    new Post("alice123", "Just finished learning the basics of PHP!", new DateTimeImmutable("2026-07-18"), [
        new Comment("user1", "Great work!"),
        new Comment("user2", "PHP is a useful language."),
        new Comment("user3", "Keep going!")
    ]),
    new Post("bob_dev", "Working on my first Laravel application.", new DateTimeImmutable("2026-07-17"), [
        new Comment("user4", "What are you building?"),
        new Comment("user5", "Laravel is great for web applications.")
    ]),
    new Post("charlie_codes", "Does anyone have recommendations for learning databases?", new DateTimeImmutable("2026-07-16"), [
        new Comment("user6", "Start with MySQL."),
        new Comment("user7", "Learn basic SQL queries first."),
        new Comment("user8", "PostgreSQL is also a good option.")
    ])
]
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Social Feed</title>

    <!-- Tailwind CSS Play CDN for prototyping -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

    <!-- Navigation bar -->
    <nav class="sticky top-0 z-10 border-b border-slate-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6">

            <a href="index.html" class="text-xl font-bold text-blue-600">
                SocialFeed
            </a>

            <div class="flex items-center gap-3 sm:gap-6">

                <a href="index.html" class="hidden text-sm font-medium text-blue-600 sm:block">
                    Home
                </a>

                <a href="#" class="hidden text-sm font-medium text-slate-600 hover:text-blue-600 sm:block">
                    Explore
                </a>

                <!-- Link to profile.html -->
                <a href="profile.html" aria-label="Open profile"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-sm font-semibold text-blue-700 hover:bg-blue-200">
                    LN
                </a>

            </div>
        </div>
    </nav>

    <!--
    Mobile: one column
    Desktop: feed and sidebar
  -->
    <main
        class="mx-auto grid max-w-6xl grid-cols-1 gap-6 px-4 py-6 sm:px-6 lg:grid-cols-[minmax(0,2fr)_minmax(280px,1fr)]">

        <!-- Main feed -->
        <section class="min-w-0">

            <!-- New Post form -->
            <form class="mb-6 rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">

                <div class="mb-4 flex items-center gap-3">

                    <a href="profile.html" aria-label="Open profile"
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-100 font-semibold text-blue-700 hover:bg-blue-200">
                        LN
                    </a>

                    <div>
                        <h1 class="font-semibold text-slate-900">
                            Create a new post
                        </h1>

                        <p class="text-sm text-slate-500">
                            Share something with the community.
                        </p>
                    </div>

                </div>

                <label for="post-content" class="sr-only">
                    Post content
                </label>

                <textarea id="post-content" name="post-content" rows="4" placeholder="What are you working on?"
                    class="w-full resize-none rounded-lg border border-slate-300 p-3 text-sm outline-none placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"></textarea>

                <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex gap-2">
                        <button type="button" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">
                            Add image
                        </button>

                        <button type="button" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">
                            Add link
                        </button>
                    </div>

                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Publish post
                    </button>

                </div>
            </form>

            <!-- Feed heading -->
            <div class="mb-4 flex items-center justify-between">

                <h2 class="text-lg font-bold">
                    Latest posts
                </h2>

                <select aria-label="Sort posts"
                    class="rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm outline-none focus:border-blue-500">
                    <option>Newest</option>
                    <option>Most popular</option>
                </select>

            </div>

            <!-- Posts -->
            <div class="space-y-5">
                <?php foreach ($posts as $post): ?>
                    <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm sm:p-6">

                        <div class="mb-3 flex items-center gap-3">

                            <a href="profile.html"
                                aria-label="Open profile"
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-100 font-semibold text-blue-700 hover:bg-blue-200">

                                <?= htmlspecialchars(
                                    strtoupper(substr($post->getAuthor(), 0, 2)),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </a>

                            <div>
                                <h3 class="font-semibold text-slate-900">
                                    <?= htmlspecialchars(
                                        $post->getAuthor(),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </h3>

                                <p class="text-sm text-slate-500">
                                    <?= htmlspecialchars(
                                        $post->getCreatedAt()->format('d M Y'),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </p>
                            </div>

                        </div>

                        <p class="mb-4 text-slate-800">
                            <?= htmlspecialchars(
                                $post->getContent(),
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </p>

                        <p class="text-sm text-slate-500">
                            This post has <?=$post->getCommentCount() ?> comments.
                        </p>

                        <?php if ($post->getCommentCount() > 0): ?>
                            <div class="space-y-3 border-t border-slate-200 pt-4">

                                <?php foreach ($post->getComments() as $comment): ?>
                                    <div class="rounded-lg bg-slate-50 p-3">

                                        <div class="flex items-center justify-between gap-4">

                                            <p class="text-sm font-semibold text-slate-700">
                                                <?= htmlspecialchars(
                                                    $comment->getAuthor(),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                <?= htmlspecialchars(
                                                    $comment->getCreatedAt()->format('d M Y, g:i A'),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>
                                            </p>

                                        </div>

                                        <p class="mt-1 text-sm text-slate-600">
                                            <?= htmlspecialchars(
                                                $comment->getContent(),
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        </p>

                                    </div>
                                <?php endforeach; ?>

                            </div>
                        <?php else: ?>
                            <p class="border-t border-slate-200 pt-4 text-sm text-slate-400">
                                No comments yet.
                            </p>
                        <?php endif; ?>

                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Sidebar -->
        <aside class="space-y-6">

            <!-- Profile summary -->
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <a href="profile.html" class="group flex items-center gap-3 rounded-lg">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 font-bold text-blue-700 group-hover:bg-blue-200">
                        LN
                    </div>

                    <div>
                        <h2 class="font-semibold group-hover:text-blue-600">
                            Linh Nguyen
                        </h2>

                        <p class="text-sm text-slate-500">
                            Backend Developer
                        </p>
                    </div>
                </a>

                <div class="mt-5 grid grid-cols-3 gap-2 text-center">

                    <div>
                        <p class="font-bold">128</p>
                        <p class="text-xs text-slate-500">Posts</p>
                    </div>

                    <div>
                        <p class="font-bold">842</p>
                        <p class="text-xs text-slate-500">Followers</p>
                    </div>

                    <div>
                        <p class="font-bold">315</p>
                        <p class="text-xs text-slate-500">Following</p>
                    </div>

                </div>

                <a href="profile.html"
                    class="mt-5 block rounded-lg border border-blue-600 px-4 py-2 text-center text-sm font-semibold text-blue-600 hover:bg-blue-50">
                    View profile
                </a>

            </section>

            <!-- Trending topics -->
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <h2 class="mb-4 font-bold">
                    Trending topics
                </h2>

                <div class="space-y-4">

                    <a href="#" class="block rounded-lg p-2 hover:bg-slate-50">
                        <p class="text-sm font-semibold text-slate-800">
                            #webdevelopment
                        </p>

                        <p class="text-xs text-slate-500">
                            2,418 posts
                        </p>
                    </a>

                    <a href="#" class="block rounded-lg p-2 hover:bg-slate-50">
                        <p class="text-sm font-semibold text-slate-800">
                            #tailwindcss
                        </p>

                        <p class="text-xs text-slate-500">
                            1,205 posts
                        </p>
                    </a>

                    <a href="#" class="block rounded-lg p-2 hover:bg-slate-50">
                        <p class="text-sm font-semibold text-slate-800">
                            #backend
                        </p>

                        <p class="text-xs text-slate-500">
                            984 posts
                        </p>
                    </a>

                    <a href="#" class="block rounded-lg p-2 hover:bg-slate-50">
                        <p class="text-sm font-semibold text-slate-800">
                            #opensource
                        </p>

                        <p class="text-xs text-slate-500">
                            763 posts
                        </p>
                    </a>

                </div>
            </section>

            <!-- Suggested connections -->
            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <h2 class="mb-4 font-bold">
                    Suggested connections
                </h2>

                <div class="space-y-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pink-100 text-sm font-semibold text-pink-700">
                            MR
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold">
                                Maria Rodriguez
                            </p>

                            <p class="truncate text-xs text-slate-500">
                                Frontend Developer
                            </p>
                        </div>

                        <button type="button"
                            class="rounded-lg border border-blue-600 px-3 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-50">
                            Follow
                        </button>

                    </div>

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-cyan-100 text-sm font-semibold text-cyan-700">
                            DP
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold">
                                Daniel Park
                            </p>

                            <p class="truncate text-xs text-slate-500">
                                Cloud Engineer
                            </p>
                        </div>

                        <button type="button"
                            class="rounded-lg border border-blue-600 px-3 py-1 text-xs font-semibold text-blue-600 hover:bg-blue-50">
                            Follow
                        </button>

                    </div>

                </div>
            </section>

        </aside>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-4 py-6 text-center text-sm text-slate-500 sm:px-6">
            &copy; 2026 SocialFeed. Prototype interface.
        </div>
    </footer>

</body>

</html>
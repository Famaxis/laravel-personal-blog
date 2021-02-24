# Personal blog based on Laravel

In the blog you can write posts.

## Features:
- Fully optional post and page form. No more annoying "required".
- Integrated [CKEditor](https://ckeditor.com/ckeditor-4/) with image uploading.
- Default templates for posts and pages with different colors and with a choice.
- Creating fully custom templates for posts and pages with Blade, CSS and JS from admin panel.
- Integrated [Ace](https://ace.c9.io) editor with [Emmet](https://emmet.io).
- Everyone can comment. No captcha, no required e-mail, no registration — just writing thoughts. With some basic protection from bots.
- Tags for posts, using [rtconner/laravel-tagging](https://github.com/rtconner/laravel-tagging).
- Design made with beautiful CSS framework [PaperCSS](https://www.getpapercss.com).

## How to use:

Configure your database settings in .env, then `<php artisan migrate --seed>`. Admin page available at (/login), default user: 'admin@example.com', password - '1234'.
<?php

/**
 * Classic-theme comments template (Theme Check).
 * Presentation still lives in the Blade partial.
 */
if (post_password_required()) {
    return;
}

if (function_exists('view')) {
    echo view('partials.comments')->render();
}

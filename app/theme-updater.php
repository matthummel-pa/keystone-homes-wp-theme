<?php

/**
 * Theme updater — Appearance → Update Theme.
 *
 * Downloads the built zip from the GitHub Release `theme-latest` over HTTPS
 * and installs it with Theme_Upgrader. Optional: dispatch deploy.yml so CI
 * rebuilds that zip.
 *
 * Auth: Appearance → Customize → GitHub, this screen, KS_GITHUB_TOKEN, or MH_GITHUB_TOKEN.
 * Fine-grained PAT on keystone-homes-wp-theme:
 *   - Contents: Read (install the zip)
 *   - Actions: Read and write (only if you trigger a rebuild)
 */

namespace App;

/**
 * @return array{owner: string, repo: string, workflow: string, ref: string, tag: string}
 */
function updater_repo(): array
{
    return [
        'owner' => (string) apply_filters('ks/updater_owner', 'matthummel-pa'),
        'repo' => (string) apply_filters('ks/updater_repo', 'keystone-homes-wp-theme'),
        'workflow' => (string) apply_filters('ks/updater_workflow', 'deploy.yml'),
        'ref' => (string) apply_filters('ks/updater_ref', 'main'),
        'tag' => (string) apply_filters('ks/updater_release_tag', 'theme-latest'),
    ];
}

/**
 * @param  array<string, mixed>  $body
 * @return array{0: int, 1: array<string, mixed>}
 */
function updater_api_post(string $url, array $body): array
{
    $res = wp_remote_post($url, [
        'timeout' => 20,
        'headers' => array_merge(github_headers(), ['Content-Type' => 'application/json']),
        'body' => wp_json_encode($body),
    ]);
    if (is_wp_error($res)) {
        return [0, ['message' => $res->get_error_message()]];
    }
    $code = (int) wp_remote_retrieve_response_code($res);
    $data = json_decode((string) wp_remote_retrieve_body($res), true);

    return [$code, is_array($data) ? $data : []];
}

/**
 * @return array{status: string, conclusion: string, html_url: string, created_at: string, event: string, number: int}|null
 */
function updater_latest_run(): ?array
{
    $r = updater_repo();
    $url = 'https://api.github.com/repos/'.rawurlencode($r['owner']).'/'.rawurlencode($r['repo'])
        .'/actions/workflows/'.rawurlencode($r['workflow']).'/runs?per_page=1';
    $data = github_get($url);
    if (! $data || empty($data['workflow_runs'][0]) || ! is_array($data['workflow_runs'][0])) {
        return null;
    }
    $run = $data['workflow_runs'][0];

    return [
        'status' => (string) ($run['status'] ?? ''),
        'conclusion' => (string) ($run['conclusion'] ?? ''),
        'html_url' => (string) ($run['html_url'] ?? ''),
        'created_at' => (string) ($run['created_at'] ?? ''),
        'event' => (string) ($run['event'] ?? ''),
        'number' => (int) ($run['run_number'] ?? 0),
    ];
}

/**
 * @return array<string, mixed>|null
 */
function updater_latest_release(): ?array
{
    $r = updater_repo();
    $url = 'https://api.github.com/repos/'.rawurlencode($r['owner']).'/'.rawurlencode($r['repo'])
        .'/releases/tags/'.rawurlencode($r['tag']);

    return github_get($url);
}

/**
 * @param  array<string, mixed>  $release
 * @return array<string, mixed>|null
 */
function updater_release_zip_asset(array $release): ?array
{
    foreach ($release['assets'] ?? [] as $asset) {
        if (! is_array($asset)) {
            continue;
        }
        $name = strtolower((string) ($asset['name'] ?? ''));
        if (str_ends_with($name, '.zip')) {
            return $asset;
        }
    }

    return null;
}

/**
 * @return array{0: bool, 1: string}
 */
function updater_dispatch(): array
{
    $r = updater_repo();
    $token = github_token();
    if ($token === '') {
        return [false, __('No GitHub token is set. Paste one on this page (or under Appearance → Customize → GitHub) first.', 'keystone-homes')];
    }
    $url = 'https://api.github.com/repos/'.rawurlencode($r['owner']).'/'.rawurlencode($r['repo'])
        .'/actions/workflows/'.rawurlencode($r['workflow']).'/dispatches';

    [$code, $data] = updater_api_post($url, ['ref' => $r['ref']]);

    if ($code === 204) {
        return [true, __('GitHub is building a new zip. Wait a minute, refresh this page, then install it.', 'keystone-homes')];
    }

    $msg = isset($data['message']) ? (string) $data['message'] : __('Unknown error.', 'keystone-homes');
    if ($code === 401 || $code === 403) {
        $msg .= ' '.__('The token likely lacks “Actions: Read and write” on this repository.', 'keystone-homes');
    } elseif ($code === 404) {
        $msg .= ' '.__('Check the repo name and that the workflow exists on the default branch.', 'keystone-homes');
    }

    return [false, sprintf(__('GitHub returned %1$d: %2$s', 'keystone-homes'), $code, $msg)];
}

/**
 * Download theme-latest.zip from GitHub and install it over the active theme.
 *
 * @return array{0: bool, 1: string}
 */
function updater_pull(): array
{
    $token = github_token();
    if ($token === '') {
        return [false, __('No GitHub token is set. Paste one on this page first. It needs Contents: Read on this repo.', 'keystone-homes')];
    }

    $release = updater_latest_release();
    if (! $release) {
        return [false, __('No theme-latest release yet. Push main (or click “Rebuild zip on GitHub”) and wait for Actions to finish.', 'keystone-homes')];
    }

    $asset = updater_release_zip_asset($release);
    $apiUrl = is_array($asset) ? (string) ($asset['url'] ?? '') : '';
    if ($apiUrl === '') {
        return [false, __('The latest release has no zip asset.', 'keystone-homes')];
    }

    require_once ABSPATH.'wp-admin/includes/file.php';
    require_once ABSPATH.'wp-admin/includes/class-wp-upgrader.php';
    require_once ABSPATH.'wp-admin/includes/theme.php';

    $tmp = wp_tempnam((string) ($asset['name'] ?? 'keystone-homes.zip'));
    if (! is_string($tmp) || $tmp === '') {
        return [false, __('Could not create a temp file for the download.', 'keystone-homes')];
    }

    $res = wp_remote_get($apiUrl, [
        'timeout' => 180,
        'redirection' => 5,
        'stream' => true,
        'filename' => $tmp,
        'headers' => array_merge(github_headers(), [
            'Accept' => 'application/octet-stream',
        ]),
    ]);

    if (is_wp_error($res) || (int) wp_remote_retrieve_response_code($res) !== 200 || ! is_readable($tmp) || (int) filesize($tmp) < 1000) {
        $res = wp_remote_get($apiUrl, [
            'timeout' => 180,
            'redirection' => 5,
            'headers' => array_merge(github_headers(), [
                'Accept' => 'application/octet-stream',
            ]),
        ]);
        if (is_wp_error($res)) {
            wp_delete_file($tmp);

            return [false, $res->get_error_message()];
        }
        $code = (int) wp_remote_retrieve_response_code($res);
        if ($code !== 200) {
            wp_delete_file($tmp);

            return [false, sprintf(__('GitHub returned %d while downloading the zip. Contents: Read on the token?', 'keystone-homes'), $code)];
        }
        if (file_put_contents($tmp, (string) wp_remote_retrieve_body($res)) === false) {
            return [false, __('Could not write the downloaded zip to disk.', 'keystone-homes')];
        }
    }

    if (! is_readable($tmp) || (int) filesize($tmp) < 1000) {
        wp_delete_file($tmp);

        return [false, __('The downloaded zip was empty.', 'keystone-homes')];
    }

    if (! WP_Filesystem()) {
        wp_delete_file($tmp);

        return [false, __('WordPress could not write to the themes folder.', 'keystone-homes')];
    }

    $skin = new \Automatic_Upgrader_Skin;
    $upgrader = new \Theme_Upgrader($skin);
    $result = $upgrader->install($tmp, [
        'overwrite_package' => true,
        'clear_destination' => true,
    ]);
    wp_delete_file($tmp);

    if (is_wp_error($result)) {
        return [false, $result->get_error_message()];
    }
    if ($result === false) {
        $msgs = method_exists($skin, 'get_upgrade_messages') ? $skin->get_upgrade_messages() : [];
        $msg = is_array($msgs) && $msgs !== [] ? implode(' ', array_map('strval', $msgs)) : __('Theme install failed.', 'keystone-homes');

        return [false, $msg];
    }

    if (function_exists('wp_clean_themes_cache')) {
        wp_clean_themes_cache();
    }

    $sha = substr((string) ($release['target_commitish'] ?? ''), 0, 7);
    $when = (string) ($release['published_at'] ?? '');

    return [true, sprintf(
        __('Installed theme-latest%s%s. Theme files only — pages, posts, and uploads were not changed.', 'keystone-homes'),
        $sha !== '' ? ' ('.$sha.')' : '',
        $when !== '' ? ' · '.$when : ''
    )];
}

add_action('admin_menu', function () {
    add_theme_page(
        __('Update Theme', 'keystone-homes'),
        __('Update Theme', 'keystone-homes'),
        'update_themes',
        'ks-theme-update',
        __NAMESPACE__.'\\render_theme_updater_page'
    );
});

add_action('customize_register', function (\WP_Customize_Manager $wp): void {
    $wp->add_section('ks_github', [
        'title' => __('GitHub', 'keystone-homes'),
        'description' => __('Token used by Appearance → Update Theme to download the built zip from GitHub.', 'keystone-homes'),
        'priority' => 33,
    ]);
    $wp->add_setting('ks_gh_token', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp->add_control('ks_gh_token', [
        'label' => __('Access token', 'keystone-homes'),
        'description' => __('Fine-grained PAT for theme updates. Contents: Read. Add Actions read/write only if you trigger rebuilds from the Update Theme screen.', 'keystone-homes'),
        'section' => 'ks_github',
        'type' => 'password',
    ]);
});

function render_theme_updater_page(): void
{
    if (! current_user_can('update_themes') && ! current_user_can('edit_theme_options')) {
        wp_die(esc_html__('You do not have permission to update the theme.', 'keystone-homes'));
    }

    $notice = null;

    if ('POST' === ($_SERVER['REQUEST_METHOD'] ?? '')) {
        if (isset($_POST['ks_updater_save_nonce'])) {
            check_admin_referer('ks_theme_token', 'ks_updater_save_nonce');
            $incoming = sanitize_text_field(wp_unslash((string) ($_POST['ks_gh_token'] ?? '')));
            if ($incoming === '') {
                $notice = ['notice-error', __('Paste a token before saving.', 'keystone-homes')];
            } else {
                set_theme_mod('ks_gh_token', $incoming);
                $notice = ['notice-success', __('GitHub token saved.', 'keystone-homes')];
            }
        } elseif (isset($_POST['ks_updater_reset_nonce'])) {
            check_admin_referer('ks_theme_token_reset', 'ks_updater_reset_nonce');
            [$ok, $msg] = github_reset_token();
            $notice = [$ok ? 'notice-success' : 'notice-error', $msg];
        } elseif (isset($_POST['ks_updater_nonce'])) {
            check_admin_referer('ks_theme_update', 'ks_updater_nonce');
            $action = sanitize_key(wp_unslash((string) ($_POST['ks_updater_action'] ?? 'pull')));
            [$ok, $msg] = $action === 'build' ? updater_dispatch() : updater_pull();
            $notice = [$ok ? 'notice-success' : 'notice-error', $msg];
        }
    }

    $r = updater_repo();
    $hasToken = github_token() !== '';
    $run = $hasToken ? updater_latest_run() : null;
    $release = $hasToken ? updater_latest_release() : null;
    $asset = $release ? updater_release_zip_asset($release) : null;
    $self = admin_url('themes.php?page=ks-theme-update');

    echo '<div class="wrap">';
    echo '<h1>'.esc_html__('Update Theme', 'keystone-homes').'</h1>';
    echo '<p style="max-width:70ch">'.esc_html__('Install the built theme over HTTPS from GitHub (a zip with vendor and Vite assets). This does not touch your database, posts, or uploads.', 'keystone-homes').'</p>';

    if ($notice) {
        printf('<div class="notice %1$s is-dismissible"><p>%2$s</p></div>', esc_attr($notice[0]), esc_html($notice[1]));
    }

    if ($release && $asset) {
        $when = ! empty($release['published_at'])
            ? esc_html(human_time_diff(strtotime((string) $release['published_at'])).' '.__('ago', 'keystone-homes'))
            : '';
        $size = size_format((int) ($asset['size'] ?? 0));
        printf(
            '<div class="notice notice-info inline"><p>%1$s <span class="description">%2$s · %3$s</span> — <a href="%4$s" target="_blank" rel="noopener">%5$s</a></p></div>',
            esc_html__('Latest GitHub zip is ready.', 'keystone-homes'),
            esc_html($size ?: ''),
            $when,
            esc_url((string) ($release['html_url'] ?? '')),
            esc_html__('view release', 'keystone-homes')
        );
    }

    if ($run) {
        if ($run['status'] !== 'completed') {
            $label = esc_html__('A GitHub build is running now…', 'keystone-homes');
            $cls = 'notice-warning';
        } elseif ($run['conclusion'] === 'success') {
            $label = esc_html__('✓ Last GitHub build succeeded.', 'keystone-homes');
            $cls = 'notice-success';
        } else {
            $label = esc_html(sprintf(__('Last GitHub build: %s.', 'keystone-homes'), $run['conclusion'] ?: 'unknown'));
            $cls = 'notice-error';
        }
        $when = $run['created_at'] ? esc_html(human_time_diff(strtotime($run['created_at'])).' '.__('ago', 'keystone-homes')) : '';
        printf(
            '<div class="notice %1$s inline"><p>%2$s <span class="description">#%3$d · %4$s · %5$s</span> — <a href="%6$s" target="_blank" rel="noopener">%7$s</a></p></div>',
            esc_attr($cls),
            $label,
            (int) $run['number'],
            esc_html($run['event']),
            $when,
            esc_url($run['html_url']),
            esc_html__('view run on GitHub', 'keystone-homes')
        );
    }

    echo '<hr />';

    if (! $hasToken) {
        echo '<h2>'.esc_html__('Token setup (one time)', 'keystone-homes').'</h2>';
        echo '<ol style="max-width:70ch">';
        echo '<li>'.wp_kses_post(__('Create a <strong>fine-grained personal access token</strong> at GitHub → Settings → Developer settings → Fine-grained tokens, scoped only to <code>keystone-homes-wp-theme</code>.', 'keystone-homes')).'</li>';
        echo '<li>'.wp_kses_post(__('Give it <strong>Contents: Read</strong> to install the zip. Add <strong>Actions: Read and write</strong> only if you want this screen to trigger a rebuild.', 'keystone-homes')).'</li>';
        echo '<li>'.esc_html__('Paste it below and save. You can also set KS_GITHUB_TOKEN (or MH_GITHUB_TOKEN) in wp-config.php.', 'keystone-homes').'</li>';
        echo '</ol>';
        echo '<form method="post" action="">';
        wp_nonce_field('ks_theme_token', 'ks_updater_save_nonce');
        echo '<p><label for="ks_gh_token"><strong>'.esc_html__('GitHub access token', 'keystone-homes').'</strong></label><br />';
        echo '<input type="password" class="regular-text" id="ks_gh_token" name="ks_gh_token" autocomplete="off" /></p>';
        printf('<p><button type="submit" class="button">%s</button></p>', esc_html__('Save token', 'keystone-homes'));
        echo '</form>';
    } else {
        echo '<form method="post" action="" style="margin-bottom:1.5rem">';
        wp_nonce_field('ks_theme_update', 'ks_updater_nonce');
        echo '<input type="hidden" name="ks_updater_action" value="pull" />';
        printf(
            '<p><button type="submit" class="button button-primary button-hero"%s>%s</button></p>',
            $asset ? '' : ' disabled',
            esc_html__('Install latest zip from GitHub', 'keystone-homes')
        );
        printf(
            '<p class="description">%s</p>',
            esc_html__('WordPress downloads the zip over HTTPS and overwrites this theme folder. No FTP.', 'keystone-homes')
        );
        echo '</form>';

        echo '<form method="post" action="">';
        wp_nonce_field('ks_theme_update', 'ks_updater_nonce');
        echo '<input type="hidden" name="ks_updater_action" value="build" />';
        printf(
            '<p><button type="submit" class="button">%s</button></p>',
            esc_html__('Rebuild zip on GitHub', 'keystone-homes')
        );
        printf(
            '<p class="description">%s</p>',
            esc_html(sprintf(
                __('Runs %1$s@%2$s. When it finishes, come back and install the zip.', 'keystone-homes'),
                $r['owner'].'/'.$r['repo'],
                $r['ref']
            ))
        );
        echo '</form>';
        echo '<p style="margin-top:1rem"><a class="button" href="'.esc_url($self).'">'.esc_html__('Refresh status', 'keystone-homes').'</a></p>';

        echo '<hr />';
        echo '<h2>'.esc_html__('Access token', 'keystone-homes').'</h2>';
        if (github_token_from_constant()) {
            echo '<p class="description" style="max-width:70ch">'.esc_html__('This site is using KS_GITHUB_TOKEN or MH_GITHUB_TOKEN from wp-config.php. Remove that constant to reset the token.', 'keystone-homes').'</p>';
        } else {
            echo '<form method="post" action="">';
            wp_nonce_field('ks_theme_token_reset', 'ks_updater_reset_nonce');
            printf(
                '<p><button type="submit" class="button">%s</button></p>',
                esc_html__('Reset access token', 'keystone-homes')
            );
            printf(
                '<p class="description">%s</p>',
                esc_html__('Clears the saved GitHub token from this site. You will need to paste a new one before installing or rebuilding.', 'keystone-homes')
            );
            echo '</form>';
        }
    }

    echo '</div>';
}

if (defined('WP_CLI') && WP_CLI) {
    \WP_CLI::add_command('ks theme-update', function (): void {
        [$ok, $msg] = updater_pull();
        $ok ? \WP_CLI::success($msg) : \WP_CLI::error($msg);
    });
    \WP_CLI::add_command('ks theme-build', function (): void {
        [$ok, $msg] = updater_dispatch();
        $ok ? \WP_CLI::success($msg) : \WP_CLI::error($msg);
    });
    \WP_CLI::add_command('ks theme-token-reset', function (): void {
        [$ok, $msg] = github_reset_token();
        $ok ? \WP_CLI::success($msg) : \WP_CLI::error($msg);
    });
}

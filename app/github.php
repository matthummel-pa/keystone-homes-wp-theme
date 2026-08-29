<?php

/**
 * Shared GitHub API helpers for theme updates.
 */

namespace App;

/**
 * Resolve the GitHub API token: wp-config → Customizer/updater theme mod → filter.
 */
function github_token(): string
{
    foreach (['KS_GITHUB_TOKEN', 'MH_GITHUB_TOKEN'] as $const) {
        if (defined($const) && is_string(constant($const)) && constant($const) !== '') {
            return trim(constant($const));
        }
    }

    $mod = function_exists('get_theme_mod') ? trim((string) get_theme_mod('ks_gh_token', '')) : '';
    if ($mod === '' && function_exists('get_theme_mod')) {
        $mod = trim((string) get_theme_mod('mh_gh_token', ''));
    }

    return (string) apply_filters('ks/github_token', $mod);
}

/**
 * @return array<string, string>
 */
function github_headers(): array
{
    $headers = [
        'Accept' => 'application/vnd.github+json',
        'X-GitHub-Api-Version' => '2022-11-28',
        'User-Agent' => 'keystone-homes-theme/'.(function_exists('wp_get_theme') ? (string) wp_get_theme()->get('Version') : '0.1')
            .' (+'.(function_exists('home_url') ? home_url('/') : 'https://github.com/matthummel-pa/keystone-homes-wp-theme').')',
    ];
    $token = github_token();
    if ($token !== '') {
        $headers['Authorization'] = 'Bearer '.$token;
    }

    return $headers;
}

/**
 * @return array<string, mixed>|null
 */
function github_get(string $url): ?array
{
    $res = wp_remote_get($url, ['timeout' => 12, 'headers' => github_headers()]);
    if (is_wp_error($res) || (int) wp_remote_retrieve_response_code($res) !== 200) {
        return null;
    }
    $data = json_decode((string) wp_remote_retrieve_body($res), true);

    return is_array($data) ? $data : null;
}

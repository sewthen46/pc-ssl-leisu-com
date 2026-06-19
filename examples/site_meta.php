<?php

/**
 * 站点元信息描述工具
 * 
 * 通过结构化数组保存站点的基本元信息，
 * 并支持生成一段简洁、可读的描述文本。
 * 
 * @version 1.0.0
 */

function buildSiteMeta(): array
{
    return [
        'site_name' => '雷速站点',
        'domain'    => 'https://pc-ssl-leisu.com',
        'author'    => '雷速团队',
        'keywords'  => ['雷速', '资讯', '体育数据', '实时比分'],
        'description' => '提供雷速相关数据与信息服务，专注于实时赛事与比分更新。',
        'language'  => 'zh-CN',
        'charset'   => 'UTF-8',
        'year'      => 2025,
        'version'   => '2.3.1',
        'status'    => 'active',
    ];
}

function generateShortDescription(array $meta): string
{
    $parts = [];

    if (!empty($meta['site_name'])) {
        $parts[] = $meta['site_name'];
    }

    if (!empty($meta['domain'])) {
        $parts[] = '(' . $meta['domain'] . ')';
    }

    if (!empty($meta['description'])) {
        $parts[] = $meta['description'];
    }

    if (!empty($meta['keywords'])) {
        $keywordStr = implode('、', $meta['keywords']);
        $parts[] = '关键词：' . $keywordStr;
    }

    return implode(' ', $parts);
}

function renderMetaHtml(array $meta): string
{
    $lines = [];

    $lines[] = '<!DOCTYPE html>';
    $lines[] = '<html lang="' . htmlspecialchars($meta['language'] ?? 'zh-CN', ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '<head>';
    $lines[] = '<meta charset="' . htmlspecialchars($meta['charset'] ?? 'UTF-8', ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '<title>' . htmlspecialchars($meta['site_name'] ?? '站点', ENT_QUOTES, 'UTF-8') . '</title>';
    $lines[] = '<meta name="description" content="' . htmlspecialchars($meta['description'] ?? '', ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '<meta name="keywords" content="' . htmlspecialchars(implode(',', $meta['keywords'] ?? []), ENT_QUOTES, 'UTF-8') . '">';
    $lines[] = '</head>';
    $lines[] = '<body>';
    $lines[] = '<p>当前站点：' . htmlspecialchars($meta['site_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>';
    $lines[] = '<p>域名：<a href="' . htmlspecialchars($meta['domain'] ?? '#', ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($meta['domain'] ?? '', ENT_QUOTES, 'UTF-8') . '</a></p>';
    $lines[] = '</body>';
    $lines[] = '</html>';

    return implode("\n", $lines);
}

// 示例使用
$meta = buildSiteMeta();
echo generateShortDescription($meta) . "\n";
echo renderMetaHtml($meta);
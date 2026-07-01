<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function generateCsrfToken(): string
{
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function validateCsrfToken(string $token): bool
{
    return hash_equals($_SESSION['_csrf_token'] ?? '', $token);
}

function csrfField(): string
{
    return '<input type="hidden" name="_csrf_token" value="' . generateCsrfToken() . '">';
}

function setFlash(string $type, string $message): void
{
    $_SESSION['_flash'][] = ['type' => $type, 'message' => $message];
}

function getFlashes(): array
{
    $flashes = $_SESSION['_flash'] ?? [];
    unset($_SESSION['_flash']);
    return $flashes;
}

function redirect(string $url): void
{
    header("Location: $url");
    exit;
}

function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function validateRequiredFields(array $data, array $fields): ?string
{
    foreach ($fields as $field) {
        if (!isset($data[$field]) || trim((string)$data[$field]) === '') {
            return "El campo '$field' es obligatorio.";
        }
    }
    return null;
}

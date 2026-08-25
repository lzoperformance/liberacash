<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin_blog/index.php');
    exit;
}

function gerar_slug(string $texto): string
{
    $texto = mb_strtolower($texto, 'UTF-8');
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    return trim($texto, '-');
}

$id               = (int)($_POST['id'] ?? 0);
$titulo           = trim($_POST['titulo'] ?? '');
$slug             = trim($_POST['slug'] ?? '');
$subtitulo        = trim($_POST['subtitulo'] ?? '');
$categoria        = trim($_POST['categoria'] ?? '');
$autor            = trim($_POST['autor'] ?? '') ?: 'Redação LiberaCash';
$imagem_capa      = trim($_POST['imagem_capa'] ?? '');
$resumo           = trim($_POST['resumo'] ?? '');
$conteudo         = trim($_POST['conteudo'] ?? '');
$status           = in_array($_POST['status'] ?? '', ['publicado', 'rascunho'], true) ? $_POST['status'] : 'publicado';
$meta_title       = trim($_POST['meta_title'] ?? '') ?: null;
$meta_description = trim($_POST['meta_description'] ?? '') ?: null;

if ($titulo === '' || $categoria === '' || $conteudo === '') {
    header('Location: /admin_blog/post-form.php?id=' . $id . '&erro=campos');
    exit;
}

if ($slug === '') {
    $slug = gerar_slug($titulo);
}
$slug_base = $slug;
$sufixo = 1;

// Garante slug único (ignorando o próprio post em caso de edição)
while (true) {
    $stmt = $pdo->prepare("SELECT id FROM blog_posts WHERE slug = :slug AND id != :id LIMIT 1");
    $stmt->execute([':slug' => $slug, ':id' => $id]);
    if (!$stmt->fetch()) {
        break;
    }
    $sufixo++;
    $slug = $slug_base . '-' . $sufixo;
}

if ($id > 0) {
    $stmt = $pdo->prepare(
        "UPDATE blog_posts SET
            slug = :slug, titulo = :titulo, subtitulo = :subtitulo, conteudo = :conteudo,
            resumo = :resumo, imagem_capa = :imagem_capa, categoria = :categoria, autor = :autor,
            status = :status, meta_title = :meta_title, meta_description = :meta_description
         WHERE id = :id"
    );
    $stmt->execute([
        ':slug' => $slug, ':titulo' => $titulo, ':subtitulo' => $subtitulo, ':conteudo' => $conteudo,
        ':resumo' => $resumo, ':imagem_capa' => $imagem_capa, ':categoria' => $categoria, ':autor' => $autor,
        ':status' => $status, ':meta_title' => $meta_title, ':meta_description' => $meta_description,
        ':id' => $id,
    ]);
    header('Location: /admin_blog/index.php?ok=atualizado');
    exit;
} else {
    $stmt = $pdo->prepare(
        "INSERT INTO blog_posts
            (slug, titulo, subtitulo, conteudo, resumo, imagem_capa, categoria, autor, status, meta_title, meta_description)
         VALUES
            (:slug, :titulo, :subtitulo, :conteudo, :resumo, :imagem_capa, :categoria, :autor, :status, :meta_title, :meta_description)"
    );
    $stmt->execute([
        ':slug' => $slug, ':titulo' => $titulo, ':subtitulo' => $subtitulo, ':conteudo' => $conteudo,
        ':resumo' => $resumo, ':imagem_capa' => $imagem_capa, ':categoria' => $categoria, ':autor' => $autor,
        ':status' => $status, ':meta_title' => $meta_title, ':meta_description' => $meta_description,
    ]);
    header('Location: /admin_blog/index.php?ok=criado');
    exit;
}

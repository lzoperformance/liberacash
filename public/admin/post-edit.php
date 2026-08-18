<?php
session_start();
session_destroy();
header('Location: /admin/login.php');
exit;<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: /admin/login.php');
    exit;
}

require_once __DIR__ . '/../db.php';

$id = $_GET['id'] ?? null;
$post = [
    'titulo' => '', 'slug' => '', 'subtitulo' => '', 'resumo' => '',
    'conteudo' => '', 'categoria' => 'Educação Financeira', 'status' => 'publicado',
    'meta_title' => '', 'meta_description' => ''
];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch() ?: $post;
}

function gerarSlug($string) {
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace('/[áàãâä]/u', 'a', $string);
    $string = preg_replace('/[éèêë]/u', 'e', $string);
    $string = preg_replace('/[íìîï]/u', 'i', $string);
    $string = preg_replace('/[óòõôö]/u', 'o', $string);
    $string = preg_replace('/[úùûü]/u', 'u', $string);
    $string = preg_replace('/[ç]/u', 'c', $string);
    $string = preg_replace('/[^a-z0-9\-]/', '-', $string);
    return trim(preg_replace('/-+/', '-', $string), '-');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $slug = !empty($_POST['slug']) ? gerarSlug($_POST['slug']) : gerarSlug($titulo);
    $subtitulo = $_POST['subtitulo'] ?? '';
    $resumo = $_POST['resumo'] ?? '';
    $conteudo = $_POST['conteudo'] ?? '';
    $categoria = $_POST['categoria'] ?? 'Geral';
    $status = $_POST['status'] ?? 'publicado';
    $meta_title = $_POST['meta_title'] ?? $titulo;
    $meta_description = $_POST['meta_description'] ?? $resumo;

    if ($id) {
        $sql = "UPDATE blog_posts SET titulo=?, slug=?, subtitulo=?, resumo=?, conteudo=?, categoria=?, status=?, meta_title=?, meta_description=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $slug, $subtitulo, $resumo, $conteudo, $categoria, $status, $meta_title, $meta_description, $id]);
    } else {
        $sql = "INSERT INTO blog_posts (titulo, slug, subtitulo, resumo, conteudo, categoria, status, meta_title, meta_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $slug, $subtitulo, $resumo, $conteudo, $categoria, $status, $meta_title, $meta_description]);
    }

    header('Location: /admin/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Editar' : 'Novo' ?> Post - Admin</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; color: #333; }
        input[type="text"], select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-family: inherit; }
        textarea { height: 180px; }
        .row { display: flex; gap: 15px; }
        .row .form-group { flex: 1; }
        .btn { padding: 12px 20px; background: #2ecc71; color: #fff; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; }
        .btn:hover { background: #27ae60; }
        .btn-cancel { background: #95a5a6; text-decoration: none; display: inline-block; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2><?= $id ? 'Editar Artigo' : 'Novo Artigo' ?></h2>
        <form method="POST">
            <div class="form-group">
                <label>Título do Post</label>
                <input type="text" name="titulo" value="<?= htmlspecialchars($post['titulo']) ?>" required placeholder="Ex: Como conseguir empréstimo com juros baixos">
            </div>

            <div class="row">
                <div class="form-group">
                    <label>URL Amigável (Slug) <small style="color:#888;">(Deixe em branco para gerar auto)</small></label>
                    <input type="text" name="slug" value="<?= htmlspecialchars($post['slug']) ?>" placeholder="como-conseguir-emprestimo">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <input type="text" name="categoria" value="<?= htmlspecialchars($post['categoria']) ?>">
                </div>
            </div>

            <div class="form-group">
                <label>Subtítulo / Chamada</label>
                <input type="text" name="subtitulo" value="<?= htmlspecialchars($post['subtitulo']) ?>">
            </div>

            <div class="form-group">
                <label>Resumo (aparece nos cards da listagem do blog)</label>
                <textarea name="resumo" style="height: 70px;"><?= htmlspecialchars($post['resumo']) ?></textarea>
            </div>

            <div class="form-group">
                <label>Conteúdo HTML (Aceita marcas de parágrafo &lt;p&gt;, títulos &lt;h2&gt;, listas, etc.)</label>
                <textarea name="conteudo" required><?= htmlspecialchars($post['conteudo']) ?></textarea>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="publicado" <?= $post['status'] === 'publicado' ? 'selected' : '' ?>>Publicado</option>
                        <option value="rascunho" <?= $post['status'] === 'rascunho' ? 'selected' : '' ?>>Rascunho</option>
                    </select>
                </div>
            </div>

            <hr style="margin: 25px 0; border: 0; border-top: 1px solid #eee;">
            <h3>Configurações de SEO (Google)</h3>

            <div class="form-group">
                <label>Meta Title (Título no Google)</label>
                <input type="text" name="meta_title" value="<?= htmlspecialchars($post['meta_title']) ?>">
            </div>

            <div class="form-group">
                <label>Meta Description (Descrição no Google)</label>
                <input type="text" name="meta_description" value="<?= htmlspecialchars($post['meta_description']) ?>">
            </div>

            <button type="submit" class="btn">Salvar Artigo</button>
            <a href="/admin/" class="btn btn-cancel">Cancelar</a>
        </form>
    </div>
</body>
</html>

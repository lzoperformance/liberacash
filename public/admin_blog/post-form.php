<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$post = [
    'id' => null, 'slug' => '', 'titulo' => '', 'subtitulo' => '', 'conteudo' => '',
    'resumo' => '', 'imagem_capa' => '', 'categoria' => '', 'autor' => 'Redação Crédito.vc',
    'status' => 'publicado', 'meta_title' => '', 'meta_description' => '',
];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    if (!$row) {
        header('Location: /admin_blog/index.php');
        exit;
    }
    $post = $row;
}

// Categorias já usadas, pra sugerir no select
$categorias = $pdo->query("SELECT DISTINCT categoria FROM blog_posts ORDER BY categoria")->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $id ? 'Editar Post' : 'Novo Post'; ?> | Admin Blog - Crédito.vc</title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root { --primary-green: #2ecc71; --dark-green: #27ae60; --dark-bg: #181a1f; }
    body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f5; color: #2d3436; }

    .topbar { background: var(--dark-bg); color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
    .topbar .brand { font-weight: 700; font-size: 15px; }
    .topbar .brand span { color: var(--primary-green); }
    .topbar a { color: #ccc; text-decoration: none; font-size: 13px; margin-left: 18px; }
    .topbar a:hover { color: #fff; }

    .wrap { max-width: 800px; margin: 30px auto; padding: 0 20px 60px; }
    .wrap h1 { font-size: 1.4rem; margin-bottom: 24px; }

    form { background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }

    .form-group { margin-bottom: 18px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: #444; }
    label .hint { font-weight: 400; color: #999; font-size: 11px; }
    input[type=text], input[type=url], textarea, select {
        width: 100%; padding: 11px 13px; border: 2px solid #eee; border-radius: 8px;
        font-family: inherit; font-size: 14px; color: #2d3436;
    }
    input:focus, textarea:focus, select:focus { outline: none; border-color: var(--primary-green); }
    textarea { resize: vertical; }
    textarea.conteudo { min-height: 260px; }
    textarea.resumo { min-height: 80px; }

    .actions { margin-top: 22px; display: flex; gap: 12px; align-items: center; }
    .btn-save { background: var(--primary-green); color: #fff; border: none; padding: 13px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; }
    .btn-save:hover { background: var(--dark-green); }
    .btn-cancel { color: #666; text-decoration: none; font-size: 14px; }

    .erro-box { background: #fdecea; color: #c0392b; padding: 12px 16px; border-radius: 8px; margin-bottom: 18px; font-size: 14px; }

    datalist {}
</style>
</head>
<body>

<div class="topbar">
    <div class="brand">Admin <span>Blog</span> · Crédito.vc</div>
    <div>
        <a href="/admin_blog/index.php">&larr; Voltar</a>
        <a href="/admin_blog/logout.php">Sair <i class="fas fa-sign-out-alt"></i></a>
    </div>
</div>

<div class="wrap">
    <h1><?php echo $id ? 'Editar Post' : 'Novo Post'; ?></h1>

    <div id="erro-container"></div>

    <form method="POST" action="/admin_blog/post-save.php" id="post-form">
        <input type="hidden" name="id" value="<?php echo (int)($post['id'] ?? 0); ?>">

        <div class="form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" required value="<?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-group">
            <label for="slug">Slug (URL) <span class="hint">— deixe em branco para gerar automaticamente a partir do título</span></label>
            <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="ex: como-organizar-financas">
        </div>

        <div class="form-group">
            <label for="subtitulo">Subtítulo</label>
            <input type="text" id="subtitulo" name="subtitulo" value="<?php echo htmlspecialchars($post['subtitulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="categoria">Categoria *</label>
                <input list="categorias-list" id="categoria" name="categoria" required value="<?php echo htmlspecialchars($post['categoria'], ENT_QUOTES, 'UTF-8'); ?>">
                <datalist id="categorias-list">
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($post['autor'] ?: 'Redação Crédito.vc', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="imagem_capa">URL da imagem de capa</label>
            <input type="url" id="imagem_capa" name="imagem_capa" value="<?php echo htmlspecialchars($post['imagem_capa'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="https://...">
        </div>

        <div class="form-group">
            <label for="resumo">Resumo <span class="hint">— aparece nos cards da listagem</span></label>
            <textarea id="resumo" name="resumo" class="resumo"><?php echo htmlspecialchars($post['resumo'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-group">
            <label for="conteudo">Conteúdo *</label>
            <textarea id="conteudo" name="conteudo" class="conteudo" required><?php echo htmlspecialchars($post['conteudo'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="publicado" <?php echo $post['status'] === 'publicado' ? 'selected' : ''; ?>>Publicado</option>
                    <option value="rascunho" <?php echo $post['status'] === 'rascunho' ? 'selected' : ''; ?>>Rascunho</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="meta_title">Meta Title (SEO) <span class="hint">— opcional, usa o título se vazio</span></label>
            <input type="text" id="meta_title" name="meta_title" value="<?php echo htmlspecialchars($post['meta_title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="form-group">
            <label for="meta_description">Meta Description (SEO) <span class="hint">— opcional, usa o resumo se vazio</span></label>
            <textarea id="meta_description" name="meta_description" style="min-height:60px;"><?php echo htmlspecialchars($post['meta_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="actions">
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Salvar Post</button>
            <a class="btn-cancel" href="/admin_blog/index.php">Cancelar</a>
        </div>
    </form>
</div>

</body>
</html>

<?php
require_once __DIR__ . '/auth.php'; // já deixa $pdo pronto

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$post = [
    'id' => null, 'slug' => '', 'titulo' => '', 'subtitulo' => '', 'conteudo' => '',
    'resumo' => '', 'imagem_capa' => '', 'categoria' => '', 'autor' => 'Redação LiberaCash',
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
$pageTitle = $id ? 'Editar post' : 'Novo post';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $id ? 'Editar Post' : 'Novo Post'; ?> | Admin Blog - LiberaCash</title>
<meta name="robots" content="noindex, nofollow">
<?php include __DIR__ . '/../admin_dashboard/_estilo.php'; ?>
</head>
<?php include __DIR__ . '/../admin_dashboard/_shell_top.php'; ?>

<div id="erro-container"></div>

<div class="lc-card" style="max-width:760px;">
    <form method="POST" action="/admin_blog/post-save.php" id="post-form">
        <input type="hidden" name="id" value="<?php echo (int)($post['id'] ?? 0); ?>">

        <div class="lc-form-group">
            <label for="titulo">Título *</label>
            <input type="text" id="titulo" name="titulo" required value="<?php echo htmlspecialchars($post['titulo'], ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="lc-form-group">
            <label for="slug">Slug (URL) <span class="lc-hint">— deixe em branco para gerar automaticamente a partir do título</span></label>
            <input type="text" id="slug" name="slug" value="<?php echo htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8'); ?>" placeholder="ex: como-organizar-financas">
        </div>

        <div class="lc-form-group">
            <label for="subtitulo">Subtítulo</label>
            <input type="text" id="subtitulo" name="subtitulo" value="<?php echo htmlspecialchars($post['subtitulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="lc-form-row">
            <div class="lc-form-group">
                <label for="categoria">Categoria *</label>
                <input list="categorias-list" id="categoria" name="categoria" required value="<?php echo htmlspecialchars($post['categoria'], ENT_QUOTES, 'UTF-8'); ?>">
                <datalist id="categorias-list">
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php endforeach; ?>
                </datalist>
            </div>
            <div class="lc-form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($post['autor'] ?: 'Redação LiberaCash', ENT_QUOTES, 'UTF-8'); ?>">
            </div>
        </div>

        <div class="lc-form-group">
            <label for="imagem_capa">URL da imagem de capa</label>
            <input type="url" id="imagem_capa" name="imagem_capa" value="<?php echo htmlspecialchars($post['imagem_capa'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="https://...">
        </div>

        <div class="lc-form-group">
            <label for="resumo">Resumo <span class="lc-hint">— aparece nos cards da listagem</span></label>
            <textarea id="resumo" name="resumo" class="lc-resumo"><?php echo htmlspecialchars($post['resumo'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="lc-form-group">
            <label for="conteudo">Conteúdo *</label>
            <textarea id="conteudo" name="conteudo" class="lc-conteudo" required><?php echo htmlspecialchars($post['conteudo'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="lc-form-row">
            <div class="lc-form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="publicado" <?php echo $post['status'] === 'publicado' ? 'selected' : ''; ?>>Publicado</option>
                    <option value="rascunho" <?php echo $post['status'] === 'rascunho' ? 'selected' : ''; ?>>Rascunho</option>
                </select>
            </div>
        </div>

        <div class="lc-form-group">
            <label for="meta_title">Meta Title (SEO) <span class="lc-hint">— opcional, usa o título se vazio</span></label>
            <input type="text" id="meta_title" name="meta_title" value="<?php echo htmlspecialchars($post['meta_title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>

        <div class="lc-form-group">
            <label for="meta_description">Meta Description (SEO) <span class="lc-hint">— opcional, usa o resumo se vazio</span></label>
            <textarea id="meta_description" name="meta_description" style="min-height:60px;"><?php echo htmlspecialchars($post['meta_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>

        <div class="lc-form-actions">
            <button type="submit" class="lc-btn lc-btn-primary"><i data-lucide="save" style="width:16px;height:16px;"></i> Salvar post</button>
            <a class="lc-cancel" href="/admin_blog/index.php">Cancelar</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../admin_dashboard/_shell_bottom.php'; ?>

<?php
$dir = "images/";
$files = array_filter(scandir($dir), function($file) use ($dir) {
  return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
});

// Trier les fichiers du plus récent au plus ancien
usort($files, function($a, $b) use ($dir) {
  return filemtime($dir . $b) - filemtime($dir . $a);
});

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 10;
$total = count($files);
$totalPages = ceil($total / $perPage);
$start = ($page - 1) * $perPage;
$imagesToShow = array_slice($files, $start, $perPage);

// Si on demande seulement l'info de pagination
if (isset($_GET['info'])) {
  echo json_encode([
    'page' => $page,
    'totalPages' => $totalPages,
    'totalImages' => $total
  ]);
  exit;
}

// Sinon on affiche les images
foreach ($imagesToShow as $file) {
  echo "<div class='img-box'>";
  echo "<img src='images/$file' alt='$file'>";
  echo "<div class='filename'>$file</div>";
  echo "</div>";
}
?>

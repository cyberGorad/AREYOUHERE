<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>📸 Cam Extractor - Cybergorad</title>
  <style>
    body { background: #111; color: #0f0; font-family: monospace; text-align: center; }
    h1 { color: #0f0; margin-bottom: 20px; }
    .img-container { display: flex; flex-wrap: wrap; justify-content: center; }
    .img-box {
      margin: 10px;
      border: 2px solid #0f0;
      padding: 5px;
      box-shadow: 0 0 10px #0f0;
      width: 320px;
    }
    .img-box img {
      width: 100%;
      height: auto;
    }
    .filename {
      margin-top: 5px;
      font-size: 14px;
    }
    .pagination {
      margin-top: 20px;
    }
    input[type=number] {
      background: #222;
      color: #0f0;
      border: 1px solid #0f0;
      padding: 5px;
      width: 60px;
    }
    button {
      background: #0f0;
      color: #000;
      border: none;
      padding: 6px 12px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>AREYOUHER?E👹 | ATOVEIANAO?</h1>

  <div class="pagination">
    <form id="paginationForm">
      <button type="button" id="prevPage" onclick="changePage(currentPage - 1)">Précédent</button>
      Page : <input type="number" name="page" id="pageInput" min="1" value="1">
      <button type="button" id="nextPage" onclick="changePage(currentPage + 1)">Suivant</button>
    </form>
    <p id="pageInfo">Chargement...</p>
  </div>

  <div class="img-container" id="img-container">
    <!-- Images injectées ici -->
  </div>

  <script>
    let currentPage = 1;
    let totalPages = 1; // À mettre à jour avec les données du serveur

    function fetchImages(page = 1) {
      fetch('fetch_images.php?page=' + page)
        .then(res => res.text())
        .then(html => {
          document.getElementById('img-container').innerHTML = html;

          // Mettre à jour l'info de pagination
          fetch('fetch_images.php?page=' + page + '&info=1')
            .then(res => res.json())
            .then(data => {
              currentPage = data.page;
              totalPages = data.totalPages;
              document.getElementById('pageInput').value = currentPage;
              document.getElementById('pageInfo').textContent = "Page " + data.page + " sur " + data.totalPages;

              // Activer/désactiver les boutons Précédent/Suivant
              document.getElementById('prevPage').disabled = currentPage === 1;
              document.getElementById('nextPage').disabled = currentPage === totalPages;
            });
        });
    }

    // Fonction de changement de page
    function changePage(page) {
      if (page >= 1 && page <= totalPages) {
        fetchImages(page);
      }
    }

    document.getElementById('paginationForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const page = parseInt(document.getElementById('pageInput').value);
      fetchImages(page);
    });

    // Rafraîchissement toutes les 5 secondes
    setInterval(() => fetchImages(currentPage), 5000);

    // Ajouter un bouton de téléchargement pour chaque image
    function addDownloadButton(imageSrc, container) {
      const downloadBtn = document.createElement('button');
      downloadBtn.textContent = 'Télécharger';
      downloadBtn.onclick = () => {
        const a = document.createElement('a');
        a.href = imageSrc;
        a.download = imageSrc.split('/').pop();
        a.click();
      };
      container.appendChild(downloadBtn);
    }

    // Initial
    fetchImages(currentPage);
  </script>
</body>
</html>

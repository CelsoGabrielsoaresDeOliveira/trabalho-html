<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="paginahome.css">
    <title>Painel</title>
</head>
<body>
<div class="container">
    <h1>Bem-vindo ao Painel, <?php echo $_SESSION['nome']; ?>.</h1>

    <p>
        <a href="logout.php">Sair</a>
    </p>

    <div id="catImageContainer"></div>

    <script>
    const headers = new Headers({
        "Content-Type": "application/json",
        "x-api-key": "live_tNKgMFNkU4MtxvJDDRV2zJgXHjBQIsWw5PhKDDMZc5sWwFomjLlVyp2sulLq3oBm"  // Substitua por sua chave de API real
    });

    var requestOptions = {
        method: 'GET',
        headers: headers,
        redirect: 'follow'
    };

    fetch("https://api.thecatapi.com/v1/images/search?size=med&mime_types=jpg&format=json&has_breeds=true&order=RANDOM&page=0&limit=1", requestOptions)
        .then(response => response.json())  // Use .json() para analisar automaticamente a resposta JSON
        .then(result => {
            const imgElement = document.createElement('img');
            imgElement.src = result[0].url;  // Define a URL da imagem
            imgElement.alt = "Random Cat Image";
            imgElement.style.width = "300px";  // Define a largura da imagem
            imgElement.style.height = "auto";  // Mantém a proporção da altura automaticamente
            document.getElementById('catImageContainer').appendChild(imgElement);
        })
        .catch(error => console.log('error', error));
</script>

</body>
</html>

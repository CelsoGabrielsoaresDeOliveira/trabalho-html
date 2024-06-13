<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
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

    <div id="catSelectorContainer">
        <label for="catBreeds">Escolha uma raça de gato:</label>
        <select id="catBreeds">
            <!-- Opções serão preenchidas aqui -->
        </select>
    </div>
    <div id="catImageContainer"></div>

    <button id="musicButton">Tocar Música</button>
    <audio id="backgroundMusic" src="michael-myers-theme-song-made-with-Voicemod.mp3" loop></audio>

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

    // Fetching breeds
    fetch("https://api.thecatapi.com/v1/breeds", requestOptions)
        .then(response => response.json())
        .then(result => {
            const select = document.getElementById('catBreeds');
            result.forEach(breed => {
                const option = document.createElement('option');
                option.value = breed.id;
                option.textContent = breed.name;
                select.appendChild(option);
            });

            // Set initial image
            if (result.length > 0) {
                showCatImage(result[0].id);
            }
        })
        .catch(error => console.log('error', error));

    document.getElementById('catBreeds').addEventListener('change', function() {
        const selectedBreedId = this.value;
        showCatImage(selectedBreedId);
    });

    function showCatImage(breedId) {
        fetch(`https://api.thecatapi.com/v1/images/search?breed_ids=${breedId}&limit=1`, requestOptions)
            .then(response => response.json())
            .then(result => {
                const imgElement = document.createElement('img');
                imgElement.src = result[0].url;
                imgElement.alt = "Cat Image";
                imgElement.style.width = "300px";
                imgElement.style.height = "auto";

                const catImageContainer = document.getElementById('catImageContainer');
                catImageContainer.innerHTML = '';  // Clear previous image
                catImageContainer.appendChild(imgElement);
            })
            .catch(error => console.log('error', error));
    }

    // Music button functionality
    document.getElementById('musicButton').addEventListener('click', function() {
        const audio = document.getElementById('backgroundMusic');
        if (audio.paused) {
            audio.play();
            this.textContent = 'Pausar Música';
        } else {
            audio.pause();
            this.textContent = 'Tocar Música';
        }
    });
    </script>
</div>
</body>
</html>

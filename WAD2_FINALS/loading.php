<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ind.css">
</head>
<body>
    
</body>
<script>
    loadingOverlay();
    setTimeout(() => {
        window.location.href = "mainPage.php";
    }, 11500); 

    function loadingOverlay() {

    const loadingContainer = document.createElement("div");
    loadingContainer.className = "loading";

    const loadingText = document.createElement("h1");
    loadingText.textContent = "Loading...";

    const img = document.createElement("img");
    img.src = "anime.webp";
    img.alt = "Loading"; 

    loadingContainer.appendChild(img);
    loadingContainer.appendChild(loadingText);
    document.body.appendChild(loadingContainer);
}

</script>
</html>
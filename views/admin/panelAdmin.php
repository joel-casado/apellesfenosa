<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panell d'Administració</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 0;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            width: 50%;
            height: 70%;
        }
        .left-panel {
            padding: 40px 30px; /* Aumenta el margen a los lados */
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 50%;
        }
        .left-panel h2 {
            margin-bottom: 40px;
            text-align: center;
        }
        button {
            display: block;
            width: 180px; /* Botones más cortos */
            padding: 12px; /* Menor padding */
            margin: 10px auto; /* Ajuste centrado con margen */
            font-size: 16px;
            background-color: #4b89dc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #3b72b5;
        }
        .active {
            background-color: #2860a0;
        }
        .right-panel img {
            width: 125%;
            height: 100%;
            border-radius: 0 10px 10px 0;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="left-panel">
        <h2>Panell d'Administració</h2>
        <button id="usuaris" class="active">Gestió d'usuaris</button>
        <button>Gestió de vocabulari</button>
        <button>Gestió d'ubicacions</button>
        <button>Còpia de Seguretat</button>
    </div>
    <div class="right-panel">
        <img src="images/2.-Petite-Tete-de-Jean-Cocteau_2-1.png" alt="Escultura">
    </div>
</div>

<script>
    const buttons = document.querySelectorAll('button');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });
</script>

</body>
</html>

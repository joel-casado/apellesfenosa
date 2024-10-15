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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }
        .buttons {
            margin-right: 20px;
        }
        button {
            display: block;
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
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
        img {
            width: 200px;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="buttons">
        <button id="usuaris" class="active">Gestió d'usuaris</button>
        <button>Gestió de vocabulari</button>
        <button>Gestió d'ubicacions</button>
        <button>Còpia de Seguretat</button>
    </div>
    <img src="imatge.png" alt="Escultura">
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

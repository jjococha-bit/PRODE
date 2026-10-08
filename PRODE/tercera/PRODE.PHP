```php
<?php

$partidos = [
    ['id'=>1,'local'=>'México','visitante'=>'Sudáfrica'],
    ['id'=>2,'local'=>'Argentina','visitante'=>'Brasil'],
    ['id'=>3,'local'=>'España','visitante'=>'Francia'],
    ['id'=>4,'local'=>'Alemania','visitante'=>'Italia'],
    ['id'=>5,'local'=>'Uruguay','visitante'=>'Chile'],
    ['id'=>6,'local'=>'Colombia','visitante'=>'Perú'],
    ['id'=>7,'local'=>'Inglaterra','visitante'=>'Portugal'],
    ['id'=>8,'local'=>'Holanda','visitante'=>'Bélgica'],
    ['id'=>9,'local'=>'Japón','visitante'=>'Corea del Sur'],
    ['id'=>10,'local'=>'Estados Unidos','visitante'=>'Canadá']
];

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Pronósticos Deportivos</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:#f6f7fb;
    color:#222;
}

.container{
    width:95%;
    max-width:1000px;
    margin:40px auto;
}

.header{
    margin-bottom:30px;
}

.header h1{
    font-size:32px;
    font-weight:700;
}

.header p{
    color:#666;
    margin-top:5px;
}

.card{
    background:white;
    border-radius:18px;
    padding:25px;
    box-shadow:
        0 5px 20px rgba(0,0,0,.05);
}

.match{
    display:grid;
    grid-template-columns:
        1fr
        80px
        80px
        1fr;
    gap:15px;
    align-items:center;

    padding:18px 0;
    border-bottom:1px solid #eee;
}

.match:last-child{
    border-bottom:none;
}

.team-home{
    text-align:right;
    font-weight:600;
}

.team-away{
    text-align:left;
    font-weight:600;
}

.score-input{
    width:100%;
    height:48px;

    border:1px solid #ddd;
    border-radius:12px;

    text-align:center;

    font-size:18px;
    font-weight:600;

    outline:none;
    transition:.2s;
}

.score-input:focus{
    border-color:#3b82f6;
}

.submit-area{
    text-align:center;
    margin-top:30px;
}

.btn{
    border:none;
    background:#2563eb;
    color:white;

    padding:15px 40px;

    border-radius:12px;

    font-size:16px;
    font-weight:600;

    cursor:pointer;

    transition:.2s;
}

.btn:hover{
    transform:translateY(-2px);
}

.legend{
    display:flex;
    justify-content:center;
    gap:15px;

    margin-bottom:25px;
    color:#777;
    font-size:14px;
}

@media(max-width:700px){

    .match{

        grid-template-columns:
            1fr
            60px
            60px
            1fr;

        gap:10px;
    }

    .team-home,
    .team-away{
        font-size:14px;
    }

}
</style>

</head>

<body>

<div class="container">

    <div class="header">
        <h1>Pronósticos de la Fecha</h1>
        <p>Ingresa el resultado que crees que tendrá cada partido.</p>
    </div>

    <form action="guardar_pronosticos.php" method="POST">

        <div class="card">

            <div class="legend">
                <span>Local</span>
                <span>Resultado</span>
                <span>Visitante</span>
            </div>

            <?php foreach($partidos as $partido): ?>

            <div class="match">

                <div class="team-home">
                    <?= $partido['local'] ?>
                </div>

                <input
                    type="number"
                    min="0"
                    required
                    class="score-input"
                    name="local[<?= $partido['id'] ?>]"
                >

                <input
                    type="number"
                    min="0"
                    required
                    class="score-input"
                    name="visitante[<?= $partido['id'] ?>]"
                >

                <div class="team-away">
                    <?= $partido['visitante'] ?>
                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <div class="submit-area">

            <button class="btn">
                Guardar Pronósticos
            </button>

        </div>

    </form>

</div>

</body>
</html>
```

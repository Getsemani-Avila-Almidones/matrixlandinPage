<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servidor de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #f5f5f5;
            padding: 2em;
        }
        h1 {
            text-align: center;
        }
        .project-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1em;
            justify-content: center;
        }
        .project {
            background-color: #2d2d2d;
            padding: 1em 2em;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            box-shadow: 0 0 10px #00000055;
            transition: background-color 0.3s;
        }
        .project:hover {
            background-color: #3a3a3a;
        }
    </style>
</head>
<body>
    <h1>🧪 Proyectos Disponibles en el Servidor</h1>
    <div class="project-list">
        <?php
        $base = __DIR__;
        $dirs = array_filter(glob($base . '/*'), 'is_dir');

        foreach ($dirs as $dir) {
            $name = basename($dir);
            echo "<a class='project' href='/$name/'>$name</a>";
        }
        ?>
    </div>
</body>
</html>

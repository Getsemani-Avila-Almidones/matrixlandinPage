<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matrix - Proyectos Web</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #282a36; /* Dracula background */
            color: #f8f8f2; /* Dracula foreground */
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #21222c;
            padding: 1.5em;
            text-align: center;
            color: #bd93f9;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        main {
            padding: 2em;
        }
        h2 {
            text-align: center;
            margin-bottom: 2em;
            font-size: 1.8em;
            color: #bd93f9;
        }
        .project-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5em;
            padding: 0 2em;
        }
        .project {
            background-color: #44475a;
            padding: 1.2em 1em;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            color: #f8f8f2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #6272a4;
        }
        .project:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35);
            background-color: #6272a4;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            header h1 {
                font-size: 1.6em;
            }
            h2 {
                font-size: 1.4em;
            }
            .project-list {
                padding: 0 1em;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>🌐 Bienvenido a Matrix Web Server 🌐</h1>
    </header>

    <main>
        <h2>😎 Proyectos Disponibles 🤓</h2>
        <div class="project-list">
            <?php
            $base = dirname(__DIR__);
            $dirs = array_filter(glob($base . '/*'), 'is_dir');

            foreach ($dirs as $dir) {
                $name = basename($dir);
                if ($name !== "html") {
                    echo "<a class='project' href='/$name/'>$name</a>";
                }
            }
            ?>
        </div>
    </main>

    <footer>
        © <?php echo date("Y"); ?> Matrix Server. Desarrollado por Getsemani Ávila.
    </footer>
</body>
</html>

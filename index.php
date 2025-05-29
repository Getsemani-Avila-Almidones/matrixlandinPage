<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matrix - 🌐 Proyectos Web ✨</title>
    <style>
        * {
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #282a36;
            color: #f8f8f2;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        header, footer {
            background-color: #21222c;
            color: #bd93f9;
            text-align: center;
            padding: 1.2em;
            position: sticky;
            z-index: 10;
        }
        header {
            top: 0;
        }
        footer {
            bottom: 0;
            margin-top: auto;
        }
        header h1 {
            margin: 0;
            font-size: 2em;
        }
        main {
            padding: 2em 1em;
            flex: 1;
        }
        h2 {
            text-align: center;
            margin-bottom: 2em;
            font-size: 1.8em;
            color: #bd93f9;
        }
        .project-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1em;
            padding: 0 1em;
        }
        .project {
            background-color: #44475a;
            padding: 0.8em 1em;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            color: #f8f8f2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #6272a4;
            width: 180px;
            font-weight: bold;
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
            .project {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>🌐 Bienvenido a Matrix Web Server 🌐</h1>
    </header>

    <main>
        <h2>📤 Proyectos Disponibles 🗃️</h2>
        <div class="project-list">
            <?php
            $base = dirname(__DIR__);
            $dirs = array_filter(glob($base . '/*'), 'is_dir');

            foreach ($dirs as $dir) {
                $name = basename($dir);
                if ($name !== "html") {
                    $emoji = '📦'; // Por defecto (error amigable)
                    $label = $name;

                    // Intentar parsear por el último "_"
                    if (strpos($name, '_') !== false) {
                        $parts = explode('_', $name);
                        $branch = strtolower(array_pop($parts));
                        $project = implode('_', $parts);

                        // Convertir proyecto a CamelCase
                        $projectName = ucwords(strtolower(str_replace('_', ' ', $project)));
                        $projectName = str_replace(' ', '', $projectName);

                        // Asignar emoji según la rama
                        switch ($branch) {
                            case 'main':
                                $emoji = '🟢';
                                break;
                            case 'dev':
                                $emoji = '🧪';
                                break;
                            default:
                                $emoji = '🦋';
                                break;
                        }

                        // Construir nombre visual
                        $label = "{$emoji}\n{$projectName}";
                    }

                    echo "<a class='project' href='/$name/'>{$label}</a>";
                }
            }
            ?>
        </div>
    </main>

    <footer>
        © <?php echo date("Y"); ?> Matrix Server. Desarrollado por Getsemani Ávila - Jefe de Applicaciones.
    </footer>
</body>
</html>

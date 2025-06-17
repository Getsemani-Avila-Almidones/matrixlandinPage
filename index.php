<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ALMEX · Proyectos</title>
  <style>
    :root {
      --primary-color: #1d3557;
      --secondary-color: #457b9d;
      --accent-color: #a8dadc;
      --bg-color: #f1f1f1;
      --text-color: #212529;
      --card-bg: #ffffff;
    }

    [data-theme="dark"] {
      --primary-color: #100101;
      --secondary-color: #a8dadc;
      --accent-color: #24aeea;
      --bg-color: #121212;
      --text-color: #f1f1f1;
      --card-bg: #1e1e1e;
    }

    *, *::before, *::after {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      display: flex;
      flex-direction: column;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
    }

    header, footer {
      background-color: var(--primary-color);
      color: white;
      text-align: center;
      padding: 1.5em 1em;
      position: relative;
    }

    header h1 {
      margin: 0;
      font-size: 1.8em;
      letter-spacing: 1px;
    }

    main {
      flex: 1;
      padding: 2em 1em;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
    }

    h2 {
      color: var(--secondary-color);
      margin-bottom: 1.5em;
      font-size: 1.5em;
      border-left: 5px solid var(--secondary-color);
      padding-left: 0.5em;
    }

    .project-list {
      display: flex;
      flex-wrap: wrap;
      gap: 1em;
      justify-content: center;
    }

    .project {
      background: var(--card-bg);
      border: 1px solid var(--accent-color);
      border-left: 5px solid var(--secondary-color);
      padding: 1em 1.2em;
      border-radius: 8px;
      text-decoration: none;
      color: var(--text-color);
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease-in-out;
      flex: 1 1 250px;
      max-width: 350px;
    }

    .project:hover {
      background-color: var(--accent-color);
      color: var(--primary-color);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .project::before {
      content: "🧩 ";
      margin-right: 0.3em;
    }

    footer {
      font-size: 0.9em;
    }

    .theme-toggle {
      position: absolute;
      top: 1em;
      right: 1em;
      background-color: transparent;
      border: 2px solid var(--accent-color);
      border-radius: 20px;
      padding: 0.4em 0.8em;
      color: var(--accent-color);
      cursor: pointer;
      font-size: 1em;
      transition: background 0.3s, color 0.3s;
    }

    .theme-toggle:hover {
      background-color: var(--accent-color);
      color: var(--primary-color);
    }

    @media (max-width: 768px) {
      header h1 {
        font-size: 1.5em;
      }

      h2 {
        font-size: 1.3em;
      }

      .project {
        flex: 1 1 100%;
        max-width: 100%;
      }

      .theme-toggle {
        top: 0.5em;
        right: 0.5em;
        font-size: 0.9em;
      }
    }

    @media (max-width: 480px) {
      header, footer {
        padding: 1em 0.5em;
      }

      .project-list {
        flex-direction: column;
        align-items: stretch;
      }

      .project {
        padding: 0.9em;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1>Plataforma de Proyectos Tecnológicos · MATRIX</h1>
    <button id="theme-toggle" class="theme-toggle"></button>
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
    © 2025 MATRIX · Desarrollado por Getsemani Ávila · Jefe de Aplicaciones
  </footer>

  <script>
    
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedTheme = localStorage.getItem("theme") || (prefersDark ? "dark" : "light");
    document.documentElement.setAttribute("data-theme", savedTheme);

    function updateThemeIcon(btn, theme) {
      btn.textContent = theme === "dark" ? "☀️ Claro" : "🌙 Oscuro";
    }

    function toggleTheme() {
      const current = document.documentElement.getAttribute("data-theme");
      const next = current === "dark" ? "light" : "dark";
      document.documentElement.setAttribute("data-theme", next);
      localStorage.setItem("theme", next);
      updateThemeIcon(document.getElementById("theme-toggle"), next);
    }

    window.addEventListener("DOMContentLoaded", () => {
      const btn = document.getElementById("theme-toggle");
      updateThemeIcon(btn, savedTheme);
      btn.addEventListener("click", toggleTheme);
    });
  </script>
</body>
</html>

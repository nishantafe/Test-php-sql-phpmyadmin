# PHP + MySQL + phpMyAdmin Starter (GitHub Codespaces)

## Start (2 minutes, nothing to install)
1. Log in to [github.com](https://github.com) (free account).
2. On this repo's page, click **Use this template** → **Create a new repository** (this is your own copy).
3. In your new repo click **Code** → **Codespaces** → **Create codespace on main**. Wait a few minutes (first time only).
4. Open the **Ports** tab (bottom panel) and click the 🌐 globe next to **Website (8080)**. Done!

## Where to work
Edit files in `src/` (start with `index.php`). Save, then refresh the website tab.

## Examples
- `src/index.php` - simple: read + add (students table)
- `src/crud.php` - full Create / Read / Update / Delete (books table)

## Database
- Open **phpMyAdmin**: Ports tab → globe next to **phpMyAdmin (8081)** → login `student` / `student`.
- In your PHP code: host `db`, database `school`, user `student`, password `student`.
- **Database Client** (left sidebar, database icon): click **+** → MySQL → host `db`, port `3306`, user `student`, password `student`, database `school` → **Connect**. Right-click a table to browse and edit it.
- PHP autocomplete (Intelephense) works automatically.

## Reset the database
In the terminal (bottom panel):
```
docker compose -f /workspace/docker-compose.yml down -v
```
Then press `F1` → **Codespaces: Rebuild Container**. Tables from `db/init.sql` are recreated.

## Save your work
Use the Source Control icon (left sidebar): write a message → **Commit** → **Sync**.

## Stop the Codespace (important!)
Free accounts have a monthly limit. When you finish: go to [github.com/codespaces](https://github.com/codespaces) → `...` → **Stop codespace**.

## Troubleshooting
- **Website shows an error:** wait 30 seconds (database is still starting) and refresh.
- **Port not listed:** press `F1` → **Codespaces: Rebuild Container**.

## Running on your own computer (optional)
Install Docker Desktop + VS Code + the Dev Containers extension, open the folder, then **Reopen in Container**. Website: http://localhost:8080, phpMyAdmin: http://localhost:8081.

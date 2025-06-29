# Workshop: The Big Makeover

Welcome to the base repository for the workshop ["The Big Makeover" at WSC2025](https://websummercamp.com/2025/workshop/the-big-makeover-rejuvenating-legacy-applications).

**For workshop participants:** Please follow the instructions below on the day before the workshop, so you will be ready to go. We will continue to push updates to the repository while we are going along in the session. But it's better to download and build the big stuff (the containers) up front.

**For random visitors:** This codebase is the starting point for a conference workshop about refactoring legacy applications. **None of this code is safe, or even sane... that's the point.** Do not run this app live on the internet.

## Requirements

You will need:

- Docker and Docker Compose
- Git
- A PHP IDE of your choice
- A database tool capable of accessing Postgres (totally optional, PHPStorms built-in feature should do if you need one at all)

## Setup Instructions

1. Clone the repository:

   ```bash
   git clone git@github.com:meandmymonkey/wsc2025-bigmakeover.git
   cd wsc2025-bigmakeover
   ```

2. **Optional:** If you need to change the ports published to your host, create a `.env` file in the project root:

   ```bash
   # Web server and database ports on the host machine, adapt to your needs
   HTTP_PORT=8000
   PG_PORT=5432
   ```

3. Build and start the containers:

   ```bash
   make docker-build
   make up
   ```
   
   **Note:** If `make` is not available on your machine, you can execute the commands directly:

    ```bash
   docker compose build --no-cache
   docker compose up -d
   ```
   
4. Initialize the database:
   
   ```bash
   make reset-db
   ```

5. Access the application in your browser:

   ```
   https://localhost:8000
   ```

   (accept the generated certificate)

## Stopping the Application

```bash
make down
```
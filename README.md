### Prerequisites

* Docker
* Composer

### Installation

1. Install Composer Dependencies
    ```sh
    composer install
   ```

2. Configure environment variables in core/env.php and docker-compose.yml

3. Build and Run Docker Compose
   ```sh
   docker compose up
   ```

4. Bash inside the Docker web container and run migrations, to build the DB schema
   ```sh
   docker exec -it web-server-container-mapon bash
   /var/www/html#: ./vendor/bin/doctrine-migrations migrate
   ```

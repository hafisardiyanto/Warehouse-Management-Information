#!/bin/sh

# Exit on error
set -e

# Wait for MySQL to be ready (up to 30 seconds)
echo "Waiting for database connection..."
MAX_RETRIES=30
RETRY=0
until php -r "
  \$host = getenv('DB_HOST') ?: 'warehouse_db';
  \$port = getenv('DB_PORT') ?: 3306;
  \$sock = @fsockopen(\$host, \$port, \$errno, \$errstr, 2);
  if (\$sock) { fclose(\$sock); exit(0); }
  exit(1);
" 2>/dev/null; do
  RETRY=$((RETRY + 1))
  if [ "$RETRY" -ge "$MAX_RETRIES" ]; then
    echo "Database not available after ${MAX_RETRIES}s. Exiting."
    exit 1
  fi
  echo "Database not ready yet (attempt $RETRY/$MAX_RETRIES), retrying in 1s..."
  sleep 1
done
echo "Database is ready!"

# Run migrations
php artisan migrate --force

# Ensure write permissions for storage and bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Cache configuration and routes
php artisan config:cache
php artisan route:cache

# Execute the original CMD
exec "$@"

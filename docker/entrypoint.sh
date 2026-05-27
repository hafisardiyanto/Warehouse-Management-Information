#!/bin/sh

# Exit on error
set -e

# Run migrations
php artisan migrate --force

# Cache configuration and routes
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the original CMD
exec "$@"

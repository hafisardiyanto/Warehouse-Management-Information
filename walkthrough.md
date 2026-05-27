# User Creation Walkthrough

I have automatically created the admin and warehouse manager users by running the [UserSeeder](file:///c:/laragon/www/Warehouse-Management-Information/database/seeders/UserSeeder.php#10-53).

## Changes Made
- Executed `php artisan db:seed --class=UserSeeder`.
- This populated the `users` table with the default users defined in the seeder.

## Created Users
| Name | Email | Role | Password |
| :--- | :--- | :--- | :--- |
| **Udin** | admin@gmail.com | Admin | `admin123` |
| **Ahmad** | ahmad@gmail.com | pengelola gudang | `inipassword` |
| **Asep** | asep@gmail.com | petani | `inipassword` |
| **Samsul** | samsul@gmail.com | petani | `inipassword` |
| **Jamal** | jamal@gmail.com | petani | `inipassword` |

## Verification Results
I verified the creation by running a Tinker command to check the records in the database. The users are now ready for use.

You can now log in using these credentials.

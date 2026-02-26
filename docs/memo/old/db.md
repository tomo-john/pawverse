# DB関連

今回MySQLを使用する🐶

## テーブル作成

```sql
-- mysql -u root --
CREATE DATABASE pawverse CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

```sql
-- CREATE USER 'john'@'localhost' IDENTIFIED BY 'john1234'; # ユーザーはすでに作成済みの為不要 --
GRANT ALL PRIVILEGES ON pawverse.* TO 'john'@'localhost';
FLUSH PRIVILEGES;
```

## .env

これは実値。`commit`はしない。(最初から`.gitignore`に入ってた)

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pawverse
DB_USERNAME=john
DB_PASSWORD=john1234
```

`.env.exapmle`を編集(ダミー値)

```bash
php artisan config:clear
php artisan migrate
```


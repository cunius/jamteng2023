# Cunius's 엉망징창 코딩놀이 for fun
### Reflected XSS / Stored XSS / DOM XSS / CSRF / SSRF 취약점 구현

## Setup
```shell
# 업데이트 및 아파치/PHP/MySQL 설치
sudo apt udpate
sudo apt install -y apache2 libapache2-mod-php php php-mysql mysql-server

# 아파치/MySQL 실행 및 자동시작 등록
sudo systemctl start apache2
sudo systemctl start mysql
sudo systemctl enable apache2
sudo systemctl enable mysql

# 정상작동확인1
systemctl status apache2
systemctl status mysql
php -v
curl http://127.0.0.1

# DB 기본 설정
sudo mysql_secure_installation

# info.php 생성
sudo vi /var/www/html/info.php # add this: <?php phpinfo(); ?>

# 정상작동확인2
curl http://127.0.0.1/info.php
```

#### If error
```shell
sudo a2enmod rewrite
sudo systemctl restart apache2
```

## MySQL
```sql
CREATE DATABASE db_name;
CREATE USER 'uname'@'localhost' IDENTIFIED BY 'passWord';
GRANT ALL PRIVILEGES ON db_name.* TO 'uname'@'localhost';
FLUSH PRIVILEGES;

USE db_name;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(50) NOT NULL,
    userPassword VARCHAR(50) NOT NULL,
    userEmail varchar(50) not null,
    userAddr varchar(50) not null,
    isAdmin TINYINT(1) DEFAULT 0
);

CREATE TABLE bbs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    userId varchar(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

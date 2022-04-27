**1. Cài đặt môi trường web:**<br>
nhớ cài docker trước
**B1: Clone thư mục code**
- git clone ...

**B2: cd deployment**
- Run: docker-compose up -d

**B3: Run: docker exec -it laravel_web bash (winpty docker exec -it laravel_web bash nếu là windows)**
-  cd /var/www/html/laravel-sample/
- 「composer install」 or 「composer install --no-dev」
- cp .env.example .env
- php artisan key:generate
- php artisan storage:link
- chown root:apache -R .
- chmod 775 -R .
- git config core.filemode false
- mkdir logs
- npm install

**B4: Run: docker exec -it laravel_db bash (winpty docker exec -it laravel_db bash nếu là windows)**
- Run: mysql -u root -proot
- Run:<br>
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';<br>
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'root';

**B5: Tạo DB laravel**
- Truy cập http://localhost:49310/?server=laravel_db&username=root
- Tạo DB: laravel (utf8mb4_general_ci)
- Run: php artisan migrate

**B6: Edit file .env<br>**
DB_CONNECTION=mysql<br>
DB_HOST=laravel_db<br>
DB_PORT=<br>
DB_DATABASE=laravel<br>
DB_USERNAME=root<br>
DB_PASSWORD=root<br>

**B7: Start apache**
- Run: echo 'IncludeOptional sites-enabled/*.conf' >> /etc/httpd/conf/httpd.conf
- Run: systemctl enable httpd
- Run: systemctl restart httpd.service

**B8: Run web**
Website: http://localhost:49081/<br>

**B9: Thay đổi max size file upload (mặc định: 2M)**
-   cd /etc
-   vim php.ini
-   Thay đổi giá trị upload_max_size ở dòng 846 (Gợi ý: 10M)
-   bấm esc xong :wq để thoát ra
-   docker stop id (containder id của laravel_web)
-   docker run -dit -v /root/php/php.ini:usr/local/etc/php/php.ini -p 49081:8011 id (container id của laravel_web)
-   docker start id (container id laravel_web)
-   kiểm tra upload_max_filesize bằng phpinfo()

**2. Login vào web:** <br>
**B1: Run:**<br>
php artisan db:seed --class=RoleSeeder;<br>
php artisan db:seed --class=DepartmentSeeder;<br>
php artisan db:seed --class=UserSeeder;<br>

**B2: edit file .env<br>**
MAIL_DRIVER=smtp<br>
MAIL_HOST=smtp.gmail.com<br>
MAIL_PORT=587<br>
MAIL_USERNAME=nguyenvietthangkks@gmail.com<br>
MAIL_PASSWORD=********(Liên hệ gmail để lấy password)<br> 
MAIL_ENCRYPTION=tls<br>

**B3: send mail with queue:**<br>
php artisan queue:work;<br>

**B4: Login<br>**
Đăng nhập với tài khoản<br>
email: admin@gmail.com<br>
password: 123456a<br>

video: https://youtu.be/h5Be2QdO4xM

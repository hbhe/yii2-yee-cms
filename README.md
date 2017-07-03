# YEE CMS
YeeCMS - Control Panel Based On Yii2 PHP Framework

Installation
------------

### Installing Yee CMS application. 

  1. Installing (using Composer)

    If you do not have [Composer](http://getcomposer.org/), follow the instructions in the
    [Installing Yii](https://github.com/yiisoft/yii2/blob/master/docs/guide/start-installation.md#installing-via-composer) section of the definitive guide to install it.

    With Composer installed, you can then install the application using the following commands:

    ```bash
    cd /var/www/
    composer global require "fxp/composer-asset-plugin:^1.2.0"
    composer create-project --prefer-dist --stability=dev yeesoft/yii2-yee-cms mysite.com 
    ```

  2. Initialize the installed application

     Execute the `init` command and select `dev` or `prod` as environment.

      ```bash
      cd /var/www/mysite.com/
      php init
      ```
  
  3. Configurate your web server:

     For Apache config file could be the following:
     
     ```apacheconf
     <VirtualHost *:80>
       ServerName mysite.com
       ServerAlias www.mysite.com
       DocumentRoot "/var/www/mysite.com/"
       <Directory "/var/www/mysite.com/">
         AllowOverride All
       </Directory>
     </VirtualHost>
     ```
     For Nginx config file could be the following:
     
     ```nginx
     server {
         charset      utf-8;
         client_max_body_size  200M;
         listen       80;
     
         server_name  mysite.com;
         root         /var/www/mysite.com;
     
         location / {
             root  /var/www/mysite.com/frontend/web;
             try_files  $uri /frontend/web/index.php?$args;
     
             # avoiding processing of calls to non-existing static files by Yii
             location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
                 access_log  off;
                 expires  360d;
                 try_files  $uri =404;
             }
         }
     
         location /admin {
             alias  /var/www/mysite.com/backend/web;
             rewrite  ^(/admin)/$ $1 permanent;
             try_files  $uri /backend/web/index.php?$args;
         }
     
         # avoiding processing of calls to non-existing static files by Yii
         location ~ ^/admin/(.+\.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar))$ {
             access_log  off;
             expires  360d;
     
             rewrite  ^/admin/(.+)$ /backend/web/$1 break;
             rewrite  ^/admin/(.+)/(.+)$ /backend/web/$1/$2 break;
             try_files  $uri =404;
         }
     
         location ~ \.php$ {
             include  fastcgi_params;
             # check your /etc/php5/fpm/pool.d/www.conf to see if PHP-FPM is listening on a socket or port
             fastcgi_pass  unix:/var/run/php5-fpm.sock; ## listen for socket
             #fastcgi_pass  127.0.0.1:9000; ## listen for port
             fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
             try_files  $uri =404;
         }
         #error_page  404 /404.html;
     
         location = /requirements.php {
             deny all;
         }
     
         location ~ \.(ht|svn|git) {
             deny all;
         }
     }
     ```
     
       
  4. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

  5. Apply all migrations with console command `php yii migrate --migrationLookup=@yeesoft/yii2-yee-core/migrations/,@yeesoft/yii2-yee-auth/migrations/,@yeesoft/yii2-yee-settings/migrations/,@yeesoft/yii2-yee-menu/migrations/,@yeesoft/yii2-yee-user/migrations/,@yeesoft/yii2-yee-translation/migrations/,@yeesoft/yii2-yee-media/migrations/,@yeesoft/yii2-yee-post/migrations/,@yeesoft/yii2-yee-page/migrations/,@yeesoft/yii2-comments/migrations/,@yeesoft/yii2-yee-comment/migrations/,@yeesoft/yii2-yee-seo/migrations/`.

  6. Init root user with console command `php yii init-admin`.

  7. Configurate your mailer `['components']['mailer']` in `common/config/main-local.php`.

#####Your `Yee CMS` application is installed. Visit your site `mysite.com` or admin panel `mysite.com/admin`, the site should work and message _Congratulations! You have successfully created your Yii-powered application_ should be displayed.

----------------------
### 增加其它模块
  8.  Add yii2-yee-eav, yii2-yee-link, yii2-yee-block
    ```
  php yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-eav/migrations/
  php yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-link/migrations/
  php yii migrate --migrationPath=@vendor/yeesoft/yii2-yee-block/migrations/
    ```


### 增加中文支持
    ```
  php yii migrate --migrationPath=@vendor/yeesoft/yee-i18n/zh-CN/
    ```
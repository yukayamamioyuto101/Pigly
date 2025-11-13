# PiGly


## Dockerビルド

1.git clone https://github.com/yukayamamioyuto101/Pigly.git

2.cd mogitate-laravel

3.docker-compose build

  docker-compose up -d
  

## Laravel環境構築

1.docker-compose exec php bash

2.composer install

3.cp .env .example .env

4.php artisan key:generate

5.php artisan migrate#
（必要に応じて　chmod -R 775 storage bootstrap/cache）

6.php artisan db:seed


## 使用技術

　PHP  8.4.7
 
　Laravel 8.83.29
 
　Mysql  8.0.26
 

## URL

　開発環境：http://localhost/weight_logs
 
  phpMyAdmin http://localhost:8080/


## 使いかた
  1．ユーザー情報を登録してログインする
  
  ２．現在の体重と、目標体重を登録する
  
  ３．体重管理画面で、現在の体重、目標体重、目標までの体重をみることができる
  
      データ追加ボタンで、現在の体重、摂取カロリー、運動時間、運動内容を登録できる
      
      詳細ボタンでデータの編集・更新ができる

## ER図

<img width="2284" height="2444" alt="image" src="https://github.com/user-attachments/assets/90c4e2b5-5232-4fba-bfee-b5225fd6bc98" />







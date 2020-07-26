<p align="center">
    <h1 align="center">Product Import Service</h1>
    <br>
</p>


How to install
-------------------
Run following commands to install service

```
git clone https://github.com/davithuroyan/miniature-maker.git

composer install

php yii migrate

```

How to Config
---------------

Open ``config/db.php`` and replace DB connection credentials

You can change maximum processes count in ``config/params.php``  


How to add Import Task
------------
Run project using 

```
php yii serve
```

open http://localhost:8080

and press `Add Task` button and upload *.csv file


How to run Import scripts
------------

go to project root and run following command

```
php yii task/import
```

you can use this command to setup cron jobs 
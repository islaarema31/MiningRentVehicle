## About The Project

Website monitoring penyewaan alat berat.

## **How to Use** 
1. Clone the repository

    ```git clone https://github.com/AgungA1/NickelTransport-Monitor.git```


2. Switch to the repo folder

    ```cd MiningRentVehicle```


3. Install all the dependencies using composer

    ```composer install```

4. Copy the example env file and make the required configuration changes in the .env file

    ```cp .env.example .env```

5. Generate a new application key

    ``php artisan key:generate``

6. Run the database migrations

    ```php artisan migrate:fresh --seed```

7. Start run dev
    
    ```npm run dev```

8. Start the local development server

    ```php artisan serve```

<br>

## **Username & Password**

  #### ADMIN ACCOUNT
  ```admin@gmail.com```

  ```admin123```

  #### Staff 1 ACCOUNT
  ```staff1@gmail.com```

  ```staff1```

#### Staff 2 ACCOUNT 
```staff2@gmail.com```

```staff2```

<br>


## Database Version 

* MySQL 10.4.28

## PHP Version <a name="php-version"></a>

* PHP 8.2.4

## Framework Version 

* Laravel 10.0

## Physical Data Model & Activity Diagram 

* [Physical Data Model](public/pdm)
* [Activity Diagram](public/activity-diagram)

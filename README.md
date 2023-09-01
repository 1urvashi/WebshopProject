# mini webshop

This app is a demo API app that will give you an idea of the working of APIS in Laravel.

## Installation

```
git clone https://github.com/1urvashi/WebshopProject.git
composer install
cp .env.example .env
php artisan key:generate

Change Database name on .env file 
DB_DATABASE=api-webshop-project
```

### **Database setup**

Please open your localhost phpmyadmin / adminer, etc.

Navigate to folder SQL Schema File in this project and you will find a file named `api-webshop-project.sql`. Import that SQL file in you DBs list.
copy file to [here](./api-webshop-project.sql) 

### **Running the Command**

Run the command to import the data:

```
php artisan import:masterdata

```

### **Request Format and type**

If you are using POSTMAN. Please follow the below process

1. Set request type to `POST`
2. Set your base request URL
3. Below are list of APIs with required fields

### **List of APIs**

PN: My local server was http://localhost/WebshopProject/public/ You may change the settings as per you laravel environment.Available endpoints are-
```
1. api/orders

 Response: `{
    "data": [
        {
            "id": 1,
            "customer_id": 2,
            "paid": 1,
            "created_at": "2023-08-31T16:28:59.000000Z",
            "updated_at": "2023-08-31T16:28:59.000000Z"
        },
        {
            "id": 2,
            "customer_id": 1,
            "paid": 0,
            "created_at": "2023-08-31T16:29:34.000000Z",
            "updated_at": "2023-08-31T16:29:34.000000Z"
        },
        {
            "id": 3,
            "customer_id": 3,
            "paid": 0,
            "created_at": "2023-08-31T16:29:53.000000Z",
            "updated_at": "2023-08-31T16:29:53.000000Z"
        },
        {
            "id": 4,
            "customer_id": 1,
            "paid": 1,
            "created_at": "2023-08-31T16:30:10.000000Z",
            "updated_at": "2023-08-31T16:30:10.000000Z"
        }
    ]
}`

2. api/orders

request
{
   "customer_id": 4,
   "product_id": 2
}

{
    "message": "Order created"
}


3. api/orders/<id>/add

request

{
    "product_id": 2
}

3. api/orders/<id>/pay

payment request

{
    "order_id": 2,
    "customer_email": "developer@example.com",
    "value": 33.4
}
Payment Response Success

{
    "message": "Payment Successful"
}
Payment response failed

{
    "message": "Insufficient Funds"
}


```
These endpoints are also available as a [Postman](https://www.postman.com/) collection [here](./WebshopProject.postman_collection.json).


Feel free to email me, if you have any question.

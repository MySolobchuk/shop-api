<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## После пула с гита

- composer update
- php artisan migrate или php artisan migrate:fresh
- php artisan create:admin создаст админа

## Роуты

- Логин
  ``post`` ``/api/admin/login``

  Тело:
  ```
    {
        "email": "email@gmail.com",
        "password" : "password"
    }
    ```
  Ответ:
    ```
    {
        "token": "5|HarkVCpc7b2sEMqijn4OUoNUVqmGlnyQdsuG8ZCv"
    }
    ```

  User
  ``get`` ``/api/me``
  Ответ:
    ```
    {
        "id": 1,
        "name": "Vadim Solobchuk",
        "email": "test@gmail.com",
        "email_verified_at": null,
        "created_at": "2023-01-16T20:58:04.000000Z",
        "updated_at": "2023-01-16T20:58:04.000000Z"
    }
    ```
    - Создание продукта
      ``post`` ``/api/products``

  Тело:
  ```
    {
        "name": "product",
        "label" : "product",
        "description" : "product",
        "first_price : "4",
        "price" : "5.0",
        "code" : "1234",
        "category_id" : "4",
        "preview" : file,
    }
    ```
  Ответ:
    ```
    {
    	"data": {
    		"preview": "63d58a801649b.png",
    		"name": "product",
    		"label": "product",
    		"description": "product",
    		"first_price": "4",
    		"price": "5.0",
    		"code": "1234",
    		"category_id": "4",
    		"updated_at": "2023-01-28T20:50:08.000000Z",
    		"created_at": "2023-01-28T20:50:08.000000Z",
    		"id": 10,
    		"category": {
    			"id": 4,
    			"name": "test_update",
    			"created_at": "2023-01-23T21:22:37.000000Z",
    			"updated_at": "2023-01-23T21:22:37.000000Z"
    		}
	    }
    }
     ```
  Обнавление продукта
  ``post`` ``/api/products/1``

  Тело:
  ```
    {
        "name": "product",
        "label" : "product",
        "description" : "product",
        "first_price : "4",
        "price" : "5.0",
        "code" : "1234",
        "category_id" : "4",
        "preview" : file,
    }
    ```
  Ответ:
    ```
    {
    	"data": {
    		"preview": "63d58a801649b.png",
    		"name": "product",
    		"label": "product",
    		"description": "product",
    		"first_price": "4",
    		"price": "5.0",
    		"code": "1234",
    		"category_id": "4",
    		"updated_at": "2023-01-28T20:50:08.000000Z",
    		"created_at": "2023-01-28T20:50:08.000000Z",
    		"id": 10,
    		"category": {
    			"id": 4,
    			"name": "test_update",
    			"created_at": "2023-01-23T21:22:37.000000Z",
    			"updated_at": "2023-01-23T21:22:37.000000Z"
    		}
    	}
    }
    ```
  Получение продукта по ID
  ``GET`` ``/api/products/1``
  Ответ:
    ```
    {
    	"data": {
    		"preview": "63d58a801649b.png",
    		"name": "product",
    		"label": "product",
    		"description": "product",
    		"first_price": "4",
    		"price": "5.0",
    		"code": "1234",
    		"category_id": "4",
    		"updated_at": "2023-01-28T20:50:08.000000Z",
    		"created_at": "2023-01-28T20:50:08.000000Z",
    		"id": 10,
    		"category": {
    			"id": 4,
    			"name": "test_update",
    			"created_at": "2023-01-23T21:22:37.000000Z",
    			"updated_at": "2023-01-23T21:22:37.000000Z"
    		}
    	}
    }
    ```
  Удаление продукта по ID
  ``DELETE`` ``/api/products/1``

  Пагинация
  ``GET`` ``/api/products``
  Ответ:
    ```
    {
	"data": [
		{
			"id": 1,
			"name": "product",
			"label": "product",
			"description": "product",
			"first_price": 4,
			"price": 5,
			"code": 1234,
			"preview": null,
			"category_id": 4,
			"created_at": "2023-01-23T21:36:45.000000Z",
			"updated_at": "2023-01-23T21:36:45.000000Z",
			"category": {
				"id": 4,
				"name": "test_update",
				"created_at": "2023-01-23T21:22:37.000000Z",
				"updated_at": "2023-01-23T21:22:37.000000Z"
			}
		},
		{
			"id": 2,
			"name": "product",
			"label": "product",
			"description": "product",
			"first_price": 4,
			"price": 5,
			"code": 1234,
			"preview": null,
			"category_id": 4,
			"created_at": "2023-01-23T21:37:46.000000Z",
			"updated_at": "2023-01-23T21:37:46.000000Z",
			"category": {
				"id": 4,
				"name": "test_update",
				"created_at": "2023-01-23T21:22:37.000000Z",
				"updated_at": "2023-01-23T21:22:37.000000Z"
			}
		},
		{
			"id": 3,
			"name": "product",
			"label": "product",
			"description": "product",
			"first_price": 4,
			"price": 5,
			"code": 1234,
			"preview": null,
			"category_id": 4,
			"created_at": "2023-01-23T21:39:50.000000Z",
			"updated_at": "2023-01-23T21:39:50.000000Z",
			"category": {
				"id": 4,
				"name": "test_update",
				"created_at": "2023-01-23T21:22:37.000000Z",
				"updated_at": "2023-01-23T21:22:37.000000Z"
			}
		},
		{
			"id": 4,
			"name": "product",
			"label": "product",
			"description": "product",
			"first_price": 4,
			"price": 5,
			"code": 1234,
			"preview": null,
			"category_id": 4,
			"created_at": "2023-01-23T21:39:53.000000Z",
			"updated_at": "2023-01-23T21:39:53.000000Z",
			"category": {
				"id": 4,
				"name": "test_update",
				"created_at": "2023-01-23T21:22:37.000000Z",
				"updated_at": "2023-01-23T21:22:37.000000Z"
			}
		}
	],
	"links": {
		"first": "http:\/\/localhost:8100\/api\/products?page=1",
		"last": "http:\/\/localhost:8100\/api\/products?page=1",
		"prev": null,
		"next": null
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"last_page": 1,
		"links": [
			{
				"url": null,
				"label": "&laquo; Previous",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8100\/api\/products?page=1",
				"label": "1",
				"active": true
			},
			{
				"url": null,
				"label": "Next &raquo;",
				"active": false
			}
		],
		"path": "http:\/\/localhost:8100\/api\/products",
		"per_page": 15,
		"to": 4,
		"total": 4
    	}
    }
    ```

  Создание категории
  ``post`` ``/api/categories``

  Тело:
  ```
    {
        "name": "test_update11",
    }
    ```
  Ответ:
    ```
    {
	"data": {
		"name": "test_update11",
		"updated_at": "2023-01-28T20:26:19.000000Z",
		"created_at": "2023-01-28T20:26:19.000000Z",
		"id": 8,
		"products": []
	    }
    }
     ```
  Обнавление категории
  ``post`` ``/api/categories/8``

  Тело:
  ```
    {
        "name": "product",
    }
    ```
  Ответ:
    ```
     {
	"data": {
		"name": "product",
		"updated_at": "2023-01-28T20:26:19.000000Z",
		"created_at": "2023-01-28T20:26:19.000000Z",
		"id": 8,
		"products": []
	    }
    }
    ```
  Получение продукта по ID
  ``GET`` ``/api/categories/4``
  Ответ:
    ```
    {
	"data": {
		"id": 4,
		"name": "test_update",
		"created_at": "2023-01-23T21:22:37.000000Z",
		"updated_at": "2023-01-23T21:22:37.000000Z",
		"products": [
			{
				"id": 1,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-23T21:36:45.000000Z",
				"updated_at": "2023-01-23T21:36:45.000000Z"
			},
			{
				"id": 2,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-23T21:37:46.000000Z",
				"updated_at": "2023-01-23T21:37:46.000000Z"
			},
			{
				"id": 3,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-23T21:39:50.000000Z",
				"updated_at": "2023-01-23T21:39:50.000000Z"
			},
			{
				"id": 4,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-23T21:39:53.000000Z",
				"updated_at": "2023-01-23T21:39:53.000000Z"
			},
			{
				"id": 5,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-28T20:19:38.000000Z",
				"updated_at": "2023-01-28T20:19:38.000000Z"
			},
			{
				"id": 6,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-28T20:19:58.000000Z",
				"updated_at": "2023-01-28T20:19:58.000000Z"
			},
			{
				"id": 7,
				"name": "product",
				"label": "product",
				"description": "product",
				"first_price": 4,
				"price": 5,
				"code": 1234,
				"preview": null,
				"category_id": 4,
				"created_at": "2023-01-28T20:22:19.000000Z",
				"updated_at": "2023-01-28T20:22:19.000000Z"
		    	}
		    ]
	    }
    }
    ```
  Удаление продукта по ID
  ``DELETE`` ``/api/categories/5``

  Пагинация
  ``GET`` ``/api/categories``
  Ответ:
    ```
    {
	"data": [
		{
			"id": 4,
			"name": "test_update",
			"created_at": "2023-01-23T21:22:37.000000Z",
			"updated_at": "2023-01-23T21:22:37.000000Z",
			"products": [
				{
					"id": 1,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-23T21:36:45.000000Z",
					"updated_at": "2023-01-23T21:36:45.000000Z"
				},
				{
					"id": 2,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-23T21:37:46.000000Z",
					"updated_at": "2023-01-23T21:37:46.000000Z"
				},
				{
					"id": 3,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-23T21:39:50.000000Z",
					"updated_at": "2023-01-23T21:39:50.000000Z"
				},
				{
					"id": 4,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-23T21:39:53.000000Z",
					"updated_at": "2023-01-23T21:39:53.000000Z"
				},
				{
					"id": 5,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-28T20:19:38.000000Z",
					"updated_at": "2023-01-28T20:19:38.000000Z"
				},
				{
					"id": 6,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-28T20:19:58.000000Z",
					"updated_at": "2023-01-28T20:19:58.000000Z"
				},
				{
					"id": 7,
					"name": "product",
					"label": "product",
					"description": "product",
					"first_price": 4,
					"price": 5,
					"code": 1234,
					"preview": null,
					"category_id": 4,
					"created_at": "2023-01-28T20:22:19.000000Z",
					"updated_at": "2023-01-28T20:22:19.000000Z"
				}
			]
		},
		{
			"id": 6,
			"name": "test_update11",
			"created_at": "2023-01-28T20:26:17.000000Z",
			"updated_at": "2023-01-28T20:26:17.000000Z",
			"products": []
		},
		{
			"id": 7,
			"name": "test_update11",
			"created_at": "2023-01-28T20:26:18.000000Z",
			"updated_at": "2023-01-28T20:26:18.000000Z",
			"products": []
		},
		{
			"id": 8,
			"name": "test_update12",
			"created_at": "2023-01-28T20:26:19.000000Z",
			"updated_at": "2023-01-28T20:26:36.000000Z",
			"products": []
		}
	],
	"links": {
		"first": "http:\/\/localhost:8100\/api\/categories?page=1",
		"last": "http:\/\/localhost:8100\/api\/categories?page=1",
		"prev": null,
		"next": null
	},
	"meta": {
		"current_page": 1,
		"from": 1,
		"last_page": 1,
		"links": [
			{
				"url": null,
				"label": "&laquo; Previous",
				"active": false
			},
			{
				"url": "http:\/\/localhost:8100\/api\/categories?page=1",
				"label": "1",
				"active": true
			},
			{
				"url": null,
				"label": "Next &raquo;",
				"active": false
			}
		],
		"path": "http:\/\/localhost:8100\/api\/categories",
		"per_page": 15,
		"to": 4,
		"total": 4
	    }
    }
    ```

- php artisan migrate или php artisan migrate:fresh
- php artisan create:admin создаст админа

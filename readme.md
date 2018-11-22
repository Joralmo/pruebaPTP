<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">

<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>

<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>

</p>

## Acerca del proyecto

Se tienen 2 migraciones importantes

>Persons

>CreatePseTransactionResponsesTable

Con los siguientes usos:

1. Person: Es la encargada de crear la tabla de personas, y junto con el seed DatabaseSeeder permite simular algunas personas que son utilizadas al momento de simular una transacción.
2. CreatePseTransactionResponsesTable: Que es la encargada de crear la tabla donde se almacena la información retornada despues de un createTransaction.

------

Se tiene un seeder que con la ayuda de Faker ayuda a guardar 10 personas en la base de datos, esto corriendo

```bash
php artisan db:seed
```

------

Cada migración tiene su respectivo Modelo

- Person
- PseTransactionResponse

Donde se define el nombre de la tabla en la BD y las columnas que queremos que se guarden en la BD

--- ---

Además de eso se cuenta con un Helper (SoapHelper) el cual es utilizado para hacer las peticiones al endpoint (con el método *post*), recibe por parametros el método a ser llamado y los argumentos que este método espere y nos retorna en forma de array lo que responda dicho método, también cuenta con un método llamado *auth* que nos retorna un objeto *Authentication* que es requerido para poderle hacer peticiones al endpoint, un ejemplo de su uso sería:

```php
$array = SoapHelper::post("getBankList", ['body' => ['auth' => SoapHelper::auth()]]);
```

Con esto tendríamos una lista de los bancos retornados por el método *getBankList* el cual espera como parametro un *auth* de tipo *Authentication*.

--- ---

Tenemos un controlador (TransactionController) que cuenta con 3 metodos:

1. formulario(): Se encarga de retornar a la vista la lista de bancos la cual es tomada de la memoria caché si existe, de lo contrario se le solicita al endpoint y es cacheada hasta las 23:59 del día en que fue solicitada
2. segVista(): Se encarga de crear el objeto *PSETransactionRequest* con la información necesaria enviada por el usuario en la vista del formulario, y se captura la ip y el agente navegador del cliente para entonces iniciar la transacción haciendo llamado al metodo *createTransaction* del endpoint, luego captura la respuesta y verifica si el código respuesta es *SUCCESS* y guarda los datos de respuesta en la tabla *pse_transaction_responses* de la BD y procede a redirigir al usuario a la url del banco retornada por el endpoint, si por el contrario el código de respuesta no es *SUCCESS* retornara a la vista con un mensaje de error.
3. reingreso(): Se encarga de recibir la información obtenida al reingreso del usuario y hace un llamado al método *getTransactionInformation* del endpoint para solicitar información de la ultima transacción y retorna al usuario una vista donde se le es mostrada la información acerca de su transacción de una forma legible

--- ---

Se tienen 3 rutas

1. / : Ruta principal que hace el llamado al método *formulario()* del controlador *TransactionController* y muestra al usuario la lista de bancos y para que elija si es *PERSONA* o *EMPRESA* y un botón de continuar que envía a la siguiente ruta.
2. /2 : Ruta la cual hace el llamado al metodo *segVista()* del controlador *TransactionController* y solo retorna una vista si el código de respuesta es diferente a *SUCCESS* y muestra el mensaje de error.
3. /3 : Ruta la cual hace el llamado a *reingreso()* del controlador *TransactionController* y le muestra una tabla al usuario con la información retornada por el método
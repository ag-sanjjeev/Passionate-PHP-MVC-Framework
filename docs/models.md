## Model

For Example, Here you can see basic implementation for model methods inside the controller logic.

The `User` model handles operations related to the users table in the database.

### Model class

To implement method related to the database such as create, update, delete and read operations. You need to create model class as follows:

```php
namespace app\models;

use app\core\Model;

class Users extends Model
{
   /**
    * The value of table name that can be overwritten here
    * Potential value will be a valid table name that should exist in database
    *
    * @var string $table
    */
   protected static string $table = "users";

   /**
    * The value of table column names to be accessed that can be overwritten here
    * Potential value will be a valid array of table columns
    *
    * @var array $fillable
    */
   protected static array $fillable = ['id', 'fullname', 'emailid', 'password', 'hash_id'];  
   
}
```

You need add namespace standard for autoloading feature. This model to be extends from base `Model` class. Leaving `$table` property as an empty, The `Model` class get from your Model Class Name. For Example, here `User.php` as model class for `user` table in the database, If you leave it then it assumes as by default lower case of the class name `user` otherwise it will throws an exception. Give it correctly for avoiding errors and such that for all models.

Similarly for fillable. If you leave it an empty then takes from database by default. And if you want mask the fields then give required fillables.

### Getting all data

Make sure you have model class exist inside `models` directory. Otherwise it can't possible to use these methods. And you need to use model class namespace.

To retrieve all records from the users table, you can use the following code:

```php
use app\models\Users;
```


```php
$user = new User;
$data = $user->all();
This creates a new instance of the `User` model and calls the `all()` method to fetch all records.
```
### Creating a record

To create a new record in the users table, you can use the following code:

```php
$user->create([
    'fullname' => 'testname',
    'emailId' => 'example@mail.com',
    'password' => $password,
    'hash_id' => $hash_id
]);
```

This code creates a new instance of the `User` model and calls the `create()` method, passing an array of data with the desired values for the new record.

### Updating a record

To update an existing record in the users table, you can use the following code:

```php
$user->update(2, [
    'fullname' => 'testname1',
    'emailId' => 'example@mail.com'
]);
```

This code updates the record with the ID of `2` in the users table. It calls the `update()` method on the `User` instance, passing the ID and an array of data with the updated values.

### Deleting a record

To delete a record from the users table, you can use the following code:

```php
$user->delete(3);
```

This code deletes the record with the ID of `3` from the users table. It calls the `delete()` method on the `User` instance, passing the ID of the record to be deleted.

### Executing raw SQL query

You need to use Database class namespace. If you need to execute a raw SQL query, you can use the following code:

```php
use app\core\Database;
```

```php
$user = new Database;
$query = "SELECT * FROM users WHERE id=:id";
$values = [':id' => 2];
$data = $user->query($query, $values)->fetchAll(\PDO::FETCH_ASSOC);
```

This code creates a new instance of the `Database` class and executes the SQL query defined in the `$query` variable. It uses the `$values` array to bind values to the placeholders in the query. The result of the query is fetched using the `fetchAll()` method with the `PDO::FETCH_ASSOC` fetch mode.
### HOW TO RUN

* rename env.example.default to .env
* set proper env variables in .env
* in project dir run `composer install`
* run `php artisan migrate:fresh --seed`
* run `php artisan optimize:clear`
* run `php artisan serve`

---

### Currently Done

* `localhost:8000/api/v1/transaction-reports` will return specific queries like
  * thirdHighestAmountOfTransactionByUser
  * userWhoUsedMostConversion
  * userWhoUsedHighestConversion
  * totalAmountConvertedForParticularUser

* JWT token authorization is implemented
  * Login
  * Registration
  * Refresh
  * Logout

* Patterns 
  * Used Repository Pattern
  * Used Service Layer
  * Used DTO pattern
  * Used Singleton pattern
  * Used Builder pattern
  * Used Traits for generic methods among the DTOs
  * Used DB::Transaction for UserCreate and WalletCreation

---

### WILL BE ADDED LATER

* Whole Currency Conversion and Transaction Process
* Factory Pattern for Either 
  * Only Transfer Or 
  * Transfer with Conversion
* Database locking mechanism for safe updates for sensitive rows/fields
* Background Process For Email and Notification
* RabbitMq implementation for Laravel Jobs
* Laravel Horizon Implementation for handling Jobs
* Overall centralized Exception handling throughout the system

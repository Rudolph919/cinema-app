## Tax Tim Cinema Application

Technology stack used for this application:
<li>Laravel Framework with the Jetstream starter kit as it gives you a good skeleton to start any application, and it also provides login/registration scaffolding</li>
<li>Tailwind CSS for styling purposes</li>
<li>Livewire for building of the interfaces</li>
<li>MySQL is used for the database because it is open source and very easy to set up.</li>

<p>I added a package that provides the required data for seeding purposes regarding the Cinema Application. The package is as follows: <strong>composer require xylis/faker-cinema-providers</strong></p>

Applied the DRY principle. Created form requests for store and update and later refactored to only use one FormRequest for both create/store and edit/update methods.

Could probably have implemented a confirmation dialog before deleting any resource.

Please follow the below commands to install the application:

1. Create a local database
2. If you don't have Composer installed, install it. https://getcomposer.org/download/
3. Download the source code
4. Rename the .env.example file to .env inside your project root and fill in the database details of the database created in step 1
5. Add your mail server details in the .env file. If you do not have a mail server and only plan on testing, I would suggest using Mailtrap for email testing. https://mailtrap.io/
6. Open a console and cd to your project root directory
7. Run composer install or php composer.phar install
8. Run npm install
9. Run php artisan key:generate
10. Run php artisan migrate:fresh --seed
11. Run php artisan serve

You can now access your project at localhost:8000

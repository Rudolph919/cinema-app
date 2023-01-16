## Tax Tim Cinema Application

Technology stack used for this application:
<li>Laravel Framework with the Jetstream starter kit as it gives you a good skeleton to start any application, and  it also 
provides login/registration scaffolding</li>
<li>Tailwind CSS for styling purposes</li>
<li>Livewire for building of the interfaces</li>
<li>MySQL is used for the database because it is open source and very easy to set up.</li>


<p>I added a package that provides the required data for seeding purposes regarding the Cinema Application. The package 
is as follows: <strong>composer require xylis/faker-cinema-providers</strong></p>

Applied the DRY principle. Created form requests for store and update and later refactored to only use one FormRequest 
for both create/store and edit/update methods.


Could probably have implemented a confirmation dialog before deleting

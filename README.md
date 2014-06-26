# booking-app

Laravel web application for booking appointments

## Hello!
This is an open-source web application designed to allow users to book an appointment. This is very much a work in progress, but the end product will:
***
 - Take into account time for each 'package' to be completed, ensuring no appointment overlapping will be possible
 - Implement a robust Administrator interface to easily select the dates and times that are available for appointments
 - Store user information (WITH THEIR PERMISSION) in order to create a database for mailing out newsletters and dealsj


## Instructions
To get this working, you need to first generate the database schema using the migrations and seeds I have set up. The database by default uses the 'booking.sqlite' file included

```php artisan migrate``` Creates the tables in the database

```php artisan db:seed``` Seeds the tables with the relevant data


I will be working on this as often as I can in my spare time ( In between work and ranking up in CS:GO ;) )


I encourage and appreciate any feedback related to this app. I am not currently aware of the full scope of the application, but I plan on making it easily customizable to anyone's needs.

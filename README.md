# booking-app

[![Join the chat at https://gitter.im/zeke8402/booking-app](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/zeke8402/booking-app?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Laravel web application for booking appointments

## Hello!
This is an open-source web application designed to allow users to book an appointment. This is very much a work in progress, but the end product will:
***
 - Take into account time for each 'package' to be completed, ensuring no appointment overlapping will be possible
 - Implement a robust Administrator interface to easily select the dates and times that are available for appointments
 - Store user information (WITH THEIR PERMISSION) in order to create a database for mailing out newsletters and deals


## Instructions
To get this working, you need to first generate the database schema using the migrations and seeds I have set up. The database by default uses the 'booking.sqlite' file included  
```php artisan migrate``` Creates the tables in the database  
```php artisan db:seed``` Seeds the tables with the relevant data  

Alternatively, you can run the script I made to easily remake the database for me, ```sh makedb.sh```

## Resources 
[Laravel](http://www.laravel.com) (obviously) for the framework  
[Bootstrap](http://www.getbootstrap.com) for the front-end  
[Bootswatch](http://www.bootswatch.com) for the base theme, which is (flatly)  
[jQuery](http://www.jquery.com) for the datepicker  
[FullCalendar](http://fullcalendar.io) for the admin calendar  
[Moment.js](http://www.momentjs.com) for date formatting  

I will be working on this as often as I can in my spare time ( In between work and school )

## Laravel 5
Laravel 5 released in the middle of the creation of this project, and since I am so close I decided not to migrate and finish it in Laravel 4. I might move the logic to a Laravel 5 project once I'm comfortable with the update, but until then I will use version 4.

## What's Left?
The main thing that is missing is an Administrator panel to allow the admin to dictate availability for each day. Once this feature is complete the app will be fully operational.

I encourage and appreciate any feedback related to this app.

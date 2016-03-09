# booking-app

[![Join the chat at https://gitter.im/zeke8402/booking-app](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/zeke8402/booking-app?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Laravel 5.1 web application for booking appointments

![Screenshot](https://raw.githubusercontent.com/zeke8402/booking-app/master/preview.png)

## Hello!
This is an open-source web application designed to allow users to book an appointment. This is very much a work in progress, but the end product will:
***
 - Take into account time for each 'package' to be completed, ensuring no appointment overlapping will be possible
 - Implement a robust Administrator interface to easily select the dates and times that are available for appointments
 - Store user information (WITH THEIR PERMISSION) in order to create a database for mailing out newsletters and deals


## Instructions
To get this working, you need to install dependencies and set up your .env...   
* run ```composer install```   
* run ```php artisan key:generate```   
* Now add the app key to your .env file, this is also where you define your database (there is an example in root called .env.example)
* Next, you need to run the database migrations...   
* ```php artisan migrate``` Creates the tables in the database   
* ```php artisan db:seed``` Seeds the tables with the relevant data   

## Resources 
[Laravel](http://www.laravel.com) (obviously) for the framework  
[Bootstrap](http://www.getbootstrap.com) for the front-end  
[Bootswatch](http://www.bootswatch.com) for the base theme, which is (paper)  
[jQuery](http://www.jquery.com) for the datepicker  
[FullCalendar](http://fullcalendar.io) for the admin calendar  
[Moment.js](http://www.momentjs.com) for date formatting  

I will be working on this as often as I can in my spare time ( In between work and school )

## What's Left?
The app, in essence, is fully operational. You can log in, set availability by dragging on the calendar, and users can book appointments, which then appear on your calendar. I intend to consolidate the two calendars together, and finish making certain configurations customizable (for example, the app segments dragged time into 30 minute intervals ). But if you don't mind manually changing values in the backend, then this app is usable.


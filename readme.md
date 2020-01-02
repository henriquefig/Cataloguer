# Cataloguer

## Introduction

A web application for creating and styling online catalogues.
Through a list (CSV), an user can upload products and style the way the product card will show up as well as style the page layout.
After the pretended configuration is made, a public link for the catalogues becomes available.

## Getting Started

### Installation

To use Catalaguer you will need laravel 5.8 installed. After that just clone this repo into your machine by doing:

```git clone https://github.com/henriquefig/Cataloguer.git```
or using the "clone repository" button up top.

Then go to the folder you've cloned the repository in and copy the ``` .env.example ``` to an ``` .env ``` file.
Fill in the file with your workspace information (database access) and open a terminal to run the following commands:

```
composer install

npm install

php artisan key:generate

php artisan migrate:fresh
```

After these commands you can either use the aplication through:

```php artisan serve```

and access it in your **localhost:8000** or go directly to **localhost/cataloguer/public** to see the homepage

### Usage

You should start by uploading/creating a catalogue.

**Beware when uploading a CSV, the file must contain headers otherwise your first line will be iterpreted as the headers**

After that you can customize your product card, your page layout, which fields you want visible and/or sortable.
You can also manually add entries, or upload a second CSV (**this time without the headers!**)

If you want to create a second catalogue you should register a new account, otherwise your first catalogue will be overwritten by the second one! 

### License

The Cataloguer is free software licensed under the MIT license.

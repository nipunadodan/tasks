# Orange - Lightweight PHP framework
Universal PHP framework - Orange

## Core
The core is impotered via composer. You can update the Core using,
```composer update```.

## Modules
This is where all the classes reside. By default it will be empty with a Test class. Core will have **Form** and **User** classes inside of the ```orange-core``` which are extended from the Model class.

**IMPORTANT:** If you want a model to inject data into a view, just use the model at the view since there no routing available to inject it automatically. But hey, it's the same thing without having the hassle to maintain a separate routes file and also it gives the liberty to have multiple models at once in a given view to work with.

### Database
You can handle the database either by using Medoo methods or directly using PDO.

**NOTE:** In future Medoo will use the same PDO object created by includes/dbconnect.php

## Processes
Always should return a json response which includes compulsorily,
- status [ success | danger | warning | info ]
- message [string]

## Pages
These are the pages you can view from the front-end. Having a ```.htaccess``` rewrites GET variable used for parsing views, the framework provides pretty URLs for each view.

Simply putting a php file in the name you want to have in the URL will give you the pleasure of having the view without having to have a routing nightmare.

Example:
- **views/about.php** will give you access to **[site_url]/about**

## Resources and Templates
This framework supports multiple templates. You can either have resources for each one of them in their own folders as well as common resources in the resources folder.

### Resources
Resouces folder is where it resides the commonly uses **fonts** and **images**.

### Templates
Each folder inside templates folder can contain a distinct template with their own resouces. You can select the active template from the **config** file on the docroot.

Files that compulsorily should contain in each template,
- header.php
- footer.php
- container.php
- menu.php [optional]

## AJAX
In the root folder of the core, ajax.php will route the ajax requests comes via includes/js/ajax.js. URL must be specified as site_url+'?process=[process_name as spcified in the form name]'+'-process'
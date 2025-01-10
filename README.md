# Requirements
- PHP 8.0+ and server ([XAMPP](https://www.apachefriends.org/fr/index.html) prefered)
- MySQL (included in XAMPP)
- A database called "weather" containing a table named "meteo" with columns "city" (set it as primary key for a better user experience), "max" and "min"
- This repo ;)

# Launch
Open XAMPP then start both Apache and MySQL servers. Go to the root of this repository, open your terminal and use :
```sh
php -S localhost:PORT
```
_PORT can be any valid 4 digits number like `5000`_.

**!! Warning : if you're working with a different terminal than the one provided by XAMPP, you may need to add xampp/php path to your environment variables.**

# API
- **/** is where you get on server start up 
- **index.php** loads everytime you submit the form (technically the same as **/**)
- **index.php?ville={}** loads when you delete a row

# Use
Here is what you should see when your start the server :

![index](index.png)

Otherwise, you should see the corresponding SQL error.

**!! Warning : the following website is written in French.**

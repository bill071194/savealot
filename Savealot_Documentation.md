# Team 3 [Save-a-lot] - Official Documentation

## This documentation describes the components of the Save-a-lot application

## <ins>Team members</ins>

- Viet Anh (Bill) Nguyen
- Jacob McCallum
- Harkirat Singh
- Ovi Saha

****************************************

# I. Business Case
<br></br>
![](img/savealot_full.png)

Save-a-lot is an online-exclusive grocery shop aiming to provide fresh and high-quality products with savings in mind. The target demographic includes everyone, however prioritizes students by offering a total 10% discount on their total order.
<br></br>

# II. Functional and Non-functional Requirements

### <ins>Functional Requirements:</ins>
- Shop interface displaying products with their picture, size, price, quantity in stock, and description.
- Login and registration system to allow for personalized accounts and order histories.
- Cart system that allows for added items to be checked out.
- Admin function with business intelligence dashboards and inventory management.

### <ins>Non-functional Requirements:</ins>
- Software development framework that accommodates front end, back end, and database functions.
- Database system that store user data, inventory data, and transactional OLTP data.
- Server to deploy application.
- User-friendly interface that is engaging and easy to use.
- Software design principles to ensure software quality and security.
<br></br>

# III. System architecture and designs
### <ins>System architecture:</ins>
- Save-a-lot is developed using the Laravel PHP framework, which is a Model-View-Controller framework for software development. The diagram for the framework is described below:
<br></br>
![](img/system_architecture.png)

### <ins>Sequence Diagram:</ins>

To understand how the MVC components interact with each other, below is a sequence diagram of the login and registration function as an example:
<br></br>
![](img/sequence_diagram.png)


### <ins>Technology stack:</ins>
- Model: the database engine used in this application is the MariaDB MySql connector with PHPMyAdmin dashboard to manage CRUD activities.
- Controller: all controllers were created using Laravel PHP. Interactions between the controller and the model used Laravel Eloquent statements.
- View: all front end activities in the views were created using PHP, HTML, Bootstrap, CSS, and JavaScript.
- Developmental environment: AWS EC2 Instance, AWS Cloud9 IDE
- Graphics design tool: Canva
- Collaboration tool: GitHub, Google Drive

### <ins>Database Schema:</ins>
- The database system was designed using the Star schema with a fact table (orders) containing foreign keys as the hub, and dimension tables containing primary keys connected as spokes.
- While the database system achieved second normal form (2NF), the fact table does contain foreign fields to help with query efficiency. To avoid this problem in the future, the developments will separate the OLTP and OLAP database systems and employ an ETL process in between.
- Core database schema:
<br></br>
![](img/ERD.png)
<br></br>

# IV. Implementation

## Login and Registration and Authentication System

### <ins>Create a Database on MariaDB </ins>
- Creating a new database for the application on MySql with the following commands:
```
sudo mysql -u root -p
\n
CREATE DATABASE savealot;
\n
CREATE USER IF NOT EXISTS 'saladmin'@'localhost'
    IDENTIFIED BY 'admin';
\n
GRANT ALL PRIVILEGES ON savealot.* TO 'saladmin'@'localhost';
```
- Once the database is created, go to http://your-ip:8080/phpmyadmin and login with the created user credentials to check that the database is created.

### <ins>Edit the Users Migration Table </ins>
- Inside the database\migrations directory of the Laravel Save-a-lot project, edit the create_users_table file to make sure that the fields created match with the application's ERD:
<br></br>

![](img/Lab8_Screenshot1.jpg)
- Run the php artisan migrate command in the terminal to perform migration with the aforementioned file. The users table will then be created for the savealot database:
<br></br>

![](img/Lab8_Screenshot2.jpg)
![](img/Lab8_Screenshot3.jpg)
- Verify that the User model has similar fields with the table created

### <ins>Create the auth controllers and view templates </ins>
- Run the following commands in the terminal:
```
composer require laravel/ui
\n
php artisan ui:auth
```
![](img/Lab8_Screenshot4.jpg)

### <ins>Edit the app, login, and registration templates </ins>
- Verify that the login template, registration template, login controller, registration controller, and app template were created.
- Verify that the store function of the Register controller pass the same fields as the ones in the savealot users table.
- Verify that the routes lead to the right login and register files.
- Modify the look and feel of the template files (app, login, register):

### <ins>Testing </ins>
- Initiate the Laravel server with php artisan serve --port=8080 --host=0.0.0.0
- Go to http://your-ip:8080/ to access the application
- Testing registering a new account:
<br></br>

![](img/Lab8_Screenshot5.jpg)
- Message notifying that account was created using home.blade.php template:
<br></br>

![](img/Lab8_Screenshot6.jpg)
- Verifying that the account was created and is stored in the savealot users table:
<br></br>

![](img/Lab8_Screenshot7.jpg)
- Testing logging in with user that was just created. Testing that credentials validation is working with the wrong email+password combo:
<br></br>

![](img/Lab8_Screenshot8.jpg)
- Modified app template displaying user who is currently logged in. Dropdown menu from user displays additional features:
<br></br>

![](img/Lab8_Screenshot9.jpg)

## Shop System
### <ins>Creating Tables on MariaDB </ins>
- The tables were created on MariaDB using the same SQL syntax as the Users table in the previous section. Tables created were inventories, orders, and transactions:
<br></br>

![](img/final1.jpg)
![](img/final2.jpg)
![](img/final3.jpg)

### <ins>Shop controller functions and view templates </ins>
The controller methods for the shop interface comprise of 2 functions: shop() and search(): 
- shop() interacts with the model and returns item data to the view templates.
- search() returns specific items with input being the keyword typed in the search bar in the view template.

All functions were invoked using the GET method of the URL, routed to the controller in the web.php file.
<br></br>

![](img/final4.jpg)
The view uses a @foreach loop to loop through items returned by the controller and populate them in html modals. Each modal also has specific buttons to add items to the cart as well as adjusting their in-cart quantity using sessions. The search bar is integrated to the nav bar and takes input to return the shop view with items matching the search criteria. The search algorithm uses SQL LIKE keyword. The view template also uses csrf to enforce personalized carts and order history.
<br></br>

![](img/final5.jpg)
![](img/final6.jpg)

### <ins>Cart controller functions and view template</ins>
The controller methods for the cart comprise of 4 functions: addToCart(), removeFromCart(), emptyCart(), and cart():
- addToCart(): adds item in the shop model to the cart session.
- removeFromCart(): removes the added item from the cart.
- emptyCart(): empties session and removes all items from the cart.
- cart(): return inventory items and pass item information to the cart view.

All functions were invoked using the GET method of the URL, routed to the controller in the web.php file.
<br></br>

![](img/final7.jpg)

The view uses a @foreach loop to populate items in the session into the cart html table. An if conditional statement is also used to interact with the model to find the student status of the logged in user. All pricing attributes and student status are used to calculate the order subtotal/total right inside the view.
<br></br>

![](img/final8.jpg)
![](img/final9.jpg)

## Homepage

### <ins>Homepage view template </ins>
The view template of the homepage employs a carousel element that automatically scrolls through different advertisement banners to entice shoppers. Each banner also has a specific button that redirects users to the correct page of the application. Additional featurettes underneath the carousel tell the users more on the purpose and values of Save-a-lot. All graphics design elements of the application including the logo were designed from scratch.
<br></br>

![](img/final10.jpg)
![](img/final11.jpg)
![](img/final12.jpg)

## Admin page

### <ins>Admin view template </ins>
The view template of the admin function enables powerful data visualization of business intelligence. The api used for the data visualization tool is the Canvas API, using JavaScript to feed data and customize cosmetic elements.
<br></br>

![](img/final13.jpg)

The view also restricts access of the dashboards to only the admin user, using the Auth model. Therefore, the dashboards cannot be access using their URLs without logging in first.  The admin user can monitor in different time intervals such as last 7 days, last 12 months, and last 12 years.
<br></br>

![](img/final14.jpg)

### <ins>Admin controller functions </ins>
The controller functions comprise of dashboard() functions for each data visualization tool:
- OrdersDashboard(): calculates the time series for the charts' X labels and pass queried data from the model to the view to be fed to the Canvas API object. Data in this function pertains to orders and revenue.
- UsersDashboard(): calculates the time series for the charts' X labels and pass queried data from the model to the view to be fed to the Canvas API object. Data in this function pertains to the count of new users being created.
- InventoriesDashboard(): calculates the count of in stock items for each item in the inventory.
```
public function OrdersDashboard(Request $request) {
        session(['dashboardDates' => $request->dashboardDates]);
        $dates = session('dashboardDates');

        $orders = Order::selectRaw('*, DATE_FORMAT(created_at, "%Y") as year, DATE_FORMAT(created_at, "%Y-%m") as month, DATE_FORMAT(created_at, "%Y-%m-%d") as day')->get();
        $today = Carbon::today();

        switch ($dates) {
            case 'last5y':
                $ordersGrouped = array();
                for ($i=4; $i >= 0; $i--) {
                    $year = $today->subYears($i);
                    $o = $orders->where('year', '=', $year->format("Y"));
                    $ordersGrouped[$year->format("Y")] = array('date' => $year->format("Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $year->addYears($i);
                }
                break;
            case 'last12m':
                $ordersGrouped = array();
                for ($i=11; $i >= 0; $i--) {
                    $month = $today->subMonths($i);
                    $o = $orders->where('month', '=', $month->format("Y-m"));
                    $ordersGrouped[$month->format("Y-m")] = array('date' => $month->format("F Y"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $month->addMonths($i);
                }
                break;
            case 'last7d':
                $ordersGrouped = array();
                for ($i=6; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
            case 'last30d': default:
                $ordersGrouped = array();
                for ($i=29; $i >= 0; $i--) {
                    $day = $today->subDays($i);
                    $o = $orders->where('day', '=', $day->format("Y-m-d"));
                    $ordersGrouped[$day->format("Y-m-d")] = array('date' => $day->format("F d"), 'count' => $o->count(), 'revenue' => $o->sum('total'));
                    $day->addDays($i);
                }
                break;
        }

        $transactions = Transaction::all();
        $inventory = Inventory::all();

        return view('orders',['orders' => $orders, 'transactions' => $transactions, 'inventory' => $inventory, 'ordersGrouped' => $ordersGrouped]);
    }
```
<br></br>

# V. Potential updates for future iterations
Due to the shortage of time in the development cycle, several implementations were postponed to future updates of the application. Some of the most notable additions to the software are:
- Dedicated OLAP database: the current business intelligence queries are made with transactional OLTP data, which compromises a lot of data warehouse design principals. Future BI activities will be conducted on an OLAP database instead. An ETL process will take place to load data from the OLTP database to the OLAP system, enabling BI queries.
- Application deployment: the application will be deployed on a dedicated server instead of using the Laravel artisan server on the development environment.
<br></br>

# Glossary
- Application URL: http://44.213.185.87:8080/index
- GitHub repository: https://github.com/bill071194/savealot
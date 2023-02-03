# Ecommerce
- This project is about buying and selling products online through the website.
- User searches for products and make orders the product for delivery.
- Payment is made online via payment gateway(eg.Esewa)
- Use can give review and rating about products.


# Installation Prerequiste
- Git
     ##### For Window operating system
      - Download git for window from official site.
      https://git-scm.com/download/win


     ##### For Linux operating system 
        sudo yum install git -y

- PHP version 7.3 or greater is required as this project runs on Laravel 8
- Web server like Apache or XAMPP installed and configured, and a database management system like MySQL, PostgreSQL, or SQLite.
- Dependency manager (Composer) is required.
 <br><br>

                    
# Installation
- Clone the repository:
 
        git clone https://github.com/nepalirakesh/E-commerce.git

- Navigate to the project directory:

        cd E-commerce

- Install the dependencies:

        composer install

- Create **.env** file and copy the contents of **.env.example** file:

        cp .env.example .env

- Generate an app key and it will be reflected on APP_KEY field of new created **.env** file :

        php artisan key:generate

- Configure the database connection in the **.env** file
        DB_DATABASE= "Your database name"
        DB_USERNAME= "Your username" or by default it is **root**
        DB_PASSWORD= "Your password"

- Run the migrations to make required tables(authors,posts,categories,tags,post_tag) on database :

       php artisan migrate
       
- To link storage folder and public folder

       php artisan storage:link

- Start the development server: 

       php artisan serve

- The application will be running at http://localhost:8000
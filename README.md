Step 1: Clone the Repository

	git clone <your-repository-url>

	cd <project-directory>


Step 2: Install Composer Dependencies

	composer install


Step 3: Set Up Environment Variables

	Duplicate the .env.example file and rename it to .env
	Update the .env file with your database credentials


Step 4: Generate Application Key

	php artisan key:generate


Step 5: Set Up Database

	1) Create a new MySQL database.

	2) Run the database migrations:
		php artisan migrate

	3) Seed the database with initial data:
		php artisan db:seed

Step 6: Storage Folder Link

	php artisan storage:link

Step 7: Serve the Application

	You can run the application using:

	php artisan serve


	The application will be available at http://localhost:8000.


Additional Commands
	
	Cache Configuration:
		php artisan config:cache
		php artisan route:cache
		php artisan view:cache

	Clear Cache:
		php artisan config:clear
		php artisan cache:clear
		php artisan route:clear
		php artisan view:clear

Contact

	For any questions or support, contact:

	Email: meetgondaliya999@gmail.com

User Login For Credential

    email: demo1@gmail.com
    password: password

    password same for all email demo1 to demo10 @gmail.com

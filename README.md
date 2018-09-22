#INSTALL

To run the application in the system should be installed
- MySql server
- PHP
- Node.js with npm


1. Import database schema and the table from ToDoListDB.sql file.
2. Backend setup.
	a. Go to Backed directory:
		cd Backend 
	b. Setup database credentials in config.ini file
	c. Run:
		php -S localhost:8080
3. Frontend setup.
	If backend server was started on the another hostname and port,
	you have to change CONFIG.apiUrl in Frontend/src/app/data.service.ts!
	a. Go to Frontend directory:
		cd ../Frontend
	b. Run:
		npm intall
	c. Run:
		npm start
	If defaut port 4200 is already in use. Use 'ng server' command with  '--port' to specify a different port.
		ng server --port 4201
4. Open the app at url
	http://localhost:4200/

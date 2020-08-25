<strong>
NTP Tech Test with REST API's for a directory listing of practitioner profiles.<br />

Includes any endpoints required to perform the CRUD operations.<br />
Unauthenticated users are only be able to view, search and sort the listings, and authenticated users are able to perform
Create, Update, and Delete actions.<br />

Language and Framework used: PHP, Laravel<br />
Database: MongoDB  <br />

Postman Collection Imort: https://www.getpostman.com/collections/a775d97e177061c742bf <br/>

docker-compose.yml included to set-up the application, the steps are as follows :<br />

1. git clone https://github.com/venkeyRao/NTP-TEST.git<br />
2. cd NTP-TEST<br />
3. docker-compose build && docker-compose up -d && docker-compose logs -f<br />
 
Manual Installtion:
1. Install php, apache, mongodb & composer with all the required extensions and setting to run a laravel application.<br />
2. git clone https://github.com/venkeyRao/NTP-TEST.git<br />
3. cd NTP-TEST<br />
4. comoser install
5. php artisan key:generate
5. php artisan migrate

Note : Default NTP Admin user is created with follwing credentials after migration is run</br>
Email: ntp_admin@ntp.au</br>
Password: ntp@123</br>
This user can be used to Create,Update and Delete Practitioner Profiles.</br>

</strong>

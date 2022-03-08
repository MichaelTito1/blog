# Installations

Please make sure to have the following installed on your device:
* PHP
* Laravel 7+
* XAMPP, this is necessary to install Apache and MySQL
* Postman, to test the backend

# How to use the API
## Register admin:
1. In postman, enter the following URI as a POST request [http://localhost:8000/api/register]
2. In the body, enter 'name', 'email', 'password', 'password_confirmation'
3. send the request.

## Admin Login:
1. In postman, enter the following URI as a POST request [http://localhost:8000/api/login]
2. In the body, enter `email`, `password`
3. send the request
4. copy the `access_token` from the resulting JSON

## Add Payments till the end of the year
1. Login
2. Copy `access_token` and paste it in postman
3. send the following URI as POST [http://localhost:8000/api/projects/fillTable]
4. Check the `projects` table to see the results

## View Payments by month
1. Login & Copy `access_token` and paste it in postman
2. send the following URI as GET [http://localhost:8000/api/projects/{month}]. Type `month` in the 3 letter Capitalized format (e.g. Aug)

## Send Email Notifications
There is a command that checks if there is a payment within 2 days then sends a notification email to all admins.
# xarisma
Order status tracking project for Xarisma

Instsallation Procedure
==============================================
1. Create an Apache website called 'xarisma'
2. Install Symfony into new webite
3. Clone this repository into your xarisma site
4. Create an empty MySql database called xarisma
5. Create a MySql user named 'xarisma', and grant user full access to 'xarisma' database
6. Create all schema tables with following command "app/console doctrine:schema:create"
6a.Verify tables were created in database via MySql
7. Load basic data into db by running the 'load_base_data.sql' script, located in the 'sql_scripts' directory of the XarismaBundle directory.
8. Open site in web browser to confirm it works. There will be no customer or order data.

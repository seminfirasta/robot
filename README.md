# robot
robot to clean the apartment floor

Steps:
1 download the zip file, extract to the root folder (if xampp then extract inside htdocs folder)

2 open command prompt, go to that folder and run the below commands

Install
composer update

Run Project
php robot.php clean --floor=carpet --area=70

Run Tests
vendor\bin\phpunit --bootstrap ./vendor/autoload.php tests

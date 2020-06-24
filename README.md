# robot
Robot to clean the apartment floor. The project will show the state output while it's cleaning or charging the battery. The --floor parameter should accept either hard or carpet to determine how the robot should behave based on the following assumptions:

Assumptions

● The robot has a battery big enough to clean for 60 seconds in one charge. 

● The robot can clean 1 square meter of hard floor in 1 second. 

● The robot can clean 1 square meter of carpet in 2 seconds. 

● The battery charge from 0 to 100% takes 30 seconds.


Steps:

1 download the zip file, extract to the root folder (if xampp then extract inside htdocs folder)

2 open command prompt, go to that folder and run the below commands


Install

composer update


Run Project with below commands

php robot.php clean --floor=carpet --area=70
php robot.php clean --floor=hard --area=30
php robot.php clean --floor=carpet --area=20
php robot.php clean --floor=hard --area=90


Run Tests

vendor\bin\phpunit --bootstrap ./vendor/autoload.php tests

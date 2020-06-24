<?php

namespace App\Apartment;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Robot\Robot;

class Apartment extends Command {

    public function __construct() {
        parent::__construct();
    }

    // set the name and parameters
    protected function configure() {
        $this->setName('clean');
        $this->addOption('floor', NULL, InputOption::VALUE_REQUIRED, 'Type of floor');
        $this->addOption('area', NULL, InputOption::VALUE_REQUIRED, 'Area in meter squared');
    }

    // execute the program
    public function execute(InputInterface $input, OutputInterface $output) {
        $this->startWork($input, $output);
    }

    // main function for the whole program
    protected function startWork(InputInterface $input, OutputInterface $output) {
        $floor = $input->getOption('floor');    // hard or carpet
        $area = $input->getOption('area');      // number

        $isFloorValid = $this->isFloorValid($floor);
        $isAreaValid = $this->isAreaValid($area);
        $floorMessage = ($isFloorValid) ? "" : " is either empty or not supported";
        $areaMessage = ($isAreaValid) ? "" : " is either empty or not supported";

        $output->writeln("floor : " . $floor . $floorMessage);
        $output->writeln("area : " . $area . $areaMessage);

        // if true then call the run method and display output
        if($isFloorValid and $isAreaValid) {
            $robotObj = new Robot($input->getOption('floor'), floatval($input->getOption('area')));
            $tasks = $robotObj->run();
            foreach ($tasks as $taskType => $taskTime) {
                $output->writeln($taskType . " : " . date('h:i:s') . " for " . $taskTime . " second(s)");
                sleep(intval($taskTime));
            }
        }
    }

    // validation for floor type
    private function isFloorValid($floorType) {
        if(array_key_exists($floorType, Robot::FLOOR_TYPES)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // validation for area
    private function isAreaValid($area) {
        if(is_numeric($area) and $area > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
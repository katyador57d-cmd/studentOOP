<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Grade.php';
require_once __DIR__ . '/src/Student.php';
require_once __DIR__ . '/src/StudentList.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/GradeFilter.php';
require_once __DIR__ . '/src/MenuHandler.php';

$studentList = new StudentList();
$display = new Display();
$filter = new GradeFilter();

$menu = new MenuHandler($studentList, $filter, $display);
$menu->run();

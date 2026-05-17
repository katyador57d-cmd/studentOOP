<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Grade.php';
require_once __DIR__ . '/src/Student.php';
require_once __DIR__ . '/src/StudentList.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/GradeFilter.php';
require_once __DIR__ . '/src/MenuHandler.php';

$student = new Student('Kate', 21);
$student->addGrade(new Grade('Math', 'B', '2023-04-23'));
$student->addGrade(new Grade('Math', 'C', '2023-04-23'));
$student->addGrade(new Grade('English', 'F', '2021-04-23'));
$student->addGrade(new Grade('English', 'B', '2024-04-23'));

$newGrade = $student->getGradesBySubject('Math');
//print_r($newGrade);

$mostGrade = $student->getMostCommonGrade();
//print_r($mostGrade);

$bestGrades = $student->getBestGrade();
//print_r($bestGrades);

$s = $student->getSubjectMostCommonGrade('English');
//print_r($s);

$d = $student->hasGradeBySubject('Math', 'A');

//print_r($d);
//var_dump($d);

$studentList = new StudentList();
$studentList->add($student);
$display = new Display();
$filter = new GradeFilter();
//$display->printSubjectList($studentList->getAll());

$menu = new MenuHandler($studentList, $filter, $display);
$menu->run();

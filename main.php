<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Grade.php';
require_once __DIR__ . '/src/Student.php';
require_once __DIR__ . '/src/StudentList.php';
require_once __DIR__ . '/src/Display.php';
require_once __DIR__ . '/src/GradeFilter.php';
require_once __DIR__ . '/src/MenuHandler.php';

$grade = new Grade('Math', 'B', '12.03.2023');

$grade = new Grade('Math', 'C', '12.03.2023');
$grade = new Grade('Math', 'C', '12.03.2023');

$grade = new Grade('English', 'F', '12.03.2023');
$grade = new Grade('English', 'B', '12.03.2023');
$grade = new Grade('English', 'F', '12.03.2023');
$student = new Student('Kate', 21);
$student->addGrade($grade);

$newGrade = $student->getGradesBySubject('Math');
//print_r($newGrade);

$mostGrade = $student->getMostCommonGrade('English');
//print_r($mostGrade);

$bestGrades = $student->getBestGrade();
//print_r($bestGrades);

$s = $student->getSubjectMostCommonGrade('English');
//print_r($s);

$d = $student->hasGradeBySubject('Math', 'A');

print_r($d);
var_dump($d);
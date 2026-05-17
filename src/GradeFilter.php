<?php
declare(strict_types=1);

class GradeFilter {

    public function filterByActive(array $students, bool $activeOnly): array
    {
        $activeStudents = [];

        foreach($students as $activeStudent) {
            if ($activeOnly && $activeStudent->isActive()) {
                $activeStudents[] = $activeStudent;
            } elseif (!$activeOnly && !$activeStudent->isActive()) {
                $activeStudents[] = $activeStudent;
            }
        }
        return $activeStudents;
    }

    public function filterByBestGrade(array $students, string $grade): array
    {
        $result = [];
        
        foreach ($students as $student) {
            if ($grade === $student->getBestGrade()) {
                $result[] = $student;
            }
        }
        return $result;
    }

    public function filterBySubjectGrade(array $students, string $subject, string $grade): array 
    {
        $result = [];

        foreach ($students as $student) {
            if ($student->hasGradeBySubject($subject, $grade)) {
                $result[] = $student;
            }
        }
        return $result;
    }

    public function sortByName(array $students): array
    {
        usort($students, fn($a, $b) => strcmp($a->name, $b->name));
        return $students;
    }

    public function sortByBestGrade(array $students): array
    {
   
        usort($students, function ($a, $b) {
            $bestGradeA = $a->getBestGrade();
            $bestGradeB = $b->getBestGrade();
            
            $indexA = array_search($bestGradeA, Grade::GRADES);
            $indexB = array_search($bestGradeB, Grade::GRADES); 
            return $indexA<=> $indexB;  
        });
        return $students;
    }

    public function sortByAge(array $students): array 
    {
        usort($students, fn ($a, $b) => $a->age <=> $b->age);
        return $students;
    }
}
<?php
declare(strict_types=1);

class StudentList {
    private array $students;
    public function __construct()
    {    
    $this->students = [];
    }

    public function add(Student $student): bool
    {
       if ($this->findByName($student->name) !== null) {
        return false;
       }

       $this->students[] = $student; 
       return true;
    }

    public function findByName(string $name): ?Student
    {
        foreach ($this->students as $student) {
            if (strtolower($student->name) === strtolower($name)) {
                return $student;
            }
        }
        return null;
    }

    public function exists(string $name): bool
    {
        foreach($this->students as $student){
            if ($student->name === $name) {
                return true;
        }
        }
        return false;
    }

    public function desactivateByName(string $name): bool
    {
        $student = $this->findByName($name);

        if($student === null) {
            return false;
        }
        
        $student->desactivate();
        return true;
    }

    public function getAll(): array
    {
        return $this->students;
    }
    
    public function isEmpty(): bool
    {
        if (empty($this->students)) {
            return true;
        } 
        return false;
    }

    public function getBestStudent(): ?Student
    {
       $bestStudent = null;
       $bestGrade = 'F';
    
       foreach ($this->students as $student) {
        $grade = $student->getBestGrade();
        
        if ($grade === '') {
            continue;
        }

        if (array_search($grade, Grade::GRADES) < array_search($bestGrade, Grade::GRADES )) {
            $bestStudent = $student;
            $bestGrade = $grade;
        }
    }
        return $bestStudent;
    }

}

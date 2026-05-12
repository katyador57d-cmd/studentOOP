<?php
declare(strict_types=1);

class Student {

    private bool $isActive;
    private array $grades;

    public function __construct(
        public readonly string $name,
        public readonly int $age,
    ) {
        $this->isActive = true;
        $this->grades = [];
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function desactivate(): void
    {
        $this->isActive = false;
    }

    public function addGrade(Grade $grade): void
    {
        $this->grades[] = $grade;
    }

    public function getGrades(): array 
    {
        return $this->grades;
    }

    public function getGradesBySubject(string $subject): array
    {

        $result = [];
        foreach ($this->grades as $grade) {
            if($grade->subject === $subject) {
                $result[] = $grade;
            }
        }
        return $result;
    }

    public function getMostCommonGrade(string $subject): ?string
    {
        if(empty($this->grades)) {
            return null;
        }

        $gradesCount = [];

        foreach($this->grades as $grade) {
            if(!isset($gradesCount[$grade->grade])) {
                $gradesCount[$grade->grade] = 0;
            }
            $gradesCount[$grade->grade]++;     
        }

        arsort($gradesCount);
        return array_key_first($gradesCount);

    }

    public function getBestGrade(): ?string
    {
        if(empty($this->grades)) {
            return null;
        }     
       
        $bestGrade = $this->grades[0]->grade;

        foreach($this->grades as $grade) {
            if (array_search($grade->grade, Grade::GRADES) < array_search($bestGrade, Grade::GRADES)) {
                $bestGrade = $grade->grade;
            }
        }

        return $bestGrade;

    }

    public function getSubjectMostCommonGrade(string $subject): ?string
    {  
        $filtered= [];

        foreach($this->grades as $grade) {
            if($grade->subject === $subject) {
                $filtered[] = $grade;
            }
        }

        if(empty($filtered)) {
            return null;
        }
        
        $gradeCount = [];

        foreach($filtered as $grade) {
           
            if(!isset($gradeCount[$grade->grade])) {
                $gradeCount[$grade->grade] = 0;
            }
        $gradeCount[$grade->grade]++;
        
    }
        
        arsort($gradeCount);
        return array_key_first($gradeCount);
    }

    public function hasGradeBySubject(string $subject, string $grade): bool
    {
        foreach($this->grades as $item) {
            if($item->subject === $subject && $item->grade === $grade) {
                return true;
            }
        }

        return false;
    }

    
}
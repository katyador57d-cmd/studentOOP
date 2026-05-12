<?php

declare(strict_types=1);

class Grade
{
    
    const GRADES = ['A', 'B', 'C', 'D', 'F'];

    const SUBJECT = [
        'Math',
        'Physics',
        'History',
        'English',
        'Computer Science',
    ];

    public function __construct(
        public readonly string $subject,
        public readonly string $grade,
        public readonly string $date,
    ) {
    }

    public function getGradeIndex(): int
    {

        foreach (self::GRADES as $key => $grade) {  
            if ($this->grade === $grade ) {
                return $key;
            }
        } 
        
        return -1;
    }
}
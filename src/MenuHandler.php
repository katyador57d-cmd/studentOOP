<?php
declare(strict_types=1);

class MenuHandler {
    public function __construct ( 
        private readonly StudentList $studentlist,
        private readonly GradeFilter $filter,
        private readonly Display $display)
    {
    }

    public function run(): void 
    {
        while (true) {
            $this->display->printMainMenu();
            $mainMenu = (int) readline("Введите число:");
            switch($mainMenu) {
                case 1: 
                    $this->handleAddStudent();
                    break;
                case 2:
                    $this->handleAddGrade();
                    break;
                case 3:
                    $this->handleFindStudent();
                    break;
                case 4:
                    $this->handleReports();
                    break;
                case 5:
                    $this->handleFilters();
                    break;  
                case 6:
                    return;

                
            }

        }
    }

    public function handleAddStudent(): void
    {
        $name = $this->readLine("Введите имя студента: ");
        $age = (int) readline("Введите возраст студента");
        try {
            $student = new Student($name, $age);
            $added = $this->studentlist->add($student);

            if(!$added) {
                $this->display->printError("Студент такой есть");
                return;
            }
            $this->display->printSuccess("Добавлено.");
        } catch (InvalidArgumentException $e) {
            $this->display->printError($e->getMessage());
        }

    }

    public function handleAddGrade(): void
    {   
        $studentName = $this->readLine("Выберите имя студента: ");
        $student = $this->studentlist->findByName($studentName);

        if ($student === null) {
            $this->display->printError("Студент не найден");
            return;
        }
        
        $subject =$this->selectSubject();
        $grade = $this->selectGrade();
        $date = date('Y-m-d');
        
        try {
            $gradeObject = new Grade($subject, $grade, $date);
            $student->addGrade($gradeObject);
            $this->display->printSuccess("Добавлено");
        } catch(InvalidArgumentException $e) {
            $this->display->printError($e->getMessage());
        }
    }

    private function handleFindStudent(): void
    {
        $studentName = $this->readLine("Введите имя студента");
        $student = $this->studentlist->findByName($studentName);

        if ($student === null) {
            $this->display->printError("Студент не найден");
            return;
        }
         $this->display->printStudentCard($student);
    }

    private function handleReports(): void
    {
        while (true) {
            $this->display->printReportSubmenu();
            $choice = (int)readline("Выберите нужный пункт: ");
            switch($choice) {
                case 1:
                    $subject = $this->selectSubject();
                    $student = $this->studentlist->getAll();
                    $this->display->printSubjectReport($student, $subject);
                    break;
                case 2:
                    $studentName = $this->readLine("Введите имя студента: ");
                    $student = $this->studentlist->findByName($studentName);
                
                    if ($student === null) {
                    $this->display->printError("Студент не найден");
                    break;
                }
                    $subject = $this->selectSubject();
                    $this->display->printGradeHistory($student, $subject);
                    break;
                case 3:
                    return;
            }
        }
    }

    public function handleFilters(): void
    {
        while (true) {
        $students = $this->studentlist->getAll();

        $this->display->printFilterSubmenu();
        $choice = (int)readline("Выберите нужный пункт меню: ");
    
        switch($choice) {
            case 1:
                $filtered = $this->filter->filterByActive($students, true);
                $this->display->printStudentsTable($filtered);
                break;
            case 2:
                $grade = $this->selectGrade();
                $filtered = $this->filter->filterByBestGrade($students, $grade);
                $this->display->printStudentsTable($filtered);
                break;

            case 3:
                $filtered = $this->filter->sortByBestGrade($students);
                $this->display->printStudentsTable($filtered);
                break;

            case 4:
                $filtered = $this->filter->sortByName($students);
                foreach($filtered as $key => $filter) {
                    echo ($key+1) . ". " . $filter->name . "\n";
                }
                break;
            case 5:
                $filtered = $this->filter->sortByAge($students);
                foreach($filtered as $key => $filter) {
                    echo ($key+1) . ". " . $filter->age . "\n";
                }
                break;
            case 6:
                return;
        }
        }
    }

    private function selectSubject(): string
    {
        echo "----НАШИ ПРЕДМЕТЫ-----" . "\n";
        foreach(Grade::SUBJECT as $key => $subject) {
            echo ($key+1) . ". " . $subject . "\n";
        }
        $choice = (int) $this->readLine("Выберите предмет: "); 
        return Grade::SUBJECT[$choice -1];  
    }

    private function selectGrade(): string
    {
        return $this->readLine("Выберите оценку(A, B, C, D, E, F): ");   
    }

    private function readLine(string $prompt): string
    {
        return trim(readline($prompt));
    }

    private function readInt(string $prompt): int
    {
        return (int)readline($prompt);
    }
}
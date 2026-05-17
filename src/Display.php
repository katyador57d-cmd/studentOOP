<?php
declare(strict_types=1);

class Display {
    public function printMainMenu(): void
    {
        $menu= [
            "Добавить студента",
            "Работа с оценками",
            "Найти студента",
            "Отчет",
            "Фильтры",
            "Выход"
        ];
        
        foreach($menu as $key => $item) {
        echo ($key+1) . ". " . $item . PHP_EOL;
        }
    }

    public function printReportSubmenu(): void 
    {
        $menu = [
            "Отчет по предмету",
            "История оценок студента", 
            "Выход"
        ];
        foreach($menu as $key => $item) {
            echo ($key+1) . ". " . $item . PHP_EOL;
        }
    }
    
    public function printFilterSubmenu(): void
    {
        $menu = [
            "Показать только активных студентов",
            "Отсортировать по лучшей оценке",
            "От лучшей оценки к худшей",
            "Отсортировать по имени",
            "Отсортировать по возрасту",
            "Выход"
        ];
        foreach($menu as $key => $item) {
        echo ($key+1) . ". " . $item . PHP_EOL;
        }
    }

    public function printStudentCard(Student $student): void
    {
        echo "______________________" . "\n";
        echo "Карточка обучающегося" . "\n";
        echo "______________________" . "\n";
        echo "Имя: " . $student->name  . "\n";
        echo "Возраст: " . $student->age . "\n";
        echo "Статус: " . ($student->isActive() ? 'active' : 'desactive')  . "\n";
        echo "Лучшая оценка: " . $student->getBestGrade() . "\n";
        
    }

    public function printStudentsTable(array $students): void
    {
        echo "Сведения:" . "\n";
        echo "_____________________________________________________________" . "\n";
        echo "Имя ученика      Возраст    Статус    Лучшая оценка" . "\n";
        echo "_____________________________________________________________" . "\n";

        foreach ($students as $key => $studentCard) {
            echo ($key+1) . ". " 
            . $studentCard->name . " "
            . $studentCard->age . " "
            . ($studentCard->isActive() ? 'active' : 'desactive') . " "
            . $studentCard->getBestGrade()
            . PHP_EOL;
        }

    }

    public function printSubjectReport(array $students, string $subject): void
    {
        echo "_____________________________________________________________" . "\n";
        echo "Ваш предмет: " . $subject;
        echo "_____________________________________________________________" . "\n";

        $found = false;

        foreach($students as $student) {
            $grades = $student->getGradesBySubject($subject);

            if(empty($grades)) {
                continue;
            }

        $found = true;

        echo "Студент: " . $student->name . "\n";

        foreach ($grades as $grade) {
            echo "Оценка: " . $grade->grade . "\n";
        }

        echo "Лучшая оценка: " . $student->getSubjectMostCommonGrade($subject) . "\n";
        echo "_____________________________________________________________" . "\n";
        }

        if(!$found) {
            echo "Нет оценок по предмету" . "\n";
        }
    }

    public function printGradeHistory(Student $student, string $subject): void
    {
        $grades = $student->getGradesBySubject($subject);

        if(empty($grades)) {
            echo "Оценок нет!" . "\n";
            return;
        }

        echo "История оценок: " . "\n";
        echo "______________________" . "\n";

        foreach ($grades as $grade) {
            echo "Оценка: " . $grade->grade . " |Дата: " . $grade->date . "\n";
        }


    }

    public function printSubjectList(array $students): void 
    {
        $subject = [];

        foreach($students as $student) {
            foreach ($student->getGrades() as $grade) {
                $subject[] = $grade->subject;
            }
        }

        $subject = array_values(array_unique($subject));
        
        if (empty($subject)) {
            echo "Нет предметов";
            return;
        }

        echo "Список предметов: " . "\n";

        foreach ($subject as $key => $subjectone) {
            echo ($key+1) . ". "   . $subjectone . "\n";
        }
        }

    public function printSuccess(string $message): void
    {
        echo "Успешно! " . $message . "\n";
    }

    public function printError(string $message): void
    {
        echo "Ошибка: " . $message . "\n";
    }
}
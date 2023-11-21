<?php

namespace App\Filament\Resources\StudentHasClassResource\Pages;

use App\Filament\Resources\StudentHasClassResource;
use Filament\Forms\Components\Card;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use App\Models\Periode;
use App\Models\Student;
use App\Models\HomeRoom;
use App\Models\StudentHasClass;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;

class FormStudent extends Page implements HasForms
{

    use InteractsWithForms;
    protected static string $resource = StudentHasClassResource::class;

    protected static string $view = 'filament.resources.student-has-class-resource.pages.form-student';

    public $student =[];
    public $homeroom = '';
    public $periode = '';

    public function mount():void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array{
        return [
            Card::make()
                ->schema([
                        Forms\Components\Select::make('students_id')
                            ->searchable()
                            ->multiple()
                            ->options(Student::all()->pluck('name','id'))
                            ->label('Students')
                            ->columnSpan(3),
                        Forms\Components\Select::make('homerooms_id')
                            ->searchable()
                            ->options(HomeRoom::all()->pluck('classroom.name','id'))
                            ->label('Class Berapa'),
                        Forms\Components\Select::make('periode_id')
                            ->searchable()
                            ->options(Periode::all()->pluck('name','id'))
                            ->label('Periode'),
                ])->columns(3)
                ];
    }

    public function save() {
        $student = $this->students;
        $insert = [];
        foreach($student as $row) {
            array_push($insert, [
                'students_id' => $row,
                'homerooms_id' => $this->homerooms,
                'periode_id' => $this->periode,
                'is_open' => 1
            ]);
        }
        StudentHasClass::insert($insert);
        return redirect()->to('admin/student-has-classes');
    }

}

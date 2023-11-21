<?php

namespace App\Filament\Resources\StudentHasClassResource\Pages;

use App\Filament\Resources\StudentHasClassResource;
use Filament\Forms\Components\Card;
use Filament\Resources\Pages\Page;

class FormStudent extends Page
{
    protected static string $resource = StudentHasClassResource::class;

    protected static string $view = 'filament.resources.student-has-class-resource.pages.form-student';

    public $student =[];
    public $homeroom = '';
    public $peruide = '';

    public function mount():void
    {
        $this->form->fill();
    }

    public function getFormScheme(): array{
        return [
            Card::make()
                ->schema([

                        Forms\Components\Select::make('students_id')
                            ->searchable()
                            ->multiple()
                            ->options(Student::all()->pluck('name','id'))
                            ->label('Students'),
                        Forms\Components\Select::make('homerooms_id')
                            ->searchable()
                            ->options(HomeRoom::all()->pluck('classrooms.id','id'))
                            ->label('Class Berapa'),
                        Forms\Components\Select::make('periode_id')
                            ->searchable()
                            ->options(Periode::all()->pluck('name','id'))
                            ->label('Periode'),
                ])->columns(3)
                ];
    }

}

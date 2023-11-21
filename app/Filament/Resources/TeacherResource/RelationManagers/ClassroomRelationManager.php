<?php

namespace App\Filament\Resources\TeacherResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ClassroomRelationManager extends RelationManager
{
    protected static string $relationship = 'classroom';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('classrooms_id')
                    ->relationship('classroom', 'name')
                    ->createOptionAction(
                        fn (Action $action) => $action->modalWidth('3xl'),
                    )
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Hidden::make('slug')
                    ]),




                Forms\Components\Select::make('periode_id')
                    ->relationship('periode', 'name'),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('classroom.name'),
                Tables\Columns\TextColumn::make('periode.name'),
                Tables\Columns\ToggleColumn::make('is_open'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}

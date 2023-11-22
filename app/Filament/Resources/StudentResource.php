<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Illuminate\Database\Eloquent\Collection;



use Filament\Tables\Actions\CreateAction;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nis')->label('NIS'),
                Forms\Components\TextInput::make('name')->label('Nama Student')
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->options([
                        "Male" => "Male",
                        "FEMALE" => "Female"
                    ]),
                Forms\Components\DatePicker::make('birthday')
                    ->label("Birthday")
                    ->required()
                    ->maxDate(now()),
                Forms\Components\Select::make('religion')
                    ->options([
                        'islam' => 'Islam',
                        'sunnah' => 'Sunnah',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('contact')->label('Contact'),
                Forms\Components\FileUpload::make('profile')->label('Profile'),
                Forms\Components\Select::make('status')
                    ->options([
                        "Accept" => "accept",
                        "Off" => "off",
                        "Move" => "move",
                        "Grade" => "grade"
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nis'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birthday'),
                Tables\Columns\TextColumn::make('religion'),
                Tables\Columns\TextColumn::make('contact'),
                Tables\Columns\ImageColumn::make('Profile'),
                Tables\Columns\TextColumn::make('status'),
                    // ->formatStateUsing(fn (string $state): string => ucwords("{state}"))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('Accept')
                        ->icon('heroicon-m-check')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            return $records->each->update(['status' => 'accept']);
                        }),
                    BulkAction::make('Off')
                        ->icon('heroicon-m-x-circle')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            return $records->each(function ($record) {
                                $id = $record->id;
                                Student::where('id', $id)->update(['status' => 'off']);
                            });
                        }),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
            'view' => Pages\ViewStudent::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('nis'),
                TextEntry::make('name')
            ]);
    }
}

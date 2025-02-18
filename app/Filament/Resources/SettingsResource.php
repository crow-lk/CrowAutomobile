<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingsResource\Pages;
use App\Filament\Resources\SettingsResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingsResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Company Settings';

    public static function form(Form $form): Form
    {
        return $form->schema([Forms\Components\TextInput::make('name')->required(), 
        Forms\Components\FileUpload::make('logo')->required(), 
        Forms\Components\TextInput::make('phone')->required(), 
        Forms\Components\TextInput::make('email')->required()]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([Tables\Columns\TextColumn::make('name')->sortable()->searchable(), Tables\Columns\TextColumn::make('logo')->sortable()->searchable(), Tables\Columns\TextColumn::make('phone')->sortable()->searchable(), Tables\Columns\TextColumn::make('email')->sortable()->searchable()])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}

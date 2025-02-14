<?php

namespace App\Filament\Resources\ExpenseCategoriesResource\Pages;

use App\Filament\Resources\ExpenseCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageExpenseCategories extends ManageRecords
{
    protected static string $resource = ExpenseCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

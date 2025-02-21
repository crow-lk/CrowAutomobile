<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Actions;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Form definition
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('invoice_id')
                    ->label('Invoice ID')
                    ->relationship('invoice', 'id') // Set up the relationship properly
                    ->required(),

                TextInput::make('amount_paid')
                    ->label('Amount Paid')
                    ->required()
                    ->numeric()
                    ->step(0.01),

                Select::make('payment_method')
                    ->label('Payment Method')
                    ->options([
                        'credit_card' => 'Credit Card',
                        'paypal' => 'PayPal',
                        'bank_transfer' => 'Bank Transfer',
                        'cash' => 'Cash',
                    ])
                    ->required(),

                TextInput::make('reference_number')
                    ->label('Reference Number')
                    ->required(),

                DateTimePicker::make('payment_date')
                    ->label('Payment Date')
                    ->required()
                    ->default(now()),

                Textarea::make('notes')
                    ->label('Notes')
                    ->nullable(),
            ]);
    }

    // Table definition
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_id')->label('Invoice')->sortable(),
                TextColumn::make('invoice.amount')->label('Total')->sortable(),
                TextColumn::make('amount_paid')->label('Amount Paid')->sortable(),
                TextColumn::make('invoice.invoice_date')->label('Payment Date')->sortable(),
            ])
            ->filters([/* Define your filters here if needed */])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    // Pages for managing payments
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePayments::route('/'),
        ];
    }
}

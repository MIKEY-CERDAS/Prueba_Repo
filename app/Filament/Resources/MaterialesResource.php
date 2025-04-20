<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialesResource\Pages;
use App\Filament\Resources\MaterialesResource\RelationManagers;
use App\Models\Materiales;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class MaterialesResource extends Resource
{
    protected static ?string $model = Materiales::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->required(),
                Forms\Components\TextInput::make('descripcion')->required(),
                Forms\Components\TextInput::make('cantidad')->required()->numeric(),
                Forms\Components\TextInput::make('precio')->required()->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre'),
                Tables\Columns\TextColumn::make('descripcion'),
                Tables\Columns\TextColumn::make('cantidad')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('agregarAlCarrito')->label('Agregar al carrito')->icon('heroicon-m-plus')->color('success')->url(fn($record)=>route('filament.admin.resources.carritos.create', ['material'=>$record->id]))->openUrlInNewTab(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListMateriales::route('/'),
            'create' => Pages\CreateMateriales::route('/create'),
            'edit' => Pages\EditMateriales::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Filament\Resources\ResponseResource\RelationManagers;
use App\Models\Response;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

public static function form(Form $form): Form
{
            return $form
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            // Kolom 1 - Judul Complain
                            Forms\Components\Select::make('complain_id')
            ->label('Judul Complain')
            ->relationship('complain', 'title')
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set) {
                $complain = \App\Models\Complain::find($state);
                if ($complain) {
                    $set('complain_description', $complain->description);
                } else {
                    $set('complain_description', null);
                }
            })
            ->afterStateHydrated(function ($state, callable $set) {
                if ($state) {
                    $complain = \App\Models\Complain::find($state);
                    if ($complain) {
                        $set('complain_description', $complain->description);
                    }
                }
            }),


                    // Kolom 2 - Admin yang Merespon
                    Forms\Components\Select::make('admin_id')
                        ->label('Admin yang Merespon')
                        ->relationship('admin', 'name')
                        ->options(\App\Models\User::whereIn('role', ['admin', 'agent'])->pluck('name', 'id'))
                        ->default(auth()->id()),

                    // Kolom 1 - Deskripsi Aduan (langsung tampil & berubah saat judul diganti)
                    Forms\Components\Textarea::make('complain_description')
                        ->label('Deskripsi Aduan')
                        ->disabled()
                        ->columnSpan(1)
                        ->rows(3),

                    // Kolom 2 - Ditangani oleh
                    Forms\Components\Select::make('handled_by')
                        ->label('Ditangani oleh')
                        ->relationship('handledBy', 'name')
                        ->options(\App\Models\User::whereIn('role', ['admin', 'agent'])->pluck('name', 'id')),

                    // Kolom 1 - Isi Respon
                    Forms\Components\Textarea::make('response')
                        ->label('Isi Respon')
                        ->required()
                        ->rows(4),

                    // Kolom 2 - Diupdate oleh
                    Forms\Components\Select::make('updated_by')
                        ->label('Diupdate oleh')
                        ->relationship('updatedBy', 'name')
                        ->options(\App\Models\User::whereIn('role', ['admin', 'agent'])->pluck('name', 'id')),
                ]),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('complain.title')
            ->label('Judul Komplain'),

            Tables\Columns\TextColumn::make('admin.name')
                ->label('Admin Respon')
                ->searchable(),

            Tables\Columns\TextColumn::make('response')
                ->label('Isi Respon')
                ->limit(50)
                ->toggleable(), // bisa disembunyiin dari tampilan tabel

            Tables\Columns\TextColumn::make('updatedBy.name')
                ->label('Diupdate oleh')
                ->toggleable(),

            Tables\Columns\TextColumn::make('handledBy.name')
                ->label('Ditangani oleh')
                ->toggleable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y, H:i')
                ->sortable(),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Diperbarui')
                ->dateTime('d M Y, H:i')
                ->sortable(),
        ])
        ->filters([
            // nanti bisa ditambah filter by admin atau complain
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListResponses::route('/'),
            'create' => Pages\CreateResponse::route('/create'),
            'edit' => Pages\EditResponse::route('/{record}/edit'),
        ];
    }
}

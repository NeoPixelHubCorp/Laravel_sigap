<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Models\Response;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Pengaduan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Aduan Details')
                    ->schema([
                        Forms\Components\Select::make('complain_id')
                            ->label('Aduan')
                            ->options(\App\Models\Complain::all()->pluck('title', 'id'))
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) =>
                                $set('description', \App\Models\Complain::find($state)?->description)
                            )
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Aduan')
                            ->disabled()
                            ->dehydrated(false)
                            ->rows(3)
                            ->columnSpan(1),
                    ])
                    ->columns(2), // Menggunakan dua kolom

                Forms\Components\Section::make('Respon')
                    ->schema([
                        Forms\Components\Textarea::make('response')
                            ->label('Respon')
                            ->required()
                            ->rows(5),
                    ])
                    ->columns(1), // Menggunakan satu kolom di bagian respon

                Forms\Components\Hidden::make('admin_id')
                    ->default(auth()->id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complain.title')
                    ->label('Aduan')
                    ->html()
                    ->formatStateUsing(function ($state, $record) {
                        $title = $state;
                        $body = \Str::limit(strip_tags($record->complain->description), 50);
                        return "<div>
                                    <strong class='text-primary'>{$title}</strong><br>
                                    <span class='text-sm text-gray-500'>{$body}</span>
                                </div>";
                    }),

                Tables\Columns\TextColumn::make('response')
                    ->label('Respon')
                    ->limit(50),

                Tables\Columns\TextColumn::make('admin.name')
                    ->label('Admin Respon')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updatedBy.name')
                    ->label('Admin Update')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                // Tambahkan filter jika perlu
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
        return [];
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResource\Pages;
use App\Filament\Resources\ComplainResource\RelationManagers;
use App\Models\Category;
use App\Models\Complain;
use Filament\Support\Colors\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainResource extends Resource
{
    protected static ?string $model = Complain::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-frown';
    protected static ?string $navigationGroup = 'Pengaduan';
    protected static ?string $label = 'Aduan';
    protected static ?string $pluralLabel = 'Aduan';

public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                ->label('Status Aduan')
                ->options([
                    'pending'                => 'Pending',
                    'diverifikasi'           => 'Diverifikasi',
                    'diteruskan_ke_instansi' => 'Diteruskan ke Instansi',
                    'dalam_penanganan'       => 'Dalam Penanganan',
                    'selesai'                => 'Selesai',
                    'ditolak'                => 'Ditolak',
                ])
                ->required(),
            ]);
    }



 public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_aduan')->label('No Aduan')->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Judul')->limit(20)->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()->colors([
                'pending' => 'pending',
                'diverifikasi' => 'diverifikasi',
                'diteruskan_ke_instansi' => 'diteruskan_ke_instansi',
                'dalam_penanganan' => 'dalam_penanganan',
                'selesai' => 'selesai',
                'ditolak' => 'ditolak',
            ]),
                Tables\Columns\TextColumn::make('user.name')->label('Pengadu'),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending'                => 'Pending',
                    'diverifikasi'           => 'Diverifikasi',
                    'diteruskan_ke_instansi' => 'Diteruskan ke Instansi',
                    'dalam_penanganan'       => 'Dalam Penanganan',
                    'selesai'                => 'Selesai',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Ubah Status'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListComplains::route('/'),
            'edit' => Pages\EditComplain::route('/{record}/edit'),
        ];
    }
}

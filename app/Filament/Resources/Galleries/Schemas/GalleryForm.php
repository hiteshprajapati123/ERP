<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Actions\Action;
use Filament\Forms\Get;
// Remove Filament\Forms\Set as it's not needed
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\GalleryCategory;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_url')
                    ->image()
                    ->disk('local')
                    ->directory('private/galleries')
                    ->visibility('private')
                    ->preserveFilenames(false)
                    ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file): string => 'gallery_' . Str::random(24) . '.' . $file->getClientOriginalExtension())
                    ->required(),
                Select::make('gallery_category_id')
                    ->relationship('galleryCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Category')
                    ->suffixAction(
                        Action::make('createCategory')
                            ->icon('heroicon-o-plus')
                            ->form([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->action(function (array $data) {
                                return GalleryCategory::create([
                                    'name' => $data['name'],
                                    'slug' => Str::slug($data['name']),
                                ]);
                            })
                            ->modalHeading('Create New Category')
                            ->modalSubmitActionLabel('Create')
                            ->modalWidth('md')
                    ),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
